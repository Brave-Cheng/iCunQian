<?php


abstract class BaseProject extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $type;


	
	protected $phase;


	
	protected $name;


	
	protected $long_name;


	
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


	
	protected $creator = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collProjectMembers;

	
	protected $lastProjectMemberCriteria = null;

	
	protected $collProjectHistorys;

	
	protected $lastProjectHistoryCriteria = null;

	
	protected $collProjectDocuments;

	
	protected $lastProjectDocumentCriteria = null;

	
	protected $collMilestones;

	
	protected $lastMilestoneCriteria = null;

	
	protected $collDailyReports;

	
	protected $lastDailyReportCriteria = null;

	
	protected $collSignIns;

	
	protected $lastSignInCriteria = null;

	
	protected $collApplications;

	
	protected $lastApplicationCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
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

	
	public function getLongName()
	{

		return $this->long_name;
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

	
	public function getCreator()
	{

		return $this->creator;
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
			$this->modifiedColumns[] = ProjectPeer::ID;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = ProjectPeer::TYPE;
		}

	} 
	
	public function setPhase($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->phase !== $v) {
			$this->phase = $v;
			$this->modifiedColumns[] = ProjectPeer::PHASE;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ProjectPeer::NAME;
		}

	} 
	
	public function setLongName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->long_name !== $v) {
			$this->long_name = $v;
			$this->modifiedColumns[] = ProjectPeer::LONG_NAME;
		}

	} 
	
	public function setProprietor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->proprietor !== $v) {
			$this->proprietor = $v;
			$this->modifiedColumns[] = ProjectPeer::PROPRIETOR;
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
			$this->modifiedColumns[] = ProjectPeer::START_DATE;
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
			$this->modifiedColumns[] = ProjectPeer::END_DATE;
		}

	} 
	
	public function setIsBuyTheTenderDocument($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_buy_the_tender_document !== $v) {
			$this->is_buy_the_tender_document = $v;
			$this->modifiedColumns[] = ProjectPeer::IS_BUY_THE_TENDER_DOCUMENT;
		}

	} 
	
	public function setTenderDocumentPrice($v)
	{

		if ($this->tender_document_price !== $v) {
			$this->tender_document_price = $v;
			$this->modifiedColumns[] = ProjectPeer::TENDER_DOCUMENT_PRICE;
		}

	} 
	
	public function setTenderingStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tendering_status !== $v) {
			$this->tendering_status = $v;
			$this->modifiedColumns[] = ProjectPeer::TENDERING_STATUS;
		}

	} 
	
	public function setBlockNumber($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->block_number !== $v) {
			$this->block_number = $v;
			$this->modifiedColumns[] = ProjectPeer::BLOCK_NUMBER;
		}

	} 
	
	public function setComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = ProjectPeer::COMMENT;
		}

	} 
	
	public function setIsProjectEnd($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_project_end !== $v) {
			$this->is_project_end = $v;
			$this->modifiedColumns[] = ProjectPeer::IS_PROJECT_END;
		}

	} 
	
	public function setProjectEndComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->project_end_comment !== $v) {
			$this->project_end_comment = $v;
			$this->modifiedColumns[] = ProjectPeer::PROJECT_END_COMMENT;
		}

	} 
	
	public function setModifier($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->modifier !== $v || $v === 0) {
			$this->modifier = $v;
			$this->modifiedColumns[] = ProjectPeer::MODIFIER;
		}

	} 
	
	public function setCreator($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->creator !== $v || $v === 0) {
			$this->creator = $v;
			$this->modifiedColumns[] = ProjectPeer::CREATOR;
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
			$this->modifiedColumns[] = ProjectPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProjectPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->type = $rs->getInt($startcol + 1);

			$this->phase = $rs->getInt($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->long_name = $rs->getString($startcol + 4);

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

			$this->creator = $rs->getInt($startcol + 16);

			$this->created_at = $rs->getTimestamp($startcol + 17, null);

			$this->updated_at = $rs->getTimestamp($startcol + 18, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Project object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProjectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProjectPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ProjectPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProjectPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProjectPeer::DATABASE_NAME);
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
					$pk = ProjectPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProjectPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collProjectMembers !== null) {
				foreach($this->collProjectMembers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjectHistorys !== null) {
				foreach($this->collProjectHistorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjectDocuments !== null) {
				foreach($this->collProjectDocuments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMilestones !== null) {
				foreach($this->collMilestones as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDailyReports !== null) {
				foreach($this->collDailyReports as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSignIns !== null) {
				foreach($this->collSignIns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collApplications !== null) {
				foreach($this->collApplications as $referrerFK) {
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


			if (($retval = ProjectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProjectMembers !== null) {
					foreach($this->collProjectMembers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjectHistorys !== null) {
					foreach($this->collProjectHistorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjectDocuments !== null) {
					foreach($this->collProjectDocuments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMilestones !== null) {
					foreach($this->collMilestones as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDailyReports !== null) {
					foreach($this->collDailyReports as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSignIns !== null) {
					foreach($this->collSignIns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collApplications !== null) {
					foreach($this->collApplications as $referrerFK) {
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
		$pos = ProjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getType();
				break;
			case 2:
				return $this->getPhase();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getLongName();
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
				return $this->getCreator();
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
		$keys = ProjectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getType(),
			$keys[2] => $this->getPhase(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getLongName(),
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
			$keys[16] => $this->getCreator(),
			$keys[17] => $this->getCreatedAt(),
			$keys[18] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setType($value);
				break;
			case 2:
				$this->setPhase($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setLongName($value);
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
				$this->setCreator($value);
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
		$keys = ProjectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPhase($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLongName($arr[$keys[4]]);
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
		if (array_key_exists($keys[16], $arr)) $this->setCreator($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCreatedAt($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setUpdatedAt($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProjectPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProjectPeer::ID)) $criteria->add(ProjectPeer::ID, $this->id);
		if ($this->isColumnModified(ProjectPeer::TYPE)) $criteria->add(ProjectPeer::TYPE, $this->type);
		if ($this->isColumnModified(ProjectPeer::PHASE)) $criteria->add(ProjectPeer::PHASE, $this->phase);
		if ($this->isColumnModified(ProjectPeer::NAME)) $criteria->add(ProjectPeer::NAME, $this->name);
		if ($this->isColumnModified(ProjectPeer::LONG_NAME)) $criteria->add(ProjectPeer::LONG_NAME, $this->long_name);
		if ($this->isColumnModified(ProjectPeer::PROPRIETOR)) $criteria->add(ProjectPeer::PROPRIETOR, $this->proprietor);
		if ($this->isColumnModified(ProjectPeer::START_DATE)) $criteria->add(ProjectPeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(ProjectPeer::END_DATE)) $criteria->add(ProjectPeer::END_DATE, $this->end_date);
		if ($this->isColumnModified(ProjectPeer::IS_BUY_THE_TENDER_DOCUMENT)) $criteria->add(ProjectPeer::IS_BUY_THE_TENDER_DOCUMENT, $this->is_buy_the_tender_document);
		if ($this->isColumnModified(ProjectPeer::TENDER_DOCUMENT_PRICE)) $criteria->add(ProjectPeer::TENDER_DOCUMENT_PRICE, $this->tender_document_price);
		if ($this->isColumnModified(ProjectPeer::TENDERING_STATUS)) $criteria->add(ProjectPeer::TENDERING_STATUS, $this->tendering_status);
		if ($this->isColumnModified(ProjectPeer::BLOCK_NUMBER)) $criteria->add(ProjectPeer::BLOCK_NUMBER, $this->block_number);
		if ($this->isColumnModified(ProjectPeer::COMMENT)) $criteria->add(ProjectPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(ProjectPeer::IS_PROJECT_END)) $criteria->add(ProjectPeer::IS_PROJECT_END, $this->is_project_end);
		if ($this->isColumnModified(ProjectPeer::PROJECT_END_COMMENT)) $criteria->add(ProjectPeer::PROJECT_END_COMMENT, $this->project_end_comment);
		if ($this->isColumnModified(ProjectPeer::MODIFIER)) $criteria->add(ProjectPeer::MODIFIER, $this->modifier);
		if ($this->isColumnModified(ProjectPeer::CREATOR)) $criteria->add(ProjectPeer::CREATOR, $this->creator);
		if ($this->isColumnModified(ProjectPeer::CREATED_AT)) $criteria->add(ProjectPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProjectPeer::UPDATED_AT)) $criteria->add(ProjectPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProjectPeer::DATABASE_NAME);

		$criteria->add(ProjectPeer::ID, $this->id);

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

		$copyObj->setType($this->type);

		$copyObj->setPhase($this->phase);

		$copyObj->setName($this->name);

		$copyObj->setLongName($this->long_name);

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

		$copyObj->setCreator($this->creator);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProjectMembers() as $relObj) {
				$copyObj->addProjectMember($relObj->copy($deepCopy));
			}

			foreach($this->getProjectHistorys() as $relObj) {
				$copyObj->addProjectHistory($relObj->copy($deepCopy));
			}

			foreach($this->getProjectDocuments() as $relObj) {
				$copyObj->addProjectDocument($relObj->copy($deepCopy));
			}

			foreach($this->getMilestones() as $relObj) {
				$copyObj->addMilestone($relObj->copy($deepCopy));
			}

			foreach($this->getDailyReports() as $relObj) {
				$copyObj->addDailyReport($relObj->copy($deepCopy));
			}

			foreach($this->getSignIns() as $relObj) {
				$copyObj->addSignIn($relObj->copy($deepCopy));
			}

			foreach($this->getApplications() as $relObj) {
				$copyObj->addApplication($relObj->copy($deepCopy));
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
			self::$peer = new ProjectPeer();
		}
		return self::$peer;
	}

	
	public function initProjectMembers()
	{
		if ($this->collProjectMembers === null) {
			$this->collProjectMembers = array();
		}
	}

	
	public function getProjectMembers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProjectMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectMembers === null) {
			if ($this->isNew()) {
			   $this->collProjectMembers = array();
			} else {

				$criteria->add(ProjectMemberPeer::PROJECT_ID, $this->getId());

				ProjectMemberPeer::addSelectColumns($criteria);
				$this->collProjectMembers = ProjectMemberPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProjectMemberPeer::PROJECT_ID, $this->getId());

				ProjectMemberPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectMemberCriteria) || !$this->lastProjectMemberCriteria->equals($criteria)) {
					$this->collProjectMembers = ProjectMemberPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectMemberCriteria = $criteria;
		return $this->collProjectMembers;
	}

	
	public function countProjectMembers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProjectMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectMemberPeer::PROJECT_ID, $this->getId());

		return ProjectMemberPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProjectMember(ProjectMember $l)
	{
		$this->collProjectMembers[] = $l;
		$l->setProject($this);
	}


	
	public function getProjectMembersJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProjectMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectMembers === null) {
			if ($this->isNew()) {
				$this->collProjectMembers = array();
			} else {

				$criteria->add(ProjectMemberPeer::PROJECT_ID, $this->getId());

				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ProjectMemberPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastProjectMemberCriteria) || !$this->lastProjectMemberCriteria->equals($criteria)) {
				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastProjectMemberCriteria = $criteria;

		return $this->collProjectMembers;
	}


	
	public function getProjectMembersJoinProjectRole($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProjectMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectMembers === null) {
			if ($this->isNew()) {
				$this->collProjectMembers = array();
			} else {

				$criteria->add(ProjectMemberPeer::PROJECT_ID, $this->getId());

				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinProjectRole($criteria, $con);
			}
		} else {
									
			$criteria->add(ProjectMemberPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastProjectMemberCriteria) || !$this->lastProjectMemberCriteria->equals($criteria)) {
				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinProjectRole($criteria, $con);
			}
		}
		$this->lastProjectMemberCriteria = $criteria;

		return $this->collProjectMembers;
	}

	
	public function initProjectHistorys()
	{
		if ($this->collProjectHistorys === null) {
			$this->collProjectHistorys = array();
		}
	}

	
	public function getProjectHistorys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProjectHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectHistorys === null) {
			if ($this->isNew()) {
			   $this->collProjectHistorys = array();
			} else {

				$criteria->add(ProjectHistoryPeer::PROJECT_ID, $this->getId());

				ProjectHistoryPeer::addSelectColumns($criteria);
				$this->collProjectHistorys = ProjectHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProjectHistoryPeer::PROJECT_ID, $this->getId());

				ProjectHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectHistoryCriteria) || !$this->lastProjectHistoryCriteria->equals($criteria)) {
					$this->collProjectHistorys = ProjectHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectHistoryCriteria = $criteria;
		return $this->collProjectHistorys;
	}

	
	public function countProjectHistorys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProjectHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectHistoryPeer::PROJECT_ID, $this->getId());

		return ProjectHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProjectHistory(ProjectHistory $l)
	{
		$this->collProjectHistorys[] = $l;
		$l->setProject($this);
	}

	
	public function initProjectDocuments()
	{
		if ($this->collProjectDocuments === null) {
			$this->collProjectDocuments = array();
		}
	}

	
	public function getProjectDocuments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProjectDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectDocuments === null) {
			if ($this->isNew()) {
			   $this->collProjectDocuments = array();
			} else {

				$criteria->add(ProjectDocumentPeer::PROJECT_ID, $this->getId());

				ProjectDocumentPeer::addSelectColumns($criteria);
				$this->collProjectDocuments = ProjectDocumentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProjectDocumentPeer::PROJECT_ID, $this->getId());

				ProjectDocumentPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectDocumentCriteria) || !$this->lastProjectDocumentCriteria->equals($criteria)) {
					$this->collProjectDocuments = ProjectDocumentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectDocumentCriteria = $criteria;
		return $this->collProjectDocuments;
	}

	
	public function countProjectDocuments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProjectDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectDocumentPeer::PROJECT_ID, $this->getId());

		return ProjectDocumentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProjectDocument(ProjectDocument $l)
	{
		$this->collProjectDocuments[] = $l;
		$l->setProject($this);
	}


	
	public function getProjectDocumentsJoinDocument($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProjectDocumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectDocuments === null) {
			if ($this->isNew()) {
				$this->collProjectDocuments = array();
			} else {

				$criteria->add(ProjectDocumentPeer::PROJECT_ID, $this->getId());

				$this->collProjectDocuments = ProjectDocumentPeer::doSelectJoinDocument($criteria, $con);
			}
		} else {
									
			$criteria->add(ProjectDocumentPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastProjectDocumentCriteria) || !$this->lastProjectDocumentCriteria->equals($criteria)) {
				$this->collProjectDocuments = ProjectDocumentPeer::doSelectJoinDocument($criteria, $con);
			}
		}
		$this->lastProjectDocumentCriteria = $criteria;

		return $this->collProjectDocuments;
	}

	
	public function initMilestones()
	{
		if ($this->collMilestones === null) {
			$this->collMilestones = array();
		}
	}

	
	public function getMilestones($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMilestonePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMilestones === null) {
			if ($this->isNew()) {
			   $this->collMilestones = array();
			} else {

				$criteria->add(MilestonePeer::PROJECT_ID, $this->getId());

				MilestonePeer::addSelectColumns($criteria);
				$this->collMilestones = MilestonePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MilestonePeer::PROJECT_ID, $this->getId());

				MilestonePeer::addSelectColumns($criteria);
				if (!isset($this->lastMilestoneCriteria) || !$this->lastMilestoneCriteria->equals($criteria)) {
					$this->collMilestones = MilestonePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMilestoneCriteria = $criteria;
		return $this->collMilestones;
	}

	
	public function countMilestones($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMilestonePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MilestonePeer::PROJECT_ID, $this->getId());

		return MilestonePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMilestone(Milestone $l)
	{
		$this->collMilestones[] = $l;
		$l->setProject($this);
	}

	
	public function initDailyReports()
	{
		if ($this->collDailyReports === null) {
			$this->collDailyReports = array();
		}
	}

	
	public function getDailyReports($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDailyReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDailyReports === null) {
			if ($this->isNew()) {
			   $this->collDailyReports = array();
			} else {

				$criteria->add(DailyReportPeer::PROJECT_ID, $this->getId());

				DailyReportPeer::addSelectColumns($criteria);
				$this->collDailyReports = DailyReportPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DailyReportPeer::PROJECT_ID, $this->getId());

				DailyReportPeer::addSelectColumns($criteria);
				if (!isset($this->lastDailyReportCriteria) || !$this->lastDailyReportCriteria->equals($criteria)) {
					$this->collDailyReports = DailyReportPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDailyReportCriteria = $criteria;
		return $this->collDailyReports;
	}

	
	public function countDailyReports($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDailyReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DailyReportPeer::PROJECT_ID, $this->getId());

		return DailyReportPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDailyReport(DailyReport $l)
	{
		$this->collDailyReports[] = $l;
		$l->setProject($this);
	}


	
	public function getDailyReportsJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDailyReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDailyReports === null) {
			if ($this->isNew()) {
				$this->collDailyReports = array();
			} else {

				$criteria->add(DailyReportPeer::PROJECT_ID, $this->getId());

				$this->collDailyReports = DailyReportPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(DailyReportPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastDailyReportCriteria) || !$this->lastDailyReportCriteria->equals($criteria)) {
				$this->collDailyReports = DailyReportPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastDailyReportCriteria = $criteria;

		return $this->collDailyReports;
	}

	
	public function initSignIns()
	{
		if ($this->collSignIns === null) {
			$this->collSignIns = array();
		}
	}

	
	public function getSignIns($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSignInPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSignIns === null) {
			if ($this->isNew()) {
			   $this->collSignIns = array();
			} else {

				$criteria->add(SignInPeer::PROJECT_ID, $this->getId());

				SignInPeer::addSelectColumns($criteria);
				$this->collSignIns = SignInPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SignInPeer::PROJECT_ID, $this->getId());

				SignInPeer::addSelectColumns($criteria);
				if (!isset($this->lastSignInCriteria) || !$this->lastSignInCriteria->equals($criteria)) {
					$this->collSignIns = SignInPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSignInCriteria = $criteria;
		return $this->collSignIns;
	}

	
	public function countSignIns($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSignInPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SignInPeer::PROJECT_ID, $this->getId());

		return SignInPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSignIn(SignIn $l)
	{
		$this->collSignIns[] = $l;
		$l->setProject($this);
	}


	
	public function getSignInsJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSignInPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSignIns === null) {
			if ($this->isNew()) {
				$this->collSignIns = array();
			} else {

				$criteria->add(SignInPeer::PROJECT_ID, $this->getId());

				$this->collSignIns = SignInPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(SignInPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSignInCriteria) || !$this->lastSignInCriteria->equals($criteria)) {
				$this->collSignIns = SignInPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastSignInCriteria = $criteria;

		return $this->collSignIns;
	}

	
	public function initApplications()
	{
		if ($this->collApplications === null) {
			$this->collApplications = array();
		}
	}

	
	public function getApplications($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplications === null) {
			if ($this->isNew()) {
			   $this->collApplications = array();
			} else {

				$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

				ApplicationPeer::addSelectColumns($criteria);
				$this->collApplications = ApplicationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

				ApplicationPeer::addSelectColumns($criteria);
				if (!isset($this->lastApplicationCriteria) || !$this->lastApplicationCriteria->equals($criteria)) {
					$this->collApplications = ApplicationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastApplicationCriteria = $criteria;
		return $this->collApplications;
	}

	
	public function countApplications($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

		return ApplicationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addApplication(Application $l)
	{
		$this->collApplications[] = $l;
		$l->setProject($this);
	}


	
	public function getApplicationsJoinApproval($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplications === null) {
			if ($this->isNew()) {
				$this->collApplications = array();
			} else {

				$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

				$this->collApplications = ApplicationPeer::doSelectJoinApproval($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastApplicationCriteria) || !$this->lastApplicationCriteria->equals($criteria)) {
				$this->collApplications = ApplicationPeer::doSelectJoinApproval($criteria, $con);
			}
		}
		$this->lastApplicationCriteria = $criteria;

		return $this->collApplications;
	}


	
	public function getApplicationsJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplications === null) {
			if ($this->isNew()) {
				$this->collApplications = array();
			} else {

				$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

				$this->collApplications = ApplicationPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastApplicationCriteria) || !$this->lastApplicationCriteria->equals($criteria)) {
				$this->collApplications = ApplicationPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastApplicationCriteria = $criteria;

		return $this->collApplications;
	}


	
	public function getApplicationsJoinDepartment($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplications === null) {
			if ($this->isNew()) {
				$this->collApplications = array();
			} else {

				$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

				$this->collApplications = ApplicationPeer::doSelectJoinDepartment($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastApplicationCriteria) || !$this->lastApplicationCriteria->equals($criteria)) {
				$this->collApplications = ApplicationPeer::doSelectJoinDepartment($criteria, $con);
			}
		}
		$this->lastApplicationCriteria = $criteria;

		return $this->collApplications;
	}

} 