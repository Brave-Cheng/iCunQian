<?php echo javascript_include_tag('comm') ?>
<?php include_partial('global/datetimepicker_path'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('signIn/index?' .  html_entity_decode(formGetQuery("project", "user", "startTime", "endTime")));?>"><?php echo __('签到记录');?></a> &gt; <span><?php echo __('签到详细页面');?></span>
    </div>
    <div class="box">
    <div class="btn_con">
        <?php echo form_tag("signIn/statisticList?" . html_entity_decode(formGetQuery("keywords")), "id=searchTable") ?>
        
        <div class="btns mb10 clearfix">
             <div class="left">
                <label class="label"><?php echo __('根据项目筛选');?>：</label>
                <select id="project" name="project" class="select" onChange="changeProject(this,'<?php echo url_for("signIn/statisticList")?>');">
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

            <div class="clear"></div>
            <?php
                $currentDate = date('Y-m-d');
                $prevWeekDate = date('Y-m-d', strtotime("$currentDate - 7 days"));
            ?>
            <div class="mt10">
                &nbsp;&nbsp;<?php echo __('选择时间段： 从 ');?><input type="text" onChange="return changeStartTime(this, '<?php echo url_for("signIn/statisticList")?>');"  id="startTime" name='startTime' class="txt" value="<?php echo $sf_request->hasParameter('startTime') ? $startTime : $prevWeekDate;?>" />
                <span class="operation"><a href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="return clearStartTime('<?php echo url_for("signIn/statisticList")?>');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                <?php echo __('到 ');?>
                <input type="text" onChange="return changeEndTime(this, '<?php echo url_for("signIn/statisticList")?>');" id="endTime" name='endTime' class="txt" value="<?php echo $sf_request->hasParameter('endTime') ? $endTime : $currentDate;?>"/>
                <span class="operation"><a href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="return clearEndTime('<?php echo url_for("signIn/statisticList")?>');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                <span class="error mt10"><?php if(!empty($title)){echo __('开始时间不能晚于结束时间');}?></span>
            </div>
        </div>
        <div class="pagination mb10" style="float:none;">
            <div class="pagerlist"><?php if(utilPagerDisplayTotal($pager) > 20){
                echo utilPagerPages($pager, "signIn/statisticList" , html_entity_decode(formGetQueryDenyPager("keywords","userId")));
                } ?>
                <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条");?></span>
            </div>
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
            <table>
                <thead>
                    <tr>
                        <td class="w80"><?php echo __('签到时间');?></td>
                        <td class="w200"><?php echo __('签到地点');?></td>
                        <td class="w60"><?php echo __('签到人');?></td>
                        <td class="w140"><?php echo __('签到项目');?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if($pager['results']):?>
                    <?php foreach($pager['results'] as $key=>$signIn):?>
                    <tr class=<?php echo $key%2==0 ? "" : "odd";?>>
                        <td><?php echo date('Y-m-d H:i', strtotime($signIn->getSignInTime()));?></td>
                        <td>
                        <?php 
                            $addressArr = explode(',', $signIn->getAddress());
                            echo implode($addressArr);
                        ?>
                        </td>
                        <?php
                            if($signIn->getUserInfo()){
                                $user = sfGuardUserPeer::retrieveByPK($signIn->getUserInfo()->getUserId());
                                if($user->getIsActive()){
                                    $class = '';
                                }else{
                                    $class = 'gray';
                                }
                            }
                        ?>
                        <td class="<?php echo $class?>"><?php echo $signIn->getUserInfo() ? $signIn->getUserInfo()->getLastName() . $signIn->getUserInfo()->getFirstName() : '';?></td>
                        <td><?php echo $signIn->getProjectInfo()->getName();?></td>
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
            <div class="pagerlist"><?php if(utilPagerDisplayTotal($pager) > 20){
                echo utilPagerPages($pager, "signIn/statisticList" , html_entity_decode(formGetQueryDenyPager("keywords","userId")));
                } ?>
                <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条");?></span>
            </div>
            <div class="clear"></div>
            <div class="btn_con">
            <div class="btns clearfix mt10">
                <a href="<?php echo url_for('signIn/index?' .  html_entity_decode(formGetQuery("project", "user", "startTime", "endTime")));?>" class="btn_blue">返回</a>
            </div>
        </div>
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
    var userId = '<?php echo $user->getId();?>';
    function changeProject(obj, url){
        window.location.href = url + '?userId=' + userId +   '&project=' + obj.value + '&startTime=' + $("#startTime").val() + '&endTime=' + $("#endTime").val();
    }

    function changeStartTime(obj, url){
        window.location.href = url + '?userId='+userId + '&project=' + $('#project').val() + '&startTime=' + $("#startTime").val() + '&endTime=' + $("#endTime").val();;

    }
    function changeEndTime(obj, url){
        window.location.href = url + '?userId='+userId + '&project=' + $('#project').val() + '&startTime=' + $("#startTime").val() + '&endTime=' + $("#endTime").val();;

    }
    function clearStartTime(url){
        $('#startTime').val('');
        window.location.href = url + '?userId='+userId + '&project=' + $('#project').val() + '&startTime=' + '' + '&endTime=' + $("#endTime").val();;
    }
    function clearEndTime(url){
        $('#endTime').val('');
        window.location.href = url + '?userId='+userId + '&project=' + $('#project').val() + '&startTime=' + $("#startTime").val() + '&endTime=' + '';;
    }
    $(document).ready(function(){
        setSearchType( 'keywords' );
    })
</script>