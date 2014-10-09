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
            return '-';
        }
    }

    /**
     * Re-write setDeadline 
     *
     * @param string $deadline date string
     *
     * @return void
     * 
     * @issue 2579
     */
    public function setDeadline($deadline) {
        if (empty($deadline)) {
            $deadline = DepositFinancialProductsPeer::DATE_NULL;
        }
        parent::setDeadline($deadline);
    }

    /**
     * Re-write setProfitStartDate 
     *
     * @param string $profitStartDate date string
     *
     * @return void
     * 
     * @issue 2579
     */
    public function setProfitStartDate($profitStartDate) {
        if (empty($profitStartDate)) {
            $profitStartDate = DepositFinancialProductsPeer::DATE_NULL;
        }
        parent::setProfitStartDate($profitStartDate);
    }

    /**
     * Re-write getDeadline
     *
     * @param string $format date format string
     *
     * @return string
     *
     * @issue 2579
     */
    public function getDeadline($format = 'Y-m-d') {
        $date = parent::getDeadline($format);
        if ($date == DepositFinancialProductsPeer::DATE_NULL) {
            return;
        }
        return $date;
    }

    /**
     * Re-write getProfitStartDate
     *
     * @param string $format date format string
     *
     * @return string
     *
     * @issue 2579
     */
    public function getProfitStartDate($format = 'Y-m-d') {
        $date = parent::getProfitStartDate($format);
        if ($date == DepositFinancialProductsPeer::DATE_NULL) {
            return;
        }
        return $date;
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
     * Re-write setExpectedRate action
     *
     * @param float $v float string
     *
     * @return void
     *
     * @issue 2580
     */
    public function setExpectedRate($v) {
        if ($v) {
            if (strpos($v, '.')) {
                $v = sprintf("%.4f", $v);
            }
            parent::setExpectedRate($v);    

        }
    }

    /**
     * Re-write setActualRate action
     *
     * @param float $v float string
     *
     * @return void
     *
     * @issue 2580
     */
    public function setActualRate($v) {
        if ($v) {
            if (strpos($v, '.')) {
                $v = sprintf("%.4f", $v);
            }
            parent::setActualRate($v);    
        }
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
            return sprintf("%.2f", $expactedRate);
        }
        return $expactedRate;
    }

    /**
     * Re-write getActualRate action
     *
     * @return void
     *
     * @issue 2580
     */
    public function getActualRate() {
        $actualRate = parent::getActualRate();
        if (strpos($actualRate, '.')) {
            return sprintf("%.4f", $actualRate);
        }
        return $actualRate;
    }




    /**
     * Get bank times
     *
     * @return int
     *
     * @issue 2673
     */
    public function getBankTimes() {
        return ceil($this->getExpectedRate() / DepositFinancialProductsPeer::BANK_INTEREST);
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

    /**
     * Get no sigin expected rate
     *
     * @return string
     *
     * @issue 2673
     */
    public function getNoSiginExpectedRate() {
        return number_format($this->getExpectedRate(), 1, '.', 0);
    }

    /**
     * Re-wirte getInvestIncreaseAmount
     *
     * @return string
     *
     * @issue 2579
     */
    public function getInvestIncreaseAmount() {
        return parent::getInvestIncreaseAmount() > 0 ? parent::getInvestIncreaseAmount() : '';
    }

    /**
     * Get format invest start amount
     *
     * @return string
     *
     * @issue 2673
     */
    public function getFormatInvestStartAmount() {
        if ($this->getInvestStartAmount()) {
            // return $this->getInvestStartAmount() / 10000  . DepositFinancialProductsPeer::TEN_THOUSAND_YUAN;    
            return $this->getInvestStartAmount();
        }
        return '-';
    }

    /**
     * Get no sigin format invest start amount
     *
     * @return string
     *
     * @issue 2673
     */
    public function getNoSiginInvestStartAmount() {
        if ($this->getInvestStartAmount()) {
            return $this->getInvestStartAmount() / 10000;    
        }
        return '0';
    }


    /**
     * Re-wirte getInvestStartAmount
     *
     * @return string
     *
     * @issue 2579
     */
    public function getInvestStartAmount() {
        return parent::getInvestStartAmount() > 0 ? parent::getInvestStartAmount() : '';
    }

    /**
     * Get format invest cycle
     *
     * @return string
     *
     * @issue 2673
     */
    public function getFormatInvestCycle() {
        if ($this->getInvestCycle()) {
            return $this->getInvestCycle() . DepositFinancialProductsPeer::MONTH;    
        }
        return '-';
    }

    /**
     * Get no sigin format invest cycle
     *
     * @return string
     *
     * @issue 2673
     */
    public function getNoSiginInvestCycle() {
        if ($this->getInvestCycle()) {
            return $this->getInvestCycle();    
        }
        return 0;
    }

    /**
     * Re-write getInvestCycle
     *
     * @return string
     *
     * @issue 2579
     */
    public function getInvestCycle() {
        return parent::getInvestCycle() != 0 ? parent::getInvestCycle() : '';
    }

    /**
     * Get format status
     *
     * @return string
     *
     * @issue 2673
     */
    public function getFormatStatus() {

        $current = time();
        $saleStartDate = strtotime($this->getSaleStartDate());
        $saleEndDate = strtotime($this->getSaleEndDate());

        if ($saleStartDate < $current) {
            $date = ceil(($current- $saleStartDate) / (24 * 3600));
            return sprintf(DepositFinancialProductsPeer::DAYS_SALE, $date);
        }
        if ($current >= $saleStartDate
         || $current <= $saleEndDate) {
            return DepositFinancialProductsPeer::DAYS_SALING;
        }

        if ($current > $saleEndDate) {
            return DepositFinancialProductsPeer::DAYS_SALED;
        }
    }

    /**
     * Re-write getName
     *
     * @return string
     *
     * @issue 2673
     */
    public function getFormatName() {
        return parent::getName() ? parent::getName() : '-';
    }

    /**
     * Re-write getRegion
     *
     * @return string
     *
     * @issue 2673
     */
    public function getFormatRegion() {
        return parent::getRegion() ? parent::getRegion() : '-';
    }

    /**
     * Re-write getCurrency
     *
     * @return string
     *
     * @issue 2673
     */
    public function getCurrency() {
        return parent::getCurrency() ? parent::getCurrency() : '-';
    }

    /**
     * Re-write getProfitType
     *
     * @return string
     *
     * @issue 2673
     */
    public function getProfitType(){
        return parent::getProfitType() ? parent::getProfitType() : '-';
    }

}
