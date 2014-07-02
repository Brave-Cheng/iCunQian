<?php


abstract class BaseNotification extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $sf_guard_user_id;


	
	protected $title;


	
	protected $content;


	
	protected $unique_key;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $asfGuardUser;

	
	protected $collNotificationRecivers;

	
	protected $lastNotificationReciverCriteria = null;

	
	protected $collSmsQueues;

	
	protected $lastSmsQueueCriteria = null;

	
	protected $collReadingHistorys;

	
	protected $lastReadingHistoryCriteria = null;

	
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

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getContent()
	{

		return $this->content;
	}

	
	public function getUniqueKey()
	{

		return $this->unique_key;
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
			$this->modifiedColumns[] = NotificationPeer::ID;
		}

	} 
	
	public function setSfGuardUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sf_guard_user_id !== $v) {
			$this->sf_guard_user_id = $v;
			$this->modifiedColumns[] = NotificationPeer::SF_GUARD_USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = NotificationPeer::TITLE;
		}

	} 
	
	public function setContent($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = NotificationPeer::CONTENT;
		}

	} 
	
	public function setUniqueKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->unique_key !== $v) {
			$this->unique_key = $v;
			$this->modifiedColumns[] = NotificationPeer::UNIQUE_KEY;
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
			$this->modifiedColumns[] = NotificationPeer::CREATED_AT;
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
			$this->modifiedColumns[] = NotificationPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->sf_guard_user_id = $rs->getInt($startcol + 1);

			$this->title = $rs->getString($startcol + 2);

			$this->content = $rs->getString($startcol + 3);

			$this->unique_key = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Notification object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotificationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			NotificationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(NotificationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(NotificationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotificationPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NotificationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += NotificationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collNotificationRecivers !== null) {
				foreach($this->collNotificationRecivers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSmsQueues !== null) {
				foreach($this->collSmsQueues as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collReadingHistorys !== null) {
				foreach($this->collReadingHistorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = NotificationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNotificationRecivers !== null) {
					foreach($this->collNotificationRecivers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSmsQueues !== null) {
					foreach($this->collSmsQueues as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collReadingHistorys !== null) {
					foreach($this->collReadingHistorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTitle();
				break;
			case 3:
				return $this->getContent();
				break;
			case 4:
				return $this->getUniqueKey();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotificationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSfGuardUserId(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getContent(),
			$keys[4] => $this->getUniqueKey(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTitle($value);
				break;
			case 3:
				$this->setContent($value);
				break;
			case 4:
				$this->setUniqueKey($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotificationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSfGuardUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContent($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUniqueKey($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NotificationPeer::DATABASE_NAME);

		if ($this->isColumnModified(NotificationPeer::ID)) $criteria->add(NotificationPeer::ID, $this->id);
		if ($this->isColumnModified(NotificationPeer::SF_GUARD_USER_ID)) $criteria->add(NotificationPeer::SF_GUARD_USER_ID, $this->sf_guard_user_id);
		if ($this->isColumnModified(NotificationPeer::TITLE)) $criteria->add(NotificationPeer::TITLE, $this->title);
		if ($this->isColumnModified(NotificationPeer::CONTENT)) $criteria->add(NotificationPeer::CONTENT, $this->content);
		if ($this->isColumnModified(NotificationPeer::UNIQUE_KEY)) $criteria->add(NotificationPeer::UNIQUE_KEY, $this->unique_key);
		if ($this->isColumnModified(NotificationPeer::CREATED_AT)) $criteria->add(NotificationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(NotificationPeer::UPDATED_AT)) $criteria->add(NotificationPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NotificationPeer::DATABASE_NAME);

		$criteria->add(NotificationPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setContent($this->content);

		$copyObj->setUniqueKey($this->unique_key);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getNotificationRecivers() as $relObj) {
				$copyObj->addNotificationReciver($relObj->copy($deepCopy));
			}

			foreach($this->getSmsQueues() as $relObj) {
				$copyObj->addSmsQueue($relObj->copy($deepCopy));
			}

			foreach($this->getReadingHistorys() as $relObj) {
				$copyObj->addReadingHistory($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new NotificationPeer();
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

	
	public function initNotificationRecivers()
	{
		if ($this->collNotificationRecivers === null) {
			$this->collNotificationRecivers = array();
		}
	}

	
	public function getNotificationRecivers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificationReciverPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificationRecivers === null) {
			if ($this->isNew()) {
			   $this->collNotificationRecivers = array();
			} else {

				$criteria->add(NotificationReciverPeer::NOTIFICATION_ID, $this->getId());

				NotificationReciverPeer::addSelectColumns($criteria);
				$this->collNotificationRecivers = NotificationReciverPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificationReciverPeer::NOTIFICATION_ID, $this->getId());

				NotificationReciverPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificationReciverCriteria) || !$this->lastNotificationReciverCriteria->equals($criteria)) {
					$this->collNotificationRecivers = NotificationReciverPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificationReciverCriteria = $criteria;
		return $this->collNotificationRecivers;
	}

	
	public function countNotificationRecivers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotificationReciverPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotificationReciverPeer::NOTIFICATION_ID, $this->getId());

		return NotificationReciverPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotificationReciver(NotificationReciver $l)
	{
		$this->collNotificationRecivers[] = $l;
		$l->setNotification($this);
	}


	
	public function getNotificationReciversJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificationReciverPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificationRecivers === null) {
			if ($this->isNew()) {
				$this->collNotificationRecivers = array();
			} else {

				$criteria->add(NotificationReciverPeer::NOTIFICATION_ID, $this->getId());

				$this->collNotificationRecivers = NotificationReciverPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(NotificationReciverPeer::NOTIFICATION_ID, $this->getId());

			if (!isset($this->lastNotificationReciverCriteria) || !$this->lastNotificationReciverCriteria->equals($criteria)) {
				$this->collNotificationRecivers = NotificationReciverPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastNotificationReciverCriteria = $criteria;

		return $this->collNotificationRecivers;
	}

	
	public function initSmsQueues()
	{
		if ($this->collSmsQueues === null) {
			$this->collSmsQueues = array();
		}
	}

	
	public function getSmsQueues($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSmsQueuePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSmsQueues === null) {
			if ($this->isNew()) {
			   $this->collSmsQueues = array();
			} else {

				$criteria->add(SmsQueuePeer::NOTIFICATION_ID, $this->getId());

				SmsQueuePeer::addSelectColumns($criteria);
				$this->collSmsQueues = SmsQueuePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SmsQueuePeer::NOTIFICATION_ID, $this->getId());

				SmsQueuePeer::addSelectColumns($criteria);
				if (!isset($this->lastSmsQueueCriteria) || !$this->lastSmsQueueCriteria->equals($criteria)) {
					$this->collSmsQueues = SmsQueuePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSmsQueueCriteria = $criteria;
		return $this->collSmsQueues;
	}

	
	public function countSmsQueues($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSmsQueuePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SmsQueuePeer::NOTIFICATION_ID, $this->getId());

		return SmsQueuePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSmsQueue(SmsQueue $l)
	{
		$this->collSmsQueues[] = $l;
		$l->setNotification($this);
	}

	
	public function initReadingHistorys()
	{
		if ($this->collReadingHistorys === null) {
			$this->collReadingHistorys = array();
		}
	}

	
	public function getReadingHistorys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseReadingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReadingHistorys === null) {
			if ($this->isNew()) {
			   $this->collReadingHistorys = array();
			} else {

				$criteria->add(ReadingHistoryPeer::NOTIFICATION_ID, $this->getId());

				ReadingHistoryPeer::addSelectColumns($criteria);
				$this->collReadingHistorys = ReadingHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReadingHistoryPeer::NOTIFICATION_ID, $this->getId());

				ReadingHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastReadingHistoryCriteria) || !$this->lastReadingHistoryCriteria->equals($criteria)) {
					$this->collReadingHistorys = ReadingHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastReadingHistoryCriteria = $criteria;
		return $this->collReadingHistorys;
	}

	
	public function countReadingHistorys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseReadingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ReadingHistoryPeer::NOTIFICATION_ID, $this->getId());

		return ReadingHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addReadingHistory(ReadingHistory $l)
	{
		$this->collReadingHistorys[] = $l;
		$l->setNotification($this);
	}


	
	public function getReadingHistorysJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseReadingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReadingHistorys === null) {
			if ($this->isNew()) {
				$this->collReadingHistorys = array();
			} else {

				$criteria->add(ReadingHistoryPeer::NOTIFICATION_ID, $this->getId());

				$this->collReadingHistorys = ReadingHistoryPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ReadingHistoryPeer::NOTIFICATION_ID, $this->getId());

			if (!isset($this->lastReadingHistoryCriteria) || !$this->lastReadingHistoryCriteria->equals($criteria)) {
				$this->collReadingHistorys = ReadingHistoryPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastReadingHistoryCriteria = $criteria;

		return $this->collReadingHistorys;
	}


	
	public function getReadingHistorysJoinNews($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseReadingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReadingHistorys === null) {
			if ($this->isNew()) {
				$this->collReadingHistorys = array();
			} else {

				$criteria->add(ReadingHistoryPeer::NOTIFICATION_ID, $this->getId());

				$this->collReadingHistorys = ReadingHistoryPeer::doSelectJoinNews($criteria, $con);
			}
		} else {
									
			$criteria->add(ReadingHistoryPeer::NOTIFICATION_ID, $this->getId());

			if (!isset($this->lastReadingHistoryCriteria) || !$this->lastReadingHistoryCriteria->equals($criteria)) {
				$this->collReadingHistorys = ReadingHistoryPeer::doSelectJoinNews($criteria, $con);
			}
		}
		$this->lastReadingHistoryCriteria = $criteria;

		return $this->collReadingHistorys;
	}

} 