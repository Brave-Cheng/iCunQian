<?php

/**
 * Api Log Methods
 *
 * @package api/lib
 * @author brave <brave.cheng@expacta.com.cn>
 */

class apiLog
{
    public static $logFlag = true;
    public static $logFile = 'api.log';
    public static $logDirectory = 'api';

    /**
     * get log directory
     * 
     * @return string
     *
     * @issue 2763
     */
    public static function getLogDirectory() {
        $sfLogDir = sfConfig::get('sf_log_dir');
        $apiLogDir = $sfLogDir . DIRECTORY_SEPARATOR . self::getApiLogDirectory();
        if (!is_dir($apiLogDir)) {
            @mkdir($apiLogDir, 0777, true);
        }
        return $apiLogDir;
    }
    
    /**
     * get api log directory
     * 
     * @return string
     *
     * @issue 2763
     */
    protected static function getApiLogDirectory() {
        return self::$logDirectory;
    }
    
    /**
     * get log filename
     * 
     * @return string
     *
     * @issue 2763
     */
    protected static function getLogFileName() {
        $loginInformation = sfContext::getInstance()->getUser()->getLoginInformation();
        if ($loginInformation) {
            $fileName = $loginInformation->getCode() . '_' . $loginInformation->getToken() . '.txt';
        } else {
            $fileName = self::$logFile;
        }
        return $fileName;
    }
    
    /**
     * write log message
     * 
     * @param string $message     content
     * @param mixed  $logFileName filename
     * 
     * @return mixed
     *
     * @issue 2763
     */
    public static function logMessage($message, $logFileName = null) {
        if (!self::$logFlag) {
            return;
        }
        $logDirectory = self::getLogDirectory();
        if (empty($logFileName)) {
            $logFileName = self::getLogFileName();
        }
        $handle = fopen($logDirectory . DIRECTORY_SEPARATOR . $logFileName, 'a');
        fwrite($handle, date('Y-m-d H:i:s') . ": {$message}\n");
        fclose($handle);
    }
}

?>
