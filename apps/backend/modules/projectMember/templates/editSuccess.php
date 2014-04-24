<?php echo stylesheet_tag('ui-lightness/jquery-ui-1.9.2.custom.css')?>
<?php echo javascript_include_tag('jquery-ui-1.9.2.custom.min.js')?>
<?php echo javascript_include_tag('comm') ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
      <div id="content" class="right">
            <div class="bread_crumbs"> <a href="<?php echo url_for('project/index?type=' . $sf_request->getParameter('type'));?>"><?php echo __('项目管理');?></a> &gt; <span><?php echo __('修改成员');?></span></div>
            <div class="box">
                <div class="mb20">请为新创建的<?php echo $types[$project->getType()], htmlspecialchars( $project->getName() );?>添加项目成员（从左侧选择个人或者部门单击添加到右侧项目成员列表）：</div>
                <div class="project_user_list">
                    <div class="title_box clearfix">
                        <div class="title"><?php echo __('公司人员列表');?></div>
                        <div class="title title_2"><?php echo __('现有项目成员');?></div>
                    </div>
                    <?php echo form_tag("project/editProjectMember", "id=searchTable") ?>
                    <div id="search" class="m15 clearfix">
                        <div class="left">
                            <input type="submit" class="search_btn" value="" />
                            <?php echo formInputTag("keywords", "搜索用户", array("class"=>"txt w180 gray"))?>
                            <input type="button" class="btn_blue" value="搜索" id="btn_search"/>
                        </div>
                        <div class="lh30 ml15 left"><span id="keyError" style="color:red"><?php echo __(form_span_error("memberNull")); ?></span></div>
                    </div>
                    </form>
                    <div class="left com_user">
                        <div class="accordion">
                        <?php foreach( $departments as $department ) : ?>
                        <?php if(($project->getType() == ProjectPeer::OUTSOURCE_PROJECT) && in_array($department->getId(), array(2, 3))):?>
                            <h3 id="h_<?php echo $department->getId(); ?>"><?php echo $department->getName(); echo '(<span class="span_left">' . $department->getLeftMembersCount($project->getId()) . '</span>人)';?></h3>
                            <?php $users = $department->getDepartmentUsers(); ?>
                            <div class = "lleft" id="lleft_<?php echo $department->getId(); ?>">
                                <ul>
                                    <?php foreach($users as $user):?>
                                    <?php if(!ProjectPeer::checkIsInProject($user->getUserId(), $project->getId())):?>
                                    <li id="user_<?php echo $user->getUserId();?>">
                                        <a title="点击添加" href="javascript:void(0);" onclick="javascript:addOption(this);" id='<?php echo $user->getUserId()?>'><?php echo  $user->getLastName() . $user->getFirstName();?></a>
                                    </li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                            <?php elseif(($project->getType() == ProjectPeer::INNER_PROJECT)):?>
                             <h3 id="h_<?php echo $department->getId(); ?>"><?php echo $department->getName(); echo '(<span class="span_left">' . $department->getLeftMembersCount($project->getId()) . '</span>人)';?></h3>
                            <?php $users = $department->getDepartmentUsers(); ?>
                            <div class = "lleft" id="lleft_<?php echo $department->getId(); ?>">
                                <ul>
                                    <?php foreach($users as $user):?>
                                    <?php if(!ProjectPeer::checkIsInProject($user->getUserId(), $project->getId())):?>
                                    <li id="user_<?php echo $user->getUserId();?>">
                                        <a title="点击添加" href="javascript:void(0);" onclick="javascript:addOption(this);" id='<?php echo $user->getUserId()?>'><?php echo  $user->getLastName() . $user->getFirstName();?></a>
                                    </li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                            <?php endif;?>
                        <?php endforeach;?>
                        </div>
                    </div>
                    <div class="left pro_user">
                    <?php if(!$project->getIsProjectEnd()){?>
                        <?php echo form_tag("projectMember/update?" . html_entity_decode(formGetQuery("keywords", "type") ), "id=userList") ?>
                    <?php }else{?> 
                        <?php echo form_tag("projectMember/update?" . html_entity_decode(formGetQuery("keywords", "type") )) ?>
                    <?php }?>   
                        <input type="hidden" name="id" value="<?php echo $project->getId();?>" />
                        <div class="accordion">

                        <?php foreach( $departments as $department ) : ?>
                             <?php if(($project->getType() == ProjectPeer::OUTSOURCE_PROJECT) && in_array($department->getId(), array(2, 3))):?>
                            <h3><?php echo $department->getName();echo '(<span class="span_right">' . $department->getRightMembersCount($project->getId()) . '</span>人)';?></h3>

                            <?php $users = $department->getDepartmentUsers(); ?>
                            <div id="right_<?php echo $department->getId(); ?>">
                                <ul>
                                    <?php foreach($users as $user):?>
                                    <?php if(ProjectPeer::checkIsInProject($user->getUserId(), $project->getId())):?>
                                    <li class="muser" id="muser_<?php echo $user->getUserId();?>">
                                        <span><?php echo  $user->getLastName() . $user->getFirstName();?></span><?php echo '';?>
                                    <span class="right">
                                        <?php if(($project->getType() != ProjectPeer::OUTSOURCE_PROJECT)):?>
                                        <strong>成员角色: </strong>
                                        <?php $userRoleId = ProjectPeer::checkUserRole($user->getUserId(), $project->getId());?>
                                        <select class="w100" name="projectRole[]" onChange="return optionChange(this);">
                                            <option  value="0"><?php echo __('选择角色');?></option>
                                            <?php foreach($projectRoles as $projectRole):?>
                                                <?php if($userRoleId == $projectRole->getId() ):?>
                                                <option selected="selected" value="<?php echo $projectRole->getId();?>"><?php echo $projectRole->getName();?></option>
                                                <?php else:?>
                                                 <option  value="<?php echo $projectRole->getId();?>"><?php echo $projectRole->getName();?></option>
                                                <?php endif; ?>
                                            <?php endforeach;?>
                                        </select>
                                        <?php endif;?>
                                        <input type="hidden" class="userClass" name="userId[]" id="muser_<?php echo $user->getUserId();?>" value="<?php echo $user->getUserId();?>" />
                                        <?php if(($project->getType() != ProjectPeer::OUTSOURCE_PROJECT)):?>
                                        <?php if($userRoleId == ProjectRolePeer::CUSTOME_ROLE):?>
                                        <?php $otherRoleName = ProjectPeer::getProjectMemberOtherRoleName($user->getUserId(), $project->getId());?>
                                        <input type="text" id="otherRole_<?php echo $user->getUserId();?>" name="otherRole[<?php echo $user->getUserId();?>]" value="<?php echo $otherRoleName;?>" class="txt w60" />
                                        <?php endif?>
                                        <?php endif;?>
                                        <a title="点击删除" href="javascript:void(0);" onclick="javascript:removeOption(this);" id='<?php echo $user->getUserId()?>' data-name='<?php echo  $user->getLastName() . $user->getFirstName();?>'><?php echo __('删除成员');?></a>
                                    </span>
                                    </li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                            <?php elseif(($project->getType() == ProjectPeer::INNER_PROJECT)):?>
                            <h3><?php echo $department->getName();echo '(<span class="span_right">' . $department->getRightMembersCount($project->getId()) . '</span>人)';?></h3>
                            <?php $users = $department->getDepartmentUsers(); ?>
                            <div id="right_<?php echo $department->getId(); ?>">
                                <ul>
                                    <?php foreach($users as $user):?>
                                    <?php if(ProjectPeer::checkIsInProject($user->getUserId(), $project->getId())):?>
                                    <li class="muser" id="muser_<?php echo $user->getUserId();?>">
                                        <span><?php echo  $user->getLastName() . $user->getFirstName();?></span><?php echo '';?>
                                    <span class="right">
                                        <strong>成员角色: </strong>
                                        <?php $userRoleId = ProjectPeer::checkUserRole($user->getUserId(), $project->getId());?>
                                        <select class="w100" name="projectRole[]" onChange="return optionChange(this);">
                                            <option  value="0"><?php echo __('选择角色');?></option>
                                            <?php foreach($projectRoles as $projectRole):?>
                                                <?php if($userRoleId == $projectRole->getId() ):?>
                                                <option selected="selected" value="<?php echo $projectRole->getId();?>"><?php echo $projectRole->getName();?></option>
                                                <?php else:?>
                                                 <option  value="<?php echo $projectRole->getId();?>"><?php echo $projectRole->getName();?></option>
                                                <?php endif; ?>
                                            <?php endforeach;?>
                                        </select>
                                        <input type="hidden" class="userClass" name="userId[]" id="muser_<?php echo $user->getUserId();?>" value="<?php echo $user->getUserId();?>" />
                                        <?php if($userRoleId == ProjectRolePeer::CUSTOME_ROLE):?>
                                        <?php $otherRoleName = ProjectPeer::getProjectMemberOtherRoleName($user->getUserId(), $project->getId());?>
                                        <input type="text" id="otherRole_<?php echo $user->getUserId();?>" name="otherRole[<?php echo $user->getUserId();?>]" value="<?php echo $otherRoleName;?>" class="txt w60" />
                                        <?php endif?>
                                        <a title="点击删除" href="javascript:void(0);" onclick="javascript:removeOption(this);" id='<?php echo $user->getUserId()?>' data-name='<?php echo  $user->getLastName() . $user->getFirstName();?>'><?php echo __('删除成员');?></a>
                                    </span>
                                    </li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                            <?php endif;?>
                       <?php endforeach;?>
                        </div>
                    </div>

                    <div class="clear"></div>
                    <div class="btn_con mt15">
                        <div class="btns clearfix">
                        <?php if(!$project->getIsProjectEnd()){?>
                            <input type="submit" onclick="return checkForm();" value="<?php echo __('保存');?>" class="btn_blue" />
                        <?php }?>
                            <a href="<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("keywords", "type") )); ?>" class="btn_blue jump"><?php echo __('返回');?></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
<?php
if(($project->getType() == ProjectPeer::INNER_PROJECT)){
    $str = '<strong>成员角色: </strong> <select class="w100" name="projectRole[]" onChange="return optionChange(this);">';
        $str .='<option value="0">选择角色</option>';
        foreach($projectRoles as $projectRole){
            $str .='<option value="' . $projectRole->getId() .'">'. $projectRole->getName() .'</option>';
        }
    $str .= '</select>';
}else{
    $str = '';
}
?>
<script type="text/javascript">
var options = '<?php echo $str;?>';
$(function(){
    $( ".accordion" ).exAccordion();
    setSearchType( 'keywords' );

    $('.span_right').each(function(){
        if($(this).text()!= '0'){
            $(this).parent().next('div').css('display', 'block');
        }
    });

    $('.search_btn , #btn_search').click(function(){
        $('.lleft').css('display', 'none');
        var searchIndex = 0;
        var keyWords = $('#keywords').val();
        keyWords = $.trim(keyWords);
        if(keyWords == '' || keyWords == '搜索用户'){
            $("#keyError").html('请输入需要查询的用户关键字！');
            return false;
        }
        $('.lleft li').each(function(){
            $(this).css('background', '');
            var name = $(this).text();
            if(keyWords != '' && name.indexOf(keyWords) != -1){
                var pid =$(this).parent().parent().attr('id');
                pid = pid.substr(6);
                $('#lleft_' + pid) . css('display', 'block');
                $(this).css('background', 'yellow');
                searchIndex = 1;
            }
        });
        if(searchIndex == 1){
            $("#keyError").html('');
        }else{
            $("#keyError").html('没有找到相关记录！');
        }
        return false;
    });

    var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '1'){
        showSaveSuccessfullyMessage( null, "<?php echo url_for('project/index?' . html_entity_decode(formGetQuery("keywords", "type") ) ); ?>" );
    }
    $(".jump").leaveCheck({formId:'userList',formUrl:'<?php echo url_for("projectMember/checkMember"); ?>'});
})


function addOption(obj){
    var str = '';
    var leftParent = $(obj).parent().parent().parent().attr('id');
    leftParentId = leftParent.substr(6);
    var userName = $(obj).text();
    var userId = $(obj).attr('id');
    var dele=' <a href="javascript:void(0);" title="点击移除" data-name="'+ userName +'" onclick="removeOption(this);" id="' + userId +'">删除成员</a>';
    //var roleInput = '<input type="text" id="otherRole" name="otherRole[]" value="" class="txt w60" />';
    var input = '<input class="userClass" type="hidden" name="userId[]" id=muser_' + userId + ' value="' + userId +'" />';
    str += '<li class="muser" id=muser_' + userId + '><span>' + userName + '</span><span class="right">' + options + dele + input +'</span></li>';
    var str = $(str);
    $("#" + 'right_' + leftParentId ).find('ul').append(str);
    $("#" + 'right_' + leftParentId ).show();
    $("#user_" + userId).remove();

    //var flag = '<?php //echo $project->getPhase();?>';
    //if(flag == '1'){
        //$('#otherRole').remove();
    //}
}

function optionChange(obj){
    var userId = $(obj).siblings('.userClass').attr('id').substr(6);
    var roleInput = $('<input type="text" id="otherRole_' +userId + '"name="otherRole[' + userId + ']" value="" class="txt w60" />');
    var customRole = '<?php echo ProjectRolePeer::CUSTOME_ROLE;?>';
    if($(obj).val() == customRole){
        roleInput.insertBefore($(obj).siblings('.userClass'));
    }else{
        $(obj).siblings('#otherRole_' + userId).remove();
    }
}
function checkForm(){
    var data = $('#userList').serialize();
    var obj = $.ajax({
        type: "POST",
        url: '<?php echo url_for("project/checkProjectMember");?>',
        async: false,
        data: $('#userList').serialize(),
        success: function(msgs) {
            if(msgs == '1'){
                $("#keyError").html('请为项目成员指定一个角色。如果下拉列表中的角色均不合适，请选择自定义角色，然后输入项目中的角色');
            }
            if(msgs == '2'){
                $("#keyError").html('项目经理必须存在');
            }
            if(msgs == '3'){
                $("#keyError").html('项目经理只能有一个人');
            }
            if(msgs == '4'){
                $("#keyError").html('项目角色不能重复，请重新选择');
            }
        }
    });
    if(obj.responseText != '0'){
        return false;
    }
    return true; 
}
</script>
