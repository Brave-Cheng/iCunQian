<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="#"><?php echo __('权限管理') ?></a> &gt; <span><?php echo __('列表页') ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
        <div class="btns mb10 clearfix">
            <a href="<?php echo url_for('permission/insert'); ?>" class="btn_blue"><?php echo __('创建权限') ?></a>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'permissionList', this.href)" href='<?php echo url_for("permission/delete") ?>'><?php echo __('批量删除') ?></a>
            <?php
                if( $sf_request->hasParameter("msg") ){
                    if( $sf_request->getParameter("msg") == 1 ){
                        echo "<span class='error lh30'>删除成功</span>";
                    }else if( $sf_request->getParameter("msg") == 0 ){
                        echo "<span class='error lh30'>请选择要删除的权限</span>";
                    }
                }
            ?>
        </div>
    </div>
    <div class="tables ex_tabs">
        <form aciton="<?php echo url_for('user/delete'); ?>" method='post' id='permissionList' />
        <div class="tab-item on">
            <table>
                <thead>
                    <tr>
                        <td class="w20"><input type="checkbox" class="cboxAll" /></td>
                        <td class="w60"><?php echo __('权限名称') ?></td>
                        <td class="w140"><?php echo __('权限描述') ?></td>
                        <td class="w60"><?php echo __('模块名') ?></td>
                        <td class="w60"><?php echo __('排序') ?></td>
                        <td class="w90"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($permissions as $int => $permission) { ?>
                    <tr <?php if( $int%2 && $permission->getActionName() != null ){ echo "class='odd red'"; }else if($permission->getActionName() != null){ echo "class='red'"; }else if($int%2){ echo "class='odd'"; } ?> >
                        <td><input type="checkbox" name='deleteId[]' class="cbox" value="<?php echo $permission->getId(); ?>"/></td>
                        <td><?php echo htmlspecialchars( $permission->getName() ); ?></td>
                        <td><?php echo htmlspecialchars( $permission->getDescription() ); ?></td>
                        <td><?php echo $permission->getModuleName(); ?></td>
                        <td><?php echo $permission->getSortOrder(); ?></td>
                        <td class="operate">
                            <a href='<?php echo url_for('permission/edit?id=' . $permission->getId() ) ?>'><?php echo __('编辑') ?></a> /
                            <a onclick="return showDeleteConfirmMessage(null, '', this.href)" href='<?php echo url_for('permission/delete?deleteId=' . $permission->getId()) ?>'><?php echo __('删除') ?></a>
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
            <a href="<?php echo url_for('permission/insert'); ?>" class="btn_blue"><?php echo __('创建权限') ?></a>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'permissionList', this.href)" href='<?php echo url_for("permission/delete") ?>'><?php echo __('批量删除') ?></a>
        </div>
    </div>
    </div>
</div>