<?php

/**
 * @package api/lib 
 */

/**
 * Api user
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class myUser extends sfBasicSecurityUser
{
    /**
     * set user login information
     * 
     * @param object $loginInformation ApiLoginInformation
     * 
     * @return null
     *
     * @issue 2763
     */
    public function setLoginInformation(ApiLoginInformation $loginInformation){
        $this->setAttribute('loginInformation', $loginInformation);
    }
    
    /**
     * get user login information
     * 
     * @return mixed
     *
     * @issue 2763
     */
    public function getLoginInformation(){
        return $this->getAttribute('loginInformation');
    }

    /**
     * get user code
     * 
     * @return string
     *
     * @issue 2763
     */
    public function getCode(){
        return $this->getLoginInformation()->getCode();
    }
}
