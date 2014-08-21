<?php

/**
 * @package apps\api\lib\Exception
 */


class OtherException extends Exception
{

    public static $error3000 = '2000';

    /**
     * Constructs the Exception.
     *
     * @param integer $code     The Exception code.
     * @param string  $message  The Exception message to throw.
     * @param object  $previous The previous exception used for the exception chaining.
     *
     * @issue 2646
     */
    public function __construct($code, $message = '', $previous = null) {
        
        $tempMessage = '';

        $codeMessage = $this->getCodeMessage($code);    

        if ($codeMessage) {
            if ($message) {
                $tempMessage = sprintf('%s (%s)', $codeMessage, $message);
            } else {
                $tempMessage = $codeMessage;
            }
        }
        if (version_compare(phpversion(), '5.3.0', '<')) {
            parent::__construct($tempMessage, $code);
        } else {
            parent::__construct($tempMessage, $code, $previous);    
        }
    }

    /**
     * Get parameters haystack
     *
     * @return array
     *
     * @issue 2646
     */
    protected function getMessageHaystack() {
        return array(
            self::$error3000 => '该数据已经存在！',
        );
    }

    /**
     * Get error message
     *
     * @param int $code Exception code
     *
     * @return string Exception message
     *
     * @issue 2646
     */
    public function getCodeMessage($code) {
        $search = $this->getMessageHaystack();
        if (array_key_exists($code, $search)) {
            return $search[$code];
        }
        return;
    }
}