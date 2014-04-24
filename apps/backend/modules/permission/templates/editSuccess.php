<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<?php echo form_tag('permission/update', 'method=post') ?>
<?php
    if($sfGuardPermission){
        echo "<input name='id' value='" . $sfGuardPermission->getId() . "' style='display:none;' />";
    }
?>
<div id="content" class="right">
    <div class="bread_crumbs"> <a href="<?php echo url_for('permission/index'); ?>"><?php echo __('权限管理'); ?></a> &gt; <span> <?php echo __('列表页') ?></span> </div>
    <div class="box">
        <div class="formDiv">
            <div class="formItem">
                    <label class="label">
                        <?php echo __('权限名称'); ?>：
                    </label>
                    <div class="iner">
                        <input type="text"  name='name' class="txt" value="<?php echo $sfGuardPermission ? htmlspecialchars( $sfGuardPermission->getName() ) : ''; ?>"/><em class="red">*</em>
                        <span class="error"><?php echo __(form_span_error("name")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('权限描述'); ?>：</label>
                <div class="iner">
                    <textarea name='description' class="textarea"><?php echo $sfGuardPermission ? htmlspecialchars( $sfGuardPermission->getDescription() ) : ''; ?></textarea>
                    <div class="error"><?php echo __(form_span_error('description')) ?></div>
                </div>
            </div>
            <div class="formItem">
                    <label class="label">
                        <?php echo __('模块名'); ?>：
                    </label>
                    <div class="iner">
                        <input type="text"  name='module_name' class="txt" value="<?php echo $sfGuardPermission ? $sfGuardPermission->getModuleName() : ''; ?>"/><em class="red">*</em>
                        <span class="error"><?php echo __(form_span_error("module_name")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                    <label class="label">
                        <?php echo __('动作名'); ?>：
                    </label>
                    <div class="iner">
                        <input type="text"  name='action_name' class="txt" value="<?php echo $sfGuardPermission ? $sfGuardPermission->getActionName() : ''; ?>"/><span class="red">&nbsp;只有特殊权限需要填写</span>
                        <span class="error"><?php echo __(form_span_error("action_name")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                    <label class="label">
                        <?php echo __('排序'); ?>：
                    </label>
                    <div class="iner">
                        <input type="text"  name='sortOrder' class="txt" value="<?php echo $sfGuardPermission ? $sfGuardPermission->getSortOrder() : ''; ?>"/><em class="red">*</em>
                        <span class="error"><?php echo __(form_span_error("sortOrder")); ?></span>
                    </div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="保存" class="btn_blue" />
                <a href="<?php echo url_for('permission/index'); ?>" class="btn_blue"><?php echo __('放弃'); ?></a>
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

        <?php if(!isset($sfGuardPermission)){ ?>
            $("input[name='name']").focus();
        <?php }?>
    });
</script>