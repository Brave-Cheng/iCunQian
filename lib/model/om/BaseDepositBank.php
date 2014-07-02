<?php


abstract class BaseDepositBank extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name = '';


	
	protected $short_name = '';


	
	protected $short_char = '';


	
	protected $phone = '';


	
	protected $logo = '';


	
	protected $is_valid = 0;


	
	protected $sync_status = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDepositBankAliass;

	
	protected $lastDepositBankAliasCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getShortName()
	{

		return $this->short_name;
	}

	
	public function getShortChar()
	{

		return $this->short_char;
	}

	
	public function getPhone()
	{

		return $this->phone;
	}

	
	public function getLogo()
	{

		return $this->logo;
	}

	
	public function getIsValid()
	{

		return $this->is_valid;
	}

	
	public function getSyncStatus()
	{

		return $this->sync_status;
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
			$this->modifiedColumns[] = DepositBankPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = DepositBankPeer::NAME;
		}

	} 
	
	public function setShortName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->short_name !== $v || $v === '') {
			$this->short_name = $v;
			$this->modifiedColumns[] = DepositBankPeer::SHORT_NAME;
		}

	} 
	
	public function setShortChar($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->short_char !== $v || $v === '') {
			$this->short_char = $v;
			$this->modifiedColumns[] = DepositBankPeer::SHORT_CHAR;
		}

	} 
	
	public function setPhone($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone !== $v || $v === '') {
			$this->phone = $v;
			$this->modifiedColumns[] = DepositBankPeer::PHONE;
		}

	} 
	
	public function setLogo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->logo !== $v || $v === '') {
			$this->logo = $v;
			$this->modifiedColumns[] = DepositBankPeer::LOGO;
		}

	} 
	
	public function setIsValid($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_valid !== $v || $v === 0) {
			$this->is_valid = $v;
			$this->modifiedColumns[] = DepositBankPeer::IS_VALID;
		}

	} 
	
	public function setSyncStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sync_status !== $v || $v === 0) {
			$this->sync_status = $v;
			$this->modifiedColumns[] = DepositBankPeer::SYNC_STATUS;
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
			$this->modifiedColumns[] = DepositBankPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositBankPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->short_name = $rs->getString($startcol + 2);

			$this->short_char = $rs->getString($startcol + 3);

			$this->phone = $rs->getString($startcol + 4);

			$this->logo = $rs->getString($startcol + 5);

			$this->is_valid = $rs->getInt($startcol + 6);

			$this->sync_status = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositBank object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositBankPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositBankPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositBankPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositBankPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositBankPeer::DATABASE_NAME);
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
					$pk = DepositBankPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositBankPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDepositBankAliass !== null) {
				foreach($this->collDepositBankAliass as $referrerFK) {
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


			if (($retval = DepositBankPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDepositBankAliass !== null) {
					foreach($this->collDepositBankAliass as $referrerFK) {
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
		$pos = DepositBankPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getShortName();
				break;
			case 3:
				return $this->getShortChar();
				break;
			case 4:
				return $this->getPhone();
				break;
			case 5:
				return $this->getLogo();
				break;
			case 6:
				return $this->getIsValid();
				break;
			case 7:
				return $this->getSyncStatus();
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
		$keys = DepositBankPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getShortName(),
			$keys[3] => $this->getShortChar(),
			$keys[4] => $this->getPhone(),
			$keys[5] => $this->getLogo(),
			$keys[6] => $this->getIsValid(),
			$keys[7] => $this->getSyncStatus(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositBankPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setShortName($value);
				break;
			case 3:
				$this->setShortChar($value);
				break;
			case 4:
				$this->setPhone($value);
				break;
			case 5:
				$this->setLogo($value);
				break;
			case 6:
				$this->setIsValid($value);
				break;
			case 7:
				$this->setSyncStatus($value);
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
		$keys = DepositBankPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setShortName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setShortChar($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPhone($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLogo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsValid($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSyncStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositBankPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositBankPeer::ID)) $criteria->add(DepositBankPeer::ID, $this->id);
		if ($this->isColumnModified(DepositBankPeer::NAME)) $criteria->add(DepositBankPeer::NAME, $this->name);
		if ($this->isColumnModified(DepositBankPeer::SHORT_NAME)) $criteria->add(DepositBankPeer::SHORT_NAME, $this->short_name);
		if ($this->isColumnModified(DepositBankPeer::SHORT_CHAR)) $criteria->add(DepositBankPeer::SHORT_CHAR, $this->short_char);
		if ($this->isColumnModified(DepositBankPeer::PHONE)) $criteria->add(DepositBankPeer::PHONE, $this->phone);
		if ($this->isColumnModified(DepositBankPeer::LOGO)) $criteria->add(DepositBankPeer::LOGO, $this->logo);
		if ($this->isColumnModified(DepositBankPeer::IS_VALID)) $criteria->add(DepositBankPeer::IS_VALID, $this->is_valid);
		if ($this->isColumnModified(DepositBankPeer::SYNC_STATUS)) $criteria->add(DepositBankPeer::SYNC_STATUS, $this->sync_status);
		if ($this->isColumnModified(DepositBankPeer::CREATED_AT)) $criteria->add(DepositBankPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositBankPeer::UPDATED_AT)) $criteria->add(DepositBankPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositBankPeer::DATABASE_NAME);

		$criteria->add(DepositBankPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setShortName($this->short_name);

		$copyObj->setShortChar($this->short_char);

		$copyObj->setPhone($this->phone);

		$copyObj->setLogo($this->logo);

		$copyObj->setIsValid($this->is_valid);

		$copyObj->setSyncStatus($this->sync_status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDepositBankAliass() as $relObj) {
				$copyObj->addDepositBankAlias($relObj->copy($deepCopy));
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
			self::$peer = new DepositBankPeer();
		}
		return self::$peer;
	}

	
	public function initDepositBankAliass()
	{
		if ($this->collDepositBankAliass === null) {
			$this->collDepositBankAliass = array();
		}
	}

	
	public function getDepositBankAliass($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositBankAliasPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositBankAliass === null) {
			if ($this->isNew()) {
			   $this->collDepositBankAliass = array();
			} else {

				$criteria->add(DepositBankAliasPeer::DEPOSIT_BANK_ID, $this->getId());

				DepositBankAliasPeer::addSelectColumns($criteria);
				$this->collDepositBankAliass = DepositBankAliasPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepositBankAliasPeer::DEPOSIT_BANK_ID, $this->getId());

				DepositBankAliasPeer::addSelectColumns($criteria);
				if (!isset($this->lastDepositBankAliasCriteria) || !$this->lastDepositBankAliasCriteria->equals($criteria)) {
					$this->collDepositBankAliass = DepositBankAliasPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDepositBankAliasCriteria = $criteria;
		return $this->collDepositBankAliass;
	}

	
	public function countDepositBankAliass($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDepositBankAliasPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DepositBankAliasPeer::DEPOSIT_BANK_ID, $this->getId());

		return DepositBankAliasPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepositBankAlias(DepositBankAlias $l)
	{
		$this->collDepositBankAliass[] = $l;
		$l->setDepositBank($this);
	}

} 