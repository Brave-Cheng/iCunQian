<?php


abstract class BaseDepositMembersSubscribePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_members_subscribe';

	
	const CLASS_DEFAULT = 'lib.model.DepositMembersSubscribe';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_members_subscribe.ID';

	
	const DEPOSIT_MEMBERS_ID = 'deposit_members_subscribe.DEPOSIT_MEMBERS_ID';

	
	const DEPOSIT_BANK_ID = 'deposit_members_subscribe.DEPOSIT_BANK_ID';

	
	const CITY = 'deposit_members_subscribe.CITY';

	
	const PROFIT_TYPE = 'deposit_members_subscribe.PROFIT_TYPE';

	
	const EXPECTED_RATE = 'deposit_members_subscribe.EXPECTED_RATE';

	
	const INVEST_CYCLE = 'deposit_members_subscribe.INVEST_CYCLE';

	
	const IS_VALID = 'deposit_members_subscribe.IS_VALID';

	
	const CREATED_AT = 'deposit_members_subscribe.CREATED_AT';

	
	const UPDATED_AT = 'deposit_members_subscribe.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DepositMembersId', 'DepositBankId', 'City', 'ProfitType', 'ExpectedRate', 'InvestCycle', 'IsValid', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositMembersSubscribePeer::ID, DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, DepositMembersSubscribePeer::DEPOSIT_BANK_ID, DepositMembersSubscribePeer::CITY, DepositMembersSubscribePeer::PROFIT_TYPE, DepositMembersSubscribePeer::EXPECTED_RATE, DepositMembersSubscribePeer::INVEST_CYCLE, DepositMembersSubscribePeer::IS_VALID, DepositMembersSubscribePeer::CREATED_AT, DepositMembersSubscribePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'deposit_members_id', 'deposit_bank_id', 'city', 'profit_type', 'expected_rate', 'invest_cycle', 'is_valid', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DepositMembersId' => 1, 'DepositBankId' => 2, 'City' => 3, 'ProfitType' => 4, 'ExpectedRate' => 5, 'InvestCycle' => 6, 'IsValid' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (DepositMembersSubscribePeer::ID => 0, DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID => 1, DepositMembersSubscribePeer::DEPOSIT_BANK_ID => 2, DepositMembersSubscribePeer::CITY => 3, DepositMembersSubscribePeer::PROFIT_TYPE => 4, DepositMembersSubscribePeer::EXPECTED_RATE => 5, DepositMembersSubscribePeer::INVEST_CYCLE => 6, DepositMembersSubscribePeer::IS_VALID => 7, DepositMembersSubscribePeer::CREATED_AT => 8, DepositMembersSubscribePeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'deposit_members_id' => 1, 'deposit_bank_id' => 2, 'city' => 3, 'profit_type' => 4, 'expected_rate' => 5, 'invest_cycle' => 6, 'is_valid' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositMembersSubscribeMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositMembersSubscribeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositMembersSubscribePeer::getTableMap();
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
		return str_replace(DepositMembersSubscribePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositMembersSubscribePeer::ID);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::DEPOSIT_BANK_ID);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::CITY);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::PROFIT_TYPE);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::EXPECTED_RATE);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::INVEST_CYCLE);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::IS_VALID);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::CREATED_AT);

		$criteria->addSelectColumn(DepositMembersSubscribePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_members_subscribe.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_members_subscribe.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositMembersSubscribePeer::doSelectRS($criteria, $con);
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
		$objects = DepositMembersSubscribePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositMembersSubscribePeer::populateObjects(DepositMembersSubscribePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositMembersSubscribePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositMembersSubscribePeer::getOMClass();
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
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositMembersSubscribePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinDepositBank(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, DepositBankPeer::ID);

		$rs = DepositMembersSubscribePeer::doSelectRS($criteria, $con);
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

		DepositMembersSubscribePeer::addSelectColumns($c);
		$startcol = (DepositMembersSubscribePeer::NUM_COLUMNS - DepositMembersSubscribePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositMembersPeer::addSelectColumns($c);

		$c->addJoin(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersSubscribePeer::getOMClass();

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
										$temp_obj2->addDepositMembersSubscribe($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositMembersSubscribes();
				$obj2->addDepositMembersSubscribe($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinDepositBank(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositMembersSubscribePeer::addSelectColumns($c);
		$startcol = (DepositMembersSubscribePeer::NUM_COLUMNS - DepositMembersSubscribePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositBankPeer::addSelectColumns($c);

		$c->addJoin(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, DepositBankPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersSubscribePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositBankPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDepositBank(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDepositMembersSubscribe($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositMembersSubscribes();
				$obj2->addDepositMembersSubscribe($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$criteria->addJoin(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, DepositBankPeer::ID);

		$rs = DepositMembersSubscribePeer::doSelectRS($criteria, $con);
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

		DepositMembersSubscribePeer::addSelectColumns($c);
		$startcol2 = (DepositMembersSubscribePeer::NUM_COLUMNS - DepositMembersSubscribePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositMembersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositMembersPeer::NUM_COLUMNS;

		DepositBankPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DepositBankPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$c->addJoin(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, DepositBankPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersSubscribePeer::getOMClass();


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
					$temp_obj2->addDepositMembersSubscribe($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersSubscribes();
				$obj2->addDepositMembersSubscribe($obj1);
			}


					
			$omClass = DepositBankPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDepositBank(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDepositMembersSubscribe($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initDepositMembersSubscribes();
				$obj3->addDepositMembersSubscribe($obj1);
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
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, DepositBankPeer::ID);

		$rs = DepositMembersSubscribePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDepositBank(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersSubscribePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositMembersSubscribePeer::doSelectRS($criteria, $con);
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

		DepositMembersSubscribePeer::addSelectColumns($c);
		$startcol2 = (DepositMembersSubscribePeer::NUM_COLUMNS - DepositMembersSubscribePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositBankPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositBankPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, DepositBankPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersSubscribePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositBankPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositBank(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositMembersSubscribe($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersSubscribes();
				$obj2->addDepositMembersSubscribe($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptDepositBank(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositMembersSubscribePeer::addSelectColumns($c);
		$startcol2 = (DepositMembersSubscribePeer::NUM_COLUMNS - DepositMembersSubscribePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositMembersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositMembersPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersSubscribePeer::getOMClass();

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
					$temp_obj2->addDepositMembersSubscribe($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersSubscribes();
				$obj2->addDepositMembersSubscribe($obj1);
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
		return DepositMembersSubscribePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositMembersSubscribePeer::ID); 

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
			$comparison = $criteria->getComparison(DepositMembersSubscribePeer::ID);
			$selectCriteria->add(DepositMembersSubscribePeer::ID, $criteria->remove(DepositMembersSubscribePeer::ID), $comparison);

			$comparison = $criteria->getComparison(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID);
			$selectCriteria->add(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, $criteria->remove(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID), $comparison);

			$comparison = $criteria->getComparison(DepositMembersSubscribePeer::DEPOSIT_BANK_ID);
			$selectCriteria->add(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, $criteria->remove(DepositMembersSubscribePeer::DEPOSIT_BANK_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DepositMembersSubscribePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DepositMembersSubscribePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositMembersSubscribe) {

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

			$criteria->add(DepositMembersSubscribePeer::ID, $vals[0], Criteria::IN);
			$criteria->add(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, $vals[1], Criteria::IN);
			$criteria->add(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, $vals[2], Criteria::IN);
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

	
	public static function doValidate(DepositMembersSubscribe $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositMembersSubscribePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositMembersSubscribePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DepositMembersSubscribePeer::DATABASE_NAME, DepositMembersSubscribePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositMembersSubscribePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $deposit_members_id, $deposit_bank_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(DepositMembersSubscribePeer::ID, $id);
		$criteria->add(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, $deposit_members_id);
		$criteria->add(DepositMembersSubscribePeer::DEPOSIT_BANK_ID, $deposit_bank_id);
		$v = DepositMembersSubscribePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseDepositMembersSubscribePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositMembersSubscribeMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositMembersSubscribeMapBuilder');
}
