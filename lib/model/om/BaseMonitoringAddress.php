<?php


abstract class BaseMonitoringAddress extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $county_id;


	
	protected $office_of_the_company_name;


	
	protected $address;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collMonitors;

	
	protected $lastMonitorCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCountyId()
	{

		return $this->county_id;
	}

	
	public function getOfficeOfTheCompanyName()
	{

		return $this->office_of_the_company_name;
	}

	
	public function getAddress()
	{

		return $this->address;
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
			$this->modifiedColumns[] = MonitoringAddressPeer::ID;
		}

	} 
	
	public function setCountyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->county_id !== $v) {
			$this->county_id = $v;
			$this->modifiedColumns[] = MonitoringAddressPeer::COUNTY_ID;
		}

	} 
	
	public function setOfficeOfTheCompanyName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->office_of_the_company_name !== $v) {
			$this->office_of_the_company_name = $v;
			$this->modifiedColumns[] = MonitoringAddressPeer::OFFICE_OF_THE_COMPANY_NAME;
		}

	} 
	
	public function setAddress($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = MonitoringAddressPeer::ADDRESS;
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
			$this->modifiedColumns[] = MonitoringAddressPeer::CREATED_AT;
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
			$this->modifiedColumns[] = MonitoringAddressPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->county_id = $rs->getInt($startcol + 1);

			$this->office_of_the_company_name = $rs->getString($startcol + 2);

			$this->address = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating MonitoringAddress object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MonitoringAddressPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MonitoringAddressPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(MonitoringAddressPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(MonitoringAddressPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MonitoringAddressPeer::DATABASE_NAME);
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
					$pk = MonitoringAddressPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MonitoringAddressPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collMonitors !== null) {
				foreach($this->collMonitors as $referrerFK) {
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


			if (($retval = MonitoringAddressPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMonitors !== null) {
					foreach($this->collMonitors as $referrerFK) {
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
		$pos = MonitoringAddressPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCountyId();
				break;
			case 2:
				return $this->getOfficeOfTheCompanyName();
				break;
			case 3:
				return $this->getAddress();
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
		$keys = MonitoringAddressPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCountyId(),
			$keys[2] => $this->getOfficeOfTheCompanyName(),
			$keys[3] => $this->getAddress(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MonitoringAddressPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCountyId($value);
				break;
			case 2:
				$this->setOfficeOfTheCompanyName($value);
				break;
			case 3:
				$this->setAddress($value);
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
		$keys = MonitoringAddressPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCountyId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOfficeOfTheCompanyName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAddress($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MonitoringAddressPeer::DATABASE_NAME);

		if ($this->isColumnModified(MonitoringAddressPeer::ID)) $criteria->add(MonitoringAddressPeer::ID, $this->id);
		if ($this->isColumnModified(MonitoringAddressPeer::COUNTY_ID)) $criteria->add(MonitoringAddressPeer::COUNTY_ID, $this->county_id);
		if ($this->isColumnModified(MonitoringAddressPeer::OFFICE_OF_THE_COMPANY_NAME)) $criteria->add(MonitoringAddressPeer::OFFICE_OF_THE_COMPANY_NAME, $this->office_of_the_company_name);
		if ($this->isColumnModified(MonitoringAddressPeer::ADDRESS)) $criteria->add(MonitoringAddressPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(MonitoringAddressPeer::CREATED_AT)) $criteria->add(MonitoringAddressPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MonitoringAddressPeer::UPDATED_AT)) $criteria->add(MonitoringAddressPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MonitoringAddressPeer::DATABASE_NAME);

		$criteria->add(MonitoringAddressPeer::ID, $this->id);

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

		$copyObj->setCountyId($this->county_id);

		$copyObj->setOfficeOfTheCompanyName($this->office_of_the_company_name);

		$copyObj->setAddress($this->address);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getMonitors() as $relObj) {
				$copyObj->addMonitor($relObj->copy($deepCopy));
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
			self::$peer = new MonitoringAddressPeer();
		}
		return self::$peer;
	}

	
	public function initMonitors()
	{
		if ($this->collMonitors === null) {
			$this->collMonitors = array();
		}
	}

	
	public function getMonitors($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMonitorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMonitors === null) {
			if ($this->isNew()) {
			   $this->collMonitors = array();
			} else {

				$criteria->add(MonitorPeer::MONITORING_ADDRESS_ID, $this->getId());

				MonitorPeer::addSelectColumns($criteria);
				$this->collMonitors = MonitorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MonitorPeer::MONITORING_ADDRESS_ID, $this->getId());

				MonitorPeer::addSelectColumns($criteria);
				if (!isset($this->lastMonitorCriteria) || !$this->lastMonitorCriteria->equals($criteria)) {
					$this->collMonitors = MonitorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMonitorCriteria = $criteria;
		return $this->collMonitors;
	}

	
	public function countMonitors($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMonitorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MonitorPeer::MONITORING_ADDRESS_ID, $this->getId());

		return MonitorPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMonitor(Monitor $l)
	{
		$this->collMonitors[] = $l;
		$l->setMonitoringAddress($this);
	}

} 