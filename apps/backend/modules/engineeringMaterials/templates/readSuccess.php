<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<?php echo form_tag("engineeringMaterials/update", "id=updateMaterial") ?>
<input type="hidden" name="id" value="<?php echo $application->getId();?>" />
<input type="hidden" name="engineeringMaterialsId" value="<?php echo $engineeringMaterials->getId();?>" />
    <div id="main" class="clearfix">
        <div class="full_width">
            <div class="bread_crumbs"> <a href="<?php echo url_for('commitApproval/index');?>">审批流程</a> &gt; <span>查看审批</span> </div>
            <a class="btn_blue right mt5 mr5" target="_blank"  href="<?php echo url_for('engineeringMaterials/print?' . html_entity_decode(formGetQuery("approvalType", "id", "projectType", "keywords", "applicationId", "approvalId")))?>"><?php echo __('打印预览')?></a>
            <div class="formDiv pro_form data_display">
                <h3 class="title">设备材料申购单</h3>
                <div class="left w300 ml20">
                    <div class="formItem">
                        <span>合同段：</span>
                        <div class="iner">
                        <?php echo $engineeringMaterials->getContractSection();?>
                        </div>
                    </div>
                </div>
                <div class="left w260">
                    <div class="formItem">
                        <span>项目名称：</span>
                        <div class="iner">
                            <?php echo ProjectPeer::retrieveByPk($application->getProjectId())->getName();?>
                        </div>
                    </div>
                </div>
                <div class="right mr20">
                    <div class="formItem">
                        <span>编号：</span>
                        <div class="iner">
                        <?php echo $engineeringMaterials->getNumber();?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="tables ex_tabs">
                    <table id="list">
                        <thead>
                            <tr>
                                <td class="w40">细目号</td>
                                <td class="w40">设备材料名</td>
                                <td class="w40">品牌、型号</td>
                                <td class="w40">技术要求</td>
                                <td class="w40">单位</td>
                                <td class="w40">数量</td>
                                <td class="w40">到货日期</td>
                                <td class="w60">到货地点</td>
                                <td class="w60">备注</td>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        <?php foreach($engineeringMaterialsItems as $data):?>
                            <tr class="">
                                <td></td>
                                <td><?php echo $data->getMaterialName();?></td>
                                <td><?php echo $data->getBrand();?></td>
                                <td><?php echo $data->getTechnicalRequireMent();?></td>
                                <td><?php echo $data->getUnit();?></td>
                                <td><?php echo $data->getQuantity();?></td>
                                <td><?php echo $data->getArrivalDate();?></td>
                                <td><?php echo $data->getArrivalPlace();?></td>
                                <td><?php echo $data->getComment();?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <div class="clearfix mt15">
                        <div class="left">
                            <div class="formItem">
                                <span>制表人：</span>
                                <div class="iner">
                                <?php
                                $user = $application->getsfGuardUser()->getProfile();
                                if($user->getLastName()){
                                    echo $user->getLastName() . $user->getFirstName();
                                }else{
                                    echo '系统管理员';
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="formItem">
                                <span>制表日期：</span>
                                <div class="iner"><?php echo date('Y-m-d');?></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt10">
                        <?php include_partial('global/approveresultpartial', array('applicationResults' => $applicationResults, 'application' => $application)) ?>
                    </div>
                </div>
                <div class="btn_con">
                    <div class="btns clearfix w60">
                        <a href="<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery("projectType", "keywords", "applicationId", "approvalId")));?>" class="btn_blue">返回</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
<script type="text/javascript">
$(function(){
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
</script>