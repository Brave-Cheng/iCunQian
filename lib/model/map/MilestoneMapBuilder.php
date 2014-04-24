<?php



class MilestoneMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MilestoneMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('milestone');
		$tMap->setPhpName('Milestone');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PROJECT_ID', 'ProjectId', 'int', CreoleTypes::INTEGER, 'project', 'ID', true, null);

		$tMap->addColumn('IS_COMPLETED', 'IsCompleted', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_APPLY', 'IsApply', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DEADLINE', 'Deadline', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 