<?php
class projectMemberActions extends BaseBackends
{
    
    public function preExecute(){
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
    }
    public function executeEdit(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        
        $this->forward404Unless($this->project);
        if(!$this->project->isUserInProjectOrProjectCreater($this->getUser())) $this->redirect('dashboard/index');
        $this->types = ProjectPeer::getTypes();
        $this->departments = DepartmentPeer::getAllDepartments();
        $this->projectRoles = ProjectRolePeer::doSelect(new Criteria());
        $this->keyWords = $this->getRequestParameter('keywords');

    }
    /**
    * executeUpdate - update project member
    * @author you.wu <you.wu@expacta.com.cn>
    */
    public function executeUpdate(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $project = ProjectPeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($project);
            $criteria = new Criteria();
            $criteria->add(ProjectMemberPeer::PROJECT_ID, $project->getId());
            ProjectMemberPeer::doDelete($criteria);            
            $userIds = $this->getRequestParameter('userId');
            $roleIds = $this->getRequestParameter('projectRole') ? $this->getRequestParameter('projectRole') : array();
            $otherRoles = $this->getRequestParameter('otherRole') ? $this->getRequestParameter('otherRole') : array();
            foreach($userIds as $key=>$userId){
                $projectMember = new ProjectMember();
                $projectMember->setProjectId($project->getId());
                $projectMember->setSfGuardUserId($userId);
                $projectMember->setProjectRoleId(isset($roleIds[$key]) ? $roleIds[$key] : 0);
                $projectMember->setOtherRoleName(isset($otherRoles[$userId]) ? $otherRoles[$userId] : null);
                $projectMember->save();
            }
            return $this->redirect('projectMember/edit?id=' .$project->getId() .'&' .html_entity_decode(util::formGetQuery('type', 'keywords').'&msg=1'));
        }
    }

    public function validateUpdate(){
        return $this->_validateMember();
    }
    private function _validateMember(){
        $userIds = $this->getRequestParameter('userId');
        $roleIds = $this->getRequestParameter('projectRole');
        if(!count($userIds)){
            $this->getRequest()->setError('memberNull', '项目成员不能为空');
            return false;
        }
        if(count($roleIds)){
            $roleValues = array_count_values($roleIds);
            if($roleValues[4] > 1){
                $this->getRequest()->setError('memberNull', '项目经理只能有一人');
                return false;
            }
        }
        if($this->getUser()->getGuardUser()->getIsSuperAdmin()) return true;
        return true;
    }
    public function handleErrorUpdate(){
        return $this->forward('projectMember', 'edit');
    }
    /**
     * @return     true, false
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-15
     * @issue      2326 - project manager
     * @desc       validate projectMember to return to page value,
     *             and if Modified,
     *             if have  , return true;
     */
    public function executeCheckMember(){
        $status = 0;
        $arr = array();
        $userIds = $this->getRequestParameter('userId');
        $projectRoles = $this->getRequestParameter('projectRole');
        $otherRoles = $this->getRequestParameter('otherRole');
        if($userIds && $otherRoles){
            foreach ($userIds as $key => $userid){
            $otherRoleName = isset($otherRoles[$userid]) ? $otherRoles[$userid] : null;
            $otherRoleNames[] = $otherRoleName;
            }
        }else{
            $otherRoleNames = $otherRoles;
        }
        $paramets = array(
                'SfGuardUserId'=>$userIds,
                'ProjectRoleId'=>$projectRoles,
                'OtherRoleName'=>$otherRoleNames
            );
        if($this->getRequestParameter('id')){
            $c = new Criteria();
            $c->add(ProjectMemberPeer::PROJECT_ID, $this->getRequestParameter('id'));
            $c->addAscendingOrderByColumn(ProjectMemberPeer::ID);
            $projectMembers = ProjectMemberPeer::doSelect($c);
            $status = util::isModified($projectMembers, 'ProjectMemberPeer', $paramets) ? '1' : '0';
        }else{
            foreach($paramets as $paramet){
                if($paramet != null){
                    $status = true;
                    break;
                }
            }
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
