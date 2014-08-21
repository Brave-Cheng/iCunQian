<?php



class DepositFeedbackMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositFeedbackMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_feedback');
		$tMap->setPhpName('DepositFeedback');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('DEPOSIT_MEMBERS_ID', 'DepositMembersId', 'int', CreoleTypes::INTEGER, 'deposit_members', 'ID', true, null);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('CONTENT', 'Content', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('MAIL_SEND_STATUS', 'MailSendStatus', 'string', CreoleTypes::VARCHAR, true, 'yes', 'no');

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 