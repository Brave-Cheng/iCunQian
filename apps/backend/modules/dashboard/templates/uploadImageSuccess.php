<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo form_tag('dashboard/updateImage', 'method=post multipart=true id=userInfo') ?>
<input name='id' value="<?php echo $sfUser->getId(); ?>" type="hidden" />
<input name='type' value="<?php echo $type; ?>" type="hidden" />
<div id="content" class="right">
    <div class="bread_crumbs">
        <a class="jump" href="<?php echo url_for('dashboard/index'); ?>"><?php echo __('个人中心'); ?></a> &gt; 
        <span> <?php if( $type == 'headPhoto' ){ echo __('上传照片'); }else{ echo __('上传签名'); } ?></span> 
    </div>
    <div class="box">
        <div class="formDiv">
        <?php if( $type == 'headPhoto' ){ ?>
            <div class="formItem">
                    <label class="label"><?php echo __('照片'); ?>：&nbsp;&nbsp;</label>
                    <div class="iner relative">
                        <input onchange="getVal();" name='headPhoto' type="file" class="file mt5" value=""/><br/>
                        <span class="error"><?php echo __(form_span_error("headPhoto")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                <?php if( $userProfile && $userProfile->getHeadPhoto() != '' ){?>
                <label class="label"><?php echo __('照片预览'); ?>：&nbsp;&nbsp;</label>
                <img src="<?php echo sfGuardUserProfilePeer::getHeadPhotoUrl( $userProfile->getHeadPhoto() ); ?>" width="100"  />
                <?php
                }else{
                ?>
                <span class="no_photo"><?php echo __('照片预览： 暂无照片'); ?></span>
                <?php
                }
                ?>
            </div>
        <?php } ?>
        <?php if( $type == 'signatureImage' ){ ?>
            <div class="formItem">
                    <label class="label "><?php echo __('提示'); ?>：&nbsp;&nbsp;</label>
                    <div class="iner relative lh30">
                        <?php echo __('为了保证最后打印效果，我们建议上传长为150，宽为100 的图片,或者是 长比宽为3:2的图片');?>
                    </div>
            </div>
            <div class="formItem">
                    <label class="label"><?php echo __('签名'); ?>：&nbsp;&nbsp;</label>
                    <div class="iner relative lh30">
                        <input onchange="getVal();" name='signatureImage' type="file" class="file mt5" value=""/><br/>
                        <span class="error"><?php echo __(form_span_error("signatureImage")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                <?php if( $userProfile && $userProfile->getSignatureImage() != '' ){?>
                <label class="label"><?php echo __('签名预览'); ?>：&nbsp;&nbsp;</label>
                <img src="<?php echo sfGuardUserProfilePeer::getSingatureImageUrl( $userProfile->getSignatureImage() );?>" height="100"/>
                <?php
                }else{
                ?>
                <span class="no_photo"><?php echo __('签名预览： 暂无签名'); ?></span>
                <?php
                }
                ?>
            </div>
        <?php } ?>
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
            showSaveSuccessfullyMessage('上传成功', "<?php echo url_for($urlName)?>");
        }      
    });
    function getVal(){
    	$(".jump").leaveCheck({formId:'userInfo',formUrl:'<?php echo url_for("dashboard/checkUserInfo"); ?>'});
    }
</script>