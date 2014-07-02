<?php

/**
 * Subclass for representing a row from the 'project_member' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ProjectMember extends BaseProjectMember
{
    public function getMemberUser(){
        if(!$this->getSfGuardUserId()) return null;
        $criteria = new Criteria();
        $criteria->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, criteria::LEFT_JOIN);
        $criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getSfGuardUserId());
        $criteria->add(sfGuardUserPeer::IS_ACTIVE, 1);
        $user = sfGuardUserProfilePeer::doSelectOne($criteria);
        return $user;
    }
    
    public function getMemberRole(){
        if(!$this->getProjectRoleId()) return null;
        $criteria = new Criteria();
        $role = ProjectRolePeer::retrieveByPK($this->getProjectRoleId());
        return $role;
    }
    

}
