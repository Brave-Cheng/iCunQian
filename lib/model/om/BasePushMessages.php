<?php


abstract class BasePushMessages extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $deposit_financial_products_id;


	
	protected $push_devices_id;


	
	protected $type = 'client';


	
	protected $message = '';


	
	protected $delivery;


	
	protected $status = 'queued';


	
	protected $error_message = '';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDepositFinancialProducts;

	
	protected $aPushDevices;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDepositFinancialProductsId()
	{

		return $this->deposit_financial_products_id;
	}

	
	public function getPushDevicesId()
	{

		return $this->push_devices_id;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getMessage()
	{

		return $this->message;
	}

	
	public function getDelivery($format = 'Y-m-d H:i:s')
	{

		if ($this->delivery === null || $this->delivery === '') {
			return null;
		} elseif (!is_int($this->delivery)) {
						$ts = strtotime($this->delivery);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [delivery] as date/time value: " . var_export($this->delivery, true));
			}
		} else {
			$ts = $this->delivery;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getErrorMessage()
	{

		return $this->error_message;
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
			$this->modifiedColumns[] = PushMessagesPeer::ID;
		}

	} 
	
	public function setDepositFinancialProductsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_financial_products_id !== $v) {
			$this->deposit_financial_products_id = $v;
			$this->modifiedColumns[] = PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID;
		}

		if ($this->aDepositFinancialProducts !== null && $this->aDepositFinancialProducts->getId() !== $v) {
			$this->aDepositFinancialProducts = null;
		}

	} 
	
	public function setPushDevicesId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->push_devices_id !== $v) {
			$this->push_devices_id = $v;
			$this->modifiedColumns[] = PushMessagesPeer::PUSH_DEVICES_ID;
		}

		if ($this->aPushDevices !== null && $this->aPushDevices->getId() !== $v) {
			$this->aPushDevices = null;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v || $v === 'client') {
			$this->type = $v;
			$this->modifiedColumns[] = PushMessagesPeer::TYPE;
		}

	} 
	
	public function setMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message !== $v || $v === '') {
			$this->message = $v;
			$this->modifiedColumns[] = PushMessagesPeer::MESSAGE;
		}

	} 
	
	public function setDelivery($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [delivery] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->delivery !== $ts) {
			$this->delivery = $ts;
			$this->modifiedColumns[] = PushMessagesPeer::DELIVERY;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status !== $v || $v === 'queued') {
			$this->status = $v;
			$this->modifiedColumns[] = PushMessagesPeer::STATUS;
		}

	} 
	
	public function setErrorMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->error_message !== $v || $v === '') {
			$this->error_message = $v;
			$this->modifiedColumns[] = PushMessagesPeer::ERROR_MESSAGE;
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
			$this->modifiedColumns[] = PushMessagesPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PushMessagesPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->deposit_financial_products_id = $rs->getInt($startcol + 1);

			$this->push_devices_id = $rs->getInt($startcol + 2);

			$this->type = $rs->getString($startcol + 3);

			$this->message = $rs->getString($startcol + 4);

			$this->delivery = $rs->getTimestamp($startcol + 5, null);

			$this->status = $rs->getString($startcol + 6);

			$this->error_message = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PushMessages object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PushMessagesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PushMessagesPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PushMessagesPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PushMessagesPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PushMessagesPeer::DATABASE_NAME);
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


												
			if ($this->aDepositFinancialProducts !== null) {
				if ($this->aDepositFinancialProducts->isModified()) {
					$affectedRows += $this->aDepositFinancialProducts->save($con);
				}
				$this->setDepositFinancialProducts($this->aDepositFinancialProducts);
			}

			if ($this->aPushDevices !== null) {
				if ($this->aPushDevices->isModified()) {
					$affectedRows += $this->aPushDevices->save($con);
				}
				$this->setPushDevices($this->aPushDevices);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PushMessagesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PushMessagesPeer::doUpdate($this, $con);
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


												
			if ($this->aDepositFinancialProducts !== null) {
				if (!$this->aDepositFinancialProducts->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositFinancialProducts->getValidationFailures());
				}
			}

			if ($this->aPushDevices !== null) {
				if (!$this->aPushDevices->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPushDevices->getValidationFailures());
				}
			}


			if (($retval = PushMessagesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PushMessagesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDepositFinancialProductsId();
				break;
			case 2:
				return $this->getPushDevicesId();
				break;
			case 3:
				return $this->getType();
				break;
			case 4:
				return $this->getMessage();
				break;
			case 5:
				return $this->getDelivery();
				break;
			case 6:
				return $this->getStatus();
				break;
			case 7:
				return $this->getErrorMessage();
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
		$keys = PushMessagesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDepositFinancialProductsId(),
			$keys[2] => $this->getPushDevicesId(),
			$keys[3] => $this->getType(),
			$keys[4] => $this->getMessage(),
			$keys[5] => $this->getDelivery(),
			$keys[6] => $this->getStatus(),
			$keys[7] => $this->getErrorMessage(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PushMessagesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDepositFinancialProductsId($value);
				break;
			case 2:
				$this->setPushDevicesId($value);
				break;
			case 3:
				$this->setType($value);
				break;
			case 4:
				$this->setMessage($value);
				break;
			case 5:
				$this->setDelivery($value);
				break;
			case 6:
				$this->setStatus($value);
				break;
			case 7:
				$this->setErrorMessage($value);
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
		$keys = PushMessagesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDepositFinancialProductsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPushDevicesId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMessage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDelivery($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setErrorMessage($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PushMessagesPeer::DATABASE_NAME);

		if ($this->isColumnModified(PushMessagesPeer::ID)) $criteria->add(PushMessagesPeer::ID, $this->id);
		if ($this->isColumnModified(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID)) $criteria->add(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->deposit_financial_products_id);
		if ($this->isColumnModified(PushMessagesPeer::PUSH_DEVICES_ID)) $criteria->add(PushMessagesPeer::PUSH_DEVICES_ID, $this->push_devices_id);
		if ($this->isColumnModified(PushMessagesPeer::TYPE)) $criteria->add(PushMessagesPeer::TYPE, $this->type);
		if ($this->isColumnModified(PushMessagesPeer::MESSAGE)) $criteria->add(PushMessagesPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(PushMessagesPeer::DELIVERY)) $criteria->add(PushMessagesPeer::DELIVERY, $this->delivery);
		if ($this->isColumnModified(PushMessagesPeer::STATUS)) $criteria->add(PushMessagesPeer::STATUS, $this->status);
		if ($this->isColumnModified(PushMessagesPeer::ERROR_MESSAGE)) $criteria->add(PushMessagesPeer::ERROR_MESSAGE, $this->error_message);
		if ($this->isColumnModified(PushMessagesPeer::CREATED_AT)) $criteria->add(PushMessagesPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PushMessagesPeer::UPDATED_AT)) $criteria->add(PushMessagesPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PushMessagesPeer::DATABASE_NAME);

		$criteria->add(PushMessagesPeer::ID, $this->id);

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

		$copyObj->setDepositFinancialProductsId($this->deposit_financial_products_id);

		$copyObj->setPushDevicesId($this->push_devices_id);

		$copyObj->setType($this->type);

		$copyObj->setMessage($this->message);

		$copyObj->setDelivery($this->delivery);

		$copyObj->setStatus($this->status);

		$copyObj->setErrorMessage($this->error_message);

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
			self::$peer = new PushMessagesPeer();
		}
		return self::$peer;
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

	
	public function setPushDevices($v)
	{


		if ($v === null) {
			$this->setPushDevicesId(NULL);
		} else {
			$this->setPushDevicesId($v->getId());
		}


		$this->aPushDevices = $v;
	}


	
	public function getPushDevices($con = null)
	{
		if ($this->aPushDevices === null && ($this->push_devices_id !== null)) {
						include_once 'lib/model/om/BasePushDevicesPeer.php';

			$this->aPushDevices = PushDevicesPeer::retrieveByPK($this->push_devices_id, $con);

			
		}
		return $this->aPushDevices;
	}

} 