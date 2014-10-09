<?php


abstract class BaseDepositStationNewsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_station_news';

	
	const CLASS_DEFAULT = 'lib.model.DepositStationNews';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_station_news.ID';

	
	const TITLE = 'deposit_station_news.TITLE';

	
	const CONTENT = 'deposit_station_news.CONTENT';

	
	const SEND_TIME = 'deposit_station_news.SEND_TIME';

	
	const TYPE = 'deposit_station_news.TYPE';

	
	const DEPOSIT_FINANCIAL_PRODUCTS_ID = 'deposit_station_news.DEPOSIT_FINANCIAL_PRODUCTS_ID';

	
	const CREATED_AT = 'deposit_station_news.CREATED_AT';

	
	const UPDATED_AT = 'deposit_station_news.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Content', 'SendTime', 'Type', 'DepositFinancialProductsId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositStationNewsPeer::ID, DepositStationNewsPeer::TITLE, DepositStationNewsPeer::CONTENT, DepositStationNewsPeer::SEND_TIME, DepositStationNewsPeer::TYPE, DepositStationNewsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositStationNewsPeer::CREATED_AT, DepositStationNewsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'content', 'send_time', 'type', 'deposit_financial_products_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Content' => 2, 'SendTime' => 3, 'Type' => 4, 'DepositFinancialProductsId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (DepositStationNewsPeer::ID => 0, DepositStationNewsPeer::TITLE => 1, DepositStationNewsPeer::CONTENT => 2, DepositStationNewsPeer::SEND_TIME => 3, DepositStationNewsPeer::TYPE => 4, DepositStationNewsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID => 5, DepositStationNewsPeer::CREATED_AT => 6, DepositStationNewsPeer::UPDATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'content' => 2, 'send_time' => 3, 'type' => 4, 'deposit_financial_products_id' => 5, 'created_at' => 6, 'updated_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositStationNewsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositStationNewsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositStationNewsPeer::getTableMap();
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
		return str_replace(DepositStationNewsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositStationNewsPeer::ID);

		$criteria->addSelectColumn(DepositStationNewsPeer::TITLE);

		$criteria->addSelectColumn(DepositStationNewsPeer::CONTENT);

		$criteria->addSelectColumn(DepositStationNewsPeer::SEND_TIME);

		$criteria->addSelectColumn(DepositStationNewsPeer::TYPE);

		$criteria->addSelectColumn(DepositStationNewsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);

		$criteria->addSelectColumn(DepositStationNewsPeer::CREATED_AT);

		$criteria->addSelectColumn(DepositStationNewsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_station_news.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_station_news.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositStationNewsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositStationNewsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositStationNewsPeer::doSelectRS($criteria, $con);
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
		$objects = DepositStationNewsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositStationNewsPeer::populateObjects(DepositStationNewsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositStationNewsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositStationNewsPeer::getOMClass();
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
		return DepositStationNewsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositStationNewsPeer::ID); 

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
			$comparison = $criteria->getComparison(DepositStationNewsPeer::ID);
			$selectCriteria->add(DepositStationNewsPeer::ID, $criteria->remove(DepositStationNewsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DepositStationNewsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DepositStationNewsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositStationNews) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DepositStationNewsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DepositStationNews $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositStationNewsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositStationNewsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DepositStationNewsPeer::DATABASE_NAME, DepositStationNewsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositStationNewsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DepositStationNewsPeer::DATABASE_NAME);

		$criteria->add(DepositStationNewsPeer::ID, $pk);


		$v = DepositStationNewsPeer::doSelect($criteria, $con);

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
			$criteria->add(DepositStationNewsPeer::ID, $pks, Criteria::IN);
			$objs = DepositStationNewsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDepositStationNewsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositStationNewsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositStationNewsMapBuilder');
}
