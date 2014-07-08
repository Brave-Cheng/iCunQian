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
                $this->post['third_party_account']
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
                throw new Exception("Request parameter is incorrect, the parameter must contain account_id.");
            }
            $rs = DepositMembersPeer::accountLogout(
                $this->post['account_id']
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
            
            $rs = DepositMembersPeer::resetPasswordBySms(
                $this->post['account_id']
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
            $rs = DepositMembersPeer::resetPasswordByEmail(
                $this->post['account_id']
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
                $this->post['nickname'],
                $this->post['email'],
                $this->post['mobile']
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
        try {
            if (!$accountId) {
                throw new Exception('There is no account_id parameter.');
            }
            $this->_validateAlterAvatar();
            
            $avatar = $this->uploadAvatar(rand(10000000000, 99999999999));
            $rs = DepositMembersPeer::alterAvatar(
                $accountId,
                $avatar
            );
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
                throw new Exception("Request parameter is incorrect. The parameter must contain account_id, type!");
            }
            if (!in_array($this->post['type'], array('email', 'mobile'))) {
                throw new Exception("Unsupport type. The type must be 'email' or 'mobile'.");
            }
            $rs = DepositMembersPeer::activation($this->post['account_id'], $this->post['type']);
            $this->responseData = array('status' => 1, 'account' => array(
                'account_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
        }
    }
    /**
     * Validate update account 
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateUpdateAccount() {
        if ($this->post['email']) {
            $emailValidator = new sfEmailValidator();
            $emailValidator->initialize($this->getContext(), array(
                'email_error' => 'This email address is invalid'
            ));
            if(!$emailValidator->execute($this->post['email'], $emailError)) {
                throw new Exception($error);
            }
        }
        if ($this->post['password']) {
            $stringValidator = new sfStringValidator();
            $stringValidator->initialize($this->getContext(), array(
                'min'           => 6,
                'min_error'     => 'The password is too short. (6 characters miximum)',
                'max'           => 45,
                'max_error'     => 'The password is too long. (45 characters maximum)',
            ));
            if (!$stringValidator->execute($this->post['password'], $stringError)) {
                throw new Exception($stringError);
            }
        }
        if ($this->post['mobile']) {
            $regexValidate = new sfRegexValidator();
            $regexValidate->initialize($this->getContext(), array(
                'match'             => true,
                'match_error'       => 'The mobile number is invalid.',
                'pattern'           => "/^1([358][0-9]|45|47)[0-9]{8}$/",
            ));
            if (!$regexValidate->execute($this->post['mobile'], $regexError)) {
                throw new Exception($regexError);
            }
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
            || empty($this->post['third_party_account'])) {
            throw new Exception('Request parameter is incorrect, the parameter must contain account_id, third_party_type, third_party_account');
        }
        if (!in_array($this->post['third_party_type'], DepositMembersPeer::getThirdPartyPlatforms())) {
            throw new Exception(sprintf(util::getMultiMessage('Third Party Type Error %'), implode(',', DepositMembersPeer::getThirdPartyPlatforms())));
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
            throw new Exception('Request parameter is incorrect, the parameter must contain account, password');
        }
        
        if (is_numeric($this->post['account'])) {
            $regexValidate = new sfRegexValidator();
            $regexValidate->initialize($this->getContext(), array(
                'match'             => true,
                'match_error'       => 'The mobile number is invalid.',
                'pattern'           => "/^1([358][0-9]|45|47)[0-9]{8}$/",
            ));
            if (!$regexValidate->execute($this->post['account'], $regexError)) {
                throw new Exception($regexError);
            }
        }

        if (strpos($this->post['account'], '@') !== false) {
            //Important: symfony email validate in action
            $emailValidator = new sfEmailValidator();
            $emailValidator->initialize($this->getContext(), array(
                'email_error' => 'This email address is invalid'
            ));
            if(!$emailValidator->execute($this->post['account'], $emailError)) {
                throw new Exception($error);
            }
        }

        $stringValidator = new sfStringValidator();
        $stringValidator->initialize($this->getContext(), array(
            'min'           => 6,
            'min_error'     => 'The password is too short. (6 characters miximum)',
            'max'           => 45,
            'max_error'     => 'The password is too long. (45 characters maximum)',
        ));
        if (!$stringValidator->execute($this->post['password'], $stringError)) {
            throw new Exception($stringError);
        }
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
            throw new Exception('Request parameter is incorrect, the parameter must contain account');
        }
    }

    /**
     * Validate avatar
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateAlterAvatar() {
        if (is_null(($this->getRequest()->getFile('avatar')))) {
            throw new Exception(util::getMultiMessage('No avatar upload'));
        }

        if (($fileError = $this->getRequest()->getFileError('avatar'))) {
            throw new Exception($fileError);
        }

        if ($this->getRequest()->getFileSize('avatar') > 1024 * 1024 * 10) {
            throw new Exception("The avatar is too big.(10m is maximum)");
        }
        
        if (!in_array($this->getRequest()->getFileType('avatar'), DepositMembersPeer::getSupportAvatarTypes())) {

            throw new Exception(sprintf('Unsupport avatar type. only be (%s)', implode(',', DepositMembersPeer::getSupportAvatarTypes())));
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
            throw new Exception(sprintf('Upload avatar%s failed.', $avatar));
        }
        return $rename . $this->getRequest()->getFileExtension('avatar');
    }

}
