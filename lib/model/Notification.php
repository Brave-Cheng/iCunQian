<?php

/**
 * Subclass for representing a row from the 'notification' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Notification extends BaseNotification
{
    const SESTEM_MAIL_NAME = '系统邮件';
    const SESTEM_MAIL_ID = 0;
    public function getReadingHistoryByNotification(){
        $getReadingHistorys = Notification::getReadingHistorys();
        foreach ($getReadingHistorys as $getReadingHistory){
            return $getReadingHistory;
        }
    }
    /**
     * insertNotificationRecivers -- insert notification recivers
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public function insertNotificationRecivers($member){
        try{
            $notificationReceiver = new NotificationReciver();
            $notificationReceiver->setNotificationId($this->getId());
            $notificationReceiver->setsfGuardUserId(isset($member['user_id']) ? $member['user_id'] : 0);
            $notificationReceiver->save();  
        }catch(Execption $e){
            throw $e;
        }
    }
}