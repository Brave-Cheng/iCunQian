<?php



class DepositMembersDeviceMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositMembersDeviceMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_members_device');
		$tMap->setPhpName('DepositMembersDevice');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TOKEN', 'Token', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addForeignKey('DEPOSIT_MEMBERS_ID', 'DepositMembersId', 'int', CreoleTypes::INTEGER, 'deposit_members', 'ID', true, null);

		$tMap->addColumn('IS_VALID', 'IsValid', 'string', CreoleTypes::VARCHAR, true, 'yes', 'no');

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 