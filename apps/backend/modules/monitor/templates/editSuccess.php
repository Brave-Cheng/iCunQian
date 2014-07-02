<?php echo javascript_include_tag('jquery.leaveCheck.js'); ?>
<?php include_partial('global/confirm'); ?>
<?php echo form_tag('monitor/update', 'method=post id=monitor') ?>
<?php
    if($monitor){
        echo "<input type='hidden' name='id' value='" . $monitor->getId() . "' />";
    }
?>
<input name="monitoringAddressId" type="hidden" value="<?php echo $monitoringAddress->getId(); ?>" />
<div id="content" class="right">
    <div class="bread_crumbs">
        <span><a class="jump" href="<?php echo url_for('monitorAddress/index'); ?>"><?php echo __('视频监控'); ?></a></span> &gt; <span><?php echo __('添加摄像头'); ?></span>
    </div>
    <div class="box" id="monitor">
        <div class="formDiv">
            <?php if(!$monitor){ ?>
            <span><?php echo __('您正在为 ' . $monitoringAddress->getOfficeOfTheCompanyName() . ' 的监控列表添加摄像头'); ?>： </span>
            <?php }else{ ?>
            <span><?php echo __('您正在修改 ' . $monitoringAddress->getOfficeOfTheCompanyName() . ' 的监控列表中的摄像头'); ?>： </span>
            <?php } ?>
        </div>
        <div class="formDiv">
            <div class="formItem">
               <label class="label" for='office_of_the_company_name'><?php echo __('描述'); ?>：</label>
               <div class="iner">
                    <input type="text" class="txt w400" value="<?php echo $monitor ? $monitor->getDescription() : ''; ?>" name='description' id='description' /><em class="red">*</em>&nbsp;（最长支持40位字符）
               </div>
               <div class="iner">
                    <span class="error"><?php echo __(form_span_error("description")); ?></span>
               </div>
            </div>
        </div>
        <div class="formDiv">
            <div class="formItem">
               <label class="label" for='address'><?php echo __('视频地址'); ?>：</label>
               <div class="iner">
                    <input type="text" class="txt w400" value="<?php echo $monitor ? $monitor->getIp() : ''; ?>" name='ip' id='ip' /><em class="red">*</em>&nbsp;（最长支持40位字符）
               </div>
               <div class="iner">
                    <span class="error"><?php echo __(form_span_error("ip")); ?></span>
               </div>
            </div>
        </div>
        <div class="btn_con mt20">
            <div class="btns clearfix">
                <input type="submit" value="<?php echo __('保存'); ?>" class="btn_blue" />
                <a href="<?php echo url_for('monitor/index?id=' . $monitoringAddress->getId()); ?>" class="btn_blue jump"><?php echo __('返回列表'); ?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage(null, '<?php echo url_for($urlName); ?>');
        }
        <?php if(!$monitor){ ?>
        $("#description").focus();
        <?php } ?>

        $(".jump").leaveCheck({formId:'monitor',formUrl:'<?php echo url_for("monitor/leaveCheck"); ?>'});
    });
</script>