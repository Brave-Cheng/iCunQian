<?php

/**
 * Subclass for representing a row from the 'sign_in' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SignIn extends BaseSignIn
{
    /**
     * getUserInfo - get user information 
     * @return user Object 
     * @author you.wu <you.wu@expacta.com.cn>
     * @issue - 2339 - Sign in to view and statistics
     */
    public function getUserInfo(){
        if(!$this->getSfGuardUserId()) return null;
        $criteria = new Criteria();
        $criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getSfGuardUserId());
        $userInfo = SfGuardUserProfilePeer::doSelectOne($criteria);
        return $userInfo;
    }
    /**
     * getProjectInfo - get project information 
     * @return project Object 
     * @author you.wu <you.wu@expacta.com.cn>
     * @issue - 2339 - Sign in to view and statistics
     */
    public function getProjectInfo(){
        if(!$this->getProjectId()) return null;
        $projectInfo = ProjectPeer::retrieveByPK($this->getProjectId());
        return $projectInfo;
    }
    
}
