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

    public static $error1010 = '1010';
    public static $error1011 = '1011';
    public static $error1012 = '1012';



    

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
     * Get sms validate code
     *
     * @return array
     *
     * @issue 2715
     */
    public static function getSmsValidateCode() {
        return array(
            self::$error1010,
            self::$error1011,
            self::$error1012
        );
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
            self::$error1010 => util::getMultiMessage('Parameter validation fail.'),
            self::$error1011 => util::getMultiMessage('Parameter validation fail.'),
            self::$error1012 => util::getMultiMessage('Parameter validation fail.'),
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