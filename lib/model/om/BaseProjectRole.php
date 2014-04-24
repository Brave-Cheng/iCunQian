<?php


abstract class BaseProjectRole extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collProjectMembers;

	
	protected $lastProjectMemberCriteria = null;

	
	protected $collWorkflows;

	
	protected $lastWorkflowCriteria = null;

	
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
			$this->modifiedColumns[] = ProjectRolePeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ProjectRolePeer::NAME;
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
			$this->modifiedColumns[] = ProjectRolePeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProjectRolePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->updated_at = $rs->getTimestamp($startcol + 3, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ProjectRole object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProjectRolePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProjectRolePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ProjectRolePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProjectRolePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProjectRolePeer::DATABASE_NAME);
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
					$pk = ProjectRolePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProjectRolePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collProjectMembers !== null) {
				foreach($this->collProjectMembers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWorkflows !== null) {
				foreach($this->collWorkflows as $referrerFK) {
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


			if (($retval = ProjectRolePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProjectMembers !== null) {
					foreach($this->collProjectMembers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWorkflows !== null) {
					foreach($this->collWorkflows as $referrerFK) {
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
		$pos = ProjectRolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProjectRolePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProjectRolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProjectRolePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProjectRolePeer::DATABASE_NAME);

		if ($this->isColumnModified(ProjectRolePeer::ID)) $criteria->add(ProjectRolePeer::ID, $this->id);
		if ($this->isColumnModified(ProjectRolePeer::NAME)) $criteria->add(ProjectRolePeer::NAME, $this->name);
		if ($this->isColumnModified(ProjectRolePeer::CREATED_AT)) $criteria->add(ProjectRolePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProjectRolePeer::UPDATED_AT)) $criteria->add(ProjectRolePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProjectRolePeer::DATABASE_NAME);

		$criteria->add(ProjectRolePeer::ID, $this->id);

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

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProjectMembers() as $relObj) {
				$copyObj->addProjectMember($relObj->copy($deepCopy));
			}

			foreach($this->getWorkflows() as $relObj) {
				$copyObj->addWorkflow($relObj->copy($deepCopy));
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
			self::$peer = new ProjectRolePeer();
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

				$criteria->add(ProjectMemberPeer::PROJECT_ROLE_ID, $this->getId());

				ProjectMemberPeer::addSelectColumns($criteria);
				$this->collProjectMembers = ProjectMemberPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProjectMemberPeer::PROJECT_ROLE_ID, $this->getId());

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

		$criteria->add(ProjectMemberPeer::PROJECT_ROLE_ID, $this->getId());

		return ProjectMemberPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProjectMember(ProjectMember $l)
	{
		$this->collProjectMembers[] = $l;
		$l->setProjectRole($this);
	}


	
	public function getProjectMembersJoinProject($criteria = null, $con = null)
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

				$criteria->add(ProjectMemberPeer::PROJECT_ROLE_ID, $this->getId());

				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinProject($criteria, $con);
			}
		} else {
									
			$criteria->add(ProjectMemberPeer::PROJECT_ROLE_ID, $this->getId());

			if (!isset($this->lastProjectMemberCriteria) || !$this->lastProjectMemberCriteria->equals($criteria)) {
				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinProject($criteria, $con);
			}
		}
		$this->lastProjectMemberCriteria = $criteria;

		return $this->collProjectMembers;
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

				$criteria->add(ProjectMemberPeer::PROJECT_ROLE_ID, $this->getId());

				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(ProjectMemberPeer::PROJECT_ROLE_ID, $this->getId());

			if (!isset($this->lastProjectMemberCriteria) || !$this->lastProjectMemberCriteria->equals($criteria)) {
				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastProjectMemberCriteria = $criteria;

		return $this->collProjectMembers;
	}

	
	public function initWorkflows()
	{
		if ($this->collWorkflows === null) {
			$this->collWorkflows = array();
		}
	}

	
	public function getWorkflows($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkflowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkflows === null) {
			if ($this->isNew()) {
			   $this->collWorkflows = array();
			} else {

				$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

				WorkflowPeer::addSelectColumns($criteria);
				$this->collWorkflows = WorkflowPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

				WorkflowPeer::addSelectColumns($criteria);
				if (!isset($this->lastWorkflowCriteria) || !$this->lastWorkflowCriteria->equals($criteria)) {
					$this->collWorkflows = WorkflowPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWorkflowCriteria = $criteria;
		return $this->collWorkflows;
	}

	
	public function countWorkflows($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseWorkflowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

		return WorkflowPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWorkflow(Workflow $l)
	{
		$this->collWorkflows[] = $l;
		$l->setProjectRole($this);
	}


	
	public function getWorkflowsJoinApproval($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkflowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkflows === null) {
			if ($this->isNew()) {
				$this->collWorkflows = array();
			} else {

				$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

				$this->collWorkflows = WorkflowPeer::doSelectJoinApproval($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

			if (!isset($this->lastWorkflowCriteria) || !$this->lastWorkflowCriteria->equals($criteria)) {
				$this->collWorkflows = WorkflowPeer::doSelectJoinApproval($criteria, $con);
			}
		}
		$this->lastWorkflowCriteria = $criteria;

		return $this->collWorkflows;
	}


	
	public function getWorkflowsJoinDepartment($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkflowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkflows === null) {
			if ($this->isNew()) {
				$this->collWorkflows = array();
			} else {

				$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

				$this->collWorkflows = WorkflowPeer::doSelectJoinDepartment($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

			if (!isset($this->lastWorkflowCriteria) || !$this->lastWorkflowCriteria->equals($criteria)) {
				$this->collWorkflows = WorkflowPeer::doSelectJoinDepartment($criteria, $con);
			}
		}
		$this->lastWorkflowCriteria = $criteria;

		return $this->collWorkflows;
	}


	
	public function getWorkflowsJoinTitle($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkflowPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkflows === null) {
			if ($this->isNew()) {
				$this->collWorkflows = array();
			} else {

				$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

				$this->collWorkflows = WorkflowPeer::doSelectJoinTitle($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkflowPeer::PROJECT_ROLE_ID, $this->getId());

			if (!isset($this->lastWorkflowCriteria) || !$this->lastWorkflowCriteria->equals($criteria)) {
				$this->collWorkflows = WorkflowPeer::doSelectJoinTitle($criteria, $con);
			}
		}
		$this->lastWorkflowCriteria = $criteria;

		return $this->collWorkflows;
	}

} 