<?php include_partial('global/confirm'); ?>
<?php echo form_tag('dashboard/updateChangePassword','id=dashboard')?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a class="jump" href="<?php echo url_for('dashboard/index')?>"><?php echo __('个人中心') ?></a> &gt; <?php echo __('修改密码') ?>
    </div>
    <div class="box">
    <div class="formDiv">   
       <div class="formItem">
               <label class="label" for="password"><?php echo __('原密码：');?></label>
           <div class="iner">
               <?php echo input_password_tag('password')?> 
               <span class="error"> <?php echo form_span_error('password') ?></span>
           </div>
       </div>
    </div>   
    <div class="formDiv">   
       <div class="formItem">
               <label class="label" for="newPassword"><?php echo __('新密码：');?></label>
           <div class="iner">
               <?php echo input_password_tag('newPassword')?> 
               <span class="error"> <?php echo form_span_error('newPassword') ?></span>
           </div>
       </div>
    </div> 
    <div class="formDiv">   
       <div class="formItem">
               <label class="label" for="confirmPassword" ><?php echo __('再次输入密码：');?></label>
           <div class="iner">
               <?php echo input_password_tag('confirmPassword')?> 
               <span class="error"> <?php echo form_span_error('confirmPassword') ?></span>
           </div>
       </div>
    </div> 
    <div class="btn_con">
    <div class="btns clearfix">
        <input type="submit" value="<?php echo __('修改');?>" class="btn_blue" />
        <a href="<?php echo url_for('dashboard/index'); ?>" class="btn_blue jump"><?php echo __('放弃');?></a>
    </div>
    </div>
    </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage('<?php echo __("密码修改成功，请用新密码重新登入"); ?>', "<?php echo url_for('sfGuardAuth/signout'); ?>" );
        }else if(msg == '0'){
            showSaveSuccessfullyMessage('<?php echo __("密码修改失败");?>');
        }else if(msg == '2'){
            showSaveSuccessfullyMessage('<?php echo __("密码已经在其他地方被修改，请用新密码重新登入"); ?>', "<?php echo url_for('sfGuardAuth/signout'); ?>" );
        }
        $(".jump").leaveCheck({formId:'dashboard',formUrl:'<?php echo url_for("dashboard/checkPassword"); ?>'});
    });
</script>
