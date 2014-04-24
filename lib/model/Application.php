<?php

/**
 * Subclass for representing a row from the 'application' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Application extends BaseApplication
{   
    public function currentUserApproval($userId){
        $criteria = new Criteria();
        $criteria->add(ApplicationWorkFlowPeer::SF_GUARD_USER_ID, $userId);
        $criteria->add(ApplicationWorkFlowPeer::APPLICATION_ID, $this->getId());
        $applicatinWorkFlowObj = ApplicationWorkFlowPeer::doSelectOne($criteria);
        if($applicatinWorkFlowObj){
            return $applicatinWorkFlowObj->getApprovalResult() > 0 ? true : false;
        }
        return true;
    }
}
