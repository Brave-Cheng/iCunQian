<?php

/**
 * Subclass for performing query and update operations on the 'deposit_request_financial' table.
 *
 * 
 *
 * @package plugins.deposit.lib.model
 */ 
class DepositRequestFinancialPeer extends BaseDepositRequestFinancialPeer
{
    public static $processStatus = array(
        1 => '未处理',
        2 => '已处理',
    );

    /**
     * insert request financial
     * @param  string $uniqueKey 
     * @param  int $requestId 
     * @return mixed
     */
    static public function saveFinancial($uniqueKey, $requestId) {
        if (!self::isExist($uniqueKey, $requestId)) {
            $financial = new DepositRequestFinancial();
            $financial->setRequestId($requestId);
            $financial->setUniqueKey($uniqueKey);
            $financial->setProcessStatus(1);
            $financial->save();
            return $financial->getId();
        }
        return null;
    }

    /**
     * verfiy the request financial is exist
     * @param  string $uniqueKey 
     * @param  int $requestId 
     * @return mixed
     */
    static public function isExist($uniqueKey, $requestId) {
        $criteria = new Criteria();
        $criteria->add(DepositRequestFinancialPeer::REQUEST_ID, $requestId);
        $criteria->add(DepositRequestFinancialPeer::UNIQUE_KEY, $uniqueKey);
        return DepositRequestFinancialPeer::doSelectOne($criteria);
    }

    /**
     * update status
     * @param  string $uniqueKey 
     * @param  int $requestId 
     * @param  int $status
     * @return mixed
     */
    static public function updateStatusByKeys($uniqueKey, $requestId, $status) {
        if (($financial = self::isExist($uniqueKey, $requestId))){
            $financial->setProcessStatus($status);
            $financial->save();
        }
    }
    
    /**
     * update status by primary key
     * @param int $pk
     * @param int $status
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
     * @param int $pk
     * @param int $process
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
     * @param int $process
     * @return array
     */
    static public function getUnProcessData($process = 1) {
        $criteria = new Criteria();
        $criteria->add(DepositRequestFinancialPeer::PROCESS_STATUS, $process);
        return DepositRequestFinancialPeer::doSelect($criteria);
    }
}
