<?php



class WorkflowMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WorkflowMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('workflow');
		$tMap->setPhpName('Workflow');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('APPROVAL_ID', 'ApprovalId', 'int', CreoleTypes::INTEGER, 'approval', 'ID', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_PROJECT_ROLE', 'IsProjectRole', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addForeignKey('PROJECT_ROLE_ID', 'ProjectRoleId', 'int', CreoleTypes::INTEGER, 'project_role', 'ID', false, null);

		$tMap->addForeignKey('DEPARTMENT_ID', 'DepartmentId', 'int', CreoleTypes::INTEGER, 'department', 'ID', false, null);

		$tMap->addForeignKey('TITLE_ID', 'TitleId', 'int', CreoleTypes::INTEGER, 'title', 'ID', false, null);

		$tMap->addColumn('SORT_ORDER', 'SortOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_VALID', 'IsValid', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 