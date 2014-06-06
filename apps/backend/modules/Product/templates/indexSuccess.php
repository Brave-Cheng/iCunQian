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
            <button onclick="return formSubmit('ProductFilter', '<?php echo url_for("Product/edit?" . html_entity_decode(rm2FormGetQuery("sortBy", "sort"))); ?>', 'get');">
                <img src="/images/icons/add.png" alt="<?php echo __('Add Product'); ?>" title="<?php echo __('Add Product'); ?>" />
                <?php echo __('Add Product'); ?>
            </button>
        </p>
    </div>
    <!--form header-->
    <!--table filter-->
    <div class="clear"></div>
    <?php echo form_tag('Product/index', array('name' => 'SearchProductFilter', 'id' => 'SearchProductFilter')); ?>
        <table id="queryTable" class="listingTable searchTable" style="width: 50%; margin-top:5px">
            <tbody><tr>
                <td><label><?php echo __('Product Name')?>:</label> <br>
                <input id="" type="text" name="productName" style="width: 100px" class="hasDatepicker" value="<?php echo $sf_request->getParameter('productName');?>"></td>
                <td><label><?php echo __('Product Bank Name')?>:</label> <br>
                <input id="enddate" type="text" name="productBankName" style="width: 100px" class="hasDatepicker" value="<?php echo $sf_request->getParameter('productBankName');?>"></td>
                <td>
                <button id="Btn" style="width: 90px;">
                <img src="/images/icons/check.png" alt="Submit" title="Submit"> Search</button>
                
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <!--table filter-->
    <div class="clear"></div>    
    <!--page-->
    <div class="pagination mb10" style="float:none;">
        <div class="pagerlist">
            <?php
            if (utilPagerDisplayTotal($pager) > 20) {
                echo utilPagerPages($pager, "Product/index", html_entity_decode(formGetQueryDenyPager("keywords")));
            }
            ?>
            <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条"); ?></span>
        </div>
    </div>
    <div class="clear"></div>
    <!--page-->
    <!-- form tag-->
    <?php echo form_tag('Product/index', array('name' => 'ProductFilter', 'id' => 'ProductFilter')); ?>
    <!-- form tag-->
    <!--table gird-->
    <table class="listingTable highlight" id="sectionDataTable" style="width:100%;">
        <thead>
            <tr class="tree_item_section_head" id="section_head">
                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::ID, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::ID) ?>" title='Sort By Id'><?php echo __("ID") ?></a>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::NAME, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::NAME) ?>" title='Sort By Product Name'><?php echo __("Product Name") ?></a>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::BANK_NAME, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::BANK_NAME) ?>" title='Sort By Bank Name'><?php echo __("Product Bank Name") ?></a>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::REGION, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::REGION) ?>" title='Sort By Region Name'><?php echo __("Product Region Name") ?></a>
                </th>

                <th align="center">
                    <?php echo __("Product Currency") ?>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::PROFIT_TYPE, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::PROFIT_TYPE) ?>" title='Sort By Profit Type'><?php echo __("Product Profit Type") ?></a>
                </th>
                
                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::SALE_START_DATE, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::SALE_START_DATE) ?>" title='Sort By sale date'><?php echo __("Product Start Sale Date") ?></a>
                </th>
                
                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::INVEST_CYCLE, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::INVEST_CYCLE) ?>" title='Sort By invest cycle'><?php echo __("Product Invest Cycle") ?></a>
                </th>
                
                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::EXPECTED_RATE, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::EXPECTED_RATE) ?>" title='Sort By Expected Rate'><?php echo __("Product Expected Rate") ?></a>
                </th>
                
                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::INVEST_START_AMOUNT, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::INVEST_START_AMOUNT) ?>" title='Sort By Invest Start Amount'><?php echo __("Product Invest Start Amount") ?></a>
                </th>
                
                <th align="center">
                    <a href="<?php echo url_for("Product/index?" . rm2FormSort(DepositFinancialProductsPeer::CREATED_AT, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositFinancialProductsPeer::CREATED_AT) ?>" title='Sort By create time'><?php echo __("Create At") ?></a>
                </th>

                <th align="center">

                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pager['results'])): ?>
                <?php foreach ($pager['results'] as $index => $product): ?>
                    <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                        <td width="3%"><?php echo $product->getId(); ?></td>
                        <td width="20%"><?php echo $product->getName(); ?></td>
                        <td width="10%"><?php echo $product->getBankName(); ?></td>
                        <td width="8%"><?php echo $product->getRegion(); ?></td>
                        <td width="6%"><?php echo $product->getCurrency(); ?></td>
                        <td width="12%"><?php echo $product->getProfitType(); ?></td>
                        <td width="9%"><?php echo $product->getSaleStartDate(); ?></td>
                        <td width="5%"><?php echo $product->getInvestCycle(); ?></td>
                        <td width="3%"><?php echo $product->getExpectedRate(); ?></td>
                        <td width="5%"><?php echo $product->getInvestStartAmount(); ?></td>
                        <td width="11%"><?php echo $product->getCreatedAt('Y-m-d H:i'); ?></td>
                        <td width="8%">
                            <a href="<?php echo url_for("Product/edit?id=" . $product->getId() . '&' . html_entity_decode(rm2FormGetQuery("sortBy", "sort"))) ?>" class="edit_small button_small" title="<?php echo __("Edit") ?>" style="float:left;margin-left:5px;" ><?php echo __("Edit") ?></a>
                            <a href="<?php echo url_for("Product/delete?id=" . $product->getId()) ?>" onclick="return dormDeleteConfirm('ProductFilter', this.href);" class="delete_small button_small" title="<?php echo __("Delete") ?>" style="float:left;margin-left:5px;"><?php echo __("Delete") ?></a>
                            <a href="<?php echo url_for("Product/recommend?id=" . $product->getId()) ?>" class="moves_small button_small" title="<?php echo __("Recommend") ?>" style="float:left;margin-left:5px;"><?php echo __("Delete") ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else:?>
                    <tr><td colspan="20"><?php echo __('No Data'); ?></td></tr>
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
                echo utilPagerPages($pager, "Product/index", html_entity_decode(formGetQueryDenyPager("keywords")));
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
