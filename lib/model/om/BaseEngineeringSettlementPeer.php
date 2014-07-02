<?php


abstract class BaseEngineeringSettlementPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'engineering_settlement';

	
	const CLASS_DEFAULT = 'lib.model.EngineeringSettlement';

	
	const NUM_COLUMNS = 19;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'engineering_settlement.ID';

	
	const APPLICATION_ID = 'engineering_settlement.APPLICATION_ID';

	
	const CONTRACT_NUMBER = 'engineering_settlement.CONTRACT_NUMBER';

	
	const CONSTRUCTION_UNIT = 'engineering_settlement.CONSTRUCTION_UNIT';

	
	const EXPIRATION_DATE = 'engineering_settlement.EXPIRATION_DATE';

	
	const ISSUE = 'engineering_settlement.ISSUE';

	
	const CONTRACT_AMOUNT = 'engineering_settlement.CONTRACT_AMOUNT';

	
	const CHANGE_AMOUNT = 'engineering_settlement.CHANGE_AMOUNT';

	
	const CHANGED_AMOUNT = 'engineering_settlement.CHANGED_AMOUNT';

	
	const CURRENT_COMPLETE_ENGINEERING = 'engineering_settlement.CURRENT_COMPLETE_ENGINEERING';

	
	const CURRENT_FASTENER_RETENTION = 'engineering_settlement.CURRENT_FASTENER_RETENTION';

	
	const CURRENT_PAYABLE = 'engineering_settlement.CURRENT_PAYABLE';

	
	const TOTAL_COMPLETE_ENGINEERING = 'engineering_settlement.TOTAL_COMPLETE_ENGINEERING';

	
	const TOTAL_FASTENER_RETENTION = 'engineering_settlement.TOTAL_FASTENER_RETENTION';

	
	const TOTAL_PAYABLE = 'engineering_settlement.TOTAL_PAYABLE';

	
	const PREPAYMENT = 'engineering_settlement.PREPAYMENT';

	
	const APPLY_PAYMENT = 'engineering_settlement.APPLY_PAYMENT';

	
	const CREATED_AT = 'engineering_settlement.CREATED_AT';

	
	const UPDATED_AT = 'engineering_settlement.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ApplicationId', 'ContractNumber', 'ConstructionUnit', 'ExpirationDate', 'Issue', 'ContractAmount', 'ChangeAmount', 'ChangedAmount', 'CurrentCompleteEngineering', 'CurrentFastenerRetention', 'CurrentPayable', 'TotalCompleteEngineering', 'TotalFastenerRetention', 'TotalPayable', 'Prepayment', 'ApplyPayment', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EngineeringSettlementPeer::ID, EngineeringSettlementPeer::APPLICATION_ID, EngineeringSettlementPeer::CONTRACT_NUMBER, EngineeringSettlementPeer::CONSTRUCTION_UNIT, EngineeringSettlementPeer::EXPIRATION_DATE, EngineeringSettlementPeer::ISSUE, EngineeringSettlementPeer::CONTRACT_AMOUNT, EngineeringSettlementPeer::CHANGE_AMOUNT, EngineeringSettlementPeer::CHANGED_AMOUNT, EngineeringSettlementPeer::CURRENT_COMPLETE_ENGINEERING, EngineeringSettlementPeer::CURRENT_FASTENER_RETENTION, EngineeringSettlementPeer::CURRENT_PAYABLE, EngineeringSettlementPeer::TOTAL_COMPLETE_ENGINEERING, EngineeringSettlementPeer::TOTAL_FASTENER_RETENTION, EngineeringSettlementPeer::TOTAL_PAYABLE, EngineeringSettlementPeer::PREPAYMENT, EngineeringSettlementPeer::APPLY_PAYMENT, EngineeringSettlementPeer::CREATED_AT, EngineeringSettlementPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'application_id', 'contract_number', 'construction_unit', 'expiration_date', 'issue', 'contract_amount', 'change_amount', 'changed_amount', 'current_complete_engineering', 'current_fastener_retention', 'current_payable', 'total_complete_engineering', 'total_fastener_retention', 'total_payable', 'prepayment', 'apply_payment', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ApplicationId' => 1, 'ContractNumber' => 2, 'ConstructionUnit' => 3, 'ExpirationDate' => 4, 'Issue' => 5, 'ContractAmount' => 6, 'ChangeAmount' => 7, 'ChangedAmount' => 8, 'CurrentCompleteEngineering' => 9, 'CurrentFastenerRetention' => 10, 'CurrentPayable' => 11, 'TotalCompleteEngineering' => 12, 'TotalFastenerRetention' => 13, 'TotalPayable' => 14, 'Prepayment' => 15, 'ApplyPayment' => 16, 'CreatedAt' => 17, 'UpdatedAt' => 18, ),
		BasePeer::TYPE_COLNAME => array (EngineeringSettlementPeer::ID => 0, EngineeringSettlementPeer::APPLICATION_ID => 1, EngineeringSettlementPeer::CONTRACT_NUMBER => 2, EngineeringSettlementPeer::CONSTRUCTION_UNIT => 3, EngineeringSettlementPeer::EXPIRATION_DATE => 4, EngineeringSettlementPeer::ISSUE => 5, EngineeringSettlementPeer::CONTRACT_AMOUNT => 6, EngineeringSettlementPeer::CHANGE_AMOUNT => 7, EngineeringSettlementPeer::CHANGED_AMOUNT => 8, EngineeringSettlementPeer::CURRENT_COMPLETE_ENGINEERING => 9, EngineeringSettlementPeer::CURRENT_FASTENER_RETENTION => 10, EngineeringSettlementPeer::CURRENT_PAYABLE => 11, EngineeringSettlementPeer::TOTAL_COMPLETE_ENGINEERING => 12, EngineeringSettlementPeer::TOTAL_FASTENER_RETENTION => 13, EngineeringSettlementPeer::TOTAL_PAYABLE => 14, EngineeringSettlementPeer::PREPAYMENT => 15, EngineeringSettlementPeer::APPLY_PAYMENT => 16, EngineeringSettlementPeer::CREATED_AT => 17, EngineeringSettlementPeer::UPDATED_AT => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'application_id' => 1, 'contract_number' => 2, 'construction_unit' => 3, 'expiration_date' => 4, 'issue' => 5, 'contract_amount' => 6, 'change_amount' => 7, 'changed_amount' => 8, 'current_complete_engineering' => 9, 'current_fastener_retention' => 10, 'current_payable' => 11, 'total_complete_engineering' => 12, 'total_fastener_retention' => 13, 'total_payable' => 14, 'prepayment' => 15, 'apply_payment' => 16, 'created_at' => 17, 'updated_at' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EngineeringSettlementMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EngineeringSettlementMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EngineeringSettlementPeer::getTableMap();
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
		return str_replace(EngineeringSettlementPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EngineeringSettlementPeer::ID);

		$criteria->addSelectColumn(EngineeringSettlementPeer::APPLICATION_ID);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CONTRACT_NUMBER);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CONSTRUCTION_UNIT);

		$criteria->addSelectColumn(EngineeringSettlementPeer::EXPIRATION_DATE);

		$criteria->addSelectColumn(EngineeringSettlementPeer::ISSUE);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CONTRACT_AMOUNT);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CHANGE_AMOUNT);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CHANGED_AMOUNT);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CURRENT_COMPLETE_ENGINEERING);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CURRENT_FASTENER_RETENTION);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CURRENT_PAYABLE);

		$criteria->addSelectColumn(EngineeringSettlementPeer::TOTAL_COMPLETE_ENGINEERING);

		$criteria->addSelectColumn(EngineeringSettlementPeer::TOTAL_FASTENER_RETENTION);

		$criteria->addSelectColumn(EngineeringSettlementPeer::TOTAL_PAYABLE);

		$criteria->addSelectColumn(EngineeringSettlementPeer::PREPAYMENT);

		$criteria->addSelectColumn(EngineeringSettlementPeer::APPLY_PAYMENT);

		$criteria->addSelectColumn(EngineeringSettlementPeer::CREATED_AT);

		$criteria->addSelectColumn(EngineeringSettlementPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(engineering_settlement.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT engineering_settlement.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringSettlementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSettlementPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EngineeringSettlementPeer::doSelectRS($criteria, $con);
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
		$objects = EngineeringSettlementPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EngineeringSettlementPeer::populateObjects(EngineeringSettlementPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EngineeringSettlementPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EngineeringSettlementPeer::getOMClass();
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
			$criteria->addSelectColumn(EngineeringSettlementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSettlementPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringSettlementPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = EngineeringSettlementPeer::doSelectRS($criteria, $con);
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

		EngineeringSettlementPeer::addSelectColumns($c);
		$startcol = (EngineeringSettlementPeer::NUM_COLUMNS - EngineeringSettlementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ApplicationPeer::addSelectColumns($c);

		$c->addJoin(EngineeringSettlementPeer::APPLICATION_ID, ApplicationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringSettlementPeer::getOMClass();

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
										$temp_obj2->addEngineeringSettlement($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEngineeringSettlements();
				$obj2->addEngineeringSettlement($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EngineeringSettlementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EngineeringSettlementPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EngineeringSettlementPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = EngineeringSettlementPeer::doSelectRS($criteria, $con);
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

		EngineeringSettlementPeer::addSelectColumns($c);
		$startcol2 = (EngineeringSettlementPeer::NUM_COLUMNS - EngineeringSettlementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ApplicationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ApplicationPeer::NUM_COLUMNS;

		$c->addJoin(EngineeringSettlementPeer::APPLICATION_ID, ApplicationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EngineeringSettlementPeer::getOMClass();


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
					$temp_obj2->addEngineeringSettlement($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEngineeringSettlements();
				$obj2->addEngineeringSettlement($obj1);
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
		return EngineeringSettlementPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EngineeringSettlementPeer::ID); 

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
			$comparison = $criteria->getComparison(EngineeringSettlementPeer::ID);
			$selectCriteria->add(EngineeringSettlementPeer::ID, $criteria->remove(EngineeringSettlementPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EngineeringSettlementPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EngineeringSettlementPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EngineeringSettlement) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EngineeringSettlementPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EngineeringSettlement $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EngineeringSettlementPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EngineeringSettlementPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EngineeringSettlementPeer::DATABASE_NAME, EngineeringSettlementPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EngineeringSettlementPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EngineeringSettlementPeer::DATABASE_NAME);

		$criteria->add(EngineeringSettlementPeer::ID, $pk);


		$v = EngineeringSettlementPeer::doSelect($criteria, $con);

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
			$criteria->add(EngineeringSettlementPeer::ID, $pks, Criteria::IN);
			$objs = EngineeringSettlementPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEngineeringSettlementPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EngineeringSettlementMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EngineeringSettlementMapBuilder');
}
