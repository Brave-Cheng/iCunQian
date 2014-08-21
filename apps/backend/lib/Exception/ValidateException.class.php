<?php

/**
 * @package apps\backend\lib\Exception
 */

class ValidateException extends Exception
{

    protected $position;
    protected $production = 'Product ';
    protected $space = ' ';

    protected $extends = array('scope' => '');

    public static $error2000 = '2000';
    public static $error2001 = '2001';
    public static $error2002 = '2002';
    public static $error2003 = '2003';
    public static $error2004 = '2004';
    public static $error2005 = '2005';
    public static $error2006 = '2006';
    public static $error2007 = '2007';
    public static $error2008 = '2008';
    public static $error2009 = '2009';
    public static $error2010 = '2010';

    /**
     * Constructs the Exception.
     *
     * @param string  $position Exception location
     * @param integer $code     The Exception code.
     * @param array   $extends  extends
     * @param string  $message  The Exception message to throw.
     * @param object  $previous The previous exception used for the exception chaining.
     *
     * @issue 2579
     */
    public function __construct($position, $code, $extends = array(), $message = '', $previous = null) {
        $this->position = $position;
        $tempMessage = '';

        if ($extends) {
            $this->extends = $extends;
        }
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
     * Retrieving position 
     *
     * @return string
     *
     * @issue 2579
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Retrieving position 
     *
     * @return string
     *
     * @issue 2579
     */
    public function getFormatPosition() {
        $replace = explode("_", $this->getPosition());
        $turned = array_map('ucfirst', $replace);
        
        if (function_exists('lcfirst')) {
            return lcfirst(implode($turned));    
        } else {
            $string = implode($turned);
            $string{0} = strtolower($string{0});
            return $string;
        }
    }

    /**
     * Get parameters haystack
     *
     * @return array
     *
     * @issue 2579
     */
    protected function getMessageHaystack() {
        $position = $this->getLanguageString($this->getPosition());
        return array(
            self::$error2000 => util::getMultiMessage($position) . $this->space . util::getMultiMessage('Not an integer.'),
            self::$error2001 => util::getMultiMessage($position) . $this->space . util::getMultiMessage('Not a positive integer.'),
            self::$error2002 => util::getMultiMessage($position) . $this->space . util::getMultiMessage('Not a float.'),
            self::$error2003 => util::getMultiMessage($position) . $this->space . util::getMultiMessage('Not support float.'),
            self::$error2004 => util::getMultiMessage($position) . $this->space . sprintf(util::getMultiMessage('Not in scope %s.'), $this->extends['scope']),
            self::$error2005 => util::getMultiMessage($position) . $this->space . util::getMultiMessage('Can not be blank.'),
            self::$error2006 => util::getMultiMessage($position) . $this->space . util::getMultiMessage('Invalid date.'),
            self::$error2007 => util::getMultiMessage($position) . $this->space . sprintf(util::getMultiMessage('Can not greater equal %s.'), $this->extends['scope']),
            self::$error2008 => util::getMultiMessage($position) . $this->space . util::getMultiMessage('Decimal Digits Long.'),
            self::$error2009 => util::getMultiMessage($position) . $this->space . util::getMultiMessage('The maximum allowable 6 digits.'),
        );
    }

    /**
     * Get Language string
     *
     * @param string $string string
     * 
     * @return string
     *
     * @issue 2579
     */
    protected function getLanguageString($string) {
        $replace = explode("_", $string);
        $turned = array_map('ucfirst', $replace);
        return $this->production . implode(' ', $turned);
    }

    /**
     * Get error message
     *
     * @param int $code Exception code
     *
     * @return string Exception message
     *
     * @issue 2579
     */
    public function getCodeMessage($code) {
        $search = $this->getMessageHaystack();
        if (array_key_exists($code, $search)) {
            return $search[$code];
        }
        return;
    }

}