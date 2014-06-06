<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 7633 2008-02-27 17:54:50Z fabien $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{

    public function executeFrm(){
        sfConfig::set('sf_web_debug', false);
        $this->setLayout("layoutNull");
    }

    public function executeLogout(){
        $this->getUser()->setAuthenticated(false);
        $this->getUser()->setAttribute("user", null);
        return $this->redirect("sfGuardAuth/signin");
    }

    public function executeForgotPassword(){
        $this->send = false;
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $email = $this->getRequestParameter("email");
            $criteria = new Criteria();
            $criteria->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
            $criteria->add(sfGuardUserProfilePeer::EMAIL, $this->getRequestParameter('email'));
            $user = sfGuardUserPeer::doSelectOne($criteria);/*@var $user User */
            if($user != null){
                $newPassword = util::randomPassword(8);
                $user->setPassword($newPassword);
                $user->save();
                
                $mailer = util::initPhpMailer(); /* @var $mailer PHPMailer */
                $mailer->Subject = 'New Password For Expacta Manager System';
                $mailer->AddAddress($user->getProfile()->getEmail(), $user->getProfile()->getEnglishName());
                $content = <<<SOB
Hi,{$user->getProfile()->getEnglishName()},<br />
<br />
Your new password is: {$newPassword}, Please use the password to <a href="http://{$_SERVER['SERVER_NAME']}/index.php/auth/login">login</a>.<br />
<br />
System Admin<br />
mantis@expacta.com.cn
SOB;
                    $mailer->MsgHTML($content);
                    if (!$mailer->Send()) {
                        echo $mailer->ErrorInfo;
                    }
                    $this->send = true;
//                    $this->redirect("auth/forgotPassword");
            }else{
                $this->getRequest()->setError("forgotPassword", util::getMultiMessage("The entered email address do not exist in the system."));
            }
        }
    }
}
