<?php

/**
 * engineeringSettlement actions.
 *
 * @package    oa
 * @subpackage engineeringSettlement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class engineeringSettlementActions extends BaseBackends
{
    public function preExecute() {
        parent::preExecute();
    }
  /**
   * Executes index action
   *
   */
    public function executeIndex()
    {
        $this->forward('default', 'module');
    }

/**
 * executeAdd - Visit adding pages
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2380
 */
    public function executeAdd(){
        if($this->getUser()->getGuardUser()->getUsername() == 'admin')$this->redirect('dashboard/index');
        $this->userProjects = ProjectPeer::getUserCreateAndBelongProjects($this->getUser()->getGuardUser()->getId());
        $this->engineeringSettlement = null;
        $this->application = null;
        $this->setLayout('layoutWithoutSideBar');
        $this->setTemplate('edit');
    }

/**
 * executeEdit - Visit the edit page
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2380
 */
    public function executeEdit(){
        $application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
        if($application && $application->getSfGuardUserId() != $this->getUser()->getGuardUser()->getId()) $this->redirect('dashboard/index');
        $this->userProjects = ProjectPeer::getUserCreateAndBelongProjects($this->getUser()->getGuardUser()->getId());
        $c = new Criteria();
        $c->add(EngineeringSettlementPeer::APPLICATION_ID, $this->getRequestParameter('id'));
        $this->engineeringSettlement = EngineeringSettlementPeer::doSelectOne($c);
        $this->application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->getRequest()->setParameter('approvalType', $this->application->getApproval()->getId());
        $this->setLayout('layoutWithoutSideBar');
    }

/**
 * executeRead - Access to read the page
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2380
 */
    public function executeRead(){
        if(!ApplicationWorkFlowPeer::isBelongApplication($this->getUser()->getGuardUser(), $this->getRequestParameter('id'))) $this->redirect('dashboard/index');
        $c = new Criteria();
        $c->add(EngineeringSettlementPeer::APPLICATION_ID, $this->getRequestParameter('id'));
        $this->engineeringSettlement = EngineeringSettlementPeer::doSelectOne($c);
        $this->application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
        if ($this->application->getIsValid() == 1) {
            $this->forward404();
        }
        $this->forward404Unless($this->engineeringSettlement);
        $this->forward404Unless($this->application);
        $this->applicationResults = ApplicationWorkFlowPeer::getApplicationResults((int)$this->getRequestParameter('id'));
        $this->setLayout('layoutWithoutSideBar');
    }

    public function executePrint(){
        $c = new Criteria();
        $c->add(EngineeringSettlementPeer::APPLICATION_ID, $this->getRequestParameter('id'));
        $this->engineeringSettlement = EngineeringSettlementPeer::doSelectOne($c);
        $this->application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->forward404Unless($this->engineeringSettlement);
        $this->forward404Unless($this->application);
        $this->applicationResults = ApplicationWorkFlowPeer::getApplicationResults($this->getRequestParameter('id'));
        $this->setLayout('layoutPrint');
    }
    
/**
 * executeUpdate - Update data
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2380
 */
    public function executeUpdate(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $this->_handleApplication();
            $this->application->save();
            $this->_handleEngineeringSettlement();
            $this->engineeringSettlement->save();
            $this->setFlash('msg', 1);
            //commit approval
            $approver = Approver::createApprover();
            $approver->setApplication($this->application);
            $approver->setWorkflow(WorkflowPeer::getFirstApproval($this->application->getApprovalId()));
            try{
                $approver->commitFirstApproval();
            }catch(Exception $e){
                
            }
            return $this->redirect('engineeringSettlement/edit?id=' . $this->application->getId() . '&' .html_entity_decode(util::formGetQuery('projectType', 'keywords', "approvalType")) );
        }else{
            $this->forward404();
        }
    }
/**
 * _handleApplication - Update application table
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2380
 */
    public function _handleApplication(){
        $project = ProjectPeer::retrieveByPK( $this->getRequestParameter('project_id') );
        $approval = ApprovalPeer::retrieveByPK( $this->getRequestParameter('approvalType'));
        $this->application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
        if(!$this->application){
            $this->application = new Application();
        }
        $this->application->setApprovalId($this->getRequestParameter('approvalType'));
        $this->application->setSfGuardUserId($this->getUser()->getUserId());
        $this->application->setProjectId( $this->getRequestParameter('project_id') );
        $this->application->setName( $project->getName() . $approval->getName() );
        $this->application->setDescription('');
        $this->application->setAttachment('');
        $this->application->setCurrentStatus(0);
        return $this->application->isModified();
    }

/**
 * _handleEngineeringSettlement - Updated engineering statement
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2380
 */
    public function _handleEngineeringSettlement(){
        if(!$this->application){
            $this->application = ApplicationPeer::retrieveByPK( $this->getRequestParameter('id') );
        }
        $this->engineeringSettlement = EngineeringSettlementPeer::retrieveByPK($this->getRequestParameter('engineeringSettlementId'));
        if(!$this->engineeringSettlement){
            $this->engineeringSettlement = new EngineeringSettlement();
        }
        $this->engineeringSettlement->setApplicationId($this->application->getId());
        $this->engineeringSettlement->setContractNumber($this->getRequestParameter('contract_number'));
        $this->engineeringSettlement->setConstructionUnit($this->getRequestParameter('construction_unit'));
        $this->engineeringSettlement->setExpirationDate($this->getRequestParameter('expiration_date'));
        $this->engineeringSettlement->setIssue($this->getRequestParameter('issue'));
        $this->engineeringSettlement->setContractAmount( (float)$this->getRequestParameter('contract_amount') );
        $this->engineeringSettlement->setChangeAmount( (float)$this->getRequestParameter('change_amount') );
        $this->engineeringSettlement->setChangedAmount( (float)$this->getRequestParameter('changed_amount') );
        $this->engineeringSettlement->setCurrentCompleteEngineering($this->getRequestParameter('current_complete_engineering'));
        $this->engineeringSettlement->setCurrentFastenerRetention( (float)$this->getRequestParameter('current_fastener_retention') );
        $this->engineeringSettlement->setCurrentPayable( (float)$this->getRequestParameter('current_payable') );
        $this->engineeringSettlement->setTotalCompleteEngineering($this->getRequestParameter('total_complete_engineering'));
        $this->engineeringSettlement->setTotalFastenerRetention((float)$this->getRequestParameter('total_fastener_retention') );
        $this->engineeringSettlement->setTotalPayable( (float)$this->getRequestParameter('total_payable') );
        $this->engineeringSettlement->setPrepayment( (float)$this->getRequestParameter('prepayment') );
        $this->engineeringSettlement->setApplyPayment( (float)$this->getRequestParameter('apply_payment') );
        return $this->engineeringSettlement->isModified();
    }

/**
 * validateUpdate - Updated data validation
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2380
 */
    public function validateUpdate(){
        $parttenDecimals = "/^(\d){0,11}\.{0,1}(\d{1,4})?$/";
        if(!preg_match($parttenDecimals, $this->getRequestParameter('contract_amount'))){
            $this->getRequest()->setError( 'contract_amount', '最多四位小数或者整数超过11位' );
            return false;
        }
        if(!preg_match($parttenDecimals, $this->getRequestParameter('change_amount'))){
            $this->getRequest()->setError( 'change_amount', '最多四位小数或者整数超过11位' );
            return false;
        }
        if(!preg_match($parttenDecimals, $this->getRequestParameter('current_fastener_retention'))){
            $this->getRequest()->setError( 'current_fastener_retention', '最多四位小数或者整数超过11位' );
            return false;
        }
        if(!preg_match($parttenDecimals, $this->getRequestParameter('current_payable'))){
            $this->getRequest()->setError( 'current_payable', '最多两位小数或者整数超过11位' );
            return false;
        }
        if(!preg_match($parttenDecimals, $this->getRequestParameter('total_fastener_retention'))){
            $this->getRequest()->setError( 'total_fastener_retention', '最多四位小数或者整数超过11位' );
            return false;
        }
        if(!preg_match($parttenDecimals, $this->getRequestParameter('total_payable'))){
            $this->getRequest()->setError( 'total_payable', '最多四位小数或者整数超过11位' );
            return false;
        }
        if(!preg_match($parttenDecimals, $this->getRequestParameter('prepayment'))){
            $this->getRequest()->setError( 'prepayment', '最多四位小数或者整数超过11位' );
            return false;
        }
        if(!preg_match($parttenDecimals, $this->getRequestParameter('apply_payment'))){
            $this->getRequest()->setError( 'apply_payment', '最多四位小数或者整数超过11位' );
            return false;
        }
        return true;
    }

    public function handleErrorUpdate(){
        if($this->getRequestParameter('engineeringSettlementId')){
            return $this->forward('engineeringSettlement','edit');
        }else{
            return $this->forward('engineeringSettlement','add');
        }
    }

/**
 * executeLeaveCheck - Leave confirmation
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2380
 */
    public function executeLeaveCheck(){
        $isModified = false;
        if($this->getRequestParameter('engineeringSettlementId')){
            if( $this->_handleApplication() ){
                $isModified = true;
            }
            if( $this->_handleEngineeringSettlement() ){
                $isModified = true;
            }
        }
        else if( $this->getRequestParameter('id') || $this->getRequestParameter('contract_number') || $this->getRequestParameter('construction_unit') || $this->getRequestParameter('expiration_date') 
            || $this->getRequestParameter('issue') || $this->getRequestParameter('contract_amount') || $this->getRequestParameter('change_amount') || 
            $this->getRequestParameter('changed_amount') || $this->getRequestParameter('current_complete_engineering') || $this->getRequestParameter('current_fastener_retention') || 
            $this->getRequestParameter('current_payable') || $this->getRequestParameter('total_complete_engineering') || $this->getRequestParameter('total_fastener_retention') || 
            $this->getRequestParameter('total_payable') || $this->getRequestParameter('prepayment') || $this->getRequestParameter('apply_payment')
        ){
            $isModified = true;
        }
        echo $isModified ? '1' : '0';
        exit;
    }
}
