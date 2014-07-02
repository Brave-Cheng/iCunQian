<?php include_partial('global/confirm'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('group/index'); ?>"><?php echo __('用户组管理') ?></a> &gt; <span><?php echo __('列表页') ?></span>
    </div>
    <div class="box">
        <div class="btn_con">
            您当前编辑的是&nbsp;<?php echo htmlspecialchars( $group->getName() ); ?>组&nbsp;的权限
        </div>
        <div class="tables ex_tabs">
            <?php echo form_tag('group/updateGroupPermission', 'method=post') ?>
            <input type="text" name='groupId' class='hidden' value='<?php echo $group->getId(); ?>' />
            <div class="tab-item on">
                <table>
                    <thead>
                        <tr>
                            <td class="w140"><?php echo __('模块名称') ?></td>
                            <td class="w180"><?php echo __('权限描述') ?></td>
                            <td><?php echo __('是否允许访问'); ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($permissions as $int => $permission) { ?>
                        <tr <?php if( $int%2 ){ echo "class='odd'"; } ?>>
                            <td>
                                <?php echo $permission->getModuleName(); ?>
                            </td>
                            <td>
                                <?php echo $permission->getDescription(); ?>
                            </td>
                            <td>
                                <?php if(in_array($group->getId(), $permission->getSfGuardGroupPermissionGroupIdsByPermission())){ 
                                    echo '<select name="hasPermission_' . $permission->getId() . '" class="left"><option value="1" selected="selected">是</option><option value="0">否</option></select>';
                                }else{
                                    echo '<select name="hasPermission_' . $permission->getId() . '" class="left"><option value="1">是</option><option value="0" selected="selected">否</option></select>';
                                } ?>
                                <?php 
                                    $groupPermission = sfGuardGroupPermissionPeer::getGroupPermissionByPermissionIdGroupId( $permission->getId(), $group->getId() );
                                ?>
                                &nbsp;
                                <label class="check_label"><input value="checked" type="checkbox" <?php if($groupPermission->getAccessCreate()){ echo 'checked="true"'; } ?> name="create_<?php echo $permission->getId() ?>" />创建</label>
                                &nbsp;
                                <label class="check_label"><input value="checked" type="checkbox" <?php if($groupPermission->getAccessUpdate()){ echo 'checked="true"'; } ?> name="update_<?php echo $permission->getId() ?>" />更新</label>
                                &nbsp;
                                <label class="check_label"><input value="checked" type="checkbox" <?php if($groupPermission->getAccessRead()){ echo 'checked="true"'; } ?> name="read_<?php echo $permission->getId() ?>" />读取</label>
                                &nbsp;
                                <label class="check_label"><input value="checked" type="checkbox" <?php if($groupPermission->getAccessDelete()){ echo 'checked="true"'; } ?> name="delete_<?php echo $permission->getId() ?>" />删除</label>
                            </td>
                        </tr>
                        <?php } ?>
                    <thead>
                        <tr>
                            <td class="w140"><?php echo __('特殊权限') ?></td>
                            <td class="w180"><?php echo __('权限描述') ?></td>
                            <td><?php echo __('是否添加'); ?></td>
                        </tr>
                    </thead>
                        <?php foreach($specialPermissions as $specialPermission){ ?>
                        <tr>
                            <td><?php echo $specialPermission->getName(); ?></td>
                            <td><?php echo $specialPermission->getDescription(); ?></td>
                            <td colspan=3>
                                <input <?php if(in_array($specialPermission->getId(), $groupSpecialPermissionIds)){ echo "checked='checked'"; } ?> type='checkbox' name='specialPermission_<?php echo $specialPermission->getId(); ?>' value='checked' />
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="btn_con mt10">
                <div class="btns clearfix">
                    <input type="submit" value="保存" class="btn_blue" />
                    <a href="<?php echo url_for('group/index'); ?>" class="btn_blue"><?php echo __('放弃'); ?></a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var msg = '<?php echo $sf_request->getParameter("msg");?>';
    if(msg == '1'){
        showSaveSuccessfullyMessage(null, '<?php echo url_for($urlName); ?>');
    }
</script>