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
    public function executePassword(){
        $this->setLayout("layoutShadowbox");
    }

    public function executeForgotPassword(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $username   = $this->getRequestParameter( 'username' );
            $email      = $this->getRequestParameter( 'email' );
            $telephone  = $this->getRequestParameter( 'telephone' );
            if(empty($username) && empty($email) && empty($telephone)){
                $this->forward404();
            }else{
                $criteria = new Criteria();
                $criteria->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID, Criteria::LEFT_JOIN);
                $criteria->add(sfGuardUserPeer::USERNAME, $username);
                $criteria->add(sfGuardUserProfilePeer::EMAIL, $email);
                $criteria->add(sfGuardUserProfilePeer::TELEPHONE, $telephone);
                $criteria->addDescendingOrderByColumn(sfGuardUserPeer::ID);
                $user = sfGuardUserPeer::doSelectOne($criteria);
                if($user == null) $this->forward404();
                $newPassword = util::generateRandomKey(8);
                
                /*@var $mailer PHPMailer*/
                $mailer = util::initPhpMailer();
                $mailer->Subject = util::getI18nMessage( '四川高路交通信息工程有限公司OA系统 新密码' );
                $mailer->AddAddress($user->getProfile()->getEmail(), $user->getProfile()->getLastName() . $user->getProfile()->getFirstName() );
                $this->getRequest()->setParameter( 'forgotPasswordUser', $user );
                $this->getRequest()->setParameter( 'forgotPasswordNewPassword', $newPassword);
                $mailer->MsgHTML(util::getContentFromController( 'renderEmail', 'forgotPassword' ) );
                if($mailer->Send()){
                    $newPassword = md5( $newPassword );
                    $user->setPassword( $newPassword );
                    $user->save();
                    $this->flag = 'successfully';
                }else{
                    $this->forward404();
                    $this->flag = 'failed';
                }

            }
            $this->setLayout( 'layoutShadowbox' );
        }
        $this->setTemplate( 'password' );
    }

    public function handleErrorForgotPassword(){
        return $this->forward(sfConfig::get( 'sf_login_module' ), 'password');
    }

    public function validateForgotPassword(){
        $username   = $this->getRequestParameter( 'username' );
        $email      = $this->getRequestParameter( 'email' );
        $telephone  = $this->getRequestParameter( 'telephone' );
        if(!empty($username) && !empty($email) && !empty($telephone)){
            $criteria = new Criteria();
            $criteria->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID, Criteria::LEFT_JOIN);
            $criteria->add(sfGuardUserPeer::IS_ACTIVE, 1);
            $criteria->add(sfGuardUserPeer::USERNAME, $username);
            $criteria->add(sfGuardUserProfilePeer::EMAIL, $email);
            $criteria->add(sfGuardUserProfilePeer::TELEPHONE, $telephone);
            if(!sfGuardUserPeer::doCount($criteria, false)){
                $this->getRequest()->setError( 'usernameEmailTelephone', util::getI18nMessage('输入的用户名、邮箱或者手机号不匹配'));
                return false;
            }
        }
        return true;
    }

    public function executeSignout()
    {
        $this->getUser()->signOut();
        $signout_url = sfConfig::get('app_sf_guard_plugin_success_signout_url', $this->getRequest()->getReferer());
        session_destroy();
        $this->redirect( '@homepage' );
    }
}
