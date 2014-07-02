<?php

/**
 * @package lib\Push\GCM\Result
 */

/**
 * MultiGcmResult class: this is the subclass for GCM pushing service result
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class ServerGcmResult extends GcmResult
{
    private $_success;
    private $_failure;
    private $_multicastId;
    private $_canonicalIds;
    private $_retryMulticastIds;

    /**
     * Sets the canonicalIds property
     * 
     * @param string $canonicalIds canonicalIds
     *
     * @issue 2589
     * @return null
     */
    public function setCanonicalIds($canonicalIds) {
        $this->_canonicalIds = $canonicalIds;
    }

    /**
     * Gets the canonicalIds property
     *
     * @issue 2589
     * @return canonicalIds
     */
    public function getCanonicalIds() {
        return $this->_canonicalIds;
    }

    /**
     * Sets the multicast id.
     *
     * @param string $multicasdId multicasdId
     * 
     * @issue 2589
     * @return string
     */
    public function setMulticastId($multicasdId) {
        $this->_multicastId = $multicasdId;
    }

    /**
     * Gets the multicast id.
     *
     * @issue 2589
     * @return string
     */
    public function getMulticastId() {
        return $this->_multicastId;
    }

    /**
     * Sets the number of successful messages.
     *
     * @param int $success number
     * 
     * @issue 2589
     * @return int
     */
    public function setSuccess($success) {
        $this->_success = $success;
    }

    /**
     * Gets the number of successful messages.
     *
     * @issue 2589
     * @return int
     */
    public function getSuccess() {
        return $this->_success;
    }

    /**
     * Gets the total number of messages sent, regardless of the status.
     *
     * @issue 2589
     * @return int
     */
    public function getTotal() {
        return $this->_success + $this->_failure;
    }


    /**
     * Sets the number of failed messages.
     *
     * @param int $failure number
     * 
     * @issue 2589
     * @return int
     */
    public function setFailure($failure) {
        $this->_failure = $failure;
    }

    /**
     * Gets the number of failed messages.
     *
     * @issue 2589
     * @return int
     */
    public function getFailure() {
        return $this->_failure;
    }

    /**
     * Sets additional ids if more than one multicast message was sent.
     *
     * @param string $retryMulticastIds retryMulticastIds
     * 
     * @issue 2589
     * @return array
     */
    public function setRetryMulticastIds($retryMulticastIds) {
        $this->_retryMulticastIds = $retryMulticastIds;
    }

    /**
     * Gets additional ids if more than one multicast message was sent.
     *
     * @issue 2589
     * @return array
     */
    public function getRetryMulticastIds() {
        return $this->_retryMulticastIds;
    }




}
