<?php

/**
 * Decomposition of page elements
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
interface Parser {

    public function getTotalItems();

    public function getTotalPages();

    public function getUniqueKeys($subject);
}