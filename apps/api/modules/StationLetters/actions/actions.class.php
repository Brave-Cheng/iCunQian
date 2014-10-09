<?php

/**
 * @package apps\api\modules\StationLetters
 */

/**
 * StationLetters actions.
 *
 * @package    apps
 * @subpackage StationLetters
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class StationLettersActions extends baseApiActions
{
    /**
     * execute before the action
     *
     * @return void
     *
     * @issue 2713
     */
    public function preExecute() {
        parent::preExecute();
        $this->setTemplate('json');
    }

    /**
     * execute RetrieveStationLettersByUser
     *
     * @return void
     *
     * @issue 2713
     */
    public function executeRetrieveStationLettersByUser() {
        if ($this->getRequest()->getMethod() != sfRequest::GET) {
            $this->forward('default', 'error400');
        }
        $accountId = $this->getRequestParameter('account_id');
        $hash = $this->getRequestParameter('hash');
        $limit = $this->getRequestParameter('limit') ? intval($this->getRequestParameter('limit')) : 100;
        $since = $this->getRequestParameter('since') ? intval($this->getRequestParameter('since')) : null;
        try {
            if (empty($accountId)
                || empty($hash)) {
                throw new ParametersException(ParametersException::$error1000, 'account_id, hash');
            }
            DepositMembersPeer::verfiyMember($accountId, $hash);

            $rs = DepositMembersStationNewsPeer::getLettersByAccount(
                $accountId,
                $since,
                $limit
            );

            $lastLetters = end($rs['list']);
            $responseData['status'] = 1;
            $responseData['total_letters_returned'] = count($rs['list']);
            $responseData['since'] = strtotime($lastLetters['updated_at']);
            $responseData['total_letters'] = $rs['total'];
            $responseData['letters'] = $rs['list'];
            
            $this->responseData = $responseData;
        } catch (Exception $e) {
            $this->setResponseError($e);
        }

    }

    /**
     * execute SetStationLettersRead
     *
     * @return void
     *
     * @issue 2713
     */
    public function executeSetStationLettersRead() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) {
            apiLog::logMessage("PARAMETERS ERROR: The parameters can not be decode.");
            $this->forward('default', 'error403');
        }
        try {
            $this->validateAccount();
            $rs = DepositMembersStationNewsPeer::makeLetterRead($this->post['letter_id']);
            $this->responseData = array('status' => 1, 'letter_id' => $rs->getId());
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }

    /**
     * Execute BatchSetStationLetters action
     *
     * @return void
     *
     * @issue 2713
     */
    public function executeBatchSetStationLetters() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
            
        if (is_null($this->post)) {
            apiLog::logMessage("PARAMETERS ERROR: The parameters can not be decode.");
            $this->forward('default', 'error403');
        }
        try {
            $this->validateAccount();

            if ($this->post['secret'] != md5(json_encode($this->post['letters']))) {
                throw new ParametersException(ParametersException::$error1001, 'secret');
            }

            foreach ($this->post['letters'] as $letters) {
                try {
                    $rs = DepositMembersStationNewsPeer::makeLetterRead($letters['letter_id'], $letters['status']);
                } catch (Exception $e) {

                }
            }

            $this->responseData = array('status' => 1);

        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }
}
