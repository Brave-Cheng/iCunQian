<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <link rel="stylesheet" type="text/css" href="/js/yui/build/button/assets/skins/sam/button-my.css" />
    <link rel="stylesheet" type="text/css" href="/js/yui/build/container/assets/skins/sam/container-my.css" />
    <link rel="stylesheet" type="text/css" href="/js/yui/build/tabview/assets/skins/sam/tabview.css" />
    <?php include_javascripts() ?>
  </head>
  <body class="yui-skin-my">
    <!-- page header -->
    <?php  include_partial('global/pageHeader'); ?>
    <!-- page header end -->

    <!-- page body -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="ttLcontain">
    <tr>
        <?php if(sfContext::getInstance()->getModuleName() != "sfGuardAuth"): ?>
        <td valign="top" id="ttLLeft"><?php include_partial('global/pageNav') ?></td>
         <?php endif;?>
        <td valign="top" id="ttLright" style="width:100%">
            <div id="contentControls">
                <?php // TAB CONTENT WITHIN THIS DIV ?>
                <?php echo $sf_data->getRaw('sf_content') ?>
                <?php // END TAB CONTENT DIV ?>
            </div>
        </td>
    </tr>
    </table>
    <!-- page body end -->
    
    <!-- page footer -->
    <?php include_partial('global/pageFooter') ?>
    <!-- page footer end -->

  </body>
</html>