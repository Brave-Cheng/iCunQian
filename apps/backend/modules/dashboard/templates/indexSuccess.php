<?php include_partial('global/confirm');?>
<?php echo javascript_include_tag('comm') ?>
<div id="content" class="right">
    <div class="bread_crumbs">
        <span><a href="<?php echo url_for('dashboard/index'); ?>"><?php echo __('个人中心'); ?></a></span>
    </div>
    <div class="box">
        <div class="btn_con line_bottom">
            <div class="btn_con mt10">
               <div class="btns clearfix btn_same_width">
                <?php if($accessDailyReportCreate && $dailyReport){ ?>
                    <a href="<?php echo url_for('dailyReport/selectProject')?>" class="btn_blue"><?php echo __('撰写项目日报') ?></a>
                <?php } ?>
                <a href="<?php echo url_for('dashboard/changePassword')?>" class="btn_blue"><?php echo __('修改密码'); ?></a>
                <?php if( $user->getIsSuperAdmin() != '1' ){ ?>
                    <a href="<?php echo url_for('dashboard/editUser')?>" class="btn_blue"><?php echo __('修改个人信息'); ?></a>
                    <a href="<?php echo url_for('dashboard/uploadImage?type=headPhoto')?>" class="btn_blue"><?php echo __('上传照片'); ?></a>
                    <a href="<?php echo url_for('dashboard/uploadImage?type=signatureImage')?>" class="btn_blue"><?php echo __('上传签名'); ?></a>
                <?php }?>
                </div>
            </div>
        </div>
        <div class="mt20 mb10"><strong>您可以在这里查看您的通知：</strong></div>
        <div class="btn_con mt10 clearfix">
            <div class="btns mb10 left btn_same_width">
                <a href="<?php echo url_for('dashboard/selectReceivers'); ?>" class="btn_blue"><?php echo __('发送新通知'); ?></a>
                <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'notificationList', this.href)" href='<?php echo url_for("dashboard/delete?type=". $sf_request->getParameter( 'type' ) ) ?>'><?php echo __('批量删除') ?></a>
                <a onclick="formSubmitChecks('notificationList', '<?php echo url_for("dashboard/changeStatus"); ?>' )" href="javascript:void();"  class="btn_blue"><?php echo __('标记为已读'); ?></a>
            </div>
            <div class="left ml10">
                <span class='error lh30'>
                    <?php echo __(form_error("deleteId")); ?>
                    <?php
                        if( $sf_request->hasParameter("msg") ){
                            if( $sf_request->getParameter("msg") == 1 ){
                                echo __("删除成功");
                            }else if( $sf_request->getParameter("msg") == 0 ){
                                echo __("请选择要删除的通知");
                            }else if( $sf_request->getParameter("msg") == 2 ){
                                echo __("选择通知不存在或已被删除");
                            }
                        }
                    ?>
                </span>
            </div>
        </div>
        <div class="tables">
            <div class="clearfix mb10">
                <div class="pagination left">
                    <form action="dashboard/index" method="post" id="notification_type">
                    <div class="left mr10 select_type">
                        <?php echo __('根据项目类型筛选邮件: '); ?>
                        <select onchange="changeType(this,'<?php echo url_for("dashboard/index")?>');" name="type" class="select">
                            <option value="0" <?php if( $sf_request->getParameter( 'type' ) == '0' ) { echo "selected='selected'"; } ?> >默认</option>
                            <option value="1" <?php if( $sf_request->getParameter( 'type' ) == '1' ) { echo "selected='selected'"; } ?> >系统</option>
                            <option value="2" <?php if( $sf_request->getParameter( 'type' ) == '2' ) { echo "selected='selected'"; } ?> >个人</option>
                        </select>
                    </div>
                    </form>
                </div>
                <div class="pagination left ml20">
                    <div class="pagerlist left">
                        <?php if(utilPagerDisplayTotal($pager) > 20){
                            echo utilPagerPages($pager, "dashboard/index" , html_entity_decode(formGetQueryDenyPager("type")));
                        }?>
                        <span class="ml20 lh30"><?php echo __("当前显示：") ?> <?php echo utilPagerDisplayRows($pager) ?> <?php echo __("条  共：") ?> <?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条");?></span>
                    </div>
                </div>
            </div>
            <form aciton="<?php echo url_for('dashboard/delete'); ?>" method='post' id='notificationList' />
            <div class="tables select_all">
                    <table>
                        <thead>
                            <tr>
                                <td class="w20 alignCenter"><input type="checkbox" class="cboxAll" /></td>
                                <td class=""><?php echo __('标题') ?></td>
                                <td class="w80"><?php echo __('发件人') ?></td>
                                <td class="w120"><?php echo __('日期') ?></td>
                                <td class="w60"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if( !empty( $pager['results'] ) ){
                                foreach( $pager['results'] as $key=>$result ){
                        ?>
                                <tr <?php if( $key%2 ){ echo "class='odd'"; } ?> >
                                    <td class="alignCenter"><input type="checkbox" name='deleteId[]' class="cbox" value="<?php echo $result->getId(); ?>"/></td>
                                    <td><a class="color mail_link" href="<?php echo url_for('dashboard/view?id=' . $result->getNotification()->getId() .'&' . html_entity_decode(formGetQueryDenyPager("type")) ); ?>">
                                            <?php
                                                $readingHistoryNotification = $sf_user->getReadingHistoryNotificationId();
                                                if( in_array( $result->getNotificationId() , $readingHistoryNotification) ){
                                                    echo '<span class="gray">' . htmlspecialchars($result->getNotification()->getTitle()) . '</span><span class="icons mark_read"></span>';
                                                }else{
                                                    if(!in_array( $result->getNotificationId() , $readingHistoryNotification) && in_array($result->getNotificationId() ,$new)){
                                                        echo '<span class="bold">' . htmlspecialchars($result->getNotification()->getTitle()) . '</span><span class="icons new_mail"></span>';
                                                    }else{
                                                        echo '<span>' . htmlspecialchars($result->getNotification()->getTitle()) . '</span><span class="icons new_mail"></span>';
                                                    }
                                                    
                                                }
                                            ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                            if( $result->getNotification()->getSfGuardUserId() == '0' ){
                                                echo __(Notification::SESTEM_MAIL_NAME);
                                            }else{
                                                echo htmlspecialchars( $result->getNotification()->getSfGuardUser()->getProfile()->getLastName() . $result->getNotification()->getSfGuardUser()->getProfile()->getFirstName() );
                                            }
                                         ?>
                                    </td>
                                    <td><?php echo $result->getNotification()->getCreatedAt(); ?></td>
                                    <td class="operate">
                                        <a  onclick="return showDeleteConfirmMessage(null, '', this.href)" href='<?php echo url_for("dashboard/delete?deleteId=" . $result->getId(). '&type=' .$sf_request->getParameter( 'type' )) ?>'><?php echo __('删除') ?></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr><td colspan=5><div class='no_data'> <?php echo __('没有数据'); ?> </div></td></tr>
                        <?php } ?>
                        </tbody>
                    </table>
            </div>
            </form>
        </div>
        <div class="btn_con">
            <div class="pagination clearfix">
                <div class="left mr10 select_type">
                    <?php echo __('根据项目类型筛选邮件: '); ?>
                    <select onchange="changeType(this,'<?php echo url_for("dashboard/index")?>');" name="type" class="select">
                        <option value="0" <?php if( $sf_request->getParameter( 'type' ) == '0' ) { echo "selected='selected'"; } ?> >默认</option>
                        <option value="1" <?php if( $sf_request->getParameter( 'type' ) == '1' ) { echo "selected='selected'"; } ?> >系统</option>
                        <option value="2" <?php if( $sf_request->getParameter( 'type' ) == '2' ) { echo "selected='selected'"; } ?> >个人</option>
                    </select>
                </div>
                <div class="pagerlist left ml20">
                    <?php if(utilPagerDisplayTotal($pager) > 20){
                        echo utilPagerPages($pager, "dashboard/index" , html_entity_decode(formGetQueryDenyPager("type")));
                    }?>
                    <span class="ml20 lh30"><?php echo __("当前显示：") ?> <?php echo utilPagerDisplayRows($pager) ?> <?php echo __("条  共：") ?> <?php echo utilPagerDisplayTotal($pager) ?><?php echo __("条");?></span>
                </div>
            </div>
            <div class="btns mt10 clearfix btn_same_width">
                <a href="<?php echo url_for('dashboard/selectReceivers'); ?>" class="btn_blue"><?php echo __('发送新通知'); ?></a>
                <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'notificationList', this.href)" href='<?php echo url_for("dashboard/delete?type=". $sf_request->getParameter( 'type' ) ) ?>'><?php echo __('批量删除') ?></a>
                <a onclick="formSubmitChecks('notificationList', '<?php echo url_for("dashboard/changeStatus"); ?>' )" href="javascript:void();"  class="btn_blue"><?php echo __('标记为已读'); ?></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        setSearchType( 'keywords' );

        var msg = '<?php echo $sf_request->getParameter("msg"); ?>';
        if(msg == '3'){
            showSaveSuccessfullyMessage( '通知发送成功' );
        }
    });
    function changeType(obj, url){
        window.location.href = url + '?type=' + obj.value;
    }
    function formSubmitChecks(fid, action, method) {
        var checkItems=$('#'+fid).find('input.cbox:checked');
        if(checkItems.length==0){
            showSaveSuccessfullyMessage( '您没有选择要标记的文件，请选择文件' );
            return false;
        }
        $.ajax({
            type: "POST",
            url: action,
            data: $("#" + fid).serialize(),
            success: function(data) {
                if( data == true ){
                	showSaveSuccessfullyMessage( '标记成功！', "<?php echo url_for($urlName.'?type='. $sf_request->getParameter( 'type' ))?>" );
                }else{
                	showSaveSuccessfullyMessage( '这些信息已经被阅读', "<?php echo url_for($urlName.'?type='. $sf_request->getParameter( 'type')) ?>"  );
                }
            }
        });



    }

</script>