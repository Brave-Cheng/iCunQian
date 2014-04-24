<?php include_partial('global/confirm'); ?>
<?php echo form_tag('group/update', 'method=post') ?>
<?php
    if(!is_null($group)){
        echo "<input name='id' value='" . $group->getId() . "' style='display:none;' />";
    }
?>
<div id="content" class="right">
    <div class="bread_crumbs"> <a href="<?php echo url_for('group/index'); ?>"><?php echo __('用户组管理'); ?></a> &gt; <span> <?php echo __('编辑') ?></span> </div>
    <div class="box">
        <div class="formDiv">
            <div class="formItem">
                    <label class="label">
                        <?php echo __('用户组名称'); ?>：
                    </label>
                    <div class="iner">
                        <input type="text"  name='name' class="txt" value="<?php echo $group ? htmlspecialchars( $group->getName() ) : ''; ?>"/><em class="red">*</em>
                        <span class="error"><?php echo __(form_span_error("name")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('用户组描述'); ?>：</label>
                <div class="iner">
                    <textarea name='description' class="textarea"><?php echo $group ? htmlspecialchars( $group->getDescription() ) : ''; ?></textarea>
                    <div class="error"><?php echo __(form_span_error('description')) ?></div>
                </div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="保存" class="btn_blue" />
                <a href="<?php echo url_for('group/index'); ?>" class="btn_blue"><?php echo __('放弃'); ?></a>
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

        <?php if(is_null($group)){ ?>
            $("input[name='name']").focus();
        <?php }?>
    });
</script>