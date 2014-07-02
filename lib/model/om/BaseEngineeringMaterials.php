<?php


abstract class BaseEngineeringMaterials extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $application_id;


	
	protected $contract_section;


	
	protected $number;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aApplication;

	
	protected $collEngineeringMaterialsItemss;

	
	protected $lastEngineeringMaterialsItemsCriteria = null;

	
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

	
	public function getContractSection()
	{

		return $this->contract_section;
	}

	
	public function getNumber()
	{

		return $this->number;
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
			$this->modifiedColumns[] = EngineeringMaterialsPeer::ID;
		}

	} 
	
	public function setApplicationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->application_id !== $v) {
			$this->application_id = $v;
			$this->modifiedColumns[] = EngineeringMaterialsPeer::APPLICATION_ID;
		}

		if ($this->aApplication !== null && $this->aApplication->getId() !== $v) {
			$this->aApplication = null;
		}

	} 
	
	public function setContractSection($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contract_section !== $v) {
			$this->contract_section = $v;
			$this->modifiedColumns[] = EngineeringMaterialsPeer::CONTRACT_SECTION;
		}

	} 
	
	public function setNumber($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->number !== $v) {
			$this->number = $v;
			$this->modifiedColumns[] = EngineeringMaterialsPeer::NUMBER;
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
			$this->modifiedColumns[] = EngineeringMaterialsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EngineeringMaterialsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->application_id = $rs->getInt($startcol + 1);

			$this->contract_section = $rs->getString($startcol + 2);

			$this->number = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EngineeringMaterials object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringMaterialsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EngineeringMaterialsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EngineeringMaterialsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EngineeringMaterialsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringMaterialsPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EngineeringMaterialsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EngineeringMaterialsPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collEngineeringMaterialsItemss !== null) {
				foreach($this->collEngineeringMaterialsItemss as $referrerFK) {
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


												
			if ($this->aApplication !== null) {
				if (!$this->aApplication->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aApplication->getValidationFailures());
				}
			}


			if (($retval = EngineeringMaterialsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEngineeringMaterialsItemss !== null) {
					foreach($this->collEngineeringMaterialsItemss as $referrerFK) {
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
		$pos = EngineeringMaterialsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getContractSection();
				break;
			case 3:
				return $this->getNumber();
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
		$keys = EngineeringMaterialsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getApplicationId(),
			$keys[2] => $this->getContractSection(),
			$keys[3] => $this->getNumber(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringMaterialsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setContractSection($value);
				break;
			case 3:
				$this->setNumber($value);
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
		$keys = EngineeringMaterialsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setApplicationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContractSection($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EngineeringMaterialsPeer::DATABASE_NAME);

		if ($this->isColumnModified(EngineeringMaterialsPeer::ID)) $criteria->add(EngineeringMaterialsPeer::ID, $this->id);
		if ($this->isColumnModified(EngineeringMaterialsPeer::APPLICATION_ID)) $criteria->add(EngineeringMaterialsPeer::APPLICATION_ID, $this->application_id);
		if ($this->isColumnModified(EngineeringMaterialsPeer::CONTRACT_SECTION)) $criteria->add(EngineeringMaterialsPeer::CONTRACT_SECTION, $this->contract_section);
		if ($this->isColumnModified(EngineeringMaterialsPeer::NUMBER)) $criteria->add(EngineeringMaterialsPeer::NUMBER, $this->number);
		if ($this->isColumnModified(EngineeringMaterialsPeer::CREATED_AT)) $criteria->add(EngineeringMaterialsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EngineeringMaterialsPeer::UPDATED_AT)) $criteria->add(EngineeringMaterialsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EngineeringMaterialsPeer::DATABASE_NAME);

		$criteria->add(EngineeringMaterialsPeer::ID, $this->id);

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

		$copyObj->setContractSection($this->contract_section);

		$copyObj->setNumber($this->number);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getEngineeringMaterialsItemss() as $relObj) {
				$copyObj->addEngineeringMaterialsItems($relObj->copy($deepCopy));
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
			self::$peer = new EngineeringMaterialsPeer();
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

	
	public function initEngineeringMaterialsItemss()
	{
		if ($this->collEngineeringMaterialsItemss === null) {
			$this->collEngineeringMaterialsItemss = array();
		}
	}

	
	public function getEngineeringMaterialsItemss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringMaterialsItemsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEngineeringMaterialsItemss === null) {
			if ($this->isNew()) {
			   $this->collEngineeringMaterialsItemss = array();
			} else {

				$criteria->add(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, $this->getId());

				EngineeringMaterialsItemsPeer::addSelectColumns($criteria);
				$this->collEngineeringMaterialsItemss = EngineeringMaterialsItemsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, $this->getId());

				EngineeringMaterialsItemsPeer::addSelectColumns($criteria);
				if (!isset($this->lastEngineeringMaterialsItemsCriteria) || !$this->lastEngineeringMaterialsItemsCriteria->equals($criteria)) {
					$this->collEngineeringMaterialsItemss = EngineeringMaterialsItemsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEngineeringMaterialsItemsCriteria = $criteria;
		return $this->collEngineeringMaterialsItemss;
	}

	
	public function countEngineeringMaterialsItemss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEngineeringMaterialsItemsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, $this->getId());

		return EngineeringMaterialsItemsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEngineeringMaterialsItems(EngineeringMaterialsItems $l)
	{
		$this->collEngineeringMaterialsItemss[] = $l;
		$l->setEngineeringMaterials($this);
	}

} 