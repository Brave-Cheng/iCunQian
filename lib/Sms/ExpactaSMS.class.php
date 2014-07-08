<?php

/**
 * @package lib\Sms
 *
 * Expacta Sms send class
 */

class ExpactaSMS extends SMS
{
    const METHOD_POST    = 'POST';
    const METHOD_GET     = 'GET';
    const STATUS_SUCCEED = '0';
    const STATUS_FAILED  = '1';
    
    //request url
    private $_requestUrl = 'http://platform.trunk/Api';
    //client code
    private $_code = 'expacta';
    //api key
    private $_apiKey = '7b50ab2c9f0063a8e849252fc54579b92657f149';

    /**
     * construct 
     *
     * @param string $code   code 
     * @param string $apiKey api key
     *
     * @return void
     * @issue 2626
     */
    public function __construct($code='', $apiKey=''){
        if( !empty($code) ) $this->_code = $code;
        if( !empty($apiKey) ) $this->_apiKey = $apiKey;
    }

    /**
     * Send message. 
     *
     * @param array  $receivers receivers
     * @param string $message   message
     *
     * @return mixed
     *
     * @issue 2626
     */
    public function send($receivers = array(), $message = ''){
        try{
            if(!count($receivers)){
                throw new Exception("invalid receivers");
            }

            $response = $this->_send(implode(",", $receivers), $message);

            return $response;
        }catch(Exception $e){
            parent::logMessage($e->getMessage());
            throw $e;
        }
    }

    /**
     * Private send
     *
     * @param string $receiverString receiverString
     * @param string $message        message
     *
     * @return boolean
     *
     * @issue 2626
     */
    private function _send($receiverString = '', $message){
        //first, login
        $requestUrl = $this->_requestUrl . '/Login';
        $postData   = array(
            'code'   => $this->_code,
            'api_key' => $this->_apiKey,
        );
        $response = $this->_doRequest($postData, '', $requestUrl, self::METHOD_POST);
        $loginResponse = json_decode($response, true);
        $token = $loginResponse['token'];
        
        //second, enqueue
        $postData = array(
            'receivers' => $receiverString,
            'message'   => $message,
        );
        
        $requestUrl = $this->_requestUrl . "/Sms/{$this->_code}/Enqueue";
        $response = $this->_doRequest($postData, $token, $requestUrl, self::METHOD_POST);
        $enqueueResponse = json_decode($response, true);
        
        if(isset($enqueueResponse) && $enqueueResponse['status'] == self::STATUS_SUCCEED){
            return true;
        }else{
            $code = $enqueueResponse['error_code'];
            $msg  = $enqueueResponse['error_msg'];
            throw new Exception($msg, $code);
        }
    }
        
    /**
     * Request send message
     *
     * @param string $postData      json data
     * @param string $token         token
     * @param string $requestUrl    request url
     * @param string $requestMethod 'GET' OR 'POST'
     *
     * @return string
     *
     * @issue 2626
     */
    private function _doRequest($postData, $token, $requestUrl, $requestMethod='GET'){
        $jsonData = json_encode($postData);
        parent::logMessage("Request DATA: $jsonData");

        $header = array(
            'Content-type: application/json',
            'Content-length: ' . strlen($jsonData),
        );
        if( !empty($token) ){
            array_push($header, "Authorization: $token");
        }
        
        parent::logMessage("Request URL: $requestUrl");

        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestMethod);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($ch);
        
        parent::logMessage("Response DATA: $response");
        
        return $response;
    }
}