<?php

/**
 * @package apps\api\modules\Bank
 */

/**
 * Bank actions.
 *
 * @subpackage Bank
 * @author     brave <brave.cheng@expacta.com.cn>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BankActions extends baseApiActions
{
    protected $gzip = false;
    protected $since = null;
    protected $responseData = null;
    protected $limit = 100;
    /**
     * pre execute action
     *
     * @issue 2568
     * @return null
     */
    public function preExecute() {
        parent::preExecute();
        $this->setTemplate('json');
    }

    /**
     * execute banks action
     *
     * @issue 2568
     * @return null
     */
    public function executeBanks() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $this->httpCode = apiUtil::CODE_BAD_REQUEST;
        $responseData = array();
        $this->commonGetParameters();
        $this->httpCode = apiUtil::CODE_SUCCESSFUL;
        try {
            $banks = DepositBankPeer::fetchBank($this->since, $this->limit);
            $lastBanks = end($banks['list']);
            $responseData['total_banks_returned'] = count($banks['list']);
            $responseData['since'] = strtotime($lastBanks['update_at']);
            $responseData['total_banks'] = $banks['total'];
            $responseData['banks'] = $banks['list'];

        } catch (Exception $e) {
            $responseData['error_msg'] = $e->getMessage();
        }
        $this->responseData = $responseData;
    }
}
