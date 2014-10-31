<?php

/**
 * Subclass for performing query and update operations on the 'deposit_notification' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositNotificationPeer extends BaseDepositNotificationPeer
{

    const NOTIFICATION_SMS = 'sms';

    const NOTIFICATION_DELIVERED = 'delivered';

    /**
     * Sms enqueue
     *
     * @param string $account mobile account
     * @param string $content content
     *
     * @return object
     *
     * @issue 2626
     */
    public static function smsEnqueue($account, $content) {
        $notification = new DepositNotification();
        $notification->setNotificationType(self::NOTIFICATION_SMS);
        $notification->setNotificationTypeAccount($account);
        $notification->setContent($content);
        $notification->save();
        return $notification;
    }


    /**
     * Attemp to sms enqueue
     *
     * @param string $account mobile account
     * @param string $content content
     *
     * @return object
     *
     * @issue 2729
     */
    public static function attemptSmsEnqueue($account, $content) {
        //passed 10 minutes?
        $passedMinutes = sfContext::getInstance()->getUser()->getAttribute('timestp');
        $smsDescription = sfContext::getInstance()->getUser()->getAttribute('smsDescription');
        
        $criteria = new Criteria();
        $criteria->add(DepositNotificationPeer::CONTENT, $smsDescription);
        $criteria->add(DepositNotificationPeer::NOTIFICATION_TYPE, self::NOTIFICATION_SMS);
        $criteria->add(DepositNotificationPeer::NOTIFICATION_TYPE_ACCOUNT, $account);
        $notification = DepositNotificationPeer::doSelectOne($criteria);
        if (!$notification) {
            return self::smsEnqueue($account, $content);
        }
        return $notification;
    }

}
