<div class="app_wrap">
    <div id="app_main" class="clearfix">
        <h2 class="title"><?php echo $name?></h2>
        <div class="part">
            <h3>申请部门：<?php echo DepartmentPeer::retrieveByPK($obj->getDepartmentId()) ? DepartmentPeer::retrieveByPK($obj->getDepartmentId())->getName() : null?></h3>
        </div>
        </table>
        <?php $items = $obj->getEngineeringGoodsItemss()?>
        <?php foreach ($items as $key => $item){?>
        <table>
                <tr class="name">
                    <td>申购项目：</td>
                    <td><?php echo $item->getProjectName()?><span class="num">[<?php echo $item->getQuantity()?>-<?php echo $item->getUnit()?>]</span></td>
                </tr>
                <tr>
                    <td >规格型号：</td>
                    <td><?php echo $item->getBrand()?></td>
                </tr>
                <tr>
                    <td>用途：</td>
                    <td><?php echo $item->getRequirement()?></td>
                </tr>
                <tr>
                    <td>备注：</td>
                    <td><?php echo $item->getComment()?></td>
                </tr>
        </table>
        <?php }?>
   </div>
</div>
