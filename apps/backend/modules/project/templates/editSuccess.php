<?php include_partial('global/confirm'); ?>
<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<?php echo form_tag('project/update?' .  html_entity_decode(formGetQuery("keywords", "type") ), 'method=post multipart=true id=project') ?>
<div id="content" class="right">
   <div class="bread_crumbs"> <a href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("sortBy", "sort", "keywords", "type")))?>"><?php echo __('项目管理') ?></a> &gt; <?php if(!$project->getId()){?><a href="<?php echo url_for('project/createProjectType');?>"><?php echo  __('创建新项目') ?></a><?php }else{?><span>编辑项目</span> <?php }?> &gt; <span><?php echo __('填写项目属性') ?></span> </div>
   <?php if(!$project->getIsProjectEnd()){?>
       <input type="hidden" name="id" value="<?php echo $project->getId();?>" />
   <?php }?>
   <?php 
   if($isEnd = $project->getIsProjectEnd()){
        $option = array('class'=>'txt', 'disabled' => 'true');
   }else{
        $option = array('class'=>'txt');
   }
   
   ?>
    <div class="box">
        <div>你正在<?php echo $project->getId() ? $project->getIsProjectEnd() > 0 ? ('查看一个' . $types[$project->getType()]) : ('修改一个' . $types[$project->getType()] . '，请填写以下项目属性')  : ('创建一个' . $types[$project->getType()] . '，请填写以下项目属性'); ?>：</div>
        <div class="formDiv">      
            <div class="formItem">
                <label class="label">
                    <?php echo __('项目简称'); ?>：
                </label>
                <div class="iner lh30">
                    <?php echo $project->getName(); ?>
                </div>
            </div> 
            <div class="formItem">
                <label class="label">
                    <?php echo __('项目全称'); ?>：
                </label>
                <div class="iner lh30">
                    <?php echo $project->getLongName(); ?>
                </div>
            </div>           
            <div class="formItem">
                <label class="label">
                    <?php echo __('业主'); ?>：
                </label>
                <div class="iner lh30">
                    <?php echo $project->getProprietor();?>
                </div>
            </div>          
            <div class="formItem">
            <?php if(!$project->getIsProjectEnd()):?>
                <label class="label">
                    <?php echo __('开始日期'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('startDate',$project->getStartDate() ? date('Y-m-d', strtotime($project->getStartDate())) : null, $option)?>   
                       <?php if(!$isEnd):?>
                       <span class="operation"><a href="javascript:void(0);" class="operation" title="<?php echo __('清除')?>" onclick="$('#startDate').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                       <?php endif;?>
                    <span class="error"><?php echo __(form_span_error("startDate")); ?></span>
                </div>
                <?php else:?>
                <label class="label">
                    <?php echo __('开始日期'); ?>：
                </label> 
                <div class="iner lh30">
                    <?php echo date('Y-m-d', strtotime($project->getStartDate())) ;?>
                </div>
                <?php endif;?>
            </div>           
            <div class="formItem">
                <?php if(!$project->getIsProjectEnd()):?>
                <label class="label">
                    <?php echo __('结束日期'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('endDate',$project->getEndDate() ? date('Y-m-d', strtotime($project->getEndDate())) : null, $option)?>
                        <?php if(!$isEnd):?>
                        <span class="operation"><a href="javascript:void(0);" class="operation" title="<?php echo __('清除')?>" onclick="$('#endDate').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                        <?php endif;?>
                    <span class="error"><?php echo __(form_span_error("endDate")); ?></span>
                </div>
                <?php else:?>
                <label class="label">
                    <?php echo __('结束日期'); ?>：
                </label>
                 <div class="iner lh30">
                    <?php echo date('Y-m-d', strtotime($project->getEndDate())) ;?>
                </div>
                <?php endif;?>
            </div> 
             <?php if(($project->getType() == ProjectPeer::OUTSOURCE_PROJECT) || ($project->getPhase() == projectPeer::PROJECT_PHASE)):?>                                                              
            <div class="formItem">
                <?php if(!$project->getIsProjectEnd()):?>
                <label class="label">
                    <?php echo __('标段号'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('blockNumber',$project->getBlockNumber(), $option)?>
                    <span class="error"><?php echo __(form_span_error("blockNumber")); ?></span>
                </div>
                <?php else:?>
                <label class="label">
                    <?php echo __('标段号'); ?>：
                </label>
                <div class="iner lh30">
                    <?php echo $project->getBlockNumber();?>
                </div>
                <?php endif;?>
            </div>  
           <?php elseif($project->getPhase() == ProjectPeer::TENDERING_PHASE):?>
           <div class="formItem">
            <?php echo formInputHiddenTag("ef", $project->getIsBuyTheTenderDocument() ? 1 : 0 ) ?>
                <?php if(!$project->getIsProjectEnd()):?>
                <label class="label">
                    <?php echo __('购买标书'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <label class="inblock mr10"><input name='isBuy' <?php echo $project->getIsBuyTheTenderDocument() ? 'checked' : '';?> type="radio" class="radio"  value="1" /> <?php echo __('购买');?></label>
                    <label class="inblock mr10"><input name='isBuy' <?php echo $project->getIsBuyTheTenderDocument() ? '' : 'checked';?> type="radio" class="radio"  value=""  /><?php echo __("不购买");?></label>
                </div>
                <?php else:?>
                <label class="label">
                    <?php echo __('购买标书'); ?>：
                </label>
                <div class="iner lh30">
                    <?php 
                        $yesOrNoRadio = util::getYesOrRadio();
                        echo $yesOrNoRadio[$project->getIsBuyTheTenderDocument()];
                    ?>
                </div>
                <?php endif;?>
            </div>          
            <div class="formItem" id="prieceItem" style="display:<?php echo (formGetParameter("ef") || $project->getIsBuyTheTenderDocument())  ? "block" : "none" ?>;">
                <?php if(!$project->getIsProjectEnd()):?>
                <label class="label">
                    <?php echo __('价格'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo formInputTag('price',$project->getTenderDocumentPrice(), array('class'=>'txt'))?>
                    <?php echo __(' 元'); ?>
                    <span class="error"><?php echo __(form_span_error("price")); ?></span>
                </div>
                <?php else:?>
                <label class="label">
                    <?php echo __('价格'); ?>：
                </label>
                <div class="iner lh30">
                    <?php 
                        echo $project->getTenderDocumentPrice();
                    ?>
                    <?php echo __(' 元'); ?>
                </div>
                <?php endif;?>
            </div>           
            <div class="formItem">
                <?php if(!$project->getIsProjectEnd()):?>
                <label class="label">
                    <?php echo __('投标状态'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php echo select_tag('tenderingStatus', options_for_select(ProjectPeer::getTenderingStatus(), $project ? $project->getTenderingStatus() : '',array('include_custom' => '选择投标状态')),array("class"=>"select")) ?>  
                    <span class="error"><?php echo __(form_span_error("tenderingStatus")); ?></span>
                </div>
                <?php else:?>
                <label class="label">
                    <?php echo __('投标状态'); ?>：
                </label>
                <div class="iner lh30">
                    <?php 
                        $status = ProjectPeer::getTenderingStatus();
                        echo $status[$project->getTenderingStatus()];
                    ?>
                </div>
                <?php endif;?>
            </div>  
            <?php endif;?>
                    
            <div class="formItem">
                <?php if(!$project->getIsProjectEnd()):?>
                <label class="label">
                    <?php echo __('备注'); ?>：
                </label>
                <div class="iner">
                    <?php echo formTextareaTag('comment', str_replace('<br />','',htmlspecialchars_decode($project->getComment())), array("class"=>"textarea"));?>
                    <span class="error"><?php echo __(form_span_error("comment")); ?></span>
                </div>
                <?php else:?>
                <label class="label">
                    <?php echo __('备注'); ?>：
                </label>
                <div class="iner lh30">
                    <?php echo str_replace('<br />','',htmlspecialchars_decode($project->getComment()));?>
                </div>
                <?php endif;?>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
            <?php if(!$project->getIsProjectEnd()):?> 
                <input type="submit" value="<?php echo __('保存');?>" class="btn_blue" />  
            <?php endif;?>
                <a href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("keywords", "type") )); ?>" class="btn_blue jump"><?php echo __('返回');?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    $('#startDate,#endDate').attr('readonly', true);
    $('#startDate,#endDate').setTimepicker();
    $("input[type='radio']").click(function(){
        if($(this).val() == 1){
            $('#prieceItem').show();
            $('#ef').val(1)
        }else{
            $('#prieceItem').hide();
            $('#ef').val(0);
        }
    });
    var msg = '<?php echo $sf_flash->get("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage( null, "<?php echo url_for($urlName . '?' . html_entity_decode(formGetQuery("keywords", "type") ) ); ?>" );
    }
    $(".jump").leaveCheck({formId:'project',formUrl:'<?php echo url_for("project/checkProject"); ?>'});
});
</script>