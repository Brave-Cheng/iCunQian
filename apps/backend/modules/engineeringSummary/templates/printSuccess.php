<div class="wrap">
        <div id="full_print"  class="full_width">
            <div class="formDiv pro_form">
                <h3 class="title"><?php echo __($approvalType->getName()); ?></h3>
                <div class="left w480 ml20">
                    <div class="formItem">
                        <label class="label"> <?php echo __('项目名称'); ?>：</label>
                        <div class="iner">
                            <?php echo $application->getProject()->getName() ?>
                            <div id="project" class="error"><?php echo __(form_span_error("project")); ?></div>
                        </div>
                    </div>

                    <div class="formItem">
                        <label class="label">
                            <?php echo __('施工单位'); ?>：
                        </label>
                        <div class="iner">
                            <?php echo $engineeringSummary->getConstructionUnit(); ?>
                            <div id="constructionUnit" class="error"><?php echo __(form_span_error("constructionUnit")); ?></div>
                        </div>
                    </div>

                    <div class="formItem">
                        <label class="label">
                            <?php echo __('截止日期'); ?>：
                        </label>
                        <div class="iner">
                            <?php echo $engineeringSummary->getExpirationDate(); ?>
                            <div id="expiration_date" class="error"><?php echo __(form_span_error("expiration_date")); ?></div>
                        </div>
                    </div>
                </div>
                <div class="right mr20 w300">

                    <div class="formItem">
                        <label class="label">
                            <?php echo __('金额单位'); ?>：
                        </label>
                        <div class="iner">
                            <?php echo __('人民币元'); ?>
                        </div>
                    </div>

                    <div class="formItem">
                        <label class="label">
                            <?php echo __('期号'); ?>：
                        </label>
                        <div class="iner">
                            <?php echo $engineeringSummary->getIssue(); ?>
                            <div id="issue" class="error"><?php echo __(form_span_error("issue")); ?></div>
                        </div>
                    </div>

                    <div class="formItem">
                        <label class="label">
                            <?php echo __('合同号'); ?>：
                        </label>
                        <div class="iner">
                            <?php echo $engineeringSummary->getContractNumber(); ?>
                            <div id="contractNumber" class="error"><?php echo __(form_span_error("contractNumber")); ?></div>
                        </div>
                    </div>
                </div>


                <?php if ($applicationId): ?>
                    <div class="left w480 ml20">
                        <div class="formItem">
                            <label class="label">
                                <?php echo __('到本期末完成金额合计'); ?>：
                            </label>
                            <div class="iner">
                                <?php echo util::formattingNumbers($engineeringSummary->getTotalCurrentFinishAmount(), '2'); ?>
                            </div>
                        </div>

                        <div class="formItem">
                            <label class="label">
                                <?php echo __('到本期末完成金额合计'); ?>：
                            </label>
                            <div class="iner">
                                <?php echo util::formattingNumbers($engineeringSummary->getTotalFinishAmount(), '2'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="right mr20 w300">
                        <div class="formItem">
                            <label class="label">
                                <?php echo __('到上期末完成金额合计'); ?>：
                            </label>
                            <div class="iner">
                                <?php echo util::formattingNumbers($engineeringSummary->getTotalLastFinishAmount(), '2'); ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
                <!--头部表单 end-->

                <div class="clear"></div>

                <div class="tables ex_tabs">
                    <table id="list">
                        <thead>
                            <tr>
                                <td class="w40"><?php echo __('编号') ?></td>
                                <td class="w120"><?php echo __('项目内容') ?></td>
                                <td class="w80"><?php echo __('合同工程量') ?></td>
                                <td class="w80"><?php echo __('增减工程量+-') ?></td>
                                <td class="w60"><?php echo __('到本期末完成金额') ?></td>
                                <td class="w60"><?php echo __('到上期末完成金额') ?></td>
                                <td class="w60"><?php echo __('本期完成金额') ?></td>
                                <td class="w60"><?php echo __('完成%') ?></td>
                                <td class="w120"><?php echo __('备注') ?></td>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <!--如果工程量汇总存在多个项目信息 start-->
                            <?php if ($engineeringSummaryItems): ?>
                                <?php foreach ($engineeringSummaryItems as $engineeringSummaryItem): ?>
                                    <tr>
                                        <td class="w40"><?php echo $engineeringSummaryItem->getId() ?></td>
                                        <td class="w120">
                                            <?php echo $engineeringSummaryItem->getProjectContent() ?>
                                        </td>
                                        <td class="w80"><?php echo $engineeringSummaryItem->getContractQuantity() ?></td>
                                        <td class="w80"><?php echo $engineeringSummaryItem->getFloatQuantity() ?></td>
                                        <td class="w60"><?php echo util::formattingNumbers($engineeringSummaryItem->getCurrentFinishAmount(),'2') ?></td>
                                        <td class="w60"><?php echo util::formattingNumbers($engineeringSummaryItem->getLastFinishAmount(),'2')  ?></td>
                                        <td class="w60"><?php echo util::formattingNumbers($engineeringSummaryItem->getFinishAmount(),'2')  ?></td>
                                        <td class="w60"><?php echo util::formattingNumbers($engineeringSummaryItem->getFinishPercent(),'2') ?></td>
                                        <td class="w120"><?php echo $engineeringSummaryItem->getComment() ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="clearfix mt15">
                        <div class="left">
                            <div class="formItem">
                                <span class="color">制表人：</span>
                                <div class="inblock"><?php echo htmlspecialchars($application->getSfGuardUser()->getProfile()->getLastName()) . htmlspecialchars($application->getSfGuardUser()->getProfile()->getFirstName()); ?></div>

                            </div>
                        </div>
                        <div class="right">
                            <div class="formItem">
                                <span class="color">制表日期：</span>
                                <div class="inblock"><?php echo date('Y-m-d'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt10">
                        <?php include_partial('global/printPartial', array('id' => $sf_params->get('id'))) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

