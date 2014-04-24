<?php
if(!util::isSigninModule() && $sf_user->isAuthenticated()){
    include_partial('global/confirm');
    $user = $sf_user->getGuardUser();
?>
    <div class="wrap">
        <div id="header" class="clearfix">
            <h1 id="logo" class="left imgBg">四川高路交通信息工程有限公司OA系统</h1>
            <div class="loginfo left">
                <h2 class="imgBg">四川高路交通信息工程有限公司OA系统</h2>
                <div class="infos"><span class="icon_16 icon_user"></span>
                    <span>
                        <?php
                            $c = new Criteria();
                            $c->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $user->getId());
                            $userTitle = TitleSfGuardUserPeer::doSelectOne( $c );
                            if( $user->getIsSuperAdmin() == '1' ){
                                echo '超级管理员，您好！';
                            }else if( $userTitle && $userTitle->getTitle() && $userTitle->getTitle()->getName() ){
                                echo htmlspecialchars($user->getProfile()->getLastName()) . htmlspecialchars($userTitle->getTitle()->getName()) . '，您好！';
                            }else{
                                echo htmlspecialchars($user->getProfile()->getLastName()) . htmlspecialchars($user->getProfile()->getFirstName()) . '，您好！';
                            }
                        ?>
                    </span>
                </div>        
            </div>
            <a onclick="showDeleteConfirmMessage('是否确定离开系统', null, '<?php echo url_for("sfGuardAuth/signout"); ?>'); return false;" href="<?php echo url_for('sfGuardAuth/signout') ?>" class="btn_blue right" id="btn_logout">登出系统</a>
            <a href="<?php echo url_for('helpManual/index') ?>" class="btn_blue right mr10"  target="_block" >帮助手册</a>
        </div>
<?php }?>