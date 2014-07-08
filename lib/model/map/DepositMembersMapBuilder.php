<?php



class DepositMembersMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositMembersMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_members');
		$tMap->setPhpName('DepositMembers');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('ACCOUNT', 'Account', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('NICKNAME', 'Nickname', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('MOBILE', 'Mobile', 'string', CreoleTypes::VARCHAR, true, 12);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('AVATAR', 'Avatar', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('MOBILE_ACTIVE', 'MobileActive', 'string', CreoleTypes::VARCHAR, true, 'yes','no');

		$tMap->addColumn('EMAIL_ACTIVE', 'EmailActive', 'string', CreoleTypes::VARCHAR, true, 'yes','no');

		$tMap->addColumn('THIRD_PARTY_PLATFORM_TYPE', 'ThirdPartyPlatformType', 'string', CreoleTypes::VARCHAR, true, 'qq','tencert_weibo','weibo', 'weixin', 'null');

		$tMap->addColumn('THIRD_PARTY_PLATFORM_ACCOUNT', 'ThirdPartyPlatformAccount', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('REGISTRATION_TIME', 'RegistrationTime', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('IS_LOGIN', 'IsLogin', 'string', CreoleTypes::VARCHAR, true, 'yes','no');

		$tMap->addColumn('LAST_LOGIN', 'LastLogin', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 