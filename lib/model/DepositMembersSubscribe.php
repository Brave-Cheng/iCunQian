<?php

/**
 * Subclass for representing a row from the 'deposit_members_subscribe' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembersSubscribe extends BaseDepositMembersSubscribe
{
    /**
     * Re-write save action
     *
     * @param object $con object
     *
     * @return affectedRows
     *
     * @issue 2715
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
     * Get api getDepositMembersId
     *
     * @return int
     *
     * @issue 2715
     */
    public function getApiDepositMembersId() {
        return $this->getDepositMembersId();
    }

    /**
     * Get api getDepositBankId
     *
     * @return int
     *
     * @issue 2715
     */
    public function getApiDepositBankId() {
        return $this->getDepositBankId();
    }

    /**
     * Get api getCity
     *
     * @return string
     *
     * @issue 2715
     */
    public function getApiCity() {
        return $this->getCity();
    }

    /**
     * Get api getProfitType
     *
     * @return int
     *
     * @issue 2715
     */
    public function getApiProfitType() {
        $profitTypeRange = DepositFinancialProductsPeer::getSearchFilterByKey('profit_type');
        $trans = array_flip($profitTypeRange);
        if (in_array($this->getProfitType(), $profitTypeRange)) {
            return $trans[$this->getProfitType()];
        }
        return $this->getProfitType();
    }

    /**
     * Get api getExpectedRate
     *
     * @return int
     *
     * @issue 2715
     */
    public function getApiExpectedRate() {
        return $this->getExpectedRate();
    }

    /**
     * Get api getApiInvestCycle
     *
     * @return int
     *
     * @issue 2715
     */
    public function getApiInvestCycle() {
        return $this->getInvestCycle();
    }

    /**
     * Get api getIsValid
     *
     * @return string
     *
     * @issue 2715
     */
    public function getApiIsValid() {
        return $this->getIsValid();
    }

    /**
     * Get api rate
     *
     * @return string
     *
     * @issue 2735
     */
    public function getApiRate() {

        $expectedYieldRange = PushDevicesPeer::getExpectedYields();

        if ($this->getExpectedRate()) {
            $temp = $expectedYieldRange[$this->getExpectedRate()];
            return implode('-', $temp) . DepositFinancialProductsPeer::PERCENT;
        }

        return $this->getExpectedRate();
    }

    /**
     * Get api cycle
     *
     * @return string
     *
     * @issue 2735
     */
    public function getApiCycle() {
        $financialCycleRange = PushDevicesPeer::getFinancialCycles();
        if ($this->getInvestCycle()) {
            $temp = $financialCycleRange[$this->getInvestCycle()];
            if ($temp[0] && $temp[1]) {
                return implode('-', $temp) . util::getMultiMessage('Month');
            }
            if ($temp[0] == '' && $temp[1])  {
                return $temp[1] . util::getMultiMessage('Within');
            }
            if ($temp[1] == '' && $temp[0]) {
                return $temp[0] . util::getMultiMessage('Beyond');
            }
        }
        return $this->getInvestCycle();
    }
}
