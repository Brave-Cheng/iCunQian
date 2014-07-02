<?php
class engineeringGoodsActions extends sfActions {
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
    
    public function executePrint(){
        $this->readData();
        $this->applicationResults = ApplicationWorkFlowPeer::getApplicationResults($this->application->getId());
        $this->setLayout('layoutPrint');
    }
    
    private function readData(){
        $id = $this->getRequestParameter('id');
        if(!ApplicationWorkFlowPeer::isBelongApplication($this->getUser()->getGuardUser(), $id)) $this->redirect('dashboard/index');
        $this->application = ApplicationPeer::retrieveByPK($id);
        $this->forward404Unless($this->application);
        if ($this->application->getIsValid() == 1) {
            $this->forward404();
        }
        $criteria = new Criteria();
        $criteria->add(EngineeringGoodsPeer::APPLICATION_ID, $this->application->getId());
        $this->engineeringGoods = EngineeringGoodsPeer::doSelectOne($criteria);
        $this->forward404Unless($this->engineeringGoods);
        $criteria = new Criteria();
        $criteria->add(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, $this->engineeringGoods->getId());
        $criteria->addAscendingOrderByColumn(EngineeringGoodsItemsPeer::ID);
        $this->engineeringGoodsItems = EngineeringGoodsItemsPeer::doSelect($criteria);
        $this->forward404Unless($this->engineeringGoodsItems);
        $this->departments = DepartmentPeer::doSelect(new Criteria());
        $this->setlayout('layoutWithoutSideBar');
    }
    public function executeAdd(){
        if($this->getUser()->getGuardUser()->getUsername() == 'admin')$this->redirect('dashboard/index');
        $this->departments = DepartmentPeer::doSelect(new Criteria());
        $this->setlayout('layoutWithoutSideBar');
    }

    public function executeInsert(){
       if ($this->getRequest()->getMethod() == sfRequest::POST) {
            //insert application
            $paramsForApplication = array();
            $paramsForApplication['department'] = $this->getRequestParameter('department');
            $application = $this->insertApplication($paramsForApplication);
            //insert engineerinGoods 
            $paramsForGoods = array();
            $paramsForGoods['applicationId'] = $application->getId();
            $paramsForGoods['department'] = $this->getRequestParameter('department');;
            $engineeringGoods = $this->insertEngineeringGoods($paramsForGoods);
            // insert engineeringMaterialsItems
            $projectName = $this->getRequestParameter('project_name');
            $brands = $this->getRequestParameter('brand');
            $requirement = $this->getRequestParameter('requirement');
            $unit = $this->getRequestParameter('unit');
            $quantity = $this->getRequestParameter('quantity');
            $comment = $this->getRequestParameter('comment');
            foreach ($projectName as $key => $name) {
                $engineeringGoodsItems = new EngineeringGoodsItems();
                $engineeringGoodsItems->setProjectName($name);
                $engineeringGoodsItems->setEngineeringGoodsId($engineeringGoods->getId());
                $engineeringGoodsItems->setBrand($brands[$key]);
                $engineeringGoodsItems->setRequirement($requirement[$key]);
                $engineeringGoodsItems->setUnit($unit[$key]);
                $engineeringGoodsItems->setQuantity($quantity[$key]);
                $engineeringGoodsItems->setComment($comment[$key]);
                $engineeringGoodsItems->save();
            }
           ////commit approval
           
            $approver = Approver::createApprover();
            $approver->setApplication($application);
            $approver->setWorkflow(WorkflowPeer::getFirstApproval($application->getApprovalId()));
            $approver->commitFirstApproval();
           
            return $this->redirect('engineeringGoods/edit?id=' . $application->getId() . '&' .html_entity_decode(util::formGetQuery('projectType', 'keywords', "approvalId") .'&msg=1'));
        } else {
            $this->forward404();
        }
    }

    public function executeEdit(){
        $application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
        if($application && $application->getSfGuardUserId() != $this->getUser()->getGuardUser()->getId()) $this->redirect('dashboard/index');
        $this->readData();
    }

    public function executeUpdate(){
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $application = ApplicationPeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($application);
            $application->setDepartmentId($this->getRequestParameter('department'));
            $application->save();
            $engineeringGoods = EngineeringGoodsPeer::retrieveByPK($this->getRequestParameter('engineeringGoodsId'));
            $this->forward404Unless($engineeringGoods);
            //insert engineeringMaterials 
            $engineeringGoods->setApplicationId($application->getId());
            $engineeringGoods->setDepartmentId($this->getRequestParameter('department'));
            $engineeringGoods->save();

            // insert engineeringMaterialsItems
            $criteria = new Criteria();
            $criteria->add(EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID, $engineeringGoods->getId());
            EngineeringGoodsItemsPeer::doDelete($criteria);

            $projectName = $this->getRequestParameter('project_name');
            $brands = $this->getRequestParameter('brand');
            $requirement = $this->getRequestParameter('requirement');
            $unit = $this->getRequestParameter('unit');
            $quantity = $this->getRequestParameter('quantity');
            $comment = $this->getRequestParameter('comment');
            foreach ($projectName as $key => $name) {
                $engineeringGoodsItems = new EngineeringGoodsItems();
                $engineeringGoodsItems->setProjectName($name);
                $engineeringGoodsItems->setEngineeringGoodsId($engineeringGoods->getId());
                $engineeringGoodsItems->setBrand($brands[$key]);
                $engineeringGoodsItems->setRequirement($requirement[$key]);
                $engineeringGoodsItems->setUnit($unit[$key]);
                $engineeringGoodsItems->setQuantity($quantity[$key]);
                $engineeringGoodsItems->setComment($comment[$key]);
                $engineeringGoodsItems->save();
            }
            //commit approval
            
            $approver = Approver::createApprover();
            $approver->setApplication($application);
            $approver->setWorkflow(WorkflowPeer::getFirstApproval($application->getApprovalId()));
            $approver->commitFirstApproval();
            
            return $this->redirect('engineeringGoods/edit?id=' . $application->getId() . '&' .html_entity_decode(util::formGetQuery('projectType', 'keywords', "approvalId") .'&msg=1'));
        } else {
            $this->forward404();
        }
    }
    private function insertApplication($params) {
        $application = new Application();
        $application->setApprovalId($this->getUser()->getAttribute('approvalType'));
        $application->setSfGuardUserId($this->getUser()->getUserId());
        $application->setDepartmentId($params['department']);
        $approval = ApprovalPeer::retrieveByPK($this->getUser()->getAttribute('approvalType'));
        $application->setName($approval->getName());
        $application->setCurrentStatus(0);
        $application->save();
        return $application;
    }
    private function insertEngineeringGoods($params) {
        $engineeringGoods = new EngineeringGoods();
        $engineeringGoods->setApplicationId($params['applicationId']);
        $engineeringGoods->setDepartmentId($params['department']);
        $engineeringGoods->save();
        return $engineeringGoods;
    }
    public function executeCheckEngineeringGoods(){
        $status = false;
        $id = $this->getRequestParameter('id');
        $departmentId = $this->getRequestParameter('department');
        $projectNames = $this->getRequestParameter('project_name');
        $brand = $this->getRequestParameter('brand');
        $requirement = $this->getRequestParameter('requirement');
        $unit = $this->getRequestParameter('unit');
        $quantity = $this->getRequestParameter('quantity');
        $comment = $this->getRequestParameter('comment');      
        if($id){
            $department = false;
            $goods = false;
            // modifid department id
            $application = ApplicationPeer::retrieveByPK($id);
            $application->setDepartmentId($departmentId);
            if($application->isModified()){
                $department = true;
            }
            // modified Goods
            $goodsId  = $this->getRequestParameter('engineeringGoodsId');
            $engineeringGoods = EngineeringGoodsPeer::retrieveByPK($goodsId);
            $engineeringGoodsItems = $engineeringGoods->getEngineeringGoodsItemss();
            if($projectNames){
                foreach ($projectNames as $key => $projectName){
                    if(!isset($engineeringGoodsItems[$key])){
                        $engineeringGoodsItems[$key] = new EngineeringGoodsItems();
                    }
                    $engineeringGoodsItems[$key]->setProjectName($projectName);
                    $engineeringGoodsItems[$key]->setBrand($brand[$key]);
                    $engineeringGoodsItems[$key]->setRequirement($requirement[$key]);
                    $engineeringGoodsItems[$key]->setUnit($unit[$key]);
                    $engineeringGoodsItems[$key]->setQuantity($quantity[$key]);
                    $engineeringGoodsItems[$key]->setComment($comment[$key]);
                    if($engineeringGoodsItems[$key]->isModified()){
                        $goods = true;
                        break;
                    }
                }
            }else{
                $goods = true;
            }
            
            if($goods || $department){
                $status = true;
            }
        }else{
            if($departmentId){
                $status = true;
            }
            
            foreach ($projectNames as $key => $projectName){
                if($projectName || $brand[$key] || $requirement[$key] || $unit[$key] || $comment[$key] || $quantity[$key]){
                    $status = true;
                }
            }
        }
        $status = $status ? '1' : '0';
        exit($status);
    }
}
