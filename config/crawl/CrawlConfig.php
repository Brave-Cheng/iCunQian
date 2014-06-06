<?php


/**
 * @package config\crawl
 */
class CrawlConfig
{

    //log filename
    const ACTIVE_LOG_NAME = 'Crawl_Active_Log';
    const PAGING_DATA_SETS = 'Paging_Data_Sets';

    //tencet crawl address
    const TENCERT_PAGE_LIST_URL = 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=sxq_search_products';
    const TENCERT_PAGE_DETAIL_URL = 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=show_detail';

    const SPCIAL_CHARACTER = '发行日';
    const SALE_START_DATE = '销售起始日';
    const SALE_END_DATE = '销售截止日';
    const SPCIAL_CHARACTER_REGION = '发行地区';
    const TENCERT_TOTAL_LIST_FILTER = '起始日';
    //product attributes adapter 
    protected $attributeAdapter = array(
        'profit_type'           => array(
            '保本固定收益'      => array(
                '保证收益',
                '保证收益型',
            ),
            '保本浮动收益'      => array(
                '保本浮动收益型',
                '保本收益',
                '保本浮动',
                '浮动收益',
            ),
            '非保本浮动收益'    => array(
                '非保本浮动',
                '非保本收益',
                '非保本浮动收益型'
            ),
        ),

        'status'                => array(
            '预售'              => array(
                '在售及预售产品'
            ),
            '在售'              => array(
                '运行中的产品',
                '运行中产品'
            ),
            '过期'              => array(
                '到期产品'
            ),
        ),

        'currency'              => array(
            '人民币'            => array(
                '人民币'
            ),
            '美元'              => array(
                '美元'
             ),
            '港币'              => array(
                '港元',
                '港币'
            ),
            '英镑'              => array(
                '英镑'
            ),
            '欧元'              => array(
                '欧元'
            ),
            '澳元'              => array(
                '澳元'
            ),
            '其他币种'          => array(
                '日元',
                '加元'
            ),
        ),    
    );

    //The data dictionary
    protected $dictionaryAdapter = array(
            'name'                      => array(
                '名称',
                'name'
            ),
            'status'                    => array(
                'status'
            ),
            'profit_type'               => array(
                '收益类型',
                '收益分类',
                '收益获取方式',
            ),
            'product_type'              => array(
                '产品类型',
                '产品分类',
            ),
            'currency'                  => array(
                '认购币种',
                '币种',
                '理财币种',
            ),
            'invest_cycle'              => array(
                '投资期限',
                '理财期限',
            ),
            'target'                    => array(
                '发行对象',
                '对象',
            ),
            'sale_start_date'           => array(
                '销售起始日',
                '起始日'
            ),
            'sale_end_date'             => array(
                '销售截止日',
                '终止日'
            ),
            'profit_start_date'         => array(
                '收益起始日',
                '收益起计',
                '收益起计日',
            ),
            'deadline'                  => array(
                '到期日',
            ),
            'pay_period'                => array(
                '付息周期'
            ),
            'expected_rate'             => array(
                '预期年化收益率',
                '预计最高年化收益率',
                '预期年化收益率(%)',
            ),
            'actual_rate'               => array(
                '产品到期实际年化收益率',
            ),
            'invest_start_amount'       => array(
                '投资起始金额',
                '委托起始金额',
            ),
            'invert_increase_amount'    => array(
                '委托金额递增单位'
            ),
            'profit_desc'               => array(
                '收益率说明'
            ),
            'invest_scope'              => array(
                '投资范围'
            ),
            'stop_condition'            => array(
                '提前终止条件'
            ),
            'raise_condition'           => array(
                '募集规划条件'
            ),
            'purchase'                  => array(
                '申购条件'
            ),
            'cost'                      => array(
                '产品费用'
            ),
            'feature'                   => array(
                '产品特色'
            ),
            'events'                    => array(
                '优惠活动'
            ),
            'warnings'                  => array(
                '风险提示'
            ),
            'announce'                  => array(
                '产品公告'
            ),
            'region'                    => array(
                '发行地区'
            ),
            'bank_name'                 => array(
                '发行银行'
            ),
    );

    protected $conError = array(
        'subject' => "定时脚本%s执行出错",
        'body'    => "定时脚本%s执行出错，<br>原因：%s, <br>脚本开始时间%s,<br>脚本结束时间%s <br>请检查此脚本信息！",
    );

    protected $totalFilter = array(
        self::TENCERT_TOTAL_LIST_FILTER => '2014-05-01',
    );

    //send mail to administrator for managing the bank info
    protected $mangingBankSenders = array(
       '249636292@qq.com',
    //    'kevin.liu@expacta.com.cn',
    //    'brave.cheng@expacta.com.cn'
    );


    /**
     * get attribute adapter
     * 
     * @issue 2568
     * @return array
     */
    public function getAttributeAdapter() {
        return $this->attributeAdapter;
    }

    /**
     * get attribute dictionaryAdapter
     * 
     * @issue 2568
     * @return array
     */
    public function getDictionaryAdapter() {
        return $this->dictionaryAdapter;
    }

    /**
     * get conjob error
     * 
     * @issue 2568
     * @return array
     */
    public function getCronjobError() {
        return $this->conError;
    }

    /**
     * get total Filter
     * 
     * @issue 2568
     * @return array
     */
    public function getTotalFilter() {
        return $this->totalFilter;
    }

    /**
     * get manging bank senders
     * 
     * @issue 2568
     * @return array
     */
    public function getMangingBankSenders() {
        return $this->mangingBankSenders;
    }


}









