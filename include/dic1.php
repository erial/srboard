<?php
header ("Content-Type: text/html; charset=UTF-8");
$host = substr($_SERVER[QUERY_STRING],0,strpos($_SERVER[QUERY_STRING],"/"));
$fp = fsockopen($host, 80, $errno, $errstr, 30);
fputs($fp, "GET http://".$_SERVER[QUERY_STRING]." HTTP/1.1\r\n");
fputs($fp, "Accept-Language: ko\r\n");
fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Accept-Encoding: gzip, deflate\r\n");
fputs($fp, "User-Agent: Mozilla/4.0\r\n");
fputs($fp, "Host: ".$host."\r\n");
fputs($fp, "Connection: close\r\n");
fputs($fp, "Cache-Control: no-cache\r\n");
fputs($fp, "\r\n\r\n");
while($data = fgets($fp, 4096)) $memo .= $data;
fclose($fp);
$memo = str_replace('"/','"http://dic.naver.com/',$memo);
$memo = substr($memo,strpos($memo,"<"));
$memo = substr($memo,0,strpos($memo,'<hr />'));
$memo1 = substr($memo,0,strpos($memo,'</head>'));
$memo = $memo1."</head><body>".substr($memo,strpos($memo,'<div id="container">'));
$memo = str_replace('onclick','onxx',$memo);
echo $memo;
?>