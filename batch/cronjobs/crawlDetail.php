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

define('SLEEP_MIN_TIME', 1);
define('SLEEP_MAX_TIME', 60);

require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

$startTime = date('Y-m-d H:i:s');

$argv = $_SERVER['argv'];

$type = isset($argv[1]) ? $argv[1] : false;
$tab = isset($argv[2]) ? $argv[2] : false;
$structuralProduct = isset($argv[3]) ? $argv[3] : false;

if ($type === false || !in_array($type, array('tencent', 'jnlc', 'test'))) {
    showHelp();
}

//connection database
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

//set memory limit
set_time_limit(0);

ini_set('memory_limit', '256M');  

$crawlConfig = Config::getInstance('CrawlConfig');
$jnlcStructurualProduct = $crawlConfig->getJnlcStructurualProduct();

try {
    switch ($type) {
        case 'tencent':
            $htmlParser = new simple_html_dom();
            $tencentCrawl = new Tencent($htmlParser);
            $tencentCrawl->initializeListPages();
            $htmlParser->clear();
            throw new Exception("tencent: crawling done");
            break;
        case 'jnlc':
            if (in_array($tab, array(Jnlc::PAGE_TAB_1, Jnlc::PAGE_TAB_2, Jnlc::PAGE_TAB_3))) {
                if (array_key_exists($structuralProduct, $jnlcStructurualProduct)) {
                    $jnlcCrwal = new Jnlc($tab, $jnlcStructurualProduct[$structuralProduct], SLEEP_MIN_TIME, SLEEP_MAX_TIME);
                    $jnlcCrwal->initializeListPages();
                } else {
                    showHelp();
                }
            } else {
                showHelp();
            }
            throw new Exception("Jnlc: crawling done");
            break;
        case 'test':
            throw new Exception("Testing flow done");
            break;
        default:
            showHelp();
            break;
    }

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
 * @issue 2568, 2729
 * 
 * @return void
 */
function showHelp() {
    echo " usage: php crawlDetail.php [type] [tab] [structural product type]
    type - jump out of the loop, it's value is number type.\n 
        'tencent' is for crawling http://stock.finance.qq.com/money/bank/cpdq.shtml.\n
        'jnlc'  is for crawling http://bankdata.jnlc.com/SitePages/ProductFilter.aspx \n
        'test' is for testing flow and show it.\n
    tab & structural product type - is for jnlc page tab.\n
    ";
    die();
}