<?php

/**
 * Subclass for performing query and update operations on the 'notification' table.
 *
 * 
 *
 * @package lib.model
 */ 
class NotificationPeer extends BaseNotificationPeer
{
    public static function getNotice($tel, $time=false, $num = 20, $page = 1, $offsetId=false){
        try {
            $userId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();       
            $timeStamp = time();
            if(empty($num)) $num = 20;
            if($page>1) $page = 1;
            $c = new Criteria();     
            $offset = ($page -1 ) * $num;            
            if($time){             
                $startTime = date('Y-m-d H:i:s', $time);
                $endTime   = date('Y-m-d H:i:s', $timeStamp);
                $c->add(NotificationReciverPeer::SF_GUARD_USER_ID, $userId);
                $c->addJoin(NotificationReciverPeer::NOTIFICATION_ID, NotificationPeer::ID);
                $c->addJoin(NotificationReciverPeer::NOTIFICATION_ID, NotificationPeer::ID);
                if($offsetId){
                    $c->add(NotificationPeer::ID, $offsetId, Criteria::LESS_THAN);
                }
                $c->add(NotificationPeer::UPDATED_AT, NotificationPeer::UPDATED_AT . ' BETWEEN ' ."'$startTime'" .' AND ' . "'$endTime'", Criteria::CUSTOM);
            }else{            
                $c->add(NotificationReciverPeer::SF_GUARD_USER_ID, $userId);
                $c->addJoin(NotificationReciverPeer::NOTIFICATION_ID, NotificationPeer::ID);
                $c->add(NotificationPeer::UPDATED_AT, $timeStamp , Criteria::LESS_THAN);
                if($offsetId){
                    $c->add(NotificationPeer::ID, $offsetId, Criteria::LESS_THAN);
                }
            }
            $total = ceil(NotificationPeer::doCount($c)/$num);
            $c->setLimit($num);
            $c->setOffset($offset);
            $c->addDescendingOrderByColumn(NotificationPeer::ID);
            $notices = NotificationPeer::doSelect($c);
            
            $noticeList = array();
            foreach ($notices as $notice){
                if($notice->getSfGuardUserId() == 0){
                    $sender = Notification::SESTEM_MAIL_NAME;
                }else{
                    $sender = $notice->getSfGuardUser()->getProfile()->getLastName() . 
                              $notice->getSfGuardUser()->getProfile()->getFirstName();
                }
                $adminEmail = $notice->getSfGuardUserId();
                $adminEmail = $adminEmail == '0' ? '1' : '0';
                $isRead = $notice->getReadingHistoryByNotification() ? 1 : 0;
                $noticeList[] = array(
                        'id' => $notice->getId(),
                        'sender'=>$sender,
                        'adminEmail'=> $adminEmail,
                        'isRead'=>$isRead,
                        'title'=>$notice->getTitle(),
                        'content'=>$notice->getContent(),
                        'sendTime'   =>$notice->getCreatedAt(),     
                        'total'  => $total
                );
            }
            $responseData = array('noticeList'=>$noticeList, 'timeStamp'=>$timeStamp);
            return $responseData;
        }catch(Exception $e){
            throw $e;
        }
    }
    public static function setReading($tel, $id){
        try {
            $userId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $c = new Criteria();
            $c->add(ReadingHistoryPeer::NOTIFICATION_ID, $id);
            $readingHistoryObj = ReadingHistoryPeer::doSelectOne($c);        
            if(!$readingHistoryObj){
                $result  = 1;
                $readingHistory = new ReadingHistory();
                $readingHistory->setSfGuardUserId($userId);
                $readingHistory->setNotificationId($id);
                $readingHistory->save();
                $reponse = util::getMessage(message::MARKED_SUCCESSFULLY);
            }else{
                $result  = 0;
                $reponse = util::getMessage(message::MARKED_FAILED);
            }
            $responseData = array('result'=>$result, 'reponse'=>$reponse);
            return $responseData;
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * insertNotification -- insert notification
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public static function insertNotification($params){
        try{
            $notification = new Notification();
            $notification->setSfGuardUserId(isset($params['userId']) ? $params['userId'] : 0);
            $notification->setTitle(isset($params['title']) ? $params['title'] : null);
            $notification->setContent(isset($params['content']) ? $params['content'] : null);
            $notification->save();
            return $notification;
        }catch(Exception $e){
            throw $e;
        }
    }
    public static function sendNotification($senderId=0, $title=null, $content=null, $receiver){
        try{
            if(!isset($receiver)) return false;
            $notification = new Notification();
            $notification->setSfGuardUserId($senderId);
            $notification->setTitle($title);
            $notification->setContent($content);
            $notification->save();
            $notificationId = $notification->getId();
            $notificationReceiver = new NotificationReciver();
            $notificationReceiver->setNotificationId($notificationId);
            $notificationReceiver->setSfGuardUserId($receiver);
            $notificationReceiver->save();
            return $notificationReceiver;
        }catch(Exception $e){
            throw $e;
        }
    }
    public static function isHadSendTooMany($userId, $title, $subject){
        $startTime = date('Y-m-d') . ' 00:00:00';
        $endTime   = date('Y-m-d') . ' 23:59:59';
        $criteria = new Criteria();
        $criteria->add(NotificationPeer::UNIQUE_KEY, md5($userId.$title.$subject));
        $criteria->add(NotificationPeer::CREATED_AT, NotificationPeer::CREATED_AT . ' BETWEEN ' . "'$startTime'"  .' AND ' . "'$endTime'", Criteria::CUSTOM);
        return NotificationPeer::doSelectOne($criteria) ? '1':'0';
    }
    
    public static function isNotificationBelongToUser($user, $notificationId){
        $status = false;
        $userId = $user->getId();
        $c = new Criteria();
        $c->add(NotificationReciverPeer::NOTIFICATION_ID, $notificationId);
        $c->add(NotificationReciverPeer::SF_GUARD_USER_ID, $userId);
        $notification = NotificationReciverPeer::doSelect($c);
        if($notification){
            $status = true;
        }
        return $status;
    }
}
