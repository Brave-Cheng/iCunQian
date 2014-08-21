<?php

/**
 * Subclass for representing a row from the 'deposit_bank_alias' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositBankAlias extends BaseDepositBankAlias
{
    /**
     * Re-write save action
     *
     * @param object $con object
     *
     * @return affectedRows
     *
     * @issue 2580
     */
    public function save($con = null) {
        try {
            return parent::save($con);
        } catch (PropelException $e) {
            if (strpos($e->getMessage(), DepositFinancialProductsPeer::DUPLICATE_KEY)  !== false) {
                throw new OtherException(OtherException::$error3000);
            }
            throw $e;
        }
    }
}
