<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('comm') ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<div class="wrap">
    <?php echo form_tag("engineeringSummary/update?" . html_entity_decode(formGetQuery("projectType", "keywords", "approvalId")), "id=insertMaterial") ?>
    <div id="main" class="clearfix">
        <div class="full_width">
            <div class="bread_crumbs"> <a class="jump"href="<?php echo url_for('commitApproval/index'); ?>">审批流程</a> &gt; <?php if ($applicationId): ?><?php echo __('修改审批') ?><?php else: ?><a class="jump" href="<?php echo url_for('commitApproval/selectApprovalType'); ?>">新建审批</a> &gt; <span>第二步：填写申请表单</span><?php endif; ?> </div>
            <div class="formDiv pro_form data_display">
                <h3 class="title"><?php echo __($approvalType->getName()); ?></h3>
                <div class="left w480 ml20">
                    <div class="formItem">
                        <label class="label w80 alignRight"> <?php echo __('项目名称'); ?>：</label>
                        <div class="inblock">
                            <select class="select w260" name="project">
                                <option value=''><?php echo __('请选择') ?></option>
                                <?php if ($applicationId): ?>
                                    <?php echo objects_for_select($userProjects, 'getId', 'getName', $application->getProjectId()) ?>
                                <?php else: ?>
                                    <?php echo objects_for_select($userProjects, 'getId', 'getName') ?>
                                <?php endif; ?>
                            </select>
                            <div id="project" class="error"><?php echo __(form_span_error("project")); ?></div>
                        </div>
                    </div>

                    <div class="formItem">
                        <label class="label w80 alignRight">
                            <?php echo __('施工单位'); ?>：
                        </label>
                        <div class="inblock">
                            <?php if ($applicationId): ?>
                                <input type="text" name="constructionUnit" class="txt w260" value="<?php echo $engineeringSummary->getConstructionUnit(); ?>" />
                            <?php else: ?>
                                <input type="text" name="constructionUnit" class="txt w260" value="" />
                            <?php endif; ?>
                            <div id="constructionUnit" class="error"><?php echo __(form_span_error("constructionUnit")); ?></div>
                        </div>
                    </div>

                    <div class="formItem">
                        <label class="label w80 alignRight">
                            <?php echo __('截止日期'); ?>：
                        </label>
                        <div class="inblock">
                            <?php if ($applicationId): ?>
                                <input type="text" name="expiration_date" id="clear_expiration_date" class="txt" value="<?php echo $engineeringSummary->getExpirationDate(); ?>"  />
                            <?php else: ?>
                                <input type="text" name="expiration_date" id="clear_expiration_date" class="txt" value=""  />
                            <?php endif; ?>
                            <span class="operation"><a href="javascript:void(0);" title="<?php echo __('清除') ?>" onclick="$('#clear_expiration_date').val('');"><img src="/images/icons/delete.png" alt="clear" /></a></span>
                            <div id="expiration_date" class="error"><?php echo __(form_span_error("expiration_date")); ?></div>
                        </div>
                    </div>
                </div>
                <div class="right mr20 w300">

                    <div class="formItem">
                        <label class="label w80 alignRight">
                            <?php echo __('合同号'); ?>：
                        </label>
                        <div class="inblock">
                            <?php if ($applicationId): ?>
                                <input type="text" name="contractNumber" class="txt" value="<?php echo $engineeringSummary->getContractNumber(); ?>"  />
                            <?php else: ?>
                                <input type="text" name="contractNumber" class="txt" value=""  />
                            <?php endif; ?>
                            <div id="contractNumber" class="error"><?php echo __(form_span_error("contractNumber")); ?></div>
                        </div>
                    </div>

                    <div class="formItem">
                        <label class="label w80 alignRight">
                            <?php echo __('期号'); ?>：
                        </label>
                        <div class="inblock">
                            <?php if ($applicationId): ?>
                                <input type="text" name="issue" class="txt" value="<?php echo $engineeringSummary->getIssue(); ?>" />
                            <?php else: ?>
                                <input type="text" name="issue" class="txt" value="" />
                            <?php endif; ?>
                            <div id="issue" class="error"><?php echo __(form_span_error("issue")); ?></div>
                        </div>
                    </div>

                    <div class="formItem">
                        <label class="label w80 alignRight">
                            <?php echo __('金额单位'); ?>：
                        </label>
                        <div class="inblock lh30">
                            <?php echo __('人民币元'); ?>
                        </div>
                    </div>
                </div>


                <?php if ($applicationId): ?>
                    <div class="left w480 ml20">
                        <div class="formItem">
                            <label class="label w140 alignRight">
                                <?php echo __('到本期末完成金额合计'); ?>：
                            </label>
                            <div class="iner">
                                <input type="text" name="total_current_finish_amount" class="txt disabled" value="<?php echo util::formattingNumbers($engineeringSummary->getTotalCurrentFinishAmount(), '4'); ?>"  readonly="readonly" />
                            </div>
                        </div>

                        <div class="formItem">
                            <label class="label w140 alignRight">
                                <?php echo __('到本期末完成金额合计'); ?>：
                            </label>
                            <div class="iner">
                                <input type="text" name="total_finish_amount" class="txt disabled" value="<?php echo util::formattingNumbers($engineeringSummary->getTotalFinishAmount(), '4'); ?>"  readonly="readonly" />
                            </div>
                        </div>
                    </div>

                    <div class="right mr20 w300">
                        <div class="formItem">
                            <label class="label w140 alignRight">
                                <?php echo __('到上期末完成金额合计'); ?>：
                            </label>
                            <div class="iner">
                                <input type="text" name="total_last_finish_amount" class="txt disabled" value="<?php echo util::formattingNumbers($engineeringSummary->getTotalLastFinishAmount(), '4'); ?>"  readonly="readonly" />
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
                <!--头部表单 end-->

                <div class="clear"></div>
                <div class="clear"></div>
                <div class="tables ex_tabs">
                    <table id="list">
                        <thead>
                            <tr>
                                <td class="w40"><?php echo __('编号') ?></td>
                                <td class="w80"><?php echo __('项目内容') ?></td>
                                <td class="w80"><?php echo __('合同工程量') ?></td>
                                <td class="w80"><?php echo __('增减工程量+-') ?></td>
                                <td class="w60"><?php echo __('到本期末完成金额') ?></td>
                                <td class="w60"><?php echo __('到上期末完成金额') ?></td>
                                <td class="w60"><?php echo __('本期完成金额') ?></td>
                                <td class="w60"><?php echo __('完成%') ?><br/>（23.8546）</td>
                                <td class="w120"><?php echo __('备注') ?></td>
                                <td class="w40">操作</td>
                            </tr>
                            <tr><td class="partition" colspan="10"></td></tr>
                        </thead>
                        <tbody id="tbody">
                            <!--如果工程量汇总存在多个项目信息 start-->
                            <?php if ($engineeringSummaryItems): ?>
                                <?php foreach ($engineeringSummaryItems as $engineeringSummaryItem): ?>
                                    <tr>
                                        <td nowrap><?php echo $engineeringSummaryItem->getId(); ?></td>
                                        <td>
                                            <input type="text" name="projectContent[]" class="txt w60" value="<?php echo $engineeringSummaryItem->getProjectContent() ?>" />
                                        </td>
                                        <td><input type="text" name="contractQuantity[]" class="txt w60" value="<?php echo $engineeringSummaryItem->getContractQuantity() ?>" /></td>
                                        <td><input type="text" name="floatQuantity[]" class="txt w60" value="<?php echo $engineeringSummaryItem->getFloatQuantity() ?>" /></td>
                                        <td><input type="text" name="currentFinishAmount[]" class="txt w40 disabled currentFinishAmount<?php echo $engineeringSummaryItem->getId() ?>" value="<?php echo $engineeringSummaryItem->getCurrentFinishAmount() ?>" /></td>
                                        <td><input type="text" name="lastFinishAmount[]" class="txt w40 quantity lastFinishAmount<?php echo $engineeringSummaryItem->getId() ?>" value="<?php echo util::formattingNumbers($engineeringSummaryItem->getLastFinishAmount(), '4') ?>" onChange="calculateAmount('currentFinishAmount<?php echo $engineeringSummaryItem->getId() ?>', 'lastFinishAmount<?php echo $engineeringSummaryItem->getId() ?>', 'finishAmount<?php echo $engineeringSummaryItem->getId() ?>');" /></td>
                                        <td><input type="text" name="finishAmount[]" class="txt w40 timer finishAmount<?php echo $engineeringSummaryItem->getId() ?>" value="<?php echo util::formattingNumbers($engineeringSummaryItem->getFinishAmount(), '4') ?>" onChange="calculateAmount('currentFinishAmount<?php echo $engineeringSummaryItem->getId() ?>', 'lastFinishAmount<?php echo $engineeringSummaryItem->getId() ?>', 'finishAmount<?php echo $engineeringSummaryItem->getId() ?>');" /></td>
                                        <td><input type="text" name="finishPercent[]" class="txt w40" value="<?php echo util::formattingNumbers($engineeringSummaryItem->getFinishPercent(), '4') ?>" /></td>
                                        <td><input type="text" name="comment[]" class="txt w100" value="<?php echo $engineeringSummaryItem->getComment() ?>" /></td>
                                        <?php if ($accessDelete): ?>
                                            <td nowrap><a href="javascript:void(0);" onclick="javascript:removeOption(this);">删除</a></td>
                                        <?php endif; ?>
                                        <?php echo input_hidden_tag('engineeringSummaryItemsId[]', $engineeringSummaryItem->getId()) ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!--如果工程量汇总不存在项目 start-->
                                <tr>
                                    <td nowrap>1</td>
                                    <td>
                                        <input type="text" name="projectContent[]" class="txt w60" value="" />
                                    </td>
                                    <td><input type="text" name="contractQuantity[]" class="txt w60" value="" /></td>
                                    <td><input type="text" name="floatQuantity[]" class="txt w60" value="" /></td>
                                    <td><input type="text" name="currentFinishAmount[]" class="txt w40 disabled currentFinishAmount1" value="" readonly="readonly" /></td>
                                    <td><input type="text" name="lastFinishAmount[]" class="txt w40 quantity lastFinishAmount1" value="" onChange="calculateAmount('currentFinishAmount1', 'lastFinishAmount1', 'finishAmount1');" /></td>
                                    <td><input type="text" name="finishAmount[]" class="txt w40 timer finishAmount1" value="" onChange="calculateAmount('currentFinishAmount1', 'lastFinishAmount1', 'finishAmount1');" /></td>
                                    <td><input type="text" name="finishPercent[]" class="txt w40" value="" /></td>
                                    <td><input type="text" name="comment[]" class="txt w100" value="" /></td>
                                    <td><a href="javascript:void(0);" onclick="javascript:removeOption(this);">删除</a></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot id="doc_btn">
                            <tr>
                                <td colspan="10"><a href="javascript:void(0);" onclick="return addTableOption();" class="btn_blue right" id="addDocBtn">新增一行</a></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="clearfix mt15">
                        <div class="left">
                            <div class="formItem">
                                <span>制表人：</span>
                                <div class="iner"><?php echo $applicationId ? $application->getSfGuardUser()->getProfile()->getLastname() . $application->getSfGuardUser()->getProfile()->getFirstName() : htmlspecialchars($sf_user->getGuardUser()->getProfile()->getLastName()) . htmlspecialchars($sf_user->getGuardUser()->getProfile()->getFirstName()); ?></div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="formItem">
                                <span>制表日期：</span>
                                <div class="iner"><?php echo date('Y-m-d'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn_con">
                    <div class="btns clearfix">
                        <input type="submit" id="save_btn" onclick="return checkForm();" value="<?php echo __('保存'); ?>" class="btn_blue" />
                        <a href="<?php echo url_for("commitApproval/index?" . html_entity_decode(formGetQuery("projectType", "approvalId", "keywords"))) ?>" class="btn_blue jump"><?php echo __('放弃') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($applicationId): ?>
        <?php echo input_hidden_tag('applicationId', $applicationId); ?>
    <?php endif; ?>
    <?php if ($engineeringSummaryId): ?>
        <?php echo input_hidden_tag('engineeringSummaryId', $engineeringSummaryId) ?>
    <?php endif; ?>
    <?php echo input_hidden_tag('approvalType', $approvalId) ?>
</form>
</div>
</div>
<script type="text/javascript">
$(".jump").leaveCheck({formId:'insertMaterial',formUrl:'<?php echo url_for("engineeringSummary/checkEngineeringSummary"); ?>'});
                                var projectContent = '项目内容不能为空';
                                var contractQuantity = '合同工程量不能为空';
                                var floatQuantity = '增减工程量不能为空';
                                var lastFinishAmount = '到上期末完成金额不能为空';
                                var finishAmount = '本期完成金额不能为空';
                                var finishPercent = '完成百分比不能为空';
                                var contractNumber = '合同号不能为空';
                                var constructionUnit = '施工单位不能为空';
                                var issue = '期号不能为空';
                                var expiration_date = '截止日期不能为空';
                                var project = '项目不能为空';
                                var finishPercentError = '完成百分比只能是数字，例65或者65.45';
                                var commonNotice = '只能是数字，例675或者675.45';
                                var noTr = '没有明细数据，不能保存';
                                var fourDecimals = '最多四位小数或者整数超过11位';
                                
                                $(function() {
                                    $('input[name=expiration_date]').setTimepicker();
                                    $('input[name=expiration_date]').attr('readonly', true);
                                    setTrColor();
                                    var msg = '<?php echo $sf_request->getParameter("msg"); ?>';
                                    if (msg == '1') {
                                        showSaveSuccessfullyMessage('保存成功', "<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery("projectType", "keywords", "approvalId"))); ?>");
                                    }
                                });
                                function setTrColor() {
                                    $('#tbody tr').each(function(i) {
                                        $(this).children().first().text(i + 1);
                                        if ((i + 1) % 2 == 0) {
                                            $(this).attr('class', 'odd');
                                        }


                                    });
                                }

                                function addTableOption() {
                                    var tableString = '';
                                    var num = Number($('#tbody tr:last td:first').text());
                                    var number = num + 1;
                                    tableString += '<tr class="">';
                                    tableString += '<td></td>';
                                    tableString += '<td><input type="text" name="projectContent[]" class="txt w60" value="" /></td>';
                                    tableString += '<td><input type="text" name="contractQuantity[]" class="txt w60" value="" /></td>';
                                    tableString += '<td><input type="text" name="floatQuantity[]" class="txt w60" value="" /></td>';
                                    tableString += '<td><input type="text" name="currentFinishAmount[]" class="txt w40 disabled currentFinishAmount' + (num + 1) + '" value="" readonly="readonly"  /></td>';
                                    tableString += '<td><input type="text" name="lastFinishAmount[]" class="txt w40 quantity lastFinishAmount' + number + '" value=""  onChange="calculateAmount(\'currentFinishAmount' + number + '\', \'lastFinishAmount' + number + '\', \'finishAmount' + number + '\');"  /></td>';
                                    tableString += '<td><input type="text" name="finishAmount[]" class="txt w40 timer finishAmount' + number + '" value="" onChange="calculateAmount(\'currentFinishAmount' + number + '\', \'lastFinishAmount' + number + '\', \'finishAmount' + number + '\');"  /></td>';
                                    tableString += '<td><input type="text" name="finishPercent[]" class="txt w40" value="" /></td>';
                                    tableString += '<td><input type="text" name="comment[]" class="txt w100" value="" /></td>';
                                    tableString += '<td nowrap><a href="javascript:void(0);" onclick="javascript:removeOption(this);">删除</a></td>';
                                    tableString += '</tr>';
                                    $('#list').append(tableString);
                                    setTrColor();
                                }

                                function removeOption(obj, url, exsitId) {
                                    if (url && exsitId) {
                                        $.get(url, {engineeringSummaryItemId: exsitId}, function(res) {
                                            if (res) {
//                                                            showSaveSuccessfullyMessage(res.msg);
                                            }
                                        }, 'json');
                                    }
                                    $(obj).parent().parent().remove();
                                    setTrColor();

                                }

                                function checkForm() {
                                    var flag = true;
                                    if ($("select[name='project']").val() == '') {
                                        $("#project").html(project);
                                        flag = false;
                                    } else {
                                        $("#project").html('');
                                    }
                                    if ($("input[name='contractNumber']").val() == '') {
                                        $("#contractNumber").html(contractNumber);
                                        flag = false;
                                    } else {
                                        $("#contractNumber").html('');
                                    }

                                    if ($("input[name='constructionUnit']").val() == '') {
                                        $("#constructionUnit").html(constructionUnit);
                                        flag = false;
                                    } else {
                                        $("#constructionUnit").html('');
                                    }

                                    if ($("input[name='issue']").val() == '') {
                                        $("#issue").html(issue);
                                        flag = false;
                                    } else {
                                        $("#issue").html('');
                                    }

                                    if ($("input[name='expiration_date']").val() == '') {
                                        $("#expiration_date").html(expiration_date);
                                        flag = false;
                                    } else {
                                        $("#expiration_date").html('');
                                    }

                                    if ($('#tbody > tr').length == 0) {
                                        showSaveSuccessfullyMessage(noTr);
                                        flag = false;

                                    }
                                    $('#tbody > tr').each(function(i) {
                                        i += 1;
                                        $(this).find('input:text').each(function() {
                                            if (($(this).attr('name') == 'projectContent[]')) {
                                                if ($.trim($(this).val()) == '') {
                                                    if (!$(".projectContent" + i).html()) {
                                                        $('<div class="w80 projectContent' + i + '"style="color:red">' + projectContent + '</div>').insertAfter($(this));
                                                    }
                                                    flag = false;
                                                } else {
                                                    $(".projectContent" + i).empty();
                                                }
                                            }


                                            if (($(this).attr('name') == 'contractQuantity[]')) {
                                                if ($.trim($(this).val()) == '') {
                                                    if (!$(".contractQuantity" + i).html()) {
                                                        $('<div class="w60 contractQuantity' + i + '"style="color:red">' + contractQuantity + '</div>').insertAfter($(this));
                                                    }
                                                    flag = false;
                                                } else {
                                                    $(".contractQuantity" + i).empty();
                                                }
                                            }

                                            if (($(this).attr('name') == 'floatQuantity[]')) {
                                                if ($.trim($(this).val()) == '') {
                                                    if (!$(".floatQuantity" + i).html()) {
                                                        $('<div class="w60 floatQuantity' + i + '"style="color:red">' + floatQuantity + '</div>').insertAfter($(this));
                                                    }
                                                    flag = false;
                                                } else {
                                                    $(".floatQuantity" + i).empty();
                                                }
                                            }
                                            
                                            if (($(this).attr('name') == 'lastFinishAmount[]')) {
                                                if ($.trim($(this).val()) == '') {
                                                    if (!$(".lastFinishAmount_" + i).html()) {
                                                        $('<div class="w40 lastFinishAmount_' + i + '"style="color:red">' + lastFinishAmount + '</div>').insertAfter($(this));
                                                    }
                                                    flag = false;
                                                } else {
                                                    if (!isNumber($.trim($(this).val()))) {
                                                        $(".lastFinishAmount_" + i).empty();
                                                        $('<div class="w40 lastFinishAmount_' + i + '"style="color:red">' + commonNotice + '</div>').insertAfter($(this));
                                                        flag = false;
                                                    } else {
                                                        if(afterFourDecimals($.trim($(this).val()) )){
                                                            $(".lastFinishAmount_" + i).empty();
                                                            $('<div class="w40 lastFinishAmount_' + i + '"style="color:red">' + fourDecimals + '</div>').insertAfter($(this));
                                                            flag = false;
                                                        }else{
                                                            $(".lastFinishAmount_" + i).empty();
                                                        }
                                                    }

                                                    
                                                }
                                            }



                                            if (($(this).attr('name') == 'finishAmount[]')) {
                                                if ($.trim($(this).val()) == '') {
                                                    if (!$(".finishAmount_" + i).html()) {
                                                        $('<div class="w40 finishAmount_' + i + '"style="color:red">' + finishAmount + '</div>').insertAfter($(this));
                                                    }
                                                    flag = false;
                                                } else {
                                                    if (!isNumber($.trim($(this).val()))) {
                                                        $(".finishAmount_" + i).empty();
                                                        $('<div class="w40 finishAmount_' + i + '"style="color:red">' + commonNotice + '</div>').insertAfter($(this));
                                                        flag = false;
                                                    } else {
                                                        if(afterFourDecimals($.trim($(this).val()) )){
                                                            $(".lastFinishAmount_" + i).empty();
                                                            $('<div class="w40 lastFinishAmount_' + i + '"style="color:red">' + fourDecimals + '</div>').insertAfter($(this));
                                                            flag = false;
                                                        }else{
                                                            $(".finishAmount_" + i).empty();
                                                        }
                                                    }

                                                }
                                            }

                                            if (($(this).attr('name') == 'finishPercent[]')) {
                                                if ($.trim($(this).val()) == '') {
                                                    if (!$(".finishPercent" + i).html()) {
                                                        $('<div class="w40 finishPercent' + i + '"style="color:red">' + finishPercent + '</div>').insertAfter($(this));
                                                    }
                                                    flag = false;
                                                } else {
                                                    if (!isNumber($.trim($(this).val()))) {
                                                        $(".finishPercent" + i).empty();
                                                        $('<div class="w40 finishPercent' + i + '"style="color:red">' + finishPercentError + '</div>').insertAfter($(this));
                                                        flag = false;
                                                    } else {
                                                        if(afterFourDecimals($.trim($(this).val()) )){
                                                            $(".lastFinishAmount_" + i).empty();
                                                            $('<div class="w40 lastFinishAmount_' + i + '"style="color:red">' + fourDecimals + '</div>').insertAfter($(this));
                                                            flag = false;
                                                        }else{
                                                            $(".finishPercent" + i).empty();
                                                        }
                                                        
                                                    }

                                                }
                                            }


                                        });
                                    });
                                    return flag;
                                }





</script>

