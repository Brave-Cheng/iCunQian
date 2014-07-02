<?php

/**
 * mail actions.
 *
 * @package    Expacta Management
 * @subpackage mail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class renderEmailActions extends sfActions
{
    public function executeForgotPassword(){
        $user = sfContext::getInstance()->getUser();
        $this->user = $user->getAttribute("forgotPasswordUser");
        $this->newPassword = $user->getAttribute("forgotPasswordNewPassword");
        $this->setLayout("layoutShadowbox");
    }
}
