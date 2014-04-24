<?php

class util
{
    public static function isSigninModule(){
        return sfContext::getInstance()->getModuleName() == sfConfig::get("sf_login_module");
    }
    public static function initPhpMailer(){
        $mailer = new PHPMailer();
        $mailer->IsSMTP();
        $mailer->SMTPAuth    = true;
        $mailer->Host        = 'mail.expacta.com.cn';
        $mailer->Username    = 'mantis@expacta.com.cn';
        $mailer->Password    = 'init123';
        $mailer->ContentType = 'text/html';
        $mailer->CharSet     = 'UTF-8';
        $mailer->Encoding    = 'quoted-printable';
        $mailer->Sender      = 'mantis@expacta.com.cn';
        $mailer->SetFrom('support@rapidmanager.com', 'System Admin');
        $mailer->AddReplyTo('support@rapidmanager.com', 'System Admin');       
        return $mailer;
    }
    
    public static function generateRandomKey($len = 20){
        $string = '';
        $pool   = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for ($i = 1; $i <= $len; $i++){
            $string .= substr($pool, rand(0, 61), 1);
        }
        return $string;
    }
    
    public static function getContentFromController($module, $action=null){
        if(empty($action)) $action = 'index';
        return sfContext::getInstance()->getController()->getPresentationFor($module, $action);
    }
    
    public static function formGetQuery(){
        sfLoader::loadHelpers('util');
        $a = array();
        $nums = func_num_args();
        for ($i = 0; $i < $nums; $i++) {
            $arg = func_get_arg($i);        
            $list = explode('=', $arg);
            if (count($list) > 1) {
                list($parameter, $defaultValue) = $list;
                $value = formGetParameter($parameter);
                if ($value != null) { $a[$parameter] = urlencode($value); }
                else { $a[$parameter] = urlencode($defaultValue); }
            } else {
                list($parameter) = $list;
                $value = formGetParameter($parameter);
                if ($value != null) { $a[$parameter] = urlencode($value); }
            }
        }
        $value = formGetParameter('pager');
        if ($value != null) { $a['pager'] = $value; }
        $s = http_build_query($a);
        return $s;
    }
    
    public static function randomPassword($length = 8){
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $randStr = '';
        while(strlen($randStr)<$length){
            $randStr .= substr($str,(rand()%(strlen($str))),1);
        }
        return $randStr;
    } 
   
    public static function utf8Substr($str, $from, $len) {
        return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                       '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                       '$1',$str);
    }

    public static function logMessage($message, $logFile='', $logTime=true){
        $logDir = sfConfig::get('sf_log_dir');
        if(empty($logFile)) $logFile = SF_APP . '_' . SF_ENVIRONMENT . '.log';
        $handle = fopen($logDir . DIRECTORY_SEPARATOR . $logFile, "a");
        if($logTime == true){
            fwrite($handle, date("Y-m-d H:i:s").": $message\n");
        }else{
            fwrite($handle, $message);
        }
        fclose($handle);
        return true;
    }
    
    public static function getMessage($message, $language='en'){
        $translatedMessage = $message;
        $languageCsvFile = SF_ROOT_DIR . DIRECTORY_SEPARATOR . "doc" . DIRECTORY_SEPARATOR . $language . ".csv";
        if(!file_exists($languageCsvFile)){
            return urlencode($message);
        }
        $handle = fopen($languageCsvFile,"r");
        while ($data = fgetcsv($handle, 1000, ",")) {
            if($message == $data[0]){
                $translatedMessage = $data[1];
                break;
            }
        }
        return urlencode($translatedMessage);
    }
    
    public static function getDefaultLanguage(){
        return 'zh';
    }
    public static function getBackendUrl(){
        $url = 'http://' . $_SERVER['HTTP_HOST'];
        return $url;
    }
    public static function getBackendDir(){
        $backendDir = SF_ROOT_DIR.DIRECTORY_SEPARATOR."web".DIRECTORY_SEPARATOR;
        return $backendDir;
    }

    public static function getUploadDir(){
        $uploadDir = SF_ROOT_DIR . DIRECTORY_SEPARATOR . "web" . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        return $uploadDir;
    }

    public static function getUploadUrl(){
        $backendUrl = self::getBackendUrl();
        $uploadUrl = $backendUrl . '/uploads';
        return $uploadUrl;
    }

    /**
     * createDir create directory 
     * @param dir
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public static function createDir($dir){
       if(!is_dir($dir)){
            mkdir($dir, 0777, true);
       } 
    }
    public static function getIP(){
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return($ip);
    }

    public static function getI18nMessage($message){
        sfLoader::loadHelpers("I18N");
        return __($message);
    }


    public static function uploadImage( $file, $path, $fileName ){
        if($file['name'] && is_dir($path) && !empty($fileName)){
            return move_uploaded_file($file['tmp_name'], $path . $fileName);
        }
        return false;
    }
  
    public static function generateFileName( $image ){
        $pathInfo = pathinfo( $image['name'] );
        $fileName =  md5(uniqid('user')) . '.' . $pathInfo['extension'];
        return $fileName;
    }
    /**
     * replace special char
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public static function replaceSpecialChar($strParam){
        $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
        return preg_replace($regex,"",$strParam);
    }
    public static function getYesOrRadio(){
        $radios = array(
            0=>'否',
            1=>'是'
        );
        return $radios;
    }

    public static function addNotificationRelation($notificationId, $receiver){
        $notificationReceiver = new NotificationReciver();
        $notificationReceiver->setNotificationId( $notificationId );
        $notificationReceiver->setsfGuardUserId( $receiver ) ;
        $notificationReceiver->save();
    }


    public static function addNotification($sender, $title, $content){
        $notification = new Notification();
        $notification->setSfGuardUserId( $sender );
        $notification->setTitle( $title );
        $notification->setContent( $content);
        $notification->setUniqueKey(md5($sender.$title.$content));
        $notification->save();
        return $notification ->getId();
    }
     /**
     *
     * @param      $obj    - object
     *             $class - peer class
     *             $paramets - array(
     *                              'Column'=>paramet    
     *                                 )
     *             column  - the colum begins to uppercase
     *             paramet - if an array, the number of array must be the same
     *             $keyType - type
     * @return     bool - true false;
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-19
     * @issue      2322 - User Management
     * @desc       validate  user info data to return to page value,
     *             and  if modifite, return true;
     */
    public static function isModified($objs, $class, $paramets, $keyType = BasePeer::TYPE_PHPNAME){
        $status =  false;
        $parametCount = 0;
        if(is_array($paramets)){
            foreach ($paramets as $paramet){
                if(is_array($paramet)){
                    $parametCount = count($paramet);
                }else{
                    $parametCount = 1;
                }
            }
        }
        if($parametCount == 1){
            $status = self::modifiedArray($objs, $class, $paramets, $keyType) ? true : false;
        }else{
            $status = self::modifiedsArray($objs, $class, $paramets, $keyType) ? true : false;
        }
        return $status;
    }
    /**
     *
     * @param      $objs    - objects
     *             $class   - peer class
     *             $paramets - array(
     *                              'Column'=>paramet
     *                                 )
     *             column  - the colum begins to uppercase
     *             paramet - if an array, the number of array must be the same
     *             $keyType - type
     * @return     array()
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-19
     * @issue      2322 - User Management
     * @desc       return to modified data
     */
    public static function modifiedsArray($objs, $class, $paramets, $keyType = BasePeer::TYPE_PHPNAME){
        $arr = '';
        $parametCount = '';
        if(is_array($class)){
            $keys = self::getPhpNameByClass($class);
        }else{
            eval('$keys = '.$class.'::getFieldNames($keyType);');
        }
        $objCount = count($objs);
        if(is_array($paramets)){
            foreach ($paramets as $parametCounts){
                if(is_array($parametCounts)){
                    $parametCount = count($parametCounts);
                }
            }
        }
        if($parametCount > $objCount){
            foreach ($paramets as $key => $paramet){
                if(is_array($paramet)){
                    foreach ($paramet as $k => $p){
                        $datas = isset($objs[$k]) ? $objs[$k]->toArray() : null;
                        $data  = $datas[$key];
                        if($p != $data){
                            $arr[] = array('add' => array($key => $p));
                        }
                    }
                }
            }
        }elseif($parametCount < $objCount){
            foreach ($objs as $k => $obj){
                $datas = $obj->toArray();
                foreach ($keys as $key){
                    if(array_key_exists($key, $paramets)){
                        $arry = isset($paramets[$key][$k]) ? $paramets[$key][$k] : null;
                        $data = isset($datas[$key]) ? strval($datas[$key]) : null;
                        if($arry != $data){
                            $arr[] = array('reduce' => array($key => $data));
                        }
                    }
                }
            }
        }elseif($parametCount == $objCount){
            $arr = self::modifiedArray($objs, $class, $paramets, $keyType);
        }
        return  $arr;
    }
    /**
     *
     * @param      $objs    - objects / object
     *             $class   - peer class
     *             $paramets - array(
     *                              'Column'=>paramet
     *                                 )
     *             column  - the colum begins to uppercase
     *             paramet - if an array, the number of array must be the same
     *             $keyType - type
     * @return     array()
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-19
     * @issue      2322 - User Management
     * @desc       return to modified data
     */
    public static function modifiedArray($objs, $class, $paramets, $keyType = BasePeer::TYPE_PHPNAME){
        $arr = '';
        $status = false;
        if(is_array($class)){
            $keys = self::getPhpNameByClass($class);
        }else{
            eval('$keys = '.$class.'::getFieldNames($keyType);');
        }
        
        foreach ($objs as $obj){
            $status = is_object($obj) ? true : false;
            break;
        }
        if(is_array($objs) && $status){
            foreach ($paramets as $key => $paramet){
                if(is_array($paramet)){
                    foreach ($paramet as $k => $p){
                        $datas = isset($objs[$k]) ? $objs[$k]->toArray() : null;
                        $data  = strval($datas[$key]);
                        if($p != $data){
                            $arr[] =array('change' =>array($key => $p));
                        }
                    }
                }
            }
        }else{
            $datas = is_object($objs) ? $objs->toArray() : $objs;
            foreach ($keys as $key){
                if(array_key_exists($key, $paramets)){
                    $data = isset($datas[$key]) ? $datas[$key] : null;
                    $arry = isset($paramets[$key]) ? $paramets[$key] : null;
                    if($arry != $data){
                        $arr[] =array('change' =>array($key => $arry));
                    }
                }
            }
        }
        return $arr;
    }
    /**
     * 
     * @param      $class - array (peer class)
     *             $keyType - type
     * @return     $keys - array():
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-26    
     * @issue      2322 - User Management
     * @desc       Get the field name by class,
     *             Multiple class synthesis of an field name array
     */
    public static function getPhpNameByClass($class, $keyType = BasePeer::TYPE_PHPNAME){
        $keys = array();
        foreach ($class as $peer ){
            eval('$phpName = '.$peer.'::getFieldNames($keyType);');
            $keys = array_merge($keys, $phpName);
        }
        return $keys;
    }
    /**
     * 
     * @param      $objs - array()
     * @return     $arr - array();
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-11-26    
     * @issue      2322 - User Management
     * @desc       The field name a database change symfony need field name
     */
    public static function getFieldNameByDataFieldName($objs){
        $arr = array();
        if(is_object($objs)) return $arr;
        foreach ($objs as $keys => $obj){
            $keys = explode('_', $keys);
            foreach ($keys as $key){
                $fieldName[] = ucfirst($key);
            }
            $field = join($fieldName, '');
            $arr[$field] = $obj;
            unset($fieldName);
        }
        return $arr;
    }
    /**
     * @param  $number 
     * @param  $decimals - decimal point digit
     * @return float
     * @author hang.lu<hang.lu@expacta.com.cn>
     * @issue  2380
     */
    public static function formattingNumbers($number,$decimals){
        return sprintf("%.{$decimals}f", $number); 
    }
    
}