<?php if (ApplicationWorkFlowPeer::checkUserShowApproval($sf_user->getGuardUser()->getId(), $application->getApprovalId(), $application->getProjectId(), $application->getDepartmentId()) || $sf_user->isSuperAdmin() || $sf_user->getGuardUser()->getId() == $application->getSfGuardUserId()): ?>
<div class="formDiv line_top">
        <?php if (WorkflowPeer::checkApplicationIsApproved($application->getApprovalId(), $application->getId())): ?>
            <p class="mb10 blue"><strong>前序审批情况如下：</strong></p>
        <?php endif; ?>
        <?php if ($applicationResults): ?>
            <table class="table_list_1">
                <?php foreach ($applicationResults as $applicationResult): ?>
                    <?php $nextApprover = WorkflowPeer::getNextApprover($applicationResult->getWorkflowId(), $applicationResult->getApplication()->getApprovalId(), $applicationResult->getApplication()->getProjectId(),$application->getDepartmentId()); ?>
                    <!--审批已经有结果 start-->
                    <?php if ($applicationResult->getApprovalResult()): ?>
                        <tr>
                            <td class="w160 alignRight">
                                <?php echo '<strong>' . WorkflowPeer::getCurrentStepApproverRole($applicationResult->getWorkflowId(), $applicationResult->getApplication()->getDepartmentId()) . '</strong>' ?>：
                            </td>
                            <td class="w160 alignRight">
                                <?php
                                $approver = WorkflowPeer::getCurrentStepApprover($applicationResult->getWorkflowId(), $applicationResult->getApplication()->getProjectId(),$applicationResult->getApplication()->getDepartmentId());
                                echo $approver->getProfile()->getLastName() . $approver->getProfile()->getFirstName();
                                ?>
                            </td>
                            <td class="w60 alignCenter">
                                <?php 
                                switch ( $applicationResult->getApprovalResult() ) {
                                    case 1:
                                        echo '<img class="mt3" src="/images/approval.png" alt="同意" title="同意">';
                                        break;
                                    case 3:
                                        echo '<img class="mt3" src="/images/agree.png" alt="通过" title="通过">';
                                        break;
                                    case 2:
                                        echo '<img class="mt3" src="/images/decline.png" alt="驳回" title="驳回">';
                                        break;
                                }
                                ?>
                            </td>
                            <td class="w100 alignLeft"><?php echo date('Y-m-d',  strtotime($applicationResult->getApprovalTime()))?> </td>
                            <td>
                                <span><?php echo $applicationResult->getApprovalComment(); ?></span>
                            </td>   
                        </tr>
                        <!--审批已经有结果 end-->
                    <?php else: ?>
                        <!--审批暂无结果 start-->
                        <?php if ($sf_user->getGuardUser()->getId() == $applicationResult->getSfGuardUser()->getId()): ?>
                            <tr><td colspan="5">
                                    <div class="formItem">
                                        <label class="label"><?php echo __('您的意见') ?>：
                                        </label>
                                        <div class="iner">
                                            <textarea class="textarea" name="approvalComment" id="approvalComment"></textarea>
                                        </div>
                                    </div>
                                    <?php if ($nextApprover): ?>
                                        <div class="formItem">
                                            <label class="label"><?php echo __('下一步审批人') ?>：
                                            </label>
                                            <div class="iner lh30">
                                                <?php echo $nextApprover->getProfile()->getLastName() . $nextApprover->getProfile()->getFirstName(); ?>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <div class="left"><a href="javascript:void(0);" onclick="return saveApplication('<?php echo $applicationResult->getApplicationId(); ?>', '<?php echo $applicationResult->getWorkflowId(); ?>', 1);" class="btn_blue btn">同意</a></div>
                                            <div class="w100 right ml10"><a href="javascript:void(0);" onclick="return saveApplication('<?php echo $applicationResult->getApplicationId(); ?>', '<?php echo $applicationResult->getWorkflowId(); ?>', 2);" class="btn_blue btn">驳回</a></div>
                                        </div>
                                    <?php else: ?>
                                        <div class="clearfix">
                                            <div class="left"><a href="javascript:void(0);" onclick="return saveApplication('<?php echo $applicationResult->getApplicationId(); ?>', '<?php echo $applicationResult->getWorkflowId(); ?>', 3);" class="btn_blue btn">同意</a></div>
                                            <div class="w100 right ml10"><a href="javascript:void(0);" onclick="return saveApplication('<?php echo $applicationResult->getApplicationId(); ?>', '<?php echo $applicationResult->getWorkflowId(); ?>', 2);" class="btn_blue btn">驳回</a></div>
                                        </div>
                                    <?php endif; ?>
                                </td></tr>
                        <?php endif; ?>
                        <!--审批暂无结果 end-->
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

    </div>
    <script type="text/javascript">
        function saveApplication(applicationId, workflowId, result) {
            $('#comment_error').remove();
            var comments = $.trim($('#approvalComment').val());
            if (comments == '') {
                $('#approvalComment').after('<div id="comment_error" style="color:red">审批意见不能为空</div>');
                return false;
            }
            $.get('<?php echo url_for("commitApproval/updateApplication") ?>', {applicationId: applicationId, workflowId: workflowId, approvalResult: result, approvalComment: comments}, function(msg) {

                if (msg.error != '1' && msg.error != '2') {
                    showSaveSuccessfullyMessage(msg.msg);
                }
                if (msg.error == '2') {
                    $('#approvalComment').after('<div id="comment_error" style="color:red">' + msg.msg + '</div>');
                }
                if (msg.error == '1') {
                    showSaveSuccessfullyMessage('操作成功', "<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery("projectType", "keywords", "applicationId", "approvalId"))); ?>");
                }


            }, 'json');

        }
    </script>
<?php endif; ?>