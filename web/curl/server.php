<?php
header("Content-Type:text/html;charset=utf-8");
function GetIP(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"]))
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    else if(!empty($_SERVER["REMOTE_ADDR"]))
        $cip = $_SERVER["REMOTE_ADDR"];
    else
    $cip = "无法获取！";
    return $cip;
}


function getIpAdd() {  
    $unknown = 'unknown';  
    if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
    && $_SERVER['HTTP_X_FORWARDED_FOR'] 
    && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], 
    $unknown) ) {  
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    } elseif ( isset($_SERVER['REMOTE_ADDR']) 
    && $_SERVER['REMOTE_ADDR'] && 
    strcasecmp($_SERVER['REMOTE_ADDR'], $unknown) ) {  
    $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    /*  
    处理多层代理的情况  
    或者使用正则方式：$ip = preg_match("/[\d\.]
    {7,15}/", $ip, $matches) ? $matches[0] : $unknown;  
    */  
    if (false !== strpos($ip, ','))  
    $ip = reset(explode(',', $ip));  
     return $ip;  
} 
echo "<BR>访问IP: ".getIpAdd()."<br>";
echo "<BR>访问来路: ".$_SERVER["HTTP_REFERER"];
echo $_SERVER["REMOTE_ADDR"];
?>