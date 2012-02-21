<?php
$data = 'demodata';
$process = curl_init('http://v2.api.upyun.com/jeff-raw-space2/test1.txt');
curl_setopt($process, CURLOPT_POST, 1);
curl_setopt($process, CURLOPT_POSTFIELDS, $data);
curl_setopt($process, CURLOPT_USERPWD, "oper1:xxxxxxxx");
curl_setopt($process, CURLOPT_HTTPHEADER, array('Expect:', "Mkdir: true"));
curl_setopt($process, CURLOPT_HEADER, 0);
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($process, CURLOPT_VERBOSE, 1);
print(curl_exec($process));
print(curl_getinfo($process, CURLINFO_HTTP_CODE).'<br/>');
curl_close($process);
?>
