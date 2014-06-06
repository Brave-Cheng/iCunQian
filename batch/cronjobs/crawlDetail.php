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
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG', true);

require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

$startTime = date('Y-m-d H:i:s');
$argv = $_SERVER['argv'];

$jumpOut = isset($argv[1]) ? intval($argv[1]) : false;

if ($jumpOut === false) {
    showHelp();
}

//connection database
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

//set memory limit
set_time_limit(0);
ini_set ('memory_limit', '256M');  
 
$crawlConfig = Config::getInstance('CrawlConfig');
try {
    //log file name
    Log::instance()->setFilename(CrawlConfig::ACTIVE_LOG_NAME);
    //html dom object
    $html = new simple_html_dom();
    $tencertCrawl = new Tencent($html, $crawlConfig->getTotalFilter());
    $tencertCrawl->isDebug = true;
    $tencertCrawl->sleepMinTime = 5;
    $tencertCrawl->sleepMaxTime = 15;
    //testting limit 
    if ($jumpOut !== 0){
        $tencertCrawl->jumpOutTest = $jumpOut;
    }
    $tencertCrawl ->request();
    $html->clear();
} catch (Exception $exc) {
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
 * @return null
 */
function showHelp() {
    echo " usage: php crawlDetail.php [jump_out] 
    jump_out - jump out of the loop, it's value is number type, 0 is not jump the loop,  other number said cycle to here. \n";
    die();
}