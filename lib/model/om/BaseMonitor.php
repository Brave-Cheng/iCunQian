<?php


abstract class BaseMonitor extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $monitoring_address_id;


	
	protected $ip;


	
	protected $description;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aMonitoringAddress;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getMonitoringAddressId()
	{

		return $this->monitoring_address_id;
	}

	
	public function getIp()
	{

		return $this->ip;
	}

	
	public function getDescription()
	{

		return $this->description;
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
			$this->modifiedColumns[] = MonitorPeer::ID;
		}

	} 
	
	public function setMonitoringAddressId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->monitoring_address_id !== $v) {
			$this->monitoring_address_id = $v;
			$this->modifiedColumns[] = MonitorPeer::MONITORING_ADDRESS_ID;
		}

		if ($this->aMonitoringAddress !== null && $this->aMonitoringAddress->getId() !== $v) {
			$this->aMonitoringAddress = null;
		}

	} 
	
	public function setIp($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip !== $v) {
			$this->ip = $v;
			$this->modifiedColumns[] = MonitorPeer::IP;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = MonitorPeer::DESCRIPTION;
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
			$this->modifiedColumns[] = MonitorPeer::CREATED_AT;
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
			$this->modifiedColumns[] = MonitorPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->monitoring_address_id = $rs->getInt($startcol + 1);

			$this->ip = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Monitor object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MonitorPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MonitorPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(MonitorPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(MonitorPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MonitorPeer::DATABASE_NAME);
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


												
			if ($this->aMonitoringAddress !== null) {
				if ($this->aMonitoringAddress->isModified()) {
					$affectedRows += $this->aMonitoringAddress->save($con);
				}
				$this->setMonitoringAddress($this->aMonitoringAddress);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MonitorPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MonitorPeer::doUpdate($this, $con);
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


												
			if ($this->aMonitoringAddress !== null) {
				if (!$this->aMonitoringAddress->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMonitoringAddress->getValidationFailures());
				}
			}


			if (($retval = MonitorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MonitorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getMonitoringAddressId();
				break;
			case 2:
				return $this->getIp();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MonitorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMonitoringAddressId(),
			$keys[2] => $this->getIp(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MonitorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setMonitoringAddressId($value);
				break;
			case 2:
				$this->setIp($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MonitorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMonitoringAddressId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIp($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MonitorPeer::DATABASE_NAME);

		if ($this->isColumnModified(MonitorPeer::ID)) $criteria->add(MonitorPeer::ID, $this->id);
		if ($this->isColumnModified(MonitorPeer::MONITORING_ADDRESS_ID)) $criteria->add(MonitorPeer::MONITORING_ADDRESS_ID, $this->monitoring_address_id);
		if ($this->isColumnModified(MonitorPeer::IP)) $criteria->add(MonitorPeer::IP, $this->ip);
		if ($this->isColumnModified(MonitorPeer::DESCRIPTION)) $criteria->add(MonitorPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(MonitorPeer::CREATED_AT)) $criteria->add(MonitorPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MonitorPeer::UPDATED_AT)) $criteria->add(MonitorPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MonitorPeer::DATABASE_NAME);

		$criteria->add(MonitorPeer::ID, $this->id);

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

		$copyObj->setMonitoringAddressId($this->monitoring_address_id);

		$copyObj->setIp($this->ip);

		$copyObj->setDescription($this->description);

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
			self::$peer = new MonitorPeer();
		}
		return self::$peer;
	}

	
	public function setMonitoringAddress($v)
	{


		if ($v === null) {
			$this->setMonitoringAddressId(NULL);
		} else {
			$this->setMonitoringAddressId($v->getId());
		}


		$this->aMonitoringAddress = $v;
	}


	
	public function getMonitoringAddress($con = null)
	{
		if ($this->aMonitoringAddress === null && ($this->monitoring_address_id !== null)) {
						include_once 'lib/model/om/BaseMonitoringAddressPeer.php';

			$this->aMonitoringAddress = MonitoringAddressPeer::retrieveByPK($this->monitoring_address_id, $con);

			
		}
		return $this->aMonitoringAddress;
	}

} 