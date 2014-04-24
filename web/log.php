<?php
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

$logDir = sfConfig::get('sf_log_dir');
$logDirName = $logDir . DIRECTORY_SEPARATOR . baseOaActions::$apiLogName;
//echo nl2br(file_get_contents($logDirName));exit;

$logHandle = fopen($logDirName, 'r');
fseek($logHandle, -10240, SEEK_END);

$display = false;
while (!feof($logHandle)) {
    $buffer = fgets($logHandle, 4096);
    if($display){
        echo $buffer."<br />";
    }
    if(!$display && substr($buffer, 0, 4) == '----'){
        $display = true;
    }
}
fclose($logHandle);
