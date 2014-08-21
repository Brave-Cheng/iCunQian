<?php 

/**
 * @package apps\backend\lib
 */

/**
 * Financial product parameters validation class
 * @author brave <brave.cheng@expacta.com.cn>
 */

class ProductValidation
{

    protected $production = 'Product ';
    /**
     * Check whether the parameter is set
     *
     * @param mixed $parameter paramster string
     *
     * @return boolean 
     *
     * @issue 2579
     */
    public function hasParameter($parameter) {
        return isset($parameter) && !empty($parameter);
    }

    /**
     * Whether parameter is a positive integer
     *
     * @param mixed $parameter paramster string
     *
     * @return boolean 
     *
     * @issue 2579
     */
    public function hasPositiveInteger($parameter) {
        return intval($parameter) >= 0;
    }

    /**
     * Check whether string is integer
     *
     * @param string $var      checked string
     * @param string $position position string
     *
     * @return void
     *
     * @issue 2579
     */
    public function integerValidation($var, $position) {
        if ($this->hasParameter($var)) {
            if (!is_numeric($var)) {
                throw new ValidateException($position, ValidateException::$error2000);
            }
            if (!$this->hasPositiveInteger($var)) {
                throw new ValidateException($position, ValidateException::$error2001);
            }
            if (strpos($var, '.')) {
                throw new ValidateException($position, ValidateException::$error2003);
            }
            
            return true;
        }
    }

    /**
     * Check whether string is a float 
     *
     * @param string $var      checked string
     * @param string $position position string
     *
     * @return void
     *
     * @issue 2579
     */
    public function floatValidation($var, $position) {
        if ($this->hasParameter($var)) {
            if (!is_numeric($var)) {
                throw new ValidateException($position, ValidateException::$error2000);
            }
            if (!$this->hasPositiveInteger($var)) {
                throw new ValidateException($position, ValidateException::$error2001);
            }
            return true;
        }
    }


    /**
     * Check whether string is a number 
     *
     * @param string $var      checked string
     * @param string $position position string
     *
     * @return void
     *
     * @issue 2579
     */
    public function numberValidation($var, $position) {
        if ($this->hasParameter($var)) {
            if (!is_numeric($var)) {
                throw new ValidateException($position, ValidateException::$error2000);
            }
            return true;
        }
    }

    /**
     * Check paramter where is in scope
     *
     * @param string $var      checked string
     * @param string $position position string
     *
     * @return void
     *
     * @issue 2579
     */
    public function scopeValidation($var, $position) {
        static $adapters;
        $adapters = Config::getInstance('CrawlConfig')->getAttributeAdapter();
        $scope = array_keys($adapters[$position]);

        if (!in_array($var, $scope)) {
            throw new ValidateException($position, ValidateException::$error2004, array('scope' => implode(',', $scope)));
        }
    }


    /**
     * Date validation
     *
     * @param string $checkedDate date string
     *
     * @return boolean 
     *
     * @issue 2579
     */
    public function hasDate($checkedDate) {
        $month = $day = $year = null;
        if (strpos($checkedDate, '-')) {
            list($year, $month, $day) = explode('-', $checkedDate);    
        } 
        if (strpos($checkedDate, '/')) {
            list($year, $month, $day) = explode('/', $checkedDate);
        }
        
        if (!is_numeric($month) || !is_numeric($day) || !is_numeric($year)) {
            return false;
        }

        $mktime = mktime(0, 0, 0, $month, $day, $year);

        if (!isset($month) || !isset($day) || !isset($year)) {
            return false;
        }

        if (checkdate($month, $day, $year) == false && $mktime == false) {
            return false;
        }
        if (strtotime($checkedDate)  === false) {
            return false;
        }

        $checkedDate = date('Y/m/d', strtotime($checkedDate));

        $sfDateValidator = new sfDateValidator();
        $sfDateValidator->initialize(sfContext::getInstance());
        if (!$sfDateValidator->execute($checkedDate, $dateError)) {
            throw new Exception($dateError);

            return false;
        }
        return true;
    }

    /**
     * Check date parameter where is right
     *
     * @param string $var             checked string
     * @param string $position        position string
     * @param string $compare         compare date string
     * @param string $comparePosition compare position
     * @param string $operator        compare operator
     *
     * @return void
     *
     * @issue 2579
     */
    public function dateValidation($var, $position, $compare = '', $comparePosition = '', $operator = '') {
        $this->trimValidation($var, $position);

        if (!$this->hasDate($var)) {
            throw new ValidateException($position, ValidateException::$error2006);
        }
        
        if ($compare && $operator) {
            if (!$this->hasDate($compare)) {
                throw new ValidateException($comparePosition, ValidateException::$error2006);
            }
            $string = $this->getLanguageString($comparePosition);

            switch ($operator) {
                case '>=':
                    if (strtotime($var) >= strtotime($compare)) {
                        throw new ValidateException($comparePosition, ValidateException::$error2007, array('scope' => util::getMultiMessage($this->getLanguageString($position))));
                    }
                    break;
                
                case '<=':
                    if (strtotime($var) <= strtotime($compare)) {
                        throw new ValidateException($position, ValidateException::$error2007, array('scope' => util::getMultiMessage($this->getLanguageString($comparePosition))));
                    }
                    break;

            }
        }
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
     * Check where string is empty
     *
     * @param string $var      checked string
     * @param string $position position string
     *
     * @return void
     *
     * @issue 2579
     */
    public function trimValidation($var, $position) {
        if (trim($var) == '' || is_null($var)) {
            throw new ValidateException($position, ValidateException::$error2005);
        }
    }

    /**
     * Check where string is decimal 
     *
     * @param string $var      checked string
     * @param string $position position string
     *
     * @return void
     *
     * @issue 2579
     */
    public function decimalValidation($var, $position) {
        $this->floatValidation($var, $position);
        if (strpos($var, '.')) {
            $string = explode('.', $var);
            if (strlen($string[1]) > 4) {
                throw new ValidateException($position, ValidateException::$error2008);
            }
            if (strlen($string[0]) > 6) {
                throw new ValidateException($position, ValidateException::$error2009);
            }
        } else {
            if (strlen($var) > 6) {
                throw new ValidateException($position, ValidateException::$error2009);
            }
        }
    }

       

}