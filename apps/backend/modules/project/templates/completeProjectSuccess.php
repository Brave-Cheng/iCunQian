<?php include_partial('global/confirm'); ?>
<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<?php echo form_tag('project/updateCompleteProject?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ), 'method=post multipart=true id=complete') ?>
<?php if(!$project->getIsProjectEnd()){?>
    <input type="hidden" name="id" value="<?php echo $project->getId();?>" />
<?php }?>    
<div id="content" class="right">
   <div class="bread_crumbs"> <a class="jump" href="<?php echo url_for('project/index') ?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('结束项目') ?></span> </div>
    <div class="box">
        <div>你正在<?php echo $project->getIsProjectEnd() > 0 ? ('查看该项目的状态') : ('你正在标记该项目的结束（请注意，一旦确认完成以后，项目的所有属性将无法再次进行修改！）'); ?>：</div>
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
                    <?php echo __('完成方式'); ?>：<?php if(!$project->getIsProjectEnd()): ?><em class="red">*</em><?php endif;?>
                </label>
                <?php if(!$project->getIsProjectEnd()):?>
                <div class="iner clearfix">
                    <?php echo input_hidden_tag('complete', '1')?>
                    <label class="inblock mr10"><input name='completeType' type="radio" class="radio" value="1" <?php if($project->getIsProjectEnd() == 1) echo "checked";?> /> <?php echo __('突然中止');?></label>
                    <label class="inblock mr10"><input name='completeType' type="radio" class="radio" value="2" <?php if($project->getIsProjectEnd() == 2) echo "checked";?> /><?php echo __("项目完成");?></label>
                    <span class="error"><?php echo __(form_span_error("completeType")); ?></span>
                </div>
                <?php else:?>
                <div class="iner lh30">
                    <?php 
                        $ways = ProjectPeer::completeWay();
                        echo $ways[$project->getIsProjectEnd()];
                    ?>
                </div>
                <?php endif;?>
            </div>
            <div class="formItem">
                <?php if(!$project->getIsProjectEnd()):?>
                <label class="label">
                    <?php echo __('备注'); ?>：<em class="red">*</em>
                </label>
                <div class="iner">
                    <?php 
                    $projectEndComment = $project->getProjectEndComment()
                    ?>
                    <?php echo formTextareaTag('comment', str_replace('<br />','',htmlspecialchars_decode($projectEndComment)), array("class"=>"textarea"));?>
                    <span class="error"><?php echo __(form_span_error("comment")); ?></span>
                </div>
                <?php else:?>
                 <label class="label">
                    <?php echo __('备注'); ?>：
                </label>
                <div class="iner lh30">
                    <?php 
                    $projectEndComment = $project->getProjectEndComment()
                    ?>
                    <?php echo str_replace('<br />','',htmlspecialchars_decode($projectEndComment));?>
                </div>
                <?php endif;?>
            </div>
        </div>
        <div class="btn_con mt10">
            
            <div class="btns clearfix">
                <?php if(!$project->getIsProjectEnd()):?>
                <input type="submit" value="<?php echo __('确认项目结束');?>" class="btn_blue" />
                <?php endif;?>
                <a href="<?php echo url_for('project/index?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ) ); ?>" class="btn_blue jump"><?php echo __('返回');?></a>
            </div>
            
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage('标中项目完成成功', "<?php echo url_for($urlName . '?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ) ); ?>" );
        }
        if(msg == '3'){  
            showSaveSuccessfullyMessage( '项目已经被终止了', "<?php echo url_for($urlName . '?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ) ); ?>" );          
        }
    var flag = '<?php echo $sf_request->getParameter("flag");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage('该项目已经中标', "<?php echo url_for($urlName . '?' . html_entity_decode(html_entity_decode(formGetQuery("keywords", "type") ) ) ); ?>" );
    }
    $(".jump").leaveCheck({formId:'complete',formUrl:'<?php echo url_for("project/checkComplete"); ?>'});
});
</script>