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
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateSubscribeParamters();
            $subscribe = PushDevicesPeer::subscribeDevice(
                $this->post['app_name'],
                $this->post['device_token'],
                $this->post['device_model'],
                $this->post['device_name'],
                $this->post['profit_type'],
                $this->post['expected_yield'],
                $this->post['financial_cycle'],
                $this->post['app_version'],
                $this->post['device_uid'],
                $this->post['device_version'],
                $this->post['city'],
                $this->post['bank'],
                $this->post['development'],
                $this->post['subscribe_id']
            );

            $this->responseData = array('status' => 1, 'subscribes' => array('subscribe_id' => $subscribe->getId()));

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
    private function _validateSubscribeParamters() {
        if (empty($this->post['pk'])) {
            if (empty($this->post['app_name'])) {
                throw new ParametersException(ParametersException::$error1000, 'app_name');
            }
            if (empty($this->post['device_token'])) {
                throw new ParametersException(ParametersException::$error1000, 'device_token');
            }
            if (empty($this->post['device_model'])) {
                throw new ParametersException(ParametersException::$error1000, 'device_model');
            }
            if (empty($this->post['device_name'])) {
                throw new ParametersException(ParametersException::$error1000, 'device_name');
            }
            if (empty($this->post['profit_type'])) {
                throw new ParametersException(ParametersException::$error1000, 'profit_type');
            }
            if ($this->post['profit_type'] && !is_numeric($this->post['profit_type'])) {
                throw new ParametersException(ParametersException::$error1000, 'profit_type');   
            }
            $profitTypeRange = DepositFinancialProductsPeer::getSearchFilterByKey('profit_type');
            $this->post['profit_type'] = $profitTypeRange[$this->post['profit_type']];
            if (!$this->post['profit_type']) {
                throw new ParametersException(ParametersException::$error1002, 'profit_type');
            }
            if (empty($this->post['expected_yield'])) {
                throw new ParametersException(ParametersException::$error1000, 'expected_yield');
            }
            $expectedYieldRange = PushDevicesPeer::getExpectedYields();
            if (!array_key_exists($this->post['expected_yield'], $expectedYieldRange)) {
                throw new ParametersException(ParametersException::$error1002, 'expected_yield');
            }
            if (empty($this->post['financial_cycle'])) {
                throw new ParametersException(ParametersException::$error1000, 'financial_cycle');
            }
            $financialCycleRange = PushDevicesPeer::getFinancialCycles();
            if (!array_key_exists($this->post['financial_cycle'], $financialCycleRange)) {
                throw new ParametersException(ParametersException::$error1002, 'financial_cycle');
            }
            if ($this->post['development'] && !in_array($this->post['development'], array(PushDevicesPeer::DEVELOPMENT_SANDBOX, PushDevicesPeer::DEVELOPMENT_PRODUCTION))) {
                throw new ParametersException(ParametersException::$error1002, 'development');
            }
        }
        $models = PushDevicesPeer::getDeviceModels();
        if (!in_array($this->post['device_model'], $models)) {
            throw new ParametersException(ParametersException::$error1002, sprintf('Device model only be in %s', implode(',', $models)));
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

            if (is_string($this->post['subscribe'])) {
                $subscribe = PushDevicesPeer::setUnRegisterDeviceByToken($this->post['subscribe']);
            }
            if (is_numeric($this->post['subscribe'])) {
                $subscribe = PushDevicesPeer::setUnRegisterDeviceById($this->post['subscribe']);    
            }
            
            if (is_null($subscribe)) {
                throw new ObjectsException(ObjectsException::$error2000, $this->post['subscribe']);
            }

            $this->responseData = array('status' => 1, 'subscribes' => array('subscribe_id' => $subscribe->getId()));

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }




    /**
     * Un-subscribe 
     *
     * @return void
     *
     * @issue 2660
     */
    public function executeActivation() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateUnSubscribe();

            if (is_string($this->post['subscribe'])) {
                $subscribe = PushDevicesPeer::setRegisterDeviceByToken($this->post['subscribe']);
            }
            if (is_numeric($this->post['subscribe'])) {
                $subscribe = PushDevicesPeer::setRegisterDeviceById($this->post['subscribe']);    
            }
            
            if (is_null($subscribe)) {
                throw new ObjectsException(ObjectsException::$error2000, $this->post['subscribe']);
            }

            $this->responseData = array('status' => 1, 'subscribes' => array('subscribe_id' => $subscribe->getId()));

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }


    /**
     * Validate un-subscribe
     *
     * @return void
     *
     * @issue 2660
     */
    private function _validateUnSubscribe() {
        if (empty($this->post['subscribe'])) {
            throw new ParametersException(ParametersException::$error1000, 'subscribe');
        }
    }

  
}
