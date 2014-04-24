<?php


abstract class BaseEngineeringSummary extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $application_id;


	
	protected $total_current_finish_amount;


	
	protected $total_last_finish_amount;


	
	protected $total_finish_amount;


	
	protected $construction_unit;


	
	protected $contract_number;


	
	protected $issue;


	
	protected $expiration_date;


	
	protected $amount;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aApplication;

	
	protected $collEngineeringSummaryItemss;

	
	protected $lastEngineeringSummaryItemsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getApplicationId()
	{

		return $this->application_id;
	}

	
	public function getTotalCurrentFinishAmount()
	{

		return $this->total_current_finish_amount;
	}

	
	public function getTotalLastFinishAmount()
	{

		return $this->total_last_finish_amount;
	}

	
	public function getTotalFinishAmount()
	{

		return $this->total_finish_amount;
	}

	
	public function getConstructionUnit()
	{

		return $this->construction_unit;
	}

	
	public function getContractNumber()
	{

		return $this->contract_number;
	}

	
	public function getIssue()
	{

		return $this->issue;
	}

	
	public function getExpirationDate($format = 'Y-m-d')
	{

		if ($this->expiration_date === null || $this->expiration_date === '') {
			return null;
		} elseif (!is_int($this->expiration_date)) {
						$ts = strtotime($this->expiration_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [expiration_date] as date/time value: " . var_export($this->expiration_date, true));
			}
		} else {
			$ts = $this->expiration_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getAmount()
	{

		return $this->amount;
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
			$this->modifiedColumns[] = EngineeringSummaryPeer::ID;
		}

	} 
	
	public function setApplicationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->application_id !== $v) {
			$this->application_id = $v;
			$this->modifiedColumns[] = EngineeringSummaryPeer::APPLICATION_ID;
		}

		if ($this->aApplication !== null && $this->aApplication->getId() !== $v) {
			$this->aApplication = null;
		}

	} 
	
	public function setTotalCurrentFinishAmount($v)
	{

		if ($this->total_current_finish_amount !== $v) {
			$this->total_current_finish_amount = $v;
			$this->modifiedColumns[] = EngineeringSummaryPeer::TOTAL_CURRENT_FINISH_AMOUNT;
		}

	} 
	
	public function setTotalLastFinishAmount($v)
	{

		if ($this->total_last_finish_amount !== $v) {
			$this->total_last_finish_amount = $v;
			$this->modifiedColumns[] = EngineeringSummaryPeer::TOTAL_LAST_FINISH_AMOUNT;
		}

	} 
	
	public function setTotalFinishAmount($v)
	{

		if ($this->total_finish_amount !== $v) {
			$this->total_finish_amount = $v;
			$this->modifiedColumns[] = EngineeringSummaryPeer::TOTAL_FINISH_AMOUNT;
		}

	} 
	
	public function setConstructionUnit($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->construction_unit !== $v) {
			$this->construction_unit = $v;
			$this->modifiedColumns[] = EngineeringSummaryPeer::CONSTRUCTION_UNIT;
		}

	} 
	
	public function setContractNumber($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contract_number !== $v) {
			$this->contract_number = $v;
			$this->modifiedColumns[] = EngineeringSummaryPeer::CONTRACT_NUMBER;
		}

	} 
	
	public function setIssue($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->issue !== $v) {
			$this->issue = $v;
			$this->modifiedColumns[] = EngineeringSummaryPeer::ISSUE;
		}

	} 
	
	public function setExpirationDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [expiration_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->expiration_date !== $ts) {
			$this->expiration_date = $ts;
			$this->modifiedColumns[] = EngineeringSummaryPeer::EXPIRATION_DATE;
		}

	} 
	
	public function setAmount($v)
	{

		if ($this->amount !== $v) {
			$this->amount = $v;
			$this->modifiedColumns[] = EngineeringSummaryPeer::AMOUNT;
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
			$this->modifiedColumns[] = EngineeringSummaryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EngineeringSummaryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->application_id = $rs->getInt($startcol + 1);

			$this->total_current_finish_amount = $rs->getFloat($startcol + 2);

			$this->total_last_finish_amount = $rs->getFloat($startcol + 3);

			$this->total_finish_amount = $rs->getFloat($startcol + 4);

			$this->construction_unit = $rs->getString($startcol + 5);

			$this->contract_number = $rs->getString($startcol + 6);

			$this->issue = $rs->getString($startcol + 7);

			$this->expiration_date = $rs->getDate($startcol + 8, null);

			$this->amount = $rs->getFloat($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EngineeringSummary object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringSummaryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EngineeringSummaryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EngineeringSummaryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EngineeringSummaryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringSummaryPeer::DATABASE_NAME);
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


												
			if ($this->aApplication !== null) {
				if ($this->aApplication->isModified()) {
					$affectedRows += $this->aApplication->save($con);
				}
				$this->setApplication($this->aApplication);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EngineeringSummaryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EngineeringSummaryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEngineeringSummaryItemss !== null) {
				foreach($this->collEngineeringSummaryItemss as $referrerFK) {
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


												
			if ($this->aApplication !== null) {
				if (!$this->aApplication->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aApplication->getValidationFailures());
				}
			}


			if (($retval = EngineeringSummaryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEngineeringSummaryItemss !== null) {
					foreach($this->collEngineeringSummaryItemss as $referrerFK) {
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
		$pos = EngineeringSummaryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getApplicationId();
				break;
			case 2:
				return $this->getTotalCurrentFinishAmount();
				break;
			case 3:
				return $this->getTotalLastFinishAmount();
				break;
			case 4:
				return $this->getTotalFinishAmount();
				break;
			case 5:
				return $this->getConstructionUnit();
				break;
			case 6:
				return $this->getContractNumber();
				break;
			case 7:
				return $this->getIssue();
				break;
			case 8:
				return $this->getExpirationDate();
				break;
			case 9:
				return $this->getAmount();
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
		$keys = EngineeringSummaryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getApplicationId(),
			$keys[2] => $this->getTotalCurrentFinishAmount(),
			$keys[3] => $this->getTotalLastFinishAmount(),
			$keys[4] => $this->getTotalFinishAmount(),
			$keys[5] => $this->getConstructionUnit(),
			$keys[6] => $this->getContractNumber(),
			$keys[7] => $this->getIssue(),
			$keys[8] => $this->getExpirationDate(),
			$keys[9] => $this->getAmount(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringSummaryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setApplicationId($value);
				break;
			case 2:
				$this->setTotalCurrentFinishAmount($value);
				break;
			case 3:
				$this->setTotalLastFinishAmount($value);
				break;
			case 4:
				$this->setTotalFinishAmount($value);
				break;
			case 5:
				$this->setConstructionUnit($value);
				break;
			case 6:
				$this->setContractNumber($value);
				break;
			case 7:
				$this->setIssue($value);
				break;
			case 8:
				$this->setExpirationDate($value);
				break;
			case 9:
				$this->setAmount($value);
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
		$keys = EngineeringSummaryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setApplicationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTotalCurrentFinishAmount($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTotalLastFinishAmount($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTotalFinishAmount($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setConstructionUnit($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setContractNumber($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIssue($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setExpirationDate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAmount($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EngineeringSummaryPeer::DATABASE_NAME);

		if ($this->isColumnModified(EngineeringSummaryPeer::ID)) $criteria->add(EngineeringSummaryPeer::ID, $this->id);
		if ($this->isColumnModified(EngineeringSummaryPeer::APPLICATION_ID)) $criteria->add(EngineeringSummaryPeer::APPLICATION_ID, $this->application_id);
		if ($this->isColumnModified(EngineeringSummaryPeer::TOTAL_CURRENT_FINISH_AMOUNT)) $criteria->add(EngineeringSummaryPeer::TOTAL_CURRENT_FINISH_AMOUNT, $this->total_current_finish_amount);
		if ($this->isColumnModified(EngineeringSummaryPeer::TOTAL_LAST_FINISH_AMOUNT)) $criteria->add(EngineeringSummaryPeer::TOTAL_LAST_FINISH_AMOUNT, $this->total_last_finish_amount);
		if ($this->isColumnModified(EngineeringSummaryPeer::TOTAL_FINISH_AMOUNT)) $criteria->add(EngineeringSummaryPeer::TOTAL_FINISH_AMOUNT, $this->total_finish_amount);
		if ($this->isColumnModified(EngineeringSummaryPeer::CONSTRUCTION_UNIT)) $criteria->add(EngineeringSummaryPeer::CONSTRUCTION_UNIT, $this->construction_unit);
		if ($this->isColumnModified(EngineeringSummaryPeer::CONTRACT_NUMBER)) $criteria->add(EngineeringSummaryPeer::CONTRACT_NUMBER, $this->contract_number);
		if ($this->isColumnModified(EngineeringSummaryPeer::ISSUE)) $criteria->add(EngineeringSummaryPeer::ISSUE, $this->issue);
		if ($this->isColumnModified(EngineeringSummaryPeer::EXPIRATION_DATE)) $criteria->add(EngineeringSummaryPeer::EXPIRATION_DATE, $this->expiration_date);
		if ($this->isColumnModified(EngineeringSummaryPeer::AMOUNT)) $criteria->add(EngineeringSummaryPeer::AMOUNT, $this->amount);
		if ($this->isColumnModified(EngineeringSummaryPeer::CREATED_AT)) $criteria->add(EngineeringSummaryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EngineeringSummaryPeer::UPDATED_AT)) $criteria->add(EngineeringSummaryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EngineeringSummaryPeer::DATABASE_NAME);

		$criteria->add(EngineeringSummaryPeer::ID, $this->id);

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

		$copyObj->setApplicationId($this->application_id);

		$copyObj->setTotalCurrentFinishAmount($this->total_current_finish_amount);

		$copyObj->setTotalLastFinishAmount($this->total_last_finish_amount);

		$copyObj->setTotalFinishAmount($this->total_finish_amount);

		$copyObj->setConstructionUnit($this->construction_unit);

		$copyObj->setContractNumber($this->contract_number);

		$copyObj->setIssue($this->issue);

		$copyObj->setExpirationDate($this->expiration_date);

		$copyObj->setAmount($this->amount);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEngineeringSummaryItemss() as $relObj) {
				$copyObj->addEngineeringSummaryItems($relObj->copy($deepCopy));
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
			self::$peer = new EngineeringSummaryPeer();
		}
		return self::$peer;
	}

	
	public function setApplication($v)
	{


		if ($v === null) {
			$this->setApplicationId(NULL);
		} else {
			$this->setApplicationId($v->getId());
		}


		$this->aApplication = $v;
	}


	
	public function getApplication($con = null)
	{
		if ($this->aApplication === null && ($this->application_id !== null)) {
						include_once 'lib/model/om/BaseApplicationPeer.php';

			$this->aApplication = ApplicationPeer::retrieveByPK($this->application_id, $con);

			
		}
		return $this->aApplication;
	}

	
	public function initEngineeringSummaryItemss()
	{
		if ($this->collEngineeringSummaryItemss === null) {
			$this->collEngineeringSummaryItemss = array();
		}
	}

	
	public function getEngineeringSummaryItemss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringSummaryItemsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEngineeringSummaryItemss === null) {
			if ($this->isNew()) {
			   $this->collEngineeringSummaryItemss = array();
			} else {

				$criteria->add(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, $this->getId());

				EngineeringSummaryItemsPeer::addSelectColumns($criteria);
				$this->collEngineeringSummaryItemss = EngineeringSummaryItemsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, $this->getId());

				EngineeringSummaryItemsPeer::addSelectColumns($criteria);
				if (!isset($this->lastEngineeringSummaryItemsCriteria) || !$this->lastEngineeringSummaryItemsCriteria->equals($criteria)) {
					$this->collEngineeringSummaryItemss = EngineeringSummaryItemsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEngineeringSummaryItemsCriteria = $criteria;
		return $this->collEngineeringSummaryItemss;
	}

	
	public function countEngineeringSummaryItemss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringSummaryItemsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, $this->getId());

		return EngineeringSummaryItemsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEngineeringSummaryItems(EngineeringSummaryItems $l)
	{
		$this->collEngineeringSummaryItemss[] = $l;
		$l->setEngineeringSummary($this);
	}

} 