<?php


abstract class BaseDepositMembersSubscribe extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $deposit_members_id;


	
	protected $deposit_bank_id;


	
	protected $city = '';


	
	protected $profit_type = '';


	
	protected $expected_rate;


	
	protected $invest_cycle;


	
	protected $is_valid = 'no';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDepositMembers;

	
	protected $aDepositBank;

	
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

	
	public function getDepositBankId()
	{

		return $this->deposit_bank_id;
	}

	
	public function getCity()
	{

		return $this->city;
	}

	
	public function getProfitType()
	{

		return $this->profit_type;
	}

	
	public function getExpectedRate()
	{

		return $this->expected_rate;
	}

	
	public function getInvestCycle()
	{

		return $this->invest_cycle;
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
			$this->modifiedColumns[] = DepositMembersSubscribePeer::ID;
		}

	} 
	
	public function setDepositMembersId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_members_id !== $v) {
			$this->deposit_members_id = $v;
			$this->modifiedColumns[] = DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID;
		}

		if ($this->aDepositMembers !== null && $this->aDepositMembers->getId() !== $v) {
			$this->aDepositMembers = null;
		}

	} 
	
	public function setDepositBankId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_bank_id !== $v) {
			$this->deposit_bank_id = $v;
			$this->modifiedColumns[] = DepositMembersSubscribePeer::DEPOSIT_BANK_ID;
		}

		if ($this->aDepositBank !== null && $this->aDepositBank->getId() !== $v) {
			$this->aDepositBank = null;
		}

	} 
	
	public function setCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v || $v === '') {
			$this->city = $v;
			$this->modifiedColumns[] = DepositMembersSubscribePeer::CITY;
		}

	} 
	
	public function setProfitType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->profit_type !== $v || $v === '') {
			$this->profit_type = $v;
			$this->modifiedColumns[] = DepositMembersSubscribePeer::PROFIT_TYPE;
		}

	} 
	
	public function setExpectedRate($v)
	{

		if ($this->expected_rate !== $v) {
			$this->expected_rate = $v;
			$this->modifiedColumns[] = DepositMembersSubscribePeer::EXPECTED_RATE;
		}

	} 
	
	public function setInvestCycle($v)
	{

		if ($this->invest_cycle !== $v) {
			$this->invest_cycle = $v;
			$this->modifiedColumns[] = DepositMembersSubscribePeer::INVEST_CYCLE;
		}

	} 
	
	public function setIsValid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->is_valid !== $v || $v === 'no') {
			$this->is_valid = $v;
			$this->modifiedColumns[] = DepositMembersSubscribePeer::IS_VALID;
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
			$this->modifiedColumns[] = DepositMembersSubscribePeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositMembersSubscribePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->deposit_members_id = $rs->getInt($startcol + 1);

			$this->deposit_bank_id = $rs->getInt($startcol + 2);

			$this->city = $rs->getString($startcol + 3);

			$this->profit_type = $rs->getString($startcol + 4);

			$this->expected_rate = $rs->getFloat($startcol + 5);

			$this->invest_cycle = $rs->getFloat($startcol + 6);

			$this->is_valid = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositMembersSubscribe object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersSubscribePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositMembersSubscribePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositMembersSubscribePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositMembersSubscribePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersSubscribePeer::DATABASE_NAME);
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

			if ($this->aDepositBank !== null) {
				if ($this->aDepositBank->isModified()) {
					$affectedRows += $this->aDepositBank->save($con);
				}
				$this->setDepositBank($this->aDepositBank);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DepositMembersSubscribePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositMembersSubscribePeer::doUpdate($this, $con);
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

			if ($this->aDepositBank !== null) {
				if (!$this->aDepositBank->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositBank->getValidationFailures());
				}
			}


			if (($retval = DepositMembersSubscribePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersSubscribePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDepositBankId();
				break;
			case 3:
				return $this->getCity();
				break;
			case 4:
				return $this->getProfitType();
				break;
			case 5:
				return $this->getExpectedRate();
				break;
			case 6:
				return $this->getInvestCycle();
				break;
			case 7:
				return $this->getIsValid();
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
		$keys = DepositMembersSubscribePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDepositMembersId(),
			$keys[2] => $this->getDepositBankId(),
			$keys[3] => $this->getCity(),
			$keys[4] => $this->getProfitType(),
			$keys[5] => $this->getExpectedRate(),
			$keys[6] => $this->getInvestCycle(),
			$keys[7] => $this->getIsValid(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersSubscribePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDepositBankId($value);
				break;
			case 3:
				$this->setCity($value);
				break;
			case 4:
				$this->setProfitType($value);
				break;
			case 5:
				$this->setExpectedRate($value);
				break;
			case 6:
				$this->setInvestCycle($value);
				break;
			case 7:
				$this->setIsValid($value);
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
		$keys = DepositMembersSubscribePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDepositMembersId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDepositBankId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCity($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setProfitType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setExpectedRate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setInvestCycle($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsValid($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositMembersSubscribePeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositMembersSubscribePeer::ID)) $criteria->add(DepositMembersSubscribePeer::ID, $this->id);
		if ($this->isColumnModified(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID)) $criteria->add(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);
		if ($this->isColumnModified(DepositMembersSubscribePeer::DEPOSIT_BANK_ID)) $criteria->add(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, $this->deposit_bank_id);
		if ($this->isColumnModified(DepositMembersSubscribePeer::CITY)) $criteria->add(DepositMembersSubscribePeer::CITY, $this->city);
		if ($this->isColumnModified(DepositMembersSubscribePeer::PROFIT_TYPE)) $criteria->add(DepositMembersSubscribePeer::PROFIT_TYPE, $this->profit_type);
		if ($this->isColumnModified(DepositMembersSubscribePeer::EXPECTED_RATE)) $criteria->add(DepositMembersSubscribePeer::EXPECTED_RATE, $this->expected_rate);
		if ($this->isColumnModified(DepositMembersSubscribePeer::INVEST_CYCLE)) $criteria->add(DepositMembersSubscribePeer::INVEST_CYCLE, $this->invest_cycle);
		if ($this->isColumnModified(DepositMembersSubscribePeer::IS_VALID)) $criteria->add(DepositMembersSubscribePeer::IS_VALID, $this->is_valid);
		if ($this->isColumnModified(DepositMembersSubscribePeer::CREATED_AT)) $criteria->add(DepositMembersSubscribePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositMembersSubscribePeer::UPDATED_AT)) $criteria->add(DepositMembersSubscribePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositMembersSubscribePeer::DATABASE_NAME);

		$criteria->add(DepositMembersSubscribePeer::ID, $this->id);
		$criteria->add(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);
		$criteria->add(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, $this->deposit_bank_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getDepositMembersId();

		$pks[2] = $this->getDepositBankId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setDepositMembersId($keys[1]);

		$this->setDepositBankId($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCity($this->city);

		$copyObj->setProfitType($this->profit_type);

		$copyObj->setExpectedRate($this->expected_rate);

		$copyObj->setInvestCycle($this->invest_cycle);

		$copyObj->setIsValid($this->is_valid);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setDepositMembersId(NULL); 
		$copyObj->setDepositBankId(NULL); 
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
			self::$peer = new DepositMembersSubscribePeer();
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

	
	public function setDepositBank($v)
	{


		if ($v === null) {
			$this->setDepositBankId(NULL);
		} else {
			$this->setDepositBankId($v->getId());
		}


		$this->aDepositBank = $v;
	}


	
	public function getDepositBank($con = null)
	{
		if ($this->aDepositBank === null && ($this->deposit_bank_id !== null)) {
						include_once 'lib/model/om/BaseDepositBankPeer.php';

			$this->aDepositBank = DepositBankPeer::retrieveByPK($this->deposit_bank_id, $con);

			
		}
		return $this->aDepositBank;
	}

} 