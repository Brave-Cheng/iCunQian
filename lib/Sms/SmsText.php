<?php
class SmsText extends SmsAbstract {
    public function send($receiver , $message) {
        $this->setLastMessage($message);
        $this->setLastReceiver($receiver);

        /*$url="http://service.winic.org/sys_port/gateway/?id=075585508633&pwd=555555&to=".$receiver."&content=".urlencode($message)."&time=";
        $result = file_get_contents($url);*/
        //$result = file_get_contents("http://smscat.9aisn.com/api.php?from=1&to=".$receiver."&content=".urlencode($message));
        //$result = file_get_contents("http://utf8.sms.webchinese.cn/?Uid=guzhonzhi&Key=67869b059d62168cc9b6&smsMob=".$receiver."&smsText=".urlencode($message));
        //var_dump($result);
       // return $result;
        //http://service.winic.org/sys_port/gateway/?id=075585508633&pwd=555555&to=1590814
        //000/Send:1/Consumption:.1/Tmoney:.9/sid:0427214905864919
        
        $userName = 'TJZJ';                 //用户账号
        $userPassword = '054888';       //密码
        $userVIP = 'publicTest';                             //代理商ID
        $url = 'HTTP://web.mmlj.cn:12250/xcdeal.asp';  //提交地址
        $formdata = 'textacc='.self::codeToUni($userName).'&textpsw='.self::codeToUni($userPassword).'&textphone='.$receiver.'&submitsendmsg=submit&textcontent='.self::codeToUni($message);
        
        $opts = array(
                'http'=>array(
                        'method'=>"POST",
                        'header'=>"Accept: application/json, text/javascript, */*\r\n" .
                        "Content-Type: application/x-www-form-urlencoded\r\n".
                        "Content-Length: ".strlen($formdata)."\r\n",
                        'content'=>"{$formdata}",
                )
        );
        
        $context = stream_context_create($opts);
        
        $result = file_get_contents($url, false, $context);
        $res = explode('/', $result);
        return $res;
    }
    public static  function codeToUni($code) {
            $code = iconv('utf-8', 'UCS-2BE', $code);
            return strtoupper(array_pop(unpack('H*', $code)));
    }
}