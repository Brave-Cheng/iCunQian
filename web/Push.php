<?php

/**
 * @package web
 * push testing
 */

// define symfony constant
define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG', true);

// initialize symfony
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
header("Content-Type: text/html; charset=utf-8"); 

// remove all cache
// sfToolkit::clearDirectory(sfConfig::get('sf_cache_dir'));




// //sfTimer setup
// $reptileTimer = sfTimerManager::getTimer('Reptile');
// $timer = new sfTimer();

// //sleep for a while
// usleep(1000000);


// $reptileTimer->addTime();

// $elapsedTime = $timer->getElapsedTime();

// var_dump(sprintf('[%.2f ms] ',$elapsedTime));



echo ('Step 1, loading...' . PHP_EOL);

error_reporting(GcmConstants::$errorReporting);


/**
 * Multicast sets
 * Notes: 2014-6-12 testing not completed 
 */
// $gcmApiKey = 'AIzaSyDBWvq1ZxF71NhEti3AeRHgA1APeIw1Q5U';

// $payloadData = array('Text' => 'great match!');

// $collapseKey = 'this is a testting';

// $registrationIds = array('APA91bHCvx4tuDeGt8_VOqbEBXSB62eAe_tsurmYSOFYWdG6_cwR3jsYueQzTpquigG7W5EFNTiNpMTwZ8fKP5FtHURgfxd6dOWlmhnQ71QLAm8R3oZcBKx465BtfK8NUD1L_KDmgK2vW0y0ElN0W3yQDEGQUITQP9YpLIBgf6p8MS6XeoqTRwk');
// $messager = new GcmMessage($payloadData, $collapseKey, false, false, 24 * 3600);
// $messager->setDevices($registrationIds);

// try {
//     $multicast = new ServerGcmSend($gcmApiKey);
//     $multicast->setMessager($messager);
//     $result = $multicast->send();
//     var_dump($result);
// } catch (Exception $e) {
//     echo $e->errorMessage();
// }



/**
 * This is a testing case for APNs
 */
try {
    $environment = ApnsConstants::$environmentSandbox;
    
    $token = 'aaaa';
    $token = '9245cf268c58e62dfbbc033b50dc355757482d41405c576c80e54c368c635c09';
    // $token = '';
    // $alert = "Testing message";
    $alert = '1131212';
    $messager = new ApnsMessage();
    //Add alert
    $messager->setPushText($alert);
    //Add badge
    // $messager->setPushBadge(5);
    //Add sound
    // $messager->setPushSound('alarmsound.caf');
    //Add custom message
    // $messager->addCustomPropery('acme1', 'bar');

    $apns = new ServerApnsSend($environment);
    $apns->setMessager($messager);

    $apns->post(1, $token);

    var_dump($apns->getApnsResult()->getStatus(), $apns->getApnsResult()->getFeedback());
} catch (PushException $e) {
    echo $e->errorMessage();
}






