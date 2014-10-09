<table class="head" id="headTitle">
        <tr>
            <td width="74px"><span class="logo"><img src="<?php echo $img;?>/icon.png"></span></td>
            <td><h2>i存钱</h2>
            <label>畅享全国的高收益低风险银行理财产品。</label></td>
            <td width="80px"><a class="download" href="#">下载App</a></td>
        </tr>
    </table>
    <div class="mainInfo">
        <table class="productTitle">
            <tr>
                <td width="50px"><span class="bank_logo"><img src="<?php echo $bank->getLogo() ? $bank->getLogo() : $img . '/default_bank_min.png' ;?>" /></span></td>
                <td><span><?php echo $product->getName();?></span></td>
            <tr>
        </table>
        <div class="arrow"></div>
        <div class="circle" id="rate">
            <p>银行活期利率<?php echo $product->getFormatExpactedRate();?></p>
            <div class="bubble"><em><?php echo $product->getBankTimes(); ?></em><span>倍</span></div>
        </div>
        <div id="little">
            <div class="circle" id="percentage">
                <div class="bubble"><em><?php echo $product->getNoSiginExpectedRate();?></em><span>%</span></div>
                <p>预期年化收益</p>
            </div>
            <div class="circle" id="period">
                <div class="bubble"><em><?php echo $product->getNoSiginInvestCycle();?></em><span>个月</span></div>
                <p>锁定期</p>
            </div>
            <div class="circle" id="minimum">
                <div class="bubble"><em><?php echo $product->getNoSiginInvestStartAmount();?></em><span>万</span></div>
                <p>起投金额</p>
            </div>
        </div>       
    </div>
    <div id="money"><a href="#">立即赚钱</a></div>