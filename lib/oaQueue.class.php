<?php

/**
 * Sms OaQueue
 * @author brave.cheng
 */
class oaQueue {

    //max tasks
    public $limit = 500;
    public static $smsReturnMessage = array(
        '-1' => '没有找到基本账号',
        '-2' => '没有手机号码或手机号码序列格式不规范',
        '-3' => '现时基本账号处于休眠状态,暂时不能发送信息',
        '-4' => '对不起，移动公司规定晚上9点后禁止批量发送，若有特殊需要，必须提前申请。',
        '-5' => '基本账号已被限制',
        '-6' => '贵宾账号被限制',
        '-7' => '没有找到贵宾账号',
        '-8' => '剩余条数,余额不足提醒',
        '-9' => '服务器传输故障',
        '-101' => '发送字符数超过450字',
    );
    
    public static $isNeedRepeatSendMessageStats = array(
        '-1',
        '-2',
        '-3',
        '-4',
        '-5',
        '-8',
        '-9',
        '-101'
    );
    protected $sms = null;
    protected $queues = array();
    protected $isLoaded = false;

    public function __construct(SmsText $sms = null) {
        $this->sms = $sms;
    }

    /**
     * load queue data
     * @issue 2334
     * @author brave
     */
    protected function reload() {
        $criteria = new Criteria();
        $criteria->setLimit($this->limit);
        $this->queues = SmsQueuePeer::doSelect($criteria);
        $this->isLoaded = true;
    }

    /**
     * load queue data and send message
     * @issue 2334
     * @author brave
     */
    public function processingQueue() {
        if ($this->isLoaded === false || empty($this->queues)) {
            $this->reload();
        }
        foreach ($this->queues as $queue) {
            $res = $this->sendSmsMessage($queue->getReceiver(), $queue->getMessageContent());
            if ($res[0] == 'ok' || !in_array($res[1], self::$isNeedRepeatSendMessageStats)) {
                //dequeue
                $queue->delete();
            } else {
                try {
                    $queue->setAdditionalInformation(self::$smsReturnMessage[$res[1]]);
                    $queue->setSendTimes($queue->getSendTimes() + 1);
                    $queue->setLastSendAt(date("Y-m-d H:i:s"));
                    $queue->save();
                    self::sendMailtoSysmtemAdministrator($queue, $res[1]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
    
    /**
     * send mail to system administrator
     * @param SmsQueue $smsQueue
     * @param string $res
     * @issue 2334
     * @author brave
     */
    public static function sendMailtoSysmtemAdministrator(SmsQueue $smsQueue, $res) {
        $smsQueue->getSendTimes();
        $subjects = '系统向 ' . $smsQueue->getReceiver() . ' 发送短信失败，失败的原因是：' . self::$smsReturnMessage[$res] . (!in_array($res, self::$isNeedRepeatSendMessageStats) ? ',已经删除该短信内容.' : '');
        $title = '短信发送失败';
        $notification = NotificationPeer::retrieveByPK($smsQueue->getNotificationId());
        $notificationId = util::addNotification(0, $title, $subjects);
        if ($notificationId) {
            util::addNotificationRelation($notificationId, $notification->getSfGuardUserId());
        }
    }

    /**
     * Send a text message to one or more individuals
     * @param mixed $receiver 
     * @param string $message
     * @return int send status
     * @issue 2334
     * @author brave
     */
    public function sendSmsMessage($receiver, $message) {
        $receiver = is_array($receiver) ? implode(',', $receiver) : $receiver;
        return $this->sms->send($receiver, $message);
    }

    /**
     * sms enqueue
     * @param mixed $receiver
     * @param string $messageContent
     * @param int $notificationId
     * @issue 2334
     * @author brave
     */
    public function enqueue($receiver, $messageContent, $notificationId = 0) {
        $unique = md5($receiver . $messageContent . $notificationId);
        $receiver = is_array($receiver) ? implode(',', $receiver) : $receiver;
        if (is_null($this->checkSmsEnqueue($unique))) {
            $queueItem = new SmsQueue();
            $queueItem->setReceiver($receiver);
            $queueItem->setUniqueKey($unique);
            $queueItem->setMessageContent($messageContent);
            if ($notificationId) {
                $queueItem->setNotificationId($notificationId);
            }
            $queueItem->save();
        };
    }

    /**
     * check if sms is enqueued
     * @param string $unique
     * @return minxed
     * @issue 2334
     * @author brave
     */
    private function checkSmsEnqueue($unique) {
        $criteria = new Criteria();
        $criteria->add(SmsQueuePeer::UNIQUE_KEY, $unique);
        return SmsQueuePeer::doSelectOne($criteria);
    }

}
