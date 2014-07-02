<?php
class engineeringMaterialsActions extends sfActions {
    public function preExecute() {
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
        $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
    }
    public function executeRead(){
        $this->readData();
        $this->applicationResults = ApplicationWorkFlowPeer::getApplicationResults($this->application->getId());
    }
    /**
     * executeAdd - add material purchase 
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeAdd() {
        if($this->getUser()->getGuardUser()->getUsername() == 'admin')$this->redirect('dashboard/index');
        $this->userProjects = ProjectPeer::getUserCreateAndBelongProjects($this->getUser()->getGuardUser()->getId());
        $this->project = $this->getRequestParameter('project');
        $this->setlayout('layoutWithoutSideBar');
    }

    /**
     * executeInsert - insert material purchase 
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeInsert() {
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            //insert application
            $paramsForApplication = array();
            $paramsForApplication['project'] = $this->getRequestParameter('project');
            $application = $this->insertApplication($paramsForApplication);
            //insert engineeringMaterials 
            $paramsForMaterials = array();
            $paramsForMaterials['applicationId'] = $application->getId();
            $paramsForMaterials['contractSection'] = $this->getRequestParameter('contract_section');
            $paramsForMaterials['number'] = $this->getRequestParameter('number');
            $engineeringMaterials = $this->insertEngineeringMaterials($paramsForMaterials);
            // insert engineeringMaterialsItems
            $materialName = $this->getRequestParameter('material_name');
            $brand = $this->getRequestParameter('brand');
            $technicalRequirement = $this->getRequestParameter('technical_requirement');
            $unit = $this->getRequestParameter('unit');
            $quantity = $this->getRequestParameter('quantity');
            $arrivalDate = $this->getRequestParameter('arrival_date');
            $arrivalPlace = $this->getRequestParameter('arrival_place');
            $comment = $this->getRequestParameter('comment');
            foreach ($materialName as $key => $name) {
                $engineeringMaterialsItems = new EngineeringMaterialsItems();
                $engineeringMaterialsItems->setMaterialName($name);
                $engineeringMaterialsItems->setEngineeringMaterialsId($engineeringMaterials->getId());
                $engineeringMaterialsItems->setBrand($brand[$key]);
                $engineeringMaterialsItems->setTechnicalRequirement($technicalRequirement[$key]);
                $engineeringMaterialsItems->setUnit($unit[$key]);
                $engineeringMaterialsItems->setQuantity($quantity[$key]);
                $engineeringMaterialsItems->setArrivalDate($arrivalDate[$key]);
                $engineeringMaterialsItems->setArrivalPlace($arrivalPlace[$key]);
                $engineeringMaterialsItems->setComment($comment[$key]);
                $engineeringMaterialsItems->save();
            }
            ////commit approval
            $approver = Approver::createApprover();
            $approver->setApplication($application);
            $approver->setWorkflow(WorkflowPeer::getFirstApproval($application->getApprovalId()));
            try{
                $approver->commitFirstApproval();
            }catch(Exception $e){
                
            }
            return $this->redirect('engineeringMaterials/edit?id=' . $application->getId() . '&' .html_entity_decode(util::formGetQuery('projectType', 'keywords', "approvalId") .'&msg=1'));
        } else {
            $this->forward404();
        }
    }
    public function handleErrorInsert() {
        return $this->forward("engineeringMaterials", "add");
    }
    public function handleErrorUpdate() {
        return $this->forward("engineeringMaterials", "edit");
    }
    private function readData(){
        //$this->application = ApplicationPeer::retrieveByPK($this->getRequestParameter('applicationId'));
        $id = $this->getRequestParameter('id');
        if(!ApplicationWorkFlowPeer::isBelongApplication($this->getUser()->getGuardUser(), $id)) $this->redirect('dashboard/index');
        $this->application = ApplicationPeer::retrieveByPK($id);
        
        if ($this->application->getIsValid() == 1) {
            $this->forward404();
        }
        $this->forward404Unless($this->application);
        $criteria = new Criteria();
        $criteria->add(EngineeringMaterialsPeer::APPLICATION_ID, $this->application->getId());
        $this->engineeringMaterials = EngineeringMaterialsPeer::doSelectOne($criteria);
        $this->forward404Unless($this->engineeringMaterials);
        $criteria = new Criteria();
        $criteria->add(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, $this->engineeringMaterials->getId());
        $criteria->addAscendingOrderByColumn(EngineeringMaterialsItemsPeer::ID);
        $this->engineeringMaterialsItems = EngineeringMaterialsItemsPeer::doSelect($criteria);
        $this->forward404Unless($this->engineeringMaterialsItems);
        $this->userProjects = ProjectPeer::getUserCreateAndBelongProjects($this->getUser()->getGuardUser()->getId());
        $this->setlayout('layoutWithoutSideBar');
    }
    /**
     * executeEdit - edit material purchase 
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeEdit() {
        $application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
        if($application && $application->getSfGuardUserId() != $this->getUser()->getGuardUser()->getId()) $this->redirect('dashboard/index');
        $this->readData();
    }
    /**
     * executeupdate - update material purchase 
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeUpdate() {
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($application);
            $paramsOfAplication = array();
            $paramsOfAplication['project'] = $this->getRequestParameter('project');
            $application = $this->updateApplication($application, $paramsOfAplication);


            $engineeringMaterials = EngineeringMaterialsPeer::retrieveByPK($this->getRequestParameter('engineeringMaterialsId'));
            $this->forward404Unless($engineeringMaterials);
            //insert engineeringMaterials 

            $engineeringMaterials = EngineeringMaterialsPeer::retrieveByPK($engineeringMaterials->getId());

            $engineeringMaterials->setApplicationId($application->getId());
            $engineeringMaterials->setContractSection($this->getRequestParameter('contract_section'));
            $engineeringMaterials->setNumber($this->getRequestParameter('number'));
            $engineeringMaterials->save();

            // insert engineeringMaterialsItems
            $criteria = new Criteria();
            $criteria->add(EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID, $engineeringMaterials->getId());
            EngineeringMaterialsItemsPeer::doDelete($criteria);

            $materialName = $this->getRequestParameter('material_name');
            $brand = $this->getRequestParameter('brand');
            $technicalRequirement = $this->getRequestParameter('technical_requirement');
            $unit = $this->getRequestParameter('unit');
            $quantity = $this->getRequestParameter('quantity');
            $arrivalDate = $this->getRequestParameter('arrival_date');
            $arrivalPlace = $this->getRequestParameter('arrival_place');
            $comment = $this->getRequestParameter('comment');

            foreach ($materialName as $key => $name) {
                $engineeringMaterialsItems = new EngineeringMaterialsItems();
                $engineeringMaterialsItems->setMaterialName($name);
                $engineeringMaterialsItems->setEngineeringMaterialsId($engineeringMaterials->getId());
                $engineeringMaterialsItems->setBrand($brand[$key]);
                $engineeringMaterialsItems->setTechnicalRequirement($technicalRequirement[$key]);
                $engineeringMaterialsItems->setUnit($unit[$key]);
                $engineeringMaterialsItems->setQuantity($quantity[$key]);
                $engineeringMaterialsItems->setArrivalDate($arrivalDate[$key]);
                $engineeringMaterialsItems->setArrivalPlace($arrivalPlace[$key]);
                $engineeringMaterialsItems->setComment($comment[$key]);
                $engineeringMaterialsItems->save();
            }
            //commit approval
            $approver = Approver::createApprover();
            $approver->setApplication($application);
            $approver->setWorkflow(WorkflowPeer::getFirstApproval($application->getApprovalId()));
            $approver->commitFirstApproval();
            return $this->redirect('engineeringMaterials/edit?id=' . $application->getId() . '&' .html_entity_decode(util::formGetQuery('projectType', 'keywords', "approvalId") .'&msg=1'));
        } else {
            $this->forward404();
        }
    }
    private function updateApplication($application, $params){
        $application->setProjectId($params['project']);
        $approval = ApprovalPeer::retrieveByPK($application->getApprovalId());
        $project = ProjectPeer::retrieveByPK($params['project']);
        $application->setName($project->getName() . $approval->getName());
        $application->setCurrentStatus(0);
        $application->save();
        return $application;
    }
    private function insertApplication($params) {
        $application = new Application();
        $application->setApprovalId($this->getUser()->getAttribute('approvalType'));
        $application->setSfGuardUserId($this->getUser()->getUserId());
        $application->setProjectId($params['project']);
        $approval = ApprovalPeer::retrieveByPK($this->getUser()->getAttribute('approvalType'));
        $project = ProjectPeer::retrieveByPK($params['project']);

        $application->setName($project->getName() . $approval->getName());
        $application->setCurrentStatus(0);
        $application->save();
        return $application;
    }

    private function insertEngineeringMaterials($params) {
        $engineeringMaterials = new EngineeringMaterials();
        $engineeringMaterials->setApplicationId($params['applicationId']);
        $engineeringMaterials->setContractSection($params['contractSection']);
        $engineeringMaterials->setNumber($params['number']);
        $engineeringMaterials->save();
        return $engineeringMaterials;
    }

    public function executeCheckContractSection(){
        $contractSection = $this->getRequestParameter('contractSection');
        $id = $this->getRequestParameter('id');
        $criteria = new Criteria();
        $criteria->add(EngineeringMaterialsPeer::CONTRACT_SECTION, $contractSection);
        if($id){
            $criteria->add(EngineeringMaterialsPeer::ID, $id, Criteria::NOT_EQUAL);
        }
        $engineeringObj = EngineeringMaterialsItemsPeer::doSelect($criteria);
        if($engineeringObj){
            echo '1';
            exit;
        }
        echo '0';
        exit;
    }
    public function executeCheckNumber(){
        $number = $this->getRequestParameter('number');
        $id = $this->getRequestParameter('id');
        $criteria = new Criteria();
        $criteria->add(EngineeringMaterialsPeer::NUMBER, $number);
        if($id){
            $criteria->add(EngineeringMaterialsPeer::ID, $id, Criteria::NOT_EQUAL);
        }
        $engineeringObj = EngineeringMaterialsItemsPeer::doSelect($criteria);
        if($engineeringObj){
            echo '1';
            exit;
        }
        echo '0';
        exit;
    }
    
    public function executePrint(){
        $this->readData();
        $this->applicationResults = ApplicationWorkFlowPeer::getApplicationResults($this->application->getId());
        $this->setLayout('layoutPrint');
    }
    
    public function executeCheckEngineeringMaterials(){
        $status = false;
        $id = $this->getRequestParameter('id');
        $application = ApplicationPeer::retrieveByPK($id);
        //project id
        $projectId = $this->getRequestParameter('project');
        //engineeringMaterials data
        $engineeringMaterialsData = array(
                'ContractSection'=>$this->getRequestParameter('contract_section'),
                'Number'=>$this->getRequestParameter('number'),
        );
        //engineeringMaterialsItems data
        $materialNames = $this->getRequestParameter('material_name');
        $brand = $this->getRequestParameter('brand');
        $technicalRequirement = $this->getRequestParameter('technical_requirement');
        $unit = $this->getRequestParameter('unit');
        $quantity = $this->getRequestParameter('quantity');
        $arrivalDate = $this->getRequestParameter('arrival_date');
        $arrivalPlace = $this->getRequestParameter('arrival_place');
        $comment = $this->getRequestParameter('comment');
        if($id){
            $project = false;
            $engineeringMaterials = false;
            $engineeringMaterialsItems = false;
            //modified project id
            $application->setProjectId($projectId);
            if($application->isModified()){
                $project = true;
            }
            //modified engineeringMaterials
            $engineeringMaterialsId  = $this->getRequestParameter('engineeringMaterialsId');
            $EngineeringMaterialsObj = EngineeringMaterialsPeer::retrieveByPK($engineeringMaterialsId);
            $EngineeringMaterialsObj->fromArray($engineeringMaterialsData);
            if($EngineeringMaterialsObj->isModified()){
                $engineeringMaterials = true;
            }
            //modified engineeringMaterialsItems
            $engineeringMaterialsItemsObjs = $EngineeringMaterialsObj->getEngineeringMaterialsItemss();
            if($materialNames){
                foreach ($materialNames as $key => $materialName){
                    if(!isset($engineeringMaterialsItemsObjs[$key])){
                        $engineeringMaterialsItemsObjs[$key] = new EngineeringMaterialsItems();
                    }
                    $engineeringMaterialsItemsObjs[$key]->setMaterialName($materialName);
                    $engineeringMaterialsItemsObjs[$key]->setBrand($brand[$key]);
                    $engineeringMaterialsItemsObjs[$key]->setTechnicalRequirement($technicalRequirement[$key]);
                    $engineeringMaterialsItemsObjs[$key]->setUnit($unit[$key]);
                    $engineeringMaterialsItemsObjs[$key]->setQuantity($quantity[$key]);
                    $engineeringMaterialsItemsObjs[$key]->setArrivalDate($arrivalDate[$key] ? $arrivalDate[$key] : null);
                    $engineeringMaterialsItemsObjs[$key]->setArrivalPlace($arrivalPlace[$key]);
                    $engineeringMaterialsItemsObjs[$key]->setComment($comment[$key]);
                    if($engineeringMaterialsItemsObjs[$key]->isModified()){
                        $engineeringMaterialsItems = true;
                        break;
                    }
                }
            }else{
                $engineeringMaterialsItems = true;
            }
            if($project || $engineeringMaterials || $engineeringMaterialsItems){
                $status = true;
            }
        }else{
            if($projectId != "所有项目"){
                $status = true;
            }
            foreach ($engineeringMaterialsData as $value){
                if($value){
                    $status = true;
                }
            }
            foreach ($materialNames as $key => $materialName){
                if($materialNames[$key] || $brand[$key] || $technicalRequirement[$key]
                || $unit[$key] || $quantity[$key] || $arrivalDate[$key]|| $arrivalPlace[$key] || $comment[$key]){
                    $status = true;
                }
            }
        }
        echo $status ? '1' : '0';
        exit();
    }
}
