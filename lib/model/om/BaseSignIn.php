<?php


abstract class BaseSignIn extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $project_id;


	
	protected $sf_guard_user_id;


	
	protected $address;


	
	protected $sign_in_time;


	
	protected $longitude;


	
	protected $lattitude;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aProject;

	
	protected $asfGuardUser;

	
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

	
	public function getSfGuardUserId()
	{

		return $this->sf_guard_user_id;
	}

	
	public function getAddress()
	{

		return $this->address;
	}

	
	public function getSignInTime($format = 'Y-m-d H:i:s')
	{

		if ($this->sign_in_time === null || $this->sign_in_time === '') {
			return null;
		} elseif (!is_int($this->sign_in_time)) {
						$ts = strtotime($this->sign_in_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [sign_in_time] as date/time value: " . var_export($this->sign_in_time, true));
			}
		} else {
			$ts = $this->sign_in_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getLongitude()
	{

		return $this->longitude;
	}

	
	public function getLattitude()
	{

		return $this->lattitude;
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
			$this->modifiedColumns[] = SignInPeer::ID;
		}

	} 
	
	public function setProjectId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->project_id !== $v) {
			$this->project_id = $v;
			$this->modifiedColumns[] = SignInPeer::PROJECT_ID;
		}

		if ($this->aProject !== null && $this->aProject->getId() !== $v) {
			$this->aProject = null;
		}

	} 
	
	public function setSfGuardUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sf_guard_user_id !== $v) {
			$this->sf_guard_user_id = $v;
			$this->modifiedColumns[] = SignInPeer::SF_GUARD_USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

	} 
	
	public function setAddress($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = SignInPeer::ADDRESS;
		}

	} 
	
	public function setSignInTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [sign_in_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->sign_in_time !== $ts) {
			$this->sign_in_time = $ts;
			$this->modifiedColumns[] = SignInPeer::SIGN_IN_TIME;
		}

	} 
	
	public function setLongitude($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->longitude !== $v) {
			$this->longitude = $v;
			$this->modifiedColumns[] = SignInPeer::LONGITUDE;
		}

	} 
	
	public function setLattitude($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->lattitude !== $v) {
			$this->lattitude = $v;
			$this->modifiedColumns[] = SignInPeer::LATTITUDE;
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
			$this->modifiedColumns[] = SignInPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SignInPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->project_id = $rs->getInt($startcol + 1);

			$this->sf_guard_user_id = $rs->getInt($startcol + 2);

			$this->address = $rs->getString($startcol + 3);

			$this->sign_in_time = $rs->getTimestamp($startcol + 4, null);

			$this->longitude = $rs->getString($startcol + 5);

			$this->lattitude = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SignIn object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SignInPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SignInPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SignInPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SignInPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SignInPeer::DATABASE_NAME);
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

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SignInPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SignInPeer::doUpdate($this, $con);
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

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = SignInPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SignInPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSfGuardUserId();
				break;
			case 3:
				return $this->getAddress();
				break;
			case 4:
				return $this->getSignInTime();
				break;
			case 5:
				return $this->getLongitude();
				break;
			case 6:
				return $this->getLattitude();
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
		$keys = SignInPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProjectId(),
			$keys[2] => $this->getSfGuardUserId(),
			$keys[3] => $this->getAddress(),
			$keys[4] => $this->getSignInTime(),
			$keys[5] => $this->getLongitude(),
			$keys[6] => $this->getLattitude(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SignInPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSfGuardUserId($value);
				break;
			case 3:
				$this->setAddress($value);
				break;
			case 4:
				$this->setSignInTime($value);
				break;
			case 5:
				$this->setLongitude($value);
				break;
			case 6:
				$this->setLattitude($value);
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
		$keys = SignInPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProjectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSfGuardUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAddress($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSignInTime($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLongitude($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLattitude($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SignInPeer::DATABASE_NAME);

		if ($this->isColumnModified(SignInPeer::ID)) $criteria->add(SignInPeer::ID, $this->id);
		if ($this->isColumnModified(SignInPeer::PROJECT_ID)) $criteria->add(SignInPeer::PROJECT_ID, $this->project_id);
		if ($this->isColumnModified(SignInPeer::SF_GUARD_USER_ID)) $criteria->add(SignInPeer::SF_GUARD_USER_ID, $this->sf_guard_user_id);
		if ($this->isColumnModified(SignInPeer::ADDRESS)) $criteria->add(SignInPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(SignInPeer::SIGN_IN_TIME)) $criteria->add(SignInPeer::SIGN_IN_TIME, $this->sign_in_time);
		if ($this->isColumnModified(SignInPeer::LONGITUDE)) $criteria->add(SignInPeer::LONGITUDE, $this->longitude);
		if ($this->isColumnModified(SignInPeer::LATTITUDE)) $criteria->add(SignInPeer::LATTITUDE, $this->lattitude);
		if ($this->isColumnModified(SignInPeer::CREATED_AT)) $criteria->add(SignInPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SignInPeer::UPDATED_AT)) $criteria->add(SignInPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SignInPeer::DATABASE_NAME);

		$criteria->add(SignInPeer::ID, $this->id);

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

		$copyObj->setSfGuardUserId($this->sf_guard_user_id);

		$copyObj->setAddress($this->address);

		$copyObj->setSignInTime($this->sign_in_time);

		$copyObj->setLongitude($this->longitude);

		$copyObj->setLattitude($this->lattitude);

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
			self::$peer = new SignInPeer();
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