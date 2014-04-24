<?php


abstract class BaseProjectPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'project';

	
	const CLASS_DEFAULT = 'lib.model.Project';

	
	const NUM_COLUMNS = 19;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'project.ID';

	
	const TYPE = 'project.TYPE';

	
	const PHASE = 'project.PHASE';

	
	const NAME = 'project.NAME';

	
	const LONG_NAME = 'project.LONG_NAME';

	
	const PROPRIETOR = 'project.PROPRIETOR';

	
	const START_DATE = 'project.START_DATE';

	
	const END_DATE = 'project.END_DATE';

	
	const IS_BUY_THE_TENDER_DOCUMENT = 'project.IS_BUY_THE_TENDER_DOCUMENT';

	
	const TENDER_DOCUMENT_PRICE = 'project.TENDER_DOCUMENT_PRICE';

	
	const TENDERING_STATUS = 'project.TENDERING_STATUS';

	
	const BLOCK_NUMBER = 'project.BLOCK_NUMBER';

	
	const COMMENT = 'project.COMMENT';

	
	const IS_PROJECT_END = 'project.IS_PROJECT_END';

	
	const PROJECT_END_COMMENT = 'project.PROJECT_END_COMMENT';

	
	const MODIFIER = 'project.MODIFIER';

	
	const CREATOR = 'project.CREATOR';

	
	const CREATED_AT = 'project.CREATED_AT';

	
	const UPDATED_AT = 'project.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Type', 'Phase', 'Name', 'LongName', 'Proprietor', 'StartDate', 'EndDate', 'IsBuyTheTenderDocument', 'TenderDocumentPrice', 'TenderingStatus', 'BlockNumber', 'Comment', 'IsProjectEnd', 'ProjectEndComment', 'Modifier', 'Creator', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ProjectPeer::ID, ProjectPeer::TYPE, ProjectPeer::PHASE, ProjectPeer::NAME, ProjectPeer::LONG_NAME, ProjectPeer::PROPRIETOR, ProjectPeer::START_DATE, ProjectPeer::END_DATE, ProjectPeer::IS_BUY_THE_TENDER_DOCUMENT, ProjectPeer::TENDER_DOCUMENT_PRICE, ProjectPeer::TENDERING_STATUS, ProjectPeer::BLOCK_NUMBER, ProjectPeer::COMMENT, ProjectPeer::IS_PROJECT_END, ProjectPeer::PROJECT_END_COMMENT, ProjectPeer::MODIFIER, ProjectPeer::CREATOR, ProjectPeer::CREATED_AT, ProjectPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'type', 'phase', 'name', 'long_name', 'proprietor', 'start_date', 'end_date', 'is_buy_the_tender_document', 'tender_document_price', 'tendering_status', 'block_number', 'comment', 'is_project_end', 'project_end_comment', 'modifier', 'creator', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Type' => 1, 'Phase' => 2, 'Name' => 3, 'LongName' => 4, 'Proprietor' => 5, 'StartDate' => 6, 'EndDate' => 7, 'IsBuyTheTenderDocument' => 8, 'TenderDocumentPrice' => 9, 'TenderingStatus' => 10, 'BlockNumber' => 11, 'Comment' => 12, 'IsProjectEnd' => 13, 'ProjectEndComment' => 14, 'Modifier' => 15, 'Creator' => 16, 'CreatedAt' => 17, 'UpdatedAt' => 18, ),
		BasePeer::TYPE_COLNAME => array (ProjectPeer::ID => 0, ProjectPeer::TYPE => 1, ProjectPeer::PHASE => 2, ProjectPeer::NAME => 3, ProjectPeer::LONG_NAME => 4, ProjectPeer::PROPRIETOR => 5, ProjectPeer::START_DATE => 6, ProjectPeer::END_DATE => 7, ProjectPeer::IS_BUY_THE_TENDER_DOCUMENT => 8, ProjectPeer::TENDER_DOCUMENT_PRICE => 9, ProjectPeer::TENDERING_STATUS => 10, ProjectPeer::BLOCK_NUMBER => 11, ProjectPeer::COMMENT => 12, ProjectPeer::IS_PROJECT_END => 13, ProjectPeer::PROJECT_END_COMMENT => 14, ProjectPeer::MODIFIER => 15, ProjectPeer::CREATOR => 16, ProjectPeer::CREATED_AT => 17, ProjectPeer::UPDATED_AT => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'type' => 1, 'phase' => 2, 'name' => 3, 'long_name' => 4, 'proprietor' => 5, 'start_date' => 6, 'end_date' => 7, 'is_buy_the_tender_document' => 8, 'tender_document_price' => 9, 'tendering_status' => 10, 'block_number' => 11, 'comment' => 12, 'is_project_end' => 13, 'project_end_comment' => 14, 'modifier' => 15, 'creator' => 16, 'created_at' => 17, 'updated_at' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProjectMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProjectMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProjectPeer::getTableMap();
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
		return str_replace(ProjectPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ProjectPeer::ID);

		$criteria->addSelectColumn(ProjectPeer::TYPE);

		$criteria->addSelectColumn(ProjectPeer::PHASE);

		$criteria->addSelectColumn(ProjectPeer::NAME);

		$criteria->addSelectColumn(ProjectPeer::LONG_NAME);

		$criteria->addSelectColumn(ProjectPeer::PROPRIETOR);

		$criteria->addSelectColumn(ProjectPeer::START_DATE);

		$criteria->addSelectColumn(ProjectPeer::END_DATE);

		$criteria->addSelectColumn(ProjectPeer::IS_BUY_THE_TENDER_DOCUMENT);

		$criteria->addSelectColumn(ProjectPeer::TENDER_DOCUMENT_PRICE);

		$criteria->addSelectColumn(ProjectPeer::TENDERING_STATUS);

		$criteria->addSelectColumn(ProjectPeer::BLOCK_NUMBER);

		$criteria->addSelectColumn(ProjectPeer::COMMENT);

		$criteria->addSelectColumn(ProjectPeer::IS_PROJECT_END);

		$criteria->addSelectColumn(ProjectPeer::PROJECT_END_COMMENT);

		$criteria->addSelectColumn(ProjectPeer::MODIFIER);

		$criteria->addSelectColumn(ProjectPeer::CREATOR);

		$criteria->addSelectColumn(ProjectPeer::CREATED_AT);

		$criteria->addSelectColumn(ProjectPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(project.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT project.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProjectPeer::doSelectRS($criteria, $con);
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
		$objects = ProjectPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProjectPeer::populateObjects(ProjectPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProjectPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ProjectPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return ProjectPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ProjectPeer::ID); 

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
			$comparison = $criteria->getComparison(ProjectPeer::ID);
			$selectCriteria->add(ProjectPeer::ID, $criteria->remove(ProjectPeer::ID), $comparison);

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
			$affectedRows += ProjectPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(ProjectPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ProjectPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Project) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProjectPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += ProjectPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = ProjectPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/ProjectMember.php';

						$c = new Criteria();
			
			$c->add(ProjectMemberPeer::PROJECT_ID, $obj->getId());
			$affectedRows += ProjectMemberPeer::doDelete($c, $con);

			include_once 'lib/model/ProjectHistory.php';

						$c = new Criteria();
			
			$c->add(ProjectHistoryPeer::PROJECT_ID, $obj->getId());
			$affectedRows += ProjectHistoryPeer::doDelete($c, $con);

			include_once 'lib/model/ProjectDocument.php';

						$c = new Criteria();
			
			$c->add(ProjectDocumentPeer::PROJECT_ID, $obj->getId());
			$affectedRows += ProjectDocumentPeer::doDelete($c, $con);

			include_once 'lib/model/Milestone.php';

						$c = new Criteria();
			
			$c->add(MilestonePeer::PROJECT_ID, $obj->getId());
			$affectedRows += MilestonePeer::doDelete($c, $con);

			include_once 'lib/model/DailyReport.php';

						$c = new Criteria();
			
			$c->add(DailyReportPeer::PROJECT_ID, $obj->getId());
			$affectedRows += DailyReportPeer::doDelete($c, $con);

			include_once 'lib/model/SignIn.php';

						$c = new Criteria();
			
			$c->add(SignInPeer::PROJECT_ID, $obj->getId());
			$affectedRows += SignInPeer::doDelete($c, $con);

			include_once 'lib/model/Application.php';

						$c = new Criteria();
			
			$c->add(ApplicationPeer::PROJECT_ID, $obj->getId());
			$affectedRows += ApplicationPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Project $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProjectPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProjectPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProjectPeer::DATABASE_NAME, ProjectPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProjectPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ProjectPeer::DATABASE_NAME);

		$criteria->add(ProjectPeer::ID, $pk);


		$v = ProjectPeer::doSelect($criteria, $con);

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
			$criteria->add(ProjectPeer::ID, $pks, Criteria::IN);
			$objs = ProjectPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseProjectPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ProjectMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProjectMapBuilder');
}
