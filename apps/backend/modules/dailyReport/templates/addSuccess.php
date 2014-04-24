<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a class="jump"href="<?php echo url_for('project/index')?>"><?php echo __('项目管理') ?></a> &gt; <a class="jump"href="<?php echo url_for('dailyReport/selectProject')?>"><?php echo __('撰写日报') ?></a> &gt; <span><?php echo __('撰写日报内容') ?></span>
    </div>
    <div class="box">
    <?php echo form_tag("dailyReport/insert",'id=dailyReport') ?>
    <?php echo input_hidden_tag('addPage', '1')?>
    <?php if(!$dailyReportObj){?>
            <div class="formDiv">
                <div class="mb15"><?php  echo __('你正在为 ') . htmlspecialchars( $projectName ) . __(' 项目撰写日报。请填写日报内容：'); ?></div>     
                <div class="mb15"><span class="error"><?php echo __(form_span_error("content")); ?></span></div>             
                <div class="mb15"><textarea name="content" class="textarea" style="width:720px;height:300px;"></textarea></div>           
                <?php echo input_hidden_tag('projectId', $projectId)?>
                <div class="btn_con">   
                    <div class="btns clearfix mb10 ">
                    <input type="submit" value="<?php echo __('提交日报');?>" class="btn_blue" />
                    <?php if(!$only){?>
                        <a href="<?php echo url_for('dailyReport/selectProject')?>"  class="btn_blue jump"><?php echo __('重新选择项目') ?></a>
                    <?php }?>
                    <a href="<?php echo url_for('project/index')?>"  class="btn_blue jump"><?php echo __('放弃撰写') ?></a>
                    </div>   
                </div>
            </div>  
    <?php }elseif($sf_request->getParameter("msg") == 1){ ?>
        <div class="btn_con">   
        <div class="mb15"><?php  echo __('撰写日报成功！'); ?></div>     
        <div class="btns clearfix mb10 ">
        <?php if(!$only){?>
            <a href="<?php echo url_for('dailyReport/selectProject')?>"  class="btn_blue jump"><?php echo __('重新选择项目') ?></a>
        <?php }?>
        <a href="<?php echo url_for('project/index')?>"  class="btn_blue jump"><?php echo __('返回项目管理') ?></a>
        </div>   
    </div>                                
    <?php }else{?>
    <div class="btn_con">   
        <?php if(!$only){?>
            <div class="mb15"><?php  echo __('您已经为 ') . htmlspecialchars( $projectName ) . __(' 项目撰写了今天的日报，请重新选择项目撰写日报或返回项目管理。'); ?></div>     
            <a href="<?php echo url_for('dailyReport/selectProject')?>"  class="btn_blue jump"><?php echo __('重新选择项目') ?></a>
        <?php }else{?>
            <div class="mb15"><?php  echo __('您已经为 ') . htmlspecialchars( $projectName ) . __(' 项目撰写了今天的日报。'); ?></div>     
        <?php }?>
        <div class="btns clearfix mb10 ">
        <a href="<?php echo url_for('project/index')?>"  class="btn_blue jump"><?php echo __('返回项目管理') ?></a>
        </div>   
    </div>        
    <?php }?>  
   </form>    
 </div>                          
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".jump").leaveCheck({formId:'dailyReport',formUrl:'<?php echo url_for("dailyReport/checkDailyReport"); ?>'});
});
</script>