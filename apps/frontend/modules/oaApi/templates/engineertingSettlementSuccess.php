<div class="app_wrap">
    <div id="app_main" class="clearfix">
        <h2 class="title"><?php echo $name?></h2>
        <table>
            <tr>
                <td>项目名称：</td>
                <td><?php echo $project->getName()?></td>
            </tr>
            <tr>
                <td>施工单位：</td>
                <td><?php echo $obj->getConstructionUnit()?></td>
            </tr>
            <tr>
                <td>截止日期：</td>
                <td><?php echo $obj->getExpirationDate()?></td>
            </tr>
            <tr>
                <td>合同号：</td>
                <td><?php echo $obj->getContractNumber()?></td>
            </tr>
            <tr>
                <td>期 号：</td>
                <td><?php echo $obj->getIssue()?></td>
            </tr>
            <tr>
                <td>合同金额：</td>
                <td><?php echo $obj->getContractAmount()?></td>
            </tr>
            <tr>
                <td>本期完成工程额：</td>
                <td><?php echo $obj->getCurrentCompleteEngineering()?></td>
            </tr>
            <tr>
                <td>累计完成工程总额：</td>
                <td><?php echo $obj->getTotalCompleteEngineering()?>
            </tr>
            <tr>
                <td>已支付(预付)金额：</td>
                <td><?php echo $obj->getPrepayment()?></td>
            </tr>
            <tr>
                <td>本次申请支付金额：</td>
                <td><?php echo $obj->getApplyPayment()?></td>
            </tr>
            <tr>
                <td>变更金额：</td>
                <td><?php echo $obj->getChangeAmount()?></td>
            </tr>
            <tr>
                <td>本次扣保留金  %：</td>
                <td><?php echo $obj->getCurrentFastenerRetention()?></td>
            </tr>
            <tr>
                <td>累计扣保留金  %：</td>
                <td><?php echo $obj->getChangedAmount()?></td>
            </tr>
            <tr>
                <td>本期应付金额：</td>
                <td><?php echo $obj->getCurrentPayable()?></td>
            </tr>
            <tr>
                <td>累计应支付金额：</td>
                <td><?php echo $obj->getTotalPayable()?></td>
            </tr>
        </table>
   </div>
</div>
