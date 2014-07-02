<?php
class SmsFunction{
    /**
     * insertQueue -- insert Queue
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public static function insertQueue($params){
        try{
            $smsQueue = new SmsQueue();
            $smsQueue->setNotificationId(isset($params['id']) ? $params['id'] : 0);
            $smsQueue->setReceiver(isset($params['receiver']) ? $params['receiver'] : null);
            $smsQueue->setMessageContent(isset($params['content']) ? $params['content'] : null);
            $smsQueue->save();
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * logMessage -- wirte log when hava execption
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public static function logMessage($message){
       $logDir = sfConfig::get('sf_log_dir');
       $logFile = 'smsQueue.log';
       $handle = fopen($logDir . DIRECTORY_SEPARATOR . $logFile, "a");
       fwrite($handle, date("Y-m-d H:i:s").": $message\r\n");
       fclose($handle);
    }

}