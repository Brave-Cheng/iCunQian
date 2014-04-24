<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer
{
    const COMMERCIALDEPARTMENT_ID = 3;
    const MANAGER_ID = 2;
    const DEPARTMENT_MANAGER = 6;


    public static function getUserByTel($tel){
        $c = new Criteria();
        $c->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID, Criteria::LEFT_JOIN);
        $c->add(sfGuardUserProfilePeer::TELEPHONE, $tel);
        $c->add(sfGuardUserPeer::IS_ACTIVE, 1);
        $user = sfGuardUserProfilePeer::doSelectOne($c);
        if(!$user){
            $result = 0;
            $reponse = util::getMessage(message::USER_IS_NOT_EXIST);
            echo urldecode(json_encode(array('result'=>$result,'reponse'=>$reponse)));
            exit;
        }else{
            return $user;
        }      
    }
    
    /**
     * get user info 
     * @param int $id
     * @return mixed 
     * @issue <2333> 
     * @modified brave
     */
    public static function getUserInfoById($id) {
        $c = new Criteria();
        $c->add(sfGuardUserProfilePeer::USER_ID, $id);
        $userObj = sfGuardUserProfilePeer::doSelectOne($c);
        if ($userObj) {
            $userObj->getFullname = $userObj->getLastname() . $userObj->getFirstname();
        }
        return $userObj;
    }
    /**
     * @return Session  SfGuardUserId 
     */   
    public static function authorizationLogin($tel, $password){
        try {
            $sfGuardUserId = self::getUserByTel($tel)->getUserId();
            $sfUser = sfGuardUserPeer::retrieveByPK($sfGuardUserId);
            $user   = $sfUser->checkPassword($password, true);
            if($user){
                $sfGuardUserId = sfContext::getInstance()->getUser();
                $sfGuardUserId->setAttribute('sfGuardUser', self::getUserByTel($tel));
                $result  = 1;
                $reponse = util::getMessage(message::LOGIN_SUCCESSFULLY);
            }else{
                $result  = 0;
                $reponse = util::getMessage(message::LOGIN_FAILED);
            }
            $responseData = array('result'=>$result, 'reponse'=>$reponse);
            return $responseData;
        }catch(Exception $e){
            throw $e;
        }
    }
    public static function changePassword($tel, $oldPassword, $newPassword){
        try {
            $sfGuardUserId = self::getUserByTel($tel)->getUserId();
            $user   = sfContext::getInstance()->getUser();
            $sfUser = sfGuardUserPeer::retrieveByPK($sfGuardUserId);
            $check = $sfUser->checkPassword($oldPassword, true);
            if($check){
                $result  = 1;
                $user->setAttribute('oldPassword', $oldPassword);
                $sfUser->setPassword($newPassword);
                $sfUser->save();
                $reponse = util::getMessage(message::CHANGE_PASSWORD_SUCCESSFULLY);
            }else{
                $result  = 0;
                $reponse = util::getMessage(message::CHANGE_PASSWORD_FAILED);
            }
            $responseData = array('result'=>$result, 'reponse'=>$reponse);
            return $responseData;
        }catch(Exception $e){
            throw $e;
        }
    }
    public static function forgetPassword($tel){
        try {
            $user = self::getUserByTel($tel);
            if($user){
                //send  
                $result      = 1;
                $newPassword = util::randomPassword();                  
                $msg = urldecode(util::getMessage(message::NEW_PASSWORD).":");
                $smsQueue = new oaQueue(new SmsText());
                $smsQueue->sendSmsMessage($tel, $msg.$newPassword.'【高路OA】');
                $md5Password = md5($newPassword);
                $sfGuardUserId = self::getUserByTel($tel)->getUserId();
                $guardUser = sfGuardUserPeer::retrieveByPK($sfGuardUserId);
                $guardUser->setPassword($md5Password);               
                $guardUser->save();
                $mailer = util::initPhpMailer();
                $mailer->Subject = util::getI18nMessage( '四川高路交通信息工程有限公司OA系统 新密码' );
                $mailer->AddAddress($guardUser->getProfile()->getEmail(), $guardUser->getProfile()->getLastName() . $guardUser->getProfile()->getFirstName() );
                $user = sfContext::getInstance()->getUser();
                $user->setAttribute( 'forgotPasswordUser', $guardUser );
                $user->setAttribute( 'forgotPasswordNewPassword', $newPassword);
                $mailer->MsgHTML(util::getContentFromController( 'renderEmail', 'forgotPassword' ));
                $mailer->Send();
                
                $reponse = util::getMessage(message::GET_NEW_PASSWORD_SUCCESSFULLY);                
            }else{
                $result  = 0;
                $reponse = util::getMessage(message::USER_OR_NAME_IS_NOT_EXIST);
            }
            $responseData = array('result'=>$result, 'reponse'=>$reponse);
            return $responseData;
        }catch(Exception $e){
            throw $e;
        }
    }
    public static function uploadSignatureImage($tel){
        try{ 
            $path = sfGuardUserProfilePeer::getSignatureImageDir();
            $image = $_FILES['formVariables'];
            if($image['name']){
                   $pathInfo = pathinfo($image["name"]);
                   $fileName = md5(uniqid("image")) . "." . $pathInfo["extension"];
                   $errorMessage = '';               
                   if(!Validation::allowImage($pathInfo["extension"])){
                        $errorMessage = urldecode(util::getMessage(message::IMAGE_TYPE_IS_ERROR));  
                   }
                   if(!$errorMessage){
                       if(move_uploaded_file($image["tmp_name"], $path . $fileName)){
                            $result   = 1;
                            $sfGuardUserId = self::getUserByTel($tel)->getUserId();
                            $userInfo = self::getUserInfoById($sfGuardUserId);
                            $userInfo->setSignatureImage($fileName);
                            $userInfo->save();
                            $response = $userInfo->getUpdatedAt();  
                       }else{
                            $result   = 0;
                            $response = util::getMessage(message::UPLOAD_FILE_FAIL);
                       }
                   }else{
                       $resutl = 0;
                       $response = util::getMessage($errorMessage);
                   }         
            }else{
                $result   = 0;
                $response = util::getMessage(message::YOU_NOT_UPLOAD_FILE);
            }
            $responseData = array('result'=>$result, 'reponse'=>$response);
            return $responseData; 
         }catch(Exception $e){
            throw $e;
         }
    }
    public static function getUserInfo($tel){
        try {
            $sfGuardUserId = self::getUserByTel($tel)->getUserId();                    
            $userObj = self::getUserInfoById($sfGuardUserId);
            $c = new Criteria();
            $c->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $sfGuardUserId);
            $c->addJoin(TitleSfGuardUserPeer::TITLE_ID, TitlePeer::ID);
            $title = TitlePeer::doSelectOne($c);
            $titleName = $title ? $title->getName() : null;
            $userInfo = array();
            if($userObj){
                $userInfo = array(
                        'first_name'=>$userObj->getFirstName() ? $userObj->getFirstName() : null ,
                        'last_name'=>$userObj->getLastName() ? $userObj->getLastName() : null,
                        'gender'=>$userObj->getGender() ? $userObj->getGender() : null,
                        'telephone'=>$userObj->getTelephone() ? $userObj->getTelephone() : null,
                        'qq'=>$userObj->getQq() ? $userObj->getQq() : null,
                        'email'=>$userObj->getEmail() ? $userObj->getEmail() : null,
                        'title'=>$titleName,
                        'superiorLeaders'=>$userObj->getSuperiorLeaders() ? $userObj->getSuperiorLeaders() : null,
                        'headPhoto'=>$userObj->getHeadPhoto() ? $userObj->getHeadPhoto() : null,
                        'signatureImage'=>self::getSingatureImageUrl($userObj->getSignatureImage()) ? self::getSingatureImageUrl($userObj->getSignatureImage()) : null,
                        'sendTime'=>$userObj->getUpdatedAt() ? $userObj->getUpdatedAt() : null,
                );
            }
            return $userInfo;
        }catch(Exception $e){
            throw $e;
        }
    }
    public static function updateUserInfo($tel,$userParams){
        try {
            $erroMessage = array();
            // name
            if(empty($userParams['name'])){
                $erroMessage['name'] = util::getMessage(message::NAME_IS_NOT_BLANK);
            }
            //tel         
            if($userParams['telephone']){    
                if(!Validation::validateTel($userParams['telephone'])){                   
                    $erroMessage['tel'] = util::getMessage(message::TEL_FORMAT_ERROR);
                }            
            }
            //email
            if($userParams['email']){
                if(!Validation::validateEmail($userParams['email'])){
                    $erroMessage['email'] = util::getMessage(message::EMAIL_FORMAT_ERROR);
                }
            }
            //update     
            $sfGuardUserId = self::getUserByTel($tel)->getUserId();
            $userObj = sfGuardUserPeer::retrieveByPK($sfGuardUserId);    
            if(count($erroMessage)){
                $result  = 0;
                $reponse = $erroMessage;
            }elseif($userObj){
                $result = 1;
                $userObj->setName($userParams['name']);
                $userObj->setGender($userParams['gender']);
                $userObj->setTelephone($userParams['telephone']);
                $userObj->setEmail($userParams['email']);
                $userObj->setTitle($userParams['title']);
                $userObj->setSuperiorLeaders($userParams['superiorLeaders']);
                $userObj->setHeadPhoto($userParams['headPhoto']);
                $userObj->setQq($userParams['qq']);
                $userObj->setSignatureImage($userParams['signatureImage']);
                $userObj->save();
                $reponse = util::getMessage(message::UPDATE_USER_SUCCESSFULLY);
            }else{
                $result  = 0;
                $reponse = util::getMessage(message::USER_IS_NOT_EXIST);
            }   
            $responseData = array('result'=>$result, 'reponse'=>$reponse);    
            return $responseData;                     
        }catch(Exception $e){
            throw $e;
        }        
    }

    public static function getSignatureImageDir(){
        $uploadDir = util::getUploadDir();
        $signImageDir = $uploadDir . 'signImage' . DIRECTORY_SEPARATOR;
        if(!is_dir($signImageDir)){
            util::createDir($signImageDir);
        }
        return $signImageDir;
    }

    public static function getSingatureImageUrl($fileName){
        $signImageUrl = '';
        if(empty($fileName)) return $signImageUrl;
        $uploadUrl = util::getUploadUrl();
        $signImageUrl = $uploadUrl . '/signImage/' . $fileName;
        return $signImageUrl;
    }

    public static function getHeadPhotoDir(){
        $uploadDir = util::getUploadDir();
        $headPhotoDir = $uploadDir . 'headPhoto' . DIRECTORY_SEPARATOR;
        if(!is_dir($headPhotoDir)){
            util::createDir($headPhotoDir);
        }
        return $headPhotoDir;
    }

    public static function getHeadPhotoUrl($fileName){
        $uploadUrl = util::getUploadUrl();
        $headPhotoUrl = $uploadUrl . '/headPhoto/' . $fileName;
        return $headPhotoUrl;
    }
    
    public static function getProfileByUserId($userId){
        $c = new Criteria();
        $c->add(sfGuardUserProfilePeer::USER_ID, $userId);
        $profile = sfGuardUserProfilePeer::doSelectOne($c);
        return $profile;
    }

/**
 * [hasSingatureImage description]
 * @param  [type]  $userId [description]
 * @return boolean         [description]
 */
    public static function hasSingatureImage($userId){
        $hasSingatureImage = true;
        $user = sfGuardUserPeer::retrieveByPK( $userId );
        $signatureImage = $user->getProfile()->getSignatureImage();
        if(!$signatureImage || !file_exists(sfGuardUserProfilePeer::getSignatureImageDir() . $signatureImage )){
            $hasSingatureImage = false;
        }
        return $hasSingatureImage ? true : null ;
    }
    
    public static function getSingeByUserId($userId){
        if(empty($userId)) return null;
        $sfUser = sfGuardUserPeer::retrieveByPK($userId);
        $profile = $sfUser->getProfile();
        return self::getSingatureImageUrl($profile->getSignatureImage());
    }
    
    public static function getCommercialDepartmentManager(){
        $c = new Criteria();
        $c->addJoin(sfGuardUserPeer::ID, DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, Criteria::LEFT_JOIN);
        $c->addJoin(sfGuardUserPeer::ID, TitleSfGuardUserPeer::SF_GUARD_USER_ID, Criteria::LEFT_JOIN);
        $c->add(DepartmentSfGuardUserPeer::DEPARTMENT_ID, self::COMMERCIALDEPARTMENT_ID);
        $c->add(TitleSfGuardUserPeer::TITLE_ID, self::MANAGER_ID);
        $sfGuardUser = sfGuardUserPeer::doSelectOne($c);
        return $sfGuardUser ? $sfGuardUser : null;
    }
    
    public static function isCommercialDepartmentManagerByUserId($userId){
        $status = false;
        $user = sfGuardUserPeer::retrieveByPK($userId);
        if(!$user) return $status;
        $c = new Criteria();
        $c->add(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, $userId);
        $c->add(DepartmentSfGuardUserPeer::DEPARTMENT_ID, self::COMMERCIALDEPARTMENT_ID);
        $department = DepartmentSfGuardUserPeer::doSelectOne($c);
        return $department;
    }
}
