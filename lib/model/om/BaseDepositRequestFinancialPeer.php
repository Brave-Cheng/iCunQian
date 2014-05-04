<?php


abstract class BaseDepositRequestFinancialPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_request_financial';

	
	const CLASS_DEFAULT = 'lib.model.DepositRequestFinancial';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_request_financial.ID';

	
	const REQUEST_ID = 'deposit_request_financial.REQUEST_ID';

	
	const UNIQUE_KEY = 'deposit_request_financial.UNIQUE_KEY';

	
	const PROCESS_STATUS = 'deposit_request_financial.PROCESS_STATUS';

	
	const STATUS = 'deposit_request_financial.STATUS';

	
	const CREATED_AT = 'deposit_request_financial.CREATED_AT';

	
	const UPDATED_AT = 'deposit_request_financial.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'RequestId', 'UniqueKey', 'ProcessStatus', 'Status', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositRequestFinancialPeer::ID, DepositRequestFinancialPeer::REQUEST_ID, DepositRequestFinancialPeer::UNIQUE_KEY, DepositRequestFinancialPeer::PROCESS_STATUS, DepositRequestFinancialPeer::STATUS, DepositRequestFinancialPeer::CREATED_AT, DepositRequestFinancialPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'request_id', 'unique_key', 'process_status', 'status', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'RequestId' => 1, 'UniqueKey' => 2, 'ProcessStatus' => 3, 'Status' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (DepositRequestFinancialPeer::ID => 0, DepositRequestFinancialPeer::REQUEST_ID => 1, DepositRequestFinancialPeer::UNIQUE_KEY => 2, DepositRequestFinancialPeer::PROCESS_STATUS => 3, DepositRequestFinancialPeer::STATUS => 4, DepositRequestFinancialPeer::CREATED_AT => 5, DepositRequestFinancialPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'request_id' => 1, 'unique_key' => 2, 'process_status' => 3, 'status' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositRequestFinancialMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositRequestFinancialMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositRequestFinancialPeer::getTableMap();
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
		return str_replace(DepositRequestFinancialPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositRequestFinancialPeer::ID);

		$criteria->addSelectColumn(DepositRequestFinancialPeer::REQUEST_ID);

		$criteria->addSelectColumn(DepositRequestFinancialPeer::UNIQUE_KEY);

		$criteria->addSelectColumn(DepositRequestFinancialPeer::PROCESS_STATUS);

		$criteria->addSelectColumn(DepositRequestFinancialPeer::STATUS);

		$criteria->addSelectColumn(DepositRequestFinancialPeer::CREATED_AT);

		$criteria->addSelectColumn(DepositRequestFinancialPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_request_financial.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_request_financial.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositRequestFinancialPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositRequestFinancialPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositRequestFinancialPeer::doSelectRS($criteria, $con);
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
		$objects = DepositRequestFinancialPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositRequestFinancialPeer::populateObjects(DepositRequestFinancialPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositRequestFinancialPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositRequestFinancialPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDepositRequest(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositRequestFinancialPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositRequestFinancialPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositRequestFinancialPeer::REQUEST_ID, DepositRequestPeer::ID);

		$rs = DepositRequestFinancialPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDepositRequest(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositRequestFinancialPeer::addSelectColumns($c);
		$startcol = (DepositRequestFinancialPeer::NUM_COLUMNS - DepositRequestFinancialPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositRequestPeer::addSelectColumns($c);

		$c->addJoin(DepositRequestFinancialPeer::REQUEST_ID, DepositRequestPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositRequestFinancialPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositRequestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDepositRequest(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDepositRequestFinancial($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositRequestFinancials();
				$obj2->addDepositRequestFinancial($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositRequestFinancialPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositRequestFinancialPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositRequestFinancialPeer::REQUEST_ID, DepositRequestPeer::ID);

		$rs = DepositRequestFinancialPeer::doSelectRS($criteria, $con);
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

		DepositRequestFinancialPeer::addSelectColumns($c);
		$startcol2 = (DepositRequestFinancialPeer::NUM_COLUMNS - DepositRequestFinancialPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositRequestPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositRequestPeer::NUM_COLUMNS;

		$c->addJoin(DepositRequestFinancialPeer::REQUEST_ID, DepositRequestPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositRequestFinancialPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DepositRequestPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositRequest(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositRequestFinancial($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositRequestFinancials();
				$obj2->addDepositRequestFinancial($obj1);
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
		return DepositRequestFinancialPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositRequestFinancialPeer::ID); 

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
			$comparison = $criteria->getComparison(DepositRequestFinancialPeer::ID);
			$selectCriteria->add(DepositRequestFinancialPeer::ID, $criteria->remove(DepositRequestFinancialPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DepositRequestFinancialPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DepositRequestFinancialPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositRequestFinancial) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DepositRequestFinancialPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DepositRequestFinancial $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositRequestFinancialPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositRequestFinancialPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DepositRequestFinancialPeer::DATABASE_NAME, DepositRequestFinancialPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositRequestFinancialPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DepositRequestFinancialPeer::DATABASE_NAME);

		$criteria->add(DepositRequestFinancialPeer::ID, $pk);


		$v = DepositRequestFinancialPeer::doSelect($criteria, $con);

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
			$criteria->add(DepositRequestFinancialPeer::ID, $pks, Criteria::IN);
			$objs = DepositRequestFinancialPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDepositRequestFinancialPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositRequestFinancialMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositRequestFinancialMapBuilder');
}
