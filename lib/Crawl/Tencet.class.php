<?php

/**
 * Decomposition of page elements
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Tencent extends Crawl implements Parser {
    //Requires crawling the Web site address
    const PAGE_LIST_SIZE = 100;
    private static $totalPages = 0;
    private static $pageContent = '';
    public  static $html = null;

    public $dbConnect = false;
    public $requestListPage = false;

    public function __construct(simple_html_dom $html) {
        self::$html = $html;
        if ($this->requestListPage) {
            self::$pageContent = $this->requestListFirstPage();
            self::$totalPages = $this->getTotalItems();
        }
    }

    public function request() {
        // $this->_putDetailDataInStorage();
        $this->_putDetailDataInStorage();
    }
    
    /**
     * request per page content
     */
    public function requestListPerPage() {
        for ($index = 147; $index <= $this->getTotalPages(); $index++) {
            $this->requestSpecifiedPage($index);
        }
    }
    
    /**
     * Request to the specified page
     * @param int $index
     */
    public function requestSpecifiedPage($index) {
        $url = TENCERT_PAGE_LIST_URL . '&p=' . $index;
        $content = $this->readPage($url);
        $uniqueKeys = $this->getUniqueKeys($content);
        if ($this->dbConnect == true) {
            DepositRequestPeer::saveRequest($index, implode(",", $uniqueKeys));
        } else {
            $this->_writeElementsLog($index, $uniqueKeys);
        }
    }


    /**
     * get first page content
     * @return string
     */
    public function requestListFirstPage() {
        return $this->readPage(TENCERT_PAGE_LIST_URL);
    }
    
    /**
     * request detail page
     * @param int $urlKey
     */
    public function requestDetailPage($urlKey) {
        $url = TENCERT_PAGE_DETAIL_URL . '&id=' . $urlKey;
        return $this->_parseDetailPage($this->readPage($url));
    }
    
    /**
     * The list data in the database
     * @return mixed
     */
    private function _putListDataInStorage() {
        $uniqueKeys = $this->getUniqueKeys(self::$pageContent);
        if ($this->dbConnect == true) {
            DepositRequestPeer::saveRequest(1, implode(',', $uniqueKeys));
           $this->requestListPerPage();
        } else {
            $this->_writeElementsLog(1, $uniqueKeys);
        }
    }

    /**
     * do with the page detail and insert into database
     * @param int $page
     * @throws Exception
     */
    private function _putDetailDataInStorage($page = 1) {
        $financial = DepositRequestPeer::getUnProcessList($page);
        if ($financial) {
            $explode = explode(',', $financial->getUniqueKeys());
            foreach ($explode as $per => $key) {
                //request url by curl
                $origin = $this->requestDetailPage($key);
                //parse into available fields
                $master = DepositFinancialProductsPeer::parseIntoAvailableFields($origin);
                //save primary table
                $pk = DepositRequestFinancialPeer::saveFinancial($key, $financial->getId());
                //update primary table status
                if ($pk) {
                    DepositRequestFinancialPeer::updateStatusById($pk, $master['status']);
                }
                unset($master['status']);
                DepositFinancialProductsPeer::saveFinacialProducts($master);
                //update process_status
                DepositRequestFinancialPeer::updateProcessStatusById($pk, 2);
                if ($per == 3) {
                    break;
                }
            }
            DepositRequestPeer::updateProcessStatus($page, $financial->getUniqueKeys(), 3);
        }
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
        $region = $this->_parseSpecifiedSyntax("a[class=none_url]");
        foreach ($ulList as $ul) {
            foreach ($ul as $li) {
                $split = explode('：', $li);
                if (SPCIAL_CHARACTER == trim($split[0])) {
                    $splitDate = explode('―', $split[1]);
                    $elementList[SALE_START_DATE] = $splitDate[0];
                    $elementList[SALE_END_DATE]  = $splitDate[1];
                } elseif (SPCIAL_CHARACTER_REGION == trim($split[0])) {
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
        $uniqueKeys = implode(',', $content);
        $pagingSubject = array(
            'page'      => $paging,
            'unique'    => $uniqueKeys,
            'md5'   => $this->_makeUniqueValue($paging, $uniqueKeys),
        );
        Log::instance()->write(implode("\n", $pagingSubject));
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
                if (isset($tdElementList[0])) {
                    $trElementList[] = $this->_matchSpecifiedNumber($tdElementList[0]);
                }
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
     * get region string
     * @param string $subject
     * @return array
     */
    private function _matchRegion($subject) {
        $res = array();
        preg_match_all('/[\x{4e00}-\x{9fa5}]+/u',$subject,$res);
        return $res ? $res[0] : $res;
    }
    
    /**
     *  get total items  
     */
    public function getTotalItems() {
        self::$html->load(self::$pageContent, false);
        $totalPageElement = self::$html->find("div[class=function] p span", 0);
        $totalPage = (int)$totalPageElement->plaintext;
        self::$html->clear();
        return $totalPage;
    }
    
    /**
     *  get total pages
     */
    public function getTotalPages() {
        return ceil(self::$totalPages / self::PAGE_LIST_SIZE);
    }

}