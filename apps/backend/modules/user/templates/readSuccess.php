
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('user/index'); ?>"><?php echo __('组织结构') ?></a> &gt; <span><?php echo __('查看用户详细信息') ?></span>
    </div>
    <div class="box project">
        <div class="formDiv">
            <div class="pro_info">
                <div class="pro_item"><?php echo __('用户信息');?></div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('姓名'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo  htmlspecialchars( $userProfile->getLastName() ) .  htmlspecialchars( $userProfile->getFirstName() ); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('用户名'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo  htmlspecialchars( $sfUser->getUserName() );?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('性别'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php if( $userProfile->getGender() == 1){ ?>
                        <?php echo __('男'); ?>
                        <?php }else{ ?>
                        <?php echo __('女'); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('照片预览'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php if( $userProfile && $userProfile->getHeadPhoto() != '' ){ ?>
                            <img src="<?php echo sfGuardUserProfilePeer::getHeadPhotoUrl( $userProfile->getHeadPhoto() ); ?>" width="100" height="120" />
                        <?php
                        }else{
                        ?>
                        <span><?php echo __('暂无签名'); ?></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('电话'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo $userProfile->getTelephone(); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('QQ'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo $userProfile->getQq() ? $userProfile->getQq() : '无'; ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('邮箱'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo $userProfile->getEmail(); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('部门'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo $sfUser->getDepartmentNameString(); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('头衔'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php echo $titleSfUser && $titleSfUser->getTitle() ? $titleSfUser->getTitle()->getName() : '无'; ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('上级领导'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php 
                            $superLeader = sfGuardUserPeer::retrieveByPK($userProfile->getSuperiorLeaders()); 
                            echo $superLeader ? $superLeader : '无';
                        ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('用户角色'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php if($sfUser->getGroups()){ ?>
                            <?php foreach($groups as $group){ ?>
                            <?php
                            foreach( $sfUser->getGroups() as $userGroup ){
                                if( $userGroup->getId() == $group->getId() ){
                                    echo $group->getName();
                                }
                            }
                            ?>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php echo __('无'); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        <?php echo __('签名预览'); ?>：
                    </label>
                    <div class="iner lh30">
                        <?php if( $userProfile && $userProfile->getSignatureImage() != '' ){ ?>
                            <img src="<?php echo sfGuardUserProfilePeer::getSingatureImageUrl( $userProfile->getSignatureImage() );  ?>" width="150" />
                        <?php
                        }else{
                        ?>
                        <span><?php echo __('暂无签名'); ?></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn_con">
            <div class="btns clearfix mt10">
                <a href="<?php echo url_for('user/index?departmentId=' . $sf_request->getParameter('departmentId')); ?>" class="btn_blue jump"><?php echo __('返回'); ?></a>
            </div>
        </div>
    </div>
</div>