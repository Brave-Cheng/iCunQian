<?php


abstract class BaseReadingHistory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $sf_guard_user_id;


	
	protected $news_id;


	
	protected $notification_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $asfGuardUser;

	
	protected $aNews;

	
	protected $aNotification;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getSfGuardUserId()
	{

		return $this->sf_guard_user_id;
	}

	
	public function getNewsId()
	{

		return $this->news_id;
	}

	
	public function getNotificationId()
	{

		return $this->notification_id;
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
			$this->modifiedColumns[] = ReadingHistoryPeer::ID;
		}

	} 
	
	public function setSfGuardUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sf_guard_user_id !== $v) {
			$this->sf_guard_user_id = $v;
			$this->modifiedColumns[] = ReadingHistoryPeer::SF_GUARD_USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

	} 
	
	public function setNewsId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->news_id !== $v) {
			$this->news_id = $v;
			$this->modifiedColumns[] = ReadingHistoryPeer::NEWS_ID;
		}

		if ($this->aNews !== null && $this->aNews->getId() !== $v) {
			$this->aNews = null;
		}

	} 
	
	public function setNotificationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->notification_id !== $v) {
			$this->notification_id = $v;
			$this->modifiedColumns[] = ReadingHistoryPeer::NOTIFICATION_ID;
		}

		if ($this->aNotification !== null && $this->aNotification->getId() !== $v) {
			$this->aNotification = null;
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
			$this->modifiedColumns[] = ReadingHistoryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ReadingHistoryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->sf_guard_user_id = $rs->getInt($startcol + 1);

			$this->news_id = $rs->getInt($startcol + 2);

			$this->notification_id = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ReadingHistory object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReadingHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ReadingHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ReadingHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ReadingHistoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReadingHistoryPeer::DATABASE_NAME);
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


												
			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->aNews !== null) {
				if ($this->aNews->isModified()) {
					$affectedRows += $this->aNews->save($con);
				}
				$this->setNews($this->aNews);
			}

			if ($this->aNotification !== null) {
				if ($this->aNotification->isModified()) {
					$affectedRows += $this->aNotification->save($con);
				}
				$this->setNotification($this->aNotification);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ReadingHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ReadingHistoryPeer::doUpdate($this, $con);
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


												
			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aNews !== null) {
				if (!$this->aNews->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNews->getValidationFailures());
				}
			}

			if ($this->aNotification !== null) {
				if (!$this->aNotification->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotification->getValidationFailures());
				}
			}


			if (($retval = ReadingHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReadingHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSfGuardUserId();
				break;
			case 2:
				return $this->getNewsId();
				break;
			case 3:
				return $this->getNotificationId();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ReadingHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSfGuardUserId(),
			$keys[2] => $this->getNewsId(),
			$keys[3] => $this->getNotificationId(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReadingHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSfGuardUserId($value);
				break;
			case 2:
				$this->setNewsId($value);
				break;
			case 3:
				$this->setNotificationId($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ReadingHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSfGuardUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNewsId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNotificationId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ReadingHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(ReadingHistoryPeer::ID)) $criteria->add(ReadingHistoryPeer::ID, $this->id);
		if ($this->isColumnModified(ReadingHistoryPeer::SF_GUARD_USER_ID)) $criteria->add(ReadingHistoryPeer::SF_GUARD_USER_ID, $this->sf_guard_user_id);
		if ($this->isColumnModified(ReadingHistoryPeer::NEWS_ID)) $criteria->add(ReadingHistoryPeer::NEWS_ID, $this->news_id);
		if ($this->isColumnModified(ReadingHistoryPeer::NOTIFICATION_ID)) $criteria->add(ReadingHistoryPeer::NOTIFICATION_ID, $this->notification_id);
		if ($this->isColumnModified(ReadingHistoryPeer::CREATED_AT)) $criteria->add(ReadingHistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ReadingHistoryPeer::UPDATED_AT)) $criteria->add(ReadingHistoryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ReadingHistoryPeer::DATABASE_NAME);

		$criteria->add(ReadingHistoryPeer::ID, $this->id);

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

		$copyObj->setSfGuardUserId($this->sf_guard_user_id);

		$copyObj->setNewsId($this->news_id);

		$copyObj->setNotificationId($this->notification_id);

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
			self::$peer = new ReadingHistoryPeer();
		}
		return self::$peer;
	}

	
	public function setsfGuardUser($v)
	{


		if ($v === null) {
			$this->setSfGuardUserId(NULL);
		} else {
			$this->setSfGuardUserId($v->getId());
		}


		$this->asfGuardUser = $v;
	}


	
	public function getsfGuardUser($con = null)
	{
		if ($this->asfGuardUser === null && ($this->sf_guard_user_id !== null)) {
						include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPeer.php';

			$this->asfGuardUser = sfGuardUserPeer::retrieveByPK($this->sf_guard_user_id, $con);

			
		}
		return $this->asfGuardUser;
	}

	
	public function setNews($v)
	{


		if ($v === null) {
			$this->setNewsId(NULL);
		} else {
			$this->setNewsId($v->getId());
		}


		$this->aNews = $v;
	}


	
	public function getNews($con = null)
	{
		if ($this->aNews === null && ($this->news_id !== null)) {
						include_once 'lib/model/om/BaseNewsPeer.php';

			$this->aNews = NewsPeer::retrieveByPK($this->news_id, $con);

			
		}
		return $this->aNews;
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