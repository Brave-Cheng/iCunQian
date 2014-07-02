<?php

/**
 * @package lib\Push\Log
 */

/**
 * A simple logger.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class PushLog implements LogInterface{

    /**
     * log path
     */
    public $logPath = null;

    /**
     * Logs a message
     * 
     * @param string $msg message
     * @issue 2589
     * @return boolean 
     */
    public function Log($msg) {
        printf("%s Push Server[%d]: %s" . PHP_EOL, date('r'), getmygid(), trim($msg));
        return true;
    }

}

