<?php



class DepositAttributesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositAttributesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_attributes');
		$tMap->setPhpName('DepositAttributes');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('VALUE', 'Value', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('SYNC_STATUS', 'SyncStatus', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 