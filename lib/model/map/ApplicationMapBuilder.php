<?php



class ApplicationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ApplicationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('application');
		$tMap->setPhpName('Application');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('APPROVAL_ID', 'ApprovalId', 'int', CreoleTypes::INTEGER, 'approval', 'ID', true, null);

		$tMap->addForeignKey('SF_GUARD_USER_ID', 'SfGuardUserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addForeignKey('PROJECT_ID', 'ProjectId', 'int', CreoleTypes::INTEGER, 'project', 'ID', true, null);

		$tMap->addForeignKey('DEPARTMENT_ID', 'DepartmentId', 'int', CreoleTypes::INTEGER, 'department', 'ID', true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ATTACHMENT', 'Attachment', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CURRENT_STATUS', 'CurrentStatus', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('IS_VALID', 'IsValid', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 