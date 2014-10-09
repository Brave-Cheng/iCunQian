<?php

/**
 * @package batch\cronjobs
 */

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
define('SF_ROOT_DIR', realpath(dirname(dirname(__FILE__)) . '/..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG', false);

define('DEADLINE', "请注意，您购买的理财产品：%s 快要到期了，请及时处理。要实现您的财富连续增值吗？请看看我们的其他推荐吧。");
define("EXCEP", "不存在满足条件的理财产品！");

define('SYSTEM_TITLE', '系统消息');

$priv = array(
    'deadline',
    'send'
);

// set magic_quotes_runtime to off
ini_set('magic_quotes_runtime', 'Off');

require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

$startTime = date('Y-m-d H:i:s');

$argv = $_SERVER['argv'];

$jumpOut = isset($argv[1]) ? $argv[1] : false;

if ($jumpOut === false || !in_array($jumpOut, $priv)) {
    showHelp();
}

//set memory limit
set_time_limit(0);
ini_set ('memory_limit', '256M');  

//connection database
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

 
try {
    switch ($jumpOut) {
        case 'deadline':
            DepositPersonalProductsPeer::checkDeadlineProducts();
            break;
        case 'send':
                PushMessagesPeer::pushMessageDequeue();
            break;
    }

} catch (Exception $exc) {
    echo $exc->getMessage();
    die();
}


/**
 * show help
 * 
 * @issue 2662
 * 
 * @return void
 */
function showHelp() {
    echo " usage: php ExpirationReminder.php [reminder] 
    [reminder] - if the value is 'deadline', which regularly check the condition of financial products.
    [reminder] - if the valid is 'send', which equipment to meet the conditions of the push message." . PHP_EOL;
    die();
}
