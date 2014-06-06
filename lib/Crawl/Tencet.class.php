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
    const PAGE_LIST_SIZE = 100;

    protected static $totalPages = 0;
    protected static $pageContent = null;

    public static $html = null;
    public $jumpOutTest = false;

    private static $_resetListPageHead = array();
    private $_totalDefaultFilter = "div[class=function] p span";
    private $_totalOtherFilter = array();

    /**
     * construct
     *
     * @param object $html             simple_html_dom
     * @param array  $totalOtherFilter get total list page condition
     *
     * @issue 2568
     * @return null
     */
    public function __construct(simple_html_dom $html, $totalOtherFilter = array()) {
        self::$html = $html;
        //get to meet the demand conditions
        self::$pageContent = $this->requestListPageContent();
        self::$totalPages = $this->getTotalItems();
        if ($totalOtherFilter) {
            $this->_totalOtherFilter = $totalOtherFilter;
            self::$_resetListPageHead = $this->_resetListPageThead();
        }
    }

    /**
     * request api
     *
     * @issue 2568
     * @return null
     */
    public function request() {
        try {
            $this->requestListPerPage();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * request per page content
     *
     * @issue 2568
     * @return null
     */
    public function requestListPerPage() {
        for ($index = 1; $index <= $this->getTotalPages(); $index++) {
            $content = $this->requestListPageContent($index);
            try {
                $success = $this->_saveListSpecifiedContent($index, $content);
                if ($success === false) {
                    throw new Exception(sprintf('Page %s loop stop!', $index));
                    break;
                }
                //break the loop list
                if ($this->_totalOtherFilter) {
                    $this->_breakLoopFilter($content);
                }
            } catch (Exception $e) {
                throw $e;
                break;
            }
        }
    }

    /**
     * save the specified list page content
     *
     * @param int    $index       page number
     * @param string $listContent page content
     *
     * @issue 2568
     * @return mixed
     */
    private function _saveListSpecifiedContent($index, $listContent) {
        $error = array();
        //for testting
        if ($index == $this->jumpOutTest) {
            throw new Exception('Testting done!');
        }
        $uniqueKeys = $this->getUniqueKeys($listContent);
        if ($this->isDebug) {
            // put in the log file
            $this->_writeElementsLog($index, implode(',', $uniqueKeys));
        }
        // put in the database
        foreach ($uniqueKeys as $primaryKey) {
            try {
                $this->_putPerDetailDataInStorage($primaryKey);
            } catch (Exception $e) {
                $error[] = $e->getMessage();
            }
        }
        if (count($error) == count($uniqueKeys)) {
            return false;
        }
        return $error;
    }

    /**
     * get per list page content
     *
     * @param int $page page number
     *
     * @issue 2568
     * @return string
     */
    public function requestListPageContent($page = '') {
        if ($page) {
            $url = CrawlConfig::TENCERT_PAGE_LIST_URL . '&p=' . $page;
        } else {
            $url = CrawlConfig::TENCERT_PAGE_LIST_URL;
        }
        return $this->readPage($url);
    }

    /**
     * request detail page
     *
     * @param int $urlKey url parmary key
     *
     * @issue 2568
     * @return string
     */
    public function requestDetailPage($urlKey) {
        $url = CrawlConfig::TENCERT_PAGE_DETAIL_URL . '&id=' . $urlKey;
        return $this->_parseDetailPage($this->readPage($url));
    }

    /**
     * save per detail page to database
     *
     * @param string $primaryKey unique key
     *
     * @issue 2568
     * @return null
     */
    private function _putPerDetailDataInStorage($primaryKey) {
        //request url by curl
        $origin = $this->requestDetailPage($primaryKey);
        //parse into available fields
        $master = DepositFinancialProductsPeer::parseIntoAvailableFields($origin);
        //save primary table
        try {
            $requestFinancial = DepositRequestFinancialPeer::saveFinancial($primaryKey, $master['status']);
            unset($master['status']);
            $master['deposit_request_financial_id'] = $requestFinancial->getId();
            DepositFinancialProductsPeer::saveFinacialProducts($master);
            //update process_status
            $requestFinancial->setProcessStatus(2);
            $requestFinancial->save();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Parsing the page structure
     *
     * @param string $content detail content
     *
     * @issue 2568
     * @return mixed
     */
    private function _parseDetailPage($content) {
        self::$html->load($content, false);
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
     *
     * @issue 2568
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
     * parse detail's page table thead structure
     *
     * @param string $thead head content
     *
     * @issue 2568
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
     *
     * @param string $tbody tbody content
     *
     * @issue 2568
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
            return $idx ? self::$html->find($syntax) : self::$html->find($syntax, $idx);
        }
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
     * To grab the important content of written into the file
     *
     * @param int    $paging     page number
     * @param string $uniqueKeys keys string
     *
     * @issue 2568
     * @return  null
     */
    private function _writeElementsLog($paging, $uniqueKeys) {
        Log::instance()->setFilename(CrawlConfig::PAGING_DATA_SETS);
        $pagingSubject = array(
            'page'      => $paging,
            'unique'    => $uniqueKeys,
            'md5'   => $this->_makeUniqueValue($uniqueKeys),
        );
        Log::instance()->write(implode("\n", $pagingSubject));
    }

    /**
     * get unique number from per page
     *
     * @param string $content content
     *
     * @issue 2568
     * @return array
     */
    public function getUniqueKeys($content) {
        return $this->_parseListPageTableContent($content, false);
    }

    /**
     * All data encryption every page form a unique value
     *
     * @param string $subject subject
     *
     * @issue 2568
     * @return string
     */
    private function _makeUniqueValue($subject) {
        return md5($subject);
    }

    /**
     * match number
     *
     * @param string $subject subject
     *
     * @issue 2568
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
     * get total items
     *
     * @issue 2568
     * @return int
     */
    public function getTotalItems() {
        return $this->_getDefaultFitlerTotal();
    }

    /**
     * get total by default total filter
     *
     * @issue 2568
     * @return int total number
     */
    private function _getDefaultFitlerTotal () {
        self::$html->load(self::$pageContent, false);
        $defaultTotalFilter = $this->_parseSpecifiedSyntax($this->_totalDefaultFilter);
        return (int)$defaultTotalFilter->plaintext;
    }

    /**
     * get total pages
     *
     * @issue 2568
     * @return int
     */
    public function getTotalPages() {
        return ceil(self::$totalPages / self::PAGE_LIST_SIZE);
    }

    /**
     * parse list page table head
     *
     * @issue 2568
     * @return array
     */
    private function _parseListPageThead() {
        self::$html->load(self::$pageContent);
        $thead = $this->_loopParseSpecifiedSyntax("table[class=baobiao] tr", "th");
        return $thead[0];
    }

    /**
     * reset list page head element for matching
     *
     * @issue 2568
     * @return array
     */
    private function _resetListPageThead() {
        $resetTotalOtherFilter = array();
        $tableHead = $this->_parseListPageThead();
        $filpTableHead = array_flip($tableHead);
        foreach ($this->_totalOtherFilter as $outCondition => $outValue) {
            if (in_array($outCondition, $tableHead)) {
                $resetTotalOtherFilter[$filpTableHead[$outCondition]] = $outValue;
            }
        }
        return $resetTotalOtherFilter;
    }

    /**
     * break the loop list condition
     *
     * @param string $listContent list page content
     *
     * @issue 2568
     * @return boolean
     */
    private function _breakLoopFilter($listContent) {
        $tableBody = $this->_parseListPageTableContent($listContent);
        $outConditionsKeys = array_keys(self::$_resetListPageHead);
        foreach ($tableBody as $tds) {
            foreach ($tds as $key => $td) {
                if (in_array($key, $outConditionsKeys)) {
                    //diff time
                    $diffTime = strtotime($td);
                    $diffedTime = strtotime(self::$_resetListPageHead[$key]);
                    if ( $diffTime < $diffedTime) {
                        throw new Exception(sprintf("%s does not meet the conditions of the current page!", $td));
                    }
                }
            }
        }
    }

    /**
     * get table content of per list page
     *
     * @param string  $listContent per list page content
     * @param boolean $isGetAll    true is get all table element
     *
     * @issue 2568
     * @return array
     */
    private function _parseListPageTableContent($listContent, $isGetAll = true) {
        $trElementList = array();
        self::$html->load($listContent, false);
        $tableElement = self::$html->find("table[class=baobiao]", 0);
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
        self::$html->clear();
        return $trElementList;
    }
}
