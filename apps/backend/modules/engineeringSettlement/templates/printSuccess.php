<div class="wrap">
<div id="full_print" class="full_width">
    <div class="formDiv pro_form">
        <h2 class="title">工程量结算表-总表</h2>
        <div class="clearfix item_1">
            <div class="left w400">
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
            <div class="right w400">
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
        <div class="clearfix mt15">
            <div class="left w400">
                <div class="formItem">
                    <label class="label">制表人：</label>
                    <div class="iner lh30"><?php echo htmlspecialchars($application->getSfGuardUser()->getProfile()->getLastName()) . htmlspecialchars($application->getSfGuardUser()->getProfile()->getFirstName()); ?></div>
                </div>
            </div>
            <div class="right w400">
                <div class="formItem">
                    <label class="label">制表日期：</label>
                    <div class="iner lh30"><?php echo date('Y-m-d'); ?></div>
                </div>
            </div>
        </div>
        <?php include_partial('global/printPartial', array('id' => $sf_params->get('id'))) ?>
    </div>
</div>
</div>