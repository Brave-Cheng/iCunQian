<?php


abstract class BaseDepositPersonalProducts extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $deposit_financial_products_id;


	
	protected $deposit_members_id;


	
	protected $expected_rate;


	
	protected $amount;


	
	protected $buy_date;


	
	protected $expiry_date;


	
	protected $deadline_reminder = 'no';


	
	protected $sync_status = '0';


	
	protected $uuid = '';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDepositFinancialProducts;

	
	protected $aDepositMembers;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDepositFinancialProductsId()
	{

		return $this->deposit_financial_products_id;
	}

	
	public function getDepositMembersId()
	{

		return $this->deposit_members_id;
	}

	
	public function getExpectedRate()
	{

		return $this->expected_rate;
	}

	
	public function getAmount()
	{

		return $this->amount;
	}

	
	public function getBuyDate($format = 'Y-m-d H:i:s')
	{

		if ($this->buy_date === null || $this->buy_date === '') {
			return null;
		} elseif (!is_int($this->buy_date)) {
						$ts = strtotime($this->buy_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [buy_date] as date/time value: " . var_export($this->buy_date, true));
			}
		} else {
			$ts = $this->buy_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getExpiryDate($format = 'Y-m-d H:i:s')
	{

		if ($this->expiry_date === null || $this->expiry_date === '') {
			return null;
		} elseif (!is_int($this->expiry_date)) {
						$ts = strtotime($this->expiry_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [expiry_date] as date/time value: " . var_export($this->expiry_date, true));
			}
		} else {
			$ts = $this->expiry_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDeadlineReminder()
	{

		return $this->deadline_reminder;
	}

	
	public function getSyncStatus()
	{

		return $this->sync_status;
	}

	
	public function getUuid()
	{

		return $this->uuid;
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
			$this->modifiedColumns[] = DepositPersonalProductsPeer::ID;
		}

	} 
	
	public function setDepositFinancialProductsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_financial_products_id !== $v) {
			$this->deposit_financial_products_id = $v;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID;
		}

		if ($this->aDepositFinancialProducts !== null && $this->aDepositFinancialProducts->getId() !== $v) {
			$this->aDepositFinancialProducts = null;
		}

	} 
	
	public function setDepositMembersId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_members_id !== $v) {
			$this->deposit_members_id = $v;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID;
		}

		if ($this->aDepositMembers !== null && $this->aDepositMembers->getId() !== $v) {
			$this->aDepositMembers = null;
		}

	} 
	
	public function setExpectedRate($v)
	{

		if ($this->expected_rate !== $v) {
			$this->expected_rate = $v;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::EXPECTED_RATE;
		}

	} 
	
	public function setAmount($v)
	{

		if ($this->amount !== $v) {
			$this->amount = $v;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::AMOUNT;
		}

	} 
	
	public function setBuyDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [buy_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->buy_date !== $ts) {
			$this->buy_date = $ts;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::BUY_DATE;
		}

	} 
	
	public function setExpiryDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [expiry_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->expiry_date !== $ts) {
			$this->expiry_date = $ts;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::EXPIRY_DATE;
		}

	} 
	
	public function setDeadlineReminder($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->deadline_reminder !== $v || $v === 'no') {
			$this->deadline_reminder = $v;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::DEADLINE_REMINDER;
		}

	} 
	
	public function setSyncStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sync_status !== $v || $v === '0') {
			$this->sync_status = $v;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::SYNC_STATUS;
		}

	} 
	
	public function setUuid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uuid !== $v || $v === '') {
			$this->uuid = $v;
			$this->modifiedColumns[] = DepositPersonalProductsPeer::UUID;
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
			$this->modifiedColumns[] = DepositPersonalProductsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositPersonalProductsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->deposit_financial_products_id = $rs->getInt($startcol + 1);

			$this->deposit_members_id = $rs->getInt($startcol + 2);

			$this->expected_rate = $rs->getFloat($startcol + 3);

			$this->amount = $rs->getFloat($startcol + 4);

			$this->buy_date = $rs->getTimestamp($startcol + 5, null);

			$this->expiry_date = $rs->getTimestamp($startcol + 6, null);

			$this->deadline_reminder = $rs->getString($startcol + 7);

			$this->sync_status = $rs->getString($startcol + 8);

			$this->uuid = $rs->getString($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositPersonalProducts object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositPersonalProductsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositPersonalProductsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositPersonalProductsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositPersonalProductsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositPersonalProductsPeer::DATABASE_NAME);
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


												
			if ($this->aDepositFinancialProducts !== null) {
				if ($this->aDepositFinancialProducts->isModified()) {
					$affectedRows += $this->aDepositFinancialProducts->save($con);
				}
				$this->setDepositFinancialProducts($this->aDepositFinancialProducts);
			}

			if ($this->aDepositMembers !== null) {
				if ($this->aDepositMembers->isModified()) {
					$affectedRows += $this->aDepositMembers->save($con);
				}
				$this->setDepositMembers($this->aDepositMembers);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DepositPersonalProductsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositPersonalProductsPeer::doUpdate($this, $con);
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


												
			if ($this->aDepositFinancialProducts !== null) {
				if (!$this->aDepositFinancialProducts->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositFinancialProducts->getValidationFailures());
				}
			}

			if ($this->aDepositMembers !== null) {
				if (!$this->aDepositMembers->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositMembers->getValidationFailures());
				}
			}


			if (($retval = DepositPersonalProductsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositPersonalProductsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDepositFinancialProductsId();
				break;
			case 2:
				return $this->getDepositMembersId();
				break;
			case 3:
				return $this->getExpectedRate();
				break;
			case 4:
				return $this->getAmount();
				break;
			case 5:
				return $this->getBuyDate();
				break;
			case 6:
				return $this->getExpiryDate();
				break;
			case 7:
				return $this->getDeadlineReminder();
				break;
			case 8:
				return $this->getSyncStatus();
				break;
			case 9:
				return $this->getUuid();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositPersonalProductsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDepositFinancialProductsId(),
			$keys[2] => $this->getDepositMembersId(),
			$keys[3] => $this->getExpectedRate(),
			$keys[4] => $this->getAmount(),
			$keys[5] => $this->getBuyDate(),
			$keys[6] => $this->getExpiryDate(),
			$keys[7] => $this->getDeadlineReminder(),
			$keys[8] => $this->getSyncStatus(),
			$keys[9] => $this->getUuid(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositPersonalProductsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDepositFinancialProductsId($value);
				break;
			case 2:
				$this->setDepositMembersId($value);
				break;
			case 3:
				$this->setExpectedRate($value);
				break;
			case 4:
				$this->setAmount($value);
				break;
			case 5:
				$this->setBuyDate($value);
				break;
			case 6:
				$this->setExpiryDate($value);
				break;
			case 7:
				$this->setDeadlineReminder($value);
				break;
			case 8:
				$this->setSyncStatus($value);
				break;
			case 9:
				$this->setUuid($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositPersonalProductsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDepositFinancialProductsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDepositMembersId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setExpectedRate($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAmount($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setBuyDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setExpiryDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDeadlineReminder($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSyncStatus($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUuid($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositPersonalProductsPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositPersonalProductsPeer::ID)) $criteria->add(DepositPersonalProductsPeer::ID, $this->id);
		if ($this->isColumnModified(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID)) $criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->deposit_financial_products_id);
		if ($this->isColumnModified(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID)) $criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);
		if ($this->isColumnModified(DepositPersonalProductsPeer::EXPECTED_RATE)) $criteria->add(DepositPersonalProductsPeer::EXPECTED_RATE, $this->expected_rate);
		if ($this->isColumnModified(DepositPersonalProductsPeer::AMOUNT)) $criteria->add(DepositPersonalProductsPeer::AMOUNT, $this->amount);
		if ($this->isColumnModified(DepositPersonalProductsPeer::BUY_DATE)) $criteria->add(DepositPersonalProductsPeer::BUY_DATE, $this->buy_date);
		if ($this->isColumnModified(DepositPersonalProductsPeer::EXPIRY_DATE)) $criteria->add(DepositPersonalProductsPeer::EXPIRY_DATE, $this->expiry_date);
		if ($this->isColumnModified(DepositPersonalProductsPeer::DEADLINE_REMINDER)) $criteria->add(DepositPersonalProductsPeer::DEADLINE_REMINDER, $this->deadline_reminder);
		if ($this->isColumnModified(DepositPersonalProductsPeer::SYNC_STATUS)) $criteria->add(DepositPersonalProductsPeer::SYNC_STATUS, $this->sync_status);
		if ($this->isColumnModified(DepositPersonalProductsPeer::UUID)) $criteria->add(DepositPersonalProductsPeer::UUID, $this->uuid);
		if ($this->isColumnModified(DepositPersonalProductsPeer::CREATED_AT)) $criteria->add(DepositPersonalProductsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositPersonalProductsPeer::UPDATED_AT)) $criteria->add(DepositPersonalProductsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositPersonalProductsPeer::DATABASE_NAME);

		$criteria->add(DepositPersonalProductsPeer::ID, $this->id);
		$criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->deposit_financial_products_id);
		$criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getDepositFinancialProductsId();

		$pks[2] = $this->getDepositMembersId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setDepositFinancialProductsId($keys[1]);

		$this->setDepositMembersId($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setExpectedRate($this->expected_rate);

		$copyObj->setAmount($this->amount);

		$copyObj->setBuyDate($this->buy_date);

		$copyObj->setExpiryDate($this->expiry_date);

		$copyObj->setDeadlineReminder($this->deadline_reminder);

		$copyObj->setSyncStatus($this->sync_status);

		$copyObj->setUuid($this->uuid);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setDepositFinancialProductsId(NULL); 
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
			self::$peer = new DepositPersonalProductsPeer();
		}
		return self::$peer;
	}

	
	public function setDepositFinancialProducts($v)
	{


		if ($v === null) {
			$this->setDepositFinancialProductsId(NULL);
		} else {
			$this->setDepositFinancialProductsId($v->getId());
		}


		$this->aDepositFinancialProducts = $v;
	}


	
	public function getDepositFinancialProducts($con = null)
	{
		if ($this->aDepositFinancialProducts === null && ($this->deposit_financial_products_id !== null)) {
						include_once 'lib/model/om/BaseDepositFinancialProductsPeer.php';

			$this->aDepositFinancialProducts = DepositFinancialProductsPeer::retrieveByPK($this->deposit_financial_products_id, $con);

			
		}
		return $this->aDepositFinancialProducts;
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