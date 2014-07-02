<?php include_partial('global/confirm');?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('project/index?type='. $sf_request->getParameter('type')); ?>">项目管理</a> &gt; <span><?php echo __('查看进度') ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
    <?php echo form_tag("projectMilestone/index?" . html_entity_decode(formGetQuery("sort", "sortBy", "keywords", "type")), "id=milestoneList") ?>
    <input type="hidden" name="id" value="<?php echo $project->getId();?>" />
        <div class="btns mb10 clearfix">
            <div class="clearfix mb10">
                <p class="left">以下为<?php echo $project->getName();?>的进度状况:</p>
        </div>
             <?php if($accessUpdate){ ?>
            <a href="<?php echo url_for('projectMilestone/setMilestonesComplete'); ?> " onclick="return formSubmit('milestoneList', this.href);" class="btn_blue"><?php echo __('确认选择阶段完成') ?></a>
             <?php }?>
            <?php if($accessDelete){ ?>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'milestoneList', this.href)" href='<?php echo url_for("projectMilestone/delete?id=" . $project->getId()) ?>'><?php echo __('批量删除') ?></a>
            <?php }?>
            <?php if($project->getIsProjectEnd() == 0): ?>
            <?php if($accessCreate){ ?>
            <a href="<?php echo url_for('projectMilestone/add?id=' .$project->getId()); ?> " onclick="return formSubmit('milestoneList', this.href);" class="btn_blue"><?php echo __('新建阶段') ?></a>
            <?php }?>
           <?php endif;?>
           <a href="<?php echo url_for('project/index?' . html_entity_decode(util::formGetQuery("keywords", "type"))); ?>" class="btn_blue"><?php echo __('返回');?></a>
           <?php
                if( $sf_request->hasParameter("msg") ){
                    if( $sf_request->getParameter("msg") == 1 ){
                        echo "<span class='error lh30'>删除成功</span>";
                    }else if( $sf_request->getParameter("msg") == 0 ){
                        echo "<span class='error lh30'>请选择要删除的阶段</span>";
                    }else if( $sf_request->getParameter("msg") == 2 ){
                        $msg22Messages = $sf_flash->get('msgs2');
                        echo "<span class='error lh30'>" . $msg22Messages ."发送通知给项目经理成功！</span>";
                    }else if( $sf_request->getParameter("msg") == 3 ){
                        echo "<span class='error lh30'>阶段已标识完成</span>";
                    }else if( $sf_request->getParameter("msg") == 4 ){
                        echo "<span class='error lh30'>请选择要设定的阶段</span>";
                    }else if( $sf_request->getParameter("msg") == 5 ){
                        echo "<span class='error lh30'>抱歉,您不是该项目的成员，不能执行此操作！</span>";
                    }
                }
                if( $sf_request->hasParameter("msg2")  ){
                    if( $sf_request->getParameter("msg2") == 2 ){
                        $msg2Messages = $sf_flash->get('msgs2');
                        echo "<span class='error lh30'>" . $msg2Messages ."发送通知给项目经理成功！</span>";
                    }
                }
          ?>
    </div>
    <div class="tables tabs">
        <div class="tab-item on">
            <table>
                <thead>
                    <tr>
                        <td class="w20"><input type="checkbox" class="cbox" onclick="formSelectCheck('.cbox:enabled')"/></td>
                        <td class="w80"><?php echo __('阶段') ?></td>
                        <td class="w80"><?php echo __('截止时间') ?></td>
                        <td class="w100"><?php echo __('描述') ?></td>
                        <td class="w100"><?php echo __('状态') ?></td>
                        <td class="w100">&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($pager['results'])):?>
                    <?php foreach($pager['results'] as $key=>$milestone):?>
                    <?php
                        $deadLine = date('Y-m-d', strtotime($milestone->getDeadline()));
                        $currentDate  = date('Y-m-d', time());
                    ?>
                    <tr class=<?php echo $key%2==0 ? "" : "odd";?>>
                        <td><input type="checkbox" name='deleteId[]' class="cbox" <?php if($milestone->getIsCompleted() || $project->getIsProjectEnd()){?> disabled="disabled" <?php }?> value="<?php echo $milestone->getId();?>"/></td>
                        <td><?php echo '第'.($key+1).'阶段';?></td>
                        <td><?php echo $milestone->getDeadline();?></td>
                        <td><?php echo htmlspecialchars(strlen($milestone->getDescription())>30 ? mb_substr($milestone->getDescription(), '0','8','utf8')."..." : mb_substr($milestone->getDescription(), '0','8','utf8'));?></td>
                        <td class="status">
                        <?php
                        if($milestone->getIsCompleted()){
                            echo '已完成';
                        }else{
                            $msg = '';
                            if($milestone->getIsApply()){
                                $msg = '（已申请）';
                            }
                            if($deadLine < $currentDate){
                                echo '已过期  ' , '<img class="middle" src="/images/icons/exclamation.png" />',$msg;
                            }elseif(round((strtotime($deadLine) - strtotime($currentDate))/3600/24) <= 7){
                                echo '即将过期', $msg;
                            }else{
                                echo '进行中', $msg;
                            }
                        }
                        ?>
                        </td>
                        <td class="operate">
                        <?php if($project->getIsProjectEnd() == 0 ):?>
                        <?php if(!$milestone->getIsCompleted()): ?>
                        <?php if($accessRead):?>
                        <a href="javascript:void(0);" onclick="return setComplete(this, '<?php echo $milestone->getId();?>');" class="setComplete">完成</a>
                        <?php if($accessUpdate && !$milestone->getIsApply()): ?>
                        <a href="<?php echo url_for('projectMilestone/edit?mid=' . $milestone->getId() . '&' . 'id=' . $project->getId(). '&index=' . ($key+1)) ;?>">编辑</a>
                        <?php endif;?>
                        <?php if($accessDelete && !$milestone->getIsApply()):?>
                        <a onclick="return showDeleteConfirmMessage(null, '', this.href)" href="<?php echo url_for('projectMilestone/delete?deleteId=' . $milestone->getId() . '&id=' . $project->getId()) ;?>">删除</a>
                        <?php endif;?>
                        <?php endif;?>
                        <?php endif;?>
                        <?php endif;?>
                        </td>
                     </tr>
                     <?php endforeach;?>
                     <?php else:?>
                        <tr>
                          <td colspan="6" class=""><?php echo __('进度列表为空');?></td>
                       </tr>
                     <?php endif;?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="btn_con">
        <div class="btns clearfix mb10">
            <?php if($accessUpdate){ ?>
            <a href="<?php echo url_for('projectMilestone/setMilestonesComplete'); ?> " onclick="return formSubmit('milestoneList', this.href);" class="btn_blue"><?php echo __('确认选择阶段完成') ?></a>
            <?php }?>
            <?php if($accessDelete){ ?>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'milestoneList', this.href)" href='<?php echo url_for("projectMilestone/delete?id=" . $project->getId()) ?>'><?php echo __('批量删除') ?></a>
            <?php }?>
            <?php if($project->getIsProjectEnd() == 0): ?>
            <?php if($accessCreate){ ?>
            <a href="<?php echo url_for('projectMilestone/add?id=' .$project->getId() ); ?> " onclick="return formSubmit('milestoneList', this.href);" class="btn_blue"><?php echo __('新建阶段') ?></a>
            <?php }?>
            <?php endif;?>
            <a href="<?php echo url_for('project/index?' . html_entity_decode(util::formGetQuery("keywords", "type"))); ?>" class="btn_blue"><?php echo __('返回');?></a>
        </div>
    </div>
    </div>
    </form>
    </div>
</div>
<script type="text/javascript" >
$(function(){
    var msgs = '<?php echo $sf_request->getParameter('msg')?>';
    var msgsMessages = '<?php echo $sf_flash->get("msgs3");?>';
    if(msgs == '6'){
        showSaveSuccessfullyMessage('您今天' + msgsMessages +  '已经发送过通知了，不能再发送了！');
    }

});
function setComplete(obj, mid){
    $.get("<?php echo  url_for("projectMilestone/setComplete") ?>", {mid:mid,pid:'<?php echo $project->getId() ?>'}, function(res){
        switch(res.status){
            case 2:
                $(obj).parent().siblings('.status').html(res.msg);
                $(obj).parent().siblings().find('.cbox').attr('disabled', 'disabled');
                $(obj).parent().html(' ');
                break;
            default:
                showSaveSuccessfullyMessage(res.msg, '<?php echo url_for("projectMilestone/index?id=" . $project->getId());?>');
                break;
        }
    },'json');
    return false;
}

</script>

