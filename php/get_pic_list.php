<?php
$len=0;
$process = curl_init('http://v1.api.upyun.com/jeff-pic-space1/');
$date = gmdate('D, d M Y H:i:s \G\M\T', time() + (+1*1*60));
print($date."\n");
$sign = md5('GET&/jeff-pic-space1/&'.$date.'&'.$len.'&'.md5("xxxxxxxx"));
curl_setopt($process, CURLOPT_HTTPHEADER, array('Expect:', "Authorization: UpYun oper1:".$sign, "Date: ".$date));
curl_setopt($process, CURLOPT_HEADER, 0);
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($process, CURLOPT_VERBOSE, 1);
print(curl_exec($process));
print(curl_getinfo($process, CURLINFO_HTTP_CODE).'<br/>');
curl_close($process);
?>
