<?php

/**
 * @package lib\Push
 */

/**
 * A simple logger.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class PushLog implements LogInterface
{

    /**
     * log directory
     */
    private $_logDirectory = 'push';

    /**
     * log filename
     */
    private $_logFile = 'push.log';

    /**
     * Logs a message
     *
     * @param string $msg message
     * 
     * @issue 2589
     * @return boolean
     */
    public function log($msg) {
        return sprintf("%s Push Server[%d]: %s" . PHP_EOL, date('r'), getmypid(), trim($msg));
    }

    /**
     * Wirte a log 
     * 
     * @param string $msgs     message
     * @param string $filename filename
     *
     * @issue 2589
     * @return boolean
     */
    public function write($msgs, $filename = '') {
        $message = $this->log($msgs);
        if (sfConfig::get('sf_log_dir')) {
            $logDirectory = sfConfig::get('sf_log_dir') . DIRECTORY_SEPARATOR . $this->getLogDirectory();    
        } else {
            $basePath = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'log';
            $logDirectory = $basePath . DIRECTORY_SEPARATOR . $this->getLogDirectory();
        }
        //create directory
        if (!is_dir($logDirectory)) {
            @mkdir($logDirectory, 0777, true);
        }
        if ($filename) {
            $logFile = $logDirectory . DIRECTORY_SEPARATOR . $filename;
        } else {
            $logFile = $logDirectory . DIRECTORY_SEPARATOR . $this->getFilename();
        }
        $handle = fopen($logFile, 'a');
        fwrite($handle, "{$message}" . PHP_EOL);
        fclose($handle);
    }

    /**
     * Gets the log directory
     *
     * @issue 2589
     * @return string
     */
    public function getLogDirectory() {
        return $this->_logDirectory;
    } 

    /**
     * Gets the log filename
     * 
     * @issue 2589
     * @return string
     */
    public function getFilename() {
        return $this->_logFile;
    }



}

