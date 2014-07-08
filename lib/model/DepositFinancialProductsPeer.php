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
    public static $investCycle = array(
        1 => '1个月',
        2 => '1-3个月',
        3 => '3-6个月',
        4 => '6-12个月',
        5 => '1-2年',
        6 => '大于两年',
        7 => '无固定期限',
    );

    const SYNC_ADD    = 0;
    const SYNC_EDIT   = 1;
    const SYNC_DELETE = 2;

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
     * save finacial product
     *
     * @param array $listData data
     *
     * @issue 2568
     * @return mixed
     */
    static public function saveFinacialProducts($listData) {
        $products = null;
        $newData = array();
        foreach ($listData as $key => $value) {
            //do bank info
            if ($key == 'bank_name') {
                $bankId = DepositBankAliasPeer::getBankIdByAliasName($value);
                $key = 'bank_id';
                $value = $bankId;
            }
            $replace = explode("_", $key);
            $turned = array_map('ucfirst', $replace);
            $newData[implode($turned)] = $value;
        }
        if (isset($newData['pk'])) {
            $products = DepositFinancialProductsPeer::retrieveByPK($newData['pk']);
        }
        if (!$products) {
            $products = new DepositFinancialProducts();
        }
        $products->fromArray($newData);
        try {
            $products->save();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * set filter to query
     *
     * @param array   $filters filter array
     * @param string  $order   order
     * @param int     $limit   limit number
     * @param boolean $total   total query condition
     *
     * @issue 2568
     * @return string
     */
    static public function useFiltersOriginSql($filters = array(), $order = null, $limit = 1, $total = false) {
        $select = self::queryFields('dfp');
        $sql = "SELECT {$select} FROM " . DepositFinancialProductsPeer::TABLE_NAME . ' AS dfp';
        $order = $order ? $order : ' ORDER BY dfp.updated_at ASC';
        $where = ' WHERE 1';
        if ($filters) {
            foreach ($filters as $key => $filter) {
                $where .= " AND {$key} {$filter}";
            }
        }
        if ($total) {
             $total = str_replace($select, "COUNT(dfp.id) AS total", $sql) . ' WHERE 1 AND ' . DepositAttributesPeer::getValidStatus();
             return $total;
        }
        $where .= " AND " . DepositAttributesPeer::getValidStatus();
        $sql .= $where . $order . " LIMIT $limit";
        return $sql;
    }

    /**
     * get query fields
     *
     * @param string $key array element
     *
     * @issue 2568
     * @return string
     */
    public static function queryFields ($key) {
        $queryFields = '';
        $fields = DepositFinancialProductsPeer::getFieldNames(BasePeer::TYPE_FIELDNAME);
        foreach ($fields as $value) {
            $queryFields .= $key . '.' . $value . ',';
        }
        return trim($queryFields, ',');
    }

        /**
     * fetch filter List
     *
     * @param array  $filters filter array
     * @param string $order   order
     * @param int    $limit   limit number
     *
     * @issue 2568
     * @return string
     */
    static public function fetchFiltersList($filters = array(), $order = null, $limit = 1) {
        $rows = array();
        $total = true;
        $filter = self::useFiltersOriginSql($filters, $order, $limit);
        $totalRecord = self::getTotal(self::useFiltersOriginSql($filters, $order, $limit, $total));
        //handle filter
        $con = Propel::getConnection();
        $statement = $con->prepareStatement($filter);
        $resultsets = $statement->executeQuery();
        while ($resultsets->next()) {
            //handle per row
            $row = $resultsets->getRow();
            foreach ($row as $fieldKey => $fieldValue) {
                //special value
                if ($fieldValue == '0000-00-00'){
                    $row[$fieldKey] = '';
                }
            }
            unset($row['bank_name']);
            unset($row['id']);
            ksort($row);
            $rows[] = $row;
        }
        return array('list' => $rows, 'total' => $totalRecord);
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
     * @param string $field    field name
     *
     * @issue 2580
     * @return mixed field chinese or fields list
     */
    public static function translateFieldsMaps($platform = null, $field = null) {
        $platform = $platform ? $platform : DepositExcel::TENCERT;
        $map = 'get' . ucfirst($platform) . 'Maps';
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
            'name' => util::getMultiMessage('Product Name'),
            'bank_name' => util::getMultiMessage('Product Bank Name'),
            'sale_start_date' => util::getMultiMessage('Product Start Sale Date'),
            'sale_end_date' => util::getMultiMessage('Product Sale End Date'),
            'deadline' => util::getMultiMessage('Product Deadline'),
            'currency' => util::getMultiMessage('Product Currency'),
            'invest_cycle' => util::getMultiMessage('Product Invest Cycle'),
            'invest_start_amount' => util::getMultiMessage('Product Invest Start Amount'),
            'expected_rate' => util::getMultiMessage('Product Expected Rate'),
            'actual_rate' => util::getMultiMessage('Product Actual Rate'),
            'profit_type' => util::getMultiMessage('Product Profit Type'),
            'status' => util::getMultiMessage('Product Status'),
            'region' => util::getMultiMessage('Product Region Name'),
            'target' => util::getMultiMessage('Product Target'),
            'profit_start_date' => util::getMultiMessage('Product Profit Start Date'),
            'pay_period' => util::getMultiMessage('Product Pay Period'),
            'invest_increase_amount' => util::getMultiMessage('Product Invest Increase Amount'),
            'profit_desc' => util::getMultiMessage('Product Profit Desc'),
            'invest_scope' => util::getMultiMessage('Product Invest Scope'),
            'stop_condition' => util::getMultiMessage('Product Stop Condition'),
            'raise_condition' => util::getMultiMessage('Product Raise Condition'),
            'purchase' => util::getMultiMessage('Product Purchase'),
            'cost' => util::getMultiMessage('Product Cost'),
            'feature' => util::getMultiMessage('Product Feature'),
            'events' => util::getMultiMessage('Product Events'),
            'warnings' => util::getMultiMessage('Product Warnings'),
            'announce' => util::getMultiMessage('Product Announce'),
        );
        if ($field) {
            return $fields[$field];
        }
        return $fields;
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
            'name' => util::getMultiMessage('Product Name'),
            'bank_name' => util::getMultiMessage('Product Bank Name'),
            'currency' => util::getMultiMessage('Product Currency'),
            'sale_start_date' => util::getMultiMessage('Product Start Sale Date'),
            'sale_end_date' => util::getMultiMessage('Product Sale End Date'),
            'invest_start_amount' => util::getMultiMessage('Product Invest Start Amount'),
            'invest_cycle' => util::getMultiMessage('Product Invest Cycle'),
            'expected_rate' => util::getMultiMessage('Product Expected Rate'),
            'profit_type' => util::getMultiMessage('Product Profit Type'),
            'deadline' => util::getMultiMessage('Product Deadline'),
            'target' => util::getMultiMessage('Product Target'),
            'region' => util::getMultiMessage('Product Region Name'),
            'actual_rate' => util::getMultiMessage('Product Actual Rate'),
            'status' => util::getMultiMessage('Product Status'),
            'profit_start_date' => util::getMultiMessage('Product Profit Start Date'),
            'pay_period' => util::getMultiMessage('Product Pay Period'),
            'invest_increase_amount' => util::getMultiMessage('Product Invest Increase Amount'),
            'profit_desc' => util::getMultiMessage('Product Profit Desc'),
            'invest_scope' => util::getMultiMessage('Product Invest Scope'),
            'stop_condition' => util::getMultiMessage('Product Stop Condition'),
            'raise_condition' => util::getMultiMessage('Product Raise Condition'),
            'purchase' => util::getMultiMessage('Product Purchase'),
            'cost' => util::getMultiMessage('Product Cost'),
            'feature' => util::getMultiMessage('Product Feature'),
            'events' => util::getMultiMessage('Product Events'),
            'warnings' => util::getMultiMessage('Product Warnings'),
            'announce' => util::getMultiMessage('Product Announce'),
        );
        if ($field) {
            return $fields[$field];
        }
        return $fields;
    }

    /**
     * save data list
     *
     * @param array $master data list
     *
     * @issue 2580
     * @return null
     */
    public static function saveProducts($master) {
        try {
            unset($master['status']);
            DepositFinancialProductsPeer::saveFinacialProducts($master);
        } catch (Exception $e) {
            throw $e;
        }
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
}
