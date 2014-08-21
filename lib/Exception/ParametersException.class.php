<?php

/**
 * @package apps\api\lib\Exception
 */


class ParametersException extends Exception
{

    public static $error1000 = '1000';
    public static $error1001 = '1001';
    public static $error1002 = '1002';
    public static $error1003 = '1003';
    public static $error1004 = '1004';
    public static $error1005 = '1005';
    public static $error1006 = '1006';
    public static $error1007 = '1007';
    public static $error1008 = '1008';


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
            self::$error1000 => util::getMultiMessage('Request parameter is incorrect.'),
            self::$error1001 => util::getMultiMessage('Parameter validation fail.'),
            self::$error1002 => util::getMultiMessage('Parameter is not in the permissible range.'),
            self::$error1003 => util::getMultiMessage('Upload parameter error.'),
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