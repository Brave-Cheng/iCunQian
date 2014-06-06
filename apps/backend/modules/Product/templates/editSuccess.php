<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script> 
<!-- float js -->
<style>
    .area_style{
        width: 480px;
        height: 100px;
    }
    .dateStyle{
        height: 23px;
        line-height: 23px;
        margin-right: 10px;
    }
    .langInput{
        width: 200px;
        height: 19px;
    }
</style>
<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Product/handle', array('name' => 'productHandle', 'id' => 'productHandle', 'enctype' => 'multipart/form-data')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Product'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('productHandle', '<?php echo url_for('Product/handle'); ?>');">
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
                <label><?php echo __("Product Name"); ?></label>
                <?php echo input_tag("name", $product->getName(), array('class'=>'langInput')); ?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("name")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Status"); ?></label>
                <?php if (is_object($product->getDepositRequestFinancial())):?>
                    <?php echo select_tag("status", options_for_select($attributes['status'], $product->getDepositRequestFinancial()->getStatus() ))?>&nbsp;<div class="form_must">*</div>
                <?php else:?>
                    <?php echo select_tag("status", options_for_select($attributes['status']))?>&nbsp;<div class="form_must">*</div>
                <?php endif;?>
                <?php echo __(form_error("status")); ?>
            </div>
            
            
            <div class="formItem">                     
                <label><?php echo __("Product Profit Type"); ?></label>
                <?php echo select_tag("profitType", options_for_select($attributes['profit_type'], $product->getProfitType()))?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("productName")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Currency"); ?></label>
                <?php echo select_tag("currency", options_for_select($attributes['currency'], $product->getCurrency()))?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("currency")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Bank Name"); ?></label>
                <?php echo input_tag("bankName", $product->getBankName(), array('class'=>'langInput')); ?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("bankName")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Region Name"); ?></label>
                <?php echo input_tag("region", $product->getRegion(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Type"); ?></label>
                <?php echo input_tag("productType", $product->getProductType(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Invest Cycle"); ?></label>
                <?php echo input_tag("investCycle", $product->getInvestCycle(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Target"); ?></label>
                <?php echo input_tag("target", $product->getTarget(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Start Sale Date"); ?></label>
                <?php echo input_date_tag('saleStartDate', $product->getSaleStartDate(), array('rich' => true, 'class' => 'dateStyle'));  ?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("saleStartDate")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Sale End Date"); ?></label>
                <?php echo input_date_tag('saleEndDate', $product->getSaleEndDate(), array('rich' => true, 'class' => 'dateStyle'));?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("saleEndDate")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Deadline"); ?></label>
                <?php echo input_date_tag('deadline', $product->getDeadline(), array('rich' => true, 'class' => 'dateStyle')); ?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("deadline")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Pay Period"); ?></label>
                <?php echo input_tag("payPeriod", $product->getPayPeriod(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Expected Rate"); ?></label>
                <?php echo input_tag("expectedRate", $product->getExpectedRate(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Actual Rate"); ?></label>
                <?php echo input_tag("actualRate", $product->getActualRate(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Invest Start Amount"); ?></label>
                <?php echo input_tag("investStartAmount", $product->getInvestStartAmount(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Invest Increase Amount"); ?></label>
                <?php echo input_tag("investIncreaseAmount", $product->getInvertIncreaseAmount(), array('class'=>'langInput')); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Profit Desc"); ?></label>
                <?php echo textarea_tag('profitDesc', $product->getProfitDesc(), array('class' => 'area_style')) ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Invest Scope"); ?></label>
                <?php echo textarea_tag('investScope', $product->getInvestScope(), array('class' => 'area_style'));?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Stop Condition"); ?></label>
                <?php echo textarea_tag('stopCondition', $product->getStopCondition(), array('class' => 'area_style'));?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Raise Condition"); ?></label>
                <?php echo textarea_tag('raiseCondition', $product->getRaiseCondition(), array('class' => 'area_style'));?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Purchase"); ?></label>
                <?php echo textarea_tag('purchase', $product->getPurchase(), array('class' => 'area_style'));?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Cost"); ?></label>
                <?php echo textarea_tag('cost', $product->getCost(), array('class' => 'area_style'));?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Feature"); ?></label>
                <?php echo textarea_tag('feature', $product->getFeature(), array('class' => 'area_style'));?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Events"); ?></label>
                <?php echo textarea_tag('events', $product->getEvents(), array('class' => 'area_style'));?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Warnings"); ?></label>
                <?php echo textarea_tag('warnings', $product->getWarnings(), array('class' => 'area_style'));?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Announce"); ?></label>
                <?php echo textarea_tag('announce', $product->getAnnounce(), array('class' => 'area_style'));?>
            </div>
            

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
</script>