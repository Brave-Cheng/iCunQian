<?php

/**
 * Decomposition of page elements
 * @copyright Expacta Inc
 * @package lib/Crawl
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
interface Parser
{
    /**
     * get total items
     * 
     * @return null
     */
    public function getTotalItems();

    /**
     * get total pages
     * 
     * @return null
     *     
     */
    public function getTotalPages();

    /**
     * get unique key list
     * 
     * @param string $subject subject
     * 
     * @return null
     */
    public function getUniqueKeys($subject);
}