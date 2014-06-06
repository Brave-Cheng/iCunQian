<?php

/**
 * @package apps\api\modules\default\actions
 */

/**
 * default actions.
 *
 * @author  brave <brave.cheng@expacta.com.cn>
 * @version SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class defaultActions extends baseApiActions
{
    /**
     * Executes this action before filter.
     * 
     * @return null
     */
    public function preExecute() {
        parent::preExecute();
        $this->setTemplate('json');
    }

    /**
     * error 204
     * 
     * @return null
     */
    public function executeError204() {
        apiLog::logMessage("RESPONSE STATUS CODE: 204, No Content");

        $this->httpCode = apiUtil::CODE_NO_CONTENT;
        $this->responseData = array(
            'error_code' => $this->httpCode,
            'error_msg' => 'No Content',
        );
    }

    /**
     * error 400
     * 
     * @return null
     */
    public function executeError400() {
        apiLog::logMessage("RESPONSE STATUS CODE: 400, Bad Request");

        $this->httpCode = apiUtil::CODE_BAD_REQUEST;
        $this->responseData = array(
            'error_code' => $this->httpCode,
            'error_msg' => 'Bad Request',
        );
    }

    /**
     * error 401
     * 
     * @return null
     */
    public function executeError401() {
        apiLog::logMessage("RESPONSE STATUS CODE: 401, Unauthorized");

        $this->httpCode = apiUtil::CODE_UNAUTHORIZED;
        $this->responseData = array(
            'error_code' => $this->httpCode,
            'error_msg' => 'Unauthorized',
        );
    }

    /**
     * error 403
     * 
     * @return null
     */
    public function executeError403() {
        apiLog::logMessage("RESPONSE STATUS CODE: 403, Forbidden");

        $this->httpCode = apiUtil::CODE_FORBIDDEN;
        $this->responseData = array(
            'error_code' => $this->httpCode,
            'error_msg' => 'Forbidden',
        );
    }

    /**
     * error 404
     * 
     * @return null
     */
    public function executeError404() {
        apiLog::logMessage("RESPONSE STATUS CODE: 404, Not Found");
        
        $this->httpCode = apiUtil::CODE_NOT_FOUND;
        $this->responseData = array(
            'error_code' => $this->httpCode,
            'error_msg' => 'Not Found',
        );
    }

    /**
     * error 422
     * 
     * @return null
     */
    public function executeError422() {
        apiLog::logMessage("RESPONSE STATUS CODE: 422, Unprocessable Entity (Please check the request format)");

        $this->httpCode = apiUtil::CODE_UNPROCESSABLE_ENTITY;
        $this->responseData = array(
            'error_code' => $this->httpCode,
            'error_msg' => 'Unprocessable Entity (Please check the request format)',
        );
    }

}
