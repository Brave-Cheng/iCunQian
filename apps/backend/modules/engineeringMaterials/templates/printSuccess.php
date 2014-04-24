<div class="wrap">
            <div id="full_print"  class="full_width">
                <div class="formDiv pro_form ">
                    <h3 class="title">设备材料申购单</h3>
                    <div class="left w350 ml20">
                        <div class="formItem">
                            <span class="blue">合同段：</span>
                            <span>
                                <?php echo $engineeringMaterials->getContractSection();?>
                            </span>
                        </div>
                    </div>
                    <div class="left w260">
                        <div class="formItem">
                            <span class="blue">项目名称：</span>
                            <span >
                                <?php echo ProjectPeer::retrieveByPk($application->getProjectId())->getName();?>
                            </span>
                        </div>
                    </div>
                    <div class="right mr20">
                        <div class="formItem">
                            <span class="blue">编号：</span>
                            <span>
                               <?php echo $engineeringMaterials->getNumber();?>
                            </span>
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
                                    <label class="color">制表人：</label>
                                    <div class="inblock ">
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
                                    <label class="color">制表日期：</label>
                                    <div class="inblock"><?php echo date('Y-m-d');?></div>
                                </div>
                            </div>
                        </div>
                    
                        <?php include_partial('global/printPartial', array('id' => $sf_params->get('id'))) ?>
                    </div>
                </div>
            </div>
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