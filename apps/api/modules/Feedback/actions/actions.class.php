<?php

/**
 * @package api\modules\Feedback\actions
 */

/**
 * Feedback actions.
 *
 * @package    apps
 * @subpackage Feedback
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class FeedbackActions extends baseApiActions
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
     * Create feedback
     *
     * @return void
     *
     * @issue 2642
     */
    public function executeCreateFeedback() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward('default', 'error400');
        }
        if (is_null($this->post)) { 
            $this->forward('default', 'error403');
        }
        try {
            $this->_validateCreateFeedback();
            $rs = DepositFeedbackPeer::createFeedback(
                $this->post['email'],
                $this->post['feedback']
            );

            $this->responseData = array('status' => 1, 'feedback' => array(
                'feedback_id' => $rs->getId(),
            ));
        } catch (Exception $e) {
            $this->setResponseError($e);
        }
    }


    /**
     * Validate create feedback
     *
     * @return void
     *
     * @issue 2642
     */
    private function _validateCreateFeedback() {
        if ( empty($this->post['email'])
            || empty($this->post['feedback'])) {
            throw new ParametersException(ParametersException::$error1000, 'email, feedback');
        }
        if ($this->post['email']) {
            $this->validateEmail($this->post['email']);
        }

        if ($this->post['feedback']) {
            $stringValidator = new sfStringValidator();
            $stringValidator->initialize($this->getContext(), array(
                'min'           => 6,
                'min_error'     => util::getMultiMessage('The feedback is too short. (6 characters miximum)'),
                'max'           => 500,
                'max_error'     => util::getMultiMessage('The feedback is too long. (500 characters maximum)'),
            ));
            if (!$stringValidator->execute($this->post['feedback'], $stringError)) {
                throw new ParametersException(ParametersException::$error1001, $stringError);
            }
        }

    }
}
