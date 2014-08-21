<?php

/**
 * Subclass for representing a row from the 'deposit_personal_products' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositPersonalProducts extends BaseDepositPersonalProducts
{

    /**
     * Re-write setBuyDate
     *
     * @param mixed $date date string
     *
     * @return void
     * 
     * @issue 2579
     */
    public function setBuyDate($date) {
        if (is_numeric($date)) {
            $date = intval($date);
        } else {
            $date = strtotime($date);
            if ($date == false) {
                throw new Exception(util::getMultiMessage('Invalid date.'));
            }
        }
        parent::setBuyDate($date);
    }

    /**
     * Re-write setExpiryDate
     *
     * @param mixed $date date string
     *
     * @return void
     * 
     * @issue 2579
     */
    public function setExpiryDate($date) {
        if (is_numeric($date)) {
            $date = intval($date);
        } else {
            $date = strtotime($date);
            if ($date == false) {
                throw new Exception(util::getMultiMessage('Invalid date.'));
            }
        }
        parent::setExpiryDate($date);
    }


    /**
     * Re-wirte getAmount
     *
     * @return string
     *
     * @issue 2678
     */
    public function getAmount() {
        return parent::getAmount() ? parent::getAmount() : '-';
    }


    /**
     * Re-write getExpectedRate action
     *
     * @return void
     * 
     * @issue 2580
     */
    public function getExpectedRate() {
        $expactedRate = parent::getExpectedRate();
        if (strpos($expactedRate, '.')) {
            return sprintf("%.4f", $expactedRate);
        }
        return $expactedRate;
    }
    
    /**
     * Get format expacted rate
     *
     * @return string
     *
     * @issue 2673
     */
    public function getFormatExpactedRate() {
        return number_format($this->getExpectedRate(), 1, '.', 0) . DepositFinancialProductsPeer::PERCENT;
    }

}

