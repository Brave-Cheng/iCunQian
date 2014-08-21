<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<!-- float js -->
<style type="text/css">
.searchSelect{width: 150px;}
.s1, .s2, .s3, .s4{display: none;}
.loadShow{display: table-cell;}
.ellipsis{width: 500px;}
</style>
<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Purchase/statistics?' . formGetQueryDenyPager('sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount'), array('name' => 'PurchaseFilter', 'id' => 'PurchaseFilter')); ?>
    <!-- form tag-->

    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Statistics'); ?></h2>
        <p class="form-buttons">
        </p>
    </div>
    <!--table filter-->
    <div class="clear"></div>
    <?php echo form_tag('Purchase/statistics?' . formGetQueryDenyPager('sortBy', 'sort', 'sAccount', 'sProductName' , 'pager', 'sExpectedRate', 'sAmount'), array('name' => 'SearchPurchaseFilter', 'id' => 'SearchPurchaseFilter')); ?>
        <table id="queryTable" class="listingTable searchTable" style="margin-top:5px">
            <tbody>
                <tr>
                    <td>
                        <label><?php echo __('By Statistics')?>：</label>
                        <?php 
                            echo select_tag('sFilter', options_for_select(DepositPersonalProductsPeer::getSearchLists(), $sf_request->getParameter('sFilter')), array('class' => 'searchSelect', 'onchange' => "loadShow(this) "));
                        ?>
                    </td>

                    <td class="s1 <?php if (($sf_request->hasParameter('sBankName') && $sf_request->getParameter('sFilter') == 1) || $sFilter == 1) echo "loadShow";?>">
                        <label><?php echo __('Product Bank Name'); ?>：</label>
                        <?php echo input_tag('sBankName', $sf_request->getParameter('sBankName')); ?>
                    </td>
                    <td class="s2 <?php if ($sf_request->hasParameter('sProfitType') && $sf_request->getParameter('sFilter') == 2) echo "loadShow";?>">
                        <label><?php echo __('Product Profit Type'); ?>：</label>
                        <?php echo select_tag('sProfitType', options_for_select($attributes['profit_type'], $sf_request->getParameter('sProfitType')), array('class' => 'searchSelect'));?>
                    </td>

                    <td class="s3 <?php if ($sf_request->hasParameter('sAmount') && $sf_request->getParameter('sFilter') == 3) echo "loadShow";?>">
                        <label><?php echo __('Purchase Amount')?>：</label>
                        <?php 
                            echo select_tag('sAmount', options_for_select(PushDevicesPeer::createSelectOptions(DepositFinancialProductsPeer::getSearchSaleStartAmount()), $sf_request->getParameter('sAmount')), array('class' => 'searchSelect'));
                        ?>
                    </td>

                     <td class="s4 <?php if ($sf_request->hasParameter('sExpectedRate') && $sf_request->getParameter('sFilter') == 4) echo "loadShow";?>">
                        <label><?php echo __('Product Expected Rate')?>：</label>
                        <?php 
                            echo select_tag('sExpectedRate', options_for_select(PushDevicesPeer::createSelectOptions(PushDevicesPeer::getExpectedYields()), $sf_request->getParameter('sExpectedRate')), array('class' => 'searchSelect'));
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
    <div id="syncContent">
        <div class="pagination mb10" style="float:none;">
            <div class="pagerlist">
                <?php
                if (utilPagerDisplayTotal($pager) > 20) {
                    echo utilPagerPages($pager, "Purchase/statistics", formGetQueryDenyPager('sortBy', 'sort', 'sAccount', 'sProductName', 'sExpectedRate', 'sAmount'));
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

                    <th width="50%">
                        <?php echo __("Product Name") ?>
                    </th>

                    <th width="25%">
                        <?php echo __("Product Purchase Person") ?>
                    </th>

                    <th width="25%">
                        <?php echo __("Product Purchase Amount") ?>
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if (count($pager['results'])): ?>
                    <?php foreach ($pager['results'] as $index => $purchase): ?>
                        <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                            <td><span class="ellipsis"><?php echo $purchase[0]; ?></span></td>
                            <td><?php echo isset($purchase[1]) ? $purchase[1] : '-'; ?></td>
                            <td><?php echo isset($purchase[2]) ? intval($purchase[2]) : '-'; ?></td>
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
                    echo utilPagerPages($pager, "Purchase/statistics", formGetQueryDenyPager('sortBy', 'sort', 'sAccount', 'sProductName', 'sExpectedRate', 'sAmount'));
                }
                ?>
                <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条"); ?></span>
            </div>
        </div>
        <div class="clear"></div>
    
    </div>
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
    // 
    

    function loadShow(object) {
        $("#sProfitType, #sAmount, #sExpectedRate, #sBankName").val('');
        
        switch(object.value) {
            case '1':
                $(".s1").css('display', 'table-cell');
                $(".s2, .s3, .s4").css('display', 'none');
                
                break;
            case '2': 
                $(".s2").css('display', 'table-cell');
                $(".s1, .s3, .s4").css('display', 'none');
                
                break;
            case '3':
                $(".s3").css('display', 'table-cell');
                $(".s1, .s2, .s4").css('display', 'none');
                break;
            case '4':
                $(".s4").css('display', 'table-cell');
                $(".s1, .s3, .s2").css('display', 'none');
                break;    
        }
    }
</script>