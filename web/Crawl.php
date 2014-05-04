<?php

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG', true);
require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

//log filename
define('ACTIVE_LOG_NAME', 'Crawl_Active_Log');
define("PAGING_DATA_SETS", 'Paging_Data_Sets');

//log directory
define('PAGE_LIST_LOG_DIR', 'page_list_log_dir');
define('PAGE_DETAIL_LOG_DIR', 'page_detail_log_dir');

//tencet crawl address
define('TENCERT_PAGE_LIST_URL', 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=sxq_search_products');
define('TENCERT_PAGE_DETAIL_URL', 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=show_detail');

define('SPCIAL_CHARACTER', '发行日');
define('SALE_START_DATE', '销售起始日');
define('SALE_END_DATE', '销售截止日');
define('SPCIAL_CHARACTER_REGION', '发行地区');

$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

set_time_limit(0);

try {
    //log file name
    Log::instance()->setFilepath(sfConfig::get('sf_log_dir') . DIRECTORY_SEPARATOR .  PAGE_LIST_LOG_DIR . DIRECTORY_SEPARATOR . date('YmdH'));
    Log::instance()->setFilename(ACTIVE_LOG_NAME);
    //html dom object
    $html = new simple_html_dom();
    $tencertCrawl = new Tencent($html);
    $tencertCrawl->isDebug = false;
    $tencertCrawl->sleepMinTime = 1;
    $tencertCrawl->sleepMaxTime = 6;
    $tencertCrawl->dbConnect = true;
    header('Content-Type:text/html; charset=utf-8');
    var_dump($tencertCrawl ->request());
} catch (Exception $exc) {
//    echo $exc->getMessage() . '\n';
}





