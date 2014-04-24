<?php include_partial('global/confirm'); ?>
<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<?php echo form_tag('project/updateCompleteTender?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ), 'method=post multipart=true id=complete') ?>
<input type="hidden" name="id" value="<?php echo $project->getId();?>" />
<div id="content" class="right">
   <div class="bread_crumbs jump"> <a href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")))?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('标中项目') ?></span> </div>
    <div class="box">
        <div><?php echo __('你正在完成投标,并正式展开项目(请注意！一旦确认完成以后，项目将无法再回到投标状态！)');?></div>
        <div class="formDiv">
            <div class="formItem">
                <label class="label">
                    <?php echo __('项目名称'); ?>：
                </label>
                <div class="iner lh30">
                    <?php echo $project->getName();?>
                </div>
            </div>
            <div class="formItem">
                <label class="label">
                    <?php echo __('业主'); ?>：
                </label>
                <div class="iner lh30">
                    <?php echo $project->getProprietor(); ?>
                </div>
            </div>
            <div class="formItem">
                <label class="label">
                    <?php echo __('开始日期'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <input type="text" id="startDate" name='startDate' class="txt" value="<?php echo $project->getStartDate() ? date('Y-m-d', strtotime($project->getStartDate())) : null;?>"/>
                       <span class="operation"><a class='operation' href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="$('#startDate').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                    <span class="error"><?php echo __(form_span_error("startDate")); ?></span>
                </div>
            </div>           
            <div class="formItem">
                <label class="label">
                    <?php echo __('结束日期'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <input type="text"  id="endDate" name='endDate' class="txt" value="<?php echo $project->getEndDate() ? date('Y-m-d', strtotime($project->getEndDate())) : null;?>"/>
                        <span class="operation"><a class='operation' href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="$('#endDate').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                    <span class="error"><?php echo __(form_span_error("endDate")); ?></span>
                </div>
            </div>
            <div class="formItem">
                <label class="label">
                    <?php echo __('标段号'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('blockNumber',$project->getBlockNumber(), array('class'=>'txt'))?>
                    <span class="error"><?php echo __(form_span_error("blockNumber")); ?></span>
                </div>
            </div>  
            <div class="formItem">
                <label class="label">
                    <?php echo __('备注'); ?>：
                </label>
                <div class="iner">
                    <?php echo formTextareaTag('comment', str_replace('<br />','',htmlspecialchars_decode($project->getComment())), array("class"=>"textarea"));?>
                </div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="<?php echo __('确认已经标中项目');?>" class="btn_blue" />
                <a href="<?php echo url_for('project/index?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) )); ?>" class="btn_blue jump"><?php echo __('返回');?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    $('#startDate,#endDate').attr('readonly', true);
    $('#startDate,#endDate').setTimepicker();
    var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){  
            showSaveSuccessfullyMessage( '标中项目成功', "<?php echo url_for($urlName . '?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ) ); ?>" );          
        }
        if(msg == '2'){  
            showSaveSuccessfullyMessage( '项目已经被标中了', "<?php echo url_for($urlName . '?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ) ); ?>" );          
        }
        if(msg == '3'){  
            showSaveSuccessfullyMessage( '项目已经被终止了', "<?php echo url_for($urlName . '?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ) ); ?>" );          
        }
        $(".jump").leaveCheck({formId:'complete',formUrl:'<?php echo url_for("project/checkComplete"); ?>'});
});
</script>
