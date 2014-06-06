<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<!-- float js -->

<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Bank/index', array('name' => 'bankFilter', 'id' => 'bankFilter')); ?>
    <!-- form tag-->
    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Bank'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('bankFilter', '<?php echo url_for("Bank/edit?" . html_entity_decode(rm2FormGetQuery("sortBy", "sort"))); ?>', 'get');">
                <img src="/images/icons/add.png" alt="<?php echo __('Add Bank'); ?>" title="<?php echo __('Add Bank'); ?>" />
                <?php echo __('Add Bank'); ?>
            </button>
        </p>
    </div>
    <!--form header-->
    <!--table filter-->
    <!--table filter-->
    
    <!--page-->
    <div class="pagination mb10" style="float:none;">
        <div class="pagerlist">
            <?php
            if (utilPagerDisplayTotal($pager) > 20) {
                echo utilPagerPages($pager, "Bank/index", html_entity_decode(formGetQueryDenyPager("keywords")));
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
                <th align="center">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::ID, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::ID) ?>" title='Sort By Id'><?php echo __("ID") ?></a>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::NAME, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::NAME) ?>" title='Sort By Name'><?php echo __("Bank Name") ?></a>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::SHORT_NAME, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::SHORT_NAME) ?>" title='Sort By Short Name'><?php echo __("Bank Short Name") ?></a>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::PHONE, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::PHONE) ?>" title='Sort By Phone'><?php echo __("Bank Phone") ?></a>
                </th>

                <th align="center">
                    <?php echo __("Bank Logo") ?>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::IS_VALID, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::IS_VALID) ?>" title='Sort By valid'><?php echo __("Is Valid") ?></a>
                </th>

                <th align="center">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::CREATED_AT, "pid")) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::CREATED_AT) ?>" title='Sort By create time'><?php echo __("Create At") ?></a>
                </th>

                <th align="center">

                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pager['results'])): ?>
                <?php foreach ($pager['results'] as $index => $bank): ?>
                    <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                        <td><?php echo $bank->getId(); ?></td>
                        <td><?php echo $bank->getName(); ?></td>
                        <td><?php echo $bank->getShortName(); ?></td>
                        <td><?php echo $bank->getPhone(); ?></td>
                        <td>
                            <a href="<?php echo "http://" . $sf_request->getHost() . '/' . strtr($bank->getLogo(), '\\', '/'); ?>"><img width="96" height="96" src="<?php echo "http://" . $sf_request->getHost() . '/' . strtr($bank->getLogo(), '\\', '/'); ?>"></a>
                        </td>
                        <td><?php echo $bank->getIsValid() == 1 ? __('Yes Valid') : __('No Valid'); ?></td>
                        <td><?php echo $bank->getCreatedAt(); ?></td>
                        
                        <td>
                            <a href="<?php echo url_for("Bank/edit?id=" . $bank->getId() . '&' . html_entity_decode(rm2FormGetQuery("sortBy", "sort"))) ?>" class="edit_small button_small" title="<?php echo __("Edit") ?>" style="float:left;margin-left:10px;"><?php echo __("Edit") ?></a>
                            <a href="<?php echo url_for("Bank/delete?id=" . $bank->getId()) ?>" onclick="return dormDeleteConfirm('bankFilter', this.href);" class="delete_small button_small" title="<?php echo __("Delete") ?>" style="float:left;margin-left:10px;"><?php echo __("Delete") ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else:?>
                    <tr><td><?php echo __('No Data'); ?></td></tr>
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
                echo utilPagerPages($pager, "Bank/index", html_entity_decode(formGetQueryDenyPager("keywords")));
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
