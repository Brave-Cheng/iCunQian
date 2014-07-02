<?php

/**
 * @package lib\Push\GCM\Send
 */

/**
 * GcmSend class: this is the subclass for GCM pushing service
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class GcmSend extends Send
{
    /**
     * Initial delay before first retry, without jitter.
     */
    public static $backoffInitialDelay = 1000;

    /**
     * Maximum delay before a retry.
     */
    public static $maxBackoffDelay = 1024000;

    protected $apiKey = null;

    /**
     * Default constructor.
     *
     * @param string $apiKey API key obtained through the Google API Console.
     *
     * @issue 2589
     * @return null
     */
    public function __construct($apiKey) {
        parent::__construct();
        $this->apiKey = $apiKey;    
    }

    /**
     * Delay execution
     *
     * @issue 2589
     * @return zero on success, or FALSE on errors
     */
    public static function delayTime() {
        $sleepTime = self::$backoffInitialDelay / 2 + rand(0, self::$backoffInitialDelay);
        sleep($sleepTime);
    }

    /**
     * Use GCM Header
     *
     * @issue 2589
     * @return array
     */
    public function useHeaders() {
        $headers = array(
                        'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
                        'Authorization: key=' . $this->apiKey
                    );
        return $headers;
    }   

    /**
     * Check the post paramters
     * 
     * @param int    $index          message pid
     * @param string $registrationId token
     *
     * @issue 2589
     * @return null
     */
    public function post($index, $registrationId) {
        if (empty($index)) {
            throw new PushException('Missing message pid.');
        }
        if (empty($registrationId)) {
            throw new PushException('Missing message registration id.');
        }
    }

    /**
     * Send HTTP request by CURL 
     * 
     * @param array  $headers request header
     * @param string $url     requet url
     * @param string $body    request body
     *
     * @issue 2589
     * @return string response
     */
    public function postByCurl($headers, $url, $body) {
        $this->getLogger()->write(sprintf("INFO: Trying to connect %s", $url), GcmConstants::$gcmRequestLog);
        $ch = curl_init();
        if ($this->fiddlerDebugger) {
            //To configure a PHP/cURL application to send web traffic to Fiddler
            curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:8888');    
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($status == 503) {
            return null;
        }
        if ($status != 200) {
            throw new PushException("Request failed from GCM service.");
        }
        if ($response == '') {
            throw new PushException('Received empty response from GCM service.');
        }
        $this->getLogger()->write(sprintf('INFO: Connected to the %s', $url), GcmConstants::$gcmRequestLog);
        return $response;
    }

}
