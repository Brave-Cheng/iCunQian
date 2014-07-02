<?php

/**
 * @package lib\Push\GCM\Result
 */

/**
 * Parent class of result
 *
 * @author brave <brave.cheng@expacta.com.cn>
 */

class GcmResult extends Result
{
    
    protected $results = array();

    /**
     * Add a result to the _result property
     *
     * @param object $result result
     * 
     * @issue 2589
     * @return null
     */
    public function addResult($result) {
        $this->results[] = $result;
    }

    /**
     * Gets the results of each individual message
     *
     * @issue 2589
     * @return array
     */
    public function getResults() {
        return $this->results;
    }

}
