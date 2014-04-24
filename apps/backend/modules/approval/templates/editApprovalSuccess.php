<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js'); ?>
<form action="<?php echo url_for('approval/updateApproval'); ?>" method="post" id="approval" >
<?php if( $approval ){ ?>
    <input name='approval_id' type='hidden' value='<?php echo $approval->getId() ?>' />
<?php } ?>
<div id="content" class="right">
    <div class="bread_crumbs"> <a class="jump" href="<?php echo url_for('approval/approvalList'); ?>"><?php echo __('审批管理'); ?></a> &gt; <span> <?php echo __('编辑审批') ?></span> </div>
    <div class="box">
        <div class="formDiv">
            <div class="formItem">
                    <label class="label">
                        <?php echo __('审批名称'); ?>：<em class="red">*</em>
                    </label>
                    <div class="iner">
                        <input type="text"  name='name' class="txt" value="<?php echo $approval ? $approval->getName() : ''; ?>"/>
                        <span class="error"><?php echo __(form_span_error("name")); ?></span>
                    </div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="保存" class="btn_blue" />
                <a href="<?php echo url_for('approval/approvalList'); ?>" class="btn_blue jump"><?php echo __('放弃'); ?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage(null, "<?php echo url_for($urlName); ?>");
        }

        $(".jump").leaveCheck({formId:'approval',formUrl:'<?php echo url_for("approval/approvalLeaveCheck"); ?>'});
    });
</script>