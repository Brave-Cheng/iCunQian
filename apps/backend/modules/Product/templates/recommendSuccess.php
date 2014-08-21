<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
    $('#recommend').jqEasyCounter({
        'maxChars': 256,
        'maxCharsWarning': 200,
        'msgFontSize': '12px',
        'msgFontColor': '#000',
        'msgFontFamily': 'Verdana',
        'msgTextAlign': 'left',
        'msgWarningColor': '#F00',
        'msgAppendMethod': 'insertBefore'               
    });
});
</script>
<!-- float js -->
<style type="text/css">
    .request_error{word-wrap: break-word;}
    .error_left{width: 245px; float: left;}
    .form_error span{border-right: 1px solid rgb(85, 80, 80); margin-right: 4px; color: red;}
</style>
<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Product/push?' . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid') , array('name' => 'pushForm', 'id' => 'pushForm', 'enctype' => 'multipart/form-data')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Recommend'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('pushForm', '<?php echo url_for('Product/push?' . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')); ?>');">
                <img src="/images/icons/check.png" alt="<?php echo __('Send'); ?>" title="<?php echo __('Send'); ?>" />
                <?php echo __('Send'); ?>
            </button>
            <!-- Cancel Button -->
            <button class="cancel" onclick="return formSubmit('pushForm', '<?php echo url_for("Product/index?" . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>');">
                <img src="/images/icons/delete_small.png" alt="<?php echo __('Cancel'); ?>" title="<?php echo __('Cancel'); ?>" />
                <?php echo __('Cancel'); ?>
            </button>
        </p>
    </div>
    <!--form header-->
    <!--hidden input-->
    <?php echo input_hidden_tag("id", $product->getId()); ?>
    <!--hidden input-->

    <!--main-->
    <div id="tabContent" class="yui-content tabContent">
        <div id="tab1">
            <div class="formItem">

                <label>
                    <?php 
                        echo radiobutton_tag(
                            'template',
                            sprintf(util::getMultiMessage('This Week Top Products %s, Profit Type is %s'), $product->getName(), $product->getProfitType()),
                            false,
                            array('onclick' => 'check_push_message_template(this.value, this);', 'class' => 'template')  
                        );
                    ?>
                </label>
                    <?php echo sprintf(util::getMultiMessage('This Week Top Products %s, Profit Type is %s'), $product->getName(), $product->getProfitType());?>
            </div>

            <div class="formItem">
                <label>
                    <?php 
                        echo radiobutton_tag(
                            'template',
                            sprintf(util::getMultiMessage('Wow, There is %s come %s'), $product->getFormatExpactedRate(), $product->getName()),
                            false,
                            array('onclick' => 'check_push_message_template(this.value, this);', 'class' => 'template')  
                        );
                    ?>
                </label>
                <?php echo sprintf(util::getMultiMessage('Wow, There is %s come %s'), $product->getFormatExpactedRate(), $product->getName());?>
            </div>

            <div class="formItem">
                <label>
                    <?php 
                        echo radiobutton_tag(
                            'template',
                            sprintf(util::getMultiMessage('Bank %s Profit is %s'), $product->getName(), $product->getFormatExpactedRate()),
                            false,
                            array('onclick' => 'check_push_message_template(this.value, this);', 'class' => 'template')  
                        );
                    ?>
                </label>
                <?php echo sprintf(util::getMultiMessage('Bank %s Profit is %s'), $product->getName(), $product->getFormatExpactedRate());?>
            </div>

            <div class="clear"></div>
            


            <div class="clear"></div>
            <div class="formItem">                     
                <label style="margin-top:10px;">编辑消息内容</label>
                <div class="message">
                    <?php echo textarea_tag('recommend','', array('cols' => 100, 'rows' => 7))?>
                    <div class="error_left">
                        &nbsp;
                    </div>
                    <div class="error_right"><?php echo __(form_error('recommend'))?></div>
                </div>                
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


function check_push_message_template(val, the) {
    if ($(the).attr('checked') == 'checked') {
        $("#recommend").val(val);
        var text = $("#recommend").val().trim();
        var counter = text.length;
        $(".message_num").text(256 - counter);

    } else {
        $("#recommend").val('');
    }
    
}

</script>