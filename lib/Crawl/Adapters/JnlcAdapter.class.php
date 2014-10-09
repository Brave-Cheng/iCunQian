<?php

/**
 * @package lib\Craw\Adapeter
 */

/**
 * 
 * Crawl page jnlc adapter
 * 
 */
class JnlcAdapter extends AbstractAdapter
{

    public $strFinaName;        //DepositFinancialProducts::NAME
    public $strBankNameSmp;     //DepositFinancialProducts::BANK_NAME    
    public $dYqnhsylsx;         //DepositFinancialProducts::EXPECTED_RATE
    public $strMoneyType;       //DepositFinancialProducts::CURRENCY
    public $strProfitType;      //DepositFinancialProducts::PROFIT_TYPE
    public $strLimit;           //DepositFinancialProducts::INVEST_CYCLE, need to change fitable
    public $sdtFinaEnd;         //DepositFinancialProducts::DEADLINE
    // public $strRella;        //DepositFinancialProducts::NAME //挂钩标的
    public $sdtFinaStart;       //DepositFinancialProducts::PROFIT_START_DATE
    public $strFundsInvest;     //DepositFinancialProducts::TARGET, //投资品种
    public $sdtSaleStart;       //DepositFinancialProducts::SALE_START_DATE
    public $sdtSaleEnd;         //DepositFinancialProducts::SALE_END_DATE
    // public $strSaleTo;          //DepositFinancialProducts::TARGET
    public $strSaleWhere;       //DepositFinancialProducts::REGION
    public $strYield;            //DepositFinancialProducts::PROFIT_DESC
    public $strEarlStopExpl;     //DepositFinancialProducts::STOP_CONDITION
    public $strFeeExpl;          //DepositFinancialProducts::COST
    public $mInvestStart;        //DepositFinancialProducts::INVEST_START_AMOUNT, need to change fitable

    /**
     * populate fields
     *
     * @return array
     *
     * @issue 2729
     */
    public function populate() {
        $trans = array(
            DepositFinancialProductsPeer::PHPNAME_NAME                  => $this->_getStrFinaName(),
            DepositFinancialProductsPeer::PHPNAME_BANK_NAME             => $this->_getStrBankNameSmp(),
            DepositFinancialProductsPeer::PHPNAME_EXPECTED_RATE         => $this->_getDYqnhsylsx(),
            DepositFinancialProductsPeer::PHPNAME_CURRENCY              => $this->_getStrMoneyType(),
            DepositFinancialProductsPeer::PHPNAME_PROFIT_TYPE           => $this->_getStrProfitType(),
            DepositFinancialProductsPeer::PHPNAME_INVEST_CYCLE          => $this->_getStrLimit(),
            DepositFinancialProductsPeer::PHPNAME_DEADLINE              => $this->_getSdtFinaEnd(),
            DepositFinancialProductsPeer::PHPNAME_PROFIT_START_DATE     => $this->_getSdtFinaStart(),
            DepositFinancialProductsPeer::PHPNAME_TARGET                => $this->_getStrFundsInvest(),
            DepositFinancialProductsPeer::PHPNAME_SALE_START_DATE       => $this->_getSdtSaleStart(),
            DepositFinancialProductsPeer::PHPNAME_SALE_END_DATE         => $this->_getSdtSaleEnd(),
            DepositFinancialProductsPeer::PHPNAME_REGION                => $this->_getStrSaleWhere(),
            DepositFinancialProductsPeer::PHPNAME_PROFIT_DESC           => $this->_getStrYield(),
            DepositFinancialProductsPeer::PHPNAME_STOP_CONDITION        => $this->_getStrEarlStopExpl(),
            DepositFinancialProductsPeer::PHPNAME_COST                  => $this->_getStrFeeExpl(),
            DepositFinancialProductsPeer::PHPNAME_INVEST_START_AMOUNT   => $this->_getMInvestStart(),
        );
        return $trans;
    }

    /**
     * Get strFinaName
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrFinaName() {
        return is_null($this->strFinaName) ? '' : $this->strFinaName;
    }

    /**
     * Get strBankNameSmp
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrBankNameSmp() {
        return is_null($this->strBankNameSmp) ? '' : $this->strBankNameSmp;
    }

    /**
     * Get dYqnhsylsx
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getDYqnhsylsx() {
        return is_null($this->dYqnhsylsx) ? '' : $this->dYqnhsylsx;
    }

    /**
     * Get strMoneyType
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrMoneyType() {

        $this->strMoneyType = $this->getBasicCurreny($this->strMoneyType);

        return is_null($this->strMoneyType) ? '' : $this->strMoneyType;
    }

    /**
     * Get strProfitType
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrProfitType() {
        
        $this->strProfitType = $this->getBasicProfitType($this->strProfitType);

        return is_null($this->strProfitType) ? '' : $this->strProfitType;
    }

    /**
     * Get strLimit
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrLimit() {
        if ($this->strLimit) {
            $this->strLimit = ceil(intval($this->strLimit) / 30);
        }
        return is_null($this->strLimit) ? '' : $this->strLimit;
    }

    /**
     * Get sdtFinaEnd
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getSdtFinaEnd() {
        if ($this->sdtFinaEnd) {
            $this->sdtFinaEnd = $this->pregMatchTimeString($this->sdtFinaEnd);
        }
        return is_null($this->sdtFinaEnd) ? '' : $this->sdtFinaEnd;
    }


    /**
     * Get sdtFinaStart
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getSdtFinaStart() {
        if ($this->sdtFinaStart) {
            $this->sdtFinaStart = $this->pregMatchTimeString($this->sdtFinaStart);
        }
        return is_null($this->sdtFinaStart) ? '' : $this->sdtFinaStart;
    }

    /**
     * Get strFundsInvest
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrFundsInvest() {
        return is_null($this->strFundsInvest) ? '' : $this->strFundsInvest;
    }

    /**
     * Get sdtSaleStart
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getSdtSaleStart() {
        if ($this->sdtSaleStart) {
            $this->sdtSaleStart = $this->pregMatchTimeString($this->sdtSaleStart);
        }
        return is_null($this->sdtSaleStart) ? '' : $this->sdtSaleStart;
    }


    /**
     * Get sdtSaleEnd
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getSdtSaleEnd() {
        if ($this->sdtSaleEnd) {
            $this->sdtSaleEnd = $this->pregMatchTimeString($this->sdtSaleEnd);
        }
        return is_null($this->sdtSaleEnd) ? '' : $this->sdtSaleEnd;
    }

    /**
     * Get strSaleWhere
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrSaleWhere() {
        return is_null($this->strSaleWhere) ? '' : $this->strSaleWhere;
    }

    /**
     * Get strYield
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrYield() {
        return is_null($this->strYield) ? '' : $this->strYield;
    }

    /**
     * Get strEarlStopExpl
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrEarlStopExpl() {
        return is_null($this->strEarlStopExpl) ? '' : $this->strEarlStopExpl;
    }

    /**
     * Get strFeeExpl
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getStrFeeExpl() {
        return is_null($this->strFeeExpl) ? '' : $this->strFeeExpl;
    }

    /**
     * Get mInvestStart
     *
     * @return string
     *
     * @issue 2729
     */
    private function _getMInvestStart() {
        if ($this->mInvestStart) {
            $this->mInvestStart = $this->mInvestStart * 10000;
        }
        return is_null($this->mInvestStart) ? '' : $this->mInvestStart;
    }

    /**
     * Match time string
     *
     * @param string $timeString time string
     *
     * @return string
     *
     * @issue 2729
     */
    protected function pregMatchTimeString($timeString) {
        $matches = array();
        preg_match("/\d+/", $timeString, $matches);
        return date('Y-m-d', substr($matches[0], 0, 10));
    }

}