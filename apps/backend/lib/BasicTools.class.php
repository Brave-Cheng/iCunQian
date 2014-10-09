<?php 

/**
 * @package apps\backend\lib
 */

class BasicTools
{
    /**
     * validate invest cycle tool
     *
     * @param string $value validate value
     *
     * @return boolean
     *
     * @issue 2579
     */
    public static function validateInvestCycle($value) {
        if (!is_numeric($value)) {
            return false;
        }
        return true;
    }


    /**
     * Trim validation
     * 
     * @param string $value validate value
     *
     * @return boolean
     *
     * @issue 2706
     */
    public static function trimValidation($value) {
        if (trim($value) == '') {
            return false;
        }
        return true;
    }


}