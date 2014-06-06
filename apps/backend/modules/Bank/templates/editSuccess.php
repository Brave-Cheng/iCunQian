<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script>
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
<!-- float js -->

<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Bank/handle', array('name' => 'bankHandle', 'id' => 'bankHandle', 'enctype' => 'multipart/form-data')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Bank'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('bankHandle', '<?php echo url_for('Bank/handle'); ?>');">
                <img src="/images/icons/check.png" alt="<?php echo __('Save'); ?>" title="<?php echo __('Save'); ?>" />
                <?php echo __('Save'); ?>
            </button>
            <!-- Cancel Button -->
            <button class="cancel" onclick="return formSubmit('bankHandle', '<?php echo url_for("Bank/index") ?>');">
                <img src="/images/icons/delete_small.png" alt="<?php echo __('Cancel'); ?>" title="<?php echo __('Cancel'); ?>" />
                <?php echo __('Cancel'); ?>
            </button>
        </p>
    </div>
    <!--form header-->

    <!--hidden input-->
    <?php echo input_hidden_tag("id", $bank->getId()); ?>
    <?php echo input_hidden_tag("sortBy", $sf_request->getParameter('sortBy')); ?>
    <?php echo input_hidden_tag("sort", $sf_request->getParameter('sort')); ?>
    <!--hidden input-->

    <!--main-->
    <div id="tabContent" class="yui-content tabContent">
        <div id="tab1">

            <div class="formItem">
                <label><?php echo __("Bank Name"); ?></label>
                <?php echo input_tag("bankName", $bank->getName(), array('class'=>'langInput')); ?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("bankName")); ?>
            </div>

            <div class="formItem">
                <label><?php echo __("Bank Short Name"); ?></label>
                <?php echo input_tag("bankShortName", $bank->getShortName()); ?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("bankShortName")); ?>
            </div>

            <div class="formItem">
                <label><?php echo __("Bank Phone"); ?></label>
                <?php echo input_tag("bankPhone", $bank->getPhone()); ?>&nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("bankPhone")); ?>
            </div>

            <div class="formItem">
                <label><?php echo __("Bank Logo"); ?></label>
                <?php echo input_file_tag("bankLogo"); ?>&nbsp;
                <a href="<?php echo "http://" . $sf_request->getHost() . '/' . strtr($bank->getLogo(), '\\', '/'); ?>"><img width="96" height="96" src="<?php echo "http://" . $sf_request->getHost() . '/' . strtr($bank->getLogo(), '\\', '/'); ?>"></a>
                <?php echo __(form_error("bankLogo")); ?>
            </div>

            <div class="formItem">
                <label><?php echo __("Create At"); ?></label>
                <?php echo input_tag("bankCreateAt", $bank->getCreatedAt(), array('class'=>'bankTime')); ?>&nbsp;
            </div>

            <div class="formItem">
                <label><?php echo __("Update At"); ?></label>
                <?php echo input_tag("bankUpdateAt", $bank->getUpdatedAt(), array('class'=>'bankTime')); ?>&nbsp;
            </div>

            <div class="formItem">
                <label><?php echo __("Is Valid"); ?></label>
                <?php echo rm2FormInputYesNoRadio("isValid", $bank->getIsValid()) ?>
                <?php echo __(form_error("isValid")); ?>
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
                    $("#statistic_start_date").datepicker({dateFormat: "yy-mm-dd"});
                });
                $('.bankTime').datetimepicker({
                    showButtonPanel: false,
                    dateFormat: "yy-mm-dd",
                    alwaysSetTime: false,
                    showTime: false,
                    changeMonth: false,
                    changeYear: false,
                    changeHour: false,
                    changeMinute: false
                });
</script>
