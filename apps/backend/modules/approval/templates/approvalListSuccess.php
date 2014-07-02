<?php include_partial('global/confirm'); ?>
<?php echo javascript_include_tag('comm'); ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('approval/approvalList'); ?>"><?php echo __('审批管理'); ?></a> &gt; <span><?php echo __('审批列表'); ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
        <div class="btns mb10 clearfix">
            <a href="<?php echo url_for('approval/addApproval'); ?>" class="btn_blue"><?php echo __('创建审批'); ?></a>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'approvalList', this.href)" href='<?php echo url_for("approval/deleteApproval"); ?>'><?php echo __('批量删除'); ?></a>
            <?php
                if( $sf_request->hasParameter("msg") ){
                    if( $sf_request->getParameter("msg") == 1 ){
                        echo "<span class='error lh30'>删除成功</span>";
                    }else if( $sf_request->getParameter("msg") == 0 ){
                        echo "<span class='error lh30'>请选择要删除的流程</span>";
                    }
                }
            ?>
        </div>
    </div>
    <div class="tables ex_tabs">
        <form aciton="<?php echo url_for('approval/deleteApproval'); ?>" method='post' id='approvalList' />
        <div class="tab-item on">
            <table>
                <thead>
                    <tr>
                        <td class="w20 alignCenter"><input type="checkbox" class="cboxAll" /></td>
                        <td><?php echo __('流程名称'); ?></td>
                        <td class="w120"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $approvals as $numericalSubscript => $approval ){ ?>
                    <tr <?php if( $numericalSubscript%2 ){ echo "class='odd'"; } ?>>
                        <td class="alignCenter"><input type="checkbox" name='deleteId[]' class="cbox" value="<?php echo $approval->getId(); ?>"/></td>
                        <td><?php echo htmlspecialchars( $approval->getName() ); ?></td>
                        <td class="operate">
                            <a href='<?php echo url_for( "approval/editApproval?id=" . $approval->getId() ); ?>'><?php echo __('编辑审批'); ?></a><br/>
                            <a href='<?php echo url_for( "approval/workflowList?id=" . $approval->getId() ); ?>'><?php echo __('审批步骤管理'); ?></a><br/>
                            <a onclick="return showDeleteConfirmMessage(null, '', this.href)" href='<?php echo url_for("approval/deleteApproval?deleteId=" . $approval->getId()); ?>'><?php echo __('删除流程'); ?></a>
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
            <a href="<?php echo url_for('approval/addApproval'); ?>" class="btn_blue"><?php echo __('创建审批'); ?></a>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'approvalList', this.href)" href='<?php echo url_for("approval/deleteApproval") ?>'><?php echo __('批量删除'); ?></a>
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