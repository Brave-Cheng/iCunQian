<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <span><?php echo __('项目管理') ?></span> &gt; <span><?php echo __('项目列表') ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
    <?php echo form_tag("project/index?" . html_entity_decode(formGetQuery("keywords", "type")), "id=searchTable") ?>
    <?php $typeIndex = $sf_request->getParameter('type');?>
        <div class="btns mb10 clearfix">
            <div class="clearfix mb10">
                <p class="left">以下是你有权限查看的项目（单击每行查看项目详细信息)：</p>
                <div id="search" class="right">
                    <div class="relative left">
                    <input type="submit" class="search_btn" value="" onclick="return checkKeyword()" />
                    <?php echo formInputTag("keywords", "搜索项目", array("class"=>"txt w200 gray"))?>
                    <?php if($sf_params->get('keywords') != null){?>
                    <a title="清除搜索" href="<?php echo url_for('project/index');?>" class="clear_search"></a>
                    <?php }?>
                    </div>
                    <input type="submit" class="btn_blue" onclick="return checkKeyword();" value="搜索" />
                </div>
            </div>
        </form>
            <?php if ($accessCreate): ?>
                <a href="<?php echo url_for('project/createProjectType?' . html_entity_decode(formGetQuery("keywords", "type")));?>" class="btn_blue"><?php echo __('创建新项目') ?></a>
            <?php endif; ?>
            
            <?php if($accessDailyReportCreate && $dailyReport){ ?>
                    <a href="<?php echo url_for('dailyReport/selectProject')?>" class="btn_blue"><?php echo __('撰写项目日报') ?></a>
            <?php } ?>
        </div>
    </div>
    <div class="tables">
        <div class="pagination mb10" style="float:none;">
            <div class="left mr10">
                <label class="label"><?php echo __('根据类型筛选项目');?>：</label>
                <select name="type" class="select" onChange="changeType(this,'<?php echo url_for("project/index?keywords=" . $keywords)?>');">
                    <option value="0"><?php echo __('所有项目')?></option>
                    <?php foreach($types as $key=>$type):?>
                    <?php if($sf_request->getParameter('type') == $key):?>
                    <option value="<?php echo $key?>" selected="selected"><?php echo $type;?></option>
                    <?php else:?>
                    <option value="<?php echo $key?>" ><?php echo $type;?></option>
                    <?php endif;?>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="pagination mb10" style="float:none;">
                <div class="pagerlist"><?php if(utilPagerDisplayTotal($pager) > 20){
                    echo utilPagerPages($pager, "project/index" , html_entity_decode(formGetQueryDenyPager("keywords", "type")));
                    }?>
                    <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条");?></span>
                </div>

                <div class="clear"></div>
            </div>
            <?php if($sf_params->get('keywords') != null){?>
            <div class="mt5">          
                您当前搜索的是：<span style="color:#f29518;"><?php echo htmlspecialchars(urldecode($sf_params->get('keywords')))?></span>
            </div>
            <?php }?>
        </div>

        <?php echo form_tag("project/index?" . html_entity_decode(formGetQuery("sort", "sortBy", "keywords")), "id=list") ?>
        <div class="tab-item on">
            <table>
                <thead>
                    <tr>
                        <td class="w40"><?php  echo __('ID') ?></td>
                        <td class="w100"><?php echo __('项目名称') ?></td>
                        <td class="w60"><?php echo __('项目类型') ?></td>
                        <td class="w60"><?php echo __('项目阶段') ?></td>
                        <td class="w60"><?php echo __('业主') ?></td>
                        <td class="w100"><?php  echo __('项目成员');?></td>
                        <td class="w160"><?php  echo __('项目时间');?></td>
                        <?php if ($sf_user->moduleAccess('project', 'read') || $sf_user->isSuperAdmin()) { ?>
                        <td class="w80">&nbsp;</td>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($pager['results'])):?>
                <?php foreach($pager['results'] as $key=>$project):?>
                    <tr class=<?php echo $key%2==0 ? "" : "odd";?>>
                        <td><?php echo $project->getId();?></td>
                        <td><?php echo htmlspecialchars( $project->getName() );?></td>
                        <td><?php echo $types[$project->getType()];?></td>
                        <td><?php echo $phases[$project->getPhase()];?></td>
                        <td><?php echo htmlspecialchars( $project->getProprietor() );?></td>
                        <td>
                        <?php
                        $projectMembers = $project->getProjectMember();
                        foreach($projectMembers as $projectMember){
                            $userName = '';
                            $memberRoleName = '';
                            if($projectMember->getMemberUser()){
                                $userName = $projectMember->getMemberUser()->getLastName() . $projectMember->getMemberUser()->getFirstName();

                                if($projectMember->getMemberRole()){
                                    if($projectMember->getMemberRole()->getId() != ProjectRolePeer::CUSTOME_ROLE){
                                        $memberRoleName =  '(' . $projectMember->getMemberRole()->getName() . ')';
                                    }
                                }

                            }
                            echo $userName , $memberRoleName ,'<br />';

                        }
                        ?>
                        </td>
                        <td><?php echo date('Y-m-d', strtotime($project->getStartDate())) . ' ～ ' . date('Y-m-d', strtotime($project->getEndDate()));?></td>
                        <?php if ($sf_user->moduleAccess('project', 'read') || $sf_user->isSuperAdmin()) { ?>
                        <td class="operate">
                            

                            <?php if ($projectStatisticsRead):?>
                            <a href='<?php echo url_for("projectStatistics/index?id=" . $project->getId() .'&' . html_entity_decode(formGetQuery("keywords", "type") ) );?>'><?php echo __('项目汇总') ?></a>
                            <?php endif;?>

                            
                            <?php if(!$project->getIsProjectEnd()){?>
                            <?php if ($accessUpdate):?>
                                <a href='<?php echo url_for("project/edit?id=" . $project->getId() . '&' . html_entity_decode(formGetQuery("keywords", "type") ));?>'><?php echo __('修改属性') ?></a>
                            <?php endif;?>
                            <?php }?>

                            <?php if(!$project->getIsProjectEnd()){?>
                            <?php if ($accessProjectMemberUpdate) :?>
                            <a href='<?php echo url_for("projectMember/edit?id=" . $project->getId().  '&' . html_entity_decode(formGetQuery("keywords", "type") ) );?>'><?php echo __('修改成员') ?></a>
                            <?php endif;?>
                            <?php }?>

                            <?php if(!$project->getIsProjectEnd()){?>
                            <?php if($accessProjectDocumetUpdate){?>
                            <a href='<?php echo url_for("projectDocument/edit?projectId=" . $project->getId() . '&' . html_entity_decode(formGetQueryDenyPager("keywords", "type", 'pager') ) );?>'><?php echo __('管理文档') ?></a>
                            <?php }?>
                            <?php }?>
                            
                            <?php if(!$project->getIsProjectEnd()){?>
                            <?php if($project->hasMilestone() && $project->getType() == ProjectPeer::INNER_PROJECT && $projectMilestoneRead):?>
                            <a href='<?php echo url_for('projectMilestone/index?id=' . $project->getId() . '&' . html_entity_decode(formGetQuery("keywords", "type") ));?>'><?php echo __('跟踪进度') ?></a>
                            <?php endif;?>
                            <?php }?>
                            
                            <?php if(!$project->getIsProjectEnd()){?>
                            <?php if($project->getPhase() == ProjectPeer::TENDERING_PHASE):?>
                            <?php if ($projectHistoryRead) {?>
                            <a href="<?php echo url_for('projectHistory/index?id=' . $project->getId() . '&' . html_entity_decode(formGetQuery("keywords", "type") ));?>"><?php echo __('查看历史') ?></a>
                            <?php }?>
                            <?php if(!$project->getIsProjectEnd()):?>
                            <?php
                            //只有有权限的人才能修改中标状态
                            if ($tender) {
                            ?>
                                <a href='<?php echo url_for('project/completeTender?id=' . $project->getId() . '&' . html_entity_decode(formGetQuery("keywords", "type") ));?>'><?php echo __('中标') ?></a><br/>
                            <?php
                            }
                            ?>
                            <?php endif;?>
                            <?php endif;?>
                            <?php }?>

                            <?php if(!$project->getIsProjectEnd()){?>
                            <?php if($project->getIsProjectEnd() > 0 && $completeProjectPermission && sfGuardUserProfile::isProjectManager($project->getId()) ){?>
                                <a href="<?php echo url_for('project/completeProject?id=' . $project->getId() .'&' . html_entity_decode(formGetQuery("keywords", "type") ));?>"><?php echo __('已终止') ?></a>
                                <?php
                                }else{
                                ?>
                                <?php if($completeProjectPermission && sfGuardUserProfile::isProjectManager($project->getId())):?>  
                                <a href="<?php echo url_for('project/completeProject?id=' . $project->getId() .'&' . html_entity_decode(formGetQueryDenyPager("keywords", "type") ));?>"><?php echo __('终止') ?></a>
                                <?php endif;?>
                                <?php
                                }
                            ?>
                            <?php }?>

                            <?php if($accessDailyReportRead){?>
                                <a href="<?php echo url_for('dailyReport/list?projectId='.$project->getId()).'&' . html_entity_decode(formGetQueryDenyPager("keywords", "type", 'pager'))?>"><?php echo __('查看项目日报') ?></a>
                            <?php }?>
                        </td>
                        <?php }?>
                    </tr>
                  <?php endforeach; ?>
                  <?php else:?>
                      <tr>
                          <td colspan="8" class="no_data"><?php echo __('项目列表为空');?></td>
                      </tr>
                  <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="btn_con">
        <div class="pagination mb10" style="float:none;">
            <div class="left mr10">
                <label class="label"><?php echo __('根据类型筛选项目');?>：</label>
                <select name="type" class="select"  onChange="changeType(this,'<?php echo url_for("project/index")?>');">
                    <option value="0"><?php echo __('所有项目')?></option>
                    <?php foreach($types as $key=>$type):?>
                    <?php if($sf_request->getParameter('type') == $key):?>
                    <option value="<?php echo $key?>" selected="selected"><?php echo $type;?></option>
                    <?php else:?>
                    <option value="<?php echo $key?>" ><?php echo $type;?></option>
                    <?php endif;?>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="pagination mb10" style="float:none;">
                <div class="pagerlist"><?php if(utilPagerDisplayTotal($pager) > 20){
                echo utilPagerPages($pager, "project/index" , html_entity_decode(formGetQueryDenyPager("keywords", "type")));
                }?>
                    <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条");?></span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="btns clearfix mb10">
        <?php if($sf_params->get('keywords') != null){?>
            <div class="mt10 clearfix">
               <a class="btn_blue" href="<?php echo url_for($urlName)?>"><?php echo __("返回项目列表")?></a>   
            </div> 
        <?php }?> 
        <div class="left mt15"> 
            <?php if ($accessCreate): ?>
                <a href="<?php echo url_for('project/createProjectType?' . html_entity_decode(formGetQuery("keywords", "type")));?>" class="btn_blue"><?php echo __('创建新项目') ?></a>
            <?php endif; ?>
                
            <?php if($accessDailyReportCreate && $dailyReport ){ ?>
                    <a href="<?php echo url_for('dailyReport/selectProject')?>" class="btn_blue"><?php echo __('撰写项目日报') ?></a>
            <?php } ?>
        </div>
        </div>

    </div>
    </div>
    </form>
</div>
<script type="text/javascript">
    function changeType(obj, url){
        window.location.href = url + '?type=' + obj.value;
    }
    $(document).ready(function(){
        setSearchType( 'keywords' );
        var msg = '<?php echo $sf_flash->get("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage('项目创建成功');
        }
    })
    
    function checkKeyword(){
        var key = $("#keywords").val();
        var pattren = /(\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\||\")+/;
        key = key.replace( pattren, '');
        if($.trim(key) == "" || key == '搜索项目'){
            showSaveSuccessfullyMessage("请输入正确的关键字，并且关键词请不要包含特殊符号。", null);
            return false;
        }else{
        	return formSubmit('searchTable', '<?php echo url_for("project/index?" . html_entity_decode(formGetQuery("type")), 'get') ?>');
        }
    }
</script>
