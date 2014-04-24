<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo form_tag('dashboard/update', 'method=post id=userInfo') ?>
<input name='id' value='<?php echo $sfUser->getId(); ?>' type="hidden" />
<div id="content" class="right">
    <div class="bread_crumbs"> <a class="jump" href="<?php echo url_for('dashboard/index'); ?>"><?php echo __('个人中心') ?></a> &gt; <span> <?php echo __('修改信息') ?></span> </div>
    <div class="box">
        <div class="formDiv">
            <div class="formItem">
                    <label class="label">
                        <?php echo __('姓'); ?>：<em class="red">*</em>
                    </label>
                    <div class="iner">
                        <input type="text"  name='last_name' class="txt" value="<?php echo $userProfile ? htmlspecialchars( $userProfile->getLastName() ) : ''; ?>"/>
                        <span class="error"><?php echo __(form_span_error("last_name")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                    <label class="label">
                        <?php echo __('名'); ?>：<em class="red">*</em>
                    </label>
                    <div class="iner">
                        <input type="text"  name='first_name' class="txt" value="<?php echo $userProfile ? htmlspecialchars( $userProfile->getFirstName() ) : ''; ?>"/>
                        <span class="error"><?php echo __(form_span_error("first_name")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                    <label class="label" for="username"><?php echo __('用户名'); ?>：<em class="red">*</em></label>
                    <div class="iner">
                        <input type="text" readonly name='username' class="txt disabled" value="<?php echo $sfUser ? $sfUser->getUsername() : ''; ?>"/>
                        <span class="error"><?php echo __(form_span_error("username")); ?></span>
                        <div class="mt5"><?php echo __('用户名由5-12位字母,数字,下划线组成'); ?></div>
                    </div>
            </div>
            <?php if( !$sfUser ){ ?>
            <div class="formItem">
                    <label class="label" for="password"><?php echo __('密码'); ?>：<em class="red">*</em></label>
                    <div class="iner">
                        <input id='password' type="password" name='password' class="txt" value=""/>
                        <span class="error"><?php echo __(form_span_error("password")); ?></span>
                        <div class="mt5"><?php echo __('密码由5-15位字母,数字,下划线组成'); ?></div>
                    </div>
            </div>
            <?php } ?>
            <div class="formItem">
                    <label class="label"><?php echo __('性别'); ?>：<em class="red">*</em></label>
                    <div class="iner">
                        <label class="inblock mr10"><input name='gender' type="radio" class="radio" value="1" <?php if( $userProfile && $userProfile->getGender() == 1){ echo 'checked="true"'; } ?> /> 男</label>
                        <label class="inblock mr10"><input name='gender' type="radio" class="radio" value="0" <?php if( $userProfile && $userProfile->getGender() == 0){ echo 'checked="true"'; } ?> /> 女</label>
                        <span class="error"><?php echo __(form_span_error("gender")); ?></span>
                        <div class="clear"></div>
                    </div>
            </div>
            <div class="formItem">
                    <span class="label"><?php echo __('联系方式'); ?>：&nbsp;&nbsp;</span>
                    <div class="clear"></div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('手机'); ?>：<em class="red">*</em></label>
                <div class="iner phone">
                    <span class="inblock mr10">
                        <input name='telephone' type="text" class="txt" value="<?php echo $userProfile ? $userProfile->getTelephone() : ''; ?>"/>
                        <br />
                        <span class="error"><?php echo __(form_span_error("telephone")); ?></span>
                    </span>
                    <span class="inblock mr10">
                        <?php echo __('QQ'); ?>：&nbsp;&nbsp;<input name='qq' type="text" class="txt" value="<?php echo $userProfile ? $userProfile->getQq() : ''; ?>"/><br />
                        <span class="error qq_err"><?php echo __(form_span_error("qq")); ?></span>
                    </span>
                    <span class="inblock mr10">
                        <?php echo __('邮箱'); ?>：<em class="red">*</em> <input name='email' type="text" class="txt" value="<?php echo $userProfile ? $userProfile->getEmail() : ''; ?>"/><br />
                        <span class="error email_err ml10"><?php echo __(form_span_error("email")); ?></span>
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="formItem">
                <label class="label">&nbsp;&nbsp;</label>
                <div class="iner lh30">
                    <?php echo __('请确保手机的正确性，否则会影响短信的接收');?>
                </div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="保存" class="btn_blue" />
                <a href="<?php echo url_for('dashboard/index'); ?>" class="btn_blue jump"><?php echo __('放弃'); ?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage('', "<?php echo url_for($urlName)?>");
        }
        $(".jump").leaveCheck({formId:'userInfo',formUrl:'<?php echo url_for("dashboard/checkUserInfo"); ?>'});
    });
</script>