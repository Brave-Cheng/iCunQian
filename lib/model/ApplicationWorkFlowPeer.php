<?php

/**
 * Subclass for performing query and update operations on the 'application_work_flow' table.
 *
 * 
 *
 * @package lib.model
 */
class ApplicationWorkFlowPeer extends BaseApplicationWorkFlowPeer {

    const PENDIND = '等待审批';
    const APPROVAL = '通过，已进入下一步审核';
    const DECLINE = '驳回';
    const AGREE = '同意，已结束审核';

    protected static function getResponseData($tel, $applicationWorkFlows){
        foreach ($applicationWorkFlows as $applicationWorkFlow) {
            $departmentName = null;
            $application = $applicationWorkFlow->getApplication();
            $departmentId = $application->getDepartmentId();
            if($departmentId && DepartmentPeer::retrieveByPK($departmentId)){
                $departmentName = DepartmentPeer::retrieveByPK($departmentId)->getName();
            }
            $name = $application->getName();
            $typeId = $application->getApprovalId();
            $type = ApprovalPeer::getApprovalNameByApplicationId($typeId);
            $typeName = $type ? $type->getName() : null;
            $profile = $application->getsfGuardUser()->getProfile();
            $submitBy = $profile->getLastName() . $profile->getFirstName();
            $submitAt = $application->getCreatedAt();
            // get application templete
            $paramets = ApplicationPeer::getFormDetail($tel, $applicationWorkFlow->getApplicationId());
            $type = isset($paramets['type']) ? $paramets['type'] : null;
            if ($type == ApprovalPeer::ENGINERRING_SUMMARY) {
                $html = "engineeringSummary";
            } elseif ($type == ApprovalPeer::ENGINEERING_MATERIALS) {
                $html = "engineeringMaterials";
            } elseif ($type == ApprovalPeer::ENGINERRING_SETTLEMENT) {
                $html = "engineertingSettlement";
            }elseif($type == ApprovalPeer::ENGINEERING_GOODS){
                $html = "engineertingGoods";
            }
            $projectName = $application->getProject() ? $application->getProject()->getName() : null;
            $responseData[] = array(
                    'id' => $applicationWorkFlow->getApplicationId(),
                    'applicationId' => $applicationWorkFlow->getApplicationId(),
                    'htmlName' => $html,
                    'name' => $name,
                    'type' => $typeName,
                    'submitBy' => $submitBy,
                    'status' => $applicationWorkFlow->getApprovalResult(),
                    'submitAt' => $submitAt,
                    'projectId' => $application->getProjectId(), //空为没有关联的项目， 有则是关联项目的名称
                    'projectName' => $projectName, //空为没有关联的项目， 有则是关联项目的名称
                    'departmentName'=>$departmentName,
            );
        }
        return $responseData;
    }
    
    public static function getWorkFlows($tel) {
        try {
            $sfGuardUserId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $c = new Criteria();
            $c->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $sfGuardUserId);
            $c->add(ApplicationWorkFlowPeer::APPROVAL_RESULT, ApprovalPeer::PENDING);
            $c->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);
            $c->add(ApplicationPeer::IS_VALID, null);
            $c->addDescendingOrderByColumn(ApplicationWorkFlowPeer::ID);
            $applicationWorkFlows = ApplicationWorkFlowPeer::doSelect($c);
            $responseData = self::getResponseData($tel, $applicationWorkFlows);
            return $responseData = array('list' => $responseData);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static function getApplicationWorkFlowHistories($tel, $num=20, $page=1) {
        try {
            $sfGuardUserId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            if(empty($num)) $num = 20;
            if($page>1) $page = 1;
            $offset = ($page -1 ) * $num;
            $c = new Criteria();
            $c->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $sfGuardUserId);
            $c->add(ApplicationWorkFlowPeer::APPROVAL_RESULT, ApprovalPeer::PENDING, Criteria::ALT_NOT_EQUAL);
            $c->addJoin(ApplicationWorkFlowPeer::APPLICATION_ID, ApplicationPeer::ID);
            $c->add(ApplicationPeer::IS_VALID, null);
            $total = ceil(ApplicationWorkFlowPeer::doCount($c)/$num);
            $c->setLimit($num);
            $c->setOffset($offset);
            $c->addDescendingOrderByColumn(ApplicationWorkFlowPeer::ID);
            $applicationWorkFlows = ApplicationWorkFlowPeer::doSelect($c);
            $responseData = self::getResponseData($tel, $applicationWorkFlows);
            return $responseData = array('list' => $responseData);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * get approval status list
     * @return array
     * @issue 2337
     * @author brave
     */
    public static function getApplicationWorkflowStatus($status = false) {
        $statusList = array(
            0 => self::PENDIND,
            1 => self::APPROVAL,
            2 => self::DECLINE,
            3 => self::AGREE,
        );
        return $status === false ? $statusList : $statusList[$status];
    }

    /**
     * return the result of approval
     * @param int $applicationId
     * @return object
     * @issue 2337
     * @author brave iceia->add()  wuyou modified
    */
    public static function getApplicationResults($applicationId, $notPending=false) {
        $criteria = new Criteria();
        $criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $applicationId);
        if($notPending){
            $criteria->add(ApplicationWorkFlowPeer::APPROVAL_RESULT,ApprovalPeer::PENDING, Criteria::ALT_NOT_EQUAL);
        }
        $criteria->addAscendingOrderByColumn(ApplicationWorkFlowPeer::ID);
        return ApplicationWorkFlowPeer::doSelect($criteria);
    }

    /**
     * insert an approval
     * @param int $applicationId
     * @param int $workflowId
     * @param int $approver
     * @param int $result
     * @param string $approveComment
     * @return mixed
     * @issue 2337
     * @author brave
     */
    public static function insertApplicationWorkflow($applicationId, $workflowId, $approver, $result = 0, $approveComment = '') {
        try {
            $criteria = new Criteria();
            $criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $applicationId);
            $criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $workflowId);
            if (($applicationWorkflow = ApplicationWorkFlowPeer::doSelectOne($criteria))) {
                $applicationWorkflow = ApplicationWorkFlowPeer::retrieveByPK($applicationWorkflow->getId());
            } else {
                $applicationWorkflow = new ApplicationWorkFlow();
            }
            $applicationWorkflow->fromArray(
                    array(
                        'ApplicationId' => $applicationId,
                        'WorkflowId' => $workflowId,
                        'SfGuardUserId' => $approver,
                        'ApprovalResult' => $result,
                        'ApprovalComment' => $approveComment,
                        'ApprovalTime' => date('Y-m-d H:i:s'),
                    )
            );
            $applicationWorkflow->save();
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * set first application status
     * @param int $applicationId
     * @param int $workflowId
     */
    public static function setFirstApplicationStatus($applicationId, $workflowId) {
        $application = ApplicationPeer::retrieveByPK($applicationId);
        $firstApprover = WorkflowPeer::getFirstApprover($application->getApprovalId(), $application->getProjectId());
        $criteria = new Criteria();
        $criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $applicationId);
        $criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $firstApprover->getId());
        $criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $workflowId);
        $res = ApplicationWorkFlowPeer::doSelectOne($criteria);
        if ($res && $res->getApprovalResult() > 0) {
            ApplicationPeer::updateApplicationStatus($applicationId, 1);
        }
    }

    /**
     * check the application step exist
     * @param int $applicationId
     * @param int $step
     * @return boolean 0-not exist
     * @issue 2337
     * @author brave
     */
    public static function checkApplicationWorkflowStepExist($applicationId, $step = 0) {
        $criteria = new Criteria();
        $criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $applicationId);
        if ($step) {
            $criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $step);
        }
        return ApplicationWorkFlowPeer::doCount($criteria);
    }

    public static function getHadApprovedWorkFlows($approvalId, $currentSortOrder, $applicationId) {
        $criteria = new Criteria();
        $criteria->add(WorkflowPeer::APPROVAL_ID, $approvalId);
        $criteria->add(WorkflowPeer::SORT_ORDER, $currentSortOrder, Criteria::LESS_THAN);
        $criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $applicationId);
        $criteria->addJoin(ApplicationWorkFlowPeer::WORKFLOW_ID, WorkflowPeer::ID);
        $applicationWorkFlows = ApplicationWorkFlowPeer::doSelect($criteria);
        return $applicationWorkFlows;
    }
    /**
     * 
     * @param int $applicationId
     * @param int $workflowId
     * @param int $approvalResult
     * @param string $approvalComment
     * @author brave
     * @issue 2337
     */
    public static function setApplicationResult($applicationId, $workflowId, $approvalResult, $approvalComment) {
        $last = '';
        $application = ApplicationPeer::retrieveByPK($applicationId);
        $workflow = WorkflowPeer::retrieveByPK($workflowId);
        $approver = Approver::createApprover();
        $approver->setApplication($application);
        $approver->setWorkflow($workflow);
        $approver->setApproveAdvice($approvalComment);
        $approver->setApproveStatus($approvalResult);
        try{
            $approver->commitCurrentApproval();
        }catch(Exception $ex){
            throw new Exception($ex->getMessage());
        }
        sfLoader::loadHelpers('Url');
        $url = ApplicationPeer::getRedirectPageByApproval($application->getApprovalId(), $application->getId(), true);
        $linkUrl = url_for($url);
        $createrInfo = $application->getSfGuardUser()->getProfile();
        $currentApprover = WorkflowPeer::getCurrentStepApprover($workflow->getId(), $application->getProjectId(), $application->getDepartmentId());
        //send a notification
        if($approvalResult == '2'){
            $result = "审批为";
        }else{
            $result = "审批通过";
        }
        
        if($application->getProject()){
            $firstTitleContent = $application->getProject()->getName() . '项目的 ' . $application->getName() . '，经由 ' . $workflow->getDescription() . ' ' . $currentApprover->getProfile()->getLastName() . $currentApprover->getProfile()->getFirstName() . $result;
        }else{
            $firstTitleContent = $application->getName() . '，经由 “' .DepartmentPeer::retrieveByPK($application->getDepartmentId())->getName(). $workflow->getDescription() . ' ' . $currentApprover->getProfile()->getLastName() . $currentApprover->getProfile()->getFirstName() . $result;
        }
        switch ($approvalResult) {
            case 2:
                $title = $firstTitleContent . '驳回，意见为：' . $approvalComment . '。请针对意见做出修改后重新提交。';
                break;
            default :
                $nextApprover = WorkflowPeer::getNextApprover($workflow->getId(), $application->getApprovalId(), $application->getProjectId(), $application->getDepartmentId());
                if ($nextApprover) {
                    $sfUserDepartment = DepartmentSfGuardUserPeer::getDepartmentSfUserBySfGuardUserId($createrInfo->getUserId());
                    $notificationId = util::addNotification(0, '您有由 ' . $sfUserDepartment->getDepartment()->getName() . ' ' . $createrInfo->getLastName() . $createrInfo->getFirstName() . ' 提交的新审批', $firstTitleContent . '，现在需要您进行审批。<br/> <a class="read" href="' . $linkUrl .'">跳转到审批</a>');
                    util::addNotificationRelation($notificationId, $nextApprover->getProfile()->getUserId());
                    //send short message
                    $smsQueue = new oaQueue();
                    $smsQueue->enqueue($nextApprover->getProfile()->getTelephone(), '您有由 ' . $sfUserDepartment->getDepartment()->getName() . $createrInfo->getLastName() . $createrInfo->getFirstName() . ' 提交的新审批，现在需要您进行审批。', $notificationId);
                    
                    $last = '目前正在等待下一步审核人 ' . $nextApprover->getProfile()->getLastName() . $nextApprover->getProfile()->getFirstName() . ' 的受理。';
                }
                $title = $firstTitleContent . '，意见为：' . $approvalComment . '。' . $last;
                break;
        }
        $whetherHadWorkFlows = WorkflowPeer::WhetherHadWorkFlows($application->getApprovalId(), $workflow->getSortOrder());
        if($application->getApprovalId() == 3 && empty($whetherHadWorkFlows)){
            //发通知给商务部经理
            $receiver = sfGuardUserProfilePeer::getCommercialDepartmentManager();
            if($receiver){
                $notificationId = util::addNotification(0, $application->getName() . '的审核已审核', $createrInfo->getLastName() . $createrInfo->getFirstName() . '的' . $application->getName() . '已经通过审核，请查看。<br/> <a class="read" href="' . $linkUrl .'">跳转到审批</a>');
                util::addNotificationRelation($notificationId, $receiver->getId());
                //send short message
                $smsQueue = new oaQueue();
                $smsQueue->enqueue($receiver->getProfile()->getTelephone(), $createrInfo->getLastName() . $createrInfo->getFirstName() . '的' . $application->getName() . '已经通过审核，请查看', $notificationId);
            }
        }
        $notificationId = util::addNotification(0, '您的' . $application->getName() . '审核结果为' . ApplicationWorkFlowPeer::getApplicationWorkflowStatus($approvalResult), $title);
        util::addNotificationRelation($notificationId, $application->getSfGuardUserId());
        //send short message
        $smsQueue = new oaQueue();
        $smsQueue->enqueue($application->getsfGuardUser()->getProfile()->getTelephone(), '您的' . $application->getName() . '审核结果为' . ApplicationWorkFlowPeer::getApplicationWorkflowStatus($approvalResult) . '。 ' . $title, $notificationId);
    }

    /**
     * 
     * @param int $userId
     * @param int $approvalId
     * @return boolean
     * @author brave
     * @issue 2337
     */
    public static function checkUserShowApproval($userId, $approvalId, $projectId, $departmentId=0) {
        $userList = WorkflowPeer::getAllApproverIdOfApproval($approvalId, $projectId, $departmentId);
        return in_array($userId, $userList);
    }

    public static function isBelongApplication( $user, $id ){
        $status = false;
        $userId = $user->getId();
        $c = new Criteria();
        $c->add(ApplicationWorkFlowPeer::APPLICATION_ID, $id);
        $c->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $userId);
        $applicationWorkFlow = ApplicationWorkFlowPeer::doSelect($c);
        $application = ApplicationPeer::retrieveByPK($id);
        $isSuperAdmin = $user->getIsSuperAdmin();
        if($application && $application->getSfGuardUserId() == $userId || $applicationWorkFlow || $isSuperAdmin ){
            $status = true;
        }
        return $status;
    }
    
}
