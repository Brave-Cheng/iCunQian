<?php

/**
 * @package apps\api\modules\PushService
 */
/**
 * PushService actions.
 *
 * @author     brave <brave.cheng@expacta.com.cn>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class PushServiceActions extends baseApiActions
{

    /**
     * execute before the action
     *
     * @return null
     *
     * @issue 2599
     */
    public function preExecute() {
        parent::preExecute();
        $this->setTemplate('json');
    }

    /**
     * Subscribe API
     *
     * @return affected rows
     *
     * @issue 2599
     */
    public function executeSubscribe() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            apiLog::logMessage("PARAMETERS ERROR: The parameters can not be decode.");
            $this->forward('default', 'error403');
        }
        try {
            //account_id, hash
            $this->validateAccount();

            $this->_validateSubscribe();
            
            $subscribe = DepositMembersSubscribePeer::subscribe(
                $this->post['account_id'],
                $this->post['bank_id'],
                $this->post['city'],
                $this->post['profit_type'],
                $this->post['expected_rate'],
                $this->post['invest_cycle'],
                $this->post['is_valid']
            );

            if (trim($this->post['device_token']) != '') {
                DepositMembersTokenPeer::updateMemberToken($this->post['account_id'], $this->post['device_token']);
            }

            $this->responseData = array('status' => 1, 'subscribe_id' => $subscribe->getId());

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Validate subscribe 
     *
     * @return void
     *
     * @issue 2715
     */
    private function _validateSubscribe() {
        if ($this->post['bank_id']) {
            if (is_null(DepositBankPeer::retrieveByPK($this->post['bank_id']))) {
                throw new ParametersException(ParametersException::$error1000, 'bank_id');
            }
        }

        if ($this->post['profit_type']) {
            $profitTypeRange = DepositFinancialProductsPeer::getSearchFilterByKey('profit_type');

            $this->post['profit_type'] = $profitTypeRange[$this->post['profit_type']];
            if (!$this->post['profit_type']) {
                throw new ParametersException(ParametersException::$error1002, 'profit_type');
            }
        }
        
        if ($this->post['expected_rate']) {
            $expectedYieldRange = PushDevicesPeer::getExpectedYields();
            if (!array_key_exists($this->post['expected_rate'], $expectedYieldRange)) {
                throw new ParametersException(ParametersException::$error1002, 'expected_rate');
            }
        }
        if ($this->post['invest_cycle']) {
            $financialCycleRange = PushDevicesPeer::getFinancialCycles();
            if (!array_key_exists($this->post['invest_cycle'], $financialCycleRange)) {
                throw new ParametersException(ParametersException::$error1002, 'invest_cycle');
            }
        }

        if ($this->post['is_valid'] && !in_array($this->post['is_valid'], array(DepositMembersPeer::YES, DepositMembersPeer::NO))) {
            throw new ParametersException(ParametersException::$error1000, 'is_valid');
        }

    }



    /**
     * Un-subscribe 
     *
     * @return void
     *
     * @issue 2660
     */
    public function executeUnSubscribe() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateUnSubscribe();

            $subscribe = DepositMembersSubscribePeer::unSubscribe($this->post['subscribe_id']);

            $this->responseData = array('status' => 1, 'subscribe_id' => $subscribe->getId());
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }


    /**
     * Validate un-subscribe
     *
     * @return void
     *
     * @issue 2660, 2715
     */
    private function _validateUnSubscribe() {
        if (empty($this->post['subscribe_id']) || 
            (isset($this->post['subscribe_id']) && trim($this->post['subscribe_id']) == '')) {
            throw new ParametersException(ParametersException::$error1000, 'subscribe_id');
        }
    }


    /**
     * Execute registertoken action
     *
     * @return void
     *
     * @issue 2715
     */
    public function executeRegisterToken() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            apiLog::logMessage("PARAMETERS ERROR: The parameters can not be decode.");
            $this->forward('default', 'error403');
        }
        try {
            //account_id, hash
            $this->validateAccount();

            $this->_validateRegisterToken();
            
            $register = DepositMembersTokenPeer::registerMemberToken(
                $this->post['account_id'],
                $this->post['app_name'],
                $this->post['device_token'],
                $this->post['device_model'],
                $this->post['device_name'],
                $this->post['device_uid'],
                $this->post['app_version'],
                $this->post['device_version'],
                $this->post['development']
            );
            
            $this->responseData = array('status' => 1, 'account_id' => $register->getDepositMembersId());

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Validate subscribe post paramaters
     *
     * @return boolean
     *
     * @issue  2599
     */
    private function _validateRegisterToken() {
        if (isset($this->post['app_name']) && trim($this->post['app_name']) == '') {
            throw new ParametersException(ParametersException::$error1000, 'app_name');
        }
        if (isset($this->post['device_token']) && trim($this->post['device_token']) == '' ) {
            throw new ParametersException(ParametersException::$error1000, 'device_token');
        }
        if (isset($this->post['device_model']) && trim($this->post['device_model']) == '') {
            throw new ParametersException(ParametersException::$error1000, 'device_model');
        }
        if (isset($this->post['device_name']) && trim($this->post['device_name']) == '') {
            throw new ParametersException(ParametersException::$error1000, 'device_name');
        }
        if ($this->post['development'] && !in_array($this->post['development'], array(PushDevicesPeer::DEVELOPMENT_SANDBOX, PushDevicesPeer::DEVELOPMENT_PRODUCTION))) {
            throw new ParametersException(ParametersException::$error1002, 'development');
        }
        $models = PushDevicesPeer::getDeviceModels();
        if (!in_array($this->post['device_model'], $models)) {
            throw new ParametersException(ParametersException::$error1002, sprintf('Device model only be in %s', implode(',', $models)));
        }
    }

    
}
