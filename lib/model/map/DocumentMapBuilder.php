<?php



class DocumentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DocumentMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('document');
		$tMap->setPhpName('Document');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PROPRIETOR', 'Proprietor', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BLOCK_NUMBER', 'BlockNumber', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DOCUMENT_NUMBER', 'DocumentNumber', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('CONTRACT_NUMBER', 'ContractNumber', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ISSUE', 'Issue', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('MODIFIER', 'Modifier', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 