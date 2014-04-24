<?php


abstract class BaseApplication extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $approval_id;


	
	protected $sf_guard_user_id;


	
	protected $project_id;


	
	protected $department_id;


	
	protected $name;


	
	protected $description;


	
	protected $attachment;


	
	protected $current_status;


	
	protected $is_valid;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aApproval;

	
	protected $asfGuardUser;

	
	protected $aProject;

	
	protected $aDepartment;

	
	protected $collApplicationWorkFlows;

	
	protected $lastApplicationWorkFlowCriteria = null;

	
	protected $collEngineeringSettlements;

	
	protected $lastEngineeringSettlementCriteria = null;

	
	protected $collEngineeringMaterialss;

	
	protected $lastEngineeringMaterialsCriteria = null;

	
	protected $collEngineeringSummarys;

	
	protected $lastEngineeringSummaryCriteria = null;

	
	protected $collEngineeringGoodss;

	
	protected $lastEngineeringGoodsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getApprovalId()
	{

		return $this->approval_id;
	}

	
	public function getSfGuardUserId()
	{

		return $this->sf_guard_user_id;
	}

	
	public function getProjectId()
	{

		return $this->project_id;
	}

	
	public function getDepartmentId()
	{

		return $this->department_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getAttachment()
	{

		return $this->attachment;
	}

	
	public function getCurrentStatus()
	{

		return $this->current_status;
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
			$this->modifiedColumns[] = ApplicationPeer::ID;
		}

	} 
	
	public function setApprovalId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->approval_id !== $v) {
			$this->approval_id = $v;
			$this->modifiedColumns[] = ApplicationPeer::APPROVAL_ID;
		}

		if ($this->aApproval !== null && $this->aApproval->getId() !== $v) {
			$this->aApproval = null;
		}

	} 
	
	public function setSfGuardUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sf_guard_user_id !== $v) {
			$this->sf_guard_user_id = $v;
			$this->modifiedColumns[] = ApplicationPeer::SF_GUARD_USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

	} 
	
	public function setProjectId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->project_id !== $v) {
			$this->project_id = $v;
			$this->modifiedColumns[] = ApplicationPeer::PROJECT_ID;
		}

		if ($this->aProject !== null && $this->aProject->getId() !== $v) {
			$this->aProject = null;
		}

	} 
	
	public function setDepartmentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->department_id !== $v) {
			$this->department_id = $v;
			$this->modifiedColumns[] = ApplicationPeer::DEPARTMENT_ID;
		}

		if ($this->aDepartment !== null && $this->aDepartment->getId() !== $v) {
			$this->aDepartment = null;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ApplicationPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ApplicationPeer::DESCRIPTION;
		}

	} 
	
	public function setAttachment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->attachment !== $v) {
			$this->attachment = $v;
			$this->modifiedColumns[] = ApplicationPeer::ATTACHMENT;
		}

	} 
	
	public function setCurrentStatus($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->current_status !== $v) {
			$this->current_status = $v;
			$this->modifiedColumns[] = ApplicationPeer::CURRENT_STATUS;
		}

	} 
	
	public function setIsValid($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_valid !== $v) {
			$this->is_valid = $v;
			$this->modifiedColumns[] = ApplicationPeer::IS_VALID;
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
			$this->modifiedColumns[] = ApplicationPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ApplicationPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->approval_id = $rs->getInt($startcol + 1);

			$this->sf_guard_user_id = $rs->getInt($startcol + 2);

			$this->project_id = $rs->getInt($startcol + 3);

			$this->department_id = $rs->getInt($startcol + 4);

			$this->name = $rs->getString($startcol + 5);

			$this->description = $rs->getString($startcol + 6);

			$this->attachment = $rs->getString($startcol + 7);

			$this->current_status = $rs->getInt($startcol + 8);

			$this->is_valid = $rs->getInt($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Application object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ApplicationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ApplicationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ApplicationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ApplicationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ApplicationPeer::DATABASE_NAME);
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


												
			if ($this->aApproval !== null) {
				if ($this->aApproval->isModified()) {
					$affectedRows += $this->aApproval->save($con);
				}
				$this->setApproval($this->aApproval);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->aProject !== null) {
				if ($this->aProject->isModified()) {
					$affectedRows += $this->aProject->save($con);
				}
				$this->setProject($this->aProject);
			}

			if ($this->aDepartment !== null) {
				if ($this->aDepartment->isModified()) {
					$affectedRows += $this->aDepartment->save($con);
				}
				$this->setDepartment($this->aDepartment);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ApplicationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ApplicationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collApplicationWorkFlows !== null) {
				foreach($this->collApplicationWorkFlows as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEngineeringSettlements !== null) {
				foreach($this->collEngineeringSettlements as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEngineeringMaterialss !== null) {
				foreach($this->collEngineeringMaterialss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEngineeringSummarys !== null) {
				foreach($this->collEngineeringSummarys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEngineeringGoodss !== null) {
				foreach($this->collEngineeringGoodss as $referrerFK) {
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


												
			if ($this->aApproval !== null) {
				if (!$this->aApproval->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aApproval->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aProject !== null) {
				if (!$this->aProject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProject->getValidationFailures());
				}
			}

			if ($this->aDepartment !== null) {
				if (!$this->aDepartment->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepartment->getValidationFailures());
				}
			}


			if (($retval = ApplicationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collApplicationWorkFlows !== null) {
					foreach($this->collApplicationWorkFlows as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEngineeringSettlements !== null) {
					foreach($this->collEngineeringSettlements as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEngineeringMaterialss !== null) {
					foreach($this->collEngineeringMaterialss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEngineeringSummarys !== null) {
					foreach($this->collEngineeringSummarys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEngineeringGoodss !== null) {
					foreach($this->collEngineeringGoodss as $referrerFK) {
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
		$pos = ApplicationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getApprovalId();
				break;
			case 2:
				return $this->getSfGuardUserId();
				break;
			case 3:
				return $this->getProjectId();
				break;
			case 4:
				return $this->getDepartmentId();
				break;
			case 5:
				return $this->getName();
				break;
			case 6:
				return $this->getDescription();
				break;
			case 7:
				return $this->getAttachment();
				break;
			case 8:
				return $this->getCurrentStatus();
				break;
			case 9:
				return $this->getIsValid();
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
		$keys = ApplicationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getApprovalId(),
			$keys[2] => $this->getSfGuardUserId(),
			$keys[3] => $this->getProjectId(),
			$keys[4] => $this->getDepartmentId(),
			$keys[5] => $this->getName(),
			$keys[6] => $this->getDescription(),
			$keys[7] => $this->getAttachment(),
			$keys[8] => $this->getCurrentStatus(),
			$keys[9] => $this->getIsValid(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ApplicationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setApprovalId($value);
				break;
			case 2:
				$this->setSfGuardUserId($value);
				break;
			case 3:
				$this->setProjectId($value);
				break;
			case 4:
				$this->setDepartmentId($value);
				break;
			case 5:
				$this->setName($value);
				break;
			case 6:
				$this->setDescription($value);
				break;
			case 7:
				$this->setAttachment($value);
				break;
			case 8:
				$this->setCurrentStatus($value);
				break;
			case 9:
				$this->setIsValid($value);
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
		$keys = ApplicationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setApprovalId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSfGuardUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setProjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDepartmentId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDescription($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAttachment($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCurrentStatus($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIsValid($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ApplicationPeer::DATABASE_NAME);

		if ($this->isColumnModified(ApplicationPeer::ID)) $criteria->add(ApplicationPeer::ID, $this->id);
		if ($this->isColumnModified(ApplicationPeer::APPROVAL_ID)) $criteria->add(ApplicationPeer::APPROVAL_ID, $this->approval_id);
		if ($this->isColumnModified(ApplicationPeer::SF_GUARD_USER_ID)) $criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->sf_guard_user_id);
		if ($this->isColumnModified(ApplicationPeer::PROJECT_ID)) $criteria->add(ApplicationPeer::PROJECT_ID, $this->project_id);
		if ($this->isColumnModified(ApplicationPeer::DEPARTMENT_ID)) $criteria->add(ApplicationPeer::DEPARTMENT_ID, $this->department_id);
		if ($this->isColumnModified(ApplicationPeer::NAME)) $criteria->add(ApplicationPeer::NAME, $this->name);
		if ($this->isColumnModified(ApplicationPeer::DESCRIPTION)) $criteria->add(ApplicationPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ApplicationPeer::ATTACHMENT)) $criteria->add(ApplicationPeer::ATTACHMENT, $this->attachment);
		if ($this->isColumnModified(ApplicationPeer::CURRENT_STATUS)) $criteria->add(ApplicationPeer::CURRENT_STATUS, $this->current_status);
		if ($this->isColumnModified(ApplicationPeer::IS_VALID)) $criteria->add(ApplicationPeer::IS_VALID, $this->is_valid);
		if ($this->isColumnModified(ApplicationPeer::CREATED_AT)) $criteria->add(ApplicationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ApplicationPeer::UPDATED_AT)) $criteria->add(ApplicationPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ApplicationPeer::DATABASE_NAME);

		$criteria->add(ApplicationPeer::ID, $this->id);

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

		$copyObj->setApprovalId($this->approval_id);

		$copyObj->setSfGuardUserId($this->sf_guard_user_id);

		$copyObj->setProjectId($this->project_id);

		$copyObj->setDepartmentId($this->department_id);

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setAttachment($this->attachment);

		$copyObj->setCurrentStatus($this->current_status);

		$copyObj->setIsValid($this->is_valid);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getApplicationWorkFlows() as $relObj) {
				$copyObj->addApplicationWorkFlow($relObj->copy($deepCopy));
			}

			foreach($this->getEngineeringSettlements() as $relObj) {
				$copyObj->addEngineeringSettlement($relObj->copy($deepCopy));
			}

			foreach($this->getEngineeringMaterialss() as $relObj) {
				$copyObj->addEngineeringMaterials($relObj->copy($deepCopy));
			}

			foreach($this->getEngineeringSummarys() as $relObj) {
				$copyObj->addEngineeringSummary($relObj->copy($deepCopy));
			}

			foreach($this->getEngineeringGoodss() as $relObj) {
				$copyObj->addEngineeringGoods($relObj->copy($deepCopy));
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
			self::$peer = new ApplicationPeer();
		}
		return self::$peer;
	}

	
	public function setApproval($v)
	{


		if ($v === null) {
			$this->setApprovalId(NULL);
		} else {
			$this->setApprovalId($v->getId());
		}


		$this->aApproval = $v;
	}


	
	public function getApproval($con = null)
	{
		if ($this->aApproval === null && ($this->approval_id !== null)) {
						include_once 'lib/model/om/BaseApprovalPeer.php';

			$this->aApproval = ApprovalPeer::retrieveByPK($this->approval_id, $con);

			
		}
		return $this->aApproval;
	}

	
	public function setsfGuardUser($v)
	{


		if ($v === null) {
			$this->setSfGuardUserId(NULL);
		} else {
			$this->setSfGuardUserId($v->getId());
		}


		$this->asfGuardUser = $v;
	}


	
	public function getsfGuardUser($con = null)
	{
		if ($this->asfGuardUser === null && ($this->sf_guard_user_id !== null)) {
						include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPeer.php';

			$this->asfGuardUser = sfGuardUserPeer::retrieveByPK($this->sf_guard_user_id, $con);

			
		}
		return $this->asfGuardUser;
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

	
	public function setDepartment($v)
	{


		if ($v === null) {
			$this->setDepartmentId(NULL);
		} else {
			$this->setDepartmentId($v->getId());
		}


		$this->aDepartment = $v;
	}


	
	public function getDepartment($con = null)
	{
		if ($this->aDepartment === null && ($this->department_id !== null)) {
						include_once 'lib/model/om/BaseDepartmentPeer.php';

			$this->aDepartment = DepartmentPeer::retrieveByPK($this->department_id, $con);

			
		}
		return $this->aDepartment;
	}

	
	public function initApplicationWorkFlows()
	{
		if ($this->collApplicationWorkFlows === null) {
			$this->collApplicationWorkFlows = array();
		}
	}

	
	public function getApplicationWorkFlows($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationWorkFlowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplicationWorkFlows === null) {
			if ($this->isNew()) {
			   $this->collApplicationWorkFlows = array();
			} else {

				$criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->getId());

				ApplicationWorkFlowPeer::addSelectColumns($criteria);
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->getId());

				ApplicationWorkFlowPeer::addSelectColumns($criteria);
				if (!isset($this->lastApplicationWorkFlowCriteria) || !$this->lastApplicationWorkFlowCriteria->equals($criteria)) {
					$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastApplicationWorkFlowCriteria = $criteria;
		return $this->collApplicationWorkFlows;
	}

	
	public function countApplicationWorkFlows($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationWorkFlowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->getId());

		return ApplicationWorkFlowPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addApplicationWorkFlow(ApplicationWorkFlow $l)
	{
		$this->collApplicationWorkFlows[] = $l;
		$l->setApplication($this);
	}


	
	public function getApplicationWorkFlowsJoinWorkflow($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationWorkFlowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplicationWorkFlows === null) {
			if ($this->isNew()) {
				$this->collApplicationWorkFlows = array();
			} else {

				$criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->getId());

				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinWorkflow($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->getId());

			if (!isset($this->lastApplicationWorkFlowCriteria) || !$this->lastApplicationWorkFlowCriteria->equals($criteria)) {
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinWorkflow($criteria, $con);
			}
		}
		$this->lastApplicationWorkFlowCriteria = $criteria;

		return $this->collApplicationWorkFlows;
	}


	
	public function getApplicationWorkFlowsJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseApplicationWorkFlowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplicationWorkFlows === null) {
			if ($this->isNew()) {
				$this->collApplicationWorkFlows = array();
			} else {

				$criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->getId());

				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->getId());

			if (!isset($this->lastApplicationWorkFlowCriteria) || !$this->lastApplicationWorkFlowCriteria->equals($criteria)) {
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastApplicationWorkFlowCriteria = $criteria;

		return $this->collApplicationWorkFlows;
	}

	
	public function initEngineeringSettlements()
	{
		if ($this->collEngineeringSettlements === null) {
			$this->collEngineeringSettlements = array();
		}
	}

	
	public function getEngineeringSettlements($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringSettlementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEngineeringSettlements === null) {
			if ($this->isNew()) {
			   $this->collEngineeringSettlements = array();
			} else {

				$criteria->add(EngineeringSettlementPeer::APPLICATION_ID, $this->getId());

				EngineeringSettlementPeer::addSelectColumns($criteria);
				$this->collEngineeringSettlements = EngineeringSettlementPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EngineeringSettlementPeer::APPLICATION_ID, $this->getId());

				EngineeringSettlementPeer::addSelectColumns($criteria);
				if (!isset($this->lastEngineeringSettlementCriteria) || !$this->lastEngineeringSettlementCriteria->equals($criteria)) {
					$this->collEngineeringSettlements = EngineeringSettlementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEngineeringSettlementCriteria = $criteria;
		return $this->collEngineeringSettlements;
	}

	
	public function countEngineeringSettlements($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringSettlementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EngineeringSettlementPeer::APPLICATION_ID, $this->getId());

		return EngineeringSettlementPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEngineeringSettlement(EngineeringSettlement $l)
	{
		$this->collEngineeringSettlements[] = $l;
		$l->setApplication($this);
	}

	
	public function initEngineeringMaterialss()
	{
		if ($this->collEngineeringMaterialss === null) {
			$this->collEngineeringMaterialss = array();
		}
	}

	
	public function getEngineeringMaterialss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringMaterialsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEngineeringMaterialss === null) {
			if ($this->isNew()) {
			   $this->collEngineeringMaterialss = array();
			} else {

				$criteria->add(EngineeringMaterialsPeer::APPLICATION_ID, $this->getId());

				EngineeringMaterialsPeer::addSelectColumns($criteria);
				$this->collEngineeringMaterialss = EngineeringMaterialsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EngineeringMaterialsPeer::APPLICATION_ID, $this->getId());

				EngineeringMaterialsPeer::addSelectColumns($criteria);
				if (!isset($this->lastEngineeringMaterialsCriteria) || !$this->lastEngineeringMaterialsCriteria->equals($criteria)) {
					$this->collEngineeringMaterialss = EngineeringMaterialsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEngineeringMaterialsCriteria = $criteria;
		return $this->collEngineeringMaterialss;
	}

	
	public function countEngineeringMaterialss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringMaterialsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EngineeringMaterialsPeer::APPLICATION_ID, $this->getId());

		return EngineeringMaterialsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEngineeringMaterials(EngineeringMaterials $l)
	{
		$this->collEngineeringMaterialss[] = $l;
		$l->setApplication($this);
	}

	
	public function initEngineeringSummarys()
	{
		if ($this->collEngineeringSummarys === null) {
			$this->collEngineeringSummarys = array();
		}
	}

	
	public function getEngineeringSummarys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringSummaryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEngineeringSummarys === null) {
			if ($this->isNew()) {
			   $this->collEngineeringSummarys = array();
			} else {

				$criteria->add(EngineeringSummaryPeer::APPLICATION_ID, $this->getId());

				EngineeringSummaryPeer::addSelectColumns($criteria);
				$this->collEngineeringSummarys = EngineeringSummaryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EngineeringSummaryPeer::APPLICATION_ID, $this->getId());

				EngineeringSummaryPeer::addSelectColumns($criteria);
				if (!isset($this->lastEngineeringSummaryCriteria) || !$this->lastEngineeringSummaryCriteria->equals($criteria)) {
					$this->collEngineeringSummarys = EngineeringSummaryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEngineeringSummaryCriteria = $criteria;
		return $this->collEngineeringSummarys;
	}

	
	public function countEngineeringSummarys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringSummaryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EngineeringSummaryPeer::APPLICATION_ID, $this->getId());

		return EngineeringSummaryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEngineeringSummary(EngineeringSummary $l)
	{
		$this->collEngineeringSummarys[] = $l;
		$l->setApplication($this);
	}

	
	public function initEngineeringGoodss()
	{
		if ($this->collEngineeringGoodss === null) {
			$this->collEngineeringGoodss = array();
		}
	}

	
	public function getEngineeringGoodss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringGoodsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEngineeringGoodss === null) {
			if ($this->isNew()) {
			   $this->collEngineeringGoodss = array();
			} else {

				$criteria->add(EngineeringGoodsPeer::APPLICATION_ID, $this->getId());

				EngineeringGoodsPeer::addSelectColumns($criteria);
				$this->collEngineeringGoodss = EngineeringGoodsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EngineeringGoodsPeer::APPLICATION_ID, $this->getId());

				EngineeringGoodsPeer::addSelectColumns($criteria);
				if (!isset($this->lastEngineeringGoodsCriteria) || !$this->lastEngineeringGoodsCriteria->equals($criteria)) {
					$this->collEngineeringGoodss = EngineeringGoodsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEngineeringGoodsCriteria = $criteria;
		return $this->collEngineeringGoodss;
	}

	
	public function countEngineeringGoodss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringGoodsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EngineeringGoodsPeer::APPLICATION_ID, $this->getId());

		return EngineeringGoodsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEngineeringGoods(EngineeringGoods $l)
	{
		$this->collEngineeringGoodss[] = $l;
		$l->setApplication($this);
	}

} 