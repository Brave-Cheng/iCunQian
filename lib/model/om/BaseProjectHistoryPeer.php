<?php


abstract class BaseProjectHistoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'project_history';

	
	const CLASS_DEFAULT = 'lib.model.ProjectHistory';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'project_history.ID';

	
	const PROJECT_ID = 'project_history.PROJECT_ID';

	
	const TYPE = 'project_history.TYPE';

	
	const PHASE = 'project_history.PHASE';

	
	const NAME = 'project_history.NAME';

	
	const PROPRIETOR = 'project_history.PROPRIETOR';

	
	const START_DATE = 'project_history.START_DATE';

	
	const END_DATE = 'project_history.END_DATE';

	
	const IS_BUY_THE_TENDER_DOCUMENT = 'project_history.IS_BUY_THE_TENDER_DOCUMENT';

	
	const TENDER_DOCUMENT_PRICE = 'project_history.TENDER_DOCUMENT_PRICE';

	
	const TENDERING_STATUS = 'project_history.TENDERING_STATUS';

	
	const BLOCK_NUMBER = 'project_history.BLOCK_NUMBER';

	
	const COMMENT = 'project_history.COMMENT';

	
	const IS_PROJECT_END = 'project_history.IS_PROJECT_END';

	
	const PROJECT_END_COMMENT = 'project_history.PROJECT_END_COMMENT';

	
	const MODIFIER = 'project_history.MODIFIER';

	
	const CREATED_AT = 'project_history.CREATED_AT';

	
	const UPDATED_AT = 'project_history.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProjectId', 'Type', 'Phase', 'Name', 'Proprietor', 'StartDate', 'EndDate', 'IsBuyTheTenderDocument', 'TenderDocumentPrice', 'TenderingStatus', 'BlockNumber', 'Comment', 'IsProjectEnd', 'ProjectEndComment', 'Modifier', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ProjectHistoryPeer::ID, ProjectHistoryPeer::PROJECT_ID, ProjectHistoryPeer::TYPE, ProjectHistoryPeer::PHASE, ProjectHistoryPeer::NAME, ProjectHistoryPeer::PROPRIETOR, ProjectHistoryPeer::START_DATE, ProjectHistoryPeer::END_DATE, ProjectHistoryPeer::IS_BUY_THE_TENDER_DOCUMENT, ProjectHistoryPeer::TENDER_DOCUMENT_PRICE, ProjectHistoryPeer::TENDERING_STATUS, ProjectHistoryPeer::BLOCK_NUMBER, ProjectHistoryPeer::COMMENT, ProjectHistoryPeer::IS_PROJECT_END, ProjectHistoryPeer::PROJECT_END_COMMENT, ProjectHistoryPeer::MODIFIER, ProjectHistoryPeer::CREATED_AT, ProjectHistoryPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'project_id', 'type', 'phase', 'name', 'proprietor', 'start_date', 'end_date', 'is_buy_the_tender_document', 'tender_document_price', 'tendering_status', 'block_number', 'comment', 'is_project_end', 'project_end_comment', 'modifier', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProjectId' => 1, 'Type' => 2, 'Phase' => 3, 'Name' => 4, 'Proprietor' => 5, 'StartDate' => 6, 'EndDate' => 7, 'IsBuyTheTenderDocument' => 8, 'TenderDocumentPrice' => 9, 'TenderingStatus' => 10, 'BlockNumber' => 11, 'Comment' => 12, 'IsProjectEnd' => 13, 'ProjectEndComment' => 14, 'Modifier' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ),
		BasePeer::TYPE_COLNAME => array (ProjectHistoryPeer::ID => 0, ProjectHistoryPeer::PROJECT_ID => 1, ProjectHistoryPeer::TYPE => 2, ProjectHistoryPeer::PHASE => 3, ProjectHistoryPeer::NAME => 4, ProjectHistoryPeer::PROPRIETOR => 5, ProjectHistoryPeer::START_DATE => 6, ProjectHistoryPeer::END_DATE => 7, ProjectHistoryPeer::IS_BUY_THE_TENDER_DOCUMENT => 8, ProjectHistoryPeer::TENDER_DOCUMENT_PRICE => 9, ProjectHistoryPeer::TENDERING_STATUS => 10, ProjectHistoryPeer::BLOCK_NUMBER => 11, ProjectHistoryPeer::COMMENT => 12, ProjectHistoryPeer::IS_PROJECT_END => 13, ProjectHistoryPeer::PROJECT_END_COMMENT => 14, ProjectHistoryPeer::MODIFIER => 15, ProjectHistoryPeer::CREATED_AT => 16, ProjectHistoryPeer::UPDATED_AT => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'project_id' => 1, 'type' => 2, 'phase' => 3, 'name' => 4, 'proprietor' => 5, 'start_date' => 6, 'end_date' => 7, 'is_buy_the_tender_document' => 8, 'tender_document_price' => 9, 'tendering_status' => 10, 'block_number' => 11, 'comment' => 12, 'is_project_end' => 13, 'project_end_comment' => 14, 'modifier' => 15, 'created_at' => 16, 'updated_at' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProjectHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProjectHistoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProjectHistoryPeer::getTableMap();
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
		return str_replace(ProjectHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ProjectHistoryPeer::ID);

		$criteria->addSelectColumn(ProjectHistoryPeer::PROJECT_ID);

		$criteria->addSelectColumn(ProjectHistoryPeer::TYPE);

		$criteria->addSelectColumn(ProjectHistoryPeer::PHASE);

		$criteria->addSelectColumn(ProjectHistoryPeer::NAME);

		$criteria->addSelectColumn(ProjectHistoryPeer::PROPRIETOR);

		$criteria->addSelectColumn(ProjectHistoryPeer::START_DATE);

		$criteria->addSelectColumn(ProjectHistoryPeer::END_DATE);

		$criteria->addSelectColumn(ProjectHistoryPeer::IS_BUY_THE_TENDER_DOCUMENT);

		$criteria->addSelectColumn(ProjectHistoryPeer::TENDER_DOCUMENT_PRICE);

		$criteria->addSelectColumn(ProjectHistoryPeer::TENDERING_STATUS);

		$criteria->addSelectColumn(ProjectHistoryPeer::BLOCK_NUMBER);

		$criteria->addSelectColumn(ProjectHistoryPeer::COMMENT);

		$criteria->addSelectColumn(ProjectHistoryPeer::IS_PROJECT_END);

		$criteria->addSelectColumn(ProjectHistoryPeer::PROJECT_END_COMMENT);

		$criteria->addSelectColumn(ProjectHistoryPeer::MODIFIER);

		$criteria->addSelectColumn(ProjectHistoryPeer::CREATED_AT);

		$criteria->addSelectColumn(ProjectHistoryPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(project_history.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT project_history.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProjectHistoryPeer::doSelectRS($criteria, $con);
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
		$objects = ProjectHistoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProjectHistoryPeer::populateObjects(ProjectHistoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProjectHistoryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ProjectHistoryPeer::getOMClass();
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
			$criteria->addSelectColumn(ProjectHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectHistoryPeer::PROJECT_ID, ProjectPeer::ID);

		$rs = ProjectHistoryPeer::doSelectRS($criteria, $con);
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

		ProjectHistoryPeer::addSelectColumns($c);
		$startcol = (ProjectHistoryPeer::NUM_COLUMNS - ProjectHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProjectPeer::addSelectColumns($c);

		$c->addJoin(ProjectHistoryPeer::PROJECT_ID, ProjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectHistoryPeer::getOMClass();

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
										$temp_obj2->addProjectHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProjectHistorys();
				$obj2->addProjectHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectHistoryPeer::PROJECT_ID, ProjectPeer::ID);

		$rs = ProjectHistoryPeer::doSelectRS($criteria, $con);
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

		ProjectHistoryPeer::addSelectColumns($c);
		$startcol2 = (ProjectHistoryPeer::NUM_COLUMNS - ProjectHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectPeer::NUM_COLUMNS;

		$c->addJoin(ProjectHistoryPeer::PROJECT_ID, ProjectPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectHistoryPeer::getOMClass();


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
					$temp_obj2->addProjectHistory($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initProjectHistorys();
				$obj2->addProjectHistory($obj1);
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
		return ProjectHistoryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ProjectHistoryPeer::ID); 

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
			$comparison = $criteria->getComparison(ProjectHistoryPeer::ID);
			$selectCriteria->add(ProjectHistoryPeer::ID, $criteria->remove(ProjectHistoryPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ProjectHistoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ProjectHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ProjectHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProjectHistoryPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ProjectHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProjectHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProjectHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProjectHistoryPeer::DATABASE_NAME, ProjectHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProjectHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ProjectHistoryPeer::DATABASE_NAME);

		$criteria->add(ProjectHistoryPeer::ID, $pk);


		$v = ProjectHistoryPeer::doSelect($criteria, $con);

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
			$criteria->add(ProjectHistoryPeer::ID, $pks, Criteria::IN);
			$objs = ProjectHistoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseProjectHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ProjectHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProjectHistoryMapBuilder');
}
