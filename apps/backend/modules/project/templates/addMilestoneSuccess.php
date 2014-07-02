<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?> 
<div id="content" class="right">
    <div class="bread_crumbs">
        <a class="jump" href="<?php echo url_for('project/index')?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('创建新项目') ?></span> &gt; <span><?php echo __('第五步：设定项目里程碑') ?></span>
    </div>
    <div class="box">
        <div class="mb15">
            <?php echo __('请为您新创建的公司项目 '.$projectData['name'].' 设定里程碑(您也可以直接创建项目，等以后再为项目添加里程碑)：');?>
         </div>
      <?php echo form_tag('project/insertMilestone?' .  html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")), 'method=post multipart=true id=milestone') ?>
      <div  class="mt20">
        <div class="formDiv" id="formDiv">  

           <div class="formItem">
               <label class="label" for="time1"><?php echo __('第1阶段截止日期：');?></label>
           <div class="iner">
               <input type="text" class="txt" value="" name="time[]" id="time_1" /> 
               <span class="operation"><a href="#" title="<?php echo __('清除')?>" onclick="clearDate(this);"><img src="/images/icons/delete.png" alt="clear" /></a></span>       
           </div>
           </div>
           <div class="formItem">
               <label class="label" for="content1"><?php echo __('阶段说明：');?></label>
           <div class="iner">
                 <textarea rows="6" cols="60" name="content[]" id="content_1"></textarea>    
           </div>
           </div>
           
           
           <div class="formItem">
               <label class="label" for="time2"><?php echo __('第2阶段截止日期：');?></label>
           <div class="iner">
               <input type="text" class="txt" value="" name="time[]" id="time_2" />  
               <span class="operation"><a href="#" title="<?php echo __('清除')?>" onclick="clearDate(this);"><img src="/images/icons/delete.png" alt="clear" /></a></span>      
           </div>
           </div>
           <div class="formItem">
               <label class="label" for="content2"><?php echo __('阶段说明：');?></label>
           <div class="iner">
                 <textarea rows="6" cols="60" name="content[]" id="content_2"></textarea>    
           </div>
           </div> 
           
           
           <div class="formItem">
               <label class="label" for="time3"><?php echo __('第3阶段截止日期：');?></label>
               <div class="iner">
                   <input type="text" class="txt" value="" name="time[]" id="time_3" />
                   <span class="operation"><a href="#" title="<?php echo __('清除')?>" onclick="clearDate(this);"><img src="/images/icons/delete.png" alt="clear" /></a></span>        
               </div>
           </div>
           <div class="formItem">
               <label class="label" for="content3"><?php echo __('阶段说明：');?></label>
               <div class="iner">
                     <textarea rows="6" cols="60" name="content[]" id="content_3"></textarea>    
               </div>
           </div>  
 
        </div>
        <div class="mt20">
            <div class="btn_con"> 
                <div class="mb10 clearfix">
                    <a id="add" href="javascript:void(0);" onclick="" class="btn_blue"><?php echo __('+ 添加更多阶段') ?></a>
                </div>                
                <div class="btns clearfix">
                    <input type="submit" onclick="return checkForm();" value="<?php echo __('确认创建项目');?>" class="btn_blue" />
                    <a href="<?php echo url_for('project/addDocument')?>" class="btn_blue jump"><?php echo __('重新添加文档记录') ?></a>
                    <a href="<?php echo url_for('project/index')?>" class="btn_blue jump"><?php echo __('放弃并返回列表') ?></a>
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
    $("#add").click(function(){        
        var lastId = parseInt($('.txt:last').attr('id').substr(5));
        lastId = lastId + 1;
        var str = '';
        str += '<div class="formItem">';
        str += '<label class="label" for="time">第'+ lastId +'阶段截止日期:</label>';        
        str += '<div class="iner">';
        str += '<input type="text" class="txt" value="" name="time[]" id="time_' +lastId+ '"/>';        
        str += '<span class="operation"><a href="#" title="清除" onclick="clearDate(this); "><img src="/images/icons/delete.png" alt="clear" /></a></span>';
        str += '</div>';        
        str += '<div class="formItem">';
        str += '<label class="label" for="content">阶段说明</label>';
        str += '<div class="iner"><textarea rows="6" cols="60" name="content[]" id="content_' + lastId + '"></textarea></div>';  
        str += '</div>';
        $('#formDiv').append($(str));;
        $('.txt').setTimepicker();
        $('.txt').attr('readonly', true);
    });
    $(".jump").leaveCheck({formId:'milestone',formUrl:'<?php echo url_for("projectMilestone/checkMilestone"); ?>'});
});
function clearDate(obj){
    $(obj).parent().siblings('input').val('')
}

function checkForm(){
    var startDate = '<?php echo date('Y-m-d', strtotime($projectData['startDate']));?>';
    var endDate = '<?php echo date('Y-m-d', strtotime($projectData['endDate']));?>';
    $('.dateError').remove();
    $('.dateFError').remove();
    $('.contentError').remove();
    $('.txt').each(function(){
            var date = $(this).val();
            var contentId = $(this).attr('id').substr(5);
            var content = $('#content_' + contentId) . val();
            var arr = [];
            if($.trim(date) != ''){
                if( ($.trim(date) > endDate) || ($.trim(date) < startDate)){
                    $('<font class="dateFError" color="red">&nbsp;日期要在项目时间内</font>').insertAfter($(this).siblings('span'));
                    $('#content_' + contentId).focus();
                }
            }
            if( $.trim(date) != '' && $.trim(content) == ''  ){
                $('<br /><font class="contentError" color="red">说明文字不能为空</font>').insertAfter($('#content_' + contentId));
            }else if( $.trim(date) == '' && $.trim(content) != '' ){
                $('<font class="dateError" color="red">&nbsp;日期不能为空</font>').insertAfter($(this).siblings('span'));
           }
           
        });
    var dateError = $('.dateError').length;
    var dateFError = $('.dateFError').length;
    var contentError = $('.contentError').length;
    if(dateError || contentError || dateFError){
        return false;
    }
}
</script>
