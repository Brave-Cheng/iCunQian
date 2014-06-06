<?php

/**
 * @package apps\api\modules\Login\actions
 */

/**
 * Login actions.
 *
 * @author     jmao
 */
class LoginActions extends baseApiActions
{
    /**
     *  const GET = 2;
     *  const NONE = 1;
     *  const POST = 4;
     *  const PUT = 5;
     *  const DELETE = 6;
     *  const HEAD = 7;
     * [executeLogin description]
     * @return [type] [description]
     */

    /**
     * POST /Api/Login
     *
     * @return null
     */
    public function executeIndex() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }

        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }

        //is site exist?
        $post = $this->post;
        $code = isset($post['code']) ? $post['code'] : '';
        if (empty($code)) {
            $this->forward('default', 'error403');
        }

        $userInfo = Config::getInstance('apiConfig')->getUserInfoByCode($code);
        if (empty($userInfo))
            $this->forward('default', 'error403');

        //is api_key correct?
        $apiKey = isset($post['api_key']) ? $post['api_key'] : '';
        if (!isset($userInfo['api_key']) || ($apiKey != $userInfo['api_key']))
            $this->forward('default', 'error403');

        //is ip allowed?
        $requestIp = util::getRealIpAddr();
        $allowedIps = isset($userInfo['allowed_ips']) ? $userInfo['allowed_ips'] : array();
        if (!in_array($requestIp, $allowedIps))
            $this->forward('default', 'error403');

        //generate token, save login information to DB
        $requestTime = time();
        $tokenArray = array(
            $code,
            $apiKey,
            $requestIp,
            $requestTime,
        );
        $token = sha1(implode('_', $tokenArray));
        $loginInformation = new ApiLoginInformation();
        $loginInformation->setCode($code);
        $loginInformation->setApiKey($apiKey);
        $loginInformation->setToken($token);
        $loginInformation->setRequestIp($requestIp);
        $loginInformation->setCreatedAt($requestTime);
        $loginInformation->setUpdatedAt($requestTime);
        $loginInformation->save();

        $this->responseData = array('token' => $token);
    }
}
