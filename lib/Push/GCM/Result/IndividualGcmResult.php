<?php

/**
 * @package lib\Push\GCM\Result
 */

/**
 * Result of a GCM message request that returned HTTP status code 200.
 *
 * <p>
 * If the message is successfully created, the {@link #getMessageId()} returns
 * the message id and {@link #getErrorCodeName()} returns {@literal null};
 * otherwise, {@link #getMessageId()} returns {@literal null} and
 * {@link #getErrorCodeName()} returns the code of the error.
 *
 * <p>
 * There are cases when a request is accept and the message successfully
 * created, but GCM has a canonical registration id for that device. In this
 * case, the server should update the registration id to avoid rejected requests
 * in the future.
 *
 * <p>
 * In a nutshell, the workflow to handle a result is:
 * <pre>
 *   - Call {@link #getMessageId()}:
 *     - {@literal null} means error, call {@link #getErrorCodeName()}
 *     - non-{@literal null} means the message was created:
 *       - Call {@link #getCanonicalRegistrationId()}
 *         - if it returns {@literal null}, do nothing.
 *         - otherwise, update the server datastore with the new id.
 * </pre>
 */

/**
 * SingleGcmResult class: this is the subclass for GCM pushing service result
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class IndividualGcmResult extends GcmResult
{
    /**
     * if the messageId is null, mean error. otherwise created messaged successfully
     */
    private $_messageId = null;

    /**
     * if the errorCode is null, mean message created successfully
     */
    protected $errorCode = null;

    /**
     * if the _canonicalRegistrationId is null, do nothing. otherwise update the server datastore with new 
     * registration id
     */
    protected $canonicalRegistrationId = null;

    /**
     * Sets the message id proterty
     * 
     * @param string $messageId message id proterty
     *
     * @issue 2589
     * @return null
     */
    public function setMessageId($messageId) {
        $this->_messageId = $messageId;
    }

    /**
     * Gets the message id proterty
     * 
     * @issue 2589
     * @return messageid
     */
    public function getMessageId() {
        return $this->_messageId;
    }

    /**
     * Sets the error code
     * 
     * @param string $errorCode error code
     *
     * @issue 2589
     * @return null
     */
    public function setErrorCode($errorCode) {
        $this->errorCode = $errorCode;
    }

    /**
     * Gets the error code
     *
     * @issue 2589
     * @return errorCode
     */
    public function getErrorCode() {
        return $this->errorCode;
    }

    /**
     * Sets the canonicalRegistrationId proterty
     * 
     * @param string $canonicalRegistrationId canonicalRegistrationId
     *
     * @issue 2589
     * @return null
     */
    public function setCanonicalRegistrationId($canonicalRegistrationId) {
        $this->canonicalRegistrationId = $canonicalRegistrationId;
    }

    /**
     * Gets the canonicalRegistrationId proterty
     *
     * @issue 2589
     * @return canonicalRegistrationId
     */
    public function getCanonicalRegistrationId() {
        return $this->canonicalRegistrationId;
    }
    
}
