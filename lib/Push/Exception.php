<?php

/**
 * @package lib\Push
 */

/**
 * Exception class.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class PushException extends Exception
{

    /**
     * Get error message
     *
     * @issue 2589
     * @return string
     */
    public function errorMessage() {
        //error message
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b>';
        return $errorMsg;
    }
}
