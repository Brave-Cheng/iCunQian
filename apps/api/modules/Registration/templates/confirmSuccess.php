<style type="text/css">
body{
  color:#444;
  font-family:Georgia, Palatino, 'Palatino Linotype', Times, 'Times New Roman',
              "Hiragino Sans GB", "STXihei", "微软雅黑", serif;
  font-size:12px;
  line-height:1.5em;
  background:#fefefe;
  width: 45em;
  margin: 10px auto;
  padding: 1em;
  outline: 1300px solid #FAFAFA;
}

a{ color: #0645ad; text-decoration:none;}
a:visited{ color: #0b0080; }
a:hover{ color: #06e; }
a:active{ color:#faa700; }
a:focus{ outline: thin dotted; }
a:hover, a:active{ outline: 0; }

span.backtick {
  border:1px solid #EAEAEA;
  border-radius:3px;
  background:#F8F8F8;
  padding:0 3px 0 3px;
}

::-moz-selection{background:rgba(255,255,0,0.3);color:#000}
::selection{background:rgba(255,255,0,0.3);color:#000}

a::-moz-selection{background:rgba(255,255,0,0.3);color:#0645ad}
a::selection{background:rgba(255,255,0,0.3);color:#0645ad}

p{
margin:1em 0;
}

img{
max-width:100%;
}

h1,h2,h3,h4,h5,h6{
font-weight:normal;
color:#111;
line-height:1em;
}
h4,h5,h6{ font-weight: bold; }
h1{ font-size:2.5em; }
h2{ font-size:2em; border-bottom:1px solid silver; padding-bottom: 5px; }
h3{ font-size:1.5em; }
h4{ font-size:1.2em; }
h5{ font-size:1em; }
h6{ font-size:0.9em; }

blockquote{
color:#666666;
margin:0;
padding-left: 3em;
border-left: 0.5em #EEE solid;
}
hr { display: block; height: 2px; border: 0; border-top: 1px solid #aaa;border-bottom: 1px solid #eee; margin: 1em 0; padding: 0; }


pre , code, kbd, samp { 
  color: #000; 
  font-family: monospace; 
  font-size: 0.88em; 
  border-radius:3px;
  background-color: #F8F8F8;
  border: 1px solid #CCC; 
}
pre { white-space: pre; white-space: pre-wrap; word-wrap: break-word; padding: 5px 12px;}
pre code { border: 0px !important; padding: 0;}
code { padding: 0 3px 0 3px; }

b, strong { font-weight: bold; }

dfn { font-style: italic; }

ins { background: #ff9; color: #000; text-decoration: none; }

mark { background: #ff0; color: #000; font-style: italic; font-weight: bold; }

sub, sup { font-size: 75%; line-height: 0; position: relative; vertical-align: baseline; }
sup { top: -0.5em; }
sub { bottom: -0.25em; }

ul, ol { margin: 1em 0; padding: 0 0 0 2em; }
li p:last-child { margin:0 }
dd { margin: 0 0 0 2em; }

img { border: 0; -ms-interpolation-mode: bicubic; vertical-align: middle; }

table { border-collapse: collapse; border-spacing: 0; }
td { vertical-align: top; }

@media only screen and (min-width: 480px) {
body{font-size:14px;}
}

@media only screen and (min-width: 768px) {
body{font-size:16px;}
}

</style>

<?php if ($visit == 'error'):?>

    <h2 id="错误"><strong>访问错误！</strong></h2>
    <h3 id="您的验证时间已过期"><?php echo $error;?></h3>
    <h5 id="您可以">感谢您的支持！</h5>

<?php else:?>
    <?php if ($validate == 'successful'):?>
    <h2 id="验证成功"><strong>验证成功！</strong></h2>
    <h3 id="恭喜您成功注册i存钱通行证：">恭喜您成功注册i存钱通行证：</h3>
    <h4 id="brave-expacta-com-cn"><?php echo $email;?></h4>
    <h5 id="请直接在手机登陆">请直接通过手机登陆</h5>

    <?php else:?>

    <h2 id="验证失败！"><strong>验证失败！</strong></h2>
    <h3 id="您的验证时间已过期"><?php echo $error;?></h3>
    <h5 id="您可以">感谢您的支持！</h5>

    <?php endif;?>
<?php endif;?>


