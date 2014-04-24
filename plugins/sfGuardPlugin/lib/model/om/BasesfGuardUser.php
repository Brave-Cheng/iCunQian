<?php


abstract class BasesfGuardUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $username;


	
	protected $algorithm = 'sha1';


	
	protected $salt;


	
	protected $password;


	
	protected $created_at;


	
	protected $last_login;


	
	protected $is_active = true;


	
	protected $is_super_admin = false;

	
	protected $collsfGuardUserProfiles;

	
	protected $lastsfGuardUserProfileCriteria = null;

	
	protected $collDepartmentSfGuardUsers;

	
	protected $lastDepartmentSfGuardUserCriteria = null;

	
	protected $collUserLogs;

	
	protected $lastUserLogCriteria = null;

	
	protected $collProjectMembers;

	
	protected $lastProjectMemberCriteria = null;

	
	protected $collDailyReports;

	
	protected $lastDailyReportCriteria = null;

	
	protected $collSignIns;

	
	protected $lastSignInCriteria = null;

	
	protected $collNewss;

	
	protected $lastNewsCriteria = null;

	
	protected $collNotificationRecivers;

	
	protected $lastNotificationReciverCriteria = null;

	
	protected $collNotifications;

	
	protected $lastNotificationCriteria = null;

	
	protected $collReadingHistorys;

	
	protected $lastReadingHistoryCriteria = null;

	
	protected $collApplications;

	
	protected $lastApplicationCriteria = null;

	
	protected $collApplicationWorkFlows;

	
	protected $lastApplicationWorkFlowCriteria = null;

	
	protected $collTitleSfGuardUsers;

	
	protected $lastTitleSfGuardUserCriteria = null;

	
	protected $collsfGuardUserPermissions;

	
	protected $lastsfGuardUserPermissionCriteria = null;

	
	protected $collsfGuardUserGroups;

	
	protected $lastsfGuardUserGroupCriteria = null;

	
	protected $collsfGuardRememberKeys;

	
	protected $lastsfGuardRememberKeyCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUsername()
	{

		return $this->username;
	}

	
	public function getAlgorithm()
	{

		return $this->algorithm;
	}

	
	public function getSalt()
	{

		return $this->salt;
	}

	
	public function getPassword()
	{

		return $this->password;
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

	
	public function getLastLogin($format = 'Y-m-d H:i:s')
	{

		if ($this->last_login === null || $this->last_login === '') {
			return null;
		} elseif (!is_int($this->last_login)) {
						$ts = strtotime($this->last_login);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_login] as date/time value: " . var_export($this->last_login, true));
			}
		} else {
			$ts = $this->last_login;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getIsSuperAdmin()
	{

		return $this->is_super_admin;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ID;
		}

	} 
	
	public function setUsername($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::USERNAME;
		}

	} 
	
	public function setAlgorithm($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->algorithm !== $v || $v === 'sha1') {
			$this->algorithm = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ALGORITHM;
		}

	} 
	
	public function setSalt($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::SALT;
		}

	} 
	
	public function setPassword($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::PASSWORD;
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
			$this->modifiedColumns[] = sfGuardUserPeer::CREATED_AT;
		}

	} 
	
	public function setLastLogin($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_login] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_login !== $ts) {
			$this->last_login = $ts;
			$this->modifiedColumns[] = sfGuardUserPeer::LAST_LOGIN;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_ACTIVE;
		}

	} 
	
	public function setIsSuperAdmin($v)
	{

		if ($this->is_super_admin !== $v || $v === false) {
			$this->is_super_admin = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_SUPER_ADMIN;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->username = $rs->getString($startcol + 1);

			$this->algorithm = $rs->getString($startcol + 2);

			$this->salt = $rs->getString($startcol + 3);

			$this->password = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->last_login = $rs->getTimestamp($startcol + 6, null);

			$this->is_active = $rs->getBoolean($startcol + 7);

			$this->is_super_admin = $rs->getBoolean($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfGuardUserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(sfGuardUserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME);
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
					$pk = sfGuardUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collsfGuardUserProfiles !== null) {
				foreach($this->collsfGuardUserProfiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDepartmentSfGuardUsers !== null) {
				foreach($this->collDepartmentSfGuardUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserLogs !== null) {
				foreach($this->collUserLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjectMembers !== null) {
				foreach($this->collProjectMembers as $referrerFK) {
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

			if ($this->collNewss !== null) {
				foreach($this->collNewss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotificationRecivers !== null) {
				foreach($this->collNotificationRecivers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotifications !== null) {
				foreach($this->collNotifications as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collReadingHistorys !== null) {
				foreach($this->collReadingHistorys as $referrerFK) {
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

			if ($this->collApplicationWorkFlows !== null) {
				foreach($this->collApplicationWorkFlows as $referrerFK) {
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

			if ($this->collsfGuardUserPermissions !== null) {
				foreach($this->collsfGuardUserPermissions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardUserGroups !== null) {
				foreach($this->collsfGuardUserGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfGuardRememberKeys !== null) {
				foreach($this->collsfGuardRememberKeys as $referrerFK) {
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


			if (($retval = sfGuardUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfGuardUserProfiles !== null) {
					foreach($this->collsfGuardUserProfiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDepartmentSfGuardUsers !== null) {
					foreach($this->collDepartmentSfGuardUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserLogs !== null) {
					foreach($this->collUserLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjectMembers !== null) {
					foreach($this->collProjectMembers as $referrerFK) {
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

				if ($this->collNewss !== null) {
					foreach($this->collNewss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotificationRecivers !== null) {
					foreach($this->collNotificationRecivers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotifications !== null) {
					foreach($this->collNotifications as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collReadingHistorys !== null) {
					foreach($this->collReadingHistorys as $referrerFK) {
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

				if ($this->collApplicationWorkFlows !== null) {
					foreach($this->collApplicationWorkFlows as $referrerFK) {
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

				if ($this->collsfGuardUserPermissions !== null) {
					foreach($this->collsfGuardUserPermissions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardUserGroups !== null) {
					foreach($this->collsfGuardUserGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardRememberKeys !== null) {
					foreach($this->collsfGuardRememberKeys as $referrerFK) {
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
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUsername();
				break;
			case 2:
				return $this->getAlgorithm();
				break;
			case 3:
				return $this->getSalt();
				break;
			case 4:
				return $this->getPassword();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getLastLogin();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getIsSuperAdmin();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getAlgorithm(),
			$keys[3] => $this->getSalt(),
			$keys[4] => $this->getPassword(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getLastLogin(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getIsSuperAdmin(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUsername($value);
				break;
			case 2:
				$this->setAlgorithm($value);
				break;
			case 3:
				$this->setSalt($value);
				break;
			case 4:
				$this->setPassword($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setLastLogin($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setIsSuperAdmin($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlgorithm($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSalt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPassword($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastLogin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsSuperAdmin($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserPeer::ID)) $criteria->add(sfGuardUserPeer::ID, $this->id);
		if ($this->isColumnModified(sfGuardUserPeer::USERNAME)) $criteria->add(sfGuardUserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(sfGuardUserPeer::ALGORITHM)) $criteria->add(sfGuardUserPeer::ALGORITHM, $this->algorithm);
		if ($this->isColumnModified(sfGuardUserPeer::SALT)) $criteria->add(sfGuardUserPeer::SALT, $this->salt);
		if ($this->isColumnModified(sfGuardUserPeer::PASSWORD)) $criteria->add(sfGuardUserPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(sfGuardUserPeer::CREATED_AT)) $criteria->add(sfGuardUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfGuardUserPeer::LAST_LOGIN)) $criteria->add(sfGuardUserPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(sfGuardUserPeer::IS_ACTIVE)) $criteria->add(sfGuardUserPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(sfGuardUserPeer::IS_SUPER_ADMIN)) $criteria->add(sfGuardUserPeer::IS_SUPER_ADMIN, $this->is_super_admin);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		$criteria->add(sfGuardUserPeer::ID, $this->id);

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

		$copyObj->setUsername($this->username);

		$copyObj->setAlgorithm($this->algorithm);

		$copyObj->setSalt($this->salt);

		$copyObj->setPassword($this->password);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastLogin($this->last_login);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsSuperAdmin($this->is_super_admin);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfGuardUserProfiles() as $relObj) {
				$copyObj->addsfGuardUserProfile($relObj->copy($deepCopy));
			}

			foreach($this->getDepartmentSfGuardUsers() as $relObj) {
				$copyObj->addDepartmentSfGuardUser($relObj->copy($deepCopy));
			}

			foreach($this->getUserLogs() as $relObj) {
				$copyObj->addUserLog($relObj->copy($deepCopy));
			}

			foreach($this->getProjectMembers() as $relObj) {
				$copyObj->addProjectMember($relObj->copy($deepCopy));
			}

			foreach($this->getDailyReports() as $relObj) {
				$copyObj->addDailyReport($relObj->copy($deepCopy));
			}

			foreach($this->getSignIns() as $relObj) {
				$copyObj->addSignIn($relObj->copy($deepCopy));
			}

			foreach($this->getNewss() as $relObj) {
				$copyObj->addNews($relObj->copy($deepCopy));
			}

			foreach($this->getNotificationRecivers() as $relObj) {
				$copyObj->addNotificationReciver($relObj->copy($deepCopy));
			}

			foreach($this->getNotifications() as $relObj) {
				$copyObj->addNotification($relObj->copy($deepCopy));
			}

			foreach($this->getReadingHistorys() as $relObj) {
				$copyObj->addReadingHistory($relObj->copy($deepCopy));
			}

			foreach($this->getApplications() as $relObj) {
				$copyObj->addApplication($relObj->copy($deepCopy));
			}

			foreach($this->getApplicationWorkFlows() as $relObj) {
				$copyObj->addApplicationWorkFlow($relObj->copy($deepCopy));
			}

			foreach($this->getTitleSfGuardUsers() as $relObj) {
				$copyObj->addTitleSfGuardUser($relObj->copy($deepCopy));
			}

			foreach($this->getsfGuardUserPermissions() as $relObj) {
				$copyObj->addsfGuardUserPermission($relObj->copy($deepCopy));
			}

			foreach($this->getsfGuardUserGroups() as $relObj) {
				$copyObj->addsfGuardUserGroup($relObj->copy($deepCopy));
			}

			foreach($this->getsfGuardRememberKeys() as $relObj) {
				$copyObj->addsfGuardRememberKey($relObj->copy($deepCopy));
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
			self::$peer = new sfGuardUserPeer();
		}
		return self::$peer;
	}

	
	public function initsfGuardUserProfiles()
	{
		if ($this->collsfGuardUserProfiles === null) {
			$this->collsfGuardUserProfiles = array();
		}
	}

	
	public function getsfGuardUserProfiles($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getId());

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getId());

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;
		return $this->collsfGuardUserProfiles;
	}

	
	public function countsfGuardUserProfiles($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getId());

		return sfGuardUserProfilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfGuardUserProfile(sfGuardUserProfile $l)
	{
		$this->collsfGuardUserProfiles[] = $l;
		$l->setsfGuardUser($this);
	}

	
	public function initDepartmentSfGuardUsers()
	{
		if ($this->collDepartmentSfGuardUsers === null) {
			$this->collDepartmentSfGuardUsers = array();
		}
	}

	
	public function getDepartmentSfGuardUsers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepartmentSfGuardUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepartmentSfGuardUsers === null) {
			if ($this->isNew()) {
			   $this->collDepartmentSfGuardUsers = array();
			} else {

				$criteria->add(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

				DepartmentSfGuardUserPeer::addSelectColumns($criteria);
				$this->collDepartmentSfGuardUsers = DepartmentSfGuardUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

				DepartmentSfGuardUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastDepartmentSfGuardUserCriteria) || !$this->lastDepartmentSfGuardUserCriteria->equals($criteria)) {
					$this->collDepartmentSfGuardUsers = DepartmentSfGuardUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDepartmentSfGuardUserCriteria = $criteria;
		return $this->collDepartmentSfGuardUsers;
	}

	
	public function countDepartmentSfGuardUsers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDepartmentSfGuardUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

		return DepartmentSfGuardUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepartmentSfGuardUser(DepartmentSfGuardUser $l)
	{
		$this->collDepartmentSfGuardUsers[] = $l;
		$l->setsfGuardUser($this);
	}


	
	public function getDepartmentSfGuardUsersJoinDepartment($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepartmentSfGuardUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepartmentSfGuardUsers === null) {
			if ($this->isNew()) {
				$this->collDepartmentSfGuardUsers = array();
			} else {

				$criteria->add(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collDepartmentSfGuardUsers = DepartmentSfGuardUserPeer::doSelectJoinDepartment($criteria, $con);
			}
		} else {
									
			$criteria->add(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastDepartmentSfGuardUserCriteria) || !$this->lastDepartmentSfGuardUserCriteria->equals($criteria)) {
				$this->collDepartmentSfGuardUsers = DepartmentSfGuardUserPeer::doSelectJoinDepartment($criteria, $con);
			}
		}
		$this->lastDepartmentSfGuardUserCriteria = $criteria;

		return $this->collDepartmentSfGuardUsers;
	}

	
	public function initUserLogs()
	{
		if ($this->collUserLogs === null) {
			$this->collUserLogs = array();
		}
	}

	
	public function getUserLogs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserLogs === null) {
			if ($this->isNew()) {
			   $this->collUserLogs = array();
			} else {

				$criteria->add(UserLogPeer::SF_GUARD_USER_ID, $this->getId());

				UserLogPeer::addSelectColumns($criteria);
				$this->collUserLogs = UserLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserLogPeer::SF_GUARD_USER_ID, $this->getId());

				UserLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserLogCriteria) || !$this->lastUserLogCriteria->equals($criteria)) {
					$this->collUserLogs = UserLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserLogCriteria = $criteria;
		return $this->collUserLogs;
	}

	
	public function countUserLogs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserLogPeer::SF_GUARD_USER_ID, $this->getId());

		return UserLogPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserLog(UserLog $l)
	{
		$this->collUserLogs[] = $l;
		$l->setsfGuardUser($this);
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

				$criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getId());

				ProjectMemberPeer::addSelectColumns($criteria);
				$this->collProjectMembers = ProjectMemberPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getId());

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

		$criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getId());

		return ProjectMemberPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProjectMember(ProjectMember $l)
	{
		$this->collProjectMembers[] = $l;
		$l->setsfGuardUser($this);
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

				$criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinProject($criteria, $con);
			}
		} else {
									
			$criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastProjectMemberCriteria) || !$this->lastProjectMemberCriteria->equals($criteria)) {
				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinProject($criteria, $con);
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

				$criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinProjectRole($criteria, $con);
			}
		} else {
									
			$criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastProjectMemberCriteria) || !$this->lastProjectMemberCriteria->equals($criteria)) {
				$this->collProjectMembers = ProjectMemberPeer::doSelectJoinProjectRole($criteria, $con);
			}
		}
		$this->lastProjectMemberCriteria = $criteria;

		return $this->collProjectMembers;
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

				$criteria->add(DailyReportPeer::SF_GUARD_USER_ID, $this->getId());

				DailyReportPeer::addSelectColumns($criteria);
				$this->collDailyReports = DailyReportPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DailyReportPeer::SF_GUARD_USER_ID, $this->getId());

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

		$criteria->add(DailyReportPeer::SF_GUARD_USER_ID, $this->getId());

		return DailyReportPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDailyReport(DailyReport $l)
	{
		$this->collDailyReports[] = $l;
		$l->setsfGuardUser($this);
	}


	
	public function getDailyReportsJoinProject($criteria = null, $con = null)
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

				$criteria->add(DailyReportPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collDailyReports = DailyReportPeer::doSelectJoinProject($criteria, $con);
			}
		} else {
									
			$criteria->add(DailyReportPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastDailyReportCriteria) || !$this->lastDailyReportCriteria->equals($criteria)) {
				$this->collDailyReports = DailyReportPeer::doSelectJoinProject($criteria, $con);
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

				$criteria->add(SignInPeer::SF_GUARD_USER_ID, $this->getId());

				SignInPeer::addSelectColumns($criteria);
				$this->collSignIns = SignInPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SignInPeer::SF_GUARD_USER_ID, $this->getId());

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

		$criteria->add(SignInPeer::SF_GUARD_USER_ID, $this->getId());

		return SignInPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSignIn(SignIn $l)
	{
		$this->collSignIns[] = $l;
		$l->setsfGuardUser($this);
	}


	
	public function getSignInsJoinProject($criteria = null, $con = null)
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

				$criteria->add(SignInPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collSignIns = SignInPeer::doSelectJoinProject($criteria, $con);
			}
		} else {
									
			$criteria->add(SignInPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastSignInCriteria) || !$this->lastSignInCriteria->equals($criteria)) {
				$this->collSignIns = SignInPeer::doSelectJoinProject($criteria, $con);
			}
		}
		$this->lastSignInCriteria = $criteria;

		return $this->collSignIns;
	}

	
	public function initNewss()
	{
		if ($this->collNewss === null) {
			$this->collNewss = array();
		}
	}

	
	public function getNewss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNewsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNewss === null) {
			if ($this->isNew()) {
			   $this->collNewss = array();
			} else {

				$criteria->add(NewsPeer::SF_GUARD_USER_ID, $this->getId());

				NewsPeer::addSelectColumns($criteria);
				$this->collNewss = NewsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NewsPeer::SF_GUARD_USER_ID, $this->getId());

				NewsPeer::addSelectColumns($criteria);
				if (!isset($this->lastNewsCriteria) || !$this->lastNewsCriteria->equals($criteria)) {
					$this->collNewss = NewsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNewsCriteria = $criteria;
		return $this->collNewss;
	}

	
	public function countNewss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNewsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NewsPeer::SF_GUARD_USER_ID, $this->getId());

		return NewsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNews(News $l)
	{
		$this->collNewss[] = $l;
		$l->setsfGuardUser($this);
	}

	
	public function initNotificationRecivers()
	{
		if ($this->collNotificationRecivers === null) {
			$this->collNotificationRecivers = array();
		}
	}

	
	public function getNotificationRecivers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificationReciverPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificationRecivers === null) {
			if ($this->isNew()) {
			   $this->collNotificationRecivers = array();
			} else {

				$criteria->add(NotificationReciverPeer::SF_GUARD_USER_ID, $this->getId());

				NotificationReciverPeer::addSelectColumns($criteria);
				$this->collNotificationRecivers = NotificationReciverPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificationReciverPeer::SF_GUARD_USER_ID, $this->getId());

				NotificationReciverPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificationReciverCriteria) || !$this->lastNotificationReciverCriteria->equals($criteria)) {
					$this->collNotificationRecivers = NotificationReciverPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificationReciverCriteria = $criteria;
		return $this->collNotificationRecivers;
	}

	
	public function countNotificationRecivers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotificationReciverPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotificationReciverPeer::SF_GUARD_USER_ID, $this->getId());

		return NotificationReciverPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotificationReciver(NotificationReciver $l)
	{
		$this->collNotificationRecivers[] = $l;
		$l->setsfGuardUser($this);
	}


	
	public function getNotificationReciversJoinNotification($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificationReciverPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificationRecivers === null) {
			if ($this->isNew()) {
				$this->collNotificationRecivers = array();
			} else {

				$criteria->add(NotificationReciverPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collNotificationRecivers = NotificationReciverPeer::doSelectJoinNotification($criteria, $con);
			}
		} else {
									
			$criteria->add(NotificationReciverPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastNotificationReciverCriteria) || !$this->lastNotificationReciverCriteria->equals($criteria)) {
				$this->collNotificationRecivers = NotificationReciverPeer::doSelectJoinNotification($criteria, $con);
			}
		}
		$this->lastNotificationReciverCriteria = $criteria;

		return $this->collNotificationRecivers;
	}

	
	public function initNotifications()
	{
		if ($this->collNotifications === null) {
			$this->collNotifications = array();
		}
	}

	
	public function getNotifications($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotificationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotifications === null) {
			if ($this->isNew()) {
			   $this->collNotifications = array();
			} else {

				$criteria->add(NotificationPeer::SF_GUARD_USER_ID, $this->getId());

				NotificationPeer::addSelectColumns($criteria);
				$this->collNotifications = NotificationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificationPeer::SF_GUARD_USER_ID, $this->getId());

				NotificationPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificationCriteria) || !$this->lastNotificationCriteria->equals($criteria)) {
					$this->collNotifications = NotificationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificationCriteria = $criteria;
		return $this->collNotifications;
	}

	
	public function countNotifications($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotificationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotificationPeer::SF_GUARD_USER_ID, $this->getId());

		return NotificationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNotification(Notification $l)
	{
		$this->collNotifications[] = $l;
		$l->setsfGuardUser($this);
	}

	
	public function initReadingHistorys()
	{
		if ($this->collReadingHistorys === null) {
			$this->collReadingHistorys = array();
		}
	}

	
	public function getReadingHistorys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseReadingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReadingHistorys === null) {
			if ($this->isNew()) {
			   $this->collReadingHistorys = array();
			} else {

				$criteria->add(ReadingHistoryPeer::SF_GUARD_USER_ID, $this->getId());

				ReadingHistoryPeer::addSelectColumns($criteria);
				$this->collReadingHistorys = ReadingHistoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReadingHistoryPeer::SF_GUARD_USER_ID, $this->getId());

				ReadingHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastReadingHistoryCriteria) || !$this->lastReadingHistoryCriteria->equals($criteria)) {
					$this->collReadingHistorys = ReadingHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastReadingHistoryCriteria = $criteria;
		return $this->collReadingHistorys;
	}

	
	public function countReadingHistorys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseReadingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ReadingHistoryPeer::SF_GUARD_USER_ID, $this->getId());

		return ReadingHistoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addReadingHistory(ReadingHistory $l)
	{
		$this->collReadingHistorys[] = $l;
		$l->setsfGuardUser($this);
	}


	
	public function getReadingHistorysJoinNews($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseReadingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReadingHistorys === null) {
			if ($this->isNew()) {
				$this->collReadingHistorys = array();
			} else {

				$criteria->add(ReadingHistoryPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collReadingHistorys = ReadingHistoryPeer::doSelectJoinNews($criteria, $con);
			}
		} else {
									
			$criteria->add(ReadingHistoryPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastReadingHistoryCriteria) || !$this->lastReadingHistoryCriteria->equals($criteria)) {
				$this->collReadingHistorys = ReadingHistoryPeer::doSelectJoinNews($criteria, $con);
			}
		}
		$this->lastReadingHistoryCriteria = $criteria;

		return $this->collReadingHistorys;
	}


	
	public function getReadingHistorysJoinNotification($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseReadingHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReadingHistorys === null) {
			if ($this->isNew()) {
				$this->collReadingHistorys = array();
			} else {

				$criteria->add(ReadingHistoryPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collReadingHistorys = ReadingHistoryPeer::doSelectJoinNotification($criteria, $con);
			}
		} else {
									
			$criteria->add(ReadingHistoryPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastReadingHistoryCriteria) || !$this->lastReadingHistoryCriteria->equals($criteria)) {
				$this->collReadingHistorys = ReadingHistoryPeer::doSelectJoinNotification($criteria, $con);
			}
		}
		$this->lastReadingHistoryCriteria = $criteria;

		return $this->collReadingHistorys;
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

				$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

				ApplicationPeer::addSelectColumns($criteria);
				$this->collApplications = ApplicationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

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

		$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

		return ApplicationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addApplication(Application $l)
	{
		$this->collApplications[] = $l;
		$l->setsfGuardUser($this);
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

				$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collApplications = ApplicationPeer::doSelectJoinApproval($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastApplicationCriteria) || !$this->lastApplicationCriteria->equals($criteria)) {
				$this->collApplications = ApplicationPeer::doSelectJoinApproval($criteria, $con);
			}
		}
		$this->lastApplicationCriteria = $criteria;

		return $this->collApplications;
	}


	
	public function getApplicationsJoinProject($criteria = null, $con = null)
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

				$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collApplications = ApplicationPeer::doSelectJoinProject($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastApplicationCriteria) || !$this->lastApplicationCriteria->equals($criteria)) {
				$this->collApplications = ApplicationPeer::doSelectJoinProject($criteria, $con);
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

				$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collApplications = ApplicationPeer::doSelectJoinDepartment($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastApplicationCriteria) || !$this->lastApplicationCriteria->equals($criteria)) {
				$this->collApplications = ApplicationPeer::doSelectJoinDepartment($criteria, $con);
			}
		}
		$this->lastApplicationCriteria = $criteria;

		return $this->collApplications;
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

				$criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $this->getId());

				ApplicationWorkFlowPeer::addSelectColumns($criteria);
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $this->getId());

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

		$criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $this->getId());

		return ApplicationWorkFlowPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addApplicationWorkFlow(ApplicationWorkFlow $l)
	{
		$this->collApplicationWorkFlows[] = $l;
		$l->setsfGuardUser($this);
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

				$criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinApplication($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastApplicationWorkFlowCriteria) || !$this->lastApplicationWorkFlowCriteria->equals($criteria)) {
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinApplication($criteria, $con);
			}
		}
		$this->lastApplicationWorkFlowCriteria = $criteria;

		return $this->collApplicationWorkFlows;
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

				$criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinWorkflow($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastApplicationWorkFlowCriteria) || !$this->lastApplicationWorkFlowCriteria->equals($criteria)) {
				$this->collApplicationWorkFlows = ApplicationWorkFlowPeer::doSelectJoinWorkflow($criteria, $con);
			}
		}
		$this->lastApplicationWorkFlowCriteria = $criteria;

		return $this->collApplicationWorkFlows;
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

				$criteria->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

				TitleSfGuardUserPeer::addSelectColumns($criteria);
				$this->collTitleSfGuardUsers = TitleSfGuardUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

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

		$criteria->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

		return TitleSfGuardUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTitleSfGuardUser(TitleSfGuardUser $l)
	{
		$this->collTitleSfGuardUsers[] = $l;
		$l->setsfGuardUser($this);
	}


	
	public function getTitleSfGuardUsersJoinTitle($criteria = null, $con = null)
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

				$criteria->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

				$this->collTitleSfGuardUsers = TitleSfGuardUserPeer::doSelectJoinTitle($criteria, $con);
			}
		} else {
									
			$criteria->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $this->getId());

			if (!isset($this->lastTitleSfGuardUserCriteria) || !$this->lastTitleSfGuardUserCriteria->equals($criteria)) {
				$this->collTitleSfGuardUsers = TitleSfGuardUserPeer::doSelectJoinTitle($criteria, $con);
			}
		}
		$this->lastTitleSfGuardUserCriteria = $criteria;

		return $this->collTitleSfGuardUsers;
	}

	
	public function initsfGuardUserPermissions()
	{
		if ($this->collsfGuardUserPermissions === null) {
			$this->collsfGuardUserPermissions = array();
		}
	}

	
	public function getsfGuardUserPermissions($criteria = null, $con = null)
	{
				include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPermissionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserPermissions = array();
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

				sfGuardUserPermissionPeer::addSelectColumns($criteria);
				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

				sfGuardUserPermissionPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
					$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;
		return $this->collsfGuardUserPermissions;
	}

	
	public function countsfGuardUserPermissions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPermissionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

		return sfGuardUserPermissionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfGuardUserPermission(sfGuardUserPermission $l)
	{
		$this->collsfGuardUserPermissions[] = $l;
		$l->setsfGuardUser($this);
	}


	
	public function getsfGuardUserPermissionsJoinsfGuardPermission($criteria = null, $con = null)
	{
				include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserPermissionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserPermissions === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserPermissions = array();
			} else {

				$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelectJoinsfGuardPermission($criteria, $con);
			}
		} else {
									
			$criteria->add(sfGuardUserPermissionPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfGuardUserPermissionCriteria) || !$this->lastsfGuardUserPermissionCriteria->equals($criteria)) {
				$this->collsfGuardUserPermissions = sfGuardUserPermissionPeer::doSelectJoinsfGuardPermission($criteria, $con);
			}
		}
		$this->lastsfGuardUserPermissionCriteria = $criteria;

		return $this->collsfGuardUserPermissions;
	}

	
	public function initsfGuardUserGroups()
	{
		if ($this->collsfGuardUserGroups === null) {
			$this->collsfGuardUserGroups = array();
		}
	}

	
	public function getsfGuardUserGroups($criteria = null, $con = null)
	{
				include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserGroups = array();
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

				sfGuardUserGroupPeer::addSelectColumns($criteria);
				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

				sfGuardUserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
					$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;
		return $this->collsfGuardUserGroups;
	}

	
	public function countsfGuardUserGroups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

		return sfGuardUserGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfGuardUserGroup(sfGuardUserGroup $l)
	{
		$this->collsfGuardUserGroups[] = $l;
		$l->setsfGuardUser($this);
	}


	
	public function getsfGuardUserGroupsJoinsfGuardGroup($criteria = null, $con = null)
	{
				include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserGroups === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserGroups = array();
			} else {

				$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(sfGuardUserGroupPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfGuardUserGroupCriteria) || !$this->lastsfGuardUserGroupCriteria->equals($criteria)) {
				$this->collsfGuardUserGroups = sfGuardUserGroupPeer::doSelectJoinsfGuardGroup($criteria, $con);
			}
		}
		$this->lastsfGuardUserGroupCriteria = $criteria;

		return $this->collsfGuardUserGroups;
	}

	
	public function initsfGuardRememberKeys()
	{
		if ($this->collsfGuardRememberKeys === null) {
			$this->collsfGuardRememberKeys = array();
		}
	}

	
	public function getsfGuardRememberKeys($criteria = null, $con = null)
	{
				include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardRememberKeyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardRememberKeys === null) {
			if ($this->isNew()) {
			   $this->collsfGuardRememberKeys = array();
			} else {

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->getId());

				sfGuardRememberKeyPeer::addSelectColumns($criteria);
				$this->collsfGuardRememberKeys = sfGuardRememberKeyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->getId());

				sfGuardRememberKeyPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardRememberKeyCriteria) || !$this->lastsfGuardRememberKeyCriteria->equals($criteria)) {
					$this->collsfGuardRememberKeys = sfGuardRememberKeyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardRememberKeyCriteria = $criteria;
		return $this->collsfGuardRememberKeys;
	}

	
	public function countsfGuardRememberKeys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfGuardPlugin/lib/model/om/BasesfGuardRememberKeyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfGuardRememberKeyPeer::USER_ID, $this->getId());

		return sfGuardRememberKeyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfGuardRememberKey(sfGuardRememberKey $l)
	{
		$this->collsfGuardRememberKeys[] = $l;
		$l->setsfGuardUser($this);
	}

} 