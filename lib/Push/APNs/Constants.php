<?php

/**
 * @package lib\Push
 */

/**
 * Constants used in APNs service communication.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class ApnsConstants extends Constants {
    
    /**
     *  Production environment
     */
    public static $ENVIRONMENT_PRODUCTION = 'production';
    
    /**
     *  Sandbox environment
     */
    public static $ENVIRONMENT_SANDBOX = 'sandbox';
    
    /**
     * Apples Production APNS Gateway
     */
    public static $PRODUCTION_SSL = 'ssl://gateway.push.apple.com:2195';
    
    /**
     * Apples Production APNs Feedback Service Gateway
     */
    public static $PRODUCTION_FEEDBACK_SSL = 'ssl://feedback.push.apple.com:2196';
    
    /**
     * Absolute path to your Production Certificate
     */
    public static $PRODUCTION_CERTIFICATE = 'd:\usr\local\apns\production.pem';
    
    /**
     * Apples Production Certificate Passphrase
     */
    public static $PRODUCTION_PASSPHRASE = '';
    
    /**
     * Apples Production APNs Feedback Service Gateway
     */
    public static $SANDBOX_SSL = 'ssl://gateway.sandbox.push.apple.com:2195';
    
    /**
     * Apples Sandbox APNS Feedback Service Gateway
     */
    public static $SANDBOX_FEEDBACK_SSL = 'ssl://feedback.sandbox.push.apple.com:2196';
    
    /**
     * Absolute path to your Development Certificate
     */
    public static $SANDBOX_CERTIFICATE = 'd:\usr\local\apns\icunqian_dev.pem';
    
    /**
     * Apples Sandbox Certificate Passphrase
     */
    public static $SANDBOX_PASSPHRASE = '';
    
    
    
}

