<?php
/**
 * 
 * @author BaseBackends
 *
 * 
 */
class BaseBackends extends sfActions
{
    public function preExecute(){  
        //system write log             
        UserLogPeer::writeLog();
        $this->urlName = $this->getModuleName().'/index';
        // validate password for telephone 
        $user = $this->getUser();
        $sfUser = $user->getGuardUser();
        if(!$user->getAttribute('oldPassword') && $sfUser){
            $user->setAttribute('oldPassword', $sfUser->getPassword());
        }
        if($sfUser && $sfUser->getPassword() !=  $user->getAttribute('oldPassword')){
            $user->signOut();
            $user->getAttributeHolder()->remove('oldPassword');
            $user->getAttributeHolder()->clear();
            $signout_url = sfConfig::get('app_sf_guard_plugin_success_signout_url', $this->getRequest()->getReferer());          
            $this->redirect('' != $signout_url ? $signout_url : '@homepage');
        }
    }
    
}