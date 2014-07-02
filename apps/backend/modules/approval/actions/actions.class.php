<?php

/**
 * approval actions.
 *
 * @package    oa
 * @subpackage approval
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class approvalActions extends BaseBackends
{
    public function preExecute(){
        if($this->getUser()->getUsername() != 'admin'){
            return $this->forward404();
        }
    }
    /**
    * Executes index action
    *
    */
    public function executeIndex()
    {

    }

/**
 * executeApprovalList - Enter the approval type list
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeApprovalList(){
        $c = new Criteria();
        $c->addAscendingOrderByColumn( ApprovalPeer::ID );
        $this->approvals = ApprovalPeer::doSelect( $c );
    }

/**
 * executeAddApproval - Creating a new type approvals
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeAddApproval(){
        $this->approval = null;
        $this->setTemplate( 'editApproval' );
    }

/**
 * executeGetProjectRoles - Get all project roles
 * @return json
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeGetProjectRoles(){
        $projectRoles = ProjectRolePeer::getAllProjectRoles();
        $roles = array();
        foreach( $projectRoles as $projectRole ){
        	if($projectRole->getId() != ProjectRolePeer::CUSTOME_ROLE){
                $roles[$projectRole->getId()] = $projectRole->getName();
        	}
        }
        exit(json_encode($roles));
    }

/**
 * executeGetDepartmentNames - Get all department name
 * @return json
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeGetDepartmentNames(){
        $departments = DepartmentPeer::getAllDepartments();
        $departmentArray = array();
        $departmentArray[0] = '请选择部门';
        foreach( $departments as $department ){
            $departmentArray[$department->getId()] = $department->getName();
        }
        exit(json_encode($departmentArray));
    }

/**
 * executeGetDepartmentNames - Get all title name
 * @return json
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeGetTitleNames(){
        $titles = TitlePeer::getAllTitles();
        $titleArray = array();
        foreach( $titles as $title ){
            $titleArray[$title->getId()] = $title->getName();
        }
        exit(json_encode($titleArray));
    }

/**
 * executeEdit - Editing approval
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeEditApproval(){
        $this->approval = ApprovalPeer::retrieveByPK( $this->getRequestParameter( 'id' ) );
        if(!$this->approval){
            $this->approval = null;
        }
    }

/**
 * executeUpdateApproval - Update approval
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeUpdateApproval(){
        if( $this->getRequestParameter( 'approval_id' ) ){
            $approval = ApprovalPeer::retrieveByPK( $this->getRequestParameter( 'approval_id' ) );
        }else{
            $approval = new Approval();
        }
        $approval->setName( $this->getRequestParameter( 'name' ) );
        $approval->save();
        return $this->redirect('approval/approvalList?msg=3&id=' . $approval->getId());
    }

/**
 * executeWorkflowList - Approval of the list of steps
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeWorkflowList(){
        $this->approval = ApprovalPeer::retrieveByPK( $this->getRequestParameter( 'id' ) );
        $this->forward404Unless( $this->approval );
    }

/**
 * executeAddWorkflow - Add approval step
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeAddWorkflow(){
        $this->approval = ApprovalPeer::retrieveByPK( $this->getRequestParameter('approvalId') );
        $this->forward404Unless( $this->approval );
        $this->workflow = null;
        $this->setTemplate( 'editWorkflow' );
    }

/**
 * executeEditWorkflow - Editing an approval step
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeEditWorkflow(){
        $this->approval = ApprovalPeer::retrieveByPK( $this->getRequestParameter('approvalId') );
        $this->forward404Unless( $this->approval );
        $this->workflow = WorkflowPeer::retrieveByPK( $this->getRequestParameter( 'workflowId' ) );
        if( !$this->workflow ){
            $this->workflow = null;
        }
    }

/**
 * executeUpdateWorkflow - Update approval step
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeUpdateWorkflow(){
        //var_dump( $this->getRequestParameter('approvalId') );exit;
        if( $this->getRequestParameter('workflowId') ){
            $workflow = WorkflowPeer::retrieveByPK( $this->getRequestParameter('workflowId') );
            if( $this->getRequestParameter('is_project_role') == '1' ){
                $workflow->setDepartmentId( null );
                $workflow->setTitle( null );
                $workflow->setProjectRoleId( $this->getRequestParameter('project_role_id') );
            }
            if( $this->getRequestParameter('is_project_role') == '0' ){
                $workflow->setProjectRoleId( null );
                $workflow->setDepartmentId( $this->getRequestParameter('departmentId') );
                $workflow->setTitleId( $this->getRequestParameter('titleId') );
            }
            $workflow->save();
        }else{
            $workflow = new Workflow();
            if( $this->getRequestParameter('is_project_role') == '1' ){
                $workflow->setProjectRoleId( $this->getRequestParameter('project_role_id') );
            }
            if( $this->getRequestParameter('is_project_role') == '0' ){
                $workflow->setDepartmentId( $this->getRequestParameter('departmentId') );
                $workflow->setTitleId( $this->getRequestParameter('titleId') );
            }
        }
        $workflow->setApprovalId( $this->getRequestParameter('approvalId') );
        $workflow->setSortOrder( $this->getRequestParameter('sortOrder') );
        $workflow->setDescription( $this->getRequestParameter('description') );
        $workflow->setIsProjectRole( $this->getRequestParameter('is_project_role') );
        $workflow->save();
        return $this->redirect( 'approval/workflowList?msg=3&stepId=' . $workflow->getId() . '&id=' . $this->getRequestParameter('approvalId'));
    }
/**
 * executeDeleteApproval - Remove Approvals
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeDeleteApproval(){
        $approvals = ApprovalPeer::retrieveByPKs( $this->getRequestParameter( 'deleteId' ) );
        if( !empty($approvals) ){
            foreach( $approvals as $approval ){
                if( $approval ){
                    $approval->delete();
                }
            }
            return $this->redirect( 'approval/approvalList?msg=1');
        }
        return $this->redirect( 'approval/approvalList?msg=0');
    }

/**
 * executeDeleteWorkflow - Delete approval step
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2322 Approval Process Management
 */
    public function executeDeleteWorkflow(){
        $workflows = WorkflowPeer::retrieveByPKs( $this->getRequestParameter( 'deleteId' ) );
        if(!empty($workflows)){
            foreach( $workflows as $workflow ){
                if( $workflow ){
                    $workflow->delete();
                }
            }
            return $this->redirect( 'approval/workflowList?msg=1&id=' . $this->getRequestParameter( 'approvalId' ) );
        }
        return $this->redirect( 'approval/workflowList?msg=0&id=' . $this->getRequestParameter( 'approvalId' ) );
    }

/**
 * validateUpdateWorkflow - Update approval step verification
 * @return true or false - Verified through returns true, false otherwise
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @modified : ice.leng
 * @issue 2322 Approval Process Management
 */
    public function validateUpdateWorkflow(){
        $approvalId = $this->getRequestParameter('approvalId');
        $sortOrder = $this->getRequestParameter('sortOrder');
        $c = new Criteria();
        $c->add(WorkflowPeer::APPROVAL_ID, $approvalId);
        $c->add(WorkflowPeer::SORT_ORDER, $sortOrder);
        $workFlow = WorkflowPeer::doSelectOne($c);
        //edit data
        $workflowId = $this->getRequestParameter('workflowId');
        $workFlowObj = WorkflowPeer::retrieveByPK($workflowId);
        $currentSortOrder = $workFlowObj ? $workFlowObj->getSortOrder() : '';
        if($workFlow && $currentSortOrder != $sortOrder){
            $this->getRequest()->setError( 'sortOrder', '当前步骤已存在' );
            return false;
        }
        return true;
    }

    public function executeApprovalLeaveCheck(){
        $isModified = false;
        $approval = ApprovalPeer::retrieveByPK( $this->getRequestParameter( 'approval_id' ) );
        if($approval){
            $approval->setName( $this->getRequestParameter( 'name' ) );
            if($approval->isModified()){
                $isModified = true;
            }
        }
        else{
            if($this->getRequestParameter('name') != ""){
                $isModified = true;
            }
        }
        echo $isModified ? '1' : '0';
        exit;
    }

    public function executeWorkflowLeaveCheck(){
        $isModified = false;
        $workflow = WorkflowPeer::retrieveByPK( $this->getRequestParameter('workflowId') );
        if($workflow){
            if( $this->getRequestParameter('is_project_role') == '1' ){
                $workflow->setDepartmentId( null );
                $workflow->setTitle( null );
                $workflow->setProjectRoleId( $this->getRequestParameter('project_role_id') );
            }
            if( $this->getRequestParameter('is_project_role') == '0' ){
                $workflow->setProjectRoleId( null );
                $workflow->setDepartmentId( $this->getRequestParameter('departmentId') );
                $workflow->setTitleId( $this->getRequestParameter('titleId') );
            }
            $workflow->setApprovalId( $this->getRequestParameter('approvalId') );
            $workflow->setSortOrder( $this->getRequestParameter('sortOrder') );
            $workflow->setDescription( $this->getRequestParameter('description') );
            $workflow->setIsProjectRole( $this->getRequestParameter('is_project_role') );
            if($workflow->isModified()){
                $isModified = true;
            }
        }else{
            if($this->getRequestParameter('is_project_role') != "" || $this->getRequestParameter('sortOrder') != "" || $this->getRequestParameter('description') != "" ){
                $isModified = true;
            }
        }
        echo $isModified ? '1' : '0';
        exit;
    }

    public function handleErrorUpdateApproval(){
        return $this->forward('approval','editApproval');
    }

    public function handleErrorUpdateWorkflow(){
        return $this->forward('approval','editWorkflow');
    }
}
