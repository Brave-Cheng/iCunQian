<?php



class EngineeringMaterialsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EngineeringMaterialsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('engineering_materials');
		$tMap->setPhpName('EngineeringMaterials');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('APPLICATION_ID', 'ApplicationId', 'int', CreoleTypes::INTEGER, 'application', 'ID', true, null);

		$tMap->addColumn('CONTRACT_SECTION', 'ContractSection', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NUMBER', 'Number', 'string', CreoleTypes::VARCHAR, false, 120);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 