<?php

/**
 * @package lib\Push
 */

/**
 * The Log Interface.
 *
 * Implement the Log Interface and pass the object instance to all
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
interface LogInterface {

    /**
     * Logs a message.
     *
     * @param  $sMessage @type string The message.
     */
    public function log($sMessage);
}

