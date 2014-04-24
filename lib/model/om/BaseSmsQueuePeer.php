<?php


abstract class BaseSmsQueuePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sms_queue';

	
	const CLASS_DEFAULT = 'lib.model.SmsQueue';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sms_queue.ID';

	
	const NOTIFICATION_ID = 'sms_queue.NOTIFICATION_ID';

	
	const RECEIVER = 'sms_queue.RECEIVER';

	
	const UNIQUE_KEY = 'sms_queue.UNIQUE_KEY';

	
	const MESSAGE_CONTENT = 'sms_queue.MESSAGE_CONTENT';

	
	const ADDITIONAL_INFORMATION = 'sms_queue.ADDITIONAL_INFORMATION';

	
	const SEND_TIMES = 'sms_queue.SEND_TIMES';

	
	const LAST_SEND_AT = 'sms_queue.LAST_SEND_AT';

	
	const CREATED_AT = 'sms_queue.CREATED_AT';

	
	const UPDATED_AT = 'sms_queue.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'NotificationId', 'Receiver', 'UniqueKey', 'MessageContent', 'AdditionalInformation', 'SendTimes', 'LastSendAt', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (SmsQueuePeer::ID, SmsQueuePeer::NOTIFICATION_ID, SmsQueuePeer::RECEIVER, SmsQueuePeer::UNIQUE_KEY, SmsQueuePeer::MESSAGE_CONTENT, SmsQueuePeer::ADDITIONAL_INFORMATION, SmsQueuePeer::SEND_TIMES, SmsQueuePeer::LAST_SEND_AT, SmsQueuePeer::CREATED_AT, SmsQueuePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'notification_id', 'receiver', 'unique_key', 'message_content', 'additional_information', 'send_times', 'last_send_at', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'NotificationId' => 1, 'Receiver' => 2, 'UniqueKey' => 3, 'MessageContent' => 4, 'AdditionalInformation' => 5, 'SendTimes' => 6, 'LastSendAt' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (SmsQueuePeer::ID => 0, SmsQueuePeer::NOTIFICATION_ID => 1, SmsQueuePeer::RECEIVER => 2, SmsQueuePeer::UNIQUE_KEY => 3, SmsQueuePeer::MESSAGE_CONTENT => 4, SmsQueuePeer::ADDITIONAL_INFORMATION => 5, SmsQueuePeer::SEND_TIMES => 6, SmsQueuePeer::LAST_SEND_AT => 7, SmsQueuePeer::CREATED_AT => 8, SmsQueuePeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'notification_id' => 1, 'receiver' => 2, 'unique_key' => 3, 'message_content' => 4, 'additional_information' => 5, 'send_times' => 6, 'last_send_at' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SmsQueueMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SmsQueueMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SmsQueuePeer::getTableMap();
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
		return str_replace(SmsQueuePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SmsQueuePeer::ID);

		$criteria->addSelectColumn(SmsQueuePeer::NOTIFICATION_ID);

		$criteria->addSelectColumn(SmsQueuePeer::RECEIVER);

		$criteria->addSelectColumn(SmsQueuePeer::UNIQUE_KEY);

		$criteria->addSelectColumn(SmsQueuePeer::MESSAGE_CONTENT);

		$criteria->addSelectColumn(SmsQueuePeer::ADDITIONAL_INFORMATION);

		$criteria->addSelectColumn(SmsQueuePeer::SEND_TIMES);

		$criteria->addSelectColumn(SmsQueuePeer::LAST_SEND_AT);

		$criteria->addSelectColumn(SmsQueuePeer::CREATED_AT);

		$criteria->addSelectColumn(SmsQueuePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(sms_queue.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sms_queue.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsQueuePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsQueuePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SmsQueuePeer::doSelectRS($criteria, $con);
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
		$objects = SmsQueuePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SmsQueuePeer::populateObjects(SmsQueuePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SmsQueuePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SmsQueuePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinNotification(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsQueuePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsQueuePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsQueuePeer::NOTIFICATION_ID, NotificationPeer::ID);

		$rs = SmsQueuePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinNotification(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SmsQueuePeer::addSelectColumns($c);
		$startcol = (SmsQueuePeer::NUM_COLUMNS - SmsQueuePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		NotificationPeer::addSelectColumns($c);

		$c->addJoin(SmsQueuePeer::NOTIFICATION_ID, NotificationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsQueuePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = NotificationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getNotification(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSmsQueue($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSmsQueues();
				$obj2->addSmsQueue($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsQueuePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsQueuePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsQueuePeer::NOTIFICATION_ID, NotificationPeer::ID);

		$rs = SmsQueuePeer::doSelectRS($criteria, $con);
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

		SmsQueuePeer::addSelectColumns($c);
		$startcol2 = (SmsQueuePeer::NUM_COLUMNS - SmsQueuePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		NotificationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + NotificationPeer::NUM_COLUMNS;

		$c->addJoin(SmsQueuePeer::NOTIFICATION_ID, NotificationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsQueuePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = NotificationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getNotification(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSmsQueue($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSmsQueues();
				$obj2->addSmsQueue($obj1);
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
		return SmsQueuePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SmsQueuePeer::ID); 

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
			$comparison = $criteria->getComparison(SmsQueuePeer::ID);
			$selectCriteria->add(SmsQueuePeer::ID, $criteria->remove(SmsQueuePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SmsQueuePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SmsQueuePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SmsQueue) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SmsQueuePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SmsQueue $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SmsQueuePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SmsQueuePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SmsQueuePeer::DATABASE_NAME, SmsQueuePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SmsQueuePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SmsQueuePeer::DATABASE_NAME);

		$criteria->add(SmsQueuePeer::ID, $pk);


		$v = SmsQueuePeer::doSelect($criteria, $con);

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
			$criteria->add(SmsQueuePeer::ID, $pks, Criteria::IN);
			$objs = SmsQueuePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSmsQueuePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SmsQueueMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SmsQueueMapBuilder');
}
