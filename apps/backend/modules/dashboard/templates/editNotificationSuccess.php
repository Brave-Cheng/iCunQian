<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<div id="content" class="right">
    <?php echo form_tag("dashboard/addNotification?" . html_entity_decode(formGetQuery("sort", "sortBy", "keywords")), "id=notification_table") ?>
    <?php echo "<input name='id' value='" . $receivers . "' style='display:none;' />"; ?>
    <div class="bread_crumbs jump"> <a href="<?php echo url_for('dashboard/index'); ?>"><?php echo __('个人中心'); ?></a> &gt; <?php echo __('新建通知'); ?> &gt; <span><?php echo __('第二步：撰写通知内容'); ?></span> </div>
    <div class="box">
        <div class="formDiv">
            <div class="formItem">
                    <label class="label">
                        <?php echo __('收件人'); ?>：&nbsp;&nbsp;
                    </label>
                    <div class="iner mt5 w480">
                        <?php if($receivers == 'all'){ ?>
                            <?php echo __('所有人');?>
                        <?php }else{ 
                            $ids = explode(',', $receivers);
                            $users = sfGuardUserPeer::retrieveByPKs( $ids );
                            foreach( $users as $user ){
                                echo htmlspecialchars( $user->getProfile()->getLastName().$user->getProfile()->getFirstName() ) . ' ';
                            }
                        } ?>
                    </div>
            </div>
            <div class="formItem">
                <div class="iner" style="line-height: 12px">
                    <input type="checkbox" name='telephone' class="cbox" value="true"/> 
                    <span><?php echo __('同时发送手机短信给收件人'); ?></span>
                </div>
            </div>
            <div class="formItem">
                    <label class="label">
                        <?php echo __('通知标题'); ?>：<em class="red">*</em>
                    </label>
                    <div class="iner">
                        <input type="text"  name='title' class="txt w480" value=""/>
                        <span class="error"><?php echo __(form_span_error("title")); ?></span>
                        <div class="mt5"><?php echo __('建议标题长度在30个字符以内'); ?></div>
                    </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('通知正文：'); ?><em class="red">*</em></label>
                <div class="iner">
                    <textarea name='content' class="textarea"></textarea>
                    <div class="error"><?php echo __(form_span_error('content')) ?></div>
                </div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="<?php echo __('确认发送'); ?>" class="btn_blue" />
                <a href="<?php echo url_for('dashboard/selectReceivers'); ?>" class="btn_blue jump"><?php echo __('返回重新选择收件人'); ?></a>
                <a href="<?php echo url_for('dashboard/index'); ?>" class="btn_blue jump"><?php echo __('放弃'); ?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $("input[name='title']").focus();
        var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage();
        }    
        $(".jump").leaveCheck({formId:'notification_table',formUrl:'<?php echo url_for("dashboard/checkReceiver"); ?>'});
    });
</script>