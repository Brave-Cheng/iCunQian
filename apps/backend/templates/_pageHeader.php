<!--<div id="head">
    <h1 class="ie6"><?php echo __("Expacta Mangement") ?></h1>
</div>
-->
<div id="navBar">
    <?php if(sfContext::getInstance()->getModuleName() != "sfGuardAuth"): ?>
        <div id="userLoggedIn">
            <span style="font-weight:bold;"><?php echo __("Logged in as:") ?></span> 
            <span id="userLoggedInUsername" name="userLoggedInUsername"><?php echo util::getUser()->getUsername(); ?></span>
        </div>
        
        <ul>
            <li><a href="<?php echo url_for("sfGuardAuth/signout")?>"><?php echo __("Logout") ?></a></li>
        </ul>
    <?php endif; ?>
</div>
