<?php



class DepostMembersSettingsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepostMembersSettingsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('depost_members_settings');
		$tMap->setPhpName('DepostMembersSettings');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('DEPOSIT_MEMBERS_ID', 'DepositMembersId', 'int', CreoleTypes::INTEGER, 'deposit_members', 'ID', true, null);

		$tMap->addColumn('DEADLINE_REMINDER', 'DeadlineReminder', 'string', CreoleTypes::VARCHAR, true, 'yes', 'no');

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 