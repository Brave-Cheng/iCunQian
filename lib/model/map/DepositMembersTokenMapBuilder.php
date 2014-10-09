<?php



class DepositMembersTokenMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositMembersTokenMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_members_token');
		$tMap->setPhpName('DepositMembersToken');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_MEMBERS_ID', 'DepositMembersId', 'int' , CreoleTypes::INTEGER, 'deposit_members', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PUSH_DEVICES_ID', 'PushDevicesId', 'int' , CreoleTypes::INTEGER, 'push_devices', 'ID', true, null);

		$tMap->addColumn('IS_VALID', 'IsValid', 'string', CreoleTypes::VARCHAR, true, 'yes', 'no');

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 