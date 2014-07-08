<?php


abstract class BaseDepositNotificationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_notification';

	
	const CLASS_DEFAULT = 'lib.model.DepositNotification';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_notification.ID';

	
	const NOTIFICATION_TYPE = 'deposit_notification.NOTIFICATION_TYPE';

	
	const NOTIFICATION_TYPE_ACCOUNT = 'deposit_notification.NOTIFICATION_TYPE_ACCOUNT';

	
	const CONTENT = 'deposit_notification.CONTENT';

	
	const NOTIFICATION_STATUS = 'deposit_notification.NOTIFICATION_STATUS';

	
	const DELIVERED_TIME = 'deposit_notification.DELIVERED_TIME';

	
	const ERROR_MESSAGE = 'deposit_notification.ERROR_MESSAGE';

	
	const CREATED_AT = 'deposit_notification.CREATED_AT';

	
	const UPDATED_AT = 'deposit_notification.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'NotificationType', 'NotificationTypeAccount', 'Content', 'NotificationStatus', 'DeliveredTime', 'ErrorMessage', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositNotificationPeer::ID, DepositNotificationPeer::NOTIFICATION_TYPE, DepositNotificationPeer::NOTIFICATION_TYPE_ACCOUNT, DepositNotificationPeer::CONTENT, DepositNotificationPeer::NOTIFICATION_STATUS, DepositNotificationPeer::DELIVERED_TIME, DepositNotificationPeer::ERROR_MESSAGE, DepositNotificationPeer::CREATED_AT, DepositNotificationPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'notification_type', 'notification_type_account', 'content', 'notification_status', 'delivered_time', 'error_message', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'NotificationType' => 1, 'NotificationTypeAccount' => 2, 'Content' => 3, 'NotificationStatus' => 4, 'DeliveredTime' => 5, 'ErrorMessage' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (DepositNotificationPeer::ID => 0, DepositNotificationPeer::NOTIFICATION_TYPE => 1, DepositNotificationPeer::NOTIFICATION_TYPE_ACCOUNT => 2, DepositNotificationPeer::CONTENT => 3, DepositNotificationPeer::NOTIFICATION_STATUS => 4, DepositNotificationPeer::DELIVERED_TIME => 5, DepositNotificationPeer::ERROR_MESSAGE => 6, DepositNotificationPeer::CREATED_AT => 7, DepositNotificationPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'notification_type' => 1, 'notification_type_account' => 2, 'content' => 3, 'notification_status' => 4, 'delivered_time' => 5, 'error_message' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositNotificationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositNotificationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositNotificationPeer::getTableMap();
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
		return str_replace(DepositNotificationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositNotificationPeer::ID);

		$criteria->addSelectColumn(DepositNotificationPeer::NOTIFICATION_TYPE);

		$criteria->addSelectColumn(DepositNotificationPeer::NOTIFICATION_TYPE_ACCOUNT);

		$criteria->addSelectColumn(DepositNotificationPeer::CONTENT);

		$criteria->addSelectColumn(DepositNotificationPeer::NOTIFICATION_STATUS);

		$criteria->addSelectColumn(DepositNotificationPeer::DELIVERED_TIME);

		$criteria->addSelectColumn(DepositNotificationPeer::ERROR_MESSAGE);

		$criteria->addSelectColumn(DepositNotificationPeer::CREATED_AT);

		$criteria->addSelectColumn(DepositNotificationPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_notification.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_notification.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositNotificationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositNotificationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositNotificationPeer::doSelectRS($criteria, $con);
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
		$objects = DepositNotificationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositNotificationPeer::populateObjects(DepositNotificationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositNotificationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositNotificationPeer::getOMClass();
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
		return DepositNotificationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositNotificationPeer::ID); 

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
			$comparison = $criteria->getComparison(DepositNotificationPeer::ID);
			$selectCriteria->add(DepositNotificationPeer::ID, $criteria->remove(DepositNotificationPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DepositNotificationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DepositNotificationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositNotification) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DepositNotificationPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DepositNotification $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositNotificationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositNotificationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DepositNotificationPeer::DATABASE_NAME, DepositNotificationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositNotificationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DepositNotificationPeer::DATABASE_NAME);

		$criteria->add(DepositNotificationPeer::ID, $pk);


		$v = DepositNotificationPeer::doSelect($criteria, $con);

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
			$criteria->add(DepositNotificationPeer::ID, $pks, Criteria::IN);
			$objs = DepositNotificationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDepositNotificationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositNotificationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositNotificationMapBuilder');
}
