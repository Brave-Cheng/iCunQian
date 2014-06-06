<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script> 
<!-- float js -->

<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Product/recommend', array('name' => 'productHandle', 'id' => 'productHandle', 'enctype' => 'multipart/form-data')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Recommend'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('productHandle', '<?php echo url_for('product/handle'); ?>');">
                <img src="/images/icons/check.png" alt="<?php echo __('Save'); ?>" title="<?php echo __('Save'); ?>" />
                <?php echo __('Save'); ?>
            </button>
            <!-- Cancel Button -->
            <button class="cancel" onclick="return formSubmit('productHandle', '<?php echo url_for("Product/index" . '/' . html_entity_decode(rm2FormGetQuery("sortBy", "sort"))) ?>');">
                <img src="/images/icons/delete_small.png" alt="<?php echo __('Cancel'); ?>" title="<?php echo __('Cancel'); ?>" />
                <?php echo __('Cancel'); ?>
            </button>
        </p>
    </div>
    <!--form header-->
    <!--hidden input-->
    <?php echo input_hidden_tag("id", $product->getId()); ?>
    <?php echo input_hidden_tag("sortBy", $sf_request->getParameter('sortBy')); ?>
    <?php echo input_hidden_tag("sort", $sf_request->getParameter('sort')); ?>
    <!--hidden input-->

    <!--main-->
    <div id="tabContent" class="yui-content tabContent">
        <div id="tab1">
            <div class="formItem">                     
<!--                <p><label><?php echo __("Product Name"); ?></label><?php echo checkbox_tag('name');echo $product->getName();  ?></p>
                <p><label><?php echo __("Product Status"); ?></label><?php echo checkbox_tag('status'); echo $product->getDepositRequestFinancial()->getStatus() ?></p> 
                <p><label><?php echo __("Product Profit Type"); ?></label><?php echo checkbox_tag('profitType'); echo $product->getProfitType() ?></p> 
                <p><label><?php echo __("Product Currency"); ?></label><?php echo checkbox_tag('currency'); echo $product->getCurrency() ?></p>
                <p><label><?php echo __("Product Bank Name"); ?></label><?php echo checkbox_tag('bankName'); echo $product->getBankName() ?></p> 
                <p><label><?php echo __("Product Region Name"); ?></label><?php echo checkbox_tag('region'); echo $product->getRegion() ?></p>
                <p><label><?php echo __("Product Type"); ?></label><?php echo checkbox_tag('productType'); echo $product->getProductType() ?></p>
                <p><label><?php echo __("Product Invest Cycle"); ?></label><?php echo checkbox_tag('investCycle'); echo $product->getInvestCycle() ?></p> 
                <p><label><?php echo __("Product Target"); ?></label><?php echo checkbox_tag('target'); echo $product->getTarget() ?></p> 
                <p><label><?php echo __("Product Start Sale Date"); ?></label><?php echo checkbox_tag('saleStartDate'); echo $product->getSaleStartDate() ?></p>  
                <p><label><?php echo __("Product Sale End Date"); ?></label><?php echo checkbox_tag('saleEndDate'); echo $product->getSaleEndDate() ?></p>
                <p><label><?php echo __("Product Deadline"); ?></label><?php echo checkbox_tag('deadline'); echo $product->getDeadline() ?></p>
                <p><label><?php echo __("Product Pay Period"); ?></label><?php echo checkbox_tag('payPeriod'); echo $product->getPayPeriod() ?></p>
                <p><label><?php echo __("Product Expected Rate"); ?></label><?php echo checkbox_tag('expectedRate'); echo $product->getExpectedRate() ?></p>
                <p><label><?php echo __("Product Actual Rate"); ?></label><?php echo checkbox_tag('actualRate'); echo $product->getActualRate() ?></p>
                <p><label><?php echo __("Product Invest Start Amount"); ?></label><?php echo checkbox_tag('investStartAmount'); echo $product->getInvestStartAmount() ?></p>
                <p><label><?php echo __("Product Invest Increase Amount"); ?></label><?php echo checkbox_tag('invertIncreaseAmount'); echo $product->getInvertIncreaseAmount() ?></p>-->
                <p><label><?php echo checkbox_tag('item1', '哇，居然有“'. $product->getExpectedRate().'%” 的理财产品 “'.$product->getName().'”问世了！', false, array('onclick' => 'insert_item(this.value, this);')); ?></label>哇，居然有“<?php echo $product->getExpectedRate();?>%” 的理财产品 “<?php echo $product->getName(); ?>”问世了！</p>
                <p><label><?php echo checkbox_tag('name', '银行最新理财产品 “'.$product->getName().' ”, 预期年化收益为“'.$product->getExpectedRate().'%”', false, array('onclick' => 'insert_item(this.value, this);')); ?></label>银行最新理财产品 “<?php echo $product->getName(); ?> ”, 预期年化收益为“<?php echo $product->getExpectedRate();?>%”</p>
                <p><label><?php echo checkbox_tag('name', '本周收益率最高的银行最新理财产品 “'.$product->getName().'”,收益类型为“'.$product->getProfitType().'”', false, array('onclick' => 'insert_item(this.value, this);')); ?></label>本周收益率最高的银行最新理财产品 “<?php echo $product->getName(); ?> ”,收益类型为“<?php echo $product->getProfitType();?>”</p>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Recommend Content"); ?></label>
                <?php echo textarea_tag('recommend','', array('cols' => 100, 'rows' => 10))?>
            </div>
<!--            <div class="formItem" style="font-size: 13px;">                     
                <div class="form_must">用法：<p>1、勾选选择您需要发送的产品信息；</p><p>2、输入您推荐的内容，被替换的内容使用%s代替。</p><p>例如：“哇，居然有%s的理财产品%s问世了！ ”</p></div>
            </div>-->
            
            

        </div>
    </div>
    <!--main-->

    <div class="clear"></div>
</form> 

</div>
<!-- float js to element-->

<script type="text/javascript">
                $(document).ready(function() {
                    var msg = "<?php echo $sf_request->getParameter("rmsg"); ?>";
                    if (msg == "0") {
                        showDialogYes('<?php echo __("Save Successful") ?>', '<?php echo __("Message") ?>');
                    }
                });
                function insert_item(val, the) {
                    if ($(the).attr('checked') == 'checked') {
                        $("#recommend").val(val);
                    } else {
                        $("#recommend").val('');
                    }
                    
                }
</script>