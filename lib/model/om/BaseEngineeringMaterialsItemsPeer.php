<?php


abstract class BaseEngineeringMaterialsItemsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'engineering_materials_items';

	
	const CLASS_DEFAULT = 'lib.model.EngineeringMaterialsItems';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'engineering_materials_items.ID';

	
	const ENGINEERING_MATERIALS_ID = 'engineering_materials_items.ENGINEERING_MATERIALS_ID';

	
	const MATERIAL_NAME = 'engineering_materials_items.MATERIAL_NAME';

	
	const BRAND = 'engineering_materials_items.BRAND';

	
	const TECHNICAL_REQUIREMENT = 'engineering_materials_items.TECHNICAL_REQUIREMENT';

	
	const UNIT = 'engineering_materials_items.UNIT';

	
	const QUANTITY = 'engineering_materials_items.QUANTITY';

	
	const ARRIVAL_DATE = 'engineering_materials_items.ARRIVAL_DATE';

	
	const ARRIVAL_PLACE = 'engineering_materials_items.ARRIVAL_PLACE';

	
	const COMMENT = 'engineering_materials_items.COMMENT';

	
	const CREATED_AT = 'engineering_materials_items.CREATED_AT';

	
	const UPDATED_AT = 'engineering_materials_items.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'EngineeringMaterialsId', 'MaterialName', 'Brand', 'TechnicalRequirement', 'Unit', 'Quantity', 'ArrivalDate', 'ArrivalPlace', 'Comment', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EngineeringMaterialsItemsPeer::ID, EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, EngineeringMaterialsItemsPeer::MATERIAL_NAME, EngineeringMaterialsItemsPeer::BRAND, EngineeringMaterialsItemsPeer::TECHNICAL_REQUIREMENT, EngineeringMaterialsItemsPeer::UNIT, EngineeringMaterialsItemsPeer::QUANTITY, EngineeringMaterialsItemsPeer::ARRIVAL_DATE, EngineeringMaterialsItemsPeer::ARRIVAL_PLACE, EngineeringMaterialsItemsPeer::COMMENT, EngineeringMaterialsItemsPeer::CREATED_AT, EngineeringMaterialsItemsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'engineering_materials_id', 'material_name', 'brand', 'technical_requirement', 'unit', 'quantity', 'arrival_date', 'arrival_place', 'comment', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'EngineeringMaterialsId' => 1, 'MaterialName' => 2, 'Brand' => 3, 'TechnicalRequirement' => 4, 'Unit' => 5, 'Quantity' => 6, 'ArrivalDate' => 7, 'ArrivalPlace' => 8, 'Comment' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (EngineeringMaterialsItemsPeer::ID => 0, EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID => 1, EngineeringMaterialsItemsPeer::MATERIAL_NAME => 2, EngineeringMaterialsItemsPeer::BRAND => 3, EngineeringMaterialsItemsPeer::TECHNICAL_REQUIREMENT => 4, EngineeringMaterialsItemsPeer::UNIT => 5, EngineeringMaterialsItemsPeer::QUANTITY => 6, EngineeringMaterialsItemsPeer::ARRIVAL_DATE => 7, EngineeringMaterialsItemsPeer::ARRIVAL_PLACE => 8, EngineeringMaterialsItemsPeer::COMMENT => 9, EngineeringMaterialsItemsPeer::CREATED_AT => 10, EngineeringMaterialsItemsPeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'engineering_materials_id' => 1, 'material_name' => 2, 'brand' => 3, 'technical_requirement' => 4, 'unit' => 5, 'quantity' => 6, 'arrival_date' => 7, 'arrival_place' => 8, 'comment' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EngineeringMaterialsItemsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EngineeringMaterialsItemsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EngineeringMaterialsItemsPeer::getTableMap();
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
		return str_replace(EngineeringMaterialsItemsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::ID);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::MATERIAL_NAME);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::BRAND);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::TECHNICAL_REQUIREMENT);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::UNIT);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::QUANTITY);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::ARRIVAL_DATE);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::ARRIVAL_PLACE);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::COMMENT);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::CREATED_AT);

		$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(engineering_materials_items.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT engineering_materials_items.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EngineeringMaterialsItemsPeer::doSelectRS($criteria, $con);
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
		$objects = EngineeringMaterialsItemsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EngineeringMaterialsItemsPeer::populateObjects(EngineeringMaterialsItemsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EngineeringMaterialsItemsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EngineeringMaterialsItemsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEngineeringMaterials(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, EngineeringMaterialsPeer::ID);

		$rs = EngineeringMaterialsItemsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEngineeringMaterials(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EngineeringMaterialsItemsPeer::addSelectColumns($c);
		$startcol = (EngineeringMaterialsItemsPeer::NUM_COLUMNS - EngineeringMaterialsItemsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EngineeringMaterialsPeer::addSelectColumns($c);

		$c->addJoin(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, EngineeringMaterialsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringMaterialsItemsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EngineeringMaterialsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEngineeringMaterials(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEngineeringMaterialsItems($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEngineeringMaterialsItemss();
				$obj2->addEngineeringMaterialsItems($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringMaterialsItemsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, EngineeringMaterialsPeer::ID);

		$rs = EngineeringMaterialsItemsPeer::doSelectRS($criteria, $con);
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

		EngineeringMaterialsItemsPeer::addSelectColumns($c);
		$startcol2 = (EngineeringMaterialsItemsPeer::NUM_COLUMNS - EngineeringMaterialsItemsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EngineeringMaterialsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EngineeringMaterialsPeer::NUM_COLUMNS;

		$c->addJoin(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, EngineeringMaterialsPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringMaterialsItemsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EngineeringMaterialsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEngineeringMaterials(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEngineeringMaterialsItems($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEngineeringMaterialsItemss();
				$obj2->addEngineeringMaterialsItems($obj1);
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
		return EngineeringMaterialsItemsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EngineeringMaterialsItemsPeer::ID); 

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
			$comparison = $criteria->getComparison(EngineeringMaterialsItemsPeer::ID);
			$selectCriteria->add(EngineeringMaterialsItemsPeer::ID, $criteria->remove(EngineeringMaterialsItemsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EngineeringMaterialsItemsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EngineeringMaterialsItemsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EngineeringMaterialsItems) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EngineeringMaterialsItemsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EngineeringMaterialsItems $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EngineeringMaterialsItemsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EngineeringMaterialsItemsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EngineeringMaterialsItemsPeer::DATABASE_NAME, EngineeringMaterialsItemsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EngineeringMaterialsItemsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EngineeringMaterialsItemsPeer::DATABASE_NAME);

		$criteria->add(EngineeringMaterialsItemsPeer::ID, $pk);


		$v = EngineeringMaterialsItemsPeer::doSelect($criteria, $con);

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
			$criteria->add(EngineeringMaterialsItemsPeer::ID, $pks, Criteria::IN);
			$objs = EngineeringMaterialsItemsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEngineeringMaterialsItemsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EngineeringMaterialsItemsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EngineeringMaterialsItemsMapBuilder');
}
