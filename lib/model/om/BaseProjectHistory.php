<?php


abstract class BaseProjectHistory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $project_id;


	
	protected $type;


	
	protected $phase;


	
	protected $name;


	
	protected $proprietor;


	
	protected $start_date;


	
	protected $end_date;


	
	protected $is_buy_the_tender_document;


	
	protected $tender_document_price;


	
	protected $tendering_status;


	
	protected $block_number;


	
	protected $comment;


	
	protected $is_project_end;


	
	protected $project_end_comment;


	
	protected $modifier = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aProject;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getProjectId()
	{

		return $this->project_id;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getPhase()
	{

		return $this->phase;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getProprietor()
	{

		return $this->proprietor;
	}

	
	public function getStartDate($format = 'Y-m-d H:i:s')
	{

		if ($this->start_date === null || $this->start_date === '') {
			return null;
		} elseif (!is_int($this->start_date)) {
						$ts = strtotime($this->start_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [start_date] as date/time value: " . var_export($this->start_date, true));
			}
		} else {
			$ts = $this->start_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEndDate($format = 'Y-m-d H:i:s')
	{

		if ($this->end_date === null || $this->end_date === '') {
			return null;
		} elseif (!is_int($this->end_date)) {
						$ts = strtotime($this->end_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [end_date] as date/time value: " . var_export($this->end_date, true));
			}
		} else {
			$ts = $this->end_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsBuyTheTenderDocument()
	{

		return $this->is_buy_the_tender_document;
	}

	
	public function getTenderDocumentPrice()
	{

		return $this->tender_document_price;
	}

	
	public function getTenderingStatus()
	{

		return $this->tendering_status;
	}

	
	public function getBlockNumber()
	{

		return $this->block_number;
	}

	
	public function getComment()
	{

		return $this->comment;
	}

	
	public function getIsProjectEnd()
	{

		return $this->is_project_end;
	}

	
	public function getProjectEndComment()
	{

		return $this->project_end_comment;
	}

	
	public function getModifier()
	{

		return $this->modifier;
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
			$this->modifiedColumns[] = ProjectHistoryPeer::ID;
		}

	} 
	
	public function setProjectId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->project_id !== $v) {
			$this->project_id = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::PROJECT_ID;
		}

		if ($this->aProject !== null && $this->aProject->getId() !== $v) {
			$this->aProject = null;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::TYPE;
		}

	} 
	
	public function setPhase($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->phase !== $v) {
			$this->phase = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::PHASE;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::NAME;
		}

	} 
	
	public function setProprietor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->proprietor !== $v) {
			$this->proprietor = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::PROPRIETOR;
		}

	} 
	
	public function setStartDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [start_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->start_date !== $ts) {
			$this->start_date = $ts;
			$this->modifiedColumns[] = ProjectHistoryPeer::START_DATE;
		}

	} 
	
	public function setEndDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [end_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->end_date !== $ts) {
			$this->end_date = $ts;
			$this->modifiedColumns[] = ProjectHistoryPeer::END_DATE;
		}

	} 
	
	public function setIsBuyTheTenderDocument($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_buy_the_tender_document !== $v) {
			$this->is_buy_the_tender_document = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::IS_BUY_THE_TENDER_DOCUMENT;
		}

	} 
	
	public function setTenderDocumentPrice($v)
	{

		if ($this->tender_document_price !== $v) {
			$this->tender_document_price = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::TENDER_DOCUMENT_PRICE;
		}

	} 
	
	public function setTenderingStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tendering_status !== $v) {
			$this->tendering_status = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::TENDERING_STATUS;
		}

	} 
	
	public function setBlockNumber($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->block_number !== $v) {
			$this->block_number = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::BLOCK_NUMBER;
		}

	} 
	
	public function setComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::COMMENT;
		}

	} 
	
	public function setIsProjectEnd($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_project_end !== $v) {
			$this->is_project_end = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::IS_PROJECT_END;
		}

	} 
	
	public function setProjectEndComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->project_end_comment !== $v) {
			$this->project_end_comment = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::PROJECT_END_COMMENT;
		}

	} 
	
	public function setModifier($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->modifier !== $v || $v === 0) {
			$this->modifier = $v;
			$this->modifiedColumns[] = ProjectHistoryPeer::MODIFIER;
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
			$this->modifiedColumns[] = ProjectHistoryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProjectHistoryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->project_id = $rs->getInt($startcol + 1);

			$this->type = $rs->getInt($startcol + 2);

			$this->phase = $rs->getInt($startcol + 3);

			$this->name = $rs->getString($startcol + 4);

			$this->proprietor = $rs->getString($startcol + 5);

			$this->start_date = $rs->getTimestamp($startcol + 6, null);

			$this->end_date = $rs->getTimestamp($startcol + 7, null);

			$this->is_buy_the_tender_document = $rs->getInt($startcol + 8);

			$this->tender_document_price = $rs->getFloat($startcol + 9);

			$this->tendering_status = $rs->getString($startcol + 10);

			$this->block_number = $rs->getString($startcol + 11);

			$this->comment = $rs->getString($startcol + 12);

			$this->is_project_end = $rs->getInt($startcol + 13);

			$this->project_end_comment = $rs->getString($startcol + 14);

			$this->modifier = $rs->getInt($startcol + 15);

			$this->created_at = $rs->getTimestamp($startcol + 16, null);

			$this->updated_at = $rs->getTimestamp($startcol + 17, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ProjectHistory object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProjectHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProjectHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ProjectHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProjectHistoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProjectHistoryPeer::DATABASE_NAME);
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


												
			if ($this->aProject !== null) {
				if ($this->aProject->isModified()) {
					$affectedRows += $this->aProject->save($con);
				}
				$this->setProject($this->aProject);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProjectHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProjectHistoryPeer::doUpdate($this, $con);
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


												
			if ($this->aProject !== null) {
				if (!$this->aProject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProject->getValidationFailures());
				}
			}


			if (($retval = ProjectHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProjectHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getProjectId();
				break;
			case 2:
				return $this->getType();
				break;
			case 3:
				return $this->getPhase();
				break;
			case 4:
				return $this->getName();
				break;
			case 5:
				return $this->getProprietor();
				break;
			case 6:
				return $this->getStartDate();
				break;
			case 7:
				return $this->getEndDate();
				break;
			case 8:
				return $this->getIsBuyTheTenderDocument();
				break;
			case 9:
				return $this->getTenderDocumentPrice();
				break;
			case 10:
				return $this->getTenderingStatus();
				break;
			case 11:
				return $this->getBlockNumber();
				break;
			case 12:
				return $this->getComment();
				break;
			case 13:
				return $this->getIsProjectEnd();
				break;
			case 14:
				return $this->getProjectEndComment();
				break;
			case 15:
				return $this->getModifier();
				break;
			case 16:
				return $this->getCreatedAt();
				break;
			case 17:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProjectHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProjectId(),
			$keys[2] => $this->getType(),
			$keys[3] => $this->getPhase(),
			$keys[4] => $this->getName(),
			$keys[5] => $this->getProprietor(),
			$keys[6] => $this->getStartDate(),
			$keys[7] => $this->getEndDate(),
			$keys[8] => $this->getIsBuyTheTenderDocument(),
			$keys[9] => $this->getTenderDocumentPrice(),
			$keys[10] => $this->getTenderingStatus(),
			$keys[11] => $this->getBlockNumber(),
			$keys[12] => $this->getComment(),
			$keys[13] => $this->getIsProjectEnd(),
			$keys[14] => $this->getProjectEndComment(),
			$keys[15] => $this->getModifier(),
			$keys[16] => $this->getCreatedAt(),
			$keys[17] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProjectHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setProjectId($value);
				break;
			case 2:
				$this->setType($value);
				break;
			case 3:
				$this->setPhase($value);
				break;
			case 4:
				$this->setName($value);
				break;
			case 5:
				$this->setProprietor($value);
				break;
			case 6:
				$this->setStartDate($value);
				break;
			case 7:
				$this->setEndDate($value);
				break;
			case 8:
				$this->setIsBuyTheTenderDocument($value);
				break;
			case 9:
				$this->setTenderDocumentPrice($value);
				break;
			case 10:
				$this->setTenderingStatus($value);
				break;
			case 11:
				$this->setBlockNumber($value);
				break;
			case 12:
				$this->setComment($value);
				break;
			case 13:
				$this->setIsProjectEnd($value);
				break;
			case 14:
				$this->setProjectEndComment($value);
				break;
			case 15:
				$this->setModifier($value);
				break;
			case 16:
				$this->setCreatedAt($value);
				break;
			case 17:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProjectHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProjectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPhase($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setProprietor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStartDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEndDate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsBuyTheTenderDocument($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTenderDocumentPrice($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTenderingStatus($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setBlockNumber($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setComment($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsProjectEnd($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setProjectEndComment($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setModifier($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUpdatedAt($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProjectHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProjectHistoryPeer::ID)) $criteria->add(ProjectHistoryPeer::ID, $this->id);
		if ($this->isColumnModified(ProjectHistoryPeer::PROJECT_ID)) $criteria->add(ProjectHistoryPeer::PROJECT_ID, $this->project_id);
		if ($this->isColumnModified(ProjectHistoryPeer::TYPE)) $criteria->add(ProjectHistoryPeer::TYPE, $this->type);
		if ($this->isColumnModified(ProjectHistoryPeer::PHASE)) $criteria->add(ProjectHistoryPeer::PHASE, $this->phase);
		if ($this->isColumnModified(ProjectHistoryPeer::NAME)) $criteria->add(ProjectHistoryPeer::NAME, $this->name);
		if ($this->isColumnModified(ProjectHistoryPeer::PROPRIETOR)) $criteria->add(ProjectHistoryPeer::PROPRIETOR, $this->proprietor);
		if ($this->isColumnModified(ProjectHistoryPeer::START_DATE)) $criteria->add(ProjectHistoryPeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(ProjectHistoryPeer::END_DATE)) $criteria->add(ProjectHistoryPeer::END_DATE, $this->end_date);
		if ($this->isColumnModified(ProjectHistoryPeer::IS_BUY_THE_TENDER_DOCUMENT)) $criteria->add(ProjectHistoryPeer::IS_BUY_THE_TENDER_DOCUMENT, $this->is_buy_the_tender_document);
		if ($this->isColumnModified(ProjectHistoryPeer::TENDER_DOCUMENT_PRICE)) $criteria->add(ProjectHistoryPeer::TENDER_DOCUMENT_PRICE, $this->tender_document_price);
		if ($this->isColumnModified(ProjectHistoryPeer::TENDERING_STATUS)) $criteria->add(ProjectHistoryPeer::TENDERING_STATUS, $this->tendering_status);
		if ($this->isColumnModified(ProjectHistoryPeer::BLOCK_NUMBER)) $criteria->add(ProjectHistoryPeer::BLOCK_NUMBER, $this->block_number);
		if ($this->isColumnModified(ProjectHistoryPeer::COMMENT)) $criteria->add(ProjectHistoryPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(ProjectHistoryPeer::IS_PROJECT_END)) $criteria->add(ProjectHistoryPeer::IS_PROJECT_END, $this->is_project_end);
		if ($this->isColumnModified(ProjectHistoryPeer::PROJECT_END_COMMENT)) $criteria->add(ProjectHistoryPeer::PROJECT_END_COMMENT, $this->project_end_comment);
		if ($this->isColumnModified(ProjectHistoryPeer::MODIFIER)) $criteria->add(ProjectHistoryPeer::MODIFIER, $this->modifier);
		if ($this->isColumnModified(ProjectHistoryPeer::CREATED_AT)) $criteria->add(ProjectHistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProjectHistoryPeer::UPDATED_AT)) $criteria->add(ProjectHistoryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProjectHistoryPeer::DATABASE_NAME);

		$criteria->add(ProjectHistoryPeer::ID, $this->id);

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

		$copyObj->setProjectId($this->project_id);

		$copyObj->setType($this->type);

		$copyObj->setPhase($this->phase);

		$copyObj->setName($this->name);

		$copyObj->setProprietor($this->proprietor);

		$copyObj->setStartDate($this->start_date);

		$copyObj->setEndDate($this->end_date);

		$copyObj->setIsBuyTheTenderDocument($this->is_buy_the_tender_document);

		$copyObj->setTenderDocumentPrice($this->tender_document_price);

		$copyObj->setTenderingStatus($this->tendering_status);

		$copyObj->setBlockNumber($this->block_number);

		$copyObj->setComment($this->comment);

		$copyObj->setIsProjectEnd($this->is_project_end);

		$copyObj->setProjectEndComment($this->project_end_comment);

		$copyObj->setModifier($this->modifier);

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
			self::$peer = new ProjectHistoryPeer();
		}
		return self::$peer;
	}

	
	public function setProject($v)
	{


		if ($v === null) {
			$this->setProjectId(NULL);
		} else {
			$this->setProjectId($v->getId());
		}


		$this->aProject = $v;
	}


	
	public function getProject($con = null)
	{
		if ($this->aProject === null && ($this->project_id !== null)) {
						include_once 'lib/model/om/BaseProjectPeer.php';

			$this->aProject = ProjectPeer::retrieveByPK($this->project_id, $con);

			
		}
		return $this->aProject;
	}

} 