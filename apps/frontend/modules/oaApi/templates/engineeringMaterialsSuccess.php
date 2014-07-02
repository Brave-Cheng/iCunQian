<div class="app_wrap">
    <div id="app_main" class="clearfix">
        <div class="full_width">
                <h2 class="title"><?php echo $name?></h2>
                <table>
                    <tr>
                        <td>项目名称：</td>
                        <td><?php echo $project->getName()?></td>
                    </tr>
                    <tr>
                        <td>合同段：</td>
                        <td><?php echo $obj->getContractSection()?></td>
                    </tr>
                    <tr>
                        <td>编号：</td>
                        <td><?php echo $obj->getNumber()?></td>
                    </tr>
                </table>
                <?php $items = $obj->getEngineeringMaterialsItemss()?>
                <?php foreach ($items as $key => $item){?>
                <table>
                        <tr>
                            <td>设备材料名：</td>
                            <td><?php echo $item->getMaterialName()?></td>
                        </tr>
                        <tr>
                            <td>品牌、型号：</td>
                            <td><?php echo $item->getBrand()?></td>
                        </tr>
                        <tr>
                            <td>技术要求+-：</td>
                            <td><?php echo $item->getTechnicalRequirement()?></td>
                        </tr>
                        <tr>
                            <td>单位：</td>
                            <td><?php echo $item->getUnit()?></td>
                        </tr>
                        <tr>
                            <td>数量：</td>
                            <td><?php echo $item->getQuantity()?></td>
                        </tr>
                        <tr>
                            <td>到货日期：</td>
                            <td><?php echo $item->getArrivalDate()?></td>
                        </tr>
                        <tr>
                            <td>到货地点：</td>
                            <td><?php echo $item->getArrivalPlace()?></td>
                        </tr>
                        <tr>
                            <td>备注：</td>
                            <td><?php echo $item->getComment()?></td>
                        </tr>
                </table>
                <?php }?>
          </div>
   </div>
