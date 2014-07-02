<?php


abstract class BaseWorkflow extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $approval_id;


	
	protected $description;


	
	protected $is_project_role;


	
	protected $project_role_id;


	
	protected $department_id;


	
	protected $title_id;


	
	protected $sort_order;


	
	protected $is_valid;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aApproval;

	
	protected $aProjectRole;

	
	protected $aDepartment;

	
	protected $aTitle;

	
	protected $collApplicationWorkFlows;

	
	protected $lastApplicationWorkFlowCriteria = null;

	
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

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getIsProjectRole()
	{

		return $this->is_project_role;
	}

	
	public function getProjectRoleId()
	{

		return $this->project_role_id;
	}

	
	public function getDepartmentId()
	{

		return $this->department_id;
	}

	
	public function getTitleId()
	{

		return $this->title_id;
	}

	
	public function getSortOrder()
	{

		return $this->sort_order;
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
			$this->modifiedColumns[] = WorkflowPeer::ID;
		}

	} 
	
	public function setApprovalId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->approval_id !== $v) {
			$this->approval_id = $v;
			$this->modifiedColumns[] = WorkflowPeer::APPROVAL_ID;
		}

		if ($this->aApproval !== null && $this->aApproval->getId() !== $v) {
			$this->aApproval = null;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = WorkflowPeer::DESCRIPTION;
		}

	} 
	
	public function setIsProjectRole($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_project_role !== $v) {
			$this->is_project_role = $v;
			$this->modifiedColumns[] = WorkflowPeer::IS_PROJECT_ROLE;
		}

	} 
	
	public function setProjectRoleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->project_role_id !== $v) {
			$this->project_role_id = $v;
			$this->modifiedColumns[] = WorkflowPeer::PROJECT_ROLE_ID;
		}

		if ($this->aProjectRole !== null && $this->aProjectRole->getId() !== $v) {
			$this->aProjectRole = null;
		}

	} 
	
	public function setDepartmentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->department_id !== $v) {
			$this->department_id = $v;
			$this->modifiedColumns[] = WorkflowPeer::DEPARTMENT_ID;
		}

		if ($this->aDepartment !== null && $this->aDepartment->getId() !== $v) {
			$this->aDepartment = null;
		}

	} 
	
	public function setTitleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->title_id !== $v) {
			$this->title_id = $v;
			$this->modifiedColumns[] = WorkflowPeer::TITLE_ID;
		}

		if ($this->aTitle !== null && $this->aTitle->getId() !== $v) {
			$this->aTitle = null;
		}

	} 
	
	public function setSortOrder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sort_order !== $v) {
			$this->sort_order = $v;
			$this->modifiedColumns[] = WorkflowPeer::SORT_ORDER;
		}

	} 
	
	public function setIsValid($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_valid !== $v) {
			$this->is_valid = $v;
			$this->modifiedColumns[] = WorkflowPeer::IS_VALID;
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
			$this->modifiedColumns[] = WorkflowPeer::CREATED_AT;
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
			$this->modifiedColumns[] = WorkflowPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->approval_id = $rs->getInt($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->is_project_role = $rs->getInt($startcol + 3);

			$this->project_role_id = $rs->getInt($startcol + 4);

			$this->department_id = $rs->getInt($startcol + 5);

			$this->title_id = $rs->getInt($startcol + 6);

			$this->sort_order = $rs->getInt($startcol + 7);

			$this->is_valid = $rs->getInt($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Workflow object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkflowPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WorkflowPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(WorkflowPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(WorkflowPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkflowPeer::DATABASE_NAME);
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

			if ($this->aProjectRole !== null) {
				if ($this->aProjectRole->isModified()) {
					$affectedRows += $this->aProjectRole->save($con);
				}
				$this->setProjectRole($this->aProjectRole);
			}

			if ($this->aDepartment !== null) {
				if ($this->aDepartment->isModified()) {
					$affectedRows += $this->aDepartment->save($con);
				}
				$this->setDepartment($this->aDepartment);
			}

			if ($this->aTitle !== null) {
				if ($this->aTitle->isModified()) {
					$affectedRows += $this->aTitle->save($con);
				}
				$this->setTitle($this->aTitle);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WorkflowPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WorkflowPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collApplicationWorkFlows !== null) {
				foreach($this->collApplicationWorkFlows as $referrerFK) {
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

			if ($this->aProjectRole !== null) {
				if (!$this->aProjectRole->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProjectRole->getValidationFailures());
				}
			}

			if ($this->aDepartment !== null) {
				if (!$this->aDepartment->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepartment->getValidationFailures());
				}
			}

			if ($this->aTitle !== null) {
				if (!$this->aTitle->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTitle->getValidationFailures());
				}
			}


			if (($retval = WorkflowPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collApplicationWorkFlows !== null) {
					foreach($this->collApplicationWorkFlows as $referrerFK) {
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
		$pos = WorkflowPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDescription();
				break;
			case 3:
				return $this->getIsProjectRole();
				break;
			case 4:
				return $this->getProjectRoleId();
				break;
			case 5:
				return $this->getDepartmentId();
				break;
			case 6:
				return $this->getTitleId();
				break;
			case 7:
				return $this->getSortOrder();
				break;
			case 8:
				return $this->getIsValid();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			case 10:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkflowPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getApprovalId(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getIsProjectRole(),
			$keys[4] => $this->getProjectRoleId(),
			$keys[5] => $this->getDepartmentId(),
			$keys[6] => $this->getTitleId(),
			$keys[7] => $this->getSortOrder(),
			$keys[8] => $this->getIsValid(),
			$keys[9] => $this->getCreatedAt(),
			$keys[10] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkflowPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDescription($value);
				break;
			case 3:
				$this->setIsProjectRole($value);
				break;
			case 4:
				$this->setProjectRoleId($value);
				break;
			case 5:
				$this->setDepartmentId($value);
				break;
			case 6:
				$this->setTitleId($value);
				break;
			case 7:
				$this->setSortOrder($value);
				break;
			case 8:
				$this->setIsValid($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
			case 10:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkflowPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setApprovalId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsProjectRole($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setProjectRoleId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDepartmentId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTitleId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSortOrder($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsValid($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WorkflowPeer::DATABASE_NAME);

		if ($this->isColumnModified(WorkflowPeer::ID)) $criteria->add(WorkflowPeer::ID, $this->id);
		if ($this->isColumnModified(WorkflowPeer::APPROVAL_ID)) $criteria->add(WorkflowPeer::APPROVAL_ID, $this->approval_id);
		if ($this->isColumnModified(WorkflowPeer::DESCRIPTION)) $criteria->add(WorkflowPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(WorkflowPeer::IS_PROJECT_ROLE)) $criteria->add(WorkflowPeer::IS_PROJECT_ROLE, $this->is_project_role);
		if ($this->isColumnModified(WorkflowPeer::PROJECT_ROLE_ID)) $criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->project_role_id);
		if ($this->isColumnModified(WorkflowPeer::DEPARTMENT_ID)) $criteria->add(WorkflowPeer::DEPARTMENT_ID, $this->department_id);
		if ($this->isColumnModified(WorkflowPeer::TITLE_ID)) $criteria->add(WorkflowPeer::TITLE_ID, $this->title_id);
		if ($this->isColumnModified(WorkflowPeer::SORT_ORDER)) $criteria->add(WorkflowPeer::SORT_ORDER, $this->sort_order);
		if ($this->isColumnModified(WorkflowPeer::IS_VALID)) $criteria->add(WorkflowPeer::IS_VALID, $this->is_valid);
		if ($this->isColumnModified(WorkflowPeer::CREATED_AT)) $criteria->add(WorkflowPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WorkflowPeer::UPDATED_AT)) $criteria->add(WorkflowPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WorkflowPeer::DATABASE_NAME);

		$criteria->add(WorkflowPeer::ID, $this->id);

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

		$copyObj->setDescription($this->description);

		$copyObj->setIsProjectRole($this->is_project_role);

		$copyObj->setProjectRoleId($this->project_role_id);

		$copyObj->setDepartmentId($this->department_id);

		$copyObj->setTitleId($this->title_id);

		$copyObj->setSortOrder($this->sort_order);

		$copyObj->setIsValid($this->is_valid);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getApplicationWorkFlows() as $relObj) {
				$copyObj->addApplicationWorkFlow($relObj->copy($deepCopy));
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
			self::$peer = new WorkflowPeer();
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

	
	public function setProjectRole($v)
	{


		if ($v === null) {
			$this->setProjectRoleId(NULL);
		} else {
			$this->setProjectRoleId($v->getId());
		}


		$this->aProjectRole = $v;
	}


	
	public function getProjectRole($con = null)
	{
		if ($this->aProjectRole === null && ($this->project_role_id !== null)) {
						include_once 'lib/model/om/BaseProjectRolePeer.php';

			$this->aProjectRole = ProjectRolePeer::retrieveByPK($this->project_role_id, $con);

			
		}
		return $this->aProjectRole;
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

	
	public function setTitle($v)
	{


		if ($v === null) {
			$this->setTitleId(NULL);
		} else {
			$this->setTitleId($v->getId());
		}


		$this->aTitle = $v;
	}


	
	public function getTitle($con = null)
	{
		if ($this->aTitle === null && ($this->title_id !== null)) {
						include_once 'lib/model/om/BaseTitlePeer.php';

			$this->aTitle = TitlePeer::retrieveByPK($this->title_id, $con);

			
		}
		return $this->aTitle;
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

				$criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $this->getId());

				ApplicationWorkFlowPeer::addSelectColumns($criteria);
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $this->getId());

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

		$criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $this->getId());

		return ApplicationWorkFlowPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addApplicationWorkFlow(ApplicationWorkFlow $l)
	{
		$this->collApplicationWorkFlows[] = $l;
		$l->setWorkflow($this);
	}


	
	public function getApplicationWorkFlowsJoinApplication($criteria = null, $con = null)
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

				$criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $this->getId());

				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinApplication($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $this->getId());

			if (!isset($this->lastApplicationWorkFlowCriteria) || !$this->lastApplicationWorkFlowCriteria->equals($criteria)) {
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinApplication($criteria, $con);
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

				$criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $this->getId());

				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $this->getId());

			if (!isset($this->lastApplicationWorkFlowCriteria) || !$this->lastApplicationWorkFlowCriteria->equals($criteria)) {
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastApplicationWorkFlowCriteria = $criteria;

		return $this->collApplicationWorkFlows;
	}

} 