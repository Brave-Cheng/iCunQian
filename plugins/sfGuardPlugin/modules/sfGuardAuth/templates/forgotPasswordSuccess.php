<table border="0" cellpadding="0" cellspacing="0" style="width:100%; height:500px;">
    <tr>
        <td align="center" valign="middle" style="text-align:center; vertical-align:middle">
            <form method="post" style="">
            <div style="margin:0px auto; text-align:center; width:350px;">
                <table border="0" cellpadding="3" cellspacing="0" class="" style="border:#E5EFF8 solid 1px; padding:0px; width:330px; line-height:25px;">
                    <tr>
                        <td align="left" colspan="3" style="padding:0px 5px 0px 5px; background:#F4F9FE url(/images/backgrounds/tableheader.gif) ">
                            <b><?php echo __("Forgot Password") ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" style="padding:5px;"><?php echo __("Email") ?></td>
                        <td align="left"  style="padding:5px;"><input name="email" type="text" id="email" size="24" maxlength="32" class="textbox" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="left" style="padding:5px;">
                            <input type="submit" name="login" id="login" value="<?php echo __("Send Email") ?>" style="font-family:Arial;font-size:8pt; width:110px;" />&nbsp;
                            <a href="<?php echo url_for("auth/login") ?>"><input type="button" name="back" id="login" value="<?php echo __("Return") ?>" style="font-family:Arial;font-size:8pt; width:60px;" /></a>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3"><div><?php echo __(form_error("forgotPassword")) ?></div></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3">
                            <?php if($send) : ?>
                                <div style="color:green">The new password has been sent to your email, please check your email.</div>
                            <?php endif; ?>
                            </td>
                    </tr>
                </table>
            </div>
            </form>
        </td>
    </tr>
</table>