<?php
/**
 * 
 * @package     oa
 * @subpackage  systemUserLog
 * @author      ice.leng<ice.leng@expacta.com.cn>
 * @date        2013-10-25    
 * @issue       2323
 * @desc        write system log 
 */
class UserLogPeer extends BaseUserLogPeer
{
    /**
     * 
     * @param      $id - Operation Data Id
     *             $moduleName 
     *             $actionName            
     * @return     null
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25    
     * @issue      2323
     * @desc       save log
     */
    private static function writeDate($id, $moduleName, $actionName){ 
        $ip     = util::getIP();
        $user   = sfContext::getInstance()->getUser()->getGuardUser();
        $userId = $user?$user->getId():null;        
        // The default page when you don't record without login    
        if(!in_array($moduleName, sfGuardPermissionPeer::getPermission()) || $userId !=null){ 
            $systemLog = new UserLog();
            $systemLog->setOperationDataId($id);
            $systemLog->setSfGuardUserId($userId);
            $systemLog->setAction($actionName);
            $systemLog->setIpAddress($ip);
            $systemLog->setModule($moduleName);
            $systemLog->save();
        }
    }
    /**
     * 
     * @param      $parameter  - request parameter holder
     *             $documentId - document id
     * @return     null
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25    
     * @issue      2323
     * @desc       record   all  id   except project_document  delete document id 
     */ 
    private static function operationDataId($parameter, $documentId){
        $actionName = $parameter['action'];
        $moduleName = $parameter['module'];
        $deleteIds = isset($parameter['deleteId'])?$parameter['deleteId']:null;
        if(is_array($deleteIds)){
            foreach ($deleteIds as $deleteId){
                $id = $deleteId;
                self::writeDate($id, $moduleName, $actionName);
            }
        }else{
            $deleteId = isset($parameter['deleteId'])?$parameter['deleteId']:null;          
            $getId = !empty($parameter['id'])?$parameter['id']:$deleteId;      
            $id = $documentId?$documentId:$getId;
            self::writeDate($id, $moduleName, $actionName);           
        }
    }
    /**
     * 
     * @param      $documentId - The incoming document id
     * @return     null            
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25    
     * @issue      2323    
     * @desc       record project_document  delete document id
     */ 
    private static function writeLogForDocument($documentId){
        $actionName = 'deleteDocument';
        $moduleName = 'project';
        $id = $documentId?$documentId:null;
        self::writeDate($id, $moduleName, $actionName);
    }
    /**
     *
     * @param      $documentId - The incoming document id
     *             $msg - To judge the incoming number
     * @return     null
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25
     * @issue      2323
     * @desc       write log
     */
    public static function  writeLog($documentId=false, $msg=false){
        $request    = sfContext::getInstance()->getRequest();
        $parameter  = $request->getParameterHolder()->getAll();
        $msg ? self::writeLogForDocument($documentId) : self::operationDataId($parameter, $documentId);  
    }
}
