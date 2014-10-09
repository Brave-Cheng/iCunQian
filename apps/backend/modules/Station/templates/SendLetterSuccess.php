<style type="text/css">
.personList{width: 260px; margin: 10px 0; height: 200px;}
.personSelect{display: block; margin-left:245px; width: 220px; display: none; }
.none{display: none;}
.block{display: block;}

</style>

<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script>
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
<!-- float js -->
<script type="text/javascript">
$(document).ready(function(){
    $('#content').jqEasyCounter({
        'maxChars': 256,
        'maxCharsWarning': 150,
        'msgFontSize': '12px',
        'msgFontColor': '#000',
        'msgFontFamily': 'Verdana',
        'msgTextAlign': 'left',
        'msgWarningColor': '#F00',
        'msgAppendMethod': 'insertBefore'               
    });
});

function designee(obj) {
    if (obj.value == 'notAll') {
        $('.personSelect').css('display','block');
    } else {
        $('.personSelect').css('display','none');
    }
}
</script>
<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Station/doSendLetter?' . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager'), array('name' => 'stationHandle', 'id' => 'stationHandle', 'enctype' => 'multipart/form-data')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Send Station'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('stationHandle', '<?php echo url_for('Station/doSendLetter?' . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager')); ?>');">
                <img src="/images/icons/check.png" alt="<?php echo __('Save'); ?>" title="<?php echo __('Save'); ?>" />
                <?php echo __('Save'); ?>
            </button>
            <!-- Cancel Button -->
            <button class="cancel" onclick="return formSubmit('stationHandle', '<?php echo url_for("Members/index?" . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>');">
                <img src="/images/icons/delete_small.png" alt="<?php echo __('Cancel'); ?>" title="<?php echo __('Cancel'); ?>" />
                <?php echo __('Cancel'); ?>
            </button>
        </p>
    </div>
    <!--form header-->
    
    <!--main-->
    <div id="tabContent" class="yui-content tabContent">
        <div id="tab1">

            <div class="formItem">
                <label><?php echo __("Station Person"); ?></label>
                
                <?php 

                    $sendMessageType = $sf_flash->get('sendMessageType') ? $sf_flash->get('sendMessageType') : $sendMessageType;
                    if ($sendMessageType == DepositMembersStationNewsPeer::FORM_POST_WHOLE) {
                        echo checkbox_tag('showSelectedUsers',  1, true, array('disabled' => true)), __('Letter All');
                    }
                ?>
                <span class="person">
                        <?php 
                        if ($sendMessageType == DepositMembersStationNewsPeer::FORM_POST_SELECTED) {
                            $users = $sf_flash->get('users') ? $sf_flash->get('users') : $users;
                            foreach ($users as $user) {
                                echo checkbox_tag('showSelectedUsers', $user->getId(), true, array('disabled' => true)), $user->getNickname();
                            }
                        }

                        ?>
                </span>
                <?php 
                    echo input_hidden_tag('sendMessageType', $sendMessageType);
                    echo input_hidden_tag('personList', $selectedUsers);
                ?>
                &nbsp;<div class="form_must">*</div> <?php echo __(form_error("sendMessageType")); ?>
                
            </div>

            <div class="formItem">
                <label><?php echo __("Title"); ?></label>
                <?php 
                    echo input_tag("title", $sf_flash->get('title'), array('class'=>'langInput'));
                ?>  
                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("title")); ?>
            </div>

            <div class="formItem">
                <label><?php echo __("Content"); ?></label>
                <?php 
                    echo textarea_tag('content', $sf_flash->get('content'),array('cols' => 80, 'rows' => 6));
                ?>  
                &nbsp;<div class="form_must">*</div>
                <?php echo __(form_error("content")); ?>
            </div>


        </div>
    </div>
    <div class="clear"></div>
    <!--hidden input-->
    <!--hidden input-->
</form>

</div>
<!-- float js to element-->

<script type="text/javascript">
$(document).ready(function() {
    var msg = "<?php echo $sf_request->getParameter("rmsg"); ?>";
    if (msg == "0") {
        showDialogYes('<?php echo __("Save Successful") ?>', '<?php echo __("Message") ?>', function() {
            location.href="/Members/index";
        });

    }
});
</script>
