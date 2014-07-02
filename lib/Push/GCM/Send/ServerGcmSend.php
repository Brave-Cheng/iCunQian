<?php

/**
 * @package lib\Push\GCM\Send
 */

/**
 * MultiGcmSend class: this is the subclass for GCM pushing service
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class ServerGcmSend extends GcmSend
{


    /**
     * Sends a message to many devices, retrying in case of unavailability.
     *
     * @issue 2589
     * @return MulticastResult combined result of all requests made.
     */
    public function send() {
        $registrationIds = $this->getMessager()->getDevices();
        $attempt = 0;
        $multicastResult = null;
        $unsentRegIds = $registrationIds;
        $multicastIds = $result = array();
        do{
            $attempt++;
            $multicastResult = $this->sendNoRetryMulti($unsentRegIds);
            $multicastId = $multicastResult ->getMulticastId();
            $multicastIds[] = $multicastId;
            $unsentRegIds = $this->updateStatus($unsentRegIds, $results, $multicastResult);
            $results = $unsentRegIds[1];
            $tryAgain = count($unsentRegIds[0]) > 0 && $attempt <= $this->getRetries();
            if ($tryAgain) {
                $this->delayTime();
            }
        }while ($tryAgain);
        $success = $failure = $canonicalIds = 0;
        foreach($results as $result) {
            if(!is_null($result->getMessageId())) {
                $success++;
                if(!is_null($result->getCanonicalRegistrationId()))
                    $canonicalIds++;
            } else {
                $failure++;
            }
        }
        $multicastId = $multicastIds[0];
        $this->getMultiResult()->setSuccess($success);
        $this->getMultiResult()->setFailure($failure);
        $this->getMultiResult()->setCanonicalIds($canonicalIds);
        $this->getMultiResult()->setMulticastId($multicastId);
        $this->getMultiResult()->setRetryMulticastIds($multicastIds);

        foreach ($registrationIds as $registrationId) {
            $this->getMultiResult()->add($results[$registrationId]);
        }
        return $this->getMultiResult();
    }


    /**
     * Sends a message without retrying in case of service unavailability.
     * 
     * @issue 2589
     * @return result of the post, or {@literal null} if the GCM service was unavailable.
     */
    public function sendNoRetryMulti() {
        try {
            $response = $this->postMessage();
            $response = json_decode($response, true);
            $success = $response[GcmConstants::$jsonSuccess];
            $failure = $response[GcmConstants::$jsonFailure];
            $canonicalIds = $response[GcmConstants::$jsonCanonicalIds];
            $multicastId = $response[GcmConstants::$jsonMulticastId];

            $this->getMultiResult()->setSuccess($success);
            $this->getMultiResult()->setFailure($failure);
            $this->getMultiResult()->setCanonicalIds($canonicalIds);
            $this->getMultiResult()->setMulticastId($multicastId);

            if (isset($response[GcmConstants::$jsonResults])) {
                $individualResults = $response[Constants::$jsonResults];
                foreach ($individualResults as $singleResult) {
                    $messageId = isset($singleResult[GcmConstants::$jsonMessageId]) ? $singleResult[GcmConstants::$jsonMessageId] : null;
                    $canonicalRegistrationId = isset($singleResult[GcmConstants::$tokenCanonicalRegId]) ? $singleResult[GcmConstants::$tokenCanonicalRegId] : null;
                    $error = isset($singleResult[GcmConstants::$jsonError]) ? $singleResult[GcmConstants::$jsonError] : null;
                    $this->getSingleResult()->setMessageId($message);
                    $this->getSingleResult()->setCanonicalRegistrationId($canonicalRegistrationId);
                    $this->getSingleResult()->setErrorCode($error);
                    $this->getMultiResult()->add($this->getSingleResult());
                }
            }
            return $this->getMultiResult();
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
    public function postMessage() {
        try {
            $request = $this->getMessager()->getMulticastPayload();
            $response = $this->postByCurl($this->useHeaders(), GcmConstants::$gcmSendEndpoint, $request);  
        } catch (Exception $e) {
            throw $e;
        }
        return $response;
    }

    /**
     * Updates the status of the messages sent to devices and the list of devices
     * that should be retried.
     * 
     * @param array  $unsentRegIds list of devices that are still pending an update.
     * @param array  $allResults   map  of status that will be updated.
     * @param object $multiResult  result of the last multicast sent.
     *
     * @issue 2589
     * @return array updated version of devices that should be retried.
     */
    public function updateStatus($unsentRegIds, $allResults, $multiResult) {
        $results = $multiResult->getResults(); 
        if (count($results) != count($unsentRegIds)) {
            throw new PushException(sprintf('Internal error: sizes do not match. currentResults: %s; unsentRegIds: %s', implode(',', $results), implode(',', $unsentRegIds)));
        }  
        $newUnsentRegIds = array();
        $count = count($unsentRegIds);
        for ($i = 0; $i < $count; $i++) { 
            $regId = $unsentRegIds[$i];
            $result = $results[$i];
            $allResults[$regId] = $result;
            $error = $result->getErrorCode();

            if(!is_null($error) && $error == GcmConstants::$errorUnavailable) {
                $newUnsentRegIds[] = $regId;
            }
        }
        return array($newUnsentRegIds, $allResults);
    }

    
}
