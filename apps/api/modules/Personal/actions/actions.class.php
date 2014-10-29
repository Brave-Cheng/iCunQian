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
    public function executeRetrieveByUser() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $accountId = $this->getRequestParameter('account_id');
        $hash = $this->getRequestParameter('hash');
        $offset = $this->getRequestParameter('offset');
        $limit = $this->getRequestParameter('limit');
        try {
            if (empty($accountId)
                || empty($hash)) {
                throw new ParametersException(ParametersException::$error1000, 'account_id, hash');
            }
            DepositMembersPeer::verfiyMember($accountId, $hash);

            $rs = DepositPersonalProductsPeer::getPersonProductByUser(
                $accountId,
                $offset,
                $limit
            );
            
            $this->responseData = array('status' => 1, 'personal_products' => $rs);
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }
    
    /**
     * Get one product of user
     *
     * @return void
     *
     * @issue 2632
     */
    public function executeRetrieve() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $pk = $this->getRequestParameter('personal_product_id');
        try {
            if (empty($pk)) {
                throw new ParametersException(ParametersException::$error1000, 'personal_product_id');
            }
            $rs = DepositPersonalProductsPeer::getPersonProductById(
                $pk
            );
            
            $this->responseData = array('status' => 1, 'personal_products' => $rs);
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Create a new personal product
     *
     * @return void
     *
     * @issue 2632
     */ 
    public function executeCreate() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }

        try {

            $this->validateAccount();
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
            $this->setResponseError($e);
        }
    }

    /**
     * Update a personal product
     *
     * @return void
     *
     * @issue 2632
     */
    public function executeUpdate() {
        if ($this->getRequest()->getMethod() != sfRequest::PUT) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }

        try {
            $this->validateAccount();
            if (empty($this->post['personal_product_id'])) {
                throw new ParametersException(ParametersException::$error1000, 'personal_product_id');
            }
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
            $this->setResponseError($e);
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
        
        $accountId = $this->getRequestParameter('account_id');
        $personalProductId = $this->getRequestParameter('personal_product_id');
        $hash = $this->getRequestParameter('hash');

        try {
            if (empty($accountId) || empty($personalProductId) || empty($hash)) {
                throw new ParametersException(ParametersException::$error1000, 'account_id, personal_product_id, hash');
            }
            DepositMembersPeer::verfiyMember($accountId, $hash);

            $rs = DepositPersonalProductsPeer::deletePersonalProduct(
                $personalProductId
            );

            $this->responseData = array('status' => 1);
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }


    /**
     *execute batch synchronize action
     *
     * @return void
     *
     * @issue 2702
     */
    public function executeBatchSynchronize() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
            
        if (is_null($this->post)) {
            apiLog::logMessage("PARAMETERS ERROR: The parameters can not be decode.");
            $this->forward('default', 'error403');
        }
        try {
            $this->validateAccount();

            if ($this->post['secret'] != md5(json_encode($this->post['personal_products']))) {
                throw new ParametersException(ParametersException::$error1001, 'secret');
            }

            shell_exec("/usr/local/php5.2/bin/php  /data/testsites/deposit/devel/batch/cronjobs/BatchQueue.php " . ApiOfflineQueuePeer::ICAIFU . " " . base64_encode(json_encode($this->post['personal_products'])));

            //for test development
            shell_exec("/usr/local/php5.2/bin/php /data/testsites/deposit/devel/batch/cronjobs/ApiOfflineDequeue.php");

            // shell_exec('D:\upupw\PHP5\php.exe D:\Usr\Local\Web\Deposit\trunk\batch\cronjobs\BatchQueue.php ' . ApiOfflineQueuePeer::ICAIFU . ' ' . base64_encode(json_encode($this->post['personal_products'])));

            $this->responseData = array('status' => 1);

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Execute RetrieveFavoritesByUser action
     *
     * @return void
     *
     * @issue 2703
     */
    public function executeRetrieveFavoritesByUser() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $accountId = $this->getRequestParameter('account_id');
        $hash = $this->getRequestParameter('hash');
        $offset = $this->getRequestParameter('offset');
        $limit = $this->getRequestParameter('limit');
        try {
            if (empty($accountId)
                || empty($hash)) {
                throw new ParametersException(ParametersException::$error1000, 'account_id, hash');
            }
            DepositMembersPeer::verfiyMember($accountId, $hash);
            $rs = DepositMembersFavoritesPeer::retrieveFavoritesByUser(
                $accountId,
                $offset,
                $limit
            );
            $this->responseData = array('status' => 1, 'personal_favorites' => $rs);
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Execute FavoritesBatchSynchronize
     *
     * @return void
     *
     * @issue 2703
     */
    public function executeFavoritesBatchSynchronize() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
            
        if (is_null($this->post)) {
            apiLog::logMessage("PARAMETERS ERROR: The parameters can not be decode.");
            $this->forward('default', 'error403');
        }
        try {
            $this->validateAccount();

            if ($this->post['secret'] != md5(json_encode($this->post['personal_favorites']))) {
                throw new ParametersException(ParametersException::$error1001, 'secret');
            }

            shell_exec("/usr/local/php5.2/bin/php  /data/testsites/deposit/devel/batch/cronjobs/BatchQueue.php " . ApiOfflineQueuePeer::FAVORITE . " " . base64_encode(json_encode($this->post['personal_favorites'])));
            
            //for test development
            shell_exec("/usr/local/php5.2/bin/php  /data/testsites/deposit/devel/batch/cronjobs/ApiOfflineDequeue.php");

            // shell_exec('D:\upupw\PHP5\php.exe D:\Usr\Local\Web\Deposit\trunk\batch\cronjobs\BatchQueue.php ' . ApiOfflineQueuePeer::FAVORITE . ' ' . base64_encode(json_encode($this->post['personal_favorites'])));

            $this->responseData = array('status' => 1);

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
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
            throw new ParametersException(ParametersException::$error1000, 'product_id');
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
            throw new ParametersException(ParametersException::$error1000, 'personal_product_id');
        }
        DepositPersonalProductsPeer::verifiyPersonalProduct($this->post['personal_product_id']);
    }

}
