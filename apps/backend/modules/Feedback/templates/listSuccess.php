<style type="text/css">
.ellipsis{width: 530px;}
</style>
<!-- float js -->
<script type="text/javascript" src="/js/floating.js"></script> 
<!-- float js -->

<!-- float js to element-->
<div id="tabContent">
    <!-- form tag-->
    <?php echo form_tag('Feedback/list?' . formGetQueryDenyPager('sortBy', 'sort', 'semail', 'snickname' , 'pager', 'sid'), array('name' => 'feedbackFilter', 'id' => 'feedbackFilter')); ?>
    <!-- form tag-->
    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Feedback'); ?></h2>
        <p class="form-buttons">
        </p>
    </div>
    <!--table filter-->
    <div class="clear"></div>
    <?php echo form_tag('Feedback/list?' . formGetQueryDenyPager('sortBy', 'sort', 'semail', 'snickname' , 'pager', 'sid'), array('name' => 'SearchFeedbackFilter', 'id' => 'SearchFeedbackFilter')); ?>
        <table id="queryTable" class="listingTable searchTable" style="width: 35%; margin-top:5px">
            <tbody>
                <tr>
                    <td>
                        <label><?php echo __('ID')?>：</label>
                        <?php 
                            echo input_tag('sid', $sf_request->getParameter('sid'));
                        ?>
                    </td>
                    <td>
                        <label><?php echo __('Email')?>：</label>
                        <?php 
                            echo input_tag('semail', $sf_request->getParameter('semail'));
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
                echo utilPagerPages($pager, "Feedback/list", formGetQueryDenyPager('sortBy', 'sort', 'semail', 'snickname'));
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
                <th align="center" width="5%">
                    <a href="<?php echo url_for("Feedback/list?" . rm2FormSort(DepositFeedbackPeer::ID, 'sortBy', 'sort', 'semail', 'snickname' , 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFeedbackPeer::ID) ?>" title='根据ID排序'><?php echo __("ID") ?></a>
                </th>


                <th align="center" width="20%" >
                    <a href="<?php echo url_for("Feedback/list?" . rm2FormSort(DepositFeedbackPeer::EMAIL, 'sortBy', 'sort', 'semail', 'snickname' , 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFeedbackPeer::EMAIL) ?>" title='邮件排序'><?php echo __("Email") ?></a>
                </th>

                <th align="center" width="13%">
                    <a href="<?php echo url_for("Feedback/list?" . rm2FormSort(DepositFeedbackPeer::MAIL_SEND_STATUS, 'sortBy', 'sort', 'semail', 'snickname' , 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFeedbackPeer::MAIL_SEND_STATUS) ?>" title='邮件发送状态排序'><?php echo __("Mail Send Status") ?></a>
                </th>

                <th align="center" width="12%">
                    <a href="<?php echo url_for("Feedback/list?" . rm2FormSort(DepositFeedbackPeer::CREATED_AT, 'sortBy', 'sort', 'semail', 'snickname' , 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFeedbackPeer::CREATED_AT) ?>" title='创建时间排序'><?php echo __("Create At") ?></a>
                </th>

                <th align="center" width="50%">
                    <a href="<?php echo url_for("Feedback/list?" . rm2FormSort(DepositFeedbackPeer::CONTENT, 'sortBy', 'sort', 'semail', 'snickname' , 'pager', 'sid')) ?>" class="<?php echo rm2FormSortClass(DepositFeedbackPeer::CONTENT) ?>" title='意见排序'><?php echo __("Feedback Content") ?></a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pager['results'])): ?>
                <?php foreach ($pager['results'] as $index => $feedback): ?>
                    <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                        <td><?php echo $feedback->getId();?></td>
                        <td><?php echo $feedback->getEmail(); ?></td>
                        <td>
                            <?php echo $feedback->getMailSendStatus() == DepositMembersPeer::YES ? __('Send Yes Valid') : __('Send No Valid'); ?>
                        </td>
                        <td><?php echo $feedback->getCreatedAt(); ?></td>
                        <td><span class="ellipsis"><?php echo $feedback->getContent(); ?></span></td>
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
                echo utilPagerPages($pager, "Feedback/list", formGetQueryDenyPager('sortBy', 'sort', 'semail', 'snickname'));
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