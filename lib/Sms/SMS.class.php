<?php

/**
 * @package lib\Sms
 */

/**
 * @author jmao<john.mao@expacta.com.cn>
 */
abstract class SMS
{
    public static $logDirectory = 'sms';
    //log file name
    public static $logFile = 'sms.log';

    /**
     * Send abstract
     *
     * @param array  $receivers receivers
     * @param string $message   message
     *
     * @return void
     *
     * @issue 2626
     */
    abstract public function send($receivers = array(), $message = '');
    
    /**
     * setLogDirectory
     * 
     * @param string $logDirectory directory
     * 
     * @author john.mao <john.mao@expacta.com.cn>
     *
     * @return void
     *
     * @issue 2626
     */
    public function setLogDirectory($logDirectory = ''){
        if( !is_string($logDirectory) ){
            $logDirectory = (string) $logDirectory;
        }
        self::$logDirectory = $logDirectory;
    }

    /**
     * logMessage
     * 
     * @param string $message message
     * 
     * @return void
     * 
     * @author john.mao <john.mao@expacta.com.cn>
     * 
     * @issue 2626
     */
    protected static function logMessage($message) {
        if(file_exists(self::$logDirectory)){
            $logFile = self::$logDirectory . DIRECTORY_SEPARATOR . self::$logFile;
        }else{
            $logFile = '.' . DIRECTORY_SEPARATOR . self::$logFile;
        }
        $handle = fopen($logFile, "a");
        fwrite($handle, date("Y-m-d H:i:s") . ": $message" . PHP_EOL);
        fclose($handle);
    }
}
