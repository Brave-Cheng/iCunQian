<?php


abstract class BaseDepositMembersToken extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $deposit_members_id;


	
	protected $push_devices_id;


	
	protected $is_valid = 'no';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDepositMembers;

	
	protected $aPushDevices;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDepositMembersId()
	{

		return $this->deposit_members_id;
	}

	
	public function getPushDevicesId()
	{

		return $this->push_devices_id;
	}

	
	public function getIsValid()
	{

		return $this->is_valid;
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
			$this->modifiedColumns[] = DepositMembersTokenPeer::ID;
		}

	} 
	
	public function setDepositMembersId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_members_id !== $v) {
			$this->deposit_members_id = $v;
			$this->modifiedColumns[] = DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID;
		}

		if ($this->aDepositMembers !== null && $this->aDepositMembers->getId() !== $v) {
			$this->aDepositMembers = null;
		}

	} 
	
	public function setPushDevicesId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->push_devices_id !== $v) {
			$this->push_devices_id = $v;
			$this->modifiedColumns[] = DepositMembersTokenPeer::PUSH_DEVICES_ID;
		}

		if ($this->aPushDevices !== null && $this->aPushDevices->getId() !== $v) {
			$this->aPushDevices = null;
		}

	} 
	
	public function setIsValid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->is_valid !== $v || $v === 'no') {
			$this->is_valid = $v;
			$this->modifiedColumns[] = DepositMembersTokenPeer::IS_VALID;
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
			$this->modifiedColumns[] = DepositMembersTokenPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositMembersTokenPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->deposit_members_id = $rs->getInt($startcol + 1);

			$this->push_devices_id = $rs->getInt($startcol + 2);

			$this->is_valid = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositMembersToken object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersTokenPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositMembersTokenPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositMembersTokenPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositMembersTokenPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersTokenPeer::DATABASE_NAME);
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


												
			if ($this->aDepositMembers !== null) {
				if ($this->aDepositMembers->isModified()) {
					$affectedRows += $this->aDepositMembers->save($con);
				}
				$this->setDepositMembers($this->aDepositMembers);
			}

			if ($this->aPushDevices !== null) {
				if ($this->aPushDevices->isModified()) {
					$affectedRows += $this->aPushDevices->save($con);
				}
				$this->setPushDevices($this->aPushDevices);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DepositMembersTokenPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositMembersTokenPeer::doUpdate($this, $con);
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


												
			if ($this->aDepositMembers !== null) {
				if (!$this->aDepositMembers->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositMembers->getValidationFailures());
				}
			}

			if ($this->aPushDevices !== null) {
				if (!$this->aPushDevices->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPushDevices->getValidationFailures());
				}
			}


			if (($retval = DepositMembersTokenPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersTokenPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDepositMembersId();
				break;
			case 2:
				return $this->getPushDevicesId();
				break;
			case 3:
				return $this->getIsValid();
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
		$keys = DepositMembersTokenPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDepositMembersId(),
			$keys[2] => $this->getPushDevicesId(),
			$keys[3] => $this->getIsValid(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersTokenPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDepositMembersId($value);
				break;
			case 2:
				$this->setPushDevicesId($value);
				break;
			case 3:
				$this->setIsValid($value);
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
		$keys = DepositMembersTokenPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDepositMembersId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPushDevicesId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsValid($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositMembersTokenPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositMembersTokenPeer::ID)) $criteria->add(DepositMembersTokenPeer::ID, $this->id);
		if ($this->isColumnModified(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID)) $criteria->add(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);
		if ($this->isColumnModified(DepositMembersTokenPeer::PUSH_DEVICES_ID)) $criteria->add(DepositMembersTokenPeer::PUSH_DEVICES_ID, $this->push_devices_id);
		if ($this->isColumnModified(DepositMembersTokenPeer::IS_VALID)) $criteria->add(DepositMembersTokenPeer::IS_VALID, $this->is_valid);
		if ($this->isColumnModified(DepositMembersTokenPeer::CREATED_AT)) $criteria->add(DepositMembersTokenPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositMembersTokenPeer::UPDATED_AT)) $criteria->add(DepositMembersTokenPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositMembersTokenPeer::DATABASE_NAME);

		$criteria->add(DepositMembersTokenPeer::ID, $this->id);
		$criteria->add(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);
		$criteria->add(DepositMembersTokenPeer::PUSH_DEVICES_ID, $this->push_devices_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getDepositMembersId();

		$pks[2] = $this->getPushDevicesId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setDepositMembersId($keys[1]);

		$this->setPushDevicesId($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIsValid($this->is_valid);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setDepositMembersId(NULL); 
		$copyObj->setPushDevicesId(NULL); 
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
			self::$peer = new DepositMembersTokenPeer();
		}
		return self::$peer;
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

	
	public function setPushDevices($v)
	{


		if ($v === null) {
			$this->setPushDevicesId(NULL);
		} else {
			$this->setPushDevicesId($v->getId());
		}


		$this->aPushDevices = $v;
	}


	
	public function getPushDevices($con = null)
	{
		if ($this->aPushDevices === null && ($this->push_devices_id !== null)) {
						include_once 'lib/model/om/BasePushDevicesPeer.php';

			$this->aPushDevices = PushDevicesPeer::retrieveByPK($this->push_devices_id, $con);

			
		}
		return $this->aPushDevices;
	}

} 