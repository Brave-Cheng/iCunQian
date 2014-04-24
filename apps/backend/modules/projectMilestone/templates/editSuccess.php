<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('comm') ?> 
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a class="jump" href="<?php echo url_for('project/index')?>"><?php echo __('项目管理') ?></a> &gt; <a class="jump" href="<?php echo url_for('projectMilestone/index?id=' . $project->getId())?>"><?php echo __('跟踪项目进度') ?></a>
        &gt; <span><?php echo __('编辑进度') ?></span>
    </div>
    <div class="box">
        <div class="mb15">
            <?php echo __('请为您公司项目 '.$project->getName().' 设定里程碑：');?>
         </div>
      <?php echo form_tag('projectMilestone/update?' .  html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")), 'method=post multipart=true id=milestone') ?>
      <input type="hidden" name="id" value="<?php echo $project->getId()?>" />
      <input type="hidden" name="mid" value="<?php echo $mileStone->getId()?>" />
      <input type="hidden" name="index" value="<?php echo $sf_request->getParameter('index');?>" />
      <div  class="mt20">
        <div class="formDiv" id="formDiv">  
   
           <div class="formItem">
               <label class="label" for="time1">第<?php echo $index;?>阶段截止日期:<em class="red">*</em></label>
           <div class="iner">
               <input type="text" class="txt" value="<?php echo $mileStone->getDeadline();?>" name="time_1" id="time_1" /> 
               <span class="operation"><a href="#" class='operation' title="<?php echo __('清除')?>" onclick="clearDate(this);"><img src="/images/icons/delete.png" alt="clear" /></a></span>  
               <span class="error"><?php echo __(form_span_error("time_1")); ?></span>
           </div>
           </div>
           <div class="formItem">
               <label class="label" for="content1"><?php echo __('阶段说明');?>:<em class="red">*</em></label>
           <div class="iner" style="margin-left:107px;">
               <?php echo formTextareaTag('content_1', $mileStone->getDescription(), array("cols"=>60, "rows"=>6));?>
               <br /><span class="error"><?php echo __(form_span_error("content_1")); ?></span>
           </div>
           </div>

           
        </div>
        <div class="mt20">
            <div class="btn_con">               
                <div class="btns clearfix">
                    <input type="submit" onclick="" value="<?php echo __('保存');?>" class="btn_blue" />
                    <a href="<?php echo url_for('projectMilestone/index?id=' . $project->getId())?>" class="btn_blue jump"><?php echo __('返回') ?></a>
                    <div class="clear"></div> 
                </div>                 
            </div>
        </form>
        </div>
        
     </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('.txt').attr('readonly', true);
    $('.txt').setTimepicker(); 

    var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage( null, "<?php echo url_for('projectMilestone/index?id='.$project->getId()); ?>" );
    }
    $(".jump").leaveCheck({formId:'milestone',formUrl:'<?php echo url_for("projectMilestone/checkMilestone"); ?>'});
});
function checkForm(){
    $('.dateError').remove();
    $('.contentError').remove();
    var date = $('#time_1').val();
    var content = $('#content_1').val();
    if($.trim(date) == ''){
        $('<font class="dateError" color="red">&nbsp;日期不能为空</font>').insertAfter($('#time_1').siblings('span'));
    }
    if($.trim(content) == ''){
        $('<font class="contentError" color="red">说明文字不能为空</font>').insertAfter($('#content_1'));

    }
    var dateError = $('.dateError').length;
    var contentError = $('.contentError').length;
    if(dateError || contentError){
        return false;
    }
}
function clearDate(obj){
    $(obj).parent().siblings('input').val('')
}


</script>