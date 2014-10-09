<?php

/**
 * @package lib\Crawl
 */

/**
 * Decomposition of page elements
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Tencent extends Crawl implements Parser
{

    public $pageRows    = 100;
    public $currentPage = 1;

    public $totalItems;
    public $totalPages;
    public $htmlParser;

    /**
     * construct 
     *
     * @param object $htmlParser htmlParser
     * 
     * @return void
     * 
     * @issue 2729
     */
    public function __construct($htmlParser) {
        parent::__construct();

        $this->htmlParser = $htmlParser;

        $this->initialization();
    }


    /**
     * initialization
     *
     * @return void
     *
     * @issue 2729
     */
    protected function initialization() {

        $response = $this->sendHttpRequestByCurl(CrawlConfig::TENCENT_LIST_PAGE_URL . $this->currentPage);

        // self::getLogger()->write(sprintf("CONTENT: %s", $response)); 

        $urlKeys = $this->getUniqueKeys($response);

        self::getLogger()->write(sprintf("PAGE %s UNIQUE KEYS: %s", $this->currentPage, implode(',', $urlKeys))); 

        $errorCount = array();

        foreach ($urlKeys as $urkKey) {
            try {
                $this->processDetailPage($urkKey);

            } catch (Exception $e) {
                $errorCount[$urkKey] = $e->getMessage();
            }
        }

        if (count($errorCount) == $this->pageRows) {
            throw new Exception(sprintf("TENCENT: reptile script is finished, page %s loop stop!", $this->currentPage));
            break;
        }

    }

    /**
     * Process data of other page
     *
     * @return array
     *
     * @issue 2729
     */
    public function initializeListPages() {
        for ($currentPage = 2; $currentPage < $this->getTotalPages(); $currentPage++) { 

            $this->currentPage = $currentPage;

            $response = $this->sendHttpRequestByCurl(CrawlConfig::TENCENT_LIST_PAGE_URL . $this->currentPage);
            
            $urlKeys = $this->getUniqueKeys($response);

            self::getLogger()->write(sprintf("PAGE %s UNIQUE KEYS: %s", $this->currentPage, implode(',', $urlKeys))); 
            
            $errorCount = array();

            foreach ($urlKeys as $urkKey) {
                try {
                    
                    $this->processDetailPage($urkKey);

                } catch (Exception $e) {
                    $errorCount[] = $e->getMessage();
                }
                
            }

            if (count($errorCount) == $this->pageRows) {
                throw new Exception(sprintf("TENCENT: reptile script is finished, page %s loop stop!", $this->currentPage));
                break;
            }
        }
    }

    /**
     * Processing data of the first page
     *
     * @param array $subject subject
     * 
     * @return array
     *
     * @issue 2729
     */
    protected function processDetailPage($subject) {
        
        $response = $this->sendHttpRequestByCurl(CrawlConfig::TENCENT_DETAIL_PAGE_URL . $subject);

        $origin = $this->_parseDetailPageStructure($response);

        $tencentAdapter = new TencentAdapter();

        $tencentAdapter->setDictionaryAdapter($origin);

        DepositFinancialProductsPeer::addFinancialProduct($tencentAdapter->populate());
    }

    /**
     * Parsing the page structure
     *
     * @param string $content detail content
     *
     * @issue 2729
     * 
     * @return mixed
     */
    private function _parseDetailPageStructure($content) {
        $this->getHtmlParser()->load($content, false);
        //head element
        $headObject = $this->_parseSpecifiedSyntax("div[class=function] h2");
        if ($headObject) {
            $name = substr($headObject->innertext, 0, strpos($headObject->innertext, "<"));
            $name = iconv("GBK", "UTF-8//IGNORE", $name);
            $head = array(
                'name'   => trim(html_entity_decode($name)),
                'status' => $this->_parseSpecifiedSyntax("a[class=zuangtai color1 no_weight]", $headObject)->plaintext,
            );
        } else {
            return false;
        }

        //ul element
        $ul = $this->_parseDetailPageUl();
        //table element
        $rowsElements = array();
        $tableElement = $this->getHtmlParser()->find("table[class=bijiao]", 0);
        foreach ($tableElement->find('tr') as $rows) {
            $rowsElements[] = $rows->innertext;
        }
        $thead = $this->_parseDetailPageThead($rowsElements[0]);
        $tbody = $this->_parseDetailPageTbody(array_slice($rowsElements, 2));
        unset($rowsElements);

        $this->getHtmlParser()->clear();
        
        return array_merge($head, $ul, $thead, $tbody);
    }

    /**
     * parse specified content
     *
     * @param string $syntax  syntax
     * @param object $element object
     * @param int    $idx     number
     *
     * @issue 2568
     * @return object
     */
    private function _parseSpecifiedSyntax($syntax, $element = '', $idx = '0') {
        $idx = $idx === '';
        if ($element) {
            return $idx ? $element->find($syntax) : $element->find($syntax, $idx);
        } else {
            return $idx ? $this->getHtmlParser()->find($syntax) : $this->getHtmlParser()->find($syntax, $idx);
        }
    }

    /**
     * parse detail's page ul structure
     *
     * @issue 2568
     * 
     * @return array
     */
    private function _parseDetailPageUl() {
        $elementList = array();
        $ulList =  $this->_loopParseSpecifiedSyntax("ul[class=dcy_topList]", 'li');
        $region = $this->_parseSpecifiedSyntax("a[class=none_url]");
        foreach ($ulList as $ul) {
            foreach ($ul as $li) {
                $split = explode('：', $li);
                if (CrawlConfig::SPCIAL_CHARACTER == trim($split[0])) {
                    $splitDate = explode('―', $split[1]);
                    $elementList[CrawlConfig::SALE_START_DATE] = $splitDate[0];
                    $elementList[CrawlConfig::SALE_END_DATE]  = $splitDate[1];
                } elseif (CrawlConfig::SPCIAL_CHARACTER_REGION == trim($split[0])) {
                    $regionString = $this->_matchRegion($region->innertext);
                    $elementList[$split[0]] = $regionString ? implode(',', $regionString) : '';
                } else {
                    $elementList[$split[0]] = $split[1];
                }
            }
        }
        return $elementList;
    }

    /**
     * loop parse specified content
     *
     * @param string $syntax      syntax
     * @param string $loopElement loop element
     * @param string $element     object
     * @param int    $idx         number
     * @param string $textType    type name
     *
     * @issue 2568
     * @return array
     */
    private function _loopParseSpecifiedSyntax($syntax, $loopElement, $element = '', $idx = '', $textType = "plaintext") {
        $rowsElements = array();
        foreach ($this->_parseSpecifiedSyntax($syntax, $element, $idx) as $rows) {
            $rowElements = array();
            foreach ($rows->find($loopElement) as $row) {
                $rowElements[] = $row->$textType;
            }
            $rowsElements[] = $rowElements;
        }
        return $rowsElements;
    }

    /**
     * get region string
     *
     * @param string $subject subject
     *
     * @issue 2568
     * @return array
     */
    private function _matchRegion($subject) {
        $res = array();
        preg_match_all('/[\x{4e00}-\x{9fa5}]+/u',$subject,$res);
        return $res ? $res[0] : $res;
    }

    /**
     * parse detail's page table thead structure
     *
     * @param string $thead head content
     *
     * @issue 2568
     * @return array
     */
    private function _parseDetailPageThead($thead) {
        $this->getHtmlParser()->load($thead, false);
        $element  = $this->getHtmlParser()->find('table', 0);
        $firstTh = $this->_parseSpecifiedSyntax('th')->plaintext;
        $sencodTh = $this->_parseSpecifiedSyntax('th', $element)->plaintext;
        foreach ($element->find('td') as $tdElement) {
            $tds[] = html_entity_decode($tdElement->plaintext);
        }
        $this->getHtmlParser()->clear();
        $list = array(
            $firstTh => $tds[0],
            $sencodTh => $tds[1],
        );
        return $list;
    }

    /**
     * parse detail's page table tbody structure
     *
     * @param string $tbody tbody content
     *
     * @issue 2568
     * @return array
     */
    private function _parseDetailPageTbody($tbody) {
        $thtd = array();
        foreach ($tbody as $innerElement) {
            $this->getHtmlParser()->load($innerElement, false);
            $thtd[$this->_parseSpecifiedSyntax('th')->plaintext] = html_entity_decode($this->_parseSpecifiedSyntax('td')->plaintext);
        }
        $this->getHtmlParser()->clear();
        return $thtd;
    }

    /**
     * Re-write getTotalItems
     *
     * @return int
     *
     * @issue 2729
     */
    public function getTotalItems() {
        return $this->totalItems;
    }

    /**
     * Re-write getTotalPages
     *
     * @return int
     *
     * @issue 2729
     */
    public function getTotalPages() {
        return $this->totalPages;
    }

    /**
     * Re-write getUniqueKeys
     *
     * @param object $subject subject
     * 
     * @return int
     *
     * @issue 2729
     */
    public function getUniqueKeys($subject) {
        return $this->_parseListPageStructure($subject, false);
    }

    /**
     * Paging page structure and content
     *
     * @param string  $subject  per list page content
     * @param boolean $isGetAll true is get all table element
     *
     * @issue 2729
     * 
     * @return array
     */
    private function _parseListPageStructure($subject, $isGetAll = true) {
        $trElementList = array();
        
        $this->getHtmlParser()->load($subject, false);

        $tableElement = $this->getHtmlParser()->find("table[class=baobiao]", 0);
        
        if ($tableElement) {
            foreach ($tableElement->find("tr") as $trElement) {
                //it is important
                $tdElementList = array();
                foreach ($trElement->find("td") as $tdElement) {
                    $tdElementList[] = $tdElement->innertext;
                }
                if (!$isGetAll && isset($tdElementList[0])) {
                    $trElementList[] = $this->_matchSpecifiedNumber($tdElementList[0]);
                } else {
                    $trElementList[] = $tdElementList;
                }
            }
        }
        array_shift($trElementList);

        $this->getHtmlParser()->clear();
        
        return $trElementList;
    }

    /**
     * Get htmlParser
     *
     * @return object
     *
     * @issue 2729
     */
    public function getHtmlParser() {
        return $this->htmlParser;
    }

    /**
     * match number
     *
     * @param string $subject subject
     *
     * @issue 2729
     * 
     * @return array
     */
    private function _matchSpecifiedNumber($subject) {
        $matches = array();
        $patten = "/\d+/";
        preg_match($patten, $subject, $matches);
        return $matches[0];
    }



    
}