<?php

/**
 * @package lib\Push
 */

/**
 * Constants used in Push service communication.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
abstract class Constants
{

    /**
     * timezone identifier
     */
    public static $timezoneIndentifer = 'Asia/Chongqing';

    /**
     * Sets which PHP errors are reported
     */
    public static $errorReporting = -1;

    /**
     * Sugguest the file mode is 644
     */
    public static $filePermissions = 644;
}

