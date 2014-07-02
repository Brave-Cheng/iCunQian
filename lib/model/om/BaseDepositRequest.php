<?php


abstract class BaseDepositRequest extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $page = 0;


	
	protected $unique_keys;


	
	protected $encrypt;


	
	protected $is_process = 0;


	
	protected $request_number;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDepositRequestFinancials;

	
	protected $lastDepositRequestFinancialCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPage()
	{

		return $this->page;
	}

	
	public function getUniqueKeys()
	{

		return $this->unique_keys;
	}

	
	public function getEncrypt()
	{

		return $this->encrypt;
	}

	
	public function getIsProcess()
	{

		return $this->is_process;
	}

	
	public function getRequestNumber()
	{

		return $this->request_number;
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
			$this->modifiedColumns[] = DepositRequestPeer::ID;
		}

	} 
	
	public function setPage($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->page !== $v || $v === 0) {
			$this->page = $v;
			$this->modifiedColumns[] = DepositRequestPeer::PAGE;
		}

	} 
	
	public function setUniqueKeys($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->unique_keys !== $v) {
			$this->unique_keys = $v;
			$this->modifiedColumns[] = DepositRequestPeer::UNIQUE_KEYS;
		}

	} 
	
	public function setEncrypt($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->encrypt !== $v) {
			$this->encrypt = $v;
			$this->modifiedColumns[] = DepositRequestPeer::ENCRYPT;
		}

	} 
	
	public function setIsProcess($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_process !== $v || $v === 0) {
			$this->is_process = $v;
			$this->modifiedColumns[] = DepositRequestPeer::IS_PROCESS;
		}

	} 
	
	public function setRequestNumber($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->request_number !== $v) {
			$this->request_number = $v;
			$this->modifiedColumns[] = DepositRequestPeer::REQUEST_NUMBER;
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
			$this->modifiedColumns[] = DepositRequestPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositRequestPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->page = $rs->getInt($startcol + 1);

			$this->unique_keys = $rs->getString($startcol + 2);

			$this->encrypt = $rs->getString($startcol + 3);

			$this->is_process = $rs->getInt($startcol + 4);

			$this->request_number = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositRequest object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositRequestPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositRequestPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositRequestPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositRequestPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositRequestPeer::DATABASE_NAME);
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
					$pk = DepositRequestPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositRequestPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDepositRequestFinancials !== null) {
				foreach($this->collDepositRequestFinancials as $referrerFK) {
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


			if (($retval = DepositRequestPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDepositRequestFinancials !== null) {
					foreach($this->collDepositRequestFinancials as $referrerFK) {
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
		$pos = DepositRequestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPage();
				break;
			case 2:
				return $this->getUniqueKeys();
				break;
			case 3:
				return $this->getEncrypt();
				break;
			case 4:
				return $this->getIsProcess();
				break;
			case 5:
				return $this->getRequestNumber();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositRequestPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPage(),
			$keys[2] => $this->getUniqueKeys(),
			$keys[3] => $this->getEncrypt(),
			$keys[4] => $this->getIsProcess(),
			$keys[5] => $this->getRequestNumber(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositRequestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPage($value);
				break;
			case 2:
				$this->setUniqueKeys($value);
				break;
			case 3:
				$this->setEncrypt($value);
				break;
			case 4:
				$this->setIsProcess($value);
				break;
			case 5:
				$this->setRequestNumber($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositRequestPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPage($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUniqueKeys($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEncrypt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsProcess($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRequestNumber($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositRequestPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositRequestPeer::ID)) $criteria->add(DepositRequestPeer::ID, $this->id);
		if ($this->isColumnModified(DepositRequestPeer::PAGE)) $criteria->add(DepositRequestPeer::PAGE, $this->page);
		if ($this->isColumnModified(DepositRequestPeer::UNIQUE_KEYS)) $criteria->add(DepositRequestPeer::UNIQUE_KEYS, $this->unique_keys);
		if ($this->isColumnModified(DepositRequestPeer::ENCRYPT)) $criteria->add(DepositRequestPeer::ENCRYPT, $this->encrypt);
		if ($this->isColumnModified(DepositRequestPeer::IS_PROCESS)) $criteria->add(DepositRequestPeer::IS_PROCESS, $this->is_process);
		if ($this->isColumnModified(DepositRequestPeer::REQUEST_NUMBER)) $criteria->add(DepositRequestPeer::REQUEST_NUMBER, $this->request_number);
		if ($this->isColumnModified(DepositRequestPeer::CREATED_AT)) $criteria->add(DepositRequestPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositRequestPeer::UPDATED_AT)) $criteria->add(DepositRequestPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositRequestPeer::DATABASE_NAME);

		$criteria->add(DepositRequestPeer::ID, $this->id);

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

		$copyObj->setPage($this->page);

		$copyObj->setUniqueKeys($this->unique_keys);

		$copyObj->setEncrypt($this->encrypt);

		$copyObj->setIsProcess($this->is_process);

		$copyObj->setRequestNumber($this->request_number);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDepositRequestFinancials() as $relObj) {
				$copyObj->addDepositRequestFinancial($relObj->copy($deepCopy));
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
			self::$peer = new DepositRequestPeer();
		}
		return self::$peer;
	}

	
	public function initDepositRequestFinancials()
	{
		if ($this->collDepositRequestFinancials === null) {
			$this->collDepositRequestFinancials = array();
		}
	}

	
	public function getDepositRequestFinancials($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositRequestFinancialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositRequestFinancials === null) {
			if ($this->isNew()) {
			   $this->collDepositRequestFinancials = array();
			} else {

				$criteria->add(DepositRequestFinancialPeer::REQUEST_ID, $this->getId());

				DepositRequestFinancialPeer::addSelectColumns($criteria);
				$this->collDepositRequestFinancials = DepositRequestFinancialPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepositRequestFinancialPeer::REQUEST_ID, $this->getId());

				DepositRequestFinancialPeer::addSelectColumns($criteria);
				if (!isset($this->lastDepositRequestFinancialCriteria) || !$this->lastDepositRequestFinancialCriteria->equals($criteria)) {
					$this->collDepositRequestFinancials = DepositRequestFinancialPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDepositRequestFinancialCriteria = $criteria;
		return $this->collDepositRequestFinancials;
	}

	
	public function countDepositRequestFinancials($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDepositRequestFinancialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DepositRequestFinancialPeer::REQUEST_ID, $this->getId());

		return DepositRequestFinancialPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepositRequestFinancial(DepositRequestFinancial $l)
	{
		$this->collDepositRequestFinancials[] = $l;
		$l->setDepositRequest($this);
	}

} 