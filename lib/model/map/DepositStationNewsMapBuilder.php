<?php



class DepositStationNewsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositStationNewsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_station_news');
		$tMap->setPhpName('DepositStationNews');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CONTENT', 'Content', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('SEND_TIME', 'SendTime', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::VARCHAR, true, 16);

		$tMap->addColumn('DEPOSIT_FINANCIAL_PRODUCTS_ID', 'DepositFinancialProductsId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 