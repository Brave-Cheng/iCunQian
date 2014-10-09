<?php

/**
 * @package apps\api\modules\FinanceProduct
 */

/**
 * FinanceProduct actions.
 *
 * @subpackage FinanceProduct
 * @author     brave <brave.cheng@expacta.com.cn>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 *
 */
class FinanceProductActions extends baseApiActions
{

    const FETCH_NONE = 0; // successful
    const FETCH_NO_DATA = 1; // no exist filter data
    const FETCH_COMPLETE = 2; // successful
    const REGION_ALL = '全国';

    protected $gzip = false;
    protected $since = null;
    protected $responseData = null;
    protected $limit = 1000;
    /**
     * execute before the action
     *
     * @return null
     */
    public function preExecute() {
        parent::preExecute();
        $this->setTemplate('json');
    }


    /**
     * Get total products
     *
     * @return void
     *
     * @issue 2681
     */
    public function executeGetTotalProducts() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $responseData = array();        
        try {
            $this->commonGetParameters();
            if ($this->since) {
                $filter[DepositFinancialProductsPeer::UPDATED_AT] = " > FROM_UNIXTIME(" . $this->since . ", '%Y-%m-%d %H:%i:%s') ";
            }
            $filter[DepositFinancialProductsPeer::SALE_END_DATE]  = " >= '" . date('Y-m-d') . "'";   
            
            $total = DepositFinancialProductsPeer::getFilterProducts($filter, null, $this->limit, 0, array(), false, true);

            $this->responseData = array('status' => 1, 'total_products' => $total);

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * fetch data
     *
     * @issue 2700
     * 
     * @return void
     */
    public function executeProducts() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $responseData = array();        
        try {
            $this->commonGetParameters();
            if ($this->since) {
                $filter[DepositFinancialProductsPeer::UPDATED_AT] = " > FROM_UNIXTIME(" . $this->since . ", '%Y-%m-%d %H:%i:%s') ";
            }
            $filter[DepositFinancialProductsPeer::SALE_END_DATE]  = " >= '" . date('Y-m-d') . "'";   
                        
            $unecessaryFields = array('announce', 'cost', 'events', 'feature', 'purchase', 'raise_condition', 'status', 'stop_condition', 'target');

            $products = DepositFinancialProductsPeer::getFilterProducts($filter, null, $this->limit, 0, $unecessaryFields, false, false, true);

            $lastProducts = end($products['list']);
            $responseData['total_products_returned'] = count($products['list']);
            $responseData['since'] = strtotime($lastProducts['updated_at']);
            $responseData['total_products'] = $products['total'];
            $responseData['products'] = $products['list'];
            $this->responseData = $responseData;

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
        
    }


    /**
     * Get product api
     *
     * @return void
     *
     * @issue 2658
     */
    public function executeGetProduct() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $productId = $this->getRequestParameter('product_id');
        try {
            if (!$productId || !is_numeric($productId)) {
                throw new ParametersException(ParametersException::$error1000, 'product_id');
            }
            
            $rs = DepositFinancialProductsPeer::getSpecifyProduct($productId);
            $this->responseData = array('status' => 1, 'product' => $rs[0]);
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }


    /**
     * Get filter product api
     *
     * @return void
     *
     * @issue 2659
     */
    public function executeFilterProducts() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $this->filter = array();
        $this->limit = 100;
        try {
            $this->commonGetParameters();
            $this->_validateFilterProducts();
            $this->_filterSaleStartAmount();
            $this->_filterExpectedRate();
            $this->_filterFinancialCycle();
            $this->_filterProfitType();
            $this->_filterCurrency();
            $this->_filterStatus();

            if ($this->bankId) {
                $this->filter[DepositFinancialProductsPeer::BANK_ID] = " = '" . $this->bankId . "'";
            }

            if ($this->region) {
                $this->filter[] = " (" . DepositFinancialProductsPeer::REGION . " LIKE '%" . $this->region . "%' OR " . DepositFinancialProductsPeer::REGION . " LIKE '%" . self::REGION_ALL . "%')";
            }

            $this->filter[DepositFinancialProductsPeer::STATUS] = true;

            if ($this->keyword) {
                $this->filter[DepositFinancialProductsPeer::NAME] = " LIKE '%" .$this->keyword. "%'";
            }
            $unecessaryFields = array( 'announce', 'cost','events', 'feature', 'invest_scope', 'profit_desc', 'purchase', 'raise_condition', 'stop_condition', 'sync_status', 'target', 'warnings', 'created_at', 'updated_at'
            );
            $products = DepositFinancialProductsPeer::getFilterProducts($this->filter, null, $this->limit, $this->offset, $unecessaryFields, false);

            $lastProducts = end($products['list']);
            $responseData['total_products_returned'] = count($products['list']);
            $responseData['total_products'] = $products['total'];
            $responseData['products'] = $products['list'];
            $this->responseData = $responseData;

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }


    /**
     * Validate filter products
     *
     * @return void
     *
     * @issue 2659
     */
    private function _validateFilterProducts() {
        $this->saleStartAmount  = $this->getRequestParameter('sale_start_amount');
        $this->expectedRate     = $this->getRequestParameter('expected_rate');
        $this->financialCycle   = $this->getRequestParameter('financial_cycle');
        $this->profitType       = $this->getRequestParameter('profit_type');
        $this->currency         = $this->getRequestParameter('currency');
        $this->status           = $this->getRequestParameter('status');
        $this->bankId             = $this->getRequestParameter('bank_id');

        $this->region           = $this->getRequestParameter('region');
        $this->keyword          = $this->getRequestParameter('keyword');
        $this->offset           = $this->getRequestParameter('offset');

        if (isset($this->saleStartAmount) && !is_numeric($this->saleStartAmount)) {
            throw new ParametersException(ParametersException::$error1000, 'sale_start_amount');
        }

        if (isset($this->expectedRate) && !is_numeric($this->expectedRate)) {
            throw new ParametersException(ParametersException::$error1000, 'expected_rate');
        }

        if (isset($this->financialCycle) && !is_numeric($this->financialCycle)) {
            throw new ParametersException(ParametersException::$error1000, 'financial_cycle');
        }

        if (isset($this->profitType) && !is_numeric($this->profitType)) {
            throw new ParametersException(ParametersException::$error1000, 'profit_type');
        }

        if (isset($this->currency) && !is_numeric($this->currency)) {
            throw new ParametersException(ParametersException::$error1000, 'currency');
        }

        if (isset($this->status) && !is_numeric($this->status)) {
            throw new ParametersException(ParametersException::$error1000, 'status');
        }

        if (isset($this->bankId) && !is_numeric($this->bankId)) {
            throw new ParametersException(ParametersException::$error1000, 'bank_id');
        }

        if (isset($this->offset) && !is_numeric($this->offset)) {
            throw new ParametersException(ParametersException::$error1000, 'offset');
        }
    }

    /**
     * Get sale start amount 
     *
     * @return void
     *
     * @issue 2659
     */
    private function _filterSaleStartAmount() {
        if ($this->saleStartAmount) {
            $saleStartAmountRange = DepositFinancialProductsPeer::getSearchSaleStartAmount();
            $saleStartAmount = $saleStartAmountRange[$this->saleStartAmount];
            if (!$saleStartAmount) {
                throw new ParametersException(ParametersException::$error1002);
            }

            if (isset($saleStartAmount[0]) && isset($saleStartAmount[1])) {
                $this->filter[] =  '('. $saleStartAmount[0] ." <  " . DepositFinancialProductsPeer::INVEST_START_AMOUNT . " AND " . DepositFinancialProductsPeer::INVEST_START_AMOUNT. " <= " .$saleStartAmount[1]. ")";
            }

            if (isset($saleStartAmount[0]) && $saleStartAmount[1] === '') {
                $this->filter[DepositFinancialProductsPeer::INVEST_START_AMOUNT] = ' > ' . $saleStartAmount[0];
            }

            if (isset($saleStartAmount[1]) && $saleStartAmount[0] === '') {
                $this->filter[DepositFinancialProductsPeer::INVEST_START_AMOUNT] = ' <=' . $saleStartAmount[1];
            }
        }
    }


    /**
     * Get expected rate
     *
     * @return void
     *
     * @issue 2659
     */
    private function _filterExpectedRate() {
        if ($this->expectedRate) {
            $expectedRateRange = PushDevicesPeer::getExpectedYields();
            $expectedRate = $expectedRateRange[$this->expectedRate];

            if (!$expectedRate) {
                throw new ParametersException(ParametersException::$error1002);
            }
            
            if ($expectedRate[0] !== '' && $expectedRate[1] !== '') {
                $this->filter[] =  '('. $expectedRate[0] ." <  " . DepositFinancialProductsPeer::EXPECTED_RATE . " AND " . DepositFinancialProductsPeer::EXPECTED_RATE. " <= " .$expectedRate[1]. ")";

            }

            if ($expectedRate[0] === '' && $expectedRate[1]) {
                $this->filter[DepositFinancialProductsPeer::EXPECTED_RATE] = ' <= ' . $expectedRate[1];
            }

            if (isset($expectedRate[0]) && $expectedRate[1] === '') {
                $this->filter[DepositFinancialProductsPeer::EXPECTED_RATE] = ' >' . $expectedRate[0];
            }
        }
    }



    /**
     * Get financial cycle
     *
     * @return void
     *
     * @issue 2659
     */
    private function _filterFinancialCycle() {
        if ($this->financialCycle) {
            $financialCycleRange = PushDevicesPeer::getFinancialCycles();
            $financialCycle = $financialCycleRange[$this->financialCycle];

            if (!$financialCycle) {
                throw new ParametersException(ParametersException::$error1002);
            }
            
            if ($financialCycle[0] !== '' && $financialCycle[1] !== '') {
                $this->filter[] =  '('. $financialCycle[0] ." <  " . DepositFinancialProductsPeer::INVEST_CYCLE . " AND " . DepositFinancialProductsPeer::INVEST_CYCLE. " <= " .$financialCycle[1]. ")";  
            }

            if ($financialCycle[0] === '' && $financialCycle[1]) {
                $this->filter[DepositFinancialProductsPeer::INVEST_CYCLE] = ' <= ' . $financialCycle[1];
            }

            if (isset($financialCycle[0]) && $financialCycle[1] === '') {
                $this->filter[DepositFinancialProductsPeer::INVEST_CYCLE] = ' >' . $financialCycle[0];
            }
        }
    }

    /**
     * Get profit type
     *
     * @return void
     *
     * @issue 2659
     */
    private function _filterProfitType() {
        if ($this->profitType) {
            $profitTypeRange = DepositFinancialProductsPeer::getSearchFilterByKey('profit_type');


            $profitType = $profitTypeRange[$this->profitType];

            if (!$profitType) {
                throw new ParametersException(ParametersException::$error1002);
            }

            $this->filter[DepositFinancialProductsPeer::PROFIT_TYPE] = " = '" . $profitType . "'";

        }
    }


    /**
     * Get currency
     *
     * @return void
     *
     * @issue 2659
     */
    private function _filterCurrency() {
        if ($this->currency) {
            $currencyRange = DepositFinancialProductsPeer::getSearchFilterByKey('currency');

            $currency = $currencyRange[$this->currency];

            if (!$currency) {
                throw new ParametersException(ParametersException::$error1002);
            }

            $this->filter[DepositFinancialProductsPeer::CURRENCY] = " = '" . $currency . "'";

        }
    }


    /**
     * Get status
     *
     * @return void
     *
     * @issue 2659
     */
    private function _filterStatus() {
        if ($this->status) {
            $statusRange = DepositFinancialProductsPeer::getSearchFilterByKey('status');

            $status = $statusRange[$this->status];

            if (!$status) {
                throw new ParametersException(ParametersException::$error1002);
            }

            $this->filter[DepositFinancialProductsPeer::STATUS] = " = '" . $status . "'";

        }
    }





}
