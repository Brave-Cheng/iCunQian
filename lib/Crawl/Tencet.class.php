<?php

/**
 * Decomposition of page elements
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Tencent extends Crawl implements Parser {
    //Requires crawling the Web site address
    const PAGE_LIST_SIZE = 100;

    private static $pageListUrl = TENCERT_PAGE_LIST_URL;
    private static $pageDetailUrl = TENCERT_PAGE_DETAIL_URL;
    public static $html = null;

    public function __construct(simple_html_dom $html) {
        self::$html = $html;
    }

    public function request() {
        if ($this->isDebug) {
//            $this->_writeElementsLog(1, $this->requestListFirstPage());
//            $this->requestDetailPage();
            return $this->_parseDetailPage(file_get_contents('D:\var\www\deposit\git\log\page_list_log_dir\2014042517\Crawl_Active_Log.log'));
        }
    }
    
    /**
     * request per page content
     */
    public function requestListPerPage() {
        for ($index = 2; $index <= $this->getTotalPages(); $index++) {
            $url = self::$pageListUrl . '&p=' . $index;
            $content = $this->readPage($url);
            //write log
            if ($this->isDebug) {
                $this->_writeElementsLog($index, $content);
            }
            
        }
    }
    
    /**
     * get first page content
     * @return string
     */
    public function requestListFirstPage() {
        return $this->readPage(self::$pageListUrl);
    }
    
    /**
     * request detail page
     * @param int $urlKey
     */
    public function requestDetailPage($urlKey) {
        $url = self::$pageDetailUrl . '&id=' . $urlKey;
        $this->_parseDetailPage($this->readPage($url));
    }
    
    /**
     * Parsing the page structure
     * @param string $content
     */
    private function _parseDetailPage($content) {
        self::$html->load($content, false);
        //head element
        $head = array(
            'name' => html_entity_decode($this->_parseSpecifiedSyntax("div[class=function]")->plaintext),
            'status' => $this->_parseSpecifiedSyntax(
                    "a[class=zuangtai color1 no_weight]", $this->_parseSpecifiedSyntax("div[class=function]"))->plaintext,
        );
        //ul element
        $ul = $this->_parseDetailPageUl();
        //table element
        $rowsElements = array();
        $tableElement = self::$html->find("table[class=bijiao]", 0);
        foreach ($tableElement->find('tr') as $rows) {
            $rowsElements[] = $rows->innertext;
        }
        $thead = $this->_parseDetailPageThead($rowsElements[0]);
        $tbody = $this->_parseDetailPageTbody(array_slice($rowsElements, 2));
        unset($rowsElements);
        self::$html->clear();
        return array_merge($head, $ul, $thead, $tbody);
    }
    
    /**
     * parse detail's page ul structure
     * @return type
     */
    private function _parseDetailPageUl() {
        $elementList = array();
        $ulList =  $this->_loopParseSpecifiedSyntax("ul[class=dcy_topList]", 'li');
        foreach ($ulList as $ul) {
            foreach ($ul as $li) {
                $split = explode('：', $li);
                $elementList[$split[0]] = $split[1];
            }
        }
        return $elementList;
    }


    /**
     * parse detail's page table thead structure
     * @param string $thead
     * @return array
     */
    private function _parseDetailPageThead($thead) {
        self::$html->load($thead, false);
        $element  = self::$html->find('table', 0);
        $firstTh = $this->_parseSpecifiedSyntax('th')->plaintext;
        $sencodTh = $this->_parseSpecifiedSyntax('th', $element)->plaintext;
        foreach ($element->find('td') as $tdElement) {
            $tds[] = html_entity_decode($tdElement->plaintext);
        }
        self::$html->clear();
        $list = array(
            $firstTh => $tds[0],
            $sencodTh => $tds[1],
        );
        return $list;
    }

    /**
     * parse detail's page table tbody structure
     * @param string $tbody
     * @return array
     */
    private function _parseDetailPageTbody($tbody) {
        $thtd = array();
        foreach ($tbody as $innerElement) {
            self::$html->load($innerElement, false);
            $thtd[$this->_parseSpecifiedSyntax('th')->plaintext] = html_entity_decode($this->_parseSpecifiedSyntax('td')->plaintext);
        }
        self::$html->clear();
        return $thtd;
    }

    /**
     * parse specified content
     * @param string $syntax
     * @param object $element
     * @param int $idx
     * @return object
     */
    private function _parseSpecifiedSyntax($syntax, $element = '', $idx = '0') {
        $idx = $idx === '';
        if ($element) {
           return $idx ? $element->find($syntax) : $element->find($syntax, $idx);
        }  else {
           return $idx ? self::$html->find($syntax) : self::$html->find($syntax, $idx);
        }
    } 
    
    /**
     * loop parse specified content
     * @param string $syntax
     * @param string $loopElement
     * @param string $element
     * @param int $idx
     * @return array
     */
    private function _loopParseSpecifiedSyntax($syntax, $loopElement, $element = '', $idx = '') {
        $rowsElements = array();
        foreach ($this->_parseSpecifiedSyntax($syntax, $element, $idx) as $rows) {
            $rowElements = array();
            foreach ($rows->find($loopElement) as $row) {
                $rowElements[] = $row->plaintext;
            }
            $rowsElements[] = $rowElements;
        }
        return $rowsElements;
    }

    /**
     * To grab the important content of written into the file
     * @param int $paging
     * @param string $content
     */
    private function _writeElementsLog($paging, $content) {
        Log::instance()->setFilepath(sfConfig::get('sf_log_dir') . DIRECTORY_SEPARATOR . PAGE_LIST_LOG_DIR . DIRECTORY_SEPARATOR . date('YmdH'));
        Log::instance()->setFilename(PAGING_DATA_SETS);
        $uniqueKeys = implode(',', $this->getUniqueKeys($content));
        $pagingSubject = array(
            'page'      => $paging,
            'unique'    => $uniqueKeys,
            'md5'   => $this->_makeUniqueValue($paging, $uniqueKeys),
        );
        $this->setActiveLog($pagingSubject . "\n");
        Log::instance()->write($this->_getActiveLog());
    }

    /**
     * get unique number from per page
     */
    public function getUniqueKeys($content) {
        $trElementList = array();
        self::$html->load($content, false);
        $tableElement = self::$html->find("table[class=baobiao]", 0);
        if ($tableElement) {
            foreach ($tableElement->find("tr") as $trElement) {
                //it is important
                $tdElementList = array();
                foreach ($trElement->find("td") as $tdElement) {
                    $tdElementList[] = $tdElement->innertext;
                }
                $trElementList[] = $this->_matchSpecifiedNumber($tdElementList[0]);
            }
            self::$html->clear();
        }
        array_shift($trElementList);
        return $trElementList;
    }
    
    /**
     * All data encryption every page form a unique value
     * @param int $page
     * @param string $subject
     * @return string
     */
    private function _makeUniqueValue($page, $subject) {
        return md5($page . $subject);
    }

    /**
     * match number 
     * @param string  $subject
     * @return array
     */
    private function _matchSpecifiedNumber($subject) {
        $matches = array(); 
        $patten = "/\d+/";
        preg_match($patten, $subject, $matches);
        return $matches[0];
    }

    /**
     *  get total items  
     */
    public function getTotalItems() {
        $content = $this->requestFirstPage();
        self::$html->load($content, false);
        $totalPageElement = self::$html->find("div[class=function] p span", 0);
        $totalPage = (int)$totalPageElement->plaintext;
        self::$html->clear();
        return $totalPage;
    }
    
    /**
     *  get total pages
     */
    public function getTotalPages() {
        return ceil($this->getTotalItems() / self::PAGE_LIST_SIZE);
    }

}