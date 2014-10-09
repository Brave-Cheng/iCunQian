<?php

/**
 * Subclass for performing query and update operations on the 'push_messages' table.
 *
 * 
 *
 * @package lib\model
 */ 
class PushMessagesPeer extends BasePushMessagesPeer
{

    const STATUE_QUEUED         = 'queued';
    const STATUS_DELIVERED      = 'delivered';
    const STATUS_FAILED         = 'failed';

    /**
     * Get all pushed status
     *
     * @return array
     *
     * @issue  2599
     */
    public static function getPushedStatus() {
        $status = array(
            PushMessagesPeer::STATUE_QUEUED     => PushMessagesPeer::STATUE_QUEUED,
            PushMessagesPeer::STATUS_DELIVERED  => PushMessagesPeer::STATUS_DELIVERED,
            PushMessagesPeer::STATUS_FAILED     => PushMessagesPeer::STATUS_FAILED     
        );
    }


    /**
     * Add push message
     *
     * @param int    $accountId deposit members id 
     * @param int    $productId deposit finanacial products id
     * @param string $message   message
     *
     * @return object PushMessages
     *
     * @issue 2714
     */
    public static function pushMessageEnqueue($accountId, $productId, $message) {
        $pushMessage = new PushMessages();
        $pushMessage->setDepositMembersId($accountId);
        $pushMessage->setDepositFinancialProductsId($productId);
        $pushMessage->setMessage($message);
        $pushMessage->setStatus(PushMessagesPeer::STATUE_QUEUED);
        $pushMessage->save();
        return $pushMessage;
    }

    /**
     * Pushed message dequeue
     *
     * @param int $accountId deposit members id
     *
     * @return array
     *
     * @issue 2599, 2714
     */
    public static function messageDequeue($accountId = 0) {
        $criteria = PushMessagesPeer::filterMessages($accountId);
        return PushMessagesPeer::doSelect($criteria);
    }

    /**
     * Gets filter query message
     *
     * @param int    $accountId deposit members id
     * @param string $status    send status
     *
     * @return object 
     *
     * @issue 2599, 2714
     */
    public static function filterMessages($accountId = 0, $status = PushMessagesPeer::STATUE_QUEUED) {
        $criteria = new Criteria();
        if ($accountId) {
            $criteria->add(PushMessagesPeer::DEPOSIT_MEMBERS_ID, $accountId);
        }
        $criteria->add(PushMessagesPeer::STATUS, $status);
        return $criteria;
    }

    /**
     * Set pushed message feedback
     *
     * @param int    $messageId    push message parmary key
     * @param mixed  $delivery     send time
     * @param string $status       send status
     * @param string $errorMessage error message
     *
     * @return int affected rows
     * 
     * @issue 2599
     */
    public static function setPushedMessageFeedback($messageId, $delivery, $status, $errorMessage = '') {
        $messager = PushMessagesPeer::retrievePK($messageId);
        if (empty($messageId)) {
            throw new Exception(sprintf('the message %s is not exist.', $messageId));
        }
        $messager->setDelivery($delivery);
        $messager->setStatus($status);
        if ($errorMessage) {
            $messager->setErrorMessage($errorMessage);
        }
        return $messager->save();
    }


    /**
     * retrievePK
     *
     * @param int $pk primary key
     *
     * @return mixed
     *
     * @issue 2714
     */
    public static function retrievePK($pk) {
        $criteria = new Criteria();
        $criteria->add(PushMessagesPeer::ID, $pk);
        return PushMessagesPeer::doSelectOne($criteria);
    }

    /**
     * message dequeue
     *
     * @param int $accountId deposit members id
     *
     * @return void
     *
     * @issue 2714
     */
    public static function pushMessageDequeue($accountId = 0) {
        //message dequeue
        $messages = PushMessagesPeer::messageDequeue($accountId);
        if (empty($messages)) {
            throw new Exception("There is no message to push.");
        }
        //send message
        foreach ($messages as $message) {
            try {
                if (!DepositMembersTokenPeer::retrieveByAccountId($message->getDepositMembersId())) {
                    // throw new Exception('There is no member token.');
                    continue;
                }
                switch (PushDevicesPeer::retrieveByPK(DepositMembersTokenPeer::retrieveByAccountId($message->getDepositMembersId())->getPushDevicesId())->getDeviceModel()) {
                    case PushDevicesPeer::DEVICE_MODEL_IOS:
                        $result = util::pushApnsMessage(
                            $message->getId(), 
                            PushDevicesPeer::retrieveByPK(DepositMembersTokenPeer::retrieveByAccountId($message->getDepositMembersId())->getPushDevicesId())->getDeviceToken(),
                            $message->getMessage(), 
                            PushDevicesPeer::retrieveByPK(DepositMembersTokenPeer::retrieveByAccountId($message->getDepositMembersId())->getPushDevicesId())->getDevelopment(),
                            1, 
                            'default', 
                            array('acme1'=> $message->getDepositFinancialProductsId())
                        );
                        
                        if (is_null($result->getStatus()) && is_null($result->getFeedback())) {
                            PushMessagesPeer::setPushedMessageFeedback($message->getId(), time(), PushMessagesPeer::STATUS_DELIVERED);
                        }
                        if ($result->getStatus()) {
                            PushMessagesPeer::setPushedMessageFeedback($message->getId(), time(), PushMessagesPeer::STATUS_FAILED, $result->getStatus());
                            throw new PushException(sprintf(util::getMultiMessage('bacase %s'), $result->getStatus()));
                        }
                        if ($result->getFeedback()) {
                            PushDevicesPeer::setUnRegisterDevice(PushDevicesPeer::retrieveByPK(DepositMembersTokenPeer::retrieveByAccountId($message->getDepositMembersId())->getPushDevicesId())->getDeviceToken());
                            throw new PushException(sprintf('Push feedback: %s', $result->getFeedback()));
                        }
                        break;
                }
            } catch (Exception $e) {
                throw $e;
            }
        }
    }


}
