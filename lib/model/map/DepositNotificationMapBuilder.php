<?php



class DepositNotificationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DepositNotificationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('deposit_notification');
		$tMap->setPhpName('DepositNotification');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOTIFICATION_TYPE', 'NotificationType', 'string', CreoleTypes::VARCHAR, true, 'email','sms');

		$tMap->addColumn('NOTIFICATION_TYPE_ACCOUNT', 'NotificationTypeAccount', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('CONTENT', 'Content', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('NOTIFICATION_STATUS', 'NotificationStatus', 'string', CreoleTypes::VARCHAR, true, 'queued','delivered','failed');

		$tMap->addColumn('DELIVERED_TIME', 'DeliveredTime', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('ERROR_MESSAGE', 'ErrorMessage', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 