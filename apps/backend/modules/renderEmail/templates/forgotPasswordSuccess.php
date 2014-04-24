<style type="text/css">
    div { margin: 0; padding: 0; border: 0; outline: 0; font-weight: inherit; font-style: inherit; font-size: 100%; font: 9pt Calibri, Arial, sans-serif;}
    table {
        font: 9pt Calibri, Arial, sans-serif;
        border: 1px solid #e5eff8;
        border-width: 1px 0 0 1px;
        margin: 0 0 1em 0;
        clear:both;
    }
    table td {
        padding: 0.3em 1em;
        border: 1px solid #e5eff8;
        border-width: 0 1px 1px 0;
    }
    table th {
        font-size:120%;
        font-weight:bold;
        text-align:center;
    }
    .bold { font-weight:bold; }
</style>
<div>
    <?php echo __('取回密码说明'); ?>
    <br /><br />
        <?php echo $user->getProfile()->getLastName() . $user->getProfile()->getFirstName() . ',  这封信是由 四川高路交通信息工程有限公司OA系统 发送的。'; ?>
    <br /><br />
        <?php echo '您收到这封邮件，是由于这个邮箱地址在 四川高路交通信息工程有限公司OA系统 被登记为用户邮箱， 且该用户请求使用 Email 密码重置功能所致。'; ?>
    <br /><br />
        <?php echo '----------------------------------------------------------------------'; ?>
    <br /><br />
        <?php echo '<b>重要!</b>' ?>
    <br /><br />
        <?php echo '----------------------------------------------------------------------'; ?>
    <br /><br />
        <?php echo '如果您没有提交密码重置的请求或不是 四川高路交通信息工程有限公司OA系统 的注册用户，请立即忽略 并删除这封邮件。只有在您确认需要重置密码的情况下，才需要继续阅读下面的 内容。'; ?>
    <br /><br />
        <?php echo '----------------------------------------------------------------------'; ?>
    <br /><br />
        <?php echo '<b>密码重置说明</b>'; ?>
    <br /><br />
        <?php echo '----------------------------------------------------------------------'; ?>
    <br /><br />
        <?php echo '您的新密码: ' . $newPassword; ?>
    <br /><br />
        <?php echo '您只需要使用新的密码登陆就可以了,以下是 四川高路交通信息工程有限公司OA系统 的登陆地址'; ?>
    <br /><br />
        <?php echo 'http://oa.test.expacta.com.cn'; ?>
    <br /><br />
        <?php echo '(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)'; ?>
    <br /><br />
        <?php echo '感谢您的使用'; ?>
    <br /><br />
        <?php echo '此致'; ?>
    <br /><br />
    <?php echo __('System Admin'); ?><br />
    <?php echo __('support@expacta.com.cn'); ?>
</div>