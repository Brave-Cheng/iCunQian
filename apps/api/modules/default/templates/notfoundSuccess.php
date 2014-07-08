<?php 

?>
<style type="text/css">
body
{
  font-size:15px;
  line-height:1.7;
  overflow-x:hidden;

    background-color: white;
    border-radius: 3px;
    border: 3px solid #EEE;
    box-shadow: inset 0 0 0 1px #CECECE;
    font-family: Helvetica, arial, freesans, clean, sans-serif;
    max-width: 912px;
    padding: 30px;
    margin: 2em auto;
    height:230px;
    margin-top: 100px;
    color:#333333;
}


.body-classic{
  color:#444;
  font-family:Georgia, Palatino, 'Palatino Linotype', Times, 'Times New Roman', "Hiragino Sans GB", "STXihei", "微软雅黑", serif;
  font-size:16px;
  line-height:1.5em;
  background:#fefefe;
  width: 45em;
  margin: 10px auto;
  padding: 1em;
  outline: 1300px solid #FAFAFA;
}

body>:first-child
{
  margin-top:0!important;
}

body>:last-child
{
  margin-bottom:0!important;
}

blockquote,dl,ol,p,pre,table,ul {
  border: 0;
  margin: 15px 0;
  padding: 0;
}

body a {
  color: #4183c4;
  text-decoration: none;
}

body a:hover {
  text-decoration: underline;
}

body a.absent
{
  color:#c00;
}

body a.anchor
{
  display:block;
  padding-left:30px;
  margin-left:-30px;
  cursor:pointer;
  position:absolute;
  top:0;
  left:0;
  bottom:0
}

/*h4,h5,h6{ font-weight: bold; }*/

.octicon{
  font:normal normal 16px sans-serif;
  width: 1em;
  height: 1em;
  line-height:1;
  display:inline-block;
  text-decoration:none;
  -webkit-font-smoothing:antialiased
}

.octicon-link:before{
  content:'\a0';
}

body h1,body h2,body h3,body h4,body h5,body h6{
  margin:1em 0 15px;
  padding:0;
  font-weight:bold;
  line-height:1.7;
  cursor:text;
  position:relative
}

body h1 .octicon-link,body h2 .octicon-link,body h3 .octicon-link,body h4 .octicon-link,body h5 .octicon-link,body h6 .octicon-link{
  display:none;
  color:#000
}

body h1:hover a.anchor,body h2:hover a.anchor,body h3:hover a.anchor,body h4:hover a.anchor,body h5:hover a.anchor,body h6:hover a.anchor{
  text-decoration:none;
  line-height:1;
  padding-left:0;
  margin-left:-22px;
  top:15%
}

body h1:hover a.anchor .octicon-link,body h2:hover a.anchor .octicon-link,body h3:hover a.anchor .octicon-link,body h4:hover a.anchor .octicon-link,body h5:hover a.anchor .octicon-link,body h6:hover a.anchor .octicon-link{
  display:inline-block
}

body h1 tt,body h1 code,body h2 tt,body h2 code,body h3 tt,body h3 code,body h4 tt,body h4 code,body h5 tt,body h5 code,body h6 tt,body h6 code{
  font-size:inherit
}

body h1{
  font-size:2.5em;
  margin-bottom:55px;
}

body h2{
  font-size:2em;
  border-bottom:1px solid #eee
}

body h3{
  font-size:1.5em
}

body h4{
  font-size:1.2em
}

body h5{
  font-size:1em
}

body h6{
  color:#777;
  font-size:1em
}

body p,body blockquote,body ul,body ol,body dl,body table,body pre{
  margin:15px 0
}

body h1 tt,body h1 code,body h2 tt,body h2 code,body h3 tt,body h3 code,body h4 tt,body h4 code,body h5 tt,body h5 code,body h6 tt,body h6 code
{
  font-size:inherit;
}


body li p.first
{
  display:inline-block;
}

body ul,body ol
{
  padding-left:30px;
}

body ul.no-list,body ol.no-list
{
  list-style-type:none;
  padding:0;
}

body ul ul,body ul ol,body ol ol,body ol ul
{
  margin-bottom:0;
  margin-top:0;
}

body dl
{
  padding:0;
}

body dl dt
{
  font-size:14px;
  font-style:italic;
  font-weight:700;
  margin-top:15px;
  padding:0;
}

body dl dd
{
  margin-bottom:15px;
  padding:0 15px;
}

body blockquote
{
  border-left:4px solid #DDD;
  color:#777;
  padding:0 15px;
}

body blockquote>:first-child
{
  margin-top:0;
}

body blockquote>:last-child
{
  margin-bottom:0;
}

body table
{
  display:block;
  overflow:auto;
  width:100%;
  border-collapse: collapse;
  border-spacing: 0;
  padding: 0;
}

body table th
{
  font-weight:700;
}

body table th,body table td
{
  border:1px solid #ddd;
  padding:6px 13px;
}

body table tr
{
  background-color:#fff;
  border-top:1px solid #ccc;
}

body table tr:nth-child(2n)
{
  background-color:#f8f8f8;
}

body img
{
  -moz-box-sizing:border-box;
  box-sizing:border-box;
  max-width:100%;
}

body span.frame
{
  display:block;
  overflow:hidden;
}

body span.frame>span
{
  border:1px solid #ddd;
  display:block;
  float:left;
  margin:13px 0 0;
  overflow:hidden;
  padding:7px;
  width:auto;
}

body span.frame span img
{
  display:block;
  float:left;
}

body span.frame span span
{
  clear:both;
  color:#333;
  display:block;
  padding:5px 0 0;
}

body span.align-center
{
  clear:both;
  display:block;
  overflow:hidden;
}

body span.align-center>span
{
  display:block;
  margin:13px auto 0;
  overflow:hidden;
  text-align:center;
}

body span.align-center span img
{
  margin:0 auto;
  text-align:center;
}

body span.align-right
{
  clear:both;
  display:block;
  overflow:hidden;
}

body span.align-right>span
{
  display:block;
  margin:13px 0 0;
  overflow:hidden;
  text-align:right;
}

body span.align-right span img
{
  margin:0;
  text-align:right;
}

body span.float-left
{
  display:block;
  float:left;
  margin-right:13px;
  overflow:hidden;
}

body span.float-left span
{
  margin:13px 0 0;
}

body span.float-right
{
  display:block;
  float:right;
  margin-left:13px;
  overflow:hidden;
}

body span.float-right>span
{
  display:block;
  margin:13px auto 0;
  overflow:hidden;
  text-align:right;
}

body code,body tt
{
  background-color:#f8f8f8;
  border:1px solid #ddd;
  border-radius:3px;
  margin:0 2px;
  padding:0 5px;
}

body code
{
  white-space:nowrap;
}


code,pre{
  font-family:Consolas, "Liberation Mono", Courier, monospace;
  font-size:12px
}

body pre>code
{
  background:transparent;
  border:none;
  margin:0;
  padding:0;
  white-space:pre;
}

body .highlight pre,body pre
{
  background-color:#f8f8f8;
  border:1px solid #ddd;
  font-size:13px;
  line-height:19px;
  overflow:auto;
  padding:6px 10px;
  border-radius:3px
}

body pre code,body pre tt
{
  background-color:transparent;
  border:none;
  margin:0;
  padding:0;
}


</style>

<h2>
<a name="" class="anchor" href="" aria-hidden="true"><span class="octicon octicon-link"></span></a>Oh, 发生了错误！</h2>

<h1>
<a name="" class="anchor" href="" aria-hidden="true"><span class="octicon octicon-link"></span></a>您要访问的页面没有找到！</h1>

<p style="text-align:center;">© 2014 i存钱 All rights reserved.</p>


