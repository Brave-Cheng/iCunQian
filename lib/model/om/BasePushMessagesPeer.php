<?php


abstract class BasePushMessagesPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'push_messages';

	
	const CLASS_DEFAULT = 'lib.model.PushMessages';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'push_messages.ID';

	
	const DEPOSIT_MEMBERS_ID = 'push_messages.DEPOSIT_MEMBERS_ID';

	
	const DEPOSIT_FINANCIAL_PRODUCTS_ID = 'push_messages.DEPOSIT_FINANCIAL_PRODUCTS_ID';

	
	const MESSAGE = 'push_messages.MESSAGE';

	
	const DELIVERY = 'push_messages.DELIVERY';

	
	const STATUS = 'push_messages.STATUS';

	
	const ERROR_MESSAGE = 'push_messages.ERROR_MESSAGE';

	
	const CREATED_AT = 'push_messages.CREATED_AT';

	
	const UPDATED_AT = 'push_messages.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DepositMembersId', 'DepositFinancialProductsId', 'Message', 'Delivery', 'Status', 'ErrorMessage', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (PushMessagesPeer::ID, PushMessagesPeer::DEPOSIT_MEMBERS_ID, PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, PushMessagesPeer::MESSAGE, PushMessagesPeer::DELIVERY, PushMessagesPeer::STATUS, PushMessagesPeer::ERROR_MESSAGE, PushMessagesPeer::CREATED_AT, PushMessagesPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'deposit_members_id', 'deposit_financial_products_id', 'message', 'delivery', 'status', 'error_message', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DepositMembersId' => 1, 'DepositFinancialProductsId' => 2, 'Message' => 3, 'Delivery' => 4, 'Status' => 5, 'ErrorMessage' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (PushMessagesPeer::ID => 0, PushMessagesPeer::DEPOSIT_MEMBERS_ID => 1, PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID => 2, PushMessagesPeer::MESSAGE => 3, PushMessagesPeer::DELIVERY => 4, PushMessagesPeer::STATUS => 5, PushMessagesPeer::ERROR_MESSAGE => 6, PushMessagesPeer::CREATED_AT => 7, PushMessagesPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'deposit_members_id' => 1, 'deposit_financial_products_id' => 2, 'message' => 3, 'delivery' => 4, 'status' => 5, 'error_message' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PushMessagesMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PushMessagesMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PushMessagesPeer::getTableMap();
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
		return str_replace(PushMessagesPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PushMessagesPeer::ID);

		$criteria->addSelectColumn(PushMessagesPeer::DEPOSIT_MEMBERS_ID);

		$criteria->addSelectColumn(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);

		$criteria->addSelectColumn(PushMessagesPeer::MESSAGE);

		$criteria->addSelectColumn(PushMessagesPeer::DELIVERY);

		$criteria->addSelectColumn(PushMessagesPeer::STATUS);

		$criteria->addSelectColumn(PushMessagesPeer::ERROR_MESSAGE);

		$criteria->addSelectColumn(PushMessagesPeer::CREATED_AT);

		$criteria->addSelectColumn(PushMessagesPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(push_messages.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT push_messages.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PushMessagesPeer::doSelectRS($criteria, $con);
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
		$objects = PushMessagesPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PushMessagesPeer::populateObjects(PushMessagesPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PushMessagesPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PushMessagesPeer::getOMClass();
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
			$criteria->addSelectColumn(PushMessagesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PushMessagesPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = PushMessagesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinDepositFinancialProducts(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);

		$rs = PushMessagesPeer::doSelectRS($criteria, $con);
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

		PushMessagesPeer::addSelectColumns($c);
		$startcol = (PushMessagesPeer::NUM_COLUMNS - PushMessagesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositMembersPeer::addSelectColumns($c);

		$c->addJoin(PushMessagesPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PushMessagesPeer::getOMClass();

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
										$temp_obj2->addPushMessages($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPushMessagess();
				$obj2->addPushMessages($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinDepositFinancialProducts(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PushMessagesPeer::addSelectColumns($c);
		$startcol = (PushMessagesPeer::NUM_COLUMNS - PushMessagesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositFinancialProductsPeer::addSelectColumns($c);

		$c->addJoin(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PushMessagesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositFinancialProductsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDepositFinancialProducts(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPushMessages($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPushMessagess();
				$obj2->addPushMessages($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PushMessagesPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$criteria->addJoin(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);

		$rs = PushMessagesPeer::doSelectRS($criteria, $con);
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

		PushMessagesPeer::addSelectColumns($c);
		$startcol2 = (PushMessagesPeer::NUM_COLUMNS - PushMessagesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositMembersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositMembersPeer::NUM_COLUMNS;

		DepositFinancialProductsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DepositFinancialProductsPeer::NUM_COLUMNS;

		$c->addJoin(PushMessagesPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$c->addJoin(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PushMessagesPeer::getOMClass();


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
					$temp_obj2->addPushMessages($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPushMessagess();
				$obj2->addPushMessages($obj1);
			}


					
			$omClass = DepositFinancialProductsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDepositFinancialProducts(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPushMessages($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPushMessagess();
				$obj3->addPushMessages($obj1);
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
			$criteria->addSelectColumn(PushMessagesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);

		$rs = PushMessagesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDepositFinancialProducts(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PushMessagesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PushMessagesPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = PushMessagesPeer::doSelectRS($criteria, $con);
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

		PushMessagesPeer::addSelectColumns($c);
		$startcol2 = (PushMessagesPeer::NUM_COLUMNS - PushMessagesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositFinancialProductsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositFinancialProductsPeer::NUM_COLUMNS;

		$c->addJoin(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PushMessagesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositFinancialProductsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositFinancialProducts(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPushMessages($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPushMessagess();
				$obj2->addPushMessages($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptDepositFinancialProducts(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PushMessagesPeer::addSelectColumns($c);
		$startcol2 = (PushMessagesPeer::NUM_COLUMNS - PushMessagesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositMembersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositMembersPeer::NUM_COLUMNS;

		$c->addJoin(PushMessagesPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PushMessagesPeer::getOMClass();

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
					$temp_obj2->addPushMessages($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPushMessagess();
				$obj2->addPushMessages($obj1);
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
		return PushMessagesPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PushMessagesPeer::ID); 

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
			$comparison = $criteria->getComparison(PushMessagesPeer::ID);
			$selectCriteria->add(PushMessagesPeer::ID, $criteria->remove(PushMessagesPeer::ID), $comparison);

			$comparison = $criteria->getComparison(PushMessagesPeer::DEPOSIT_MEMBERS_ID);
			$selectCriteria->add(PushMessagesPeer::DEPOSIT_MEMBERS_ID, $criteria->remove(PushMessagesPeer::DEPOSIT_MEMBERS_ID), $comparison);

			$comparison = $criteria->getComparison(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);
			$selectCriteria->add(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $criteria->remove(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PushMessagesPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PushMessagesPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PushMessages) {

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

			$criteria->add(PushMessagesPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(PushMessagesPeer::DEPOSIT_MEMBERS_ID, $vals[1], Criteria::IN);
			$criteria->add(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $vals[2], Criteria::IN);
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

	
	public static function doValidate(PushMessages $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PushMessagesPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PushMessagesPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PushMessagesPeer::DATABASE_NAME, PushMessagesPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PushMessagesPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $deposit_members_id, $deposit_financial_products_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(PushMessagesPeer::ID, $id);
		$criteria->add(PushMessagesPeer::DEPOSIT_MEMBERS_ID, $deposit_members_id);
		$criteria->add(PushMessagesPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $deposit_financial_products_id);
		$v = PushMessagesPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BasePushMessagesPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PushMessagesMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PushMessagesMapBuilder');
}
