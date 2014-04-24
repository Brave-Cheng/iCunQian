<?php



class MonitoringAddressMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MonitoringAddressMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('monitoring_address');
		$tMap->setPhpName('MonitoringAddress');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('COUNTY_ID', 'CountyId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OFFICE_OF_THE_COMPANY_NAME', 'OfficeOfTheCompanyName', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('ADDRESS', 'Address', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 