<?php

/**
 * @package lib\Push\APNs\Send
 */

/**
 * GcmSend class: this is the superclass for all Apple Push Notification Service
 * classes.
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */
class ApnsSend extends Send
{
    /**
     * Container for service URLs environments.
     */
    protected $serviceUrl;

    protected $environment;

    protected $providerCertificateFile;

    protected $providerCertificatePassphrase;

    protected $rootCertificationAuthorityFile;

    protected $feedbackUrl;

    /**
     *  Connect time out
     */
    protected $connectTimeout;

    /**
     * Write interval in micro seconds.
     */
    protected $writeInterval;

    /**
     * Connect retry interval in micro seconds.
     */
    protected $connectRetryInterval;

    /**
     * Socket select timeout in micro seconds.
     */
    protected $socketSelectTimeout;

    /**
     * Resource SSL Socket.
     */
    public $socket = null;

    public $feedbackSocket = null;

    /**
     * Construnct function
     * 
     * @param string $environment environment
     *
     * @issue 2589
     * @return null
     */
    public function __construct($environment) {
        parent::__construct();
        try {
            $this->getEnvironment($environment);
            $this->getServiceUrl($environment);
            $this->getProviderCertificateFile($environment);
            $this->getProviderCertificatePassphrase($environment);
            $this->getFeedbackUrl($environment);
            $this->connectTimeout = ini_get('default_socket_timeout');
            $this->writeInterval = ApnsConstants::$writeInterval;
            $this->connectRetryInterval = ApnsConstants::$connectRetryInterval;
            $this->socketSelectTimeout = ApnsConstants::$socketSelectTimeout;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Gets the response status
     * 
     * @param int $status response status
     *
     * @issue 2589
     * @return mixed
     */
    public function getResponseStatus($status = '') {
        $responseStatus = array(
                ApnsConstants::$noErrorsEncountered => 'No Errors Encountered',
                ApnsConstants::$processingError     => 'Processing Error',
                ApnsConstants::$missingDeviceToken  => 'Missing Device Token',
                ApnsConstants::$missingTopic        => 'Missing Topic',
                ApnsConstants::$missingPayload      => 'Missing Payload',
                ApnsConstants::$invalidTokenSize    => 'Invalid Token Size',
                ApnsConstants::$invalidTopicSize    => 'Invalid Topic Size',
                ApnsConstants::$invalidPayloadSize  => 'Invalid Payload Size',
                ApnsConstants::$invalidToken        => 'Invalid Token',
                ApnsConstants::$none                => 'None (unknown)',
            );
        if ($status) {
            return $responseStatus[$status];
        }
        return $responseStatus;
    }

    /**
     * Get the service URL environments.
     * 
     * @param string $environment environment
     *
     * @issue 2589
     * @return string service URL
     */
    public function getServiceUrl($environment = null) {
        $serviceUrls = array(
                ApnsConstants::$environmentProduction   => ApnsConstants::$productionSsl,
                ApnsConstants::$environmentSandbox      => ApnsConstants::$sandboxSsl ,
            );
        $this->serviceUrl = is_null($environment) ? $serviceUrls : $serviceUrls[$environment];
    }

    /**
     * Get the provider environments
     * 
     * @param string $environment environment
     *
     * @issue 2589
     * @return string
     */
    public function getEnvironment($environment = null) {
        $environments = array(
                ApnsConstants::$environmentProduction => ApnsConstants::$environmentProduction,
                ApnsConstants::$environmentSandbox    => ApnsConstants::$environmentSandbox
            );
        if (!array_key_exists($environment, $environments)) {
            throw new PushException(sprintf('Invalid environment %s', $environment));
        }
        $this->environment = is_null($environment) ? $environments : $environments[$environment];
    }

    /**
     * Provider certificate file with key (Bundled PEM).
     * 
     * @param string $environment environment
     * 
     * @issue 2589
     * @return string provider certificate
     */
    public function getProviderCertificateFile($environment = null) {
        $providerCertificateFiles = array(
                ApnsConstants::$environmentProduction   => ApnsConstants::$productionCertificate,
                ApnsConstants::$environmentSandbox      => ApnsConstants::$sandboxCertificate,
            );
        $this->providerCertificateFile = is_null($environment) ? $providerCertificateFiles : $providerCertificateFiles[$environment];
        if (!is_readable($this->providerCertificateFile)) {
            throw new PushException(sprintf('Unable to read certificate file', $this->providerCertificateFile));
        }
        //Check to make sure that the certificates are available and also provide a notice if they are not as secure as they could be.
        $filePermission = substr(sprintf("%o", fileperms($this->providerCertificateFile)), -3);
        if ($filePermission > Constants::$filePermissions) {
            $this->getLogger()->write(sprintf('SUGGEST: %s is insecure, suggest chomd %s', $this->providerCertificateFile, Constants::$filePermissions));
        }
    }

    /**
     * Get the provider certificate passphrase
     * 
     * @param string $environment environment
     * 
     * @issue 2589
     * @return string provider certificate passphrase
     */
    public function getProviderCertificatePassphrase($environment = null) {
        $providerCertificatePassphrases = array(
                ApnsConstants::$environmentProduction   => ApnsConstants::$productionPassphrase,
                ApnsConstants::$environmentSandbox      => ApnsConstants::$sandboxPassphrase,
            );
        $this->providerCertificatePassphrase = is_null($environment) ? $providerCertificatePassphrases : $providerCertificatePassphrases[$environment];
    }

    /**
     * Gets the feedback url
     * 
     * @param string $environment environment
     * 
     * @issue 2589
     * @return string feedback
     */
    public function getFeedbackUrl($environment = null) {
        $feedbackUrls = array(
            ApnsConstants::$environmentProduction   => ApnsConstants::$productionFeedbackSsl,
            ApnsConstants::$environmentSandbox      => ApnsConstants::$sandboxFeedbackSsl,
        );
        $this->feedbackUrl = is_null($environment) ? $feedbackUrls : $feedbackUrls[$environment];
    }

    /**
     * Set root certification authority file.
     *
     * @param string $rootCertificationAuthorityFile filename
     *
     * @issue 2589
     * @return null
     */
    public function setRootCertificationAuthorityFile($rootCertificationAuthorityFile) {
        if (!is_readable($rootCertificationAuthorityFile)) {
            throw new PushException(sprintf('Unable to read Certificate Authority file %s', $rootCertificationAuthorityFile));
        }
        $this->rootCertificationAuthorityFile = $rootCertificationAuthorityFile;
    }

    /**
     * Get root certification authority file.
     *
     * @issue 2589
     * @return string root certification authority file.
     */
    public function getRootCertificationAuthorityFile() {
        return $this->rootCertificationAuthorityFile;
    }

    /**
     * Connects to Apple Push Notification service server.
     *
     * @issue 2589
     * @return boolean True if successful connected.
     */
    private function _connectSsl() {
        $this->getLogger()->write(sprintf("INFO: Trying %s...", $this->serviceUrl));
        $streamsContext = stream_context_create(array(
                ApnsConstants::$sslProperty => array(
                    ApnsConstants::$verifyPeerProperty      => isset($this->rootCertificationAuthorityFile),
                    ApnsConstants::$cafileProperty          => $this->getRootCertificationAuthorityFile(),
                    ApnsConstants::$localCertProperty       => $this->providerCertificateFile,
                )
            )
        );
        //Sets an option for a stream/wrapper/context
        if (!empty($this->providerCertificatePassphrase)) {
            stream_context_set_option($streamsContext, ApnsConstants::$sslProperty, ApnsConstants::$passphraseProperty, $this->getProviderCertificatePassphrase);
        }
        //Open Internet or Unix domain socket connection
        $this->socket = stream_socket_client($this->serviceUrl, $errno, $errstr, $this->connectTimeout, (STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT), $streamsContext);
        if (!$this->socket) {
            throw new PushException(sprintf("Unable to connect to %s: %s %s", $this->serviceUrl, $errno, $errstr));
            unset($this->socket);
            return false;
        }
        //Set blocking/non-blocking mode on a stream
        stream_set_blocking($this->socket, 0);
        //Sets file buffering on the given stream
        stream_set_write_buffer($this->socket, 0);
        $this->getLogger()->write(sprintf("INFO: Connected to %s", $this->serviceUrl));
        return true;
    }  

    /**
     * Close the socket service
     *
     * @issue 2589
     * @return boolean true is closed successfully
     */
    public function disconnect() {
        if (is_resource($this->serviceUrl)) {
            // stream_socket_shutdown($this->serviceUrl, STREAM_SHUT_RD);
            $this->getLogger()->write(sprintf("INFO: Close %s", $this->serviceUrl));
            return fclose($this->serviceUrl);
        }
        return false;
    } 

    /**
     * Connects to Apple Push Notification service server.
     *
     * @issue 2589
     * @return boolean True if successful connected.
     */
    public function connect() {
        $retries = 0;
        $connect = false;
        while (!$connect) {
            try {
                $connect = $this->_connectSsl();
            } catch (PushException $e) {
                $this->getLogger()->write(sprintf("ERROR: $s", $e->errorMessage()));
                if ($retries >= $this->getRetries()) {
                    throw $e;
                } else {
                    $this->getLogger()->write(sprintf("INFO: Retry to connect %s / %s", $connect+1, $this->getRetries()));
                    usleep($this->connectRetryInterval);
                }
            }
            $retries++;
        }
    }

    /**
     * Connects to Apple Push Notification Feedback service server.
     *
     * @issue 2589
     * @return boolean True if successful connected.
     */
    private function _connectFeedback() {
        $this->getLogger()->write(sprintf("INFO: Trying to connect feedback %s...", $this->feedbackUrl));
        $streamsContext = stream_context_create();
        stream_context_set_option($streamsContext, ApnsConstants::$sslProperty, ApnsConstants::$localCertProperty, $this->providerCertificateFile);
        //Sets an option for a stream/wrapper/context
        if (!empty($this->providerCertificatePassphrase)) {
            stream_context_set_option($streamsContext, ApnsConstants::$sslProperty, ApnsConstants::$passphraseProperty, $this->getProviderCertificatePassphrase);
        }
        //Open Internet or Unix domain socket connection
        $this->feedbackSocket = stream_socket_client($this->feedbackUrl, $errno, $errstr, $this->connectTimeout, STREAM_CLIENT_CONNECT, $streamsContext);

        if (!$this->feedbackSocket) {
            throw new PushException(sprintf("Unable to connect to %s: %s %s", $this->feedbackUrl, $errno, $errstr));
            unset($this->feedbackUrl);
        }
        $this->getLogger()->write(sprintf("INFO: Connected to the feedback %s", $this->feedbackUrl));
    }

    /**
     * Connect to the feedback url
     *
     * @issue 2589
     * @return null
     */
    public function connectFeedback() {       
        $feedback = array();
        $this->_connectFeedback();
        $this->getLogger()->write(sprintf('INFO: Feedback return %s', fread($this->feedbackSocket, 8192)));
        while (!feof($this->feedbackSocket)) {
            $data = fread($this->feedbackSocket, 38);
            if (strlen($data)) {
                $feedback[] = unpack('N1timestamp/n1length/H*devtoken', $data);
            }
        }
        fclose($this->feedbackSocket);
        if ($feedback) {
            $this->getApnsResult()->setFeedback($feedback);
            $this->getLogger()->write(sprintf('Unregistering Device Token: %s', implode(',', $feedback)));
        }
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
            throw new PushException('Missing message token.');
        }
    }
    
}