<?php
$headers['CLIENT-IP'] = '202.103.229.40';  
$headers['X-FORWARDED-FOR'] = '202.103.229.40'; 
 
$headerArr = array();  
foreach( $headers as $n => $v ) {  
    $headerArr[] = $n .':' . $v;   
}
 
var_dump($headerArr);
ob_start();
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, "http://deposit.trunk.local/curl/server.php");
curl_setopt ($ch, CURLOPT_HTTPHEADER , $headerArr );  //����IP
curl_setopt ($ch, CURLOPT_REFERER, "http://www.163.com/ ");   //������·
curl_setopt( $ch, CURLOPT_HEADER, 1);
 
curl_exec($ch);
curl_close ($ch);
$out = ob_get_contents();
ob_clean();
 
echo $out;
?>