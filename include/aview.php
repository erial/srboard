<?php
session_start();
header ("Content-Type: text/html; charset=utf-8");
$dot = "../";
include("common.php");
if(false !== strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])) {
$scrt = preg_replace("`[a-z]`","",md5($_POST['dd'].$time.$uzip.$_POST['id']));
$i = 0;
while(substr($scrt,$i,1) === '0') $i++;
$scrt = substr($scrt,$i,3);
function avieww($txt) {
global $scrt;
$txt = urlencode($txt);
$txtl = strlen($txt);
$ntxt = '';
for($i = 0;$i < $txtl;$i++) {
$tt = substr($txt,0,1);
$txt = substr($txt,1);
$tt = ord($tt) + $scrt;
$ntxt .= ".".base_convert($tt,10,16);
}
return $ntxt;
}
if($_POST['xx']) $_POST['id'] .= "/^".$_POST['xx'];
$fn = fopen($dxr.$_POST['id']."/no.dat","r");
$fb = fopen($dxr.$_POST['id']."/body.dat","r");
while(!feof($fn)){
$fno = fgets($fn);
if((int)substr($fno,0,6) == $_POST['dd']) {
$xxx = explode("\x1b",$fno);
if($xxx[8] <= $mbr_level || substr($xxx[0],9) == $mbr_no || $_COOKIE["scrt_".$_POST['dd'].$id] == md5($_POST['dd']."_".$sessid.$id)) {
echo $scrt.avieww(fgets($fb));}
break;
} else fgets($fb);
}
fclose($fn);
fclose($fb);
}
?>