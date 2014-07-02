<?php



class SmsQueueMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SmsQueueMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sms_queue');
		$tMap->setPhpName('SmsQueue');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('NOTIFICATION_ID', 'NotificationId', 'int', CreoleTypes::INTEGER, 'notification', 'ID', true, null);

		$tMap->addColumn('RECEIVER', 'Receiver', 'string', CreoleTypes::VARCHAR, true, 15);

		$tMap->addColumn('UNIQUE_KEY', 'UniqueKey', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('MESSAGE_CONTENT', 'MessageContent', 'string', CreoleTypes::VARCHAR, true, 200);

		$tMap->addColumn('ADDITIONAL_INFORMATION', 'AdditionalInformation', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('SEND_TIMES', 'SendTimes', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LAST_SEND_AT', 'LastSendAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 