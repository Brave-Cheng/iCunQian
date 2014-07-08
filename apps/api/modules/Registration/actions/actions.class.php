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
            $rs = DepositMembersPeer::registration(false, false, $this->post['email'], $this->post['password'], $this->post['account_id']);
            $this->responseData = array('status' => 1, 'account' => $rs);
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
            $rs = DepositMembersPeer::registration(false, $this->post['mobile'], false, $this->post['password'], $this->post['account_id']);
            $this->responseData = array('status' => 1, 'account' => $rs);
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
        
        if (!($this->getUser()->getAttribute('timestp'))
            || !($this->getUser()->getAttribute('seed'))) {
            $this->forward('default', 'error403');
        }

        try {            
            $this->_validateMobileRegister();
            if (!isset($this->post['seed'])) {
                throw new Exception("Request parameter is incorrect, the parameter must seed.");
            }
            $diff = (time() - $this->getUser()->getAttribute('timestp')) - (60 * 10);
            if ($diff > 0) {
                throw new Exception(sprintf(util::getMultiMessage('Time out %s'), $diff));
            }

            if ($this->getUser()->getAttribute('seed') != $this->post['seed']
                || !is_numeric($this->post['seed'])) {
                throw new Exception(sprintf(util::getMultiMessage('SMS sms code error%s'), $this->post['seed']));
            }
            $rs = DepositMembersPeer::smsConfirm($this->post['mobile']);
            $this->responseData = array('status' => 1, 'account' => $rs);
            $this->getUser()->setAttribute('timestp', 0);
            $this->getUser()->setAttribute('seed', 0);
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
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
        $unique = urldecode(base64_decode($unique));
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
        if (!isset($this->post['email']) && !isset($this->post['password'])) {
            throw new Exception('Request parameter is incorrect, the parameter must contain email and password.');
        }
        //Important: symfony email validate in action
        $emailValidator = new sfEmailValidator();
        $emailValidator->initialize($this->getContext(), array(
            'email_error' => 'This email address is invalid'
        ));
        if(!$emailValidator->execute($this->post['email'], $emailError)) {
            throw new Exception($emailError);
        }
        //validate password based symfony string validator
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
     * Validate mobile register paramters
     *
     * @return null
     *
     * @issue 2626
     */
    private function _validateMobileRegister() {
        if (!isset($this->post['mobile'])) {
            throw new Exception("Request parameter is incorrect, the parameter must mobile.");
        }
        if (empty($this->post['mobile'])) {
            throw new Exception("The mobile cannot be left blank.");
        }   
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
