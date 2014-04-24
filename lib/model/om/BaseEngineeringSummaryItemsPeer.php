<?php


abstract class BaseEngineeringSummaryItemsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'engineering_summary_items';

	
	const CLASS_DEFAULT = 'lib.model.EngineeringSummaryItems';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'engineering_summary_items.ID';

	
	const ENGINEERING_SUMMARY_ID = 'engineering_summary_items.ENGINEERING_SUMMARY_ID';

	
	const PROJECT_CONTENT = 'engineering_summary_items.PROJECT_CONTENT';

	
	const CONTRACT_QUANTITY = 'engineering_summary_items.CONTRACT_QUANTITY';

	
	const FLOAT_QUANTITY = 'engineering_summary_items.FLOAT_QUANTITY';

	
	const CURRENT_FINISH_AMOUNT = 'engineering_summary_items.CURRENT_FINISH_AMOUNT';

	
	const LAST_FINISH_AMOUNT = 'engineering_summary_items.LAST_FINISH_AMOUNT';

	
	const FINISH_AMOUNT = 'engineering_summary_items.FINISH_AMOUNT';

	
	const FINISH_PERCENT = 'engineering_summary_items.FINISH_PERCENT';

	
	const COMMENT = 'engineering_summary_items.COMMENT';

	
	const CREATED_AT = 'engineering_summary_items.CREATED_AT';

	
	const UPDATED_AT = 'engineering_summary_items.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'EngineeringSummaryId', 'ProjectContent', 'ContractQuantity', 'FloatQuantity', 'CurrentFinishAmount', 'LastFinishAmount', 'FinishAmount', 'FinishPercent', 'Comment', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EngineeringSummaryItemsPeer::ID, EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, EngineeringSummaryItemsPeer::PROJECT_CONTENT, EngineeringSummaryItemsPeer::CONTRACT_QUANTITY, EngineeringSummaryItemsPeer::FLOAT_QUANTITY, EngineeringSummaryItemsPeer::CURRENT_FINISH_AMOUNT, EngineeringSummaryItemsPeer::LAST_FINISH_AMOUNT, EngineeringSummaryItemsPeer::FINISH_AMOUNT, EngineeringSummaryItemsPeer::FINISH_PERCENT, EngineeringSummaryItemsPeer::COMMENT, EngineeringSummaryItemsPeer::CREATED_AT, EngineeringSummaryItemsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'engineering_summary_id', 'project_content', 'contract_quantity', 'float_quantity', 'current_finish_amount', 'last_finish_amount', 'finish_amount', 'finish_percent', 'comment', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'EngineeringSummaryId' => 1, 'ProjectContent' => 2, 'ContractQuantity' => 3, 'FloatQuantity' => 4, 'CurrentFinishAmount' => 5, 'LastFinishAmount' => 6, 'FinishAmount' => 7, 'FinishPercent' => 8, 'Comment' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (EngineeringSummaryItemsPeer::ID => 0, EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID => 1, EngineeringSummaryItemsPeer::PROJECT_CONTENT => 2, EngineeringSummaryItemsPeer::CONTRACT_QUANTITY => 3, EngineeringSummaryItemsPeer::FLOAT_QUANTITY => 4, EngineeringSummaryItemsPeer::CURRENT_FINISH_AMOUNT => 5, EngineeringSummaryItemsPeer::LAST_FINISH_AMOUNT => 6, EngineeringSummaryItemsPeer::FINISH_AMOUNT => 7, EngineeringSummaryItemsPeer::FINISH_PERCENT => 8, EngineeringSummaryItemsPeer::COMMENT => 9, EngineeringSummaryItemsPeer::CREATED_AT => 10, EngineeringSummaryItemsPeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'engineering_summary_id' => 1, 'project_content' => 2, 'contract_quantity' => 3, 'float_quantity' => 4, 'current_finish_amount' => 5, 'last_finish_amount' => 6, 'finish_amount' => 7, 'finish_percent' => 8, 'comment' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EngineeringSummaryItemsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EngineeringSummaryItemsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EngineeringSummaryItemsPeer::getTableMap();
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
		return str_replace(EngineeringSummaryItemsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::ID);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::PROJECT_CONTENT);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::CONTRACT_QUANTITY);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::FLOAT_QUANTITY);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::CURRENT_FINISH_AMOUNT);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::LAST_FINISH_AMOUNT);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::FINISH_AMOUNT);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::FINISH_PERCENT);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::COMMENT);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::CREATED_AT);

		$criteria->addSelectColumn(EngineeringSummaryItemsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(engineering_summary_items.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT engineering_summary_items.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringSummaryItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSummaryItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EngineeringSummaryItemsPeer::doSelectRS($criteria, $con);
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
		$objects = EngineeringSummaryItemsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EngineeringSummaryItemsPeer::populateObjects(EngineeringSummaryItemsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EngineeringSummaryItemsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EngineeringSummaryItemsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEngineeringSummary(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringSummaryItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSummaryItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, EngineeringSummaryPeer::ID);

		$rs = EngineeringSummaryItemsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEngineeringSummary(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EngineeringSummaryItemsPeer::addSelectColumns($c);
		$startcol = (EngineeringSummaryItemsPeer::NUM_COLUMNS - EngineeringSummaryItemsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EngineeringSummaryPeer::addSelectColumns($c);

		$c->addJoin(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, EngineeringSummaryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringSummaryItemsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EngineeringSummaryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEngineeringSummary(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEngineeringSummaryItems($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEngineeringSummaryItemss();
				$obj2->addEngineeringSummaryItems($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringSummaryItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSummaryItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, EngineeringSummaryPeer::ID);

		$rs = EngineeringSummaryItemsPeer::doSelectRS($criteria, $con);
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

		EngineeringSummaryItemsPeer::addSelectColumns($c);
		$startcol2 = (EngineeringSummaryItemsPeer::NUM_COLUMNS - EngineeringSummaryItemsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EngineeringSummaryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EngineeringSummaryPeer::NUM_COLUMNS;

		$c->addJoin(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, EngineeringSummaryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringSummaryItemsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EngineeringSummaryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEngineeringSummary(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEngineeringSummaryItems($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEngineeringSummaryItemss();
				$obj2->addEngineeringSummaryItems($obj1);
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
		return EngineeringSummaryItemsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EngineeringSummaryItemsPeer::ID); 

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
			$comparison = $criteria->getComparison(EngineeringSummaryItemsPeer::ID);
			$selectCriteria->add(EngineeringSummaryItemsPeer::ID, $criteria->remove(EngineeringSummaryItemsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EngineeringSummaryItemsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EngineeringSummaryItemsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EngineeringSummaryItems) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EngineeringSummaryItemsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EngineeringSummaryItems $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EngineeringSummaryItemsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EngineeringSummaryItemsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EngineeringSummaryItemsPeer::DATABASE_NAME, EngineeringSummaryItemsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EngineeringSummaryItemsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EngineeringSummaryItemsPeer::DATABASE_NAME);

		$criteria->add(EngineeringSummaryItemsPeer::ID, $pk);


		$v = EngineeringSummaryItemsPeer::doSelect($criteria, $con);

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
			$criteria->add(EngineeringSummaryItemsPeer::ID, $pks, Criteria::IN);
			$objs = EngineeringSummaryItemsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEngineeringSummaryItemsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EngineeringSummaryItemsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EngineeringSummaryItemsMapBuilder');
}
