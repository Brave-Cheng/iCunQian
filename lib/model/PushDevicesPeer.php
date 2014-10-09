<?php

/**
 * Subclass for performing query and update operations on the 'push_devices' table.
 *
 * 
 *
 * @package lib\model
 */ 
class PushDevicesPeer extends BasePushDevicesPeer
{
    const STATUS_ACTIVE                 = 'active';
    const STATUS_UNREGISTERED           = 'unregistered';

    const DEVELOPMENT_SANDBOX           = 'sandbox';
    const DEVELOPMENT_PRODUCTION        = 'production';

    const DEVICE_MODEL_IOS              = 'ios';
    const DEVICE_MODEL_ANDRIOD          = 'andriod';

    const SUBSCRIBE_ID                  = 'subscribe_id';
    const AFFECTED                      = 'affected';

    const EXPECTED_YIELD_1              = 1;
    const EXPECTED_YIELD_2              = 2;
    const EXPECTED_YIELD_3              = 3;
    const EXPECTED_YIELD_4              = 4;

    const FINANCIAL_CYCLE_1             = 1;
    const FINANCIAL_CYCLE_2             = 2;
    const FINANCIAL_CYCLE_3             = 3;
    const FINANCIAL_CYCLE_4             = 4;
    const FINANCIAL_CYCLE_5             = 5;

    /**
     * Get expected yield list
     *
     * @return array
     *
     * @issue 2626
     */
    public static function getExpectedYields() {
        return array(
            self::EXPECTED_YIELD_1  => array(0, 3),
            self::EXPECTED_YIELD_2  => array(3, 5),
            self::EXPECTED_YIELD_3  => array(5, 10),
            self::EXPECTED_YIELD_4  => array(10, ''),   
        );
    }

    /**
     * Get financial cycel list
     *
     * @return array
     *
     * @issue 2626
     */
    public static function getFinancialCycles() {
        return array(
            self::FINANCIAL_CYCLE_1  => array('', 1),
            self::FINANCIAL_CYCLE_2  => array(1, 3),
            self::FINANCIAL_CYCLE_3  => array(3, 6),
            self::FINANCIAL_CYCLE_4  => array(6, 12),
            self::FINANCIAL_CYCLE_5  => array(12, ''),
        );
    }


    /**
     * Register the device and Subscribed
     *
     * @param string $appName       app name
     * @param string $deviceToken   device token
     * @param string $deviceModel   device model
     * @param string $deviceName    device name
     * @param string $appVersion    app version
     * @param string $deviceUid     device uid
     * @param string $deviceVersion device version
     * @param string $development   development
     * @param int    $pk            push_device pramary key
     * @param object $con           propel connection
     *
     * @return object PushDevices
     *
     * @issue 2599
     */
    public static function subscribeDevice($appName, $deviceToken, $deviceModel, $deviceName, $appVersion = null, $deviceUid = null, $deviceVersion = null, $development = null, $pk = null, $con = null) {
        try {

            if ($pk) {
                $subscribeDevice = PushDevicesPeer::retrieveByPk($pk);
            } else {
                $subscribeDevice = new PushDevices();
            }

            $subscribeDevice->setAppName($appName);
            $subscribeDevice->setDeviceToken($deviceToken);
            $subscribeDevice->setDeviceModel($deviceModel);
            $subscribeDevice->setDeviceName($deviceName);
            if ($appVersion) {
                $subscribeDevice->setAppVersion($appVersion);
            }
            if ($deviceUid) {
                $subscribeDevice->setDeviceUid($deviceUid);
            }
            if ($deviceVersion) {
                $subscribeDevice->setDeviceVersion($deviceVersion);
            }
            if ($city) {
                $subscribeDevice->setCity($city);
            }
            if ($development) {
                $subscribeDevice->setDevelopment($development);
            }
            $subscribeDevice->setStatus(PushDevicesPeer::STATUS_ACTIVE);
            $subscribeDevice->save();
            return $subscribeDevice;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Set un-register device by token
     * 
     * @param string $token token string
     *
     * @issue 2599, 2660
     * 
     * @return affeced rows
     */
    public static function setUnRegisterDeviceByToken($token) {
        $criteria = new Criteria();
        $criteria->add(self::DEVICE_TOKEN, $token);
        $tokenExist = self::doSelectOne($criteria);
        if (is_null($tokenExist)) {
            throw new ObjectsException(ObjectsException::$error2000, sprintf(util::getMultiMessage('%s is not subscribed.'), $token));
        }
        if ($device->getStatus() == self::STATUS_UNREGISTERED) {
            throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The device is unsubscribe.'));
        }
        $tokenExist->setStatus(self::STATUS_UNREGISTERED);
        $tokenExist->save();
        return $tokenExist;
    }


    /**
     * Set register device by token
     * 
     * @param string $token token string
     *
     * @issue 2599, 2660
     * 
     * @return affeced rows
     */
    public static function setRegisterDeviceByToken($token) {
        $criteria = new Criteria();
        $criteria->add(self::DEVICE_TOKEN, $token);
        $tokenExist = self::doSelectOne($criteria);
        if (is_null($tokenExist)) {
            throw new ObjectsException(ObjectsException::$error2000, sprintf(util::getMultiMessage('%s is not subscribed.'), $token));
        }
        if ($device->getStatus() == self::STATUS_ACTIVE) {
            throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The device is subscribe.'));
        }
        $tokenExist->setStatus(self::STATUS_ACTIVE);
        $tokenExist->save();
        return $tokenExist;
    }

    /**
     * Set un-register device by id
     *
     * @param int $pk primary key
     *
     * @return object pushDevices
     * 
     * @issue 2660
     * 
     */
    public static function setUnRegisterDeviceById($pk) {
        $device = self::checkDevice($pk);
        if ($device->getStatus() == self::STATUS_UNREGISTERED) {
            throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The device is unsubscribe.'));
        }
        $device->setStatus(self::STATUS_UNREGISTERED);
        $device->save();
        return $device;
    }


    /**
     * Set un-register device by id
     *
     * @param int $pk primary key
     *
     * @return object pushDevices
     * 
     * @issue 2660
     */
    public static function setRegisterDeviceById($pk) {
        $device = self::checkDevice($pk);
        if ($device->getStatus() == self::STATUS_ACTIVE) {
            throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The device is subscribe.'));
        }
        $device->setStatus(self::STATUS_ACTIVE);
        $device->save();
        return $device;
    }

    /**
     * Change the development 
     *
     * @param string $development development name
     *
     * @return affeced rows
     *
     * @issue  2599
     */
    public static function changeDevelopment($development) {
        $device = new PushDevices();
        $device->setDevelopment($development);
        return $device->save();
    }

    /**
     * Gets the device model list
     *
     * @return array model list
     *
     * @issue 2599
     */
    public static function getDeviceModels() {
        return array(
            self::DEVICE_MODEL_ANDRIOD  => self::DEVICE_MODEL_ANDRIOD,
            self::DEVICE_MODEL_IOS      => self::DEVICE_MODEL_IOS,
        );
    }

    /**
     * Fetch device of condition
     *
     * @param string $city           city name
     * @param string $bank           bank name
     * @param string $profitType     profit type
     * @param float  $expectedYield  expected rate
     * @param int    $financialCycle financial cycle
     *
     * @return mixed
     *
     * @issue 2599
     */
    // public static function getfilterDevices($city, $bank, $profitType, $expectedYield, $financialCycle) {
    //     $sql1 = $sql2 = $sql3 = $sql4 = $sql5 = $sqlOr = '';
    //     $sql = sprintf('SELECT %s FROM %s WHERE 1', implode(',', PushDevicesPeer::getFieldNames(BasePeer::TYPE_COLNAME)),PushDevicesPeer::TABLE_NAME
    //     );
    //     $sql .= sprintf(" AND %s = '%s'", PushDevicesPeer::STATUS, PushDevicesPeer::STATUS_ACTIVE);
    //     if ($city) {
    //         $sql1 =  PushDevicesPeer::CITY . " LIKE '%{$city}%' "; 
    //         $sqlOr .= ' OR '. $sql1;
    //     }
    //     if ($bank) {
    //         $sql2 = sprintf(" %s = %s", PushDevicesPeer::BANK, $bank);
    //         $sqlOr .= ' OR '. $sql2;
    //     }
    //     if ($profitType) {
    //         $sql3 = sprintf(" %s = '%s'", PushDevicesPeer::PROFIT_TYPE, $profitType);
    //         $sqlOr .= ' OR '. $sql3;
    //     }
    //     if ($expectedYield) {
    //         if ($expectedYield) {
    //             $scope = PushDevicesPeer::getExpectedYields();
    //             foreach ($scope as $key => $vars) {
    //                 if ($vars[1] == '' && $expectedYield >= $vars[0]) {
    //                     $expectedYield = $key; continue;
    //                 }
    //                 if($expectedYield >= $vars[0] && $expectedYield < $vars[1]) {
    //                     $expectedYield = $key; continue;
    //                 }
    //             }
    //         }
    //         $sql4 = sprintf(" %s = %s", PushDevicesPeer::EXPECTED_YIELD, $expectedYield);
    //         $sqlOr .= ' OR '. $sql4;
    //     }
    //     if ($financialCycle) {
    //         $financialCycle = self::translateFinancialCycle($financialCycle);
    //         $sql5 = sprintf(" %s = %s", PushDevicesPeer::FINANCIAL_CYCLE, $financialCycle);
    //         $sqlOr .= ' OR '. $sql5;
    //     }        
    //     $sql .= sprintf(" AND ( %s ) ", ltrim($sqlOr, 'OR '));
    //     $con = Propel::getConnection();
    //     $statement = $con->prepareStatement($sql);
    //     $resultsets = $statement->executeQuery(array(), ResultSet::FETCHMODE_NUM);
    //     return PushDevicesPeer::populateObjects($resultsets);
    // }

    /**
     * Translate financial cycle 
     *
     * @param float $financialCycle financial cycle string
     *
     * @return float
     *
     * @issue 2599
     */
    public static function translateFinancialCycle($financialCycle) {
        $scope = self::getFinancialCycles();
        foreach ($scope as $key => $vars) {
            if ($vars[1] == '' && $financialCycle >= $vars[0]) {
                $financialCycle = $key; continue;
            }
            if ($vars[0] == '' && $financialCycle < $vars[1]) {
                $financialCycle = $key; continue;
            }
            if($financialCycle >= $vars[0] && $financialCycle < $vars[1]) {
                $financialCycle = $key; continue;
            }
        }
        return $financialCycle;
    }

    /**
     * Get device by appname and device token
     *
     * @param string $appName     appname
     * @param string $deviceToken token
     *
     * @return object pushdevices
     *
     * @issue 2599
     */
    public static function getDeviceByForigenKey($appName, $deviceToken) {
        $criteria = new Criteria();
        $criteria->add(PushDevicesPeer::APP_NAME, $appName);
        $criteria->add(PushDevicesPeer::DEVICE_TOKEN, $deviceToken);
        return PushDevicesPeer::doSelectOne($criteria);
    }


    /**
     * Check device is exist
     *
     * @param int $pk primary key
     *
     * @return object pushdevices
     *
     * @issue 2660
     */
    public static function checkDevice($pk) {
        $device = PushDevicesPeer::retrieveByPk($pk);
        if (!$device) {
            throw new ObjectsException(ObjectsException::$error2000, sprintf(util::getMultiMessage('%s is not subscribed.'), $pk));
        }
        return $device;
    }

    /**
     * Create select options list 
     *
     * @param array $list list array
     *
     * @return array
     *
     * @issue 2678
     */
    public static function createSelectOptions($list) {
        $expactedRateShow = array();
        foreach ($list as $key => $expactedRate) {
            $expactedRateShow[$key] = $expactedRate[0] . ' ~ ' . $expactedRate[1];
        }
        array_unshift($expactedRateShow, util::getMultiMessage('--Select--'));
        return $expactedRateShow;
    }
}
