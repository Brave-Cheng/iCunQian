<?php


abstract class BaseApplicationWorkFlow extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $application_id;


	
	protected $workflow_id;


	
	protected $sf_guard_user_id;


	
	protected $approval_result;


	
	protected $approval_comment;


	
	protected $approval_time;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aApplication;

	
	protected $aWorkflow;

	
	protected $asfGuardUser;

	
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

	
	public function getWorkflowId()
	{

		return $this->workflow_id;
	}

	
	public function getSfGuardUserId()
	{

		return $this->sf_guard_user_id;
	}

	
	public function getApprovalResult()
	{

		return $this->approval_result;
	}

	
	public function getApprovalComment()
	{

		return $this->approval_comment;
	}

	
	public function getApprovalTime($format = 'Y-m-d H:i:s')
	{

		if ($this->approval_time === null || $this->approval_time === '') {
			return null;
		} elseif (!is_int($this->approval_time)) {
						$ts = strtotime($this->approval_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [approval_time] as date/time value: " . var_export($this->approval_time, true));
			}
		} else {
			$ts = $this->approval_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
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
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::ID;
		}

	} 
	
	public function setApplicationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->application_id !== $v) {
			$this->application_id = $v;
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::APPLICATION_ID;
		}

		if ($this->aApplication !== null && $this->aApplication->getId() !== $v) {
			$this->aApplication = null;
		}

	} 
	
	public function setWorkflowId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->workflow_id !== $v) {
			$this->workflow_id = $v;
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::WORKFLOW_ID;
		}

		if ($this->aWorkflow !== null && $this->aWorkflow->getId() !== $v) {
			$this->aWorkflow = null;
		}

	} 
	
	public function setSfGuardUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sf_guard_user_id !== $v) {
			$this->sf_guard_user_id = $v;
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::SF_GUARD_USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

	} 
	
	public function setApprovalResult($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->approval_result !== $v) {
			$this->approval_result = $v;
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::APPROVAL_RESULT;
		}

	} 
	
	public function setApprovalComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->approval_comment !== $v) {
			$this->approval_comment = $v;
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::APPROVAL_COMMENT;
		}

	} 
	
	public function setApprovalTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [approval_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->approval_time !== $ts) {
			$this->approval_time = $ts;
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::APPROVAL_TIME;
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
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ApplicationWorkFlowPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->application_id = $rs->getInt($startcol + 1);

			$this->workflow_id = $rs->getInt($startcol + 2);

			$this->sf_guard_user_id = $rs->getInt($startcol + 3);

			$this->approval_result = $rs->getInt($startcol + 4);

			$this->approval_comment = $rs->getString($startcol + 5);

			$this->approval_time = $rs->getTimestamp($startcol + 6, null);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ApplicationWorkFlow object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ApplicationWorkFlowPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ApplicationWorkFlowPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ApplicationWorkFlowPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ApplicationWorkFlowPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ApplicationWorkFlowPeer::DATABASE_NAME);
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

			if ($this->aWorkflow !== null) {
				if ($this->aWorkflow->isModified()) {
					$affectedRows += $this->aWorkflow->save($con);
				}
				$this->setWorkflow($this->aWorkflow);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ApplicationWorkFlowPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ApplicationWorkFlowPeer::doUpdate($this, $con);
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

			if ($this->aWorkflow !== null) {
				if (!$this->aWorkflow->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWorkflow->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = ApplicationWorkFlowPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ApplicationWorkFlowPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getWorkflowId();
				break;
			case 3:
				return $this->getSfGuardUserId();
				break;
			case 4:
				return $this->getApprovalResult();
				break;
			case 5:
				return $this->getApprovalComment();
				break;
			case 6:
				return $this->getApprovalTime();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ApplicationWorkFlowPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getApplicationId(),
			$keys[2] => $this->getWorkflowId(),
			$keys[3] => $this->getSfGuardUserId(),
			$keys[4] => $this->getApprovalResult(),
			$keys[5] => $this->getApprovalComment(),
			$keys[6] => $this->getApprovalTime(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ApplicationWorkFlowPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setWorkflowId($value);
				break;
			case 3:
				$this->setSfGuardUserId($value);
				break;
			case 4:
				$this->setApprovalResult($value);
				break;
			case 5:
				$this->setApprovalComment($value);
				break;
			case 6:
				$this->setApprovalTime($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ApplicationWorkFlowPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setApplicationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWorkflowId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSfGuardUserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setApprovalResult($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setApprovalComment($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setApprovalTime($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ApplicationWorkFlowPeer::DATABASE_NAME);

		if ($this->isColumnModified(ApplicationWorkFlowPeer::ID)) $criteria->add(ApplicationWorkFlowPeer::ID, $this->id);
		if ($this->isColumnModified(ApplicationWorkFlowPeer::APPLICATION_ID)) $criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->application_id);
		if ($this->isColumnModified(ApplicationWorkFlowPeer::WORKFLOW_ID)) $criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $this->workflow_id);
		if ($this->isColumnModified(ApplicationWorkFlowPeer::SF_GUARD_USER_ID)) $criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $this->sf_guard_user_id);
		if ($this->isColumnModified(ApplicationWorkFlowPeer::APPROVAL_RESULT)) $criteria->add(ApplicationWorkFlowPeer::APPROVAL_RESULT, $this->approval_result);
		if ($this->isColumnModified(ApplicationWorkFlowPeer::APPROVAL_COMMENT)) $criteria->add(ApplicationWorkFlowPeer::APPROVAL_COMMENT, $this->approval_comment);
		if ($this->isColumnModified(ApplicationWorkFlowPeer::APPROVAL_TIME)) $criteria->add(ApplicationWorkFlowPeer::APPROVAL_TIME, $this->approval_time);
		if ($this->isColumnModified(ApplicationWorkFlowPeer::CREATED_AT)) $criteria->add(ApplicationWorkFlowPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ApplicationWorkFlowPeer::UPDATED_AT)) $criteria->add(ApplicationWorkFlowPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ApplicationWorkFlowPeer::DATABASE_NAME);

		$criteria->add(ApplicationWorkFlowPeer::ID, $this->id);

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

		$copyObj->setWorkflowId($this->workflow_id);

		$copyObj->setSfGuardUserId($this->sf_guard_user_id);

		$copyObj->setApprovalResult($this->approval_result);

		$copyObj->setApprovalComment($this->approval_comment);

		$copyObj->setApprovalTime($this->approval_time);

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
			self::$peer = new ApplicationWorkFlowPeer();
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

	
	public function setWorkflow($v)
	{


		if ($v === null) {
			$this->setWorkflowId(NULL);
		} else {
			$this->setWorkflowId($v->getId());
		}


		$this->aWorkflow = $v;
	}


	
	public function getWorkflow($con = null)
	{
		if ($this->aWorkflow === null && ($this->workflow_id !== null)) {
						include_once 'lib/model/om/BaseWorkflowPeer.php';

			$this->aWorkflow = WorkflowPeer::retrieveByPK($this->workflow_id, $con);

			
		}
		return $this->aWorkflow;
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

} 