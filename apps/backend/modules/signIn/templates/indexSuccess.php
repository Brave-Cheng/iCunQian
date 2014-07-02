<?php echo javascript_include_tag('comm') ?>
<?php include_partial('global/datetimepicker_path'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <span><?php echo __('签到记录');?></span> &gt; <span><?php echo __('签到查看');?></span>
    </div>
    <div class="box">
    <div class="btn_con">
        <?php echo form_tag("signIn/index?" . html_entity_decode(formGetQuery("keywords")), "id=searchTable") ?>
        <div class="btns mb10 clearfix">
             <div class="left">
                <label class="label"><?php echo __('根据项目筛选');?>：</label>
                <select id="project" name="project" class="select" onChange="changeProject(this,'<?php echo url_for("signIn/index?keywords=" . $keywords)?>');">
                    <option value="0"><?php echo __('所有项目')?></option>
                    <?php foreach($projects as $project):?>
                    <?php if($sf_request->getParameter('project') == $project->getId()):?>
                    <option value="<?php echo $project->getId()?>" selected="selected"><?php echo $project->getName();?></option>
                    <?php else:?>
                    <option value="<?php echo $project->getId()?>" ><?php echo $project->getName();?></option>
                    <?php endif;?>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="left ml10">
                <label class="label"><?php echo __('根据用户筛选');?>：</label>
                <select id="user" name="user" class="select" onChange="changeUser(this,'<?php echo url_for("signIn/index?keywords=" . $keywords)?>');">
                    <option value="0"><?php echo __('所有用户')?></option>
                    <?php foreach($users as $user):?>
                    <?php if($sf_request->getParameter('user') == $user->getUserId()):?>
                    <option value="<?php echo $user->getUserId()?>" selected="selected"><?php echo $user->getLastName() . $user->getFirstName();;?></option>
                    <?php else:?>
                    <option value="<?php echo $user->getUserId()?>" ><?php echo $user->getLastName() . $user->getFirstName();?></option>
                    <?php endif;?>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="clear"></div>
            <?php
                $currentDate = date('Y-m-d');
                $prevWeekDate = date('Y-m-d', strtotime("$currentDate - 7 days"));
            ?>
            <div class="mt10">
                &nbsp;&nbsp;<?php echo __('选择时间段： 从 ');?><input type="text" onChange="return changeStartTime(this, '<?php echo url_for("signIn/index?keywords=" . $keywords)?>');"  id="startTime" name='startTime' class="txt" value="<?php echo $sf_request->hasParameter('startTime') ? $startTime : $prevWeekDate;?>" />
                <span class="operation"><a href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="return clearStartTime('<?php echo url_for("signIn/index?keywords=" . $keywords)?>');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                <?php echo __('到 ');?>
                <input type="text" onChange="return changeEndTime(this, '<?php echo url_for("signIn/index?keywords=" . $keywords)?>');" id="endTime" name='endTime' class="txt" value="<?php echo $sf_request->hasParameter('endTime') ? $endTime : $currentDate;?>"/>
                <span class="operation"><a href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="return clearEndTime('<?php echo url_for("signIn/index?keywords=" . $keywords)?>');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                <span class="error mt10"><?php if(!empty($title)){echo __('开始时间不能晚于结束时间');}?></span>
            </div>
        </div>

        <div class="pagination mb10" style="float:none;">

            <div class="clear"></div>
        </div>
        <?php if($sf_params->get('keywords') != null){?>
            <div class="mt5">
                您当前搜索的是：<span style="color:#f29518;"><?php echo htmlspecialchars($sf_params->get('keywords'))?></span>
            </div>
        <?php }?>
    </div>
    </form>
    <div class="tables">
        <div class="on">
            <?php
            $project = ProjectPeer::retrieveByPk($sf_request->getParameter('project'));
            if($project){
                $projectName = $project->getName();
            }else{
                $projectName = '所有项目';
            }

            ?>
            <p>以下为所选时间段内，用户在<?php echo $projectName;?>的签到情况：</p>
            <table>
                <thead>
                    <tr>
                        <td class="w80"><?php echo __('签到人');?></td>
                        <td class="w200"><?php echo __('签到城市');?></td>
                        <td class="w60"><?php echo __('签到总次数');?></td>
                        <td class="w60">&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if($signListStatisticsData):?>
                    <?php foreach($signListStatisticsData as $userId=>$signInDatas):?>
                    <tr>
                        <?php
                        $signAddress = array_unique($signInDatas['address']);
                        $dataValueCount = array_count_values($signInDatas['address']);
                        $userInfo = sfGuardUserPeer::retrieveByPk($userId)->getProfile();
                        $flag = false;
                        ?>
                        <td rowspan="<?php echo count($signAddress);?>"><?php echo $userInfo->getLastName().$userInfo->getFirstName();?></td>
                        <?php foreach($signAddress as $key=>$address):?>
                        <?php echo $key==0 ? '': '<tr>'?>
                        <td><?php echo $address,'<br />'; ?></td>
                        <td ><?php echo $dataValueCount[$address];?></td>
                        <?php if(count($signAddress) >= 1 && $flag == false): ?>
                        <?php $flag = true;?>
                        <td rowspan="<?php echo count($signAddress);?>"><a href="<?php echo url_for('signIn/statisticList?userId=' . $userId . '&' . html_entity_decode(formGetQuery("project", "user", "startTime", "endTime")));?>"><?php echo __('详细页面'); ?></a></td>
                        <?php endif;?>
                        <?php endforeach;?>
                    </tr>
                    <?php endforeach;?>
                    <?php else:?>
                      <tr>
                          <td colspan="4" class=""><div class="no_data"><?php echo __('签到列表为空');?></div></td>
                      </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div style="clear:both;"></div>
    <div class="pagination mb10" style="float:none;">
            <div class="clear"></div>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#startTime,#endTime').attr('readonly', true);
        $('#startTime').setTimepicker();
        $('#endTime').setTimepicker();
    });
    function changeProject(obj, url){
        window.location.href = url + '?project=' + obj.value + '&user=' + $('#user').val() + '&startTime=' + $("#startTime").val() + '&endTime=' + $("#endTime").val();
    }
    function changeUser(obj, url){
        window.location.href = url + '?user=' + obj.value + '&project=' + $('#project').val() + '&startTime=' + $("#startTime").val() + '&endTime=' + $("#endTime").val();;
    }
    function changeStartTime(obj, url){
        window.location.href = url + '?user=' + $("#user").val() + '&project=' + $('#project').val() + '&startTime=' + $("#startTime").val() + '&endTime=' + $("#endTime").val();;

    }
    function changeEndTime(obj, url){
        window.location.href = url + '?user=' + $("#user").val() + '&project=' + $('#project').val() + '&startTime=' + $("#startTime").val() + '&endTime=' + $("#endTime").val();;

    }
    function clearStartTime(url){
        $('#startTime').val('');
        window.location.href = url + '?user=' + $("#user").val() + '&project=' + $('#project').val() + '&startTime=' + '' + '&endTime=' + $("#endTime").val();;
    }
    function clearEndTime(url){
        $('#endTime').val('');
        window.location.href = url + '?user=' + $("#user").val() + '&project=' + $('#project').val() + '&startTime=' + $("#startTime").val() + '&endTime=' + '';;
    }
    $(document).ready(function(){
        setSearchType( 'keywords' );
    })
</script>