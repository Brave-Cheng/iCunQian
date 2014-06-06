<?php



class ApiLoginInformationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ApiLoginInformationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('api_login_information');
		$tMap->setPhpName('ApiLoginInformation');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CODE', 'Code', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('API_KEY', 'ApiKey', 'string', CreoleTypes::CHAR, false, 40);

		$tMap->addColumn('TOKEN', 'Token', 'string', CreoleTypes::CHAR, false, 40);

		$tMap->addColumn('REQUEST_IP', 'RequestIp', 'string', CreoleTypes::CHAR, false, 15);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 