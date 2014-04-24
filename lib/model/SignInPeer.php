<?php

/**
 * Subclass for performing query and update operations on the 'sign_in' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SignInPeer extends BaseSignInPeer
{
    public static function signIn($tel, $signInfo){
        try{  
            $errorMessage = '';         
            $userId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $projectId = $signInfo['projectId'];
            if(!ProjectPeer::retrieveByPK($projectId)){
                $errorMessage = urldecode(util::getMessage(message::PROJECT_NOT_EXIST));
            }
            if(self::checkHasSignIn($userId, $projectId)){
                $errorMessage = urldecode(util::getMessage(message::SIGN_IN_FAILED));  
            }
            if($errorMessage){
                $result = 0;
                $response = $errorMessage;
            }else{          
                $result = 1;
                $signObj = new SignIn();
                $signObj->setProjectId($projectId);
                $signObj->setSfGuardUserId($userId);
                $signObj->setAddress($signInfo['address']);
                $signObj->setLattitude($signInfo['lattitude']);
                $signObj->setLongitude($signInfo['longitude']);                
                $signObj->setSignInTime(date('Y-m-d H:i:s'));               
                $signObj->save();
                $response = urldecode(util::getMessage(message::SIGN_IN_SUCCESSFULLY));
            }            
            $responseData = array('result'=>$result, 'response'=>$response); 
            return $responseData;         
        }catch(Execption $e){
            throw $e;
        }   
    }
    public static function checkHasSignIn($userId, $projectId){
        $startTime = date('Y-m-d') . ' 00:00:00';
        $endTime   = date('Y-m-d') . ' 23:59:59';
        $criteria = new Criteria();
        $criteria->add(SignInPeer::SF_GUARD_USER_ID, $userId);
        $criteria->add(SignInPeer::PROJECT_ID, $projectId);
        $criteria->add(SignInPeer::SIGN_IN_TIME, SignInPeer::SIGN_IN_TIME . ' BETWEEN ' . "'$startTime'"  .' AND ' . "'$endTime'", Criteria::CUSTOM);
        $signInObj = SignInPeer::doselectOne($criteria);
        if($signInObj){
            return true;
        }else{
            return false;
        } 
              
    }
    
    public static function getAllUsers(){
        $signInfo = SignInPeer::doSelect(new Criteria());
        $userIds = self::getUserIds($signInfo);
        $criteria = new Criteria();
        $criteria->add(sfGuardUserProfilePeer::USER_ID, $userIds, Criteria::IN);
        $userObjs = sfGuardUserProfilePeer::doSelect($criteria);
        return $userObjs;
    }
    public static function getUserIds($users){
        $userIds = array();
        foreach($users as $user){
            $userIds[] = $user->getSfGuardUserId();
        }
        return $userIds;
    }
    public static function getAllProjects(){
        $signInfo = SignInPeer::doSelect(new Criteria());
        $projectIds = self::getProjectIds($signInfo);
        $criteria = new Criteria();
        $criteria->add(ProjectPeer::ID, $projectIds, Criteria::IN);
        $projectsObj = ProjectPeer::doSelect($criteria);
        return $projectsObj;
    }
    public static function getProjectIds($projects){
        $projectIds = array();
        foreach($projects as $project){
            $projectIds[] = $project->getProjectId();
        }
        return $projectIds;
    }
}
