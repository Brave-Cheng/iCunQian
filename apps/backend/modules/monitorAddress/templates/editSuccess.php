<?php echo javascript_include_tag('jquery.leaveCheck.js'); ?>
<?php include_partial('global/confirm'); ?>
<?php echo form_tag('monitorAddress/update', 'method=post id=monitorAddress') ?>
<?php
    if( $monitoringAddress ){
        echo "<input name='id' value='" . $monitoringAddress->getId() . "' style='display:none;' />";
    }
?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <span><a class='jump' href="<?php echo url_for('monitorAddress/index'); ?>"><?php echo __('视频监控') ?></a></span> &gt; <span><?php echo __('地点详细页') ?></span>
    </div>
    <div class="box" id="monitorAddress">
        <div class="formDiv">
            <div class="formItem">
               <label class="label" for='office_of_the_company_name'><?php echo __('地点名'); ?>：</label>
               <div class="iner">
                    <input type="text" maxlength="40" class="txt w400" value="<?php echo $monitoringAddress ? htmlspecialchars($monitoringAddress->getOfficeOfTheCompanyName()) : ''; ?>" name='office_of_the_company_name' id='office_of_the_company_name' /><em class="red">*</em>&nbsp;（最长支持40位字符）
               </div>
               <div class="iner">
                    <span class="error"><?php echo __(form_span_error("office_of_the_company_name")); ?></span>
               </div>
            </div>
        </div>
        <div class="formDiv">
            <div class="formItem">
               <label class="label" for='address'><?php echo __('地址'); ?>：</label>
               <div class="iner">
                    <input type="text" maxlength="40" class="txt w400" value="<?php echo $monitoringAddress ? htmlspecialchars($monitoringAddress->getAddress()) : ''; ?>" name='address' id='address' /><em class="red">*</em>&nbsp;（最长支持40位字符）
               </div>
               <div class="iner">
                    <span class="error"><?php echo __(form_span_error("address")); ?></span>
               </div>
            </div>
        </div>
        <div class="btn_con mt20">
            <div class="btns clearfix">
                <input type="submit" value="<?php echo __('保存'); ?>" class="btn_blue" />
                <a href="<?php echo url_for('monitorAddress/index'); ?>" class="btn_blue jump"><?php echo __('返回列表'); ?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        <?php if( !$monitoringAddress ){ ?>
        $("#office_of_the_company_name").focus();
        <?php } ?>

        $(".jump").leaveCheck({formId:'monitorAddress',formUrl:'<?php echo url_for("monitorAddress/leaveCheck"); ?>'});
    })
</script>