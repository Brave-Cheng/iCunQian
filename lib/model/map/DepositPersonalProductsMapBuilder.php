<?php



class DepositPersonalProductsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositPersonalProductsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_personal_products');
		$tMap->setPhpName('DepositPersonalProducts');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_FINANCIAL_PRODUCTS_ID', 'DepositFinancialProductsId', 'int' , CreoleTypes::INTEGER, 'deposit_financial_products', 'ID', true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_MEMBERS_ID', 'DepositMembersId', 'int' , CreoleTypes::INTEGER, 'deposit_members', 'ID', true, null);

		$tMap->addColumn('EXPECTED_RATE', 'ExpectedRate', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('AMOUNT', 'Amount', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('BUY_DATE', 'BuyDate', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('EXPIRY_DATE', 'ExpiryDate', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('IS_VALID', 'IsValid', 'string', CreoleTypes::VARCHAR, true, 'yes','no');

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 