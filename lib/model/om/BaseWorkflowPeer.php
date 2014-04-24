<?php


abstract class BaseWorkflowPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'workflow';

	
	const CLASS_DEFAULT = 'lib.model.Workflow';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'workflow.ID';

	
	const APPROVAL_ID = 'workflow.APPROVAL_ID';

	
	const DESCRIPTION = 'workflow.DESCRIPTION';

	
	const IS_PROJECT_ROLE = 'workflow.IS_PROJECT_ROLE';

	
	const PROJECT_ROLE_ID = 'workflow.PROJECT_ROLE_ID';

	
	const DEPARTMENT_ID = 'workflow.DEPARTMENT_ID';

	
	const TITLE_ID = 'workflow.TITLE_ID';

	
	const SORT_ORDER = 'workflow.SORT_ORDER';

	
	const IS_VALID = 'workflow.IS_VALID';

	
	const CREATED_AT = 'workflow.CREATED_AT';

	
	const UPDATED_AT = 'workflow.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ApprovalId', 'Description', 'IsProjectRole', 'ProjectRoleId', 'DepartmentId', 'TitleId', 'SortOrder', 'IsValid', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (WorkflowPeer::ID, WorkflowPeer::APPROVAL_ID, WorkflowPeer::DESCRIPTION, WorkflowPeer::IS_PROJECT_ROLE, WorkflowPeer::PROJECT_ROLE_ID, WorkflowPeer::DEPARTMENT_ID, WorkflowPeer::TITLE_ID, WorkflowPeer::SORT_ORDER, WorkflowPeer::IS_VALID, WorkflowPeer::CREATED_AT, WorkflowPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'approval_id', 'description', 'is_project_role', 'project_role_id', 'department_id', 'title_id', 'sort_order', 'is_valid', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApprovalId' => 1, 'Description' => 2, 'IsProjectRole' => 3, 'ProjectRoleId' => 4, 'DepartmentId' => 5, 'TitleId' => 6, 'SortOrder' => 7, 'IsValid' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
		BasePeer::TYPE_COLNAME => array (WorkflowPeer::ID => 0, WorkflowPeer::APPROVAL_ID => 1, WorkflowPeer::DESCRIPTION => 2, WorkflowPeer::IS_PROJECT_ROLE => 3, WorkflowPeer::PROJECT_ROLE_ID => 4, WorkflowPeer::DEPARTMENT_ID => 5, WorkflowPeer::TITLE_ID => 6, WorkflowPeer::SORT_ORDER => 7, WorkflowPeer::IS_VALID => 8, WorkflowPeer::CREATED_AT => 9, WorkflowPeer::UPDATED_AT => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'approval_id' => 1, 'description' => 2, 'is_project_role' => 3, 'project_role_id' => 4, 'department_id' => 5, 'title_id' => 6, 'sort_order' => 7, 'is_valid' => 8, 'created_at' => 9, 'updated_at' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/WorkflowMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.WorkflowMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = WorkflowPeer::getTableMap();
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
		return str_replace(WorkflowPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(WorkflowPeer::ID);

		$criteria->addSelectColumn(WorkflowPeer::APPROVAL_ID);

		$criteria->addSelectColumn(WorkflowPeer::DESCRIPTION);

		$criteria->addSelectColumn(WorkflowPeer::IS_PROJECT_ROLE);

		$criteria->addSelectColumn(WorkflowPeer::PROJECT_ROLE_ID);

		$criteria->addSelectColumn(WorkflowPeer::DEPARTMENT_ID);

		$criteria->addSelectColumn(WorkflowPeer::TITLE_ID);

		$criteria->addSelectColumn(WorkflowPeer::SORT_ORDER);

		$criteria->addSelectColumn(WorkflowPeer::IS_VALID);

		$criteria->addSelectColumn(WorkflowPeer::CREATED_AT);

		$criteria->addSelectColumn(WorkflowPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(workflow.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT workflow.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
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
		$objects = WorkflowPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return WorkflowPeer::populateObjects(WorkflowPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			WorkflowPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = WorkflowPeer::getOMClass();
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
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTitle(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
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

		WorkflowPeer::addSelectColumns($c);
		$startcol = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ApprovalPeer::addSelectColumns($c);

		$c->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();

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
										$temp_obj2->addWorkflow($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1); 			}
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

		WorkflowPeer::addSelectColumns($c);
		$startcol = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProjectRolePeer::addSelectColumns($c);

		$c->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();

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
										$temp_obj2->addWorkflow($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1); 			}
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

		WorkflowPeer::addSelectColumns($c);
		$startcol = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DepartmentPeer::addSelectColumns($c);

		$c->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();

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
										$temp_obj2->addWorkflow($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTitle(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkflowPeer::addSelectColumns($c);
		$startcol = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TitlePeer::addSelectColumns($c);

		$c->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TitlePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTitle(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addWorkflow($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$criteria->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$criteria->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$criteria->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
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

		WorkflowPeer::addSelectColumns($c);
		$startcol2 = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApprovalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApprovalPeer::NUM_COLUMNS;

		ProjectRolePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectRolePeer::NUM_COLUMNS;

		DepartmentPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + DepartmentPeer::NUM_COLUMNS;

		TitlePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TitlePeer::NUM_COLUMNS;

		$c->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$c->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$c->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$c->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();


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
					$temp_obj2->addWorkflow($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1);
			}


					
			$omClass = ProjectRolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectRole(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addWorkflow($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkflows();
				$obj3->addWorkflow($obj1);
			}


					
			$omClass = DepartmentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getDepartment(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkflow($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkflows();
				$obj4->addWorkflow($obj1);
			}


					
			$omClass = TitlePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTitle(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addWorkflow($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initWorkflows();
				$obj5->addWorkflow($obj1);
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
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$criteria->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$criteria->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$criteria->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$criteria->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$criteria->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$criteria->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTitle(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkflowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkflowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$criteria->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$criteria->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$rs = WorkflowPeer::doSelectRS($criteria, $con);
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

		WorkflowPeer::addSelectColumns($c);
		$startcol2 = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectRolePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectRolePeer::NUM_COLUMNS;

		DepartmentPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DepartmentPeer::NUM_COLUMNS;

		TitlePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TitlePeer::NUM_COLUMNS;

		$c->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$c->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$c->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectRolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectRole(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1);
			}

			$omClass = DepartmentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDepartment(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkflows();
				$obj3->addWorkflow($obj1);
			}

			$omClass = TitlePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTitle(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkflows();
				$obj4->addWorkflow($obj1);
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

		WorkflowPeer::addSelectColumns($c);
		$startcol2 = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApprovalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApprovalPeer::NUM_COLUMNS;

		DepartmentPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DepartmentPeer::NUM_COLUMNS;

		TitlePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TitlePeer::NUM_COLUMNS;

		$c->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$c->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);

		$c->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();

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
					$temp_obj2->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1);
			}

			$omClass = DepartmentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDepartment(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkflows();
				$obj3->addWorkflow($obj1);
			}

			$omClass = TitlePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTitle(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkflows();
				$obj4->addWorkflow($obj1);
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

		WorkflowPeer::addSelectColumns($c);
		$startcol2 = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApprovalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApprovalPeer::NUM_COLUMNS;

		ProjectRolePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectRolePeer::NUM_COLUMNS;

		TitlePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TitlePeer::NUM_COLUMNS;

		$c->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$c->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$c->addJoin(WorkflowPeer::TITLE_ID, TitlePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();

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
					$temp_obj2->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1);
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
					$temp_obj3->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkflows();
				$obj3->addWorkflow($obj1);
			}

			$omClass = TitlePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTitle(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkflows();
				$obj4->addWorkflow($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTitle(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkflowPeer::addSelectColumns($c);
		$startcol2 = (WorkflowPeer::NUM_COLUMNS - WorkflowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApprovalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApprovalPeer::NUM_COLUMNS;

		ProjectRolePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectRolePeer::NUM_COLUMNS;

		DepartmentPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + DepartmentPeer::NUM_COLUMNS;

		$c->addJoin(WorkflowPeer::APPROVAL_ID, ApprovalPeer::ID);

		$c->addJoin(WorkflowPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);

		$c->addJoin(WorkflowPeer::DEPARTMENT_ID, DepartmentPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkflowPeer::getOMClass();

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
					$temp_obj2->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkflows();
				$obj2->addWorkflow($obj1);
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
					$temp_obj3->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkflows();
				$obj3->addWorkflow($obj1);
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
					$temp_obj4->addWorkflow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkflows();
				$obj4->addWorkflow($obj1);
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
		return WorkflowPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(WorkflowPeer::ID); 

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
			$comparison = $criteria->getComparison(WorkflowPeer::ID);
			$selectCriteria->add(WorkflowPeer::ID, $criteria->remove(WorkflowPeer::ID), $comparison);

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
			$affectedRows += WorkflowPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(WorkflowPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(WorkflowPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Workflow) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(WorkflowPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += WorkflowPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = WorkflowPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/ApplicationWorkFlow.php';

						$c = new Criteria();
			
			$c->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $obj->getId());
			$affectedRows += ApplicationWorkFlowPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Workflow $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WorkflowPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WorkflowPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(WorkflowPeer::DATABASE_NAME, WorkflowPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = WorkflowPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(WorkflowPeer::DATABASE_NAME);

		$criteria->add(WorkflowPeer::ID, $pk);


		$v = WorkflowPeer::doSelect($criteria, $con);

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
			$criteria->add(WorkflowPeer::ID, $pks, Criteria::IN);
			$objs = WorkflowPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseWorkflowPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/WorkflowMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.WorkflowMapBuilder');
}
