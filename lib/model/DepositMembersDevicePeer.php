<?php

/**
 * Subclass for performing query and update operations on the 'deposit_members_device' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembersDevicePeer extends BaseDepositMembersDevicePeer
{


    /**
     * Validate member device is active
     *
     * @param int $pk primary key
     *
     * @return Object DepositMembersDevice
     *
     * @issue 2662
     */
    public static function validateMemberDevice($pk) {
        $memberDevice = DepositMembersDevicePeer::retrieveByPk($pk);
        if (!$memberDevice) {
            throw new ObjectsException(ObjectsException::$error2000, $pk);
        }
        if ($memberDevice->getIsValid() == DepositMembersPeer::NO) {
            throw new ObjectsException(ObjectsException::$error2004);
        }
        return $memberDevice;
    }

    /**
     * Save member device by account
     *
     * @param int     $accountId account id
     * @param string  $token     token string
     * @param boolean $verify    true is verify
     *
     * @return Object DepositMembersDevice
     *
     * @issue 2662
     */
    public static function getMemberDeviceByAccount($accountId, $token, $verify = true) {
        $criteria = new Criteria();
        $criteria->add(DepositMembersDevicePeer::DEPOSIT_MEMBERS_ID, $accountId);
        $memberDevice = DepositMembersDevicePeer::doSelectOne($criteria);
        if ($verify == false) {
            return $memberDevice;
        }
        if (!$memberDevice) {
            throw new ObjectsException(ObjectsException::$error2000, $accountId);
        }
        
        if ($memberDevice->getIsValid() == DepositMembersPeer::NO) {
            throw new ObjectsException(ObjectsException::$error2004);
        }
        return $memberDevice;
    }

    /**
     * Save member device by account
     *
     * @param int    $accountId account id
     * @param string $token     token string
     *
     * @return Object DepositMembersDevice
     *
     * @issue 2662
     */
    public static function saveMemberDeviceByAccount($accountId, $token) {
        $memberDevice = DepositMembersDevicePeer::getMemberDeviceByAccount($accountId, $token, false);
        if (!$memberDevice) {
            $memberDevice = new DepositMembersDevice(); 
            $memberDevice->setDepositMembersId($accountId);
            $memberDevice->setToken($token);
            $memberDevice->setIsValid(DepositMembersPeer::YES);
            $memberDevice->save();   
        }
        return $memberDevice;
    }
}
