<?php

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/../..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG', true);
require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

// require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'crawl' . DIRECTORY_SEPARATOR . 'config.php');



$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();


$filter = array(
       
                    'dfp.created_at' => "<= FROM_UNIXTIME(" .time(). ", '%Y-%m-%d %H:%i:%s') ",
                    'drf.status'     => 'IN(1,19)',
                    'db.is_valid'    => ' = 0',
                );

$listData = DepositFinancialProductsPeer::fetchFiltersList($filter, null, 1);
 
$listData = array('status'=>count($listData), 'products'=>$listData);
// $listData = $filter;
header('Content-Type: application/json');
header('Content-Encoding: gzip');

// $encode = json_encode(json_hpack($listData, 3));
$encode = json_encode($listData);

// $encode = gzencode($encode, 9);
header('Content-Length: ' . strlen($encode));

echo $encode;

