<?php



class PushMessagesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PushMessagesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('push_messages');
		$tMap->setPhpName('PushMessages');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_MEMBERS_ID', 'DepositMembersId', 'int' , CreoleTypes::INTEGER, 'deposit_members', 'ID', true, null);

		$tMap->addForeignPrimaryKey('DEPOSIT_FINANCIAL_PRODUCTS_ID', 'DepositFinancialProductsId', 'int' , CreoleTypes::INTEGER, 'deposit_financial_products', 'ID', true, null);

		$tMap->addColumn('MESSAGE', 'Message', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DELIVERY', 'Delivery', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, true, 'queued', 'delivered', 'failed');

		$tMap->addColumn('ERROR_MESSAGE', 'ErrorMessage', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 