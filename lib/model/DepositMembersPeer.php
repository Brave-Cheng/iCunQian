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

    const NULL_STRING               = '-';


    /**
     * Get all of third party platforms
     *
     * @return array
     *
     * @issue 2626
     */
    public static function getThirdPartyPlatforms() {
        return array(
            DepositMembersPeer::THIRD_PARTY_QQ            => DepositMembersPeer::THIRD_PARTY_QQ,
            DepositMembersPeer::THIRD_PARTY_TENCERT_WEIBO => DepositMembersPeer::THIRD_PARTY_TENCERT_WEIBO,
            DepositMembersPeer::THIRD_PARTY_WEIBO         => DepositMembersPeer::THIRD_PARTY_WEIBO,
            DepositMembersPeer::THIRD_PARTY_WEIXIN        => DepositMembersPeer::THIRD_PARTY_WEIXIN,
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
            DepositMembersPeer::AVATAR_PNG    => DepositMembersPeer::AVATAR_PNG,
            DepositMembersPeer::AVATAR_JPG    => DepositMembersPeer::AVATAR_JPG
        );
    }

    /**
     * Mobile registration
     *
     * @param int    $mobile   mobile number
     * @param string $password password string
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function mobileRegistration($mobile, $password = '') {
        $member = DepositMembersPeer::verfiyAccount($mobile, true);
        if ($member) {
            if ($member->getPassword() && $member->getMobileActive() == DepositMembersPeer::YES) {
                throw new ObjectsException(ObjectsException::$error2001, sprintf(util::getMultiMessage('Mobile %s is registered.'), $mobile));
            }
            if (!$member->getPassword() && $member->getMobileActive() == DepositMembersPeer::NO) {
                $verficationCode = util::getSeed();
                $message = sprintf(util::getMultiMessage('SMS Message%s'), $verficationCode); 
                DepositMembersPeer::sendRegisterMobile($mobile, $message, $verficationCode);
                return $member;
            }
            if (!$password) {
                throw new ParametersException(ParametersException::$error1000, 'password');
            } else {
                $md5 = md5($password);
                $member->setPassword($md5);
                $member->setHash(sha1($md5));
                $member->setMobileActive(DepositMembersPeer::YES);
                $member->save();
                return $member;
            }
        } else {
            $member = new DepositMembers();
            $member->setMobile($mobile);
            $member->setRegistrationTime(time());
            $member->save();
            $verficationCode = util::getSeed();
            $message = sprintf(util::getMultiMessage('SMS Message%s'), $verficationCode); 
            DepositMembersPeer::sendRegisterMobile($mobile, $message, $verficationCode); 
            return $member;
        }
    }

    /**
     * Email registration
     *
     * @param int    $email    email
     * @param string $password password string
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function emailRegistration($email, $password) {
        $member = DepositMembersPeer::verfiyAccount($email, true);
        if ($member) {
            if ($member->getPassword() && $member->getEmailActive() == DepositMembersPeer::YES) {
                throw new ObjectsException(ObjectsException::$error2001, sprintf(util::getMultiMessage('Email %s is registered.'), $email));
            }
            if ($member->getEmailActive() == DepositMembersPeer::NO) {
                throw new ObjectsException(ObjectsException::$error2001, sprintf(util::getMultiMessage('Email %s is registered, but not validate.'), $email));
            }
        } else {
            $member = new DepositMembers();
            $member->setEmail($email);
            $member->setRegistrationTime(time());
            $md5 = md5($password); 
            $member->setPassword($md5);
            $member->setHash(sha1($md5));
            $member->save();
            DepositMembersPeer::sendRegisterMail($email, $member->getId());
        }
        return $member;
    }


    /**
     * Third-platform register
     *
     * @param string $type    third-platform type
     * @param string $account third-platform account
     *
     * @return object DepositMembers
     *
     * @issue 2646
     */
    public static function thirdRegister($type, $account) {
        $criteria = new Criteria();
        $criteria->add(DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT, $account);
        $criteria->add(DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE, $type);
        $member = DepositMembersPeer::doSelectOne($criteria);
        if ($member) {
            return $member;
        } else {
            $member = new DepositMembers();
            $member->setAccount('icunqian_'. util::getSeed());
            $member->setThirdPartyPlatformType($type);
            $member->setThirdPartyPlatformAccount($account);
            $member->setRegistrationTime(time());
            $member->save();

            return $member;
        }
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
            throw new ObjectsException(
                ObjectsException::$error2002,
                sprintf(
                    util::getMultiMessage('Fetch mail template (%s) error.'),
                    $mailTemplate
                )
            );
        }
        $validateUrl = DepositMembersPeer::generateConfirmMailLink($mailer, $pk);
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
        $id = util::authCode($id, 'ENCODE', DepositMembersPeer::BASE64);
        $url = util::getDomain();
        $url .= "/ereg/register/confirm/?email=" . urlencode($email);
        $url .= "&unique_id=" . $id;
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
        $member = DepositMembersPeer::retrieveByPk($pk);
        if (!$member) {
            throw new ObjectsException(ObjectsException::$error2000, $pk);            
        }
        if ($member->getEmail() != $email) {
            throw new ObjectsException(
                ObjectsException::$error2001,
                sprintf(
                    util::getMultiMessage('Email(%s) is not matched.'),
                    $email
                )
            );
        }

        if ($member->getEmailActive() == 'yes') {
            throw new ObjectsException(
                ObjectsException::$error2001,
                sprintf(
                    util::getMultiMessage('Email(%s) is validated.'),
                    $member->getEmail()
                )
            );
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
        sfContext::getInstance()->getUser()->setAttribute('timestp', 0);
        sfContext::getInstance()->getUser()->setAttribute('seed', 0);
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
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function smsConfirm($mobile) {
        $criteria = new criteria();
        $criteria->add(DepositMembersPeer::MOBILE, $mobile);
        $account = DepositMembersPeer::doSelectOne($criteria);
        try {
            if ($account->getMobileActive() == DepositMembersPeer::YES) {
                throw new ObjectsException(
                        ObjectsException::$error2001,
                        sprintf(
                            util::getMultiMessage('Mobile %s is validated.'),
                            $account->getMobile()
                        )
                    );
            }
            if ($account->getEmailActive() == DepositMembersPeer::YES) {
                throw new ObjectsException(
                    ObjectsException::$error2001,
                    sprintf(
                        util::getMultiMessage('Email(%s) is validated.'),
                        $account->getEmail()
                    )
                );
            }
            $account->setMobileActive(DepositMembersPeer::YES);
            $account->save();
            return $account;
        } catch (Exception $e) {
            throw $e;
        }
    }   

    /**
     * Binding third-party account
     *
     * @param int    $pk      primary key
     * @param string $type    third-party platform type, see DepositMembersPeer::getThirdPartyPlatforms()
     * @param string $account account
     * @param string $hash    verified hash
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function thirdPartyBinding($pk, $type, $account, $hash) {
        $member = DepositMembersPeer::verfiyMember($pk);
        DepositMembersPeer::verifyHash($member, $hash);
        if ($member->getThirdPartyPlatformAccount()) {
            throw new ObjectsException(
                ObjectsException::$error2001, 
                sprintf(
                    util::getMultiMessage('The account is binded %s.'),
                    $member->getThirdPartyPlatformAccount()
                )
            );
        }
        
        $member->setThirdPartyPlatformType($type);
        $member->setThirdPartyPlatformAccount($account);
        $member->save();
        return $member;
    }

    /**
     * Check if the pk is valid
     *
     * @param int    $pk   primary key
     * @param string $hash hash string
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function verfiyMember($pk, $hash = '') {
        $member = DepositMembersPeer::retrieveByPk($pk);
        if (!$member) {
            throw new ObjectsException(ObjectsException::$error2000, $pk);            
        }
        if ($member->getEmailActive() == DepositMembersPeer::NO
            && $member->getMobileActive() == DepositMembersPeer::NO) {
            throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The account is not active.'));
        }
        if ($hash) {
            DepositMembersPeer::verifyHash($member, $hash);
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
        $member = DepositMembersPeer::verfiyAccount($account);
        if (md5($password) != $member->getPassword()) {
            throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The account password is wrong.'));
        }
        if ($member->getEmailActive() == DepositMembersPeer::NO 
            && $member->getMobileActive() == DepositMembersPeer::NO) {
            throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The account is not active.'));
        }
        $member->setLastLogin(date('Y-m-d H:i:s'));
        $member->setHash(sha1($member->getPassword()));
        $member->setIsLogin(DepositMembersPeer::YES);
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
        $member = DepositMembersPeer::verfiyMember($pk);
       
        $member->setIsLogin(DepositMembersPeer::NO);
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
     * @param string $hash      hash string
     * 
     * @return object Criteria
     *
     * @issue  number
     */
    public static function alterAvatar($pk, $avatarKey, $hash) {
        $member = DepositMembersPeer::verfiyMember($pk);
        DepositMembersPeer::verifyHash($member, $hash);
        if ($member->getAvatar()) {
            @unlink(DepositMembersPeer::customAvatarDirectory() . DIRECTORY_SEPARATOR . $member->getAvatar());    
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
        $criteria = DepositMembersPeer::accountFilter($account);
        $member = DepositMembersPeer::doSelectOne($criteria);

        if (!$member && !$verify) {
            throw new ObjectsException(ObjectsException::$error2000, $account);
        }
        return $member;
    }

    /**
     * Get account information
     *
     * @param mixed $pk primary key or object DepositMembers
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function getAccountInfo($pk) {
        if (is_object($pk)) {
            $member = $pk;
        } else {
            $member = DepositMembersPeer::verfiyMember($pk);    
        }
        return array(
            'account_id'                        => $member->getId(),
            'account'                           => $member->getAccount(),
            'nickname'                          => $member->getNickname(),
            'mobile'                            => $member->getMobile(),
            'email'                             => $member->getEmail(),
            'avatar'                            => DepositMembersPeer::getHttpAvatar($member),
            'mobile_active'                     => $member->getMobileActive(),
            'email_active'                      => $member->getEmailActive(),
            'third_party_platform_type'         => $member->getThirdPartyPlatformType(),
            'third_party_platform_account'      => $member->getThirdPartyPlatformAccount(),
            'registration_time'                 => $member->getRegistrationTime(),
            'is_login'                          => $member->getIsLogin(),
            'last_login'                        => $member->getLastLogin(),
            'hash'                              => $member->getHash()
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
        $member = DepositMembersPeer::verfiyMember($pk);
        if (!$member->getMobile()) {
            throw new ObjectsException(
                ObjectsException::$error2001,
                sprintf(
                    util::getMultiMessage('Mobile %s is not register.'),
                    $member->getMobile()
                )
            );
        }
        $seed = util::getSeed();
        $message = sprintf(util::getMultiMessage('Forgot and find password%s'), $seed);
        sfContext::getInstance()->getUser()->getAttributeHolder()->clear();
        sfContext::getInstance()->getUser()->setAttribute('passwordReset', 1);
        DepositMembersPeer::sendRegisterMobile(
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
        $member = DepositMembersPeer::verfiyMember($pk);
        if (!$member->getEmail()) {
            throw new ObjectsException(
                ObjectsException::$error2000,
                sprintf(
                    util::getMultiMessage('Email(%s) is not exist.'),
                    $member->getEmail()
                )
            );
        }
        $password = '123456';
        $member->setPassword(md5($password));
        $member->save();
        DepositMembersPeer::sendForgotPasswordEmail($member->getEmail(), $password);
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
     * @param string $hash     hash string
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function updateAccount($pk, $account, $password, $nickname, $email, $mobile, $hash) {
        $member = DepositMembersPeer::verfiyMember($pk);
        DepositMembersPeer::verifyHash($member, $hash);
        if ($account) {
            $member->setAccount($account);
        }
        if ($password) {
            $md = md5($password);
            $member->setPassword($md);
            $member->setHash(sha1($md));
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
     * Update password
     *
     * @param int    $pk       primary key
     * @param string $password password string
     *
     * @return object DepositMembers
     *
     * @issue 2626
     */
    public static function updatePassword($pk, $password) {
        $member = DepositMembersPeer::retrieveByPk($pk);
        if (!$member) {
            throw new ObjectsException(ObjectsException::$error2000);            
        }
        $md = md5($password);
        $member->setPassword($md);
        $member->setHash(sha1($md));
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
            throw new ObjectsException(
                ObjectsException::$error2002,
                sprintf(
                    util::getMultiMessage('Fetch mail template (%s) error.'),
                    $mailTemplate
                )
            );
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
     * @param boolean $http return http avatar
     * @param string  $name custom directory name
     * 
     * @return string
     *
     * @issue 2626
     */
    public static function customAvatarDirectory($http = false, $name = 'avatar') {
        if ($http) {
            return util::getDomain() . '/uploads/' . $name . '/' ;
        } else {
            return sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . $name;    
        }
        
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
        $member = DepositMembersPeer::verfiyMember($pk);
        switch ($type) {
            case 'email':
                if ($member->getEmailActive() == DepositMembersPeer::YES) {
                    throw new ObjectsException(
                        ObjectsException::$error2001,
                        sprintf(
                            util::getMultiMessage('Email(%s) is validated.'),
                            $member->getEmail()
                        )
                    );
                }
                DepositMembersPeer::sendRegisterMail($member->getEmail(), $pk);
                break;
            case 'mobile':
                if ($member->getMobileActive() == DepositMembersPeer::YES) {
                    throw new ObjectsException(
                        ObjectsException::$error2001,
                        sprintf(
                            util::getMultiMessage('Mobile %s is validated.'),
                            $member->getMobile()
                        )
                    );
                }
                $verficationCode = util::getSeed();
                $message = sprintf(util::getMultiMessage('SMS Message%s'), $verficationCode); 
                DepositMembersPeer::sendRegisterMobile($member->getMobile(), $message, $verficationCode);
                break;
            default:
                throw new ParametersException(ParametersException::$error1000);
                break;
        }
        return $member;
    }

    /**
     * Verify hash is valid
     *
     * @param object $account account
     * @param string $sha1    sha1 
     *
     * @return boolean
     *
     * @issue 2646
     */
    public static function verifyHash($account, $sha1) {
        if (sha1($account->getPassword()) != $sha1) {
            throw new ObjectsException(ObjectsException::$error2005, util::getMultiMessage('Your password has been modified.'));
        }
    }

    /**
     * Get avatar url
     *
     * @param object $member DepositMembers
     *
     * @return string
     *
     * @issue 2646
     */
    public static function getHttpAvatar($member) {
        return DepositMembersPeer::customAvatarDirectory(true) . $member->getAvatar();
    }



}
