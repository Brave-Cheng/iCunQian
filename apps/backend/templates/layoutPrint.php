<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />


</head>
<body>
<script type="text/javascript">
function printdiv(printpage){
    var cssstr=document.head.innerHTML;
    var htmlTag='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">';
    var headstr=htmlTag+'<head>'+ cssstr +'<title></title></head><body>';    
    var footstr='</body>';
    var newstr=document.all.item(printpage).innerHTML;
    var oldstr=document.body.innerHTML;
    document.body.innerHTML=headstr+newstr+footstr;
    window.print();
    document.body.innerHTML=oldstr;
    return false;
}
</script>
<div class="right mr20 mt20">
<input type="button" class="btn_blue" onClick="printdiv('div_print');" value="<?php echo __('打印页面')?>">
</div>
<div id="div_print">
    <div class="main_content"><?php echo $sf_data->getRaw('sf_content') ?></div>
</div>
</body>
</html>
