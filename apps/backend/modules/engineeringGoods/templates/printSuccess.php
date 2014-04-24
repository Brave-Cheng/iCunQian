<div class="wrap">
    <div id="full_print"  class="full_width">
        <div class="formDiv pro_form data_display">
            <h3 class="title">物资申购单</h3>
            <div class="left w300 ml20">
                <div class="formItem">
                    <span>申请部门：</span>
                    <div class="iner">
                    <?php echo $application->getDepartment()->getName();?>
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
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php foreach($engineeringGoodsItems as $data):?>
                        <tr class="">
                            <td></td>
                            <td><?php echo $data->getProjectName();?></td>
                            <td><?php echo $data->getBrand();?></td>
                            <td><?php echo $data->getRequireMent();?></td>
                            <td><?php echo $data->getUnit();?></td>
                            <td><?php echo $data->getQuantity();?></td>
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