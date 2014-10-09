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

//connection database
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

$error = ApiOfflineQueuePeer::batchDequeue();

if ($error) {
    $message = implode(" <br /> ", $error);
} else {
    $message = 'Successful';
}

$endTime = date('Y-m-d H:i:s');
$crawlConfig = Config::getInstance('CrawlConfig');

//send email
// $emailAddress = $crawlConfig->getMangingBankSenders();
$emailAddress = '';
if ($emailAddress) {
    $cronMsg = $crawlConfig->getQueueMessage();
    $body = sprintf($cronMsg['body'], $argv[0], $message, $startTime, $endTime);
    $mail = Mailer::initialize();
    $mail->Subject = sprintf($cronMsg['subject'], $argv[0]);
    foreach ($emailAddress as $sender) {
        $mail->AddAddress($sender);
    }
    $mail->MsgHTML($body);
    $mail->send();
}
die('Complete');

