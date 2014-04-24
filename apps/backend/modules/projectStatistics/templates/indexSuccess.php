<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('project/index?type=' . $project->getType())?>"><?php echo __('项目管理') ?></a> &gt; <span><?php echo __('查看项目详细页面') ?></span>
    </div>
    <div class="box project">
        <h3 class="pro_title">项目<?php echo $project->getName(); echo __('的详细页面') ;?></h3>
        <div class="formDiv">
            <div class="pro_info">
                <div class="pro_item"><?php echo __('项目属性');?></div>

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
                    <div class="clear"></div>
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
                    <label class="label">
                        <?php echo __('开始日期'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo date('Y-m-d', strtotime($project->getStartDate())) ;?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('结束日期'); ?>：
                    </label>
                     <div class="iner lh30">
                        <?php echo date('Y-m-d', strtotime($project->getEndDate())) ;?>
                    </div>
                </div>
                <?php if( ($project->getPhase() == ProjectPeer::PROJECT_PHASE) || ($project->getType() == ProjectPeer::OUTSOURCE_PROJECT) ):?>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('标段号'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo $project->getBlockNumber();?>
                    </div>
                </div>
                <?php elseif($project->getPhase() == ProjectPeer::TENDERING_PHASE):?>
                <div class="formItem">
                <label class="label">
                    <?php echo __('购买标书'); ?>：
                </label>
                    <div class="iner lh30">
                        <?php
                            $yesOrNoRadio = util::getYesOrRadio();
                            echo $yesOrNoRadio[$project->getIsBuyTheTenderDocument()];
                        ?>
                    </div>
                </div>
                <?php if($project->getIsBuyTheTenderDocument()):?>
                <div class="formItem">
                    <label class="label">
                            <?php echo __('价格'); ?>：
                    </label>
                     <div class="iner lh30">
                            <?php
                                echo $project->getTenderDocumentPrice();
                            ?>
                            <?php echo __(' 元'); ?>
                    </div>
                </div>
                <?php endif;?>
                <div class="formItem">
                    <label class="label">
                            <?php echo __('投标状态'); ?>：
                    </label>
                    <div class="iner lh30">
                            <?php
                                $status = ProjectPeer::getTenderingStatus();
                                echo $status[$project->getTenderingStatus()];
                            ?>
                    </div>
                </div>
                <?php endif;?>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('备注'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo str_replace('<br />','',htmlspecialchars_decode($project->getComment()));?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <!--  项目成员 -->
            <div class="pro_info">
                <div class="pro_item"><?php echo __('项目成员'); ?></div>
                <div class="formItem">
                    <div class="lh30 mr20 ml20">
                        <?php $projectMembers = $project->getProjectMember();?>
                        <?php if($projectMembers):?>
                            <?php foreach($projectMembers as $projectMember):?>
                            <?php
                                $userName = '';
                                $memberRoleName = '';
                            ?>
                            <?php if($projectMember->getMemberUser()):?>
                            <?php $userName = $projectMember->getMemberUser()->getLastName() . $projectMember->getMemberUser()->getFirstName();?>
                            <?php if($projectMember->getMemberRole()){
                                        if($projectMember->getMemberRole()->getId() != 12){
                                            $memberRoleName =  '(' . $projectMember->getMemberRole()->getName() . ')';
                                        }
                                   }
                            ?>
                            <?php endif;?>
                            <?php $string .= $userName.$memberRoleName .'、' ?>
                            <?php endforeach;?>
                            <?php echo trim($string,'、');?>
                        <?php else:?>
                            <div style="color:#8B8B8B">暂无项目成员信息</div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="pro_info">
                <div class="pro_item"><?php echo __('项目文档'); ?></div>
                <div class="formItem">
                    <div class="lh30 mr20 ml20">
                        <table>
                            <thead>
                                <tr>
                                    <td class="w120"><?php echo __('文档编号') ?></td>
                                    <td class="w120"><?php echo __('标题') ?></td>
                                    <td class="w120"><?php echo __('合同号') ?></td>
                                    <td class="w120"><?php echo __('期号') ?></td>
                            </thead>
                            <tbody>
                            <?php $projectDocuments = $project->getProjectDocuments();?>
                            <?php if($projectDocuments):?>
                                <?php foreach($projectDocuments as $key=>$projectDocument):?>
                                <?php $document = $projectDocument->getDocument()?>
                                <?php // var_dump($document); exit;?>
                                    <tr class="<?php echo $key%2==0 ? "" : "odd";?>">
                                    <td><?php echo htmlspecialchars(strlen($document->getDocumentNumber())>24 ? mb_substr($document->getDocumentNumber(), '0','8','utf8')."..." : mb_substr($document->getDocumentNumber(),'utf8'));?></td>
                                    <td><?php echo htmlspecialchars(strlen($document->getTitle())>24 ? mb_substr($document->getTitle(), '0','8','utf8')."..." : mb_substr($document->getTitle(),'utf8'));?></td>
                                    <td><?php echo htmlspecialchars(strlen($document->getContractNumber())>24 ? mb_substr($document->getContractNumber(), '0','8','utf8')."...." : mb_substr($document->getContractNumber(),'utf8'));?></td>
                                    <td><?php echo htmlspecialchars(strlen($document->getIssue())>24 ? mb_substr($document->getIssue(), '0','8','utf8')."..." : mb_substr($document->getIssue(),'utf8'));?></td>
                                    </tr>
                                  <?php endforeach; ?>
                              <?php else:?>  
                                    <td colspan="4" align="center" style="color:#8B8B8B">暂无文档信息</td>
                              <?php endif;?>      
                            </tbody>
                        </table>
                  </div>
                </div>
            </div>
            <?php if( ($project->getPhase() == ProjectPeer::PROJECT_PHASE) && ($project->getType() == ProjectPeer::INNER_PROJECT)):?>
            <div class="pro_info">
                <div class="pro_item"><?php echo __('项目里程碑'); ?></div>
                <div class="formItem">
                 <div class="lh30 mr20 ml20">
                 <table>
                    <thead>
                        <tr>
                            <td class="w80"><?php echo __('阶段') ?></td>
                            <td class="w80"><?php echo __('截止时间') ?></td>
                            <td class="w100"><?php echo __('描述') ?></td>
                            <td class="w100"><?php echo __('状态') ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $milestones = $project->getProjectMilestones(); ?>
                        <?php if($milestones):?>
                            <?php foreach($milestones as $key=>$milestone):?>
                            <?php
                                $deadLine = date('Y-m-d', strtotime($milestone->getDeadline()));
                                $currentDate  = date('Y-m-d', time());
                            ?>
                            <tr class=<?php echo $key%2==0 ? "" : "odd";?>>
                                <td><?php echo '第'.($key+1).'阶段';?></td>
                                <td><?php echo $milestone->getDeadline();?></td>
                                <td><?php echo htmlspecialchars(strlen($milestone->getDescription())>30 ? mb_substr($milestone->getDescription(), '0','8','utf8')."..." : mb_substr($milestone->getDescription(), '0','8','utf8'));?></td>
                                <td class="status">
                                <?php
                                if($milestone->getIsCompleted()){
                                    echo '已完成';
                                }else{
                                    if($deadLine < $currentDate){
                                        echo '已过期  ' , '<img class="middle" src="/images/icons/exclamation.png" />';
                                    }elseif(round((strtotime($deadLine) - strtotime($currentDate))/3600/24) <= 7){
                                        echo '即将过期';
                                    }else{
                                        echo '进行中';
                                    }
                                }
                                ?>
                                </td>
                             </tr>
                             <?php endforeach;?>
                        <?php else:?>
                             <td colspan="4" align="center" style="color:#8B8B8B">暂无里程碑信息</td>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            </div>
            </div>
            <?php endif;?>
        </div>
        <div class="btn_con">
            <div class="btns clearfix mt10">
                <a href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("keywords", "type") )); ?>" class="btn_blue">返回</a>
            </div>
        </div>
    </div>
</div>

