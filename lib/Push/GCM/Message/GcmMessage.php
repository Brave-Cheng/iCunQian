<?php

/**
 * @package lib\Push\GCM\Message
 */

/**
 * GCM Message class.
 *
 * Sets All GCM message propertys
 * @author brave <brave.cheng@expacta.com.cn>
 */
class GcmMessage extends Message
{

    private $_collapseKey;
    private $_delayWhileIdle;
    private $_dryRun;
    private $_timeToLive;
    private $_restrictedPackageName;

    /**
     * construct 
     * 
     * @param array   $data                  data
     * @param string  $collapseKey           collapseKey
     * @param boolean $delayWhileIdle        delayWhileIdle
     * @param boolean $dryRun                dryRun
     * @param integer $timeToLive            timeToLive
     * @param string  $restrictedPackageName restrictedPackageName
     *
     * @issue 2589
     * @return null
     */
    public function __construct($data = array(), $collapseKey = '', $delayWhileIdle = false, $dryRun = false, $timeToLive = -1, $restrictedPackageName = '') {
        $this->data = $data;
        $this->_collapseKey = $collapseKey;
        $this->_delayWhileIdle = $delayWhileIdle;
        $this->_dryRun = $dryRun;
        $this->_timeToLive = $timeToLive;
        $this->_restrictedPackageName = $restrictedPackageName;
    }

    /**
     * Sets the collapseKey property.
     *
     * @param string $collapseKey collapseKey property
     *
     * @issue 2589
     * @return null
     */
    public function setCollapseKey($collapseKey) {
        $this->_collapseKey = $collapseKey;
    }

    /**
     * Gets the collapseKey property
     *
     * @issue 2589
     * @return string
     */
    public function getCollapseKey() {
        return $this->_collapseKey;
    }

    /**
     * Sets the delayWhileIdle property (default value is {false}).
     *
     * @param boolean $delayWhileIdle delayWhileIdle property
     *
     * @issue 2589
     * @return null
     */
    public function setDelayWhileIdle($delayWhileIdle) {
        $this->_delayWhileIdle = $delayWhileIdle;
    }

    /**
     * Gets the delayWhileIdle property
     *
     * @issue 2589
     * @return delayWhileIdle
     */
    public function getDelayWhileIdle() {
        return $this->_delayWhileIdle;
    }

    /**
     * Sets the dryRun property (default value is {false}).
     *
     * @param boolean $dryRun dryRun property
     *
     * @issue 2589
     * @return null
     */
    public function setDryRun($dryRun) {
        $this->_dryRun = $dryRun;
    }

    /**
     * Gets the dryRun property
     *
     * @issue 2589
     * @return boolean
     */
    public function getDryRun() {
        return $this->_dryRun;
    }

    /**
     * Sets the time to live, in seconds.
     *
     * @param int $timeToLive seconds
     *
     * @issue 2589
     * @return null
     */
    public function setTimeToLive($timeToLive) {
        $this->_timeToLive = $timeToLive;
    }

    /**
     * Gets the time to live property
     *
     * @issue 2589
     * @return int
     */
    public function getTimeToLive() {
        return $this->_timeToLive;
    }

    /**
     * Sets the restrictedPackageName property.
     *
     * @param string $restrictedPackageName restricted package name
     *
     * @issue 2589
     * @return null
     */
    public function setTestrictedPackageName($restrictedPackageName) {
        $this->_restrictedPackageName = $restrictedPackageName;
    }

    /**
     * Get the restrictedPackageName property
     *
     * @issue 2589
     * @return string
     */
    public function getRestrictedPackageName() {
        return $this->_restrictedPackageName;
    }

    /**
     * Get individual payload
     *
     * @issue 2589
     * @return string payload
     */
    public function getIndividualPayload() {
        try {
            $body = GcmConstants::$paramRegistrationId . '='  . $this->getDevices(true);            
            $delayWhileIdle = $this->getDelayWhileIdle();
            if (!is_null($delayWhileIdle)) {
                $body .= GcmConstants::$paramUrlSymbol . GcmConstants::$paramDelayWhileIdle . '=' . ($delayWhileIdle ? '1' : '0');
            }
            $collapseKey = $this->getCollapseKey();
            if (!is_null($collapseKey)) {
                $body .= GcmConstants::$paramUrlSymbol . GcmConstants::$paramCollapseKey . '=' .$collapseKey;
            }
            $timeToLive = $this->getTimeToLive();
            if (!is_null($timeToLive)) {
                $body .= GcmConstants::$paramUrlSymbol . GcmConstants::$paramTimeToLive . '=' . $timeToLive;
            }
            if (($others = $this->getCustomProperty())) {
                foreach ($others as $key => $value) {
                    $body .= GcmConstants::$paramUrlSymbol . GcmConstants::$paramPayloadPrefix . $key . '=' . $value;        
                }
            }
            return $body;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get multicast payload
     *
     * @issue 2589
     * @return string payload
     */
    public function getMulticastPayload() {
        try {
            $request = array();

            $delayWhileIdle = $this->getDelayWhileIdle();
            if (!is_null($delayWhileIdle)) {
                $request[GcmConstants::$paramDelayWhileIdle] = $delayWhileIdle;
            }
            $collapseKey = $this->getCollapseKey();
            if (!is_null($collapseKey)) {
                $request[GcmConstants::$paramCollapseKey] = $collapseKey;
            }
            $timeToLive = $this->getTimeToLive();
            if (!is_null($timeToLive)) {
                $request[GcmConstants::$paramTimeToLive] = $timeToLive;
            }
            $request[GcmConstants::$jsonRegistrationIds] = $this->getDevices();
            if (($others = $this->getCustomProperty())) {
                $request[GcmConstants::$jsonPayload] = $others;
            }
            return json_encode($request);
        } catch (Exception $e) {
            throw $e;
        }
    }


}
