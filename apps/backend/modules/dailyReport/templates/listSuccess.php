<?php include_partial('global/datetimepicker_path'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('project/index')?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('日报列表') ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
        <div class="btns mb10 clearfix">
        <?php if($accessCreate){ ?>
            <a href="<?php echo url_for('dailyReport/selectProject')?>" class="btn_blue"><?php echo __('撰写项目日报') ?></a>
        <?php } ?>
        </div>
    <?php echo form_tag("project/dailyReportList?" . html_entity_decode(formGetQuery("projectId", "startTime", "endTime")), "id=searchDate") ?>
        <div >
            <p><?php echo __('以下为 ' . htmlspecialchars( $projectName ) . ' 项目'.$startTime.'到'.$endTime.'的日报情况，请点击每一条查看具体内容：');?></p>
            <div class="clearfix mt10">
                 <div class="left">
                    <?php echo __('选择时间段：从 ');?><input type="text"  id="startTime" name='startTime' class="txt" value="<?php echo $startTime?>" onsubmit="return formSubmit('searchDate', '<?php echo url_for("dailyReport/list?" . html_entity_decode(formGetQuery("projectId", "startTime", "endTime"))) ?>')"/>
                    <span class="operation"><a href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="$('#startTime').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                    <?php echo __('到 ');?>
                    <input type="text"  id="endTime" name='endTime' class="txt" value="<?php echo $endTime?>"/>
                    <span class="operation"><a href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="$('#endTime').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                </div>
                <input type="submit" class="search_btn left ml5" value="" onclick="return formSubmit('searchDate', '<?php echo url_for("dailyReport/list?projectId=".$projectId. html_entity_decode(formGetQuery("projectId", "startTime", "endTime"))) ?>');"/>
                <span class="right lh30"><?php echo __("当前显示：")?><?php echo utilPagerDisplayRows($pager)?><?php echo __("条 共：") ?><?php echo utilPagerDisplayTotal($pager)?><?php echo __("条");?></span>
            </div>
            <div class="error mt10"><?php if(!empty($title)){echo __('开始时间不能晚于结束时间');}?></div>
            <?php echo input_hidden_tag('projectId', $projectId);?>

        </div>
     </form>
    </div>
    <div class="tables">

        <div class="tab-item on">
            <table>
                <thead>
                    <tr>
                    <?php if(sfGuardUserProfile::isVicePresident($projectId)){?>
                        <td width="20%"><?php  echo __('汇报人') ?></td>
                    <?php }?>
                        <td width="20%"><?php echo __('汇报日期');?></td>
                        <td width="60%"><?php echo __('日报内容概述') ?></td>
                    </tr>
                </thead>
                <tbody>
                 <?php if(!empty($pager['results'])){?>
                    <div class="pagination mb10" style="float:none;">
                    <div class="pagerlist">
                        <?php if(utilPagerDisplayTotal($pager) >20){ echo utilPagerPages($pager, "project/dailyReportList?projectId=".$projectId , html_entity_decode(formGetQueryDenyPager("projectId", "startTime", "endTime")));}?>

                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php foreach($pager['results'] as $key=>$dailyReport):?>
                        <tr <?php if( $key%2 ){ echo "class='odd'"; } ?>>
                        <?php if(sfGuardUserProfile::isVicePresident($projectId)){?>
                            <td><?php echo $dailyReport->getSfGuardUser()->getProfile()->getLastName().$dailyReport->getSfGuardUser()->getProfile()->getFirstName();?></td>
                        <?php }?>
                            <td><?php echo $dailyReport->getReportDate()?></td>
                            <td><a href="<?php echo url_for('dailyReport/read?id='.$dailyReport->getId());?>" class="">
                        <?php if(sfGuardUserProfile::isVicePresident($projectId)){?>
                            <?php echo htmlspecialchars(strlen($dailyReport->getContent())>80 ? mb_substr($dailyReport->getContent(), '0','67','utf8')."...." : mb_substr($dailyReport->getContent(), '0','67','utf8'));?></a></td>
                        <?php }else{?>
                            <?php echo htmlspecialchars(strlen($dailyReport->getContent())>80 ? mb_substr($dailyReport->getContent(), '0','85','utf8')."...." : mb_substr($dailyReport->getContent(), '0','85','utf8'));?></a></td>
                        <?php }?>
                    <?php endforeach;?>
               <?php }else{?>
                   <tr><td colspan=3><div class='no_data'> <?php echo __('没有数据'); ?> </div></td></tr>
               <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="btn_con">
        <div class="btns clearfix">
            <a href="<?php echo url_for('project/index?' .  html_entity_decode(formGetQuery("keywords", "type")))?>" class="btn_blue"><?php echo __('返回项目列表') ?></a>
        </div>
    </div>
    </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#startTime,#endTime').attr('readonly', true);
    $('#startTime').setTimepicker();
    $('#endTime').setTimepicker();
});
</script>