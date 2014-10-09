<?php

/**
 * @package lib\Crawl
 */

/**
 * Decomposition of page elements
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Jnlc extends Crawl implements Parser
{

    const PAGE_TAB_1    = 'newReleasedProducts';
    const PAGE_TAB_2    = 'expiringProducts';
    const PAGE_TAB_3    = 'durationProducts';

    public $pageRows    = 45;
    public $currentPage = 1;

    public $structuralProduct;
    public $pageFilters;
    public $nowDate;
    public $expireDate;
    public $pageTab;
    public $totalItems;
    public $totalPages;

    

    /**
     * construct 
     *
     * @param string $pageTab           page tab string
     * @param string $structuralProduct structural product type
     * @param int    $sleepMinTime      sleep min time
     * @param int    $sleepMaxTime      sleep max time
     *
     * @return void
     * 
     * @issue 2729
     */
    public function __construct($pageTab = self::PAGE_TAB_1, $structuralProduct, $sleepMinTime = 10, $sleepMaxTime = 60) {
        parent::__construct();
        $this->setSleepMinTime($sleepMinTime);
        $this->setSleepMaxTime($sleepMaxTime);
        $this->setstructuralProduct($structuralProduct);
        $this->setPageTab($pageTab);
        $this->nowDate = date('Y-m-d');
        $this->expireDate = date('Y-m-d', strtotime('+6 day'));
        $this->initialization();
    }

    /**
     * Set structuralProduct
     *
     * @param string $structuralProduct structural product type
     *
     * @return void
     *
     * @issue 2729
     */
    protected function setStructuralProduct($structuralProduct) {
        $this->structuralProduct = $structuralProduct;
    }

    /**
     * Set pagetab
     *
     * @param string $pageTab string
     *
     * @return void
     *
     * @issue 2729
     */
    public function setPageTab($pageTab) {
        $this->pageTab = $pageTab;
    }

    /**
     * initialization
     *
     * @return void
     *
     * @issue 2729
     */
    protected function initialization() {
        $this->setTabFilters();

        $formData = http_build_query($this->pageFilters, '', '&');

        $response = $this->sendHttpRequestByCurl(CrawlConfig::JNLC_LIST_PAGE_URL, 1, '', $formData);

        // self::getLogger()->write(sprintf("CONTENT: %s", $response)); 

        $keywords = $this->splitStringByRegularExpression($response);

        $jsonDecode = json_decode($keywords, true);

        $this->totalItems = $jsonDecode['records'];
        $this->totalPages = $jsonDecode['total'];


        $res = $this->processDetailPage($jsonDecode);

        if (count($res) == $this->pageRows) {
            throw new Exception(sprintf("JNLC: reptile script is finished, when page %s after grab the data and found that all the data duplication, stop crawling", $this->currentPage));
            break;
        }

        unset($jsonDecode, $response);

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
        $errorCount = array();
        foreach ($subject['rows'] as $array) {
            $urlKey = $array['id'];
            unset($array);
            $response = $this->sendHttpRequestByCurl(CrawlConfig::JNLC_DETAIL_PAGE_URL . $urlKey);
            // self::getLogger()->write(sprintf("CONTENT: %s", $response)); 
            $jsonString = $this->splitStringByRegularExpression($response);

            $jsonString = json_decode($jsonString, true);

            try {
                if (is_array($jsonString)) {
                    $jnlcAdapter = new JnlcAdapter();
                    $jnlcAdapter->strFinaName       = $jsonString['strFinaName'];
                    $jnlcAdapter->strBankNameSmp    = $jsonString['strBankNameSmp'];
                    $jnlcAdapter->dYqnhsylsx        = $jsonString['dYqnhsylsx'];
                    $jnlcAdapter->strMoneyType      = $jsonString['strMoneyType'];
                    $jnlcAdapter->strProfitType     = $jsonString['strProfitType'];
                    $jnlcAdapter->strLimit          = $jsonString['strLimit'];
                    $jnlcAdapter->sdtFinaEnd        = $jsonString['sdtFinaEnd'];
                    $jnlcAdapter->sdtFinaStart      = $jsonString['sdtFinaStart'];
                    $jnlcAdapter->strFundsInvest    = $jsonString['strFundsInvest'];
                    $jnlcAdapter->sdtSaleStart      = $jsonString['sdtSaleStart'];
                    $jnlcAdapter->sdtSaleEnd        = $jsonString['sdtSaleEnd'];
                    $jnlcAdapter->strSaleWhere      = $jsonString['strSaleWhere'];
                    $jnlcAdapter->strYield          = $jsonString['strYield'];
                    $jnlcAdapter->strEarlStopExpl   = $jsonString['strEarlStopExpl'];
                    $jnlcAdapter->strFeeExpl        = $jsonString['strFeeExpl'];
                    $jnlcAdapter->mInvestStart      = $jsonString['mInvestStart'];
                    
                    DepositFinancialProductsPeer::addFinancialProduct($jnlcAdapter->populate());
                } else {
                    throw new Exception('The json string can not be decode.');
                }
            } catch (Exception $e) {
                $errorCount[$urlKey] = $e->getMessage();
            }
        }
        return $errorCount;
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

            $this->setTabFilters();

            $formData = http_build_query($this->pageFilters, '', '&');

            $response = $this->sendHttpRequestByCurl(CrawlConfig::JNLC_LIST_PAGE_URL, 1, '', $formData);

            // self::getLogger()->write(sprintf("CONTENT: %s", $response)); 

            $keywords = $this->splitStringByRegularExpression($response);

            $jsonDecode = json_decode($keywords, true);

            $this->totalItems = $jsonDecode['records'];
            $this->totalPages = $jsonDecode['total'];

            $res = $this->processDetailPage($jsonDecode);
            if (count($res) == $this->pageRows) {
                throw new Exception(sprintf("JNLC: reptile script is finished, when page %s after grab the data and found that all the data duplication, stop crawling", $this->currentPage));
                break;
            }
            unset($jsonDecode, $response);
        }
    }

    /**
     * Split string by a regular expression
     *
     * @param string $subject split string
     *
     * @return string
     *
     * @issue 2729
     */
    public function splitStringByRegularExpression($subject) {
        $keywords = preg_split("/Date:\s(\w.*)\s\s/", $subject);
        if (isset($keywords[1])) {
            return trim($keywords[1]);    
        }
        return;
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

    }

    /**
     * Set tab filters
     *
     * @return void
     * 
     * @issue 2729
     */
    public function setTabFilters() {
        switch ($this->pageTab) {
            case self::PAGE_TAB_1:
                $this->pageFilters = $this->newReleasedProducts();                
                break;
            case self::PAGE_TAB_2:
                $this->pageFilters = $this->expiringProducts();
                break;
            case self::PAGE_TAB_3:
                $this->pageFilters = $this->durationProducts();
                break;
        }
    }


    /**
     * Crawl new released product tab
     * 
     * @return string
     *
     * @issue 2729
     */
    public function newReleasedProducts() {

        $requestFilterParameters = array(
            'groupOp'   => 'AND',
            'groups'     => array(
                array(
                    'groupOp'   => 'OR',   
                    'rules'     => array(
                        array(
                            'field' => 'sdtSaleEnd',
                            'op'    => 'ge',
                            'data'  => "'" . $this->nowDate . "'", //auto created
                        ),
                        array(
                            'field' => 'sdtSaleStart',
                            'op'    => 'ge',
                            'data'  => "'" . $this->nowDate . "'", //auto created
                        )
                    )
                )
            ),
            'rules'     => array(
                array(
                    'field' => 'strFinaType',
                    'op'    => 'eq',
                    'data'  => "'" . $this->structuralProduct . "'", //replaced
                ),
                array(
                    'field' => 'strSaleTo',
                    'op'    => 'cn',
                    'data'  => '', //auto created
                )
            ),
        );

        $requestParameters = array(
            '_search' => 'true',
            'rows'    => $this->pageRows,//[15,30,45]
            'page'    => $this->currentPage,//total page
            'sidx'    => 'strFinaName',
            'sord'    => 'desc',
            'filters' => json_encode($requestFilterParameters),
        );

        return $requestParameters;
    }

    /**
     * Crawl expiring products tab
     *
     * @return string
     *
     * @issue 2729
     */
    public function expiringProducts() {

        $requestFilterParameters = array(
            'groupOp'   => 'AND',
            'groups'     => array(
                array(
                    'groupOp'   => 'AND',
                    'rules'     => array(
                        array(
                            'field' => 'sdtFinaEnd',
                            'op'    => 'ge',
                            'data'  => "'" . $this->nowDate . "'", //auto created
                        ),
                        array(
                            'field' => 'sdtFinaEnd',
                            'op'    => 'le',
                            'data'  => "'" . $this->expireDate . "'", //auto created
                        )
                    )
                )
            ),
            'rules'     => array(
                array(
                    'field' => 'strFinaType',
                    'op'    => 'eq',
                    'data'  => "'" . $this->structuralProduct . "'", //replaced
                ),
                array(
                    'field' => 'strSaleTo',
                    'op'    => 'cn',
                    'data'  => '', //auto created
                )
            ),
        );

        $requestParameters = array(
            '_search' => 'true',
            'rows'    => $this->pageRows,//[15,30,45]
            'page'    => $this->currentPage,//total page
            'sidx'    => 'strFinaName',
            'sord'    => 'desc',
            'filters' => json_encode($requestFilterParameters),
        );
        return $requestParameters;
    }


    /**
     * Crawl duration product tab
     *
     * @return string
     *
     * @issue 2729
     */
    public function durationProducts() {
        $requestFilterParameters = array(
            'groupOp'   => 'AND',
            'groups'     => array(
                array(
                    'groupOp'   => 'AND',
                    'rules'     => array(
                        array(
                            'field' => 'sdtSaleEnd',
                            'op'    => 'lt',
                            'data'  => "'" . $this->nowDate . "'", //auto created
                        ),
                        array(
                            'field' => 'sdtFinaEnd',
                            'op'    => 'ge',
                            'data'  => "'" . $this->nowDate . "'", //auto created
                        )
                    )
                )
            ),
            'rules'     => array(
                array(
                    'field' => 'strFinaType',
                    'op'    => 'eq',
                    'data'  => "'" . $this->structuralProduct . "'", //replaced
                ),
                array(
                    'field' => 'strSaleTo',
                    'op'    => 'cn',
                    'data'  => '', //auto created
                )
            ),
        );

        $requestParameters = array(
            '_search' => 'true',
            'rows'    => $this->pageRows,//[15,30,45]
            'page'    => $this->currentPage,//total page
            'sidx'    => 'strFinaName',
            'sord'    => 'desc',
            'filters' => json_encode($requestFilterParameters),
        );
        return $requestParameters;
    }
    
}