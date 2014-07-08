<?php

/**
 * Api Config
 *
 * 
 * @author brave <brave.cheng@expacta.com.cn>
 */
class apiConfig
{
    const TOKEN_EXPIRED_TIME = 3600;

    public $users = array(
        'expacta' => array(
            'api_key' => '7b50ab2c9f0063a8e849252fc54579b92657f149',
            'allowed_ips' => array('127.0.0.1', '221.237.157.62', '118.122.85.168'),
        )
    );

    /**
     * token expired time
     * 
     * @return int
     */
    public function getTokenExpiredTime(){
        return self::TOKEN_EXPIRED_TIME;
    }

    /**
     * request user 
     * 
     * @return array
     */
    public function getUsers(){
        return $this->users;
    }

    /**
     * validate user by code
     * 
     * @param string $code code
     * 
     * @return array
     */
    public function getUserInfoByCode($code){
        $userInfo = array();
        if(empty($code)) return $userInfo;

        $users = $this->getUsers();
        if(isset($users[$code])){
            $userInfo = $users[$code];
        }
        return $userInfo;
    }
}