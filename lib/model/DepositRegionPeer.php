<?php

/**
 * Subclass for performing query and update operations on the 'deposit_region' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositRegionPeer extends BaseDepositRegionPeer
{
    /**
     * get region by region name
     * 
     * @param string $name region name
     * 
     * @return object
     *
     * @issue 2763
     */
    static public function getRegionByName($name) {
        if (empty($name)) {
            return false;
        }
        $criteria = new Criteria();
        $criteria->add(DepositRegionPeer::NAME, $name);
        $region = DepositRegionPeer::doSelectOne($criteria);
        if ($region) {
            return $region;
        }  else {
            return self::saveRegion($name);
        }
    }
    
    /**
     * save region by region name
     * 
     * @param string $name region name
     * 
     * @return object
     *
     * @issue 2763
     */
    static public function saveRegion($name) {
        $bank = new DepositRegion();
        $bank->setName($name);
        $bank->save();
        return $bank;
    }
}
