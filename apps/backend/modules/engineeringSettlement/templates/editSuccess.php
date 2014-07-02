<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<div id="main" class="clearfix">
<form id="engineeringSettlement" action="<?php  echo url_for('engineeringSettlement/update?' . html_entity_decode(formGetQuery("projectType", "keywords", "id", "approvalType"))); ?>" method="post" >
<input type="hidden" name="approvalType" value="<?php echo $sf_request->getParameter('approvalType'); ?>" />
<input type="hidden" name="engineeringSettlementId" value="<?php echo $engineeringSettlement ? $engineeringSettlement->getId() : '';  ?>" />
<input type="hidden" name="id" value="<?php echo $application ? $application->getId() : ''; ?>" />
<div class="full_width">
    <div class="bread_crumbs"> <a class="jump" href="<?php echo url_for('commitApproval/index'); ?>">审批流程</a> <?php if(!$application){ ?>&gt; 创建审批 &gt; <span>第二步：填写表单</span><?php }else{ ?>&gt; 编辑表单 <?php } ?> </div>
    <div class="formDiv pro_form">
        <h2 class="title">工程量结算表-总表</h2>
        <div class="clearfix item_1">
            <div class="left w540">
                <div class="formItem">
                    <label class="label">
                        项目名称：
                    </label>
                    <div class="iner">
                         <select class="w400 select" name="project_id">
                                <option value=''><?php echo __('请选择') ?></option>
                                <?php if ($application): ?>
                                    <?php echo objects_for_select($userProjects, 'getId', 'getName', $application->getProjectId()) ?>
                                <?php else: ?>
                                    <?php echo objects_for_select($userProjects, 'getId', 'getName') ?>
                                <?php endif; ?>
                            </select>
                        <div class="error"><?php echo __(form_span_error("project_id")); ?></div>
                    </div>
                    
                </div>
                <div class="formItem">
                    <label class="label">
                        施工单位：
                    </label>
                    <div class="iner">
                        <input name='construction_unit' type="text" class="txt w400" value="<?php echo $engineeringSettlement ? htmlspecialchars($engineeringSettlement->getConstructionUnit()) : ''; ?>" />
                        <div class="error"><?php echo __(form_span_error("construction_unit")); ?></div>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        截止日期：
                    </label>
                    <div class="iner">
                        <input type="text" readOnly  id="expirationDate" name='expiration_date' class="txt" value="<?php echo $engineeringSettlement ? $engineeringSettlement->getExpirationDate() : ''; ?>" />
                        <span class="operation"><a href="javascript:void(0);" title="<?php echo __('清除')?>" onclick="$('#expirationDate').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                        <div class="error"><?php echo __(form_span_error("expiration_date")); ?></div>
                    </div>
                </div>
            </div>
            <div class="right w300">
                <div class="formItem">
                    <label class="label">
                        合同号：
                    </label>
                    <div class="iner">
                        <input name="contract_number" type="text" class="txt" value="<?php echo $engineeringSettlement ? htmlspecialchars($engineeringSettlement->getContractNumber()) : ''; ?>" />
                        <div class="error"><?php echo __(form_span_error("contract_number")); ?></div>
                    </div>
                </div>
                <div class="formItem">
                    <label class="label">
                        期  号：
                    </label>
                    <div class="iner">
                        <input name="issue" type="text" class="txt" value="<?php echo $engineeringSettlement ? htmlspecialchars($engineeringSettlement->getIssue()) : ''; ?>" />
                        <div class="error"><?php echo __(form_span_error("issue")); ?></div>
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
            <table class="v_top">
                <tr>
                    <td width="300">
                        <div class="formItem">
                            <label class="label">
                                合同金额：
                            </label>
                            <div class="iner">
                                <input name="contract_amount" type="text" class="txt amount current_amount" value="<?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getContractAmount(), '4') : ''?>" />
                                <div class="error"><?php echo __(form_span_error("contract_amount")); ?></div>
                            </div>
                        </div>
                    </td>
                    <td width="300">
                        <div class="formItem">
                            <label class="label">
                                变更金额：
                            </label>
                            <div class="iner">
                                <input name="change_amount" type="text" class="txt amount change_amount" value="<?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getChangeAmount(), '4') : ''?>" />
                                <div class="error"><?php echo __(form_span_error("change_amount")); ?></div>
                                </div>
                        </div>
                    </td>
                    <td>
                        <div class="formItem">
                            <label class="label">
                                变更后金额： 
                            </label>
                            <div class="iner">
                                <input readOnly name="changed_amount" type="text" class="txt disabled changed_amount" value="<?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getChangedAmount(), '4') : '' ?>" />
                                <div class="error"><?php echo __(form_span_error("changed_amount")); ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="formItem">
                            <label class="label">
                                本期完成工程额：
                            </label>
                            <div class="iner">
                                <input name="current_complete_engineering" type="text" class="txt" value="<?php echo $engineeringSettlement ? $engineeringSettlement->getCurrentCompleteEngineering() : ''; ?>" />
                                <div class="error"><?php echo __(form_span_error("current_complete_engineering")); ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="formItem">
                            <label class="label">
                                本次扣保留金  %： <span class='example'>（例：23.8546）</span>
                            </label>
                            <div class="iner">
                                <input name="current_fastener_retention" type="text" class="txt amount" value="<?php  echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getCurrentFastenerRetention(), '4') : ''?>" />
                                <div class="error"><?php echo __(form_span_error("current_fastener_retention")); ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="formItem">
                            <label class="label">
                                本期应付金额：
                            </label>
                            <div class="iner">
                                <input name="current_payable" type="text" class="txt amount" value="<?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getCurrentPayable(), '4') : ''?>" />
                                <div class="error"><?php echo __(form_span_error("current_payable")); ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="formItem">
                            <label class="label">
                                累计完成工程总额：
                            </label>
                            <div class="iner">
                                <input name="total_complete_engineering" type="text" class="txt" value="<?php echo $engineeringSettlement ? $engineeringSettlement->getTotalCompleteEngineering() : ''; ?>" />
                                <div class="error"><?php echo __(form_span_error("total_complete_engineering")); ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="formItem">
                            <label class="label">
                                累计扣保留金  %： <span class='example'>（例：23.8546）</span>
                            </label>
                            <div class="iner">
                                <input name="total_fastener_retention" type="text" class="txt amount" value="<?php  echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getTotalFastenerRetention(), '4') : ''?>" />
                                <div class="error"><?php echo __(form_span_error("total_fastener_retention")); ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="formItem">
                            <label class="label">
                                累计应支付金额：
                            </label>
                            <div class="iner">
                                <input name="total_payable" type="text" class="txt amount" value="<?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getTotalPayable(), '4') : '' ?>" />
                                <div class="error"><?php echo __(form_span_error("total_payable")); ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="formItem">
                            <label class="label">
                                已支付(预付)金额：
                            </label>
                            <div class="iner">
                                <input name="prepayment" type="text" class="txt amount" value="<?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getPrepayment(), '4') : ''  ?>" />
                                <div class="error"><?php echo __(form_span_error("prepayment")); ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="formItem">
                            <label class="label">
                                本次申请支付金额：
                            </label>
                            <div class="iner">
                                <input name="apply_payment" type="text" class="txt amount" value="<?php echo $engineeringSettlement ?  util::formattingNumbers($engineeringSettlement->getApplyPayment(), '4') : '' ?>" />
                                <div class="error"><?php echo __(form_span_error("apply_payment")); ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="formItem left">
                            <label class="label">制表人：</label>
                            <div class="iner lh30"><?php echo $application ? $application->getSfGuardUser()->getProfile()->getLastname() . $application->getSfGuardUser()->getProfile()->getFirstName() : htmlspecialchars($sf_user->getGuardUser()->getProfile()->getLastName()) . htmlspecialchars($sf_user->getGuardUser()->getProfile()->getFirstName()); ?></div>
                        </div>                        
                    </td>
                    <td colspan="2">
                        <div class="formItem right">
                            <label  class="label">制表日期：</label>
                            <div class="iner lh30"><?php echo date('Y-m-d'); ?></div>
                        </div>
                    </td>
                    
                </tr>
            </table>
        </div>
        <div class="btn_con">
            <div class="btns clearfix">
                <input type='submit' class='btn_blue' value='保存' />
                <a href="<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery("projectType", "keywords", "id", "approvalType"))); ?>" class="btn_blue jump">放弃</a>
            </div>
        </div>
    </div>
</div>
</form>
</div>
<script type="text/javascript">
    $('#expirationDate').setTimepicker();
    $(document).ready(function(){
        $("input[name='change_amount']").change(function(){
            calculateAmount('changed_amount','current_amount','change_amount');
        })

        $("input[name='contract_amount']").change(function(){
            calculateAmount('changed_amount','current_amount','change_amount');
        })

        <?php if($sf_flash->has('msg')){ ?>
            <?php if($sf_flash->get('msg') == 1){ ?>
                showSaveSuccessfullyMessage(null, "<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery('projectType', 'keywords', 'id', 'approvalType'))); ?>");
            <?php } ?>
        <?php } ?>

        $(".jump").leaveCheck({formId:'engineeringSettlement',formUrl:'<?php echo url_for("engineeringSettlement/leaveCheck"); ?>'});
    })
</script>