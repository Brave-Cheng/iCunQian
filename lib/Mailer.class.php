<?php

/**
 *  Depoist Mailer
 *
 * @author brave <brave.cheng@expacta.com.cn>
 * @package lib
 */
class Mailer
{
    private static $_mailSender = 'mantis@expacta.com.cn';

    /**
     * class initialization
     * 
     * @return object PHPMailer
     */
    public static function initialize() {
        $mailer = new PHPMailer();
        $mailer->IsSMTP();
        $mailer->SMTPAuth = true;
        $mailer->Host = 'mail.expacta.com.cn';
        $mailer->Username = 'mantis@expacta.com.cn';
        $mailer->Password = 'init123';
        $mailer->ContentType = 'text/html';
        $mailer->CharSet = 'UTF-8';
        $mailer->Encoding = 'quoted-printable';
        $mailer->Sender = self::_getMailSender();
        $mailer->SetFrom('support@expacta.com.cn', 'System Admin');
        $mailer->AddReplyTo('support@expacta.com.cn', 'System Admin');
        return $mailer;
    }
    
    /**
     * set sender
     * 
     * @param mixed $sender sender
     * 
     * @return null
     */
    public static function setMailSender($sender) {
        self::$_mailSender = $sender;
    }
    
    /**
     * get sender
     * 
     * @return mixed
     */
    private static function _getMailSender() {
        return self::$_mailSender;
    }
    
}
 
