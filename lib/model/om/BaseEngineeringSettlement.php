<?php


abstract class BaseEngineeringSettlement extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $application_id;


	
	protected $contract_number;


	
	protected $construction_unit;


	
	protected $expiration_date;


	
	protected $issue;


	
	protected $contract_amount;


	
	protected $change_amount;


	
	protected $changed_amount;


	
	protected $current_complete_engineering;


	
	protected $current_fastener_retention;


	
	protected $current_payable;


	
	protected $total_complete_engineering;


	
	protected $total_fastener_retention;


	
	protected $total_payable;


	
	protected $prepayment;


	
	protected $apply_payment;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aApplication;

	
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

	
	public function getContractNumber()
	{

		return $this->contract_number;
	}

	
	public function getConstructionUnit()
	{

		return $this->construction_unit;
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

	
	public function getIssue()
	{

		return $this->issue;
	}

	
	public function getContractAmount()
	{

		return $this->contract_amount;
	}

	
	public function getChangeAmount()
	{

		return $this->change_amount;
	}

	
	public function getChangedAmount()
	{

		return $this->changed_amount;
	}

	
	public function getCurrentCompleteEngineering()
	{

		return $this->current_complete_engineering;
	}

	
	public function getCurrentFastenerRetention()
	{

		return $this->current_fastener_retention;
	}

	
	public function getCurrentPayable()
	{

		return $this->current_payable;
	}

	
	public function getTotalCompleteEngineering()
	{

		return $this->total_complete_engineering;
	}

	
	public function getTotalFastenerRetention()
	{

		return $this->total_fastener_retention;
	}

	
	public function getTotalPayable()
	{

		return $this->total_payable;
	}

	
	public function getPrepayment()
	{

		return $this->prepayment;
	}

	
	public function getApplyPayment()
	{

		return $this->apply_payment;
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
			$this->modifiedColumns[] = EngineeringSettlementPeer::ID;
		}

	} 
	
	public function setApplicationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->application_id !== $v) {
			$this->application_id = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::APPLICATION_ID;
		}

		if ($this->aApplication !== null && $this->aApplication->getId() !== $v) {
			$this->aApplication = null;
		}

	} 
	
	public function setContractNumber($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contract_number !== $v) {
			$this->contract_number = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::CONTRACT_NUMBER;
		}

	} 
	
	public function setConstructionUnit($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->construction_unit !== $v) {
			$this->construction_unit = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::CONSTRUCTION_UNIT;
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
			$this->modifiedColumns[] = EngineeringSettlementPeer::EXPIRATION_DATE;
		}

	} 
	
	public function setIssue($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->issue !== $v) {
			$this->issue = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::ISSUE;
		}

	} 
	
	public function setContractAmount($v)
	{

		if ($this->contract_amount !== $v) {
			$this->contract_amount = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::CONTRACT_AMOUNT;
		}

	} 
	
	public function setChangeAmount($v)
	{

		if ($this->change_amount !== $v) {
			$this->change_amount = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::CHANGE_AMOUNT;
		}

	} 
	
	public function setChangedAmount($v)
	{

		if ($this->changed_amount !== $v) {
			$this->changed_amount = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::CHANGED_AMOUNT;
		}

	} 
	
	public function setCurrentCompleteEngineering($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->current_complete_engineering !== $v) {
			$this->current_complete_engineering = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::CURRENT_COMPLETE_ENGINEERING;
		}

	} 
	
	public function setCurrentFastenerRetention($v)
	{

		if ($this->current_fastener_retention !== $v) {
			$this->current_fastener_retention = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::CURRENT_FASTENER_RETENTION;
		}

	} 
	
	public function setCurrentPayable($v)
	{

		if ($this->current_payable !== $v) {
			$this->current_payable = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::CURRENT_PAYABLE;
		}

	} 
	
	public function setTotalCompleteEngineering($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->total_complete_engineering !== $v) {
			$this->total_complete_engineering = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::TOTAL_COMPLETE_ENGINEERING;
		}

	} 
	
	public function setTotalFastenerRetention($v)
	{

		if ($this->total_fastener_retention !== $v) {
			$this->total_fastener_retention = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::TOTAL_FASTENER_RETENTION;
		}

	} 
	
	public function setTotalPayable($v)
	{

		if ($this->total_payable !== $v) {
			$this->total_payable = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::TOTAL_PAYABLE;
		}

	} 
	
	public function setPrepayment($v)
	{

		if ($this->prepayment !== $v) {
			$this->prepayment = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::PREPAYMENT;
		}

	} 
	
	public function setApplyPayment($v)
	{

		if ($this->apply_payment !== $v) {
			$this->apply_payment = $v;
			$this->modifiedColumns[] = EngineeringSettlementPeer::APPLY_PAYMENT;
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
			$this->modifiedColumns[] = EngineeringSettlementPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EngineeringSettlementPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->application_id = $rs->getInt($startcol + 1);

			$this->contract_number = $rs->getString($startcol + 2);

			$this->construction_unit = $rs->getString($startcol + 3);

			$this->expiration_date = $rs->getDate($startcol + 4, null);

			$this->issue = $rs->getString($startcol + 5);

			$this->contract_amount = $rs->getFloat($startcol + 6);

			$this->change_amount = $rs->getFloat($startcol + 7);

			$this->changed_amount = $rs->getFloat($startcol + 8);

			$this->current_complete_engineering = $rs->getString($startcol + 9);

			$this->current_fastener_retention = $rs->getFloat($startcol + 10);

			$this->current_payable = $rs->getFloat($startcol + 11);

			$this->total_complete_engineering = $rs->getString($startcol + 12);

			$this->total_fastener_retention = $rs->getFloat($startcol + 13);

			$this->total_payable = $rs->getFloat($startcol + 14);

			$this->prepayment = $rs->getFloat($startcol + 15);

			$this->apply_payment = $rs->getFloat($startcol + 16);

			$this->created_at = $rs->getTimestamp($startcol + 17, null);

			$this->updated_at = $rs->getTimestamp($startcol + 18, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EngineeringSettlement object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringSettlementPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EngineeringSettlementPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EngineeringSettlementPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EngineeringSettlementPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringSettlementPeer::DATABASE_NAME);
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
					$pk = EngineeringSettlementPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EngineeringSettlementPeer::doUpdate($this, $con);
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


												
			if ($this->aApplication !== null) {
				if (!$this->aApplication->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aApplication->getValidationFailures());
				}
			}


			if (($retval = EngineeringSettlementPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringSettlementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getContractNumber();
				break;
			case 3:
				return $this->getConstructionUnit();
				break;
			case 4:
				return $this->getExpirationDate();
				break;
			case 5:
				return $this->getIssue();
				break;
			case 6:
				return $this->getContractAmount();
				break;
			case 7:
				return $this->getChangeAmount();
				break;
			case 8:
				return $this->getChangedAmount();
				break;
			case 9:
				return $this->getCurrentCompleteEngineering();
				break;
			case 10:
				return $this->getCurrentFastenerRetention();
				break;
			case 11:
				return $this->getCurrentPayable();
				break;
			case 12:
				return $this->getTotalCompleteEngineering();
				break;
			case 13:
				return $this->getTotalFastenerRetention();
				break;
			case 14:
				return $this->getTotalPayable();
				break;
			case 15:
				return $this->getPrepayment();
				break;
			case 16:
				return $this->getApplyPayment();
				break;
			case 17:
				return $this->getCreatedAt();
				break;
			case 18:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EngineeringSettlementPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getApplicationId(),
			$keys[2] => $this->getContractNumber(),
			$keys[3] => $this->getConstructionUnit(),
			$keys[4] => $this->getExpirationDate(),
			$keys[5] => $this->getIssue(),
			$keys[6] => $this->getContractAmount(),
			$keys[7] => $this->getChangeAmount(),
			$keys[8] => $this->getChangedAmount(),
			$keys[9] => $this->getCurrentCompleteEngineering(),
			$keys[10] => $this->getCurrentFastenerRetention(),
			$keys[11] => $this->getCurrentPayable(),
			$keys[12] => $this->getTotalCompleteEngineering(),
			$keys[13] => $this->getTotalFastenerRetention(),
			$keys[14] => $this->getTotalPayable(),
			$keys[15] => $this->getPrepayment(),
			$keys[16] => $this->getApplyPayment(),
			$keys[17] => $this->getCreatedAt(),
			$keys[18] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringSettlementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setContractNumber($value);
				break;
			case 3:
				$this->setConstructionUnit($value);
				break;
			case 4:
				$this->setExpirationDate($value);
				break;
			case 5:
				$this->setIssue($value);
				break;
			case 6:
				$this->setContractAmount($value);
				break;
			case 7:
				$this->setChangeAmount($value);
				break;
			case 8:
				$this->setChangedAmount($value);
				break;
			case 9:
				$this->setCurrentCompleteEngineering($value);
				break;
			case 10:
				$this->setCurrentFastenerRetention($value);
				break;
			case 11:
				$this->setCurrentPayable($value);
				break;
			case 12:
				$this->setTotalCompleteEngineering($value);
				break;
			case 13:
				$this->setTotalFastenerRetention($value);
				break;
			case 14:
				$this->setTotalPayable($value);
				break;
			case 15:
				$this->setPrepayment($value);
				break;
			case 16:
				$this->setApplyPayment($value);
				break;
			case 17:
				$this->setCreatedAt($value);
				break;
			case 18:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EngineeringSettlementPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setApplicationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContractNumber($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setConstructionUnit($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setExpirationDate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIssue($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setContractAmount($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setChangeAmount($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setChangedAmount($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCurrentCompleteEngineering($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCurrentFastenerRetention($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCurrentPayable($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTotalCompleteEngineering($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTotalFastenerRetention($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setTotalPayable($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setPrepayment($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setApplyPayment($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCreatedAt($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setUpdatedAt($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EngineeringSettlementPeer::DATABASE_NAME);

		if ($this->isColumnModified(EngineeringSettlementPeer::ID)) $criteria->add(EngineeringSettlementPeer::ID, $this->id);
		if ($this->isColumnModified(EngineeringSettlementPeer::APPLICATION_ID)) $criteria->add(EngineeringSettlementPeer::APPLICATION_ID, $this->application_id);
		if ($this->isColumnModified(EngineeringSettlementPeer::CONTRACT_NUMBER)) $criteria->add(EngineeringSettlementPeer::CONTRACT_NUMBER, $this->contract_number);
		if ($this->isColumnModified(EngineeringSettlementPeer::CONSTRUCTION_UNIT)) $criteria->add(EngineeringSettlementPeer::CONSTRUCTION_UNIT, $this->construction_unit);
		if ($this->isColumnModified(EngineeringSettlementPeer::EXPIRATION_DATE)) $criteria->add(EngineeringSettlementPeer::EXPIRATION_DATE, $this->expiration_date);
		if ($this->isColumnModified(EngineeringSettlementPeer::ISSUE)) $criteria->add(EngineeringSettlementPeer::ISSUE, $this->issue);
		if ($this->isColumnModified(EngineeringSettlementPeer::CONTRACT_AMOUNT)) $criteria->add(EngineeringSettlementPeer::CONTRACT_AMOUNT, $this->contract_amount);
		if ($this->isColumnModified(EngineeringSettlementPeer::CHANGE_AMOUNT)) $criteria->add(EngineeringSettlementPeer::CHANGE_AMOUNT, $this->change_amount);
		if ($this->isColumnModified(EngineeringSettlementPeer::CHANGED_AMOUNT)) $criteria->add(EngineeringSettlementPeer::CHANGED_AMOUNT, $this->changed_amount);
		if ($this->isColumnModified(EngineeringSettlementPeer::CURRENT_COMPLETE_ENGINEERING)) $criteria->add(EngineeringSettlementPeer::CURRENT_COMPLETE_ENGINEERING, $this->current_complete_engineering);
		if ($this->isColumnModified(EngineeringSettlementPeer::CURRENT_FASTENER_RETENTION)) $criteria->add(EngineeringSettlementPeer::CURRENT_FASTENER_RETENTION, $this->current_fastener_retention);
		if ($this->isColumnModified(EngineeringSettlementPeer::CURRENT_PAYABLE)) $criteria->add(EngineeringSettlementPeer::CURRENT_PAYABLE, $this->current_payable);
		if ($this->isColumnModified(EngineeringSettlementPeer::TOTAL_COMPLETE_ENGINEERING)) $criteria->add(EngineeringSettlementPeer::TOTAL_COMPLETE_ENGINEERING, $this->total_complete_engineering);
		if ($this->isColumnModified(EngineeringSettlementPeer::TOTAL_FASTENER_RETENTION)) $criteria->add(EngineeringSettlementPeer::TOTAL_FASTENER_RETENTION, $this->total_fastener_retention);
		if ($this->isColumnModified(EngineeringSettlementPeer::TOTAL_PAYABLE)) $criteria->add(EngineeringSettlementPeer::TOTAL_PAYABLE, $this->total_payable);
		if ($this->isColumnModified(EngineeringSettlementPeer::PREPAYMENT)) $criteria->add(EngineeringSettlementPeer::PREPAYMENT, $this->prepayment);
		if ($this->isColumnModified(EngineeringSettlementPeer::APPLY_PAYMENT)) $criteria->add(EngineeringSettlementPeer::APPLY_PAYMENT, $this->apply_payment);
		if ($this->isColumnModified(EngineeringSettlementPeer::CREATED_AT)) $criteria->add(EngineeringSettlementPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EngineeringSettlementPeer::UPDATED_AT)) $criteria->add(EngineeringSettlementPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EngineeringSettlementPeer::DATABASE_NAME);

		$criteria->add(EngineeringSettlementPeer::ID, $this->id);

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

		$copyObj->setContractNumber($this->contract_number);

		$copyObj->setConstructionUnit($this->construction_unit);

		$copyObj->setExpirationDate($this->expiration_date);

		$copyObj->setIssue($this->issue);

		$copyObj->setContractAmount($this->contract_amount);

		$copyObj->setChangeAmount($this->change_amount);

		$copyObj->setChangedAmount($this->changed_amount);

		$copyObj->setCurrentCompleteEngineering($this->current_complete_engineering);

		$copyObj->setCurrentFastenerRetention($this->current_fastener_retention);

		$copyObj->setCurrentPayable($this->current_payable);

		$copyObj->setTotalCompleteEngineering($this->total_complete_engineering);

		$copyObj->setTotalFastenerRetention($this->total_fastener_retention);

		$copyObj->setTotalPayable($this->total_payable);

		$copyObj->setPrepayment($this->prepayment);

		$copyObj->setApplyPayment($this->apply_payment);

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
			self::$peer = new EngineeringSettlementPeer();
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

} 