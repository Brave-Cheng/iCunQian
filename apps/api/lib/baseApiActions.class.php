<?php

/**
 * @package apps\api\lib
 */

/**
 * Base Api actions.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class baseApiActions extends sfActions
{

    protected $code;
    protected $post = array();
    protected $httpCode;
    protected $logInformation = array();

    /**
     * forward default action
     * 
     * @param mixed $condition condition
     *  
     * @return null
     */
    public function forward400Unless($condition) {
        if (!$condition) {
            $this->forward('default', 'error400');
        }
    }

    /**
     * forward default action
     * 
     * @param mixed $condition condition
     * 
     * @return null
     */
    public function forward422Unless($condition) {
        if (!$condition) {
            $this->forward('default', 'error422');
        }
    }

    /**
     * execute before action execute
     * 
     * @return null
     */
    public function preExecute() {
        $this->setLayout(false);
        apiLog::logMessage("REQUEST URI: " . $this->getRequest()->getUri());
        $requestIp = util::getRealIpAddr();
        $loginInformation = $this->getUser()->getLoginInformation();
        $requestToken = $loginInformation ? $loginInformation->getToken() : ' ';
        $requestTime = date('d/M/Y:H:i:s O');
        switch ($this->getRequest()->getMethod()) {
            case sfRequest::NONE:
                $requestType = 'NONE';
                break;
            case sfRequest::GET:
                $requestType = 'GET';
                break;
            case sfRequest::POST:
                $requestType = 'POST';
                break;
            case sfRequest::PUT:
                $requestType = 'PUT';
                break;
            case sfRequest::DELETE:
                $requestType = 'DELETE';
                break;
            case sfRequest::HEAD:
                $requestType = 'HEAD';
                break;
            default:
                $requestType = '';
                break;
        }

        $this->_validatePostParameters();
    }

    /**
     * Validate post parameters
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validatePostParameters() {
        $requestUrl = str_replace($this->getRequest()->getUriPrefix(), '', $this->getRequest()->getUri());
        $this->logInformation = array(
            'ip' => $requestIp,
            'token' => $requestToken,
            'datetime' => $requestTime,
            'method' => $requestType,
            'url' => $requestUrl,
        );
        try {
            $fp = fopen('php://input', 'r');
            $postData = stream_get_contents($fp);
            $this->post = json_decode($postData, true);
            apiLog::logMessage("REQUEST DATA: " . $postData);
            apiLog::logMessage("DECODE REQUEST DATA: " . var_export($this->post, true));
        } catch (Exception $e) {
            $this->forward('default', 'error403');
        }
    }

    /**
     * execute after action execute
     * 
     * @return null
     */
    public function postExecute() {
        $this->responseData = $responseData = isset($this->responseData) ? $this->responseData : array();

        $logInformation = $this->logInformation;
        if ($this->httpCode) {
            $logInformation['reponseCode'] = $this->httpCode;
        } else {
            $logInformation['reponseCode'] = apiUtil::CODE_SUCCESSFUL;
        }
        apiLog::logMessage(implode(' - ', $logInformation), 'api_activity.log');

        apiLog::logMessage("RESPONSE DATA: " . var_export($this->responseData, true));
        
        $this->getResponse()->setStatusCode($this->httpCode);
        if ($this->contentType != 'text/html') {
            $this->getResponse()->setHttpHeader('Content-Type', 'application/json', true);
            if ($this->gzip) {
                
                $this->getResponse()->setHttpHeader('Content-Encoding', 'gzip', true);
                //header gzip
                $this->responseLengthData = gzencode(json_encode($this->responseData),9);
                $this->getResponse()->setHttpHeader('Content-Length',  strlen($this->responseLengthData));
            } else {
                $this->responseLengthData = json_encode($this->responseData);
                $this->getResponse()->setHttpHeader('Content-Length',  strlen($this->responseLengthData));
            }
        }

        
    }
    
    /**
     * common get method parameters
     * 
     * @issue 2568
     * @return null
     */
    public function commonGetParameters() {
        $headers = apache_request_headers();
        $this->gzip = (isset($headers['Accept-Encoding']) && $headers['Accept-Encoding'] == 'gzip') ? 1 : 0;

        $this->since = $this->getRequestParameter('since');
        $this->limit = $this->getRequestParameter('limit', $this->limit);

        if (isset($this->since) && !is_numeric($this->since)) {
            throw new ParametersException(ParametersException::$error1000, 'since');
        }
        if (isset($this->limit) && !is_numeric($this->limit)) {
            throw new ParametersException(ParametersException::$error1000, 'limit');
        }
    }
    
    /**
     * Set error
     *
     * @param object $e Exception
     *
     * @issue 2646
     */
    public function setResponseError($e) {
        $this->responseData = array('status' => 0, 'error' => array(
            'error_code'    => $e->getCode(),
            'error_msg'     => $e->getMessage(),
        ));
    }

    /**
     * Validate email 
     *
     * @param string $email email address
     *
     * @return void
     *
     * @issue 2646
     */
    protected function validateEmail($email) {
        $emailValidator = new sfEmailValidator();
        $emailValidator->initialize($this->getContext(), array(
            'email_error' => util::getMultiMessage('This email address is invalid.')
        ));
        if(!$emailValidator->execute($email, $emailError)) {
            throw new ParametersException(ParametersException::$error1001, $emailError);
        }
    }

    /**
     * Validate mobile
     *
     * @param int $mobile mobile number
     *
     * @return void
     *
     * @issue 2646
     */
    protected function validateMobile($mobile) {
        $regexValidate = new sfRegexValidator();
        $regexValidate->initialize($this->getContext(), array(
            'match'             => true,
            'match_error'       => util::getMultiMessage('The mobile number is invalid.'),
            'pattern'           => "/^1([358][0-9]|45|47)[0-9]{8}$/",
        ));
        if (!$regexValidate->execute($mobile, $regexError)) {
            throw new ParametersException(ParametersException::$error1001, $regexError);
        }
    }

    /**
     * Validate password
     *
     * @param string $password password string
     *
     * @return void
     *
     * @issue 2646
     */
    protected function validatePassword($password) {
        $stringValidator = new sfStringValidator();
        $stringValidator->initialize($this->getContext(), array(
            'min'           => 6,
            'min_error'     => util::getMultiMessage('The password is too short. (6 characters miximum)'),
            'max'           => 45,
            'max_error'     => util::getMultiMessage('The password is too long. (45 characters maximum)'),
        ));
        if (!$stringValidator->execute($password, $stringError)) {
            throw new ParametersException(ParametersException::$error1001, $stringError);
        }
    }

    
    /**
     * Validate string length
     *
     * @param string $string string to validate
     * @param int    $min    min length
     * @param int    $max    max length
     * @param string $field  field string
     *
     * @return void
     *
     * @issue  2662
     */
    protected function validateStringLength($string, $min, $max, $field = '') {
        $stringValidator = new sfStringValidator();
        $stringValidator->initialize($this->getContext(), array(
            'min'           => $min,
            'min_error'     => util::getMultiMessage('The string is too short.'),
            'max'           => $max,
            'max_error'     => util::getMultiMessage('The string is too long.'),
        ));
        if (!$stringValidator->execute($string, $stringError)) {
            throw new ParametersException(ParametersException::$error1001, $field . $stringError);
        }
    }
}
