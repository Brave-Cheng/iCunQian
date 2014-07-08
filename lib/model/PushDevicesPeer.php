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

    /**
     * Register the device and Subscribed
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
     * @param int    $pk             push_device pramary key
     * @param object $con            propel connection
     *
     * @return subscribe id                
     *
     * @issue  2599
     */
    public static function subscribeDevice($appName, $deviceToken, $deviceModel, $deviceName, $profitType, $expectedYield, $financialCycle, $appVersion = null, $deviceUid = null, $deviceVersion = null, $city = null, $bank = null, $pk = null, $con = null) {
        try {
            if (empty($pk)) {
                $attributes = DepositAttributesPeer::getValidAttributesByType('profit_type');
                if (!in_array($profitType, $attributes)) {
                    throw new Exception(sprintf("%s not exist.", $profitType));
                }
                $device = new PushDevices();
            } else {
                $device = PushDevicesPeer::retrieveByPk($pk);
                if (!$device) {
                    throw new Exception(sprintf('%s is not subscribed.', $pk));
                }
            }
            return $device->registerDevice($appName, $deviceToken, $deviceModel, $deviceName, $profitType, $expectedYield, $financialCycle, $appVersion, $deviceUid, $deviceVersion, $city, $bank, $con);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Set un-register device
     * 
     * @param string $token token string
     *
     * @issue 2599
     * @return affeced rows
     */
    public static function setUnRegisterDevice($token) {
        $criteria = new Criteria();
        $criteria->add(self::DEVICE_TOKEN, $token);
        $tokenExist = self::doSelectOne($criteria);
        if (is_null($tokenExist)) {
            throw new Exception(sprintf('%s is not exist.', $token));
        }
        $tokenExist->setStatus(self::STATUS_UNREGISTERED);
        return $tokenExist->save();
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
    public static function fetchFilterDevice($city, $bank, $profitType, $expectedYield, $financialCycle) {
        $criteria = new Criteria();
        if ($city) {
            $c = $criteria->getNewCriterion(PushDevicesPeer::CITY, $city, Criteria::LIKE);    
        }
        if ($bank) {
            $c2 = $criteria->getNewCriterion(PushDevicesPeer::BANK, $bank);    
        }
        if ($profitType) {
            $c3 = $criteria->getNewCriterion(PushDevicesPeer::PROFIT_TYPE, $profitType);
        }
        if ($expectedYield) {
            $c4 = $criteria->getNewCriterion(PushDevicesPeer::EXPECTED_YIELD, $expectedYield);
        }
        if ($financialCycle) {
            $c5 = $criteria->getNewCriterion(PushDevicesPeer::FINANCIAL_CYCLE, $financialCycle);
        }
        $c->addOr($c2);
        $c->addOr($c3);
        $c->addOr($c4);
        $c->addOr($c5);
        $criteria->add($c);
        return PushDevicesPeer::doSelect($criteria);

    }


}
