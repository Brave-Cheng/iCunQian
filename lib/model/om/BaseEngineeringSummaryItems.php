<?php


abstract class BaseEngineeringSummaryItems extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $engineering_summary_id;


	
	protected $project_content;


	
	protected $contract_quantity;


	
	protected $float_quantity;


	
	protected $current_finish_amount;


	
	protected $last_finish_amount;


	
	protected $finish_amount;


	
	protected $finish_percent;


	
	protected $comment;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aEngineeringSummary;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEngineeringSummaryId()
	{

		return $this->engineering_summary_id;
	}

	
	public function getProjectContent()
	{

		return $this->project_content;
	}

	
	public function getContractQuantity()
	{

		return $this->contract_quantity;
	}

	
	public function getFloatQuantity()
	{

		return $this->float_quantity;
	}

	
	public function getCurrentFinishAmount()
	{

		return $this->current_finish_amount;
	}

	
	public function getLastFinishAmount()
	{

		return $this->last_finish_amount;
	}

	
	public function getFinishAmount()
	{

		return $this->finish_amount;
	}

	
	public function getFinishPercent()
	{

		return $this->finish_percent;
	}

	
	public function getComment()
	{

		return $this->comment;
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
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::ID;
		}

	} 
	
	public function setEngineeringSummaryId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->engineering_summary_id !== $v) {
			$this->engineering_summary_id = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID;
		}

		if ($this->aEngineeringSummary !== null && $this->aEngineeringSummary->getId() !== $v) {
			$this->aEngineeringSummary = null;
		}

	} 
	
	public function setProjectContent($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->project_content !== $v) {
			$this->project_content = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::PROJECT_CONTENT;
		}

	} 
	
	public function setContractQuantity($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contract_quantity !== $v) {
			$this->contract_quantity = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::CONTRACT_QUANTITY;
		}

	} 
	
	public function setFloatQuantity($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->float_quantity !== $v) {
			$this->float_quantity = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::FLOAT_QUANTITY;
		}

	} 
	
	public function setCurrentFinishAmount($v)
	{

		if ($this->current_finish_amount !== $v) {
			$this->current_finish_amount = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::CURRENT_FINISH_AMOUNT;
		}

	} 
	
	public function setLastFinishAmount($v)
	{

		if ($this->last_finish_amount !== $v) {
			$this->last_finish_amount = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::LAST_FINISH_AMOUNT;
		}

	} 
	
	public function setFinishAmount($v)
	{

		if ($this->finish_amount !== $v) {
			$this->finish_amount = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::FINISH_AMOUNT;
		}

	} 
	
	public function setFinishPercent($v)
	{

		if ($this->finish_percent !== $v) {
			$this->finish_percent = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::FINISH_PERCENT;
		}

	} 
	
	public function setComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::COMMENT;
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
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EngineeringSummaryItemsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->engineering_summary_id = $rs->getInt($startcol + 1);

			$this->project_content = $rs->getString($startcol + 2);

			$this->contract_quantity = $rs->getString($startcol + 3);

			$this->float_quantity = $rs->getString($startcol + 4);

			$this->current_finish_amount = $rs->getFloat($startcol + 5);

			$this->last_finish_amount = $rs->getFloat($startcol + 6);

			$this->finish_amount = $rs->getFloat($startcol + 7);

			$this->finish_percent = $rs->getFloat($startcol + 8);

			$this->comment = $rs->getString($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EngineeringSummaryItems object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringSummaryItemsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EngineeringSummaryItemsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EngineeringSummaryItemsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EngineeringSummaryItemsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringSummaryItemsPeer::DATABASE_NAME);
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


												
			if ($this->aEngineeringSummary !== null) {
				if ($this->aEngineeringSummary->isModified()) {
					$affectedRows += $this->aEngineeringSummary->save($con);
				}
				$this->setEngineeringSummary($this->aEngineeringSummary);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EngineeringSummaryItemsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EngineeringSummaryItemsPeer::doUpdate($this, $con);
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


												
			if ($this->aEngineeringSummary !== null) {
				if (!$this->aEngineeringSummary->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEngineeringSummary->getValidationFailures());
				}
			}


			if (($retval = EngineeringSummaryItemsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringSummaryItemsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEngineeringSummaryId();
				break;
			case 2:
				return $this->getProjectContent();
				break;
			case 3:
				return $this->getContractQuantity();
				break;
			case 4:
				return $this->getFloatQuantity();
				break;
			case 5:
				return $this->getCurrentFinishAmount();
				break;
			case 6:
				return $this->getLastFinishAmount();
				break;
			case 7:
				return $this->getFinishAmount();
				break;
			case 8:
				return $this->getFinishPercent();
				break;
			case 9:
				return $this->getComment();
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
		$keys = EngineeringSummaryItemsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEngineeringSummaryId(),
			$keys[2] => $this->getProjectContent(),
			$keys[3] => $this->getContractQuantity(),
			$keys[4] => $this->getFloatQuantity(),
			$keys[5] => $this->getCurrentFinishAmount(),
			$keys[6] => $this->getLastFinishAmount(),
			$keys[7] => $this->getFinishAmount(),
			$keys[8] => $this->getFinishPercent(),
			$keys[9] => $this->getComment(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringSummaryItemsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEngineeringSummaryId($value);
				break;
			case 2:
				$this->setProjectContent($value);
				break;
			case 3:
				$this->setContractQuantity($value);
				break;
			case 4:
				$this->setFloatQuantity($value);
				break;
			case 5:
				$this->setCurrentFinishAmount($value);
				break;
			case 6:
				$this->setLastFinishAmount($value);
				break;
			case 7:
				$this->setFinishAmount($value);
				break;
			case 8:
				$this->setFinishPercent($value);
				break;
			case 9:
				$this->setComment($value);
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
		$keys = EngineeringSummaryItemsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEngineeringSummaryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProjectContent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContractQuantity($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFloatQuantity($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCurrentFinishAmount($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastFinishAmount($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setFinishAmount($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setFinishPercent($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setComment($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EngineeringSummaryItemsPeer::DATABASE_NAME);

		if ($this->isColumnModified(EngineeringSummaryItemsPeer::ID)) $criteria->add(EngineeringSummaryItemsPeer::ID, $this->id);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID)) $criteria->add(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, $this->engineering_summary_id);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::PROJECT_CONTENT)) $criteria->add(EngineeringSummaryItemsPeer::PROJECT_CONTENT, $this->project_content);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::CONTRACT_QUANTITY)) $criteria->add(EngineeringSummaryItemsPeer::CONTRACT_QUANTITY, $this->contract_quantity);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::FLOAT_QUANTITY)) $criteria->add(EngineeringSummaryItemsPeer::FLOAT_QUANTITY, $this->float_quantity);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::CURRENT_FINISH_AMOUNT)) $criteria->add(EngineeringSummaryItemsPeer::CURRENT_FINISH_AMOUNT, $this->current_finish_amount);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::LAST_FINISH_AMOUNT)) $criteria->add(EngineeringSummaryItemsPeer::LAST_FINISH_AMOUNT, $this->last_finish_amount);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::FINISH_AMOUNT)) $criteria->add(EngineeringSummaryItemsPeer::FINISH_AMOUNT, $this->finish_amount);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::FINISH_PERCENT)) $criteria->add(EngineeringSummaryItemsPeer::FINISH_PERCENT, $this->finish_percent);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::COMMENT)) $criteria->add(EngineeringSummaryItemsPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::CREATED_AT)) $criteria->add(EngineeringSummaryItemsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EngineeringSummaryItemsPeer::UPDATED_AT)) $criteria->add(EngineeringSummaryItemsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EngineeringSummaryItemsPeer::DATABASE_NAME);

		$criteria->add(EngineeringSummaryItemsPeer::ID, $this->id);

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

		$copyObj->setEngineeringSummaryId($this->engineering_summary_id);

		$copyObj->setProjectContent($this->project_content);

		$copyObj->setContractQuantity($this->contract_quantity);

		$copyObj->setFloatQuantity($this->float_quantity);

		$copyObj->setCurrentFinishAmount($this->current_finish_amount);

		$copyObj->setLastFinishAmount($this->last_finish_amount);

		$copyObj->setFinishAmount($this->finish_amount);

		$copyObj->setFinishPercent($this->finish_percent);

		$copyObj->setComment($this->comment);

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
			self::$peer = new EngineeringSummaryItemsPeer();
		}
		return self::$peer;
	}

	
	public function setEngineeringSummary($v)
	{


		if ($v === null) {
			$this->setEngineeringSummaryId(NULL);
		} else {
			$this->setEngineeringSummaryId($v->getId());
		}


		$this->aEngineeringSummary = $v;
	}


	
	public function getEngineeringSummary($con = null)
	{
		if ($this->aEngineeringSummary === null && ($this->engineering_summary_id !== null)) {
						include_once 'lib/model/om/BaseEngineeringSummaryPeer.php';

			$this->aEngineeringSummary = EngineeringSummaryPeer::retrieveByPK($this->engineering_summary_id, $con);

			
		}
		return $this->aEngineeringSummary;
	}

} 