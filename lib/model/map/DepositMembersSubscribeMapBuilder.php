<?php



class DepositMembersSubscribeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositMembersSubscribeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_members_subscribe');
		$tMap->setPhpName('DepositMembersSubscribe');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_MEMBERS_ID', 'DepositMembersId', 'int' , CreoleTypes::INTEGER, 'deposit_members', 'ID', true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_BANK_ID', 'DepositBankId', 'int' , CreoleTypes::INTEGER, 'deposit_bank', 'ID', true, null);

		$tMap->addColumn('CITY', 'City', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('PROFIT_TYPE', 'ProfitType', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('EXPECTED_RATE', 'ExpectedRate', 'double', CreoleTypes::DECIMAL, true, null);

		$tMap->addColumn('INVEST_CYCLE', 'InvestCycle', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('IS_VALID', 'IsValid', 'string', CreoleTypes::VARCHAR, true, 'yes', 'no');

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 