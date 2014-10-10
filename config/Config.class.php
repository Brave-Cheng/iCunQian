<?php

/**
 * @package config
 */

/**
 * auto
 *
 * 
 * @author brave <brave.cheng@expacta.com.cn>
 */
class Config
{

    /**
     * create object instance
     * 
     * @param string $name class name
     * 
     * @return object
     * 
     * @throws Exception
     *
     * @issue 2763
     */
    static public function getInstance($name) {
        if (!class_exists($name, true)) {
            throw new Exception("Class " . $name . " does not exist");
        }

        $localClassName = $name . "Local";
        if (class_exists($localClassName, true)) {
            return new $localClassName();
        }

        $develClassName = $name . "Devel";
        if (class_exists($develClassName, true)) {
            return new $develClassName();
        }

        return new $name();
    }

}