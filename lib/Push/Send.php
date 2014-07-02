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
abstract class Send
{

    public $fiddlerDebugger = true;

    /**
     * Push Log
     */
    protected $logger = null;

    /**
     * Push Message
     */
    protected $messager = null;

    /**
     * Single result 
     */
    protected $individualGcmResult = null;
    
    /**
     * Multi result
     */
    protected $serverGcmResult = null;

    protected $apnsResult = null;

    /**
     * Send retry times
     */
    protected $retries = 10;


    /**
     * construct function
     *
     * @issue 2589
     * @return null
     */
    public function __construct() {
        $this->setApnsResult();
        $this->setLogger();
        $this->setIndividualGcmResult();
        $this->setServerGcmResult();
    }

    /**
     * abstract function 
     * 
     * @param int   $index          message  primary key
     * @param mixed $registrationId registrationId is for GCM /token is for APNs
     *
     * @issue 2589
     * @return null
     */
    abstract public function post($index, $registrationId);

    /**
     * Set the Logger instance to use for logging purpose.
     *
     * @issue 2589
     * @return null
     */
    public function setLogger() {
        if (!$this->logger) {
            $this->logger = new PushLog();
        }
        if (!is_object($this->logger)) {
            throw new PushException(sprintf("The Logger %s should be an instance of PushLog", $this->logger));
        }
        if (!($this->logger instanceof LogInterface)) {
            throw new PushException(sprintf("Unable to use an instance of %s as logger." . PHP_EOL . 'a logger must be implements LogInterface', $this->logger));
        }
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

    /**
     * Set the messager instance to use for payload.
     *
     * @param obejct $messager Message instance
     *
     * @issue 2589
     * @return null
     */
    public function setMessager(Message $messager) {
        if (!is_object($messager)) {
            throw new PushException(sprintf("The messager %s should be an instance of Message", $messager));
        }
        if (!($messager instanceof Message)) {
            throw new PushException(sprintf("Unable to use an instance of %s as messager" . PHP_EOL . ' a messager must be extend Message', $messager));
        }
        $this->messager = $messager;
    }

    /**
     * Gets the messager intanse
     *
     * @issue 2589
     * @return messager instance
     */
    public function getMessager() {
        return $this->messager;
    }

    /**
     * Sets Single Result
     * 
     * @issue 2589
     * @return null
     */
    public function setServerGcmResult() {
        if (!$this->serverGcmResult) {
            $this->serverGcmResult = new ServerGcmResult();
        }
        if (!is_object($this->serverGcmResult)) {
            throw new PushException(sprintf("The ServerGcmResult %s should be an instance of ServerGcmResult", $this->serverGcmResult));
        }
    }

    /**
     * Gets Single Result
     * 
     * @issue 2589
     * @return multi result instance
     */

    public function getServerGcmResult() {
        return $this->serverGcmResult;
    }

    /**
     * Sets Single Result
     * 
     * @issue 2589
     * @return null
     */
    public function setIndividualGcmResult() {
        if (!$this->individualGcmResult) {
            $this->individualGcmResult = new IndividualGcmResult();
        }
        if (!is_object($this->individualGcmResult)) {
            throw new PushException(sprintf("The individualGcmResult %s should be an instance of individualGcmResult", $this->individualGcmResult));
        }
    }

    /**
     * Gets individualGcmResult result
     * 
     * @issue 2589
     * @return individualGcmResult instance
     */

    public function getIndividualGcmResult() {
        return $this->individualGcmResult;
    }

    /**
     * Sets the sender retry time
     * 
     * @param int $retries retry time
     *
     * @issue 2589
     * @return null
     */
    public function setRetries($retries) {
        $this->retries = (int)$retries;
    } 

    /**
     * Gets the sender retry time
     * 
     * @issue 2589
     * @return int
     */
    public function getRetries() {
        return $this->retries;
    }

    /**
     * Sets the Apns Result(feedback)
     *
     * @issue 2589
     * @return null
     */
    public function setApnsResult() {
        if (!$this->apnsResult) {
            $this->apnsResult = new ApnsResult();
        }
    }

    /**
     * Get the apns result instance
     *
     * @issue 2589
     * @return apnsresult instance
     */
    public function getApnsResult() {
        return $this->apnsResult;
    }
}
