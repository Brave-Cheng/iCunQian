<?php

/**
 * @package lib\Push
 */

/**
 * Constants used in APNs service communication.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
final class ApnsConstants extends Constants
{

    /**
     *  Production environment
     */
    public static $environmentProduction = 'production';

    /**
     *  Sandbox environment
     */
    public static $environmentSandbox = 'sandbox';

    /**
     * Apples Production APNS Gateway
     */
    public static $productionSsl = 'ssl://gateway.push.apple.com:2195';

    /**
     * Apples Production APNs Feedback Service Gateway
     */
    public static $productionFeedbackSsl = 'ssl://feedback.push.apple.com:2196';

    /**
     * Absolute path to your Production Certificate
     */
    public static $productionCertificate = 'D:\Usr\Local\Web\Deposit\trunk\config\Push\iCunQian_Production.pem';

    // public static $productionCertificate = '/data/testsites/deposit/trunk/config/Push/iCunQian_Production.pem';

    /**
     * Apples Production Certificate Passphrase
     */
    public static $productionPassphrase = '';

    /**
     * Apples Production APNs Feedback Service Gateway
     */
    public static $sandboxSsl = 'ssl://gateway.sandbox.push.apple.com:2195';

    /**
     * Apples Sandbox APNS Feedback Service Gateway
     */
    public static $sandboxFeedbackSsl = 'ssl://feedback.sandbox.push.apple.com:2196';

    /**
     * Absolute path to your Development Certificate
     */
    // public static $sandboxCertificate = '/data/testsites/deposit/trunk/config/Push/iCunQian_Sandbox.pem';
    public static $sandboxCertificate = 'D:\Usr\Local\Web\Deposit\trunk\config\Push\iCunQian_Sandbox.pem';

    /**
     * Apples Sandbox Certificate Passphrase
     */
    public static $sandboxPassphrase = '';

    /**
     * The maximum size allowed for a notification
     */
    public static $payloadMaximumSize = 256;

    /**
     * The Apple-reserved aps namespace
     */
    public static $appleReservedNamespace = 'aps';


    public static $payloadAlertIdentifier = 'alert';
    
    public static $payloadSoundIdentifier = 'sound';
    
    public static $payloadBadgeIdentifier = 'badge';

    public static $payloadContentAvailableIdentifiter = 'content-available';

    public static $payloadBodyIdentifier = 'body';

    public static $payloadActionLocKeyIdentifier = 'action-loc-key';

    public static $payloadLocKeyIdentifier = 'loc-key';

    public static $payloadLocArgsIdentifier = 'loc-args';

    public static $payloadLaunchImageIdentifier = 'launch-image';    

    /**
     * Device token length.
     */
    public static $deviceBinarySize = 32;

    /**
     * Default write interval in micro seconds.
     */
    public static $writeInterval = 10000;

    /**
     * Default connect retry interval in micro seconds.
     */
    public static $connectRetryInterval = 10000;

    /**
     * Default socket select timeout in micro seconds.
     */
    public static $socketSelectTimeout = 10000;

    /**
     * Payload command.
     */
    public static $commandPush = 1;

    /**
     * Error-response packet size.
     */
    public static $errorResponseSize = 6;

    /**
     * Error-response command code.
     */
    public static $errorResponseCommand = 8;

    /**
     * Main loop sleep time in micro seconds.
     */
    public static $mainLoopUsleep = 20000;

    /**
     * Shared memory size in bytes useful to store message queues.
     */
    public static $shmSize = 524288;

    /**
     * Message queue start identifier for messages. For every process 1 is added to this number.
     */
    public static $shmMessagesQueueKeyStart = 1000;

    /**
     * Message queue identifier for not delivered messages.
     */
    public static $shmErrorMessagesQueueKey = 999;

    public static $sslProperty = 'ssl';

    public static $passphraseProperty = 'passphrase';

    public static $verifyPeerProperty = 'verify_peer';

    public static $cafileProperty = 'cafile';

    public static $localCertProperty = 'local_cert';

    public static $messageProperty = 'MESSAGE';

    public static $binaryNotificationProperty = 'BINARY_NOTIFICATION';
    
    public static $errorsProperty = 'ERRORS';

    public static $statusCodeProperty = 'statusCode';

    public static $identifierProperty = 'identifier';

    public static $statusMessagePorperty = 'statusMessage';

    public static $commandProperty = 'command';


    /**
     * Response status
     */
    public static $noErrorsEncountered = 0;

    public static $processingError = 1;

    public static $missingDeviceToken = 2;

    public static $missingTopic = 3;

    public static $missingPayload = 4;

    public static $invalidTokenSize = 5;

    public static $invalidTopicSize = 6;

    public static $invalidPayloadSize = 7;

    public static $invalidToken = 8;

    public static $none = 255;




}

