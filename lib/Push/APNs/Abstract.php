<?php

/**
 * @package lib\Push
 */

/**
 * Abstract class: this is the superclass for all Push Notification Service
 * classes.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
abstract class PushAbstract {

    /**
     * Push Log
     */
    protected $logger = null;

    /**
     * Set the Logger instance to use for logging purpose.
     * 
     * @param PushLog $logger LogInterface instance
     * @issue 2589
     * @return null
     * @throws PushException
     */
    public function setLogger(PushLog $logger) {
        if (!is_object($logger)) {
            throw new PushException(sprintf("The Logger %s should be an instance of PushLog", $logger));
        }
        if (!($logger instanceof LogInterface)) {
            throw new PushException(sprintf("Unable to use an instance of %s as logger." . PHP_EOL . 'a logger must be implements LogInterface'));
        }
        $this->logger = $logger;
    }
    
    /**
     * Get the logger instace
     * 
     * @issue 2589
     * @return logger instance
     */
    public function getLogger() {
        return $this->logger;
    }

}
