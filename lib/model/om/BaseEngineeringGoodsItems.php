<?php


abstract class BaseEngineeringGoodsItems extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $engineering_goods_id;


	
	protected $project_name;


	
	protected $brand;


	
	protected $requirement;


	
	protected $unit;


	
	protected $quantity;


	
	protected $comment;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aEngineeringGoods;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEngineeringGoodsId()
	{

		return $this->engineering_goods_id;
	}

	
	public function getProjectName()
	{

		return $this->project_name;
	}

	
	public function getBrand()
	{

		return $this->brand;
	}

	
	public function getRequirement()
	{

		return $this->requirement;
	}

	
	public function getUnit()
	{

		return $this->unit;
	}

	
	public function getQuantity()
	{

		return $this->quantity;
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
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::ID;
		}

	} 
	
	public function setEngineeringGoodsId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->engineering_goods_id !== $v) {
			$this->engineering_goods_id = $v;
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID;
		}

		if ($this->aEngineeringGoods !== null && $this->aEngineeringGoods->getId() !== $v) {
			$this->aEngineeringGoods = null;
		}

	} 
	
	public function setProjectName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->project_name !== $v) {
			$this->project_name = $v;
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::PROJECT_NAME;
		}

	} 
	
	public function setBrand($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->brand !== $v) {
			$this->brand = $v;
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::BRAND;
		}

	} 
	
	public function setRequirement($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->requirement !== $v) {
			$this->requirement = $v;
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::REQUIREMENT;
		}

	} 
	
	public function setUnit($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->unit !== $v) {
			$this->unit = $v;
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::UNIT;
		}

	} 
	
	public function setQuantity($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v) {
			$this->quantity = $v;
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::QUANTITY;
		}

	} 
	
	public function setComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::COMMENT;
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
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EngineeringGoodsItemsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->engineering_goods_id = $rs->getInt($startcol + 1);

			$this->project_name = $rs->getString($startcol + 2);

			$this->brand = $rs->getString($startcol + 3);

			$this->requirement = $rs->getString($startcol + 4);

			$this->unit = $rs->getString($startcol + 5);

			$this->quantity = $rs->getInt($startcol + 6);

			$this->comment = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EngineeringGoodsItems object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringGoodsItemsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EngineeringGoodsItemsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EngineeringGoodsItemsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EngineeringGoodsItemsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EngineeringGoodsItemsPeer::DATABASE_NAME);
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


												
			if ($this->aEngineeringGoods !== null) {
				if ($this->aEngineeringGoods->isModified()) {
					$affectedRows += $this->aEngineeringGoods->save($con);
				}
				$this->setEngineeringGoods($this->aEngineeringGoods);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EngineeringGoodsItemsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EngineeringGoodsItemsPeer::doUpdate($this, $con);
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


												
			if ($this->aEngineeringGoods !== null) {
				if (!$this->aEngineeringGoods->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEngineeringGoods->getValidationFailures());
				}
			}


			if (($retval = EngineeringGoodsItemsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringGoodsItemsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEngineeringGoodsId();
				break;
			case 2:
				return $this->getProjectName();
				break;
			case 3:
				return $this->getBrand();
				break;
			case 4:
				return $this->getRequirement();
				break;
			case 5:
				return $this->getUnit();
				break;
			case 6:
				return $this->getQuantity();
				break;
			case 7:
				return $this->getComment();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EngineeringGoodsItemsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEngineeringGoodsId(),
			$keys[2] => $this->getProjectName(),
			$keys[3] => $this->getBrand(),
			$keys[4] => $this->getRequirement(),
			$keys[5] => $this->getUnit(),
			$keys[6] => $this->getQuantity(),
			$keys[7] => $this->getComment(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EngineeringGoodsItemsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEngineeringGoodsId($value);
				break;
			case 2:
				$this->setProjectName($value);
				break;
			case 3:
				$this->setBrand($value);
				break;
			case 4:
				$this->setRequirement($value);
				break;
			case 5:
				$this->setUnit($value);
				break;
			case 6:
				$this->setQuantity($value);
				break;
			case 7:
				$this->setComment($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EngineeringGoodsItemsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEngineeringGoodsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProjectName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBrand($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRequirement($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUnit($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setQuantity($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setComment($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EngineeringGoodsItemsPeer::DATABASE_NAME);

		if ($this->isColumnModified(EngineeringGoodsItemsPeer::ID)) $criteria->add(EngineeringGoodsItemsPeer::ID, $this->id);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID)) $criteria->add(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, $this->engineering_goods_id);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::PROJECT_NAME)) $criteria->add(EngineeringGoodsItemsPeer::PROJECT_NAME, $this->project_name);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::BRAND)) $criteria->add(EngineeringGoodsItemsPeer::BRAND, $this->brand);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::REQUIREMENT)) $criteria->add(EngineeringGoodsItemsPeer::REQUIREMENT, $this->requirement);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::UNIT)) $criteria->add(EngineeringGoodsItemsPeer::UNIT, $this->unit);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::QUANTITY)) $criteria->add(EngineeringGoodsItemsPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::COMMENT)) $criteria->add(EngineeringGoodsItemsPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::CREATED_AT)) $criteria->add(EngineeringGoodsItemsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EngineeringGoodsItemsPeer::UPDATED_AT)) $criteria->add(EngineeringGoodsItemsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EngineeringGoodsItemsPeer::DATABASE_NAME);

		$criteria->add(EngineeringGoodsItemsPeer::ID, $this->id);

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

		$copyObj->setEngineeringGoodsId($this->engineering_goods_id);

		$copyObj->setProjectName($this->project_name);

		$copyObj->setBrand($this->brand);

		$copyObj->setRequirement($this->requirement);

		$copyObj->setUnit($this->unit);

		$copyObj->setQuantity($this->quantity);

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
			self::$peer = new EngineeringGoodsItemsPeer();
		}
		return self::$peer;
	}

	
	public function setEngineeringGoods($v)
	{


		if ($v === null) {
			$this->setEngineeringGoodsId(NULL);
		} else {
			$this->setEngineeringGoodsId($v->getId());
		}


		$this->aEngineeringGoods = $v;
	}


	
	public function getEngineeringGoods($con = null)
	{
		if ($this->aEngineeringGoods === null && ($this->engineering_goods_id !== null)) {
						include_once 'lib/model/om/BaseEngineeringGoodsPeer.php';

			$this->aEngineeringGoods = EngineeringGoodsPeer::retrieveByPK($this->engineering_goods_id, $con);

			
		}
		return $this->aEngineeringGoods;
	}

} 