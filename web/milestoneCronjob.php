<?php
header('Content-type:text/html;charset=utf-8');
define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG', false);
require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

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
echo '<script>alert("项目已过期的通知已经成功发送给项目经理！");</script>';




