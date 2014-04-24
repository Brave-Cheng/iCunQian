<?php



class EngineeringSummaryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EngineeringSummaryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('engineering_summary');
		$tMap->setPhpName('EngineeringSummary');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('APPLICATION_ID', 'ApplicationId', 'int', CreoleTypes::INTEGER, 'application', 'ID', true, null);

		$tMap->addColumn('TOTAL_CURRENT_FINISH_AMOUNT', 'TotalCurrentFinishAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('TOTAL_LAST_FINISH_AMOUNT', 'TotalLastFinishAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('TOTAL_FINISH_AMOUNT', 'TotalFinishAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('CONSTRUCTION_UNIT', 'ConstructionUnit', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CONTRACT_NUMBER', 'ContractNumber', 'string', CreoleTypes::VARCHAR, false, 120);

		$tMap->addColumn('ISSUE', 'Issue', 'string', CreoleTypes::VARCHAR, false, 120);

		$tMap->addColumn('EXPIRATION_DATE', 'ExpirationDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('AMOUNT', 'Amount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 