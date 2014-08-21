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

}
