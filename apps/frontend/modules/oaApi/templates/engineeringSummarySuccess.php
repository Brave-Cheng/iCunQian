<div class="app_wrap">
    <div id="app_main" class="clearfix">
        <h2 class="title"><?php echo $name?></h2>
        <table>
            <tr>
                <td>项目名称：</td>
                <td><?php echo $project->getName()?></td>
            </tr>
            <tr>
                <td>合同号：</td>
                <td><?php echo $obj->getContractNumber()?></td>
            </tr>
            <tr>
                <td>期号：</td>
                <td><?php echo $obj->getIssue()?></td>
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
                <td>到本期末完成金额合计：</td>
                <td><?php echo $obj->getTotalCurrentFinishAmount()?></td>
            </tr>
            <tr>
                <td>到上期末完成金额合计：</td>
                <td><?php echo $obj->getTotalLastFinishAmount()?></td>
            </tr>
            <tr>
                <td>本期完成金额合计：</td>
                <td><?php echo $obj->getTotalFinishAmount()?>
            </tr>
        </table>
        <?php $items = $obj->getEngineeringSummaryItemss()?>
        <?php foreach ($items as $key => $item){?>
        <table>
                <tr>
                    <td>项目内容：</td>
                    <td><?php echo $item->getProjectContent()?></td>
                </tr>
                <tr>
                    <td>合同工程量：</td>
                    <td><?php echo $item->getContractQuantity()?></td>
                </tr>
                <tr>
                    <td>增减工程量+-：</td>
                    <td><?php echo $item->getFloatQuantity()?></td>
                </tr>
                <tr>
                    <td>到本期末完成金额：</td>
                    <td><?php echo $item->getCurrentFinishAmount()?></td>
                </tr>
                <tr>
                    <td>到上期末完成金额：</td>
                    <td><?php echo $item->getLastFinishAmount()?></td>
                </tr>
                <tr>
                    <td>本期完成金额：</td>
                    <td><?php echo $item->getFinishAmount()?></td>
                </tr>
                <tr>
                    <td>完成%：</td>
                    <td><?php echo $item->getFinishPercent()?></td>
                </tr>
                <tr>
                    <td>备注：</td>
                    <td><?php echo $item->getComment()?></td>
                </tr>
        </table>
        <?php }?>
   </div>
</div>
