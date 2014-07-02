<?php



class ApplicationWorkFlowMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ApplicationWorkFlowMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('application_work_flow');
		$tMap->setPhpName('ApplicationWorkFlow');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('APPLICATION_ID', 'ApplicationId', 'int', CreoleTypes::INTEGER, 'application', 'ID', true, null);

		$tMap->addForeignKey('WORKFLOW_ID', 'WorkflowId', 'int', CreoleTypes::INTEGER, 'workflow', 'ID', true, null);

		$tMap->addForeignKey('SF_GUARD_USER_ID', 'SfGuardUserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('APPROVAL_RESULT', 'ApprovalResult', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('APPROVAL_COMMENT', 'ApprovalComment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('APPROVAL_TIME', 'ApprovalTime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 