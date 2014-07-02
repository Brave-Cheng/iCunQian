<?php



class EngineeringSettlementMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EngineeringSettlementMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('engineering_settlement');
		$tMap->setPhpName('EngineeringSettlement');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('APPLICATION_ID', 'ApplicationId', 'int', CreoleTypes::INTEGER, 'application', 'ID', true, null);

		$tMap->addColumn('CONTRACT_NUMBER', 'ContractNumber', 'string', CreoleTypes::VARCHAR, false, 120);

		$tMap->addColumn('CONSTRUCTION_UNIT', 'ConstructionUnit', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EXPIRATION_DATE', 'ExpirationDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('ISSUE', 'Issue', 'string', CreoleTypes::VARCHAR, false, 120);

		$tMap->addColumn('CONTRACT_AMOUNT', 'ContractAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('CHANGE_AMOUNT', 'ChangeAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('CHANGED_AMOUNT', 'ChangedAmount', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('CURRENT_COMPLETE_ENGINEERING', 'CurrentCompleteEngineering', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CURRENT_FASTENER_RETENTION', 'CurrentFastenerRetention', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('CURRENT_PAYABLE', 'CurrentPayable', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('TOTAL_COMPLETE_ENGINEERING', 'TotalCompleteEngineering', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TOTAL_FASTENER_RETENTION', 'TotalFastenerRetention', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('TOTAL_PAYABLE', 'TotalPayable', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('PREPAYMENT', 'Prepayment', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('APPLY_PAYMENT', 'ApplyPayment', 'double', CreoleTypes::DECIMAL, false, 16);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 