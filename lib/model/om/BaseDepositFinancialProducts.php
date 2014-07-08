<?php


abstract class BaseDepositFinancialProducts extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name = '';


	
	protected $bank_name = '';


	
	protected $bank_id = 0;


	
	protected $region = '';


	
	protected $profit_type = '';


	
	protected $currency = '';


	
	protected $invest_cycle = 0;


	
	protected $target = '';


	
	protected $sale_start_date;


	
	protected $sale_end_date;


	
	protected $profit_start_date;


	
	protected $deadline;


	
	protected $pay_period = '';


	
	protected $expected_rate;


	
	protected $actual_rate;


	
	protected $invest_start_amount = '';


	
	protected $invest_increase_amount = '';


	
	protected $profit_desc;


	
	protected $invest_scope;


	
	protected $stop_condition;


	
	protected $raise_condition;


	
	protected $purchase;


	
	protected $cost;


	
	protected $feature;


	
	protected $events;


	
	protected $warnings;


	
	protected $announce;


	
	protected $status = '';


	
	protected $sync_status = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDepositPersonalProductss;

	
	protected $lastDepositPersonalProductsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getBankName()
	{

		return $this->bank_name;
	}

	
	public function getBankId()
	{

		return $this->bank_id;
	}

	
	public function getRegion()
	{

		return $this->region;
	}

	
	public function getProfitType()
	{

		return $this->profit_type;
	}

	
	public function getCurrency()
	{

		return $this->currency;
	}

	
	public function getInvestCycle()
	{

		return $this->invest_cycle;
	}

	
	public function getTarget()
	{

		return $this->target;
	}

	
	public function getSaleStartDate($format = 'Y-m-d')
	{

		if ($this->sale_start_date === null || $this->sale_start_date === '') {
			return null;
		} elseif (!is_int($this->sale_start_date)) {
						$ts = strtotime($this->sale_start_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [sale_start_date] as date/time value: " . var_export($this->sale_start_date, true));
			}
		} else {
			$ts = $this->sale_start_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getSaleEndDate($format = 'Y-m-d')
	{

		if ($this->sale_end_date === null || $this->sale_end_date === '') {
			return null;
		} elseif (!is_int($this->sale_end_date)) {
						$ts = strtotime($this->sale_end_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [sale_end_date] as date/time value: " . var_export($this->sale_end_date, true));
			}
		} else {
			$ts = $this->sale_end_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getProfitStartDate($format = 'Y-m-d')
	{

		if ($this->profit_start_date === null || $this->profit_start_date === '') {
			return null;
		} elseif (!is_int($this->profit_start_date)) {
						$ts = strtotime($this->profit_start_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [profit_start_date] as date/time value: " . var_export($this->profit_start_date, true));
			}
		} else {
			$ts = $this->profit_start_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDeadline($format = 'Y-m-d')
	{

		if ($this->deadline === null || $this->deadline === '') {
			return null;
		} elseif (!is_int($this->deadline)) {
						$ts = strtotime($this->deadline);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [deadline] as date/time value: " . var_export($this->deadline, true));
			}
		} else {
			$ts = $this->deadline;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getPayPeriod()
	{

		return $this->pay_period;
	}

	
	public function getExpectedRate()
	{

		return $this->expected_rate;
	}

	
	public function getActualRate()
	{

		return $this->actual_rate;
	}

	
	public function getInvestStartAmount()
	{

		return $this->invest_start_amount;
	}

	
	public function getInvestIncreaseAmount()
	{

		return $this->invest_increase_amount;
	}

	
	public function getProfitDesc()
	{

		return $this->profit_desc;
	}

	
	public function getInvestScope()
	{

		return $this->invest_scope;
	}

	
	public function getStopCondition()
	{

		return $this->stop_condition;
	}

	
	public function getRaiseCondition()
	{

		return $this->raise_condition;
	}

	
	public function getPurchase()
	{

		return $this->purchase;
	}

	
	public function getCost()
	{

		return $this->cost;
	}

	
	public function getFeature()
	{

		return $this->feature;
	}

	
	public function getEvents()
	{

		return $this->events;
	}

	
	public function getWarnings()
	{

		return $this->warnings;
	}

	
	public function getAnnounce()
	{

		return $this->announce;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getSyncStatus()
	{

		return $this->sync_status;
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
			$this->modifiedColumns[] = DepositFinancialProductsPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::NAME;
		}

	} 
	
	public function setBankName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->bank_name !== $v || $v === '') {
			$this->bank_name = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::BANK_NAME;
		}

	} 
	
	public function setBankId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bank_id !== $v || $v === 0) {
			$this->bank_id = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::BANK_ID;
		}

	} 
	
	public function setRegion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->region !== $v || $v === '') {
			$this->region = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::REGION;
		}

	} 
	
	public function setProfitType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->profit_type !== $v || $v === '') {
			$this->profit_type = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::PROFIT_TYPE;
		}

	} 
	
	public function setCurrency($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->currency !== $v || $v === '') {
			$this->currency = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::CURRENCY;
		}

	} 
	
	public function setInvestCycle($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->invest_cycle !== $v || $v === 0) {
			$this->invest_cycle = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::INVEST_CYCLE;
		}

	} 
	
	public function setTarget($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->target !== $v || $v === '') {
			$this->target = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::TARGET;
		}

	} 
	
	public function setSaleStartDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [sale_start_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->sale_start_date !== $ts) {
			$this->sale_start_date = $ts;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::SALE_START_DATE;
		}

	} 
	
	public function setSaleEndDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [sale_end_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->sale_end_date !== $ts) {
			$this->sale_end_date = $ts;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::SALE_END_DATE;
		}

	} 
	
	public function setProfitStartDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [profit_start_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->profit_start_date !== $ts) {
			$this->profit_start_date = $ts;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::PROFIT_START_DATE;
		}

	} 
	
	public function setDeadline($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [deadline] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deadline !== $ts) {
			$this->deadline = $ts;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::DEADLINE;
		}

	} 
	
	public function setPayPeriod($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pay_period !== $v || $v === '') {
			$this->pay_period = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::PAY_PERIOD;
		}

	} 
	
	public function setExpectedRate($v)
	{

		if ($this->expected_rate !== $v) {
			$this->expected_rate = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::EXPECTED_RATE;
		}

	} 
	
	public function setActualRate($v)
	{

		if ($this->actual_rate !== $v) {
			$this->actual_rate = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::ACTUAL_RATE;
		}

	} 
	
	public function setInvestStartAmount($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->invest_start_amount !== $v || $v === '') {
			$this->invest_start_amount = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::INVEST_START_AMOUNT;
		}

	} 
	
	public function setInvestIncreaseAmount($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->invest_increase_amount !== $v || $v === '') {
			$this->invest_increase_amount = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::INVEST_INCREASE_AMOUNT;
		}

	} 
	
	public function setProfitDesc($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->profit_desc !== $v) {
			$this->profit_desc = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::PROFIT_DESC;
		}

	} 
	
	public function setInvestScope($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->invest_scope !== $v) {
			$this->invest_scope = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::INVEST_SCOPE;
		}

	} 
	
	public function setStopCondition($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stop_condition !== $v) {
			$this->stop_condition = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::STOP_CONDITION;
		}

	} 
	
	public function setRaiseCondition($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->raise_condition !== $v) {
			$this->raise_condition = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::RAISE_CONDITION;
		}

	} 
	
	public function setPurchase($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->purchase !== $v) {
			$this->purchase = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::PURCHASE;
		}

	} 
	
	public function setCost($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cost !== $v) {
			$this->cost = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::COST;
		}

	} 
	
	public function setFeature($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->feature !== $v) {
			$this->feature = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::FEATURE;
		}

	} 
	
	public function setEvents($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->events !== $v) {
			$this->events = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::EVENTS;
		}

	} 
	
	public function setWarnings($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->warnings !== $v) {
			$this->warnings = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::WARNINGS;
		}

	} 
	
	public function setAnnounce($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->announce !== $v) {
			$this->announce = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::ANNOUNCE;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status !== $v || $v === '') {
			$this->status = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::STATUS;
		}

	} 
	
	public function setSyncStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sync_status !== $v || $v === 0) {
			$this->sync_status = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::SYNC_STATUS;
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
			$this->modifiedColumns[] = DepositFinancialProductsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DepositFinancialProductsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->bank_name = $rs->getString($startcol + 2);

			$this->bank_id = $rs->getInt($startcol + 3);

			$this->region = $rs->getString($startcol + 4);

			$this->profit_type = $rs->getString($startcol + 5);

			$this->currency = $rs->getString($startcol + 6);

			$this->invest_cycle = $rs->getInt($startcol + 7);

			$this->target = $rs->getString($startcol + 8);

			$this->sale_start_date = $rs->getDate($startcol + 9, null);

			$this->sale_end_date = $rs->getDate($startcol + 10, null);

			$this->profit_start_date = $rs->getDate($startcol + 11, null);

			$this->deadline = $rs->getDate($startcol + 12, null);

			$this->pay_period = $rs->getString($startcol + 13);

			$this->expected_rate = $rs->getFloat($startcol + 14);

			$this->actual_rate = $rs->getFloat($startcol + 15);

			$this->invest_start_amount = $rs->getString($startcol + 16);

			$this->invest_increase_amount = $rs->getString($startcol + 17);

			$this->profit_desc = $rs->getString($startcol + 18);

			$this->invest_scope = $rs->getString($startcol + 19);

			$this->stop_condition = $rs->getString($startcol + 20);

			$this->raise_condition = $rs->getString($startcol + 21);

			$this->purchase = $rs->getString($startcol + 22);

			$this->cost = $rs->getString($startcol + 23);

			$this->feature = $rs->getString($startcol + 24);

			$this->events = $rs->getString($startcol + 25);

			$this->warnings = $rs->getString($startcol + 26);

			$this->announce = $rs->getString($startcol + 27);

			$this->status = $rs->getString($startcol + 28);

			$this->sync_status = $rs->getInt($startcol + 29);

			$this->created_at = $rs->getTimestamp($startcol + 30, null);

			$this->updated_at = $rs->getTimestamp($startcol + 31, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 32; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DepositFinancialProducts object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositFinancialProductsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DepositFinancialProductsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DepositFinancialProductsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DepositFinancialProductsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DepositFinancialProductsPeer::DATABASE_NAME);
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
					$pk = DepositFinancialProductsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepositFinancialProductsPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDepositPersonalProductss !== null) {
				foreach($this->collDepositPersonalProductss as $referrerFK) {
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


			if (($retval = DepositFinancialProductsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDepositPersonalProductss !== null) {
					foreach($this->collDepositPersonalProductss as $referrerFK) {
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
		$pos = DepositFinancialProductsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getBankName();
				break;
			case 3:
				return $this->getBankId();
				break;
			case 4:
				return $this->getRegion();
				break;
			case 5:
				return $this->getProfitType();
				break;
			case 6:
				return $this->getCurrency();
				break;
			case 7:
				return $this->getInvestCycle();
				break;
			case 8:
				return $this->getTarget();
				break;
			case 9:
				return $this->getSaleStartDate();
				break;
			case 10:
				return $this->getSaleEndDate();
				break;
			case 11:
				return $this->getProfitStartDate();
				break;
			case 12:
				return $this->getDeadline();
				break;
			case 13:
				return $this->getPayPeriod();
				break;
			case 14:
				return $this->getExpectedRate();
				break;
			case 15:
				return $this->getActualRate();
				break;
			case 16:
				return $this->getInvestStartAmount();
				break;
			case 17:
				return $this->getInvestIncreaseAmount();
				break;
			case 18:
				return $this->getProfitDesc();
				break;
			case 19:
				return $this->getInvestScope();
				break;
			case 20:
				return $this->getStopCondition();
				break;
			case 21:
				return $this->getRaiseCondition();
				break;
			case 22:
				return $this->getPurchase();
				break;
			case 23:
				return $this->getCost();
				break;
			case 24:
				return $this->getFeature();
				break;
			case 25:
				return $this->getEvents();
				break;
			case 26:
				return $this->getWarnings();
				break;
			case 27:
				return $this->getAnnounce();
				break;
			case 28:
				return $this->getStatus();
				break;
			case 29:
				return $this->getSyncStatus();
				break;
			case 30:
				return $this->getCreatedAt();
				break;
			case 31:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositFinancialProductsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getBankName(),
			$keys[3] => $this->getBankId(),
			$keys[4] => $this->getRegion(),
			$keys[5] => $this->getProfitType(),
			$keys[6] => $this->getCurrency(),
			$keys[7] => $this->getInvestCycle(),
			$keys[8] => $this->getTarget(),
			$keys[9] => $this->getSaleStartDate(),
			$keys[10] => $this->getSaleEndDate(),
			$keys[11] => $this->getProfitStartDate(),
			$keys[12] => $this->getDeadline(),
			$keys[13] => $this->getPayPeriod(),
			$keys[14] => $this->getExpectedRate(),
			$keys[15] => $this->getActualRate(),
			$keys[16] => $this->getInvestStartAmount(),
			$keys[17] => $this->getInvestIncreaseAmount(),
			$keys[18] => $this->getProfitDesc(),
			$keys[19] => $this->getInvestScope(),
			$keys[20] => $this->getStopCondition(),
			$keys[21] => $this->getRaiseCondition(),
			$keys[22] => $this->getPurchase(),
			$keys[23] => $this->getCost(),
			$keys[24] => $this->getFeature(),
			$keys[25] => $this->getEvents(),
			$keys[26] => $this->getWarnings(),
			$keys[27] => $this->getAnnounce(),
			$keys[28] => $this->getStatus(),
			$keys[29] => $this->getSyncStatus(),
			$keys[30] => $this->getCreatedAt(),
			$keys[31] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepositFinancialProductsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setBankName($value);
				break;
			case 3:
				$this->setBankId($value);
				break;
			case 4:
				$this->setRegion($value);
				break;
			case 5:
				$this->setProfitType($value);
				break;
			case 6:
				$this->setCurrency($value);
				break;
			case 7:
				$this->setInvestCycle($value);
				break;
			case 8:
				$this->setTarget($value);
				break;
			case 9:
				$this->setSaleStartDate($value);
				break;
			case 10:
				$this->setSaleEndDate($value);
				break;
			case 11:
				$this->setProfitStartDate($value);
				break;
			case 12:
				$this->setDeadline($value);
				break;
			case 13:
				$this->setPayPeriod($value);
				break;
			case 14:
				$this->setExpectedRate($value);
				break;
			case 15:
				$this->setActualRate($value);
				break;
			case 16:
				$this->setInvestStartAmount($value);
				break;
			case 17:
				$this->setInvestIncreaseAmount($value);
				break;
			case 18:
				$this->setProfitDesc($value);
				break;
			case 19:
				$this->setInvestScope($value);
				break;
			case 20:
				$this->setStopCondition($value);
				break;
			case 21:
				$this->setRaiseCondition($value);
				break;
			case 22:
				$this->setPurchase($value);
				break;
			case 23:
				$this->setCost($value);
				break;
			case 24:
				$this->setFeature($value);
				break;
			case 25:
				$this->setEvents($value);
				break;
			case 26:
				$this->setWarnings($value);
				break;
			case 27:
				$this->setAnnounce($value);
				break;
			case 28:
				$this->setStatus($value);
				break;
			case 29:
				$this->setSyncStatus($value);
				break;
			case 30:
				$this->setCreatedAt($value);
				break;
			case 31:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositFinancialProductsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBankName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBankId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRegion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setProfitType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCurrency($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setInvestCycle($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTarget($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSaleStartDate($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSaleEndDate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setProfitStartDate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDeadline($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPayPeriod($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setExpectedRate($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setActualRate($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setInvestStartAmount($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setInvestIncreaseAmount($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setProfitDesc($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setInvestScope($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setStopCondition($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setRaiseCondition($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setPurchase($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCost($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setFeature($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setEvents($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setWarnings($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setAnnounce($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setStatus($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setSyncStatus($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCreatedAt($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setUpdatedAt($arr[$keys[31]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositFinancialProductsPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositFinancialProductsPeer::ID)) $criteria->add(DepositFinancialProductsPeer::ID, $this->id);
		if ($this->isColumnModified(DepositFinancialProductsPeer::NAME)) $criteria->add(DepositFinancialProductsPeer::NAME, $this->name);
		if ($this->isColumnModified(DepositFinancialProductsPeer::BANK_NAME)) $criteria->add(DepositFinancialProductsPeer::BANK_NAME, $this->bank_name);
		if ($this->isColumnModified(DepositFinancialProductsPeer::BANK_ID)) $criteria->add(DepositFinancialProductsPeer::BANK_ID, $this->bank_id);
		if ($this->isColumnModified(DepositFinancialProductsPeer::REGION)) $criteria->add(DepositFinancialProductsPeer::REGION, $this->region);
		if ($this->isColumnModified(DepositFinancialProductsPeer::PROFIT_TYPE)) $criteria->add(DepositFinancialProductsPeer::PROFIT_TYPE, $this->profit_type);
		if ($this->isColumnModified(DepositFinancialProductsPeer::CURRENCY)) $criteria->add(DepositFinancialProductsPeer::CURRENCY, $this->currency);
		if ($this->isColumnModified(DepositFinancialProductsPeer::INVEST_CYCLE)) $criteria->add(DepositFinancialProductsPeer::INVEST_CYCLE, $this->invest_cycle);
		if ($this->isColumnModified(DepositFinancialProductsPeer::TARGET)) $criteria->add(DepositFinancialProductsPeer::TARGET, $this->target);
		if ($this->isColumnModified(DepositFinancialProductsPeer::SALE_START_DATE)) $criteria->add(DepositFinancialProductsPeer::SALE_START_DATE, $this->sale_start_date);
		if ($this->isColumnModified(DepositFinancialProductsPeer::SALE_END_DATE)) $criteria->add(DepositFinancialProductsPeer::SALE_END_DATE, $this->sale_end_date);
		if ($this->isColumnModified(DepositFinancialProductsPeer::PROFIT_START_DATE)) $criteria->add(DepositFinancialProductsPeer::PROFIT_START_DATE, $this->profit_start_date);
		if ($this->isColumnModified(DepositFinancialProductsPeer::DEADLINE)) $criteria->add(DepositFinancialProductsPeer::DEADLINE, $this->deadline);
		if ($this->isColumnModified(DepositFinancialProductsPeer::PAY_PERIOD)) $criteria->add(DepositFinancialProductsPeer::PAY_PERIOD, $this->pay_period);
		if ($this->isColumnModified(DepositFinancialProductsPeer::EXPECTED_RATE)) $criteria->add(DepositFinancialProductsPeer::EXPECTED_RATE, $this->expected_rate);
		if ($this->isColumnModified(DepositFinancialProductsPeer::ACTUAL_RATE)) $criteria->add(DepositFinancialProductsPeer::ACTUAL_RATE, $this->actual_rate);
		if ($this->isColumnModified(DepositFinancialProductsPeer::INVEST_START_AMOUNT)) $criteria->add(DepositFinancialProductsPeer::INVEST_START_AMOUNT, $this->invest_start_amount);
		if ($this->isColumnModified(DepositFinancialProductsPeer::INVEST_INCREASE_AMOUNT)) $criteria->add(DepositFinancialProductsPeer::INVEST_INCREASE_AMOUNT, $this->invest_increase_amount);
		if ($this->isColumnModified(DepositFinancialProductsPeer::PROFIT_DESC)) $criteria->add(DepositFinancialProductsPeer::PROFIT_DESC, $this->profit_desc);
		if ($this->isColumnModified(DepositFinancialProductsPeer::INVEST_SCOPE)) $criteria->add(DepositFinancialProductsPeer::INVEST_SCOPE, $this->invest_scope);
		if ($this->isColumnModified(DepositFinancialProductsPeer::STOP_CONDITION)) $criteria->add(DepositFinancialProductsPeer::STOP_CONDITION, $this->stop_condition);
		if ($this->isColumnModified(DepositFinancialProductsPeer::RAISE_CONDITION)) $criteria->add(DepositFinancialProductsPeer::RAISE_CONDITION, $this->raise_condition);
		if ($this->isColumnModified(DepositFinancialProductsPeer::PURCHASE)) $criteria->add(DepositFinancialProductsPeer::PURCHASE, $this->purchase);
		if ($this->isColumnModified(DepositFinancialProductsPeer::COST)) $criteria->add(DepositFinancialProductsPeer::COST, $this->cost);
		if ($this->isColumnModified(DepositFinancialProductsPeer::FEATURE)) $criteria->add(DepositFinancialProductsPeer::FEATURE, $this->feature);
		if ($this->isColumnModified(DepositFinancialProductsPeer::EVENTS)) $criteria->add(DepositFinancialProductsPeer::EVENTS, $this->events);
		if ($this->isColumnModified(DepositFinancialProductsPeer::WARNINGS)) $criteria->add(DepositFinancialProductsPeer::WARNINGS, $this->warnings);
		if ($this->isColumnModified(DepositFinancialProductsPeer::ANNOUNCE)) $criteria->add(DepositFinancialProductsPeer::ANNOUNCE, $this->announce);
		if ($this->isColumnModified(DepositFinancialProductsPeer::STATUS)) $criteria->add(DepositFinancialProductsPeer::STATUS, $this->status);
		if ($this->isColumnModified(DepositFinancialProductsPeer::SYNC_STATUS)) $criteria->add(DepositFinancialProductsPeer::SYNC_STATUS, $this->sync_status);
		if ($this->isColumnModified(DepositFinancialProductsPeer::CREATED_AT)) $criteria->add(DepositFinancialProductsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DepositFinancialProductsPeer::UPDATED_AT)) $criteria->add(DepositFinancialProductsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepositFinancialProductsPeer::DATABASE_NAME);

		$criteria->add(DepositFinancialProductsPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setBankName($this->bank_name);

		$copyObj->setBankId($this->bank_id);

		$copyObj->setRegion($this->region);

		$copyObj->setProfitType($this->profit_type);

		$copyObj->setCurrency($this->currency);

		$copyObj->setInvestCycle($this->invest_cycle);

		$copyObj->setTarget($this->target);

		$copyObj->setSaleStartDate($this->sale_start_date);

		$copyObj->setSaleEndDate($this->sale_end_date);

		$copyObj->setProfitStartDate($this->profit_start_date);

		$copyObj->setDeadline($this->deadline);

		$copyObj->setPayPeriod($this->pay_period);

		$copyObj->setExpectedRate($this->expected_rate);

		$copyObj->setActualRate($this->actual_rate);

		$copyObj->setInvestStartAmount($this->invest_start_amount);

		$copyObj->setInvestIncreaseAmount($this->invest_increase_amount);

		$copyObj->setProfitDesc($this->profit_desc);

		$copyObj->setInvestScope($this->invest_scope);

		$copyObj->setStopCondition($this->stop_condition);

		$copyObj->setRaiseCondition($this->raise_condition);

		$copyObj->setPurchase($this->purchase);

		$copyObj->setCost($this->cost);

		$copyObj->setFeature($this->feature);

		$copyObj->setEvents($this->events);

		$copyObj->setWarnings($this->warnings);

		$copyObj->setAnnounce($this->announce);

		$copyObj->setStatus($this->status);

		$copyObj->setSyncStatus($this->sync_status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDepositPersonalProductss() as $relObj) {
				$copyObj->addDepositPersonalProducts($relObj->copy($deepCopy));
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
			self::$peer = new DepositFinancialProductsPeer();
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

				$criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->getId());

				DepositPersonalProductsPeer::addSelectColumns($criteria);
				$this->collDepositPersonalProductss = DepositPersonalProductsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->getId());

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

		$criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->getId());

		return DepositPersonalProductsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDepositPersonalProducts(DepositPersonalProducts $l)
	{
		$this->collDepositPersonalProductss[] = $l;
		$l->setDepositFinancialProducts($this);
	}


	
	public function getDepositPersonalProductssJoinDepositMembers($criteria = null, $con = null)
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

				$criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->getId());

				$this->collDepositPersonalProductss = DepositPersonalProductsPeer::doSelectJoinDepositMembers($criteria, $con);
			}
		} else {
									
			$criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $this->getId());

			if (!isset($this->lastDepositPersonalProductsCriteria) || !$this->lastDepositPersonalProductsCriteria->equals($criteria)) {
				$this->collDepositPersonalProductss = DepositPersonalProductsPeer::doSelectJoinDepositMembers($criteria, $con);
			}
		}
		$this->lastDepositPersonalProductsCriteria = $criteria;

		return $this->collDepositPersonalProductss;
	}

} 