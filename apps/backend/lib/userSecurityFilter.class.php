<?php

/**
 * @package apps\backend\lib
 */

class userSecurityFilter extends sfGuardBasicSecurityFilter
{
    /**
     * has permission
     * 
     * @param string $module module name
     * @param string $action action name
     * @param object $user   sfGuardUser
     * 
     * @return boolean
     *
     * @issue 2763
     */
    public function hasAccess($module, $action, sfGuardUser $user = null) {
        is_null($user) && $user = sfContext::getInstance()->getUser();
        if (in_array($module, array(sfConfig::get('sf_login_module'))))
            return true;
        if (is_null($user->getGuardUser()))
            return false;
        if (in_array($module, array('default')))
            return true;

        if ($user->isSuperAdmin())
            return true;
        return false;
    }

    /**
     * execute 
     * 
     * @param object $filterChain sfFilterChain
     * 
     * @return mixed
     * 
     * @throws sfStopException
     *
     * @issue 2763
     */
    public function execute($filterChain) {
        if ($this->isFirstCall()) {
            $controller = $this->getContext()->getController();
            $request = $this->getContext()->getRequest();
            $module = $this->getContext()->getModuleName();
            $action = $this->getContext()->getActionName();
            if (!$this->hasAccess($module, $action)) {
                $controller->forward('sfGuardAuth', 'signin');
                throw new sfStopException();
                return;
            }
        }
        // Execute next filter
        if (sfContext::getInstance()->getUser()->getGuardUser() && sfContext::getInstance()->getUser()->getGuardUser()->getIsActive() == 0) {
            sfContext::getInstance()->getUser()->signOut();
            $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', sfContext::getInstance()->getRequest()->getReferer());
            session_destroy();
            sfContext::getInstance()->getController()->redirect($signoutUrl);
        }
        $filterChain->execute();
    }

}

?>