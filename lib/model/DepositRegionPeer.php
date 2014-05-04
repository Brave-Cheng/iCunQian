<?php

/**
 * Subclass for performing query and update operations on the 'deposit_region' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DepositRegionPeer extends BaseDepositRegionPeer
{
    static public function getRegionByName($name) {
        if (empty($name)) {
            return false;
        }
        $criteria = new Criteria();
        $criteria->add(DepositRegionPeer::NAME, $name);
        $region = DepositBankPeer::doSelectOne($criteria);
        if ($region) {
            return $region;
        }  else {
            return self::saveRegion($name);
        }
    }
    
    static public function saveRegion($name) {
        $bank = new DepositRegion();
        $bank->setName($name);
        $bank->save();
        return $bank;
    }
}
