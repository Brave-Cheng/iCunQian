<?php
/**
 * @package apps\api\modules\Account\actions
 */

/**
 * Account actions.
 *
 * @package    apps
 * @subpackage Account
 * @author     brave.cheng
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class AccountActions extends baseApiActions
{
    /**
     * Executes preExecute before action.
     *
     * @return void
     *
     * @issue 2626
     */
    public function preExecute() {
        parent::preExecute();
        $this->setTemplate('json');
    }

    

    /**
     * Third-party account binding
     * 
     * @return void
     *
     * @issue 2626
     */
    public function executeThirdPartyAccountBinding() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateThirdPartyAccountBinding();
            $rs = DepositMembersPeer::thirdPartyBinding(
                $this->post['account_id'],
                $this->post['third_party_type'],
                $this->post['third_party_account'],
                $this->post['hash']
            );
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    

    /**
     * Login
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeLogin() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateLogin();
            $rs = DepositMembersPeer::accountLogin(
                $this->post['account'],
                $this->post['password']
            );
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Logout
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeLogout() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            if (empty($this->post['account_id'])) {
                throw new ParametersException(ParametersException::$error1000, 'account_id');
            }
            $rs = DepositMembersPeer::accountLogout(
                $this->post['account_id']
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Verify account
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeVerifyAccount() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateAccount();
            $rs = DepositMembersPeer::verfiyAccount(
                $this->post['account']
            );
            if ($rs->getEmailActive() == DepositMembersPeer::NO
                && $rs->getMobileActive() == DepositMembersPeer::NO) {
                throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The account is not active.'));
            }
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Forgot password and reset it by sms
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeRestPasswordSms() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateAccount();
            $rs = DepositMembersPeer::verfiyAccount($this->post['account']);
            $rs = DepositMembersPeer::resetPasswordBySms($rs->getId());
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }   

    /**
     * Forgot password and reset it by email
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeRestPasswordEmail() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateAccount();
            $rs = DepositMembersPeer::verfiyAccount($this->post['account']);
            $rs = DepositMembersPeer::resetPasswordByEmail($rs->getId());
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Update account information
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeUpdateAccount() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }

        try {
            $this->_validateUpdateAccount();
            $rs = DepositMembersPeer::updateAccount(
                $this->post['account_id'],
                $this->post['account'],
                $this->post['password'],
                $this->post['email'],
                $this->post['mobile'],
                $this->post['hash']
            );
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }


    /**
     * Execute reset password
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeResetPassword() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }

        try {
            $this->_validateResetPassword();
            $rs = DepositMembersPeer::updatePassword(
                $this->post['account_id'],
                $this->post['password']
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id'    => $rs->getId(),
                'hash'          => $rs->getHash(),
            ));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Alter avatar 
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeAlterAvatar() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }

        $accountId = (int) $this->getRequestParameter('account_id');
        $hash = $this->getRequestParameter('hash');
        try {

            $this->_validateAlterAvatar($accountId, $hash);
            
            $avatar = $this->uploadAvatar(rand(10000000000, 99999999999));
            $rs = DepositMembersPeer::alterAvatar(
                $accountId,
                $avatar,
                $hash
            );
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }

    }

    /**
     * Get account information
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeGetAccountInfo() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        try {
            $rs = DepositMembersPeer::getAccountInfo(
                $this->getRequestParameter('account_id')
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs,
            ));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Activation email or mobile
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeActivation() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            if (empty($this->post['account_id'])
                || empty($this->post['type'])) {
                throw new ParametersException(ParametersException::$error1000, 'account_id, type');
            }
            if (!in_array($this->post['type'], array('email', 'mobile'))) {
                throw new ParametersException(
                    ParametersException::$error1002, 
                    sprintf(util::getMultiMessage('%s not in %s'), $this->post['type'], 'email, mobile')
                );
            }
            $rs = DepositMembersPeer::activation($this->post['account_id'], $this->post['type']);
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Get subscribe by user id
     *
     * @return void
     *
     * @issue 2715
     */
    public function executeGetSubscribeByUser() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        try {
            $accountId  = $this->getRequestParameter('account_id');
            $hash       = $this->getRequestParameter('hash');

            if (!$accountId || !$hash) {
                throw new ParametersException(ParametersException::$error1000, 'account_id, hash');
            }
            
            DepositMembersPeer::verfiyMember($accountId, $hash);

            $rs = DepositMembersSubscribePeer::getSubscribeListByUser($accountId);

            $this->responseData = array('status' => 1, 'subscriber' => $rs);
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Validate update account 
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateResetPassword() {
        if (empty($this->post['account_id'])
            || empty($this->post['password'])) {
            throw new ParametersException(ParametersException::$error1000, 'account_id, password');
        }
        $this->validatePassword($this->post['password']);
    }


    /**
     * Validate update account 
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateUpdateAccount() {
        if (empty($this->post['account_id'])
            || empty($this->post['hash'])) {
            throw new ParametersException(ParametersException::$error1000, 'account_id, hash');
        }
        if ($this->post['email']) {
            $this->validateEmail($this->post['email']);
        }
        if ($this->post['password']) {
            $this->validatePassword($this->post['password']);
        }
        if ($this->post['mobile']) {
            $this->validateMobile($this->post['mobile']);
        }
    }


    /**
     * Validate third party account
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateThirdPartyAccountBinding() {
        if (empty($this->post['account_id']) 
            || empty($this->post['third_party_type']) 
            || empty($this->post['third_party_account'])
            || empty($this->post['hash'])) {
            throw new ParametersException(ParametersException::$error1000, 'account_id, third_party_type, third_party_account, hash');
            
        }
        if (!in_array($this->post['third_party_type'], DepositMembersPeer::getThirdPartyPlatforms())) {
            throw new ParametersException(
                ParametersException::$error1002, 
                sprintf(util::getMultiMessage('%s not in %s'), $this->post['third_party_type'], implode(',', DepositMembersPeer::getThirdPartyPlatforms()))
            );
        }
    }

    /**
     * Validate login or logout
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateLogin() {
        if (empty($this->post['account']) 
            || empty($this->post['password'])) {
            throw new ParametersException(ParametersException::$error1000, 'account, password');
        }
        
        if (is_numeric($this->post['account'])) {
            $this->validateMobile($this->post['account']);
        }

        if (strpos($this->post['account'], '@') !== false) {
            //Important: symfony email validate in action
            $this->validateEmail($this->post['account']);
        }
        $this->validatePassword($this->post['password']);
    }


    /**
     * Validate login
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateAccount() {
        if (empty($this->post['account'])) {
            throw new ParametersException(ParametersException::$error1000, 'account');
        }
    }

    /**
     * Validate alter avatar 
     *
     * @param int $accountId account id
     * @param string $hash   hash string
     *
     * @return void
     *
     * @issue 2646
     */
    private function _validateAlterAvatar($accountId, $hash) {

        if (empty($accountId)
            || empty($hash)
            || is_null($this->getRequest()->getFile('avatar'))) {
            throw new ParametersException(ParametersException::$error1000, 'account_id, hash,avatar');
        }

        if (($fileError = $this->getRequest()->getFileError('avatar'))) {
            throw new ParametersException(ParametersException::$error1003, $fileError);
        }

        if ($this->getRequest()->getFileSize('avatar') > 1024 * 1024 * 10) {
            throw new ParametersException(ParametersException::$error1003, util::getMultiMessage('The avatar is too big (10m is maximum).'));
        }
        
        if (!in_array($this->getRequest()->getFileType('avatar'), DepositMembersPeer::getSupportAvatarTypes())) {
            throw new ParametersException(
                ParametersException::$error1003, 
                sprintf(
                    util::getMultiMessage('Unsupport avatar type, only be (%s).'),
                    implode(',', DepositMembersPeer::getSupportAvatarTypes())
                )
            );
        }
    }

    /**
     * Move the avatar to destination
     *
     * @param string $rename re-named avatar
     *
     * @return string path of avatar
     *
     * @issue 2626
     */
    public function uploadAvatar($rename = '') {
        $uploads = DepositMembersPeer::customAvatarDirectory();
        if (!is_dir($uploads)) {
            @mkdir(
                $uploads,
                0777,
                true
            );
        }

        $rename = $rename ? $rename : $this->getRequest()->getFileName('avatar');
        
        if (!move_uploaded_file($this->getRequest()->getFilePath('avatar'), $uploads . DIRECTORY_SEPARATOR . $rename . $this->getRequest()->getFileExtension('avatar'))) {
            throw new ParametersException(ParametersException::$error1003, sprintf(util::getMultiMessage('Move upload file(%s) faild.'), $rename));
        }
        return $rename . $this->getRequest()->getFileExtension('avatar');
    }


    

}
