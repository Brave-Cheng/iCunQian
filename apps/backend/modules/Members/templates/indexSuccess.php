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
    <!--form header-->
    <div class="content-header">
        <h2><?php echo __('Members'); ?></h2>
    </div>
    <!--form header-->

    <div class="clear"></div>
    <!--table filter-->
    <?php echo form_tag('Members/index?' . formGetQueryDenyPager('sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager'), array('name' => 'SearchMembersFilter', 'id' => 'SearchMembersFilter')); ?>
        <table id="queryTable" class="listingTable searchTable" style="width: 35%; margin-top:5px">
            <tbody>
                <tr>
                    <td>
                        <label><?php echo __('ID')?>：</label>
                        <?php echo input_tag('sid', $sf_request->getParameter('sid')); ?>
                    </td>

                    <td>
                        <label><?php echo __('Mobile')?>：</label>
                        <?php 
                        echo input_tag('smobile', $sf_request->getParameter('smobile')); ?>
                    </td>

                    <td>
                        <label><?php echo __('Nickname')?>：</label>
                        <?php echo input_tag('snickname', $sf_request->getParameter('snickname')); ?>
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

    <?php echo form_tag('Members/index?' . formGetQueryDenyPager('sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager'), array('name' => 'sectionTable', 'id' => 'sectionTable', 'method' => 'post')); ?>
        <!--opreate-->
        <div class="toolbar" style="float:right; position:relative; width: 310px;">
            <img src="/img/icons/withselected.png" style="position:absolute; right:2px; bottom:-9px; z-index:-1">
            <ul>
                <li>    
                    <?php
                        echo link_to(__('Send Letter'), 'Station/SendLetter', array('class' => 'text_link move', 'onclick' => "return sendLetters('sectionTable', this.href);"));
                    ?>
                </li>
                <li>
                    <?php
                        echo link_to(__('Send All Letter'), 'Station/SendLetter', array('class' => 'text_link move', 'onclick' => "return sendLettersAll('sectionTable', this.href);"));
                    ?>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
        <!--opreate-->
    
        <!--page-->
        <div class="pagination mb10" style="float:none;">
            <div class="pagerlist">
                <?php
                if (utilPagerDisplayTotal($pager) > 20) {
                    echo utilPagerPages($pager, "Members/index", formGetQueryDenyPager('sortBy', 'sort', 'sid', 'smobile', 'snickname'));
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
                    <th width="4%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::ID, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::ID) ?>" title='<?php echo __('ID') . __('Sort');?>'><?php echo __("ID") ?></a>
                    </th>

                    <th width="8%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::NICKNAME, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::NICKNAME) ?>" title='<?php echo __('Nickname') . __('Sort');?>'><?php echo __("Nickname") ?></a>
                    </th>

                    <th width="9%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::MOBILE, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::MOBILE) ?>" title='<?php echo __('Mobile') . __('Sort');?>'><?php echo __("Mobile") ?></a>
                    </th>

                    <th width="12%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::EMAIL, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::EMAIL) ?>" title='<?php echo __('Email') . __('Sort');?>'><?php echo __("Email") ?></a>
                    </th>

                    <th width="5%">
                        <?php echo __("Avatar"); ?>
                    </th>

                    <th width="11%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::MOBILE_ACTIVE, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::MOBILE_ACTIVE) ?>" title='<?php echo __('Mobile') . __('Active') . __('Sort');?>'><?php echo __('Mobile') . __('Active') ?></a>
                    </th>

                    <th width="9%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::EMAIL_ACTIVE, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::EMAIL_ACTIVE) ?>" title='<?php echo __('Email') . __('Active') . __('Sort');?>'><?php echo __('Email') . __('Active') ?></a>
                    </th>

                    <th width="10%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::REGISTRATION_TIME, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::REGISTRATION_TIME) ?>" title='<?php echo __('Registration Time') . __('Sort');?>'><?php echo __('Registration Time') ?></a>
                    </th>

                    <th width="9%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::IS_LOGIN, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::IS_LOGIN) ?>" title='<?php echo __('Is Login') . __('Sort');?>'><?php echo __('Is Login') ?></a>
                    </th>

                    <th width="9%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::THIRD_PARTY_PLATFORM_TYPE) ?>" title='<?php echo __('Third Type') . __('Sort');?>'><?php echo __('Third Type') ?></a>
                    </th>

                    <th width="12%">
                        <a href="<?php echo url_for("Members/index?" . rm2FormSort(DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT, 'sortBy', 'sort', 'sid', 'smobile', 'snickname' , 'pager')) ?>" class="<?php echo rm2FormSortClass(DepositMembersPeer::THIRD_PARTY_PLATFORM_ACCOUNT) ?>" title='<?php echo __('Third Account') . __('Sort');?>'><?php echo __('Third Account') ?></a>
                    </th>

                    <th width="2%">
                        <input type="checkbox" onclick="rm2FormSelectCheck('.selectCheck1')" class="selectCheck1">

                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($pager['results'])): ?>
                    <?php foreach ($pager['results'] as $index => $members): ?>
                        <tr class="<?php echo ($index % 2 == 1) ? 'altRow' : ''; ?>">
                            <td><?php echo $members->getId(); ?>
                                <?php echo input_hidden_tag('hash', $members->getHash());?>
                            </td>
                            <td><?php echo $members->getNickname(); ?></td>
                            <td><?php echo $members->getMobile(); ?></td>
                            <td><span class="ellipsisShort"><?php echo $members->getEmail(); ?></span></td>
                            <td>
                                <?php if ($members->getAvatar() != DepositMembersPeer::NULL_STRING ): ?>
                                    <img style="broder:mone; width:90px; height:90px;" src="<?php echo $members->getAvatar();?>">
                                <?php else:?>
                                    <?php echo $members->getAvatar();?>
                                <?php endif?>
                                
                            </td>
                            <td>
                                <?php if ($members->getMobileActive() == DepositMembersPeer::YES) :?>
                                    <img style="broder:mone;" title="<?php echo __('Yes Active');?>" alt="<?php echo __('Yes Active');?>" src="<?php echo util::getDomain();?>/images/icons/running.png">
                                <?php else:?>
                                   <img  style="broder:mone;" title="<?php echo __('No Active');?>" alt="<?php echo __('No Active');?>" src="<?php echo util::getDomain();?>/images/icons/deactivated.png">
                                <?php endif;?>
                            </td>
                            <td>
                                <?php if ($members->getEmailActive() == DepositMembersPeer::YES) :?>
                                    <img style="broder:mone;" title="<?php echo __('Yes Active');?>" alt="<?php echo __('Yes Active');?>" src="<?php echo util::getDomain();?>/images/icons/running.png">
                                <?php else:?>
                                   <img  style="broder:mone;" title="<?php echo __('No Active');?>" alt="<?php echo __('No Active');?>" src="<?php echo util::getDomain();?>/images/icons/deactivated.png">
                                <?php endif;?>
                            </td>
                            <td><?php echo $members->getRegistrationTime(); ?></td>
                            <td>
                                <?php if ($members->getIsLogin() == DepositMembersPeer::YES) :?>
                                    <img style="broder:mone;" title="<?php echo __('Yes Login');?>" alt="<?php echo __('Yes Login');?>" src="<?php echo util::getDomain();?>/images/icons/running.png">
                                <?php else:?>
                                   <img  style="broder:mone;" title="<?php echo __('No Login');?>" alt="<?php echo __('No Login');?>" src="<?php echo util::getDomain();?>/images/icons/deactivated.png">
                                <?php endif;?>
                            </td>

                            <td><?php echo $members->getThirdPartyPlatformType(); ?></td>
                            <td><?php echo $members->getThirdPartyPlatformAccount(); ?></td>
                            <td>
                                <input type="checkbox" name="selectIds[]" id="selectIds" value="<?php echo $members->getId();?>" class="selectCheck1">
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
                    echo utilPagerPages($pager, "Bank/index", formGetQueryDenyPager('sortBy', 'sort', 'sid', 'smobile', 'snickname'));
                }
                ?>
                <span class="right lh30"><?php echo __("当前显示：") ?><?php echo utilPagerDisplayRows($pager) ?><?php echo __("条  共：") ?><?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条"); ?></span>
            </div>
        </div>
        <div class="clear"></div>
        <!--page-->
    
        <!--opreate-->
        <div class="toolbar" style="float:right; position:relative; width: 310px;">
            <img src="/img/icons/withselected.png" style="position:absolute; right:2px; bottom:-9px; z-index:-1">
            <ul>
                <li>    
                    <?php
                        echo link_to(__('Send Letter'), 'Station/SendLetter', array('class' => 'text_link move', 'onclick' => "return sendLetters('sectionTable', this.href);"));
                    ?>
                </li>
                <li>
                    <?php
                        echo link_to(__('Send All Letter'), 'Station/SendLetter', array('class' => 'text_link move', 'onclick' => "return sendLettersAll('sectionTable', this.href);"));
                    ?>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
        <!--opreate-->
    </form> 

</div>
<!-- float js to element-->