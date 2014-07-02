<?php echo stylesheet_tag('ui-lightness/jquery-ui-1.9.2.custom.css')?>
<?php echo javascript_include_tag('jquery-ui-1.9.2.custom.min.js')?>
<?php echo javascript_include_tag('comm') ?>
<?php echo javascript_include_tag('jquery.leaveCheck.js') ?>
<div id="content" class="right">
    <div class="bread_crumbs"> <a href="<?php echo url_for('dashboard/index'); ?>"><?php echo __('个人中心'); ?></a> &gt; <?php echo __('新建通知'); ?> &gt; <span><?php echo __('第一步：选择收件人'); ?></span> </div>
    <div class="box">
        <?php echo __('请为新的通知选择收件人（从左侧选择个人或者部门单击添加到右侧项目成员列表）：'); ?>
        <div class="project_user_list mt10">
            <div class="title_box clearfix">
                <div class="title"><?php echo __('公司人员列表'); ?></div>
                <div class="title title_3"><?php echo __('收件人'); ?></div>
            </div>
            
            <?php echo form_tag("dashboard/selectReceivers?" . html_entity_decode(formGetQuery("sort", "sortBy", "keywords")), "id=searchTable") ?>
                <div id="search" class="m15 clearfix">
                    <div class="left">
                        <input type="submit" class="search_btn" value="" onclick=""/>
                        <?php echo formInputTag("keywords", "搜索用户", array("class"=>"txt w180 gray"))?>
                        <input type="button" class="btn_blue" value="搜索" id="btn_search"/>
                    </div>
                    <div class="lh30 left ml15">
                        <span class="error" id="keyError" ><?php echo form_error('userId'); ?></span>
                    </div>
                </div>        
            </form>  
            <div class="left com_user notification_com_user">
                    
                <div class="accordion">
                <?php foreach( $departments as $department ) : ?>
                    <h3 id="h_<?php echo $department->getId(); ?>"><?php echo $department->getName();echo '（<span class="span_left">' . $department->getNotificationMemberCount($department->getId()) . '</span>人）'; ?></h3>
                    <?php $users = $department->getDepartmentUsers(); ?>
                    <div class = "lleft" id="lleft_<?php echo $department->getId(); ?>">
                        <ul>
                            <?php foreach($users as $user):?>
                                <?php if($user->getUserId() != $sf_user->getGuardUser()->getId() ){ ?>
                                <li id="user_<?php echo $user->getUserId();?>">
                                    <a class="addUser" title="点击添加" href="javascript:void();" id='<?php echo $user->getUserId()?>'><?php echo $user->getLastName() . $user->getFirstName();?></a>
                                </li>
                                <?php } ?>
                            <?php endforeach;?>
                        </ul>
                    </div>
                <?php endforeach;?>
                </div>
            </div>
            <form action="<?php echo url_for('dashboard/addReceivers'); ?>" id="notification" method="post" >
            <div class="left pro_user notification_pro_user">
                
                <div class="accordion">
                <?php foreach( $departments as $department ) : ?>
                    <h3><?php echo $department->getName(); ?></h3>
                    <div id="right_<?php echo $department->getId(); ?>">
                        <ul></ul>
                    </div>
                <?php endforeach;?>
                </div>
            </div>

            <div class="clear"></div>
            <div class="btn_con mt15">
                <div class="btns clearfix">
                    <input type="submit" value="<?php echo __(' 确认收件人并编辑通知内容');?>" class="btn_blue" />
                    <a href="<?php echo url_for('dashboard/addReceivers?userId=all'); ?>" class="btn_blue"><?php echo __('向所有人发送并编辑通知内容');?></a>
                    <a href="<?php echo url_for('dashboard/index'); ?>" class="btn_blue jump"><?php echo __('放弃并返回');?></a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.addUser').click(function(){
            addOption( $(this) );
        })
        setSearchType( 'keywords' );
        $( ".accordion" ).exAccordion();
        $('.search_btn, #btn_search' ).click(function(){
            $('.lleft').css('display', 'none');
            var searchIndex = 0;
            var keyWords = $('#keywords').val();
            keyWords = $.trim(keyWords);
            if(keyWords == '' || keyWords == '搜索用户'){
                $("#keyError").html('请输入需要查询的用户关键字！')
                return false;
            }
            $('.lleft li').each(function(){
                $(this).css('background', '');
                var name = $(this).text();
                if(keyWords != '' &&  name.indexOf(keyWords) != -1){
                    var pid =$(this).parent().parent().attr('id');
                    pid = pid.substr(6);
                    $('#lleft_' + pid) . css('display', 'block');
                    $(this).css('background', 'yellow');
                    searchIndex = 1;
                }
            });
            if(searchIndex == 1){
                $("#keyError").html('');
            }else{
                $("#keyError").html('没有找到相关记录！');
            }
            return false;
        });
        $(".jump").leaveCheck({formId:'notification',formUrl:'<?php echo url_for("dashboard/checkReceiver"); ?>'});
    })
</script>
