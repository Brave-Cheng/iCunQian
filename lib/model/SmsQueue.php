<?php

/**
 * Subclass for representing a row from the 'sms_queue' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SmsQueue extends BaseSmsQueue
{
    public function save($con = null) {
        $receiver = $this->getReceiver();
        $messageContent = $this->getMessageContent(); 
        $notificationId = $this->getNotificationId();    
        $keyContent = $receiver . $messageContent . $notificationId;
        $keyContent = preg_replace('/[\s]/is',"",$keyContent);
        $uniqueKey  = md5($keyContent);
        $this->setUniqueKey($uniqueKey);
        if(!$this->getId() && ($existingOne = $this->loadByUniqueKey($uniqueKey, false , $con ))) {
            throw new RecordExistingException("This message has been queued succeed at: " . $existingOne->getCreatedAt());
        }
        return parent::save($con);
    }
    
    public function loadByUniqueKey($key , $isSend = null , $con = null) {
        $cr = new Criteria();
        $cr->add(SmsQueuePeer::UNIQUE_KEY, $key);
        if($isSend !== null ){
            $isSend = intval($isSend) > 0 ? 1 : 0;
            $comparison = $isSend > 0 ? Criteria::GREATER_EQUAL : Criteria::EQUAL;
            $cr->add(SmsQueuePeer::SEND_TIMES, $isSend , $comparison);
        }
        $v = SmsQueuePeer::doSelect($cr , $con );
        return !empty($v) > 0 ? $v[0] : null;
    }
    
    public function getAdditionalInformation($key = null) {
        $string = parent::getAdditionalInformation();
        if(empty($string)) $string=serialize(array());

        $data = unserialize($string);
        if($key === null) {
            return $data;
        } else if(isset($data[$key])) {
            return $data[$key];
        }
        return null;
    }

    public function addAdditionalInformation ($key , $value=null) {
        $data = $this->getAdditionalInformation();
        $data[$key] = $value;
        parent::setAdditionalInformation(serialize($data));
        return $this;
    }

    public function unsetAdditionalInformation($key=null) {
        if($key === null) {
            parent::setAdditionalInformation(null);
        } else {
            $data = $this->getAdditionalInformation();
            if(isset($data[$key])){
                unset($data[$key]);
                parent::setAdditionalInformation(serialize($data));
            }
        }
        return $this;
    }
    
}
