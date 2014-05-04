<?php

/**
 * Subclass for performing query and update operations on the 'deposit_financial_products' table.
 *
 * 
 *
 * @package lib.model
 */
class DepositFinancialProductsPeer extends BaseDepositFinancialProductsPeer {
    
    //data dictionary
    public static $dictionary = array(
        'name' => array(
            '名称',
            'name'
        ),
        'status' => array(
            'status'
        ),
        'profit_type' => array(
            '收益类型',
            '收益分类',
            '收益获取方式',
        ),
        'product_type' => array(
            '产品类型',
            '产品分类',
        ),
        'currency' => array(
            '认购币种',
            '币种',
        ),
        'invest_cycle' => array(
            '投资期限',
        ),
        'target' => array(
            '发行对象',
            '对象',
        ),
        'sale_start_date' => array(
            '销售起始日',
            '起始日'
        ),
        'sale_end_date' => array(
            '销售截止日',
            '终止日'
        ),
        'profit_start_date' => array(
            '收益起始日',
            '收益起计',
        ),
        'deadline' => array(
            '到期日',
        ),
        'pay_period' => array(
            '付息周期'
        ),
        'expected_rate' => array(
            '预期年化收益率',
            '预计最高年化收益率',
        ),
        'actual_rate' => array(
            '产品到期实际年化收益率',
        ),
        'invest_start_amount' => array(
            '投资起始金额',
            '委托起始金额',
        ),
        'invert_increase_amount' => array(
            '委托金额递增单位'
        ),
        'profit_desc' => array(
            '收益率说明'
        ),
        'invest_scope' => array(
            '投资范围'
        ),
        'stop_condition' => array(
            '提前终止条件'
        ),
        'raise_condition' => array(
            '募集规划条件'
        ),
        'purchase' => array(
            '申购条件'
        ),
        'cost' => array(
            '产品费用'
        ),
        'feature' => array(
            '产品特色'
        ),
        'events' => array(
            '优惠活动'
        ),
        'warnings' => array(
            '风险提示'
        ),
        'announce' => array(
            '产品公告'
        ),
        'region_id' => array(
            '发行地区'
        ),
        'bank_id' => array(
            '发行银行'
        ),
    );
    
    public static $status = array(
        1 => '在售及预售产品',
        2 => '运行中的产品',
        3 => '到期产品',
    );
    
    public static $currency = array(
        1 => '人民币',
        2 => '美元',
        3 => '港币',
        4 => '欧元',
        5 => '英镑',
        6 => '澳元',
        7 => '加元',
        8 => '其他币种',
    );
    public static $profit_type = array(
        1 => '保证收益',
        2 => '保本浮动',
        3 => '非保本浮动',
        4 => '保证收益',
    );

    public static $invest_cycle = array(
        1 => '1个月',
        2 => '1-3个月',
        3 => '3-6个月',
        4 => '6-12个月',
        5 => '1-2年',
        6 => '大于两年',
        7 => '无固定期限',
    );
    
    public static $target = array(
        1 => '拆借',
        2 => '货币市场',
        3 => '债券',
        4 => '债权',
        5 => '受益权',
    );
    
    public static $product_type = array(
        1 => '人民币产品',
        2 => '外币产品',
        3 => '其他产品',
    );
    
    //Transformation of corresponding value field
    public static $convertFiledValue = array(
        'status',
        'currency',
        'profit_type',
        'product_type',
        'target',
    );
    
    public static $convertFieldValueToInt = array(
        'target',
    );
    
    public static $convertFieldTypeToFloat = array(
        'expected_rate',
        'actual_rate',
    );

    public static $convertFieldTypeToInt = array(
        'invest_start_amount',
        'invert_increase_amount',
        'invest_cycle'
    );
    
    public static $convertRelationTable = array(
        'bank_id',
        'region_id',
    );

    

    /**
     * Parsed into identifiable data
     * @param array $crawl
     * @return array
     */
    static public function parseIntoIdentifiableFields($crawl) {
        $fields = array();
        if ($crawl) {
            foreach ($crawl as $dictionary => $string) {
                foreach (self::$dictionary as $field => $dictionaryArray) {
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
     * @param array $data
     * @return array
     */
    static public function parseIntoAvailableFields($data) {
        $newData = array();
        $data = self::parseIntoIdentifiableFields($data);
        if(!$data){
            return false;
        }
        foreach ($data as $fieldKey => $fieldValue) {
            //Transformation of corresponding value field
            if (in_array($fieldKey, self::$convertFiledValue)) {
                
                $flip = array_flip(self::${$fieldKey});
                if (in_array($fieldKey, self::$convertFieldValueToInt)) {
                    $explode = explode(',', $fieldValue);
                    if ($explode) {
                        $explodeValueIntString = '';
                        foreach ($explode as $explodeValue) {
                            $explodeValueIntString .= $flip[$explodeValue] . ',';
                        }
                        $newData[$fieldKey] = trim($explodeValueIntString, ',');
                    }
                } else {
                    $newData[$fieldKey] = $flip[$fieldValue];
                }
                
            } elseif (in_array($fieldKey, self::$convertFieldTypeToFloat)) {
                
                $newData[$fieldKey] = floatval($fieldValue);
                
            } elseif (in_array($fieldKey, self::$convertFieldTypeToInt)) {
                
                $newData[$fieldKey] = intval($fieldValue);
                
            } elseif (in_array($fieldKey, self::$convertRelationTable)) {
                
                if ($fieldKey == 'bank_id') {
                    $cls = DepositBankPeer::getBankByBankname($fieldValue);
                    $newData[$fieldKey] = is_object($cls) ? $cls->getId() : 0;
                }
                
                if ($fieldKey == 'region_id') {
                    $newData[$fieldKey] = self::saveRegionName($fieldValue);;
                }
                
                
            } else {
                $newData[$fieldKey] = $fieldValue;
            }
        }
        return $newData;
    }
    
    /**
     * save finacial product
     * @param  array $listData 
     * @return mixed          
     */
    static public function saveFinacialProducts($listData) {
        $products = null;
        $newData = array();
        foreach ($listData as $key => $value) {
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
        } catch (Exception $exc) {
            
        }
    }
    
    /**
     * 
     * @param type $regionName
     * @return type
     */
    static public function saveRegionName($regionName) {
        $int = '';
        $pos = strpos($regionName, ',');
        if ($pos === false) {
            $cls =  DepositRegionPeer::getRegionByName($regionName);
            $int = is_object($cls) ? $cls->getId() : 0;
        } else {
            $explode = explode(',', $regionName);
            if ($explode) {
                foreach ($explode as $region) {
                    $cls = DepositRegionPeer::getRegionByName($region);
                    $object = is_object($cls) ? $cls->getId() : 0;
                    $int .= $object . ',';
                }
            }
        }
        return trim($int, ',');
    }
}
