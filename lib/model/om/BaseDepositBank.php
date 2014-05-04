<?php


abstract class BaseDepositBank extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $property = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDepositFinancialProductss;

	
	protected $lastDepositFinancialProductsCriteria = null;

	
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

	
	public function getProperty()
	{

		return $this->property;
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

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = DepositBankPeer::NAME;
		}

	} 
	
	public function setProperty($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->property !== $v || $v === 0) {
			$this->property = $v;
			$this->modifiedColumns[] = DepositBankPeer::PROPERTY;
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

			$this->property = $rs->getInt($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
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

			if ($this->collDepositFinancialProductss !== null) {
				foreach($this->collDepositFinancialProductss as $referrerFK) {
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


				if ($this->collDepositFinancialProductss !== null) {
					foreach($this->collDepositFinancialProductss as $referrerFK) {
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
				return $this->getProperty();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
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
			$keys[2] => $this->getProperty(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdatedAt(),
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
				$this->setProperty($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositBankPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProperty($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositBankPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositBankPeer::ID)) $criteria->add(DepositBankPeer::ID, $this->id);
		if ($this->isColumnModified(DepositBankPeer::NAME)) $criteria->add(DepositBankPeer::NAME, $this->name);
		if ($this->isColumnModified(DepositBankPeer::PROPERTY)) $criteria->add(DepositBankPeer::PROPERTY, $this->property);
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

		$copyObj->setProperty($this->property);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDepositFinancialProductss() as $relObj) {
				$copyObj->addDepositFinancialProducts($relObj->copy($deepCopy));
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

	
	public function initDepositFinancialProductss()
	{
		if ($this->collDepositFinancialProductss === null) {
			$this->collDepositFinancialProductss = array();
		}
	}

	
	public function getDepositFinancialProductss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositFinancialProductsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositFinancialProductss === null) {
			if ($this->isNew()) {
			   $this->collDepositFinancialProductss = array();
			} else {

				$criteria->add(DepositFinancialProductsPeer::BANK_ID, $this->getId());

				DepositFinancialProductsPeer::addSelectColumns($criteria);
				$this->collDepositFinancialProductss = DepositFinancialProductsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepositFinancialProductsPeer::BANK_ID, $this->getId());

				DepositFinancialProductsPeer::addSelectColumns($criteria);
				if (!isset($this->lastDepositFinancialProductsCriteria) || !$this->lastDepositFinancialProductsCriteria->equals($criteria)) {
					$this->collDepositFinancialProductss = DepositFinancialProductsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDepositFinancialProductsCriteria = $criteria;
		return $this->collDepositFinancialProductss;
	}

	
	public function countDepositFinancialProductss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDepositFinancialProductsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DepositFinancialProductsPeer::BANK_ID, $this->getId());

		return DepositFinancialProductsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepositFinancialProducts(DepositFinancialProducts $l)
	{
		$this->collDepositFinancialProductss[] = $l;
		$l->setDepositBank($this);
	}


	
	public function getDepositFinancialProductssJoinDepositRequestFinancial($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositFinancialProductsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositFinancialProductss === null) {
			if ($this->isNew()) {
				$this->collDepositFinancialProductss = array();
			} else {

				$criteria->add(DepositFinancialProductsPeer::BANK_ID, $this->getId());

				$this->collDepositFinancialProductss = DepositFinancialProductsPeer::doSelectJoinDepositRequestFinancial($criteria, $con);
			}
		} else {
									
			$criteria->add(DepositFinancialProductsPeer::BANK_ID, $this->getId());

			if (!isset($this->lastDepositFinancialProductsCriteria) || !$this->lastDepositFinancialProductsCriteria->equals($criteria)) {
				$this->collDepositFinancialProductss = DepositFinancialProductsPeer::doSelectJoinDepositRequestFinancial($criteria, $con);
			}
		}
		$this->lastDepositFinancialProductsCriteria = $criteria;

		return $this->collDepositFinancialProductss;
	}


	
	public function getDepositFinancialProductssJoinDepositRegion($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositFinancialProductsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositFinancialProductss === null) {
			if ($this->isNew()) {
				$this->collDepositFinancialProductss = array();
			} else {

				$criteria->add(DepositFinancialProductsPeer::BANK_ID, $this->getId());

				$this->collDepositFinancialProductss = DepositFinancialProductsPeer::doSelectJoinDepositRegion($criteria, $con);
			}
		} else {
									
			$criteria->add(DepositFinancialProductsPeer::BANK_ID, $this->getId());

			if (!isset($this->lastDepositFinancialProductsCriteria) || !$this->lastDepositFinancialProductsCriteria->equals($criteria)) {
				$this->collDepositFinancialProductss = DepositFinancialProductsPeer::doSelectJoinDepositRegion($criteria, $con);
			}
		}
		$this->lastDepositFinancialProductsCriteria = $criteria;

		return $this->collDepositFinancialProductss;
	}

} 