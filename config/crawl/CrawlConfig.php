<?php


/**
 * @package config\crawl
 */
class CrawlConfig
{
    // tencent config
    const TENCENT_LIST_PAGE_URL     = 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=sxq_search_products&p=';
    const TENCENT_DETAIL_PAGE_URL   = 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=show_detail&id=';

    //jnlc config
    const JNLC_LIST_PAGE_URL        = 'http://bankdata.jnlc.com/SitePages/Layouts/JNPJFeature/search.ashx?qt=complex&qn=BankFinacleAllProducts&model=YHLC';
    const JNLC_DETAIL_PAGE_URL      = 'http://bankdata.jnlc.com/SitePages/layouts/JNPJFeature/search.ashx?qt=simply&qn=BankFinacleSingleInf&model=YHLC&_search=true&searchField=id&searchOper=eq&searchString=';
    

    const SPCIAL_CHARACTER          = '发行日';
    const SALE_START_DATE           = '销售起始日';
    const SALE_END_DATE             = '销售截止日';
    const SPCIAL_CHARACTER_REGION   = '发行地区';
    const TENCERT_TOTAL_LIST_FILTER = '起始日';

    const DEFAULT_DATE              = '1970-01-01';

    const STATUS_1                  = '预售';
    const STATUS_2                  = '在售';
    const STATUS_3                  = '过期';

    const JNLC_FILTER_NON_STRUCTURAL_PRODUCTS = '非结构性产品';
    const JNLC_FILTER_STRUCTURAL_PRODUCTS = '结构性产品';


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
            self::STATUS_1  => array(
                '在售及预售产品'
            ),
            self::STATUS_2   => array(
                '运行中的产品',
                '运行中产品'
            ),
            self::STATUS_3   => array(
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
                '加元',
                '其他',
                '其他币种'
            ),
        ),    
    );

    protected $conError = array(
        'subject' => "定时脚本%s执行完成",
        'body'    => "定时脚本%s执行完成，<br>结果：%s, <br>脚本开始时间%s,<br>脚本结束时间%s <br>请登陆后台查看抓取数据！",
    );

    protected $totalFilter = array(
        self::TENCERT_TOTAL_LIST_FILTER => '2014-05-01',
    );

    //send mail to administrator for managing the bank info
    protected $mangingBankSenders = array(
       '249636292@qq.com',
       'yun.li@expacta.com.cn',
    //    'kevin.liu@expacta.com.cn',
    //    'brave.cheng@expacta.com.cn'
    );


    /**
     * get Jnlc structurual product
     * 
     * @issue 2568
     * 
     * @return array
     */
    public function getJnlcStructurualProduct() {
        return array(
            self::JNLC_FILTER_NON_STRUCTURAL_PRODUCTS,
            self::JNLC_FILTER_STRUCTURAL_PRODUCTS,
        );
    }

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

    /**
     * Get status property
     *
     * @return array
     *
     * @issue 2579
     */
    public function getStatus() {
        return array(
            1 => self::STATUS_1,
            2 => self::STATUS_2,
            3 => self::STATUS_3,
        );
    }

    /**
     * Get queue message
     *
     * @return array
     *
     * @issue 2729
     */
    public function getQueueMessage() {
        return array(
            'subject' => "定时脚本%s执行完成",
            'body'    => "定时脚本%s执行完成，<br>结果：%s, <br>脚本开始时间%s,<br>脚本结束时间%s",
        );
    }

    /**
     * Get Tencent dictionary
     *
     * @return array
     *
     * @issue 2729
     */
    public function getTencentDictionary() {
        return array(
            'name'                      => array(
                '名称',
                'name'
            ),
            'status'                    => array(
                'status'
            ),
            'profitType'                => array(
                '收益类型',
                '收益分类',
                '收益获取方式',
            ),
            'currency'                  => array(
                '认购币种',
                '币种',
                '理财币种',
            ),
            'investCycle'               => array(
                '投资期限',
                '理财期限',
            ),
            'target'                    => array(
                '发行对象',
                '对象',
            ),
            'saleStartDate'             => array(
                '销售起始日',
                '起始日'
            ),
            'saleEndDate'               => array(
                '销售截止日',
                '终止日'
            ),
            'profitStartDate'           => array(
                '收益起始日',
                '收益起计',
                '收益起计日',
            ),
            'deadline'                  => array(
                '到期日',
            ),
            'payPeriod'                 => array(
                '付息周期'
            ),
            'expectedRate'              => array(
                '预期年化收益率',
                '预计最高年化收益率',
                '预期年化收益率(%)',
            ),
            'actualRate'                => array(
                '产品到期实际年化收益率',
            ),
            'investStartAmount'         => array(
                '投资起始金额',
                '委托起始金额',
            ),
            'investIncreaseAmount'      => array(
                '委托金额递增单位'
            ),
            'profitDesc'                => array(
                '收益率说明'
            ),
            'investScope'               => array(
                '投资范围'
            ),
            'stopCondition'             => array(
                '提前终止条件'
            ),
            'raiseCondition'            => array(
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
            'bankName'                  => array(
                '发行银行'
            ),
        );
    }

}









