<?php
class projectHistoryActions extends BaseBackends
{
        /**
     * executeViewHistory - view project history 
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function executeIndex(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->forward404Unless($this->project);
        if(!$this->project->isUserInProjectOrProjectCreater($this->getUser())) $this->redirect('dashboard/index');
        $sql = 'SELECT * FROM %%project_history%% AS project_history 
                WHERE project_history.project_id = ? ORDER BY project_history.id DESC, project_history . updated_at DESC';
        $p = array($this->project->getId());
        $sql = str_replace('%%project_history%%', ProjectHistoryPeer::TABLE_NAME, $sql);
        $this->pager = DBUtil::pagerSql($sql, $p, 'ProjectHistoryPeer');
        $this->options = ProjectPeer::getYesorNo();
        $this->statuss = ProjectPeer::getTenderingStatus();
        $this->colorColumn = array(
                'StartDate'=>'',
                'EndDate'=>'',
                'IsBuyTheTenderDocument'=>'',
                'TenderDocumentPrice'=>'',
                'TenderingStatus'=>'',
                'Comment'=>'',
                'Modifier'=>''
        );
    }
    
    /**
     * get this module access 
     * @issue 2347
     * @modified brave
     */
    public function preExecute() {
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
    }
}
