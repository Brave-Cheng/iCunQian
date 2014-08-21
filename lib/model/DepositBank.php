<?php

/**
 * Subclass for representing a row from the 'deposit_bank' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositBank extends BaseDepositBank
{

    /**
     * Get logo
     *
     * @return string
     *
     * @issue 2673
     */
    public function getLogo() {
        
        if (parent::getLogo()) {
            return util::getDomain() . '/' . strtr(parent::getLogo(), '\\', '/');    
        }
        return;
    }
    
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

    /**
     * Re-write getShortName
     *
     * @return string
     *
     * @issue 2580
     */
    public function getShortName() {
        return parent::getShortName() ? parent::getShortName() : '-';
    }

    /**
     * Re-write getPhone
     *
     * @return string
     *
     * @issue 2580
     */
    public function getPhone() {
        return parent::getPhone() ? parent::getPhone() : '-';
    }
}
