<?php

/**
 * user actions - CRUD user information
 * @package    oa
 * @subpackage user
 * @author     hang.lu <hang.lu@expacta.com.cn>
 * @issue - 2322 - User Management
 */
class userActions extends BaseBackends
{
    public function preExecute(){
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
    }

    /**
     * executeIndex - enerated list of user information
     * @return page - User List page
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 -User Management
     */
    public function executeIndex()
    {
        $this->departments = DepartmentPeer::getAllDepartments();
        $this->departmentId = $this->getRequestParameter('departmentId');
        $keywords = util::replaceSpecialChar( $this->getRequestParameter( 'keywords' ) );
        $this->departmentUserCount = array();
        $sql = 'SELECT * FROM %%sf_user%% AS sf_user
        LEFT JOIN %%sf_profile%% AS profile ON (sf_user.id = profile.user_id)
        LEFT JOIN %%sf_departmentUser%% AS departmentUser ON (sf_user.id = departmentUser.sf_guard_user_id)
        LEFT JOIN %%sf_title%% AS userTitle ON (sf_user.id = userTitle.sf_guard_user_id)
        LEFT JOIN %%title%% AS title ON (userTitle.title_id = title.id)
        LEFT JOIN %%department%% AS department ON (departmentUser.department_id = department.id)
        LEFT JOIN project_member ON (sf_user.id = project_member.sf_guard_user_id)
        LEFT JOIN project ON (project_member.project_id = project.id)
        WHERE sf_user.is_active = ? 
        AND department.id = ? ';
        $tapMap = array(
            '%%sf_user%%' => sfGuardUserPeer::TABLE_NAME,
            '%%sf_profile%%' => sfGuardUserProfilePeer::TABLE_NAME,
            '%%sf_departmentUser%%' => DepartmentSfGuardUserPeer::TABLE_NAME,
            '%%department%%' => DepartmentPeer::TABLE_NAME,
            '%%sf_title%%' => TitleSfGuardUserPeer::TABLE_NAME,
            '%%title%%' => TitlePeer::TABLE_NAME,
        );
        foreach($this->departments as $department){
            if(!$keywords){
                $c = new Criteria();
                $c->addJoin(sfGuardUserPeer::ID, DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, Criteria::LEFT_JOIN);
                $c->add(DepartmentSfGuardUserPeer::DEPARTMENT_ID, $department->getId());
                $c->add(sfGuardUserPeer::IS_ACTIVE, 1);
                $this->departmentUserCount[$department->getId()] = sfGuardUserPeer::doCount( $c );
            }else{
                $p = array(1, $department->getId());
                $sqlString = ' AND ( profile.first_name like ? ';
                $p[] = "%$keywords%";
                $sqlString .= 'OR profile.last_name like ? ';
                $p[] = "%$keywords%";
                $sqlString .= "OR CONCAT_WS('', profile.last_name, profile.first_name) LIKE ? ";
                $p[] = "%$keywords%";
                $sqlString .= 'OR title.name like ? ';
                $p[] = "%$keywords%";
                $sqlString .= 'OR profile.telephone like ? ';
                $p[] = "%$keywords%";
                $sqlString .= 'OR department.name like ? ';
                $p[] = "%$keywords%";
                $sqlString .= 'OR project.name like ? ) ';
                $p[] = "%$keywords%";
                $sqlString = $sql . $sqlString;
                $sqlString = strtr( $sqlString, $tapMap );
                $sqlString = str_replace('*', ' Count(*) AS count ', $sqlString);
                $result = DBUtil::execSql($sqlString, $p);
                while($result->next()){
                    $count = $result->getRow();
                    $this->departmentUserCount[$department->getId()] = $count['count'];
                }
                unset($sqlString,$p);
            }
        }
        if( $keywords != "" || $keywords != null ){
            $p = array( 1, $this->departmentId );
            if($this->getRequestParameter('departmentId') == 'all'){
                $sql = str_replace('AND department.id = ?', '', $sql);
                $p = array(1);
            }
            $this->keywords = $keywords;
            $sql .= ' AND ( profile.first_name like ? ';
            $p[] = "%$keywords%";
            $sql .= 'OR profile.last_name like ? ';
            $p[] = "%$keywords%";
            $sql .= "OR CONCAT_WS('', profile.last_name, profile.first_name) LIKE ? ";
            $p[] = "%$keywords%";
            $sql .= 'OR title.name like ? ';
            $p[] = "%$keywords%";
            $sql .= 'OR profile.telephone like ? ';
            $p[] = "%$keywords%";
            $sql .= 'OR department.name like ? ';
            $p[] = "%$keywords%";
            $sql .= 'OR project.name like ? ) ';
            $p[] = "%$keywords%";
        }else{
            $this->departmentId = $this->getRequestParameter('departmentId') ? $this->getRequestParameter('departmentId') : 1;
            if($this->departmentId == 'all'){
                $this->departmentId = 1;
            }
            $this->keywords = null;
            $p = array(1, $this->departmentId);
        }
        $sql = strtr( $sql, $tapMap );

        $sql .= 'GROUP BY sf_user.id ORDER BY sf_user.id ASC ';
        $this->users = DBUtil::execSql( $sql, $p, 'sfGuardUserPeer' );
    }
    /**
     * _getDepartmentUser - Users get the department where
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 -User Management
     */
    private function _getDepartmentUser(){
        $id = $this->getRequestParameter( 'id' );
        if(!$this->getUser()->isSuperAdmin()) $this->redirect('dashboard/index');
        $this->sfUser = sfGuardUserPeer::retrieveByPK( $id );
        $this->forward404Unless($this->sfUser);
        $this->userProfile = $this->sfUser->getProfile();
        $this->groups = sfGuardGroupPeer::getGroups();
        $this->titleSfUser = $this->sfUser->getTitleSfGuardUserBySfUser( $this->sfUser );
        return $this->sfUser->getDepartmentSfUser( $this->sfUser );
    }

    /**
     * executeRead - Into reading page
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 -User Management
     */
    public function executeRead(){
        $this->_getDepartmentUser();
    }

    /**
     * executeEdit - Enter the EDIT page, modify existing users
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    public function executeEdit()
    {
        if(!$this->getUser()->isSuperAdmin()) $this->redirect('dashboard/index');
        $c = new Criteria();
        $c->add(sfGuardUserPeer::IS_ACTIVE, 1);
        $this->users = sfGuardUserPeer::doSelect( $c );
        $this->departments = DepartmentPeer::getAllDepartments();
        $this->titles = TitlePeer::getAllTitles();
        $this->groups = sfGuardGroupPeer::getGroups();
        if( $this->getRequestParameter( 'id' ) ){
            $this->departmentSfUser = $this->_getDepartmentUser();
        }else{
            $this->sfUser  = null;
            $this->userProfile = null;
            $this->departmentSfUser = null;
        }
    }

    /**
     * executeAdd - Add a new user
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    public function executeAdd(){
        $c = new Criteria();
        $c->add(sfGuardUserPeer::IS_ACTIVE, 1);
        $this->users = sfGuardUserPeer::doSelect( $c );
        $this->groups = sfGuardGroupPeer::getGroups();
        $this->titles = TitlePeer::getAllTitles();
        $this->departments = DepartmentPeer::getAllDepartments();
        $this->sfUser  = null;
        $this->userProfile = null;
        $this->departmentSfUser = $this->getRequestParameter('departmentId');
        $this->setTemplate('edit');
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
        $sfUserId = $this->getRequestParameter( 'id' );
        if($sfUserId){
            $sfUser = sfGuardUserPeer::retrieveByPK($this->getRequestParameter( 'id' ));
            $this->forward404Unless($sfUser);
        }else{
            $sfUser = new sfGuardUser();
        }
        $headPhotoImage = $this->getRequest()->getFile( 'headPhoto' );
        if( $headPhotoImage['name'] ){
            $headPhotoUploadPath = sfGuardUserProfilePeer::getHeadPhotoDir();
            if($sfUser->getId() && $headPhotoName = $sfUser->getProfile()->getHeadPhoto()){
                @unlink($headPhotoUploadPath . $headPhotoName);
            }
            $this->headPhotoFileName = util::generateFileName( $headPhotoImage );
            $this->headPhoto = util::uploadImage( $headPhotoImage, $headPhotoUploadPath, $this->headPhotoFileName );
        }
        $signatureImage = $this->getRequest()->getFile( 'signatureImage' );
        if( $signatureImage['name'] ){
            $signatureImageUploadPath = sfGuardUserProfilePeer::getSignatureImageDir();
            if($sfUser->getId() && $signatureImageName = $sfUser->getProfile()->getSignatureImage()){
                @unlink($signatureImageUploadPath . $signatureImageName);
            }
            $this->signatureImageFileName = util::generateFileName( $signatureImage, true );
            $this->signatureImage = util::uploadImage( $signatureImage, $signatureImageUploadPath, $this->signatureImageFileName );
            //  Uniform Scale  width 150  height 100
            $imagePath = $signatureImageUploadPath . $this->signatureImageFileName;
            Image::thumb($imagePath);
        }
        //save sfGuardUser
        $sfUser->setUsername( $this->getRequestParameter( 'username' ) );
        $password = trim($this->getRequestparameter( 'password' ));
        if( $password ){
            $password = md5( $password );
            $sfUser->setPassword( $password );
        }
        $sfUser->save();
        //save user profile
        $this->_handleUserProfile( $sfUser );
        $this->sfUserProfile->setModifier( $this->modifierId );
        $this->sfUserProfile->save();
        //save department and title
        $this->_handleDepartmentAndTitle( $sfUser );
        $this->departmentSfUser->save();
        $this->titleSfUser->save();
        //save user permission
        $this->_handleGroup( $sfUser );
        return $this->redirect( 'user/edit?msg=1&id=' . $sfUser->getId() . '&departmentId=' . $this->getRequestParameter('departmentId') );
    }

    /**
     * _handleUserProfile - update user profile data
     * @param  object $sfUser - user object
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    private function _handleUserProfile( $sfUser ){
        $this->sfUserProfile = $sfUser->getProfile();
        if( !$this->sfUserProfile ){
            $this->sfUserProfile = new sfUserProfile();
        }
        $this->sfUserProfile->setUserId( $sfUser->getId() );
        $this->sfUserProfile->setFirstName( $this->getRequestParameter( 'first_name' ) );
        $this->sfUserProfile->setLastName( $this->getRequestparameter( 'last_name' ) );
        if( $this->headPhoto ){
            $this->sfUserProfile->setHeadPhoto( $this->headPhotoFileName );
        }
        $this->sfUserProfile->setQq( $this->getRequestParameter( 'qq' ) );
        $this->sfUserProfile->setTelephone( $this->getRequestParameter( 'telephone' ) );
        $this->sfUserProfile->setEmail( $this->getRequestParameter( 'email' ) );
        $this->sfUserProfile->setSuperiorLeaders( $this->getRequestParameter( 'superiorLeaders' ) );
        $this->sfUserProfile->setGender( $this->getRequestParameter( 'gender' ) );
        if( $this->signatureImage ){
            $this->sfUserProfile->setSignatureImage( $this->signatureImageFileName );
        }
    }

    /**
     * _handleDepartmentAndTitle - Update department and title data
     * @param  object $sfUser - user object
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    private function _handleDepartmentAndTitle( $sfUser ){
        $this->departmentSfUser = $sfUser->getDepartmentSfUser( $sfUser );
        if( !$this->departmentSfUser ){
            $this->departmentSfUser = new DepartmentSfGuardUser();
        }
        $this->departmentSfUser->setDepartmentId( $this->getRequestParameter( 'departmentId' ) );
        $this->departmentSfUser->setSfGuardUserId( $sfUser->getId() );
        $this->titleSfUser = $sfUser->getTitleSfGuardUserBySfUser( $sfUser );
        if( !$this->titleSfUser ){
            $this->titleSfUser = new TitleSfGuardUser();
        }
        $this->titleSfUser->setSfGuardUserId( $sfUser->getId() );
        $this->titleSfUser->setTitleid( $this->getRequestParameter('titleId') );
    }

    /**
     * _handleGroup - update group data
     * @param  [type] $sfUser [description]
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    private function _handleGroup( $sfUser ){
        $userGroups = $sfUser->getGroups();
        if(!empty($userGroups)){
            $sql = 'DELETE FROM sf_guard_user_group WHERE user_id = ?';
            $p = array( $sfUser->getId() );
            DBUtil::execSql( $sql, $p );
        }
        $userGroup = new sfGuardUserGroup();
        $userGroup->setUserId( $sfUser->getId() );
        $userGroup->setGroupId( 1 );
        $userGroup->save();
        if( $this->getRequestParameter( 'groupIds' ) ){
            foreach($this->getRequestParameter('groupIds') as $groupId){
                $userGroup = new sfGuardUserGroup();
                $userGroup->setUserId( $sfUser->getId() );
                $userGroup->setGroupId( $groupId );
                $userGroup->save();
            }
        }
    }

    /**
     * validateUpdate - Update verification
     * @return bool - Validation returns true, otherwise returns false
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    public function validateUpdate(){
        if( !$this->getRequestParameter('id') ){
            if( !$this->getRequestParameter( 'password' ) ){
                $this->getRequest()->setError( 'password', '密码不能为空' );
                return false;
            }
            if( !$this->getRequestParameter( 'passwordConfirm' ) ){
                $this->getRequest()->setError( 'passwordConfirm', '确认密码不能为空' );
                return false;
            }
            if( $this->getRequestParameter( 'password' ) != $this->getRequestParameter( 'passwordConfirm' ) ){
                $this->getRequest()->setError( 'passwordConfirm', '两次密码不相同' );
                return false;
            }
            $c = new Criteria();
            $c->add( sfGuardUserProfilePeer::TELEPHONE, $this->getRequestParameter( 'telephone' ) );
            $c->addJoin( sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID );
            $c->add( sfGuardUserPeer::IS_ACTIVE, 1 );
            $telephone = sfGuardUserProfilePeer::doSelectOne( $c );
            if( $telephone ){
                $this->getRequest()->setError( 'telephone', '此电话号码已存在' );
                return false;
            }
            $c = new Criteria();
            $c->add( sfGuardUserProfilePeer::EMAIL, $this->getRequestParameter( 'email' ) );
            $c->addJoin( sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID );
            $c->add( sfGuardUserPeer::IS_ACTIVE, 1 );
            $email = sfGuardUserProfilePeer::doSelectOne( $c );
            if( $email ){
                $this->getRequest()->setError( 'email', '此邮箱已存在' );
                return false;
            }
            return true;
        }
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
        return $this->forward("user", "edit");
    }

    /**
     * executeDelete - Delete User
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    public function executeDelete()
    {
        $departmentId = $this->getRequestParameter( 'departmentId' ) ? $this->getRequestParameter( 'departmentId' ) : 1;
        $id = $this->getRequestParameter( 'deleteId' );
        $sfUsers = sfGuardUserPeer::retrieveByPKs( $id );
        if( !empty($sfUsers) ){
            foreach( $sfUsers as $sfUser ){
                if( $sfUser ){
                    if( $sfUser->getId() == $this->getUser()->getGuardUser()->getId() ){
                        $this->setFlash('msg', 3);
                        return $this->redirect( 'user/index' );
                    }
                    $sfUser->setIsActive( '0' );
                    $sfUser->save();
                }
            }
            $this->setFlash('msg', 1);
            return $this->redirect( 'user/index?departmentId=' . $departmentId .'&keywords=' . $this->getRequestParameter('keywords'));
        }
        $this->setFlash('msg', 0);
        return $this->redirect( 'user/index?departmentId=' . $departmentId . '&keywords=' . $this->getRequestParameter('keywords'));
    }

    /**
     * executeLeaveCheck - When users edit the data, leaving the page prompts
     * @return number 1 or 0 - 1 indicates that the user modifies the data, it will pop-up boxes, 0 immediately leave the page
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    public function executeLeaveCheck(){
        $isModified = false;
        if( $this->getRequestParameter('id') ){
            $sfUser = sfGuardUserPeer::retrieveByPK( $this->getRequestParameter( 'id' ) );
            $this->_handleUserProfile( $sfUser );
            if( $this->sfUserProfile->isModified() ){
                $isModified = true;
            }
            $this->_handleDepartmentAndTitle($sfUser);
            if( $this->departmentSfUser->isModified() ){
                $isModified = true;
            }
            if( $this->titleSfUser->isModified() ){
                $isModified = true;
            }
            $oldGroups = $sfUser->getGroups();
            $oldGroupIds = array();
            foreach ($oldGroups as $oldGroup) {
                $oldGroupIds[] = $oldGroup->getId();
            }
            //default base Competence
            $groupIds = array('1');
            $groupIds = array_merge($groupIds, $this->getRequestParameter('groupIds'));
            $diff = array_diff( $oldGroupIds,  $groupIds);
            if(count($diff) > 0){
                $isModified = true;
            }
            $diff = array_diff( $this->getRequestParameter('groupIds'),$oldGroupIds );
            if(count($diff) > 0){
                $isModified = true;
            }
        }else{
            if( $this->getRequestParameter('last_name') != '' || $this->getRequestParameter('first_name') != '' || 
                $this->getRequestParameter('username') != ''  || $this->getRequestParameter('password') != '' || 
                $this->getRequestParameter('gender') != '' || $this->getRequestParameter('department') != '' || 
                $this->getRequestParameter('telephone') != '' || $this->getRequestParameter('qq') != '' || 
                $this->getRequestParameter('email') != '' || $this->getRequestParameter('title') != '' || 
                $this->getRequestParameter('superiorLeaders') != '' || count($this->getRequestParameter('permissionsId')) > 0 ){
                $isModified = true;
            }
        }
        echo $isModified ? '1' : '0';
        exit;
    }
}
