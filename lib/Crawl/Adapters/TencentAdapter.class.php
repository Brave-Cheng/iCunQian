<?php

/**
 * @package lib\Craw\Adapeter
 */

/**
 * 
 * Crawl page tencent adapter
 * 
 */
class TencentAdapter extends AbstractAdapter
{

    public $name;
    public $status;
    public $bankName;
    public $saleStartDate;
    public $saleEndDate;
    public $profitType;
    public $currency;
    public $profitStartDate;
    public $region;
    public $deadline;
    public $target;
    public $investCycle;
    public $expectedRate;
    public $actualRate;
    public $payPeriod;
    public $investStartAmount;
    public $investIncreaseAmount;
    public $profitDesc;
    public $stopCondition;
    public $raiseCondition;
    public $purchase;
    public $feature;
    public $events;
    public $warnings;
    public $announce;


    /**
     * setDictionaryAdapter
     *
     * @param string $subject subject
     * 
     * @return void
     *
     * @issue 2729
     */
    public function setDictionaryAdapter($subject) {
    
        $dictionarys = Config::getInstance('CrawlConfig')->getTencentDictionary();

        foreach ($subject as $key => $value) {
            foreach ($dictionarys as $field => $fieldVars) {
                if (in_array($key, $fieldVars)) {
                    $this->$field = $value;
                }
            }
        }        
    }

    /**
     * populate fields
     *
     * @return array
     *
     * @issue 2729
     */
    public function populate() {
        $trans = array(
            DepositFinancialProductsPeer::PHPNAME_NAME                      => $this->getName(),
            DepositFinancialProductsPeer::PHPNAME_STATUE                    => $this->getStatus(),
            DepositFinancialProductsPeer::PHPNAME_BANK_NAME                 => $this->getBankName(),
            DepositFinancialProductsPeer::PHPNAME_SALE_START_DATE           => $this->getSaleStartDate(),
            DepositFinancialProductsPeer::PHPNAME_SALE_END_DATE             => $this->getSaleEndDate(),
            DepositFinancialProductsPeer::PHPNAME_PROFIT_TYPE               => $this->getProfitType(),
            DepositFinancialProductsPeer::PHPNAME_CURRENCY                  => $this->getCurrency(),
            DepositFinancialProductsPeer::PHPNAME_PROFIT_START_DATE         => $this->getProfitStartDate(),
            DepositFinancialProductsPeer::PHPNAME_REGION                    => $this->getRegion(),
            DepositFinancialProductsPeer::PHPNAME_DEADLINE                  => $this->getDeadline(),
            DepositFinancialProductsPeer::PHPNAME_TARGET                    => $this->getTarget(),
            DepositFinancialProductsPeer::PHPNAME_INVEST_CYCLE              => $this->getInvestCycle(),
            DepositFinancialProductsPeer::PHPNAME_EXPECTED_RATE             => $this->getExpectedRate(),
            DepositFinancialProductsPeer::PHPNAME_ACTUAL_RATE               => $this->getActualRate(),
            DepositFinancialProductsPeer::PHPNAME_PAY_PERIOD                => $this->getPayPeriod(),
            DepositFinancialProductsPeer::PHPNAME_INVEST_START_AMOUNT       => $this->getInvestStartAmount(),
            DepositFinancialProductsPeer::PHPNAME_INVEST_INCREASE_AMOUNT    => $this->getInvestIncreaseAmount(),
            DepositFinancialProductsPeer::PHPNAME_PROFIT_DESC               => $this->getProfitDesc(),
            DepositFinancialProductsPeer::PHPNAME_STOP_CONDITION            => $this->getStopCondition(),
            DepositFinancialProductsPeer::PHPNAME_RAISE_CONDITION           => $this->getRaiseCondition(),
            DepositFinancialProductsPeer::PHPNAME_PURCHASE                  => $this->getPurchase(),
            DepositFinancialProductsPeer::PHPNAME_FEATURE                   => $this->getFeature(),
            DepositFinancialProductsPeer::PHPNAME_EVENTS                    => $this->getEvents(),
            DepositFinancialProductsPeer::PHPNAME_WARNINGS                  => $this->getWarnings(),
            DepositFinancialProductsPeer::PHPNAME_ANNOUNCE                  => $this->getAnnounce(),
        );
        return $trans;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @issue 2729
     */
    public function getName() {
        return is_null($this->name) ? '' : $this->name;
    }

    /**
     * Get status
     *
     * @return string
     *
     * @issue 2729
     */
    public function getStatus() {
        $attributes = $this->getAttributesAdapter();

        foreach ($attributes['status'] as $key => $fieldValueLists) {
            if (in_array($this->status, $fieldValueLists)) {
                $this->status = $key;
                break;
            }
        }
        return is_null($this->status) ? '' : $this->status;
    }

    /**
     * Get bankName
     *
     * @return string
     *
     * @issue 2729
     */
    public function getBankName() {
        return is_null($this->bankName) ? '' : $this->bankName;
    }

    /**
     * Get saleStartDate
     *
     * @return string
     *
     * @issue 2729
     */
    public function getSaleStartDate() {
        return strtotime($this->saleStartDate) == false ? CrawlConfig::DEFAULT_DATE : $this->saleStartDate;
    }

    /**
     * Get saleEndDate
     *
     * @return string
     *
     * @issue 2729
     */
    public function getSaleEndDate() {
        return strtotime($this->saleEndDate) == false ? CrawlConfig::DEFAULT_DATE : $this->saleEndDate;
    }

    /**
     * Get profitType
     *
     * @return string
     *
     * @issue 2729
     */
    public function getProfitType() {
        $this->profitType = $this->getBasicProfitType($this->profitType);
        return is_null($this->profitType) ? '' : $this->profitType;
    }

    /**
     * Get currency
     *
     * @return string
     *
     * @issue 2729
     */
    public function getCurrency() {
        $this->currency = $this->getBasicCurreny($this->currency);
        return is_null($this->currency) ? '' : $this->currency;
    }

    /**
     * Get profitStartDate
     *
     * @return string
     *
     * @issue 2729
     */
    public function getProfitStartDate() {
        return strtotime($this->profitStartDate) == false ? CrawlConfig::DEFAULT_DATE : $this->profitStartDate;
    }

    /**
     * Get region
     *
     * @return string
     *
     * @issue 2729
     */
    public function getRegion() {
        return is_null($this->region) ? '' : $this->region;
    }

    /**
     * Get deadline
     *
     * @return string
     *
     * @issue 2729
     */
    public function getDeadline() {
        return strtotime($this->deadline) == false ? CrawlConfig::DEFAULT_DATE : $this->deadline;
    }

    /**
     * Get target
     *
     * @return string
     *
     * @issue 2729
     */
    public function getTarget() {
        return is_null($this->target) ? '' : $this->target;
    }

    /**
     * Get investCycle
     *
     * @return string
     *
     * @issue 2729
     */
    public function getInvestCycle() {
        return is_null($this->investCycle) ? '' : intval($this->investCycle);
    }

    /**
     * Get expectedRate
     *
     * @return string
     *
     * @issue 2729
     */
    public function getExpectedRate() {
        return is_null($this->expectedRate) ? '' : trim($this->expectedRate, '%');
    }

    /**
     * Get actualRate
     *
     * @return string
     *
     * @issue 2729
     */
    public function getActualRate() {
        return is_null($this->actualRate) ? '' : trim($this->actualRate, '%');
    }

    /**
     * Get name
     *
     * @return string
     *
     * @issue 2729
     */
    public function getPayPeriod() {
        return is_null($this->payPeriod) ? '' : $this->payPeriod;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @issue 2729
     */
    public function getInvestStartAmount() {
        return is_null($this->investStartAmount) ? '' : intval($this->investStartAmount);
    }

    /**
     * Get name
     *
     * @return string
     *
     * @issue 2729
     */
    public function getInvestIncreaseAmount() {
        return is_null($this->investIncreaseAmount) ? '' : intval($this->investIncreaseAmount);
    }

    /**
     * Get profitDesc
     *
     * @return string
     *
     * @issue 2729
     */
    public function getProfitDesc() {
        return is_null($this->profitDesc) ? '' : $this->profitDesc;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @issue 2729
     */
    public function getStopCondition() {
        return is_null($this->stopCondition) ? '' : $this->stopCondition;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @issue 2729
     */
    public function getRaiseCondition() {
        return is_null($this->raiseCondition) ? '' : $this->raiseCondition;
    }

    /**
     * Get purchase
     *
     * @return string
     *
     * @issue 2729
     */
    public function getPurchase() {
        return is_null($this->purchase) ? '' : $this->purchase;
    }

    /**
     * Get feature
     *
     * @return string
     *
     * @issue 2729
     */
    public function getFeature() {
        return is_null($this->feature) ? '' : $this->feature;
    }

    /**
     * Get events
     *
     * @return string
     *
     * @issue 2729
     */
    public function getEvents() {
        return is_null($this->events) ? '' : $this->events;
    }

    /**
     * Get warnings
     *
     * @return string
     *
     * @issue 2729
     */
    public function getWarnings() {
        return is_null($this->warnings) ? '' : $this->warnings;
    }

    /**
     * Get announce
     *
     * @return string
     *
     * @issue 2729
     */
    public function getAnnounce() {
        return is_null($this->announce) ? '' : $this->announce;
    }

    
    
}