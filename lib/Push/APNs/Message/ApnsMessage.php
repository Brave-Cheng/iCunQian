<?php

/**
 * @package lib\Push\APNs\Message
 */

/**
 * The Push Notification Custom Message
 *
 * Sets All APNs message propertys
 * @author brave <brave.cheng@expacta.com.cn>
 */
class ApnsMessage extends Message
{
    /**
     * If the JSON payload is longer than maximum allowed size, shorts message text.
     */
    private $_autoAdjustLongPayload = true;

    /**
     * Alert message to display to the user
     */
    private $_pushText;

    /**
     * Number to badge the application icon with
     */
    private $_pushBadge;

    /**
     * Sound to play
     */
    private $_pushSound;

    /**
     * That message will expire in 604800 seconds (86400 * 7, 7 days) if not successful delivered.
     */
    private $_expiry;

    /**
     * Custom message identifier
     */
    private $_customIdentifier;

    /**
     * True to initiates the Newsstand background download. 
     * @see http://tinyurl.com/ApplePushNotificationNewsstand
     */
    private $_contentAvailable;

    /**
     * The "View" button title
     */
    private $_actionLocKey;

    /**
     * A key to an alert-message string in a Localizable.strings file
     */
    private $_locKey;

    /**
     * Variable string values to appear in place of the format specifiers in loc-key.
     */
    private $_locArgs;

    /**
     * The filename of an image file in the application bundle.
     */
    private $_launchImage;

    /**
     * Set the auto-adjust long payload value.
     * 
     * @param boolean $autoAjust If true a long payload is shorted cutting long text value.
     *
     * @issue 2589
     * @return null
     */
    public function setAutoAdjustLongPayload($autoAjust) {
        $this->_autoAdjustLongPayload = (boolean) $autoAjust;
    }

    /**
     * Get the auto-adjust long payload value.
     *
     * @issue 2589
     * @return boolean The auto-adjust long payload value.
     */
    public function getAutoAdjustLongPayload() {
        return $this->_autoAdjustLongPayload;
    }

    /**
     * Set the alert message to display to the user.
     * 
     * @param string $text An alert message to display to the user.
     *
     * @issue 2589
     * @return null
     */
    public function setPushText($text) {
        $this->_pushText = $text;
    }

    /**
     * Get the alert message to display to the user. 
     *
     * @issue 2589
     * @return string An alert message to display to the user.
     */
    public function getPushText() {
        if ($this->getAutoAdjustLongPayload()) {
            $textLength = strlen($this->_pushText);

            if ($textLength > 0) {
                $this->_pushText =  mb_substr($this->_pushText, 0, ApnsConstants::$payloadMaximumSize, 'UTF-8');
            } else {
                throw new Exception(sprintf('JSON Payload is too long: %s bytes. Maximum size is %s bytes. The message text can not be auto-adjusted.', $jsonPayloadLength, ApnsConstants::$payloadMaximumSize));
            }   
        } else {
            throw new PushException(sprintf('JSON Payload is too long: %s bytes. Maximum size is %s', $jsonPayloadLength, ApnsConstants::$payloadMaximumSize));
        }
        return $this->_pushText;
    }

    /**
     * Set the number to badge the application icon with.
     * 
     * @param int $badge A number to badge the application icon with.
     *
     * @issue 2589
     * @return null
     */
    public function setPushBadge($badge) {
        $this->_pushBadge = (int) $badge;
    }

    /**
     * Get the number to badge the application icon with.
     * 
     * @issue 2589
     * @return int the number to badge the application icon with
     */
    public function getPushBadge() {
        return $this->_pushBadge;
    }

    /**
     * Set the sound to play.
     * 
     * @param string $sound the sound name
     *
     * @issue 2589
     * @return null
     */
    public function setPushSound($sound = 'default') {
        $this->_pushSound = $sound;
    } 

    /**
     * Get the sound to play
     *
     * @issue 2589
     * @return string the sound to play
     */
    public function getPushSound() {
        return $this->_pushSound;
    }

    /**
     * Initiates the Newsstand background download.
     * 
     * @param boolean $contentAvailable True to initiates the Newsstand background download.
     *
     * @issue 2589
     * @return null
     */
    public function setContentAvailable($contentAvailable = true) {
        $this->_contentAvailable = (boolean) $contentAvailable;
    }

    /**
     * Get if should initiates the Newsstand background download.
     *
     * @issue 2589
     * @return boolean Initiates the Newsstand background download property.
     */
    public function getContentAvailable() {
        return $this->_contentAvailable;
    }

    /**
     * Set the expiry value.
     * 
     * @param int $expiry This message will expire in N seconds. if not successful delivered.
     *
     * @issue 2589
     * @return null
     */
    public function setExpiry($expiry) {
        $this->_expiry = $expiry;
    }

    /**
     * Get the expiry value
     *
     * @issue 2589
     * @return int The expire message value (in seconds).
     */
    public function getExpiry() {
        return $this->_expiry;
    }


    /**
     * Set the custom message identifier.
     *
     * The custom message identifier is useful to associate a push notification
     * to a DB record or an User entry for example. The custom message identifier
     * can be retrieved in case of error using the getCustomIdentifier()
     * method of an entry retrieved by the getErrors() method.
     * This custom identifier, if present, is also used in all status message by
     * the ApnsPHP_Push class.
     *
     * @param stirng $mCustomIdentifier mixed The custom message identifier.
     *
     * @issue 2589
     * @return null
     */
    public function setCustomIdentifier($mCustomIdentifier) {
        $this->_customIdentifier = $mCustomIdentifier;
    }

    /**
     * Get the custom message identifier.
     *
     * @issue 2589
     * @return mixed The custom message identifier.
     */
    public function getCustomIdentifier() {
        return $this->_customIdentifier;
    }

    /**
     * Set the "View" button title.
     *
     * If a string is specified, displays an alert with two buttons.
     * iOS uses the string as a key to get a localized string in the current localization
     * to use for the right button’s title instead of "View". If the value is an
     * empty string, the system displays an alert with a single OK button that simply
     * dismisses the alert when tapped.
     * 
     * @param string $actionLocKey The "View" button title, default empty string
     *
     * @issue 2589
     * @return null
     */
    public function setActionLocKey($actionLocKey) {
        $this->_actionLocKey = $actionLocKey;
    }

    /**
     * Get the "View" button title.
     *
     * @issue 2589
     * @return string The "View" button title.
     */
    public function getActionLocKey() {
        return $this->_actionLocKey;
    }

    /**
     * Set the alert-message string in Localizable.strings file for the current
     * localization (which is set by the user’s language preference).
     *
     * The key string can be formatted with %@ and %n$@ specifiers to take the variables
     * specified in loc-args.
     * 
     * @param string $locKey The alert-message string.
     *
     * @issue 2589
     * @return null
     */
    public function setLocKey($locKey) {
        $this->_locKey = $locKey;
    }

    /**
     * Get the alert-message string.
     *
     * @issue 2589
     * @return string
     */
    public function getLocKey() {
        return $this->_locKey;
    }

    /**
     * Set the variable string values to appear in place of the format specifiers
     * in loc-key.
     * 
     * @param array $locArgs The variable string values.
     *
     * @issue 2589
     * @return null
     */
    public function setLocArgs($locArgs) {
        $this->_locArgs = $locArgs;
    }

    /**
     * Get the variable string values.
     *
     * @issue 2589
     * @return string
     */
    public function getLocArgs() {
        return $this->_locArgs;
    }

    /**
     * Set the filename of an image file in the application bundle; it may include
     * the extension or omit it.
     *
     * The image is used as the launch image when users tap the action button or
     * move the action slider. If this property is not specified, the system either
     * uses the previous snapshot, uses the image identified by the UILaunchImageFile
     * key in the application’s Info.plist file, or falls back to Default.png.
     * This property was added in iOS 4.0.
     * 
     * @param string $launchImage The filename of an image file.
     *
     * @issue 2589
     * @return null
     */
    public function setLaunchImage($launchImage) {
        $this->_launchImage = $launchImage;
    } 

    /**
     * Get the filename of an image file.
     *
     * @issue 2589
     * @return The filename of an image file.
     */
    public function getLaunchImage() {
        return $this->_launchImage;
    } 

    /**
     * Get the payload dictionary.
     *
     * @issue 2589
     * @return array The payload dictionary.
     */
    public function getPayloadDirectory() {
        $payload[ApnsConstants::$appleReservedNamespace] = array();
        $payload = $this->getPayloadAlertDirectory();

        if ($this->getPushText()) {
            $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadAlertIdentifier] = (string) $this->getPushText();
        }
        if ($this->getPushSound()) {
            $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadSoundIdentifier] = (string) $this->getPushSound();
        }

        if ($this->getPushBadge() && $this->getPushBadge() > 0) {
            $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadBadgeIdentifier] = (int) $this->getPushBadge();
        }

        if ($this->getContentAvailable()) {
            $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadContentAvailableIdentifiter] = $this->getContentAvailable();
        }

        if ($this->getCustomProperty()) {
            foreach ($this->getCustomProperty() as $key => $value) {
                $payload[$key] = $value;
            }
        }
        return $payload;
    }

    /**
     * Get the alert payload 
     *
     * @issue 2589
     * @return array
     */
    public function getPayloadAlertDirectory() {
        $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadAlertIdentifier] = array();
        if ($this->getPushText()) {
            if ($this->getLockey()) {
                $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadAlertIdentifier][ApnsConstants::$payloadLocKeyIdentifier] = $this->getLockey();
            } else {
                $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadAlertIdentifier][ApnsConstants::$payloadBodyIdentifier] = $this->getPushText();
            }

            if ($this->getLocArgs()) {
                $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadAlertIdentifier][ApnsConstants::$payloadLocArgsIdentifier] = $this->getLocArgs();
            }

            if ($this->getActionLocKey()) {
                $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadAlertIdentifier][ApnsConstants::$payloadActionLocKeyIdentifier] = $this->getActionLocKey();
            }

            if ($this->getLaunchImage()) {
                $payload[ApnsConstants::$appleReservedNamespace][ApnsConstants::$payloadAlertIdentifier][ApnsConstants::$payloadLaunchImageIdentifier] = $this->getLaunchImage();
            }
        } else {
            throw new PushException('Missing alter message.');
        }
        return $payload;
    }

    /**
     * Convert the message in a JSON-encoded payload.
     *
     * @issue 2589
     * @return string JSON-encoded payload.
     */
    public function getJsonPayload() {
        $payloadDirectory = array_filter($this->getPayloadDirectory());
        if (empty($payloadDirectory)) {
            throw new PushException(sprintf('Current payload %s can not be empty!', $payloadDirectory));
        }
        
        $jsonPayload = $this->_jsonEncode($this->getPayloadDirectory());

        return $jsonPayload; 
    }


    /**
     * JSON Encode
     *
     * Some servers do not have json_encode, so use this instead.
     *
     * @param array $array Data to convert to JSON string.
     *
     * @issue 2589
     * @return string
     */
    private function _jsonEncode($array = false){
        //Using json_encode if exists
        if (function_exists('json_encode')) {
            return json_encode($array);
        }
        if (is_null($array)) return 'null';
        if ($array === false) return 'false';
        if ($array === true) return 'true';
        if (is_scalar($array)) {
            if (is_float($array)) {
                return floatval(str_replace(",", ".", strval($array)));
            }
            if (is_string($array)) {
                static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $array) . '"';
            } else {
                return $array;
            }
        }
        $isList = true;
        for ($i=0, reset($array); $i<count($array); $i++, next($array)) {
            if (key($array) !== $i) {
                $isList = false;
                break;
            }
        }
        $result = array();
        if ($isList) {
            foreach($array as $v) $result[] = $this->_jsonEncode($v);
            return '[' . join(',', $result) . ']';
        } else {
            foreach ($array as $k => $v) $result[] = $this->_jsonEncode($k).':'.$this->_jsonEncode($v);
            return '{' . join(',', $result) . '}';
        }
    }


    /**
     * PHP Magic Method. When an object is "converted" to a string, JSON-encoded
     * payload is returned.
     *
     * @issue 2589
     * @return string JSON-encoded payload.
     */
    public function __toString() {
        try {
            return $this->getJsonPayload();
        } catch (Exception $e) {
            return;
        }
    }

}       