<?php


abstract class BaseDepositMembersFavorites extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $deposit_members_id;


	
	protected $deposit_financial_products_id;


	
	protected $sync_status = '0';


	
	protected $uuid = '';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDepositMembers;

	
	protected $aDepositFinancialProducts;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDepositMembersId()
	{

		return $this->deposit_members_id;
	}

	
	public function getDepositFinancialProductsId()
	{

		return $this->deposit_financial_products_id;
	}

	
	public function getSyncStatus()
	{

		return $this->sync_status;
	}

	
	public function getUuid()
	{

		return $this->uuid;
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
			$this->modifiedColumns[] = DepositMembersFavoritesPeer::ID;
		}

	} 
	
	public function setDepositMembersId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_members_id !== $v) {
			$this->deposit_members_id = $v;
			$this->modifiedColumns[] = DepositMembersFavoritesPeer::DEPOSIT_MEMBERS_ID;
		}

		if ($this->aDepositMembers !== null && $this->aDepositMembers->getId() !== $v) {
			$this->aDepositMembers = null;
		}

	} 
	
	public function setDepositFinancialProductsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_financial_products_id !== $v) {
			$this->deposit_financial_products_id = $v;
			$this->modifiedColumns[] = DepositMembersFavoritesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID;
		}

		if ($this->aDepositFinancialProducts !== null && $this->aDepositFinancialProducts->getId() !== $v) {
			$this->aDepositFinancialProducts = null;
		}

	} 
	
	public function setSyncStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sync_status !== $v || $v === '0') {
			$this->sync_status = $v;
			$this->modifiedColumns[] = DepositMembersFavoritesPeer::SYNC_STATUS;
		}

	} 
	
	public function setUuid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uuid !== $v || $v === '') {
			$this->uuid = $v;
			$this->modifiedColumns[] = DepositMembersFavoritesPeer::UUID;
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
			$this->modifiedColumns[] = DepositMembersFavoritesPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositMembersFavoritesPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->deposit_members_id = $rs->getInt($startcol + 1);

			$this->deposit_financial_products_id = $rs->getInt($startcol + 2);

			$this->sync_status = $rs->getString($startcol + 3);

			$this->uuid = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositMembersFavorites object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersFavoritesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositMembersFavoritesPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositMembersFavoritesPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositMembersFavoritesPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositMembersFavoritesPeer::DATABASE_NAME);
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


												
			if ($this->aDepositMembers !== null) {
				if ($this->aDepositMembers->isModified()) {
					$affectedRows += $this->aDepositMembers->save($con);
				}
				$this->setDepositMembers($this->aDepositMembers);
			}

			if ($this->aDepositFinancialProducts !== null) {
				if ($this->aDepositFinancialProducts->isModified()) {
					$affectedRows += $this->aDepositFinancialProducts->save($con);
				}
				$this->setDepositFinancialProducts($this->aDepositFinancialProducts);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DepositMembersFavoritesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositMembersFavoritesPeer::doUpdate($this, $con);
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


												
			if ($this->aDepositMembers !== null) {
				if (!$this->aDepositMembers->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositMembers->getValidationFailures());
				}
			}

			if ($this->aDepositFinancialProducts !== null) {
				if (!$this->aDepositFinancialProducts->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositFinancialProducts->getValidationFailures());
				}
			}


			if (($retval = DepositMembersFavoritesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersFavoritesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDepositMembersId();
				break;
			case 2:
				return $this->getDepositFinancialProductsId();
				break;
			case 3:
				return $this->getSyncStatus();
				break;
			case 4:
				return $this->getUuid();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositMembersFavoritesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDepositMembersId(),
			$keys[2] => $this->getDepositFinancialProductsId(),
			$keys[3] => $this->getSyncStatus(),
			$keys[4] => $this->getUuid(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositMembersFavoritesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDepositMembersId($value);
				break;
			case 2:
				$this->setDepositFinancialProductsId($value);
				break;
			case 3:
				$this->setSyncStatus($value);
				break;
			case 4:
				$this->setUuid($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositMembersFavoritesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDepositMembersId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDepositFinancialProductsId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSyncStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUuid($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositMembersFavoritesPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositMembersFavoritesPeer::ID)) $criteria->add(DepositMembersFavoritesPeer::ID, $this->id);
		if ($this->isColumnModified(DepositMembersFavoritesPeer::DEPOSIT_MEMBERS_ID)) $criteria->add(DepositMembersFavoritesPeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);
		if ($this->isColumnModified(DepositMembersFavoritesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID)) $criteria->add(DepositMembersFavoritesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->deposit_financial_products_id);
		if ($this->isColumnModified(DepositMembersFavoritesPeer::SYNC_STATUS)) $criteria->add(DepositMembersFavoritesPeer::SYNC_STATUS, $this->sync_status);
		if ($this->isColumnModified(DepositMembersFavoritesPeer::UUID)) $criteria->add(DepositMembersFavoritesPeer::UUID, $this->uuid);
		if ($this->isColumnModified(DepositMembersFavoritesPeer::CREATED_AT)) $criteria->add(DepositMembersFavoritesPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositMembersFavoritesPeer::UPDATED_AT)) $criteria->add(DepositMembersFavoritesPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositMembersFavoritesPeer::DATABASE_NAME);

		$criteria->add(DepositMembersFavoritesPeer::ID, $this->id);
		$criteria->add(DepositMembersFavoritesPeer::DEPOSIT_MEMBERS_ID, $this->deposit_members_id);
		$criteria->add(DepositMembersFavoritesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->deposit_financial_products_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getDepositMembersId();

		$pks[2] = $this->getDepositFinancialProductsId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setDepositMembersId($keys[1]);

		$this->setDepositFinancialProductsId($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSyncStatus($this->sync_status);

		$copyObj->setUuid($this->uuid);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setDepositMembersId(NULL); 
		$copyObj->setDepositFinancialProductsId(NULL); 
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
			self::$peer = new DepositMembersFavoritesPeer();
		}
		return self::$peer;
	}

	
	public function setDepositMembers($v)
	{


		if ($v === null) {
			$this->setDepositMembersId(NULL);
		} else {
			$this->setDepositMembersId($v->getId());
		}


		$this->aDepositMembers = $v;
	}


	
	public function getDepositMembers($con = null)
	{
		if ($this->aDepositMembers === null && ($this->deposit_members_id !== null)) {
						include_once 'lib/model/om/BaseDepositMembersPeer.php';

			$this->aDepositMembers = DepositMembersPeer::retrieveByPK($this->deposit_members_id, $con);

			
		}
		return $this->aDepositMembers;
	}

	
	public function setDepositFinancialProducts($v)
	{


		if ($v === null) {
			$this->setDepositFinancialProductsId(NULL);
		} else {
			$this->setDepositFinancialProductsId($v->getId());
		}


		$this->aDepositFinancialProducts = $v;
	}


	
	public function getDepositFinancialProducts($con = null)
	{
		if ($this->aDepositFinancialProducts === null && ($this->deposit_financial_products_id !== null)) {
						include_once 'lib/model/om/BaseDepositFinancialProductsPeer.php';

			$this->aDepositFinancialProducts = DepositFinancialProductsPeer::retrieveByPK($this->deposit_financial_products_id, $con);

			
		}
		return $this->aDepositFinancialProducts;
	}

} 