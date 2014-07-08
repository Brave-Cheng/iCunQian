<?php

/**
 * @package lib\Sms
 */

/**
 * Mmlj Sms send class
 */
class MmljSMS extends SMS
{
    //Account
    private $_account = 'expacta';
    //Password
    private $_password = '667788';
    //Address
    private $_apiAddress = 'HTTP://web.mmlj.cn:12250/xcdeal.asp';
    
    public static $sendMessageError = array(
        '-1' => '没有找到基本账号',
        '-2' => '没有手机号码或手机号码序列格式不规范',
        '-3' => '现时基本账号处于休眠状态,暂时不能发送信息',
        '-4' => '对不起，移动公司规定晚上9点后禁止批量发送，若有特殊需要，必须提前申请。',
        '-5' => '基本账号已被限制',
        '-6' => '贵宾账号被限制',
        '-7' => '没有找到贵宾账号',
        '-8' => '剩余条数,余额不足提醒',
        '-9' => '服务器传输故障',
        '-101' => '发送字符数超过450字',
    );

    /**
     * construct
     *
     * @param string $account    account
     * @param string $password   password
     * @param string $apiAddress api address
     *
     * @return void
     * 
     * @issue 2626
     */
    public function __construct($account='', $password='', $apiAddress=''){
        if( !empty($account) ) $this->_account = $account;
        if( !empty($password) ) $this->_password = $password;
        if( !empty($apiAddress) ) $this->_apiAddress = $apiAddress;
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
    public function send($receivers = array(), $message = '') {
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
    private function _send($receiverString = '', $message) {
        $receiverString = trim($receiverString);
        $message = trim($message);
        parent::logMessage('receivers: ' . $receiverString);
        parent::logMessage('message:' . $message);
        if(!$receiverString){
            throw new Exception("receiver is empty");
        }
        if(!$message){
            throw new Exception("message is blank");
        }
        if(strlen($message) > '450'){
            throw new Exception("message is too long(max is 450)");
        }
        $params = array(
            'textacc'       => $this->codeToUni($this->_account),
            'textpsw'       => $this->codeToUni($this->_password),
            'textphone'     => $receiverString,
            'submitsendmsg' => 'submit',
            'textcontent'   => $this->codeToUni($message),
        );
        $formdata = html_entity_decode(http_build_query($params));
        parent::logMessage('send data: ' . $formdata);
        $options =array(
            'http' => array(
                'method' => "POST",
                'header' => "Accept: application/json, text/javascript, */*\r\n" .
                "Content-Type: application/x-www-form-urlencoded\r\n" .
                "Content-Length: " . strlen($formdata) . "\r\n",
                'content' => $formdata,
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents($this->_apiAddress, false, $context);
        parent::logMessage('response: ' . $response);
        $result = false;
        if($response){
            $responseArray = explode('/', $response);
            //success response => OK/<int>
            if(isset($responseArray['0']) && $responseArray['0'] == 'OK'){
                $result = true;
            }
        }
        return $result;
    }

    /**
     * Code to string
     *
     * @param string $code changed code
     *
     * @return string
     *
     * @issue 2626
     */
    public function codeToUni($code) {
        $code = iconv('utf-8', 'UCS-2BE', $code);
        $unpack = unpack('H*', $code);
        if (count($unpack) < 2) {
            array_unshift($unpack, 'temp');
        }
        return strtoupper(array_pop($unpack));
    }
}