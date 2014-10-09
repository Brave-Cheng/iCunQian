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

require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

$startTime = date('Y-m-d H:i:s');

$argv = $_SERVER['argv'];

$type = isset($argv[1]) ? $argv[1] : false;
$parameters = isset($argv[2]) ? $argv[2] : false;

if ($type === false || $parameters === false) {
    showHelp();
}

//connection database
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();
 

try {

    if ($type != DepositStationNewsPeer::SEND_LETTER ) {
        throw new Exception("Error Processing Request: type");
    }

    $str = json_decode(base64_decode($parameters), true);

    if (!$str || empty($str['persons'])) {
        throw new Exception("Error Processing Request: parameters");
    }

    foreach ($str['persons'] as $accountId) {
        DepositMembersStationNewsPeer::addMemberStationNews($accountId, $str['stationNewsId']);
    }

} catch (Exception $exc) {

    $crawlConfig = Config::getInstance('CrawlConfig');
    $endTime = date('Y-m-d H:i:s');

    //send email
    $emailAddress = $crawlConfig->getMangingBankSenders();
    if ($emailAddress) {
        $cronMsg = $crawlConfig->getCronjobError();
        $body = sprintf($cronMsg['body'], $argv[0], $exc->getMessage(), $startTime, $endTime);
        $mail = Mailer::initialize();
        $mail->Subject = sprintf($cronMsg['subject'], $argv[0]);
        foreach ($emailAddress as $sender) {
            $mail->AddAddress($sender);
        }
        $mail->MsgHTML($body);
        $mail->send();
    }
    echo $exc->getMessage();
    die();
}

/**
 * show help
 * 
 * @issue 2568
 * @return void
 */
function showHelp() {
    echo " usage: php BatchQueue.php [type] [parameters]\n";
    die();
}