<?php


abstract class BaseDepositFinancialProductsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_financial_products';

	
	const CLASS_DEFAULT = 'lib.model.DepositFinancialProducts';

	
	const NUM_COLUMNS = 32;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_financial_products.ID';

	
	const NAME = 'deposit_financial_products.NAME';

	
	const BANK_NAME = 'deposit_financial_products.BANK_NAME';

	
	const BANK_ID = 'deposit_financial_products.BANK_ID';

	
	const REGION = 'deposit_financial_products.REGION';

	
	const PROFIT_TYPE = 'deposit_financial_products.PROFIT_TYPE';

	
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

	
	const INVEST_INCREASE_AMOUNT = 'deposit_financial_products.INVEST_INCREASE_AMOUNT';

	
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

	
	const STATUS = 'deposit_financial_products.STATUS';

	
	const SYNC_STATUS = 'deposit_financial_products.SYNC_STATUS';

	
	const CREATED_AT = 'deposit_financial_products.CREATED_AT';

	
	const UPDATED_AT = 'deposit_financial_products.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'BankName', 'BankId', 'Region', 'ProfitType', 'Currency', 'InvestCycle', 'Target', 'SaleStartDate', 'SaleEndDate', 'ProfitStartDate', 'Deadline', 'PayPeriod', 'ExpectedRate', 'ActualRate', 'InvestStartAmount', 'InvestIncreaseAmount', 'ProfitDesc', 'InvestScope', 'StopCondition', 'RaiseCondition', 'Purchase', 'Cost', 'Feature', 'Events', 'Warnings', 'Announce', 'Status', 'SyncStatus', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositFinancialProductsPeer::ID, DepositFinancialProductsPeer::NAME, DepositFinancialProductsPeer::BANK_NAME, DepositFinancialProductsPeer::BANK_ID, DepositFinancialProductsPeer::REGION, DepositFinancialProductsPeer::PROFIT_TYPE, DepositFinancialProductsPeer::CURRENCY, DepositFinancialProductsPeer::INVEST_CYCLE, DepositFinancialProductsPeer::TARGET, DepositFinancialProductsPeer::SALE_START_DATE, DepositFinancialProductsPeer::SALE_END_DATE, DepositFinancialProductsPeer::PROFIT_START_DATE, DepositFinancialProductsPeer::DEADLINE, DepositFinancialProductsPeer::PAY_PERIOD, DepositFinancialProductsPeer::EXPECTED_RATE, DepositFinancialProductsPeer::ACTUAL_RATE, DepositFinancialProductsPeer::INVEST_START_AMOUNT, DepositFinancialProductsPeer::INVEST_INCREASE_AMOUNT, DepositFinancialProductsPeer::PROFIT_DESC, DepositFinancialProductsPeer::INVEST_SCOPE, DepositFinancialProductsPeer::STOP_CONDITION, DepositFinancialProductsPeer::RAISE_CONDITION, DepositFinancialProductsPeer::PURCHASE, DepositFinancialProductsPeer::COST, DepositFinancialProductsPeer::FEATURE, DepositFinancialProductsPeer::EVENTS, DepositFinancialProductsPeer::WARNINGS, DepositFinancialProductsPeer::ANNOUNCE, DepositFinancialProductsPeer::STATUS, DepositFinancialProductsPeer::SYNC_STATUS, DepositFinancialProductsPeer::CREATED_AT, DepositFinancialProductsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'bank_name', 'bank_id', 'region', 'profit_type', 'currency', 'invest_cycle', 'target', 'sale_start_date', 'sale_end_date', 'profit_start_date', 'deadline', 'pay_period', 'expected_rate', 'actual_rate', 'invest_start_amount', 'invest_increase_amount', 'profit_desc', 'invest_scope', 'stop_condition', 'raise_condition', 'purchase', 'cost', 'feature', 'events', 'warnings', 'announce', 'status', 'sync_status', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'BankName' => 2, 'BankId' => 3, 'Region' => 4, 'ProfitType' => 5, 'Currency' => 6, 'InvestCycle' => 7, 'Target' => 8, 'SaleStartDate' => 9, 'SaleEndDate' => 10, 'ProfitStartDate' => 11, 'Deadline' => 12, 'PayPeriod' => 13, 'ExpectedRate' => 14, 'ActualRate' => 15, 'InvestStartAmount' => 16, 'InvestIncreaseAmount' => 17, 'ProfitDesc' => 18, 'InvestScope' => 19, 'StopCondition' => 20, 'RaiseCondition' => 21, 'Purchase' => 22, 'Cost' => 23, 'Feature' => 24, 'Events' => 25, 'Warnings' => 26, 'Announce' => 27, 'Status' => 28, 'SyncStatus' => 29, 'CreatedAt' => 30, 'UpdatedAt' => 31, ),
		BasePeer::TYPE_COLNAME => array (DepositFinancialProductsPeer::ID => 0, DepositFinancialProductsPeer::NAME => 1, DepositFinancialProductsPeer::BANK_NAME => 2, DepositFinancialProductsPeer::BANK_ID => 3, DepositFinancialProductsPeer::REGION => 4, DepositFinancialProductsPeer::PROFIT_TYPE => 5, DepositFinancialProductsPeer::CURRENCY => 6, DepositFinancialProductsPeer::INVEST_CYCLE => 7, DepositFinancialProductsPeer::TARGET => 8, DepositFinancialProductsPeer::SALE_START_DATE => 9, DepositFinancialProductsPeer::SALE_END_DATE => 10, DepositFinancialProductsPeer::PROFIT_START_DATE => 11, DepositFinancialProductsPeer::DEADLINE => 12, DepositFinancialProductsPeer::PAY_PERIOD => 13, DepositFinancialProductsPeer::EXPECTED_RATE => 14, DepositFinancialProductsPeer::ACTUAL_RATE => 15, DepositFinancialProductsPeer::INVEST_START_AMOUNT => 16, DepositFinancialProductsPeer::INVEST_INCREASE_AMOUNT => 17, DepositFinancialProductsPeer::PROFIT_DESC => 18, DepositFinancialProductsPeer::INVEST_SCOPE => 19, DepositFinancialProductsPeer::STOP_CONDITION => 20, DepositFinancialProductsPeer::RAISE_CONDITION => 21, DepositFinancialProductsPeer::PURCHASE => 22, DepositFinancialProductsPeer::COST => 23, DepositFinancialProductsPeer::FEATURE => 24, DepositFinancialProductsPeer::EVENTS => 25, DepositFinancialProductsPeer::WARNINGS => 26, DepositFinancialProductsPeer::ANNOUNCE => 27, DepositFinancialProductsPeer::STATUS => 28, DepositFinancialProductsPeer::SYNC_STATUS => 29, DepositFinancialProductsPeer::CREATED_AT => 30, DepositFinancialProductsPeer::UPDATED_AT => 31, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'bank_name' => 2, 'bank_id' => 3, 'region' => 4, 'profit_type' => 5, 'currency' => 6, 'invest_cycle' => 7, 'target' => 8, 'sale_start_date' => 9, 'sale_end_date' => 10, 'profit_start_date' => 11, 'deadline' => 12, 'pay_period' => 13, 'expected_rate' => 14, 'actual_rate' => 15, 'invest_start_amount' => 16, 'invest_increase_amount' => 17, 'profit_desc' => 18, 'invest_scope' => 19, 'stop_condition' => 20, 'raise_condition' => 21, 'purchase' => 22, 'cost' => 23, 'feature' => 24, 'events' => 25, 'warnings' => 26, 'announce' => 27, 'status' => 28, 'sync_status' => 29, 'created_at' => 30, 'updated_at' => 31, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
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

		$criteria->addSelectColumn(DepositFinancialProductsPeer::NAME);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::BANK_NAME);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::BANK_ID);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::REGION);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::PROFIT_TYPE);

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

		$criteria->addSelectColumn(DepositFinancialProductsPeer::INVEST_INCREASE_AMOUNT);

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

		$criteria->addSelectColumn(DepositFinancialProductsPeer::STATUS);

		$criteria->addSelectColumn(DepositFinancialProductsPeer::SYNC_STATUS);

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
