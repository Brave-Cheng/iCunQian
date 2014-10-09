<?php

/**
 * @package apps\api\modules\Registration\actions
 */

/**
 * Registration actions.
 *
 * 
 * @subpackage Registration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class RegistrationActions extends baseApiActions
{
    
    /**
     * Pre-execute action
     *
     * @return null
     *
     * @issue 2626
     */
    public function preExecute() {
        parent::preExecute();
        $this->setTemplate('json');
    }


    /**
     * Confirm mail register
     *
     * @return null
     *
     * @issue 2626
     */
    public function executeRegisterConfirm() {
        $this->validate = 'successful';
       
        try {
            $this->_validateRegisterConfirm();
            $diff = time() - $this->timestamp - (60 * 60 * 24);
            if ($diff > 0) {
                throw new Exception(sprintf(util::getMultiMessage('Time out %s'), $diff));
            }
            DepositMembersPeer::emailConfirm($this->email, $this->unique);

        } catch (Exception $e) {
            $this->validate = 'fail';
            $this->error = $e->getMessage();
        }
        $this->contentType = 'text/html';
        $this->setTemplate('confirm');
    }

    /**
     * Forgot password and reset it
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeResetPassword() {
        
        $this->contentType = 'text/html';
    }

    /**
     * Email registration, 
     * necessary parameters [email, password]
     * 
     * @return null
     *
     * @issue 2626
     */
    public function executeMailRegister() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateMailRegister();
            $rs = DepositMembersPeer::emailRegistration($this->post['email'], $this->post['password']);
            $this->responseData = array('status' => 1, 'account' => array('account_id' => $rs->getId()));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Mobile registration
     * necessary parameters [mobile, password]
     *
     * @return null
     *
     * @issue 2626
     */
    public function executeMobileRegister() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }

        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        
        try {
            $this->_validateMobileRegister();
            $rs = DepositMembersPeer::mobileRegistration($this->post['mobile'], $this->post['password'], $this->post['nickname']);
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Verfiy SMS code
     *
     * @return void
     *
     * @issue 2626
     */
    public function executeVerfiySmsCode() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }

        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {    
            $this->_validateVerfiySmsCode();
            $rs = DepositMembersPeer::verfiyAccount($this->post['mobile'], true);

            if ($this->getUser()->getAttribute('passwordReset') != 1) {
                if ($rs->getMobileActive() == DepositMembersPeer::YES) {
                    throw new ObjectsException(
                        ObjectsException::$error2001,
                        sprintf(
                            util::getMultiMessage('Mobile %s is validated.'),
                            $rs->getMobile()
                        )
                    );
                }
            }
           
            if ($this->getUser()->getAttribute('seed') != $this->post['seed']
                || !is_numeric($this->post['seed'])) {
                throw new ParametersException(ParametersException::$error1010, sprintf(util::getMultiMessage('SMS sms code error%s'), $this->post['seed']));
            }

            $diff = (time() - $this->getUser()->getAttribute('timestp')) - (60 * 10);
            if ($diff > 0) {
                throw new ParametersException(ParametersException::$error1011, sprintf(util::getMultiMessage('Time out %s'), $diff));
            }

            
            if ($this->getUser()->getAttribute('passwordReset') != 1) {
                $rs = DepositMembersPeer::smsConfirm($this->post['mobile']);    
            }
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
            $this->getUser()->getAttributeHolder()->clear();
        } catch (Exception $e) {
            $this->setResponseError($e);
        }

    }

    /**
     * Validate action
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateVerfiySmsCode() {
        if (empty($this->post['mobile'])
            || empty($this->post['seed'])) {
            throw new ParametersException(ParametersException::$error1000, 'mobile, seed');
        }   
        if (!($this->getUser()->getAttribute('timestp'))
            || !($this->getUser()->getAttribute('seed'))) {
            throw new ParametersException(ParametersException::$error1012, sprintf(util::getMultiMessage('verifiy is invalid.'), $diff));
        }     

    }

    /**
     * Third-platform register
     *
     * @return void
     *
     * @issue 2646
     */
    public function executeThirdPlatformRegister() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }

        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        
        try {
            $this->_validateThirdPlatformRegister();
            $rs = DepositMembersPeer::thirdRegister(
                $this->post['third_party_type'],
                $this->post['third_party_account']
            );
            $this->responseData = array('status' => 1, 'account' => DepositMembersPeer::getAccountInfo($rs));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Validate email confirm url
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateRegisterConfirm() {
        $this->timestamp = $this->getRequestParameter('tsp');
        $this->email = $this->getRequestParameter('email');

        $unique = $this->getRequestParameter('unique_id');
        $this->unique = util::authCode($unique, 'DECODE', DepositMembersPeer::BASE64);
        
        if (!$this->timestamp 
            || !$this->email
            || ! $this->unique
            || !is_numeric($this->timestamp)
            || (strlen($this->timestamp) != 10)
            || !is_numeric($this->unique)) {
            $this->forward('default', 'notFound404');
        }  

        $emailValidator = new sfEmailValidator();
        $emailValidator->initialize($this->getContext(), array(
            'email_error' => 'This email address is invalid'
        ));
        if(!$emailValidator->execute($this->email, $emailError)) {
            $this->forward('default', 'notFound404');
        }

    }

    /**
     * Validate mail register parameters
     *
     * @return boolean. true is validate successfully
     *
     * @issue 2626
     */
    private function _validateMailRegister() {
        if (empty($this->post['email']) || empty($this->post['password'])) {
            throw new ParametersException(ParametersException::$error1000, 'email, password');
        }
        //Important: symfony email validate in action
        $this->validateEmail($this->post['email']);
        //validate password based symfony string validator
        $this->validatePassword($this->post['password']);
    }


    /**
     * Validate mobile register paramters
     *
     * @return null
     *
     * @issue 2626, 2704
     */
    private function _validateMobileRegister() {
        if (empty($this->post['mobile'])) {
            throw new ParametersException(ParametersException::$error1000, 'mobile');
        } 

        $this->validateMobile($this->post['mobile']);
        
        if ($this->post['password']) {
            $this->validatePassword($this->post['password']);
        }

        if (isset($this->post['nickname']) && trim($this->post['nickname']) == '') {
            throw new ParametersException(ParametersException::$error1000, 'nickname');
        }

        if ($this->post['nickname']) {
            $this->validateStringLength($this->post['nickname'], 1, 20, 'nickname');
        }
    } 

    /**
     * Validate third-platform register
     *
     * @return void
     *
     * @issue 2646
     */
    private function _validateThirdPlatformRegister() {
        if (empty($this->post['third_party_type'])
            || empty($this->post['third_party_account'])) {
            throw new ParametersException(ParametersException::$error1000, 'third_party_type, third_party_account');
        }

        if (!in_array($this->post['third_party_type'], DepositMembersPeer::getThirdPartyPlatforms())) {
            throw new ParametersException(
                ParametersException::$error1002, 
                sprintf(util::getMultiMessage('%s not in %s'), $this->post['third_party_type'], implode(',', DepositMembersPeer::getThirdPartyPlatforms()))
            );
        }

    }


}
