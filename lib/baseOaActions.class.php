<?php
class baseOaActions extends sfActions
{
    static $apiLogName  = 'api_visit.log';
    static $systemErrorLogName  = 'system_error.log';
    static $telKey = 85332667;

    public function preExecute(){ 
        date_default_timezone_set('Asia/Shanghai');
        if(!$this->getUser()->hasAttribute('sfGuardUser')){
            header('Content-type: text/html; charset = utf-8');
            $tel     = $this->getRequestParameter('tel');
            $tel     = $this->getTel($tel);
            $userObj = sfGuardUserProfilePeer::getUserByTel($tel);
            if(!$userObj){
                $result = 0;
                $reponse = util::getMessage(message::USER_IS_NOT_EXIST);
                echo urldecode(json_encode(array('result'=>$result,'reponse'=>$reponse)));
                exit;
            }
        }
    }

    public function getResponseData($responseData){
        $responseData = urldecode(json_encode($responseData));       
        $this->logApiActionMessage($responseData);
        $callback = $this->getRequestParameter('callback');
        if($callback){
            $data =  $callback . "(" . $responseData . ");";
        }else{
            $data =  $responseData;
        }
        echo $data;        
        die();
    } 
    
    public function logApiActionMessage($content){
        $message = '';
        $moduleName = $this->getModuleName();
        $actionName = $this->getActionName();
        $parameters = $this->getRequest()->getParameterHolder()->getNames();
        $parameters = array_flip($parameters);
        //unsert the default parameter
        unset($parameters['module']);
        unset($parameters['action']);
        $parameters = array_keys($parameters);
        $parameterString = "";
        foreach($parameters as $parameter){
            $parameterString .= $parameter . " - " . $this->getRequestParameter($parameter) . ", ";
        }
        $message .= "Request time: " .date("Y-m-d H:i:s") ."\n";
        $message .= "Api name: " .$actionName ."\n";
        $message .= "Parameter: " . $parameterString ."\n";
        $message .= "Response: " . $content ."\n";
        $message .= '-----------------------------------------------------------------' ."\n";
        $logName  = self::$apiLogName;
        util::logMessage($message, $logName, false);
    }
    
    public function returnSystemErrorMessage($e, $language='en'){
        $message = util::getMessage(message::SYSTEM_ERROR, $language);
        if($e){
            $logMessage = $e->getMessage();
        }else{
            $logMessage = urldecode($message);
        }
        util::logMessage($logMessage, self::$systemErrorLogName);
        echo urldecode(json_encode($logMessage)); 
        die();
    }
    
    public function getTel($tel){
        $tel = base64_decode($tel);
        $tel = $tel - self::$telKey;
        return $tel;
    } 
}

?>