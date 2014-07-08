<?php


abstract class BaseDepositPersonalProductsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_personal_products';

	
	const CLASS_DEFAULT = 'lib.model.DepositPersonalProducts';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_personal_products.ID';

	
	const DEPOSIT_FINANCIAL_PRODUCTS_ID = 'deposit_personal_products.DEPOSIT_FINANCIAL_PRODUCTS_ID';

	
	const DEPOSIT_MEMBERS_ID = 'deposit_personal_products.DEPOSIT_MEMBERS_ID';

	
	const EXPECTED_RATE = 'deposit_personal_products.EXPECTED_RATE';

	
	const AMOUNT = 'deposit_personal_products.AMOUNT';

	
	const BUY_DATE = 'deposit_personal_products.BUY_DATE';

	
	const EXPIRY_DATE = 'deposit_personal_products.EXPIRY_DATE';

	
	const IS_VALID = 'deposit_personal_products.IS_VALID';

	
	const CREATED_AT = 'deposit_personal_products.CREATED_AT';

	
	const UPDATED_AT = 'deposit_personal_products.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DepositFinancialProductsId', 'DepositMembersId', 'ExpectedRate', 'Amount', 'BuyDate', 'ExpiryDate', 'IsValid', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositPersonalProductsPeer::ID, DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, DepositPersonalProductsPeer::EXPECTED_RATE, DepositPersonalProductsPeer::AMOUNT, DepositPersonalProductsPeer::BUY_DATE, DepositPersonalProductsPeer::EXPIRY_DATE, DepositPersonalProductsPeer::IS_VALID, DepositPersonalProductsPeer::CREATED_AT, DepositPersonalProductsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'deposit_financial_products_id', 'deposit_members_id', 'expected_rate', 'amount', 'buy_date', 'expiry_date', 'is_valid', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DepositFinancialProductsId' => 1, 'DepositMembersId' => 2, 'ExpectedRate' => 3, 'Amount' => 4, 'BuyDate' => 5, 'ExpiryDate' => 6, 'IsValid' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (DepositPersonalProductsPeer::ID => 0, DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID => 1, DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID => 2, DepositPersonalProductsPeer::EXPECTED_RATE => 3, DepositPersonalProductsPeer::AMOUNT => 4, DepositPersonalProductsPeer::BUY_DATE => 5, DepositPersonalProductsPeer::EXPIRY_DATE => 6, DepositPersonalProductsPeer::IS_VALID => 7, DepositPersonalProductsPeer::CREATED_AT => 8, DepositPersonalProductsPeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'deposit_financial_products_id' => 1, 'deposit_members_id' => 2, 'expected_rate' => 3, 'amount' => 4, 'buy_date' => 5, 'expiry_date' => 6, 'is_valid' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositPersonalProductsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositPersonalProductsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositPersonalProductsPeer::getTableMap();
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
		return str_replace(DepositPersonalProductsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositPersonalProductsPeer::ID);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::EXPECTED_RATE);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::AMOUNT);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::BUY_DATE);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::EXPIRY_DATE);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::IS_VALID);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::CREATED_AT);

		$criteria->addSelectColumn(DepositPersonalProductsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_personal_products.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_personal_products.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositPersonalProductsPeer::doSelectRS($criteria, $con);
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
		$objects = DepositPersonalProductsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositPersonalProductsPeer::populateObjects(DepositPersonalProductsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositPersonalProductsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositPersonalProductsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDepositFinancialProducts(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);

		$rs = DepositPersonalProductsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinDepositMembers(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositPersonalProductsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDepositFinancialProducts(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositPersonalProductsPeer::addSelectColumns($c);
		$startcol = (DepositPersonalProductsPeer::NUM_COLUMNS - DepositPersonalProductsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositFinancialProductsPeer::addSelectColumns($c);

		$c->addJoin(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositPersonalProductsPeer::getOMClass();

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
										$temp_obj2->addDepositPersonalProducts($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositPersonalProductss();
				$obj2->addDepositPersonalProducts($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinDepositMembers(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositPersonalProductsPeer::addSelectColumns($c);
		$startcol = (DepositPersonalProductsPeer::NUM_COLUMNS - DepositPersonalProductsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositMembersPeer::addSelectColumns($c);

		$c->addJoin(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositPersonalProductsPeer::getOMClass();

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
										$temp_obj2->addDepositPersonalProducts($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositPersonalProductss();
				$obj2->addDepositPersonalProducts($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);

		$criteria->addJoin(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositPersonalProductsPeer::doSelectRS($criteria, $con);
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

		DepositPersonalProductsPeer::addSelectColumns($c);
		$startcol2 = (DepositPersonalProductsPeer::NUM_COLUMNS - DepositPersonalProductsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositFinancialProductsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositFinancialProductsPeer::NUM_COLUMNS;

		DepositMembersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DepositMembersPeer::NUM_COLUMNS;

		$c->addJoin(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);

		$c->addJoin(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositPersonalProductsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DepositFinancialProductsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositFinancialProducts(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositPersonalProducts($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositPersonalProductss();
				$obj2->addDepositPersonalProducts($obj1);
			}


					
			$omClass = DepositMembersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDepositMembers(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDepositPersonalProducts($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initDepositPersonalProductss();
				$obj3->addDepositPersonalProducts($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptDepositFinancialProducts(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositPersonalProductsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDepositMembers(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositPersonalProductsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);

		$rs = DepositPersonalProductsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptDepositFinancialProducts(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositPersonalProductsPeer::addSelectColumns($c);
		$startcol2 = (DepositPersonalProductsPeer::NUM_COLUMNS - DepositPersonalProductsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositMembersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositMembersPeer::NUM_COLUMNS;

		$c->addJoin(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositPersonalProductsPeer::getOMClass();

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
					$temp_obj2->addDepositPersonalProducts($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositPersonalProductss();
				$obj2->addDepositPersonalProducts($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptDepositMembers(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositPersonalProductsPeer::addSelectColumns($c);
		$startcol2 = (DepositPersonalProductsPeer::NUM_COLUMNS - DepositPersonalProductsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositFinancialProductsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositFinancialProductsPeer::NUM_COLUMNS;

		$c->addJoin(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, DepositFinancialProductsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositPersonalProductsPeer::getOMClass();

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
					$temp_obj2->addDepositPersonalProducts($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositPersonalProductss();
				$obj2->addDepositPersonalProducts($obj1);
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
		return DepositPersonalProductsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositPersonalProductsPeer::ID); 

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
			$comparison = $criteria->getComparison(DepositPersonalProductsPeer::ID);
			$selectCriteria->add(DepositPersonalProductsPeer::ID, $criteria->remove(DepositPersonalProductsPeer::ID), $comparison);

			$comparison = $criteria->getComparison(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);
			$selectCriteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $criteria->remove(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID), $comparison);

			$comparison = $criteria->getComparison(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID);
			$selectCriteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $criteria->remove(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DepositPersonalProductsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DepositPersonalProductsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositPersonalProducts) {

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

			$criteria->add(DepositPersonalProductsPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $vals[1], Criteria::IN);
			$criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $vals[2], Criteria::IN);
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

	
	public static function doValidate(DepositPersonalProducts $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositPersonalProductsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositPersonalProductsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DepositPersonalProductsPeer::DATABASE_NAME, DepositPersonalProductsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositPersonalProductsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $deposit_financial_products_id, $deposit_members_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(DepositPersonalProductsPeer::ID, $id);
		$criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $deposit_financial_products_id);
		$criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $deposit_members_id);
		$v = DepositPersonalProductsPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseDepositPersonalProductsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositPersonalProductsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositPersonalProductsMapBuilder');
}
