<?php

/**
 * dashboard actions.
 *
 * @package    oa
 * @subpackage dashboard
 * @author     ice.leng
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class dashboardActions extends BaseBackends
{
    public function preExecute(){
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessDailyReportCreate = $userProfile->moduleAccess('dailyReport', 'add');
    }
    /**
    * Executes index action
    *
    */
    /**
    * executeIndex - Get notification list
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    public function executeIndex(){
        $this->user = $this->getUser()->getGuardUser();
        $sql = 'SELECT * FROM %%notification_reciver%% AS notification_reciver 
            LEFT JOIN %%notification%% AS notification ON (notification_reciver.notification_id = notification.id) 
            WHERE notification_reciver.sf_guard_user_id = ? ';
        $tapMap = array(
            '%%notification_reciver%%' => NotificationReciverPeer::TABLE_NAME,
            '%%notification%%' => NotificationPeer::TABLE_NAME
        );
        $p = array( $this->user->getId() );
        if( $this->getRequestParameter( 'type' ) == '1' ){
            $sql .= 'AND notification.sf_guard_user_id = ? ';
            $this->type = '1';
            $p = array( $this->user->getId(), 0 );
        }else if( $this->getRequestParameter( 'type' ) == '2' ) {
            $sql .= 'AND notification.sf_guard_user_id != ? ';
            $this->type = '2';
            $p = array( $this->user->getId(), 0 );
        }
        $sql .= ' ORDER BY notification.id DESC ';
        $sql = strtr( $sql, $tapMap );
        $this->pager = DBUtil::pagerSql( $sql, $p , 'NotificationReciverPeer' );
        // modifited dailyReport if had project
        $c = new Criteria();
        $c->add(ProjectMemberPeer::SF_GUARD_USER_ID, $this->getUser()->getUserId());
        $c->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);
        $c->add(ProjectPeer::TYPE, ProjectPeer::INNER_PROJECT);
        $c->add(ProjectPeer::PHASE, ProjectPeer::PROJECT_PHASE);
        $c->add(ProjectPeer::IS_PROJECT_END, ProjectPeer::PROJECT_NOT_END);
        $c->addAscendingOrderByColumn(ProjectPeer::UPDATED_AT);
        $this->dailyReport = ProjectPeer::doSelect($c);
        $startTime = date('Y-m-d', time()) . ' 00:00:00';
        $endTime   = date('Y-m-d', time()) . ' 23:59:59';
        $criteria = new Criteria();
        $criteria->addJoin(NotificationPeer::ID, NotificationReciverPeer::NOTIFICATION_ID);
        $criteria->add(NotificationReciverPeer::SF_GUARD_USER_ID, $this->user->getId());
        $criteria->add(NotificationReciverPeer::CREATED_AT, NotificationReciverPeer::CREATED_AT . ' BETWEEN ' ."'$startTime'" .' AND ' . "'$endTime'", Criteria::CUSTOM);
        $noifices = NotificationReciverPeer::doSelect($criteria);
        $new = array();
        foreach($noifices as $noifice){
            $new[] = $noifice->getNotificationId();
        }
        $this->new = $new;
    }

    /**
    * executeDelete - Remove from notification_reciver associated data
    * @return page - Back to the index page
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    public function executeDelete()
    {
        
        $id = $this->getRequestParameter( 'deleteId' );
        $type = $this->getRequestParameter( 'type' );
        $notificationReceivers = NotificationReciverPeer::retrieveByPKs( $id );
        if( !empty($notificationReceivers) ){
            foreach( $notificationReceivers as $notificationReceiver ){
                if( $notificationReceiver ){
                    $notificationReceiver->delete();
                }else{
                    return $this->redirect( 'dashboard/index?msg=2' );
                }
            }
            return $this->redirect( 'dashboard/index?msg=1&type='.$type  );
        }
        return $this->redirect( 'dashboard/index?msg=0&type='.$type );
    }

    /**
    * executeSelectReceivers - Select the notification recipient
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    public function executeSelectReceivers(){
        $this->departments = DepartmentPeer::getAllDepartments();
        $this->keyWords = $this->getRequestParameter( 'keywords' );
    }

    /**
    * executeEditNotification - Editing content of the notification
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    public function executeEditNotification(){
        $this->receivers = $this->getRequestParameter( 'id' );
    }

    /**
    * executeAddReceivers - Parameters passed to the recipient editNotificationSuccess.php,if the argument is null, then return to selectReceiversSuccess.php
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    public function executeAddReceivers(){
        $userId = $this->getRequestParameter( 'userId' );
        if( $userId == 'all' ){
            $this->receivers = 'all';
        }else{
            $this->receivers = implode( ',', $userId );
        }
        $this->setTemplate( 'editNotification' );
    }

    /**
    * executeAddNotification - The notification added to the database, when getRequestParameter ('telephone') is equal to true, into the queue
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    public function executeAddNotification(){
        $smsQueue = new oaQueue();
        $id = $this->getUser()->getGuardUser()->getId();
        if( $this->getUser()->getGuardUser()->getIsSuperAdmin() == '1' ){
            $id = 0;
        }
        $title = $this->getRequestParameter('title') ? $this->getRequestParameter('title') : '';
        $content = $this ->getRequestParameter('content') ? $this->getRequestParameter('content') : '';
        $notificationId = util::addNotification($id, $title, $content);
        $content = $content . '【高路OA】';
        switch ( $this->getRequestParameter( 'id' ) ) {
            case 'all': 
                $resultset = $this->_getResources();
                while($resultset->next()){
                    $row = $resultset->getRow();
                    $sfUser = sfGuardUserPeer::retrieveByPK( $row['id'] );
                    if( $row['id'] != $this->getUser()->getGuardUser()->getId() && $sfUser->getIsSuperAdmin() != '1' ){
                        util::addNotificationRelation($notificationId, $row['id']);
                        if( $this->getRequestParameter( 'telephone' ) && $sfUser->getIsSuperAdmin() != '1' ){
                            $smsQueue->enqueue($sfUser->getProfile()->getTelephone(), $content, $notificationId);
                        }
                    }
                }
                break;
            default: 
                $ids = explode(',', $this->getRequestParameter( 'id' ));
                foreach ($ids as $id) {
                    if( $id != $this->getUser()->getGuardUser()->getId() ){
                        $sfUser = sfGuardUserPeer::retrieveByPK( $id );
                        if( $id != $this->getUser()->getGuardUser()->getId() && $sfUser->getIsSuperAdmin() != '1' ){
                            util::addNotificationRelation($notificationId, $id);
                            if( $this->getRequestParameter( 'telephone' ) && $sfUser->getIsSuperAdmin() != '1' ){
                                if( $this->getRequestParameter( 'telephone' ) && $sfUser->getIsSuperAdmin() != '1' ){
                                    $smsQueue->enqueue($sfUser->getProfile()->getTelephone(), $content,$notificationId);
                                }
                            }
                        }
                    }
                }
                break;
        }
        $this->redirect('dashboard/index?msg=3');
    }

    /**
    * executeView - View notifications, the notification will be seen marked as read
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    public function executeView(){
        $this->hasSignatureImage = true;
        $id = $this->getRequestParameter( 'id' );
        if(!NotificationPeer::isNotificationBelongToUser($this->getUser()->getGuardUser(), $id)) return $this->redirect('dashboard/index');
        if(!$this->getUser()->isSuperAdmin()){
            $userSignatureImage = $this->getUser()->getGuardUser()->getProfile()->getSignatureImage();
            if(!$userSignatureImage || !file_exists(sfGuardUserProfilePeer::getSignatureImageDir() . $userSignatureImage )){
                $this->hasSignatureImage = false;
            }
        }
        $this->notification = NotificationPeer::retrieveByPK( $id );
        $this->forward404Unless( $this->notification );
        if( !in_array( $this->notification->getId(), $this->getUser()->getReadingHistoryNotificationId() ) ){
            $newHistory = new ReadingHistory();
            $newHistory->setSfGuardUserId( $this->getUser()->getGuardUser()->getId() );
            $newHistory->setNotificationId( $this->notification->getId() );
            $newHistory->save();
        }
    }

    /**
    * executeChangeStatus - Change notification has been read
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2322 - System Notifications
    * @modifiter  ice.leng <ice.leng@expacta.com.cn>
    *    ajax  validate marker
    */
    public function executeChangeStatus(){
        $status = false;
        $notificationReceivers = NotificationReciverPeer::retrieveByPKs( $this->getRequestParameter( 'deleteId' ) );
        $readingHistorys = $this->getUser()->getGuardUser()->getReadingHistorys();
        $readingHistoryNotificationIds = array();
        if( !empty( $readingHistorys ) ){
            foreach ($readingHistorys as $readingHistory) {
                $readingHistoryNotificationIds[] = $readingHistory->getNotificationId();
            }
            foreach ($notificationReceivers as $notificationReceiver) {
                if(!in_array($notificationReceiver->getNotificationId(), $readingHistoryNotificationIds)){
                    $newHistory = new ReadingHistory();
                    $newHistory->setSfGuardUserId( $this->getUser()->getGuardUser()->getId() );
                    $newHistory->setNotificationId( $notificationReceiver->getNotificationId() );
                    $newHistory->save();
                    $status = true;
                }
            }
        }else{
            foreach ($notificationReceivers as $notificationReceiver) {
                $newHistory = new ReadingHistory();
                $newHistory->setSfGuardUserId( $this->getUser()->getGuardUser()->getId() );
                $newHistory->setNotificationId( $notificationReceiver->getNotificationId() );
                $newHistory->save();
                $status = true;
            }
        }
        exit($status);
    }

    public function executeEditUser(){
        if($this->getUser()->getGuardUser()->getUsername() == 'admin')$this->redirect('dashboard/index');
        $this->departments = DepartmentPeer::getAllDepartments();
        $this->userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->departmentSfUser = $this->getUser()->getGuardUser()->getDepartmentSfUser( $this->getUser()->getGuardUser() );
        $this->sfUser = $this->getUser()->getGuardUser();
    }

    public function executeUploadImage(){
        if($this->getUser()->getGuardUser()->getUsername() == 'admin')$this->redirect('dashboard/index');
        $this->sfUser = $this->getUser()->getGuardUser();
        $this->userProfile = $this->getUser()->getGuardUser()->getProfile();
        if( empty( $this->type ) ){
            $this->type = $this->getRequestParameter('type');
        }
    }

    public function executeUpdateImage(){
        $sfUser = $this->getUser()->getGuardUser();
        $this->modifierId = $sfUser->getId();
        if( $this->getRequestParameter( 'type' ) == 'headPhoto' ){
            $headPhotoImage = $this->getRequest()->getFile( 'headPhoto' );
            if( $headPhotoImage['name'] ){
                $headPhotoUploadPath = sfGuardUserProfilePeer::getHeadPhotoDir();
                if($sfUser->getId() && $headPhotoName = $sfUser->getProfile()->getHeadPhoto()){
                    @unlink($headPhotoUploadPath . $headPhotoName);
                }
                $this->headPhotoFileName = util::generateFileName( $headPhotoImage );
                $this->headPhoto = util::uploadImage( $headPhotoImage, $headPhotoUploadPath, $this->headPhotoFileName );
            }
        }else{
            $signatureImage = $this->getRequest()->getFile( 'signatureImage' );
            if( $signatureImage['name'] ){
                $signatureImageUploadPath = sfGuardUserProfilePeer::getSignatureImageDir();
                if($sfUser->getId() && $signatureImageName = $sfUser->getProfile()->getSignatureImage()){
                    @unlink($signatureImageUploadPath . $signatureImageName);
                }
                $this->signatureImageFileName = util::generateFileName( $signatureImage );
                $this->signatureImage = util::uploadImage( $signatureImage, $signatureImageUploadPath, $this->signatureImageFileName );
                //  Uniform Scale  width 150  height 100
                $imagePath = $signatureImageUploadPath . $this->signatureImageFileName;
                Image::thumb($imagePath);
            }
        }
        $this->sfUserProfile = $sfUser->getProfile();
        if( $this->headPhoto ){
            $this->sfUserProfile->setHeadPhoto( $this->headPhotoFileName );
        }
        if( $this->signatureImage ){
            $this->sfUserProfile->setSignatureImage( $this->signatureImageFileName );
        }
        $this->sfUserProfile->setModifier( $this->modifierId );
        $this->sfUserProfile->save();
        return $this->redirect( 'dashboard/uploadImage?msg=1&type=' . $this->getRequestParameter( 'type' ) );
    }

    public function validateUpdateImage(){
        if( $this->getRequestParameter( 'type' ) == 'headPhoto' ){
            $headPhoto = $this->getRequest()->getFile( 'headPhoto' );
            if( !$headPhoto['name'] ){
                $this->getRequest()->setError( 'headPhoto', '请选择要上传的照片' );
                return false;
            }
        }
        if( $this->getRequestParameter( 'type' ) == 'signatureImage' ){
            $headPhoto = $this->getRequest()->getFile( 'signatureImage' );
            if( !$headPhoto['name'] ){
                $this->getRequest()->setError( 'signatureImage', '请选择要上传的签名' );
                return false;
            }
        }
        return true;
    }

    public function handleErrorUpdateImage(){
        $this->type = $this->getRequestParameter( 'type' );
        return $this->forward("dashboard", "uploadImage");
    }

    /**
    * _handleNotification - The notification added to the database
    * @return obj - notification object
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    private function _handleNotification(){
        $notification = new Notification();
        $id = $this->getUser()->getGuardUser()->getId();
        if( $this->getUser()->getUsername() == 'admin' ){
            $id = 0;
        }
        $notification->setSfGuardUserId( $id );
        $notification->setTitle( $this->getRequestParameter( 'title' ) );
        $notification->setContent( $this->getRequestParameter( 'content' ) );
        $notification->save();
        return $notification;
    }

    /**
    * _setSmsQueueParameters - Generate the parameters into the queue
    * @param number $id - Recipient's ID
    * @param obj $notification - notification object
    * @return null or array - When the recipient ID sender ID is not equal to the return parameter array, null otherwise
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    private function _setSmsQueueParameters( $id, $notification ){
        if( $id != $this->getUser()->getGuardUser()->getId() ){
            $receiver = sfGuardUserPeer::retrieveByPK( $id );
            $this->forward404Unless( $receiver );
            $parameters = array(
                'id' => $notification->getId(),
                'content' => $notification->getContent(),
                'receiver' => $receiver->getProfile()->getTelephone()
            );
            return $parameters;
        }
        return null;
    }

    /**
    * _getResources - When a notification is sent to the all, the type of resource use while loop to retrieve data
    * @author hang.lu <hang.lu@expacta.com.cn>
    * @issue - 2332 - System Notifications
    */
    private function _getResources(){
        $sql = 'SELECT sfGuardUser.id 
                FROM %%sfGuardUser%% AS sfGuardUser 
                WHERE sfGuardUser.is_active = ? ORDER BY id ASC';
        $p = array(1);
        $tmpMap = array(
            '%%sfGuardUser%%' => sfGuardUserPeer::TABLE_NAME,
        );
        $sql = strtr($sql, $tmpMap);
        $connection = Propel::getConnection();
        $statement = $connection->prepareStatement($sql);
        $resultset = $statement->executeQuery($p);
        return $resultset;
    }

    public function handleErrorAddReceivers(){
        return $this->forward( "dashboard", "selectReceivers" );
    }

    public function handleErrorAddNotification(){
        return $this->forward( "dashboard", "editNotification" );
    }

    /**
     * executeUpdate - Update user information when a new user is created
     * $sfUser - User login information
     * $sfUserProfile - Personal Information
     * $departmentSfUser - User information associated with the department
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    public function executeUpdate()
    {
        $this->modifierId = $this->getUser()->getGuardUser()->getId();
        $sfUser = sfGuardUserPeer::retrieveByPK($this->getRequestParameter( 'id' ));
        $this->forward404Unless($sfUser);
        //save sfGuardUser
        $sfUser->setUsername( $this->getRequestParameter( 'username' ) );
        $sfUser->save();
        //save user profile
        $this->_handleUserProfile( $sfUser );
        return $this->redirect( 'dashboard/editUser?msg=1' );
    }

    private function _handleUserProfile( $sfUser ){
        $this->sfUserProfile = $sfUser->getProfile();
        if( !$this->sfUserProfile ){
            $this->sfUserProfile = new sfUserProfile();
        }
        $this->sfUserProfile->setUserId( $sfUser->getId() );
        $this->sfUserProfile->setFirstName( $this->getRequestParameter( 'first_name' ) );
        $this->sfUserProfile->setLastName( $this->getRequestparameter( 'last_name' ) );
        $this->sfUserProfile->setQq( $this->getRequestParameter( 'qq' ) );
        $this->sfUserProfile->setTelephone( $this->getRequestParameter( 'telephone' ) );
        $this->sfUserProfile->setEmail( $this->getRequestParameter( 'email' ) );
        $this->sfUserProfile->setGender( $this->getRequestParameter( 'gender' ) );
        $this->sfUserProfile->setModifier( $this->modifierId );
        $this->sfUserProfile->save();
    }

    /**
     * validateUpdate - Update verification
     * @return bool - Validation returns true, otherwise returns false
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    public function validateUpdate(){
        $sfUser = sfGuardUserPeer::retrieveByPK( $this->getRequestParameter( 'id' ) );
        if( $this->getRequestParameter( 'telephone' ) != $sfUser->getProfile()->getTelephone() ){
            $c = new Criteria();
            $c->add( sfGuardUserProfilePeer::TELEPHONE, $this->getRequestParameter( 'telephone' ) );
            $c->addJoin( sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID );
            $c->add( sfGuardUserPeer::IS_ACTIVE, 1 );
            $telephone = sfGuardUserProfilePeer::doSelectOne( $c );
            if( $telephone ){
                $this->getRequest()->setError( 'telephone', '此电话号码已存在' );
                return false;
            }
        }
        if( $this->getRequestParameter( 'email' ) != $sfUser->getProfile()->getEmail() ){
            $c = new Criteria();
            $c->add( sfGuardUserProfilePeer::EMAIL, $this->getRequestParameter( 'email' ) );
            $c->addJoin( sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID );
            $c->add( sfGuardUserPeer::IS_ACTIVE, 1 );
            $email = sfGuardUserProfilePeer::doSelectOne( $c );
            if( $email ){
                $this->getRequest()->setError( 'email', '此邮箱已存在' );
                return false;
            }
        }
        return true;
    }

    public function handleErrorUpdate(){
        return $this->forward("dashboard", "editUser");
    }

    /**
     * executeChangePassword - changePassword User
     * @author ice.leng<ice.leng@expacta.com.cn>
     * @issue - 2338 - dashboard - modifite password
     */
    public function executeChangePassword(){
        
    }
    public function handleErrorUpdateChangePassword(){
        return $this->forward("dashboard", "changePassword");
    }
    /**
     * @return     bool - false
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-18    
     * @issue      2338 - dashboard - modifite password
     * @desc       validate password if right
     */
    public function validateUpdateChangePassword(){
        $password    = md5(trim($this->getRequestParameter('password')));
        $sfUser = sfGuardUserPeer::retrieveByPK($this->getUser()->getUserId());
        $this->forward404Unless($sfUser);
        if(!$sfUser->checkPassword($password, true)){
            $this->getRequest()->setError( 'password', '原密码不匹配' );
            return false;
        }
        return true;
    } 
    /**
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-18    
     * @issue      2338 - dashboard - modifite password
     * @desc       update password
     * @modified   brave
     */ 
    public function executeUpdateChangePassword(){
        $newPassword = md5(trim($this->getRequestParameter('newPassword'))); 
        $sessionPassword = $this->getUser()->getAttribute('currentUserPassword');
        if ($sessionPassword && ($newPassword != $sessionPassword )) {
            return $this->redirect('dashboard/changePassword?id=' . $this->getUser()->getUserId() . '&msg=2');
        }
        $sfUser = sfGuardUserPeer::retrieveByPK($this->getUser()->getUserId());
        $this->forward404Unless($sfUser);
        $sfUser->setPassword( $newPassword );
        $this->getUser()->setAttribute('currentUserPassword', $newPassword);
        $sfUser->save();
        return $this->redirect( 'dashboard/changePassword?id='.$this->getUser()->getUserId().'&msg=1' );
        
    }
    /**
     * @return     bool - false  true
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-18    
     * @issue      2338 - dashboard - modifite password
     * @desc       validate password to return to page value,
     *             if have  , return true; 
     */
    public function executeCheckPassword(){
        $status = false;
        $password = $this->getRequestParameter('password');
        $newPassword = $this->getRequestParameter('newPassword');
        $confirmPassword = $this->getRequestParameter('confirmPassword');
        if($password || $newPassword || $confirmPassword){
            $status = true;
        }
        exit($status);
    }
    /**
     * @return     bool - false  true
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-18
     * @issue      2322 - User Management
     * @desc       validate  user info data to return to page value,
     *             and  if modifite, return true;
     */
    public function executeCheckUserInfo(){
        $status = false;
        $qq = $this->getRequestParameter('qq') ? $this->getRequestParameter('qq') : null;
        if(!$this->getRequestParameter('type')){
            $paramets = array(
                    'FirstName'=>$this->getRequestParameter('first_name'),
                    'LastName' =>$this->getRequestParameter('last_name'),
                    'Qq'       =>$qq,
                    'Gender'   =>$this->getRequestParameter('gender'),
                    'Telephone'=>$this->getRequestParameter('telephone'),
                    'Email'    =>$this->getRequestParameter('email')
            );
            $id = $this->getUser()->getUserid();
            $sfUser   = sfGuardUserPeer::retrieveByPK($id);
            $userName = $this->getRequestParameter('username');
            $c = new Criteria();
            $c->add(sfGuardUserProfilePeer::USER_ID, $id);
            $userInfo = sfGuardUserProfilePeer::doSelectOne($c);
            if(util::isModified($userInfo, 'sfGuardUserProfilePeer', $paramets)|| $userName != $sfUser->getUsername()){
                $status = true;
            }
        }else{
            $status = true;
        }
        exit($status);
    }
    /**
     * @return     bool - false true
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-18    
     * @issue      2332 - System Notifications
     * @desc
     */
    public function executeCheckReceiver(){
        $status = false;
        $userId = $this->getRequestParameter( 'userId' );
        $title = $this->getRequestParameter('title');
        $content = $this->getRequestParameter('content');
        $telephone = $this->getRequestParameter('telephone');
        if($userId || $telephone || $title || $content){
            $status = true;
        }
        exit($status);
    }
    
}
