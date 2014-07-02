<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('comm') ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a class="jump" href="<?php echo url_for('project/index')?>"><?php echo __('项目管理') ?></a> &gt;
        <a class="jump" href="<?php echo url_for('projectMilestone/index?id=' . $project->getId())?>"><?php echo __('查看进度') ?></a> &gt;
        <span>新建阶段</span>
    </div>
    <div class="box">
        <div class="mb15" id="title">
            <?php echo __('请为您新创建的公司项目 '.$project->getName().' 设定里程碑：');?>
         </div>
      <?php echo form_tag('projectMilestone/insert?' .  html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")), 'method=post multipart=true id=milestone') ?>
      <input type="hidden" name="id" value="<?php echo $project->getId()?>" />
      <div  class="mt20">
        <div class="formDiv" id="formDiv">

           <?php for($i=$count+1; $i<=$count + 3; $i++):?>
           <div class="formItem">
               <label class="label" for="time1">第<?php echo $i;?>阶段截止日期：</label>
           <div class="iner">
               <input type="text" class="txt" value="" name="time[]" id="time_<?php echo $i?>" />
               <span class="operation"><a href="#" class="operation" title="<?php echo __('清除')?>" onclick="clearDate(this);"><img src="/images/icons/delete.png" alt="clear" /></a></span>
           </div>
           </div>
           <div class="formItem">
               <label class="label" for="content1"><?php echo __('阶段说明：');?></label>
           <div class="iner">
                 <textarea rows="6" cols="60" name="content[]" id="content_<?php echo $i?>"></textarea>
           </div>
           </div>
           <?php endfor;?>

        </div>
        <div class="mt20">
            <div class="btn_con">
                <div class="mb10 clearfix">
                    <a id="add" href="javascript:void(0);" onclick="" class="btn_blue"><?php echo __('+ 添加更多阶段') ?></a>
                </div>
                <div class="btns clearfix">
                    <input type="submit" onclick="return checkForm();" value="<?php echo __('保存并返回查看进度页面');?>" class="btn_blue" />
                    <a href="<?php echo url_for('projectMilestone/index?id=' . $project->getId())?>" class="btn_blue jump"><?php echo __('放弃并返回') ?></a>
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
        str += '<label class="label" for="time">第'+ lastId +'阶段截止日期：</label>';
        str += '<div class="iner">';
        str += '<input type="text" class="txt" value="" name="time[]" id="time_' +lastId+ '"/>';
        str += '<span class="operation"><a href="#" title="清除" onclick="clearDate(this); "><img src="/images/icons/delete.png" alt="clear" /></a></span>';
        str += '</div>';
        str += '<div class="formItem">';
        str += '<label class="label" for="content">阶段说明：</label>';
        str += '<div class="iner"><textarea rows="6" cols="60" name="content[]" id="content_' + lastId + '"></textarea></div>';
        str += '</div>';
        $('#formDiv').append($(str));;
        $('.txt').setTimepicker();
        $('.txt').attr('readonly', true);
    });

    var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage();
    }
    $(".jump").leaveCheck({formId:'milestone',formUrl:'<?php echo url_for("projectMilestone/checkMilestone"); ?>'});
});
function clearDate(obj){
    $(obj).parent().siblings('input').val('')
}

function checkForm(){
    $('.dateError').remove();
    $('.dateFError').remove();
    $('.contentError').remove();
    $('.allError').remove();
    var flag = false;
    var startDate = '<?php echo date('Y-m-d', strtotime($project->getStartDate()));?>';
    var endDate = '<?php echo date('Y-m-d', strtotime($project->getEndDate()));?>';
    $('.txt').each(function(){
            var date = $(this).val();
            var contentId = $(this).attr('id').substr(5);
            var content = $('#content_' + contentId) . val();
            if($.trim(date) != '' || $.trim(content) != ''){
                flag = true;
                if($.trim(date) != ''){
                    if( ($.trim(date) > endDate) || ($.trim(date) < startDate)){
                        $('<font class="dateFError" color="red">&nbsp;日期要在项目时间内</font>').insertAfter($(this).siblings('span'));
                        $('#content_' + contentId).focus();
                    }
                }
            }

            if( $.trim(date) != '' && $.trim(content) == ''  ){
                $('<br /><font class="contentError" color="red">说明文字不能为空</font>').insertAfter($('#content_' + contentId));
                $('#content_' + contentId).focus();
            }else if( $.trim(date) == '' && $.trim(content) != '' ){
                $('<font class="dateError" color="red">&nbsp;日期不能为空</font>').insertAfter($(this).siblings('span'));
                $('#content_' + contentId).focus();
            }


    });
    var dateError = $('.dateError').length;
    var dateFError = $('.dateFError').length;
    var contentError = $('.contentError').length;
    if(!flag){
        $('#title').append('<font class="allError" color="red">&nbsp;请填写里程碑的阶段日期和说明</font>');
        $('body').scrollTop(0);
        return false;
    }else{
        $('.allError').remove();
    }
    if(dateError || contentError || dateFError){
        return false;
    }
}
</script>