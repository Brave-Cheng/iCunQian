<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js'); ?>
<form action="<?php echo url_for('approval/updateWorkflow'); ?>" method="post" id="workflow" >
<?php
    if($workflow){
        echo "<input name='workflowId' value='" . $workflow->getId() . "' type='hidden' />";
    }
?>
<input name='approvalId' value='<?php echo $approval->getId(); ?>' type='hidden' />
<div id="content" class="right">
    <div class="bread_crumbs"> <a class="jump" href="<?php echo url_for('approval/approvalList'); ?>"><?php echo __('审批管理'); ?></a> &gt; <a href="<?php echo url_for('approval/workflowList?id='. $approval->getId() ); ?>"><?php echo __('审批步骤管理'); ?></a> &gt; <span> <?php echo __('编辑审批步骤') ?></span> </div>
    <div class="box">
        <div class="formDiv">
            <div class="formItem">
                <label class="label">
                    <?php echo __('您当前编辑的是'); ?>：
                </label>
                <div>
                    <input class="w160 disabled" type="text" name="approvalName" value="<?php echo htmlspecialchars( $approval->getName() ); ?>"/>
                </div>
            </div>
            <div class="formItem">
                <label class="label">
                    <?php echo __('步骤排序'); ?>：
                </label>
                <div>
                    <input class="w40" type="text" name="sortOrder" value="<?php echo $workflow ? $workflow->getSortOrder() : ''; ?>"/>
                    <span class="error"><?php echo __(form_span_error("sortOrder")); ?></span>
                </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('描述'); ?>：</label>
                <div>
                    <textarea name="description" class="w365 h100 textarea"><?php echo $workflow ? $workflow->getDescription() : ''; ?></textarea>
                    <span class="error"><?php echo __(form_span_error("description")); ?></span>
                </div>
            </div>
            <div class="formItem">
                <label class="label"><?php echo __('是否关联项目'); ?>：</label>
                <div>
                    <select name="is_project_role" class="project_role">
                        <option value='' ><?php echo __('请选择'); ?></option>
                        <option value='1' <?php if($sf_request->getParameter('is_project_role') == '1'){ echo 'selected="true"'; } ?>><?php echo __('是'); ?></option>
                        <option value='0' <?php if($sf_request->getParameter('is_project_role') == '0'){ echo 'selected="true"'; } ?>><?php echo __('否'); ?></option>
                    </select>
                    <span class="error"><?php echo __(form_span_error("is_project_role")); ?></span>
                </div>
            </div>
        </div>
        <div class="btn_con mt10">
            <div class="btns clearfix">
                <input type="submit" value="保存" class="btn_blue" />
                <a href="<?php echo url_for('approval/workflowList?id=' . $approval->getId()); ?>" class="btn_blue jump"><?php echo __('放弃'); ?></a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        function showSelect(){
            if( $('.project_role').val() == '1'){
                var formItem = $( '<div>' );
                    formItem.attr( 'class', 'formItem' ).appendTo( $('.formDiv') );
                var label = $('<label>');
                    label.attr( 'class', 'label project_role_label' ).text( '项目角色：' ).appendTo( formItem );
                var roleSelect = $('<select>');
                    roleSelect.attr({'class':'roleSelect', 'name':'project_role_id'}).appendTo( formItem );
                $.post("<?php echo url_for('approval/getProjectRoles'); ?>", function(data){
                        for(i in data){
                            var option = $( '<option>' );
                                option.attr( 'value', i ).text( data[i] ).appendTo( $('.roleSelect') );
                                <?php
                                if(isset($workflow)){
                                    if($workflow->getIsProjectRole() == "1"){
                                ?>
                                        if(<?php echo $workflow->getProjectRoleId(); ?> == i){
                                            option.attr('selected', 'true');
                                        }
                                <?php
                                    }
                                }
                                ?>
                        }
                        $(".roleSelect").sSelect();
                }, "json");

            }
            if( $('.project_role').val() == '0' ){
                var formItem = $( '<div>' );
                    formItem.attr( 'class', 'formItem' ).appendTo( $('.formDiv') );
                var label = $('<label>');
                    label.attr( 'class', 'label project_role_label' ).text( '部门：' ).appendTo( formItem );
                var departmentSelect = $('<select>');
                    departmentSelect.attr({'class':'departmentSelect', 'name':'departmentId'}).appendTo( formItem );
                $.post("<?php echo url_for('approval/getDepartmentNames'); ?>", function(data){
                        for(i in data){
                            var option = $( '<option>' );
                                option.attr( 'value', i ).text( data[i] ).appendTo( $('.departmentSelect') );
                                <?php
                                if(isset($workflow)){
                                    if($workflow->getIsProjectRole() == "0"){
                                ?>
                                        if('<?php echo $workflow->getDepartmentId(); ?>' == i){
                                            option.attr('selected', 'true');
                                        }
                                <?php
                                    }
                                }
                                ?>
                        }
                        $(".departmentSelect").sSelect();
                }, "json");
                var formItem = $( '<div>' );
                    formItem.attr( 'class', 'formItem' ).appendTo( $('.formDiv') );
                var label = $('<label>');
                    label.attr( 'class', 'label' ).text( '头衔：' ).appendTo( formItem );
                var titleSelect = $('<select>');
                    titleSelect.attr({'class':'titleSelect', 'name':'titleId'}).appendTo( formItem );
                $.post("<?php echo url_for('approval/getTitleNames'); ?>", function(data){
                        for(i in data){
                            var option = $( '<option>' );
                                option.attr( 'value', i ).text( data[i] ).appendTo( $('.titleSelect') );
                                <?php
                                if(isset($workflow)){
                                    if($workflow->getIsProjectRole() == "0"){
                                ?>
                                        if(<?php echo $workflow->getTitleId(); ?> == i){
                                            option.attr('selected', 'true');
                                        }
                                <?php
                                    }
                                }
                                ?>
                        }
                        $(".titleSelect").sSelect();
                }, "json");
            }
        }
        $( '.project_role' ).change(function(){
            $(this).parent().parent().parent().nextAll().remove();
            showSelect();
        })
        
        <?php if(isset($workflow)){?>
            <?php if($workflow->getIsProjectRole() == '1'){ ?>
                $('.project_role option[value="1"]').attr('selected', 'true');
                showSelect();
            <?php } ?>
            <?php if($workflow->getIsProjectRole() == '0'){ ?>
                $('.project_role option[value="0"]').attr('selected', 'true');
                showSelect();
            <?php } ?>
        <?php } ?>
        
        $(".project_role").sSelect();

        $(".jump").leaveCheck({formId:'workflow',formUrl:'<?php echo url_for("approval/workflowLeaveCheck"); ?>'});
    })
</script>