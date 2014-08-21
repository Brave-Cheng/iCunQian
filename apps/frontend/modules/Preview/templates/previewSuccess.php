
    <div class="head" id="headTitle">产品详情</div>
    <div class="mainInfo">
        <div class="productTitle">
            <span class="bank_logo"><img src="<?php echo $bank->getLogo();?>" /></span>
            <span><?php echo $product->getName();?></span>
        </div>
        <div class="row">
            <img class="happy_pig" src="<?php echo $img;?>happy_pig.png" />
            <p class="time"><?php echo $product->getFormatStatus(); ?></p>
            <p>
                <span><?php echo $product->getProfitType();?></span>
                <span><?php echo $product->getCurrency();?></span>
                <span><?php echo $product->getRegion();?></span>
            </p>
            <p class="earnings">
                <span>预期收益是<?php echo $product->getFormatExpactedRate();?>，<br />是银行的</span>
                <span class="multiple"><?php echo $product->getBankTimes(); ?></span>
                <span><br />倍</span>
            </p>
        </div>
        <div class="row">
            <dl>
                <dt><?php echo $product->getFormatExpactedRate();?></dt>
                <dd>预期收益</dd>
            </dl>
            <dl>
                <dt><?php echo $product->getFormatInvestStartAmount();?></dt>
                <dd>起投金额</dd>
            </dl>
            <dl>
                <dt><?php echo $product->getFormatInvestCycle();?></dt>
                <dd>锁定期</dd>
            </dl>
        </div>
    </div>
    <dl class="info">
        <dt>收益率</dt>
        <dd><?php echo $product->getProfitDesc();?></dd>    
    </dl>

    <dl class="info">
        <dt>投资范围</dt>
        <dd><?php echo $product->getInvestScope();?></dd>    
    </dl>

    <dl class="info">
        <dt>风险提示</dt>
        <dd><?php echo $product->getWarnings();?></dd>
    </dl>
