<?php
session_start();
include("include/common.php");

$no6 = str_pad($_REQUEST['no'],6,0,STR_PAD_LEFT);
if($_REQUEST['xx'] > 0) $xn = "/^".$_REQUEST['xx'];
else $xn = '';
$psscked = 0;
function strcut($str, $len){
$str = trim($str);
if(strlen($str) > $len) {
$str = preg_replace("`<[^>]*>`","",$str);
$str = substr($str, 0, $len + 1);
$end = $len;
if(ord($str[$end -2]) < 224 && ord($str[$end]) > 126) {
while(ord($str[$end]) < 194 && ord($str[$end]) > 126) $end--;
$str = substr($str, 0, $end);
}
}
return $str;
}
function wpass($w) {
global $dxr,$time;
$ipt = str_pad($_SERVER['REMOTE_ADDR'],15);
$mtime = $time - 86400;
$fww = '';
$fwc = 0;
if($w == 1 && ($fw = @fopen($dxr."wrong_pass2.dat","r"))) {
$nfw = 0;
while(!feof($fw)) {
$fwo = fgets($fw);
if(substr($fwo,0,10) > $mtime) {
if(substr($fwo,10,15) == $ipt) {$fwc = sprintf("%d",(substr($fwo,0,10) - $mtime)/60);
$fwc = sprintf("%d",$fwc/60)."시간 ".($fwc%60)."분";
}
$fww .= $fwo;
} else $nfw = 1;
}
fclose($fw);
if($nfw) {
$fw = fopen($dxr."wrong_pass2.dat","w");
fputs($fw,$fww);
fclose($fw);
}} else if($w == 2) {
$fwi = '';
if($fw = @fopen($dxr."wrong_pass1.dat","r")) {
while(!feof($fw)) {
$fwo = fgets($fw);
if(substr($fwo,0,10) > $mtime) {
if(substr($fwo,10,15) == $ipt) {$fwc++;$fwi .= $fwo;}
else $fww .= $fwo;
} else $nfw = 1;
}
fclose($fw);
$fwc++;
if($fwc > 9) {
$fw = fopen($dxr."wrong_pass2.dat","a");
fputs($fw,$time.$ipt."\n");
fclose($fw);
$fwi = '';
}}
if($fwc < 10) $fwi .= $time.$ipt."\n";
$fw = fopen($dxr."wrong_pass1.dat","w");
fputs($fw,$fwi.$fww);
fclose($fw);
}
return $fwc;
}
if($_POST['pass'] && ($_POST['edit'] || $_POST['mode'] == 'edit')) {if($fwc = wpass(1)) {
$dxpt = ($_POST['request'])? $_POST['request']:$dxpt;
scrhref($dxpt,0,"반복된 틀린 비밀번호로 차단되셨습니다. (남은 시간 : {$fwc})");exit;}}
if($_REQUEST['tb']) {
if($fbn = @fopen($dxr.$id."/bno.dat","r")) {
$i =1;
while(!feof($fbn)) {
if($trbk[1] <= substr(fgets($fbn), 0, 6)) {$xn = "/^".$i;break;}
$i++;
}
fclose($fbn);
}}
if($id) {
if($wdth[7][33]) {
$ffldr = "icon/".$id."/";
if(!is_dir($ffldr)) mkdir($ffldr, 0777);
} else $ffldr = $dxr.$id."/files/";
if($_POST['delf']) {
if($mbr_level == 9) {
$delfc = count($_POST['delf']);
for($i = 0; $i < $delfc;$i++) {
if($_POST['delf'][$i]) @unlink($ffldr.$_POST['delf'][$i]);
}}
scrhref($dxpt,0,0);
exit;
}}
$saved = ($mbr_no)? $dxr."_member_/wtp_".$mbr_no:$dxr."_member_/wtpip_".str_replace(".","x",$_SERVER['REMOTE_ADDR']);
function mkthumb($dest,$tname,$ext,$mxwidth,$mxheight,$fixed,$quality){
list($width, $height) = @getimagesize($dest);
if(!$ext) $ext = strtolower(substr($dest, -3));
$pos_x = 0;$pos_y = 0;
if($width > $mxwidth ||$height > $mxheight) {
if($fixed) {$nwidth = $mxwidth;$nheight = $mxheight;} else {
if($width/$mxwidth >= $height/$mxheight) {$nwidth = $mxwidth;$nheight = $mxwidth*$height/$width;$pos_y = ($mxheight -$nheight)/2;}
else {$nheight = $mxheight;$nwidth = $mxheight*$width/$height;$pos_x = ($mxwidth -$nwidth)/2;}}
$thumb  = @imagecreatetruecolor($mxwidth, $mxheight);
@imagefill($thumb, 0, 0, @imagecolorallocate($thumb, 255, 255, 255));
if($ext=='jpg') $source = @imagecreatefromjpeg($dest);
else if($ext=='gif') $source = @imagecreatefromgif($dest);
else if($ext=='png') $source = @imagecreatefrompng($dest);
if(@imagecopyresampled($thumb, $source, $pos_x, $pos_y, 0, 0, $nwidth, $nheight, $width, $height)){
$ok = @imagejpeg($thumb,$tname,$quality);
if($ok) {$return = 1;imagedestroy($thumb);}
}}
return $return;
}
function sendmail($mailto,$from,$replyto,$title,$body) {
if(!empty($_FILES['attachment']['size'])) {
$result = fopen($_FILES['attachment']['tmp_name'],"r");
$file = fread($result,$_FILES['attachment']['size']);
fclose($result);
@unlink($_FILES['attachment']['tmp_name']);
$boundary = "--------".md5(uniqid("srboard"));
$mhead = "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
$mbody = "This is a multi-part message in MIME format.\r\n\r\n--$boundary\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\n";
$mbody .= nl2br(stripslashes($body))."\r\n\r\n--$boundary\r\n";
$mbody .= "Content-Type: application/octet-stream; name=\"".basename($_FILES['attachment']['name'])."\"\r\n";
$mbody .= "Content-Transfer-Encoding: base64\r\n\r\n".chunk_split(base64_encode($file))."\r\n\r\n";
} else {
$mhead = "Content-Type: text/html; charset=UTF-8\r\n";
$mbody =  nl2br(stripslashes($body));
}
$mailsent = mail($mailto, "=?UTF-8?B?".base64_encode($title)."?=\n", $mbody, "MIME-Version: 1.0\r\n".$mhead."From: =?UTF-8?B?".base64_encode($from)."?=<{$replyto}>\r\nReply-To: {$replyto}\r\nX-Sender: <{$replyto}>\r\nX-Mailer: PHP/".phpversion()."\r\nX-Priority: 3\r\nReturn-Path: <{$replyto}>\r\n");
return $mailsent;
}
function rsst($rsstxt) {
$rsstxt = str_replace("&","&amp;",$rsstxt);
$rsstxt = str_replace("<","&lt;",$rsstxt);
$rsstxt = str_replace(">","&gt;",$rsstxt);
$rsstxt = str_replace("\"","&quot;",$rsstxt);
$rsstxt = str_replace("'","&#039;",$rsstxt);
return $rsstxt;
}
if($_GET['file'] || $_GET['fno'] || $_GET['down']){
/*** 파일출력 시작 ***/
if(!$_GET['fno'] && $_GET['down']) $_GET['fno'] = $_GET['down'];
$wmp = 0;$vip = 0;$ok = 0;$file = 0;
if($_GET['by'] == 'wmp' && (strpos($_SERVER['HTTP_USER_AGENT'],'Windows-Media-Player') !== false || strpos($_SERVER['HTTP_USER_AGENT'],'NSPlayer') !== false)) $wmp = 1;
if($_GET['by'] == 'wmp' && $sss[23] != 'a' && $wdth[7][3] != 'a' && ($sss[22] > 0 || $sss[23] > 0 || $wdth[7][3] > 0)) {$wmpf = $dxr.$id."/wmp.dat";
if($wmp == 1) {
usleepp($dxr.$id."/wmp.dat@@");
$Jfwmp = fopen($wmpf."@@","w");$fwmp = fopen($wmpf,"r");$wtime = $time - 20;
while($fwo = fgets($fwmp)){if((int)substr($fwo,0,10) > $wtime) {if($vip == 0 && substr($fwo,10,-1) == $_SERVER['REMOTE_ADDR']) $vip = 1;fputs($Jfwmp,$fwo);}}
fclose($fwmp);fclose($Jfwmp);copy($wmpf."@@",$wmpf);unlink($wmpf."@@");
} else if($sss[22] <= $mbr_level && $sss[23] <= $mbr_level && $wdth[7][3] <= $mbr_level) {$fwmp = fopen($wmpf,"a");fputs($fwmp,$time.$_SERVER['REMOTE_ADDR']."\n");fclose($fwmp);}
}
if($_GET['file']) $ext = strtolower(substr($_GET['file'],-4));else $ext = '';
if($sss[72] && ($ext=='.jpg' || $ext=='.gif' || $ext=='.png')) $vip = 2;
if($vip == 1 || ($sss[22] <= $mbr_level && ($sss[23] <= $mbr_level || $vip == 2))) {
if(($wdth[7][3] != 'a' && $wdth[7][3] <= $mbr_level) || $vip != 0) {
if($wmp == 1 || $sett[13] == 1 || strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) !== false){
if($_GET['file']) $fname = str_replace("/","",$_GET['file']);$file = $ffldr.str_replace("%","",urlencode($fname));
if($_GET['fno'] || !file_exists($file)) {
$file = '';
if($fu = @fopen($du,"r")) $fuo = fgets($fu);
if($_GET['fno'] && $_GET['fno'] > (int)substr($fuo, -7, 6)) {@fclose($fu);if($fu = @fopen($dxr.$id."/_upload.dat","r")) {$fuo = fgets($fu);}$wmp = 4;}
if($wmp == 1 || $wmp == 4 || (!$_GET['down'] && $wdth[7][33] != '1')) {
if($fu && $fuo) {
while(!feof($fu)){
	$fux = (int)substr($fuo, -7, 6);
	if($fux > 0 && ($_GET['fno'] == $fux || ($_GET['file'] && (($f27 = substr($fuo,27,-13)) == $_GET['file'] || str_replace("%","",urlencode($f27)) == $_GET['file'] || ($f6 = substr($fuo,6,-13)) == $_GET['file'] || str_replace("%","",urlencode($f6)) == $_GET['file'])))) {
	$fu6 = substr($fuo,0,6);if($wmp == 4) $fname = substr($fuo, 26, -13);else $fname = substr($fuo, 6, -13);
	if($fname[20] == '/') {$file = $ffldr.substr($fname,0,20);$fname = substr($fname,21);$ifisf = 1;} else {$file = $ffldr.str_replace("%","",urlencode($fname));$ifisf = 0;}
//if($ifisf == 1 && !file_exists($file)) $file = $ffldr.str_replace("%","",urlencode($fname));
	break;
	}
	$fuo = fgets($fu);
}
fclose($fu);
}} else {
usleepp($du."@@");
$jdu = fopen($du."@@","w");
while(!feof($fu)){
	$fux = (int)substr($fuo, -7, 6);
	if($fux > 0 && ($_GET['fno'] == $fux || ($_GET['file'] && (($f27 = substr($fuo,27,-13)) == $_GET['file'] || str_replace("%","",urlencode($f27)) == $_GET['file'] || ($f6 = substr($fuo,6,-13)) == $_GET['file'] || str_replace("%","",urlencode($f6)) == $_GET['file'])))) {
	$fu6 = substr($fuo,0,6);$vip = strlen($fuo);$fname = substr($fuo, 6, -13);$fuu = substr($fuo, -13, 6);if($_GET['down']) {$fuu = (int)$fuu + 1;$fuu = str_pad($fuu, 6, 0, STR_PAD_LEFT);}
  if($fname[20] == '/') {$dest = substr($fname,0,20);$fname = substr($fname,21);$ifisf = 1;} else {$dest = str_replace("%","",urlencode($fname));$ifisf = 0;}
	if($wdth[7][33] == '1') {
	if($extt = strrpos($fname,".")) $ext = strtolower(substr($fname,$extt));else $ext = '';$file = substr(md5($fname.$time),rand(0,10),(20 - strlen($ext))).$ext;
	if(copy($ffldr.$dest,$ffldr.$file)) {unlink($ffldr.$dest);$fuo = substr($fuo,0,6).$file."/".$fname.$fuu.substr($fuo, -7);$file = $ffldr.$file;$ok = 1;}
	}
	if($ok != 1) {$file = $ffldr.$dest;$fuo = substr($fuo, 0, -13).$fuu.substr($fuo, -7);}
	$vip -= strlen($fuo);}
	fputs($jdu,$fuo);
	$fuo = fgets($fu);
}
fputs($jdu,$fuo);
fclose($fu);
fclose($jdu);
//if($ifisf == 1 && !file_exists($file)) $file = $ffldr.str_replace("%","",urlencode($fname));
if(file_exists($file)) {if(!file_exists($du) || (filesize($du) == filesize($du."@@") + $vip)) {@copy($du,$du."_bk");copy($du."@@",$du);}
else if($ok == 1) {copy($file,$ffldr.$dest);unlink($file);}$ok = 2;}
unlink($du."@@");
}
if(!$wdth[9][11] && $wdth[9][14] && $fu6) {
$fu6i = (int)$fu6;
if($wdth[6] && $fu6i <= (int)substr($do[$wdth[6]],0,6)) {
for($aa = 1; $aa <= $wdth[6]; $aa++){
if($fu6i <= (int)substr($do[$aa],0,6)) {$xn = "/^".$aa;break;}
}} else $xn = '';
$nfn = fopen($dxr.$id.$xn."/no.dat","r");
while($nfno = fgets($nfn)){
if($fu6 == substr($nfno, 0, 6)) {
$nfno = explode("\x1b",$nfno);
$nfne = $nfno[3];
if(strlen($nfne) == 3 && $nfne[2] > $mbr_level) $ok = 4;
break;
}}
fclose($nfn);
}}
if($ext == '') $ext = strtolower(substr($fname,-4));
if($ext=='.jpg' || $ext=='.gif' || $ext=='.png') $fimg = 1;else $fimg = 0;
if($ok != 4 || $fimg) {
if($ok == 2 || @is_file($file)) {
if($wdth[7][33] == '1') {
header("location:".$file);
} else {
$fname = iconv("UTF-8","CP949//IGNORE",$fname);
if(!$_GET['down'] && $fimg){
header("Content-type:image/jpeg");
header("Content-Disposition: inline; filename=\"$fname\"");
} else if(!$_GET['down'] && $ext == '.swf') {
header("Content-Type: application/x-shockwave-flash");
header("Content-Disposition: inline; filename=\"$fname\"");
} else if(!$_GET['down'] && $ext == '.mid') {
header("Content-Type: application/x-mplayer2");
header("Content-Disposition: attachment; filename=\"$fname\"");
} else if($_GET['by'] == 'wmp') {
header("Content-Type: video/".substr($ext,1));
header("Content-Disposition: attachment; filename=\"$fname\"");
} else {
if($mbr_no && ($_GET['down'] || $_GET['fno'])) chmbr($mbr_no,8,1);
header("Content-Type: applicaiton/octet-stream");
header("Content-Disposition:attachment; filename=\"$fname\"");
}
$ok = 2;
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($file));
fpassthru(fopen($file,"rb"));
}} else $ok = 3;}}}}
if($ok != 2) {header("Content-Type: text/html; charset=UTF-8");echo (($ok == 3)? "파일":"권한")."이 없습니다";}
exit;
/*** 파일출력 끝 ***/
} else if((is_uploaded_file($_FILES['img']['tmp_name']) || is_uploaded_file($_FILES['img2']['tmp_name'])) && $mbr_level) {
if(($upfile = $_FILES['img']['tmp_name']) && getimagesize($upfile)) {
$ext = strtolower(substr($_FILES['img']['name'], -3));
if(!mkthumb($upfile,"icon/m80_".$mbr_no,$ext,80,80,1,90)) {move_uploaded_file($upfile, "icon/m80_".$mbr_no);$upfile ="icon/m80_".$mbr_no;}
if(!file_exists("icon/m20_".$mbr_no)) {if(!mkthumb($upfile,"icon/m20_".$mbr_no,$ext,20,20,1,80)) copy($upfile, "icon/m20_".$mbr_no);}
} else if(($upfile = $_FILES['img2']['tmp_name']) && getimagesize($upfile)) {
$ext = strtolower(substr($_FILES['img2']['name'], -3));
if(!mkthumb($upfile,"icon/m20_".$mbr_no,$ext,20,20,1,80)) move_uploaded_file($upfile, "icon/m20_".$mbr_no);
}
scrhref($index."?mbr_info=1",0,0);
exit;
} else if($id || $_POST['ajax']) {
/*** 게시판 id가 있으면 시작 ***/
header ("Content-Type: text/html; charset=UTF-8");
$dl = $dxr.$id.$xn."/list.dat";
$dn = $dxr.$id.$xn."/no.dat";
$db = $dxr.$id.$xn."/body.dat";
$rb = $dxr.$id.$xn."/rbody.dat";
$rl = $dxr.$id.$xn."/rlist.dat";
$dib_2 = $dxr.$id."/rtb.dat";
$dib_3 = $dxr.$id."/stb.dat";
$tdu = $dxr.$id."/_upload.dat";
$tgx = $dxr.$id."/tag.dat";
$tmx = $dxr.$id."/date.dat";
$dockie2 = substr(md5(preg_replace("`[^0-9]`i","",$dockie).$dxr),0,20);
$dockie3 = $_SESSION[$wtses];
if($_REQUEST['ntime']) {if($_REQUEST['ntime'] != $dockie2 || strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) === false || $_COOKIE[$docoo] != $dockie) {scrhref($dxpt,0,'글쓰기가 정상적으로 이뤄지지 않았습니다.');exit;}}
if($_POST['antispam'] || $_POST['wcontent'] || $_POST['content']) {
$tzt = preg_replace("/[^0-9]/","",md5($_POST['spm'].$sessid.$zro));
for($t=0;$tzt < 99999;$t++) $tzt += $tzt;
$tzt = strval(substr($tzt,-6));
}
if($_POST['wcontent'] || $_POST['content'] || $_POST['edit'] || $_POST['mode'] || $_POST['meem']) {
foreach($_POST as $key => $value) {
if(strpos($value,"\x1b") !== false) $_POST[$key] = str_replace("\x1b","Wx1b",$_POST[$key]);
}}
if($_POST['ckdoubled']) {
if(strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) !== false) {
echo "<script type='text/javascript'>parent.srchecked = ";
if($time - @filemtime($dn."@@") > 3) {
if($_POST['ckdoubled'] == '3') echo 3;
else if($_POST['ckdoubled'] == '2') echo ($time - @filemtime($rl."@@") < 3)? 2:3;
else echo 2;
} else echo 2;
echo ";</script>";
}
if(!$_POST['saved']) exit;
}
function tgxedit($tgz,$tzg,$tzz) {
global $tgx, $time;
usleepp($tgx."@@");
if($tzg == 3) $tgz = ",".$tgz.",";
else {
$tag7 = str_replace(",,",",",preg_replace("`[\s]?,[\s]?`", ",",str_replace("\'","´",str_replace('\"','˝',$tgz.","))));
$tag8 = ",".$tag7;
if($tzz) {
$tzz = ",".$tzz;
foreach(explode(",",$tag7) as $tz3) {
$tz3 = ",".$tz3.",";
if($tz3 != ",," && strpos($tzz,$tz3) !== false) {
$tag8 = str_replace($tz3,",",$tag8);
$tzz = str_replace($tz3,",",$tzz);
}}}}

if(!$tzz || $tzz != $tag7) {
$jtg = fopen($tgx."@@","w");
$tg = fopen($tgx,"r");
while($tgo = trim(fgets($tg))) {
$tgo8 = ",".substr($tgo,0,-8).",";
if($tzg == 3 && !$tok && $tgz == $tgo8) {
$tgo = substr($tgo,0,-8).str_pad(substr($tgo,-8,4) + 1,4,0,STR_PAD_LEFT).substr($tgo,-4);$tok=1;
} else if($tzg != 3 && $tag8 != "," && strpos($tag8,$tgo8) !== false) {
$tag8 = str_replace($tgo8,",",$tag8);
if($tzg != 2 && substr($tgo,-4) < 9999) $tgo = substr($tgo,0,-4).str_pad(substr($tgo,-4) + 1,4,0,STR_PAD_LEFT);
else if($tzg == 2){if(substr($tgo,-4) > 0) $tgo = substr($tgo,0,-4).str_pad(substr($tgo,-4) - 1,4,0,STR_PAD_LEFT); else $tgo = '';}
} else if($tzz && $tzz != "," && strpos($tzz,$tgo8) !== false) {if(substr($tgo,-4) > 0) $tgo = substr($tgo,0,-4).str_pad(substr($tgo,-4) - 1,4,0,STR_PAD_LEFT);else $tgo = '';}
if($tgo) fputs($jtg,$tgo."\n");
}
fclose($tg);
if($tzg == 1 && $tag8 != ",") {
$tag8 = str_replace(",","00000001\n",substr($tag8,1));
fputs($jtg,$tag8);
}
fclose($jtg);
copy($tgx."@@",$tgx);
unlink($tgx."@@");
}
if($tzg == 1) return $tag7;
}
if($_POST['ajax']){
if(strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) !== false){
if($_POST['notifx']) {if($mbr_no && @filesize($dxr."_member_/notify_".$mbr_no) > 1) fclose(fopen($dxr."_member_/notify_".$mbr_no,"w"));exit;}
if($_POST['onload']) {
if(!$_COOKIE[$docoo] || $_COOKIE[$docoo] != $dockie) {if(!setcookie($docoo, $dockie)) {echo "alert('쿠키를 열어주세요');";exit;}}
echo "\nif(!sessno) sessno = ".(int)substr(preg_replace("`[^0-9]`","",md5($_SERVER['REMOTE_ADDR'].$zro)),0,3).";";
}
if($_POST['check_memo'] || $_POST['onload']) {
if($mbr_no && $mbr_level) {
fclose(fopen($dxr."_member_/logged_".$mbr_no,"w"));
if($sett[52] > 1 && $sett[57] != 'a' && $sett[57] <= $mbr_level) {
$fim = fopen($dmo, "r");
while(!feof($fim)) {
if(substr(fgets($fim),3,5) == $mbr_n5) {
$ismemo="new_memo";
break;
}}
fclose($fim);
$isckmemo = 1;
}
$vn = (($_POST['id'] !== 1 && $_POST['alst'] && $_POST['alst'] < $lst)? 3:1);
if($sett[83]) {
$afsz = @filesize($dxr."_member_/notify_".$mbr_no);
if($afsz !== 1) {
$isckmemo = 1;
if($afsz > 1) {
echo "setTimeout(\"isnotiff(".$vn.",'";
$af = fopen($dxr."_member_/notify_".$mbr_no,"r");
while($afo = fgets($af)) echo trim($afo)."#";
fclose($af);
echo "')\",1600);";
$vn = 1;
}}}}
if($vn == 3) echo "setTimeout(\"isnotiff(2)\",100);";
if($sett[89] != 'a' && $sett[89] <= $mbr_level && $id && $wdth[5][0] != 'a' && $wdth[5][0] <= $mbr_level) {
$isckmemo = 1;
if($_POST['rptime'] && $_POST['rptime'] < filemtime($rl)) {
$nfn = fopen($dn,"r");
while($nfno = fgets($nfn)){
if($no6 == substr($nfno, 0, 6)) {
$nfne = explode("\x1b",$nfno);
break;
}}
fclose($nfn);
$nfno = $nfne[2] - (int)$_POST['rps'];
if($nfne > 0) echo "ckrps({$nfno},{$nfne[2]},{$_POST['no']});";
}}
if($isckmemo == 1 || $sett[84]) {
if(!$ismemo) $ismemo = 'none';
echo "setTimeout(\"checkmemo('{$ismemo}')\",1500);";
}}
if($_POST['tglus']) tgxedit(urldecode($_POST['tglus']),3,0);
if($_POST['antispam']) {echo ($_POST['antispam'] == $tzt)? "a":"b";exit;}
else if($sett[84] && isset($_POST['isvcnct'])) {
$mlgd = 0;
$mlge = 0;
$vcndr = $dxr."_member_/visitors/";
if(!file_exists($vcndr)) {
mkdir($vcndr,0777);
if(!$mbr_level) $mlge = 1;
} else if($_POST['isvcnct']) {
$mlg = opendir($dxr."_member_");
while($mlgo = readdir($mlg)) {
if(substr($mlgo,0,7) == 'logged_' && $time - filemtime($dxr.'_member_/'.$mlgo) < 60) $mlgd++;
}
closedir($mlg);
$mle = opendir($vcndr);
while($mleo = readdir($mle)) {
if($mleo != '.' && $mleo != '..') {
if((!$mbr_level && $mleo == $_SERVER['REMOTE_ADDR'])|| $time - filemtime($vcndr.$mleo) < 60) $mlge++;
else unlink($vcndr.$mleo);
}}
closedir($mle);
}
if(!$mbr_level) fclose(fopen($vcndr.$_SERVER['REMOTE_ADDR'],"w"));
if($_POST['isvcnct']) echo "$('isvcnnct1').innerHTML = '{$mlgd}';$('isvcnnct2').innerHTML = '{$mlge}';";
}} else {echo "alert('정상적인 접근이 아닙니다');";exit;}
}
function sendtb($tburl, $tblink, $subject, $content, $no) {
global $sett, $id, $dib_3, $index, $time;
$url = $sett[14].$index."?id=".$id."&no=".$no;
$post_data = "title=".urlencode($subject)."&url=".urlencode($url)."&excerpt=".urlencode(strcut($content,256))."&blog_name=".urlencode($sett[0]);
$tbu = parse_url($tburl);
if($fp = fsockopen($tbu['host'], 80, $errno, $errstr, 30)){
fputs($fp, "POST ".$tbu['path']." HTTP/1.1\r\n");
fputs($fp, "Host: ".$tbu['host']."\r\n");
fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Content-Length: ".strlen($post_data)."\r\n");
fputs($fp, "Connection: close\r\n\r\n");
fputs($fp, $post_data."\r\n\r\n");
while($data = fgets($fp, 4096)) $memo .= $data;
fclose($fp);
if(strpos($memo, 'error>0</error')) {
$sql = str_pad($no,6, 0, STR_PAD_LEFT)."\x1b".$tblink."\x1b\x1b".time()."\n";
usleepp($dib_3."@@");
$jtrb = fopen($dib_3."@@","w");
fputs($jtrb,$sql);
$trb = fopen($dib_3,"r");
while($xxx = fgets($trb)) fputs($jtrb,$xxx);
fclose($trb);
fclose($jtrb);
copy($dib_3."@@",$dib_3);
unlink($dib_3."@@");
$url = 1;
}}
return (int)$url;
}
function thumb($deest){
global $ffldr, $sett, $tdu, $du;
$huoo = false;
$return = 0;
if(substr($deest,0,4) == 'fno/') $hno = 4;
else $hno = 5;
$dest = substr($deest,$hno);
if($hno == 4) {
$dests = str_pad($dest,6,0,STR_PAD_LEFT)."\n";
if($_POST['mode'] == "edit") $hu = fopen($du,"r");
else $hu = fopen($tdu,"r");
if($hu) {
while($huo = fgets($hu)) {
if(substr($huo,-7) == $dests) {
$huoo = strpos($huo,'/');
if($huoo !== false) {$destt = substr($huo,0,$huoo);$sname = str_replace('%','',urlencode(substr($huo,$huoo + 1,-17))).'_s.jpg';}
else $destt = substr($huo,0,-13);
if($_POST['mode'] == "edit") $destt = substr($destt,6);else $destt = substr($destt,26);
break;
}}
fclose($hu);
}} else $destt = str_replace("%","",$deest);
$dest = $ffldr.$destt;
if(file_exists($dest)) {
$ext = strtolower(substr($destt, -3));
if($huoo === false) $sname = substr($destt,0,-4)."_s.jpg";
$tname = $ffldr.$sname;
if(file_exists($tname)) $return = '/file/'.$sname;
else if(mkthumb($dest,$tname,$ext,(int)substr($sett[43],0,4),(int)substr($sett[43],4,4),(int)substr($sett[43],11,1),(int)substr($sett[43],8,3))) $return = '/file/'.$sname;
}
if(!$return) $return = '/'.$deest;
return $return;
}
function xdate($xdime, $xmp, $xmid){
global $dxr, $tmx, $time;
if($xmon = @date("Ym", $xdime)) {
usleepp($tmx."@@");
$jtmx = fopen($tmx."@@","w");
$xfx = fopen($tmx,"r");
$xfoo = '';
while(!feof($xfx)) {
$xfxo = fgets($xfx);
if(substr($xfxo, 0, 6) == $xmon) {
$xmx = 1;
if($xmp) $xfxn = (int)substr($xfxo, 6) + 1;
else $xfxn = (int)substr($xfxo, 6) - 1;
if($xfxn) $xfoo .= $xmon.$xfxn."\n";
} else $xfoo .= $xfxo;
}
if($xmx != 1) $xfoo = $xmon."1\n".$xfoo;
fputs($jtmx, $xfoo);
fclose($xfx);
fclose($jtmx);
copy($tmx."@@", $tmx);
unlink($tmx."@@");
$xmx = 2;
if($xmid) {
usleepp($xmid."@@");
$jxmid = fopen($xmid."@@","w");
$smx = fopen($xmid,"r");
$xfoo = '';
while(!feof($smx)) {
$xfxo = fgets($smx);
if(substr($xfxo, 0, 6) == $xmon) {
$xmx = 1;
$xfxn = (int)substr($xfxo, 6) + 1;
$xfoo .= $xmon.$xfxn."\n";
} else $xfoo .= $xfxo;
}
if($xmx != 1) $xfoo = $xmon."1\n".$xfoo;
fputs($jxmid, $xfoo);
fclose($smx);
fclose($jxmid);
copy($xmid."@@", $xmid);
unlink($xmid."@@");
}
}
}
function mmd($nn, $num, $p, $first, $last) {
	global $dxr, $dim, $sss, $time;
if((int)$nn) {
if($p != "2") {
$val = ($p == '1')? 1:-1;
chmbr($nn, $num, $val);
}
if(!$sss[64] && !$sss[62]) {
$last = strcut($last, 100)."\n";
$file = ($num == 1)? $dxr."_member_/rp_".$nn:$dxr."_member_/list_".$nn;
usleepp($file."@@");
$jfile = fopen($file."@@","w");
if($p == "1") fputs($jfile,$first.$last);
if($fd = @fopen($file,"r")) {
while(!feof($fd)) {
if($p != "1") {
$fdo = fgets($fd);
if(substr($fdo, 0, 26) != $first) fputs($jfile, $fdo);
else {
if($p == "2") fputs($jfile, $first.$last);
$p = 1;
}
} else fputs($jfile, fgets($fd));
}
fclose($fd);
}
fclose($jfile);
copy($file."@@",$file);
unlink($file."@@");
}
}
}
function newrp($newrp) {
	global $id, $dxr, $time, $sss;
	usleepp($dxr.$id."/new_rp.dat@@");
	$jnew = fopen($dxr.$id."/new_rp.dat@@","w");
	$fm = fopen($dxr.$id."/new_rp.dat","r");
	while(!feof($fm)) {
	$fmo = fgets($fm);
	if(false === strpos($newrp, substr($fmo, 0, 6).":")) fputs($jnew,$fmo);
	}
	fclose($fm);
	fclose($jnew);
	copy($dxr.$id."/new_rp.dat@@",$dxr.$id."/new_rp.dat");
	unlink($dxr.$id."/new_rp.dat@@");
}

function divide($lstp, $fctp, $before, $adn, $adv, $next) {
global $dxr, $id, $wdth, $lst, $fct, $sett, $ds, $dct, $ctg, $ctgn, $ctl;
if($before) {
$lstt = $lstp;
$fctt = $fctp;
} else {
$lstt = $lst;
$fctt = $fct;
}
$bn = fopen($dxr.$id."/bno.dat","a+");
for($b =1;$b < $wdth[6];$b++) {fgets($bn);}
$bno = $fctt - substr(fgets($bn),6,6);
if($bno >= $sett[7]) {
$bnno = str_pad($lstt,6, 0, STR_PAD_LEFT).str_pad($fctt,6, 0, STR_PAD_LEFT).str_pad($bno,6, 0, STR_PAD_LEFT)."\n";
fputs($bn, $bnno);
}
fclose($bn);
if($bnno) {
$dvd = $wdth[6] + 1;
mkdir($dxr.$id."/^".$dvd, 0777);
copy($dxr.$id."/body.dat", $dxr.$id."/^".$dvd."/body.dat");
copy($dxr.$id."/list.dat", $dxr.$id."/^".$dvd."/list.dat");
copy($dxr.$id."/no.dat", $dxr.$id."/^".$dvd."/no.dat");
copy($dxr.$id."/^".$dvd."/no.dat", $dxr.$id."/^".$dvd."/no.dat_bk");
copy($dxr.$id."/rbody.dat", $dxr.$id."/^".$dvd."/rbody.dat");
copy($dxr.$id."/rlist.dat", $dxr.$id."/^".$dvd."/rlist.dat");
fclose(fopen($dxr.$id."/body.dat","w"));
fclose(fopen($dxr.$id."/list.dat","w"));
fclose(fopen($dxr.$id."/no.dat","w"));
fclose(fopen($dxr.$id."/rbody.dat","w"));
fclose(fopen($dxr.$id."/rlist.dat","w"));
} else $dvd = $wdth[6];

if($adn) $wdth[$adn] = $adv;
$ncct = substr($wdth[0],0,10).str_pad($lstp,6, 0, STR_PAD_LEFT).str_pad($fctp,6, 0, STR_PAD_LEFT).substr($wdth[0], 22)."\x1b".$wdth[1]."\x1b".$wdth[2]."\x1b".$wdth[3]."\x1b".$wdth[4]."\x1b".$wdth[5]."\x1b".$dvd."\x1b".$wdth[7]."\x1b".$wdth[8]."\x1b".$wdth[9]."\x1b\n";
nds($ncct);
if($_POST['ct']) {
$ncct = "";
$pct = str_pad($_POST['ct'], 2, 0, STR_PAD_LEFT);
$ctgn[$pct]++;
for($i = 1;$i <= $ctl;$i++) {
$ii = str_pad($i, 2, 0, STR_PAD_LEFT);
if($ctg[$ii]) $ncct .= "\x1b".$ctg[$ii].str_pad($ctgn[$ii],6,0,STR_PAD_LEFT);
}
ndc($ncct."\x1b\n");
}
return $nnext;
}
function nodat($ndn,$ndne,$ndnev) {
global $dn, $time, $sett;
$exit = 0;
if($fnfz = filesize($dn)) {
usleepp($dn."@@");
$njdn = fopen($dn."@@","w");
$nfn = fopen($dn,"r");
while($nfno = fgets($nfn)){
if($ndn == (int)substr($nfno, 0, 6)) {
if(substr($nfno,6,2) == 'aa') {$exit = 1;break;}
$nfne = explode("\x1b", trim($nfno));
if($nfne[$ndne] != 'a') {
$fnfz -= strlen($nfno);
if($ndne == 5) {
$nvote = explode('|',$nfne[5]);
if($ndnev == 2) {$nfne[5] = $nvote[0].'|'.($nvote[1] + 1);$nde = -1;}
else if($ndnev == 1) {$nfne[5] = ($nvote[0] + 1).'|'.$nvote[1];$nde = 1;}
else {$nde = substr($ndnev,1);$nfne[5] = ($nvote[0] + $nde).'|'.($nvote[1] + 1);$nde -= 2.5;}
if($nde && ($ndnn = (int)substr($nfno,9))) chmbr($ndnn,11,$nde);
} else {
$nfne[$ndne] = $nfne[$ndne] + $ndnev;
if($nfne[$ndne] < 0) $nfne[$ndne] = '0';
if($ndne == 4 && $sett[80] <= $nfne[4]) $nfne[0] = substr($nfne[0],0,8)."9".substr($nfne[0],9);
}
$nfno = $nfne[0]."\x1b".$nfne[1]."\x1b".$nfne[2]."\x1b".$nfne[3]."\x1b".$nfne[4]."\x1b".$nfne[5]."\x1b".$nfne[6]."\x1b\n";
$fnfz += strlen($nfno);
} else {$exit = 1;break;}
}
fputs($njdn, $nfno);
}
fclose($nfn);
fclose($njdn);
if($exit != 1 && $fnfz == filesize($dn."@@")) {copy($dn,$dn."_m");copy($dn."@@",$dn);$exit = 2;}
unlink($dn."@@");
}
return $exit;
}
function ndc($ncc) {
global $ds, $dc, $id10, $time;
$nccx = strpos(substr($ncc,-9,7),"\x1b");
if($nccx !== false) {$ncc = substr($ncc,0,-9 +$nccx)."\x1b\n";
while(substr($ncc,-9) == "\x1b000000\x1b\n") {$ncc = substr($ncc,0,-8)."\n";}
while(substr($ncc,-3) == "\x1b\x1b\n") {$ncc = substr($ncc,0,-2)."\n";}
}
usleepp($dc."@@");
$jdc = fopen($dc."@@","w");
$nfc = fopen($dc,"r");
$nfs = fopen($ds,"r");
while(!feof($nfs)){
$ndss = fgets($nfs);
$ndcc = fgets($nfc);
if(substr($ndss, 0, 10) == $id10) $ndcc = $ncc;
fputs($jdc,$ndcc);
}
fclose($nfs);
fclose($nfc);
fclose($jdc);
copy($dc."@@",$dc);
unlink($dc."@@");
}
function nds($nss) {
global $ds, $dc, $id10, $time;
usleepp($ds."@@");
$jds = fopen($ds."@@","w");
$nfs = fopen($ds,"r");
$sxxx = filesize($ds) + strlen($nss);
while(!feof($nfs)){
$ndss = fgets($nfs);
if(substr($ndss, 0, 10) == $id10) {$sxxx -= strlen($ndss);$ndss = $nss;}
fputs($jds,$ndss);
}
fclose($nfs);
fclose($jds);
if($sxxx == filesize($ds."@@")) {copy($ds,$ds."_bk");copy($ds."@@",$ds);}
unlink($ds."@@");
}
function mcontent($str) {
global $mbr_level;
if($mbr_level != 9) {
$str = str_replace("<script","&lt;",$str);
$sts = strpos($str,'<iframe');
if($sts !== false) {
$strr = '';
while($sts !== false) {
$sstr = substr($str,0,$sts);
$str = substr($str,$sts + 7);
$sttx = substr($str,0,strpos($str,'>'));
$sttx = substr($sttx,strpos($sttx,'src=') + 12);
$sttx = substr(substr($sttx,0,strpos($sttx,'/')),-13);
if($sttx == 'w.youtube.com' || $sttx == 'yer.sbs.co.kr' || $sttx == 'el.pandora.tv' || $sttx == 'nmv.naver.com') $sstr .= '<iframe';
else $sstr .= '&lt;iframe';
$sts = strpos($str,'<iframe');
$strr .= $sstr;
}
$str = $strr.$str;
}
$sttr = $str;
while(($sts = strpos($sttr,'<object')) !== false) {
$sttr = substr($sttr,$sts + 7);
$sttx = strtolower(substr($sttr,0,strpos($sttr,'>')));
if(strpos($sttx,'base64') || strpos($sttx,'script')) {$str = str_replace("<object","&lt;object",$str);break;}
}
if(strpos($str,' on')) {
$str = preg_replace("` on(click|mouseover|mouseout|dblclick)(=['\"])(imgview|preview|toggle|nwopn|this\.style\.display)`"," \x10on$1$2$3",$str);
$str = preg_replace("`<([^>]+) on[^> ]+`", "<$1", $str);
$str = str_replace(" \x10on", " on", $str);
}}
//$str = str_replace("<img src=", "<img name='img580' onclick='imgview(this.src)' src=", $str);
$str = str_replace("<a href=", "<a target='_blank' href=", $str);
if($_POST['addfield']) {
for($a=0;isset($_POST['addfield'][$a]);$a++) $str .= "\x1b".stripslashes($_POST['addfield'][$a]);
}
return $str;
}
function notifxz($ntfxzn,$ntfxznl) {
global $rl, $id10;
$ntfxzfn = fopen($rl,"r");
$ntfxzzp = 1;
while($ntfxznl > 0 && !feof($ntfxzfn)){
$ntfxzzzz = fgets($ntfxzfn);
if($ntfxzn == substr($ntfxzzzz, 0, 6)) {
$ntfxznl--;
$ntfxzzn = substr($ntfxzzzz, 13, 1);
if($ntfxzzn > $ntfxzzp) {
if($ntfxzzo)  notiff($ntfxzzo,0,$id10.$ntfxzn,0);
} else $ntfxzzo = (int)substr($ntfxzzzz, 24, 5);
$ntfxzzp = $ntfxzzn;
}
}
fclose($ntfxzfn);
}
if($_POST['ajax']){
if($_POST['nlus']) {
nodat($_POST['nlus'],1,1);
if($mbr_no) chmbr($mbr_no,9,1);
} else if($_POST['rvote']){
if($mbr_level >= $wdth[9][0]){
	$vte = 0;
	$gt = "_r".(int)$_POST['rvote']."_";
	if($_COOKIE["vtd_".$id]) {
		if(false === strpos($_COOKIE["vtd_".$id], $gt)) {
			$gt = $_COOKIE["vtd_".$id].substr($gt,1);
			setcookie("vtd_".$id, $gt, $time + ($sett[29]*86400));
			$vte = 1;
		}
	} else {
	setcookie("vtd_".$id, $gt, $time + ($sett[29]*86400));
	$vte = 1;
	}
if($vte == 1){
$dv = $dxr.$id."/vote.dat";
$ydate = $time - $sett[29]*86400;
$num = str_pad($_POST['rvote'], 7, 0, STR_PAD_LEFT);
if(filemtime($dv) > $ydate) {
usleepp($dv."@@");
$jdv = fopen($dv."@@","w");
$fv = fopen($dv,"r");
while(!feof($fv)) {
	$vvv = fgets($fv);
	if(substr($vvv,0,10) < $ydate) $vvv = '';
	else {
	if($num == substr($vvv,10,7)) {
	$vnum = 1;
	if(false !== strpos($vvv, "\x1b".$_SERVER['REMOTE_ADDR']."\x1b")) {
	$vte = 2;
	break;
	} else $vvv = $time.$num.substr(trim($vvv),17).$_SERVER['REMOTE_ADDR']."\x1b\n";
	}}
fputs($jdv, $vvv);
}
if($vnum != 1) fputs($jdv, $time.$num."\x1b".$_SERVER['REMOTE_ADDR']."\x1b\n");
fclose($fv);
fclose($jdv);
if($vte != 2) copy($dv."@@",$dv);
unlink($dv."@@");
} else {
$fv = fopen($dv,"w");
$vvv = $time.$num."\x1b".$_SERVER['REMOTE_ADDR']."\x1b\n";
fputs($fv, $vvv);
fclose($fv);
}
if($vte != 2){
$mrcnt = 0;
usleepp($rl."@@");
$jrl = fopen($rl."@@","w");
$cl = fopen($rl,"r");
while(!feof($cl)){
$clo = fgets($cl);
if(!$mrcnt && substr($clo,6,7) == $num) {
if(!$mbr_no || $mbr_no != (int)substr($clo,24,5)) {
$clx = explode("\x1b",$clo);
if($_POST['apop'] == 1) $clx[1] = $clx[1] + 1;else $clx[2] = $clx[2] + 1;
$clo = trim($clx[0])."\x1b".$clx[1]."\x1b".$clx[2]."\x1b\n";
} else break;
$mrcnt = 2;
}
fputs($jrl, $clo);
}
fclose($jrl);
fclose($cl);
if($mrcnt == 2) copy($rl."@@",$rl);
unlink($rl."@@");
if($mrcnt == 2) echo ($_POST['apop'] == 1)? "alert('추천했습니다');":"alert('비추했습니다');";
echo "location.reload();";
} else echo "alert('이미 평가하셨습니다');";
} else echo "alert('이미 평가하셨습니다');";
} else if($_POST['vote']){
} else echo "alert('권한이 없습니다');";
} else if($_POST['vote']){
if(($_POST['apop'] != '3' && ($wdth[0][60] || $wdth[0][61] || $wdth[7][5])) || ($_POST['apop'] == '3' && $wdth[0][49] == '2')) {
if(($_POST['apop'] != '3' && $mbr_level >= $wdth[9][0]) || ($_POST['apop'] == '3' && $sett[79] <= $mbr_level)) {
/** 추천 처리 시작 **/
	$vte = 0;
	$gt = "_".$_POST['vote']."_";
	$vtdid = ($_POST['apop'] != '3')? "vtd_".$id:"atd_".$id;
	if($_COOKIE[$vtdid]) {
		if(false === strpos($_COOKIE[$vtdid], $gt)) {
			$gt = $_COOKIE[$vtdid].substr($gt,1);
			setcookie($vtdid, $gt, $time + ($sett[29]*86400));
			$vte = 1;
		}
	} else {
	setcookie($vtdid, $gt, $time + ($sett[29]*86400));
	$vte = 1;
	}
if($vte == 1){
$dv = ($_POST['apop'] != '3')? $dxr.$id."/vote.dat":$dxr.$id."/accused.dat";
$ydate = $time - $sett[29]*86400;
$num = str_pad($_POST['vote'], 6, 0, STR_PAD_LEFT);
if(file_exists($dv) && filemtime($dv) > $ydate) {
usleepp($dv."@@");
$jdv = fopen($dv."@@","w");
$fv = fopen($dv,"r");
while(!feof($fv)) {
	$vvv = fgets($fv);
	if(substr($vvv,0,10) < $ydate) $vvv = '';
	else {
	if($num == substr($vvv,10,6)) {
	$vnum = 1;
	if(false !== strpos($vvv, "\x1b".$_SERVER['REMOTE_ADDR']."\x1b")) {
	$vte = 2;
	break;
	} else $vvv = $time.$num.substr(trim($vvv),16).$_SERVER['REMOTE_ADDR']."\x1b\n";
	}}
fputs($jdv, $vvv);
}
if($vnum != 1) fputs($jdv, $time.$num."\x1b".$_SERVER['REMOTE_ADDR']."\x1b\n");
fclose($fv);
fclose($jdv);
if($vte != 2) copy($dv."@@",$dv);
unlink($dv."@@");
} else {
$fv = fopen($dv,"w");
$vvv = $time.$num."\x1b".$_SERVER['REMOTE_ADDR']."\x1b\n";
fputs($fv, $vvv);
fclose($fv);
}
if($vte != 2){
if($_POST['apop'] == '3') {
if($sett[81] == '1') $apop = 1;
else $apop = (int)($mbr_level/$sett[81]) + 1;
nodat($num,4,$apop);
echo "alert('신고했습니다');";
} else {
nodat($num,5,$_POST['apop']);
if($mbr_no) chmbr($mbr_no,10,1);
if($_POST['apop'][0] != 's') echo ($_POST['apop'] == 1)? "alert('추천했습니다');":"alert('비추했습니다');";
echo "location.reload();";
}
} else echo "alert('이미 평가하셨습니다');";
} else echo "alert('이미 평가하셨습니다');";
} else echo "alert('권한이 없습니다');";
}
/** 추천 처리 끝 **/
}
exit;
}
/** if($_POST['ajax']){ **/
if(!$_POST['vote'] && !$_POST['rvote'] && $sss[43] != 'a' && $sss[43] <= $mbr_level) $_SERVER['REMOTE_ADDR'] = "               ";
if($_POST['remote']) {
if(!$mbr_no && $_POST['name'] && $_POST['pass'] && $_POST['wcontent'] && !$_POST['pno'] && !$_POST['edit'] && !$_POST['vote'] && !$_POST['exc'] && !$_POST['selected'] && !$_POST['ntime'] && !$_POST['mode'] && !$_POST['content'] && !$_POST['delfile'] && !$_POST['email'] && !$_POST['meem']) {
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(trim(substr($xxx,5,15)) == $_POST['name']) {
$okok = explode("\x1b", $xxx);
if(md5(substr($okok[6],0,10).$_POST['pass']) == substr($okok[0],20)) {$mbr_no = (int)substr($okok[0],0,5);$_SESSION['m_nick']=$okok[1];$mbr_level=$okok[2];$_POST['pass'] = '';}
break;
}
}
fclose($fim);
if(!$mbr_level || !$sett[54] || $mbr_level < $sett[54]) exit;
$sett[82] = 0;
} else exit;}
if($_POST['request']) $_POST['request'] = str_replace("&amp;","&",$_POST['request']);
if($_POST['link']) {$_POST['link'] = stripslashes($_POST['link']);if($_POST['link'] == 'http://') $_POST['link'] = '';}
if($mbr_level < $sett[87] && (($_POST['wcontent'] && (int)$sett[85] > 0 && $sett[85]*1024 < strlen($_POST['wcontent'])) || ($_POST['content'] && (int)$sett[86] > 0 && $sett[86]*1024 < strlen($_POST['content']))))  {scrhref($dxpt."&amp;p=1",0,"내용이 너무 깁니다.");exit;}
if($_GET['rss']) {
/** rss 출력 시작**/
if($fct > 0 && $sss[22] == "0" && $sss[23] == "0" && $sss[29]) {
//$wdth[1] = rsst($wdth[1]);
header("Content-Type: text/xml; charset=UTF-8");
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\" ?".">\n";
echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";
echo "<channel>\n";
echo "<title>".rsst($sett[0])."</title>\n";
echo "<link>".$sett[14].$index."?id=".$id."</link>\n";
echo "<description>".$wdth[1]."</description>\n";
echo "<language>ko</language>\n";
echo "<generator>{$srboard}</generator>\n";
$fl = fopen($dl,"r");
$fb = fopen($db,"r");
$fn = fopen($dn,"r");
for($ii = 1;$ii <= $sett[35] && !feof($fn);$ii++) {
$fno = fgets($fn);
$flo = explode("\x1b", fgets($fl));
$fbo = trim(fgets($fb));
if($fno[8] == "0" && $fno[6] != 'a') {
if($fbe = strpos($fbo,"\x1b")) $fbo = substr($fbo,0,$fbe);
if($sett[27]) $fbo = preg_replace("`<[^>]+>`","",preg_replace("`<(/?[ab])`i","&lt;$1",$fbo));
$furl = $sett[14].$index."?id=".$id."&amp;no=".(int)substr($fno, 0, 6);
if($wdth[7][1] && $sett[4]) $fbo = strcut($fbo,128*pow(2,$sett[4] -1))."<br /><a target='_blank' href='".$furl."'>글 전체보기</a>";
if(trim($flo[0])){
if($ii == 1) echo "<pubDate>".gmdate("D, d M Y H:i:s", substr($flo[0], 0, 10))." +0900</pubDate>\n";
echo "<item>\n";
echo "<title>".rsst($flo[3])."</title>\n";
echo "<link>".$furl."</link>\n";
echo "<guid>".$furl."</guid>\n";
echo "<description>".rsst($fbo)."</description>\n";
echo "<category>".$wdth[1]."</category>\n";
$floo = explode(",",$flo[6]);
for($j =0; trim($floo[$j]); $j++) echo "<category>".$floo[$j]."</category>\n";
echo "<dc:creator>".rsst($flo[1])."</dc:creator>\n";
echo "<pubDate>".gmdate("D, d M Y H:i:s", substr($flo[0], 0, 10))." +0900</pubDate>\n";
echo "</item>\n";
} else if($usmw != $id && $wdth[6]) {
$usmw = $id;
fclose($fl);
fclose($fn);
fclose($fb);
$fn = fopen($dxr.$id."/^".$wdth[6]."/no.dat","r");
$fl = fopen($dxr.$id."/^".$wdth[6]."/list.dat","r");
$fb = fopen($dxr.$id."/^".$wdth[6]."/body.dat","r");
$ii--;
}
} else $ii--;
}
fclose($fl);
fclose($fb);
fclose($fn);
echo "</channel>\n";
echo "</rss>\n";
}
exit;
/** rss 출력 끝**/
} else if($trbk){
/** 트랙백 처리 시작**/
header("Content-type: text/xml;charset=utf-8");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
if (!$_POST['url'] || !$_POST['title'])  $error = "no";
else if($_POST['title'] == $_POST['excerpt'] || $_POST['blog_name'] == $_POST['title']) $error = "no";
if($error == 'no' || $sss[49] != '1') {
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n<response>\n<error>1</error>\n<message>Incomplete Information</message>\n</response>";
} else {
$tr6 = str_pad($trbk[1],6, 0, STR_PAD_LEFT);
if($sett[71][21] != 0) {
$gn = fopen($dn,"r");
$gl = fopen($dl,"r");
while(substr(fgets($gn),0,6) !== $tr6) fgets($gl);
$dctime = $time - substr(fgets($gl),0,10);
fclose($gn);
fclose($gl);
}
if($sett[71][21] != 0 && $dctime > $cuttime[$sett[71][21]]) {
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n<response>\n<error>1</error>\n<message>Incomplete Information</message>\n</response>";
} else {
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n<response>\n<error>0</error>\n</response>";
$title_length = strlen($_POST['title']);
if(mb_detect_encoding($_POST['title'],"UTF-8,EUC-KR,ASCII") != 'UTF-8') {
	$_POST['blog_name'] = iconv("CP949", "UTF-8//IGNORE", $_POST['blog_name']);
	$_POST['title'] = iconv("CP949", "UTF-8//IGNORE", $_POST['title']);
	if($_POST['excerpt']) $_POST['excerpt'] = iconv("CP949", "UTF-8//IGNORE", $_POST['excerpt']);
}
if(nodat($trbk[1],4,1) == 2) {
$_POST['title'] = str_replace("\\","",stripslashes($_POST['title']));
$_POST['excerpt'] = str_replace("\\","",stripslashes($_POST['excerpt']));
$sql = $tr6."\x1b".trim($_POST['blog_name'])."\x1b".$_POST['url']."\x1b".trim($_POST['title'])."\x1b".preg_replace("`[\r]?[\n]`", "<br />", $_POST['excerpt'])."\x1b".$time."\x1b".$_SERVER['REMOTE_ADDR']."\n";
usleepp($dxr.$id."/rtb.dat@@");
$jtrb = fopen($dxr.$id."/rtb.dat@@","w");
fputs($jtrb,$sql);
$trb = fopen($dxr.$id."/rtb.dat","r");
while($xxx = fgets($trb)) fputs($jtrb,$xxx);
fclose($trb);
fclose($jtrb);
copy($dxr.$id."/rtb.dat@@",$dxr.$id."/rtb.dat");
unlink($dxr.$id."/rtb.dat@@");
}}}
exit;
/** 트랙백 처리 끝**/
} else if($_POST['exc'] || $_POST['selected']) {
if($_POST['ifno'] && $_POST['selected'] == 'ifno') {
include('include/select_range.php');exit;
}
if($_POST['exc'] == "delete" && $sss[66]) {$_POST['exc'] = "change";$_POST['changeto'] = "aa";include("include/selected.php");$_POST['exc'] = "modify_cnt";$_POST['changeto'] = "";}
if($_POST['exc']  == "delete_rp" || $_POST['exc'] == "delete" || ($_POST['moveto'] && $_POST['exc'] != "copy")) {
if($sett[83]) {
$ntfxxfn = fopen($dn,"r");
while(!feof($ntfxxfn)){
$ntfxxzzz = fgets($ntfxxfn);
$ntfxxzn = substr($ntfxxzzz, 0, 6);
if(false !== strpos($_POST['selected'], $ntfxxzn.":")) {
$ntfxxex = explode("\x1b", $ntfxxzzz);
if($ntfxxex[2] > 0) {
$ntfxxmn = substr($ntfxxex[0],9);
if($ntfxxmn) notiff($ntfxxmn,0,$id10.$ntfxxzn,0);
if($ntfxxex[2] > 1) notifxz($ntfxxzn,$ntfxxex[2]);
}}}
fclose($ntfxxfn);
}}
/** 일괄선택 처리시작 **/
include("include/selected.php");
exit;
/** 일괄선택 처리끝 **/
} else if($_POST['edit'] == "modify_rp") {
if($sss[25] <= $mbr_level) {
/** 리플 수정 시작**/
if(md5($sessid) == $_POST['ip'] && $_COOKIE[$docoo] == $dockie) {
$mrcnt = 3;
$content = stripslashes($_POST['content']);
$content = preg_replace("`<([ai/][^am >])`i", "&lt;$1", preg_replace("`<([^ai/])`i", "&lt;$1", $content));
$cont = explode("<",$content);
$content = $cont[0];
for($i = 1;$cont[$i];$i++) {
$end = strpos($cont[$i],">") + 1;
$str = substr($cont[$i],0,$end);
if(substr($str,0,3) == 'IMG') $str = "img".substr($str,3);
else if(substr($str,0,1) == 'A') $str = "a".substr($str,1);
else if(substr($str,0,2) == "/A") $str = "/a".substr($str,2);
$str = str_replace(" \x18click", " onclick", str_replace(" on", " xx", preg_replace("` onclick=(['\"]?)parent.imgview`i"," \x18click=$1parent.imgview",$str)));
$str = preg_replace("` ([a-z]+)=([^'\"> ]+)`i"," $1='$2'",$str);
if(substr($str,0,3) == 'img' && substr($str,-2) != "/>") $str = substr($str,0,-1)." />";
$content .= "<".$str.substr($cont[$i],$end);
}
$content = str_replace("\r","",str_replace("\n","<br />",str_replace("\x7f","<br />",$content)));
if($_POST['rsecrt']) {
$content = "\x1b".$content;
$last = "[비밀글]";
} else $last = strcut($content,100);
$ttt = ($sett[92][1] == 1 || $sett[92][1] == 3)? 1:0;
if($ttt) {
usleepp($rl."@@");
$jrl = fopen($rl."@@","w");
}
usleepp($rb."@@");
$jrb = fopen($rb."@@","w");
$cb = fopen($rb,"r");
$cl = fopen($rl,"r");
while(!feof($cl)){
$clo = fgets($cl);
if(!$cbo && substr($clo,6,7) == $_POST['cc']) {
$pno6 = substr($clo,0,6);
$first = $id10.substr($clo, 0, 6).substr($clo, 14, 10);
if($sss[26] == 'd' && strpos($_POST['request'],'rp=') === false) $_POST['request'] .= "&amp;rp=".(int)substr($clo, 0, 6);
$mno = (int)substr($clo, 24, 5);
$cbo = fgets($cb);
if(($mno == 0 && $_POST['pass'] && $_POST['pass'] == trim(substr($cbo,15,10))) || ($mno > 0 && $mno == $mbr_no) || $mbr_level == "9") $psscked = 2;
else break;
$usetimecut = ckmdfx(1,1,0,$clo);
if($usetimecut === 4) break;
else if($usetimecut !== 7) {
if($usetimecut === 3 || $usetimecut === 5) {
$clx = @fgets($cl);
if(trim($clx) != '' && substr($clx, 0, 6) == $pno6 && substr($clo, 13, 1) < substr($clx, 13, 1)) break;
}}
if(!$mno && $_POST['link']) $_POST['link'] = "\x18{$_POST['link']}\x1b";
else $_POST['link'] = "";
if($ttt) fputs($jrl,substr($clo,0,14).$time.substr($clo,24));
fputs($jrb, substr($cbo,0,25).$_POST['link'].$content."\n");
if($usetimecut === 3 || $usetimecut === 5) fputs($jrb, fgets($cb));
$clx = $clo;
$mrcnt = 1;
} else {fputs($jrb, fgets($cb));if($ttt) fputs($jrl, $clo);}
}
fclose($cl);
fclose($jrb);
fclose($cb);
if($mrcnt === 1) copy($rb."@@",$rb);
unlink($rb."@@");
if($ttt) {
fclose($jrl);
if($mrcnt === 1) copy($rl."@@",$rl);
unlink($rl."@@");
}
if($mrcnt === 1) {
$content = strcut($content,100);
if(!$_POST['rsecrt']) {
$fn = fopen($dn,"r");
while(!feof($fn)){
$fno = fgets($fn);
if($pno6 == substr($fno, 0, 6)) {
$pno8 = $fno[8];
break;
}}
fclose($fn);
if($pno8) $content = "\x1b".$pno8.$content;
}
usleepp($dxr.$id."/new_rp.dat@@");
$jnew = fopen($dxr.$id."/new_rp.dat@@","w");
$fm = fopen($dxr.$id."/new_rp.dat","r");
while(!feof($fm)) {
$fmo = fgets($fm);
if($modfd != 3 && substr($fmo, 0, 14) == substr($clx, 0, 14)) {
fputs($jnew,substr($fmo, 0, 44).$content."\n");
$modfd = 3;
} else fputs($jnew,$fmo);
}
fclose($fm);
fclose($jnew);
copy($dxr.$id."/new_rp.dat@@",$dxr.$id."/new_rp.dat");
unlink($dxr.$id."/new_rp.dat@@");
mmd($mno, 1, "2", $first, $content);
scrhref($_POST['request'],1,0);
} else {
if($psscked != 2) $psscked = "비밀번호가 틀립니다. (".wpass(2)."/10)";
else $psscked = (($usetimecut === 3)?"덧글이 있어서":"시간 경과로")." 변경 금지되었습니다.";
scrhref($_POST['request'],1,$psscked);
}}} else scrhref($_POST['request'],'parent','권한이 없습니다');
exit;
/** 리플 수정 끝**/
} else if($_POST['edit'] == "del_reple") {
if($sss[25] <= $mbr_level || ($sss[25] == 'a' && $mbr_level == '9')) {
/** 리플 삭제 시작**/
$_POST['pno'] = str_pad($_POST['pno'], 6, 0, STR_PAD_LEFT);
$mrcnt = '';
usleepp($rl."@@");
$jrl = fopen($rl."@@","w");
$cl = fopen($rl,"r");
usleepp($rb."@@");
$jrb = fopen($rb."@@","w");
$cb = fopen($rb,"r");
while(!feof($cl)){
$clo = fgets($cl);
if(!$mrcnt && substr($clo,6,7) == $_POST['cc']) {
$mno = (int)substr($clo, 24, 5);
$cbo = fgets($cb);
if(($mno == 0 && $_POST['pass'] && $_POST['pass'] == trim(substr($cbo,15,10))) || ($mno > 0 && $mno == $mbr_no) || $mbr_level == "9") {
$psscked = 2;
$usetimecut = ckmdfx(1,2,0,$clo);
if($usetimecut !== 4) {
$mrcnt = 'three';
$clx = @fgets($cl);
$cbx = @fgets($cb);
if(trim($clx) != '' && substr($clx, 0, 6) == $_POST['pno'] && substr($clo, 13, 1) < substr($clx, 13, 1)) {
if($usetimecut !== 3 && $usetimecut !== 5) {
$clx = $clo.$clx;
$cbx = substr($cbo,0,25)."<span class='deleted_rp'>삭제된 덧글입니다.</span>\n".$cbx;
$mrcnt = 'four';
} else $mrcnt = 'exit';
}}}
if($mrcnt == 'three' || $mrcnt == 'four') {
fputs($jrl, $clx);
fputs($jrb, $cbx);
$cll = $clo;
	} else {
$mrcnt = 'exit';
if($psscked != 2) $psscked = "비밀번호가 틀립니다. (".wpass(2)."/10)";
else $psscked = (($usetimecut === 3)?"덧글이 있어서":"시간 경과로")." 삭제 금지되었습니다.";
echo "<script type='text/javascript'>/*<![CDATA[*/alert('".$psscked."');/*]]>*/</script>";
	break;
	}
} else {
fputs($jrl, $clo);
fputs($jrb, fgets($cb));
}
}
fclose($jrl);
fclose($cl);
fclose($jrb);
fclose($cb);
if($mrcnt && $mrcnt != 'exit') {
copy($rl."@@",$rl);
copy($rb."@@",$rb);
}
unlink($rl."@@");
unlink($rb."@@");
if($mrcnt && $mrcnt != 'exit') {
if($mrcnt != 'four') nodat($_POST['pno'],2,-1);
if($mno) {
$first = $id10.$_POST['pno'].substr($clx, 14, 10);
if($mrcnt != 'four') mmd($mno, 1, "0", $first, "");
else mmd($mno, 1, "2", $first, "삭제됨");
}
usleepp($dxr.$id."/new_rp.dat@@");
$jnew = fopen($dxr.$id."/new_rp.dat@@","w");
$fm = fopen($dxr.$id."/new_rp.dat","r");
while(!feof($fm)) {
$fmo = fgets($fm);
if($mrcnt != 'exit' && substr($fmo, 0, 14) == substr($cll, 0, 14)) {
if($mrcnt == 'four') fputs($jnew,substr($fmo, 0, 44)."삭제됨\n");
$mrcnt = 'exit';
} else fputs($jnew,$fmo);
}
fclose($fm);
fclose($jnew);
copy($dxr.$id."/new_rp.dat@@",$dxr.$id."/new_rp.dat");
unlink($dxr.$id."/new_rp.dat@@");
}
scrhref($_POST['request'],1,0);
} else scrhref($_POST['request'],'parent','권한이 없습니다');
exit;
/** 리플 삭제 끝**/
} else if($_POST['edit'] == "disclose" || $_POST['edit'] == "unlock") {
$alert = '';
if($mbr_level == "9") $scrt = "scrt_".$_POST['no'].$id;
else {
if($_POST['edit'] == "unlock") $_POST['pno'] = $_POST['no'];
$fn = fopen($dn,"r");
$fl = fopen($dl,"r");
while($zzz = @fgets($fn)){
	$xxx = fgets($fl);
	if($_POST['pno'] == (int)substr($zzz, 0, 6)) {
	$xxx = explode("\x1b",$xxx);
	$zzz = substr($zzz,9,strpos($zzz,"\x1b") -9);
	if(($mbr_no >= 1 && $zzz == $mbr_no) || (!$zzz && $_POST['pass'] && $xxx[2] == $_POST['pass'])) $scrt = "scrt_".$_POST['no'].$id;
	else if($_POST['edit'] == "unlock" && $_POST['pass']) $alert = "비밀번호가 틀립니다. (".wpass(2)."/10)";
	break;
	}
}
fclose($fl);
fclose($fn);
if(!$scrt && $_POST['edit'] != "unlock") {
$cpu = $_POST['cup'] - 1;
$cl = fopen($rl,"r");
$cb = fopen($rb,"r");
while($clo = @fgets($cl)){
$cbo = fgets($cb);
if((int)substr($clo,0,6) == $_POST['pno']) {
if(substr($clo,6,7) == $_POST['no'] || substr($clo,13,1) == $cpu) {
$cclo = (int)substr($clo, 24, 5);
$cbo = trim(substr($cbo,15,10));
if(substr($clo,6,7) == $_POST['no']) {
if((($cclo >= 1 && $cclo == $mbr_no) || ($cclo == 0 && $_POST['pass'] && $_POST['pass'] == $cbo)) || (($ccp[0] >= 1 && $ccp[0] == $mbr_no) || ($ccp[0] == 0 && $_POST['pass'] && $_POST['pass'] == $ccp[1]))) $scrt = "scrt_".$_POST['no'].$id;
else if($_POST['pass']) $alert = "비밀번호가 틀립니다. (".wpass(2)."/10)";
break;
} else $ccp = array($cclo,$cbo);
}
}}
fclose($cl);
fclose($cb);
}
}
if($scrt) setcookie($scrt,md5($_POST['no']."_".$sessid.$id));
scrhref($_POST['request'],1,$alert);
exit;
} else if($_POST['edit'] == "del_rtb" || $_POST['edit'] == "del_stb") {
/** 보낸/받은 트랙백 삭제 시작**/
$fn = fopen($dn,"r");
$fl = fopen($dl,"r");
$mrcnt = 1;
while(!feof($fn)){
	$zzz = fgets($fn);
	if($_POST['pno'] == (int)substr($zzz, 0, 6)) {
	$crp = explode("\x1b", $zzz);
	$xxx = fgets($fl);
	if(substr($zzz,6,2) == 'aa') {$mrcnt = 0;break;}
	if(($mbr_no >= 1 && substr($zzz,9,strpos($zzz,"\x1b") - 9) == $mbr_no) || ($_POST['pass'] && trim(substr($xxx, 20, 10)) == $_POST['pass']) || $mbr_level == "9") {
	if($_POST['edit'] == "del_rtb") nodat($_POST['pno'],4,-1);
	else if($_POST['edit'] == "del_stb") nodat($_POST['pno'],3,-1);
	} else $mrcnt = 0;
	break;
}}
fclose($fl);
fclose($fn);
if($mrcnt == 1) {
if($_POST['edit'] == "del_rtb") $file = $dib_2;
else $file = $dib_3;
usleepp($file."@@");
$jfile = fopen($file."@@","w");
$fb = fopen($file,"r");
$i = 1;
while(!feof($fb)){
$mmm = fgets($fb);
if($i != $_POST['cc']) fputs($jfile, $mmm);
$i++;
}
fclose($fb);
fclose($jfile);
copy($file."@@",$file);
unlink($file."@@");
}
scrhref($_POST['request'],1,0);
/** 보낸/받은 트랙백 삭제 끝**/
} else if(is_uploaded_file($_FILES['file']['tmp_name']) && !$_POST['delfile']){
echo "<script type='text/javascript'>/*<![CDATA[*/";
if($sss[24] <= $mbr_level && $wdth[7][31] != 'a' && $wdth[7][31] <= $mbr_level && $dockie3 && $dockie3[0] == $_POST['id']) {
/** 파일업로드 시작**/
if($mbr_level == 9 || !$sett[9] || !$wdth[7][9] || $_FILES['file']['size'] + (int)base_convert($_POST['fsze'],24,10)  < $sett[9]*1048576) {
	$fname = str_replace("%","",$_FILES['file']['name']);
	if(!$wdth[7][33] || preg_match("`\.({$sett[64]})$`i",$fname)) {
	$deste = str_replace("%","",urlencode($fname));
	if($extt = strrpos($fname,".")) $ext = strtolower(substr($fname,$extt));else $ext = '';$dest = substr(md5($fname.$time),rand(0,10),(20 - strlen($ext))).$ext;
	if(($ext=='.jpg' || $ext=='.gif' || $ext=='.png') && file_exists($ffldr.substr($deste,0,-4).'_s.jpg')) $isthumb = substr($deste,0,-4).'_s.jpg';else $isthumb = 0;
	if(file_exists($ffldr.$dest)) {$u = 1;while(file_exists($ffldr.$dest)) {$dest = substr(md5($dest.$u),rand(0,10),(20 - strlen($ext))).$ext;$u++;}}
	if($isthumb) {$u = 1;while(file_exists($ffldr.$u."_".$isthumb)) {$u++;}}
	move_uploaded_file($_FILES['file']['tmp_name'], $ffldr.$dest);
$fname = $dest."/".$fname;
if($ftu = @fopen($tdu,"r")) {$ftuo = fgets($ftu);$ftuu = (int)substr($ftuo,-7,6) + 1;fclose($ftu);} else $ftuu = 0;
if($fu = @fopen($du,"r")) {$fuo = fgets($fu);$fuu = (int)substr($fuo,-7,6) + 1;} else $fuu = 1;
if($ftuu > $fuu) $fuu = $ftuu;
if($dockie3[1] == $_POST['ufm'] && $lst >= $_POST['ufm']) $fame = $fname;
else {
if($fu) fclose($fu);$du = $tdu;
if($fu = @fopen($du,"r")) $fuo = fgets($fu);else $fuo = '';
$fame = $_POST['ntime'].$fname;
}
$content = str_pad($_POST['ufm'],6,0,STR_PAD_LEFT).$fame."000000".str_pad($fuu, 6, 0, STR_PAD_LEFT)."\n";
usleepp($du."@@");
$jdu = fopen($du."@@","w");
fputs($jdu, $content);
if($fu) {
fputs($jdu, $fuo);
while(!feof($fu)) fputs($jdu, fgets($fu));
fclose($fu);
}
fclose($jdu);
if(!file_exists($du) || (filesize($du) + strlen($content) == filesize($du."@@"))) {@copy($du,$du."_bk");copy($du."@@",$du);}
else unlink($ffldr.$dest);
unlink($du."@@");
} else echo "parent.alert('첨부파일 허용된 확장자가 아닙니다');";
} else {unlink($_FILES['file']['tmp_name']);echo "parent.alert('파일이 등록되지 않았습니다. (업로드한계: {$sett[9]}MB)');";}
}
echo "location.href='?id={$id}&ufn={$_POST['ufm']}&no={$_POST['no']}&ntime={$_POST['ntime']}';/*]]>*/</script>";
exit;
/** 파일업로드 끝**/
} else if($_POST['mode'] == "edit" || $_POST['edit'] == "delete") {
if($sss[24] <= $mbr_level && ($_POST['edit'] == "delete" || $sss[26] == 'd' || ($_POST['ntime']  && $dockie3 && $dockie3[0] == $_POST['id'] && $dockie3[1] == $_POST['no']))) {
/** 본문 수정/삭제 시작**/
include("include/edit.php");
/** 본문 수정/삭제 끝 **/
} else scrhref($dxpt,0,'권한이 없습니다');
unset($_SESSION[$wtses]);
exit;
} else if($_POST['pno'] && $_POST['content']) {
if($sss[25] <= $mbr_level) {
/** 새리플 처리 시작 **/
if((!$_POST['antispam'] || $_POST['antispam'] != $tzt) && $sett[82] && (!$mbr_no || ($sett[82] != 1 && $sett[82] != 3)))  {scrhref($_POST['request'],1,"스팸 방지 코드가 틀렸습니다");exit;}
if(trim($_POST['content']) == "") {scrhref($_POST['request'],1,"내용이 비었습니다");exit;}
if(!$_COOKIE["cmt_".$id] || ($time - substr($_COOKIE["cmt_".$id],0,10) >= $sett[50]*60 || $mbr_level >= $sett[51])) {
if(md5($sessid) == $_POST['ip'] && $_COOKIE[$docoo] == $dockie) {
if($mbr_level) {
if($sss[64]) $_POST['name'] = '익명_'.substr(md5($sessid),6,6);else $_POST['name'] = $_SESSION['m_nick'];
} else {
if($_SESSION['yname'] != $_POST['name'] || $_SESSION['ypass'] != $_POST['pass']) {
if($_POST['pass'] && strlen($_POST['pass']) <= 10 && !preg_match("`[^0-9a-z]`i", $_POST['pass'])) {
$_POST['name'] = strcut(stripslashes(trim($_POST['name'])), 20);
$_SESSION['yname'] = $_POST['name'];
$_SESSION['ypass'] = $_POST['pass'];
} else $exit = 'exit';
}
}
$_POST['pass'] = str_pad($_POST['pass'],10);
if($_POST['name'] && $exit != 'exit') {
setcookie("cmt_".$id, $time);
$pno6 = str_pad($_POST['pno'],6,0,STR_PAD_LEFT);
$fn = fopen($dn,"r");
while(!feof($fn)){
$fno = fgets($fn);
if($pno6 == substr($fno, 0, 6)) {
$rps = substr($fno,strpos($fno,"\x1b") + 1);
$rps = (int)substr($rps,strpos($rps,"\x1b") + 1,1);
if(substr($fno,6,2) != 'aa') {
$pno8 = $fno[8];
$fnn = explode("\x1b",$fno);
} else $exit = '본문삭제';
break;
}}
fclose($fn);
if($fnn) {
if($fnn[2] == 'a') exit;
$content = stripslashes($_POST['content']);
$content = str_replace("<", "&lt;", str_replace("&", "&amp;", $content));
if($sett[42]) $content = preg_replace("`(http|https|ftp)://([^\"'<>\r\n\s]+)\.(jpg|gif|png|jpeg)`i", "<img name='img580' src='$1\x1b\x1b\x1b\x1b$2.$3' alt='' onclick='parent.imgview(this.src)' />", $content);
else $content = preg_replace("`(http|https|ftp)://([^\"'<>\r\n\s]+)\.(jpg|gif|png|jpeg)`i", "<a href='#none' onclick='parent.imgview(this.innerHTML)'>$1\x1b\x1b\x1b\x1b$2.$3</a>", $content);
$content = preg_replace("`(http|https|ftp)://([^\"'<>\r\n\s]+)`i", "<a target='_blank' href='$1://$2'>$1://$2</a>", $content);
$content = str_replace("\x1b\x1b\x1b\x1b", "://", $content);
$content = str_replace("\r","",str_replace("\n","<br />",str_replace("\x7f","<br />",$content)));
if($_POST['rsecrt']) {
$content = "\x1b".$content;
$last = "[비밀글]";
} else $last = strcut($content,100);
if($pno8) $last = "\x1b".$pno8.$last;
if(!$mbr_level && $_POST['link']) $_POST['link'] = "\x18{$_POST['link']}\x1b";
else $_POST['link'] = "";
$content = str_pad($_SERVER['REMOTE_ADDR'],15).$_POST['pass'].$_POST['link'].$content."\n";
usleepp($dxr.$id."/new_rp.dat@@");
$jnew = fopen($dxr.$id."/new_rp.dat@@","w");
$fm = fopen($dxr.$id."/new_rp.dat","r");
if(!feof($fm)) $fmo = fgets($fm);
$clst = (int)substr($fmo, 6, 7) + 1;
if($frlst = @fopen($dxr.$id."/last_rp.dat","r")) {
$clst = (int)fgets($frlst) + 1;
fclose($frlst);
}
$frlst = fopen($dxr.$id."/last_rp.dat","w");
fputs($frlst,$clst);
fclose($frlst);
$clst = str_pad($clst, 7, 0, STR_PAD_LEFT);
$_POST['pno'] = str_pad($_POST['pno'], 6, 0, STR_PAD_LEFT);
if($sett[83]) {
$fnm = substr($fnn[0],9);
if($fnm && $fnm != $mbr_no) notiff($fnm,1,$id10.$_POST['pno'],$clst);
}
$first = $_POST['pno'].$clst.$_POST['up'].str_pad($_POST['name'],20).$time.$last."\n".$fmo;
fputs($jnew,$first);
for($i = 1;!feof($fm) && $i < 20;$i++) {
fputs($jnew,fgets($fm));
}
fclose($fm);
fclose($jnew);
copy($dxr.$id."/new_rp.dat@@",$dxr.$id."/new_rp.dat");
unlink($dxr.$id."/new_rp.dat@@");
$first = $_POST['pno'].$clst.$_POST['up'].$time.str_pad($mbr_no,5,0,STR_PAD_LEFT).$_POST['name']."\x1b\x1b\x1b\n";
usleepp($rl."@@");
$jrl = fopen($rl."@@","w");
$cl = fopen($rl,"r");
usleepp($rb."@@");
$jrb = fopen($rb."@@","w");
$cb = fopen($rb,"r");
$cup = 0;
if($_POST['cc'] || $rps) {
while(!feof($cl)){
$clo = fgets($cl);
if(!$cup && $_POST['up'] > 1 && substr($clo,0,13) == $_POST['pno'].$_POST['cc']) {$clf = 1;if($sett[83] && ($fnp = (int)substr($clo,24,5))) {if($fnp != $mbr_no && $fnp != $fnm) notiff($fnp,1,$id10.$_POST['pno'],$clst);}}
if(!$cup && (($_POST['up'] == 1 && substr($clo,0,6) == $_POST['pno']) || $clf == 1)) $cup = 1;
else if($cup == 1 && (substr($clo,0,6) != $_POST['pno'] || substr($clo,13,1) < $_POST['up'])) {
fputs($jrl,$first);
fputs($jrb,$content);
$cup = 3;
}
fputs($jrl, $clo);
fputs($jrb, fgets($cb));
if($cup == 3) break;
}
}
if(!$_POST['cc'] || $cup != 3) {
fputs($jrl,$first);
fputs($jrb,$content);
}
while(!feof($cl)) {
fputs($jrl, fgets($cl));
fputs($jrb, fgets($cb));
}
fclose($jrl);
fclose($cl);
copy($rl."@@",$rl);
unlink($rl."@@");
fclose($jrb);
fclose($cb);
copy($rb."@@",$rb);
unlink($rb."@@");
nodat($_POST['pno'],2,1);
if(!$sss[64] && $mbr_no >= 1) mmd($mbr_no, 1, "1", $id10.$_POST['pno'].$time, $last);
scrhref($_POST['request'],1,0);
}}
} else $exit = '로봇';
} else $exit = '시간간격 제한('.$sett[50].'분)';
if(!$pno6) {
echo "<script type='text/javascript'>/*<![CDATA[*/history.go(-1);alert('";
if($exit == 'exit') echo "비밀번호는 영문,숫자 10자 이내로";
else if(!$exit && !$_POST['name']) echo "이름이 비었습니다.";
else echo $exit."으로 작성금지";
if(strpos($_SERVER['HTTP_USER_AGENT'],"MSIE")) echo " - 글내용은 복사되었습니다.');window.clipboardData.setData('Text', \"".str_replace('"','',$_POST['content'])."\");/*]]>*/</script>";
else echo "');prompt(\"\",\"".str_replace('"','',str_replace("\r\n","<br />",$_POST['content']))."\");/*]]>*/</script>";
} else if($sett[15] && $fnn[6][1]) {
$mno = substr($fnn[0],9);
if($mno && $mno == $mbr_no) exit;
if($mno) {
$fnn = str_pad($mno,5,0,STR_PAD_LEFT);
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(substr($xxx, 0, 5) == $fnn) {
$xxx = explode("\x1b", $xxx);
$mailaddr = $xxx[3];
break;
}}
fclose($fim);
} else {$mailaddr = substr($fnn[6],1);$xxx[1] = "비회원";}
if($mailaddr) {
$sett14 = substr($sett[14],7);
$sett14 = substr($sett14,0,strpos($sett14,'/'));
sendmail($mailaddr,"관리자","admin@{$sett14}","[{$sett[0]}] 게시판에 \"{$_POST['name']}\"님의 덧글이 올라왔습니다","<div style='font-family:\"Malgun Gothic\";font-size:11pt;border:1px solid #ddd;padding:10px;line-height:160%'><div style='background:#f6f6f6;border:1px solid #ddd;padding:4px;margin-bottom:20px'><div style='background:#fff;padding:5px'>안녕하세요 <span style='font-size:12pt;color:#FF6633'>\"{$sett[0]}\"</span> ({$sett14}) 입니다.</div></div><span style='font-size:12pt;color:#FF6633'>\"{$bdidnm[$id]}\"</span> <b>{$xxx[1]}</b>님이 쓴 글에 <b>{$_POST['name']}</b>의 덧글이 올라왔습니다.<br /><a target=\"_blank\" href=\"{$sett[14]}{$index}?id={$id}&amp;no=".(int)$pno6."\">{$sett[14]}{$index}?id={$id}&amp;no=".(int)$pno6."</a><br /><br />본 메일은 발송전용 메일입니다.</div>");
}}}
exit;
/** 새리플 처리 끝 **/
} else if($_POST['wcontent']) {
/** 새글 처리 시작 **/
unset($_SESSION[$wtses]);
if((!$_POST['antispam'] || $_POST['antispam'] != $tzt) && $sett[82] > 2 && (!$mbr_no || $sett[82] == 5))  {scrhref($dxpt."&amp;p=1",0,"스팸 방지 코드가 틀렸습니다");exit;}
if(!$_COOKIE['write'] || ($time - substr($_COOKIE['write'],0,10) >= $sett[49]*60 || $mbr_level >= $sett[51])) {
if($sss[24] <= $mbr_level && ($mbr_no || $_COOKIE[$docoo] == $dockie)) {
if($mbr_no) {if($sss[64]) $_POST['name'] = '익명_'.substr(md5($sessid),6,6);else $_POST['name'] = $_SESSION['m_nick'];
} else {
if($_SESSION['yname'] != $_POST['name'] || $_SESSION['ypass'] != $_POST['pass']) {
if($_POST['pass'] && strlen($_POST['pass']) <= 10 && !preg_match("`[^0-9a-z]`i", $_POST['pass'])) {
$_POST['name'] = strcut(stripslashes(trim($_POST['name'])), 20);
$_SESSION['yname'] = $_POST['name'];
$_SESSION['ypass'] = $_POST['pass'];
} else $exit = 'exit';
}
}
if($_POST['reply'] != 'new' && (!$sss[55] || !$_POST['dctym'] || ($s7116 && $_POST['dctym'] > $cuttime[$sett[71][20]]))) $exit = 'exit';
if($_POST['name'] && $exit != 'exit') {
@unlink($saved);
$lstp = $lst + 1;
$fctp = $fct + 1;
setcookie("write", $time);
if(!$mbr_no) setcookie("vst_{$id}", "_{$lstp}_", $time + 86400);
if($_POST['notice']) {$adn = 4;$adv = $wdth[4].$lstp."^";}
divide($lstp, $fctp, 0, $adn, $adv, 0);
$lst = $lstp;
if(($wdth[5][1] && $content == '_') || $wdth[5][2]) {
$content = '';
if($_POST['addfield']) {for($a=0;isset($_POST['addfield'][$a]);$a++) $content .= "\x1b".stripslashes($_POST['addfield'][$a]);}
$content .= "\n";
} else {
$content = stripslashes($_POST['wcontent']);
$rssu = 'a';
$rsctnt = strchr($content,'<img');
while($rsctnt && $rssu == 'a') {
$rsctntt = substr($rsctnt, 0, strpos($rsctnt,'>'));
if(strpos($rsctntt,'img580') !== false) {
if(strpos($rsctntt,'exe.php?sls=') !== false) preg_match("`<img [^<>\r\n]+(exe\.php\?sls=[^\"'<>\r\n\s]+)`i", $rsctntt, $rssu);
else preg_match("`<img [^<>\r\n]+(http://[^\"'<>\r\n\s]+)`i", $rsctntt, $rssu);
if($rssu && strpos($rssu[1],$_SERVER['HTTP_HOST']) !== false && strpos($rssu[1],'icon/emoticon') !== false) $rssu = 'a';
}
$rsctnt = strchr(substr($rsctnt, 4),'<img');
}
if($rssu != 'a' && $rssu[1]) {
$urrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?sls=".$id."/";
$urrlu = "exe.php?sls=".$id."/";
if(strpos($rssu[1], $urrl) !== false) $thumb = substr($rssu[1], strlen($urrl));
else if(strpos($rssu[1], $urrlu) !== false) $thumb = substr($rssu[1], strlen($urrlu));
if($thumb) $spic = thumb($thumb);
else $spic = str_replace("&","&amp;",str_replace("amp;","",$rssu[1]));
}
$content = mcontent($content);
$content = str_replace("\r","",str_replace("\n","<br />",$content))."\n";
}
$_POST['subject'] = str_replace("<", "&lt;", stripslashes(trim($_POST['subject'])));
if($_POST['wf_link6']) {if(!$wdth[7][32]) $tag6 = tgxedit($_POST['wf_link6'],1,0);else $tag6 = ",";}
if(substr($_POST['wf_link5'],0,4) != 'http' && substr($_POST['wf_link5'],0,6) != 'magnet') $_POST['wf_link5'] = '';
$memo = $time.str_pad($_SERVER['REMOTE_ADDR'],15)."\x1b".$_POST['name']."\x1b".$_POST['pass']."\x1b".$_POST['subject']."\x1b".$spic."\x1b".$_POST['wf_link5']."\x1b".$tag6."\x1b\n";
if(!$_POST['ct']) $_POST['ct'] = "00";
if(!$_POST['perm_vw']) $_POST['perm_vw'] = "0";
else if($_POST['perm_vw'] != 'r' && !$mbr_no) setcookie("scrt_".$lst.$id,md5($lst."_".$sessid.$id));
if($_POST['depth']) $_POST['perm_re'] = $_POST['depth'];
if($wdth[9][11] && $_POST['tb_url']) $tbis = sendtb($_POST['tb_url'], $_POST['tb_link'], $_POST['subject'], $content, $lst);
else if(!$wdth[9][11]) $tbis = (int)$_POST['perm_rpw'].(int)$_POST['perm_rpv'].(int)$_POST['perm_dwn'];
if($_POST['perm_rpmail'] == 'Email Address') $_POST['perm_rpmail'] = '0';
$xxx = str_pad($lst,6, 0, STR_PAD_LEFT).$_POST['ct'].$_POST['perm_vw'].$mbr_no."\x1b\x1b".$_POST['perm_rp']."\x1b".$tbis."\x1b".$_POST['perm_tb']."\x1b\x1b".$_POST['perm_re'].$_POST['perm_rpmail']."\x1b\n";
if($_POST['notice']){
$fns = fopen($dxr.$id."/notice.dat","a+");
$noticx = str_pad($lst,6, 0, STR_PAD_LEFT).$memo;
fputs($fns, $noticx);
fclose($fns);
}
usleepp($dn."@@");
$jdn = fopen($dn."@@","w");
$fnfz = filesize($dn) + strlen($xxx);
$fn = fopen($dn,"r");
usleepp($dl."@@");
$jdl = fopen($dl."@@","w");
$fl = fopen($dl,"r");
usleepp($db."@@");
$jdb = fopen($db."@@","w");
$fb = fopen($db,"r");
if($_POST['reply'] && $_POST['depth']) {
while(!feof($fn)) {
$nnn = fgets($fn);
fputs($jdn, $nnn);
fputs($jdl, fgets($fl));
fputs($jdb, fgets($fb));
if((int)substr($nnn, 0, 6) == $_POST['reply']) {
fputs($jdn, $xxx);
fputs($jdl, $memo);
fputs($jdb, $content);
}
}
} else {
fputs($jdn, $xxx);
fputs($jdl, $memo);
fputs($jdb, $content);
while(!feof($fn)) {
fputs($jdb, fgets($fb));
fputs($jdn, fgets($fn));
fputs($jdl, fgets($fl));
}
}
fclose($fn);
fclose($fl);
fclose($fb);
fclose($jdn);
fclose($jdl);
fclose($jdb);
if($fnfz == filesize($dn."@@")) {
copy($dl."@@",$dl);
copy($db."@@",$db);
copy($dn,$dn."_bk");
copy($dn."@@",$dn);
}
unlink($dn."@@");
unlink($dl."@@");
unlink($db."@@");
if($sss[26] != 'd' && !$sss[64] && $mbr_no >= 1) mmd($mbr_no, 0, "1", $id10.str_pad($lst,6, 0, STR_PAD_LEFT).$time, $_POST['subject']);
if($_POST['afsze'] && $_POST['ntime'] && @filesize($tdu)) {
usleepp($du."@@");
$jdu = fopen($du."@@","w");
$fu = fopen($du, "a+");$fuo = '';
usleepp($tdu."@@");
$jtdu = fopen($tdu."@@","w");
$tu = fopen($tdu, "a+");
while($tuo = fgets($tu)){
if(substr($tuo, 0, 26) == $_POST['uno'].$_POST['ntime']) {
$fuo .= str_pad($lst,6, 0, STR_PAD_LEFT).substr($tuo,26);
} else {
fputs($jtdu, $tuo);
if($tdux != 1 && trim($tuo)) $tdux = 1;
}
}
if($fuo != '') {
fputs($jdu, $fuo);
while($ffo = fgets($fu)) fputs($jdu, $ffo);
}
fclose($fu);
fclose($tu);
fclose($jtdu);
fclose($jdu);
if($tdux == 1) copy($tdu."@@", $tdu);
else unlink($tdu);
unlink($tdu."@@");
if($fuo != '' && filesize($du) + strlen($fuo) == filesize($du."@@")) {@copy($du,$du."_bk");copy($du."@@",$du);}
unlink($du."@@");
$nwdoc = $dxr.$id."/nwdoc";
if($fw = @fopen($nwdoc,"r")) {
if($_POST['uno'] == fread($fw,6)) $ndx = 9;
fclose($fw);
if($ndx == 9) unlink($nwdoc);
}}
xdate($time, 1, '');
if($sett[15] && $wdth[3] && $wdth[7][6] && $wdth[3] != $mbr_id) {
$wdth30 = str_pad($wdth[3],10);
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(substr($xxx, 5, 10) == $wdth30) {
$mailaddr = explode("\x1b", $xxx);
$mailaddr = $mailaddr[3];
break;
}}
fclose($fim);
if($mailaddr) {
$sett14 = substr($sett[14],7);
$sett14 = substr($sett14,0,strpos($sett14,'/'));
sendmail($mailaddr,"관리자","admin@{$sett14}","[{$sett[0]}] 게시판에 새글이 올라왔습니다","<div style='font-family:\"Malgun Gothic\";font-size:11pt'><span style='font-size:12pt;color:#FF6633'>\"{$sett[0]} > {$bdidnm[$id]}\"</span> 게시판에 새글이 올라왔습니다.<br /><a target=\"_blank\" href=\"{$sett[14]}{$index}?id={$id}&amp;no={$lst}\">{$sett[14]}{$index}?id={$id}&amp;no={$lst}</a><br />{$_POST['subject']}</a> by {$_POST['name']}<br><br>본 메일은 발송전용 메일입니다.</div>");
}}
scrhref($dxpt."&amp;p=1",0,0);
} else $exit = '비밀번호는 영문,숫자만 10자 이내로';
} else $exit = '로봇으로 작성금지';
} else $exit = '시간간격 제한('.$sett[49].'분)으로 작성금지';
if($exit) {scrhref(0,0,$exit);echo "<textarea style='width:100%;height:100%'>{$_POST['wcontent']}</textarea>";}
exit;
/** 새글 처리 끝 **/
} else if($_GET['read'] && $sss[24] <= $mbr_level) {
/** rss 리딩 시작 **/
if($sss[24] <= $mbr_level) {
function startElement($parser, $name, $attribs) {
global $currentTag;
$currentTag = $name;
}
function endElement($parser, $name) {
global $currentTag;
$currentTag = "";
}
function characterData($parser, $data) {
global $currentTag, $enc, $n, $jdl, $jdb, $wt, $fol, $cnt, $tag6, $wtx,$isbody;
if($enc != 8) $data = iconv("CP949", "UTF-8//IGNORE", $data);
if($n > 0){
$data = trim($data);
switch ($currentTag) {
	case "link":
    $wt['link'] .= $data;
    break;
	case "guid":
    $wt['link2'] .= $data;
    break;
  case "title":
    $wt['title'] .= $data;
    break;
  case "description":
    $wt['body'] .= preg_replace("`[\r\n\t]+`", "", $data);
    break;
  case "author":
    $wt['name'] = $data;
    break;
  case "dc:creator":
    $wt['name'] = $data;
    break;
  case "category":
    $dat = preg_split("`[,/]\s?`", $data);
	for($d=0;trim($dat[$d]);$d++) {$dat[$d] = str_replace("'","´",str_replace('"','˝',$dat[$d]));if(false === strpos($wt['tag'],$dat[$d].",")) {$wt['tag'] .= $dat[$d].",";if(false === strpos($tag6,$dat[$d].",")) $tag6 .= $dat[$d].",";}}
    break;
  case "dc:subject":
    $dat = preg_split("`[,/]\s?`", $data);
	for($d=0;trim($dat[$d]);$d++) {$dat[$d] = str_replace("'","´",str_replace('"','˝',$dat[$d]));if(false === strpos($wt['tag'],$dat[$d].",")) {$wt['tag'] .= $dat[$d].",";if(false === strpos($tag6,$dat[$d].",")) $tag6 .= $dat[$d].",";}}
    break;
  case "pubDate":
    $wt['date'] = strtotime(substr($data,0,50));
    break;
  case "dc:date":
  		if($data[10] == "T") $wt['date'] = mktime(substr($data, 11, 2), substr($data, 14, 2), substr($data, 17, 2), substr($data, 5, 2), substr($data, 8, 2), substr($data, 0, 4));
  		else $wt['date'] = strtotime($data);
    break;
  case "item":
		if($wt['link2']) $wt['link'] = $wt['link2'];
		if(is_array($fol) && in_array($wt['link'], $fol)) $wtx = "1";
		if($wtx != '1' && $wt['title'] != ''){
  		if($wt['name'] == "" && $wt['tag']) $wt['name'] = substr($wt['tag'],0,strpos($wt['tag'],','));
  		$wt['name'] = strcut($wt['name'], 20);
		if($wt['date']) xdate($wt['date'], 1, '');
  	fputs($jdl, str_pad($wt['date'], 25)."\x1b".$wt['name']."\x1b\x1b".$wt['title']."\x1b\x1b".$wt['link']."\x1b".$wt['tag']."\x1b\n");
 		if(!$isbody) $wt['body'] = '';
 		fputs($jdb, $wt['body']."\n");
 		$cnt++;
 		}
  		$wt = "";
    break;
default:
    break;
   }
  } else if($currentTag == "item") {
  		$wt = "";
  		$n = 1;
  	}
}
function rssread($url) {
global $currentTag, $enc, $n, $jdl, $jdb, $wt, $fol, $cnt, $tag6, $wtx,$isbody;
$urx = strpos($url, "/");
$host = substr($url, 0, $urx);
$url = substr($url, $urx);
if($host){
$tag6 = "";
$currentTag = "";
$xmlParser = xml_parser_create();
$caseFold = xml_parser_get_option($xmlParser, XML_OPTION_CASE_FOLDING);
$targetEncoding = xml_parser_get_option($xmlParser, XML_OPTION_TARGET_ENCODING);
if($caseFold == 1) xml_parser_set_option($xmlParser, XML_OPTION_CASE_FOLDING, false);
xml_set_element_handler($xmlParser, "startElement", "endElement");
xml_set_character_data_handler($xmlParser, "characterData");
if($fp = @fsockopen($host, 80)) {
fputs($fp, "GET $url HTTP/1.0\r\n");
fputs($fp,"Host: $host\r\n");
fputs($fp,"\r\n");
$w = "";
$n = 0;
if(strpos(fgets($fp),'302 Found')) {
while($data = fgets($fp)) {if(strtolower(substr($data,0,9)) == "location:") break;}
$url = substr(trim(substr($data,9)),7);
$urx = strpos($url, "/");
$host = substr($url, 0, $urx);
$url = substr($url, $urx);
if($host){
fclose($fp);
$fp = @fsockopen($host, 80);
fputs($fp, "GET $url HTTP/1.0\r\n");
fputs($fp,"Host: $host\r\n");
fputs($fp,"\r\n");
}}
while($data = rawurldecode(fgets($fp))) {
if(!$enc) {
if(strpos($data, 'encoding="UTF-8"')) $enc = 8;
else if(strpos($data, 'encoding="utf-8"')) $enc = 8;
else if(strpos($data, 'encoding')) $enc = 1;
} else {
if($wtx != "1") {
if(!xml_parse($xmlParser, $data, feof($fp))) {
break;
    xml_parser_free($xmlParser);
   }
} else break;
}
}
xml_parser_free($xmlParser);
fclose($fp);
}
}
}

$a=fopen($dxr.$id."/rss.dat","r");
while(!feof($a)) {$dss[] = fgets($a);}
fclose($a);
$i = $_GET['read'] - 1;
$an = count($dss);
if($_GET['read'] < $an) {
$url = trim(substr($dss[$i], 8));
$isbody = substr($dss[$i],0,1);
if($url) {
usleepp($dl."@@");
$jdl = fopen($dl."@@","w");
usleepp($db."@@");
$jdb = fopen($db."@@","w");
$ct = str_pad($_GET['read'], 2, 0, STR_PAD_LEFT);
$ctgrn = $ctgn[$ct] -1;
if($ctgrn > 0) {
$fn = fopen($dn,"r");
$fl = fopen($dl,"r");
$f = 0;
$fol = array();
while(!feof($fn)) {
$fno = fgets($fn);
$flo = fgets($fl);
	if($fno == "" || $fno == "\n") {
	list($ida,$fn,$fl) = data6($ida,array($fn,$fl),0);
	if($ida == 'q') break;
	} else {
if(substr($fno, 6, 2) == $ct) {
$fff = explode("\x1b", $flo);
$fol[$f] = $fff[5];
if($f == 20 || $f >= $ctgrn) break;
$f++;
}}}
fclose($fn);
fclose($fl);
}
$cnt = 0;
rssread($url);
if($cnt) {
tgxedit($tag6,4,0);
if(file_exists($dxr."_fen")) {
$fen = fgets($jfen=fopen($dxr."_fen","r"));fclose($jfen);
} else $fen = $lst;
$ffn = $fen + $cnt;
fputs($jfen=fopen($dxr."_fen","w"),$ffn);fclose($jfen);
usleepp($dn."@@");
$jdn = fopen($dn."@@","w");
$fnfz = filesize($dn);
for($ffn = $ffn; $ffn > $fen; $ffn--) {
$zzz = str_pad($ffn, 6, 0, STR_PAD_LEFT).$ct."0\x1b\x1b\x1b\x1b\x1b\x1b\x1b\n";
$fnfz += strlen($zzz);
fputs($jdn, $zzz);
}
$fn = fopen($dn,"r");
$fl = fopen($dl,"r");
$fb = fopen($db,"r");
while(!feof($fn)) {
fputs($jdl, fgets($fl));
fputs($jdb, fgets($fb));
fputs($jdn, fgets($fn));
}
fclose($fn);
fclose($fl);
fclose($fb);
fclose($jdn);
$fco = "\x1b";
for($i=1;$i <= $ctl;$i++) {
$ii = str_pad($i, 2, 0, STR_PAD_LEFT);
if($ctg[$ii]) {
$fco .= $ctg[$ii];
if($_GET['read'] == $i) $ctgn[$ii] += $cnt;
$fco .= str_pad($ctgn[$ii], 6, 0, STR_PAD_LEFT)."\x1b";
}}
ndc($fco."\n");
}
fclose($jdl);
fclose($jdb);
if($cnt) {
if($fnfz == filesize($dn."@@")) {
copy($dl."@@", $dl);
copy($db."@@", $db);
copy($dn,$dn."_bk");
copy($dn."@@",$dn);
}
unlink($dn."@@");
}
unlink($dl."@@");
unlink($db."@@");
}
$read = $_GET['read'] + 1;
scrhref("?id=".$id."&amp;read=".$read."&amp;rn=".$_GET['rn'],0,0);
} else {
if(file_exists($dxr."_fen")) {$fen = fgets($jfen=fopen($dxr."_fen","r"));fclose($jfen);unlink($dxr."_fen");}
if($fen && $fen != $lst) {
$lstp = $fen;
$fctp = $fen - $lst + $fct;
divide($lstp, $fctp, 1, 0, 0, 1);
}
$fs = fopen($ds,"r");
while($sss = fgets($fs)){
if(!$ssr && trim(substr($sss, 0, 10)) == $id) $ssr = 1;
else if($ssr == 1 && $sss[63]) {$nnext = trim(substr($sss, 0, 10));break;}
}
fclose($fs);
if($_GET['rn'] && $nnext) {
$rr = $_GET['rn'] + 1;
scrhref("?id=".$nnext."&amp;read=1&amp;rn=".$rr,0,0);
} else scrhref($dxpt."&amp;p=1",0,0);
}
}
exit;
/** rss 리딩 끝 **/
} else if($_GET['write'] || $_POST['edit'] == "edit") {
if($sss[24] <= $mbr_level) {
if($_GET['write'] && $_COOKIE['write']) $cwt = $time - substr($_COOKIE['write'],0,10);else $cwt = 'a';
if($cwt == 'a' || ($cwt >= $sett[49]*60 || $mbr_level >= $sett[51])) {
if($_COOKIE[$docoo] == $dockie) {
/** 글쓰기/글수정 시작  **/
include("include/write.php");
} else scrhref($dxpt,0,"쿠키가 막혀 있거나, 정상적인 접근이 아닙니다.");
} else scrhref($dxpt,0,"시간간격 제한 ({$sett[49]}분) : ".($sett[49]*60 - $cwt)." 초 남았습니다.");
} exit;
/** 글쓰기/글수정 끝 **/
} else if($_POST['dxess']){
if($_POST['delfile'] = urldecode($_POST['delfile'])){
/** 파일삭제 시작  **/
if($sss[24] <= $mbr_level && $wdth[7][31] != 'a' && $wdth[7][31] <= $mbr_level && $dockie3 && $dockie3[0] == $_POST['id']) {
$isern = ($dockie3[1] == $_POST['ufm'] && $lst >= $_POST['ufm'])? 2:3;
$du = ($isern == 2)? $du:$tdu;
if($fu = @fopen($du,"r")) {
usleepp($du."@@");
$uf6 = str_pad($_POST['ufm'],6,0,STR_PAD_LEFT);
$jdu = fopen($du."@@","w");
$vip = 0;
while(!feof($fu)){
	$fuo = fgets($fu);
	if(substr($fuo, 0, 6) == $uf6) {
$delfn = (int)substr($fuo, -7, 6);
if($delfn == $_POST['delfile'] || false !== strpos($_POST['delfile'],"^{$delfn}^")) {
if($isern == 2) $fname = substr($fuo, 6, -13);
else if(substr($fuo, 6, 20) == $_POST['ntime'] || $mbr_level == 9) $fname = trim(substr($fuo, 26, -13));
if($fname) {
$ext = strtolower(substr($fname,-3));
$fnamee = str_replace("%","",urlencode($fname));
if($ext == 'jpg' || $ext == 'gif' || $ext == 'png') {if($fname[20] == '/') @unlink($ffldr.str_replace('%','',urlencode(substr($fnamee, 21, -4))).'_s.jpg');else @unlink($ffldr.substr($fnamee, 0, -4).'_s.jpg');}
if($fname[20] == '/') $fname = substr($fname,0,20);
else $fname = $fnamee;
unlink($ffldr.$fname);
$vip += strlen($fuo);
$fuo = "";
}}}
fputs($jdu, $fuo);
}
fclose($fu);
fclose($jdu);
if(filesize($du) - $vip == filesize($du."@@")) {@copy($du,$du."_bk");copy($du."@@",$du);}
unlink($du."@@");
}}}
if($_POST['dxess'] == '3') unset($_SESSION[$wtses]);
else scrhref("?id=".$id."&amp;ufn=".$_POST['ufm']."&amp;no=".$_POST['no']."&amp;ntime=".$_POST['ntime'],0,0);
exit;
/** 파일삭제 끝 **/
} else if($_POST['saved']) {
if($_POST['saved'] == 'dxess') unset($_SESSION[$wtses]);
else {
$fp = fopen($saved,"w");
fwrite($fp,stripslashes($_POST['saved']));
fclose($fp);
}
exit;
} else if($_GET['ufn']){
/** 업로드목록 출력 시작 **/
if($sss[24] <= $mbr_level && $wdth[7][31] != 'a' && $wdth[7][31] <= $mbr_level && $dockie3 && $dockie3[0] == $_GET['id']) {
$isern = ($dockie3[1] ==  $_GET['ufn'] && $lst >= $_GET['ufn'])? 2:3;
$du = ($isern == 2)? $du:$tdu;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="<?php echo $srboard?>" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>파일업로드</title>
<style type='text/css'>
* {font-size:8pt; font-family:verdana; overflow:hidden}
body {padding:0; margin:0}
a:link {text-decoration:none; color:#666666}
a:visited {text-decoration:none; color:#666666}
a:hover {text-decoration:underline; color:red}
#file {width:75px; height:40px; position:absolute; top:0; left:0; z-index:2; cursor:pointer; font-size:40px}
<?php if($isie == 1) {?>
#file {filter:alpha(opacity=0);opacity:0;}
<?php } else {?>
#file {opacity:0;}
<?php }?>
a.butt3 {float:left; font-weight:bold; font-size:9pt; cursor:pointer; font-family:verdana,Gulim; letter-spacing:-1px; height:18px; padding:3px 6px 1px 6px; background:url('icon/b3.png'); border:1px solid; border-color:#CECECE #E9E9E9 #CECECE #E9E9E9} /*위지윅 버튼*/
a.butt3:link, a.butt3:visited {text-decoration:none; color:#222222; border-color:#CECECE #E9E9E9 #CECECE #E9E9E9; border-style:solid; border-width:1px; margin-bottom:1px}
a.butt3:hover, a.butt3:active {text-decoration:none; color:#222222; border-top:2px solid #FF6633; margin-bottom:0; cursor:pointer}
</style>
</head>
<body onload="fselct()" onmousedown="parent.mtxt(9)">
<script type='text/javascript'>
/*<![CDATA[*/
function fselct() {
parent.updoc = window;
var ulist = '';
<?php
$i = 0;
$afsze = 0;
if($fu = @fopen($du,"r")) {
while(!feof($fu)) {
	$fuo = fgets($fu);
	if((int)substr($fuo, 0, 6) == $_GET['ufn']) {
$delfile = (int)substr($fuo, -7, 6);
$fname = '';
if($isern == 2) $fname = substr($fuo, 6, -13);
else if(substr($fuo, 6, 20) == $_GET['ntime']) $fname = substr($fuo, 26, -13);
if($fname) {
if($fname[20] == '/') {$fsze = substr($fname,0,20);$fname = substr($fname,21);}
else $fsze = str_replace("%","",urlencode($fname));
if(file_exists($ffldr.$fsze)) {
$href = "/fno/".$delfile;
$ext = strtolower(substr($fname,-4));
if($ext=='.jpg' || $ext=='.gif' || $ext=='.png') $ext = 'emg';
else if($ext=='.swf') $ext = 'swf';
else if($ext=='.wma' || $ext=='.mid' || $ext=='midi' || $ext=='.asf' || $ext=='.asx') $ext = 'wma';
else if($ext=='.mp3' || $ext=='.wav' || $ext=='.ogg') $ext = 'wmb';
else if($ext=='.wmv') $ext = 'wmc';
else if($ext=='.mp4' || $ext=='mpeg' || $ext=='.mpg' || $ext=='.avi') $ext = 'wmd';
else $ext = '';
$fsize = filesize($ffldr.$fsze);
$afsze += $fsize;
$sfile = ($fsize >= 1048576)? sprintf("%.2f", ($fsize / 1048576))."mb":sprintf("%.2f", ($fsize / 1024))."kb";
?>ulist += "<li class='<?php echo $ext?>' onclick='tclick(this)' ondblclick='tdbck(this)'><input type='hidden' value='<?php echo $delfile?>' /><input type='hidden' value='<?php echo $href?>' /><span class='lt'><?php echo $fname?></span><span class='rt'><?php echo $sfile?></span><span style='clear:both'></span></li>";
<?php
$i++;
}}}}
fclose($fu);
?>
if(ulist != '') {
parent.$('fuplist').innerHTML = ulist + '<li></li>';
parent.$('afszt').innerHTML = <?php echo sprintf("%.2f",($afsze/1024))?>;
parent.$('afszt').previousSibling.value = <?php echo sprintf("%.2f",($afsze/1024))?>;
setTimeout('aftrfs()',100);
} else {
parent.$('fuplist').innerHTML = '<li></li>';
parent.$('previe').innerHTML = '';
parent.$('afszt').innerHTML = '0';
parent.$('afszt').previousSibling.value = '';
}
<?php } if($ismobile || !$iswindows) {?>
parent.$('uploadlist').previousSibling.innerHTML = "<a onclick='$(\"uploadlist\").contentWindow.document.delup.submit()' class='butt3 bold8' style='float:left'>&nbsp;</a>";
<?php }?>
}
function aftrfs() {
var fli = parent.$('fuplist').getElementsByTagName('li');
if(fli != '') {
setTimeout('parent.tclick()',100);
parent.rdio = fli;
if(<?php echo $i?> < 3) {for(var i=0;i < <?php echo $i?>;i++) fli[i].style.width = '240px';}
} else setTimeout('aftrfs()',100);
}
/*]]>*/
</script>
<?php
if($mbr_level == 9 || !$sett[9] || $afsze < $sett[9]*1048576) {
$onchange = ($wdth[7][33])? 'if(this.value.match(/\.('.$sett[64].')$/i)) {document.delup.delfile.value="";submit();}else{alert("허용되지 않는 첨부파일 확장자 입니다");return false;}':'document.delup.delfile.value="";submit();';
?>
<form name='delup' enctype='multipart/form-data' method='post' style='margin:0'>
<input type='hidden' name='id' value='<?php echo $id?>' />
<input type='hidden' name='no' value='<?php echo $_GET['no']?>' />
<input type='hidden' name='ufm' value='<?php echo $_GET['ufn']?>' />
<input type='hidden' name='ntime' value='<?php echo $_GET['ntime']?>' />
<input type='hidden' name='fsze' value='<?php echo base_convert($afsze,10,24)?>' />
<input type='hidden' name='delfile' value='' />
<input type='hidden' name='dxess' value='2' />
<a class='butt3' style='position:absolute' />파일업로드</a><input type='file' id='file' name='file' onchange='parent.updoc = window;if(this.value) {<?php echo $onchange?>}' />
</form>
</body></html>
<?php
}}
exit;
/** 업로드목록 출력 끝 **/
} else {
scrhref($index,0,0);
exit;
}
/*** 게시판 id가 있으면 끝 ***/
} else if($_GET['rssfeed']) {
/*** rssfeed 출력 시작 ***/
$rbdt = '';
$fcut = 0;
foreach($fsbs as $rbid => $rbset) {
if(($_GET['rssfeed'] == 'all' || (is_array($bfsb[$_GET['rssfeed']]) && in_array($rbid,$bfsb[$_GET['rssfeed']]))) && $rbset[12] == "0" && $rbset[13] == "0" && $rbset[19]) {
if(filemtime($dxr.$rbid."/body.dat") > $fcut) {
$frn = fopen($dxr.$rbid."/no.dat","r");
$frl = fopen($dxr.$rbid."/list.dat","r");
$frb = fopen($dxr.$rbid."/body.dat","r");
for($ii = 0;$ii < $sett[36] && $frlo = fgets($frl);$ii++) {
$fdate = substr($frlo, 0, 10);
if($fdate <= $fcut) break;
$fno = fgets($frn);
if($fno[8] == "0") {
$frno = (int)substr($fno,0,6);
$frbo = fgets($frb);
if($frbe = strpos($frbo,"\x1b")) $frbo = substr($frbo,0,$frbe);
$frbo = strip_tags(strcut($frbo,256));
$rbdt[$fdate] = array($rbid,$frno,substr($frlo, 26),$frbo);
} else {fgets($frb);$ii--;}}
fclose($frn);
fclose($frl);
fclose($frb);
if($ii == $sett[36]) $fcut = $fdate;
}}}
if(is_array($rbdt)) {
krsort($rbdt);
header("Content-Type: text/xml; charset=UTF-8");
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\" ?".">\n";
echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";
echo "<channel>\n";
$sett[0] = rsst($sett[0]);
if($_GET['rssfeed'] == 'all') echo "<title>".$sett[0]."</title>\n";
else echo "<title>".$sett[0]." (".rsst($sect[$_GET['rssfeed']][0]).")</title>\n";
if($_GET['rssfeed'] == 'all') echo "<link>".$sett[14].$index."</link>\n";
else echo "<link>".$sett[14].$index."?section=".$_GET['rssfeed']."</link>\n";
if($_GET['rssfeed'] == 'all') echo "<description>".$sett[0]."</description>\n";
else echo "<description>".$sett[0]." (".rsst($sect[$_GET['rssfeed']][0]).")</description>\n";
echo "<language>ko</language>\n";
echo "<generator>{$srboard}</generator>\n";
for($i = 1;$i <= $sett[36] && list($key,$value) = each($rbdt);$i++) {
if($i == 1) echo "<pubDate>".gmdate("D, d M Y H:i:s", $key)." +0900</pubDate>\n";
$frrn = explode("\x1b",$value[2]);
$frrn[2] = preg_replace("`<[^>]+>?`i","",$frrn[2]);
$furl = $sett[14].$index."?id=".urlencode($value[0])."&amp;no=".(int)$value[1];
echo "<item>\n";
echo "<title>".rsst($frrn[2])."</title>\n";
echo "<link>".$furl."</link>\n";
echo "<guid>".$furl."</guid>\n";
echo "<description>".rsst($value[3])."&lt;br /&gt;&lt;a target=&quot;_blank&quot; href=&quot;".$furl."&quot;&gt;글 전체보기&lt;/a&gt;</description>\n";
echo "<category>".rsst($value[0])."</category>\n";
if($_GET['rssfeed'] != 'all') echo "<category>".rsst($sect[$_GET['rssfeed']][0])."</category>\n";
$floo = explode(",",$frrn[5]);
for($j =0; trim($floo[$j]); $j++) echo "<category>".$floo[$j]."</category>\n";
echo "<dc:creator>".rsst($frrn[0])."</dc:creator>\n";
echo "<pubDate>".gmdate("D, d M Y H:i:s", $key)." +0900</pubDate>\n";
echo "</item>\n";
}
echo "</channel>\n";
echo "</rss>\n";
}
exit;
/*** rssfeed 출력 끝 ***/
} else if($_GET['mss']) {
if($fim = @fopen($dim,"r")) {
while(!feof($fim)) {
$fmo = fgets($fim);
if((int)substr($fmo, 0, 5) == $_GET['mss']) {
$fmo = explode("\x1b", $fmo);
$fmo = rsst($fmo[1]);
break;
}
}
fclose($fim);
if($fr = fopen($dxr."_member_/list_".$_GET['mss'],"r")) {
header("Content-Type: text/xml; charset=UTF-8");
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\" ?".">\n";
echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";
echo "<channel>\n";
echo "<title>".rsst($sett[0])." - ".$fmo."님의 최근글</title>\n";
echo "<link>".$sett[14]."member.php?mno=".$_GET['mss']."</link>\n";
echo "<description>".$fmo."님의 최근글></description>\n";
echo "<language>ko</language>\n";
echo "<generator>{$srboard}</generator>\n";
for($ii = 1;$ii <= $sett[35] && !feof($fr);$ii++) {
$fro = fgets($fr);
if($ii == 1) echo "<pubDate>".gmdate("D, d M Y H:i:s", substr($fro,16,10))." +0900</pubDate>\n";
$furl = $sett[14].$index."?id=".urlencode(trim(substr($fro,0,10)))."&amp;no=".(int)substr($fro, 10, 6);
echo "<item>\n";
echo "<title>".rsst(substr($fro,26,-1))."</title>\n";
echo "<link>".$furl."</link>\n";
echo "<guid>".$furl."</guid>\n";
echo "<description>&lt;a target=&quot;_blank&quot; href=&quot;".$furl."&quot;&gt;글 전체보기&lt;/a&gt;</description>\n";
echo "<dc:creator>".$fmo."</dc:creator>\n";
echo "<pubDate>".gmdate("D, d M Y H:i:s", substr($fro,16,10))." +0900</pubDate>\n";
echo "</item>\n";
}
fclose($fr);
echo "</channel>\n";
echo "</rss>\n";
}}
exit;
} else {
header ("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="<?php echo $srboard?>" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=2.5, minimum-scale=0.5, width=device-width" />
<?php
include("include/memo.php");
}
if($_POST['ajax']) exit;
?>
</body>
</html>