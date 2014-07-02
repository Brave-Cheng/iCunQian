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

    const HTTP_METHOD_GET  = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const TIMEOUT   = 15;
    
    public $sleepMinTime = 10;
    public $sleepMaxTime = 60;
    public $constructIp  = array(
                                'CLIENT-IP:42.121.64.12',
                                'X-FORWARDED-FOR:61.145.122.155'
                            );
    public $constructReferer = "http://www.jnlc.com/";
    public $isDebug = false;
    
    private $_activeLog = array();

    //Using multiple useragent prevent denial of service
    public $userAgent = array(
                                'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
                                'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)',
                                'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)',
                                'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                                'msnbot/1.1 (+http://search.msn.com/msnbot.htm)',
                                'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)',
                                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116',
                            );
    /**
     * get random user-agent
     * 
     * @return string
     *
     * @issue 2599
     */
    public function getRandomUserAgent() {
        $maxNumber = sizeof($this->userAgent) - 1;
        $randomNumber = rand(0, $maxNumber);
        return $this->userAgent[$randomNumber];
    }

    /**
     * get random sleep time
     * 
     * @return int sleep time
     *
     * @issue 2599
     */
    public function getRandomSleepTime() {
        return rand($this->sleepMinTime, $this->sleepMaxTime);
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
    public function readPage($url, $header = 1, $cookie = '', $post = '', $isGet = false) {
        sleep($this->getRandomSleepTime());
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, $header);
        //it's important for scrape
        if($cookie){
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);     
        }
        //get random user-agent
        $userAgent = $this->getRandomUserAgent();
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //Whether crawl the pages after the jump, it's important for scrape
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($curl, CURLOPT_HTTPHEADER , $this->constructIp);
        curl_setopt($curl, CURLOPT_REFERER, $this->constructReferer);
        if ($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }
        if ($isGet) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, self::HTTP_METHOD_GET);
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_FAILONERROR, 0);
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, self::TIMEOUT);
        if ($this->isDebug) {
            $this->setActiveLog("CURL Request url: ". $url . "\n");
            $this->setActiveLog("CURL Request Time: " . date('Y-m-d H:i:s') . "\n"); 
        }
        $data = curl_exec($curl);
        if ($this->isDebug) {
            $this->setActiveLog('CURL Response Time: ' . date('Y-m-d H:i:s') . "\n"); 
            $this->setActiveLog("CURL Response Content Length: " . strlen($data) . "\n");
        }
        curl_close($curl);
        if ($this->isDebug) {
            Log::instance()->setFilename(CrawlConfig::ACTIVE_LOG_NAME);
            Log::instance()->write($this->_getActiveLog());
        }
        if (!$data) {
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
        if (!@eregi("^HTTP/1\.. 200", $response)) {
            if (@eregi("^HTTP/1\.. 302", $response)) {
                return $response;
            }
            if (@eregi("^HTTP/1\.. 403", $response)) {
                $response = '';
            }
            return false;
        } else {
            return $response;
        }
    }
    
    /**
     * set active log
     * 
     * @param mixed $log log content
     * 
     * @return null
     *
     *
     * @issue 2599
     */
    protected function setActiveLog($log){
        if (!is_array($log)) {
            $log = array($log);
        }
        $this->_activeLog = array_merge($this->_activeLog, $log);
    }
    
    /**
     * get active log
     * 
     * @return string 
     *
     *
     * @issue 2599
     */
    private function _getActiveLog() {
        return implode("\n", $this->_activeLog);
    }
    
}






