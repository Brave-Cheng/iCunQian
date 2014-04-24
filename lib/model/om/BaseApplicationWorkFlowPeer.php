<?php


abstract class BaseApplicationWorkFlowPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'application_work_flow';

	
	const CLASS_DEFAULT = 'lib.model.ApplicationWorkFlow';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'application_work_flow.ID';

	
	const APPLICATION_ID = 'application_work_flow.APPLICATION_ID';

	
	const WORKFLOW_ID = 'application_work_flow.WORKFLOW_ID';

	
	const SF_GUARD_USER_ID = 'application_work_flow.SF_GUARD_USER_ID';

	
	const APPROVAL_RESULT = 'application_work_flow.APPROVAL_RESULT';

	
	const APPROVAL_COMMENT = 'application_work_flow.APPROVAL_COMMENT';

	
	const APPROVAL_TIME = 'application_work_flow.APPROVAL_TIME';

	
	const CREATED_AT = 'application_work_flow.CREATED_AT';

	
	const UPDATED_AT = 'application_work_flow.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ApplicationId', 'WorkflowId', 'SfGuardUserId', 'ApprovalResult', 'ApprovalComment', 'ApprovalTime', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ApplicationWorkFlowPeer::ID, ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationWorkFlowPeer::WORKFLOW_ID, ApplicationWorkFlowPeer::SF_GUARD_USER_ID, ApplicationWorkFlowPeer::APPROVAL_RESULT, ApplicationWorkFlowPeer::APPROVAL_COMMENT, ApplicationWorkFlowPeer::APPROVAL_TIME, ApplicationWorkFlowPeer::CREATED_AT, ApplicationWorkFlowPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'application_id', 'workflow_id', 'sf_guard_user_id', 'approval_result', 'approval_comment', 'approval_time', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApplicationId' => 1, 'WorkflowId' => 2, 'SfGuardUserId' => 3, 'ApprovalResult' => 4, 'ApprovalComment' => 5, 'ApprovalTime' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (ApplicationWorkFlowPeer::ID => 0, ApplicationWorkFlowPeer::APPLICATION_ID => 1, ApplicationWorkFlowPeer::WORKFLOW_ID => 2, ApplicationWorkFlowPeer::SF_GUARD_USER_ID => 3, ApplicationWorkFlowPeer::APPROVAL_RESULT => 4, ApplicationWorkFlowPeer::APPROVAL_COMMENT => 5, ApplicationWorkFlowPeer::APPROVAL_TIME => 6, ApplicationWorkFlowPeer::CREATED_AT => 7, ApplicationWorkFlowPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'application_id' => 1, 'workflow_id' => 2, 'sf_guard_user_id' => 3, 'approval_result' => 4, 'approval_comment' => 5, 'approval_time' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ApplicationWorkFlowMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ApplicationWorkFlowMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ApplicationWorkFlowPeer::getTableMap();
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
		return str_replace(ApplicationWorkFlowPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::ID);

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::APPLICATION_ID);

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::WORKFLOW_ID);

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::SF_GUARD_USER_ID);

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::APPROVAL_RESULT);

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::APPROVAL_COMMENT);

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::APPROVAL_TIME);

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::CREATED_AT);

		$criteria->addSelectColumn(ApplicationWorkFlowPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(application_work_flow.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT application_work_flow.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ApplicationWorkFlowPeer::doSelectRS($criteria, $con);
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
		$objects = ApplicationWorkFlowPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ApplicationWorkFlowPeer::populateObjects(ApplicationWorkFlowPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ApplicationWorkFlowPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ApplicationWorkFlowPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinApplication(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = ApplicationWorkFlowPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinWorkflow(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);

		$rs = ApplicationWorkFlowPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$rs = ApplicationWorkFlowPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinApplication(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationWorkFlowPeer::addSelectColumns($c);
		$startcol = (ApplicationWorkFlowPeer::NUM_COLUMNS - ApplicationWorkFlowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ApplicationPeer::addSelectColumns($c);

		$c->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationWorkFlowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ApplicationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getApplication(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addApplicationWorkFlow($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initApplicationWorkFlows();
				$obj2->addApplicationWorkFlow($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinWorkflow(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationWorkFlowPeer::addSelectColumns($c);
		$startcol = (ApplicationWorkFlowPeer::NUM_COLUMNS - ApplicationWorkFlowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		WorkflowPeer::addSelectColumns($c);

		$c->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationWorkFlowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = WorkflowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getWorkflow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addApplicationWorkFlow($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initApplicationWorkFlows();
				$obj2->addApplicationWorkFlow($obj1); 			}
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

		ApplicationWorkFlowPeer::addSelectColumns($c);
		$startcol = (ApplicationWorkFlowPeer::NUM_COLUMNS - ApplicationWorkFlowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationWorkFlowPeer::getOMClass();

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
										$temp_obj2->addApplicationWorkFlow($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initApplicationWorkFlows();
				$obj2->addApplicationWorkFlow($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);

		$criteria->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);

		$criteria->addJoin(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$rs = ApplicationWorkFlowPeer::doSelectRS($criteria, $con);
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

		ApplicationWorkFlowPeer::addSelectColumns($c);
		$startcol2 = (ApplicationWorkFlowPeer::NUM_COLUMNS - ApplicationWorkFlowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApplicationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApplicationPeer::NUM_COLUMNS;

		WorkflowPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + WorkflowPeer::NUM_COLUMNS;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + sfGuardUserPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);

		$c->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);

		$c->addJoin(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationWorkFlowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ApplicationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getApplication(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplicationWorkFlow($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initApplicationWorkFlows();
				$obj2->addApplicationWorkFlow($obj1);
			}


					
			$omClass = WorkflowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getWorkflow(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addApplicationWorkFlow($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initApplicationWorkFlows();
				$obj3->addApplicationWorkFlow($obj1);
			}


					
			$omClass = sfGuardUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getsfGuardUser(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addApplicationWorkFlow($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initApplicationWorkFlows();
				$obj4->addApplicationWorkFlow($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptApplication(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);

		$criteria->addJoin(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$rs = ApplicationWorkFlowPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptWorkflow(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);

		$criteria->addJoin(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);

		$rs = ApplicationWorkFlowPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ApplicationWorkFlowPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);

		$criteria->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);

		$rs = ApplicationWorkFlowPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptApplication(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationWorkFlowPeer::addSelectColumns($c);
		$startcol2 = (ApplicationWorkFlowPeer::NUM_COLUMNS - ApplicationWorkFlowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		WorkflowPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + WorkflowPeer::NUM_COLUMNS;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfGuardUserPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);

		$c->addJoin(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationWorkFlowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = WorkflowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getWorkflow(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplicationWorkFlow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initApplicationWorkFlows();
				$obj2->addApplicationWorkFlow($obj1);
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
					$temp_obj3->addApplicationWorkFlow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initApplicationWorkFlows();
				$obj3->addApplicationWorkFlow($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptWorkflow(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ApplicationWorkFlowPeer::addSelectColumns($c);
		$startcol2 = (ApplicationWorkFlowPeer::NUM_COLUMNS - ApplicationWorkFlowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApplicationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApplicationPeer::NUM_COLUMNS;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfGuardUserPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);

		$c->addJoin(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, sfGuardUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationWorkFlowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ApplicationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getApplication(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplicationWorkFlow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initApplicationWorkFlows();
				$obj2->addApplicationWorkFlow($obj1);
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
					$temp_obj3->addApplicationWorkFlow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initApplicationWorkFlows();
				$obj3->addApplicationWorkFlow($obj1);
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

		ApplicationWorkFlowPeer::addSelectColumns($c);
		$startcol2 = (ApplicationWorkFlowPeer::NUM_COLUMNS - ApplicationWorkFlowPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApplicationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApplicationPeer::NUM_COLUMNS;

		WorkflowPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + WorkflowPeer::NUM_COLUMNS;

		$c->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);

		$c->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ApplicationWorkFlowPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ApplicationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getApplication(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addApplicationWorkFlow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initApplicationWorkFlows();
				$obj2->addApplicationWorkFlow($obj1);
			}

			$omClass = WorkflowPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getWorkflow(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addApplicationWorkFlow($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initApplicationWorkFlows();
				$obj3->addApplicationWorkFlow($obj1);
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
		return ApplicationWorkFlowPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ApplicationWorkFlowPeer::ID); 

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
			$comparison = $criteria->getComparison(ApplicationWorkFlowPeer::ID);
			$selectCriteria->add(ApplicationWorkFlowPeer::ID, $criteria->remove(ApplicationWorkFlowPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ApplicationWorkFlowPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ApplicationWorkFlowPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ApplicationWorkFlow) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ApplicationWorkFlowPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ApplicationWorkFlow $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ApplicationWorkFlowPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ApplicationWorkFlowPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ApplicationWorkFlowPeer::DATABASE_NAME, ApplicationWorkFlowPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ApplicationWorkFlowPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ApplicationWorkFlowPeer::DATABASE_NAME);

		$criteria->add(ApplicationWorkFlowPeer::ID, $pk);


		$v = ApplicationWorkFlowPeer::doSelect($criteria, $con);

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
			$criteria->add(ApplicationWorkFlowPeer::ID, $pks, Criteria::IN);
			$objs = ApplicationWorkFlowPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseApplicationWorkFlowPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ApplicationWorkFlowMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ApplicationWorkFlowMapBuilder');
}
