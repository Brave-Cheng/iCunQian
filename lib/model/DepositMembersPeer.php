<?php

/**
 * Subclass for performing query and update operations on the 'deposit_members' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembersPeer extends BaseDepositMembersPeer
{
    const ACCOUNT_ID                = 'account_id';
    const BASE64                    = 'base64';
    const YES                       = 'yes';
    const NO                        = 'no';

    const THIRD_PARTY_QQ            = 'qq';
    const THIRD_PARTY_TENCERT_WEIBO = 'tencert_weibo';
    const THIRD_PARTY_WEIBO         = 'weibo';
    const THIRD_PARTY_WEIXIN        = 'weixin';

    const AVATAR_JPG                = 'image/jpeg';
    const AVATAR_PNG                = 'image/png';


    /**
     * Get all of third party platforms
     *
     * @return array
     *
     * @issue 2626
     */
    public static function getThirdPartyPlatforms() {
        return array(
            self::THIRD_PARTY_QQ            => self::THIRD_PARTY_QQ,
            self::THIRD_PARTY_TENCERT_WEIBO => self::THIRD_PARTY_TENCERT_WEIBO,
            self::THIRD_PARTY_WEIBO         => self::THIRD_PARTY_WEIBO,
            self::THIRD_PARTY_WEIXIN        => self::THIRD_PARTY_WEIXIN,
        );
    }

    /**
     * Set support avatar type
     *
     * @return array
     *
     * @issue void
     */
    public static function getSupportAvatarTypes() {
        return array(
            self::AVATAR_PNG    => self::AVATAR_PNG,
            self::AVATAR_JPG    => self::AVATAR_JPG
        );
    }
    /**
     * Member registration 
     *
     * @param string $account  account
     * @param int    $mobile   mobile
     * @param string $email    email
     * @param string $password password
     * @param int    $pk       primary key
     *
     * @return array
     *
     * @issue 2626
     */
    public static function registration($account, $mobile, $email, $password, $pk) {
        if ($pk) {
            $member = self::verfiyMember($pk);
            if ($mobile != $member->getMobile()) {
                throw new Exception(sprintf("The mobile %s is not exist.", $mobile));
            }
            if ($email != $member->getEmail()) {
                throw new Exception(sprintf("The email %s is not exist.", $email));
            }
        } else {

            if ($mobile && self::verfiyAccount($mobile, true)) {
                throw new Exception(sprintf(util::getMultiMessage('Mobile %s is registered'), $mobile));
            }   
            if ($email && self::verfiyAccount($email, true)) {
                throw new Exception(sprintf(util::getMultiMessage('Email %s is registered'), $email));
            }

            $member = new DepositMembers();
            $member->setRegistrationTime(date('Y-m-d H:i:s'));
        }
        if ($account) {
            $member->setAccount($account);
        }
        if ($mobile) {
            $member ->setMobile($mobile);
        }
        if ($email) {
            $member->setEmail($email);
        }
        if ($password) {
            $member->setPassword(md5($password));
        }
        $affected = $member->save();
        if ($affected) {
            if ($email) {
                self::sendRegisterMail($email, $member->getId());    
            }
            if ($mobile) {
                $verficationCode = util::getSeed();
                $message = sprintf(util::getMultiMessage('SMS Message%s'), $verficationCode); 
                self::sendRegisterMobile($mobile, $message, $verficationCode); 
            }
        }
        return array(self::ACCOUNT_ID => $member->getId(), PushDevicesPeer::AFFECTED => $affected);
    }

    /**
     * Send register mail 
     *
     * @param string $mailer mail to 
     * @param string $pk     primary key
     *
     * @return null
     * 
     * @issue 2626
     */
    public static function sendRegisterMail($mailer, $pk) {
        $mailTemplate = sfConfig::get('sf_upload_dir') . '/iCunQian-Registration.html';
        $body = file_get_contents($mailTemplate);
        if (empty($body)) {
            throw new Exception(sprintf("Fetch mail template (%s) error.", $mailTemplate));
        }
        $validateUrl = self::generateConfirmMailLink($mailer, $pk);
        $body = str_replace('{validate_url}', $validateUrl, $body);
        $body = str_replace('{email}', $mailer, $body);
        $body = str_replace('{datetime}', date('Y-m-d'), $body);
        //send mail
        $mail = Mailer::initialize();
        $mail->Subject = util::getMultiMessage('Mail Subject');
        if (is_array($mailer)) {
            foreach ($mailer as $sender) {
                $mail->AddAddress($sender);
            }
        } else {
            $mail->AddAddress($mailer);
        }
        $mail->MsgHTML($body);
        $mail->send();
    }

    /**
     * Make confirm mail links
     *
     * @param string $email email
     * @param int    $id    primary key
     *
     * @return string
     *
     * @issue 2626
     */
    public static function generateConfirmMailLink($email, $id) {
        $timestp = time();
        $id = util::authCode($id, 'ENCODE', self::BASE64);
        $url = util::getDomain();
        $url .= "/ereg/register/confirm/?email=" . urlencode($email);
        $url .= "&unique_id=" . urlencode(base64_encode($id));
        $url .= "&tsp=" . $timestp;
        return $url;
    }

    /**
     * Confirm email validate
     *
     * @param string $email email account
     * @param int    $pk    primary key       
     *
     * @return boolean
     *
     * @issue 2626
     */
    public static function emailConfirm($email, $pk) {
        $member = self::verfiyMember($pk);
        if ($member->getEmail() != $email) {
            throw new Exception(sprintf(util::getMultiMessage('Email(%s) is not match'), $email));
        }

        if ($member->getEmailActive() == 'yes') {
            throw new Exception(sprintf(util::getMultiMessage('Email(%s) validated'), $email));
        }

        $member->setEmailActive('yes');
        return $member->save();
    }



    /**
     * Send register mobile 
     *
     * @param int    $mobile          mobile  
     * @param string $message         message  
     * @param int    $verficationCode seed
     *
     * @return null
     *
     * @issue 2626
     */
    public static function sendRegisterMobile($mobile, $message, $verficationCode) {
        $receivers = is_array($mobile) ? $mobile : array($mobile);

        sfContext::getInstance()->getUser()->setAttribute('seed', $verficationCode);
        sfContext::getInstance()->getUser()->setAttribute('timestp', time());

        $notification = DepositNotificationPeer::smsEnqueue(implode(',', $receivers), $message);
        try {
            $mmijSms = new MmljSMS();
            $sendStatus = $mmijSms->send($receivers, $message);
            if ($sendStatus) {
                $notification->setNotificationStatus(DepositNotificationPeer::NOTIFICATION_DELIVERED);
                $notification->setDeliveredTime(date('Y-m-d H:i:s'));
                $notification->save();
            }
        } catch (Exception $e) {
            $notification->setErrorMessage($e->getMessage());
            $notification->save();
            throw $e;
        }
    }

    /**
     * Sms confirm
     *
     * @param int $mobile mobile number
     *
     * @return void
     *
     * @issue 2626
     */
    public static function smsConfirm($mobile) {
        $criteria = new criteria();
        $criteria->add(DepositMembersPeer::MOBILE, $mobile);
        $account = DepositMembersPeer::doSelectOne($criteria);
        try {
            if (!$account) {
                throw new Exception(sprintf(util::getMultiMessage('Mobile %s is not register'), $mobile));
            }
            if ($account->getMobileActive() == self::YES) {
                throw new Exception(sprintf(util::getMultiMessage('Mobile %s is verficated'), $mobile));
                
            }
            $account->setMobileActive(self::YES);
            $account->save();
            return array('account_id' => $account->getId());
        } catch (Exception $e) {
            throw $e;
        }
    }   

    /**
     * Binding third-party account
     *
     * @param int    $pk      primary key
     * @param string $type    third-party platform type, see self::getThirdPartyPlatforms()
     * @param string $account account
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function thirdPartyBinding($pk, $type, $account) {
        $member = self::verfiyMember($pk);
        if ($member->getThirdPartyPlatformAccount()) {
            throw new Exception(sprintf(util::getMultiMessage('The account is binded %s'), $member->getThirdPartyPlatformAccount()));
        }
        $member->setThirdPartyPlatformType($type);
        $member->setThirdPartyPlatformAccount($account);
        $member->save();
        return $member;
    }

    /**
     * Check if the pk is valid
     *
     * @param int $pk primary key
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function verfiyMember($pk) {
        $member = DepositMembersPeer::retrieveByPk($pk);
        if (!$member) {
            throw new Exception(util::getMultiMessage('The account not exist'));
        }
        return $member;
    }

    /**
     * Account login
     *
     * @param string $account  email or mobile or account
     * @param string $password password
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function accountLogin($account, $password) {
        $member = self::verfiyAccount($account);
        if ($member->getIsLogin() == self::YES) {
            throw new Exception(util::getMultiMessage('The account is login'));
        }
        if (md5($password) != $member->getPassword()) {
            throw new Exception(util::getMultiMessage('The account password is wrong'));
        }
        if ($member->getEmailActive() == self::NO && $member->getMobileActive() == self::NO) {
            throw new Exception(util::getMultiMessage('The account is not avtive'));
        }

        $member->setIsLogin(self::YES);
        $member->setLastLogin(date('Y-m-d H:i:s'));
        $member->save();

        return $member;

    }

    /**
     * Account logout
     *
     * @param string $pk primary key
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function accountLogout($pk) {
        $member = self::verfiyMember($pk);
        if ($member->getIsLogin() == self::NO) {
            throw new Exception(util::getMultiMessage('The account is logout'));
        }
        $member->setIsLogin(self::NO);
        $member->save();

        return $member;

    }

    /**
     * Make account filter condition
     *
     * @param string $account email or mobile or account
     *
     * @return object Criteria
     * 
     * @issue 2626
     */
    public static function accountFilter($account) {
        $criteria = new Criteria();
        $baseAccount = $criteria->getNewCriterion(DepositMembersPeer::ACCOUNT, $account);
        $nickname = $criteria->getNewCriterion(DepositMembersPeer::NICKNAME, $account);
        $email = $criteria->getNewCriterion(DepositMembersPeer::EMAIL, $account);
        $mobile = $criteria->getNewCriterion(DepositMembersPeer::MOBILE, $account);

        $baseAccount->addOr($nickname);
        $email->addOr($mobile);
        $baseAccount->addOr($email);
        $criteria->add($baseAccount);
        return $criteria;
    }

    /**
     * Alter avatar
     *
     * @param int    $pk        primary key
     * @param string $avatarKey avatar file key
     *
     * @return object Criteria
     *
     * @issue  number
     */
    public static function alterAvatar($pk, $avatarKey) {
        if (!$avatarKey) {
            throw new Exception('No avatar upload.');
        }
        $member = self::verfiyMember($pk);
        if ($member->getAvatar()) {
            @unlink(self::customAvatarDirectory() . DIRECTORY_SEPARATOR . $member->getAvatar());    
        }
        
        $member->setAvatar($avatarKey);
        $member->save();
        return $member;
    }

    /**
     * Check account if is valid
     *
     * @param string  $account account
     * @param boolean $verify  boolean
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function verfiyAccount($account, $verify = false) {
        $criteria = self::accountFilter($account);
        $member = DepositMembersPeer::doSelectOne($criteria);

        if (!$member && !$verify) {
            throw new Exception(util::getMultiMessage('The account not exist'));
        }
        return $member;
    }

    /**
     * Get account information
     *
     * @param int $pk primary key
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function getAccountInfo($pk) {
        $member = self::verfiyMember($pk);
        return array(
            'account_id'                        =>  $member->getId(),
            'account'                           => $member->getAccount(),
            'nickname'                          => $member->getNickname(),
            'mobile'                            => $member->getMobile(),
            'email'                             => $member->getEmail(),
            'avatar'                            => $member->getAvatar(),
            'mobile_active'                     => $member->getMobileActive(),
            'email_active'                      => $member->getEmailActive(),
            'third_party_platform_type'         => $member->getThirdPartyPlatformType(),
            'third_party_platform_account'      => $member->getThirdPartyPlatformAccount(),
            'registration_time'                 => $member->getRegistrationTime(),
            'is_login'                          => $member->getIsLogin(),
            'last_login'                        =>$member->getLastLogin()
        );
    }

    /**
     * Forgot password and reset it by sms
     *
     * @param int $pk primary key
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function resetPasswordBySms($pk) {
        $member = self::verfiyMember($pk);
        if (!$member->getMobile()) {
            throw new Exception(sprintf(util::getMultiMessage('Mobile %s is not register'), $member->getMobile()));
        }
        $seed = util::getSeed();
        $message = sprintf(util::getMultiMessage('Forgot and find password%s'), $seed);
        self::sendRegisterMobile(
            $member->getMobile(),
            $message,
            $seed
        );
        return $member;
    }


    /**
     * Forgot password and reset it by email
     *
     * @param int $pk primary key
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function resetPasswordByEmail($pk) {
        $member = self::verfiyMember($pk);
        if (!$member->getEmail()) {
            throw new Exception(sprintf(util::getMultiMessage('Email(%s) is not match'), $member->getEmail()));
        }
        $password = '123456';
        $member->setPassword(md5($password));
        $member->save();
        self::sendForgotPasswordEmail($member->getEmail(), $password);
        return $member;
    }

    /**
     * Update account information
     *
     * @param int    $pk       primary key
     * @param string $account  account
     * @param string $password password
     * @param string $nickname nickname
     * @param string $email    email
     * @param int    $mobile   mobile 
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function updateAccount($pk, $account, $password, $nickname, $email, $mobile) {
        $member = self::verfiyMember($pk);
        if ($account) {
            $member->setAccount($account);
        }
        if ($password) {
            $member->setPassword(md5($password));
        }
        if ($nickname) {
            $member->setNickname($nickname);
        }
        if ($email) {
            $member->setEmail($email);
        }
        if ($mobile) {
            $member->setMobile($mobile);
        }
        $member->save();
        return $member;
    }

    /**
     * Send an email which forgot password
     *
     * @param string $mailer   mail to 
     * @param string $password reset password
     *
     * @return void
     * 
     * @issue 2626
     */
    public static function sendForgotPasswordEmail($mailer, $password) {
        $mailTemplate = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'iCunQian-Forgot-Password.html';
        $body = file_get_contents($mailTemplate);
        if (empty($body)) {
            throw new Exception(sprintf("Fetch mail template (%s) error.", $mailTemplate));
        }
        
        $body = str_replace('{email}', $mailer, $body);
        $body = str_replace('{reset_password}', $password, $body);
        $body = str_replace('{datetime}', date('Y-m-d'), $body);

        //send mail
        $mail = Mailer::initialize();
        $mail->Subject = util::getMultiMessage('Reset Password Subject');
        if (is_array($mailer)) {
            foreach ($mailer as $sender) {
                $mail->AddAddress($sender);
            }
        } else {
            $mail->AddAddress($mailer);
        }
        $mail->MsgHTML($body);
        $mail->send();
    }

    /**
     * Get custom avatar directory
     *
     * @param string $name custom directory name
     *
     * @return string
     *
     * @issue 2626
     */
    public static function customAvatarDirectory($name = 'avatar') {
        return sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . $name;
    }

    /**
     * Activation by email or mobile
     *
     * @param int    $pk   primary key
     * @param string $type 'email' or 'mobile'
     *
     * @return object DepositMembers 
     *
     * @issue 2626
     */
    public static function activation($pk, $type) {
        $member = self::verfiyMember($pk);
        switch ($type) {
            case 'email':
                if ($member->getEmailActive() == self::YES) {
                    throw new Exception(sprintf(util::getMultiMessage('Email(%s) validated'), $member->getEmail()));
                }
                self::sendRegisterMail($member->getEmail(), $pk);
                break;
            case 'mobile':
                if ($member->getMobileActive() == self::YES) {
                    throw new Exception(sprintf(util::getMultiMessage('Mobile %s is verficated'), $member->getMobile()));
                }
                $verficationCode = util::getSeed();
                $message = sprintf(util::getMultiMessage('SMS Message%s'), $verficationCode); 
                self::sendRegisterMobile($member->getMobile(), $message, $verficationCode);
                break;
            default:
                throw new Exception("Unsupport type.");
                break;
        }
        return $member;
    }
}
