<?php

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Crawl {

    const HTTP_METHOD_GET  = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const TIMEOUT   = 15;
    
    public $sleepMinTime = 10;
    public $sleepMaxTime = 60;
    
    public $isDebug = false;
    
    private $activeLog = array();

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
     * @return string
     */
    public function getRandomUserAgent() {
        $maxNumber = sizeof($this->userAgent) - 1;
        $randomNumber = rand(0, $maxNumber);
        return $this->userAgent[$randomNumber];
    }

    /**
     * get random sleep time
     * @return int sleep time
     */
    public function getRandomSleepTime() {
        return rand($this->sleepMinTime, $this->sleepMaxTime);
    }


    /**
     * get remote page content by curl
     * @param  string  $url    
     * @param  integer $header 
     * @param  string  $cookie 
     * @param  string  $post   
     * @param  boolean $isGet  
     * @return mixed   content
     */
    public function readPage($url, $header = 1, $cookie = '', $post = '', $isGet=false) {
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
            $this->setActiveLog("CURL Request Time: " . date('Y-m-d H:i:s') . "\n"); 
        }
        $data = curl_exec($curl);
        if ($this->isDebug) {
            $this->setActiveLog('CURL Response Time: ' . date('Y-m-d H:i:s') . "\n"); 
            $this->setActiveLog("CURL Response Content: \n" . $data . "\n");
        }
        curl_close($curl);
        if ($this->isDebug) {
            Log::instance()->write($this->_getActiveLog());
        }
        if (!$data) {
            return false;
        }
        return $this->_isCorrectStatusCode($data);
    }
    
    /**
     * get correct content
     * @param string $response
     * @return boolean|string
     */
    private function _isCorrectStatusCode($response) {
        if (!eregi("^HTTP/1\.. 200", $response)) {
            if (eregi("^HTTP/1\.. 302", $response)) {
                return $response;
            }
            if (eregi("^HTTP/1\.. 403", $response)) {
                $response = '';
            }
            return false;
        } else {
            return $response;
        }
    }
    
    /**
     * set active log
     * @param mixed $log
     */
    protected function setActiveLog($log){
        if (!is_array($log)) {
            $log = array($log);
        }
        $this->activeLog = array_merge($this->activeLog, $log);
    }
    
    /**
     * get active log
     * @return string
     */
    protected function _getActiveLog() {
        return implode("\n", $this->activeLog);
    }
    
}






