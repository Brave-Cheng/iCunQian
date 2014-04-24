<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<div class="wrap">
    <?php echo form_tag("engineeringGoods/update?" . html_entity_decode(formGetQuery("projectType", "keywords", "applicationId", "approvalId")), "id=insertMaterial") ?>
    <input type="hidden" name="id" value="<?php echo $application->getId();?>" />
    <input type="hidden" name="engineeringGoodsId" value="<?php echo $engineeringGoods->getId();?>" />
        <div id="main" class="clearfix">
            <div class="full_width">
                <div class="bread_crumbs"> <a class="jump" href="<?php echo url_for('commitApproval/index');?>">审批流程</a> &gt; <a class="jump" href="<?php echo url_for('commitApproval/selectApprovalType');?>">新建审批</a> &gt; <span>第二步：填写申请表单</span> </div>
                <div class="formDiv pro_form data_display">
                    <h3 class="title">物资申购单</h3>
                    <div class="left w260 ml20">
                        <div class="formItem">
                            <span class="left lh30 alignRight">申请部门：</span>
                            <div class="iner">
                                <select class="select" name="department" id="department">
                                    <option value=""><?php echo __('选择部门') ?></option>
                                    <?php echo objects_for_select($departments, 'getId', 'getName', $application->getDepartmentId()) ?>
                                </select>
                                <div id="project_div" class="error"><?php echo __(form_span_error("department")); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="clear"></div>
                    <div class="tables ex_tabs">
                        <table id="list">
                            <thead>
                                <tr>
                                    <td class="w40">细目号</td>
                                    <td class="w90">申购项目</td>
                                    <td class="w70">规格型号</td>
                                    <td class="w70">用途</td>
                                    <td class="w50">单位</td>
                                    <td class="w50">数量</td>
                                    <td class="w70">备注</td>
                                    <td class="w40">操作</td>
                                </tr>
                                <tr><td class="partition" colspan="10"></td></tr>
                            </thead>
                            <tbody id="tbody">
                                <?php foreach($engineeringGoodsItems as $data):?>
                                <tr class="1">
                                    <td>1</td>
                                    <td><input type="text" name="project_name[]" class="txt w70" value="<?php echo $data->getProjectName();?>" /></td>
                                    <td><input type="text" name="brand[]" class="txt w60" value="<?php echo $data->getBrand();?>" /></td>
                                    <td><input type="text" name="requirement[]" class="txt w50" value="<?php echo $data->getRequireMent();?>" /></td>
                                    <td><input type="text" name="unit[]" class="txt w30" value="<?php echo $data->getUnit();?>" /></td>
                                    <td><input type="text" name="quantity[]" class="txt w30 quantity" value="<?php echo $data->getQuantity();?>" /></td>
                                    <td><input type="text" name="comment[]" class="txt w50" value="<?php echo $data->getComment();?>" /></td>
                                    <td><a href="javascript:void(0);" onclick="javascript:removeOption(this);">删除</a></td>
                                </tr>
                                <?php endforeach;?>
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
$(".jump").leaveCheck({formId:'insertMaterial',formUrl:'<?php echo url_for('engineeringGoods/checkEngineeringGoods?' . html_entity_decode(formGetQuery('department', 'pager'))); ?>'});
$(function(){
    initData();
    var msg = '<?php echo $sf_request->getParameter("msg");?>';
    if(msg == '1'){
        showSaveSuccessfullyMessage(null, '<?php echo url_for("commitApproval/index?" .  html_entity_decode(formGetQuery("projectType", "keywords", "applicationId", "approvalId"))); ?>');
    }
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
    str += '<td><input type="text" name="project_name[]" class="txt w70" value="" /></td>';
    str += '<td><input type="text" name="brand[]" class="txt w60" value="" /></td>';
    str += '<td><input type="text" name="requirement[]" class="txt w50" value="" /></td>';
    str += '<td><input type="text" name="unit[]" class="txt w30" value="" /></td>';
    str += '<td><input type="text" name="quantity[]" class="txt w30 quantity" value="" /></td>';
    str += '<td><input type="text" name="comment[]" class="txt w50" value="" /></td>';
    str += '<td><a href="javascript:void(0);" onclick="javascript:removeOption(this);">删除</a></td>';
    str += '</tr>';
    $('#list').append(str);
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
    $('.department_error').remove();

    if($('#department').val() == ''){
        $('<div class="department_error" style="color:red">部门必选</div>').insertAfter($('#department').parent());
        flag[0] = 0;
    }else{
        $('.department_error').remove();
        flag[0] = 1;
    }
    $('#tbody > tr').each(function(i){
        $('.goods_project_error_'+i).remove();
        $('.brand_error_'+i).remove();
        $('.requirement_error_'+i).remove();
        $('.quantity_ferror_' + i).remove();
        $('.unit_error_'+i).remove();
        $('.quantity_error_'+i).remove();
        $('.numberf_error_' + i).remove();
        $('.comment_error_'+i).remove();
        $(this).find('input:text').each(function(){
            if(($(this).attr('name') == 'project_name[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="goods_project_error_'+ i + '"style="color:red;width:70px">申购项目不能为空</div>').insertAfter($(this));
                    flag[1] = 0;
                }else{
                    $('.goods_project_error_' + i ).remove();
                    flag[1] = 1;
                }
            }

            if(($(this).attr('name') == 'brand[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="brand_error_'+ i + '"style="color:red;width:60px">规格型号不能为空</div>').insertAfter($(this));
                    flag[2] = 0;
                }else{
                    $('.brand_error_' + i).remove();
                    flag[2] = 1;
                }
            }

            if(($(this).attr('name') == 'requirement[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="requirement_error_'+ i + '"style="color:red;width:50px">用途不能为空</div>').insertAfter($(this));
                    flag[3] = 0;
                }else{
                    $('.requirement_error_' + i).remove();
                    flag[3] = 1;
                }
            }

            if(($(this).attr('name') == 'unit[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="unit_error_'+ i + '"style="color:red;width:30px">单位不能为空 </div>').insertAfter($(this));
                    flag[4] = 0;
                }else{
                    $('.unit_error_' + i).remove();
                    flag[4] = 1;
                }
            }

            if(($(this).attr('name') == 'quantity[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="quantity_error_'+ i + '"style="color:red;width:30px">数量不能为空  </div>').insertAfter($(this));
                    flag[5] = 0;
                }else{
                    $('.quantity_error_' + i).remove();
                    flag[5] = 1;
                }
                if($.trim($(this).val()) != ''){
                    if(!/^\d+$/.test($.trim($(this).val()))){
                        $('<div class="numberf_error_'+ i + '"style="color:red;width:30px">数量必须为整数</div>').insertAfter($(this));
                        flag[6] = 0;
                    }else{
                        $('.numberf_error_' + i).remove();
                        flag[6] = 1;
                    }
                }
            }

           if(($(this).attr('name') == 'comment[]')){
                if($.trim($(this).val()) == ''){
                    $('<div class="comment_error_'+ i + '"style="color:red;width:50px">备注不能为空</div>') .insertAfter($(this));
                    flag[7] = 0;
                }else{
                    $('.comment_error_' + i).remove();
                    flag[7] = 1;
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

</script>

