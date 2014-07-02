<?php

/**
 * Subclass for performing query and update operations on the 'deposit_request_financial' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositRequestFinancialPeer extends BaseDepositRequestFinancialPeer
{
    public static $processStatus = array(
        1 => '未处理',
        2 => '已处理',
    );

    const DATA_MODE_IMPORT = 10;
    const DATA_MODE_ADD = 11;
    
    /**
     * get mode list
     * 
     * @param int $mode mode id
     * 
     * @issue 2580
     * @return mixed
     */
    public static function getMode($mode = null) {
        $modes = array(
            self::DATA_MODE_ADD     => util::getMultiMessage('Manual Add '), 
            self::DATA_MODE_IMPORT  => util::getMultiMessage('Excel Add '), 
        );
        if ($mode) {
            return $modes[$mode];
        }
        return $modes;
    }

    /**
     * insert request financial
     * 
     * @param string $uniqueKey unique key
     * @param int    $status    status
     * 
     * @issue 2579
     * @return mixed
     */
    static public function saveFinancial($uniqueKey, $status) {
        if (!self::isExist($uniqueKey)) {
            $financial = new DepositRequestFinancial();
            $financial->setUniqueKey($uniqueKey);
            $financial->setStatus($status);
            $financial->setProcessStatus(1);
            $financial->setSyncStatus(DepositFinancialProductsPeer::SYNC_ADD);
            $financial->save();
            return $financial;
        }
        throw new Exception(sprintf("The %s is exist", $uniqueKey));
    }

    /**
     * verfiy the request financial is exist
     * 
     * @param string $uniqueKey unique key
     * 
     * @issue 2579
     * @return mixed
     */
    static public function isExist($uniqueKey) {
        $criteria = new Criteria();
        $criteria->add(DepositRequestFinancialPeer::UNIQUE_KEY, $uniqueKey);
        return DepositRequestFinancialPeer::doSelectOne($criteria);
    }

    /**
     * update status
     * 
     * @param string $uniqueKey unique key
     * @param int    $status    status
     * 
     * @issue 2579
     * @return mixed
     */
    static public function updateStatusByKeys($uniqueKey, $status) {
        if (($financial = self::isExist($uniqueKey))){
            $financial->setProcessStatus($status);
            $financial->save();
        }
    }
    
    /**
     * update status by primary key
     * 
     * @param int $pk     parmary key
     * @param int $status status
     * 
     * @issue 2579
     * @return null
     */
    static public function updateStatusById($pk, $status) {
        $financial = DepositRequestFinancialPeer::retrieveByPK($pk);
        if ($financial) {
            $financial->setStatus($status);
            $financial->save();
        }
    }
    
    /**
     * update process status by primary key
     * 
     * @param int $pk      parmary key
     * @param int $process process status
     * 
     * @issue 2579
     * @return null
     */
    static public function updateProcessStatusById($pk, $process) {
        $financial = DepositRequestFinancialPeer::retrieveByPK($pk);
        if ($financial) {
            $financial->setProcessStatus($process);
            $financial->save();
        }
    }

    /**
     * get un processed data list 
     * 
     * @param int $process process status
     * 
     * @issue 2579
     * @return array
     */
    static public function getUnProcessData($process = 1) {
        $criteria = new Criteria();
        $criteria->add(DepositRequestFinancialPeer::PROCESS_STATUS, $process);
        return DepositRequestFinancialPeer::doSelect($criteria);
    }
    
    /**
     * add financial by mode
     * 
     * @param int    $mode   mode id
     * @param string $status status
     * 
     * @issue 2580
     * @return DepositRequestFinancial
     */
    public static function addByMode($mode, $status) {
        try {
            $financial = new DepositRequestFinancial();
            $financial->setStatus($status);
            $financial->setProcessStatus($mode);
            $financial->setSyncStatus(DepositFinancialProductsPeer::SYNC_ADD);
            $financial->save();
            return $financial;
        } catch (Exception $exc) {
            throw $exc;
        }



        
    }

}
