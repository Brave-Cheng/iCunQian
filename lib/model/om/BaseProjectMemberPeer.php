<?php


abstract class BaseProjectMemberPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'project_member';

	
	const CLASS_DEFAULT = 'lib.model.ProjectMember';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'project_member.ID';

	
	const PROJECT_ID = 'project_member.PROJECT_ID';

	
	const SF_GUARD_USER_ID = 'project_member.SF_GUARD_USER_ID';

	
	const PROJECT_ROLE_ID = 'project_member.PROJECT_ROLE_ID';

	
	const OTHER_ROLE_NAME = 'project_member.OTHER_ROLE_NAME';

	
	const CREATED_AT = 'project_member.CREATED_AT';

	
	const UPDATED_AT = 'project_member.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProjectId', 'SfGuardUserId', 'ProjectRoleId', 'OtherRoleName', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ProjectMemberPeer::ID, ProjectMemberPeer::PROJECT_ID, ProjectMemberPeer::SF_GUARD_USER_ID, ProjectMemberPeer::PROJECT_ROLE_ID, ProjectMemberPeer::OTHER_ROLE_NAME, ProjectMemberPeer::CREATED_AT, ProjectMemberPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'project_id', 'sf_guard_user_id', 'project_role_id', 'other_role_name', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProjectId' => 1, 'SfGuardUserId' => 2, 'ProjectRoleId' => 3, 'OtherRoleName' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (ProjectMemberPeer::ID => 0, ProjectMemberPeer::PROJECT_ID => 1, ProjectMemberPeer::SF_GUARD_USER_ID => 2, ProjectMemberPeer::PROJECT_ROLE_ID => 3, ProjectMemberPeer::OTHER_ROLE_NAME => 4, ProjectMemberPeer::CREATED_AT => 5, ProjectMemberPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'project_id' => 1, 'sf_guard_user_id' => 2, 'project_role_id' => 3, 'other_role_name' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProjectMemberMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProjectMemberMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProjectMemberPeer::getTableMap();
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
		return str_replace(ProjectMemberPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ProjectMemberPeer::ID);

		$criteria->addSelectColumn(ProjectMemberPeer::PROJECT_ID);

		$criteria->addSelectColumn(ProjectMemberPeer::SF_GUARD_USER_ID);

		$criteria->addSelectColumn(ProjectMemberPeer::PROJECT_ROLE_ID);

		$criteria->addSelectColumn(ProjectMemberPeer::OTHER_ROLE_NAME);

		$criteria->addSelectColumn(ProjectMemberPeer::CREATED_AT);

		$criteria->addSelectColumn(ProjectMemberPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(project_member.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT project_member.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProjectMemberPeer::doSelectRS($criteria, $con);
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
		$objects = ProjectMemberPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProjectMemberPeer::populateObjects(ProjectMemberPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProjectMemberPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ProjectMemberPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinProject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);

		$rs = ProjectMemberPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectMemberPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$rs = ProjectMemberPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinProjectRole(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$rs = ProjectMemberPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinProject(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProjectMemberPeer::addSelectColumns($c);
		$startcol = (ProjectMemberPeer::NUM_COLUMNS - ProjectMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProjectPeer::addSelectColumns($c);

		$c->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectMemberPeer::getOMClass();

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
										$temp_obj2->addProjectMember($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProjectMembers();
				$obj2->addProjectMember($obj1); 			}
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

		ProjectMemberPeer::addSelectColumns($c);
		$startcol = (ProjectMemberPeer::NUM_COLUMNS - ProjectMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(ProjectMemberPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectMemberPeer::getOMClass();

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
										$temp_obj2->addProjectMember($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProjectMembers();
				$obj2->addProjectMember($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProjectRole(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProjectMemberPeer::addSelectColumns($c);
		$startcol = (ProjectMemberPeer::NUM_COLUMNS - ProjectMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProjectRolePeer::addSelectColumns($c);

		$c->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectMemberPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectRolePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProjectRole(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addProjectMember($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProjectMembers();
				$obj2->addProjectMember($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);

		$criteria->addJoin(ProjectMemberPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$criteria->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$rs = ProjectMemberPeer::doSelectRS($criteria, $con);
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

		ProjectMemberPeer::addSelectColumns($c);
		$startcol2 = (ProjectMemberPeer::NUM_COLUMNS - ProjectMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectPeer::NUM_COLUMNS;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfGuardUserPeer::NUM_COLUMNS;

		ProjectRolePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProjectRolePeer::NUM_COLUMNS;

		$c->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);

		$c->addJoin(ProjectMemberPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$c->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectMemberPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ProjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProjectMember($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initProjectMembers();
				$obj2->addProjectMember($obj1);
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
					$temp_obj3->addProjectMember($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initProjectMembers();
				$obj3->addProjectMember($obj1);
			}


					
			$omClass = ProjectRolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProjectRole(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProjectMember($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initProjectMembers();
				$obj4->addProjectMember($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptProject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectMemberPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$criteria->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$rs = ProjectMemberPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);

		$criteria->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$rs = ProjectMemberPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptProjectRole(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);

		$criteria->addJoin(ProjectMemberPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$rs = ProjectMemberPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptProject(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProjectMemberPeer::addSelectColumns($c);
		$startcol2 = (ProjectMemberPeer::NUM_COLUMNS - ProjectMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfGuardUserPeer::NUM_COLUMNS;

		ProjectRolePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectRolePeer::NUM_COLUMNS;

		$c->addJoin(ProjectMemberPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$c->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectMemberPeer::getOMClass();

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
					$temp_obj2->addProjectMember($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProjectMembers();
				$obj2->addProjectMember($obj1);
			}

			$omClass = ProjectRolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectRole(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProjectMember($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProjectMembers();
				$obj3->addProjectMember($obj1);
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

		ProjectMemberPeer::addSelectColumns($c);
		$startcol2 = (ProjectMemberPeer::NUM_COLUMNS - ProjectMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectPeer::NUM_COLUMNS;

		ProjectRolePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectRolePeer::NUM_COLUMNS;

		$c->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);

		$c->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectMemberPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProjectMember($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProjectMembers();
				$obj2->addProjectMember($obj1);
			}

			$omClass = ProjectRolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectRole(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProjectMember($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProjectMembers();
				$obj3->addProjectMember($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProjectRole(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProjectMemberPeer::addSelectColumns($c);
		$startcol2 = (ProjectMemberPeer::NUM_COLUMNS - ProjectMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectPeer::NUM_COLUMNS;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfGuardUserPeer::NUM_COLUMNS;

		$c->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);

		$c->addJoin(ProjectMemberPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectMemberPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProjectMember($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProjectMembers();
				$obj2->addProjectMember($obj1);
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
					$temp_obj3->addProjectMember($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProjectMembers();
				$obj3->addProjectMember($obj1);
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
		return ProjectMemberPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ProjectMemberPeer::ID); 

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
			$comparison = $criteria->getComparison(ProjectMemberPeer::ID);
			$selectCriteria->add(ProjectMemberPeer::ID, $criteria->remove(ProjectMemberPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ProjectMemberPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ProjectMemberPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ProjectMember) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProjectMemberPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ProjectMember $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProjectMemberPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProjectMemberPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProjectMemberPeer::DATABASE_NAME, ProjectMemberPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProjectMemberPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ProjectMemberPeer::DATABASE_NAME);

		$criteria->add(ProjectMemberPeer::ID, $pk);


		$v = ProjectMemberPeer::doSelect($criteria, $con);

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
			$criteria->add(ProjectMemberPeer::ID, $pks, Criteria::IN);
			$objs = ProjectMemberPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseProjectMemberPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ProjectMemberMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProjectMemberMapBuilder');
}
