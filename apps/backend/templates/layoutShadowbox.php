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
    <div>
         <?php echo $sf_data->getRaw('sf_content') ?>
    </div>
  </body>
</html>