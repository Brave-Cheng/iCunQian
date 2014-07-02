<?php

/**
 * engineeringSummary actions.
 *
 * @package    oa
 * @subpackage engineeringSummary
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class engineeringSummaryActions extends BaseBackends {

    /**
     * Executes index action
     *
     */
    public function executeIndex() {
        $this->forward('default', 'module');
    }

    /**
     * get module permission
     * @issue 2337
     * @author brave
     */
    public function preExecute() {
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
        $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
    }

    /**
     * create a new engineering summary 
     * @issue 2337
     * @author brave
     */
    public function executeCreate() {
        $this->commonPage();
        $this->setTemplate('create');
    }

    /**
     * 
     * @issue 2337
     * @author brave
     */
    private function commonPage() {
        $this->engineeringSummaryItems = $this->engineeringSummaryId = '';
        $this->approvalId = $this->getUser()->getAttribute('approvalType') ? $this->getUser()->getAttribute('approvalType') : $this->getRequestParameter('approvalType');
        $this->approvalType = ApprovalPeer::retrieveByPK($this->approvalId);
        $this->forward404Unless($this->approvalType);
        $this->userProjects = ProjectPeer::getUserCreateAndBelongProjects($this->getUser()->getGuardUser()->getId());
        $this->applicationId = $this->getRequestParameter('id');
        if ($this->applicationId) {
            $this->application = ApplicationPeer::retrieveByPK($this->applicationId);
            $this->forward404Unless($this->application);
            if ($this->application->getIsValid() == 1) {
                $this->forward404();
            }
            $this->engineeringSummary = EngineeringSummaryPeer::getEngineeringSummaryByApplicationId($this->applicationId);
            $this->forward404Unless($this->engineeringSummary);
            $this->engineeringSummaryId = $this->engineeringSummary->getId();
            if ($this->engineeringSummaryId) {
                $this->engineeringSummaryItems = EngineeringSummaryItemsPeer::getItemsByEngineeringSummaryId($this->engineeringSummaryId);
            }
        }
        $this->setlayout('layoutWithoutSideBar');
    }

    /**
     * edit an engineering summary 
     * @issue 2337
     * @author brave
     */
    public function executeEdit() {
        $application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
        if($application && $application->getSfGuardUserId() != $this->getUser()->getGuardUser()->getId()) $this->redirect('dashboard/index');
        $this->commonPage();
        $this->setTemplate('create');
    }

    /**
     * update a new engineering summary 
     * @issue 2337
     * @author brave
     */
    public function executeUpdate() {
        if ($this->getRequest()->getMethod() == sfRequest::POST) {

            //first step: insert application 
            $this->applicationId = $this->getRequestParameter('applicationId');
            if ($this->applicationId) {
                $application = ApplicationPeer::retrieveByPK($this->applicationId);
            } else {
                $application = new Application();
            }
            $application->fromArray(
                    array(
                        'ApprovalId' => $this->getRequestParameter('approvalType'),
                        'SfGuardUserId' => $this->getUser()->getGuardUser()->getId(),
                        'ProjectId' => $this->getRequestParameter('project'),
                        'CurrentStatus' => 0,
                    )
            );
            $application->save();
            if (!$this->applicationId) {
                $this->applicationId = $application->getId();
            }
            $approval = ApprovalPeer::retrieveByPK($this->getRequestParameter('approvalType'));
            $project = ProjectPeer::retrieveByPK($this->getRequestParameter('project'));
            $application->setName($project->getName() . $approval->getName());
            $application->save();
            //second step: insert engineering summary
            $this->engineeringSummaryId = $this->getRequestParameter('engineeringSummaryId');
            if ($this->engineeringSummaryId) {
                $engineeringSummary = EngineeringSummaryPeer::retrieveByPK($this->engineeringSummaryId);
            } else {
                $engineeringSummary = new EngineeringSummary();
            }
            $engineeringSummary->fromArray(
                    array(
                        'ApplicationId' => $this->applicationId,
                        'ConstructionUnit' => $this->getRequestParameter('constructionUnit'),
                        'ContractNumber' => $this->getRequestParameter('contractNumber'),
                        'Issue' => $this->getRequestParameter('issue'),
                        'ExpirationDate' => $this->getRequestParameter('expiration_date'),
                    )
            );
            $engineeringSummary->save();
            if (!$this->engineeringSummaryId) {
                $this->engineeringSummaryId = $engineeringSummary->getId();
            }

            //third step: insert engineering summary items
            $this->projectContents = $this->getRequestParameter('projectContent');
            $currentItemsId = $this->getRequestParameter('engineeringSummaryItemsId');
            $this->contractQuantity = $this->getRequestParameter('contractQuantity');
            $this->floatQuantity = $this->getRequestParameter('floatQuantity');
            $this->currentFinishAmount = $this->getRequestParameter('currentFinishAmount');
            $this->lastFinishAmount = $this->getRequestParameter('lastFinishAmount');
            $this->finishAmount = $this->getRequestParameter('finishAmount');
            $this->finishPercent = $this->getRequestParameter('finishPercent');
            $this->comment = $this->getRequestParameter('comment');

            //delelte key
            if ($currentItemsId) {
                $criteria = new Criteria();
                $criteria->add(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, $this->engineeringSummaryId);
                EngineeringSummaryItemsPeer::doDelete($criteria);
            }
            $total_current_finish_amount = $total_last_finish_amount = $total_finish_amount = 0;
            foreach ($this->projectContents as $key => $projectContent) {
                $this->engineeringSummaryItemsId = $currentItemsId[$key];
//                if ($this->engineeringSummaryItemsId) {
//                    $engineeringSummaryItems = EngineeringSummaryItemsPeer::retrieveByPK($this->engineeringSummaryItemsId);
//                } else {
//                    $engineeringSummaryItems = new EngineeringSummaryItems();
//                }
                $engineeringSummaryItems = new EngineeringSummaryItems();
                $engineeringSummaryItems->fromArray(
                        array(
                            'EngineeringSummaryId' => $this->engineeringSummaryId,
                            'ProjectContent' => $projectContent,
                            'ContractQuantity' => $this->contractQuantity[$key],
                            'FloatQuantity' => $this->floatQuantity[$key],
                            'CurrentFinishAmount' => $this->currentFinishAmount[$key],
                            'LastFinishAmount' => $this->lastFinishAmount[$key],
                            'FinishAmount' => $this->finishAmount[$key],
                            'FinishPercent' => $this->finishPercent[$key],
                            'Comment' => $this->comment[$key],
                        )
                );
                $engineeringSummaryItems->save();
                $total_current_finish_amount += $engineeringSummaryItems->getCurrentFinishAmount();
                $total_last_finish_amount +=$engineeringSummaryItems->getLastFinishAmount();
                $total_finish_amount += $engineeringSummaryItems->getFinishAmount();
            }

            //four step: update must data
            /* update engineering summary */
            $engineeringSummary->fromArray(
                    array(
                        'TotalCurrentFinishAmount' => $total_current_finish_amount,
                        'TotalLastFinishAmount' => $total_last_finish_amount,
                        'TotalFinishAmount' => $total_finish_amount,
                    )
            );
            $engineeringSummary->save();

            //commit approval
            $approver = Approver::createApprover();
            $approver->setApplication($application);
            $approver->setWorkflow(WorkflowPeer::getFirstApproval($application->getApprovalId()));
            try{
                $approver->commitFirstApproval();
            }catch(Exception $e){
                
            }
            return $this->redirect('engineeringSummary/edit?id=' . $application->getId() . '&approvalType=' . $application->getApprovalId() . '&' . html_entity_decode(util::formGetQuery("keywords", "projectType", "approvalId")) . '&msg=1');
        } else {
            $this->forward404();
        }
    }

    /**
     * check fields is necessary
     * @return direct
     * @issue 2337
     * @author brave
     */
    public function handleErrorUpdate() {
        return $this->forward("engineeringSummary", "create");
    }

    /**
     * view page
     * @issue 2337
     * @author brave
     */
    public function executeRead() {
        if(!ApplicationWorkFlowPeer::isBelongApplication($this->getUser()->getGuardUser(), $this->getRequestParameter('id'))) $this->redirect('dashboard/index');
        $this->commonPage();
        $this->applicationResults = ApplicationWorkFlowPeer::getApplicationResults($this->applicationId);
    }

    
    public function executePrint(){
        $this->commonPage();
        $this->applicationResults = ApplicationWorkFlowPeer::getApplicationResults($this->applicationId);
        $this->setLayout('layoutPrint');
    }
    /**
     * delete summary item 
     * @issue 2337
     * @author brave
     */
    public function executeAjaxDelete() {
        $this->engineeringSummaryItemId = $this->getRequestParameter('engineeringSummaryItemId');
        $res = array('msg' => '删除失败！');
        if ($this->engineeringSummaryItemId) {
            $engineeringSummaryItem = EngineeringSummaryItemsPeer::retrieveByPK($this->engineeringSummaryItemId);
            $engineeringSummaryItem->delete();
            $res = array('msg' => '删除成功！');
        }
        exit(json_encode($res));
    }
    public function executeCheckEngineeringSummary(){
        $status = false;
        $id = $this->getRequestParameter('applicationId');
        $application = ApplicationPeer::retrieveByPK($id);
        //project id
        $projectId = $this->getRequestParameter('project');
        //engineeringSummary data
        $expirationDate = $this->getRequestParameter('expiration_date') ? $this->getRequestParameter('expiration_date') : null;
        $engineeringSummaryData = array(
                'ContractNumber'=>$this->getRequestParameter('contractNumber'),
                'Issue'=>$this->getRequestParameter('issue'),
                'ConstructionUnit'=>$this->getRequestParameter('constructionUnit'),
                'ExpirationDate'=>$expirationDate,
        );
        //engineeringSummaryItems  data
        $projectContents = $this->getRequestParameter('projectContent');
        $contractQuantity = $this->getRequestParameter('contractQuantity');
        $floatQuantity = $this->getRequestParameter('floatQuantity');
        $lastFinishAmount = $this->getRequestParameter('lastFinishAmount');
        $finishAmount = $this->getRequestParameter('finishAmount');
        $finishPercent = $this->getRequestParameter('finishPercent');
        $comment = $this->getRequestParameter('comment');
        if($id){
            $project = false;
            $engineeringSummary = false;
            $engineeringSummaryItems = false;
            //modified project id
            $application->setProjectId($projectId);
            if($application->isModified()){
                $project = true;
            }
            //modified engineeringSummary
            $engineeringSummaryId  = $this->getRequestParameter('engineeringSummaryId');
            $engineeringSummaryObj = EngineeringSummaryPeer::retrieveByPK($engineeringSummaryId);
            $engineeringSummaryObj->fromArray($engineeringSummaryData);
            if($engineeringSummaryObj->isModified()){
                $engineeringSummary = true;
            }
            //modified engineeringSummaryItems
            $engineeringSummaryItemsObjs = $engineeringSummaryObj->getEngineeringSummaryItemss();
            if($projectContents){
                foreach ($projectContents as $key => $projectContent){
                    $engineeringSummaryItemsObj = $engineeringSummaryItemsObjs[$key] ? $engineeringSummaryItemsObjs[$key] : new EngineeringSummaryItems();
                    $engineeringSummaryItemsObj->setProjectContent($projectContents[$key]);
                    $engineeringSummaryItemsObj->setContractQuantity($contractQuantity[$key]);
                    $engineeringSummaryItemsObj->setFloatQuantity($floatQuantity[$key]);
                    $engineeringSummaryItemsObj->setLastFinishAmount((float)$lastFinishAmount[$key]);
                    $engineeringSummaryItemsObj->setFinishAmount((float)$finishAmount[$key]);
                    $engineeringSummaryItemsObj->setFinishPercent((float)$finishPercent[$key]);
                    $engineeringSummaryItemsObj->setComment($comment[$key]);
                    if($engineeringSummaryItemsObj->isModified()){
                        $engineeringSummaryItems = true;
                        break;
                    }
                }
            }else{
                $engineeringSummaryItems = true;
            }
            if($engineeringSummary || $engineeringSummaryItems || $project){
                $status = true;
            }
        }else{
            if($projectId ){
                $status = true;
            }
            foreach ($engineeringSummaryData as $value){
                if($value){
                    $status = true;
                }
            }
            foreach ($projectContents as $key => $projectContent){
                if($projectContents[$key] || $contractQuantity[$key] || $floatQuantity[$key] || $lastFinishAmount[$key]
                || $finishAmount[$key] ||  $finishPercent[$key] || $comment[$key]){
                    $status = true;
                }
            }
        }
        echo $status ? '1' : '0';
        exit();
    }
    
    

}
