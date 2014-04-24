<?php


abstract class BaseTitle extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collWorkflows;

	
	protected $lastWorkflowCriteria = null;

	
	protected $collTitleSfGuardUsers;

	
	protected $lastTitleSfGuardUserCriteria = null;

	
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
			$this->modifiedColumns[] = TitlePeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = TitlePeer::NAME;
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
			$this->modifiedColumns[] = TitlePeer::CREATED_AT;
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
			$this->modifiedColumns[] = TitlePeer::UPDATED_AT;
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
			throw new PropelException("Error populating Title object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TitlePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TitlePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TitlePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(TitlePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TitlePeer::DATABASE_NAME);
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
					$pk = TitlePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TitlePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collWorkflows !== null) {
				foreach($this->collWorkflows as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTitleSfGuardUsers !== null) {
				foreach($this->collTitleSfGuardUsers as $referrerFK) {
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


			if (($retval = TitlePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWorkflows !== null) {
					foreach($this->collWorkflows as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTitleSfGuardUsers !== null) {
					foreach($this->collTitleSfGuardUsers as $referrerFK) {
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
		$pos = TitlePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = TitlePeer::getFieldNames($keyType);
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
		$pos = TitlePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = TitlePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TitlePeer::DATABASE_NAME);

		if ($this->isColumnModified(TitlePeer::ID)) $criteria->add(TitlePeer::ID, $this->id);
		if ($this->isColumnModified(TitlePeer::NAME)) $criteria->add(TitlePeer::NAME, $this->name);
		if ($this->isColumnModified(TitlePeer::CREATED_AT)) $criteria->add(TitlePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TitlePeer::UPDATED_AT)) $criteria->add(TitlePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TitlePeer::DATABASE_NAME);

		$criteria->add(TitlePeer::ID, $this->id);

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

			foreach($this->getWorkflows() as $relObj) {
				$copyObj->addWorkflow($relObj->copy($deepCopy));
			}

			foreach($this->getTitleSfGuardUsers() as $relObj) {
				$copyObj->addTitleSfGuardUser($relObj->copy($deepCopy));
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
			self::$peer = new TitlePeer();
		}
		return self::$peer;
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

				$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

				WorkflowPeer::addSelectColumns($criteria);
				$this->collWorkflows = WorkflowPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

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

		$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

		return WorkflowPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWorkflow(Workflow $l)
	{
		$this->collWorkflows[] = $l;
		$l->setTitle($this);
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

				$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

				$this->collWorkflows = WorkflowPeer::doSelectJoinApproval($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

			if (!isset($this->lastWorkflowCriteria) || !$this->lastWorkflowCriteria->equals($criteria)) {
				$this->collWorkflows = WorkflowPeer::doSelectJoinApproval($criteria, $con);
			}
		}
		$this->lastWorkflowCriteria = $criteria;

		return $this->collWorkflows;
	}


	
	public function getWorkflowsJoinProjectRole($criteria = null, $con = null)
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

				$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

				$this->collWorkflows = WorkflowPeer::doSelectJoinProjectRole($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

			if (!isset($this->lastWorkflowCriteria) || !$this->lastWorkflowCriteria->equals($criteria)) {
				$this->collWorkflows = WorkflowPeer::doSelectJoinProjectRole($criteria, $con);
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

				$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

				$this->collWorkflows = WorkflowPeer::doSelectJoinDepartment($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkflowPeer::TITLE_ID, $this->getId());

			if (!isset($this->lastWorkflowCriteria) || !$this->lastWorkflowCriteria->equals($criteria)) {
				$this->collWorkflows = WorkflowPeer::doSelectJoinDepartment($criteria, $con);
			}
		}
		$this->lastWorkflowCriteria = $criteria;

		return $this->collWorkflows;
	}

	
	public function initTitleSfGuardUsers()
	{
		if ($this->collTitleSfGuardUsers === null) {
			$this->collTitleSfGuardUsers = array();
		}
	}

	
	public function getTitleSfGuardUsers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTitleSfGuardUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTitleSfGuardUsers === null) {
			if ($this->isNew()) {
			   $this->collTitleSfGuardUsers = array();
			} else {

				$criteria->add(TitleSfGuardUserPeer::TITLE_ID, $this->getId());

				TitleSfGuardUserPeer::addSelectColumns($criteria);
				$this->collTitleSfGuardUsers = TitleSfGuardUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TitleSfGuardUserPeer::TITLE_ID, $this->getId());

				TitleSfGuardUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastTitleSfGuardUserCriteria) || !$this->lastTitleSfGuardUserCriteria->equals($criteria)) {
					$this->collTitleSfGuardUsers = TitleSfGuardUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTitleSfGuardUserCriteria = $criteria;
		return $this->collTitleSfGuardUsers;
	}

	
	public function countTitleSfGuardUsers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTitleSfGuardUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TitleSfGuardUserPeer::TITLE_ID, $this->getId());

		return TitleSfGuardUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTitleSfGuardUser(TitleSfGuardUser $l)
	{
		$this->collTitleSfGuardUsers[] = $l;
		$l->setTitle($this);
	}


	
	public function getTitleSfGuardUsersJoinsfGuardUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTitleSfGuardUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTitleSfGuardUsers === null) {
			if ($this->isNew()) {
				$this->collTitleSfGuardUsers = array();
			} else {

				$criteria->add(TitleSfGuardUserPeer::TITLE_ID, $this->getId());

				$this->collTitleSfGuardUsers = TitleSfGuardUserPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		} else {
									
			$criteria->add(TitleSfGuardUserPeer::TITLE_ID, $this->getId());

			if (!isset($this->lastTitleSfGuardUserCriteria) || !$this->lastTitleSfGuardUserCriteria->equals($criteria)) {
				$this->collTitleSfGuardUsers = TitleSfGuardUserPeer::doSelectJoinsfGuardUser($criteria, $con);
			}
		}
		$this->lastTitleSfGuardUserCriteria = $criteria;

		return $this->collTitleSfGuardUsers;
	}

} 