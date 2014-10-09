<style type="text/css">
    .center a{text-align: center;}
    .ellipsis{ width: 600px;}
    .actions a{margin: 5px; 0;}
</style>
<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<!-- float js -->

<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Station/index?' . formGetQueryDenyPager('sortBy', 'sort', 'sid', 'sTitle', 'snickname' , 'pager'), array('name' => 'stationFilter', 'id' => 'stationFilter')); ?>
    <!-- form tag-->
    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Station'); ?></h2>
        <p class="form-buttons">
            <!-- Save Button -->
        </p>
    </div>
    </form>
    <!--table filter-->
    <div class="clear"></div>
    <?php echo form_tag('Station/index?' . formGetQueryDenyPager('sortBy', 'sort', 'sid', 'sTitle', 'snickname' , 'pager'), array('name' => 'SearchStationFilter', 'id' => 'SearchStationFilter')); ?>
        <table id="queryTable" class="listingTable searchTable" style="width: 35%; margin-top:5px">
            <tbody>
                <tr>
                    <td>
                        <label><?php echo __('ID')?>：</label>
                        <?php echo input_tag('sid', $sf_request->getParameter('sid')); ?>
                    </td>

                    <td>
                        <label><?php echo __('Title')?>：</label>
                        <?php echo input_tag('sTitle', $sf_request->getParameter('sTitle')); ?>
                    </td>

                    <td>
                        <label><?php echo __('Nickname')?>：</label>
                        <?php echo input_tag('sNickname', $sf_request->getParameter('sNickname')); ?>
                    </td>

                    
                    <td>
                    <button id="Btn" style="width: 90px;">
                    <img src="/images/icons/check.png" alt="Submit" title="Submit"><?php echo __('Search'); ?></button>
                    
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
                echo utilPagerPages($pager, "Station/index", formGetQueryDenyPager('sortBy', 'sort', 'sid', 'sTitle', 'snickname'));
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
                <th width="10%">
                    <?php echo __("ID") ?>
                </th>
                <th width="15%">
                    <?php echo __("Nickname") ?>
                </th>
                <th width="10%">
                    <?php echo __("Station Status") ?>
                </th>
                <th width="15%">
                    <?php echo __("Station Send Time") ?>
                </th>
                <th width="50%">
                    <?php echo __("Title") ?>
                </th>

            </tr>
        </thead>
        <tbody>
            <?php if (count($pager['results'])): ?>
                <?php foreach ($pager['results'] as $index => $station): ?>
                    <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                        <td><?php echo $station->getId(); ?>
                        </td>

                        <td><?php echo is_object($station->getDepositMembers()) ? $station->getDepositMembers()->getNickname() : '-'; ?>
                        </td>

                        <td><?php echo $station->getFormatStatus(); ?>
                        </td>

                        <td><?php 
                        if (is_object($station->getDepositStationNews())) {
                            echo $station->getDepositStationNews()->getSendTime();    
                        } else {
                            echo '-';
                        }
                         ?>
                        </td>

                        <td><span class="ellipsis"><?php 
                        if(is_object($station->getDepositStationNews())) {
                            echo $station->getDepositStationNews()->getTitle();
                        } else {
                            echo '-';
                        }
                         ?></span>
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
                echo utilPagerPages($pager, "Station/index", formGetQueryDenyPager('sortBy', 'sort', 'sid', 'sTitle', 'snickname' , 'pager'));
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