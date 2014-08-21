<?php


abstract class BaseDepositNotification extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $notification_type = 'sms';


	
	protected $notification_type_account = '';


	
	protected $content = '';


	
	protected $notification_status = 'queued';


	
	protected $delivered_time;


	
	protected $error_message = '';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getNotificationType()
	{

		return $this->notification_type;
	}

	
	public function getNotificationTypeAccount()
	{

		return $this->notification_type_account;
	}

	
	public function getContent()
	{

		return $this->content;
	}

	
	public function getNotificationStatus()
	{

		return $this->notification_status;
	}

	
	public function getDeliveredTime($format = 'Y-m-d H:i:s')
	{

		if ($this->delivered_time === null || $this->delivered_time === '') {
			return null;
		} elseif (!is_int($this->delivered_time)) {
						$ts = strtotime($this->delivered_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [delivered_time] as date/time value: " . var_export($this->delivered_time, true));
			}
		} else {
			$ts = $this->delivered_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getErrorMessage()
	{

		return $this->error_message;
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
			$this->modifiedColumns[] = DepositNotificationPeer::ID;
		}

	} 
	
	public function setNotificationType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->notification_type !== $v || $v === 'sms') {
			$this->notification_type = $v;
			$this->modifiedColumns[] = DepositNotificationPeer::NOTIFICATION_TYPE;
		}

	} 
	
	public function setNotificationTypeAccount($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->notification_type_account !== $v || $v === '') {
			$this->notification_type_account = $v;
			$this->modifiedColumns[] = DepositNotificationPeer::NOTIFICATION_TYPE_ACCOUNT;
		}

	} 
	
	public function setContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v || $v === '') {
			$this->content = $v;
			$this->modifiedColumns[] = DepositNotificationPeer::CONTENT;
		}

	} 
	
	public function setNotificationStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->notification_status !== $v || $v === 'queued') {
			$this->notification_status = $v;
			$this->modifiedColumns[] = DepositNotificationPeer::NOTIFICATION_STATUS;
		}

	} 
	
	public function setDeliveredTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [delivered_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->delivered_time !== $ts) {
			$this->delivered_time = $ts;
			$this->modifiedColumns[] = DepositNotificationPeer::DELIVERED_TIME;
		}

	} 
	
	public function setErrorMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->error_message !== $v || $v === '') {
			$this->error_message = $v;
			$this->modifiedColumns[] = DepositNotificationPeer::ERROR_MESSAGE;
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
			$this->modifiedColumns[] = DepositNotificationPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositNotificationPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->notification_type = $rs->getString($startcol + 1);

			$this->notification_type_account = $rs->getString($startcol + 2);

			$this->content = $rs->getString($startcol + 3);

			$this->notification_status = $rs->getString($startcol + 4);

			$this->delivered_time = $rs->getTimestamp($startcol + 5, null);

			$this->error_message = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositNotification object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositNotificationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositNotificationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositNotificationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositNotificationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositNotificationPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DepositNotificationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositNotificationPeer::doUpdate($this, $con);
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


			if (($retval = DepositNotificationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositNotificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNotificationType();
				break;
			case 2:
				return $this->getNotificationTypeAccount();
				break;
			case 3:
				return $this->getContent();
				break;
			case 4:
				return $this->getNotificationStatus();
				break;
			case 5:
				return $this->getDeliveredTime();
				break;
			case 6:
				return $this->getErrorMessage();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositNotificationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNotificationType(),
			$keys[2] => $this->getNotificationTypeAccount(),
			$keys[3] => $this->getContent(),
			$keys[4] => $this->getNotificationStatus(),
			$keys[5] => $this->getDeliveredTime(),
			$keys[6] => $this->getErrorMessage(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositNotificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNotificationType($value);
				break;
			case 2:
				$this->setNotificationTypeAccount($value);
				break;
			case 3:
				$this->setContent($value);
				break;
			case 4:
				$this->setNotificationStatus($value);
				break;
			case 5:
				$this->setDeliveredTime($value);
				break;
			case 6:
				$this->setErrorMessage($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositNotificationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNotificationType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNotificationTypeAccount($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContent($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNotificationStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeliveredTime($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setErrorMessage($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositNotificationPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositNotificationPeer::ID)) $criteria->add(DepositNotificationPeer::ID, $this->id);
		if ($this->isColumnModified(DepositNotificationPeer::NOTIFICATION_TYPE)) $criteria->add(DepositNotificationPeer::NOTIFICATION_TYPE, $this->notification_type);
		if ($this->isColumnModified(DepositNotificationPeer::NOTIFICATION_TYPE_ACCOUNT)) $criteria->add(DepositNotificationPeer::NOTIFICATION_TYPE_ACCOUNT, $this->notification_type_account);
		if ($this->isColumnModified(DepositNotificationPeer::CONTENT)) $criteria->add(DepositNotificationPeer::CONTENT, $this->content);
		if ($this->isColumnModified(DepositNotificationPeer::NOTIFICATION_STATUS)) $criteria->add(DepositNotificationPeer::NOTIFICATION_STATUS, $this->notification_status);
		if ($this->isColumnModified(DepositNotificationPeer::DELIVERED_TIME)) $criteria->add(DepositNotificationPeer::DELIVERED_TIME, $this->delivered_time);
		if ($this->isColumnModified(DepositNotificationPeer::ERROR_MESSAGE)) $criteria->add(DepositNotificationPeer::ERROR_MESSAGE, $this->error_message);
		if ($this->isColumnModified(DepositNotificationPeer::CREATED_AT)) $criteria->add(DepositNotificationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositNotificationPeer::UPDATED_AT)) $criteria->add(DepositNotificationPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositNotificationPeer::DATABASE_NAME);

		$criteria->add(DepositNotificationPeer::ID, $this->id);

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

		$copyObj->setNotificationType($this->notification_type);

		$copyObj->setNotificationTypeAccount($this->notification_type_account);

		$copyObj->setContent($this->content);

		$copyObj->setNotificationStatus($this->notification_status);

		$copyObj->setDeliveredTime($this->delivered_time);

		$copyObj->setErrorMessage($this->error_message);

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
			self::$peer = new DepositNotificationPeer();
		}
		return self::$peer;
	}

} 