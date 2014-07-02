<?php

/**
 * @package lib\Push
 */

/**
 * Abstract message class.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
abstract class Message
{
    /**
     * payload custom perperty
     */
    public $customProperty = array();

    /**
     * Recipients device tokens
     */
    public $devices = array(); 

    /**
     * Add a key/value pair to payload custom property,
     *
     * @param string $key   $key
     * @param string $value $value
     *
     * @issue 2589
     * @return null
     */
    public function addCustomPropery($key, $value = null) {
        if (is_array($key)) {
            $this->setCustomProperty($key);
        } else {
            if ($key == ApnsConstants::$appleReservedNamespace) {
                throw new PushException(sprintf('Property %s can not be used to custom property', $key));
            }
            $this->customProperty[$key] = $value;
        }
        
    }

    /**
     * Sets the custom property
     *
     * @param array $property custom property
     *
     * @return null
     * 
     * @issue 2599
     */
    public function setCustomProperty($property = array()) {
        $this->customProperty = array_merge($this->customProperty, $property); 
    }   

    /**
     * Get the custom property, return the specified value if key exists 
     *
     * @param string $key custom property name.
     * 
     * @issue 2589
     * @return mixed
     */
    public function getCustomProperty($key = null) {
        if ($key) {
            if (!array_key_exists($key, $this->customProperty)) {
                throw new PushException(sprintf('No property exists with the specified name %s', $key));
            }
            return $this->customProperty[$key];    
        }
        return $this->customProperty;
    }

    /**
     * Set the devices
     *
     * @param array $devices devices
     *
     * @issue 2589
     * @return null
     */
    public function setDevices($devices = array()) {
        $this->devices = $devices;
    } 

    /**
     * Get the devices
     *
     * @param boolean $individual true is getting the individual device
     * 
     * @issue 2589
     * @return mixed devices
     */
    public function getDevices($individual = false) {
        if (empty($this->devices)) {
            throw new PushException(sprintf("There is not exists device to push!"));
        }
        if ($individual) {
            return array_shift($this->devices);
        }
        return $this->devices;
    }

    /**
     * Push a device to devices
     *
     * @param string $device device
     *
     * @issue 2589
     * @return null;
     */
    public function addDevices($device) {
        array_push($this->devices, $device);
    }


}
