<?php


abstract class BaseDepositStationNews extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title = '';


	
	protected $content = '';


	
	protected $send_time;


	
	protected $type = 'default';


	
	protected $deposit_financial_products_id = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDepositMembersStationNewss;

	
	protected $lastDepositMembersStationNewsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getContent()
	{

		return $this->content;
	}

	
	public function getSendTime($format = 'Y-m-d H:i:s')
	{

		if ($this->send_time === null || $this->send_time === '') {
			return null;
		} elseif (!is_int($this->send_time)) {
						$ts = strtotime($this->send_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [send_time] as date/time value: " . var_export($this->send_time, true));
			}
		} else {
			$ts = $this->send_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getDepositFinancialProductsId()
	{

		return $this->deposit_financial_products_id;
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
			$this->modifiedColumns[] = DepositStationNewsPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v || $v === '') {
			$this->title = $v;
			$this->modifiedColumns[] = DepositStationNewsPeer::TITLE;
		}

	} 
	
	public function setContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v || $v === '') {
			$this->content = $v;
			$this->modifiedColumns[] = DepositStationNewsPeer::CONTENT;
		}

	} 
	
	public function setSendTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [send_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->send_time !== $ts) {
			$this->send_time = $ts;
			$this->modifiedColumns[] = DepositStationNewsPeer::SEND_TIME;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v || $v === 'default') {
			$this->type = $v;
			$this->modifiedColumns[] = DepositStationNewsPeer::TYPE;
		}

	} 
	
	public function setDepositFinancialProductsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_financial_products_id !== $v || $v === 0) {
			$this->deposit_financial_products_id = $v;
			$this->modifiedColumns[] = DepositStationNewsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID;
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
			$this->modifiedColumns[] = DepositStationNewsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositStationNewsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->content = $rs->getString($startcol + 2);

			$this->send_time = $rs->getTimestamp($startcol + 3, null);

			$this->type = $rs->getString($startcol + 4);

			$this->deposit_financial_products_id = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositStationNews object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositStationNewsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositStationNewsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositStationNewsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositStationNewsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositStationNewsPeer::DATABASE_NAME);
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
					$pk = DepositStationNewsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositStationNewsPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDepositMembersStationNewss !== null) {
				foreach($this->collDepositMembersStationNewss as $referrerFK) {
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


			if (($retval = DepositStationNewsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDepositMembersStationNewss !== null) {
					foreach($this->collDepositMembersStationNewss as $referrerFK) {
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
		$pos = DepositStationNewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getContent();
				break;
			case 3:
				return $this->getSendTime();
				break;
			case 4:
				return $this->getType();
				break;
			case 5:
				return $this->getDepositFinancialProductsId();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositStationNewsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getContent(),
			$keys[3] => $this->getSendTime(),
			$keys[4] => $this->getType(),
			$keys[5] => $this->getDepositFinancialProductsId(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositStationNewsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setContent($value);
				break;
			case 3:
				$this->setSendTime($value);
				break;
			case 4:
				$this->setType($value);
				break;
			case 5:
				$this->setDepositFinancialProductsId($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositStationNewsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSendTime($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDepositFinancialProductsId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositStationNewsPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositStationNewsPeer::ID)) $criteria->add(DepositStationNewsPeer::ID, $this->id);
		if ($this->isColumnModified(DepositStationNewsPeer::TITLE)) $criteria->add(DepositStationNewsPeer::TITLE, $this->title);
		if ($this->isColumnModified(DepositStationNewsPeer::CONTENT)) $criteria->add(DepositStationNewsPeer::CONTENT, $this->content);
		if ($this->isColumnModified(DepositStationNewsPeer::SEND_TIME)) $criteria->add(DepositStationNewsPeer::SEND_TIME, $this->send_time);
		if ($this->isColumnModified(DepositStationNewsPeer::TYPE)) $criteria->add(DepositStationNewsPeer::TYPE, $this->type);
		if ($this->isColumnModified(DepositStationNewsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID)) $criteria->add(DepositStationNewsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->deposit_financial_products_id);
		if ($this->isColumnModified(DepositStationNewsPeer::CREATED_AT)) $criteria->add(DepositStationNewsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositStationNewsPeer::UPDATED_AT)) $criteria->add(DepositStationNewsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositStationNewsPeer::DATABASE_NAME);

		$criteria->add(DepositStationNewsPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setContent($this->content);

		$copyObj->setSendTime($this->send_time);

		$copyObj->setType($this->type);

		$copyObj->setDepositFinancialProductsId($this->deposit_financial_products_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDepositMembersStationNewss() as $relObj) {
				$copyObj->addDepositMembersStationNews($relObj->copy($deepCopy));
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
			self::$peer = new DepositStationNewsPeer();
		}
		return self::$peer;
	}

	
	public function initDepositMembersStationNewss()
	{
		if ($this->collDepositMembersStationNewss === null) {
			$this->collDepositMembersStationNewss = array();
		}
	}

	
	public function getDepositMembersStationNewss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositMembersStationNewsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositMembersStationNewss === null) {
			if ($this->isNew()) {
			   $this->collDepositMembersStationNewss = array();
			} else {

				$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $this->getId());

				DepositMembersStationNewsPeer::addSelectColumns($criteria);
				$this->collDepositMembersStationNewss = DepositMembersStationNewsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $this->getId());

				DepositMembersStationNewsPeer::addSelectColumns($criteria);
				if (!isset($this->lastDepositMembersStationNewsCriteria) || !$this->lastDepositMembersStationNewsCriteria->equals($criteria)) {
					$this->collDepositMembersStationNewss = DepositMembersStationNewsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDepositMembersStationNewsCriteria = $criteria;
		return $this->collDepositMembersStationNewss;
	}

	
	public function countDepositMembersStationNewss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDepositMembersStationNewsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $this->getId());

		return DepositMembersStationNewsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepositMembersStationNews(DepositMembersStationNews $l)
	{
		$this->collDepositMembersStationNewss[] = $l;
		$l->setDepositStationNews($this);
	}


	
	public function getDepositMembersStationNewssJoinDepositMembers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDepositMembersStationNewsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDepositMembersStationNewss === null) {
			if ($this->isNew()) {
				$this->collDepositMembersStationNewss = array();
			} else {

				$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $this->getId());

				$this->collDepositMembersStationNewss = DepositMembersStationNewsPeer::doSelectJoinDepositMembers($criteria, $con);
			}
		} else {
									
			$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $this->getId());

			if (!isset($this->lastDepositMembersStationNewsCriteria) || !$this->lastDepositMembersStationNewsCriteria->equals($criteria)) {
				$this->collDepositMembersStationNewss = DepositMembersStationNewsPeer::doSelectJoinDepositMembers($criteria, $con);
			}
		}
		$this->lastDepositMembersStationNewsCriteria = $criteria;

		return $this->collDepositMembersStationNewss;
	}

} 