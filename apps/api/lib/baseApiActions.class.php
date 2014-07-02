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

        if ($this->gzip) {
            $this->getResponse()->setHttpHeader('Content-Type', 'application/json', true);
            $this->getResponse()->setHttpHeader('Content-Encoding', 'gzip', true);
            //header gzip
            $this->responseLengthData = gzencode(json_encode($this->responseData),9);
            $this->getResponse()->setHttpHeader('Content-Length',  strlen($this->responseLengthData));
        } else {
            $this->responseLengthData = json_encode($this->responseData);
            $this->getResponse()->setHttpHeader('Content-Length',  strlen($this->responseLengthData));
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
        $this->since = $this->getRequestParameter('since') ? $this->getRequestParameter('since') : null;
        $this->limit = $this->getRequestParameter('limit') ? $this->getRequestParameter('limit') : $this->limit;
    }
    

}
