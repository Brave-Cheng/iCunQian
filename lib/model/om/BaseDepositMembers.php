<?php


abstract class BaseDepositMembers extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $account = '';


	
	protected $nickname = '';


	
	protected $password = '';


	
	protected $mobile = '';


	
	protected $email = '';


	
	protected $avatar = '';


	
	protected $mobile_active = 'no';


	
	protected $email_active = 'no';


	
	protected $third_party_platform_type = 'null';


	
	protected $third_party_platform_account = '';


	
	protected $registration_time;


	
	protected $is_login = 'no';


	
	protected $last_login;


	
	protected $hash = '';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDepositPersonalProductss;

	
	protected $lastDepositPersonalProductsCriteria = null;

	
	protected $collDepositFeedbacks;

	
	protected $lastDepositFeedbackCriteria = null;

	
	protected $collDepositMembersDevices;

	
	protected $lastDepositMembersDeviceCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAccount()
	{

		return $this->account;
	}

	
	public function getNickname()
	{

		return $this->nickname;
	}

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getMobile()
	{

		return $this->mobile;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getAvatar()
	{

		return $this->avatar;
	}

	
	public function getMobileActive()
	{

		return $this->mobile_active;
	}

	
	public function getEmailActive()
	{

		return $this->email_active;
	}

	
	public function getThirdPartyPlatformType()
	{

		return $this->third_party_platform_type;
	}

	
	public function getThirdPartyPlatformAccount()
	{

		return $this->third_party_platform_account;
	}

	
	public function getRegistrationTime($format = 'Y-m-d H:i:s')
	{

		if ($this->registration_time === null || $this->registration_time === '') {
			return null;
		} elseif (!is_int($this->registration_time)) {
						$ts = strtotime($this->registration_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [registration_time] as date/time value: " . var_export($this->registration_time, true));
			}
		} else {
			$ts = $this->registration_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsLogin()
	{

		return $this->is_login;
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

	
	public function getHash()
	{

		return $this->hash;
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
			$this->modifiedColumns[] = DepositMembersPeer::ID;
		}

	} 
	
	public function setAccount($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->account !== $v || $v === '') {
			$this->account = $v;
			$this->modifiedColumns[] = DepositMembersPeer::ACCOUNT;
		}

	} 
	
	public function setNickname($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nickname !== $v || $v === '') {
			$this->nickname = $v;
			$this->modifiedColumns[] = DepositMembersPeer::NICKNAME;
		}

	} 
	
	public function setPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v || $v === '') {
			$this->password = $v;
			$this->modifiedColumns[] = DepositMembersPeer::PASSWORD;
		}

	} 
	
	public function setMobile($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mobile !== $v || $v === '') {
			$this->mobile = $v;
			$this->modifiedColumns[] = DepositMembersPeer::MOBILE;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v || $v === '') {
			$this->email = $v;
			$this->modifiedColumns[] = DepositMembersPeer::EMAIL;
		}

	} 
	
	public function setAvatar($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->avatar !== $v || $v === '') {
			$this->avatar = $v;
			$this->modifiedColumns[] = DepositMembersPeer::AVATAR;
		}

	} 
	
	public function setMobileActive($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mobile_active !== $v || $v === 'no') {
			$this->mobile_active = $v;
			$this->modifiedColumns[] = DepositMembersPeer::MOBILE_ACTIVE;
		}

	} 
	
	public function setEmailActive($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email_active !== $v || $v === 'no') {
			$this->email_active = $v;
			$this->modifiedColumns[] = DepositMembersPeer::EMAIL_ACTIVE;
		}

	} 
	
	public function setThirdPartyPlatformType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->third_party_platform_type !== $v || $v === 'null') {
			$this->third_party_platform_type = $v;
			$this->modifiedColumns[] = DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE;
		}

	} 
	
	public function setThirdPartyPlatformAccount($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->third_party_platform_account !== $v || $v === '') {
			$this->third_party_platform_account = $v;
			$this->modifiedColumns[] = DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT;
		}

	} 
	
	public function setRegistrationTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [registration_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->registration_time !== $ts) {
			$this->registration_time = $ts;
			$this->modifiedColumns[] = DepositMembersPeer::REGISTRATION_TIME;
		}

	} 
	
	public function setIsLogin($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->is_login !== $v || $v === 'no') {
			$this->is_login = $v;
			$this->modifiedColumns[] = DepositMembersPeer::IS_LOGIN;
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
			$this->modifiedColumns[] = DepositMembersPeer::LAST_LOGIN;
		}

	} 
	
	public function setHash($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->hash !== $v || $v === '') {
			$this->hash = $v;
			$this->modifiedColumns[] = DepositMembersPeer::HASH;
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
			$this->modifiedColumns[] = DepositMembersPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositMembersPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->account = $rs->getString($startcol + 1);

			$this->nickname = $rs->getString($startcol + 2);

			$this->password = $rs->getString($startcol + 3);

			$this->mobile = $rs->getString($startcol + 4);

			$this->email = $rs->getString($startcol + 5);

			$this->avatar = $rs->getString($startcol + 6);

			$this->mobile_active = $rs->getString($startcol + 7);

			$this->email_active = $rs->getString($startcol + 8);

			$this->third_party_platform_type = $rs->getString($startcol + 9);

			$this->third_party_platform_account = $rs->getString($startcol + 10);

			$this->registration_time = $rs->getTimestamp($startcol + 11, null);

			$this->is_login = $rs->getString($startcol + 12);

			$this->last_login = $rs->getTimestamp($startcol + 13, null);

			$this->hash = $rs->getString($startcol + 14);

			$this->created_at = $rs->getTimestamp($startcol + 15, null);

			$this->updated_at = $rs->getTimestamp($startcol + 16, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositMembers object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositMembersPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositMembersPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositMembersPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersPeer::DATABASE_NAME);
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
					$pk = DepositMembersPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositMembersPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDepositPersonalProductss !== null) {
				foreach($this->collDepositPersonalProductss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDepositFeedbacks !== null) {
				foreach($this->collDepositFeedbacks as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDepositMembersDevices !== null) {
				foreach($this->collDepositMembersDevices as $referrerFK) {
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


			if (($retval = DepositMembersPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDepositPersonalProductss !== null) {
					foreach($this->collDepositPersonalProductss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDepositFeedbacks !== null) {
					foreach($this->collDepositFeedbacks as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDepositMembersDevices !== null) {
					foreach($this->collDepositMembersDevices as $referrerFK) {
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
		$pos = DepositMembersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAccount();
				break;
			case 2:
				return $this->getNickname();
				break;
			case 3:
				return $this->getPassword();
				break;
			case 4:
				return $this->getMobile();
				break;
			case 5:
				return $this->getEmail();
				break;
			case 6:
				return $this->getAvatar();
				break;
			case 7:
				return $this->getMobileActive();
				break;
			case 8:
				return $this->getEmailActive();
				break;
			case 9:
				return $this->getThirdPartyPlatformType();
				break;
			case 10:
				return $this->getThirdPartyPlatformAccount();
				break;
			case 11:
				return $this->getRegistrationTime();
				break;
			case 12:
				return $this->getIsLogin();
				break;
			case 13:
				return $this->getLastLogin();
				break;
			case 14:
				return $this->getHash();
				break;
			case 15:
				return $this->getCreatedAt();
				break;
			case 16:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositMembersPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAccount(),
			$keys[2] => $this->getNickname(),
			$keys[3] => $this->getPassword(),
			$keys[4] => $this->getMobile(),
			$keys[5] => $this->getEmail(),
			$keys[6] => $this->getAvatar(),
			$keys[7] => $this->getMobileActive(),
			$keys[8] => $this->getEmailActive(),
			$keys[9] => $this->getThirdPartyPlatformType(),
			$keys[10] => $this->getThirdPartyPlatformAccount(),
			$keys[11] => $this->getRegistrationTime(),
			$keys[12] => $this->getIsLogin(),
			$keys[13] => $this->getLastLogin(),
			$keys[14] => $this->getHash(),
			$keys[15] => $this->getCreatedAt(),
			$keys[16] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAccount($value);
				break;
			case 2:
				$this->setNickname($value);
				break;
			case 3:
				$this->setPassword($value);
				break;
			case 4:
				$this->setMobile($value);
				break;
			case 5:
				$this->setEmail($value);
				break;
			case 6:
				$this->setAvatar($value);
				break;
			case 7:
				$this->setMobileActive($value);
				break;
			case 8:
				$this->setEmailActive($value);
				break;
			case 9:
				$this->setThirdPartyPlatformType($value);
				break;
			case 10:
				$this->setThirdPartyPlatformAccount($value);
				break;
			case 11:
				$this->setRegistrationTime($value);
				break;
			case 12:
				$this->setIsLogin($value);
				break;
			case 13:
				$this->setLastLogin($value);
				break;
			case 14:
				$this->setHash($value);
				break;
			case 15:
				$this->setCreatedAt($value);
				break;
			case 16:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositMembersPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAccount($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNickname($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPassword($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMobile($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEmail($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAvatar($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMobileActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEmailActive($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setThirdPartyPlatformType($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setThirdPartyPlatformAccount($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setRegistrationTime($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsLogin($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setLastLogin($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setHash($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedAt($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositMembersPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositMembersPeer::ID)) $criteria->add(DepositMembersPeer::ID, $this->id);
		if ($this->isColumnModified(DepositMembersPeer::ACCOUNT)) $criteria->add(DepositMembersPeer::ACCOUNT, $this->account);
		if ($this->isColumnModified(DepositMembersPeer::NICKNAME)) $criteria->add(DepositMembersPeer::NICKNAME, $this->nickname);
		if ($this->isColumnModified(DepositMembersPeer::PASSWORD)) $criteria->add(DepositMembersPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(DepositMembersPeer::MOBILE)) $criteria->add(DepositMembersPeer::MOBILE, $this->mobile);
		if ($this->isColumnModified(DepositMembersPeer::EMAIL)) $criteria->add(DepositMembersPeer::EMAIL, $this->email);
		if ($this->isColumnModified(DepositMembersPeer::AVATAR)) $criteria->add(DepositMembersPeer::AVATAR, $this->avatar);
		if ($this->isColumnModified(DepositMembersPeer::MOBILE_ACTIVE)) $criteria->add(DepositMembersPeer::MOBILE_ACTIVE, $this->mobile_active);
		if ($this->isColumnModified(DepositMembersPeer::EMAIL_ACTIVE)) $criteria->add(DepositMembersPeer::EMAIL_ACTIVE, $this->email_active);
		if ($this->isColumnModified(DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE)) $criteria->add(DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE, $this->third_party_platform_type);
		if ($this->isColumnModified(DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT)) $criteria->add(DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT, $this->third_party_platform_account);
		if ($this->isColumnModified(DepositMembersPeer::REGISTRATION_TIME)) $criteria->add(DepositMembersPeer::REGISTRATION_TIME, $this->registration_time);
		if ($this->isColumnModified(DepositMembersPeer::IS_LOGIN)) $criteria->add(DepositMembersPeer::IS_LOGIN, $this->is_login);
		if ($this->isColumnModified(DepositMembersPeer::LAST_LOGIN)) $criteria->add(DepositMembersPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(DepositMembersPeer::HASH)) $criteria->add(DepositMembersPeer::HASH, $this->hash);
		if ($this->isColumnModified(DepositMembersPeer::CREATED_AT)) $criteria->add(DepositMembersPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositMembersPeer::UPDATED_AT)) $criteria->add(DepositMembersPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositMembersPeer::DATABASE_NAME);

		$criteria->add(DepositMembersPeer::ID, $this->id);

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

		$copyObj->setAccount($this->account);

		$copyObj->setNickname($this->nickname);

		$copyObj->setPassword($this->password);

		$copyObj->setMobile($this->mobile);

		$copyObj->setEmail($this->email);

		$copyObj->setAvatar($this->avatar);

		$copyObj->setMobileActive($this->mobile_active);

		$copyObj->setEmailActive($this->email_active);

		$copyObj->setThirdPartyPlatformType($this->third_party_platform_type);

		$copyObj->setThirdPartyPlatformAccount($this->third_party_platform_account);

		$copyObj->setRegistrationTime($this->registration_time);

		$copyObj->setIsLogin($this->is_login);

		$copyObj->setLastLogin($this->last_login);

		$copyObj->setHash($this->hash);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDepositPersonalProductss() as $relObj) {
				$copyObj->addDepositPersonalProducts($relObj->copy($deepCopy));
			}

			foreach($this->getDepositFeedbacks() as $relObj) {
				$copyObj->addDepositFeedback($relObj->copy($deepCopy));
			}

			foreach($this->getDepositMembersDevices() as $relObj) {
				$copyObj->addDepositMembersDevice($relObj->copy($deepCopy));
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
			self::$peer = new DepositMembersPeer();
		}
		return self::$peer;
	}

	
	public function initDepositPersonalProductss()
	{
		if ($this->collDepositPersonalProductss === null) {
			$this->collDepositPersonalProductss = array();
		}
	}

	
	public function getDepositPersonalProductss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositPersonalProductsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositPersonalProductss === null) {
			if ($this->isNew()) {
			   $this->collDepositPersonalProductss = array();
			} else {

				$criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $this->getId());

				DepositPersonalProductsPeer::addSelectColumns($criteria);
				$this->collDepositPersonalProductss = DepositPersonalProductsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $this->getId());

				DepositPersonalProductsPeer::addSelectColumns($criteria);
				if (!isset($this->lastDepositPersonalProductsCriteria) || !$this->lastDepositPersonalProductsCriteria->equals($criteria)) {
					$this->collDepositPersonalProductss = DepositPersonalProductsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDepositPersonalProductsCriteria = $criteria;
		return $this->collDepositPersonalProductss;
	}

	
	public function countDepositPersonalProductss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDepositPersonalProductsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $this->getId());

		return DepositPersonalProductsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepositPersonalProducts(DepositPersonalProducts $l)
	{
		$this->collDepositPersonalProductss[] = $l;
		$l->setDepositMembers($this);
	}


	
	public function getDepositPersonalProductssJoinDepositFinancialProducts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositPersonalProductsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositPersonalProductss === null) {
			if ($this->isNew()) {
				$this->collDepositPersonalProductss = array();
			} else {

				$criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $this->getId());

				$this->collDepositPersonalProductss = DepositPersonalProductsPeer::doSelectJoinDepositFinancialProducts($criteria, $con);
			}
		} else {
									
			$criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $this->getId());

			if (!isset($this->lastDepositPersonalProductsCriteria) || !$this->lastDepositPersonalProductsCriteria->equals($criteria)) {
				$this->collDepositPersonalProductss = DepositPersonalProductsPeer::doSelectJoinDepositFinancialProducts($criteria, $con);
			}
		}
		$this->lastDepositPersonalProductsCriteria = $criteria;

		return $this->collDepositPersonalProductss;
	}

	
	public function initDepositFeedbacks()
	{
		if ($this->collDepositFeedbacks === null) {
			$this->collDepositFeedbacks = array();
		}
	}

	
	public function getDepositFeedbacks($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositFeedbackPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositFeedbacks === null) {
			if ($this->isNew()) {
			   $this->collDepositFeedbacks = array();
			} else {

				$criteria->add(DepositFeedbackPeer::DEPOSIT_MEMBERS_ID, $this->getId());

				DepositFeedbackPeer::addSelectColumns($criteria);
				$this->collDepositFeedbacks = DepositFeedbackPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepositFeedbackPeer::DEPOSIT_MEMBERS_ID, $this->getId());

				DepositFeedbackPeer::addSelectColumns($criteria);
				if (!isset($this->lastDepositFeedbackCriteria) || !$this->lastDepositFeedbackCriteria->equals($criteria)) {
					$this->collDepositFeedbacks = DepositFeedbackPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDepositFeedbackCriteria = $criteria;
		return $this->collDepositFeedbacks;
	}

	
	public function countDepositFeedbacks($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDepositFeedbackPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DepositFeedbackPeer::DEPOSIT_MEMBERS_ID, $this->getId());

		return DepositFeedbackPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepositFeedback(DepositFeedback $l)
	{
		$this->collDepositFeedbacks[] = $l;
		$l->setDepositMembers($this);
	}

	
	public function initDepositMembersDevices()
	{
		if ($this->collDepositMembersDevices === null) {
			$this->collDepositMembersDevices = array();
		}
	}

	
	public function getDepositMembersDevices($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositMembersDevicePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositMembersDevices === null) {
			if ($this->isNew()) {
			   $this->collDepositMembersDevices = array();
			} else {

				$criteria->add(DepositMembersDevicePeer::DEPOSIT_MEMBERS_ID, $this->getId());

				DepositMembersDevicePeer::addSelectColumns($criteria);
				$this->collDepositMembersDevices = DepositMembersDevicePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepositMembersDevicePeer::DEPOSIT_MEMBERS_ID, $this->getId());

				DepositMembersDevicePeer::addSelectColumns($criteria);
				if (!isset($this->lastDepositMembersDeviceCriteria) || !$this->lastDepositMembersDeviceCriteria->equals($criteria)) {
					$this->collDepositMembersDevices = DepositMembersDevicePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDepositMembersDeviceCriteria = $criteria;
		return $this->collDepositMembersDevices;
	}

	
	public function countDepositMembersDevices($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDepositMembersDevicePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DepositMembersDevicePeer::DEPOSIT_MEMBERS_ID, $this->getId());

		return DepositMembersDevicePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepositMembersDevice(DepositMembersDevice $l)
	{
		$this->collDepositMembersDevices[] = $l;
		$l->setDepositMembers($this);
	}

} 