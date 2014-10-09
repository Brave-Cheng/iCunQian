<?php

/**
 * @package lib\model
 */

/**
 * Subclass for performing query and update operations on the 'deposit_financial_products' table.
 *
 */
class DepositFinancialProductsPeer extends BaseDepositFinancialProductsPeer
{

    const PHPNAME_NAME                      = 'Name';
    const PHPNAME_BANK_NAME                 = 'BankName';
    const PHPNAME_EXPECTED_RATE             = 'ExpectedRate';
    const PHPNAME_CURRENCY                  = 'Currency';
    const PHPNAME_PROFIT_TYPE               = 'ProfitType';
    const PHPNAME_INVEST_CYCLE              = 'InvestCycle';
    const PHPNAME_DEADLINE                  = 'Deadline';
    const PHPNAME_PROFIT_START_DATE         = 'ProfitStartDate';
    const PHPNAME_TARGET                    = 'Target';
    const PHPNAME_SALE_START_DATE           = 'SaleStartDate';
    const PHPNAME_SALE_END_DATE             = 'SaleEndDate';
    const PHPNAME_REGION                    = 'Region';
    const PHPNAME_PROFIT_DESC               = 'ProfitDesc';
    const PHPNAME_STOP_CONDITION            = 'StopCondition';
    const PHPNAME_COST                      = 'Cost';
    const PHPNAME_INVEST_START_AMOUNT       = 'InvestStartAmount';
    const PHPNAME_BANK_ID                   = 'BankId';
    const PHPNAME_STATUE                    = 'Status';
    const PHPNAME_ACTUAL_RATE               = 'ActualRate';
    const PHPNAME_PAY_PERIOD                = 'PayPeriod';
    const PHPNAME_INVEST_INCREASE_AMOUNT    = 'InvestIncreaseAmount';
    const PHPNAME_INVEST_SCOPE              = 'InvestScope';
    const PHPNAME_RAISE_CONDITION           = 'RaiseCondition';
    const PHPNAME_PURCHASE                  = 'Purchase';
    const PHPNAME_FEATURE                   = 'Feature';
    const PHPNAME_EVENTS                    = 'Events';
    const PHPNAME_WARNINGS                  = 'Warnings';
    const PHPNAME_ANNOUNCE                  = 'Announce';



    const SYNC_ADD    = 0;
    const SYNC_EDIT   = 1;
    const SYNC_DELETE = 2;
    const DATE_NULL   = '1970-01-01';

    const EXPECTED_RATE_FIELD = 'expected_rate';
    const INVEST_CYCLE_FIELD  = 'invest_cycle';
    const ACTUAL_RATE_FIELD = 'actual_rate';


    public static $syncStatus = array(
        self::SYNC_ADD    => '新增',
        self::SYNC_EDIT   => '修改',
        self::SYNC_DELETE => '删除',
    );
    
    public static $convertFieldTypeToFloat = array(
        'expected_rate',
        'actual_rate',
    );

    public static $convertFieldTypeToInt = array(
        'invest_start_amount',
        'invest_increase_amount',
        'invest_cycle'
    );


    const SEARCH_COUNT_1 = 1;
    const SEARCH_COUNT_2 = 2;
    const SEARCH_COUNT_3 = 3;
    const SEARCH_COUNT_4 = 4;
    const SEARCH_COUNT_5 = 5;
    const SEARCH_COUNT_6 = 6;

    const DUPLICATE_KEY  = 'Duplicate entry';

    const BANK_INTEREST = 0.35;

    const PERCENT = '%';
    const TEN_THOUSAND_YUAN = '万元';
    const MONTH = '个月';

    const DAYS_SALE = '%s天后发售';
    const DAYS_SALING = '正在发售';
    const DAYS_SALED = '过期';

    /**
     * Get search sale start amount 
     *
     * @return array
     *
     * @issue 2659
     */
    public static function getSearchSaleStartAmount() {
        return array(
            self::SEARCH_COUNT_1 => array(0, 5000), 
            self::SEARCH_COUNT_2 => array(5000, 10000),
            self::SEARCH_COUNT_3 => array(10000, 20000),
            self::SEARCH_COUNT_4 => array(20000, 50000),
            self::SEARCH_COUNT_5 => array(50000, 100000),
            self::SEARCH_COUNT_6 => array(100000, ''),
        );
    }

    /**
     * Get search range by key
     *
     * @param string $rangeKey key string
     *
     * @return array
     *
     * @issue 2659
     */
    public static function getSearchFilterByKey($rangeKey) {
        $adapter = Config::getInstance('CrawlConfig')->getAttributeAdapter();
        $range = array();
        if (array_key_exists($rangeKey, $adapter)) {
            $tempRange = array_keys($adapter[$rangeKey]);
            foreach ($tempRange as $key => $value) {
                $key++;
                $range[$key] = $value;
            }
        }
        return $range;
    }


    /**
     * Parsed into identifiable data
     *
     * @param array $crawl origon crawl data
     *
     * @issue 2568
     * @return array
     */
    static public function parseIntoIdentifiableFields($crawl) {
        $fields = array();
        if ($crawl) {
            foreach ($crawl as $dictionary => $string) {
                foreach (Config::getInstance('CrawlConfig')->getDictionaryAdapter() as $field => $dictionaryArray) {
                    if (in_array($dictionary, $dictionaryArray)) {
                        $string = $string == '-' ? 0 : $string;
                        $fields[$field] = $string;
                    }
                }
            }
        }
        return $fields;
    }

    /**
     * Parsed into available data
     *
     * @param array $data master crawl data
     *
     * @issue 2568
     * @return array
     */
    static public function parseIntoAvailableFields($data) {
        $newData = array();
        $data = self::parseIntoIdentifiableFields($data);
        if(!$data){
            return false;
        }
        $adapter = array_keys(Config::getInstance('CrawlConfig')->getAttributeAdapter());
        foreach ($data as $fieldKey => $fieldValue) {
            //Transformation of corresponding value field
            if (in_array($fieldKey, $adapter)) {
                //save attribute
                $newData[$fieldKey] = DepositAttributesPeer::fetchStandardAdapter($fieldValue);
            } elseif (in_array($fieldKey, self::$convertFieldTypeToFloat)) {
                $newData[$fieldKey] = floatval($fieldValue);
            } elseif (in_array($fieldKey, self::$convertFieldTypeToInt)) {
                $newData[$fieldKey] = intval($fieldValue);
            } else {
                $newData[$fieldKey] = $fieldValue;
            }
        }
        return $newData;
    }


    /**
     * set filter to query
     *
     * @param array   $filters    filter array
     * @param string  $order      order
     * @param int     $limit      limit number
     * @param boolean $total      total query condition
     * @param int     $offset     offset
     * @param boolean $bankFilter true is add bank criteria 
     *
     * @issue 2568, 2659
     * @return string
     */
    static public function filterQuerySql($filters = array(), $order = null, $limit = 1, $total = false, $offset = 0, $bankFilter = false) {

        if ($bankFilter == false) {
            $bankFields = array(DepositBankPeer::SHORT_NAME, DepositBankPeer::SHORT_CHAR, DepositBankPeer::PHONE);
            $bankFields = array_map('strtolower', $bankFields);
            $queryFields = implode(',', self::getFilterQueryFields())  . ' , ' . implode(',', $bankFields);
        } else {
            $queryFields = implode(',', self::getFilterQueryFields());
        }

        $sql = sprintf("SELECT %s FROM %s", $queryFields, DepositFinancialProductsPeer::TABLE_NAME);
        
        $sql .= sprintf(" LEFT JOIN %s ON %s = %s", DepositBankPeer::TABLE_NAME, DepositBankPeer::ID, DepositFinancialProductsPeer::BANK_ID);    

        $orderBy = $order ? $order : ' ORDER BY ' . DepositFinancialProductsPeer::UPDATED_AT . ' ASC ';

        $where = ' WHERE 1';

        if ($filters) {
            foreach ($filters as $key => $filter) {
                if ($key == DepositFinancialProductsPeer::STATUS) {
                    if (!isset($filters[DepositFinancialProductsPeer::STATUS])) {
                        $where .= ' AND ' . DepositAttributesPeer::getValidStatus();        
                    } else {
                        $where .= ' AND ' . DepositAttributesPeer::getValidStatus(true);
                    }
                } else {
                    $where .= is_string($key) ? " AND {$key} {$filter}" : " AND {$filter}";    
                }
            }
        }
        $where .= sprintf(' AND %s = 1', DepositBankPeer::IS_VALID);  

        if ($total) {
            $countSql = str_replace(implode(',', self::getFilterQueryFields()), " COUNT(*) AS total", $sql . $where);
            return $countSql;
        }
        return $sql . $where . $orderBy . ' LIMIT ' . ($offset ? $offset . ' , ' : '') . $limit;
    }

    /**
     * Get query fields
     *
     * @issue 2568, 2658
     * 
     * @return string
     */
    public static function getFilterQueryFields() {

        $fields = DepositFinancialProductsPeer::getFieldNames(BasePeer::TYPE_COLNAME);

        $fields = array_map('strtolower', $fields);
        
        return $fields;
    }

    /**
     * fetch filter List
     *
     * @param array   $filters          filter array
     * @param string  $order            order
     * @param int     $limit            limit number
     * @param int     $offset           offset
     * @param array   $unecessaryFields unecessary field
     * @param boolean $actualStatus     true is use logic
     * @param boolean $noQueryList      true is not query sql and return total
     * @param boolean $noBankFileds     true is no get bank fields
     *
     * @issue 2568, 2659, 2681, 2700
     * 
     * @return mixed 
     */
    static public function getFilterProducts($filters = array(), $order = null, $limit = 1, $offset = 0, $unecessaryFields = array(), $actualStatus = false, $noQueryList = false, $noBankFileds = false) {
        $rows = array();
        $total = true;
        
        $totalRecord = self::getTotal(self::filterQuerySql($filters, $order, $limit, $total));

        if ($noQueryList) {
            return $totalRecord;        
        }

        $filterSql = self::filterQuerySql($filters, $order, $limit, false, $offset, $noBankFileds);

        $rows = self::getFormatProduct($filterSql, $unecessaryFields, $actualStatus);

        return array('list' => $rows, 'total' => $totalRecord);
    }


    /**
     * Get specify product
     *
     * @param int $productId product primary key
     *
     * @return array
     *
     * @issue 2553
     */
    public static function getSpecifyProduct($productId) {
        $bankFields = array(DepositBankPeer::SHORT_NAME, DepositBankPeer::SHORT_CHAR, DepositBankPeer::PHONE);
        $bankFields = array_map('strtolower', $bankFields);
        $queryFields = implode(',', self::getFilterQueryFields())  . ' , ' . implode(',', $bankFields);

        $sql = sprintf("SELECT %s FROM %s", $queryFields, DepositFinancialProductsPeer::TABLE_NAME);
        
        $sql .= sprintf(" LEFT JOIN %s ON %s = %s", DepositBankPeer::TABLE_NAME, DepositBankPeer::ID, DepositFinancialProductsPeer::BANK_ID);    

        $orderBy = $order ? $order : ' ORDER BY ' . DepositFinancialProductsPeer::UPDATED_AT . ' ASC ';

        $where = ' WHERE 1';

        $sql .= $where;

        $sql .= sprintf(" AND %s = %s", DepositFinancialProductsPeer::ID, $productId);

        return self::getFormatProduct($sql);
    }

    /**
     * Get format products
     *
     * @param string  $sql              sql string
     * @param array   $unecessaryFields unecessary field
     * @param boolean $actualStatus     true is use logic
     *
     * @return array
     *
     * @issue 2646
     */
    public static function getFormatProduct($sql, $unecessaryFields = array(), $actualStatus = false) {
        $con = Propel::getConnection();
        $statement = $con->prepareStatement($sql);
        $resultsets = $statement->executeQuery();
        while ($resultsets->next()) {
            //handle per row
            $row = $resultsets->getRow();
            
            foreach ($row as $fieldKey => $fieldValue) {
                //special value
                if ($fieldValue == DepositFinancialProductsPeer::DATE_NULL){
                    $row[$fieldKey] = '';
                }
                if ($fieldKey == DepositFinancialProductsPeer::EXPECTED_RATE_FIELD
                    || $fieldKey == DepositFinancialProductsPeer::ACTUAL_RATE_FIELD) {
                    $row[$fieldKey] = number_format($fieldValue, 2, '.', '');
                }
                if ($fieldKey == DepositFinancialProductsPeer::INVEST_CYCLE_FIELD) {
                    $row[$fieldKey] = number_format($fieldValue, 0, '.', '');
                }
                if ($actualStatus && $fieldKey == 'status') {
                    $row[$fieldKey] = DepositFinancialProductsPeer::getActualStatus($row['sale_start_date'], $row['sale_end_date'], $row['deadline']);
                }
                if ($unecessaryFields && in_array($fieldKey, $unecessaryFields)) {
                    unset($row[$fieldKey]);
                }
            }
            unset($row['bank_name']);
            ksort($row);
            $rows[] = $row;
        }
        return $rows;
    }


    /**
     * get total products
     *
     * @param string $query total sql
     *
     * @issue 2556
     * @return int
     */
    static public function getTotal($query) {
        $connection = Propel::getConnection();
        $statement = $connection->prepareStatement($query);
        $resultset = $statement->executeQuery();
        $resultset->next();
        return $resultset->getInt('total');
    }


    /**
     * populate attribute
     *
     * @param int $id primary key
     *
     * @issue 2568
     * @return obejct
     */
    static public function populateAttributes($id) {
        $attribute = array();
        $attributes = DepositAttributesPeer::retrieveByPK($id);
        if ($attributes) {
            $attribute['id'] = $attributes->getId();
            $attribute['var'] = $attributes->getValue();
        }
        return $attribute;
    }


    /**
     * parase table fields to chinese
     *
     * @param string $platform platform name
     * @param string $test     platform test data 
     * @param string $field    field name
     *
     * @issue 2580
     * @return mixed field chinese or fields list
     */
    public static function translateFieldsMaps($platform = null, $test = null, $field = null) {
        $platform = $platform ? $platform : DepositExcel::TENCERT;
        if ($test) {
            $map = 'get' . ucfirst($platform) . 'TestData';
        } else {
            $map = 'get' . ucfirst($platform) . 'Maps';
        }
        return self::$map($field);    
    }

    /**
     * get Tencert fields map
     *
     * @param string $field field name
     *
     * @issue 2580
     * @return mixed
     */
    public static function getTencertMaps($field = null) {
        $fields = array(
            'name'                      => util::getMultiMessage('Product Name'),
            'bank_name'                 => util::getMultiMessage('Product Bank Name'),
            'sale_start_date'           => util::getMultiMessage('Product Sale Start Date'),
            'sale_end_date'             => util::getMultiMessage('Product Sale End Date'),
            'deadline'                  => util::getMultiMessage('Product Deadline'),
            'currency'                  => util::getMultiMessage('Product Currency'),
            'invest_cycle'              => util::getMultiMessage('Product Invest Cycle'),
            'invest_start_amount'       => util::getMultiMessage('Product Invest Start Amount'),
            'expected_rate'             => util::getMultiMessage('Product Expected Rate'),
            'actual_rate'               => util::getMultiMessage('Product Actual Rate'),
            'profit_type'               => util::getMultiMessage('Product Profit Type'),
            'region'                    => util::getMultiMessage('Product Region Name'),
            'target'                    => util::getMultiMessage('Product Target'),
            'profit_start_date'         => util::getMultiMessage('Product Profit Start Date'),
            'pay_period'                => util::getMultiMessage('Product Pay Period'),
            'invest_increase_amount'    => util::getMultiMessage('Product Invest Increase Amount'),
            'profit_desc'               => util::getMultiMessage('Product Profit Desc'),
            'invest_scope'              => util::getMultiMessage('Product Invest Scope'),
            'stop_condition'            => util::getMultiMessage('Product Stop Condition'),
            'raise_condition'           => util::getMultiMessage('Product Raise Condition'),
            'purchase'                  => util::getMultiMessage('Product Purchase'),
            'cost'                      => util::getMultiMessage('Product Cost'),
            'feature'                   => util::getMultiMessage('Product Feature'),
            'events'                    => util::getMultiMessage('Product Events'),
            'warnings'                  => util::getMultiMessage('Product Warnings'),
            'announce'                  => util::getMultiMessage('Product Announce'),
        );
        if ($field) {
            return $fields[$field];
        }
        return $fields;
    }

    /**
     * Get tencert test data
     *
     * @return array
     *
     * @issue 2580
     */
    public static function getTencertTestData() {
        return array(
            'name'                      => util::getMultiMessage('Product Test Name'),
            'bank_name'                 => util::getMultiMessage('Product Test Bank Name'),
            'sale_start_date'           => util::getMultiMessage('Product Test Sale Start Date'),
            'sale_end_date'             => util::getMultiMessage('Product Test Sale End Date'),
            'deadline'                  => util::getMultiMessage('Product Test Deadline'),
            'currency'                  => util::getMultiMessage('Product Test Currency'),
            'invest_cycle'              => util::getMultiMessage('Product Test Invest Cycle'),
            'invest_start_amount'       => util::getMultiMessage('Product Test Invest Start Amount'),
            'expected_rate'             => util::getMultiMessage('Product Test Expected Rate'),
            'actual_rate'               => util::getMultiMessage('Product Test Actual Rate'),
            'profit_type'               => util::getMultiMessage('Product Test Profit Type'),
            'region'                    => util::getMultiMessage('Product Test Region Name'),
            'target'                    => util::getMultiMessage('Product Test Target'),
            'profit_start_date'         => util::getMultiMessage('Product Test Profit Start Date'),
            'pay_period'                => util::getMultiMessage('Product Test Pay Period'),
            'invest_increase_amount'    => util::getMultiMessage('Product Test Invest Increase Amount'),
            'profit_desc'               => util::getMultiMessage('Product Test Profit Desc'),
            'invest_scope'              => util::getMultiMessage('Product Test Invest Scope'),
            'stop_condition'            => util::getMultiMessage('Product Test Stop Condition'),
            'raise_condition'           => util::getMultiMessage('Product Test Raise Condition'),
            'purchase'                  => util::getMultiMessage('Product Test Purchase'),
            'cost'                      => util::getMultiMessage('Product Test Cost'),
            'feature'                   => util::getMultiMessage('Product Test Feature'),
            'events'                    => util::getMultiMessage('Product Test Events'),
            'warnings'                  => util::getMultiMessage('Product Test Warnings'),
            'announce'                  => util::getMultiMessage('Product Test Announce'),
        );
    }

    /**
     * get jnlc fields map
     *
     * @param string $field field name
     *
     * @issue 2580
     * @return mixed
     */
    public static function getJnlcMaps($field = null) {
        $fields = array(
            'name'                          => util::getMultiMessage('Product Name'),
            'bank_name'                     => util::getMultiMessage('Product Bank Name'),
            'currency'                      => util::getMultiMessage('Product Currency'),
            'sale_start_date'               => util::getMultiMessage('Product Sale Start Date'),
            'sale_end_date'                 => util::getMultiMessage('Product Sale End Date'),
            'invest_start_amount'           => util::getMultiMessage('Product Invest Start Amount'),
            'invest_cycle'                  => util::getMultiMessage('Product Invest Cycle'),
            'expected_rate'                 => util::getMultiMessage('Product Expected Rate'),
            'profit_type'                   => util::getMultiMessage('Product Profit Type'),
            'deadline'                      => util::getMultiMessage('Product Deadline'),
            'target'                        => util::getMultiMessage('Product Target'),
            'region'                        => util::getMultiMessage('Product Region Name'),
            'actual_rate'                   => util::getMultiMessage('Product Actual Rate'),
            'profit_start_date'             => util::getMultiMessage('Product Profit Start Date'),
            'pay_period'                    => util::getMultiMessage('Product Pay Period'),
            'invest_increase_amount'        => util::getMultiMessage('Product Invest Increase Amount'),
            'profit_desc'                   => util::getMultiMessage('Product Profit Desc'),
            'invest_scope'                  => util::getMultiMessage('Product Invest Scope'),
            'stop_condition'                => util::getMultiMessage('Product Stop Condition'),
            'raise_condition'               => util::getMultiMessage('Product Raise Condition'),
            'purchase'                      => util::getMultiMessage('Product Purchase'),
            'cost'                          => util::getMultiMessage('Product Cost'),
            'feature'                       => util::getMultiMessage('Product Feature'),
            'events'                        => util::getMultiMessage('Product Events'),
            'warnings'                      => util::getMultiMessage('Product Warnings'),
            'announce'                      => util::getMultiMessage('Product Announce'),
        );
        if ($field) {
            return $fields[$field];
        }
        return $fields;
    }

    /**
     * Get JNLC test data
     *
     * @return array
     *
     * @issue 2580
     */
    public static function getJnlcTestData() {
        return array(
            'name'                          => util::getMultiMessage('Product Test Name'),
            'bank_name'                     => util::getMultiMessage('Product Test Bank Name'),
            'currency'                      => util::getMultiMessage('Product Test Currency'),
            'sale_start_date'               => util::getMultiMessage('Product Test Sale Start Date'),
            'sale_end_date'                 => util::getMultiMessage('Product Test Sale End Date'),
            'invest_start_amount'           => util::getMultiMessage('Product Test Invest Start Amount'),
            'invest_cycle'                  => util::getMultiMessage('Product Test Invest Cycle'),
            'expected_rate'                 => util::getMultiMessage('Product Test Expected Rate'),
            'profit_type'                   => util::getMultiMessage('Product Test Profit Type'),
            'deadline'                      => util::getMultiMessage('Product Test Deadline'),
            'target'                        => util::getMultiMessage('Product Test Target'),
            'region'                        => util::getMultiMessage('Product Test Region Name'),
            'actual_rate'                   => util::getMultiMessage('Product Test Actual Rate'),
            'profit_start_date'             => util::getMultiMessage('Product Test Profit Start Date'),
            'pay_period'                    => util::getMultiMessage('Product Test Pay Period'),
            'invest_increase_amount'        => util::getMultiMessage('Product Test Invest Increase Amount'),
            'profit_desc'                   => util::getMultiMessage('Product Test Profit Desc'),
            'invest_scope'                  => util::getMultiMessage('Product Test Invest Scope'),
            'stop_condition'                => util::getMultiMessage('Product Test Stop Condition'),
            'raise_condition'               => util::getMultiMessage('Product Test Raise Condition'),
            'purchase'                      => util::getMultiMessage('Product Test Purchase'),
            'cost'                          => util::getMultiMessage('Product Test Cost'),
            'feature'                       => util::getMultiMessage('Product Test Feature'),
            'events'                        => util::getMultiMessage('Product Test Events'),
            'warnings'                      => util::getMultiMessage('Product Test Warnings'),
            'announce'                      => util::getMultiMessage('Product Test Announce'),
        );
    }

    /**
     * save data list
     *
     * @param array $master saved fields
     *
     * @issue 2580, 2579
     * 
     * @return DepositFinancialProducts
     */
    public static function saveProducts($master) {
        $products = null;
        $newData = array();
        if (empty($master)) {
            throw new Exception('No data to save. the reptile data is empty!');
        }
        try {
            foreach ($master as $key => $value) {
                //do bank info
                if ($key == 'bank_name') {
                    $bankId = DepositBankAliasPeer::getBankIdByAliasName($value);
                    if (is_null($bankId)) {
                        throw new Exception('Add a new bank failed.');
                    }
                    $key = 'bank_id';
                    $value = $bankId;
                }
                //NULL 
                if (is_null($value)) {
                    $value = '';
                }
                $replace = explode("_", $key);
                $turned = array_map('ucfirst', $replace);
                $newData[implode($turned)] = $value;
            }
            if (!empty($newData['Pk'])) {
                $products = DepositFinancialProductsPeer::retrieveByPK($newData['Pk']);
            } else {
                $products = new DepositFinancialProducts();
            }
            $products->fromArray($newData);
            $products->save();
            return $products;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a new financial product
     *
     * @param array $subject product array
     * 
     * @return obejct
     * 
     * @issue 2729
     * 
     */
    public static function addFinancialProduct($subject) {

        $products = new DepositFinancialProducts();

        foreach ($subject as $key => $field) {
            if ($key == DepositFinancialProductsPeer::PHPNAME_BANK_NAME) {
                $bankId = DepositBankAliasPeer::getBankIdByAliasName($field);
                if (!$bankId) {
                    throw new Exception("Add a new bank failed.");
                }
                $subject[DepositFinancialProductsPeer::PHPNAME_BANK_ID] = $bankId;
                unset($subject[$key]);
            }
        }

        $products->fromArray($subject);
        $products->save();
        return $products;
    }

    

    /**
     * Update bank id
     *
     * @return null
     *
     * @issue 2614
     */
    public static function updateOldBankId() {
        $criteria = new Criteria();
        $banks = DepositFinancialProductsPeer::doSelect($criteria);
        foreach ($banks as $bank) {
            $bankId = DepositBankAliasPeer::getBankIdByAliasName($bank->getBankName());
            $bank->setBankId($bankId);
            $bank->save();
        }
    }

    /**
     * Check if is valid product
     *
     * @param int $productId primary key
     *
     * @return object DepositFinancialProducts
     *
     * @issue 2632
     */
    public static function verifyProduct($productId) {
        $product = DepositFinancialProductsPeer::retrieveByPK($productId);
        if (!$product) {
            throw new Exception("The product is not exist");
        }
        return $product;
    }


    /**
     * Get actual status by times
     *
     * @param string $saleStartDate date string
     * @param string $saleEndDate   date string
     * @param string $deadline      date string
     *
     * @return string 
     *
     * @issue 2579
     */
    public static function getActualStatus($saleStartDate, $saleEndDate, $deadline) {

        $currentTime = time();
        $deadline = strtotime($deadline);
        $saleStartDate = strtotime($saleStartDate);
        $saleEndDate = strtotime($saleEndDate);

        $statusList = Config::getInstance('CrawlConfig')->getStatus();
        if ($deadline && $currentTime >= $deadline) {
            return $statusList[3];
        }

        if ($currentTime > $saleStartDate && $currentTime < $saleEndDate ) {
            return $statusList[1];
        }
        
        return $statusList[2];
    }



}
