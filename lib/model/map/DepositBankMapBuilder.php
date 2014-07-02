<?php



class DepositBankMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositBankMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_bank');
		$tMap->setPhpName('DepositBank');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('SHORT_NAME', 'ShortName', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('SHORT_CHAR', 'ShortChar', 'string', CreoleTypes::VARCHAR, true, 16);

		$tMap->addColumn('PHONE', 'Phone', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('LOGO', 'Logo', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('IS_VALID', 'IsValid', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('SYNC_STATUS', 'SyncStatus', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 