<?php
class projectMilestoneActions extends BaseBackends
{
    
    /**
     * get this module access 
     * @issue 2347
     * @modified brave
     */
    public function preExecute() {
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
        $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
    }
    
    
    private static $mileStoneCompleteStatus = array(
        array('status' => 0, 'msg' => '抱歉,您不是该项目的成员，不能执行此操作！'),
        array('status' => 1, 'msg' => '发送通知给项目经理成功！'),
        array('status' => 2, 'msg' => '已完成'),
        array('satatus'=>3, 'msg' => '你今天已经发送过通知了，不能再发送了！')
    );
    
    public function executeIndex(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($this->project);
        if(!$this->project->isUserInProjectOrProjectCreater($this->getUser())) $this->redirect('dashboard/index');
        $sql = 'SELECT * FROM %%milestone%% AS milestone 
                WHERE milestone.project_id = ? ORDER BY milestone.id ASC';
        $p  = array($this->project->getId());
        $sql = str_replace('%%milestone%%', MilestonePeer::TABLE_NAME, $sql);
        $this->pager = DBUtil::pagerSql($sql, $p, 'MilestonePeer');        
    } 
      
    public function executeAdd(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($this->project);
        $this->mileCount = $this->getMileCount($this->project->getId());
    }
    
    private function getMileCount($projectId){
        $criteria = new Criteria();
        $criteria->add(MilestonePeer::PROJECT_ID, $projectId);
        $this->count = MilestonePeer::doCount($criteria);
    }
    
    public function executeInsert(){
        $project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($project);
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
        return $this->redirect('projectMilestone/index?id=' . $project->getId());
    }
    
    public function executeEdit(){
        $this->project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($this->project);
        $this->mileStone = MilestonePeer::retrieveByPK($this->getRequestParameter('mid'));
        $this->forward404Unless($this->mileStone); 
        $this->index = $this->getRequestParameter('index');
    }
    /**
    *  executeUpdate - update Milestone
    * @author you.wu <you.wu@expacta.com.cn>
    */
    public function executeUpdate(){
        $project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($project);
        $mileStone = MilestonePeer::retrieveByPK($this->getRequestParameter('mid'));
        $this->forward404Unless($mileStone);
        $index = $this->getRequestParameter('index');
        $mileStone->setDeadline($this->getRequestParameter('time_1'));
        $mileStone->setDescription($this->getRequestParameter('content_1'));
        $mileStone->save();
        return $this->redirect('projectMilestone/edit?id=' . $project->getId() . '&' . 'mid=' . $mileStone->getId() . '&msg=1&index=' . $index);
    }
    
    public function validateUpdate(){
        $project = ProjectPeer::retrieveByPK($this->getRequestparameter('id'));
        $this->forward404Unless($project);
        $startDate = date('Y-m-d', strtotime($project->getStartDate()));
        $endDate =  date('Y-m-d', strtotime($project->getEndDate()));
        $deadDate = $this->getRequestParameter('time_1');
        if(($deadDate > $endDate) || ($deadDate < $startDate)){
            $this->getRequest()->setError('time_1', '日期要在项目时间内');
            return false;
        }
        return true;
    }
    
    public function handleErrorUpdate(){
        return $this->forward('projectMilestone', 'edit');

    }
    
    public function executeDelete(){
        $project = ProjectPeer::retrieveByPK($this->getRequestParameter('id'));
        $this->forward404Unless($project);
        $deleteIds = $this->getRequestParameter('deleteId');
        $criteria = new Criteria();
        $criteria->add(MilestonePeer::ID, $deleteIds, Criteria::IN);
        $mileStones = MilestonePeer::doSelect($criteria);
        if($mileStones){
            foreach($mileStones as $mileStone){
                $mileStone->delete();
            }
            return $this->redirect('projectMilestone/index?msg=1&id=' . $project->getId());
        }
        return $this->redirect('projectMilestone/index?msg=0&id=' . $project->getId());
    }
    
    /**
     * set milestone is complete
     * issue <2333>
     * @modified brave
     */
    public function executeSetComplete() {
        sfLoader::loadHelpers('Url');
        $status = self::$mileStoneCompleteStatus[0];
        $userId = $this->getUser()->getUserId();
        $projectId = $this->getRequestParameter('pid');
        $project = ProjectPeer::retrieveByPK($projectId);
        $milestone = MilestonePeer::retrieveByPK($this->getRequestParameter('mid'));
        $milestoneList = MilestonePeer::getProjectMilestoneList($projectId);
        $roleName = DBUtil::getProjectUserRoleName($userId, $projectId);
        $projectManagers = DBUtil::getProjectRole($projectId);
        $projectVP = DBUtil::getProjectRole($projectId,VP);
        
        $userInfo = sfGuardUserProfilePeer::getUserInfoById($userId);
        if ($roleName && $roleName != ProjectRolePeer::PROJECT_PM && $projectManagers) {
            $urlFor = url_for('projectMilestone/index?id=' . $projectId);
            $urlLink = ' <a href="' . $urlFor .'">跳转到进度列表</a>';
            $subject = "【".$userInfo->getFullname."】申请了【" . $project->getName() . "】【" . $milestoneList[$milestone->getId()] . "】计划在【" . $milestone->getDeadline() . "】结束的【" . $milestone->getDescription() . "】完成。请确认！<br />$urlLink";
            $title = '项目：' . $project->getName() . ' 阶段完成';
            if(NotificationPeer::isHadSendTooMany($userId, $title, $subject)){
                $status = self::$mileStoneCompleteStatus[3];
                exit(json_encode($status));
            }
            $notificationId = util::addNotification($userId, $title, $subject);
            $milestone->setIsApply(1);
            $milestone->save();
            foreach ($projectManagers as $projectManager) {
                util::addNotificationRelation($notificationId, $projectManager->getSfGuardUserId());
            }
            if ($projectVP) {
                foreach ($projectVP as $projectManager) {
                    util::addNotificationRelation($notificationId, $projectManager->getSfGuardUserId());
                }
            }
            
            $status = self::$mileStoneCompleteStatus[1];
        }
        
        if ($roleName && $roleName == ProjectRolePeer::PROJECT_PM) {
            $mileStone = MilestonePeer::retrieveByPK($this->getRequestParameter('mid'));
            if ($mileStone) {
                $mileStone->setIsCompleted(1);
                $mileStone->save();
                $status = self::$mileStoneCompleteStatus[2];
            }
        }
        exit(json_encode($status));
    }
    public function executeSetMilestonesComplete(){
       if($this->getRequest()->getMethod() == sfRequest::POST){
            sfLoader::loadHelpers('Url');
            $project = ProjectPeer::retrieveByPk($this->getRequestParameter('id'));
            $projectId = $project->getId();
            $userId = $this->getUser()->getUserId();
            $milestoneList = MilestonePeer::getProjectMilestoneList($projectId);
            $roleName = DBUtil::getProjectUserRoleName($userId, $projectId);
            $projectManagers = DBUtil::getProjectRole($projectId);
            $projectVP = DBUtil::getProjectRole($projectId, ProjectRolePeer::PROJECT_VP);
            $userInfo = sfGuardUserProfilePeer::getUserInfoById($userId);

            if(!$project->isUserInProject($userId)){
                return $this->redirect('projectMilestone/index?id=' . $project->getId() . '&msg=5');
            }

            $deleteIds = $this->getRequestParameter('deleteId');
            if($deleteIds){
                if ($roleName && $roleName != ProjectRolePeer::PROJECT_PM && $projectManagers) {
                        $milestones = MilestonePeer::retrieveByPKs($deleteIds);
                        foreach($milestones as $key=>$milestone){
                            $urlFor = url_for('projectMilestone/index?id=' . $projectId);
                            $urlLink = ' <a href="' . $urlFor .'">跳转到进度列表</a>';
                            $subject = "【".$userInfo->getFullname."】申请了【" . $project->getName() . "】【" . $milestoneList[$milestone->getId()] . "】计划在【" . $milestone->getDeadline() . "】结束的【" . $milestone->getDescription() . "】完成。请确认！<br />$urlLink";
                            $title = '项目：' . $project->getName() . ' 阶段完成';
                            if(NotificationPeer::isHadSendTooMany($userId, $title, $subject)){
                                $message[$key] = $milestoneList[$milestone->getId()];
                            }else{
                                $message[$key] = '';
                            }
                            if(!$message[$key]){
                                $messageForMilestone[] = $milestoneList[$milestone->getId()];
                                $notificationId = util::addNotification($userId, $title, $subject);
                                $milestone->setIsApply(1);
                                $milestone->save();

                                foreach ($projectManagers as $projectManager) {
                                    util::addNotificationRelation($notificationId, $projectManager->getSfGuardUserId());
                                }
                                if ($projectVP) {
                                    foreach ($projectVP as $projectManager) {
                                        util::addNotificationRelation($notificationId, $projectManager->getSfGuardUserId());
                                    }
                                }
                            }
                        }
                        $message = array_filter($message);
                        $msg2Flag = '';
                        if(count($messageForMilestone)){
                            $msg2Flag = '&msg2=2';
                            $msg2 = implode('，', $messageForMilestone);
                            $this->setFlash('msgs2', $msg2);
                        }

                        if(count($message)){
                            $messages = implode('，', $message);
                            $this->setFlash('msgs3', $messages);
                            return $this->redirect('projectMilestone/index?id=' . $project->getId() . '&msg=6' . $msg2Flag);
                        }
                        return $this->redirect('projectMilestone/index?id=' . $project->getId() . '&msg=2');
                    
                }

                if ($roleName && $roleName == ProjectRolePeer::PROJECT_PM) {
                    
                        $mileStones = MilestonePeer::retrieveByPKs($deleteIds);
                        foreach($mileStones as $mileStone){
                            $mileStone->setIsCompleted(1);
                            $mileStone->save();
                        }
                        return $this->redirect('projectMilestone/index?id=' . $project->getId() . '&msg=3');
                    
                }
            }else{
                return $this->redirect('projectMilestone/index?id=' . $project->getId() . '&msg=4');
            }           
        }
    }
    /**
     * @return     true, false
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-15
     * @issue      2326 - project manager
     * @desc       validate projectMilestone to return to page value,
     *             and if Modified,
     *             if have  , return true;
     */
    public function executeCheckMilestone(){
        $status = false;
        $dates = $this->getRequestParameter('time');
        $contents = $this->getRequestParameter('content');
        if($this->getRequestParameter('mid')){
            $dates = $this->getRequestParameter('time_1');
            $contents = $this->getRequestParameter('content_1');
            $c = new Criteria();
            $c->add(MilestonePeer::PROJECT_ID, $this->getRequestParameter('id'));
            $c->add(MilestonePeer::ID, $this->getRequestParameter('mid'));
            $mileston = MilestonePeer::doSelectOne($c);
            if($mileston->getDeadline() != $dates || $mileston->getDescription() != $contents){
                $status = true;
            }
        }else{           
            foreach ($dates as $date){
                if($date != null){
                    $status = true;
                    break;
                }
            }
            foreach ($contents as $content){
                if($content != null){
                    $status = true;
                    break;
                }
            }
        }
        exit($status);
    }
}
