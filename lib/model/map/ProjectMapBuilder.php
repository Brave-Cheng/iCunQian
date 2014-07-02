<?php



class ProjectMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ProjectMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('project');
		$tMap->setPhpName('Project');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('PHASE', 'Phase', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LONG_NAME', 'LongName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PROPRIETOR', 'Proprietor', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('START_DATE', 'StartDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('END_DATE', 'EndDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('IS_BUY_THE_TENDER_DOCUMENT', 'IsBuyTheTenderDocument', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('TENDER_DOCUMENT_PRICE', 'TenderDocumentPrice', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('TENDERING_STATUS', 'TenderingStatus', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BLOCK_NUMBER', 'BlockNumber', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_PROJECT_END', 'IsProjectEnd', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('PROJECT_END_COMMENT', 'ProjectEndComment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MODIFIER', 'Modifier', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATOR', 'Creator', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 