<?php

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Tencent extends Crawl{
    //Requires crawling the Web site address
    const PAGE_URL = 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=sxq_search_products';
    
    public function __construct(Log $logger) {
        self::$logger = $logger;
        $this->url = PAGE_URL;
    }

    public function request() {
        $page = $this->readPage();
    }

    





}