<?php include_partial('global/confirm'); ?>
<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('comm') ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo form_tag('project/insert?' .  html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")), 'method=post multipart=true id=project') ?>
<div id="content" class="right">
   <div class="bread_crumbs"> <a class="jump" href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")))?>"><?php echo __('项目管理') ?></a> &gt; <a class="jump" href="<?php echo url_for('project/createProjectType');?>"><?php echo __('创建新项目') ?></a> &gt; <span><?php echo __('第二步:填写项目属性') ?></span> </div>
   <input type="hidden" name="flag" value="<?php echo $rmsg ==1 ? 1 : 0 ;?>" />
   <input type="hidden" name="flag2" value="<?php echo $rmsg ==2 ? 2 : 0 ;?>" />
    <div class="box">
        <?php if($tenderKey== ProjectPeer::TENDERING_PHASE):?>
        <div>你的公司项目需要投标，请填写以下投标属性：</div>
        <?php else:?>
        <div>你正在创建一个新的<?php echo $types[$typeKey];?>，请填写以下项目属性：</div>
        <?php endif;?>
        <div class="formDiv">      
            <div class="formItem">
                <label class="label">
                    <?php echo __('项目简称'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('projectName',$projectData['name'], array('class'=>'txt'))?>
                    <span class="error"><?php echo __(form_span_error("projectName")); ?></span>
                    <div class="mt5"><?php echo __('(一旦项目创建成功此项将不可修改)');?></div>
                </div>
            </div>  
            <div class="formItem">
                <label class="label">
                    <?php echo __('项目全称'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('projectLongName',$projectData['longName'], array('class'=>'txt'))?>
                    <span class="error"><?php echo __(form_span_error("projectLongName")); ?></span>
                    <div class="mt5"><?php echo __('(一旦项目创建成功此项将不可修改)');?></div>
                </div>
            </div>          
            <div class="formItem">
                <label class="label">
                    <?php echo __('业主'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('proprietor',$projectData['proprietor'], array('class'=>'txt'))?>
                    <span class="error"><?php echo __(form_span_error("proprietor")); ?></span>
                    <div class="mt5"><?php echo __('(一旦项目创建成功此项将不可修改)');?></div>
                </div>
            </div>          
            <div class="formItem">
                <label class="label">
                    <?php echo __('开始日期'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <input type="text" id="startDate" name='startDate' class="txt" value="<?php echo $projectData['startDate'] ? date('Y-m-d', strtotime($projectData['startDate'])) : null;?>"/>
                       <span class="operation"><a href="javascript:void(0);" class="operation" title="<?php echo __('清除')?>" onclick="$('#startDate').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                    <span class="error"><?php echo __(form_span_error("startDate")); ?></span>
                </div>
            </div>           
            <div class="formItem">
                <label class="label">
                    <?php echo __('结束日期'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <input type="text"  id="endDate" name='endDate' class="txt" value="<?php echo $projectData['endDate'] ? date('Y-m-d', strtotime($projectData['endDate'])) : null;?>"/>
                        <span class="operation"><a href="javascript:void(0);" class="operation" title="<?php echo __('清除')?>" onclick="$('#endDate').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                    <span class="error"><?php echo __(form_span_error("endDate")); ?></span>
                </div>
            </div> 
            <?php if(($typeKey == ProjectPeer::OUTSOURCE_PROJECT) || ($tenderKey == projectPeer::PROJECT_PHASE)):?>                               
            <div class="formItem">
                <label class="label">
                    <?php echo __('标段号'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('blockNumber',$projectData['blockNumber'], array('class'=>'txt'))?>
                    <span class="error"><?php echo __(form_span_error("blockNumber")); ?></span>
                </div>
            </div> 
            <?php elseif($tenderKey == ProjectPeer::TENDERING_PHASE):?>
            <div class="formItem">
                <?php echo formInputHiddenTag("ef", 0) ?>
                <label class="label">
                    <?php echo __('购买标书'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <label class="inblock mr10"><input name='isBuy' <?php echo $projectData['isBuy'] ? 'checked' : '';?> type="radio" class="radio" value="1" /> <?php echo __('购买');?></label>
                    <label class="inblock mr10"><input name='isBuy' <?php echo $projectData['isBuy'] ? '' : 'checked';?> type="radio" class="radio" value=""  /><?php echo __("不购买");?></label>
                </div>
            </div>          
            <div class="formItem" id="prieceItem" style="display:<?php echo formGetParameter("ef") ? "block" : "none" ?>;">
                <label class="label">
                    <?php echo __('价格'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('price',$projectData['price'], array('class'=>'txt'))?>
                    <?php echo __(' 元'); ?>
                    <span class="error"><?php echo __(form_span_error("price")); ?></span>
                </div>
            </div>           
            <div class="formItem">
                <label class="label">
                    <?php echo __('投标状态'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo select_tag('tenderingStatus', options_for_select(ProjectPeer::getTenderingStatus(), $projectData['tenderingStatus'],array('include_custom' => '选择投标状态')),array('class'=>'select')) ?>  
                    <span class="error"><?php echo __(form_span_error("tenderingStatus")); ?></span>
                </div>
            </div>  
            <?php endif;?>                     
            <div class="formItem">
                <label class="label">
                    <?php echo __('备注'); ?>：
                </label>
                <div class="iner">
                    <?php echo formTextareaTag('comment', str_replace('<br />','',htmlspecialchars_decode($projectData['comment'])), array("class"=>"textarea"));?>
                    <span class="error"><?php echo __(form_span_error("comment")); ?></span>
                </div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="<?php echo __('确认项目属性并添加项目成员');?>" class="btn_blue" />
                <a href="<?php echo url_for('project/createProjectType');?>" class="btn_blue jump"><?php echo __('重新选择项目类型') ?></a>
                <a href="<?php echo url_for('project/index'); ?>" class="btn_blue jump"><?php echo __('放弃并返回');?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    $('#startDate,#endDate').attr('readonly', true);
    $('#startDate,#endDate').setTimepicker();
    var isBuy = '<?php echo $sf_request->getParameter('isBuy') ? $sf_request->getParameter('isBuy') : $projectData['isBuy'];?>';
    if(isBuy == 1){
        $('#prieceItem').show();
        $('#ef').val(1);
    }else{
        $('#prieceItem').hide();
        $('#ef').val(0);
    }
    $("input[type='radio']").click(function(){
        if($(this).val() == 1){
            $('#prieceItem').show();
            $('#ef').val(1)
        }else{
            $('#prieceItem').hide();
            $('#ef').val(0);
        }
    });
    $(".jump").leaveCheck({formId:'project',formUrl:'<?php echo url_for("project/checkProject"); ?>'});
});
</script>