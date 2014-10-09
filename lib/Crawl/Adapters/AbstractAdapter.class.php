<?php

/**
 * @package lib\Craw\Adapeter
 * 
 * Crawl page abstract adapter
 * 
 */

class AbstractAdapter
{
    /**
     * Get attributesAdapter
     *
     * @return array
     *
     * @issue 2729
     */
    public function getAttributesAdapter() {
        static $attributesAdapter;
        $attributesAdapter = Config::getInstance('CrawlConfig')->getAttributeAdapter();
        return $attributesAdapter;
        
    }

    /**
     * Get currency
     *
     * @param string $currency currency
     *
     * @return string
     *
     * @issue  2729
     */
    public function getBasicCurreny($currency) {
        $attributes = $this->getAttributesAdapter();

        foreach ($attributes['currency'] as $key => $fieldValueLists) {
            if (in_array($currency, $fieldValueLists)) {
                $currency = $key;
                break;
            }
        }
        return $currency;
    }

    /**
     * Get Profit type
     *
     * @param string $profitType profit type
     *
     * @return string
     *
     * @issue 2729
     */
    public function getBasicProfitType($profitType) {
        $attributes = $this->getAttributesAdapter();
        
        foreach ($attributes['profit_type'] as $key => $fieldValueLists) {
            if (in_array($profitType, $fieldValueLists)) {
                $profitType = $key;
                break;
            }
        }

        return $profitType;
    }
}