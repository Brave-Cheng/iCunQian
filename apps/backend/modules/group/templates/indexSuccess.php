<?php include_partial('global/confirm'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('group/index'); ?>"><?php echo __('用户组管理') ?></a> &gt; <span><?php echo __('列表页') ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
        <div class="btns mb10 clearfix">
            <a href="<?php echo url_for('group/add'); ?>" class="btn_blue"><?php echo __('创建用户组') ?></a>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'groupList', this.href)" href='<?php echo url_for("group/delete") ?>'><?php echo __('批量删除') ?></a>
            <?php
                if( $sf_request->hasParameter("msg") ){
                    if( $sf_request->getParameter("msg") == 1 ){
                        echo "<span class='error lh30'>删除成功</span>";
                    }else if( $sf_request->getParameter("msg") == 0 ){
                        echo "<span class='error lh30'>请选择要删除的用户组</span>";
                    }
                }
            ?>
        </div>
    </div>
    <div class="tables ex_tabs">
        <form aciton="<?php echo url_for('group/delete'); ?>" method='post' id='groupList' />
        <div class="tab-item on">
            <table>
                <thead>
                    <tr>
                        <td class="w40 alignCenter"><input type="checkbox" class="cboxAll" /></td>
                        <td class="w140"><?php echo __('用户组组名称') ?></td>
                        <td><?php echo __('用户组描述') ?></td>
                        <td class="w80"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($groups as $int => $group) { ?>
                    <tr <?php if( $int%2 ){ echo "class='odd'"; } ?>>
                        <td class='alignCenter'><input type="checkbox" name='deleteId[]' class="cbox" value="<?php echo $group->getId(); ?>"/></td>
                        <td><?php echo htmlspecialchars( $group->getName() ); ?></td>
                        <td><?php echo htmlspecialchars( $group->getDescription() ); ?></td>
                        <td class="operate">
                            <a href='<?php echo url_for("group/edit?id=" . $group->getId()); ?>'><?php echo __('编辑') ?></a> <br/>
                            <a href='<?php echo url_for("group/setPermission?id=" . $group->getId()); ?>'><?php echo __('设置组权限') ?></a> <br/>
                            <a onclick="return showDeleteConfirmMessage(null, 'groupList', this.href)" href='<?php echo url_for("group/delete?deleteId=" . $group->getId()); ?>'><?php echo __('删除') ?></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </form>
    </div>
    <div class="btn_con">
        <div class="btns clearfix">
            <a href="<?php echo url_for('group/add'); ?>" class="btn_blue"><?php echo __('创建用户组') ?></a>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'groupList', this.href)" href='<?php echo url_for("group/delte"); ?>'><?php echo __('批量删除') ?></a>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    var msg = '<?php echo $sf_request->getParameter("msg");?>';
    if(msg == '2'){
        showSaveSuccessfullyMessage(null);
    }
</script>