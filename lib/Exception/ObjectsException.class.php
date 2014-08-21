<?php

/**
 * @package apps\api\lib\Exception
 */


class ObjectsException extends Exception
{

    public static $error2000 = '2000';
    public static $error2001 = '2001';
    public static $error2002 = '2002';
    public static $error2003 = '2003';
    public static $error2004 = '2004';
    public static $error2005 = '2005';

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
            self::$error2000 => util::getMultiMessage('The requested object does not exist.'),
            self::$error2001 => util::getMultiMessage('Object property value validation fails.'),
            self::$error2002 => util::getMultiMessage('File object does not exist.'),
            self::$error2003 => util::getMultiMessage('The item is repeat.'),
            self::$error2004 => util::getMultiMessage('Object is not active.'),
            self::$error2005 => util::getMultiMessage('The password hash is invalid.'),
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