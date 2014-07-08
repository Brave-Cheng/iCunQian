<?php

/**
 * @package apps\api\modules\Personal\actions
 */

/**
 * Personal actions.
 *
 * @subpackage Personal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class PersonalActions extends baseApiActions
{
    /**
     * Executes preExecute before action.
     *
     * @return void
     *
     * @issue 2626
     */
    public function preExecute() {
        parent::preExecute();
        $this->setTemplate('json');
    }

    /**
     * Get all of products of user
     *
     * @return void
     *
     * @issue 2632
     */
    public function executeGetAll() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $accountId = $this->getRequestParameter('account_id');
        try {
            if (empty($accountId)) {
                throw new Exception("Request parameters is incorrect. the parameter must be account_id.");
            }

            DepositMembersPeer::verfiyMember($accountId);

            $rs = DepositPersonalProductsPeer::getPersonProductByUser(
                $accountId
            );
            
            $this->responseData = array('status' => 1, 'personal_products' => $rs);
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
        }
    }
    
    /**
     * Get one product of user
     *
     * @return void
     *
     * @issue 2632
     */
    public function executeGet() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $pk = $this->getRequestParameter('personal_product_id');
        try {
            if (empty($pk)) {
                throw new Exception('Request parameters is incorrect. the parameter must be personal_product_id.');
            }
            $rs = DepositPersonalProductsPeer::getPersonProductById(
                $pk
            );
            
            $this->responseData = array('status' => 1, 'personal_products' => $rs);
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
        }
    }

    /**
     * Create a new personal product
     *
     * @return void
     *
     * @issue 2632
     */ 
    public function executePost() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }

        try {

            $this->_validateUser();
            $this->_validateProduct();

            $rs = DepositPersonalProductsPeer::addPersonalProduct(
                $this->post['product_id'],
                $this->post['account_id'],
                $this->post['expected_rate'],
                $this->post['amount'],
                $this->post['buy_date'],
                $this->post['expiry_date']
            );

            $this->responseData = array('status' => 1, 'personal_products' => array(
                'personal_product_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
        }
    }

    /**
     * Update a personal product
     *
     * @return void
     *
     * @issue 2632
     */
    public function executePut() {
        if ($this->getRequest()->getMethod() != sfRequest::PUT) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }

        try {
            $rs = DepositPersonalProductsPeer::updatePersonalProduct(
                $this->post['personal_product_id'],
                $this->post['expected_rate'],
                $this->post['amount'],
                $this->post['buy_date'],
                $this->post['expiry_date']
            );

            $this->responseData = array('status' => 1, 'personal_products' => array(
                'personal_product_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
        }
    }

    /**
     * Delte a personal product
     *
     * @return void
     *
     * @issue 2632
     */
    public function executeDelete() {
        if ($this->getRequest()->getMethod() != sfRequest::DELETE) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }

        try {

            $rs = DepositPersonalProductsPeer::deletePersonalProduct(
                $this->post['personal_product_id']
            );

            $this->responseData = array('status' => 1);
        } catch (Exception $e) {
            $this->responseData = array('status' => 0, 'error_msg' => $e->getMessage());
        }
    }


    /**
     * Check if is valid user
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validateUser() {
        if (empty($this->post['account_id'])) {
            throw new Exception("Request parameters is incorrect. the parameter must be account_id.");
        }

        DepositMembersPeer::verfiyMember($this->post['account_id']);
    }

    /**
     * Check if is valid product
     *
     * @return void
     *
     * @issue 2632
     */
    private function _validateProduct() {
        if (empty($this->post['product_id'])) {
            throw new Exception("Request parameters is incorrect. the parameter must be product_id.");
        }
        DepositFinancialProductsPeer::verifyProduct($this->post['product_id']);
    }
    /**
     * Check if is valid personal product
     *
     * @return void
     *
     * @issue 2626
     */
    private function _validatePersonalProduct() {
        if (empty($this->post['personal_product_id'])) {
            throw new Exception("Request parameters is incorrect. the parameter must be personal_product_id.");
        }
        DepositPersonalProductsPeer::verifiyPersonalProduct($this->post['personal_product_id']);
    }

}
