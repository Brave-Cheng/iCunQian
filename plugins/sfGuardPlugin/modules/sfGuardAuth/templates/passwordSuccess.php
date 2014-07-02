<style>
body{background:#fff;}
div.main_content{}
div.main_content .label{display: block;width: 110px; text-align: right;float: left;line-height: 30px;}
.publishButton{margin-left: 116px;}
span.form_must{color:#ca0000;vertical-align: middle;float: left;line-height: 30px;}
#tabContent .btns{text-align: center;}
#tabContent .btns .btn_blue{float: none;margin:20px auto;}
#tabContent .details_feed{margin: 80px 0 0 0;}
</style>
<div id="tabContent">
    <h2><?php echo __("重置密码") ?></h2>
    <?php if(!isset($flag)){ ?>
        <form action="<?php echo url_for("sfGuardAuth/forgotPassword")?>" method="POST" id="forgotPassword">
            <div class="details">
                <div class="formItem">
                    <span class="form_must">*</span>
                    <label for="username" class="label"><?php echo __("请输入您的用户名") ?>：</label>
                    <input type="text"  name='username' class="txt" value=""/>
                    <span class="error"><?php echo __(form_span_error("username")); ?></span>
                </div>
                <div class="clear"></div>
                <br/>
                <div class="formItem">
                    <span class="form_must">*</span>
                    <label for="telephone" class="label"><?php echo __("请输入您的手机号") ?>：</label>
                    <input type="text"  name='telephone' class="txt" value=""/>
                    <span class="error"><?php echo __(form_span_error("telephone")); ?></span>
                </div>
                <br/>
                <div class="formItem">
                    <span class="form_must">*</span>
                    <label for="email" class="label"><?php echo __("请输入您的邮箱") ?>：</label>
                    <input type="text"  name='email' class="txt" value=""/>
                    <span class="error"><?php echo __(form_span_error("email")); ?></span>
                </div>
                <br/>
                <div class="formItem alignCenter">
                    <span class="error"><?php echo __(form_span_error("usernameEmailTelephone")); ?></span>
                </div>
            </div>
            <div class="btns clearfix mt5">
            <button name="clicksave" id="clicksave" class="publishButton btn_blue mt5" onclick="return formSubmit('forgotPassword', '<?php echo url_for("sfGuardAuth/forgotPassword") ?>');">
                <?php echo __("发送新的密码") ?>
            </button>
            </div>
            <div class="clear"></div>
        </form>
    <?php }else{ ?>
        <?php if( $flag == 'successfully' ){ ?>
            <div class="details details_feed">
                <div class="formItem" style="text-align:center;">
                    <?php echo __("密码已重置,已将新密码发送至你的邮箱") ?>
                </div>
            </div>
        <?php }elseif( $flag == 'failed' ){ ?>
            <div class="details details_feed">
                <div class="formItem" style="text-align:center;">
                    <?php echo __("邮件发送过程中发生错误,请再试一次n.  <br />如果问题仍然存在，请与系统管理员联系.") ?>
                </div>
            </div>
        <?php } ?>
        <div class="btns clearfix">
            <button name="clicksave" id="clicksave" class="publishButton btn_blue" onclick="parent.Shadowbox.close();">
                <?php echo __("Close") ?>
            </button>
        </div>
    <?php } ?>
</div>