<?php

define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG', false);
require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

$pidFile = SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR;
define("PID_FILE", $pidFile);
if (!isset($_SERVER['argv'][1]) || empty($_SERVER['argv'][1])) {
    $_SERVER['argv'][1] = 'admin';
}
$_SERVER['DB_CONNECT_NAME'] = $_SERVER['argv'][1];
$pidFile .= strtolower($_SERVER['argv'][1]) . "_";

$pidFile .= 'milestoneCronjob.pid';
echo "PID file: {$pidFile} \n";
start();

$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();
$connection = Propel::getConnection();

try {
    $sql = 'SELECT DISTINCT project.id AS project_id, project.name AS project_name, milestone.id AS mid FROM %%milestone%% AS milestone 
            LEFT JOIN %%project%% AS project ON (milestone.project_id = project.id) 
            WHERE milestone.is_completed = ? AND milestone.deadline < ? AND project.is_project_end = ? ';
    $p = array(0, date('Y-m-d', time()), 0);
    $sql = str_replace('%%milestone%%', MilestonePeer::TABLE_NAME, $sql);
    $sql = str_replace('%%project%%', ProjectPeer::TABLE_NAME, $sql);
    $statement = $connection->prepareStatement($sql);
    $resultset = $statement->executeQuery($p);
    while ($resultset->next()) {
        $row = $resultset->getRow();
        $milestoneList = MilestonePeer::getProjectMilestoneList($row['project_id']);
        $notificationId = util::addNotification(0, '项目已过期', '项目【' . $row['project_name'] . '】的【'.$milestoneList[$row['mid']].'】 已经过期！');
        $projectManagers = DBUtil::getProjectRole($row['project_id']);
        foreach ($projectManagers as $projectManager) {
            util::addNotificationRelation($notificationId, $projectManager->getSfGuardUserId());
        }
        $projectViceManagers = DBUtil::getProjectRole($row['project_id'], VP);
        foreach ($projectViceManagers as $projectManager) {
            util::addNotificationRelation($notificationId, $projectManager->getSfGuardUserId());
        }
    }
} catch (Exception $e) {
    SmsFunction::logMessage($e->getMessage());
}

function shutdown() {
    @unlink(PID_FILE);
}

function start() {
    $processNumber = getProcessNumber();
    echo "current processor number: {$processNumber} \n";
    if (file_exists(PID_FILE) && $processNumber > 1) {
        echo "\nCache builder is running...\n";
        echo "The pid file of cache builder is exist: " . PID_FILE, " ,if you can sure the builder is not running , please delete the pid file and try again.\n";
        die();
    } else {
        file_put_contents(PID_FILE, date("Y-m-d H:i:s"));
        register_shutdown_function("shutdown");
    }
}

function getProcessNumber() {
    $processName = basename(__FILE__);
    $cmd = "ps aux | grep '" . $processName . "'";
    if (!isset($_SERVER['argv'][1]) || empty($_SERVER['argv'][1])) {
        $_SERVER['argv'][1] = 'admin';
        $dbname = trim($_SERVER['argv'][1]);
    } else {
        $dbname = trim($_SERVER['argv'][1]);
        $cmd .= " | grep '" . $dbname . "'";
    }

    $cmd = $cmd . " | grep -v 'grep' | wc -l";
    echo $cmd, "\n";
    $processNumber = exec($cmd);
    $processNumber = intval($processNumber);
    return $processNumber;
}

