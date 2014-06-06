<?php


abstract class BaseDepositFinancialProductsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_financial_products';

	
	const CLASS_DEFAULT = 'lib.model.DepositFinancialProducts';

	
	const NUM_COLUMNS = 31;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_financial_products.ID';

	
	const DEPOSIT_REQUEST_FINANCIAL_ID = 'deposit_financial_products.DEPOSIT_REQUEST_FINANCIAL_ID';

	
	const NAME = 'deposit_financial_products.NAME';

	
	const BANK_NAME = 'deposit_financial_products.BANK_NAME';

	
	const REGION = 'deposit_financial_products.REGION';

	
	const PROFIT_TYPE = 'deposit_financial_products.PROFIT_TYPE';

	
	const PRODUCT_TYPE = 'deposit_financial_products.PRODUCT_TYPE';

	
	const CURRENCY = 'deposit_financial_products.CURRENCY';

	
	const INVEST_CYCLE = 'deposit_financial_products.INVEST_CYCLE';

	
	const TARGET = 'deposit_financial_products.TARGET';

	
	const SALE_START_DATE = 'deposit_financial_products.SALE_START_DATE';

	
	const SALE_END_DATE = 'deposit_financial_products.SALE_END_DATE';

	
	const PROFIT_START_DATE = 'deposit_financial_products.PROFIT_START_DATE';

	
	const DEADLINE = 'deposit_financial_products.DEADLINE';

	
	const PAY_PERIOD = 'deposit_financial_products.PAY_PERIOD';

	
	const EXPECTED_RATE = 'deposit_financial_products.EXPECTED_RATE';

	
	const ACTUAL_RATE = 'deposit_financial_products.ACTUAL_RATE';

	
	const INVEST_START_AMOUNT = 'deposit_financial_products.INVEST_START_AMOUNT';

	
	const INVERT_INCREASE_AMOUNT = 'deposit_financial_products.INVERT_INCREASE_AMOUNT';

	
	const PROFIT_DESC = 'deposit_financial_products.PROFIT_DESC';

	
	const INVEST_SCOPE = 'deposit_financial_products.INVEST_SCOPE';

	
	const STOP_CONDITION = 'deposit_financial_products.STOP_CONDITION';

	
	const RAISE_CONDITION = 'deposit_financial_products.RAISE_CONDITION';

	
	const PURCHASE = 'deposit_financial_products.PURCHASE';

	
	const COST = 'deposit_financial_products.COST';

	
	const FEATURE = 'deposit_financial_products.FEATURE';

	
	const EVENTS = 'deposit_financial_products.EVENTS';

	
	const WARNINGS = 'deposit_financial_products.WARNINGS';

	
	const ANNOUNCE = 'deposit_financial_products.ANNOUNCE';

	
	const CREATED_AT = 'deposit_financial_products.CREATED_AT';

	
	const UPDATED_AT = 'deposit_financial_products.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DepositRequestFinancialId', 'Name', 'BankName', 'Region', 'ProfitType', 'ProductType', 'Currency', 'InvestCycle', 'Target', 'SaleStartDate', 'SaleEndDate', 'ProfitStartDate', 'Deadline', 'PayPeriod', 'ExpectedRate', 'ActualRate', 'InvestStartAmount', 'InvertIncreaseAmount', 'ProfitDesc', 'InvestScope', 'StopCondition', 'RaiseCondition', 'Purchase', 'Cost', 'Feature', 'Events', 'Warnings', 'Announce', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositFinancialProductsPeer::ID, DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID, DepositFinancialProductsPeer::NAME, DepositFinancialProductsPeer::BANK_NAME, DepositFinancialProductsPeer::REGION, DepositFinancialProductsPeer::PROFIT_TYPE, DepositFinancialProductsPeer::PRODUCT_TYPE, DepositFinancialProductsPeer::CURRENCY, DepositFinancialProductsPeer::INVEST_CYCLE, DepositFinancialProductsPeer::TARGET, DepositFinancialProductsPeer::SALE_START_DATE, DepositFinancialProductsPeer::SALE_END_DATE, DepositFinancialProductsPeer::PROFIT_START_DATE, DepositFinancialProductsPeer::DEADLINE, DepositFinancialProductsPeer::PAY_PERIOD, DepositFinancialProductsPeer::EXPECTED_RATE, DepositFinancialProductsPeer::ACTUAL_RATE, DepositFinancialProductsPeer::INVEST_START_AMOUNT, DepositFinancialProductsPeer::INVERT_INCREASE_AMOUNT, DepositFinancialProductsPeer::PROFIT_DESC, DepositFinancialProductsPeer::INVEST_SCOPE, DepositFinancialProductsPeer::STOP_CONDITION, DepositFinancialProductsPeer::RAISE_CONDITION, DepositFinancialProductsPeer::PURCHASE, DepositFinancialProductsPeer::COST, DepositFinancialProductsPeer::FEATURE, DepositFinancialProductsPeer::EVENTS, DepositFinancialProductsPeer::WARNINGS, DepositFinancialProductsPeer::ANNOUNCE, DepositFinancialProductsPeer::CREATED_AT, DepositFinancialProductsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'deposit_request_financial_id', 'name', 'bank_name', 'region', 'profit_type', 'product_type', 'currency', 'invest_cycle', 'target', 'sale_start_date', 'sale_end_date', 'profit_start_date', 'deadline', 'pay_period', 'expected_rate', 'actual_rate', 'invest_start_amount', 'invert_increase_amount', 'profit_desc', 'invest_scope', 'stop_condition', 'raise_condition', 'purchase', 'cost', 'feature', 'events', 'warnings', 'announce', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DepositRequestFinancialId' => 1, 'Name' => 2, 'BankName' => 3, 'Region' => 4, 'ProfitType' => 5, 'ProductType' => 6, 'Currency' => 7, 'InvestCycle' => 8, 'Target' => 9, 'SaleStartDate' => 10, 'SaleEndDate' => 11, 'ProfitStartDate' => 12, 'Deadline' => 13, 'PayPeriod' => 14, 'ExpectedRate' => 15, 'ActualRate' => 16, 'InvestStartAmount' => 17, 'InvertIncreaseAmount' => 18, 'ProfitDesc' => 19, 'InvestScope' => 20, 'StopCondition' => 21, 'RaiseCondition' => 22, 'Purchase' => 23, 'Cost' => 24, 'Feature' => 25, 'Events' => 26, 'Warnings' => 27, 'Announce' => 28, 'CreatedAt' => 29, 'UpdatedAt' => 30, ),
		BasePeer::TYPE_COLNAME => array (DepositFinancialProductsPeer::ID => 0, DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID => 1, DepositFinancialProductsPeer::NAME => 2, DepositFinancialProductsPeer::BANK_NAME => 3, DepositFinancialProductsPeer::REGION => 4, DepositFinancialProductsPeer::PROFIT_TYPE => 5, DepositFinancialProductsPeer::PRODUCT_TYPE => 6, DepositFinancialProductsPeer::CURRENCY => 7, DepositFinancialProductsPeer::INVEST_CYCLE => 8, DepositFinancialProductsPeer::TARGET => 9, DepositFinancialProductsPeer::SALE_START_DATE => 10, DepositFinancialProductsPeer::SALE_END_DATE => 11, DepositFinancialProductsPeer::PROFIT_START_DATE => 12, DepositFinancialProductsPeer::DEADLINE => 13, DepositFinancialProductsPeer::PAY_PERIOD => 14, DepositFinancialProductsPeer::EXPECTED_RATE => 15, DepositFinancialProductsPeer::ACTUAL_RATE => 16, DepositFinancialProductsPeer::INVEST_START_AMOUNT => 17, DepositFinancialProductsPeer::INVERT_INCREASE_AMOUNT => 18, DepositFinancialProductsPeer::PROFIT_DESC => 19, DepositFinancialProductsPeer::INVEST_SCOPE => 20, DepositFinancialProductsPeer::STOP_CONDITION => 21, DepositFinancialProductsPeer::RAISE_CONDITION => 22, DepositFinancialProductsPeer::PURCHASE => 23, DepositFinancialProductsPeer::COST => 24, DepositFinancialProductsPeer::FEATURE => 25, DepositFinancialProductsPeer::EVENTS => 26, DepositFinancialProductsPeer::WARNINGS => 27, DepositFinancialProductsPeer::ANNOUNCE => 28, DepositFinancialProductsPeer::CREATED_AT => 29, DepositFinancialProductsPeer::UPDATED_AT => 30, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'deposit_request_financial_id' => 1, 'name' => 2, 'bank_name' => 3, 'region' => 4, 'profit_type' => 5, 'product_type' => 6, 'currency' => 7, 'invest_cycle' => 8, 'target' => 9, 'sale_start_date' => 10, 'sale_end_date' => 11, 'profit_start_date' => 12, 'deadline' => 13, 'pay_period' => 14, 'expected_rate' => 15, 'actual_rate' => 16, 'invest_start_amount' => 17, 'invert_increase_amount' => 18, 'profit_desc' => 19, 'invest_scope' => 20, 'stop_condition' => 21, 'raise_condition' => 22, 'purchase' => 23, 'cost' => 24, 'feature' => 25, 'events' => 26, 'warnings' => 27, 'announce' => 28, 'created_at' => 29, 'updated_at' => 30, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositFinancialProductsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositFinancialProductsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositFinancialProductsPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(DepositFinancialProductsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositFinancialProductsPeer::ID);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::NAME);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::BANK_NAME);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::REGION);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::PROFIT_TYPE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::PRODUCT_TYPE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::CURRENCY);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::INVEST_CYCLE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::TARGET);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::SALE_START_DATE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::SALE_END_DATE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::PROFIT_START_DATE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::DEADLINE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::PAY_PERIOD);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::EXPECTED_RATE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::ACTUAL_RATE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::INVEST_START_AMOUNT);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::INVERT_INCREASE_AMOUNT);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::PROFIT_DESC);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::INVEST_SCOPE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::STOP_CONDITION);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::RAISE_CONDITION);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::PURCHASE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::COST);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::FEATURE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::EVENTS);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::WARNINGS);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::ANNOUNCE);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::CREATED_AT);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_financial_products.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_financial_products.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositFinancialProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositFinancialProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositFinancialProductsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = DepositFinancialProductsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositFinancialProductsPeer::populateObjects(DepositFinancialProductsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositFinancialProductsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositFinancialProductsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDepositRequestFinancial(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositFinancialProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositFinancialProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID, DepositRequestFinancialPeer::ID);

		$rs = DepositFinancialProductsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDepositRequestFinancial(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositFinancialProductsPeer::addSelectColumns($c);
		$startcol = (DepositFinancialProductsPeer::NUM_COLUMNS - DepositFinancialProductsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositRequestFinancialPeer::addSelectColumns($c);

		$c->addJoin(DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID, DepositRequestFinancialPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositFinancialProductsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositRequestFinancialPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDepositRequestFinancial(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDepositFinancialProducts($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositFinancialProductss();
				$obj2->addDepositFinancialProducts($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositFinancialProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositFinancialProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID, DepositRequestFinancialPeer::ID);

		$rs = DepositFinancialProductsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositFinancialProductsPeer::addSelectColumns($c);
		$startcol2 = (DepositFinancialProductsPeer::NUM_COLUMNS - DepositFinancialProductsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositRequestFinancialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositRequestFinancialPeer::NUM_COLUMNS;

		$c->addJoin(DepositFinancialProductsPeer::DEPOSIT_REQUEST_FINANCIAL_ID, DepositRequestFinancialPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositFinancialProductsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DepositRequestFinancialPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositRequestFinancial(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositFinancialProducts($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositFinancialProductss();
				$obj2->addDepositFinancialProducts($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return DepositFinancialProductsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositFinancialProductsPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(DepositFinancialProductsPeer::ID);
			$selectCriteria->add(DepositFinancialProductsPeer::ID, $criteria->remove(DepositFinancialProductsPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(DepositFinancialProductsPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(DepositFinancialProductsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositFinancialProducts) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DepositFinancialProductsPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(DepositFinancialProducts $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositFinancialProductsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositFinancialProductsPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(DepositFinancialProductsPeer::DATABASE_NAME, DepositFinancialProductsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositFinancialProductsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(DepositFinancialProductsPeer::DATABASE_NAME);

		$criteria->add(DepositFinancialProductsPeer::ID, $pk);


		$v = DepositFinancialProductsPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(DepositFinancialProductsPeer::ID, $pks, Criteria::IN);
			$objs = DepositFinancialProductsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDepositFinancialProductsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositFinancialProductsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositFinancialProductsMapBuilder');
}
