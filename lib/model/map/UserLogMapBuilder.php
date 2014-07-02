<?php



class UserLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserLogMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('user_log');
		$tMap->setPhpName('UserLog');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('SF_GUARD_USER_ID', 'SfGuardUserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('IP_ADDRESS', 'IpAddress', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('MODULE', 'Module', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('ACTION', 'Action', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('OPERATION_DATA_ID', 'OperationDataId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 