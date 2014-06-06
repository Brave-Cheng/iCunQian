<?php

/**
 * api user
 * 
 * @package api/lib
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
     */
    public function setLoginInformation(ApiLoginInformation $loginInformation){
        $this->setAttribute('loginInformation', $loginInformation);
    }
    
    /**
     * get user login information
     * 
     * @return mixed
     */
    public function getLoginInformation(){
        return $this->getAttribute('loginInformation');
    }

    /**
     * get user code
     * 
     * @return string
     */
    public function getCode(){
        return $this->getLoginInformation()->getCode();
    }
}
