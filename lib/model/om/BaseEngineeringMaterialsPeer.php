<?php


abstract class BaseEngineeringMaterialsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'engineering_materials';

	
	const CLASS_DEFAULT = 'lib.model.EngineeringMaterials';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'engineering_materials.ID';

	
	const APPLICATION_ID = 'engineering_materials.APPLICATION_ID';

	
	const CONTRACT_SECTION = 'engineering_materials.CONTRACT_SECTION';

	
	const NUMBER = 'engineering_materials.NUMBER';

	
	const CREATED_AT = 'engineering_materials.CREATED_AT';

	
	const UPDATED_AT = 'engineering_materials.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ApplicationId', 'ContractSection', 'Number', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EngineeringMaterialsPeer::ID, EngineeringMaterialsPeer::APPLICATION_ID, EngineeringMaterialsPeer::CONTRACT_SECTION, EngineeringMaterialsPeer::NUMBER, EngineeringMaterialsPeer::CREATED_AT, EngineeringMaterialsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'application_id', 'contract_section', 'number', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApplicationId' => 1, 'ContractSection' => 2, 'Number' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (EngineeringMaterialsPeer::ID => 0, EngineeringMaterialsPeer::APPLICATION_ID => 1, EngineeringMaterialsPeer::CONTRACT_SECTION => 2, EngineeringMaterialsPeer::NUMBER => 3, EngineeringMaterialsPeer::CREATED_AT => 4, EngineeringMaterialsPeer::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'application_id' => 1, 'contract_section' => 2, 'number' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EngineeringMaterialsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EngineeringMaterialsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EngineeringMaterialsPeer::getTableMap();
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
		return str_replace(EngineeringMaterialsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EngineeringMaterialsPeer::ID);

		$criteria->addSelectColumn(EngineeringMaterialsPeer::APPLICATION_ID);

		$criteria->addSelectColumn(EngineeringMaterialsPeer::CONTRACT_SECTION);

		$criteria->addSelectColumn(EngineeringMaterialsPeer::NUMBER);

		$criteria->addSelectColumn(EngineeringMaterialsPeer::CREATED_AT);

		$criteria->addSelectColumn(EngineeringMaterialsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(engineering_materials.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT engineering_materials.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringMaterialsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringMaterialsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EngineeringMaterialsPeer::doSelectRS($criteria, $con);
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
		$objects = EngineeringMaterialsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EngineeringMaterialsPeer::populateObjects(EngineeringMaterialsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EngineeringMaterialsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EngineeringMaterialsPeer::getOMClass();
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
			$criteria->addSelectColumn(EngineeringMaterialsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringMaterialsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringMaterialsPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = EngineeringMaterialsPeer::doSelectRS($criteria, $con);
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

		EngineeringMaterialsPeer::addSelectColumns($c);
		$startcol = (EngineeringMaterialsPeer::NUM_COLUMNS - EngineeringMaterialsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ApplicationPeer::addSelectColumns($c);

		$c->addJoin(EngineeringMaterialsPeer::APPLICATION_ID, ApplicationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringMaterialsPeer::getOMClass();

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
										$temp_obj2->addEngineeringMaterials($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEngineeringMaterialss();
				$obj2->addEngineeringMaterials($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringMaterialsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringMaterialsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringMaterialsPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = EngineeringMaterialsPeer::doSelectRS($criteria, $con);
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

		EngineeringMaterialsPeer::addSelectColumns($c);
		$startcol2 = (EngineeringMaterialsPeer::NUM_COLUMNS - EngineeringMaterialsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApplicationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApplicationPeer::NUM_COLUMNS;

		$c->addJoin(EngineeringMaterialsPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringMaterialsPeer::getOMClass();


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
					$temp_obj2->addEngineeringMaterials($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEngineeringMaterialss();
				$obj2->addEngineeringMaterials($obj1);
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
		return EngineeringMaterialsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EngineeringMaterialsPeer::ID); 

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
			$comparison = $criteria->getComparison(EngineeringMaterialsPeer::ID);
			$selectCriteria->add(EngineeringMaterialsPeer::ID, $criteria->remove(EngineeringMaterialsPeer::ID), $comparison);

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
			$affectedRows += EngineeringMaterialsPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(EngineeringMaterialsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EngineeringMaterialsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EngineeringMaterials) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EngineeringMaterialsPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += EngineeringMaterialsPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = EngineeringMaterialsPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/EngineeringMaterialsItems.php';

						$c = new Criteria();
			
			$c->add(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, $obj->getId());
			$affectedRows += EngineeringMaterialsItemsPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(EngineeringMaterials $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EngineeringMaterialsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EngineeringMaterialsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EngineeringMaterialsPeer::DATABASE_NAME, EngineeringMaterialsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EngineeringMaterialsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EngineeringMaterialsPeer::DATABASE_NAME);

		$criteria->add(EngineeringMaterialsPeer::ID, $pk);


		$v = EngineeringMaterialsPeer::doSelect($criteria, $con);

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
			$criteria->add(EngineeringMaterialsPeer::ID, $pks, Criteria::IN);
			$objs = EngineeringMaterialsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEngineeringMaterialsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EngineeringMaterialsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EngineeringMaterialsMapBuilder');
}
