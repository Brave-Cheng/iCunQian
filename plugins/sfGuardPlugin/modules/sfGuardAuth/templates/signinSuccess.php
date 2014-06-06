<table border="0" cellpadding="0" cellspacing="0" style="width:100%; height:500px;">
  <tr>
      <td align="center" valign="middle" style="text-align:center; vertical-align:middle">
      <form method="post" style="">
      <div style="margin:0px auto; text-align:center; width:350px;">
        <table border="0" cellpadding="3" cellspacing="0" class="" style="border:#E5EFF8 solid 1px; padding:0px; width:330px; line-height:25px;">
          <tr>
            <td align="left" colspan="3" style="padding:0px 5px 0px 5px; background:#F4F9FE url(/images/backgrounds/tableheader.gif) ">
              <b><?php echo __("Login") ?></b>
            </td>
          </tr>
          <tr>
            <td align="right" style="padding:5px;"><?php echo __("Username") ?></td>
            <td align="left"  style="padding:5px;"><input name="username" type="text" id="username" size="24" maxlength="32" class="textbox" /></td>
            <td></td>
          </tr>
          <tr>
            <td align="right" style="padding:5px;"><?php echo __("Password") ?></td>
            <td align="left" style="padding:5px;"><input name="password" type="password" id="password" size="24" maxlength="32" class="password" /></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td align="left" style="padding:5px;">
              <input type="submit" name="login" id="login" value="<?php echo __("Login") ?>" style="font-family:Arial;font-size:8pt; width:80px;" />&nbsp;
              <a href="<?php echo url_for("sfGuardAuth/forgotPassword") ?>"><?php echo __("Forgot your password?") ?></a>
            </td>
            <td></td>
          </tr>
          <tr>
            <td align="left" colspan="3"><div><?php echo __(form_error("login")) ?></div></td>
          </tr>
        </table>
      </div>
      </form>
    </td>
  </tr>
</table>