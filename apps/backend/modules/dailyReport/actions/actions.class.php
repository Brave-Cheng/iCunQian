<?php
 /**
 * dailyReport actions.
 *
 * @package    oa
 * @subpackage dailyReport
 * @author     ice.leng<ice.leng@expacta.com.cn>
 * @version    2328 - dailyRepost manager
 */
class dailyReportActions extends BaseBackends
{
    public function preExecute(){
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->showAll = sfGuardUserProfile::hasPermission('showAll');
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        if($this->getUser()->getGuardUser()->getIsSuperAdmin() != 1){
            $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        }
    }
    /**
     *
     * @param      $projectId - project id
     *             $startTime - page to return to start time
     *             $endTime   - page to return to end time
     * @return     page
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25
     * @issue      2328 - dailyRepost manager
     * @desc       daily repost list
     */
    public function executeList(){
        $this->projectId = $projectId = $this->getRequestParameter('projectId');
        if(!DailyReportPeer::isProjectMemberByProjectId($projectId, $this->getUser()->getGuardUser()) && $this->getUser()->getGuardUser()->getIsSuperAdmin() != 1 ) $this->redirect('dashboard/index');
        $this->startTime = $startTime = $this->getRequestParameter('startTime');
        $this->endTime   = $endTime = $this->getRequestParameter('endTime');
        $project = ProjectPeer::retrieveByPK($projectId);
        $this->forward404Unless($project);
        $this->projectName = $project->getName();
        $projectRole = ProjectRolePeer::getProjectRoleByUserId($this->getUser()->getUserId(), $project->getId());
        if( $startTime == '' && $endTime == '' ){
            $startTime = date('Y-m-d', (time()-24*3600));
            $endTime = date('Y-m-d');
        }elseif($startTime && $endTime){
            if($startTime > $endTime){
                $this->title = 1;
            }
        }elseif($startTime == ''){
            $startTime = date('Y-m-d');
        }elseif($endTime == ''){
            $endTime = date('Y-m-d');
        }
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $p   = array($projectId, $startTime, $endTime);
        $sql = "SELECT * FROM %%dailyReport%%
                WHERE %%dailyReport%%.PROJECT_ID=? ";
        if(!sfGuardUserProfile::isVicePresident($projectId)){     
            $sql.="AND %%dailyReport%%.SF_GUARD_USER_ID=? ";
            $p   = array($projectId, $this->getUser()->getUserId(), $startTime, $endTime);
        }
        $sql.= " AND %%dailyReport%%.REPORT_DATE BETWEEN  ? AND  ?";
        $sql.= "ORDER BY %%dailyReport%%.REPORT_DATE DESC";
    
        $sql = str_replace("%%dailyReport%%" , DailyReportPeer::TABLE_NAME, $sql);
        $this->pager = DBUtil::pagerSql($sql, $p, 'DailyReportPeer');
    }
    /**
     *
     * @param      null
     * @return     project object
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25
     * @issue      2328 - dailyRepost manager
     * @desc       select project
     */
    public function executeSelectProject(){
        $c = new Criteria();
        $c->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getUser()->getUserId());
        $c->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);
        $c->add(ProjectPeer::TYPE, ProjectPeer::INNER_PROJECT);
        $c->add(ProjectPeer::PHASE, ProjectPeer::PROJECT_PHASE);
        $c->add(ProjectPeer::IS_PROJECT_END, ProjectPeer::PROJECT_NOT_END);
        $c->addAscendingOrderByColumn(ProjectPeer::UPDATED_AT);
        $this->projects = $project = ProjectPeer::doSelect($c);
        if(count($project) == '1'){
            $projectId = isset($project[0]) ? $project[0]->getId() : null;
            $this->getUser()->setAttribute('onlyProject', 1);
            $this->redirect('dailyReport/add?projectId=' . $projectId);
        }
    }
    /**
     * @param      $projectId - page to return to project id
     *             $id
     * @return     project name , dailyReport object
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25
     * @issue      2328 - dailyRepost manager
     * @desc       add  daily report data
     */
    public function executeAdd(){
        $this->only = $this->getUser()->getAttribute('onlyProject');
        $this->projectId = $projectId = $this->getRequestParameter('projectId');
        $project = ProjectPeer::retrieveByPK($projectId);
        $this->forward404Unless($project);
        $this->projectName = $project->getName();
        $c = new Criteria();
        $c->add(DailyReportPeer::SF_GUARD_USER_ID, $this->getUser()->getUserId());
        $c->add(DailyReportPeer::PROJECT_ID, $projectId);
        $c->add(DailyReportPeer::REPORT_DATE, date('Y-m-d'));
        $dailyReportObj = DailyReportPeer::doSelectOne($c);
        $this->dailyReportObj = $dailyReportObj;
        
    
    }
    public function handleErrorInsert(){
        $projectId = $this->getRequestParameter('projectId');
        return $this->forward("dailyReport", "add");
    }
    /**
     * @param      $projectId - page to return to project id
     *             $content  -  page to return to content
     * @return     add daily report page
     *             id  - daily report IdentityMapper
     *             projectId - project Id
     *             msg - judge number
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25
     * @issue      2328 - dailyRepost manager
     * @desc       save  daily report data
     */
    public function executeInsert(){
        $content   = $this->getRequestParameter('content');
        $projectId = $this->getRequestParameter('projectId');
        $dailyReport = new DailyReport();
        $dailyReport->setProjectId($projectId);
        $dailyReport->setSfGuardUserId($this->getUser()->getUserId());
        $dailyReport->setReportDate(date('Y-m-d', time()));
        $dailyReport->setContent($content);
        $dailyReport->save();
        $id = $dailyReport->getId();
        return $this->redirect('dailyReport/add?id='.$id.'&projectId='.$projectId.'&msg=1');
    }  
    /**
     *
     * @param      $id - page to return to dailyReport id
     * @return     dailyReport object
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25
     * @issue      2328 - dailyRepost manager
     * @desc       get dailyReport data by id
     */
    public function executeRead(){
        $id = $this->getRequestParameter('id');
        $this->dailyReportObj = DailyReportPeer::retrieveByPK($id);
        $this->forward404Unless($this->dailyReportObj);
        if($this->dailyReportObj->getSfGuardUserId() != $this->getUser()->getGuardUser()->getId() && $this->getUser()->getGuardUser()->getIsSuperAdmin() != 1 ) $this->redirect('dashboard/index');
    }
    public function executeCheckDailyReport(){
        $status = false;
        $content = $this->getRequestParameter('content');
        $addPage = $this->getRequestParameter('addPage');
        if($addPage){
            $status = $content ? true : false;
        }else{
            $status = true;
        }  
        exit($status);
    }
}
