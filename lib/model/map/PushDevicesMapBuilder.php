<?php



class PushDevicesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PushDevicesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('push_devices');
		$tMap->setPhpName('PushDevices');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CLIENT_ID', 'ClientId', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('APP_NAME', 'AppName', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('APP_VERSION', 'AppVersion', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('DEVICE_UID', 'DeviceUid', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DEVICE_NAME', 'DeviceName', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DEVICE_MODEL', 'DeviceModel', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('DEVICE_VERSION', 'DeviceVersion', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('DEVICE_TOKEN', 'DeviceToken', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DEVELOPMENT', 'Development', 'string', CreoleTypes::VARCHAR, true, 'production', 'sandbox');

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, false, 'active', 'unregistered');

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 