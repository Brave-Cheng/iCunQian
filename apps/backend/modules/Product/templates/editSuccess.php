<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script> 
<!-- float js -->
<style>
    .area_style{width: 480px; height: 100px;}
    .dateStyle{height: 23px; line-height: 23px; margin-right: 10px;}
    .langInput{width: 200px;height: 19px;}
    .formItem label span {color: #777;}
    .formItem label{width: 260px;}
    .select_tag_width{width: 200px;}
</style>
<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Product/handle?'. formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid'), array('name' => 'productHandle', 'id' => 'productHandle')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Product'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('productHandle', '<?php echo url_for('Product/handle?' . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')); ?>');">
                <img src="/images/icons/check.png" alt="<?php echo __('Save'); ?>" title="<?php echo __('Save'); ?>" />
                <?php echo __('Save'); ?>
            </button>
            <!-- Cancel Button -->
            <button class="cancel" onclick="return formSubmit('productHandle', '<?php echo url_for("Product/index?" . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>');">
                <img src="/images/icons/delete_small.png" alt="<?php echo __('Cancel'); ?>" title="<?php echo __('Cancel'); ?>" />
                <?php echo __('Cancel'); ?>
            </button>
        </p>
    </div>
    <!--form header-->
    <!--hidden input-->
    <?php
        echo input_hidden_tag('act', $sf_flash->has('act') ? $sf_params->get('act') : $act);
    ?>
    <!--hidden input-->

    <!--main-->
    <div id="tabContent" class="yui-content tabContent">
        <div id="tab1">
            <div><?php echo __(form_error("backError")); ?></div>
            <div class="formItem">                     
                <label><?php echo __("Product Name"); ?></label>

                <?php 
                    echo input_tag("name", $sf_flash->has('commit') ? $sf_params->get('name') : $product->getName(), array('class'=>'langInput'));
                ?>  
                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("name")); ?>
            </div>
            
            
            <div class="formItem">                     
                <label><?php echo __("Product Profit Type"); ?></label>

                <?php 
                     echo select_tag("profitType", options_for_select($attributes['profit_type'], $sf_flash->has('commit') ? $sf_params->get('profitType') : $product->getProfitType()), array('class' => 'select_tag_width'));
                ?>
                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("profitType")); ?>

            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Currency"); ?></label>
                <?php 
                     echo select_tag("currency", options_for_select($attributes['currency'], $sf_flash->has('commit') ? $sf_params->get('currency') : $product->getCurrency()), array('class' => 'select_tag_width'));
                ?>
                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("currency")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Bank Name"); ?></label>

                <?php 
                    echo select_tag('bankId', options_for_select(DepositBankPeer::getBankList(), $sf_flash->has('commit') ? $sf_params->get('bankId')  : $product->getBankId()), array('class' => 'select_tag_width'));
                ?>
                
                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("bankId")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Region Name"); ?></label>

                <?php 
                    echo input_tag("region", $sf_flash->has('commit') ? $sf_params->get('region') : $product->getRegion(), array('class'=>'langInput'));
                ?>  
            </div>
            
            
            <div class="formItem">                     
                <label><?php echo __("Product Invest Cycle"); ?><span><?php echo __('Support one float.');?></span></label>

                <?php 
                    echo input_tag("investCycle", $sf_flash->has('commit') ? $sf_params->get('investCycle') : $product->getInvestCycle(), array('class'=>'langInput'));
                ?> 

                &nbsp;<?php echo __(form_error("investCycle")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Target"); ?></label>
                <?php 
                    echo input_tag("target", $sf_flash->has('commit') ? $sf_params->get('target') : $product->getTarget(), array('class'=>'langInput'));
                ?>

            </div>
            
            <div class="formItem">                     
                <label style="line-height:39px;"><?php echo __("Product Sale Start Date"); ?></label>
                <?php 

                    echo input_date_tag('saleStartDate', 
                        $sf_flash->has('commit') ? 
                        strtotime($sf_params->get('saleStartDate')) == true ? 
                        $sf_params->get('saleStartDate'): '' : 
                        $product->getSaleStartDate(), 
                        array('rich' => true, 'class' => 'dateStyle'));

                    
                ?>
                &nbsp;<div class="form_must">*</div>
                &nbsp;<?php echo __(form_error("saleStartDate")); ?>
            </div>
            
            <div class="formItem">                     
                <label style="line-height:39px;"><?php echo __("Product Sale End Date"); ?></label>
                <?php 
                    echo input_date_tag('saleEndDate', $sf_flash->has('commit') ? strtotime($sf_params->get('saleEndDate')) == true ?  $sf_params->get('saleEndDate')  : '' : $product->getSaleEndDate(), array('rich' => true, 'class' => 'dateStyle'));
                ?>

                &nbsp;<div class="form_must">*</div>
                &nbsp;<?php echo __(form_error("saleEndDate")); ?>
            </div>

            <div class="formItem">                     
                <label style="line-height:39px;"><?php echo __("Product Profit Start Date"); ?></label>

                <?php 
                    echo input_date_tag('profitStartDate', $sf_flash->has('commit') ? strtotime($sf_params->get('profitStartDate')) == true ? $sf_params->get('profitStartDate') : '' : $product->getProfitStartDate(), array('rich' => true, 'class' => 'dateStyle'));
                ?>
                &nbsp;<?php echo __(form_error("profitStartDate")); ?>
            </div>
            
            <div class="formItem">                     
                <label style="line-height:39px;"><?php echo __("Product Deadline"); ?></label>
                <?php 
                    echo input_date_tag('deadline', $sf_flash->has('commit') ? strtotime($sf_params->get('deadline')) == true ? $sf_params->get('deadline') : '' : $product->getDeadline(), array('rich' => true, 'class' => 'dateStyle'));
                ?>
                &nbsp;<?php echo __(form_error("deadline")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Pay Period"); ?></label>
                <?php 
                    echo input_tag("payPeriod", $sf_flash->has('commit') ? $sf_params->get('payPeriod') : $product->getPayPeriod(), array('class'=>'langInput'));
                ?>

                &nbsp;<?php echo __(form_error("payPeriod")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Expected Rate"); ?><span><?php echo __('Support four float.');?></span></label>

                <?php 
                    echo input_tag("expectedRate", $sf_flash->has('commit') ? $sf_params->get('expectedRate') : $product->getExpectedRate(), array('class'=>'langInput'));
                ?>

                &nbsp;<?php echo __(form_error("expectedRate")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Actual Rate"); ?><span><?php echo __('Support four float.');?></span></label>

                <?php 
                    echo input_tag("actualRate", $sf_flash->has('commit') ? $sf_params->get('actualRate') : $product->getActualRate(), array('class'=>'langInput'));
                ?>

                &nbsp;<?php echo __(form_error("actualRate")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Invest Start Amount"); ?></label>
                <?php 
                    echo input_tag("investStartAmount", $sf_flash->has('commit') ? $sf_params->get('investStartAmount') : $product->getInvestStartAmount(), array('class'=>'langInput'));
                ?>
                &nbsp;<?php echo __(form_error("investStartAmount")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Invest Increase Amount"); ?></label>
                <?php 
                    echo input_tag("investIncreaseAmount", $sf_flash->has('commit') ? $sf_params->get('investIncreaseAmount') : $product->getInvestIncreaseAmount(), array('class'=>'langInput'));
                ?>
                &nbsp;<?php echo __(form_error("investIncreaseAmount")); ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Profit Desc"); ?></label>
                <?php
                    echo textarea_tag('profitDesc', $sf_flash->has('commit') ? $sf_params->get('profitDesc') : $product->getProfitDesc(), array('class' => 'area_style')); 
                ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Invest Scope"); ?></label>

                <?php
                    echo textarea_tag('investScope', $sf_flash->has('commit') ? $sf_params->get('investScope') : $product->getInvestScope(), array('class' => 'area_style')); 
                ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Stop Condition"); ?></label>
                <?php
                    echo textarea_tag('stopCondition', $sf_flash->has('commit') ? $sf_params->get('stopCondition') : $product->getStopCondition(), array('class' => 'area_style')); 
                ?>

            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Raise Condition"); ?></label>

                <?php
                    echo textarea_tag('raiseCondition', $sf_flash->has('commit') ? $sf_params->get('raiseCondition') : $product->getRaiseCondition(), array('class' => 'area_style')); 
                ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Purchase"); ?></label>

                <?php
                    echo textarea_tag('purchase', $sf_flash->has('commit') ? $sf_params->get('purchase') : $product->getPurchase(), array('class' => 'area_style')); 
                ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Cost"); ?></label>
                <?php
                    echo textarea_tag('cost', $sf_flash->has('commit') ? $sf_params->get('cost') : $product->getCost(), array('class' => 'area_style')); 
                ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Feature"); ?></label>


                <?php
                    echo textarea_tag('feature', $sf_flash->has('commit') ? $sf_params->get('feature') : $product->getFeature(), array('class' => 'area_style')); 
                ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Events"); ?></label>

                <?php
                    echo textarea_tag('events', $sf_flash->has('commit') ? $sf_params->get('events') : $product->getEvents(), array('class' => 'area_style')); 
                ?>
            </div>
            
            <div class="formItem">                     
                <label><?php echo __("Product Warnings"); ?></label>

                <?php
                    echo textarea_tag('warnings', $sf_flash->has('commit') ? $sf_params->get('warnings') : $product->getWarnings(), array('class' => 'area_style')); 
                ?>
            </div>
            
            <div class="formItem">                    
                <label><?php echo __("Product Announce"); ?></label>

                <?php
                    echo textarea_tag('announce', $sf_flash->has('commit') ? $sf_params->get('announce') : $product->getAnnounce(), array('class' => 'area_style')); 
                ?>

            </div>


        </div>
    </div>
    <!--main-->
    <!--hidden input-->
    <?php
        echo input_hidden_tag('id', $sf_flash->has('commit') ? $sf_params->get('id') : $product->getId());
     ?>
    <!--hidden input-->
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