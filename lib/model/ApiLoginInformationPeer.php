<?php

/**
 * Subclass for performing query and update operations on the 'api_login_information' table.
 *
 * 
 *
 * @package lib\model
 */ 
class ApiLoginInformationPeer extends BaseApiLoginInformationPeer
{
    /**
     * retrieveByToken retrieve login information by token
     * 
     * @param string $token token name
     * 
     * @return ApiLoginInformation
     *
     * @issue 2763
     */
    public static function retrieveByToken($token){
        $criteria = new Criteria();
        $criteria->add(BaseApiLoginInformationPeer::TOKEN, $token);
        return BaseApiLoginInformationPeer::doSelectOne($criteria);
    }
}
