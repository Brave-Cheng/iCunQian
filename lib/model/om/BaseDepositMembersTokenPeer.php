<?php


abstract class BaseDepositMembersTokenPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_members_token';

	
	const CLASS_DEFAULT = 'lib.model.DepositMembersToken';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_members_token.ID';

	
	const DEPOSIT_MEMBERS_ID = 'deposit_members_token.DEPOSIT_MEMBERS_ID';

	
	const PUSH_DEVICES_ID = 'deposit_members_token.PUSH_DEVICES_ID';

	
	const IS_VALID = 'deposit_members_token.IS_VALID';

	
	const CREATED_AT = 'deposit_members_token.CREATED_AT';

	
	const UPDATED_AT = 'deposit_members_token.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DepositMembersId', 'PushDevicesId', 'IsValid', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositMembersTokenPeer::ID, DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, DepositMembersTokenPeer::PUSH_DEVICES_ID, DepositMembersTokenPeer::IS_VALID, DepositMembersTokenPeer::CREATED_AT, DepositMembersTokenPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'deposit_members_id', 'push_devices_id', 'is_valid', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DepositMembersId' => 1, 'PushDevicesId' => 2, 'IsValid' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (DepositMembersTokenPeer::ID => 0, DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID => 1, DepositMembersTokenPeer::PUSH_DEVICES_ID => 2, DepositMembersTokenPeer::IS_VALID => 3, DepositMembersTokenPeer::CREATED_AT => 4, DepositMembersTokenPeer::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'deposit_members_id' => 1, 'push_devices_id' => 2, 'is_valid' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositMembersTokenMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositMembersTokenMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositMembersTokenPeer::getTableMap();
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
		return str_replace(DepositMembersTokenPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositMembersTokenPeer::ID);

		$criteria->addSelectColumn(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID);

		$criteria->addSelectColumn(DepositMembersTokenPeer::PUSH_DEVICES_ID);

		$criteria->addSelectColumn(DepositMembersTokenPeer::IS_VALID);

		$criteria->addSelectColumn(DepositMembersTokenPeer::CREATED_AT);

		$criteria->addSelectColumn(DepositMembersTokenPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_members_token.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_members_token.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositMembersTokenPeer::doSelectRS($criteria, $con);
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
		$objects = DepositMembersTokenPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositMembersTokenPeer::populateObjects(DepositMembersTokenPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositMembersTokenPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositMembersTokenPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDepositMembers(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositMembersTokenPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinPushDevices(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersTokenPeer::PUSH_DEVICES_ID, PushDevicesPeer::ID);

		$rs = DepositMembersTokenPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDepositMembers(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositMembersTokenPeer::addSelectColumns($c);
		$startcol = (DepositMembersTokenPeer::NUM_COLUMNS - DepositMembersTokenPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositMembersPeer::addSelectColumns($c);

		$c->addJoin(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersTokenPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositMembersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDepositMembers(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDepositMembersToken($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositMembersTokens();
				$obj2->addDepositMembersToken($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinPushDevices(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositMembersTokenPeer::addSelectColumns($c);
		$startcol = (DepositMembersTokenPeer::NUM_COLUMNS - DepositMembersTokenPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PushDevicesPeer::addSelectColumns($c);

		$c->addJoin(DepositMembersTokenPeer::PUSH_DEVICES_ID, PushDevicesPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersTokenPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PushDevicesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPushDevices(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDepositMembersToken($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositMembersTokens();
				$obj2->addDepositMembersToken($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$criteria->addJoin(DepositMembersTokenPeer::PUSH_DEVICES_ID, PushDevicesPeer::ID);

		$rs = DepositMembersTokenPeer::doSelectRS($criteria, $con);
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

		DepositMembersTokenPeer::addSelectColumns($c);
		$startcol2 = (DepositMembersTokenPeer::NUM_COLUMNS - DepositMembersTokenPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositMembersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositMembersPeer::NUM_COLUMNS;

		PushDevicesPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PushDevicesPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$c->addJoin(DepositMembersTokenPeer::PUSH_DEVICES_ID, PushDevicesPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersTokenPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DepositMembersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositMembers(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositMembersToken($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersTokens();
				$obj2->addDepositMembersToken($obj1);
			}


					
			$omClass = PushDevicesPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPushDevices(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDepositMembersToken($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initDepositMembersTokens();
				$obj3->addDepositMembersToken($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptDepositMembers(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersTokenPeer::PUSH_DEVICES_ID, PushDevicesPeer::ID);

		$rs = DepositMembersTokenPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptPushDevices(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersTokenPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositMembersTokenPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptDepositMembers(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositMembersTokenPeer::addSelectColumns($c);
		$startcol2 = (DepositMembersTokenPeer::NUM_COLUMNS - DepositMembersTokenPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PushDevicesPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PushDevicesPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersTokenPeer::PUSH_DEVICES_ID, PushDevicesPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersTokenPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PushDevicesPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPushDevices(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositMembersToken($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersTokens();
				$obj2->addDepositMembersToken($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptPushDevices(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositMembersTokenPeer::addSelectColumns($c);
		$startcol2 = (DepositMembersTokenPeer::NUM_COLUMNS - DepositMembersTokenPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositMembersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositMembersPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersTokenPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositMembersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositMembers(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositMembersToken($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersTokens();
				$obj2->addDepositMembersToken($obj1);
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
		return DepositMembersTokenPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositMembersTokenPeer::ID); 

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
			$comparison = $criteria->getComparison(DepositMembersTokenPeer::ID);
			$selectCriteria->add(DepositMembersTokenPeer::ID, $criteria->remove(DepositMembersTokenPeer::ID), $comparison);

			$comparison = $criteria->getComparison(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID);
			$selectCriteria->add(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, $criteria->remove(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID), $comparison);

			$comparison = $criteria->getComparison(DepositMembersTokenPeer::PUSH_DEVICES_ID);
			$selectCriteria->add(DepositMembersTokenPeer::PUSH_DEVICES_ID, $criteria->remove(DepositMembersTokenPeer::PUSH_DEVICES_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DepositMembersTokenPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DepositMembersTokenPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositMembersToken) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
				$vals[2][] = $value[2];
			}

			$criteria->add(DepositMembersTokenPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, $vals[1], Criteria::IN);
			$criteria->add(DepositMembersTokenPeer::PUSH_DEVICES_ID, $vals[2], Criteria::IN);
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

	
	public static function doValidate(DepositMembersToken $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositMembersTokenPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositMembersTokenPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DepositMembersTokenPeer::DATABASE_NAME, DepositMembersTokenPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositMembersTokenPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $deposit_members_id, $push_devices_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(DepositMembersTokenPeer::ID, $id);
		$criteria->add(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, $deposit_members_id);
		$criteria->add(DepositMembersTokenPeer::PUSH_DEVICES_ID, $push_devices_id);
		$v = DepositMembersTokenPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseDepositMembersTokenPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositMembersTokenMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositMembersTokenMapBuilder');
}
