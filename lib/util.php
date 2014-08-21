<?php

/**
 * util class
 * 
 * @package lib
 */

class util
{
    /**
     * getMultiMessage
     * 
     * @param string $message message
     * 
     * @issue 2568
     * @return string
     */
    public static function getMultiMessage($message) {
        return sfContext::getInstance()->getI18N()->__($message);
    }

    /**
     * get user
     * 
     * @issue 2568
     * @return object user
     */
    public static function getUser() {
        return sfContext::getInstance()->getUser();
    }

    /**
     * get random password
     * 
     * @param int $length length
     * 
     * @issue 2568
     * @return string
     */
    public static function randomPassword($length = 8) {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $randStr = "";
        while (strlen($randStr) < $length) {
            $randStr .= substr($str, (rand() % (strlen($str))), 1);
        }
        return $randStr;
    }

    /**
     * get or create
     * 
     * @param string $name     name
     * @param string $defaults default
     * @param string $type     type
     * 
     * @issue 2568
     * @return object name
     */
    public static function getOrCreate($name, $defaults, $type = BasePeer::TYPE_FIELDNAME) {
        $peer = $name . 'Peer';
        $c = new Criteria();
        foreach ($defaults as $field => $value) {
            $field = call_user_func(array($peer, 'translateFieldName'), $field, $type, BasePeer::TYPE_FIELDNAME);
            $c->add(constant($peer . '::' . strtoupper($field)), $value);
        }
        if (!($obj = call_user_func(array($peer, 'doSelectOne'), $c))) {
            $obj = new $name();
            $obj->fromArray($defaults, $type);
        }
        return $obj;
    }

    /**
     * getContentFromController
     * 
     * @param object $module module
     * @param string $action action
     * 
     * @issue 2568
     * @return object
     */
    public static function getContentFromController($module, $action = null) {
        if (empty($action))
            $action = 'index';
        return sfContext::getInstance()->getController()->getPresentationFor($module, $action);
    }

    /**
     * getI18nMessage
     * 
     * @param string $message message
     * 
     * @issue 2568
     * @return message
     */
    public static function getI18nMessage($message) {
        sfLoader::loadHelpers("I18N");
        return __($message);
    }

    /**
     * formattingNumbers
     * 
     * @param int   $number   number
     * @param float $decimals decimals
     * 
     * @issue 2568
     * @return string
     */
    public static function formattingNumbers($number, $decimals) {
        return sprintf("%.{$decimals}f", $number);
    }

    /**
     * replaceSpecialChar
     * 
     * @param string $strParam str
     * 
     * @issue 2568
     * @return string
     */
    public static function replaceSpecialChar($strParam) {
        $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
        return preg_replace($regex, "", $strParam);
    }

    /**
     * logMessage
     * 
     * @param string $message message
     * @param string $logFile message
     * 
     * @issue 2568
     * @return boolean
     */
    public static function logMessage($message, $logFile = '') {
        $logDir = sfConfig::get('sf_log_dir');
        if (empty($logFile))
            $logFile = SF_APP . '_' . SF_ENVIRONMENT . '.log';
        $handle = fopen($logDir . DIRECTORY_SEPARATOR . $logFile, "a");
        fwrite($handle, date("Y-m-d H:i:s") . ": $message" . PHP_EOL);
        fclose($handle);
        return true;
    }

    /**
     * rm2FormGetQuery
     * 
     * @issue 2568
     * @return object
     */
    public static function rm2FormGetQuery() {
        $a = array();
        $nums = func_num_args();
        for ($i = 0; $i < $nums; $i++) {
            $arg = func_get_arg($i);
            $list = explode("=", $arg);
            if (count($list) > 1) {
                list($parameter, $defaultValue) = $list;
                $value = self::rm2FormGetParameter($parameter);
                if ($value != null) {
                    $a[$parameter] = urlencode($value);
                } else {
                    $a[$parameter] = urlencode($defaultValue);
                }
            } else {
                list($parameter) = $list;
                $value = self::rm2FormGetParameter($parameter);
                if ($value != null) {
                    $a[$parameter] = urlencode($value);
                }
            }
        }
        $value = self::rm2FormGetParameter("pager");
        if ($value != null) {
            $a["pager"] = $value;
        }
        $s = http_build_query($a);
        return $s;
    }

    /**
     * rm2FormGetParameter
     * 
     * @param string $name         name
     * @param string $defaultValue value
     * @param string $index        index 
     * 
     * @issue 2568
     * @return string
     */
    public static function rm2FormGetParameter($name, $defaultValue = null, $index = "") {
        $requeset = sfContext::getInstance()->getRequest();
        if ($name == null || $name == '') {
            return $defaultValue;
        }
        $name = str_replace(array("[", "]"), array("", ""), $name);
        $value = null;
        if ($requeset->hasParameter($name)) {
            $reqValue = $requeset->getParameter($name);
            if (is_object($reqValue) && $index != "") {
                $value = $reqValue[$index];
            } else {
                $value = $reqValue;
            }
        } else {
            if (is_object($value) && $index != "") {
                $value = $value[$index];
            }
        }

        return $value;
    }

    /**
     * getTopFewDigitsSumInArrayByNumbers
     * 
     * @param array $array   array
     * @param int   $numbers number
     * 
     * @issue 2568
     * @return int
     */
    public static function getTopFewDigitsSumInArrayByNumbers($array, $numbers) {
        $feesArray = $array;
        for ($i = 0; $i <= count($feesArray) - 1; $i++) {
            for ($j = 0; $j < count($feesArray) - $i - 1; $j++) {
                if ($feesArray[$j + 1] > $feesArray[$j]) {
                    $temp = $feesArray[$j + 1];
                    $feesArray[$j + 1] = $feesArray[$j];
                    $feesArray[$j] = $temp;
                }
            }
        }
        $topFewDigitsSum = 0;
        for ($i = 0; $i < $numbers; $i++) {
            if (isset($feesArray[$i])) {
                $topFewDigitsSum += $feesArray[$i];
            } else {
                $topFewDigitsSum += 0;
            }
        }
        return $topFewDigitsSum;
    }
    
    /**
     * create dir
     * 
     * @param string $path  path name
     * @param int    $mode  mode
     * @param string $user  user name 
     * @param string $group group name
     * 
     * @issue 2568
     * @return null
     */
    public static function createDir($path, $mode, $user, $group) {
        if (!file_exists($path)) {
            self::createDir(dirname($path), $mode, $user, $group);
            mkdir($path);
            exec("chmod -R $mode $path");
            exec("chown -R $user:$group $path");
        }
    }
    
    /**
     * get real ip
     * 
     * @issue 2568
     * @return string
     */
    public static function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
    /**
     * char to pinyin
     * 
     * @param string $string char string
     * 
     * @issue 2568
     * @return string
     */
    public static function charToPinyin($string) {
        $pinyin = '';
        $api = "http://ctrlapi.sinaapp.com/pinyin/index.php?wd=%s&s=0";
        $content = file_get_contents(sprintf($api, $string));
        if ($content) {
            $string = explode(" ", $content);
            foreach ($string as $word) {
                $first = substr($word, 0, 1);
                $pinyin .= strtoupper($first);
            }
        } else {
            $pinyin = Pinyin::conv($string);
        }
        return $pinyin;
    }

    /**
     * Push APNs service
     *
     * @param int     $messageId index key
     * @param string  $token     token 
     * @param string  $message   message
     * @param boolean $sandbox   apns environment
     * @param int     $badge     apns badge
     * @param string  $sound     apns sound
     * @param array   $custom    apns custom message
     *
     * @return mixed
     *
     * @issue 2599
     */
    public static function pushApnsMessage($messageId, $token, $message, $sandbox = false, $badge = 0, $sound = '', $custom = array()) {
        if ($sandbox == PushDevicesPeer::DEVELOPMENT_SANDBOX) {
            $environment = ApnsConstants::$environmentSandbox;    
        } else {
            $environment = ApnsConstants::$environmentProduction;
        }
        //set message info
        $messager = new ApnsMessage();
        //Add alert 
        $messager->setPushText($message);
        //Add badge
        if ($badge) {
            $messager->setPushBadge($badge);
        }
        //Add sound
        if ($sound) {
            $messager->setPushSound($sound);
        }
        //Add custom message
        if ($custom) {
            $messager->addCustomPropery($custom);
        }
        $apns = new ServerApnsSend($environment);
        $apns->setMessager($messager);

        $apns->post($messageId, $token);
        return $apns->getApnsResult();
    }

    /**
     * Get domain
     *
     * @return string
     *
     * @issue 2626
     */
    public static function getDomain() {
        return 'http://' . sfContext::getInstance()->getRequest()->getHost();
    }

    /**
     * encode and decode string
     *
     * @param string $string    encode/decode string
     * @param enum   $operation "DECODE" or "ENCODE"
     * @param string $key       Encrypted string
     * 
     * @return - encoded/decoded string
     * 
     * @issue 2626
     */
    public static function authCode($string, $operation, $key = '') {
        $cipher = MCRYPT_BLOWFISH;
        $mode = MCRYPT_MODE_ECB;
        $key = $key ? $key : "YYADE-+78d$-OP25b-721n-qweF3";
        if (function_exists('mcrypt_create_iv')) {
            $iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher, $mode), MCRYPT_RAND);
            if ($operation == "ENCODE") {
                return base64_encode(mcrypt_encrypt($cipher, $key, $string, $mode, $iv));
            } else {
                return rtrim(mcrypt_decrypt($cipher, $key, base64_decode($string), $mode, $iv), "\0");
            }
        }
        return $string;
    }

    /**
     * Make seed 
     *
     * @return int
     *
     * @issue 2626
     */
    public static function getSeed() {
        return rand(100000, 699999);
    }

    /**
     * Check string if is date
     *
     * @param string $string date string
     * @param string $format Y-m-d
     *
     * @return boolean    
     *
     * @issue 2580
     */
    public static function isDate($string, $format = 'Y-m-d') {
        if (empty($string)) {
            return true;
        }
        if (strpos($string, '/') !== false) {
            $arr = explode('/',$string);    
        }
        if (strpos($string, '-') !== false) {
             $arr = explode('-',$string);
        } 
        
        if (empty($arr[0]) || empty($arr[1]) || empty($arr[2])) {
            return false;
        } else {
            return checkdate($arr[1],$arr[2],$arr[0]);    
        }
    }

    /**
     * Send an email
     *
     * @param string $mailer  mail to 
     * @param string $subject subject
     * @param string $body    body
     * 
     * @return void
     * 
     * @issue 2641
     */
    public static function mailTo($mailer, $subject, $body) {
        //send mail
        $mail = Mailer::initialize();
        $mail->Subject = $subject;
        if (is_array($mailer)) {
            foreach ($mailer as $sender) {
                $mail->AddAddress($sender);
            }
        } else {
            $mail->AddAddress($mailer);
        }
        $mail->MsgHTML($body);
        $mail->send();
    }

}