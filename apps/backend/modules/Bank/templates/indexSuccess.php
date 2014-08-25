<style type="text/css">
    #sectionDataTable td{height: 96px;}
    .center a{text-align: center;}
    .ellipsis{ width: 300px;}
    .actions a{margin: 5px; 0;}
</style>
<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<!-- float js -->

<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Bank/index?' . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sbankid' , 'pager'), array('name' => 'bankFilter', 'id' => 'bankFilter')); ?>
    <!-- form tag-->
    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Bank'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
            <button onclick="return formSubmit('bankFilter', '<?php echo url_for("Bank/edit?" . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>', 'get');">
                <img src="/images/icons/add.png" alt="<?php echo __('Add Bank'); ?>" title="<?php echo __('Add Bank'); ?>" />
                <?php echo __('Add Bank'); ?>
            </button>
        </p>
    </div>
    </form>
    <!--table filter-->
    <div class="clear"></div>
    <?php echo form_tag('Bank/index?' . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager'), array('name' => 'SearchBankFilter', 'id' => 'SearchProductFilter')); ?>
        <table id="queryTable" class="listingTable searchTable" style="width: 35%; margin-top:5px">
            <tbody>
                <tr>
                    <td>
                        <label><?php echo __('ID')?>：</label>
                        <?php echo input_tag('sid', $sf_request->getParameter('sid')); ?>
                    </td>

                    <td>
                        <label><?php echo __('Bank Name')?>：</label>
                        <?php echo input_tag('sname', $sf_request->getParameter('sname')); ?>
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
                echo utilPagerPages($pager, "Bank/index", formGetQueryDenyPager('sortBy', 'sname', 'sid', 'sort'));
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
                <th align="center" width="6%">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::ID, 'sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::ID) ?>" title='<?php echo __('ID') . __('Sort');?>'><?php echo __("ID") ?></a>
                </th>

                <th align="center" width="20%">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::NAME, 'sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::NAME) ?>" title='<?php echo __('Bank Name') . __('Sort');?>'><?php echo __("Bank Name") ?></a>
                </th>

                <th align="center" width="20%">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::SHORT_NAME, 'sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::SHORT_NAME) ?>" title='<?php echo __('Bank Short Name') . __('Sort');?>'><?php echo __("Bank Short Name") ?></a>
                </th>

                <th align="center" width="12%">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::PHONE, 'sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::PHONE) ?>" title='<?php echo __('Bank Phone') . __('Sort');?>'><?php echo __("Bank Phone") ?></a>
                </th>

                <th align="center" width="12%">
                    <?php echo __("Bank Logo") ?>
                </th>

                <th align="center" width="11%">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::IS_VALID, 'sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::IS_VALID) ?>" title='<?php echo __('Is Valid') . __('Sort');?>'><?php echo __("Is Valid") ?></a>
                </th>

                <th align="center" width="19%">
                    <a href="<?php echo url_for("Bank/index?" . rm2FormSort(DepositBankPeer::CREATED_AT, 'sortBy', 'sort', 'sname', 'sid' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositBankPeer::CREATED_AT) ?>" title='<?php echo __('Create At') . __('Sort');?>'><?php echo __("Create At") ?></a>
                </th>

                <th align="center" width="4%">

                </th>

            </tr>
        </thead>
        <tbody>
            <?php if (count($pager['results'])): ?>
                <?php foreach ($pager['results'] as $index => $bank): ?>
                    <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                        <td><?php echo $bank->getId(); ?></td>
                        <td><span class="ellipsis"><?php echo $bank->getName(); ?></span></td>
                        <td><span class="ellipsisShort"><?php echo $bank->getFormatShortName(); ?></span></td>
                        <td><?php echo $bank->getFormatPhone();?></td>
                        <td>

                            <?php if ($bank->getLogo()):?>
                                <a href="<?php echo $bank->getLogo()?>"><img width="96" height="96" src="<?php echo  $bank->getLogo();?>"></a>
                            <?php else:?>
                            -
                            <?php endif;?>
                        </td>
                        <td class="center">
                            <?php if ($bank->getIsValid() == 1) :?>
                                <img style="broder:mone;" title="<?php echo __('Yes Valid');?>" alt="<?php echo __('Yes Valid');?>" src="<?php echo util::getDomain();?>/images/icons/running.png">
                            <?php else:?>
                               <img  style="broder:mone;" title="<?php echo __('No Valid');?>" alt="<?php echo __('No Valid');?>" src="<?php echo util::getDomain();?>/images/icons/deactivated.png">
                            <?php endif;?>

                        </td>
                        <td><?php echo $bank->getCreatedAt(); ?></td>
                        
                        <td class="actions">

                            <?php 
                                echo link_to(
                                    __('Edit'), 
                                    'Bank/edit?id=' . $bank->getId() . '&' . formGetQueryDenyPager('sortBy', 'sort', 'sname', 'sid' , 'pager'),
                                    array('class' => 'edit_small button_small', 'title' => __('Edit'))
                                );
                            ?>

                            <?php
                                if (is_null(DepositBankPeer::hasBankProducts($bank->getId()))) {
                                    echo link_to(
                                        __('Delete'),
                                        'Bank/Delete?id=' . $bank->getId(),
                                        array(
                                            'class'     => 'delete_small button_small',
                                            'onclick'   => "return dormDeleteConfirm('bankFilter', this.href);",
                                            'title'     => __('Delete')
                                        )
                                    );
                                }
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
                echo utilPagerPages($pager, "Bank/index", formGetQueryDenyPager('sort', 'sname', 'sid', 'sortBy'));
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