<table class="head" id="headTitle">
        <tr>
            <td width="74px"><span class="logo"><img src="<?php echo $img;?>/icon.png"></span></td>
            <td><h2>i存钱</h2>
            <label>畅享全国的高收益低风险银行理财产品。</label></td>
            <td width="80px"><a id="download" onclick="redirectTo(event);" href='http://mp.weixin.qq.com/mp/redirect?url=http%3A%2F%2Fitunes.apple.com%2Fus%2Fapp%2Fid399608199%23rd'>下载App</a></td>
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
    <div id="money"><a id="redirect" onclick="redirectTo(event);" href='http://mp.weixin.qq.com/mp/redirect?url=http%3A%2F%2Fitunes.apple.com%2Fus%2Fapp%2Fid399608199%23rd'>立即赚钱</a></div>
    <script type="text/javascript">
        //document.getElementById('redirect').onclick = redirectTo();
        //document.getElementById('download').onclick = redirectTo();
        function redirectTo(event){
            var ua = navigator.userAgent.toLowerCase();
            if(ua.indexOf('iphone') > -1 || ua.indexOf('ipad') > -1){
                return true;
            }else{
                alert('《i存钱》目前仅支持IOS版本，其余平台将陆续开放，敬请期待。');
                event.preventDefault();
                return false;
            }
        }
    </script>