<?php


abstract class BaseEngineeringGoodsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'engineering_goods';

	
	const CLASS_DEFAULT = 'lib.model.EngineeringGoods';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'engineering_goods.ID';

	
	const APPLICATION_ID = 'engineering_goods.APPLICATION_ID';

	
	const DEPARTMENT_ID = 'engineering_goods.DEPARTMENT_ID';

	
	const CREATED_AT = 'engineering_goods.CREATED_AT';

	
	const UPDATED_AT = 'engineering_goods.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ApplicationId', 'DepartmentId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EngineeringGoodsPeer::ID, EngineeringGoodsPeer::APPLICATION_ID, EngineeringGoodsPeer::DEPARTMENT_ID, EngineeringGoodsPeer::CREATED_AT, EngineeringGoodsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'application_id', 'department_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApplicationId' => 1, 'DepartmentId' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ),
		BasePeer::TYPE_COLNAME => array (EngineeringGoodsPeer::ID => 0, EngineeringGoodsPeer::APPLICATION_ID => 1, EngineeringGoodsPeer::DEPARTMENT_ID => 2, EngineeringGoodsPeer::CREATED_AT => 3, EngineeringGoodsPeer::UPDATED_AT => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'application_id' => 1, 'department_id' => 2, 'created_at' => 3, 'updated_at' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EngineeringGoodsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EngineeringGoodsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EngineeringGoodsPeer::getTableMap();
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
		return str_replace(EngineeringGoodsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EngineeringGoodsPeer::ID);

		$criteria->addSelectColumn(EngineeringGoodsPeer::APPLICATION_ID);

		$criteria->addSelectColumn(EngineeringGoodsPeer::DEPARTMENT_ID);

		$criteria->addSelectColumn(EngineeringGoodsPeer::CREATED_AT);

		$criteria->addSelectColumn(EngineeringGoodsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(engineering_goods.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT engineering_goods.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringGoodsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringGoodsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EngineeringGoodsPeer::doSelectRS($criteria, $con);
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
		$objects = EngineeringGoodsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EngineeringGoodsPeer::populateObjects(EngineeringGoodsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EngineeringGoodsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EngineeringGoodsPeer::getOMClass();
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
			$criteria->addSelectColumn(EngineeringGoodsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringGoodsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringGoodsPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = EngineeringGoodsPeer::doSelectRS($criteria, $con);
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

		EngineeringGoodsPeer::addSelectColumns($c);
		$startcol = (EngineeringGoodsPeer::NUM_COLUMNS - EngineeringGoodsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ApplicationPeer::addSelectColumns($c);

		$c->addJoin(EngineeringGoodsPeer::APPLICATION_ID, ApplicationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringGoodsPeer::getOMClass();

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
										$temp_obj2->addEngineeringGoods($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEngineeringGoodss();
				$obj2->addEngineeringGoods($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringGoodsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringGoodsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringGoodsPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = EngineeringGoodsPeer::doSelectRS($criteria, $con);
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

		EngineeringGoodsPeer::addSelectColumns($c);
		$startcol2 = (EngineeringGoodsPeer::NUM_COLUMNS - EngineeringGoodsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApplicationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApplicationPeer::NUM_COLUMNS;

		$c->addJoin(EngineeringGoodsPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringGoodsPeer::getOMClass();


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
					$temp_obj2->addEngineeringGoods($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEngineeringGoodss();
				$obj2->addEngineeringGoods($obj1);
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
		return EngineeringGoodsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EngineeringGoodsPeer::ID); 

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
			$comparison = $criteria->getComparison(EngineeringGoodsPeer::ID);
			$selectCriteria->add(EngineeringGoodsPeer::ID, $criteria->remove(EngineeringGoodsPeer::ID), $comparison);

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
			$affectedRows += EngineeringGoodsPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(EngineeringGoodsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EngineeringGoodsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EngineeringGoods) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EngineeringGoodsPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += EngineeringGoodsPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = EngineeringGoodsPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/EngineeringGoodsItems.php';

						$c = new Criteria();
			
			$c->add(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, $obj->getId());
			$affectedRows += EngineeringGoodsItemsPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(EngineeringGoods $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EngineeringGoodsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EngineeringGoodsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EngineeringGoodsPeer::DATABASE_NAME, EngineeringGoodsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EngineeringGoodsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EngineeringGoodsPeer::DATABASE_NAME);

		$criteria->add(EngineeringGoodsPeer::ID, $pk);


		$v = EngineeringGoodsPeer::doSelect($criteria, $con);

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
			$criteria->add(EngineeringGoodsPeer::ID, $pks, Criteria::IN);
			$objs = EngineeringGoodsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEngineeringGoodsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EngineeringGoodsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EngineeringGoodsMapBuilder');
}
