<?php

/**
 * Subclass for performing query and update operations on the 'api_offline_queue' table.
 *
 * 
 *
 * @package lib\model
 */ 
class ApiOfflineQueuePeer extends BaseApiOfflineQueuePeer
{
    const ICAIFU = 'icaifu';
    const FAVORITE = 'favorite';


    /**
     * Get types
     *
     * @return array
     *
     * @issue 2703
     */
    public static function getTypes() {
        return array(
            ApiOfflineQueuePeer::ICAIFU     => ApiOfflineQueuePeer::ICAIFU,
            ApiOfflineQueuePeer::FAVORITE   => ApiOfflineQueuePeer::FAVORITE,
        );
    }

    /**
     * Batch dequeue
     *
     * @return array error list
     *
     * @issue 2702
     */
    public static function batchDequeue() {
        $queueLists = ApiOfflineQueuePeer::doSelect(new Criteria());
        $error = array();
        if ($queueLists) {
            foreach ($queueLists as $queue) {
                switch ($queue->getType()) {
                    case ApiOfflineQueuePeer::ICAIFU:
                        try {
                            ApiOfflineQueuePeer::personalEnqueue($queue->getBody());    
                        } catch (Exception $e) {
                            $error[] = $e->getMessage();
                        }
                        $queue->delete();
                        break;
                    case ApiOfflineQueuePeer::FAVORITE:
                        try {
                            ApiOfflineQueuePeer::favoriteEnqueue($queue->getBody());
                        } catch (Exception $e) {
                            $error[] = $e->getMessage();
                        }
                        $queue->delete();
                        break;

                }
            }
            return $error;
        }
    }

    /**
     * Personal product enqueue
     *
     * @param string $serialize serialize string 
     *
     * @return void
     *
     * @issue 2702
     */
    public static function personalEnqueue($serialize) {
        $unserialize = unserialize($serialize);
        if (!$unserialize) {
            // throw new ParametersException(ParametersException::$error1000, $unserialize);
            throw new Exception('The unserialize string can not be decode.');
        }
        if (!is_array($unserialize)) {
            // throw new ObjectsException(ObjectsException::$error2000);
            throw new Exception('The unserialize string is not an array.');
        }
        $personal = DepositPersonalProductsPeer::retrieveByUuid($unserialize['uuid']);
        DepositFinancialProductsPeer::verifyProduct($unserialize['product_id']);
        if (!in_array($unserialize['deadline_reminder'], array(DepositMembersPeer::YES, DepositMembersPeer::NO))) {
            // throw new ParametersException(ParametersException::$error1000, 'deadline_reminder');
            throw new Exception('The parameter deadline_reminder is not correct.');
            
        }
        if (!$personal) {
            DepositPersonalProductsPeer::addPersonalProduct(
                $unserialize['product_id'],
                $unserialize['account_id'],
                $unserialize['expectet_rate'],
                $unserialize['amount'],
                $unserialize['buy_date'],
                $unserialize['expired_date'],
                $unserialize['uuid'],
                $unserialize['sync_status'],
                $unserialize['deadline_reminder']
            );
        } else {
            $personal->setDepositFinancialProductsId($unserialize['product_id']);
            $personal->setDepositMembersId($unserialize['account_id']);
            $personal->setExpectedRate($unserialize['expectet_rate']);
            $personal->setAmount($unserialize['amount']);
            $personal->setBuyDate($unserialize['buy_date']);
            $personal->setExpiryDate($unserialize['expired_date']);
            $personal->setSyncStatus($unserialize['sync_status']);
            $personal->setDeadlineReminder($unserialize['deadline_reminder']);
            $personal->save();
        }
    }

    /**
     * User favorite product enqueue
     *
     * @param string $serialize serialize string 
     *
     * @return void
     *
     * @issue 2703
     */
    public static function favoriteEnqueue($serialize) {
        $unserialize = unserialize($serialize);
        if (!$unserialize) {
            // throw new ParametersException(ParametersException::$error1000, $unserialize);
            throw new Exception('The unserialize string can not be decode.');
        }
        if (!is_array($unserialize)) {
            // throw new ObjectsException(ObjectsException::$error2000);
            throw new Exception('The unserialize string is not an array.');
        }
        $favorite = DepositMembersFavoritesPeer::retrieveByUuid($unserialize['uuid']);

        DepositFinancialProductsPeer::verifyProduct($unserialize['id']);

        if (!$favorite) {
            DepositMembersFavoritesPeer::addFavoriate(
                $unserialize['account_id'],
                $unserialize['id'],
                $unserialize['sync_status'],
                $unserialize['uuid']
            );
        } else {
            $favorite->setDepositMembersId($unserialize['account_id']);
            $favorite->setDepositFinancialProductsId($unserialize['id']);
            $favorite->setSyncStatus($unserialize['sync_status']);
            $favorite->setUuid($unserialize['uuid']);
            $favorite->save();
        }
    }
}
