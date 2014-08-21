<?php

/**
 * Subclass for representing a row from the 'push_devices' table.
 *
 * 
 *
 * @package lib\model
 */ 
class PushDevices extends BasePushDevices
{

    /**
     * Re-write save function 
     *
     * @param string $appName        app name
     * @param string $deviceToken    device token
     * @param string $deviceModel    device model
     * @param string $deviceName     device name
     * @param string $profitType     profit type
     * @param string $expectedYield  expected yield
     * @param string $financialCycle financial cycle
     * @param string $appVersion     app version
     * @param string $deviceUid      device uid
     * @param string $deviceVersion  device version
     * @param string $city           city
     * @param string $bank           bank
     * @param string $development    development
     * @param object $con            propel connection
     *
     * @return subscribe id
     *
     * @issue 2599
     */
    public function registerDevice($appName, $deviceToken, $deviceModel, $deviceName, $profitType, $expectedYield, $financialCycle, $appVersion = null, $deviceUid = null, $deviceVersion = null, $city = null, $bank = null, $development = null, $con = null) {
        try {
            $this->setAppName($appName);
            $this->setDeviceToken($deviceToken);
            $this->setDeviceModel($deviceModel);
            $this->setDeviceName($deviceName);
            $this->setProfitType($profitType);
            $this->setExpectedYield($expectedYield);
            $this->setFinancialCycle($financialCycle);
            if ($appVersion) {
                $this->setAppVersion($appVersion);
            }
            if ($deviceUid) {
                $this->setDeviceUid($deviceUid);
            }
            if ($deviceVersion) {
                $this->setDeviceVersion($deviceVersion);
            }
            if ($city) {
                $this->setCity($city);
            }
            if ($bank) {
                $this->setBank($bank);
            }
            if ($development) {
                $this->setDevelopment($development);
            }
            $this->setStatus(PushDevicesPeer::STATUS_ACTIVE);
            $affected = parent::save();

            return $this;

        } catch (Exception $e) {
            throw $e;
        }
    }

    


}
