<?php


abstract class BaseEngineeringSummaryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'engineering_summary';

	
	const CLASS_DEFAULT = 'lib.model.EngineeringSummary';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'engineering_summary.ID';

	
	const APPLICATION_ID = 'engineering_summary.APPLICATION_ID';

	
	const TOTAL_CURRENT_FINISH_AMOUNT = 'engineering_summary.TOTAL_CURRENT_FINISH_AMOUNT';

	
	const TOTAL_LAST_FINISH_AMOUNT = 'engineering_summary.TOTAL_LAST_FINISH_AMOUNT';

	
	const TOTAL_FINISH_AMOUNT = 'engineering_summary.TOTAL_FINISH_AMOUNT';

	
	const CONSTRUCTION_UNIT = 'engineering_summary.CONSTRUCTION_UNIT';

	
	const CONTRACT_NUMBER = 'engineering_summary.CONTRACT_NUMBER';

	
	const ISSUE = 'engineering_summary.ISSUE';

	
	const EXPIRATION_DATE = 'engineering_summary.EXPIRATION_DATE';

	
	const AMOUNT = 'engineering_summary.AMOUNT';

	
	const CREATED_AT = 'engineering_summary.CREATED_AT';

	
	const UPDATED_AT = 'engineering_summary.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ApplicationId', 'TotalCurrentFinishAmount', 'TotalLastFinishAmount', 'TotalFinishAmount', 'ConstructionUnit', 'ContractNumber', 'Issue', 'ExpirationDate', 'Amount', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EngineeringSummaryPeer::ID, EngineeringSummaryPeer::APPLICATION_ID, EngineeringSummaryPeer::TOTAL_CURRENT_FINISH_AMOUNT, EngineeringSummaryPeer::TOTAL_LAST_FINISH_AMOUNT, EngineeringSummaryPeer::TOTAL_FINISH_AMOUNT, EngineeringSummaryPeer::CONSTRUCTION_UNIT, EngineeringSummaryPeer::CONTRACT_NUMBER, EngineeringSummaryPeer::ISSUE, EngineeringSummaryPeer::EXPIRATION_DATE, EngineeringSummaryPeer::AMOUNT, EngineeringSummaryPeer::CREATED_AT, EngineeringSummaryPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'application_id', 'total_current_finish_amount', 'total_last_finish_amount', 'total_finish_amount', 'construction_unit', 'contract_number', 'issue', 'expiration_date', 'amount', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApplicationId' => 1, 'TotalCurrentFinishAmount' => 2, 'TotalLastFinishAmount' => 3, 'TotalFinishAmount' => 4, 'ConstructionUnit' => 5, 'ContractNumber' => 6, 'Issue' => 7, 'ExpirationDate' => 8, 'Amount' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (EngineeringSummaryPeer::ID => 0, EngineeringSummaryPeer::APPLICATION_ID => 1, EngineeringSummaryPeer::TOTAL_CURRENT_FINISH_AMOUNT => 2, EngineeringSummaryPeer::TOTAL_LAST_FINISH_AMOUNT => 3, EngineeringSummaryPeer::TOTAL_FINISH_AMOUNT => 4, EngineeringSummaryPeer::CONSTRUCTION_UNIT => 5, EngineeringSummaryPeer::CONTRACT_NUMBER => 6, EngineeringSummaryPeer::ISSUE => 7, EngineeringSummaryPeer::EXPIRATION_DATE => 8, EngineeringSummaryPeer::AMOUNT => 9, EngineeringSummaryPeer::CREATED_AT => 10, EngineeringSummaryPeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'application_id' => 1, 'total_current_finish_amount' => 2, 'total_last_finish_amount' => 3, 'total_finish_amount' => 4, 'construction_unit' => 5, 'contract_number' => 6, 'issue' => 7, 'expiration_date' => 8, 'amount' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EngineeringSummaryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EngineeringSummaryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EngineeringSummaryPeer::getTableMap();
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
		return str_replace(EngineeringSummaryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EngineeringSummaryPeer::ID);

		$criteria->addSelectColumn(EngineeringSummaryPeer::APPLICATION_ID);

		$criteria->addSelectColumn(EngineeringSummaryPeer::TOTAL_CURRENT_FINISH_AMOUNT);

		$criteria->addSelectColumn(EngineeringSummaryPeer::TOTAL_LAST_FINISH_AMOUNT);

		$criteria->addSelectColumn(EngineeringSummaryPeer::TOTAL_FINISH_AMOUNT);

		$criteria->addSelectColumn(EngineeringSummaryPeer::CONSTRUCTION_UNIT);

		$criteria->addSelectColumn(EngineeringSummaryPeer::CONTRACT_NUMBER);

		$criteria->addSelectColumn(EngineeringSummaryPeer::ISSUE);

		$criteria->addSelectColumn(EngineeringSummaryPeer::EXPIRATION_DATE);

		$criteria->addSelectColumn(EngineeringSummaryPeer::AMOUNT);

		$criteria->addSelectColumn(EngineeringSummaryPeer::CREATED_AT);

		$criteria->addSelectColumn(EngineeringSummaryPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(engineering_summary.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT engineering_summary.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringSummaryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSummaryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EngineeringSummaryPeer::doSelectRS($criteria, $con);
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
		$objects = EngineeringSummaryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EngineeringSummaryPeer::populateObjects(EngineeringSummaryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EngineeringSummaryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EngineeringSummaryPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinApplication(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringSummaryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSummaryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringSummaryPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = EngineeringSummaryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinApplication(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EngineeringSummaryPeer::addSelectColumns($c);
		$startcol = (EngineeringSummaryPeer::NUM_COLUMNS - EngineeringSummaryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ApplicationPeer::addSelectColumns($c);

		$c->addJoin(EngineeringSummaryPeer::APPLICATION_ID, ApplicationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringSummaryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getApplication(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEngineeringSummary($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEngineeringSummarys();
				$obj2->addEngineeringSummary($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringSummaryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSummaryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringSummaryPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = EngineeringSummaryPeer::doSelectRS($criteria, $con);
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

		EngineeringSummaryPeer::addSelectColumns($c);
		$startcol2 = (EngineeringSummaryPeer::NUM_COLUMNS - EngineeringSummaryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApplicationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApplicationPeer::NUM_COLUMNS;

		$c->addJoin(EngineeringSummaryPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringSummaryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ApplicationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getApplication(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEngineeringSummary($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEngineeringSummarys();
				$obj2->addEngineeringSummary($obj1);
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
		return EngineeringSummaryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EngineeringSummaryPeer::ID); 

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
			$comparison = $criteria->getComparison(EngineeringSummaryPeer::ID);
			$selectCriteria->add(EngineeringSummaryPeer::ID, $criteria->remove(EngineeringSummaryPeer::ID), $comparison);

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
			$affectedRows += EngineeringSummaryPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(EngineeringSummaryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EngineeringSummaryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EngineeringSummary) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EngineeringSummaryPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += EngineeringSummaryPeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = EngineeringSummaryPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/EngineeringSummaryItems.php';

						$c = new Criteria();
			
			$c->add(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, $obj->getId());
			$affectedRows += EngineeringSummaryItemsPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(EngineeringSummary $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EngineeringSummaryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EngineeringSummaryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EngineeringSummaryPeer::DATABASE_NAME, EngineeringSummaryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EngineeringSummaryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EngineeringSummaryPeer::DATABASE_NAME);

		$criteria->add(EngineeringSummaryPeer::ID, $pk);


		$v = EngineeringSummaryPeer::doSelect($criteria, $con);

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
			$criteria->add(EngineeringSummaryPeer::ID, $pks, Criteria::IN);
			$objs = EngineeringSummaryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEngineeringSummaryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EngineeringSummaryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EngineeringSummaryMapBuilder');
}
