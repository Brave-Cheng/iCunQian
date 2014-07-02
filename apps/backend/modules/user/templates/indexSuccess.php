<div id="content" class="right">
    <div class="bread_crumbs">
        <a href="<?php echo url_for('user/index'); ?>"><?php echo __('组织结构') ?></a> &gt; <span><?php echo __('列表页') ?></span>
    </div>
    <div class="box">
    <div class="btn_con">
        <div class="btns mb10 clearfix">
            <?php echo form_tag('user/index', 'id=searchUser') ?>
            <div id="search" class="right">
                <div class="relative left">
                    <input type='hidden' name='departmentId' value='all' />
                    <input type="button" onclick="checkKeyword();" class="search_btn" value=""/>
                    <?php echo formInputTag("keywords", "搜索用户", array("class"=>"txt w200 gray"))?>
                    <?php if($sf_params->get('keywords') != null){?>
                    <a title="清除搜索" href="<?php echo url_for('user/index') ?>" class="clear_search"></a>
                    <?php } ?>
                </div>
                <input type="button" class="btn_blue" value="<?php echo __('搜索')?>" onclick="checkKeyword();"/>
            </div>
            </form>
            <?php if( $sf_user->isSuperAdmin() ){ ?>
            <a href="<?php echo url_for('user/add?departmentId=' . $sf_request->getParameter('departmentId')); ?>" class="btn_blue"><?php echo __('创建用户') ?></a>
            <?php } ?>
            <?php if( $sf_user->isSuperAdmin()){ ?>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'userList', this.href); return false;" href='<?php echo url_for("user/delete") ?>'><?php echo __('批量删除') ?></a>
            <?php } ?>
            <?php
                if( $sf_flash->has("msg") ){
                    if( $sf_flash->get('msg') == 1 ){
                        echo "<span class='error lh30'>删除成功</span>";
                    }else if( $sf_flash->get('msg') == 0 ){
                        echo "<span class='error lh30'>请选择要删除用户</span>";
                    }
                }
            ?>
        </div>
    </div>
    <?php if($keywords != null){?>
    <div class="mt5">
        您当前搜索的是：<span id='keyword_now' style="color:#f29518;"><?php echo htmlspecialchars( $keywords ); ?></span>
    </div>
    <?php }?>
    <div class="tables ex_tabs">
        <form aciton="<?php echo url_for('user/delete'); ?>" method='post' id='userList' />
            <input type='hidden' name='keywords' value='<?php echo $sf_request->getParameter('keywords'); ?>' />
        <ul class="tab-nav clearfix">
            <input type="hidden" name="departmentId" value="<?php echo $departmentId; ?>" />
            <?php foreach( $departments as $department ) : ?>
            <li
                <?php
                if($department->getId() == $departmentId){
                    echo "class='current'";
                }else if( $departmentUserCount[$department->getId()] < 1 ){
                    echo "class='disabled'";
                }
                ?> >
            <a href='<?php if($keywords){ echo url_for("user/index?departmentId=" . "{$department->getId()}" . "&keywords=" . $keywords ); }else{ echo url_for("user/index?departmentId=" . "{$department->getId()}"); } ?>' ><?php echo $department->getName(); ?></a></li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-item on">
            <table>
                <thead>
                    <tr>
                        <?php if($sf_user->isSuperAdmin()){ ?>
                        <td class="w20 alignCenter"><input type="checkbox" class="cboxAll" /></td>
                        <?php } ?>
                        <td class="w60"><?php echo __('姓名') ?></td>
                        <td class="w120"><?php echo __('头衔') ?></td>
                        <td><?php echo __('当前所在项目') ?></td>
                        <td class="w120"><?php echo __('手机号') ?></td>
                        <?php if($sf_user->isSuperAdmin()){ ?>
                            <td class="w90"></td>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($users)){ ?>
                        <?php
                            foreach( $users as $key=>$user ) {
                                $profile = $user->getProfile();
                        ?>
                        <tr <?php if( $key%2 ){ echo "class='odd'"; } ?>>
                            <?php if($sf_user->isSuperAdmin()){ ?>
                            <td class="alignCenter"><?php if($user->getId() != $sf_user->getUserId()){ echo '<input type="checkbox" name="deleteId[]"" class="cbox" value="' . $user->getId() . '" />'; } ?></td>
                            <?php } ?>
                            <td><?php echo htmlspecialchars( $profile->getLastName() ) . htmlspecialchars( $profile->getFirstName() ); ?></td>
                            <td><?php echo htmlspecialchars( $user->getTitleByUserId($user->getId()) ); ?></td>
                            <td><?php echo htmlspecialchars( $user->getProjectNameString() ); ?></td>
                            <td><?php echo $profile->getTelephone(); ?></td>
                            <?php if($sf_user->isSuperAdmin()){ ?>
                            <td class="operate">
                                <a href='<?php echo url_for("user/read?id=" . $user->getId() . "&departmentId=" . $sf_request->getParameter('departmentId')) ?>'><?php echo __('查看') ?></a><br/>
                                <a href='<?php echo url_for("user/edit?id=" . $user->getId() . "&departmentId=" . $sf_request->getParameter('departmentId')) ?>'><?php echo __('编辑') ?></a><br/>
                                <a onclick="return showDeleteConfirmMessage(null, '', this.href)" href='<?php echo url_for("user/delete?deleteId=" . $user->getId() .'&'. html_entity_decode(formGetQuery("departmentId", "pager"))) ?>'><?php echo __('删除') ?></a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    <?php }else{ ?>
                        <tr><td colspan=7><div class='no_data'> <?php echo __('没有数据'); ?> </div></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </form>
    </div>
    <div class="btn_con">
        <div class="btns clearfix mt10">
            <?php if( $sf_user->isSuperAdmin()){ ?>
            <a href="<?php echo url_for('user/add?departmentId=' . $sf_request->getParameter('departmentId')); ?>" class="btn_blue"><?php echo __('创建用户') ?></a>
            <?php } ?>
            <?php if( $sf_user->isSuperAdmin() ){ ?>
            <a class="btn_blue" onclick="return showDeleteConfirmMessage(null, 'userList', this.href); return false;" href='<?php echo url_for("user/delete") ?>'><?php echo __('批量删除') ?></a>
            <?php } ?>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        setSearchType( 'keywords' );
    })

    function checkKeyword(){
        var key = $.trim($("#keywords").val());
        var pattren = /(\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\||\")+/;
        key = key.replace( pattren, '');
        if(key == "" || key =="搜索用户"){
            showSaveSuccessfullyMessage("请输入正确的关键字，并且关键词请不要包含特殊符号。", null);
        }else{
            formSubmit('searchUser', '<?php echo url_for("user/index?" . html_entity_decode(formGetQuery("sortBy", "sort"))) ?>');
        }
    }
</script>