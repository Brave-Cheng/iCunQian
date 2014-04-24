<?php 
    $projectModules = array(
        'project',    
        'dailyReport',
        'projectDocument',
        'projectStatistics',
        'projectMember',
    )
?>
<div id="main" class="clearfix">
    <?php
        $userAllPermissionNames =  $sf_user->getGuardUser()->getUserAllPermissionNames();
    ?>
    <!-- menu begin -->
    <div id="main_menu" class="left">
        <ul class="menus">
            <li>
                <a href="<?php echo url_for('dashboard/index')?>"<?php if($sf_context->getModuleName() == 'dashboard'){echo 'class="current jump"';}else{ echo 'class="jump"'; } ?>><span><?php echo __('个人中心');?></span></a>
            </li>
            <?php if(in_array('user', $userAllPermissionNames) || $sf_user->isSuperAdmin()){ ?>
            <li>
                <a href="<?php echo url_for('user/index')?>"<?php if($sf_context->getModuleName() == 'user'){echo 'class="current jump"';}else{ echo 'class="jump"'; } ?>><span><?php echo __('组织结构');?></span></a>
            </li>
            <?php } ?>
            <?php if(in_array('document', $userAllPermissionNames) || $sf_user->isSuperAdmin()){ ?>
            <li>
                <a href="<?php echo url_for('document/index')?>"<?php if($sf_context->getModuleName() == 'document'){echo 'class="current jump"';}else{ echo 'class="jump"'; } ?>><span><?php echo __('文档管理');?></span></a>
            </li>
            <?php } ?>
            <?php if(in_array('project', $userAllPermissionNames) || $sf_user->isSuperAdmin()){ ?>
            <li>
                <a href="<?php echo url_for('project/index')?>"<?php if(in_array($sf_context->getModuleName() , $projectModules)== 'project'){echo 'class="current jump"';}else{ echo 'class="jump"'; } ?>><span><?php echo __('项目管理');?></span></a>
            </li>
            <?php } ?>
            <?php if(in_array('commitApproval', $userAllPermissionNames) || $sf_user->isSuperAdmin()){ ?>
            <li>
                <a href="<?php echo url_for('commitApproval/index'); ?>"<?php if($sf_context->getModuleName() == 'commitApproval'){echo 'class="current jump"';}else{ echo 'class="jump"'; } ?>><span><?php echo __('审批流程');?></span></a>
            </li>
            <?php } ?>
            <?php if(in_array('monitorAddress', $userAllPermissionNames) || $sf_user->isSuperAdmin()){ ?>
            <li>
                <a href="<?php echo url_for('monitorAddress/index'); ?>"<?php if($sf_context->getModuleName() == 'monitor' || $sf_context->getModuleName() == 'monitorAddress'){echo 'class="current jump"';}else{ echo 'class="jump"'; } ?>><span><?php echo __('视频监控');?></span></a>
            </li>
            <?php } ?>
            <?php if(in_array('signIn', $userAllPermissionNames) || $sf_user->isSuperAdmin()){ ?>
            <li>
                <a href="<?php echo url_for('signIn/index');?>"<?php if($sf_context->getModuleName() == 'signIn'){echo 'class="current jump"';}else{ echo 'class="jump"'; } ?>><span><?php echo __('签到记录');?></span></a>
            </li>
            <?php } ?>
        </ul>
    </div>