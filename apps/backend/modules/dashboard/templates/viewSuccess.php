<div id="content" class="right">
    <div class="bread_crumbs">
        <span><a href="<?php echo url_for('dashboard/index'); ?>"><?php echo __('个人中心'); ?></a> &gt; <?php echo __('查看通知'); ?></span>
    </div>
    <div class="box">
        <div class="tables">
            <table>
                <tbody>
                    <tr>
                        <td class="w60">
                            <?php echo __('发件人'); ?>：
                        </td>
                        <td>
                            <?php
                                if( $notification->getsfGuardUserId() == '0' ){
                                    echo __(Notification::SESTEM_MAIL_NAME);
                                }else{
                                    echo $notification->getsfGuardUser()->getProfile()->getLastName() . $notification->getsfGuardUser()->getProfile()->getFirstName();
                                }
                            ?>
                        </td>
                    </tr>
                    <tr class="odd">
                        <td><?php echo __('邮件时间'); ?>：</td>
                        <td><?php echo $notification->getCreatedAt(); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo __('邮件标题'); ?>：</td>
                        <td><?php echo htmlspecialchars( $notification->getTitle() ); ?></td>
                    </tr>
                    <tr class="odd">
                        <td><?php echo __('邮件正文'); ?>： </td>
                        <td>
                        <?php 
                            $str = $notification->getContent();
                            $str = str_replace( array("\r\n", "\n", "\r"), '<br/>', $str );
                            echo $str;
                        ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt10">
                <a class="btn_blue mt20" href="<?php echo url_for('dashboard/index?' . html_entity_decode(formGetQueryDenyPager("type"))); ?>"><?php echo __('返回'); ?></a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var hasSignatureImage = "<?php echo $hasSignatureImage; ?>";
        if (!hasSignatureImage) {
            $(".read").bind("click", function() {
                showDeleteConfirmMessage('您还没有上传签名，无法进行审批。是否继续?', '', $(this).attr('href'));
                return false;
            })
        }
    })
</script>