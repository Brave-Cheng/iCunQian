<?php

/**
 * Subclass for representing a row from the 'department' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Department extends BaseDepartment
{
    public function getDepartmentUsers(){
        if(!$this->getId()) return null;
        $criteria = new Criteria();
        $criteria->addJoin(sfGuardUserProfilePeer::USER_ID, DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, Criteria::LEFT_JOIN);
        $criteria->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, Criteria::LEFT_JOIN);
        $criteria->add(DepartmentSfGuardUserPeer::DEPARTMENT_ID, $this->getId());
        $criteria->add(sfGuardUserPeer::IS_ACTIVE, 1);
        $criteria->setDistinct();
        $departmentUsers = sfGuardUserProfilePeer::doSelect($criteria);
        return $departmentUsers;
    }
    
    public function getRightMembersCount($projectId){
        $users = $this->getDepartmentUsers();
        $count = 0;
        foreach($users as $user){
            if(ProjectPeer::checkIsInProject($user->getUserId(), $projectId)){
                $count = $count +1;
            }        
        }
        return $count;
    }
    public function getLeftMembersCount($projectId){
        $users = $this->getDepartmentUsers();
        $count = 0;
        foreach($users as $user){
            if(!ProjectPeer::checkIsInProject($user->getUserId(), $projectId)){
                $count = $count +1;
            }        
        }
        return $count;
    }
    public function getNotificationMemberCount($nid){
        $user   = sfContext::getInstance()->getUser()->getGuardUser();
        $userId = $user?$user->getId():null;
        $users = $this->getDepartmentUsers();
        $count = 0;
        foreach($users as $user){
            if($user->getUserId() != $userId){
                $count = $count +1;
            }
        }
        return $count;
    }
}
