<?php


abstract class BaseDepositFinancialProducts extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $deposit_request_financial_id = 0;


	
	protected $name = '';


	
	protected $bank_name = '';


	
	protected $region = '';


	
	protected $profit_type = '';


	
	protected $product_type = '';


	
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


	
	protected $invert_increase_amount = '';


	
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


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDepositRequestFinancial;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDepositRequestFinancialId()
	{

		return $this->deposit_request_financial_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getBankName()
	{

		return $this->bank_name;
	}

	
	public function getRegion()
	{

		return $this->region;
	}

	
	public function getProfitType()
	{

		return $this->profit_type;
	}

	
	public function getProductType()
	{

		return $this->product_type;
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

	
	public function getInvertIncreaseAmount()
	{

		return $this->invert_increase_amount;
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
	
	public function setDepositRequestFinancialId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deposit_request_financial_id !== $v || $v === 0) {
			$this->deposit_request_financial_id = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID;
		}

		if ($this->aDepositRequestFinancial !== null && $this->aDepositRequestFinancial->getId() !== $v) {
			$this->aDepositRequestFinancial = null;
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
	
	public function setProductType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->product_type !== $v || $v === '') {
			$this->product_type = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::PRODUCT_TYPE;
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
	
	public function setInvertIncreaseAmount($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->invert_increase_amount !== $v || $v === '') {
			$this->invert_increase_amount = $v;
			$this->modifiedColumns[] = DepositFinancialProductsPeer::INVERT_INCREASE_AMOUNT;
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

			$this->deposit_request_financial_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->bank_name = $rs->getString($startcol + 3);

			$this->region = $rs->getString($startcol + 4);

			$this->profit_type = $rs->getString($startcol + 5);

			$this->product_type = $rs->getString($startcol + 6);

			$this->currency = $rs->getString($startcol + 7);

			$this->invest_cycle = $rs->getInt($startcol + 8);

			$this->target = $rs->getString($startcol + 9);

			$this->sale_start_date = $rs->getDate($startcol + 10, null);

			$this->sale_end_date = $rs->getDate($startcol + 11, null);

			$this->profit_start_date = $rs->getDate($startcol + 12, null);

			$this->deadline = $rs->getDate($startcol + 13, null);

			$this->pay_period = $rs->getString($startcol + 14);

			$this->expected_rate = $rs->getFloat($startcol + 15);

			$this->actual_rate = $rs->getFloat($startcol + 16);

			$this->invest_start_amount = $rs->getString($startcol + 17);

			$this->invert_increase_amount = $rs->getString($startcol + 18);

			$this->profit_desc = $rs->getString($startcol + 19);

			$this->invest_scope = $rs->getString($startcol + 20);

			$this->stop_condition = $rs->getString($startcol + 21);

			$this->raise_condition = $rs->getString($startcol + 22);

			$this->purchase = $rs->getString($startcol + 23);

			$this->cost = $rs->getString($startcol + 24);

			$this->feature = $rs->getString($startcol + 25);

			$this->events = $rs->getString($startcol + 26);

			$this->warnings = $rs->getString($startcol + 27);

			$this->announce = $rs->getString($startcol + 28);

			$this->created_at = $rs->getTimestamp($startcol + 29, null);

			$this->updated_at = $rs->getTimestamp($startcol + 30, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 31; 
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


												
			if ($this->aDepositRequestFinancial !== null) {
				if ($this->aDepositRequestFinancial->isModified()) {
					$affectedRows += $this->aDepositRequestFinancial->save($con);
				}
				$this->setDepositRequestFinancial($this->aDepositRequestFinancial);
			}


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


												
			if ($this->aDepositRequestFinancial !== null) {
				if (!$this->aDepositRequestFinancial->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepositRequestFinancial->getValidationFailures());
				}
			}


			if (($retval = DepositFinancialProductsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
				return $this->getDepositRequestFinancialId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getBankName();
				break;
			case 4:
				return $this->getRegion();
				break;
			case 5:
				return $this->getProfitType();
				break;
			case 6:
				return $this->getProductType();
				break;
			case 7:
				return $this->getCurrency();
				break;
			case 8:
				return $this->getInvestCycle();
				break;
			case 9:
				return $this->getTarget();
				break;
			case 10:
				return $this->getSaleStartDate();
				break;
			case 11:
				return $this->getSaleEndDate();
				break;
			case 12:
				return $this->getProfitStartDate();
				break;
			case 13:
				return $this->getDeadline();
				break;
			case 14:
				return $this->getPayPeriod();
				break;
			case 15:
				return $this->getExpectedRate();
				break;
			case 16:
				return $this->getActualRate();
				break;
			case 17:
				return $this->getInvestStartAmount();
				break;
			case 18:
				return $this->getInvertIncreaseAmount();
				break;
			case 19:
				return $this->getProfitDesc();
				break;
			case 20:
				return $this->getInvestScope();
				break;
			case 21:
				return $this->getStopCondition();
				break;
			case 22:
				return $this->getRaiseCondition();
				break;
			case 23:
				return $this->getPurchase();
				break;
			case 24:
				return $this->getCost();
				break;
			case 25:
				return $this->getFeature();
				break;
			case 26:
				return $this->getEvents();
				break;
			case 27:
				return $this->getWarnings();
				break;
			case 28:
				return $this->getAnnounce();
				break;
			case 29:
				return $this->getCreatedAt();
				break;
			case 30:
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
			$keys[1] => $this->getDepositRequestFinancialId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getBankName(),
			$keys[4] => $this->getRegion(),
			$keys[5] => $this->getProfitType(),
			$keys[6] => $this->getProductType(),
			$keys[7] => $this->getCurrency(),
			$keys[8] => $this->getInvestCycle(),
			$keys[9] => $this->getTarget(),
			$keys[10] => $this->getSaleStartDate(),
			$keys[11] => $this->getSaleEndDate(),
			$keys[12] => $this->getProfitStartDate(),
			$keys[13] => $this->getDeadline(),
			$keys[14] => $this->getPayPeriod(),
			$keys[15] => $this->getExpectedRate(),
			$keys[16] => $this->getActualRate(),
			$keys[17] => $this->getInvestStartAmount(),
			$keys[18] => $this->getInvertIncreaseAmount(),
			$keys[19] => $this->getProfitDesc(),
			$keys[20] => $this->getInvestScope(),
			$keys[21] => $this->getStopCondition(),
			$keys[22] => $this->getRaiseCondition(),
			$keys[23] => $this->getPurchase(),
			$keys[24] => $this->getCost(),
			$keys[25] => $this->getFeature(),
			$keys[26] => $this->getEvents(),
			$keys[27] => $this->getWarnings(),
			$keys[28] => $this->getAnnounce(),
			$keys[29] => $this->getCreatedAt(),
			$keys[30] => $this->getUpdatedAt(),
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
				$this->setDepositRequestFinancialId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setBankName($value);
				break;
			case 4:
				$this->setRegion($value);
				break;
			case 5:
				$this->setProfitType($value);
				break;
			case 6:
				$this->setProductType($value);
				break;
			case 7:
				$this->setCurrency($value);
				break;
			case 8:
				$this->setInvestCycle($value);
				break;
			case 9:
				$this->setTarget($value);
				break;
			case 10:
				$this->setSaleStartDate($value);
				break;
			case 11:
				$this->setSaleEndDate($value);
				break;
			case 12:
				$this->setProfitStartDate($value);
				break;
			case 13:
				$this->setDeadline($value);
				break;
			case 14:
				$this->setPayPeriod($value);
				break;
			case 15:
				$this->setExpectedRate($value);
				break;
			case 16:
				$this->setActualRate($value);
				break;
			case 17:
				$this->setInvestStartAmount($value);
				break;
			case 18:
				$this->setInvertIncreaseAmount($value);
				break;
			case 19:
				$this->setProfitDesc($value);
				break;
			case 20:
				$this->setInvestScope($value);
				break;
			case 21:
				$this->setStopCondition($value);
				break;
			case 22:
				$this->setRaiseCondition($value);
				break;
			case 23:
				$this->setPurchase($value);
				break;
			case 24:
				$this->setCost($value);
				break;
			case 25:
				$this->setFeature($value);
				break;
			case 26:
				$this->setEvents($value);
				break;
			case 27:
				$this->setWarnings($value);
				break;
			case 28:
				$this->setAnnounce($value);
				break;
			case 29:
				$this->setCreatedAt($value);
				break;
			case 30:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepositFinancialProductsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDepositRequestFinancialId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBankName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRegion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setProfitType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setProductType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCurrency($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setInvestCycle($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTarget($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSaleStartDate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSaleEndDate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setProfitStartDate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setDeadline($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPayPeriod($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setExpectedRate($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setActualRate($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setInvestStartAmount($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setInvertIncreaseAmount($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setProfitDesc($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setInvestScope($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setStopCondition($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setRaiseCondition($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setPurchase($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCost($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setFeature($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setEvents($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setWarnings($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setAnnounce($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCreatedAt($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setUpdatedAt($arr[$keys[30]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepositFinancialProductsPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepositFinancialProductsPeer::ID)) $criteria->add(DepositFinancialProductsPeer::ID, $this->id);
		if ($this->isColumnModified(DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID)) $criteria->add(DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID, $this->deposit_request_financial_id);
		if ($this->isColumnModified(DepositFinancialProductsPeer::NAME)) $criteria->add(DepositFinancialProductsPeer::NAME, $this->name);
		if ($this->isColumnModified(DepositFinancialProductsPeer::BANK_NAME)) $criteria->add(DepositFinancialProductsPeer::BANK_NAME, $this->bank_name);
		if ($this->isColumnModified(DepositFinancialProductsPeer::REGION)) $criteria->add(DepositFinancialProductsPeer::REGION, $this->region);
		if ($this->isColumnModified(DepositFinancialProductsPeer::PROFIT_TYPE)) $criteria->add(DepositFinancialProductsPeer::PROFIT_TYPE, $this->profit_type);
		if ($this->isColumnModified(DepositFinancialProductsPeer::PRODUCT_TYPE)) $criteria->add(DepositFinancialProductsPeer::PRODUCT_TYPE, $this->product_type);
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
		if ($this->isColumnModified(DepositFinancialProductsPeer::INVERT_INCREASE_AMOUNT)) $criteria->add(DepositFinancialProductsPeer::INVERT_INCREASE_AMOUNT, $this->invert_increase_amount);
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

		$copyObj->setDepositRequestFinancialId($this->deposit_request_financial_id);

		$copyObj->setName($this->name);

		$copyObj->setBankName($this->bank_name);

		$copyObj->setRegion($this->region);

		$copyObj->setProfitType($this->profit_type);

		$copyObj->setProductType($this->product_type);

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

		$copyObj->setInvertIncreaseAmount($this->invert_increase_amount);

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
			self::$peer = new DepositFinancialProductsPeer();
		}
		return self::$peer;
	}

	
	public function setDepositRequestFinancial($v)
	{


		if ($v === null) {
			$this->setDepositRequestFinancialId('0');
		} else {
			$this->setDepositRequestFinancialId($v->getId());
		}


		$this->aDepositRequestFinancial = $v;
	}


	
	public function getDepositRequestFinancial($con = null)
	{
		if ($this->aDepositRequestFinancial === null && ($this->deposit_request_financial_id !== null)) {
						include_once 'lib/model/om/BaseDepositRequestFinancialPeer.php';

			$this->aDepositRequestFinancial = DepositRequestFinancialPeer::retrieveByPK($this->deposit_request_financial_id, $con);

			
		}
		return $this->aDepositRequestFinancial;
	}

} 