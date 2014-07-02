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
interface LogInterface
{

    /**
     * Logs a message.
     *
     * @param string $sMessage type string The message.
     *
     * @issue 2589
     * @return null
     */
    public function log($sMessage);
}

