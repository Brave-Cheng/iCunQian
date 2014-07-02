<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script> 
<!-- float js -->
<style type="text/css">
    /*.formItem ul li{margin-bottom: 10px;}*/
</style>
<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Product/push', array('name' => 'pushForm', 'id' => 'pushForm', 'enctype' => 'multipart/form-data')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Recommend'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('pushForm', '<?php echo url_for('Product/push'); ?>');">
                <img src="/images/icons/check.png" alt="<?php echo __('Send'); ?>" title="<?php echo __('Send'); ?>" />
                <?php echo __('Send'); ?>
            </button>
            <!-- Cancel Button -->
            <button class="cancel" onclick="return formSubmit('pushForm', '<?php echo url_for("Product/index" . '/' . html_entity_decode(rm2FormGetQuery("sortBy", "sort"))) ?>');">
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
<!--                 <ul>
                    <li><?php echo __('Product Name');?>：<?php echo checkbox_tag('name', $product->getName()); echo $product->getName();?></li>
                    <li><?php echo __('Product Bank Name');?>：<?php echo checkbox_tag('bankName', $product->getBankName()); echo $product->getBankName();?></li>
                    <li><?php echo __('Product Region Name');?>：<?php echo checkbox_tag('regionName', $product->getRegion()); echo $product->getRegion();?></li>
                    <li><?php echo __('Product Profit Type');?>：<?php echo checkbox_tag('profitType', $product->getProfitType()); echo $product->getProfitType();?></li>
                    <li><?php echo __('Product Currency');?>：<?php echo checkbox_tag('currency', $product->getCurrency()); echo $product->getCurrency();?></li>
                    <li><?php echo __('Product Invest Cycle');?>：<?php echo checkbox_tag('investCycle', $product->getInvestCycle()); echo $product->getInvestCycle();?></li>
                    <li><?php echo __('Product Target');?>：<?php echo checkbox_tag('target', $product->getTarget()); echo $product->getTarget();?></li>
                    <li><?php echo __('Product Sale Start Date');?>：<?php echo checkbox_tag('saleStartDate', $product->getSaleStartDate()); echo $product->getSaleStartDate();?></li>
                    <li><?php echo __('Product Sale End Date');?>：<?php echo checkbox_tag('saleEndDate', $product->getSaleEndDate()); echo $product->getSaleEndDate();?></li>
                    <li><?php echo __('Product Profit Start Date');?>：<?php echo checkbox_tag('profitStartDate', $product->getProfitStartDate()); echo $product->getProfitStartDate();?></li>
                    <li><?php echo __('Product Deadline');?>：<?php echo checkbox_tag('deadline', $product->getDeadline()); echo $product->getDeadline();?></li>
                    <li><?php echo __('Product Pay Period');?>：<?php echo checkbox_tag('payperiod', $product->getPayPeriod()); echo $product->getPayPeriod();?></li>
                    <li><?php echo __('Product Expected Rate');?>：<?php echo checkbox_tag('expectedRate', $product->getExpectedRate()); echo $product->getExpectedRate();?></li>
                    <li><?php echo __('Product Actual Rate');?>：<?php echo checkbox_tag('actualRate', $product->getActualRate()); echo $product->getActualRate();?></li>
                    <li><?php echo __('Product Invest Start Amount');?>：<?php echo checkbox_tag('investStartAmount', $product->getInvestStartAmount()); echo $product->getInvestStartAmount();?></li>
                    <li><?php echo __('Product Invest Increase Amount');?>：<?php echo checkbox_tag('investIncreaseAmount', $product->getInvestIncreaseAmount()); echo $product->getInvestIncreaseAmount();?></li>
                
                </ul> -->
                <label><?php echo checkbox_tag('name', sprintf(util::getMultiMessage('This Week Top Products %s, Profit Type is %s'), $product->getName(), $product->getProfitType()), false, array('onclick' => 'insert_item(this.value, this);')); ?></label>
                    <?php echo sprintf(util::getMultiMessage('This Week Top Products %s, Profit Type is %s'), $product->getName(), $product->getProfitType());?>
            </div>

            <div class="formItem">
                <label><?php echo checkbox_tag('item1', sprintf(util::getMultiMessage('Wow, There is %s come %s'), $product->getExpectedRate(), $product->getName()), false, array('onclick' => 'insert_item(this.value, this);')); ?></label>
                <?php echo sprintf(util::getMultiMessage('Wow, There is %s come %s'), $product->getExpectedRate(), $product->getName());?>
            </div>

            <div class="formItem">
                <label><?php echo checkbox_tag('name', sprintf(util::getMultiMessage('Bank %s Profit is %s'), $product->getName(), $product->getExpectedRate()), false, array('onclick' => 'insert_item(this.value, this);')); ?></label>
                <?php echo sprintf(util::getMultiMessage('Bank %s Profit is %s'), $product->getName(), $product->getExpectedRate());?>
            </div>

            <div class="clear"></div>
            <div class="formItem">
                <label>&nbsp;</label>
                <?php echo __(form_error("pushError")); echo __(form_error('recommend'));
                ?>
            </div>



            <div class="clear"></div>
            <div class="formItem">                     
                <label>&nbsp;</label>
                <?php echo textarea_tag('recommend','', array('cols' => 100, 'rows' => 10))?>
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
                function insert_item(val, the) {
                    if ($(the).attr('checked') == 'checked') {
                        $("#recommend").val(val);
                    } else {
                        $("#recommend").val('');
                    }
                    
                }
</script>