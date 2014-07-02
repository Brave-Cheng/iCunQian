<?php

/**
 * @package lib\Push\Apns\Result
 */

/**
 * Parent class of result
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */

class ApnsResult extends Result
{
    protected $status = null;

    protected $feedback = null;

    /**
     * Sets APNs response 
     * 
     * @param string $status status
     * 
     * @issue 2589
     * @return null
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * Gets APNs response
     *
     * @issue 2589
     * @return string
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * Sets the feedback info
     * 
     * @param string $feedback feedback info
     *
     * @issue 2589
     * @return null
     */
    public function setFeedback($feedback) {
        $this->feedback = $feedback;
    }

    /**
     * Gets feedback
     *
     * @issue 2589
     * @return string
     */
    public function getFeedback() {
        return $this->feedback;
    }
}