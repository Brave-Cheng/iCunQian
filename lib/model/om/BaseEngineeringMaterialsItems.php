<?php


abstract class BaseEngineeringMaterialsItems extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $engineering_materials_id;


	
	protected $material_name;


	
	protected $brand;


	
	protected $technical_requirement;


	
	protected $unit;


	
	protected $quantity;


	
	protected $arrival_date;


	
	protected $arrival_place;


	
	protected $comment;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aEngineeringMaterials;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEngineeringMaterialsId()
	{

		return $this->engineering_materials_id;
	}

	
	public function getMaterialName()
	{

		return $this->material_name;
	}

	
	public function getBrand()
	{

		return $this->brand;
	}

	
	public function getTechnicalRequirement()
	{

		return $this->technical_requirement;
	}

	
	public function getUnit()
	{

		return $this->unit;
	}

	
	public function getQuantity()
	{

		return $this->quantity;
	}

	
	public function getArrivalDate($format = 'Y-m-d')
	{

		if ($this->arrival_date === null || $this->arrival_date === '') {
			return null;
		} elseif (!is_int($this->arrival_date)) {
						$ts = strtotime($this->arrival_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [arrival_date] as date/time value: " . var_export($this->arrival_date, true));
			}
		} else {
			$ts = $this->arrival_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getArrivalPlace()
	{

		return $this->arrival_place;
	}

	
	public function getComment()
	{

		return $this->comment;
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
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::ID;
		}

	} 
	
	public function setEngineeringMaterialsId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->engineering_materials_id !== $v) {
			$this->engineering_materials_id = $v;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID;
		}

		if ($this->aEngineeringMaterials !== null && $this->aEngineeringMaterials->getId() !== $v) {
			$this->aEngineeringMaterials = null;
		}

	} 
	
	public function setMaterialName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->material_name !== $v) {
			$this->material_name = $v;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::MATERIAL_NAME;
		}

	} 
	
	public function setBrand($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->brand !== $v) {
			$this->brand = $v;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::BRAND;
		}

	} 
	
	public function setTechnicalRequirement($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->technical_requirement !== $v) {
			$this->technical_requirement = $v;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::TECHNICAL_REQUIREMENT;
		}

	} 
	
	public function setUnit($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->unit !== $v) {
			$this->unit = $v;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::UNIT;
		}

	} 
	
	public function setQuantity($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v) {
			$this->quantity = $v;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::QUANTITY;
		}

	} 
	
	public function setArrivalDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [arrival_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->arrival_date !== $ts) {
			$this->arrival_date = $ts;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::ARRIVAL_DATE;
		}

	} 
	
	public function setArrivalPlace($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->arrival_place !== $v) {
			$this->arrival_place = $v;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::ARRIVAL_PLACE;
		}

	} 
	
	public function setComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::COMMENT;
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
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EngineeringMaterialsItemsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->engineering_materials_id = $rs->getInt($startcol + 1);

			$this->material_name = $rs->getString($startcol + 2);

			$this->brand = $rs->getString($startcol + 3);

			$this->technical_requirement = $rs->getString($startcol + 4);

			$this->unit = $rs->getString($startcol + 5);

			$this->quantity = $rs->getInt($startcol + 6);

			$this->arrival_date = $rs->getDate($startcol + 7, null);

			$this->arrival_place = $rs->getString($startcol + 8);

			$this->comment = $rs->getString($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EngineeringMaterialsItems object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringMaterialsItemsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EngineeringMaterialsItemsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EngineeringMaterialsItemsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EngineeringMaterialsItemsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringMaterialsItemsPeer::DATABASE_NAME);
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


												
			if ($this->aEngineeringMaterials !== null) {
				if ($this->aEngineeringMaterials->isModified()) {
					$affectedRows += $this->aEngineeringMaterials->save($con);
				}
				$this->setEngineeringMaterials($this->aEngineeringMaterials);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EngineeringMaterialsItemsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EngineeringMaterialsItemsPeer::doUpdate($this, $con);
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


												
			if ($this->aEngineeringMaterials !== null) {
				if (!$this->aEngineeringMaterials->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEngineeringMaterials->getValidationFailures());
				}
			}


			if (($retval = EngineeringMaterialsItemsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringMaterialsItemsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEngineeringMaterialsId();
				break;
			case 2:
				return $this->getMaterialName();
				break;
			case 3:
				return $this->getBrand();
				break;
			case 4:
				return $this->getTechnicalRequirement();
				break;
			case 5:
				return $this->getUnit();
				break;
			case 6:
				return $this->getQuantity();
				break;
			case 7:
				return $this->getArrivalDate();
				break;
			case 8:
				return $this->getArrivalPlace();
				break;
			case 9:
				return $this->getComment();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EngineeringMaterialsItemsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEngineeringMaterialsId(),
			$keys[2] => $this->getMaterialName(),
			$keys[3] => $this->getBrand(),
			$keys[4] => $this->getTechnicalRequirement(),
			$keys[5] => $this->getUnit(),
			$keys[6] => $this->getQuantity(),
			$keys[7] => $this->getArrivalDate(),
			$keys[8] => $this->getArrivalPlace(),
			$keys[9] => $this->getComment(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringMaterialsItemsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEngineeringMaterialsId($value);
				break;
			case 2:
				$this->setMaterialName($value);
				break;
			case 3:
				$this->setBrand($value);
				break;
			case 4:
				$this->setTechnicalRequirement($value);
				break;
			case 5:
				$this->setUnit($value);
				break;
			case 6:
				$this->setQuantity($value);
				break;
			case 7:
				$this->setArrivalDate($value);
				break;
			case 8:
				$this->setArrivalPlace($value);
				break;
			case 9:
				$this->setComment($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EngineeringMaterialsItemsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEngineeringMaterialsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMaterialName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBrand($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTechnicalRequirement($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUnit($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setQuantity($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setArrivalDate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setArrivalPlace($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setComment($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EngineeringMaterialsItemsPeer::DATABASE_NAME);

		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::ID)) $criteria->add(EngineeringMaterialsItemsPeer::ID, $this->id);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID)) $criteria->add(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, $this->engineering_materials_id);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::MATERIAL_NAME)) $criteria->add(EngineeringMaterialsItemsPeer::MATERIAL_NAME, $this->material_name);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::BRAND)) $criteria->add(EngineeringMaterialsItemsPeer::BRAND, $this->brand);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::TECHNICAL_REQUIREMENT)) $criteria->add(EngineeringMaterialsItemsPeer::TECHNICAL_REQUIREMENT, $this->technical_requirement);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::UNIT)) $criteria->add(EngineeringMaterialsItemsPeer::UNIT, $this->unit);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::QUANTITY)) $criteria->add(EngineeringMaterialsItemsPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::ARRIVAL_DATE)) $criteria->add(EngineeringMaterialsItemsPeer::ARRIVAL_DATE, $this->arrival_date);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::ARRIVAL_PLACE)) $criteria->add(EngineeringMaterialsItemsPeer::ARRIVAL_PLACE, $this->arrival_place);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::COMMENT)) $criteria->add(EngineeringMaterialsItemsPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::CREATED_AT)) $criteria->add(EngineeringMaterialsItemsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EngineeringMaterialsItemsPeer::UPDATED_AT)) $criteria->add(EngineeringMaterialsItemsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EngineeringMaterialsItemsPeer::DATABASE_NAME);

		$criteria->add(EngineeringMaterialsItemsPeer::ID, $this->id);

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

		$copyObj->setEngineeringMaterialsId($this->engineering_materials_id);

		$copyObj->setMaterialName($this->material_name);

		$copyObj->setBrand($this->brand);

		$copyObj->setTechnicalRequirement($this->technical_requirement);

		$copyObj->setUnit($this->unit);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setArrivalDate($this->arrival_date);

		$copyObj->setArrivalPlace($this->arrival_place);

		$copyObj->setComment($this->comment);

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
			self::$peer = new EngineeringMaterialsItemsPeer();
		}
		return self::$peer;
	}

	
	public function setEngineeringMaterials($v)
	{


		if ($v === null) {
			$this->setEngineeringMaterialsId(NULL);
		} else {
			$this->setEngineeringMaterialsId($v->getId());
		}


		$this->aEngineeringMaterials = $v;
	}


	
	public function getEngineeringMaterials($con = null)
	{
		if ($this->aEngineeringMaterials === null && ($this->engineering_materials_id !== null)) {
						include_once 'lib/model/om/BaseEngineeringMaterialsPeer.php';

			$this->aEngineeringMaterials = EngineeringMaterialsPeer::retrieveByPK($this->engineering_materials_id, $con);

			
		}
		return $this->aEngineeringMaterials;
	}

} 