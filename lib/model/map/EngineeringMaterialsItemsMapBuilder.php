<?php



class EngineeringMaterialsItemsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EngineeringMaterialsItemsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('engineering_materials_items');
		$tMap->setPhpName('EngineeringMaterialsItems');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ENGINEERING_MATERIALS_ID', 'EngineeringMaterialsId', 'int', CreoleTypes::INTEGER, 'engineering_materials', 'ID', true, null);

		$tMap->addColumn('MATERIAL_NAME', 'MaterialName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BRAND', 'Brand', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TECHNICAL_REQUIREMENT', 'TechnicalRequirement', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('UNIT', 'Unit', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('QUANTITY', 'Quantity', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ARRIVAL_DATE', 'ArrivalDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('ARRIVAL_PLACE', 'ArrivalPlace', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 