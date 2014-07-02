<?php



class MonitorMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MonitorMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('monitor');
		$tMap->setPhpName('Monitor');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('MONITORING_ADDRESS_ID', 'MonitoringAddressId', 'int', CreoleTypes::INTEGER, 'monitoring_address', 'ID', false, null);

		$tMap->addColumn('IP', 'Ip', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 