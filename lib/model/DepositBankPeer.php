<?php

/**
 * Subclass for performing query and update operations on the 'deposit_bank' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DepositBankPeer extends BaseDepositBankPeer
{
    
    static public function getBankByBankname($bankname) {
        if (empty($bankname)) {
            return false;
        }
        $criteria = new Criteria();
        $criteria->add(DepositBankPeer::NAME, $bankname);
        $bank = DepositBankPeer::doSelectOne($criteria);
        if ($bank) {
            return $bank;
        }  else {
            return self::saveBank($bankname);
        }
    }
    
    static public function saveBank($bankname) {
        $bank = new DepositBank();
        $bank->setName($bankname);
        $bank->save();
        return $bank;
    }
}
