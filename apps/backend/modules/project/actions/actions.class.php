<?php
class projectActions extends BaseBackends
{
    
    /**
     * get this module access 
     * @issue 2347
     * @modified brave, ice
     */
    public function preExecute() {
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
        $this->tender = $userProfile->moduleAccess($this->getModuleName(), 'tender');
        $this->projectStatisticsRead = $userProfile->moduleAccess('projectStatistics', 'read');
        $this->completeProjectPermission = $userProfile->moduleAccess('project', 'completeProject');
        $this->projectMilestoneRead = $userProfile->moduleAccess('projectMilestone', 'read');
        $this->projectHistoryRead = $userProfile->moduleAccess('projectHistory','read');
        $this->accessProjectMemberUpdate = $userProfile->moduleAccess('projectMember', 'update');
        $this->accessProjectDocumetUpdate = $userProfile->moduleAccess('projectDocument', 'update');
        $this->accessDailyReportRead = $userProfile->moduleAccess('dailyReport', 'read');
        $this->accessDailyReportCreate = $userProfile->moduleAccess('dailyReport', 'add');
    }
    
    /**
     * project index
     * @issue 2326
     * @modified brave ， ice
     */
    public function executeIndex() {
        $this->getUser()->setAttribute('projectTypeKey', null);
        $this->getUser()->setAttribute('projectTenderKey', null);
        $this->getUser()->setAttribute('projectData', null);
        $this->getUser()->setAttribute('projectMemberData', null);
        $this->getUser()->setAttribute('documentData', null);
        $this->getUser()->setAttribute('onlyProject', null);
        $sql = 'SELECT DISTINCT project.* FROM %%project%% AS project  ';
        //admin show all project
        $p = array();
        if (false == $this->getUser()->isSuperAdmin() && !sfGuardUserProfile::hasPermission('showAll')) {
            $sql .=' LEFT JOIN %%project_member%% as project_member ON(project.id = project_member . project_id) WHERE ( project_member.sf_guard_user_id = ? OR project.creator = ? )';
            $p = array($this->getUser()->getUserId(), $this->getUser()->getUserId());
        } else {
            $sql .=' WHERE 1 ';
        }
        $keyWords = trim(urldecode($this->getRequestParameter('keywords')));
        $keyWords = util::replaceSpecialChar($keyWords);
        $type = $this->getRequestParameter('type') ? $this->getRequestParameter('type') : 0;
        $andArray = array();
        if (strlen($keyWords)) {
            $andArray[] = ' project.name LIKE ?';
            $p[] = "%$keyWords%";
            $andArray[] = ' project.proprietor LIKE ?';
            $p[] = "%$keyWords%";
            if ($andArray) {
                $sql .= ' AND (' . implode(' OR ', $andArray) . ')';
            }
        }
        if ($type == ProjectPeer::INNER_PROJECT) {
            $sql .= ' AND project.type = ' . projectPeer::INNER_PROJECT;
        } elseif ($type == ProjectPeer::OUTSOURCE_PROJECT) {
            $sql .= ' AND project.type = ' . projectPeer::OUTSOURCE_PROJECT;
        }
        $sql .= ' ORDER BY project.id DESC';
        $sql = str_replace('%%project%%', ProjectPeer::TABLE_NAME, $sql);
        $sql = str_replace('%%project_member%%', ProjectMemberPeer::TABLE_NAME, $sql);
        $countSql = str_replace('DISTINCT project.*', 'COUNT(DISTINCT project.id) as count', $sql);
        $this->pager = DBUtil::pagerSql($sql, $p, 'ProjectPeer', $countSql);
        $this->types = ProjectPeer::getTypes();
        $this->phases = ProjectPeer::getPhases();
        $this->keywords = $this->getRequestParameter('keywords');
        // modifited dailyReport if had project
        $c = new Criteria();
        $c->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getUser()->getUserId());
        $c->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);
        $c->add(ProjectPeer::TYPE, ProjectPeer::INNER_PROJECT);
        $c->add(ProjectPeer::PHASE, ProjectPeer::PROJECT_PHASE);
        $c->add(ProjectPeer::IS_PROJECT_END, ProjectPeer::PROJECT_NOT_END);
        $c->addAscendingOrderByColumn(ProjectPeer::UPDATED_AT);
        $this->dailyReport = ProjectPeer::doSelect($c);
        
    }
 
    public function executeCreateProjectType(){
    }
    /**
     * InsertProjectType - create project type
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeInsertProjectType(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $type = $this->getRequestParameter('types');
            $this->getUser()->setAttribute('projectTypeKey', $type);
            if($type == ProjectPeer::INNER_PROJECT){            
                return $this->redirect('project/selectTender');
            }elseif($type == ProjectPeer::OUTSOURCE_PROJECT){
                return $this->redirect('project/add');
            }  
        }else{
            $this->forward404();
        }
    }
    
    public function executeSelectTender(){
        if(!$this->getuser()->hasAttribute('projectTypeKey')) $this->redirect('dashboard/index');
    }
    /**
     * executeAddSelectTender- select tender 
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeAddSelectTender(){
        if($this->getRequest()->getMethod() == sfRequest::POST){  
            $this->getUser()->setAttribute('projectTenderKey',  $this->getRequestParameter('isTender'));
            return $this->redirect('project/add');
        }else{
            $this->forward404();
        }
    }

    public function validateInsert(){
        $projectTenderKey = $this->getUser()->getAttribute('projectTenderKey');
        $projectTypeKey = $this->getUser()->getAttribute('projectTypeKey');
        $check = true;
        if($projectTenderKey == ProjectPeer::TENDERING_PHASE){
            if($this->getRequestParameter('ef')){
                $price = trim($this->getRequestparameter('price'));
                if(!$this->_validatePrice($price)){
                   $check = false;
                }
            }

            if(!$this->getRequestParameter('tenderingStatus')){
                $this->getRequest()->setError("tenderingStatus", '投标状态必选'); 
                $check = false;
            }
        }elseif( ($projectTypeKey == ProjectPeer::OUTSOURCE_PROJECT) || ($projectTenderKey == ProjectPeer::PROJECT_PHASE)){
            if(!$this->getRequestParameter('blockNumber')){
                $this->getRequest()->setError("blockNumber", '标段号不能为空'); 
                $check = false;
            }
        }
        return $check;
    }
    private function _validatePrice($price){
        if(!$price){
            $this->getRequest()->setError("price", '价格不能为空'); 
            return false;
        }else{
            $pattern = "/^(\d){0,12}\.{0,1}(\d{1,2})?$/";
            if(!preg_match($pattern, $price)){
                $this->getRequest()->setError("price", "价格必须是数字且保留2位小数");
                return false;
            }
        }
        return true; 
    }
    public function handleErrorInsert(){
        return $this->forward('project', 'add');
    }
    public function executeAdd(){ 
        if(!$this->getuser()->hasAttribute('projectTypeKey')) $this->redirect('dashboard/index');
        $this->projectData = $this->getUser()->getAttribute('projectData');
        $this->typeKey = $this->getUser()->getAttribute('projectTypeKey'); 
        $this->tenderKey = $this->getUser()->getAttribute('projectTenderKey');
        $this->types = ProjectPeer::getTypes();
        $this->rmsg = $this->getRequestParameter('rmsg');    
    }
    /**
    * executeInsert - insert project
    * @author you.wu <you.wu@expacta.com.cn>
    */
    public function executeInsert(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $startDate = $this->getRequestParameter('startDate') ? $this->getRequestParameter('startDate') : null;
            $endDate = $this->getRequestParameter('endDate') ? $this->getRequestParameter('endDate') : null;
            $comment = htmlspecialchars(nl2br($this->getRequestParameter('comment')));
            $modifier = $this->getUser()->getUserId();
            $projectTypeKey = $this->getUser()->getAttribute('projectTypeKey');
            $projectTenderKey = $this->getUser()->getAttribute('projectTenderKey');
            if($projectTenderKey  == ProjectPeer::TENDERING_PHASE){
                $phase = ProjectPeer::TENDERING_PHASE;
                $blockNumber = null;
                $isBuy = $this->getRequestParameter('isBuy');
                if($this->getRequestParameter('isBuy')){
                    $price = $this->getRequestparameter('price');
                }else{
                    $price = null;
                }
                $tenderingStatus = $this->getRequestparameter('tenderingStatus');
            }elseif(($projectTypeKey == ProjectPeer::OUTSOURCE_PROJECT) || $projectTenderKey  == ProjectPeer::PROJECT_PHASE){
                $phase = ProjectPeer::PROJECT_PHASE;
                $blockNumber = $this->getRequestParameter('blockNumber');
                $isBuy = 0;
                $price = null;
                $tenderingStatus = null;
            }
            $projectData = array(
               'type'=>$projectTypeKey,
               'phase'=>$phase,
               'name'=>$this->getRequestParameter('projectName'),
               'longName'=>$this->getRequestParameter('projectLongName'),
               'proprietor' =>$this->getRequestParameter('proprietor'),
               'startDate'=>$startDate,
               'endDate'=>$endDate,
               'blockNumber'=>$blockNumber,
               'isBuy'=>$isBuy,
               'price'=>$price,
               'tenderingStatus'=>$tenderingStatus,
               'comment'=>$comment,
               'modifier'=>$modifier,
               'creator'=>$modifier
            );
            $this->getUser()->setAttribute('projectData', $projectData);
            return $this->redirect('project/addProjectMember');       
        }
    }
  
    //insert projectMember
    public function executeAddProjectMember(){
        if(!$this->getuser()->hasAttribute('projectData')) $this->redirect('dashboard/index');
        $this->projectData = $this->getUser()->getAttribute('projectData');
        $this->type = $this->projectData['type'];
        $this->name = $this->projectData['name'];

        $projectMemberData = $this->getUser()->getAttribute('projectMemberData');
        $this->userIds = $projectMemberData['userIds'] ? $projectMemberData['userIds'] : array();
        $this->roleIds = $projectMemberData['roleIds'] ? $projectMemberData['roleIds'] : array();
        $this->otherRoles = $projectMemberData['otherRoles'] ? $projectMemberData['otherRoles'] : array();

        $this->types = ProjectPeer::getTypes();
        $this->departments = DepartmentPeer::getAllDepartments();
        $this->projectRoles = ProjectRolePeer::doSelect(new Criteria());
        $this->keyWords = $this->getRequestParameter('keywords'); 
        
    }
    /**
     * executeInsertProjectMember - insert project member
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeInsertProjectMember(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $projectMemberData = array(
               'userIds'=>$this->getRequestParameter('userId'),
               'roleIds'=>$this->getRequestParameter('projectRole'),
               'otherRoles'=>$this->getRequestParameter('otherRole')
            );
            $this->getUser()->setAttribute('projectMemberData', $projectMemberData);
            return $this->redirect('project/addDocument');
        }else{
            $this->forward404();
        }
    }
    public function _validateMember(){
        $userIds = $this->getRequestParameter('userId');
        $roleIds = $this->getRequestParameter('projectRole');
        if(!count($userIds)){
            $this->getRequest()->setError('memberNull', '项目成员不能为空');
            return false;
        }
        if($this->getUser()->getGuardUser()->getIsSuperAdmin()) return true;
        

        return true;
    }
    public function validateInsertProjectMember(){
        return $this->_validateMember();
    }
    public function handleErrorInsertProjectMember(){
        return $this->forward('project', 'addProjectMember');
    }

    /**
     * 
     * insertInitData - insert tender history table data
     * @author you.wu <you.wu@expacta.com.cn>
     */
    private function insertInitData($project){
        $data = $project->toArray();
        $data['ProjectId'] = $project->getId();
        $data['TenderingStatus'] = $project->getTenderingStatus();
        $projectHistory = new ProjectHistory();
        $projectHistory->fromArray($data);
        $projectHistory->save();
    }
    private function insertProject($projectData){
        $project = new Project();
        $project->setType($projectData['type']);
        $project->setPhase($projectData['phase']);
        $project->setName($projectData['name']);
        $project->setLongName($projectData['longName']);
        $project->setProprietor($projectData['proprietor']);
        $project->setStartDate($projectData['startDate']);
        $project->setEndDate($projectData['endDate']);
        $project->setBlockNumber($projectData['blockNumber']);
        $project->setIsBuyTheTenderDocument($projectData['isBuy']);
        $project->setTenderDocumentPrice($projectData['price']);
        $project->setTenderingStatus($projectData['tenderingStatus']);
        $project->setComment($projectData['comment']);
        $project->setModifier($projectData['modifier']);
        $project->setCreator($projectData['creator']);
        $project->save();
        if( $project->getPhase() == ProjectPeer::TENDERING_PHASE){
            $this->insertInitData($project);
        }
        return $project;
    }
    private function insertProjectMember($project, $userIds, $roleIds, $otherRoles){
        $criteria = new Criteria();
        $criteria->add(ProjectMemberPeer::PROJECT_ID, $project->getId());
        ProjectMemberPeer::doDelete($criteria); 
        foreach($userIds as $key=>$userId){
            $projectMember = new ProjectMember();
            $projectMember->setProjectId($project->getId());
            $projectMember->setSfGuardUserId($userId);
            $projectMember->setProjectRoleId(isset($roleIds[$key]) ? $roleIds[$key] : 0);
            $projectMember->setOtherRoleName(isset($otherRoles[$userId]) ? $otherRoles[$userId] : null);
            $projectMember->save();
        }
    }
    
    //insert document
    public function executeAddDocument(){ 
        if(!$this->getuser()->hasAttribute('projectMemberData')) $this->redirect('dashboard/index');
        $this->projectData = $projectData = $this->getUser()->getAttribute('projectData');
        if($this->getUser()->hasAttribute('documentData')){
            $this->documents = $this->getUser()->getAttribute('documentData');
        }else{
            $this->documents = array();
        }
    }
    public function executeInsertDocument(){
        $projectData  = $this->getUser()->getAttribute('projectData');
        $projectMemberData = $this->getUser()->getAttribute('projectMemberData');
        $titles = $this->getRequestParameter('title') ? $this->getRequestParameter('title') : array();
        $issues = $this->getRequestParameter('issue') ? $this->getRequestParameter('issue') : array();
        $documentNumbers = $this->getRequestParameter('documentNumber') ? $this->getRequestParameter('documentNumber') : array();
        $contractNumbers = $this->getRequestParameter('contractNumber') ? $this->getRequestParameter('contractNumber') : array();
        $documentData = array(
                'titles' => $titles,
                'issues' => $issues,
                'documentNumbers' => $documentNumbers,
                'contractNumbers' => $contractNumbers
        );
        $this->getUser()->setAttribute('documentData', $documentData);       
        if($projectData['phase'] == ProjectPeer::TENDERING_PHASE || ProjectPeer::OUTSOURCE_PROJECT == $projectData['type']){
            //insert project
            $project = $this->insertProject($projectData);          
            $userIds = $projectMemberData['userIds'];
            $roleIds = $projectMemberData['roleIds'] ? $projectMemberData['roleIds'] : array();
            $otherRoles = $projectMemberData['otherRoles'] ? $projectMemberData['otherRoles'] : array();
            //insert project memeber
            $this->insertProjectMember($project, $userIds, $roleIds, $otherRoles);
            //insert document 
            $this->insertDocument($documentData, $projectData, $project->getId());                   
            $this->setFlash('msg',1);
            return $this->redirect('project/index?type=' . $project->getType().'&id=' . $project->getId());
        }
        return $this->redirect('project/addMilestone'); 
          
    }
    /**
     * 
     * @param      $documentData $projectData $projectId    
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-13    
     * @issue      2329 - docuemt manager
     * @desc       insert document-project datas
     */
    private function insertDocument($documentData, $projectData, $projectId){
        $proprietor  = $projectData['proprietor'];
        $blockNumber = !empty($projectData['blockNumber']) ? $projectData['blockNumber'] : null;
        $modifier = $projectData['modifier'];
        $titles = $documentData['titles'];
        $issues = $documentData['issues'];
        $contractNumbers = $documentData['contractNumbers'];
        $documentNumbers = $documentData['documentNumbers'];
        $projectName = $projectData['name'];
        if(isset($titles)){
            foreach ($titles as $key=>$title){
                $document = new Document();
                $document->setTitle(trim($title));
                $document->setIssue(isset($issues[$key])?trim($issues[$key]):null);
                $document->setContractNumber(isset($contractNumbers[$key])?trim($contractNumbers[$key]):null);
                $document->setDocumentNumber(isset($documentNumbers[$key])?trim($documentNumbers[$key]):null);
                $document->setProprietor($proprietor);
                $document->setNew($projectName);
                $document->setBlockNumber($blockNumber);
                $document->setModifier($this->getUser()->getUserId());
                $document->save();
                $documentId = $document->getId();
                $projectDocument = new ProjectDocument();
                $projectDocument->setDocumentId($documentId);
                $projectDocument->setProjectId($projectId);
                $projectDocument->save();
            }
        }
    }
    
    //insert milestone
    public function executeAddMilestone(){
        if(!$this->getuser()->hasAttribute('documentNumber')  && !$this->getuser()->hasAttribute('projectMemberData')) $this->redirect('dashboard/index');
        $this->projectData = $this->getUser()->getAttribute('projectData');
    }  
    /**
    * executeInsertMilestone - insert milestone
    * @author you.wu <you.wu@expacta.com.cn>
    */ 
    public function executeInsertMilestone(){
        $projectData = $this->getUser()->getAttribute('projectData');
        $project = $this->insertProject($projectData);
        $projectMemberData = $this->getUser()->getAttribute('projectMemberData');
        $userIds = $projectMemberData['userIds'];
        $roleIds = $projectMemberData['roleIds'];
        $otherRoles = $projectMemberData['otherRoles'];
        $this->insertProjectMember($project, $userIds, $roleIds, $otherRoles);
        //session  - document
        $documentData = $this->getUser()->getAttribute('documentData');
        $this->insertDocument($documentData, $projectData, $project->getId());      
        $dates = $this->getRequestParameter('time');
        $contens = $this->getRequestParameter('content');
        foreach($dates as $key=>$date){
            if($date){
                $mileStone = new Milestone();
                $mileStone->setProjectId($project->getId());
                $mileStone->setIsCompleted(0);
                $date = $date ? $date : null;
                $mileStone->setDeadline($date);
                $mileStone->setDescription($contens[$key]);
                $mileStone->save();
            }
        }
        $this->setFlash('msg',1);
        return $this->redirect('project/index?msg=1&id=' . $project->getId());
    }


    public function executeEdit(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($this->project);
        if(!$this->project->isUserInProjectOrProjectCreater($this->getUser())) $this->redirect('dashboard/index');
        $this->types = ProjectPeer::getTypes();
    }
    /**
    * executeUpdate - update project
    * @author you.wu <you.wu@expacta.com.cn>
    */
    public function executeUpdate(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
            $this->forward404Unless($project);
            $startDate = $this->getRequestParameter('startDate') ? $this->getRequestParameter('startDate') : null;
            $endDate = $this->getRequestParameter('endDate') ? $this->getRequestParameter('endDate') : null;
            $comment = htmlspecialchars(nl2br($this->getRequestParameter('comment')));
            $modifier = $this->getUser()->getUserId();

            if($project->getPhase()  == ProjectPeer::TENDERING_PHASE){
                $phase = ProjectPeer::TENDERING_PHASE;
                $blockNumber = null;
                $isBuy = $this->getRequestParameter('isBuy');
                if($this->getRequestParameter('isBuy')){
                    $price = $this->getRequestparameter('price');
                }else{
                    $price = null;
                }
                $tenderingStatus = $this->getRequestparameter('tenderingStatus');
            }elseif(($project->getType() == ProjectPeer::OUTSOURCE_PROJECT) || $project->getPhase()  == ProjectPeer::PROJECT_PHASE){
                $phase = ProjectPeer::PROJECT_PHASE;
                $blockNumber = $this->getRequestParameter('blockNumber');
                $isBuy = 0;
                $price = null;
                $tenderingStatus = null;
            }
            $project->setStartDate($startDate);
            $project->setEndDate($endDate);
            $project->setBlockNumber($blockNumber);
            $project->setIsBuyTheTenderDocument($isBuy);
            $project->setTenderDocumentPrice($price);
            $project->setTenderingStatus($tenderingStatus);
            $project->setComment($comment);
            $project->setModifier($modifier);
            if($project->getPhase() == ProjectPeer::TENDERING_PHASE){
                $changeArray = array(
                     'StartDate'=>$startDate,
                     'EndDate'=>$endDate, 
                     'IsBuyTheTenderDocument'=>$isBuy, 
                     'TenderingStatus'=> $tenderingStatus,
                     'TenderDocumentPrice'=>$price,
                     'Comment'=>$comment,
                     'Modifier'=>$modifier
                );           
                $project->checkChangeAndInsertData($changeArray); 
            }
            $project->save();
            $this->setFlash('msg',1);
            return $this->redirect('project/edit?id=' . $project->getId() . '&' . html_entity_decode(util::formGetQuery("keywords", "type")));
        }
    }
    public function validateUpdate(){
        $project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($project);
        $check = true;
        $mileStones = $this->getMileStones($project);
        $startDate = $this->getRequestParameter('startDate') ? $this->getRequestParameter('startDate') : null;
        $endDate = $this->getRequestParameter('endDate') ? $this->getRequestParameter('endDate') : null;
        
        foreach($mileStones as $mileStone){
            $deadLineForStart = $mileStone->getDeadline();
            if($deadLineForStart < $startDate){
                $this->getRequest()->setError("startDate", '阶段时间点小于项目的开始时间了。请重新填写。'); 
                $check = false;
                break;
            }
        }

        foreach($mileStones as $mileStone){
            $deadLineForEnd = $mileStone->getDeadline();
            if( $deadLineForEnd > $endDate){
                $this->getRequest()->setError("endDate", '阶段时间点大于项目的结束时间了。请重新填写。'); 
                $check = false;
                break;
            }
        }
        
        if($project->getPhase() == ProjectPeer::TENDERING_PHASE){
            if($this->getRequestParameter('ef')){
                $price = trim($this->getRequestparameter('price'));
                if(!$this->_validatePrice($price)){
                   $check = false;
                }
            }

            if(!$this->getRequestParameter('tenderingStatus')){
                $this->getRequest()->setError("tenderingStatus", '投标状态必选'); 
                $check = false;
            }
        }elseif( ($project->getType() == ProjectPeer::OUTSOURCE_PROJECT) || ($project->getPhase() == ProjectPeer::PROJECT_PHASE)){
            if(!$this->getRequestParameter('blockNumber')){
                $this->getRequest()->setError("blockNumber", '标段号不能为空'); 
                $check = false;
            }
        }
        return $check;
    }
    public function handleErrorUpdate(){
        return $this->forward('project', 'edit');
    }
    private function getMileStones($project){
        $criteria = new Criteria();
        $criteria->add(MilestonePeer::PROJECT_ID, $project->getId());
        return MilestonePeer::doSelect($criteria);
    }
    public function executeCompleteProject(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($this->project);
    }
    /**
     * 
     * executeUpdateCompleteProject - complete project
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeUpdateCompleteProject(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
            $this->forward404Unless($project);

            $project->setIsProjectEnd($this->getRequestParameter('completeType'));
            $comment = htmlspecialchars(nl2br($this->getRequestParameter('comment')));
            $project->setProjectEndComment($comment);
            //set project pharse
            $project->setPhase(ProjectPeer::PROJECT_STOP);
            try{
                $project->save();
            }catch(Exception $e){
                return $this->redirect('project/completeProject?id='. $project->getId()  . '&'. html_entity_decode(util::formGetQuery("keywords", "type").'&msg=3') );
            }
            
            return $this->redirect('project/completeProject?id=' .$project->getId() . '&' . html_entity_decode(util::formGetQuery("keywords", "type")) . '&msg=1' );
        }else{
           $this->forward404();
        }
   }
   
    public function handleErrorUpdateCompleteProject(){
        return $this->forward('project', 'completeProject');
    }

    public function executeCompleteTender(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        if(!$this->project->isUserInProjectOrProjectCreater($this->getUser())) $this->redirect('dashboard/index');
        $this->forward404Unless($this->project);
   }
   /**
    * executeUpdateCompleteTender - update completeTender
    * @author you.wu <you.wu@expacta.com.cn>
    */
    public function executeUpdateCompleteTender(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $id = $this->getRequestParameter('id');
            $project = ProjectPeer::retrieveByPK($id);
            $this->forward404Unless($project);
            if($project->getPhase() == ProjectPeer::PROJECT_PHASE){
                //return $this->forward404();
                return $this->redirect('project/completeTender?id='. $project->getId()  . '&'. html_entity_decode(util::formGetQuery("keywords", "type").'&msg=2') );
            }
            $project->setPhase(ProjectPeer::PROJECT_PHASE);
            $startDate = $this->getRequestParameter('startDate') ? $this->getRequestParameter('startDate') : null;
            $endDate = $this->getRequestParameter('endDate') ? $this->getRequestParameter('endDate') : null;
            $project->setStartDate($startDate);
            $project->setEndDate($endDate);
            $blockNumber = $this->getRequestParameter('blockNumber');
            $project->setBlockNumber($blockNumber);
            $comment = htmlspecialchars(nl2br($this->getRequestParameter('comment')));
            $project->setComment($comment);
            try{
                $project->save();
            }catch(Exception $e){
                return $this->redirect('project/completeTender?id='. $project->getId()  . '&'. html_entity_decode(util::formGetQuery("keywords", "type").'&msg=3') );
            }
            // modifiter document block_mumber datas;
            $c = new Criteria();
            $c->add(ProjectDocumentPeer::PROJECT_ID, $id);
            $projectDocuments = ProjectDocumentPeer::doSelect($c);
            foreach ($projectDocuments as $projectDocument){
                $projectDocument->getDocument()->setBlockNumber($blockNumber);
                $projectDocument->save();
            }
            return $this->redirect('project/completeTender?id='. $project->getId()  . '&'. html_entity_decode(util::formGetQuery("keywords", "type").'&msg=1') );
        }  else {
            $this->forward404();
        }
    }
    public function handleErrorUpdateCompleteTender(){
            return $this->forward('project', 'completeTender');
    }
    /**
     * @return     true false
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-15
     * @issue      2326 - project manager
     * @desc       validate type and tender if  had value,
     *             if have,   return true;
     */
    public function executeCheckType(){
        $status = false;
        $type = $this->getRequestParameter('types');
        $isTender = $this->getRequestParameter('isTender');
        if($type || $isTender){
            $status = true;
        }
        exit($status);
    }
    /**
     * @return     true false
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-15
     * @issue      2326 - project manager
     * @desc       validate project to return to page value,
     *             and if Modified,
     *             if have  , return true;
     */
    public function executeCheckProject(){
        $status = false;
        $startDate = $this->getRequestParameter('startDate') ? $this->getRequestParameter('startDate').' 00:00:00' : null;
        $endDate = $this->getRequestParameter('endDate') ? $this->getRequestParameter('endDate').' 00:00:00'  : null;
        $paramets = array(
                //public information
                'Name' => $this->getRequestParameter('projectName'),
                'LongName' => $this->getRequestParameter('projectLongName'),
                'Proprietor' => $this->getRequestParameter('proprietor'),
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'Comment' => htmlspecialchars(nl2br($this->getRequestParameter('comment'))),
                //outsource project and inner project infomation
                'BlockNumber' => $this->getRequestParameter('blockNumber'),
                //tender infomation
                'IsBuyTheTenderDodument' => $this->getRequestParameter('isBuy'),
                'TenderingStatus' => $this->getRequestparameter('tenderingStatus'),
                'TenderDocumentPrice' => $this->getRequestparameter('price')
        );
        if($this->getRequestParameter('id')){
            $paramets = array(
                    'StartDate' => $startDate,
                    'EndDate' => $endDate,
                    'Comment' => htmlspecialchars(nl2br($this->getRequestParameter('comment'))),
                    'BlockNumber' => $this->getRequestParameter('blockNumber'),
            );
            $project = ProjectPeer::retrieveByPK($this->getRequestParameter('id'));
            //validate tender data
            if($this->getRequestParameter('isBuy') || $this->getRequestparameter('price') || $this->getRequestparameter('tenderingStatus')){
                $isBuy = $this->getRequestParameter('isBuy');
                $TenderingStatus =$this->getRequestparameter('tenderingStatus');
                $price = $this->getRequestparameter('price');
                $paramets = array(
                    'StartDate' => $startDate,
                    'EndDate' => $endDate,
                    'Comment' => htmlspecialchars(nl2br($this->getRequestParameter('comment'))),
                    'IsBuyTheTenderDocument'=>$isBuy,
                    'TenderDocumentPrice'=>$price,
                    'TenderingStatus'=>$TenderingStatus
                );
                
            }
            
            $status = util::isModified($project, 'ProjectPeer', $paramets);
        }else{
            foreach($paramets as $paramet){
                if($paramet != null){
                    $status = true;
                }
            }
        }
         
        exit($status);
    }
    /**
     * @return     true, false
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-15
     * @issue      2326 - project manager
     * @desc       validate completeProject and completeTender to return to page value,
     *             and if Modified,
     *             if have  , return true;
     */
    public function executeCheckComplete(){
        $status = false;
        $startDate = $this->getRequestParameter('startDate') ? $this->getRequestParameter('startDate').' 00:00:00' : null;
        $endDate = $this->getRequestParameter('endDate') ? $this->getRequestParameter('endDate').' 00:00:00' : null;
        $paramets = array(
                'StartDate' => $startDate,
                'EndDate' => $endDate,
                'Comment' => $this->getRequestParameter('comment'),
                'BlockNumber' => $this->getRequestParameter('blockNumber'),
        ); 
        $complete = $this->getRequestParameter('complete');
        if($complete){
            $completeType = $this->getRequestParameter('completeType');
            $comment = $this->getRequestParameter('comment');
            if($comment || $completeType){
                $status = true;
            }
        }else{
            $id = $this->getRequestParameter('id');
            $c = new Criteria();
            $c->add(ProjectPeer::ID, $id);
            $project = ProjectPeer::doSelectOne($c);
            $status = util::isModified($project, 'ProjectPeer', $paramets);
        } 
        
        exit($status);
    }  

    public function executeCheckProjectMember(){
        $roleIds = $this->getRequestParameter('projectRole');
        if(count($roleIds)){
            $roleValues = array_count_values($roleIds);
            if(isset($roleValues[0]) || $roleValues[0] > 0){
                echo '1';
                exit;
            }
            if(!isset($roleValues[4]) || $roleValues[4] == 0){
                echo '2';
                exit;
            }elseif(isset($roleValues[4]) && $roleValues[4] > 1){
                echo '3';
                exit;
            }

            foreach($roleValues as $key=>$value){
                if($roleValues[$key] > 1){
                    echo '4';
                    exit;
                }
            }
        }
        echo '0';
        exit;
    }   
}