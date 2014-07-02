<?php
class SmsProcessor extends VarienObject {
    public function process(SmsReceived $smsText , $con) {
        $content = $smsText->getMessageContent();
        $sender  = $smsText->getSender();

        if(strtolower(trim($content)) == "bm") {
            $phone = $sender;
            try {
                $user = new User();
                $user->setUsername($phone);
                $password = util::randomPassword();
                $user->setPassword(md5($password));
                $user->save($con);
                $content = "succeed, username is your phone number and password is : " . $password;
            } catch (Exception $ex) {
                $content = "faild, you phone number have been registered";
            }
            $smsQueue = new SmsQueue();
            $smsQueue->setReceiver($phone);
            $smsQueue->setMessageContent($content);
            $smsQueue->save($con);
        }
        $smsText->setHandleHit($smsText->getHandleHit()+1);
        $smsText->save($con);
    }
}