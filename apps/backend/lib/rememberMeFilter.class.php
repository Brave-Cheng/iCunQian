<?php

/**
 * @package apps\backend\lib
 */

class rememberMeFilter extends sfFilter
{
    
    /**
     * execute description
     * 
     * @param object $filterChain sfFilterChain
     * 
     * @return mixed 
     * 
     * @issue 2763
     */
    public function execute ($filterChain) {
        // execute this filter only once, and if the user is not already logged in, and has a cookie set
        if ($this->isFirstCall() && !$this->getContext()->getUser()->isAuthenticated()
         && $this->getContext()->getRequest()->getCookie(sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember')))
        {
             // See if a user exists with this cookie in the remember database
            $c = new Criteria();
            $c->add(sfGuardRememberKeyPeer::REMEMBER_KEY, $this->getContext()->getRequest()->getCookie(sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember')));
            $c->add(sfGuardRememberKeyPeer::IP_ADDRESS, $this->getContext()->getRequest()->getHttpHeader ('addr','remote'));

            if ($resultArray = sfGuardRememberKeyPeer::doSelectJoinsfGuardUser($c)) {
                $resultRow = current($resultArray);
                $this->getContext()->getUser()->signIn($resultRow->getSfGuardUser());
            }
        }
        // execute next filter
        $filterChain->execute();
    }

}