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
     * fetch data
     *
     * @return null
     */
    public function executeProducts() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $this->httpCode = apiUtil::CODE_BAD_REQUEST;
        $responseData = array();
        $this->commonGetParameters();
        $this->httpCode = apiUtil::CODE_SUCCESSFUL;
        try {
            if ($this->since) {
                $filter = array(
                    'dfp.updated_at' => " > FROM_UNIXTIME(" . $this->since . ", '%Y-%m-%d %H:%i:%s') ",
                );
            } 
            $products = DepositFinancialProductsPeer::fetchFiltersList($filter, null, $this->limit);
            $lastProducts = end($products['list']);
            $responseData['total_products_returned'] = count($products['list']);
            $responseData['since'] = strtotime($lastProducts['updated_at']);
            $responseData['total_products'] = $products['total'];
            $responseData['products'] = $products['list'];
        } catch (Exception $e) {
            $responseData['error_msg'] = $e->getMessage();
        }
        $this->responseData = $responseData;
    }

    /**
     * RESTFul DELETE Method
     *
     * @issue 2579
     * @return null
     */
    public function executeDelete() {
        if ($this->getRequest()->getMethod() != sfRequest::DELETE) {
            $this->forward('default', 'error400');
        }
        $response = array();
        $this->httpCode = apiUtil::CODE_BAD_REQUEST;
        $this->product = $this->getRequestParameter('product') ? $this->getRequestParameter('product') : 0;
        if (empty($this->product)) {
            $response = array(
                'error_code' => apiUtil::CODE_BAD_REQUEST,
                'error_msg' => $this->getContext()->getI18N()->__('No since specified'),
            );
        } else {
            $this->httpCode = apiUtil::CODE_SUCCESSFUL;
            try {
                $product = DepositFinancialProductsPeer::retrieveByPK($this->product);
                if (empty($product)) {
                    throw new Exception(sprintf("product %s is not exist!", $this->product));
                }
                $product->getDepositRequestFinancial()->delete();
                $product->delete();
                $response['status'] = 1;
            } catch (Exception $exc) {
                $response['status'] = 0;
                $response['error_msg'] = $exc->getMessage();
            }
        }
        $this->responseData = $response;
    }

}
