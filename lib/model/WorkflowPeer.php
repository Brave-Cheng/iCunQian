<?php

/**
 * Subclass for performing query and update operations on the 'workflow' table.
 *
 * 
 *
 * @package lib.model
 */
class WorkflowPeer extends BaseWorkflowPeer {

    protected static function getResponseData($applicationWorkFlows){
        foreach ($applicationWorkFlows as $applicationWorkFlow) {
            $userId = $applicationWorkFlow->getSfGuardUserId();
            $profile = sfGuardUserProfilePeer::getProfileByUserId($userId);
            $approvedBy = $profile->getLastName() . $profile->getFirstName();
            $workFlow = $applicationWorkFlow->getWorkFlow();
            $departmentId = $workFlow->getDepartmentId();
            $department = DepartmentPeer::retrieveByPK($departmentId);
            $departmentName = $department ? $department->getName() : null;
            $titleId = $workFlow->getTitleId();
            $roleId = $workFlow->getProjectRoleId();
            $role = ProjectRolePeer::retrieveByPK($roleId);
            $roleName = $role ? $role->getName() : null;
            $sortOrder = $workFlow->getSortOrder();
            $title = TitlePeer::getTitleName($userId, $titleId);
            $titleName = $title ? $title->getName() : null;
            $responseData[] = array(
                    'id' => $applicationWorkFlow->getId(),
                    'approvedBy' => $approvedBy,
                    'department' => $departmentName,
                    'title' => $titleName,
                    'role' => $roleName,
                    'sortOrder' => $sortOrder,
                    'approvedAt' => $applicationWorkFlow->getApprovalTime(),
                    'status' => $applicationWorkFlow->getApprovalResult(),
                    'comment' => $applicationWorkFlow->getApprovalComment(),
            );
        }
        return $responseData;
    }
    
    public static function getWorkFlowInfo($tel, $id) {
        try {
            $sfGuardUserId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $c = new Criteria();
            $c->add(ApplicationWorkFlowPeer::APPLICATION_ID, $id);
            $c->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $sfGuardUserId);
            $applicationWorkFlowOne = ApplicationWorkFlowPeer::doSelectOne($c);
            $currentSortOrder = $applicationWorkFlowOne->getWorkFlow()->getSortOrder();
            $approvalId = $applicationWorkFlowOne->getWorkFlow()->getApprovalId();
            $applicationId = $applicationWorkFlowOne->getApplicationId();
            $applicationWorkFlows = ApplicationWorkFlowPeer::getHadApprovedWorkFlows($approvalId, $currentSortOrder, $applicationId);
            $responseData = self::getResponseData($applicationWorkFlows);
            return $responseData = array('list' => $responseData);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function getWorkFlowInfoById($tel, $id) {
        try {
            $projectName = null;
            $departmentName = null;
            $status = null;
            $sfGuardUserId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $application = ApplicationPeer::retrieveByPK($id);
            $name = $application->getName();
            $profile = $application->getsfGuardUser()->getProfile();
            $submitBy = $profile->getLastName() . $profile->getFirstName();
            $submitAt = $application->getCreatedAt();
            $projectId = $application->getProjectId();
            if($projectId && ProjectPeer::retrieveByPK($projectId)){
                $projectName = ProjectPeer::retrieveByPK($projectId)->getName();
            }
            $departmentId = $application->getDepartmentId();
            if($departmentId && DepartmentPeer::retrieveByPK($departmentId)){
                $departmentName = DepartmentPeer::retrieveByPK($departmentId)->getName();
            }
            $type = $application->getApprovalId();
            if ($type == ApprovalPeer::ENGINERRING_SUMMARY) {
                $html = "engineeringSummary";
            } elseif ($type == ApprovalPeer::ENGINEERING_MATERIALS) {
                $html = "engineeringMaterials";
            } elseif ($type == ApprovalPeer::ENGINERRING_SETTLEMENT) {
                $html = "engineertingSettlement";
            }elseif($type == ApprovalPeer::ENGINEERING_GOODS){
                $html = "engineertingGoods";
            }
            $c = new Criteria();
            $c->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $sfGuardUserId);
            $c->add(ApplicationWorkFlowPeer::APPLICATION_ID, $application->getId());
            $c->addDescendingOrderByColumn(ApplicationWorkFlowPeer::ID);
            $applicationWorkFlow = ApplicationWorkFlowPeer::doSelectOne($c);
            if($applicationWorkFlow){
               $status = $applicationWorkFlow->getApprovalResult();
            }
            if($application->getIsvalid() != 1){
                $result = 1;
                $responseData = array(
                        'id' => $application->getId(),
                        'applicationId' => $application->getId(),
                        'htmlName' => $html,
                        'name' => $name,
                        'type' => ApprovalPeer::retrieveByPK($type)->getName(),
                        'submitBy' => $submitBy,
                        'status' => $status,
                        'submitAt' => $submitAt,
                        'projectId' => $application->getProjectId(), //空为没有关联的项目， 有则是关联项目的名称
                        'projectName' => $projectName, //空为没有关联的项目， 有则是关联项目的名称
                        'departmentName'=>$departmentName,
                        'htmlName'=> $html,
                        'name'=>$name,
                        'submitBy'=>$submitBy,
                        'submitAt'=>$submitAt,
                        'projectName'=>$projectName,
                        'departmentName'=>$departmentName,
                );
            }else{
                $result = 404;
                $responseData = array(
                        'id' => '',
                        'applicationId' => '',
                        'htmlName' => '',
                        'name' => '',
                        'type' => '',
                        'submitBy' => '',
                        'status' => '',
                        'submitAt' => '',
                        'projectId' => '',
                        'projectName' => '',
                        'departmentName'=>'',
                        'htmlName'=> '',
                        'name'=> '',
                        'submitBy'=> '',
                        'submitAt'=> '',
                        'projectName'=> '',
                        'departmentName'=> '',
                );
            }
            return $responseData = array('result' => $result,'list' => $responseData);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static function getWorkFlowHistoryInfo($tel, $id) {
        try {
            $sfGuardUserId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $c = new Criteria();
            $c->add(ApplicationWorkFlowPeer::APPLICATION_ID, $id);
            $c->add(ApplicationWorkFlowPeer::APPROVAL_RESULT, 0, Criteria::ALT_NOT_EQUAL);
            $applicationWorkFlows = ApplicationWorkFlowPeer::doSelect($c);
            $responseData = self::getResponseData($applicationWorkFlows);
            return $responseData = array('list' => $responseData);
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    
    public static function WhetherHadWorkFlows($approvalId, $currentSortOrder) {
        $criteria = new Criteria();
        $criteria->add(WorkflowPeer::APPROVAL_ID, $approvalId);
        $criteria->add(WorkflowPeer::SORT_ORDER, $currentSortOrder, Criteria::GREATER_THAN);
        $workFlows = WorkflowPeer::doSelect($criteria);
        return $workFlows;
    }

    /**
     * 
     * @param type $departmentId
     * @param type $titleId
     * @return type
     * @author ice
     */
    public static function getAuditorByDepartmentIdTitleId($departmentId, $titleId) {
        $c = new Criteria();
        $c->addJoin(sfGuardUserPeer::ID, DepartmentSfGuardUserPeer::SF_GUARD_USER_ID);
        $c->addJoin(sfGuardUserPeer::ID, TitleSfGuardUserPeer::SF_GUARD_USER_ID);
        $c->add(sfGuardUserPeer::IS_ACTIVE, 1);
        $c->add(DepartmentSfGuardUserPeer::DEPARTMENT_ID, $departmentId);
        $c->add(TitleSfguardUserPeer::TITLE_ID, $titleId);
        return sfGuardUserPeer::doSelectOne($c);
    }

    /**
     * Check whether there are steps approval
     * @param int $approval
     * @issue 2337
     * @author brave
     */
    public static function getTotalStepOfApproval($approval) {
        $criteria = new Criteria();
        $criteria->add(WorkflowPeer::APPROVAL_ID, $approval);
        return WorkflowPeer::doCount($criteria);
    }
    /**
     * Check whether there are steps approval
     * @param int $approval
     * @issue 2337
     * @author ice
     */
    public static function getAllWorkFlowByApprovalId($approvalId){
        $criteria = new Criteria();
        $criteria->add(WorkflowPeer::APPROVAL_ID, $approvalId);
        $criteria->addAscendingOrderByColumn(WorkflowPeer::SORT_ORDER);
        $workflows = WorkflowPeer::doSelect($criteria);
        return $workflows;
    }
    
    /**
     * get order workflow sets
     * @param int $approval
     * @issue 2337
     * @author brave
     */
    public static function getOrderedWorkflowSets($approval) {
        $stepSets = array();
        if (self::getTotalStepOfApproval($approval) == 0) {
            return $stepSets;
        }
        $workflows = self::getAllWorkFlowByApprovalId($approval);
        foreach ($workflows as $workflow) {
            $stepSets[$workflow->getSortOrder()] = $workflow->getId();
        }
        return $stepSets;
    }

    /**
     * get first approval
     * @param int $approvalId
     * @return user
     * @issue 2337
     * @author brave
     */
    public static function getFirstApproval($approvalId) {
        $criteria = new Criteria();
        $criteria->add(WorkflowPeer::APPROVAL_ID, $approvalId);
        $criteria->addAscendingOrderByColumn(WorkflowPeer::SORT_ORDER);
        return WorkflowPeer::doSelectOne($criteria);
    }

    /**
     * get next approver
     * @param int $workflowId
     * @param int $approvalId
     * @param int $projectId
     * @param int $nextWorkflowId
     * @return boolean
     * @issue 2337
     * @author brave
     */
    public static function getNextApprover($workflowId, $approvalId, $projectId, $departmentId = 0, &$nextWorkflowId = 0) {
        $stepSets = self::getOrderedWorkflowSets($approvalId);
        if ($stepSets) {
            $arrayValue = array_values($stepSets);
            $current = array_search($workflowId, $arrayValue);
            if (isset($arrayValue[$current + 1])) {
                $nextWorkflowId = $arrayValue[$current + 1];
                return self::getCurrentStepApprover($nextWorkflowId, $projectId, $departmentId);
            } else {
                return false;
            }
        }
    }

    /**
     * get the approver of current approval
     * @param int $workflowId
     * @param int $projectId
     * @return user
     * @issue 2337
     * @author brave
     */
    public static function getCurrentStepApprover($workflowId, $projectId, $departmentId=0) {
        $workflow = WorkflowPeer::retrieveByPK($workflowId);
        if ($workflow->getIsProjectRole()) {
            return ProjectPeer::getProjectRoleUser($projectId, $workflow->getProjectRoleId());
        } else {
            //$department = $departmentId ? $departmentId : $workflow->getDepartmentId();
            $department = $workflow->getDepartmentId() ? $workflow->getDepartmentId() : $departmentId;
            return WorkflowPeer::getAuditorByDepartmentIdTitleId($department, $workflow->getTitleId());
        }
    }

    /**
     * get current approver role name
     * @param int $workflowId
     * @return string
     * @issue 2337
     * @author brave
     */
    public static function getCurrentStepApproverRole($workflowId, $departmentId=0) {
        $workflow = WorkflowPeer::retrieveByPK($workflowId);
        if ($departmentId) {
            $department = DepartmentPeer::retrieveByPK($departmentId);
        }
        if ($workflow->getIsProjectRole()) {
            return $workflow->getProjectRole()->getName();
        } else {
            if ($workflow->getDepartment()) {
                return $workflow->getDepartment()->getName() . ' ' . $workflow->getTitle()->getName();
            } else {
                if($departmentId){
                    $department = DepartmentPeer::retrieveByPK($departmentId);
                    return $department->getName() . ' ' . $workflow->getTitle()->getName();
                }
            }
        }
    }

    /**
     * get an approver of approval
     * @param int $approvalId
     * @param int $projectId
     * @return user
     * @issue 2337
     * @author brave
     */
    public static function getFirstApprover($approvalId, $projectId, $departmentId=0) {
        $workflowSets = WorkflowPeer::getFirstApproval($approvalId);
        return self::getCurrentStepApprover($workflowSets->getId(), $projectId, $departmentId);
    }

    /**
     * 
     * @param int $approvalId
     * @param int $projectId
     * @issue 2337
     * @author brave
     */
    public static function getAllApproverIdOfApproval($approvalId, $projectId, $departmentId=0) {
        $userList = array();
        $workflowList = self::getOrderedWorkflowSets($approvalId);
        // You can view the approval of the Ministry of Commerce, General Manager completed  engineeringMaterials
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        $userId = $user->getId();
        if($approvalId == ApprovalPeer::ENGINEERING_MATERIALS && sfGuardUserProfilePeer::isCommercialDepartmentManagerByUserId($userId)){
            $userList[] = $userId;
        }
        if ($workflowList) {
            foreach ($workflowList as $workflowId) {
                $currentApprover = self::getCurrentStepApprover($workflowId, $projectId, $departmentId);
                if ($currentApprover) {
                    $userList[] = $currentApprover->getId();
                }
            }
        }
        return $userList;
    }

    /**
     * 
     * @param int $approvalId
     * @param int $applicationId
     * @return mixed 0=no result
     * @issue 2337
     * @author brave
     */
    public static function checkApplicationIsApproved($approvalId, $applicationId) {
        $firstApproval = self::getFirstApproval($approvalId);
        if($firstApproval){
            $criteria = new Criteria();
            $criteria->add(ApplicationWorkFlowPeer::WORKFLOW_ID, $firstApproval->getId());
            $criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $applicationId);
            $criteria->add(ApplicationWorkFlowPeer::APPROVAL_RESULT, 0, Criteria::GREATER_THAN);
            return ApplicationWorkFlowPeer::doSelectOne($criteria);
        }
        return null;
    }
}

