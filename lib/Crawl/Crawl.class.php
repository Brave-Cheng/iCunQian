<?php

/**
 * @package lib\Crawl
 */

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Crawl
{

    const HTTP_METHOD_GET               = 'GET';
    const HTTP_METHOD_POST              = 'POST';
    const TIMEOUT                       = 15;
    
    public $sleepMinTime                = 10;
    public $sleepMaxTime                = 60;

    public static $logger;
    public static $requestActiveLog     = 'http_request_access_logs';
    
    public $constructIp                 = array(
                                            'CLIENT-IP:42.121.64.12',
                                            'X-FORWARDED-FOR:61.145.122.155'
                                        );
    public $constructReferer            = "http://www.jnlc.com/";
    

    /**
     * construct
     *
     * @return void
     * 
     * @issue 2729
     */
    public function __construct() {
        self::$logger = Log::instance();
    }

    /**
     * Get user agent
     *
     * @return array
     *
     * @issue 2729
     */
    protected function getUserAgent() {
        //Using multiple useragent prevent denial of service
        return array(
            'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
            'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)',
            'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)',
            'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
            'msnbot/1.1 (+http://search.msn.com/msnbot.htm)',
            'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)',
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116',
        );
    }

    /**
     * get random user-agent
     * 
     * @return string
     *
     * @issue 2599, 2729
     */
    public function getRandomUserAgent() {
        $userAgent = $this->getUserAgent();
        $maxNumber = sizeof($userAgent) - 1;
        $randomNumber = rand(0, $maxNumber);
        return $userAgent[$randomNumber];
    }

    /**
     * get random sleep time
     * 
     * @return int sleep time
     *
     * @issue 2599
     */
    public function getRandomSleepTime() {
        return rand($this->getSleepMinTime(), $this->getSleepMaxTime());
    }

    /**
     * Set sleepMinTime
     *
     * @param int $sleepMinTime sleepMinTime
     *
     * @return void
     * 
     * @issue 2729
     */
    public function setSleepMinTime($sleepMinTime) {
        $this->sleepMinTime = $sleepMinTime;
    }

    /**
     * Get sleepMinTime 
     *
     * @return int
     *
     * @issue 2729
     */
    protected function getSleepMinTime() {
        return $this->sleepMinTime;
    }

    /**
     * Set sleepMaxTime
     *
     * @param int $sleepMaxTime sleepMaxTime
     *
     * @return void
     * 
     * @issue 2729
     */
    public function setSleepMaxTime($sleepMaxTime) {
        $this->sleepMaxTime = $sleepMaxTime;
    }

    /**
     * Get sleepMaxTime 
     *
     * @return int
     *
     * @issue 2729
     */
    protected function getSleepMaxTime() {
        return $this->sleepMaxTime;
    }


    /**
     * get remote page content by curl
     * 
     * @param string  $url    url
     * @param integer $header header content 
     * @param string  $cookie cookie 
     * @param string  $post   post 
     * @param boolean $isGet  get is true, and other is false
     * 
     * @return mixed   content
     *
     * @issue 2599
     */
    public function sendHttpRequestByCurl($url, $header = 1, $cookie = '', $post = '', $isGet = false) {
        self::getLogger()->setFilename(self::$requestActiveLog);

        self::getLogger()->write(sprintf("SLEEP: %s s", $this->getRandomSleepTime()));

        sleep($this->getRandomSleepTime());
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        
        self::getLogger()->write(sprintf("REQUEST URL: %s", $url));

        curl_setopt($curl, CURLOPT_HEADER, $header);
        //it's important for scrape
        if($cookie){
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);     
        }
        //get random user-agent
        $userAgent = $this->getRandomUserAgent();
        
        self::getLogger()->write(sprintf("USER AGENT: %s", $userAgent));

        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //Whether crawl the pages after the jump, it's important for scrape
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($curl, CURLOPT_HTTPHEADER , $this->constructIp);
        curl_setopt($curl, CURLOPT_REFERER, $this->constructReferer);
        if ($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            self::getLogger()->write(sprintf("HTTP METHOD: %s %s", self::HTTP_METHOD_POST, $post));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }
        if ($isGet) {
            self::getLogger()->write(sprintf("REQUEST METHOD: %s", self::HTTP_METHOD_GET));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, self::HTTP_METHOD_GET);
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_FAILONERROR, 0);
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, self::TIMEOUT);
        $data = curl_exec($curl);
        curl_close($curl);
        if (!$data) {
            self::getLogger()->write(sprintf("HTTP RESPONSE FAILED: %s", $data));
            return false;
        }
        return $this->_isCorrectStatusCode($data);
    }
    
    /**
     * get correct content
     * 
     * @param string $response response content
     * 
     * @return boolean|string
     *
     * @issue 2599
     */
    private function _isCorrectStatusCode($response) {

        if ($this->isJson($response)) {
            return $response;
        }
        if (!@eregi("^HTTP/1\.. 200", $response)) {
            if (@eregi("^HTTP/1\.. 302", $response)) {
                return $response;
            }
            if (@eregi("^HTTP/1\.. 403", $response)) {
                $response = '';
            }
            self::getLogger()->write(sprintf("HTTP RESPONSE CAN NOT BE IDENTIFIED: %s", $response));
            return false;
        } else {
            return $response;
        }
    }
    
    /**
     * Is Json
     *
     * @param string $string string
     *
     * @return boolean 
     *
     * @issue 2729
     */
    protected function isJson($string) {
        return ((is_string($string) && 
         (is_object(json_decode($string)) || 
         is_array(json_decode($string))))) ? true : false;
    }

    /**
     * Get logger
     *
     * @return object
     *
     * @issue 2729
     */
    public static function getLogger() {
        return self::$logger;
    }

}






