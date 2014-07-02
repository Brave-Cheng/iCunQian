<?php


abstract class BaseSmsQueue extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $notification_id;


	
	protected $receiver;


	
	protected $unique_key;


	
	protected $message_content;


	
	protected $additional_information;


	
	protected $send_times = 0;


	
	protected $last_send_at;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aNotification;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNotificationId()
	{

		return $this->notification_id;
	}

	
	public function getReceiver()
	{

		return $this->receiver;
	}

	
	public function getUniqueKey()
	{

		return $this->unique_key;
	}

	
	public function getMessageContent()
	{

		return $this->message_content;
	}

	
	public function getAdditionalInformation()
	{

		return $this->additional_information;
	}

	
	public function getSendTimes()
	{

		return $this->send_times;
	}

	
	public function getLastSendAt($format = 'Y-m-d H:i:s')
	{

		if ($this->last_send_at === null || $this->last_send_at === '') {
			return null;
		} elseif (!is_int($this->last_send_at)) {
						$ts = strtotime($this->last_send_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_send_at] as date/time value: " . var_export($this->last_send_at, true));
			}
		} else {
			$ts = $this->last_send_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SmsQueuePeer::ID;
		}

	} 
	
	public function setNotificationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->notification_id !== $v) {
			$this->notification_id = $v;
			$this->modifiedColumns[] = SmsQueuePeer::NOTIFICATION_ID;
		}

		if ($this->aNotification !== null && $this->aNotification->getId() !== $v) {
			$this->aNotification = null;
		}

	} 
	
	public function setReceiver($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->receiver !== $v) {
			$this->receiver = $v;
			$this->modifiedColumns[] = SmsQueuePeer::RECEIVER;
		}

	} 
	
	public function setUniqueKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->unique_key !== $v) {
			$this->unique_key = $v;
			$this->modifiedColumns[] = SmsQueuePeer::UNIQUE_KEY;
		}

	} 
	
	public function setMessageContent($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message_content !== $v) {
			$this->message_content = $v;
			$this->modifiedColumns[] = SmsQueuePeer::MESSAGE_CONTENT;
		}

	} 
	
	public function setAdditionalInformation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->additional_information !== $v) {
			$this->additional_information = $v;
			$this->modifiedColumns[] = SmsQueuePeer::ADDITIONAL_INFORMATION;
		}

	} 
	
	public function setSendTimes($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->send_times !== $v || $v === 0) {
			$this->send_times = $v;
			$this->modifiedColumns[] = SmsQueuePeer::SEND_TIMES;
		}

	} 
	
	public function setLastSendAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_send_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_send_at !== $ts) {
			$this->last_send_at = $ts;
			$this->modifiedColumns[] = SmsQueuePeer::LAST_SEND_AT;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = SmsQueuePeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = SmsQueuePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->notification_id = $rs->getInt($startcol + 1);

			$this->receiver = $rs->getString($startcol + 2);

			$this->unique_key = $rs->getString($startcol + 3);

			$this->message_content = $rs->getString($startcol + 4);

			$this->additional_information = $rs->getString($startcol + 5);

			$this->send_times = $rs->getInt($startcol + 6);

			$this->last_send_at = $rs->getTimestamp($startcol + 7, null);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SmsQueue object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SmsQueuePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SmsQueuePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SmsQueuePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SmsQueuePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SmsQueuePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aNotification !== null) {
				if ($this->aNotification->isModified()) {
					$affectedRows += $this->aNotification->save($con);
				}
				$this->setNotification($this->aNotification);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SmsQueuePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SmsQueuePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aNotification !== null) {
				if (!$this->aNotification->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotification->getValidationFailures());
				}
			}


			if (($retval = SmsQueuePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SmsQueuePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNotificationId();
				break;
			case 2:
				return $this->getReceiver();
				break;
			case 3:
				return $this->getUniqueKey();
				break;
			case 4:
				return $this->getMessageContent();
				break;
			case 5:
				return $this->getAdditionalInformation();
				break;
			case 6:
				return $this->getSendTimes();
				break;
			case 7:
				return $this->getLastSendAt();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsQueuePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNotificationId(),
			$keys[2] => $this->getReceiver(),
			$keys[3] => $this->getUniqueKey(),
			$keys[4] => $this->getMessageContent(),
			$keys[5] => $this->getAdditionalInformation(),
			$keys[6] => $this->getSendTimes(),
			$keys[7] => $this->getLastSendAt(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SmsQueuePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNotificationId($value);
				break;
			case 2:
				$this->setReceiver($value);
				break;
			case 3:
				$this->setUniqueKey($value);
				break;
			case 4:
				$this->setMessageContent($value);
				break;
			case 5:
				$this->setAdditionalInformation($value);
				break;
			case 6:
				$this->setSendTimes($value);
				break;
			case 7:
				$this->setLastSendAt($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsQueuePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNotificationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setReceiver($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUniqueKey($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMessageContent($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAdditionalInformation($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSendTimes($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLastSendAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SmsQueuePeer::DATABASE_NAME);

		if ($this->isColumnModified(SmsQueuePeer::ID)) $criteria->add(SmsQueuePeer::ID, $this->id);
		if ($this->isColumnModified(SmsQueuePeer::NOTIFICATION_ID)) $criteria->add(SmsQueuePeer::NOTIFICATION_ID, $this->notification_id);
		if ($this->isColumnModified(SmsQueuePeer::RECEIVER)) $criteria->add(SmsQueuePeer::RECEIVER, $this->receiver);
		if ($this->isColumnModified(SmsQueuePeer::UNIQUE_KEY)) $criteria->add(SmsQueuePeer::UNIQUE_KEY, $this->unique_key);
		if ($this->isColumnModified(SmsQueuePeer::MESSAGE_CONTENT)) $criteria->add(SmsQueuePeer::MESSAGE_CONTENT, $this->message_content);
		if ($this->isColumnModified(SmsQueuePeer::ADDITIONAL_INFORMATION)) $criteria->add(SmsQueuePeer::ADDITIONAL_INFORMATION, $this->additional_information);
		if ($this->isColumnModified(SmsQueuePeer::SEND_TIMES)) $criteria->add(SmsQueuePeer::SEND_TIMES, $this->send_times);
		if ($this->isColumnModified(SmsQueuePeer::LAST_SEND_AT)) $criteria->add(SmsQueuePeer::LAST_SEND_AT, $this->last_send_at);
		if ($this->isColumnModified(SmsQueuePeer::CREATED_AT)) $criteria->add(SmsQueuePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SmsQueuePeer::UPDATED_AT)) $criteria->add(SmsQueuePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SmsQueuePeer::DATABASE_NAME);

		$criteria->add(SmsQueuePeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNotificationId($this->notification_id);

		$copyObj->setReceiver($this->receiver);

		$copyObj->setUniqueKey($this->unique_key);

		$copyObj->setMessageContent($this->message_content);

		$copyObj->setAdditionalInformation($this->additional_information);

		$copyObj->setSendTimes($this->send_times);

		$copyObj->setLastSendAt($this->last_send_at);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SmsQueuePeer();
		}
		return self::$peer;
	}

	
	public function setNotification($v)
	{


		if ($v === null) {
			$this->setNotificationId(NULL);
		} else {
			$this->setNotificationId($v->getId());
		}


		$this->aNotification = $v;
	}


	
	public function getNotification($con = null)
	{
		if ($this->aNotification === null && ($this->notification_id !== null)) {
						include_once 'lib/model/om/BaseNotificationPeer.php';

			$this->aNotification = NotificationPeer::retrieveByPK($this->notification_id, $con);

			
		}
		return $this->aNotification;
	}

} 