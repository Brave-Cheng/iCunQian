<?php



class DepositRequestFinancialMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositRequestFinancialMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_request_financial');
		$tMap->setPhpName('DepositRequestFinancial');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('UNIQUE_KEY', 'UniqueKey', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('PROCESS_STATUS', 'ProcessStatus', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('SYNC_STATUS', 'SyncStatus', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 