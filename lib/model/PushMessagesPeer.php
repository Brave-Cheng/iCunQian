<?php

/**
 * Subclass for performing query and update operations on the 'push_messages' table.
 *
 * 
 *
 * @package lib\model
 */ 
class PushMessagesPeer extends BasePushMessagesPeer
{

    const STATUE_QUEUED         = 'queued';
    const STATUS_DELIVERED      = 'delivered';
    const STATUS_FAILED         = 'failed';

    const TYPE_ACOUNT           = 'account';
    const TYPE_CLIENT           = 'client';


    /**
     * Get all pushed status
     *
     * @return array
     *
     * @issue  2599
     */
    public static function getPushedStatus() {
        $status = array(
            PushMessagesPeer::STATUE_QUEUED     => PushMessagesPeer::STATUE_QUEUED,
            PushMessagesPeer::STATUS_DELIVERED  => PushMessagesPeer::STATUS_DELIVERED,
            PushMessagesPeer::STATUS_FAILED     => PushMessagesPeer::STATUS_FAILED     
        );
    }

    /**
     * Pushed message enqueue
     *
     * @param string $message     pushed message
     * @param int    $subscribeId device subscribe id
     * @param string $type        type string
     *
     * @return array affected rows more than 0 is enqueue sucessfully 
     *
     * @issue 2599, 2662
     */
    public static function messageEnqueue($message, $subscribeId, $type = PushMessagesPeer::TYPE_CLIENT) {
        if (empty($message)) {
            throw new Exception('Send message can not be empty.');
        }
        if (empty($subscribeId)) {
            throw new Exception('Subscribe id can not be empty.');
        }
        // $message    = PushMessagesPeer::decodePushMessage($subscribeId, $message);
        $messager   = new PushMessages();
        $messager->setMessage($message);
        $messager->setPushDevicesId($subscribeId);
        $messager->setType($type);
        $messager->save();
        return array('message_id' => $messager->getId(), 'subscribe_id' => $subscribeId);
    }

    /**
     * Pushed message dequeue
     *
     * @param integer $subscribeId device subscribe id
     *
     * @return array
     *
     * @issue  2599
     */
    public static function messageDequeue($subscribeId = 0) {
        $criteria = PushMessagesPeer::filterMessages($subscribeId);
        return PushMessagesPeer::doSelect($criteria);
    }

    /**
     * Gets filter query message
     *
     * @param integer $subscribeId device subscribe id
     * @param string  $status      send status
     *
     * @return object 
     *
     * @issue 2599
     */
    public static function filterMessages($subscribeId = 0, $status = PushMessagesPeer::STATUE_QUEUED) {
        $criteria = new Criteria();
        if ($subscribeId) {
            $criteria->add(PushMessagesPeer::PUSH_DEVICES_ID, $subscribeId);
        }
        $criteria->add(PushMessagesPeer::STATUS, $status);
        return $criteria;
    }

    /**
     * Set pushed message feedback
     *
     * @param int    $messageId    push message parmary key
     * @param mixed  $delivery     send time
     * @param string $status       send status
     * @param string $errorMessage error message
     *
     * @return int affected rows
     * 
     * @issue 2599
     */
    public static function setPushedMessageFeedback($messageId, $delivery, $status, $errorMessage = '') {
        $messager = PushMessagesPeer::retrieveByPK($messageId);
        if (empty($messageId)) {
            throw new Exception(sprintf('the message %s is not exist.', $messageId));
        }
        $messager->setDelivery($delivery);
        $messager->setStatus($status);
        if ($errorMessage) {
            $messager->setErrorMessage($errorMessage);
        }
        return $messager->save();
    }


    /**
     * Push message
     *
     * @param int $device device info
     * @param int $pid    product id
     *
     * @return mixed
     *
     * @issue 2599
     */
    public static function pushMessage($device, $pid) {
        if (!($device->getId())) {
            throw new Exception("the subscribe id can not be empty.");
        }
        //message dequeue
        $messages = PushMessagesPeer::messageDequeue($device->getId());
        if (empty($messages)) {
            throw new Exception("There is no message to push.");
        }
        //select platform
        // $device = PushDevicesPeer::retrieveByPK($subscribeId);
        //send message
        foreach ($messages as $message) {
            try {
                if ($device->getDeviceModel() == PushDevicesPeer::DEVICE_MODEL_IOS) {
                    $result = util::pushApnsMessage($message->getId(), $device->getDeviceToken(), $message->getMessage(), $device->getDevelopment(), 1, 'default', array('acme1'=>$pid));
                    
                    if (is_null($result->getStatus()) && is_null($result->getFeedback())) {
                        PushMessagesPeer::setPushedMessageFeedback($message->getId(), time(), PushMessagesPeer::STATUS_DELIVERED);
                    }
                    if ($result->getStatus()) {
                        PushMessagesPeer::setPushedMessageFeedback($message->getId(), time(), PushMessagesPeer::STATUS_FAILED, $result->getStatus());
                        throw new PushException(sprintf(util::getMultiMessage('bacase %s'), $result->getStatus()));
                    }
                    if ($result->getFeedback()) {
                        PushDevicesPeer::setUnRegisterDevice($device->getDeviceToken());
                        throw new PushException(sprintf('Push feedback: %s', $result->getFeedback()));
                    }
                }
                if ($device->getDeviceModel() == PushDevicesPeer::DEVICE_MODEL_ANDRIOD) {
                    
                }
            } catch (Exception $e) {
                throw $e;
            }
        }
        
    }

    /**
     * Get decode pushed message
     *
     * @param int    $subscribeId subscribe id
     * @param string $message     message
     * @param int    $badge       apns badge
     * @param string $sound       apns sound
     * @param array  $custom      apns custom message
     *
     * @return string
     *
     * @issue 2599
     */
    public static function decodePushMessage($subscribeId, $message, $badge = 0, $sound = '', $custom = array()) {
        $device = PushDevicesPeer::retrieveByPK($subscribeId);
        switch ($device->getDeviceModel()) {
            case PushDevicesPeer::DEVICE_MODEL_IOS:
                $messager = new ApnsMessage();
                $messager->setPushText($message);
                //Add badge
                if ($badge) {
                    $messager->setPushBadge($badge);
                }
                //Add sound
                if ($sound) {
                    $messager->setPushSound($sound);
                }
                //Add custom message
                if ($custom) {
                    $messager->addCustomPropery($custom);
                }
                return $messager->getJsonPayload();
                break;
            case PushDevicesPeer::DEVICE_MODEL_ANDRIOD:
                //andriod message
                break;
        }
        
    }

}
