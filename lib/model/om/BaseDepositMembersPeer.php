<?php


abstract class BaseDepositMembersPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'deposit_members';

	
	const CLASS_DEFAULT = 'lib.model.DepositMembers';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'deposit_members.ID';

	
	const ACCOUNT = 'deposit_members.ACCOUNT';

	
	const NICKNAME = 'deposit_members.NICKNAME';

	
	const PASSWORD = 'deposit_members.PASSWORD';

	
	const MOBILE = 'deposit_members.MOBILE';

	
	const EMAIL = 'deposit_members.EMAIL';

	
	const AVATAR = 'deposit_members.AVATAR';

	
	const MOBILE_ACTIVE = 'deposit_members.MOBILE_ACTIVE';

	
	const EMAIL_ACTIVE = 'deposit_members.EMAIL_ACTIVE';

	
	const THIRD_PARTY_PLATFORM_TYPE = 'deposit_members.THIRD_PARTY_PLATFORM_TYPE';

	
	const THIRD_PARTY_PLATFORM_ACCOUNT = 'deposit_members.THIRD_PARTY_PLATFORM_ACCOUNT';

	
	const REGISTRATION_TIME = 'deposit_members.REGISTRATION_TIME';

	
	const IS_LOGIN = 'deposit_members.IS_LOGIN';

	
	const LAST_LOGIN = 'deposit_members.LAST_LOGIN';

	
	const CREATED_AT = 'deposit_members.CREATED_AT';

	
	const UPDATED_AT = 'deposit_members.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Account', 'Nickname', 'Password', 'Mobile', 'Email', 'Avatar', 'MobileActive', 'EmailActive', 'ThirdPartyPlatformType', 'ThirdPartyPlatformAccount', 'RegistrationTime', 'IsLogin', 'LastLogin', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DepositMembersPeer::ID, DepositMembersPeer::ACCOUNT, DepositMembersPeer::NICKNAME, DepositMembersPeer::PASSWORD, DepositMembersPeer::MOBILE, DepositMembersPeer::EMAIL, DepositMembersPeer::AVATAR, DepositMembersPeer::MOBILE_ACTIVE, DepositMembersPeer::EMAIL_ACTIVE, DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE, DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT, DepositMembersPeer::REGISTRATION_TIME, DepositMembersPeer::IS_LOGIN, DepositMembersPeer::LAST_LOGIN, DepositMembersPeer::CREATED_AT, DepositMembersPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'account', 'nickname', 'password', 'mobile', 'email', 'avatar', 'mobile_active', 'email_active', 'third_party_platform_type', 'third_party_platform_account', 'registration_time', 'is_login', 'last_login', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Account' => 1, 'Nickname' => 2, 'Password' => 3, 'Mobile' => 4, 'Email' => 5, 'Avatar' => 6, 'MobileActive' => 7, 'EmailActive' => 8, 'ThirdPartyPlatformType' => 9, 'ThirdPartyPlatformAccount' => 10, 'RegistrationTime' => 11, 'IsLogin' => 12, 'LastLogin' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
		BasePeer::TYPE_COLNAME => array (DepositMembersPeer::ID => 0, DepositMembersPeer::ACCOUNT => 1, DepositMembersPeer::NICKNAME => 2, DepositMembersPeer::PASSWORD => 3, DepositMembersPeer::MOBILE => 4, DepositMembersPeer::EMAIL => 5, DepositMembersPeer::AVATAR => 6, DepositMembersPeer::MOBILE_ACTIVE => 7, DepositMembersPeer::EMAIL_ACTIVE => 8, DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE => 9, DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT => 10, DepositMembersPeer::REGISTRATION_TIME => 11, DepositMembersPeer::IS_LOGIN => 12, DepositMembersPeer::LAST_LOGIN => 13, DepositMembersPeer::CREATED_AT => 14, DepositMembersPeer::UPDATED_AT => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'account' => 1, 'nickname' => 2, 'password' => 3, 'mobile' => 4, 'email' => 5, 'avatar' => 6, 'mobile_active' => 7, 'email_active' => 8, 'third_party_platform_type' => 9, 'third_party_platform_account' => 10, 'registration_time' => 11, 'is_login' => 12, 'last_login' => 13, 'created_at' => 14, 'updated_at' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DepositMembersMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DepositMembersMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DepositMembersPeer::getTableMap();
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
		return str_replace(DepositMembersPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DepositMembersPeer::ID);

		$criteria->addSelectColumn(DepositMembersPeer::ACCOUNT);

		$criteria->addSelectColumn(DepositMembersPeer::NICKNAME);

		$criteria->addSelectColumn(DepositMembersPeer::PASSWORD);

		$criteria->addSelectColumn(DepositMembersPeer::MOBILE);

		$criteria->addSelectColumn(DepositMembersPeer::EMAIL);

		$criteria->addSelectColumn(DepositMembersPeer::AVATAR);

		$criteria->addSelectColumn(DepositMembersPeer::MOBILE_ACTIVE);

		$criteria->addSelectColumn(DepositMembersPeer::EMAIL_ACTIVE);

		$criteria->addSelectColumn(DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE);

		$criteria->addSelectColumn(DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT);

		$criteria->addSelectColumn(DepositMembersPeer::REGISTRATION_TIME);

		$criteria->addSelectColumn(DepositMembersPeer::IS_LOGIN);

		$criteria->addSelectColumn(DepositMembersPeer::LAST_LOGIN);

		$criteria->addSelectColumn(DepositMembersPeer::CREATED_AT);

		$criteria->addSelectColumn(DepositMembersPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(deposit_members.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT deposit_members.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DepositMembersPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DepositMembersPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DepositMembersPeer::doSelectRS($criteria, $con);
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
		$objects = DepositMembersPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DepositMembersPeer::populateObjects(DepositMembersPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DepositMembersPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DepositMembersPeer::getOMClass();
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
		return DepositMembersPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DepositMembersPeer::ID); 

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
			$comparison = $criteria->getComparison(DepositMembersPeer::ID);
			$selectCriteria->add(DepositMembersPeer::ID, $criteria->remove(DepositMembersPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DepositMembersPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DepositMembersPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DepositMembers) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DepositMembersPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DepositMembers $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DepositMembersPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DepositMembersPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DepositMembersPeer::DATABASE_NAME, DepositMembersPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DepositMembersPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DepositMembersPeer::DATABASE_NAME);

		$criteria->add(DepositMembersPeer::ID, $pk);


		$v = DepositMembersPeer::doSelect($criteria, $con);

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
			$criteria->add(DepositMembersPeer::ID, $pks, Criteria::IN);
			$objs = DepositMembersPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDepositMembersPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DepositMembersMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DepositMembersMapBuilder');
}
