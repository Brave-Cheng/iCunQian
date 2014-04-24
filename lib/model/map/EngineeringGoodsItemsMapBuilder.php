<?php



class EngineeringGoodsItemsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EngineeringGoodsItemsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('engineering_goods_items');
		$tMap->setPhpName('EngineeringGoodsItems');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ENGINEERING_GOODS_ID', 'EngineeringGoodsId', 'int', CreoleTypes::INTEGER, 'engineering_goods', 'ID', true, null);

		$tMap->addColumn('PROJECT_NAME', 'ProjectName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BRAND', 'Brand', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('REQUIREMENT', 'Requirement', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('UNIT', 'Unit', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('QUANTITY', 'Quantity', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 