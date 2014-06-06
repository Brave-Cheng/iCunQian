<?php
$tree =  new Dtree('Nav');

$user = util::getUser();
$userEnglishName = $user->getProfile() ? $user->getProfile()->getEnglishName() : 'admin';

$tree->node(__("Bank"));
$tree->leaf(__("Bank"), url_for("Bank/index"));

$tree->node(__("Product"));
$tree->leaf(__("Product"), url_for("Product/index"));
$tree->leaf(__("Product Excel Import"), url_for("Product/import"));

?>
<div id="maximizer" onclick="fullView()" style="width:10px;top:20px"><img src="/images/icons/arrow_collapse.png" alt="Hide Navigation" /></div>
    <div id="navColumn">
        <div id="dTreeNav">
            <script type="text/javascript">
            <?php echo $tree; ?>
            </script>
        </div>
</div>
