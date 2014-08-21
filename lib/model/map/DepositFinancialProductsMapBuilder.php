<?php



class DepositFinancialProductsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositFinancialProductsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_financial_products');
		$tMap->setPhpName('DepositFinancialProducts');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('BANK_NAME', 'BankName', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('BANK_ID', 'BankId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('REGION', 'Region', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('PROFIT_TYPE', 'ProfitType', 'string', CreoleTypes::VARCHAR, true, 48);

		$tMap->addColumn('CURRENCY', 'Currency', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('INVEST_CYCLE', 'InvestCycle', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('TARGET', 'Target', 'string', CreoleTypes::VARCHAR, true, 128);

		$tMap->addColumn('SALE_START_DATE', 'SaleStartDate', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('SALE_END_DATE', 'SaleEndDate', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('PROFIT_START_DATE', 'ProfitStartDate', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('DEADLINE', 'Deadline', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('PAY_PERIOD', 'PayPeriod', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('EXPECTED_RATE', 'ExpectedRate', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('ACTUAL_RATE', 'ActualRate', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('INVEST_START_AMOUNT', 'InvestStartAmount', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('INVEST_INCREASE_AMOUNT', 'InvestIncreaseAmount', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('PROFIT_DESC', 'ProfitDesc', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INVEST_SCOPE', 'InvestScope', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('STOP_CONDITION', 'StopCondition', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RAISE_CONDITION', 'RaiseCondition', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PURCHASE', 'Purchase', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COST', 'Cost', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FEATURE', 'Feature', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('EVENTS', 'Events', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('WARNINGS', 'Warnings', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ANNOUNCE', 'Announce', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('SYNC_STATUS', 'SyncStatus', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 