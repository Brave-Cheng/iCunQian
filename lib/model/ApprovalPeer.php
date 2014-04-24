<?php

/**
 * Subclass for performing query and update operations on the 'approval' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ApprovalPeer extends BaseApprovalPeer
{
    const PENDING = 0;
    const NEXT    = 1;
    const END     = 2;
    const ENGINEERING_MATERIALS = 3;
    const ENGINERRING_SETTLEMENT = 4;
    const ENGINERRING_SUMMARY = 2;
    const ENGINEERING_GOODS   = 1;
    const TITLE = '您有一条新审核通知请注意查看';
    public static function setApprove($tel, $id, $status, $comment){
        try{
            $sfGuardUserId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $c = new Criteria();
            $c->add(ApplicationWorkFlowPeer::APPLICATION_ID, $id);
            $c->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $sfGuardUserId);
            $applicationWorkFlowOne = ApplicationWorkFlowPeer::doSelectOne($c);
            if(ApplicationPeer::retrieveByPk($id)->getIsvalid() == 1){
                $result = 404;
                $reponse = util::getMessage(message::NOT_FOUND_APPLICATION);
            }elseif($applicationWorkFlowOne && $applicationWorkFlowOne->getApprovalResult() == self::PENDING ){
                $workflowId = $applicationWorkFlowOne->getWorkFlowId();
                $status = $status ? $status : 2;
                ApplicationWorkFlowPeer::setApplicationResult($id, $workflowId, $status, $comment);
                $result = 1;
                $reponse = util::getMessage(message::APPROVAL_SUCCESSFULLY);;
            }else{
                $result = 0;
                $reponse = util::getMessage(message::APPROVAL_FAILED);
             }
           $responseData = array('result'=>$result, 'reponse'=>$reponse);
           return $responseData;
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * 
     * @param      $id - ApplicationId
     * @return     return object
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-29    
     * @issue      2344 - approval manager
     * @desc       get approval objcet
     */
    public static function getApprovalNameByApplicationId($id){
        $c = new Criteria();
        $c->add(ApprovalPeer::ID, $id);
        $approval = ApprovalPeer::doSelectOne($c);
        return $approval;
    } 
    
    
    /**
     * executeSelectApprovalType- select approval type 
     * @issue 2337
     * @author brave
     */
    public static function getApprovalTypeList() {
        $approvalTypes = self::doSelect(new Criteria);
        if ($approvalTypes) {
            foreach ($approvalTypes as $key => $perType) {
                if (!$perType->getName()) {
                    unset($approvalTypes[$key]);
                }
            }
        }
        return $approvalTypes;
    }

    public static function getUserIdByDepartmentOrProject($departmentId, $title, $projectId, $projectRoleId){
        $obj = '';
        if(isset($projectId) && isset($projectRoleId)){
            $c = new Criteria();
            $c->add(ProjectMemberPeer::PROJECT_ID, $projectId);
            $c->add(ProjectMemberPeer::PROJECT_ROLE_ID, $projectRoleId);
            $obj = ProjectMemberPeer::doSelectOne($c);
        }else{
            if(!isset($departmentId) && !isset($title)) return $obj;
            $c = new Criteria();
            $c->add(DepartmentSfGuardUserPeer::DEPARTMENT_ID, $departmentId);
            $c->add(TitleSfGuardUserPeer::TITLE_ID, $title);
            $c->addJoin(TitleSfGuardUserPeer::TITLE_ID, TitlePeer::ID);
            $c->addJoin(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, TitleSfGuardUserPeer::SF_GUARD_USER_ID);
            $obj = TitleSfGuardUserPeer::doSelectOne($c);
        }
        return $obj;
    }
    
    public static function insertApplicationWorkFlow($applicationId, $workFlowId, $receiverId){
        try{
            $applicationWorkFlow = new ApplicationWorkFlow();
            $applicationWorkFlow->setApplicationId($applicationId);
            $applicationWorkFlow->setWorkflowId($workFlowId);
            $applicationWorkFlow->setSfGuardUserId($receiverId);
            $applicationWorkFlow->setApprovalResult(self::PENDING);
            $applicationWorkFlow->save();
            return $applicationWorkFlow;
        }catch(Exception $e){
            throw $e;
        }
    }
    

}
