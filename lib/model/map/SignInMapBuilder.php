<?php



class SignInMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SignInMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sign_in');
		$tMap->setPhpName('SignIn');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PROJECT_ID', 'ProjectId', 'int', CreoleTypes::INTEGER, 'project', 'ID', true, null);

		$tMap->addForeignKey('SF_GUARD_USER_ID', 'SfGuardUserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('ADDRESS', 'Address', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SIGN_IN_TIME', 'SignInTime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LONGITUDE', 'Longitude', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('LATTITUDE', 'Lattitude', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 