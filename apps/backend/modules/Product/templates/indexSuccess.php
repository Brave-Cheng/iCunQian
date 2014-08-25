<style type="text/css">
    .actions a{margin: 5px 0;}
</style>
<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<!-- float js -->

<!-- float js to element-->
<div id="tabContent">
    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Product'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('ProductFilter', '<?php echo url_for("Product/add?" . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid'), true); ?>', 'get');">

                <img src="/images/icons/add.png" alt="<?php echo __('Add Product'); ?>" title="<?php echo __('Add Product'); ?>" />
                <?php echo __('Add Product'); ?>
            </button>
        </p>
    </div>
    <!--form header-->
    <!--table filter-->
    <div class="clear"></div>
    <?php echo form_tag('Product/index?' . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid'), array('name' => 'SearchProductFilter', 'id' => 'SearchProductFilter')); ?>
        <table id="queryTable" class="listingTable searchTable" style="width: 46%; margin-top:5px">
            <tbody>
                <tr>
                    <td><label><?php echo __('ID')?>：</label>
                        <?php echo input_tag('sid', $sf_request->getParameter('sid'));?>

                    <td><label><?php echo __('Product Name')?>：</label> 
                        <?php echo input_tag('productName', $sf_request->getParameter('productName'));?>

                    <td><label><?php echo __('Product Bank Name')?>：</label>
                        <?php echo input_tag('productBankName', $sf_request->getParameter('productBankName')); ?>
                    <td>
                    <button id="Btn" style="width: 90px;">
                    <img src="/images/icons/check.png" alt="Submit" title="Submit"> 搜素</button>
                    
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <!--table filter-->
    <!-- shortchar -->
    <div class="clear"></div>    

    <!--page-->
    <div class="pagination mb10" style="float:none;">
        <div class="pagerlist">
            <?php
            if (utilPagerDisplayTotal($pager) > 20) {
                echo utilPagerPages($pager, "Product/index", formGetQueryDenyPager('sort', 'productName', 'productBankName', 'sortBy', 'sid'));
            }
            ?>
            <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条"); ?></span>
        </div>
    </div>
    <div class="clear"></div>
    <!--page-->
    <!-- form tag-->
    <?php echo form_tag('Product/index?' . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid'), array('name' => 'ProductFilter', 'id' => 'ProductFilter')); ?>
    <!-- form tag-->
    <!--table gird-->
    <table class="listingTable highlight" id="sectionDataTable" style="width:100%;">
        <thead>
            <tr class="tree_item_section_head" id="section_head">
                <th width="5%">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::ID, 'sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::ID) ?>" title='<?php echo __('ID') . __('Sort');?>'><?php echo __("ID") ?></a>
                </th>

                <th width="8%">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::NAME, 'sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')); ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::NAME) ?>" title="<?php echo __('Product Name') . __('Sort');?>"><?php echo __("Product Name") ?></a>
                </th>

                <th width="9%">
                    <?php echo __("Product Bank Name") ?>
                </th>

                <th width="10%">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::REGION, 'sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::REGION) ?>" title="<?php echo __('Product Region Name') . __('Sort');?>"><?php echo __("Product Region Name") ?></a>
                </th>

                <th width="7%">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::CURRENCY, 'sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::CURRENCY) ?>" title="<?php echo __('Product Currency') . __('Sort');?>"><?php echo __("Product Currency") ?></a>
                </th>

                <th width="16%">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::PROFIT_TYPE, 'sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::PROFIT_TYPE) ?>" title="<?php echo __('Product Profit Type"') . __('Sort');?>"><?php echo __("Product Profit Type") ?></a>
                </th>
                
                <th width="17%">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::EXPECTED_RATE, 'sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::EXPECTED_RATE) ?>" title="<?php echo __('Product Expected Rate') . __('Sort');?>"><?php echo __("Product Expected Rate") ?></a>
                </th>
                
                <th width="15%">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::INVEST_START_AMOUNT, 'sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::INVEST_START_AMOUNT) ?>" title="<?php echo __('Product Invest Start Amount') . __('Sort');?>"><?php echo __("Product Invest Start Amount") ?></a>
                </th>
                
                <th width="15%">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::CREATED_AT, 'sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::CREATED_AT) ?>" title="<?php echo __('Create At') . __('Sort');?>"><?php echo __("Create At") ?></a>
                </th>

                <th>

                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pager['results'])): ?>
                <?php foreach ($pager['results'] as $index => $product): ?>
                    <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                        <td><?php echo $product->getId(); ?></td>
                        <td><span class="ellipsis"><?php echo $product->getFormatName(); ?></span></td>
                        <td><span class="ellipsisShort"> <?php echo $product->getRealBankName();?></span></td>
                        <td ><span class="ellipsisShort"><?php echo $product->getFormatRegion();?></span></td>
                        <td ><?php echo $product->getCurrency();?></td>
                        <td ><?php echo $product->getProfitType();?></td>
                        <td ><?php echo $product->getFormatExpactedRate(); ?></td>
                        <td ><?php echo $product->getFormatInvestStartAmount(); ?></td>
                        <td ><?php echo $product->getCreatedAt('Y-m-d H:i'); ?></td>
                        <td class="actions">
                            <?php 
                                echo link_to(
                                    __('Edit'), 
                                    'Product/edit?id=' . $product->getId() . '&' . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid'),
                                    array('class' => 'edit_small button_small', 'title' => __('Edit'))
                                );
                            ?>

                            <?php 
                                echo link_to(
                                    __('Delete'),
                                    "Product/delete?id=" . $product->getId(),
                                    array(
                                        'class' => 'delete_small button_small',
                                        'onclick' => "return dormDeleteConfirm('ProductFilter', this.href);",
                                        'title' => __('Delete')
                                    )
                                );
                            ?>

                            <?php 
                                echo link_to(
                                    __('Recommend'),
                                    "Product/recommend?id=" . $product->getId() . '&' . formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid'),
                                    array('class' => 'moves_small button_small', 'title' => __('Recommend'))
                                );
                            ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else:?>
                    <tr><td colspan="20" style="text-align:center"><?php echo __('No Data'); ?></td></tr>
            <?php endif;?>
        </tbody>
    </table>
    <!--table gird-->
    <div class="clear"></div>
    <!--page-->
    <div class="pagination mb10" style="float:none;">
        <div class="pagerlist">
            <?php
            if (utilPagerDisplayTotal($pager) > 20) {
                echo utilPagerPages($pager, "Product/index", formGetQueryDenyPager('sortBy', 'sort', 'productName', 'productBankName', 'pager', 'sid'));
            }
            ?>
            <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条"); ?></span>
        </div>
    </div>
    <div class="clear"></div>
    <!--page-->
</form> 

</div>
<!-- float js to element-->
<script type="text/javascript">
    // $(".ellipsis").mouseenter(function(){
    //     $(this).removeClass('ellipsis');
    // }).mouseleave(function(){
    //     $(this).addClass('ellipsis');
    // })
</script>