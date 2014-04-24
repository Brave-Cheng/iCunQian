<link rel="stylesheet" href="/js/shadowbox/shadowbox.css">
<script type="text/javascript" src="/js/shadowbox/shadowbox.js"></script>
<script type="text/javascript">
    Shadowbox.init();
</script>
<div class="wrap login_wrap">
    <div id="login_div">
        <form action="<?php echo url_for("sfGuardAuth/signin")?>" method="post">
        <div class="login_title imgBg"><?php echo __('四川高路交通信息工程有限公司OA系统'); ?></div>
        <div class="login_form formDiv">
            <div class="formItem">
                <label class="label"><?php echo __('用户名'); ?>：</label>
                <div class="iner">
                    <input name='username' id='username' type="text" class="txt" value=""/>
                </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('密&nbsp;&nbsp;码'); ?>：</label>
                <div class="iner">
                    <input name='password' id='password' type="password" class="txt" value=""/>
                </div>
            </div>
            <div class="btn_con clearfix mt5">
                <div class="btns clearfix">
                    <input class='btn_blue' type="submit" name="login" id="login" value="<?php echo __("登录") ?>" />
                    <a class='btn_blue' href="<?php echo url_for("sfGuardAuth/password") ?>" rel="Shadowbox;type=iframe;width=400;height=276"><?php echo __("忘记密码？") ?></a>
                </div>
            </div>
            <div class="red" style="margin:10px 0 0 58px;"><?php echo __(form_error("username")) ?></div>
            <div class="clear"></div>
        </div>
        </form>
    </div>
</div>