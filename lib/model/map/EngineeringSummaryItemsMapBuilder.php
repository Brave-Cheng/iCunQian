<?php



class EngineeringSummaryItemsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EngineeringSummaryItemsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('engineering_summary_items');
		$tMap->setPhpName('EngineeringSummaryItems');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ENGINEERING_SUMMARY_ID', 'EngineeringSummaryId', 'int', CreoleTypes::INTEGER, 'engineering_summary', 'ID', true, null);

		$tMap->addColumn('PROJECT_CONTENT', 'ProjectContent', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CONTRACT_QUANTITY', 'ContractQuantity', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('FLOAT_QUANTITY', 'FloatQuantity', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CURRENT_FINISH_AMOUNT', 'CurrentFinishAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('LAST_FINISH_AMOUNT', 'LastFinishAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('FINISH_AMOUNT', 'FinishAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('FINISH_PERCENT', 'FinishPercent', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 