<?php include_partial('global/datetimepicker_path'); ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<?php echo javascript_include_tag('comm') ?>
<div class="wrap">
    <?php echo form_tag("engineeringMaterials/update", "id=updateMaterial") ?>
    <input type="hidden" name="applicationId" value="<?php echo $application->getId();?>" />
    <input type="hidden" name="engineeringMaterialsId" value="<?php echo $engineeringMaterials->getId();?>" />
        <div id="main" class="clearfix">
            <div class="full_width">
                <div class="bread_crumbs"> <a href="<?php echo url_for('commitApproval/index');?>">审批流程</a> &gt; <span><?php 
                echo $application->getName();?>页面信息</span> </div>
                <div class="formDiv pro_form">
                    <h3 class="title">设备材料申购单</h3>
                    <div class="left w350">
                        <div class="formItem">
                            <label class="label">合同段：</label>
                            <div class="iner lh30">
                            <?php echo $engineeringMaterials->getContractSection();?>
                            </div>
                        </div>
                    </div>
                    <div class="left w260">
                        <div class="formItem">
                            <label class="label">项目名称：</label>
                            <div class="iner lh30">
                                <?php echo ProjectPeer::retrieveByPk($application->getProjectId())->getName();?>
                            </div>
                        </div>
                    </div>
                    <div class="right mr20">
                        <div class="formItem">
                            <label class="label">编号：</label>
                            <div class="iner lh30">
                            <?php echo $engineeringMaterials->getNumber();?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="tables ex_tabs">
                        <table id="list">
                            <thead>
                                <tr>
                                    <td>细目号</td>
                                    <td>设备材料名</td>
                                    <td>品牌、型号</td>
                                    <td>技术要求</td>
                                    <td>单位</td>
                                    <td>数量</td>
                                    <td>到货日期</td>
                                    <td>到货地点</td>
                                    <td>备注</td>
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
                                    <label class="label">制表人：</label>
                                    <div class="iner lh30"><?php echo $sf_user->getGuardUser()->getProfile()->getLastName() ? htmlspecialchars($sf_user->getGuardUser()->getProfile()->getLastName()) . htmlspecialchars($sf_user->getGuardUser()->getProfile()->getFirstName()) : '系统管理员';?></div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="formItem">
                                    <label class="label">制表日期：</label>
                                    <div class="iner lh30"><?php echo date('Y-m-d');?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn_con">
                        <div class="btns clearfix">
                            <a href="<?php echo url_for('commitApproval/index?' . html_entity_decode(formGetQuery("projectType", "keywords", "applicationId", "approvalId")));?>" class="btn_blue">返回</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
</div>
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