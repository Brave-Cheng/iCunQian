<?php


abstract class BasePushDevicesPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'push_devices';

	
	const CLASS_DEFAULT = 'lib.model.PushDevices';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'push_devices.ID';

	
	const CLIENT_ID = 'push_devices.CLIENT_ID';

	
	const APP_NAME = 'push_devices.APP_NAME';

	
	const APP_VERSION = 'push_devices.APP_VERSION';

	
	const DEVICE_UID = 'push_devices.DEVICE_UID';

	
	const DEVICE_NAME = 'push_devices.DEVICE_NAME';

	
	const DEVICE_MODEL = 'push_devices.DEVICE_MODEL';

	
	const DEVICE_VERSION = 'push_devices.DEVICE_VERSION';

	
	const DEVICE_TOKEN = 'push_devices.DEVICE_TOKEN';

	
	const DEVELOPMENT = 'push_devices.DEVELOPMENT';

	
	const STATUS = 'push_devices.STATUS';

	
	const CREATED_AT = 'push_devices.CREATED_AT';

	
	const UPDATED_AT = 'push_devices.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ClientId', 'AppName', 'AppVersion', 'DeviceUid', 'DeviceName', 'DeviceModel', 'DeviceVersion', 'DeviceToken', 'Development', 'Status', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (PushDevicesPeer::ID, PushDevicesPeer::CLIENT_ID, PushDevicesPeer::APP_NAME, PushDevicesPeer::APP_VERSION, PushDevicesPeer::DEVICE_UID, PushDevicesPeer::DEVICE_NAME, PushDevicesPeer::DEVICE_MODEL, PushDevicesPeer::DEVICE_VERSION, PushDevicesPeer::DEVICE_TOKEN, PushDevicesPeer::DEVELOPMENT, PushDevicesPeer::STATUS, PushDevicesPeer::CREATED_AT, PushDevicesPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'client_id', 'app_name', 'app_version', 'device_uid', 'device_name', 'device_model', 'device_version', 'device_token', 'development', 'status', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ClientId' => 1, 'AppName' => 2, 'AppVersion' => 3, 'DeviceUid' => 4, 'DeviceName' => 5, 'DeviceModel' => 6, 'DeviceVersion' => 7, 'DeviceToken' => 8, 'Development' => 9, 'Status' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ),
		BasePeer::TYPE_COLNAME => array (PushDevicesPeer::ID => 0, PushDevicesPeer::CLIENT_ID => 1, PushDevicesPeer::APP_NAME => 2, PushDevicesPeer::APP_VERSION => 3, PushDevicesPeer::DEVICE_UID => 4, PushDevicesPeer::DEVICE_NAME => 5, PushDevicesPeer::DEVICE_MODEL => 6, PushDevicesPeer::DEVICE_VERSION => 7, PushDevicesPeer::DEVICE_TOKEN => 8, PushDevicesPeer::DEVELOPMENT => 9, PushDevicesPeer::STATUS => 10, PushDevicesPeer::CREATED_AT => 11, PushDevicesPeer::UPDATED_AT => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'client_id' => 1, 'app_name' => 2, 'app_version' => 3, 'device_uid' => 4, 'device_name' => 5, 'device_model' => 6, 'device_version' => 7, 'device_token' => 8, 'development' => 9, 'status' => 10, 'created_at' => 11, 'updated_at' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PushDevicesMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PushDevicesMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PushDevicesPeer::getTableMap();
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
		return str_replace(PushDevicesPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PushDevicesPeer::ID);

		$criteria->addSelectColumn(PushDevicesPeer::CLIENT_ID);

		$criteria->addSelectColumn(PushDevicesPeer::APP_NAME);

		$criteria->addSelectColumn(PushDevicesPeer::APP_VERSION);

		$criteria->addSelectColumn(PushDevicesPeer::DEVICE_UID);

		$criteria->addSelectColumn(PushDevicesPeer::DEVICE_NAME);

		$criteria->addSelectColumn(PushDevicesPeer::DEVICE_MODEL);

		$criteria->addSelectColumn(PushDevicesPeer::DEVICE_VERSION);

		$criteria->addSelectColumn(PushDevicesPeer::DEVICE_TOKEN);

		$criteria->addSelectColumn(PushDevicesPeer::DEVELOPMENT);

		$criteria->addSelectColumn(PushDevicesPeer::STATUS);

		$criteria->addSelectColumn(PushDevicesPeer::CREATED_AT);

		$criteria->addSelectColumn(PushDevicesPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(push_devices.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT push_devices.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PushDevicesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PushDevicesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PushDevicesPeer::doSelectRS($criteria, $con);
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
		$objects = PushDevicesPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PushDevicesPeer::populateObjects(PushDevicesPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PushDevicesPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PushDevicesPeer::getOMClass();
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
		return PushDevicesPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PushDevicesPeer::ID); 

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
			$comparison = $criteria->getComparison(PushDevicesPeer::ID);
			$selectCriteria->add(PushDevicesPeer::ID, $criteria->remove(PushDevicesPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PushDevicesPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PushDevicesPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PushDevices) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PushDevicesPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PushDevices $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PushDevicesPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PushDevicesPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PushDevicesPeer::DATABASE_NAME, PushDevicesPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PushDevicesPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PushDevicesPeer::DATABASE_NAME);

		$criteria->add(PushDevicesPeer::ID, $pk);


		$v = PushDevicesPeer::doSelect($criteria, $con);

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
			$criteria->add(PushDevicesPeer::ID, $pks, Criteria::IN);
			$objs = PushDevicesPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePushDevicesPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PushDevicesMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PushDevicesMapBuilder');
}
