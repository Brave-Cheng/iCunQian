<?php

/**
 * Subclass for performing query and update operations on the 'deposit_request' table.
 *
 * 
 *
 * @package plugins.deposit.lib.model
 */ 
class DepositRequestPeer extends BaseDepositRequestPeer
{

    public static $isProcess = array(
        1 => '任务未开始',
        2 => '正在处理',
        3 => '处理完成',
    );

    static public function saveRequest($page, $uniquesKeys) {
        if (!self::isRepeat($page, $uniquesKeys)) {
            $request = new DepositRequest();
            $request->setPage($page);
            $request->setUniqueKeys($uniquesKeys);
            $request->setEncrypt(self::makeUniqueValue($page, $uniquesKeys));
            $request->setIsProcess(1);
            $request->setRequestNumber(1);
            $request->save();
        } else {
            self::increaseRequestNumber($page, $uniquesKeys);
        }
    }

    /**
     * Whether the page has been repeated
     * @param  int  $page        
     * @param  string  $uniquesKeys 
     * @return mixed           
     */
    static public function isRepeat($page, $uniquesKeys) {
        $critiera = new Criteria();
        $critiera->add(DepositRequestPeer::PAGE, $page);
        $critiera->add(DepositRequestPeer::ENCRYPT, self::makeUniqueValue($page, $uniquesKeys));
        return DepositRequestPeer::doSelectOne($critiera);
    }

    /**
     * Update request number
     * @param  int  $page        
     * @param  string  $uniquesKeys 
     * @return mixed 
     */
    static public function increaseRequestNumber($page, $uniquesKeys) {
         if (($request = self::isRepeat($page, $uniquesKeys))) {
            $request->setRequestNumber($request->getRequestNumber() + 1);        
            $request->save();
         }
    }

    /**
     * Update the processing status
     * @param  int $page        
     * @param  string $uniquesKeys 
     * @param  int $status      
     * @return mixed
     */
    static public function updateProcessStatus($page, $uniquesKeys, $status) {
        if (($request = self::isRepeat($page, $uniquesKeys))) {
            $request->setIsProcess($status);        
            $request->save();
        }
    }
    
    /**
     * All data encryption every page form a unique value
     * @param int $page
     * @param string $subject
     * @return string
     */
    static public function makeUniqueValue($page, $subject) {
        return md5($page . $subject);
    }
    
    /**
     * get un-process data
     * @param int $page
     * @return object 
     */
    static public function getUnProcessList($page = 1) {
        $criteria = new Criteria();
        $criteria->add(DepositRequestPeer::PAGE, $page);
        $criteria->add(DepositRequestPeer::IS_PROCESS, 3, Criteria::NOT_EQUAL);
        return DepositRequestPeer::doSelectOne($criteria);
    }
    
}
