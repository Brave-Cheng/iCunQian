<?php

/**
 * Subclass for representing a row from the 'deposit_financial_products' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositFinancialProducts extends BaseDepositFinancialProducts
{

    /**
     * Get bank name
     *
     * @return bank name
     *
     * @issue 2614
     */
    public function getRealBankName() {
        $bank = DepositBankPeer::retrieveByPK($this->getBankId());
        if ($bank) {
            return $bank->getName();                
        } else {
            return;
        }
    }
}
