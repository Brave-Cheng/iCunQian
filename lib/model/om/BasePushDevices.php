<?php


abstract class BasePushDevices extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $client_id = '';


	
	protected $app_name = '';


	
	protected $app_version = '';


	
	protected $device_uid = '';


	
	protected $device_name = '';


	
	protected $device_model = '';


	
	protected $device_version = '';


	
	protected $device_token = '';


	
	protected $development = 'sandbox';


	
	protected $status = 'unregistered';


	
	protected $city = '';


	
	protected $bank = 0;


	
	protected $profit_type = '';


	
	protected $expected_yield;


	
	protected $financial_cycle = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collPushMessagess;

	
	protected $lastPushMessagesCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getClientId()
	{

		return $this->client_id;
	}

	
	public function getAppName()
	{

		return $this->app_name;
	}

	
	public function getAppVersion()
	{

		return $this->app_version;
	}

	
	public function getDeviceUid()
	{

		return $this->device_uid;
	}

	
	public function getDeviceName()
	{

		return $this->device_name;
	}

	
	public function getDeviceModel()
	{

		return $this->device_model;
	}

	
	public function getDeviceVersion()
	{

		return $this->device_version;
	}

	
	public function getDeviceToken()
	{

		return $this->device_token;
	}

	
	public function getDevelopment()
	{

		return $this->development;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getCity()
	{

		return $this->city;
	}

	
	public function getBank()
	{

		return $this->bank;
	}

	
	public function getProfitType()
	{

		return $this->profit_type;
	}

	
	public function getExpectedYield()
	{

		return $this->expected_yield;
	}

	
	public function getFinancialCycle()
	{

		return $this->financial_cycle;
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
			$this->modifiedColumns[] = PushDevicesPeer::ID;
		}

	} 
	
	public function setClientId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->client_id !== $v || $v === '') {
			$this->client_id = $v;
			$this->modifiedColumns[] = PushDevicesPeer::CLIENT_ID;
		}

	} 
	
	public function setAppName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->app_name !== $v || $v === '') {
			$this->app_name = $v;
			$this->modifiedColumns[] = PushDevicesPeer::APP_NAME;
		}

	} 
	
	public function setAppVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->app_version !== $v || $v === '') {
			$this->app_version = $v;
			$this->modifiedColumns[] = PushDevicesPeer::APP_VERSION;
		}

	} 
	
	public function setDeviceUid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->device_uid !== $v || $v === '') {
			$this->device_uid = $v;
			$this->modifiedColumns[] = PushDevicesPeer::DEVICE_UID;
		}

	} 
	
	public function setDeviceName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->device_name !== $v || $v === '') {
			$this->device_name = $v;
			$this->modifiedColumns[] = PushDevicesPeer::DEVICE_NAME;
		}

	} 
	
	public function setDeviceModel($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->device_model !== $v || $v === '') {
			$this->device_model = $v;
			$this->modifiedColumns[] = PushDevicesPeer::DEVICE_MODEL;
		}

	} 
	
	public function setDeviceVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->device_version !== $v || $v === '') {
			$this->device_version = $v;
			$this->modifiedColumns[] = PushDevicesPeer::DEVICE_VERSION;
		}

	} 
	
	public function setDeviceToken($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->device_token !== $v || $v === '') {
			$this->device_token = $v;
			$this->modifiedColumns[] = PushDevicesPeer::DEVICE_TOKEN;
		}

	} 
	
	public function setDevelopment($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->development !== $v || $v === 'sandbox') {
			$this->development = $v;
			$this->modifiedColumns[] = PushDevicesPeer::DEVELOPMENT;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status !== $v || $v === 'unregistered') {
			$this->status = $v;
			$this->modifiedColumns[] = PushDevicesPeer::STATUS;
		}

	} 
	
	public function setCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v || $v === '') {
			$this->city = $v;
			$this->modifiedColumns[] = PushDevicesPeer::CITY;
		}

	} 
	
	public function setBank($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bank !== $v || $v === 0) {
			$this->bank = $v;
			$this->modifiedColumns[] = PushDevicesPeer::BANK;
		}

	} 
	
	public function setProfitType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->profit_type !== $v || $v === '') {
			$this->profit_type = $v;
			$this->modifiedColumns[] = PushDevicesPeer::PROFIT_TYPE;
		}

	} 
	
	public function setExpectedYield($v)
	{

		if ($this->expected_yield !== $v) {
			$this->expected_yield = $v;
			$this->modifiedColumns[] = PushDevicesPeer::EXPECTED_YIELD;
		}

	} 
	
	public function setFinancialCycle($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->financial_cycle !== $v || $v === 0) {
			$this->financial_cycle = $v;
			$this->modifiedColumns[] = PushDevicesPeer::FINANCIAL_CYCLE;
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
			$this->modifiedColumns[] = PushDevicesPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PushDevicesPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->client_id = $rs->getString($startcol + 1);

			$this->app_name = $rs->getString($startcol + 2);

			$this->app_version = $rs->getString($startcol + 3);

			$this->device_uid = $rs->getString($startcol + 4);

			$this->device_name = $rs->getString($startcol + 5);

			$this->device_model = $rs->getString($startcol + 6);

			$this->device_version = $rs->getString($startcol + 7);

			$this->device_token = $rs->getString($startcol + 8);

			$this->development = $rs->getString($startcol + 9);

			$this->status = $rs->getString($startcol + 10);

			$this->city = $rs->getString($startcol + 11);

			$this->bank = $rs->getInt($startcol + 12);

			$this->profit_type = $rs->getString($startcol + 13);

			$this->expected_yield = $rs->getFloat($startcol + 14);

			$this->financial_cycle = $rs->getInt($startcol + 15);

			$this->created_at = $rs->getTimestamp($startcol + 16, null);

			$this->updated_at = $rs->getTimestamp($startcol + 17, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PushDevices object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PushDevicesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PushDevicesPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PushDevicesPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PushDevicesPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PushDevicesPeer::DATABASE_NAME);
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
					$pk = PushDevicesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PushDevicesPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPushMessagess !== null) {
				foreach($this->collPushMessagess as $referrerFK) {
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


			if (($retval = PushDevicesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPushMessagess !== null) {
					foreach($this->collPushMessagess as $referrerFK) {
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
		$pos = PushDevicesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getClientId();
				break;
			case 2:
				return $this->getAppName();
				break;
			case 3:
				return $this->getAppVersion();
				break;
			case 4:
				return $this->getDeviceUid();
				break;
			case 5:
				return $this->getDeviceName();
				break;
			case 6:
				return $this->getDeviceModel();
				break;
			case 7:
				return $this->getDeviceVersion();
				break;
			case 8:
				return $this->getDeviceToken();
				break;
			case 9:
				return $this->getDevelopment();
				break;
			case 10:
				return $this->getStatus();
				break;
			case 11:
				return $this->getCity();
				break;
			case 12:
				return $this->getBank();
				break;
			case 13:
				return $this->getProfitType();
				break;
			case 14:
				return $this->getExpectedYield();
				break;
			case 15:
				return $this->getFinancialCycle();
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
		$keys = PushDevicesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getClientId(),
			$keys[2] => $this->getAppName(),
			$keys[3] => $this->getAppVersion(),
			$keys[4] => $this->getDeviceUid(),
			$keys[5] => $this->getDeviceName(),
			$keys[6] => $this->getDeviceModel(),
			$keys[7] => $this->getDeviceVersion(),
			$keys[8] => $this->getDeviceToken(),
			$keys[9] => $this->getDevelopment(),
			$keys[10] => $this->getStatus(),
			$keys[11] => $this->getCity(),
			$keys[12] => $this->getBank(),
			$keys[13] => $this->getProfitType(),
			$keys[14] => $this->getExpectedYield(),
			$keys[15] => $this->getFinancialCycle(),
			$keys[16] => $this->getCreatedAt(),
			$keys[17] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PushDevicesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setClientId($value);
				break;
			case 2:
				$this->setAppName($value);
				break;
			case 3:
				$this->setAppVersion($value);
				break;
			case 4:
				$this->setDeviceUid($value);
				break;
			case 5:
				$this->setDeviceName($value);
				break;
			case 6:
				$this->setDeviceModel($value);
				break;
			case 7:
				$this->setDeviceVersion($value);
				break;
			case 8:
				$this->setDeviceToken($value);
				break;
			case 9:
				$this->setDevelopment($value);
				break;
			case 10:
				$this->setStatus($value);
				break;
			case 11:
				$this->setCity($value);
				break;
			case 12:
				$this->setBank($value);
				break;
			case 13:
				$this->setProfitType($value);
				break;
			case 14:
				$this->setExpectedYield($value);
				break;
			case 15:
				$this->setFinancialCycle($value);
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
		$keys = PushDevicesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClientId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAppName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAppVersion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDeviceUid($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeviceName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeviceModel($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDeviceVersion($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDeviceToken($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDevelopment($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setStatus($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCity($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setBank($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setProfitType($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setExpectedYield($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setFinancialCycle($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUpdatedAt($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PushDevicesPeer::DATABASE_NAME);

		if ($this->isColumnModified(PushDevicesPeer::ID)) $criteria->add(PushDevicesPeer::ID, $this->id);
		if ($this->isColumnModified(PushDevicesPeer::CLIENT_ID)) $criteria->add(PushDevicesPeer::CLIENT_ID, $this->client_id);
		if ($this->isColumnModified(PushDevicesPeer::APP_NAME)) $criteria->add(PushDevicesPeer::APP_NAME, $this->app_name);
		if ($this->isColumnModified(PushDevicesPeer::APP_VERSION)) $criteria->add(PushDevicesPeer::APP_VERSION, $this->app_version);
		if ($this->isColumnModified(PushDevicesPeer::DEVICE_UID)) $criteria->add(PushDevicesPeer::DEVICE_UID, $this->device_uid);
		if ($this->isColumnModified(PushDevicesPeer::DEVICE_NAME)) $criteria->add(PushDevicesPeer::DEVICE_NAME, $this->device_name);
		if ($this->isColumnModified(PushDevicesPeer::DEVICE_MODEL)) $criteria->add(PushDevicesPeer::DEVICE_MODEL, $this->device_model);
		if ($this->isColumnModified(PushDevicesPeer::DEVICE_VERSION)) $criteria->add(PushDevicesPeer::DEVICE_VERSION, $this->device_version);
		if ($this->isColumnModified(PushDevicesPeer::DEVICE_TOKEN)) $criteria->add(PushDevicesPeer::DEVICE_TOKEN, $this->device_token);
		if ($this->isColumnModified(PushDevicesPeer::DEVELOPMENT)) $criteria->add(PushDevicesPeer::DEVELOPMENT, $this->development);
		if ($this->isColumnModified(PushDevicesPeer::STATUS)) $criteria->add(PushDevicesPeer::STATUS, $this->status);
		if ($this->isColumnModified(PushDevicesPeer::CITY)) $criteria->add(PushDevicesPeer::CITY, $this->city);
		if ($this->isColumnModified(PushDevicesPeer::BANK)) $criteria->add(PushDevicesPeer::BANK, $this->bank);
		if ($this->isColumnModified(PushDevicesPeer::PROFIT_TYPE)) $criteria->add(PushDevicesPeer::PROFIT_TYPE, $this->profit_type);
		if ($this->isColumnModified(PushDevicesPeer::EXPECTED_YIELD)) $criteria->add(PushDevicesPeer::EXPECTED_YIELD, $this->expected_yield);
		if ($this->isColumnModified(PushDevicesPeer::FINANCIAL_CYCLE)) $criteria->add(PushDevicesPeer::FINANCIAL_CYCLE, $this->financial_cycle);
		if ($this->isColumnModified(PushDevicesPeer::CREATED_AT)) $criteria->add(PushDevicesPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PushDevicesPeer::UPDATED_AT)) $criteria->add(PushDevicesPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PushDevicesPeer::DATABASE_NAME);

		$criteria->add(PushDevicesPeer::ID, $this->id);

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

		$copyObj->setClientId($this->client_id);

		$copyObj->setAppName($this->app_name);

		$copyObj->setAppVersion($this->app_version);

		$copyObj->setDeviceUid($this->device_uid);

		$copyObj->setDeviceName($this->device_name);

		$copyObj->setDeviceModel($this->device_model);

		$copyObj->setDeviceVersion($this->device_version);

		$copyObj->setDeviceToken($this->device_token);

		$copyObj->setDevelopment($this->development);

		$copyObj->setStatus($this->status);

		$copyObj->setCity($this->city);

		$copyObj->setBank($this->bank);

		$copyObj->setProfitType($this->profit_type);

		$copyObj->setExpectedYield($this->expected_yield);

		$copyObj->setFinancialCycle($this->financial_cycle);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPushMessagess() as $relObj) {
				$copyObj->addPushMessages($relObj->copy($deepCopy));
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
			self::$peer = new PushDevicesPeer();
		}
		return self::$peer;
	}

	
	public function initPushMessagess()
	{
		if ($this->collPushMessagess === null) {
			$this->collPushMessagess = array();
		}
	}

	
	public function getPushMessagess($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePushMessagesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPushMessagess === null) {
			if ($this->isNew()) {
			   $this->collPushMessagess = array();
			} else {

				$criteria->add(PushMessagesPeer::PUSH_DEVICES_ID, $this->getId());

				PushMessagesPeer::addSelectColumns($criteria);
				$this->collPushMessagess = PushMessagesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PushMessagesPeer::PUSH_DEVICES_ID, $this->getId());

				PushMessagesPeer::addSelectColumns($criteria);
				if (!isset($this->lastPushMessagesCriteria) || !$this->lastPushMessagesCriteria->equals($criteria)) {
					$this->collPushMessagess = PushMessagesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPushMessagesCriteria = $criteria;
		return $this->collPushMessagess;
	}

	
	public function countPushMessagess($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePushMessagesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PushMessagesPeer::PUSH_DEVICES_ID, $this->getId());

		return PushMessagesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPushMessages(PushMessages $l)
	{
		$this->collPushMessagess[] = $l;
		$l->setPushDevices($this);
	}


	
	public function getPushMessagessJoinDepositFinancialProducts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePushMessagesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPushMessagess === null) {
			if ($this->isNew()) {
				$this->collPushMessagess = array();
			} else {

				$criteria->add(PushMessagesPeer::PUSH_DEVICES_ID, $this->getId());

				$this->collPushMessagess = PushMessagesPeer::doSelectJoinDepositFinancialProducts($criteria, $con);
			}
		} else {
									
			$criteria->add(PushMessagesPeer::PUSH_DEVICES_ID, $this->getId());

			if (!isset($this->lastPushMessagesCriteria) || !$this->lastPushMessagesCriteria->equals($criteria)) {
				$this->collPushMessagess = PushMessagesPeer::doSelectJoinDepositFinancialProducts($criteria, $con);
			}
		}
		$this->lastPushMessagesCriteria = $criteria;

		return $this->collPushMessagess;
	}

} 