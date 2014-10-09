<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<!-- float js -->
<style type="text/css">
.searchSelect{width: 150px;}
</style>
<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Purchase/list?' . formGetQueryDenyPager('sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount'), array('name' => 'PurchaseFilter', 'id' => 'PurchaseFilter')); ?>
    <!-- form tag-->
    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Search'); ?></h2>
        <p class="form-buttons">
        </p>
    </div>
    <!--table filter-->
    <div class="clear"></div>
    <?php echo form_tag('Purchase/list?' . formGetQueryDenyPager('sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount'), array('name' => 'SearchPurchaseFilter', 'id' => 'SearchPurchaseFilter')); ?>
        <table id="queryTable" class="listingTable searchTable" style="width: 50%; margin-top:5px">
            <tbody>
                <tr>
                    <td>
                        <label><?php echo __('ID')?>：</label>
                        <?php 
                            echo input_tag('sid', $sf_request->getParameter('sid'));
                        ?>
                    </td>
                    <td>
                        <label><?php echo __('Deposit Member')?>：</label>
                        <?php 
                            echo input_tag('sAccount', $sf_request->getParameter('sAccount'));
                        ?>
                    </td>
                    <td>
                        <label><?php echo __('Product Name')?>：</label>
                        <?php 
                            echo input_tag('sProductName', $sf_request->getParameter('sProductName'));
                        ?>
                    </td>
                    <td>
                        <label><?php echo __('Product Expected Rate')?>：</label>
                        <?php 
                            echo select_tag('sExpectedRate', options_for_select(PushDevicesPeer::createSelectOptions(PushDevicesPeer::getExpectedYields()), $sf_request->getParameter('sExpectedRate')), array('class' => 'searchSelect'));
                        ?>
                    </td>
                    <td>
                        <label><?php echo __('Purchase Amount')?>：</label>
                        <?php 
                            echo select_tag('sAmount', options_for_select(PushDevicesPeer::createSelectOptions(DepositFinancialProductsPeer::getSearchSaleStartAmount()), $sf_request->getParameter('sAmount')), array('class' => 'searchSelect'));
                        ?>
                    </td>
                <td>
                <button id="Btn" style="width: 90px;">
                <img src="/images/icons/check.png" alt="Submit" title="Submit"> 搜素</button>
                
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="clear"></div>   
    <!--table filter-->
    <!--table filter-->
    <!--table filter-->
    
    <!--page-->
    <div class="pagination mb10" style="float:none;">
        <div class="pagerlist">
            <?php
            if (utilPagerDisplayTotal($pager) > 20) {
                echo utilPagerPages($pager, "Purchase/list", formGetQueryDenyPager('sortBy', 'sort', 'sAccount', 'sProductName', 'sExpectedRate', 'sAmount'));
            }
            ?>
            <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条"); ?></span>
        </div>
    </div>
    <div class="clear"></div>
    <!--page-->
    
    <!--table gird-->
    <table class="listingTable highlight" id="sectionDataTable" style="width:100%;">
        <thead>
            <tr class="tree_item_section_head" id="section_head">
                <th width="5%">
                    <a href="<?php echo url_for("Purchase/list?" . rm2FormSort(DepositPersonalProductsPeer::ID, 'sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount')) ?>" class="<?php echo rm2FormSortClass(DepositPersonalProductsPeer::ID) ?>" title="<?php echo __('ID') . __('Sort');?>"><?php echo __("ID") ?></a>
                </th>

                <th width="14%">
                    <?php echo __("Product Name") ?>
                </th>

                <th width="10%">
                    <?php echo __("Deposit Member") ?>
                </th>

                <th width="14%">
                    <a href="<?php echo url_for("Purchase/list?" . rm2FormSort(DepositPersonalProductsPeer::EXPECTED_RATE, 'sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount')) ?>" class="<?php echo rm2FormSortClass(DepositPersonalProductsPeer::EXPECTED_RATE) ?>" title="<?php echo __('Product Expected Rate') . __('Sort');?>"><?php echo __("Product Expected Rate") ?></a>
                </th>

                <th width="15%">
                    <a href="<?php echo url_for("Purchase/list?" . rm2FormSort(DepositPersonalProductsPeer::AMOUNT, 'sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount')) ?>" class="<?php echo rm2FormSortClass(DepositPersonalProductsPeer::AMOUNT) ?>" title="<?php echo __('ID') . __('Sort');?>"><?php echo __("Purchase Amount") ?></a>
                </th>

                <th width="9%">
                    <a href="<?php echo url_for("Purchase/list?" . rm2FormSort(DepositPersonalProductsPeer::BUY_DATE, 'sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount')) ?>" class="<?php echo rm2FormSortClass(DepositPersonalProductsPeer::BUY_DATE) ?>" title="<?php echo __('Purchase Buy Date') . __('Sort');?>"><?php echo __("Purchase Buy Date") ?></a>
                </th>

                <th width="9%">
                    <a href="<?php echo url_for("Purchase/list?" . rm2FormSort(DepositPersonalProductsPeer::EXPIRY_DATE, 'sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount')) ?>" class="<?php echo rm2FormSortClass(DepositPersonalProductsPeer::EXPIRY_DATE) ?>" title="<?php echo __('Purchase Expiry Date') . __('Sort');?>"><?php echo __("Purchase Expiry Date") ?></a>
                </th>

                <th width="12%"><?php 
                        echo link_to(
                            __('Deadline Reminder'), 
                            "Purchase/list?" . rm2FormSort(DepositPersonalProductsPeer::DEADLINE_REMINDER, 'sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount'), 
                            array(
                                "class" => rm2FormSortClass(DepositPersonalProductsPeer::DEADLINE_REMINDER), 
                                "title" => __('Deadline Reminder') . __('Sort')
                            )
                        );?>
                </th>

                <th width="12%">
                    <?php 
                        echo link_to(
                            __('Sync Status'),
                            'Purchase/list?' . rm2FormSort(DepositPersonalProductsPeer::SYNC_STATUS, 'sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount'),
                            array(
                                'class' => rm2FormSortClass(DepositPersonalProductsPeer::SYNC_STATUS),
                                'title' => __('Sync Status') . __('Sort')
                            )
                        );
                    ?>
                </th>
                
            </tr>
        </thead>
        <tbody>
            <?php if (count($pager['results'])): ?>
                <?php foreach ($pager['results'] as $index => $purchase): ?>
                    <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                        <td><?php echo $purchase->getId(); ?></td>
                        <td><span class="ellipsis">
                            <?php
                                if (is_object($purchase->getDepositFinancialProducts())) {
                                    echo $purchase->getDepositFinancialProducts()->getName();    
                                } else {
                                    echo '-';
                                }               
                            ?>
                        </span></td>
                        <td><?php 

                        if (is_object($purchase->getDepositMembers())) {
                            echo $purchase->getDepositMembers()->getNickname();
                        } else {
                            echo "-";
                        }

                        ; ?></td>
                        <td><?php echo $purchase->getFormatExpactedRate(); ?></td>
                        <td><?php echo $purchase->getAmount(); ?></td>
                        <td><?php echo $purchase->getBuyDate('Y-m-d'); ?></td>
                        <td><?php echo $purchase->getExpiryDate('Y-m-d'); ?></td>
                        <td>
                            <?php if ($purchase->getDeadlineReminder() == DepositMembersPeer::YES) :?>
                                <img style="broder:mone;" title="<?php echo __('Yes');?>" alt="<?php echo __('Yes');?>" src="<?php echo util::getDomain();?>/images/icons/running.png">
                            <?php else:?>
                               <img  style="broder:mone;" title="<?php echo __('No');?>" alt="<?php echo __('No');?>" src="<?php echo util::getDomain();?>/images/icons/deactivated.png">
                            <?php endif;?>
                        </td>
                        <td><?php echo $purchase->getFormatSyncStatus(); ?></td>
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
                echo utilPagerPages($pager, "Purchase/list", formGetQueryDenyPager('sortBy', 'sort', 'sAccount', 'sProductName', 'sExpectedRate', 'sAmount'));
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