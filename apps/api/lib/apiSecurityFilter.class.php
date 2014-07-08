<?php

/**
 * @package api\lib
 */

/**
 * method of apiSecurityFilter.
 *
 * 
 * @author brave <brave.cheng@expacta.com.cn>
 */
class apiSecurityFilter extends sfBasicSecurityFilter
{

    protected $loginInformation = null;
    
    /**
     * Executes this filter.
     *
     * @param object $filterChain A sfFilterChain instance
     * 
     * @return void
     * 
     * @issue 2626
     */
    public function execute($filterChain) {
        if ($this->isFirstCall()) {
            $module = $this->getContext()->getModuleName();
            $action = $this->getContext()->getActionName();
            if (!in_array($module, apiUtil::getInsecureModules()) 
                && !in_array($action, apiUtil::getInsecureActions())) {
                $this->validateToken();
                $this->validateIp();
            }
        }
        $filterChain->execute($filterChain);
    }
    
    /**
     * validate the token
     * 
     * @return void
     *
     * @issue 2626
     */
    public function validateToken() {
        $controller = $this->getContext()->getController();
        $headers = $this->fetchHttpRequestHeaders();
        //There is no Token
        if (!isset($headers['Authorization'])) {
            $controller->forward('default', 'error401');
            die();
        }
        //Authentication token is valid
        $token = $headers['Authorization'];
        apiLog::logMessage('REQUEST TOKEN:' . $token);
        $this->loginInformation = ApiLoginInformationPeer::retrieveByToken($token);
        if (null == $this->loginInformation) {
            $controller->forward('default', 'error401');
            die();
        }
        //Authentication token is overdue
        $currentRequestTime = time();
        $tokenRequestTime = strtotime($this->loginInformation->getCreatedAt());
        $tokenExpiredTime = Config::getInstance('apiConfig')->getTokenExpiredTime();
        if( $currentRequestTime - $tokenRequestTime > $tokenExpiredTime ){
            $controller->forward('default', 'error401');
            die();
        }
    }
    
    /**
     * validate ip
     * 
     * @return void
     *
     * @issue 2626
     */
    public function validateIp() {
        $controller = $this->getContext()->getController();

        $requestIp = util::getRealIpAddr();

        $code = $this->loginInformation->getCode();
        $userInfo = Config::getInstance('apiConfig')->getUserInfoByCode($code);
        $allowedIps = isset($userInfo['allowed_ips']) ? $userInfo['allowed_ips'] : array();

        if (!in_array($requestIp, $allowedIps)) {
            $controller->forward('default', 'error403');
            exit;
        }

        //save login information to session
        $this->getContext()->getUser()->setLoginInformation($this->loginInformation);
    }

    /**
     * Fetch all HTTP request headers
     * 
     * @return array
     *
     * @issue 2626
     */
    public function fetchHttpRequestHeaders() {
        return apache_request_headers();
    }

}

