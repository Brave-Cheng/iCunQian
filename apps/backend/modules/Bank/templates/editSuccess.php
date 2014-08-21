<style type="text/css">
    .formItem span{margin: 0 10px;}
    .formItem span img{ border: none; width: 96px; height: 96px;}
</style>
<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script>
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
<!-- float js -->

<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Bank/handle?' . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager'), array('name' => 'bankHandle', 'id' => 'bankHandle', 'enctype' => 'multipart/form-data')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Bank'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('bankHandle', '<?php echo url_for('Bank/handle?' . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager')); ?>');">
                <img src="/images/icons/check.png" alt="<?php echo __('Save'); ?>" title="<?php echo __('Save'); ?>" />
                <?php echo __('Save'); ?>
            </button>
            <!-- Cancel Button -->
            <button class="cancel" onclick="return formSubmit('bankHandle', '<?php echo url_for("Bank/index?" . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>');">
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

            <div class="formItem">
                <label><?php echo __("Bank Name"); ?></label>

                <?php 
                    echo input_tag("bankName", $sf_flash->has('commit') ? $sf_params->get('bankName') : $bank->getName(), array('class'=>'langInput'));
                ?>  

                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("bankName")); ?>
            </div>

            <div class="formItem">
                <label><?php echo __("Bank Short Name"); ?></label>

                <?php 
                    echo input_tag("bankShortName", $sf_flash->has('commit') ? $sf_params->get('bankShortName') : $bank->getShortName(), array('class'=>'langInput'));
                ?>
                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("bankShortName")); ?>
            </div>

            <div class="formItem">
                <label><?php echo __("Bank Phone"); ?></label>
                <?php 
                    echo input_tag("bankPhone", $sf_flash->has('commit') ? $sf_params->get('bankPhone') : $bank->getPhone(), array('class'=>'langInput'));
                ?>
                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("bankPhone")); ?>
            </div>

            <div class="formItem">
                <span>
                            <label><?php echo __("Bank Logo"); ?></label>
                            <?php echo input_file_tag("bankLogo"); ?>
                </span>

                <span>
                    <?php if($bank->getLogo()):?>
                        <img src="<?php echo $bank->getLogo();?>">
                    <?php endif;?>
                </span>
                
 
                
                <?php echo __(form_error("bankLogo")); ?>
            </div>

            <div class="formItem">
                <label><?php echo __("Is Valid"); ?></label>
                <?php echo rm2FormInputYesNoRadio("isValid", $bank->getIsValid()) ?>
                <?php echo __(form_error("isValid")); ?>
            </div>


        </div>
    </div>
    <div class="clear"></div>
    <!--hidden input-->
    <?php if ($bank->getId()) echo input_hidden_tag("id", $bank->getId()); ?>
    <!--hidden input-->
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
