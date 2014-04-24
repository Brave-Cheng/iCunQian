<?php
class projectStatisticsActions extends BaseBackends
{
    public function executeIndex(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($this->project);
        if(!$this->project->isUserInProjectOrProjectCreater($this->getUser())) $this->redirect('dashboard/index');
        
    }
    
    /**
     * get this module access 
     * @issue 2347
     * @modified brave
     */
    public function preExecute() {
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
    }
}
