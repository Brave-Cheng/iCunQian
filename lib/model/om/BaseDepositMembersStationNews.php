<?php


abstract class BaseDepositMembersStationNews extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $deposit_station_news_id;


	
	protected $deposit_members_id;


	
	protected $status = '0';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDepositStationNews;

	
	protected $aDepositMembers;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDepositStationNewsId()
	{

		return $this->deposit_station_news_id;
	}

	
	public function getDepositMembersId()
	{

		return $this->deposit_members_id;
	}

	
	public function getStatus()
	{

		return $this->status;
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
			$this->modifiedColumns[] = DepositMembersStationNewsPeer::ID;
		}

	} 
	
	public function setDepositStationNewsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_station_news_id !== $v) {
			$this->deposit_station_news_id = $v;
			$this->modifiedColumns[] = DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID;
		}

		if ($this->aDepositStationNews !== null && $this->aDepositStationNews->getId() !== $v) {
			$this->aDepositStationNews = null;
		}

	} 
	
	public function setDepositMembersId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_members_id !== $v) {
			$this->deposit_members_id = $v;
			$this->modifiedColumns[] = DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID;
		}

		if ($this->aDepositMembers !== null && $this->aDepositMembers->getId() !== $v) {
			$this->aDepositMembers = null;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status !== $v || $v === '0') {
			$this->status = $v;
			$this->modifiedColumns[] = DepositMembersStationNewsPeer::STATUS;
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
			$this->modifiedColumns[] = DepositMembersStationNewsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositMembersStationNewsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->deposit_station_news_id = $rs->getInt($startcol + 1);

			$this->deposit_members_id = $rs->getInt($startcol + 2);

			$this->status = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositMembersStationNews object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersStationNewsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositMembersStationNewsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositMembersStationNewsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositMembersStationNewsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersStationNewsPeer::DATABASE_NAME);
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


												
			if ($this->aDepositStationNews !== null) {
				if ($this->aDepositStationNews->isModified()) {
					$affectedRows += $this->aDepositStationNews->save($con);
				}
				$this->setDepositStationNews($this->aDepositStationNews);
			}

			if ($this->aDepositMembers !== null) {
				if ($this->aDepositMembers->isModified()) {
					$affectedRows += $this->aDepositMembers->save($con);
				}
				$this->setDepositMembers($this->aDepositMembers);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DepositMembersStationNewsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositMembersStationNewsPeer::doUpdate($this, $con);
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


												
			if ($this->aDepositStationNews !== null) {
				if (!$this->aDepositStationNews->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositStationNews->getValidationFailures());
				}
			}

			if ($this->aDepositMembers !== null) {
				if (!$this->aDepositMembers->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositMembers->getValidationFailures());
				}
			}


			if (($retval = DepositMembersStationNewsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersStationNewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDepositStationNewsId();
				break;
			case 2:
				return $this->getDepositMembersId();
				break;
			case 3:
				return $this->getStatus();
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
		$keys = DepositMembersStationNewsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDepositStationNewsId(),
			$keys[2] => $this->getDepositMembersId(),
			$keys[3] => $this->getStatus(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersStationNewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDepositStationNewsId($value);
				break;
			case 2:
				$this->setDepositMembersId($value);
				break;
			case 3:
				$this->setStatus($value);
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
		$keys = DepositMembersStationNewsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDepositStationNewsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDepositMembersId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositMembersStationNewsPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositMembersStationNewsPeer::ID)) $criteria->add(DepositMembersStationNewsPeer::ID, $this->id);
		if ($this->isColumnModified(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID)) $criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $this->deposit_station_news_id);
		if ($this->isColumnModified(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID)) $criteria->add(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);
		if ($this->isColumnModified(DepositMembersStationNewsPeer::STATUS)) $criteria->add(DepositMembersStationNewsPeer::STATUS, $this->status);
		if ($this->isColumnModified(DepositMembersStationNewsPeer::CREATED_AT)) $criteria->add(DepositMembersStationNewsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositMembersStationNewsPeer::UPDATED_AT)) $criteria->add(DepositMembersStationNewsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositMembersStationNewsPeer::DATABASE_NAME);

		$criteria->add(DepositMembersStationNewsPeer::ID, $this->id);
		$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $this->deposit_station_news_id);
		$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getDepositStationNewsId();

		$pks[2] = $this->getDepositMembersId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setDepositStationNewsId($keys[1]);

		$this->setDepositMembersId($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStatus($this->status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setDepositStationNewsId(NULL); 
		$copyObj->setDepositMembersId(NULL); 
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
			self::$peer = new DepositMembersStationNewsPeer();
		}
		return self::$peer;
	}

	
	public function setDepositStationNews($v)
	{


		if ($v === null) {
			$this->setDepositStationNewsId(NULL);
		} else {
			$this->setDepositStationNewsId($v->getId());
		}


		$this->aDepositStationNews = $v;
	}


	
	public function getDepositStationNews($con = null)
	{
		if ($this->aDepositStationNews === null && ($this->deposit_station_news_id !== null)) {
						include_once 'lib/model/om/BaseDepositStationNewsPeer.php';

			$this->aDepositStationNews = DepositStationNewsPeer::retrieveByPK($this->deposit_station_news_id, $con);

			
		}
		return $this->aDepositStationNews;
	}

	
	public function setDepositMembers($v)
	{


		if ($v === null) {
			$this->setDepositMembersId(NULL);
		} else {
			$this->setDepositMembersId($v->getId());
		}


		$this->aDepositMembers = $v;
	}


	
	public function getDepositMembers($con = null)
	{
		if ($this->aDepositMembers === null && ($this->deposit_members_id !== null)) {
						include_once 'lib/model/om/BaseDepositMembersPeer.php';

			$this->aDepositMembers = DepositMembersPeer::retrieveByPK($this->deposit_members_id, $con);

			
		}
		return $this->aDepositMembers;
	}

} 