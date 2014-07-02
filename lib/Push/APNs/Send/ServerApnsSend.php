<?php

/**
 * @package lib\Push\APNs\Send
 */

/**
 * ServerApnsSend class: this is the subclass for APNs pushing service
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */

class ServerApnsSend extends ApnsSend
{

    /**
     * Send a message 
     *
     * @param int   $index message  primary key
     * @param mixed $token token is for GCM /token is for APNs
     * 
     * @issue 2589
     * @return null
     */
    public function post($index, $token) {
        try {
            parent::post($index, $token);
            $this->connect();
            if (!$this->socket) {
                throw new PushException('Not connect to the Push Notification Service.');
            }
            $message = $this->_createBinaryNotification($index, $token);
            $this->_send($message);
            $this->disconnect();
        } catch (PushException $e) {
            throw $e;
        }
    }

    /**
     * Generate a binary notification from a device token and a JSON-encoded payload.
     *
     * @param int    $index  Message unique ID.
     * @param string $token  The device token.
     * @param int    $expiry Seconds, starting from now, that
     *                       identifies when the notification is no longer valid and can be discarded.
     *                       Pass a negative value (-1 for example) to request that APNs not store
     *                       the notification at all. Default is 86400 * 7, 7 days.
     *
     * @issue 2589
     * @return string A binary notification.              
     */
    private function _createBinaryNotification($index, $token, $expiry = 120) {
        // 2 minute validity hard coded!
        $expiry = $expiry > 0 ? time() + $expiry : 0;
        $msg = chr(ApnsConstants::$commandPush).pack("N",$index).pack("N",$expiry).pack("n",ApnsConstants::$deviceBinarySize).pack('H*',$token).pack("n",strlen($this->getMessager()->getJsonPayload())).$this->getMessager()->getJsonPayload();
        return $msg;
    }

    /**
     * Send a message 
     * 
     * @param string $string message
     *
     * @issue 2589
     * @return null
     */
    private function _send($string) {
        $length = fwrite($this->socket, $string);
        if ($length === false) {
            throw new PushException(sprintf('Failed writing to stream: %s', $this->socket));
        }
        $this->getLogger()->write(sprintf('INFO: Sucessfuly writting to stream %s and the Message is %s', $this->serviceUrl, $string));
        $this->_streamSelect();
    }

    /**
     *  Calls the send() function, Divide the unit
     *
     * @issue 2589
     * @return null
     */
    private function _streamSelect() {
        $read = array($this->socket);
        $null = null;
        // this is important for request many times
        $changeStreams = stream_select($read, $null, $null, 1, $null);

        if ($changeStreams === false) {
            $this->getLogger()->write('ERROR: Unable to wait for a steam availability.');
        } elseif ($changeStreams > 0) {
            $this->_getResponse();
        } else {
            $this->getLogger()->write(sprintf('INFO: steam select %s', $changeStreams));
            $this->connectFeedback();
        }
    }

    /**
     * Gets the response
     * 
     * @issue 2589
     * @return mixed
     */
    private function _getResponse() {
        $status = $command = ord(fread($this->socket, 1));
        $identifier = implode('', unpack('N', fread($this->socket, 4)));
        $this->getLogger()->write(sprintf('APNs responded with command(%s) status(%s) pid(%s)', $command, $status, $identifier));
        if ($status > 0) {
            $this->getLogger()->write(sprintf("APNs responded with error for (%s). status(%s: %s)", $identifier, $status, $this->getResponseStatus($status)));
            $this->getApnsResult()->setStatus($this->getResponseStatus($status));
        } else {
            $this->connectFeedback();
        }
    }
}