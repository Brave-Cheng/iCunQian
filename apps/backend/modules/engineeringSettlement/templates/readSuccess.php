<?php include_partial('global/datetimepicker_path'); ?>
<div id="main" class="clearfix">
<div class="full_width">
    <div class="bread_crumbs"> <a href="<?php echo url_for('commitApproval/index'); ?>">审批流程</a> &gt; 查看审批</div>
    <a class="btn_blue right mt5 mr5" target="_blank"  href="<?php echo url_for('engineeringSettlement/print?' . html_entity_decode(formGetQuery("approvalType", "id", "projectType", "keywords", "applicationId", "approvalId")))?>"><?php echo __("打印预览")?></a>
    <div class="formDiv pro_form">
        <h2 class="title">工程量结算表-总表</h2>
        <div class="clearfix item_1">
            <div class="left w540">
                <div class="formItem">
                    <label class="label">
                        项目名称：
                    </label>
                    <div class="iner lh30">
                        <?php echo $application->getProject()->getName(); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        施工单位：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement->getConstructionUnit(); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        截止日期：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement->getExpirationDate(); ?>
                    </div>
                </div>
            </div>
            <div class="right w300">
                <div class="formItem">
                    <label class="label">
                        合同号：
                    </label>
                    <div class="iner lh30">
                        <?php echo htmlspecialchars($engineeringSettlement->getContractNumber()); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        期  号：
                    </label>
                    <div class="iner lh30">
                        <?php echo htmlspecialchars($engineeringSettlement->getIssue()); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        金额单位：
                    </label>
                    <div class="iner lh30">
                        人民币元
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix item_2">
            <div class="left w300">
                <div class="formItem">
                    <label class="label">
                        合同金额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getContractAmount(), '2') : ''?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        本期完成工程额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement->getCurrentCompleteEngineering(); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        累计完成工程总额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement->getTotalCompleteEngineering(); ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        已支付(预付)金额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getPrepayment(), '2') : ''  ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label ">
                        本次申请支付金额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ? util::formattingNumbers($engineeringSettlement->getApplyPayment(), '2') : '' ?>
                    </div>
                </div>
            </div>
            <div class="left w300">
                <div class="formItem">
                    <label class="label">
                        变更金额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getChangeAmount(), '2') : '' ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        本次扣保留金  %：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ? util::formattingNumbers($engineeringSettlement->getCurrentFastenerRetention(), '2') : '' ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        累计扣保留金  %：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ? util::formattingNumbers($engineeringSettlement->getTotalFastenerRetention(), '2') : ''?>
                    </div>
                </div>
            </div>
            <div class="right w300">
                <div class="formItem">
                    <label class="label">
                        变更后金额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getChangedAmount(), '2') : '' ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        本期应付金额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getCurrentPayable(), '2') : '' ?>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        累计应支付金额：
                    </label>
                    <div class="iner lh30">
                        <?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getTotalPayable(), '2') : ''?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix mt15 ml20 mr20">
            <div class="left">
                <div class="formItem">
                    <span class="blue"><strong>制表人：</strong></span>
                    <div class="inblock"><?php echo htmlspecialchars($application->getSfGuardUser()->getProfile()->getLastName()) . htmlspecialchars($application->getSfGuardUser()->getProfile()->getFirstName()); ?></div>
                </div>
            </div>
            <div class="right">
                <div class="formItem">
                    <span class="blue"><strong>制表日期：</strong></span>
                    <div class="inblock"><?php echo date('Y-m-d'); ?></div>
                </div>
            </div>
        </div>
        <div class="tables ex_tabs">
            <?php include_partial('global/approveresultpartial', array('applicationResults' => $applicationResults, 'application' => $application)) ?>
        </div>
        <div class="btn_con">
            <div class="btns clearfix w60">
                <a href="<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery("projectType", "keywords", "id", "approvalType"))); ?>" class="btn_blue">返回</a>
            </div>
        </div>
    </div>
</div>
</div>