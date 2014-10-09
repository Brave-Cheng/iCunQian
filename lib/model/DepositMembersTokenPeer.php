<?php

/**
 * Subclass for performing query and update operations on the 'deposit_members_token' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembersTokenPeer extends BaseDepositMembersTokenPeer
{

    /**
     * Register user apns token
     *
     * @param int    $accountId     deposit members id
     * @param string $appName       app name
     * @param string $deviceToken   device token
     * @param string $deviceModel   device model
     * @param string $deviceName    device name
     * @param string $appVersion    app version
     * @param string $deviceUid     device uid
     * @param string $deviceVersion device version
     * @param string $development   development
     *
     * @return object DepositMembersToken
     * 
     * @issue 2715
     */
    public static function registerMemberToken($accountId, $appName, $deviceToken, $deviceModel, $deviceName, $appVersion = null, $deviceUid = null, $deviceVersion = null, $development = null) {
        try {
            $memberToken = DepositMembersTokenPeer::retrieveByAccountId($accountId);

            if ($memberToken) {
                $device = PushDevicesPeer::subscribeDevice($appName, $deviceToken, $deviceModel, $deviceName, $appVersion, $deviceUid, $deviceVersion, $development, $memberToken->getPushDevicesId());
            } else {

                $device = PushDevicesPeer::subscribeDevice($appName, $deviceToken, $deviceModel, $deviceName, $appVersion, $deviceUid, $deviceVersion, $development);

                $memberToken = new DepositMembersToken();
            }
            $memberToken->setDepositMembersId($accountId);
            $memberToken->setPushDevicesId($device->getId());
            $memberToken->setIsValid(DepositMembersPeer::YES);
            $memberToken->save();
            return $memberToken;

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Retrieve by account id
     *
     * @param int $accountId deposit members id
     *
     * @return mixed
     *
     * @issue 2715
     */
    public static function retrieveByAccountId($accountId) {
        $criteria = new Criteria();
        $criteria->add(DepositMembersTokenPeer::DEPOSIT_MEMBERS_ID, $accountId);
        return DepositMembersTokenPeer::doSelectOne($criteria);
    }

    /**
     * Update member token
     *
     * @param int    $accountId deposit members id
     * @param string $token     token string
     *
     * @return object DepositMembersToken
     *
     * @issue 2715
     */
    public static function updateMemberToken($accountId, $token) {
        $memberToken = DepositMembersTokenPeer::retrieveByAccountId($accountId);
        if ($memberToken) {
            $device = PushDevicesPeer::retrieveByPk($memberToken->getPushDevicesId());
            if ($device) {
                $device->setDeviceToken($token);
                $device->save();  
            }
        }
        return $memberToken;
    }
}
