<?php


abstract class BaseApplicationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'application';

	
	const CLASS_DEFAULT = 'lib.model.Application';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'application.ID';

	
	const APPROVAL_ID = 'application.APPROVAL_ID';

	
	const SF_GUARD_USER_ID = 'application.SF_GUARD_USER_ID';

	
	const PROJECT_ID = 'application.PROJECT_ID';

	
	const DEPARTMENT_ID = 'application.DEPARTMENT_ID';

	
	const NAME = 'application.NAME';

	
	const DESCRIPTION = 'application.DESCRIPTION';

	
	const ATTACHMENT = 'application.ATTACHMENT';

	
	const CURRENT_STATUS = 'application.CURRENT_STATUS';

	
	const IS_VALID = 'application.IS_VALID';

	
	const CREATED_AT = 'application.CREATED_AT';

	
	const UPDATED_AT = 'application.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ApprovalId', 'SfGuardUserId', 'ProjectId', 'DepartmentId', 'Name', 'Description', 'Attachment', 'CurrentStatus', 'IsValid', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ApplicationPeer::ID, ApplicationPeer::APPROVAL_ID, ApplicationPeer::SF_GUARD_USER_ID, ApplicationPeer::PROJECT_ID, ApplicationPeer::DEPARTMENT_ID, ApplicationPeer::NAME, ApplicationPeer::DESCRIPTION, ApplicationPeer::ATTACHMENT, ApplicationPeer::CURRENT_STATUS, ApplicationPeer::IS_VALID, ApplicationPeer::CREATED_AT, ApplicationPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'approval_id', 'sf_guard_user_id', 'project_id', 'department_id', 'name', 'description', 'attachment', 'current_status', 'is_valid', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApprovalId' => 1, 'SfGuardUserId' => 2, 'ProjectId' => 3, 'DepartmentId' => 4, 'Name' => 5, 'Description' => 6, 'Attachment' => 7, 'CurrentStatus' => 8, 'IsValid' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (ApplicationPeer::ID => 0, ApplicationPeer::APPROVAL_ID => 1, ApplicationPeer::SF_GUARD_USER_ID => 2, ApplicationPeer::PROJECT_ID => 3, ApplicationPeer::DEPARTMENT_ID => 4, ApplicationPeer::NAME => 5, ApplicationPeer::DESCRIPTION => 6, ApplicationPeer::ATTACHMENT => 7, ApplicationPeer::CURRENT_STATUS => 8, ApplicationPeer::IS_VALID => 9, ApplicationPeer::CREATED_AT => 10, ApplicationPeer::UPDATED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'approval_id' => 1, 'sf_guard_user_id' => 2, 'project_id' => 3, 'department_id' => 4, 'name' => 5, 'description' => 6, 'attachment' => 7, 'current_status' => 8, 'is_valid' => 9, 'created_at' => 10, 'updated_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ApplicationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ApplicationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ApplicationPeer::getTableMap();
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
		return str_replace(ApplicationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ApplicationPeer::ID);

		$criteria->addSelectColumn(ApplicationPeer::APPROVAL_ID);

		$criteria->addSelectColumn(ApplicationPeer::SF_GUARD_USER_ID);

		$criteria->addSelectColumn(ApplicationPeer::PROJECT_ID);

		$criteria->addSelectColumn(ApplicationPeer::DEPARTMENT_ID);

		$criteria->addSelectColumn(ApplicationPeer::NAME);

		$criteria->addSelectColumn(ApplicationPeer::DESCRIPTION);

		$criteria->addSelectColumn(ApplicationPeer::ATTACHMENT);

		$criteria->addSelectColumn(ApplicationPeer::CURRENT_STATUS);

		$criteria->addSelectColumn(ApplicationPeer::IS_VALID);

		$criteria->addSelectColumn(ApplicationPeer::CREATED_AT);

		$criteria->addSelectColumn(ApplicationPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(application.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT application.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
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
		$objects = ApplicationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ApplicationPeer::populateObjects(ApplicationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ApplicationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ApplicationPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinApproval(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinProject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinDepartment(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinApproval(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationPeer::addSelectColumns($c);
		$startcol = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ApprovalPeer::addSelectColumns($c);

		$c->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ApprovalPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getApproval(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addApplication($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinsfGuardUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationPeer::addSelectColumns($c);
		$startcol = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfGuardUserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfGuardUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addApplication($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProject(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationPeer::addSelectColumns($c);
		$startcol = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProjectPeer::addSelectColumns($c);

		$c->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addApplication($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinDepartment(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationPeer::addSelectColumns($c);
		$startcol = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepartmentPeer::addSelectColumns($c);

		$c->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DepartmentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDepartment(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addApplication($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$criteria->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$criteria->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);

		$criteria->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
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

		ApplicationPeer::addSelectColumns($c);
		$startcol2 = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApprovalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApprovalPeer::NUM_COLUMNS;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfGuardUserPeer::NUM_COLUMNS;

		ProjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProjectPeer::NUM_COLUMNS;

		DepartmentPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + DepartmentPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$c->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$c->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);

		$c->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ApprovalPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getApproval(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplication($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1);
			}


					
			$omClass = sfGuardUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfGuardUser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addApplication($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initApplications();
				$obj3->addApplication($obj1);
			}


					
			$omClass = ProjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addApplication($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initApplications();
				$obj4->addApplication($obj1);
			}


					
			$omClass = DepartmentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getDepartment(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addApplication($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initApplications();
				$obj5->addApplication($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptApproval(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$criteria->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);

		$criteria->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptsfGuardUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$criteria->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);

		$criteria->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptProject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$criteria->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$criteria->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDepartment(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$criteria->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$criteria->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);

		$rs = ApplicationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptApproval(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationPeer::addSelectColumns($c);
		$startcol2 = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfGuardUserPeer::NUM_COLUMNS;

		ProjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectPeer::NUM_COLUMNS;

		DepartmentPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + DepartmentPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$c->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);

		$c->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfGuardUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfGuardUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1);
			}

			$omClass = ProjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initApplications();
				$obj3->addApplication($obj1);
			}

			$omClass = DepartmentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getDepartment(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initApplications();
				$obj4->addApplication($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptsfGuardUser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationPeer::addSelectColumns($c);
		$startcol2 = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApprovalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApprovalPeer::NUM_COLUMNS;

		ProjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectPeer::NUM_COLUMNS;

		DepartmentPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + DepartmentPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$c->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);

		$c->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ApprovalPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getApproval(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1);
			}

			$omClass = ProjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initApplications();
				$obj3->addApplication($obj1);
			}

			$omClass = DepartmentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getDepartment(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initApplications();
				$obj4->addApplication($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProject(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationPeer::addSelectColumns($c);
		$startcol2 = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApprovalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApprovalPeer::NUM_COLUMNS;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfGuardUserPeer::NUM_COLUMNS;

		DepartmentPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + DepartmentPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$c->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$c->addJoin(ApplicationPeer::DEPARTMENT_ID, DepartmentPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ApprovalPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getApproval(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1);
			}

			$omClass = sfGuardUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfGuardUser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initApplications();
				$obj3->addApplication($obj1);
			}

			$omClass = DepartmentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getDepartment(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initApplications();
				$obj4->addApplication($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptDepartment(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationPeer::addSelectColumns($c);
		$startcol2 = (ApplicationPeer::NUM_COLUMNS - ApplicationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApprovalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApprovalPeer::NUM_COLUMNS;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfGuardUserPeer::NUM_COLUMNS;

		ProjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProjectPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationPeer::APPROVAL_ID, ApprovalPeer::ID);

		$c->addJoin(ApplicationPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$c->addJoin(ApplicationPeer::PROJECT_ID, ProjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ApprovalPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getApproval(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initApplications();
				$obj2->addApplication($obj1);
			}

			$omClass = sfGuardUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfGuardUser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initApplications();
				$obj3->addApplication($obj1);
			}

			$omClass = ProjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addApplication($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initApplications();
				$obj4->addApplication($obj1);
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
		return ApplicationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ApplicationPeer::ID); 

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
			$comparison = $criteria->getComparison(ApplicationPeer::ID);
			$selectCriteria->add(ApplicationPeer::ID, $criteria->remove(ApplicationPeer::ID), $comparison);

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
			$affectedRows += ApplicationPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(ApplicationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ApplicationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Application) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ApplicationPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += ApplicationPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = ApplicationPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/ApplicationWorkFlow.php';

						$c = new Criteria();
			
			$c->add(ApplicationWorkFlowPeer::APPLICATION_ID, $obj->getId());
			$affectedRows += ApplicationWorkFlowPeer::doDelete($c, $con);

			include_once 'lib/model/EngineeringSettlement.php';

						$c = new Criteria();
			
			$c->add(EngineeringSettlementPeer::APPLICATION_ID, $obj->getId());
			$affectedRows += EngineeringSettlementPeer::doDelete($c, $con);

			include_once 'lib/model/EngineeringMaterials.php';

						$c = new Criteria();
			
			$c->add(EngineeringMaterialsPeer::APPLICATION_ID, $obj->getId());
			$affectedRows += EngineeringMaterialsPeer::doDelete($c, $con);

			include_once 'lib/model/EngineeringSummary.php';

						$c = new Criteria();
			
			$c->add(EngineeringSummaryPeer::APPLICATION_ID, $obj->getId());
			$affectedRows += EngineeringSummaryPeer::doDelete($c, $con);

			include_once 'lib/model/EngineeringGoods.php';

						$c = new Criteria();
			
			$c->add(EngineeringGoodsPeer::APPLICATION_ID, $obj->getId());
			$affectedRows += EngineeringGoodsPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Application $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ApplicationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ApplicationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ApplicationPeer::DATABASE_NAME, ApplicationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ApplicationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ApplicationPeer::DATABASE_NAME);

		$criteria->add(ApplicationPeer::ID, $pk);


		$v = ApplicationPeer::doSelect($criteria, $con);

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
			$criteria->add(ApplicationPeer::ID, $pks, Criteria::IN);
			$objs = ApplicationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseApplicationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ApplicationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ApplicationMapBuilder');
}
