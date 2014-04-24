<?php


abstract class BaseEngineeringGoodsItemsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'engineering_goods_items';

	
	const CLASS_DEFAULT = 'lib.model.EngineeringGoodsItems';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'engineering_goods_items.ID';

	
	const ENGINEERING_GOODS_ID = 'engineering_goods_items.ENGINEERING_GOODS_ID';

	
	const PROJECT_NAME = 'engineering_goods_items.PROJECT_NAME';

	
	const BRAND = 'engineering_goods_items.BRAND';

	
	const REQUIREMENT = 'engineering_goods_items.REQUIREMENT';

	
	const UNIT = 'engineering_goods_items.UNIT';

	
	const QUANTITY = 'engineering_goods_items.QUANTITY';

	
	const COMMENT = 'engineering_goods_items.COMMENT';

	
	const CREATED_AT = 'engineering_goods_items.CREATED_AT';

	
	const UPDATED_AT = 'engineering_goods_items.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'EngineeringGoodsId', 'ProjectName', 'Brand', 'Requirement', 'Unit', 'Quantity', 'Comment', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EngineeringGoodsItemsPeer::ID, EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, EngineeringGoodsItemsPeer::PROJECT_NAME, EngineeringGoodsItemsPeer::BRAND, EngineeringGoodsItemsPeer::REQUIREMENT, EngineeringGoodsItemsPeer::UNIT, EngineeringGoodsItemsPeer::QUANTITY, EngineeringGoodsItemsPeer::COMMENT, EngineeringGoodsItemsPeer::CREATED_AT, EngineeringGoodsItemsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'engineering_goods_id', 'project_name', 'brand', 'requirement', 'unit', 'quantity', 'comment', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'EngineeringGoodsId' => 1, 'ProjectName' => 2, 'Brand' => 3, 'Requirement' => 4, 'Unit' => 5, 'Quantity' => 6, 'Comment' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (EngineeringGoodsItemsPeer::ID => 0, EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID => 1, EngineeringGoodsItemsPeer::PROJECT_NAME => 2, EngineeringGoodsItemsPeer::BRAND => 3, EngineeringGoodsItemsPeer::REQUIREMENT => 4, EngineeringGoodsItemsPeer::UNIT => 5, EngineeringGoodsItemsPeer::QUANTITY => 6, EngineeringGoodsItemsPeer::COMMENT => 7, EngineeringGoodsItemsPeer::CREATED_AT => 8, EngineeringGoodsItemsPeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'engineering_goods_id' => 1, 'project_name' => 2, 'brand' => 3, 'requirement' => 4, 'unit' => 5, 'quantity' => 6, 'comment' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EngineeringGoodsItemsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EngineeringGoodsItemsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EngineeringGoodsItemsPeer::getTableMap();
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
		return str_replace(EngineeringGoodsItemsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::ID);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::PROJECT_NAME);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::BRAND);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::REQUIREMENT);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::UNIT);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::QUANTITY);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::COMMENT);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::CREATED_AT);

		$criteria->addSelectColumn(EngineeringGoodsItemsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(engineering_goods_items.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT engineering_goods_items.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringGoodsItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringGoodsItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EngineeringGoodsItemsPeer::doSelectRS($criteria, $con);
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
		$objects = EngineeringGoodsItemsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EngineeringGoodsItemsPeer::populateObjects(EngineeringGoodsItemsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EngineeringGoodsItemsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EngineeringGoodsItemsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEngineeringGoods(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringGoodsItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringGoodsItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, EngineeringGoodsPeer::ID);

		$rs = EngineeringGoodsItemsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEngineeringGoods(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EngineeringGoodsItemsPeer::addSelectColumns($c);
		$startcol = (EngineeringGoodsItemsPeer::NUM_COLUMNS - EngineeringGoodsItemsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EngineeringGoodsPeer::addSelectColumns($c);

		$c->addJoin(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, EngineeringGoodsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringGoodsItemsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EngineeringGoodsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEngineeringGoods(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEngineeringGoodsItems($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEngineeringGoodsItemss();
				$obj2->addEngineeringGoodsItems($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringGoodsItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringGoodsItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, EngineeringGoodsPeer::ID);

		$rs = EngineeringGoodsItemsPeer::doSelectRS($criteria, $con);
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

		EngineeringGoodsItemsPeer::addSelectColumns($c);
		$startcol2 = (EngineeringGoodsItemsPeer::NUM_COLUMNS - EngineeringGoodsItemsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EngineeringGoodsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EngineeringGoodsPeer::NUM_COLUMNS;

		$c->addJoin(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, EngineeringGoodsPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringGoodsItemsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EngineeringGoodsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEngineeringGoods(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEngineeringGoodsItems($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEngineeringGoodsItemss();
				$obj2->addEngineeringGoodsItems($obj1);
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
		return EngineeringGoodsItemsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EngineeringGoodsItemsPeer::ID); 

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
			$comparison = $criteria->getComparison(EngineeringGoodsItemsPeer::ID);
			$selectCriteria->add(EngineeringGoodsItemsPeer::ID, $criteria->remove(EngineeringGoodsItemsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EngineeringGoodsItemsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EngineeringGoodsItemsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EngineeringGoodsItems) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EngineeringGoodsItemsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EngineeringGoodsItems $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EngineeringGoodsItemsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EngineeringGoodsItemsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EngineeringGoodsItemsPeer::DATABASE_NAME, EngineeringGoodsItemsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EngineeringGoodsItemsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EngineeringGoodsItemsPeer::DATABASE_NAME);

		$criteria->add(EngineeringGoodsItemsPeer::ID, $pk);


		$v = EngineeringGoodsItemsPeer::doSelect($criteria, $con);

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
			$criteria->add(EngineeringGoodsItemsPeer::ID, $pks, Criteria::IN);
			$objs = EngineeringGoodsItemsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEngineeringGoodsItemsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EngineeringGoodsItemsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EngineeringGoodsItemsMapBuilder');
}
