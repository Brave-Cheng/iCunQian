<?php



class sfGuardUserProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.sfGuardUserProfileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_guard_user_profile');
		$tMap->setPhpName('sfGuardUserProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('CHINESE_NAME', 'ChineseName', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('ENGLISH_NAME', 'EnglishName', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('GENDER', 'Gender', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('TELEPHONE', 'Telephone', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('QQ', 'Qq', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 