<?php
if($_SERVER['QUERY_STRING']) {
$font = '9.ttf';
$query = explode('|',$_SERVER['QUERY_STRING']);
/* query[0] = text */
/* query[1] = width */
/* query[2] = height */
/* query[3] = font-size */
/* query[4] = background-color/font-color/bg-fontcolor */
/* query[5] = padding-left/padding-top/bg padding-left/bg padding-top */
header('Content-type: image/png; charset:utf-8');

$query[0] = urldecode($query[0]);
if(!$query[3]) $query[3] = 9;
if(!$query[1]) $query[1] = $query[3]*strlen($query[0])*0.8 + $query[3]*0.2;
if(!$query[2]) $query[2] = $query[3]*1.3;
if(!$query[4]) $query[4] = 'fff000';
if(!$query[5]) $query[5] = '01010202';
function m32($n) {
global $query;
return base_convert($query[4][$n],16,10)*17;
}
$im = imagecreatetruecolor($query[1], $query[2]);
$bgc = imagecolorallocate($im, m32(0), m32(1), m32(2));
imagefilledrectangle($im, 0, 0, $query[1], $query[2], $bgc);
$ftc = imagecolorallocate($im, m32(3), m32(4), m32(5));
if(strlen($query[4]) == 9) {
$bfc = imagecolorallocate($im, m32(6), m32(7), m32(8));
imagettftext($im, $query[3], 0, $query[3]*(int)substr($query[5],4,2)/10, $query[3]+$query[3]*(int)substr($query[5],6,2)/10, $bfc, $font, $query[0]);
}
imagettftext($im, $query[3], 0, $query[3]*(int)substr($query[5],0,2)/10, $query[3]+$query[3]*(int)substr($query[5],2,2)/10, $ftc, $font, $query[0]);
imagepng($im);
imagedestroy($im);
}
?>