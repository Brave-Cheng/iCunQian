<?php


abstract class BaseDepositMembersStationNewsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_members_station_news';

	
	const CLASS_DEFAULT = 'lib.model.DepositMembersStationNews';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_members_station_news.ID';

	
	const DEPOSIT_STATION_NEWS_ID = 'deposit_members_station_news.DEPOSIT_STATION_NEWS_ID';

	
	const DEPOSIT_MEMBERS_ID = 'deposit_members_station_news.DEPOSIT_MEMBERS_ID';

	
	const STATUS = 'deposit_members_station_news.STATUS';

	
	const CREATED_AT = 'deposit_members_station_news.CREATED_AT';

	
	const UPDATED_AT = 'deposit_members_station_news.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DepositStationNewsId', 'DepositMembersId', 'Status', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositMembersStationNewsPeer::ID, DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, DepositMembersStationNewsPeer::STATUS, DepositMembersStationNewsPeer::CREATED_AT, DepositMembersStationNewsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'deposit_station_news_id', 'deposit_members_id', 'status', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DepositStationNewsId' => 1, 'DepositMembersId' => 2, 'Status' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (DepositMembersStationNewsPeer::ID => 0, DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID => 1, DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID => 2, DepositMembersStationNewsPeer::STATUS => 3, DepositMembersStationNewsPeer::CREATED_AT => 4, DepositMembersStationNewsPeer::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'deposit_station_news_id' => 1, 'deposit_members_id' => 2, 'status' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositMembersStationNewsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositMembersStationNewsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositMembersStationNewsPeer::getTableMap();
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
		return str_replace(DepositMembersStationNewsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositMembersStationNewsPeer::ID);

		$criteria->addSelectColumn(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID);

		$criteria->addSelectColumn(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID);

		$criteria->addSelectColumn(DepositMembersStationNewsPeer::STATUS);

		$criteria->addSelectColumn(DepositMembersStationNewsPeer::CREATED_AT);

		$criteria->addSelectColumn(DepositMembersStationNewsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_members_station_news.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_members_station_news.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositMembersStationNewsPeer::doSelectRS($criteria, $con);
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
		$objects = DepositMembersStationNewsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositMembersStationNewsPeer::populateObjects(DepositMembersStationNewsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositMembersStationNewsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositMembersStationNewsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDepositStationNews(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, DepositStationNewsPeer::ID);

		$rs = DepositMembersStationNewsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositMembersStationNewsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDepositStationNews(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositMembersStationNewsPeer::addSelectColumns($c);
		$startcol = (DepositMembersStationNewsPeer::NUM_COLUMNS - DepositMembersStationNewsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositStationNewsPeer::addSelectColumns($c);

		$c->addJoin(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, DepositStationNewsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersStationNewsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositStationNewsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDepositStationNews(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDepositMembersStationNews($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositMembersStationNewss();
				$obj2->addDepositMembersStationNews($obj1); 			}
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

		DepositMembersStationNewsPeer::addSelectColumns($c);
		$startcol = (DepositMembersStationNewsPeer::NUM_COLUMNS - DepositMembersStationNewsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepositMembersPeer::addSelectColumns($c);

		$c->addJoin(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersStationNewsPeer::getOMClass();

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
										$temp_obj2->addDepositMembersStationNews($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDepositMembersStationNewss();
				$obj2->addDepositMembersStationNews($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, DepositStationNewsPeer::ID);

		$criteria->addJoin(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositMembersStationNewsPeer::doSelectRS($criteria, $con);
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

		DepositMembersStationNewsPeer::addSelectColumns($c);
		$startcol2 = (DepositMembersStationNewsPeer::NUM_COLUMNS - DepositMembersStationNewsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositStationNewsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositStationNewsPeer::NUM_COLUMNS;

		DepositMembersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DepositMembersPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, DepositStationNewsPeer::ID);

		$c->addJoin(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersStationNewsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DepositStationNewsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositStationNews(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositMembersStationNews($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersStationNewss();
				$obj2->addDepositMembersStationNews($obj1);
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
					$temp_obj3->addDepositMembersStationNews($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initDepositMembersStationNewss();
				$obj3->addDepositMembersStationNews($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptDepositStationNews(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);

		$rs = DepositMembersStationNewsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersStationNewsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, DepositStationNewsPeer::ID);

		$rs = DepositMembersStationNewsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptDepositStationNews(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DepositMembersStationNewsPeer::addSelectColumns($c);
		$startcol2 = (DepositMembersStationNewsPeer::NUM_COLUMNS - DepositMembersStationNewsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositMembersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositMembersPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, DepositMembersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersStationNewsPeer::getOMClass();

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
					$temp_obj2->addDepositMembersStationNews($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersStationNewss();
				$obj2->addDepositMembersStationNews($obj1);
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

		DepositMembersStationNewsPeer::addSelectColumns($c);
		$startcol2 = (DepositMembersStationNewsPeer::NUM_COLUMNS - DepositMembersStationNewsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DepositStationNewsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DepositStationNewsPeer::NUM_COLUMNS;

		$c->addJoin(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, DepositStationNewsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DepositMembersStationNewsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepositStationNewsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDepositStationNews(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDepositMembersStationNews($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDepositMembersStationNewss();
				$obj2->addDepositMembersStationNews($obj1);
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
		return DepositMembersStationNewsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositMembersStationNewsPeer::ID); 

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
			$comparison = $criteria->getComparison(DepositMembersStationNewsPeer::ID);
			$selectCriteria->add(DepositMembersStationNewsPeer::ID, $criteria->remove(DepositMembersStationNewsPeer::ID), $comparison);

			$comparison = $criteria->getComparison(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID);
			$selectCriteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $criteria->remove(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID), $comparison);

			$comparison = $criteria->getComparison(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID);
			$selectCriteria->add(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, $criteria->remove(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DepositMembersStationNewsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DepositMembersStationNewsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositMembersStationNews) {

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

			$criteria->add(DepositMembersStationNewsPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $vals[1], Criteria::IN);
			$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, $vals[2], Criteria::IN);
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

	
	public static function doValidate(DepositMembersStationNews $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositMembersStationNewsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositMembersStationNewsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DepositMembersStationNewsPeer::DATABASE_NAME, DepositMembersStationNewsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositMembersStationNewsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $deposit_station_news_id, $deposit_members_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(DepositMembersStationNewsPeer::ID, $id);
		$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID, $deposit_station_news_id);
		$criteria->add(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, $deposit_members_id);
		$v = DepositMembersStationNewsPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseDepositMembersStationNewsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositMembersStationNewsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositMembersStationNewsMapBuilder');
}
