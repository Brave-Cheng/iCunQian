<div id="content" class="right">
    <?php echo form_tag("commitApproval/insertApprovalType", "id=addType") ?>
    <div class="bread_crumbs"> <a href="<?php echo url_for('commitApproval/index'); ?>"><?php echo __('审批流程') ?></a> &gt; <span><?php echo __('新建审批') ?> &gt; <?php echo __('第一步:选择审批类型'); ?></span> </div>
    <div class="box">
        <div class="formDiv">
            <div class="mb15"><?php echo __('你正在创建一个新审批，首先请选择审批类型'); ?>：</div>
            <div class="formItem" id="div_type">
                <?php foreach ($approvalTypes as $ApprovalType): ?>
                    <label class="mb10">
                        <input type="radio"  name="types" value="<?php echo $ApprovalType->getId(); ?>" ><?php echo $ApprovalType->getName(); ?>
                    </label></br />
                <?php endforeach; ?>
                <div class="clear"></div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="<?php echo __('确认审批类型并填写审批表单'); ?>" class="btn_blue" />
                <a href="<?php echo url_for('commitApproval/index') ?>"  class="btn_blue jump"><?php echo __('放弃') ?></a>
            </div>
        </div>
    </div>
</form>
</div>
<script type="text/javascript">
    $(function() {
        $('#div_type input:radio').first().attr('checked', 'true');
    });
</script>