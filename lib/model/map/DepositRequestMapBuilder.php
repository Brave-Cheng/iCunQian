<?php



class DepositRequestMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositRequestMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_request');
		$tMap->setPhpName('DepositRequest');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PAGE', 'Page', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('UNIQUE_KEYS', 'UniqueKeys', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ENCRYPT', 'Encrypt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('IS_PROCESS', 'IsProcess', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('REQUEST_NUMBER', 'RequestNumber', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 