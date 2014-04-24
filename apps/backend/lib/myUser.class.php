<?php

class myUser extends sfGuardSecurityUser
{
    public  function  getUserId()
    {
        $user = $this->getGuardUser();
        if($user){
            return $user->getId();
        }
        
    }

    /**
     * getReadingHistoryNotificationId - Get readinghistory table notificationId
     * @return array - notificationId array
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2332 - System Notifications
     */
    public function getReadingHistoryNotificationId(){
        $readingHistorys = $this->getGuardUser()->getReadingHistorys();
        $readingHistoryNofificationId = array();
        foreach( $readingHistorys as $readingHistory ){
            $readingHistoryNofificationId[] = $readingHistory->getNotificationId();
        }
        return $readingHistoryNofificationId;
    }

    public function moduleAccess($module, $action){
        $profile = $this->getGuardUser()->getProfile();
        return $profile->moduleAccess($module, $action);
    }
}
