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
        try {
            if (is_null($this->post)) {
                $this->forward('default', 'error403');
            }
            
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
                $this->post['subscribe_id']
            );
            $this->responseData = $subscribe;
        } catch (Exception $e) {
            $this->responseData = array('error_msg' => $e->getMessage());
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
                throw new Exception('Missing app name.');
            }
            if (empty($this->post['device_token'])) {
                throw new Exception('Missing device token.');
            }
            if (empty($this->post['device_model'])) {
                throw new Exception('Missing device model.');
            }
            if (empty($this->post['device_name'])) {
                throw new Exception('Missing device name.');
            }

            if (empty($this->post['profit_type'])) {
                throw new Exception('Missing profit type.');
            }
            if (empty($this->post['expected_yield'])) {
                throw new Exception('Missing expected yield.');
            }
            if (empty($this->post['financial_cycle'])) {
                throw new Exception('Missing financial cycle.');
            }
        }
        $models = PushDevicesPeer::getDeviceModels();
        if (!in_array($this->post['device_model'], $models)) {
            throw new Exception(sprintf('Device model only be in %s', implode(',', $models)));
        }
    }

  
}
