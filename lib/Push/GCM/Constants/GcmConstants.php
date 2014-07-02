<?php

/**
 * @package lib\Push
 */

/**
 * Constants used in GCM service communication.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
final class GcmConstants extends Constants
{

    /**
     * Endpoint for sending messages.
     */
    public static $gcmSendEndpoint = 'https://android.googleapis.com/gcm/send';

    /**
     * HTTP parameter for registration id.
     */
    public static $paramRegistrationId = 'registration_id';
    
    /**
     * HTTP parameter for collapse key.
     */
    public static $paramCollapseKey = 'collapse_key';
    
    /**
     * HTTP parameter for delaying the message delivery if the device is idle.
     */
    public static $paramDelayWhileIdle = 'delay_while_idle';
    
    /**
     * Prefix to HTTP parameter used to pass key-values in the message payload.
     */
    public static $paramPayloadPrefix = 'data.';
    
    /**
     * Prefix to HTTP parameter used to set the message time-to-live.
     */
    public static $paramTimeToLive = 'time_to_live';
    
    /**
     * Too many messages sent by the sender. Retry after a while.
     */
    public static $errorQuotaExceeded = 'QuotaExceeded';
    
    /**
     * Too many messages sent by the sender to a specific device.
     * Retry after a while.
     */
    public static $errorDeviceQuotaExceeded = 'DeviceQuotaExceeded';
    
    /**
     * Missing registration_id.
     * Sender should always add the registration_id to the request.
     */
    public static $errorMissingRegistration = 'MissingRegistration';
    
    /**
     * Bad registration_id. Sender should remove this registration_id.
     */
    public static $errorInvalidRegistration = 'InvalidRegistration';
    
    /**
     * The sender_id contained in the registration_id does not match the
     * sender_id used to register with the GCM servers.
     */
    public static $errorMismatchSenderId = 'MismatchSenderId';
    
    /**
     * The user has uninstalled the application or turned off notifications.
     * Sender should stop sending messages to this device and delete the
     * registration_id. The client needs to re-register with the GCM servers to
     * receive notifications again.
     */
    public static $errorNotRegistered = 'NotRegistered';
    
    /**
     * The payload of the message is too big, see the limitations.
     * Reduce the size of the message.
     */
    public static $errorMessageTooBig = 'MessageTooBig';
    
    /**
     * Collapse key is required. Include collapse key in the request.
     */
    public static $errorMissingCollapseKey = 'MissingCollapseKey';
    
    /**
     * A particular message could not be sent because the GCM servers were not
     * available. Used only on JSON requests, as in plain text requests
     * unavailability is indicated by a 503 response.
     */
    public static $errorUnavailable = 'Unavailable';
    
    /**
     * A particular message could not be sent because the GCM servers encountered
     * an error. Used only on JSON requests, as in plain text requests internal
     * errors are indicated by a 500 response.
     */
    public static $errorInternalServerError = 'InternalServerError';
    
    /**
     * Time to Live value passed is less than zero or more than maximum.
     */
    public static $errorInvalidTtl= 'InvalidTtl';
    
    /**
     * Token returned by GCM when a message was successfully sent.
     */
    public static $tokenMessageId = 'id';
    
    /**
     * Token returned by GCM when the requested registration id has a canonical
     * value.
     */
    public static $tokenCanonicalRegId = 'registration_id';
    
    /**
     * Token returned by GCM when there was an error sending a message.
     */
    public static $tokenError = 'Error';
    
    /**
     * JSON-only field representing the registration ids.
     */
    public static $jsonRegistrationIds = 'registration_ids';
    
    /**
     * JSON-only field representing the payload data.
     */
    public static $jsonPayload = 'data';
    
    /**
     * JSON-only field representing the number of successful messages.
     */
    public static $jsonSuccess = 'success';
    
    /**
     * JSON-only field representing the number of failed messages.
     */
    public static $jsonFailure = 'failure';
    
    /**
     * JSON-only field representing the number of messages with a canonical
     * registration id.
     */
    public static $jsonCanonicalIds = 'canonical_ids';
    
    /**
     * JSON-only field representing the id of the multicast request.
     */
    public static $jsonMulticastId = 'multicast_id';
    
    /**
     * JSON-only field representing the result of each individual request.
     */
    public static $jsonResults = 'results';
    
    /**
     * JSON-only field representing the error field of an individual request.
     */
    public static $jsonError = 'error';
    
    /**
     * JSON-only field sent by GCM when a message was successfully sent.
     */
    public static $jsonMessageId = 'message_id';

    /**
     * Sets the url link symbol
     */
    public static $paramUrlSymbol = '&';

    public static $gcmRequestLog = 'Gcm_Push_Log.log';

}

