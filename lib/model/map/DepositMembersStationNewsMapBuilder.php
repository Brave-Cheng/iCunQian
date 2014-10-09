<?php



class DepositMembersStationNewsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositMembersStationNewsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_members_station_news');
		$tMap->setPhpName('DepositMembersStationNews');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_STATION_NEWS_ID', 'DepositStationNewsId', 'int' , CreoleTypes::INTEGER, 'deposit_station_news', 'ID', true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_MEMBERS_ID', 'DepositMembersId', 'int' , CreoleTypes::INTEGER, 'deposit_members', 'ID', true, null);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, true, '0', '1', '2');

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 