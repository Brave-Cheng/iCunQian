<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('approval/approvalList'); ?>"><?php echo __('审批管理'); ?></a> &gt; <span><?php echo __('审批步骤管理'); ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
        <div class="btns mb10 clearfix">
            <a href="<?php echo url_for('approval/addWorkflow?approvalId=' . $sf_request->getParameter('id')); ?>" class="btn_blue"><?php echo __('添加新步骤'); ?></a>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'workflowList', this.href)" href='<?php echo url_for("approval/deleteWorkflow"); ?>'><?php echo __('批量删除'); ?></a>
            <a class="btn_blue" href='<?php echo url_for("approval/approvalList"); ?>'><?php echo __('返回'); ?></a>
            <?php
                if( $sf_request->hasParameter("msg") ){
                    if( $sf_request->getParameter("msg") == 1 ){
                        echo "<span class='error lh30'>删除成功</span>";
                    }else if( $sf_request->getParameter("msg") == 0 ){
                        echo "<span class='error lh30'>请选择要删除的步骤</span>";
                    }
                }
            ?>
        </div>
    </div>
    <div>
        您当前查看的是：<?php echo $approval->getName(); ?>
    </div>
    <div class="tables ex_tabs">
        <form aciton="<?php echo url_for('approval/delete'); ?>" method='post' id='workflowList' />
        <input type="hidden" value="<?php echo $approval->getId(); ?>" name="approvalId" />
        <div class="tab-item on">
            <table>
                <thead>
                    <tr>
                        <td class="w20 alignCenter"><input type="checkbox" class="cboxAll" /></td>
                        <td class="w60"><?php echo __('步骤排序'); ?></td>
                        <td><?php echo __('步骤描述'); ?></td>
                        <td class="w80"><?php echo __('是否关联项目'); ?></td>
                        <td class="w180"><?php echo __('审核人'); ?></td>
                        <td class="w80"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $c = new Criteria(); $c->addAscendingOrderByColumn(WorkflowPeer::SORT_ORDER); foreach( $approval->getWorkflows( $c ) as $numericalSubscript => $workflow ){ ?>
                    <tr <?php if( $numericalSubscript%2 ){ echo "class='odd'"; } ?>>
                        <td class="alignCenter"><input type="checkbox" name='deleteId[]' class="cbox" value="<?php echo $workflow->getId(); ?>"/></td>
                        <td><?php echo htmlspecialchars( $workflow->getSortOrder() ); ?></td>
                        <td><?php echo htmlspecialchars( $workflow->getDescription() ); ?></td>
                        <td><?php if( $workflow->getIsProjectRole() == '0' ){ echo __('否'); }else{ echo __('是'); } ?></td>
                        <td>
                        <?php
                            if( $workflow->getIsProjectRole() == '0' ){
                                $departmentName = $workflow->getDepartmentId() ? DepartmentPeer::retrieveByPK( $workflow->getDepartmentId() )->getName() : null ;
                                $titleName = $workflow->getTitleId() ? TitlePeer::retrieveByPK( $workflow->getTitleId() )->getName() : null;
                                echo htmlspecialchars( $departmentName . ' ' . $titleName );
                            }else{
                                echo htmlspecialchars(ProjectRolePeer::retrieveByPK( $workflow->getProjectRoleId() ) ? ProjectRolePeer::retrieveByPK( $workflow->getProjectRoleId() )->getName() : '' );
                            }
                        ?>
                        </td>
                        <td class="operate">
                            <a href='<?php echo url_for( "approval/editWorkflow?workflowId=" . $workflow->getId() . "&approvalId=" . $sf_request->getParameter('id') ); ?>'><?php echo __('编辑'); ?></a> /
                            <a onclick="return showDeleteConfirmMessage(null, '', this.href)" href='<?php echo url_for( "approval/deleteWorkflow?deleteId=" . $workflow->getId() .'&approvalId=' . $approval->getId() );?>'><?php echo __('删除'); ?></a>
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
            <a href="<?php echo url_for('approval/addWorkflow?approvalId=' . $sf_request->getParameter('id')); ?>" class="btn_blue"><?php echo __('添加新步骤'); ?></a>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'workflowList', this.href)" href='<?php echo url_for("approval/deleteWorkflow"); ?>'><?php echo __('批量删除'); ?></a>
            <a class="btn_blue" href='<?php echo url_for("approval/approvalList"); ?>'><?php echo __('返回'); ?></a>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var msg = '<?php echo $sf_request->getParameter("msg");?>';
        if(msg == '3'){
            showSaveSuccessfullyMessage( null, null );
        }
    })
</script>