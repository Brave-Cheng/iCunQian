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

		$tMap->addForeignKey('REQUEST_FINANCIAL_ID', 'RequestFinancialId', 'int', CreoleTypes::INTEGER, 'deposit_request_financial', 'ID', true, null);

		$tMap->addForeignKey('BANK_ID', 'BankId', 'int', CreoleTypes::INTEGER, 'deposit_bank', 'ID', true, null);

		$tMap->addForeignKey('REGION_ID', 'RegionId', 'string', CreoleTypes::VARCHAR, 'deposit_region', 'ID', true, 100);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PROFIT_TYPE', 'ProfitType', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('PRODUCT_TYPE', 'ProductType', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CURRENCY', 'Currency', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('INVEST_CYCLE', 'InvestCycle', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('TARGET', 'Target', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('SALE_START_DATE', 'SaleStartDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('SALE_END_DATE', 'SaleEndDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('PROFIT_START_DATE', 'ProfitStartDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('DEADLINE', 'Deadline', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('PAY_PERIOD', 'PayPeriod', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('EXPECTED_RATE', 'ExpectedRate', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ACTUAL_RATE', 'ActualRate', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('INVEST_START_AMOUNT', 'InvestStartAmount', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('INVERT_INCREASE_AMOUNT', 'InvertIncreaseAmount', 'double', CreoleTypes::FLOAT, false, null);

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

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 