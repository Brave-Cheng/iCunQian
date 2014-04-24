<?php echo form_tag('user/update', 'method=post multipart=true id=userProfile')  ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js'); ?>
<?php
    if($sfUser){
        echo "<input name='id' value='" . $sfUser->getId() . "' type='hidden' />";
    }
?>
<div id="content" class="right">
    <div class="bread_crumbs"> <a class='jump' href="<?php echo url_for('user/index'); ?>"><?php echo __('组织结构'); ?></a> &gt; <span> <?php echo __('用户页面'); ?></span> </div>
    <div class="box">
        <div class="formDiv">
            <div class="formItem">
                    <label class="label">
                        <?php echo __('姓'); ?>：<em class="red">*</em>
                    </label>
                    <div class="iner">
                        <input type="text"  name='last_name' class="txt" value="<?php echo $userProfile ? htmlspecialchars( $userProfile->getLastName() ) : ''; ?>"/>
                        <span class="error"><?php echo __(form_span_error("last_name")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                    <label class="label">
                        <?php echo __('名'); ?>：<em class="red">*</em>
                    </label>
                    <div class="iner">
                        <input type="text"  name='first_name' class="txt" value="<?php echo $userProfile ? htmlspecialchars( $userProfile->getFirstName() ) : ''; ?>"/>
                        <span class="error"><?php echo __(form_span_error("first_name")); ?></span>
                    </div>
            </div>
            <div class="formItem">
                <?php if($sfUser){ ?>
                    <label class="label" for="username"><?php echo __('用户名'); ?>：&nbsp;&nbsp;</label>
                    <div class="iner">
                        <input type="text" readonly name='username' class="txt disabled" value="<?php echo $sfUser ? $sfUser->getUsername() : ''; ?>"/>
                    </div>
                <?php }else{ ?>
                    <label class="label" for="username"><?php echo __('用户名'); ?>：<em class="red">*</em></label>
                    <div class="iner">
                        <input type="text" name='username' class="txt" value="<?php echo $sfUser ? $sfUser->getUsername() : ''; ?>"/>
                        <span class="error"><?php echo __(form_span_error("username")); ?></span>
                        <div class="mt5"><?php echo __('用户名由3-12位字母，数字组成'); ?></div>
                    </div>
                <?php } ?>
            </div>
            <?php if( !$sfUser ){ ?>
            <div class="formItem">
                    <label class="label" for="password"><?php echo __('密码'); ?>：<em class="red">*</em></label>
                    <div class="iner">
                        <input id='password' type="password" name='password' class="txt" value=""/>
                        <span class="error"><?php echo __(form_span_error("password")); ?></span>
                        <div class="mt5"><?php echo __('密码由8-15位字母，数字组成'); ?></div>
                    </div>
            </div>
            <div class="formItem">
                    <label class="label" for="passwordConfirm"><?php echo __('确认密码'); ?>：<em class="red">*</em></label>
                    <div class="iner">
                        <input id='password' type="password" name='passwordConfirm' class="txt" value=""/>
                        <span class="error"><?php echo __(form_span_error("passwordConfirm")); ?></span>
                    </div>
            </div>
            <?php } ?>
            <div class="formItem">
                    <label class="label"><?php echo __('性别'); ?>：<em class="red">*</em></label>
                    <div class="iner">
                        <label class="inblock mr10"><input name='gender' type="radio" class="radio" value="1" <?php if( $userProfile && $userProfile->getGender() == 1){ echo 'checked="true"'; } ?> /> 男</label>
                        <label class="inblock mr10"><input name='gender' type="radio" class="radio" value="0" <?php if( $userProfile && $userProfile->getGender() == 0){ echo 'checked="true"'; } ?> /> 女</label>
                        <span class="error"><?php echo __(form_span_error("gender")); ?></span>
                        <div class="clear"></div>
                    </div>
            </div>
            <div class="formItem">
                    <label class="label"><?php echo __('照片'); ?>：&nbsp;&nbsp;</label>
                    <div class="iner relative">
                        <input name='headPhoto' type="file" class="file mt5" value=""/><br/>
                        <span class="error"><?php echo __(form_span_error("headPhoto")); ?></span>
                        <div class="right photo">
                            <?php if( $userProfile && $userProfile->getHeadPhoto() != '' ){?>
                            <span><?php echo __('照片预览'); ?>：&nbsp;&nbsp;</span>
                            <img src="<?php echo sfGuardUserProfilePeer::getHeadPhotoUrl( $userProfile->getHeadPhoto() ); ?>" width="100" />
                            <?php
                            }else{
                            ?>
                            <span class="no_photo"><?php echo __('照片预览： 暂无照片'); ?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
            </div>
            <div class="formItem">
                    <span class="label"><?php echo __('联系方式'); ?>：&nbsp;&nbsp;</span>
                    <div class="clear"></div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('手机'); ?>：<em class="red">*</em></label>
                <div class="iner phone">
                    <span class="inblock mr10">
                        <input name='telephone' type="text" class="txt" value="<?php echo $userProfile ? $userProfile->getTelephone() : ''; ?>"/>
                        <br />
                        <span class="error"><?php echo __(form_span_error("telephone")); ?></span>
                    </span>
                    <span class="inblock mr10">
                        <?php echo __('QQ'); ?>：&nbsp;&nbsp;<input name='qq' type="text" class="txt" value="<?php echo $userProfile ? $userProfile->getQq() : ''; ?>"/><br />
                        <span class="error qq_err"><?php echo __(form_span_error("qq")); ?></span>
                    </span>
                    <span class="inblock mr10">
                        <?php echo __('邮箱'); ?>：<em class="red">*</em> <input name='email' type="text" class="txt" value="<?php echo $userProfile ? $userProfile->getEmail() : ''; ?>"/><br />
                        <span class="error email_err ml10"><?php echo __(form_span_error("email")); ?></span>
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="formItem">
                <label class="label">&nbsp;&nbsp;</label>
                <div class="iner lh30">
                    <?php echo __('请确保手机的正确性，否则会影响短信的接收');?>
                </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('部门'); ?>：&nbsp;&nbsp;</label>
                <div class="iner">
                    <select class="select" name='departmentId' >
                        <?php foreach( $departments as $department ){ ?>
                        <option value='<?php echo $department->getId(); ?>' <?php $departmentId = is_object($departmentSfUser) ? $departmentSfUser->getDepartmentId() : $departmentSfUser; if( $department->getId() == $departmentId ){ echo "selected=selected"; } ?> ><?php echo $department->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('头衔'); ?>：&nbsp;&nbsp;</label>
                <select name="titleId">
                    <option value=0><?php echo __('请选择'); ?><option>
                    <?php foreach( $titles as $title ){ ?>
                        <option <?php if($sfUser && $sfUser->getTitleSfGuardUserBySfUser($sfUser) &&$sfUser->getTitleSfGuardUserBySfUser($sfUser)->getTitle() && $sfUser->getTitleSfGuardUserBySfUser($sfUser)->getTitle()->getId() == $title->getId() ){ echo "selected='selected'"; } ?> value='<?php echo $title->getId(); ?>'><?php echo $title->getName(); ?></option>;
                    <?php } ?>
                </select>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('上级领导'); ?>：&nbsp;&nbsp;</label>
                <div class="iner">
                    <select name="superiorLeaders">
                        <option value=""><?php echo __('请选择'); ?><option>
                        <?php foreach( $users as $user ){ ?>
                            <?php $userId = $sfUser ? $sfUser->getId() : 0; if( $user->getId() != $userId ){ ?>
                            <option <?php if(isset($sfUser) && $user->getId() == $sfUser->getProfile()->getSuperiorLeaders()){ echo 'selected="selected"' ;} ?> value='<?php echo $user->getId(); ?>'><?php echo $user->getProfile()->getLastName() . $user->getProfile()->getFirstName(); ?></option>;
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('用户角色'); ?>：&nbsp;&nbsp;</label>
                <div class="iner Privilege">
                    <?php foreach($groups as $group){?>
                        <?php if($group->getId() != 1 ){ ?>
                        <label class="mr10 w120">
                            <input type="checkbox" name='groupIds[]' class="checkbox" value="<?php echo $group->getId(); ?>" 
                                <?php
                                if($sfUser){
                                    foreach( $sfUser->getGroups() as $userGroup ){
                                        if( $userGroup->getId() == $group->getId() ){
                                            echo 'checked="true"';
                                        }
                                    }
                                }
                                ?>
                             />  
                            <?php echo htmlspecialchars($group->getName()); ?>
                        </label>
                        <?php } ?>
                    <?php } ?>
                    <div class="error mt10"><?php echo __(form_span_error("permissionIds")); ?></div>
                </div>
                
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('签名图片'); ?>：&nbsp;&nbsp;</label>
                <div class="iner">
                    <input name='signatureImage' type="file" class="file" value=""/><br/>
                    <span class="error"><?php echo __(form_span_error("signatureImage")); ?></span>
                </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('签名预览'); ?>：&nbsp;&nbsp;</label>
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
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="保存" class="btn_blue" />
                <a href="<?php echo url_for('user/index?departmentId=' . $sf_request->getParameter('departmentId')); ?>" class="btn_blue jump"><?php echo __('放弃'); ?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
            showSaveSuccessfullyMessage(null, '<?php echo url_for($urlName . "?departmentId=" . $sf_request->getParameter('departmentId') ); ?>');
        }
        <?php if(!$sfUser){ ?>
        $("input[name='last_name']").focus();
        <?php } ?>
        $("select[name='superiorLeaders']").sSelect();
        $("select[name='titleId']").sSelect();
        $(".jump").leaveCheck({formId:'userProfile',formUrl:'<?php echo url_for("user/leaveCheck"); ?>'});
    });
</script>