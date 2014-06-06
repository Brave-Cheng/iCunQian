<?php

//log filename
define('ACTIVE_LOG_NAME', 'Crawl_Active_Log');
define("PAGING_DATA_SETS", 'Paging_Data_Sets');

//log directory
define('PAGE_LIST_LOG_DIR', 'page_list_log_dir');
define('PAGE_DETAIL_LOG_DIR', 'page_detail_log_dir');

//tencet crawl address
define('TENCERT_PAGE_LIST_URL', 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=sxq_search_products');
define('TENCERT_PAGE_DETAIL_URL', 'http://stock.finance.qq.com/money/view/show.php?t=bank&c=show_detail');

define('SPCIAL_CHARACTER', '发行日');
define('SALE_START_DATE', '销售起始日');
define('SALE_END_DATE', '销售截止日');
define('SPCIAL_CHARACTER_REGION', '发行地区');

define('TENCERT_TOTAL_LIST_FILTER', '起始日');

//send mail to administrator for managing the bank info
$mangingBankSenders = array(
    '249636292@qq.com',
    'kevin.liu@expacta.com.cn',
    'brave.cheng@expacta.com.cn'
);

$conError = array(
    'subject' => "定时脚本%s执行出错",
    'body'    => "定时脚本%s执行出错，<br>原因：%s, <br>脚本开始时间%s,<br>脚本结束时间%s <br>请检查此脚本信息！",
);

$totalFilter = array(
    TENCERT_TOTAL_LIST_FILTER => '2014-05-01',
);

sfConfig::add(
        array(
            'sender'        => $mangingBankSenders,
            'totalFilter'   => $totalFilter,
            'cronError'     => $conError,
        )
);
