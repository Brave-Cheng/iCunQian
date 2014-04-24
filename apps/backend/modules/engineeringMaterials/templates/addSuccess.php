<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<div class="wrap">
    <?php echo form_tag("engineeringMaterials/insert?" . html_entity_decode(formGetQuery("projectType", "keywords", "applicationId", "approvalId")), "id=insertMaterial") ?>
        <div id="main" class="clearfix">
            <div class="full_width">
                <div class="bread_crumbs"> <a class="jump" href="<?php echo url_for('commitApproval/index');?>">审批流程</a> &gt; <a class="jump" href="<?php echo url_for('commitApproval/selectApprovalType');?>">新建审批</a> &gt; <span>第二步：填写申请表单</span> </div>
                <div class="formDiv pro_form data_display">

                    <h3 class="title">设备材料申购单</h3>

                    <div class="left w300 ml20">
                        <div class="formItem">
                            <span class="left lh30 alignRight">合同段：</span>
                            <span class="inblock">
                                <input type="text" name="contract_section" id="contract_section" class="txt" value="" />
                                <div id="contract_section_div" class="error"><?php echo __(form_span_error("contract_section")); ?></div>
                            </span>
                        </div>
                    </div>
                    <div class="left w260 ml20">
                        <div class="formItem">
                            <span class="left lh30 alignRight">项目名称：</span>
                            <div class="iner">
                                <select class="select" name="project" id="project">
                                    <option><?php echo __('所有项目') ?></option>
                                    <?php echo objects_for_select($userProjects, 'getId', 'getName', $project) ?>
                                </select>
                                <div id="project_div" class="error"><?php echo __(form_span_error("project")); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="right mr20">
                        <div class="formItem">
                            <span class="left lh30 alignRight">编号：</span>
                            <div class="iner">
                                <input type="text" name="number" id="number" class="txt" value="" />
                                <div id="number_div" class="error"><?php echo __(form_span_error("number")); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="tables ex_tabs">
                        <table id="list">
                            <thead>
                                <tr>
                                    <td class="w40">细目号</td>
                                    <td class="w90">设备材料名</td>
                                    <td class="w70">品牌、型号</td>
                                    <td class="w70">技术要求</td>
                                    <td class="w50">单位</td>
                                    <td class="w50">数量</td>
                                    <td class="w90">到货日期</td>
                                    <td class="w70">到货地点</td>
                                    <td class="w70">备注</td>
                                    <td class="w40">操作</td>
                                </tr>
                                <tr><td class="partition" colspan="10"></td></tr>
                            </thead>
                            <tbody id="tbody">
                                <tr class="1">
                                    <td>1</td>
                                    <td><input type="text" name="material_name[]" class="txt w70" value="" /></td>
                                    <td><input type="text" name="brand[]" class="txt w60" value="" /></td>
                                    <td><input type="text" name="technical_requirement[]" class="txt w50" value="" /></td>
                                    <td><input type="text" name="unit[]" class="txt w30" value="" /></td>
                                    <td><input type="text" name="quantity[]" class="txt w30 quantity" value="" /></td>
                                    <td><input type="text" name="arrival_date[]" class="txt w70 timer" value="" /></td>
                                    <td><input type="text" name="arrival_place[]" class="txt w50" value="" /></td>
                                    <td><input type="text" name="comment[]" class="txt w50" value="" /></td>
                                    <td><a href="javascript:void(0);" onclick="javascript:removeOption(this);">删除</a></td>
                                </tr>
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
                                    <div class="inblock"><?php echo $sf_user->getGuardUser()->getProfile()->getLastName() ? htmlspecialchars($sf_user->getGuardUser()->getProfile()->getLastName()) . htmlspecialchars($sf_user->getGuardUser()->getProfile()->getFirstName()) :'系统管理员';?></div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="formItem">
                                    <span>制表日期：</span>
                                    <div class="inblock"><?php echo date('Y-m-d');?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn_con">
                        <div class="btns clearfix">
                            <input type="submit" id="save_btn" onclick="return checkForm();" value="<?php echo __('保存');?>" class="btn_blue" />
                            <a href="<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery("projectType", "keywords", "applicationId", "approvalId")));?>" class="btn_blue jump">放弃</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(".jump").leaveCheck({formId:'insertMaterial',formUrl:'<?php echo url_for('engineeringMaterials/checkEngineeringMaterials?' . html_entity_decode(formGetQuery('projectId', 'pager'))); ?>'});
$(function(){
    $('input[name=arrival_date\\[\\]]').setTimepicker();
    $('input[name=arrival_date\\[\\]]').attr('readonly', true);
    initData();
});
function initData(){
    $('#tbody tr').each(function(i){
        $(this).children().first().text(i+1);
        if((i+1)%2 == 0){
            $(this).attr('class', 'odd');
        }
    });
}
function addTableOption(){
    var str = '';
    str += '<tr class="">';
    str += '<td>1</td>';
    str += '<td><input type="text" name="material_name[]" class="txt w70" value="" /></td>';
    str += '<td><input type="text" name="brand[]" class="txt w60" value="" /></td>';
    str += '<td><input type="text" name="technical_requirement[]" class="txt w50" value="" /></td>';
    str += '<td><input type="text" name="unit[]" class="txt w30" value="" /></td>';
    str += '<td><input type="text" name="quantity[]" class="txt w30 quantity" value="" /></td>';
    str += '<td><input type="text" name="arrival_date[]" class="txt w70 timer" value="" /></td>';
    str += '<td><input type="text" name="arrival_place[]" class="txt w50" value="" /></td>';
    str += '<td><input type="text" name="comment[]" class="txt w50" value="" /></td>';
    str += '<td><a href="javascript:void(0);" onclick="javascript:removeOption(this);">删除</a></td>';
    str += '</tr>';
    $('#list').append(str);
    $('input[name=arrival_date\\[\\]]').setTimepicker();
    $('input[name=arrival_date\\[\\]]').attr('readonly', true);
    initData();
    return false;
}
function removeOption(obj){
    $(obj).parent().parent().remove();
    initData();
}

function checkForm(){
    var flag = new Array();
    var checkStatus = new Array();
    $('.section_error').remove();
    $('.project_error').remove();
    $('.number_error').remove();
    $('.section_unique_error').remove();
    $('.number_unique_error').remove();
    if($.trim($('#contract_section').val()) == '' || $('#project').val() == '所有项目' || $.trim($('#number').val()) == ''){
        if($.trim($('#contract_section').val()) == ''){
            $('<div class="section_error" style="color:red;font-weight:normal;">合同段不能为空</div>').insertAfter($('#contract_section'));
            flag[0] = 0;
        }else{
            $('.section_error').remove();
            flag[0] = 1;
        }

        if($('#project').val() == '所有项目'){
            $('<div class="project_error" style="color:red">项目必选</div>').insertAfter($('#project').parent());
            flag[1] = 0;
        }else{
            $('.project_error').remove();
            flag[1] = 1;
        }

        if($.trim($('#number').val()) == ''){
            $('<div class="number_error" style="color:red">编号不能为空</div>').insertAfter($('#number'));
            flag[2] = 0;
        }else{
            $('.number_error').remove();
            flag[2] = 1;
        }
    }
    /*
    if($.trim($('#contract_section').val()) != ''){
        var obj = $.ajax({
            type:'get',
            url:'<?php echo url_for("engineeringMaterials/checkContractSection")?>',
            async: false,
            data:'contractSection='+ $('#contract_section').val()+'&id=0',
            success:function(msg){
                if(msg == '1'){
                    $('<div class="section_unique_error" style="color:red;font-weight:normal">合同段已经存在</div>').insertAfter($('#contract_section'));
                }else{
                    $('.section_unique_error').remove();
                }
            }
        });
        if(obj.responseText == '1'){
            flag[0] = 0;
        }else{
            flag[0] = 1;
        };
    }
    if($.trim($('#number').val()) != ''){
        var obj = $.ajax({
            type:'get',
            url:'<?php echo url_for("engineeringMaterials/checkNumber")?>',
            async: false,
            data:'number='+ $('#number').val()+'&id=0',
            success:function(msg){
                if(msg == '1'){
                    $('<div class="number_unique_error" style="color:red">编号已经存在</div>').insertAfter($('#number'));
                }else{
                    $('.number_unique_error').remove();
                }
            }
        });
        if(obj.responseText == '1'){
            flag[2] = 0;
        }else{
            flag[2] = 1;
        };
    }
    */
    $('#tbody > tr').each(function(i){
        $('.material_error_'+i).remove();
        $('.brand_error_'+i).remove();
        $('.requirement_error_'+i).remove();
        $('.quantity_ferror_' + i).remove();
        $('.unit_error_'+i).remove();
        $('.quantity_error_'+i).remove();
        $('.numberf_error_' + i).remove();
        $('.arrival_date_error_'+i).remove();
        $('.arrival_place_error_'+i).remove();
        $('.comment_error_'+i).remove();
        $(this).find('input:text').each(function(){
            if(($(this).attr('name') == 'material_name[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="material_error_'+ i + '"style="color:red;width:70px">设备材料名不能为空</div>').insertAfter($(this));
                    flag[3] = 0;
                }else{
                    $('.material_error_' + i ).remove();
                    flag[3] = 1;
                }
            }

            if(($(this).attr('name') == 'brand[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="brand_error_'+ i + '"style="color:red;width:60px">品牌、型号不能为空</div>').insertAfter($(this));
                    flag[4] = 0;
                }else{
                    $('.brand_error_' + i).remove();
                    flag[4] = 1;
                }
            }

            if(($(this).attr('name') == 'technical_requirement[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="requirement_error_'+ i + '"style="color:red;width:50px">技术要求不能为空</div>').insertAfter($(this));
                    flag[5] = 0;
                }else{
                    $('.requirement_error_' + i).remove();
                    flag[5] = 1;
                }
            }

            if(($(this).attr('name') == 'unit[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="unit_error_'+ i + '"style="color:red;width:30px">单位不能为空 </div>').insertAfter($(this));
                    flag[6] = 0;
                }else{
                    $('.unit_error_' + i).remove();
                    flag[6] = 1;
                }
            }

            if(($(this).attr('name') == 'quantity[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="quantity_error_'+ i + '"style="color:red;width:30px">数量不能为空  </div>').insertAfter($(this));
                    flag[7] = 0;
                }else{
                    $('.quantity_error_' + i).remove();
                    flag[7] = 1;
                }
                if($.trim($(this).val()) != ''){
                    if(!/^\d+$/.test($.trim($(this).val()))){
                        $('<div class="numberf_error_'+ i + '"style="color:red;width:30px">数量必须为整数</div>').insertAfter($(this));
                        flag[7] = 0;
                    }else{
                        $('.numberf_error_' + i).remove();
                        flag[7] = 1;
                    }
                }
            }

            if(($(this).attr('name') == 'arrival_date[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="arrival_date_error_'+ i + '"style="color:red;width:70px">到货日期不能为空</div>').insertAfter($(this));
                    flag[8] = 0;
                }else{
                    $('.arrival_date_error_'+ i).remove();
                    flag[8] = 1;
                }
            }

            if(($(this).attr('name') == 'arrival_place[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="arrival_place_error_'+ i + '"style="color:red;width:50px">到货地点不能为空</div>').insertAfter($(this));
                    flag[9] = 0;
                }else{
                    $('.arrival_place_error_' + i).remove();
                    flag[9] = 1;
                }
            }

           if(($(this).attr('name') == 'comment[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="comment_error_'+ i + '"style="color:red;width:50px">备注不能为空</div>') .insertAfter($(this));
                    flag[10] = 0;
                }else{
                    $('.comment_error_' + i).remove();
                    flag[10] = 1;
                }
            }
        });
        //check
        checkStatus[i] = getStatus(flag);
    });
    var status = true;
    for(var k=0; k<checkStatus.length; k++){
        if(checkStatus[k] == '0'){
            status = false;
            break;
        }
    }
    if($('#tbody').html() == false){
        showSaveSuccessfullyMessage('没有明细数据,不能保存');
        return false;
    }
    if(status){
        return true;
    }else{
        return false;
    }


}
function getStatus(arr){
    var flag = 1;
    for(var i=0; i<arr.length; i++){
        if(arr[i] == '0'){
            flag = 0;
            break;
        }
    }
    return flag;
} 
$("input[name='contract_section']").focus();
</script>

