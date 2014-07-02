<?php

/**
 * @package lib\Push\GCM\Send
 */

/**
 * SingleGcmSend class: this is the subclass for GCM pushing service
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class IndividualGcmSend extends GcmSend
{
    /**
     * Sends a message to one device, retrying in case of unavailability.
     * 
     * @issue 2589
     * @return Result result of the request (see its javadoc for more details)
     */
    public function send() {
        $attempt = $tryAgain = 0;
        $result = null;
        do {
            $tryAgain ++;
            try {
                $result = $this->sendNoRetry();
                $tryAgain = $result == null && $attempt <= $this->getRetries();
                if ($tryAgain) {
                    $this->delayTime();
                }
            } catch (Exception $e) {
                throw $e;
            }
        }while ($tryAgain);

        if (is_null($result)) {
            throw new PushException(sprintf('Could not send message after %s attempts', $attempt));
        }        
        return $result;
    }

    /**
     * Sends a message without retrying in case of service unavailability.
     * 
     * @issue 2589
     * @return result of the post, or {@literal null} if the GCM service was unavailable.
     */
    public function sendNoRetry() {
        try {
            //Send a message 
            $response = $this->post();  
            //Sets results
            $lines = explode(PHP_EOL, $response);
            $responseParts = explode('=', $lines[0]);
            $token = $responseParts[0];
            $value = $responseParts[1];
            if (GcmConstants::$tokenMessageId == $token) {
                $this->getSingleResult()->setMessageId($value);
                //new registrationId
                if (isset($lines[1]) && $lines[1] != '') {
                    $responseParts = explode('=', $lines[1]);
                    $token = $responseParts[0];
                    $value = $responseParts[1];
                    if (GcmConstants::$tokenCanonicalRegId == $token) {
                        $this->getSingleResult()->setCanonicalRegistrationId($value);
                    }
                    return $this->getSingleResult();
                }
            } elseif (GcmConstants::$tokenError == $token) {
                $this->getSingleResult()->setErrorCode($value);
                return $this->getSingleResult();
            } else {
                throw new Exception(sprintf('Received invalid response from GCM: %s', $lines[0]));
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Post a message
     * 
     * @issue 2589
     * @return string response
     */
    public function post() {
        try {
            $body = $this->getMessager()->getIndividualPayload();
            $response = $this->postByCurl($this->useHeaders(), GcmConstants::$gcmSendEndpoint, $body);  
        } catch (Exception $e) {
            throw $e;
        }
        return $response;
    }
}
