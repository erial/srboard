<?php
ob_start();
session_start();
header ("Content-Type: text/html; charset=UTF-8");
include("include/common.php");
if($ismobile) $mbwdth = 530;else $mbwdth = 800;
if($_POST['content']) {
foreach($_POST as $key => $value) {
if(strpos($value,"\x1b") !== false) $_POST[$key] = str_replace("\x1b","Wx1b",$_POST[$key]);
}}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="srboard" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php if($ismobile) {?>
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.5, minimum-scale=0.5, width=device-width" />
<?php }
if($sett[31]) {?>
<link rel="shortcut icon" type="image/x-icon" href="http://<?php echo $_SERVER['HTTP_HOST']?>/favicon.ico" />
<?php }
if($bwr == 'ie6') $pten = 10;
$isnt = 15;
function strcut($str, $len){
$str = trim($str);
$str = preg_replace('`<[^>]+>`', '', $str);
if(strlen($str) > $len) {
$str = substr($str, 0, $len + 1);
$end = $len;
if(ord($str[$end -2]) < 224 && ord($str[$end]) > 126) {
while(ord($str[$end]) < 194 && ord($str[$end]) > 126) $end--;
$str = substr($str, 0, $end)."..";
} else $str .= "..";
}
$str = str_replace("<","&lt;",$str);
return $str;
}
if($_REQUEST['mno']) $mno = $_REQUEST['mno'];
else if($_GET['log']) $mno = $_GET['log'];
else $mno = $mbr_no;
if(!file_exists($dxr."_member_/list_".$mno)) {echo "해당하는 회원이 없습니다";exit;}
$tmp = $dxr."_member_/".$mbr_no;
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'AppleWebKit')) $dbody = "document.body";
else $dbody = "document.documentElement";
$_SERVER['REQUEST_URI'] = str_replace("&","&amp;",$_SERVER['REQUEST_URI']);
$dmn = ($_GET['log'])? $dxr."_member_/member_".$_GET['log']:$dxr."_member_/member_".$mno;
$jn = fopen($dmn,"r");
$jno = explode("\x1b", fgets($jn));
fclose($jn);
$fim = fopen($dim,"r");
$nick = "";
while(!feof($fim)) {
$ffm = fgets($fim);
if(!$mm && $mno == (int)substr($ffm, 0, 5)) $mm = explode("\x1b", $ffm);
if($mbr_no == $mno) $msett = array(1,1,1,1,1);
else {
if($mm[11] === 'a' || $mbr_level < $mm[11]) $msett[0] = 0;else $msett[0] = 1;
if($mm[12] === 'a' || $mbr_level < $mm[12]) $msett[1] = 0;else $msett[1] = 1;
if($mm[13] === 'a' || $mbr_level < $mm[13]) $msett[2] = 0;else $msett[2] = 1;
if($mm[14] === 'a' || $mbr_level < $mm[14]) $msett[3] = 0;else $msett[3] = 1;
if($mbr_level < $mm[15]) $msett[4] = 0;else $msett[4] = 1;
}
if(substr($_GET['month'],0,6) == "visit_") {
$fimo = explode("\x1b",$ffm);
if($fimo[1]) $nick[(int)substr($fimo[0], 0, 5)] = $fimo[1];
} else if($mm) break;
}
fclose($fim);
if($_GET['log'] && ($_GET['log'] == $mbr_no || $mbr_level == 9)) {
if($_GET['scrap']) {
$fs = fopen($ds,"r");
while(!feof($fs)){
$sss = fgets($fs);
$wdth = explode("\x1b", $sss);
$sid = trim(substr($wdth[0], 0, 10));
$ssid[$sid] = $wdth[6];
}
fclose($fs);
$scr = "";
$fp = fopen($dxr."_member_/scrap_".$_GET['log'], "r");
while(!feof($fp) && $fpo = trim(substr(fgets($fp),0,16))) {
$fid = trim(substr($fpo,0,10));
$scr[$fid] .= "\x1b".substr($fpo,10,6);
}
fclose($fp);
if(is_array($scr)) {
$dex = "";
foreach($scr as $id => $nos) {
$ii = substr_count($nos, "\x1b");
$ida = '';
$np = fopen($dxr.$id."/no.dat","r");
while(!feof($np)) {
$npo = substr(fgets($np),0,6);
if($npo == "" || $npo == "\n") {
	list($ida,$np) = data6($ida,array($np),array($id,$ssid[$id]));
	if($ida == 'q') break;
} else {
if(false !== strpos($nos,"\x1b".$npo)) {
$dex[$id] .= "\x1b".$npo;
$ii--;
if($ii == 0) break;
}
}
}
fclose($np);
}
$tp = fopen($tmp, "w");
$fp = fopen($dxr."_member_/scrap_".$_GET['log'], "r");
while(!feof($fp) && $fpo = fgets($fp)) {
$fid = trim(substr($fpo,0,10));
if(false !== strpos($dex[$fid],"\x1b".substr($fpo,10,6))) fputs($tp, $fpo);
}
fclose($tp);
fclose($fp);
copy($tmp, $dxr."_member_/scrap_".$_GET['log']);
unlink($tmp);
}
scrhref("?mno={$_GET['log']}",0,0);
} else {
$mn5 = str_pad($_GET['log'], 5, 0, STR_PAD_LEFT);
$tmpc = $dxr."_member_/c_".$_GET['log'];
$tmpa = $dxr."_member_/a_".$_GET['log'];
$tmpb = $dxr."_member_/b_".$_GET['log'];
$tmpd = $dxr."_member_/d_".$_GET['log'];
$tmpe = $dxr."_member_/e_".$_GET['log'];
$_GET['nn'] = (int)$_GET['nn'];
$fs = fopen($ds,"r");
for($i =0;$i < $_GET['nn'];$i++) {fgets($fs);}
$idd = @fgets($fs);
fclose($fs);
$zid = substr($idd, 0, 10);
if(($zd = trim($zid))) {
if($idd[22] != 'a' && $idd[22] <= $mm[2] && $idd[23] != 'a' && !$idd[64] && !$idd[62]) {
$wdth = explode("\x1b",$idd);
$type = $wdth[0][26];
$wdth = $wdth[6];
if($type !='d') {
$ida = '';
$zn = fopen($dxr.$zd."/no.dat","r");
$zl = fopen($dxr.$zd."/list.dat","r");
$tb = fopen($tmpe,"a");
$tta = fopen($tmpa,"a");
while(!feof($zn)) {
$zzn = fgets($zn);
if($zzn == "" || $zzn == "\n") {
	list($ida,$zn,$zl) = data6($ida,array($zn,$zl),array($zd,$wdth));
	if($ida == 'q') break;
} else if(substr($zzn,6,2) == 'aa') {
$zznx[] = substr($zzn,0,6);fgets($zl);
} else if(strpos($zzn, $_GET['log']."\x1b") == 9) {
$zzl = explode("\x1b",fgets($zl));
$tate = substr($zzl[0], 0, 10);
fputs($tb,$zid.substr($zzn, 0, 6).$tate.$zzl[3]."\n");
fputs($tta, $tate."\n");
} else fgets($zl);
}
fclose($zn);
fclose($zl);
fclose($tb);
fclose($tta);
}
$ida = '';
$zr = fopen($dxr.$zd."/rlist.dat","r");
$zb = fopen($dxr.$zd."/rbody.dat","r");
$tr = fopen($tmpc,"a");
$ttb = fopen($tmpb,"a");$rnur = 0;
while(!feof($zr)) {
$zzn = fgets($zr);
if($zzn == "" || $zzn == "\n") {
	list($ida,,,,$zr,$zb) = data6($ida,array(0,0,0,$zr,$zb),array($zd,$wdth));
	if($ida == 'q') break;
} else if(substr($zzn, 24, 5) == $mn5 && (!$zznx || !in_array(substr($zzn,0,6),$zznx))) {$rnur++;
$zzl = strcut(trim(substr(fgets($zb), 25)),100);
$tate = substr($zzn, 14, 10);
fputs($tr,$zid.substr($zzn, 0, 6).$tate.$zzl."\n");
fputs($ttb, $tate."\n");
} else fgets($zb);
}
fclose($zr);
fclose($zb);
fclose($tr);
fclose($ttb);
}
$nn = $_GET['nn'] + 1;
scrhref("?log={$_GET['log']}&amp;nn={$nn}",0,0);
} else {
$fp = fopen($dxr."_member_/list_".$_GET['log'], "w");
if(file_exists($tmpa) && filesize($tmpa)) {
$aan = file($tmpa);
$cnta = count($aan);
if($cnta > 1) {
arsort($aan);
if(file_exists($tmpe) && filesize($tmpe)) {
$tfile = file($tmpe);
if($aan) foreach($aan as $key => $value) {
fputs($fp,$tfile[$key]);
}}
$tfile = "";
$aan = "";
}}
fclose($fp);
$fp = fopen($dxr."_member_/rp_".$_GET['log'], "w");
if(file_exists($tmpb) && filesize($tmpb)) {
$aan = file($tmpb);
$cntb = count($aan);
if($cntb > 1) {
arsort($aan);
if(file_exists($tmpc) && filesize($tmpc)) {
$tfile = file($tmpc);
if($aan) foreach($aan as $key => $value) {
fputs($fp,$tfile[$key]);
}}
$tfile = "";
}}
fclose($fp);
$jn = fopen($dmn,"w");
fputs($jn,$jno[0]."\x1b".$jno[1]."\x1b".$jno[2]."\x1b".$jno[3]."\x1b".$jno[4]."\x1b".$jno[5]."\x1b".$jno[6]."\x1b".$jno[7]."\x1b".$jno[8]."\x1b".$jno[9]."\x1b".$jno[10]."\x1b".$jno[11]."\x1b".(int)$cnta."\x1b".(int)$cntb."\x1b");
fclose($jn);
@unlink($tmpe);
@unlink($tmpa);
@unlink($tmpb);
@unlink($tmpc);
scrhref("?log={$_GET['log']}&amp;scrap=1",0,0);
}
}
exit;
}
function mkcontent() {
global $sett;
$content = stripslashes($_POST['content']);
if(!$_POST['edit']) {
$content = str_replace("<", "&lt;", $content);
if($sett[42]) $content = preg_replace("`http://([^\"'<>\r\n\s]+)\.(jpg|gif|png|bmp|jpeg)`i", "<img name='img580' src='\x1b\x1b\x1b\x1b$1.$2' alt='' onclick='imgview(this.src)' />", $content);
else $content = preg_replace("`http://([^\"'<>\r\n\s]+)\.(jpg|gif|png|bmp|jpeg)`i", "<a href='#none' onclick='imgview(this.innerHTML)'>\x1b\x1b\x1b\x1b$1.$2</a>", $content);
$content = preg_replace("`http://([^\"'<>\r\n\s]+)`i", "<a target='_blank' href='http://$1'>http://$1</a>", $content);
$content = str_replace("\x1b\x1b\x1b\x1b", "http://", $content);
} else if($_POST['edit'] == 'modify_rp') {
$content = preg_replace("`<([ai/][^am >])`i", "&lt;$1", preg_replace("`<([^ai/])`i", "&lt;$1", $content));
$cont = explode("<",$content);
$content = $cont[0];
for($i = 1;$cont[$i];$i++) {
$end = strpos($cont[$i],">") + 1;
$str = substr($cont[$i],0,$end);
if(substr($str,0,3) == 'IMG') $str = "img".substr($str,3);
else if(substr($str,0,1) == 'A') $str = "a".substr($str,1);
else if(substr($str,0,2) == "/A") $str = "/a".substr($str,2);
$str = str_replace(" \x18click", " onclick", str_replace(" on", " xx", preg_replace("` onclick=(['\"]?)imgview`i"," \x18click=$1imgview",$str)));
$str = preg_replace("` ([a-z]+)=([^'\"> ]+)`i"," $1='$2'",$str);
if(substr($str,0,3) == 'img' && substr($str,-2) != "/>") $str = substr($str,0,-1)." />";
$content .= "<".$str.substr($cont[$i],$end);
}}
$content = preg_replace("`[\r]*[\n]`", "<br />", $content);
return $content;
}
if($_POST['content'] || $_POST['edit'] == 'del_guest') {
if($_POST['homepage'] == "http://") $_POST['homepage'] = '';
if(!$_POST['edit'] && $sett[82] && ($sett[82] == 2 || $sett[82] == 4 || $sett[82] == 5 || !$mbr_no)) {
$tzt = preg_replace("/[^0-9]/","",md5($_POST['spm'].$sessid.$zro));
for($t=0;$tzt < 99999;$t++) $tzt += $tzt;
$tzt = strval(substr($tzt,-6));
if(!$_POST['antispam'] || $_POST['antispam'] != $tzt) exit;
}
$_POST['content'] = mkcontent();
$secrt = ($_POST['rsecrt'])? 1:0;
$file = $dxr."_member_/guest_".$mno;
usleepp($file."@@");
$jdu = fopen($file."@@","w");
if($_POST['edit'] == 'del_guest' || $_POST['edit'] == 'modify_rp' || $_POST['up'] > 1) {
$pcc = ($_POST['cc'])? $_POST['cc']:0;
$tuo = '';
if($fu = @fopen($file,"r")) {
while(!feof($fu)){
	$fuo = fgets($fu);
	if($_POST['edit'] == 'del_guest' && $_POST['no'] == substr($fuo,0,10)) {
	if($mbr_level == 9 || $mbr_no == $mno || (substr($fuo,11,5) == 'mmbr:' && $mbr_no = (int)substr($fuo,16,5)) || md5($_POST['no'].$_POST['pass']) == substr($fuo,11,32)) {if(($tuo[0] = substr($fuo,10,1)) != '9') $tuo[1] = substr($fuo,0,73)."<span style='color:#C2C2C2'><s>이 글은 삭제되었습니다</s></span>".substr($fuo,strpos($fuo,"\x1b"));$fuo = '';$ok = 1;}
	else break;
	} else if($_POST['edit'] == 'del_guest' && $tuo)  {
	if(substr($fuo,10,1) > $tuo[0]) $fuo = $tuo[1].$fuo;
	$tuo = '';
	} else if($_POST['content'] && $pcc == substr($fuo,0,10)) {
	if(($_POST['edit'] == 'modify_rp') && ($mbr_level == 9 || $mbr_no == $mno || (substr($fuo,11,5) == 'mmbr:' && $mbr_no = (int)substr($fuo,16,5)) || md5($_POST['cc'].$_POST['pass']) == substr($fuo,11,32))) {$fuo = substr($fuo,0,73).$_POST['content']."\x1b".$_POST['link']."\x1b".$_SERVER['REMOTE_ADDR']."\x1b{$secrt}\x1b\n";$ok = 1;}
	else if($_POST['up'] > 1) {
	$tuo[0] = substr($fuo,10,1);
	if($mbr_id) $tuo[1] = $time.$_POST['up']."mmbr:".str_pad($mbr_no,5,0,STR_PAD_LEFT)."                      ".str_pad($_SESSION['m_nick'],30).$_POST['content']."\x1b\x1b\x1b{$secrt}\x1b\n";
	else $tuo[1] = $time.$_POST['up'].md5($time.$_POST['pass']).str_pad($_POST['username'],30).$_POST['content']."\x1b".$_POST['homepage']."\x1b".$_SERVER['REMOTE_ADDR']."\x1b{$secrt}\x1b\n";
	} else break;
	} else if($pcc && $tuo && substr($fuo,10,1) <= $tuo[0]) {$fuo = $tuo[1].$fuo;$tuo = '';$ok = 1;}
	fputs($jdu,$fuo);
}
fclose($fu);
}
scrhref($_POST['request'],1,0);
} else if($_POST['content']) {
$ok = 1;
if($mbr_id) fputs($jdu,$time."1mmbr:".str_pad($mbr_no,5,0,STR_PAD_LEFT)."                      ".str_pad($_SESSION['m_nick'],30).$_POST['content']."\x1b\x1b\x1b{$secrt}\x1b\n");
else fputs($jdu,$time."1".md5($time.$_POST['pass']).str_pad($_POST['username'],30).$_POST['content']."\x1b".$_POST['homepage']."\x1b".$_SERVER['REMOTE_ADDR']."\x1b{$secrt}\x1b\n");
if($fu = @fopen($file,"r")) {
while(!feof($fu)){fputs($jdu,fgets($fu));}
fclose($fu);
}
scrhref("?mno={$mno}&amp;view=guest",0,0);
}
fclose($jdu);
if($ok == 1) copy($file."@@",$file);
unlink($file."@@");
exit;
}
if($_POST['dell'] && $mbr_no == $mno && $_POST['id'] && $_POST['no'] && $_POST['date']){
$fwd = str_pad($_POST['id'],10).str_pad($_POST['no'], 6, 0, STR_PAD_LEFT).$_POST['date'];
$file = $dxr."_member_/".$_POST['dell']."_".$mno;
$tp = fopen($tmp, "w");
$fd = fopen($file, "r");
while(!feof($fd)) {
$fdo = fgets($fd);
if($fwd && substr($fdo,0,26) == $fwd) $fwd = "";
else fputs($tp, $fdo);
}
fclose($fd);
fclose($tp);
if($fwd == "") copy($tmp, $file);
unlink($tmp);
if($_POST['dell'] != 'scrap') {
if($_POST['dell'] == 'rp') $n = 13;
else $n = 12;
chmbr($mno,$n,-1);
}
exit;
}
if(substr($_GET['month'],0,6) == "visit_") $file = $dxr."attend.dat";
else if(substr($_GET['month'],0,6) == "diary_") $file = $dxr."_member_/diary_".$mno;
else if($mno == $mbr_no && ($_GET['edxt'] || $_POST['dat'])) {
$file = $dxr."_member_/diary_".$mbr_no;
if($_GET['edxt']){
$fr = fopen($file,"r");
while(!feof($fr)){
$fro = fgets($fr);
if(substr($fro,0,8)==$_GET['edxt']) {
$frr = explode("\x1b",substr($fro,8));
$frr[0] = str_replace("\x18", "\r\n", $frr[0]);
$isfrr = 1;
break;
}
}
fclose($fr);
?>
<title><?php echo $_SESSION['m_nick']?>님의 다이어리</title>
<style type='text/css'> * {font-size:9pt; font-family:Gulim}</style>
<script type='text/javascript'>function ffcus(){document.getElementsByName("memo")[0].focus();parent.document.title = document.title;}</script>
<base target="_self" />
</head>
<body bgcolor='#EAEAEA' onload="setTimeout('ffcus()',100)">
<form method='post' action='?'>
<div style="text-align:center"><b><?php echo substr($_GET['edxt'],0,4)?>년 <?php echo substr($_GET['edxt'],4,2)?>월 <?php echo substr($_GET['edxt'],6)?>일</b></div><br />
<input type='hidden' name="dat" value="<?php echo $_GET['edxt']?>" />
<input type='hidden' name="isedit" value="<?php echo $isfrr?>" />
<textarea name="memo" style="width:100%;height:210px;line-height:130%;overflow:visible"><?php echo trim($frr[0])?></textarea>
<div style="text-align:center"><?php if($frr[0]){?><input type='button' value=기록삭제 onclick='document.getElementsByName("isedit")[0].value="\x18\x1b\x18";submit()' /> &nbsp; &nbsp; &nbsp; <?php }?><input type='submit' value=" 저 장 " style='width:70px' /></div></form>
</body>
</html>
<?php
}
if($_POST['dat'] && $_POST['memo']){
$_POST['memo'] = str_replace("\r\n","\x18", stripslashes(trim($_POST['memo'])));
$fr = fopen($file,"r");
$frr = fopen($tmp,"w");
if($_POST['isedit']) $frx = 0;
else {
$frx = 1;
fputs($frr, $_POST['dat'].$_POST['memo']."\r\n");
}
while(!feof($fr)){
$fro = fgets($fr);
if($frx == 0 && substr($fro,0,8)==$_POST['dat']) {
if($_POST['isedit'] != "\x18\x1b\x18") fputs($frr, $_POST['dat'].$_POST['memo']."\r\n");
$frx = 1;
} else fputs($frr, $fro);
}
fclose($fr);
fclose($frr);
copy($tmp,$file);
unlink($tmp);
$mon = substr($_POST['dat'], 0, 6);
echo "<script type='text/javascript'>
//<![CDATA[
if('{$isie}' == '1') parent.dialogArguments.location.reload();
else parent.opener.location.reload();
parent.self.close();
//]]>
</script>";
}
exit;
}
$fz = '9';
if($_COOKIE['cfsz']) $fz = $_COOKIE['cfsz'];
$id = $_GET['id'];
$fs = fopen($ds,"r");
$fc = fopen($dc,"r");
while(!feof($fs)){
$sss = fgets($fs);
$fco = fgets($fc);
if($id && $_GET['no'] && trim(substr($sss, 0, 10)) == $id) {
$dct = explode("\x1b",$fco);
for($i = 1;trim($dct[$i]);$i++) {
$ii = str_pad($i, 2, 0, STR_PAD_LEFT);
$ctg[$ii] = substr($dct[$i],0,-6);
$ctgn[$ii] = (int)substr($dct[$i],-6);
}
$ctl = $i -1;
$bbb = $sss;
	$fct = (int)substr($sss, 16, 6);
	$lst = substr($sss, 10, 6);
	$wdth = explode("\x1b", $sss);
	$bst[$id]=$wdth[1];
$wdth[6] = (int)$wdth[6];
if($wdth[6]) {
$a = fopen($dxr.$id."/bno.dat","r");
for($aa=1;!feof($a);$aa++) {if($_GET['no'] <= substr(fgets($a),0,6)) {$xx = $aa;break;}}
fclose($a);
}
} else {
$bdd = trim(substr($sss, 0, 10));
$bdn = substr($sss,75);
$bst[$bdd]=substr($bdn,0,strpos($bdn,"\x1b"));
$bsx[$bdd]=$sss[22];
}
}
fclose($fs);
fclose($fc);
$mmm = '';
$mtop = 0;
$mgder = ($mm[10])? '<a target=\'_blank\' href=\''.$mm[10].'\'><img src=\'icon/home.gif\' alt=\'homapage\' border=\'0\' /></a> ':'';
if($mm[8][1] && $mm[5]) {
$mmm .= "<br />폰번호 : ".$mm[5];
} if($mm[8][2] && substr($mm[6],10)) {
$mmm .= "<br />생&nbsp; &nbsp;일 : ".substr($mm[6],10,4).". ".substr($mm[6],14,2).". ".substr($mm[6],16,2);
} if($mm[8][3] && $mm[9] && $mm[9] != 'g') {
$mgder .= ($mm[9] == 'm')? '<span style=\'font-family:verdana;color:#3475DE\'>(♂)</span>':'<span style=\'font-family:verdana;color:#DE3434\'>(♀)</span>';
} if($mm[8][0] && $mm[4]) {
$maddr = explode(' ',$mm[4]);
$mmm .= "<br />주&nbsp; &nbsp;소 : ".$maddr[1]." ".$maddr[2]." ".$maddr[3];
}
?>
<title><?php echo $mm[1]?>님의 글</title>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<link rel='stylesheet' type='text/css' href='skin/<?php echo $sett[48]?>/style.css' />
<link rel='stylesheet' type='text/css' href='include/member.css' />
<script type='text/javascript'>
//<![CDATA[
var wopen = 1;
var setop = Array('<?php echo $isie?>','<?php echo $bwr?>',<?php echo (int)$srwtpx?>,'<?php echo $sett[55]?>','<?php echo (($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?php echo (($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','<?php echo $id?>',<?php echo (int)$sett[11]?>,<?php echo $ismobile?>,'<?php echo $bdidnm[$id]?>');
var stvbyte = 1024*20; //방명록 쓰기 길이 제한 값
//]]>
</script>
<?php if($ismobile) {?>
<style type='text/css'>
.menu_left {position:static; width:<?php echo $mbwdth?>px}
.menu_left table.sigh {float:left; width:160px; margin-right:4px}
#main {left:0}
</style>
<?php }?>
<base target="_self" />
</head>
<body>
<span id='img' style='display:none;width:0;position:absolute'></span>
<div id='pview' style='display:none;padding:5px; line-height:130%;position:absolute'></div>
<script type="text/javascript" src="include/top.js"></script>
<table cellpadding='0px' cellspacing='0px' width='<?php echo (($ismobile)? $mbwdth:$mbwdth+235)?>px' class='sigh'>
<tr><td class='menu_title1'>
<table cellpadding='0px' cellspacing='0px' width='100%' class='menu_title2'>
<tr><td style='text-align:left;padding-left:60px;'>
<?php
if(file_exists("icon/m80_".$mno)) {$m12 = "<img src='icon/m80_{$mno}' style='width:80px;height:80px;float:left;margin-right:15px;border:5px solid #EAEAEA' alt='' />";$width=300;}
else $width = 200;
?>
<div class='menu_title8' style='width:<?php echo $width + 3?>px'><div class='menu_title5' style='width:<?php echo $width?>px'><?php echo $m12?>
닉네임 : <?php echo $mm[1]?> <?php echo $mgder?><br />
가입일 : <?php echo date("Y.m.d",substr($mm[6],0,10))?><br />
포인트 : <a href='#none'<?php if($mbr_id){?> onclick="popup('admin.php?pview=<?php echo $mno?>',400,300)"<?php }?>><?php echo (int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]?></a><br />
레&nbsp; &nbsp;벨 : <?php echo levelname($mm[2])?>
 <?php if($sett[90]) {?><img class='icolv' src='icon/pointlevel/<?php echo (($sett[91][1] && $mm[2] == '9')? 'm':$mm[16])?>.gif' alt='' <?php echo (($sett[90])? "title='레벨업까지 필요한 포인트 : {$jno[13]}'":"")?> /><?php } else {?><img class='mblv' src='icon/v<?php echo $mm[2]?>.gif' alt='' /><?php }?>
<?php echo $mmm?>
</div></div><div class='menu_title6'>
<?php if($mbr_level >= $sett[57]) {?>
<input type='button' class='butten' value='쪽지' onclick="popup('exe.php?send=memo&amp;no=<?php echo $mno?>&amp;to=<?php echo urlencode($mm[1])?>',300,200)" onmousedown="this.style.borderColor='#0F408F #5185D8 #5185D8 #0F408F';this.blur()" onmouseup="this.style.borderColor='#5185D8 #0F408F #0F408F #5185D8'" />
<?php
}
if($sett[8] != 'a' && $sett[8] <= $mbr_level){?>
<input type='button' class='butten' value='메일' onclick="popup('exe.php?send=mail&amp;no=<?php echo $mno?>&amp;to=<?php echo urlencode($mm[1])?>',300,300)" onmousedown="this.style.borderColor='#0F408F #5185D8 #5185D8 #0F408F';this.blur()" onmouseup="this.style.borderColor='#5185D8 #0F408F #0F408F #5185D8'" />
<?php } if($mm[10]){?>
<input type='button' class='butten' value='홈페이지' onclick="nwopn('<?php echo $mm[10]?>')" onmousedown="this.style.borderColor='#0F408F #5185D8 #5185D8 #0F408F';this.blur()" onmouseup="this.style.borderColor='#5185D8 #0F408F #0F408F #5185D8'" />
<?php }if($mbr_no==$mno || $mbr_level == 9){?>
<input type='button' class='butten' value='로그정리' onclick="if(confirm('로그정리를 실행하시겠습니까')) location.href='?log=<?php echo $mno?>'" onmousedown="this.style.borderColor='#0F408F #5185D8 #5185D8 #0F408F';this.blur()" onmouseup="this.style.borderColor='#5185D8 #0F408F #0F408F #5185D8'" />
<?php }?>
</div></td></tr></table></td></tr></table>
<div id="main" style="width:<?php echo $mbwdth?>px">
<?php
if($_GET['month'] && ($mno == $mbr_no || (substr($_GET['month'], 0, 6) == "visit_" && $msett[4]) || (substr($_GET['month'], 0, 6) == "diary_" && $msett[0]))) {
$monsix = substr($_GET['month'], 0, 6);
if($monsix == "visit_") $mb = "";
$month = substr($_GET['month'], 10, 2);
$year = substr($_GET['month'], 6, 4);
$time = mktime(0, 0, 0, $month, 1, $year);
$fr = fopen($file,"r");
$dd = "";
$bm = "";
while(!feof($fr)){
$fro = fgets($fr);
$mon = substr($fro, 0, 6);
if(trim($mon)){
if($year == substr($fro,0,4) && $month == substr($fro,4,2)) {
$i = (int)substr($fro,6,2);
if($monsix != 'visit_') $dd[$i] = explode("\x1b",substr($fro, 8));
else if(false !== strpos($fro,"\x1b".$mno."\x1b")) $dd[$i] = 1;
}
if($monsix == 'visit_') {
if(false !== strpos($fro,"\x1b".$mno."\x1b")) $bm[$mon] = $bm[$mon] + 1;
$mb[$i] = explode("\x1b",substr($fro,9,-2));
} else $bm[$mon] = $bm[$mon] + 1;
}
}
fclose($fr);
$nxm = $monsix.$year.str_pad($month + 1, 2, 0, STR_PAD_LEFT);
$pxm = $monsix.$year.str_pad($month - 1, 2, 0, STR_PAD_LEFT);
if($month == '12') $nxm = substr($nxm,0,6).($year + 1)."01";
else if($month == '01') $pxm = substr($pxm,0,6).($year - 1)."12";
?>
<table width='100%' cellpadding='0px' cellspacing='0px'>
<tr style='text-align:center' class='logtitle'><td style='height:45px'><a href='?month=<?php echo $pxm?>&amp;mno=<?php echo $_GET['mno']?>'>≪</a></td><td style="width:33%"><?php echo substr($_GET['month'], 6, 4)?> : <?php echo (int)substr($_GET['month'], 10, 2)?></td>
<td style="width:33%"><a href='?month=<?php echo $nxm?>&amp;mno=<?php echo $_GET['mno']?>'>≫</a></td></tr></table>
<table cellpadding='0px' cellspacing='1px' width='100%' class='wtable'>
<tr class='headtd'><th style='border-left:1px solid #C0C0C0;color:#FF0000'>일</th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th style='border-right:1px solid #ADADAD'>토</th></tr>
<tr class='date'>
<?php
$fem = date("w", $time);
$med = date("t", $time);
if($year == date("Y") && $month == date("m")) $tday = date("d");
for($i = 0; $i < $fem; $i++) echo "<td>&nbsp;</td>";
for($stt = 1; $stt <= $med; $stt++) {
$s2t = str_pad($stt, 2, 0, STR_PAD_LEFT);
$sst = ($stt + $fem) % 7;
if($sst == 1) $stc = "<font color='#FF0000'>{$stt}</font>";
else $stc = $stt;
if($tday == $stt) $stc = "<b><u>{$stc}</u></b>";
if($dd[$stt]) echo "<td style='background-color:#F7F7F7;text-align:right'>";
else echo "<td style='text-align:right'>";
if($monsix == 'visit_') {
if($mb[$stt] && $msett[4]) {
$ddd = "";
for($d= 0; $mb[$stt][$d];$d++) {$ddd .= $nick[$mb[$stt][$d]]."\x18";}
if($mbr_level == 9) echo $stc."<div style='text-align:left'><a href='#none' onmouseover=\"preview(nl2br('".$ddd."'),'xx','150')\" onmouseout=\"preview()\">- ".count($mb[$stt])."명 출석</a></div></td>";
else echo $stc."</td>";
} else echo $stc."</td>";
} else {
$onclk = ($mbr_no == $mno)? " onclick=\"popup('member.php?edxt=".substr($_GET['month'],-6).$s2t."',350,280,0)\"":"";
$stc = "<div style='text-align:right'><a href='#none' {$onclk}>{$stc}</a></div>";
if($dd[$stt]) $stc .= "<div style='text-align:left'><a href='#none' {$onclk} onmouseover=\"preview(nl2br('".trim($dd[$stt][0])."'),'xx','250')\" onmouseout=\"preview()\">- ".strcut($dd[$stt][0],12)."</a></div>";
echo $stc."</td>";
}
if($sst == 0 && $stt != $med) echo "</tr><tr class='date'>";
}
if($sst > 0) for($i = $sst; $i < 7; $i++) echo "<td>&nbsp;</td>";
?>
</tr>
</table>
<?php
} else {
if($id && $bbb && $_GET['no']){
$no6 = str_pad($_GET['no'],6,0,STR_PAD_LEFT);
$xx = (int)$xx;
if($xx > 0) $zd = $id."/^".$xx;
else $zd = $id;
$fl = fopen($dxr.$zd."/list.dat","r");
$fb = fopen($dxr.$zd."/body.dat","r");
$fn = fopen($dxr.$zd."/no.dat","r");
while(!feof($fn)){
$xxx= fgets($fn);
if($no6 == substr($xxx, 0, 6)) {
if(substr($xxx,6,2) == 'aa' && $mbr_level != 9) $deleted = 1;
$crp = explode("\x1b", $xxx);
$flo = explode("\x1b", fgets($fl));
$memo = trim(fgets($fb));
break;
} else {
fgets($fl);
fgets($fb);
}
}
fclose($fl);
fclose($fn);
fclose($fb);
if($deleted) {scrhref("?".preg_replace("`&no=[0-9]+`","",$_SERVER['QUERY_STRING']),0,0);exit;}
$mn = substr($crp[0], 9);
$ctt = substr($crp[0], 6, 2);
$name = $flo[1];
$flo[3] = andamp($flo[3]);
$date = substr($flo[0], 0, 10);
if($flo[5]) {
$flo[5] = str_replace("&","&amp;",$flo[5]);
$link = "<div style='text-align:right'><a target='_blank' href='{$flo[5]}'><span class='rsslink'>링크 : {$flo[5]}</span></a> &nbsp;</div>";
}
if($flo[6]) {
$tagg = explode(",",$flo[6]);
$tag = "<div class='tagg'>태그 : ";
for($j = 0; trim($tagg[$j]); $j++){
$tag .= "<a target='_blank' href='{$index}?id={$id}&amp;search=t&amp;keyword=".urlencode($tagg[$j])."&amp;p=1'>{$tagg[$j]}</a>, ";
}
$tag .= " &nbsp;</div>";
}
if((int)$crp[0][8] > $mbr_level && (!$mn || $mn != $mbr_no) && $_COOKIE["scrt_".$_GET['no'].$id] != md5($_GET['no']."_".$sessid.$id)) {
$memo = "<div class='dv_pass'>비밀글입니다.</div>";
} else if((!$mn || $mn != $mbr_no) && ($bbb[23] == 'a' || $bbb[23] > $mbr_level)) {
$memo = "<div class='dv_pass'>읽기권한이 없습니다.</div>";
}
if($ctg[$ctt]) $isnct = "<a href='?id=".$id."&amp;ct=".$ctt."&amp;p=1' class='ctgg'>";
else $isnct = "<;>";
if($crp[6][0] > 0) {
$insert = "";
for($r = $crp[6][0];$r > 0; $r--) $insert = $insert."re:";
$flo[3] = "<font class='t8'>".$insert."</font> ".$flo[3];
}
$url = "?".str_replace("&","&amp;",preg_replace("`(\?|&)(no|rp|p)=[^&]+`i","",$_SERVER['QUERY_STRING']))."&amp;p=".$_GET['p'];
if(!$flo[5]) $isnlink = "<;>";
$aview = $wdth[7][2];
function nocopy($txt) {
global $aview;
if($txt[0] == "\x18") $txt = substr($txt,1);
if($aview) {
if($aview < 3) $txt = "<div onselectstart='return false' style='-moz-user-select:none'>".$txt."</div>";
else {
if($aview == 4) $txt = "<iframe id='ifr_bdo' style='border:0' frameborder='0'></iframe>";
if($aview >= 5) $txt = "<div style='padding:120px 0px 100px 0;margin-right:20px'><div style='background:#000;color:#FFF;font-size:25px;line-height:40px;padding:25px'>본문은 팝업으로 뜹니다<br />IE에서만 보입니다.</div></div>";
}}
return $txt;
}
?>
<script type='text/javascript'>
//<![CDATA[
ono = <?php echo $_GET['no']?>;
xxn = '<?php echo $xx?>';
document.title="[<?php echo $sett[0]?>] <?php echo $wdth[1]?> - <?php echo str_replace('"','',$flo[3])?>";
<?php if($id && $aview) {?>
function emptyselect() {
var issel = '';
if(setop[0] == '2' && (issel = window.getSelection()) && issel.toString()) {issel.removeAllRanges();}
else if(setop[0] == '1' && (issel = document.selection.createRange()) && issel.htmlText) document.selection.empty();
document.oncontextmenu = new Function ('return false');
document.ondragstart = new Function ('return false');
document.onselectstart = new Function ('return false');
document.body.style.MozUserSelect = "none";
}
<?php
$onload .= "\nsetInterval('emptyselect()',700);";
}
if($aview > 1) {?>

function keyctrl() {
alert('ctrlKey 금지');
return false;
}
function mousedow(e) {
setTimeout("mouse_down()",200);
if((setop[0] == '1' && event.button == 2) || (setop[0] != '1' && e.which == 3)) {alert('우클릭 차단');return false;}
}
setInterval('if(document.onmousedown == null){document.onmousedown = mousedow;}',300);

<?php
if($aview >= 4) {
$scrt = preg_replace("`[a-z]`","",md5($_GET['no'].$uzip.$id));
$i = 0;
while(substr($scrt,$i,1) === '0') $i++;
$scrt = substr($scrt,$i,3);
?>
function aview(idd,no,xx) {
if(idd) {
azax('include/aview.php?&id=' + idd + '&dd=' + no + '&xx=' + xx,'avax(ajax)');
}}
function avax(val) {
<?php if($aview > 4) {if($isie == 1) echo "ajaxx=avieww(ajax.substr(1));popup('{$index}?block5=1',".($mbwdth + 30).",500,1);";} else {?>
var doc = $('ifr_bdo').contentWindow.document;
 		doc.open();
 		doc.write("<html>");
 		doc.write("<head>");
 		doc.write("<link rel='stylesheet' type='text/css' href='skin/<?php echo $srk?>/style.css' />");
 		doc.write("<style type='text/css'>body {overflow:hidden; font-size:<?php echo $fz?>pt; font-family:'<?php echo $faze?>'; margin:0;-moz-user-select:none}</style>");
 		doc.write("</head>");
 		doc.write("<body onload='img_resize()' class='bdo' oncontextmenu='return false' ondragstart='return false' onselectstart='return false'>");
 		doc.write(avieww(val.substr(1)));
 		doc.write("<script type='text/javascript'>function img_resize() {var rszimg = document.getElementsByName('img580');if(rszimg) {for(i=rszimg.length -1; i >= 0; i--) {if(rszimg[i].width > <?php echo $sett[11]?>) rszimg[i].style.width = '<?php echo $sett[11]?>px';rszimg[i].style.cursor = 'pointer';}}resize();}");
 		doc.write("function resize() {if(parent.location.href.indexOf('<?php echo $_SERVER['HTTP_HOST']?>') == -1) document.write();var ht=document.body.scrollHeight + \"px\";parent.$('ifr_bdo').style.height=ht;parent.$('bdo-1').getElementsByTagName('img')[0].style.height=ht;}<\/script>");
 		doc.write("</body>");
 		doc.write("</html>");
		doc.close();
$('ifr_bdo').style.width=$('ifr_bdo').parentNode.offsetWidth +"px";
<?php }?>
}

<?php }} else {?>
function mousedow(e) {
setTimeout("mouse_down()",200);
}
<?php }?>
document.onclick = mousedow;
//]]>
</script>
<?php
$depth = $crp[6][0] + 1;
$sr = fopen("skin/".$sett[48]."/skin.html","r");
while($sro = fgets($sr)) $sr_body .= $sro;
fclose($sr);
function tagcut($tag, $rkin) {
$tlen = strlen($tag);
$head = strpos($rkin,"<sr_".$tag.">") + $tlen + 5;
return substr($rkin, $head, strpos($rkin,"</sr_".$tag.">") - $head);
}
if($ctg[$ctt]) $isnct = "";
else $isnct = "<;>";
if($bbb[54]) {
if($fv = @fopen($dxr.$id."/view.html","r")) {
$addfield = explode("\x1b",$memo);
$memo = $addfield[0];
$fvo ='';
while(!feof($fv)) {
$fvo .= fgets($fv);
}
eval("\$fvo=\"$fvo\";");
$memo = $fvo.$memo;
fclose($fv);
}} else if($aview >= 4) $onload .= "\nsetTimeout(\"aview('{$id}','{$_GET['no']}','{$xx}')\",150);";
$sr_body = str_replace("<#id#>",$id,$sr_body);
$sr_body = str_replace('<#bd_width#>','100%',$sr_body);
$sr_body = str_replace('<#bd_url#>',$sett[14],$sr_body);
$sr_body = str_replace('<#no#>',$_GET['no'],$sr_body);
if(!$mbr_no) $sr_body = str_replace('<#istmbr#>','<;>',$sr_body);
$sr_body = str_replace('<#frited#>','<;>',$sr_body);
$sr_body = str_replace("<#issign#>","<;>",$sr_body);
$sr_body = str_replace('<#xx#>',$xx,$sr_body);
$sr_body = str_replace('<#url#>',$url,$sr_body);
$sr_body = str_replace('<#subject#>',$flo[3],$sr_body);
$sr_body = str_replace('<#name#>',$name,$sr_body);
$sr_body = str_replace("<#isnct#>",$isnct,$sr_body);
if($isnct != "<;>") {
$sr_body = str_replace("<#ct_no#>",$ctt,$sr_body);
$sr_body = str_replace("<#ct_name#>",$ctg[$ctt],$sr_body);
}
$sr_body = str_replace('<#nHit#>',(int)$crp[1],$sr_body);
$sr_body = str_replace('<#nReply#>',(int)$crp[2],$sr_body);
if($wdth[9][11]) $sr_body = str_replace('<#nTrb_out#>',(int)$crp[3],$sr_body);
$sr_body = str_replace('<#nTrb_in#>',(int)$crp[4],$sr_body);
$nvote = explode('|',$crp[5]);
if($mbr_level < $wdth[9][0] || ($s7116 === 1 && $time - substr($flo[0],0,10) > $cuttime[$sett[71][17]])) $vtrpc = 1;else $vtrpc = 0;
$onload .= "vtrpc[{$_GET[no]}] = ".(($vtrpc === 1)? 3:2).";\n";
if(!$bbb[60] || $vtrpc === 1) $sr_body = str_replace('<#is_appr#>','<;>',$sr_body);
else $sr_body = str_replace("<#nAppr#>",(int)$nvote[0],$sr_body);
if(!$bbb[61] || $vtrpc === 1) $sr_body = str_replace('<#is_oppo#>','<;>',$sr_body);
else $sr_body = str_replace("<#nOppo#>",(int)$nvote[1],$sr_body);
$sr_body = str_replace('<#date#>',date("Y-m-d H:i", $date),$sr_body);
$sr_body = str_replace("<#memo#>",nocopy($memo),$sr_body);
$sr_body = str_replace('<#index#>',$index,$sr_body);
$sr_body = str_replace('<#isnlink#>',$isnlink,$sr_body);
$sr_body = str_replace("<#rlink#>",$flo[5],$sr_body);
$sr_body = str_replace('<#tag#>',$tag,$sr_body);
$sr_body = str_replace('<#depth#>',$depth,$sr_body);
$sr_body = str_replace('<#is_edit#>','<;>',$sr_body);
$sr_body = str_replace('<#is_delete#>','<;>',$sr_body);
$srbody = tagcut('head',$sr_body);
$srbody .= tagcut('body',$sr_body);
?><?php echo preg_replace("`<#[^#]+#>`","",preg_replace("`<;>(.+)<!--/-->`sU","",$srbody));?><?php
}
$bd = "";
$bm = "";
$dd = "";
if(!$_GET['p']) $_GET['p'] = 1;
$start = $isnt*($_GET['p'] - 1);
$end = $start + $isnt;
if($_GET['view']) {
$vx[0] = $_GET['view'];
}
else {
$vx[0] = "list";
$vx[1] = "rp";
$vx[2] = "scrap";
$vx[3] = "guest";
}
if($msett[1]) $vvx['list'] = "쓴글";
if($msett[2]) $vvx['rp'] = "덧글";
if($msett[3]) $vvx['scrap'] = "스크랩";
$vvx['guest'] = "방명록";
$sum['list'] = $jno[12];
$sum['rp'] = $jno[13];
if($vvx) $vcx = count($vvx);
$vcc = 0;
for($v = 0; $v < 4; $v++){
if(!$vvx[$vx[$v]]) continue;
$vcc++;
if(!$_GET['view']){
if($vcc % 2 == 0) {?><div style='float:left;width:1.4%'><img src='icon/t.gif' alt='' /></div><?php }
if($vcx == 1 || ($vcx == 3 && $vcc == 3)) {?><div style='float:left;width:100%'><?php }
else {?><div style='float:left;width:49.3%'><?php }
$end = 7;
}
?>
<table width='100%' cellpadding='0px' cellspacing='0px'>
<tr style='text-align:center' class='logtitle'><td style='height:40px'>「 <a href='?mno=<?php echo $mno?>&amp;view=<?php echo $vx[$v]?>'><?php echo $vvx[$vx[$v]]?></a> 」<?php if($vx[$v] == "list"){?><a target='_blank' href='exe.php?mss=<?php echo $mno?>'><img src='icon/rss.gif' style='border:0;margin-right:10px;float:right' alt='' /></a><?php }?></td></tr></table>
<table cellpadding='0px' cellspacing='0px' width='100%' class='wtable'>
<colgroup><col width='60px' /><col width='40px' /><col width='100%' /><col width='62px' /></colgroup>
		<tr class='headtd'>
<?php
if($vx[$v] != 'guest') {
?>
		<th width='60px' style='border-left:1px solid #C0C0C0'>id</th>
		<th width='40px'>lnk</th>
		<th width='100%'>제목</th>
		<th width='62px' style='border-right:1px solid #ADADAD'>날짜</th>
		</tr>
<?php } else {?>
<th colspan='4' style='border-left:1px solid #C0C0C0;border-right:1px solid #ADADAD'></th></tr>
<?php if($_GET['view']){?>
<tr><td colspan='4' style='padding:10px'>
<form name='cmmt' class='fmmt' target='_self' method='post' action='<?php echo $_SERVER['PHP_SELF']?>'><input type='hidden' name='mno' value='<?php echo $mno?>' /><input type='hidden' name='cc' value='0' /><input type='hidden' name='up' value='1' /><input type='hidden' name='request' value='<?php echo $_SERVER['REQUEST_URI']?>' /><input type='hidden' name='spm' value='<?php echo $time?>' />
<?php
if(!$mbr_id) {
?>
<span>name :</span><input type='text' name='username' /><span style='width:7%'>pass :</span><input type='password' name='pass' /><div class='fcler'></div>
<span>homepage :</span><input type='text' name='homepage' style='width:63%' value='http://' onclick="if(this.value=='http://') this.value=''" /><br />
<?php
}
?>
<textarea name='content' rows='1' cols='1'><?php echo $scrip?></textarea>
<div style='float:left;height:50px;padding:30px 0 0 5px'><div style='padding:0 0 10px 10px'><label>비밀글 <input type='checkbox' name='rsecrt' style='border:0' /></label></div><input type='button' onclick='chrvsbmt(this)' value='write' class='write' /></div>
<?php if($sett[82] && ($sett[82] == 2 || $sett[82] == 4 || $sett[82] == 5 || !$mbr_no)) {$nospam = 1?>
<div class='antispamdv'><img src="include/antispam.php?no=<?php echo $time?>" onclick="nwspm(this)" alt="antispam" /><input type="text" name="antispam" value="" onblur="chkatcode(0,this)" onclick="chkatcode(0,this)" /><span class="f8">스팸 방지 코드를 입력하세요</span></div>
<?php } else $nospam = 0;?></form>
</td></tr>
<?php
}}
$rt = "mno=".$mno."&amp;view=".$vx[$v];
$rtt = $rt;
if($_GET['p']) $rtt .= "&amp;p=".$_GET['p'];
if($_GET['ct']) $rtt .= "&amp;ct=".urlencode($_GET['ct']);
if($_GET['date']) $rtt .= "&amp;date=".$_GET['date'];
$file = $dxr."_member_/".$vx[$v]."_".$mno;
$mnth = ($_GET['date'])? substr($_GET['date'],0,6):date("Ym");
$day = (int)substr($_GET['date'], 6);
$c = 0;
if($fd = @fopen($file,"r")) {
while(!feof($fd)) {
if($fdo = trim(fgets($fd))){
if($vx[$v] != 'guest') {
$fid = trim(substr($fdo, 0, 10));
if($bsx[$fid] <= $mbr_level) {
$no = (int)substr($fdo, 10, 6);
$datee = substr($fdo, 16, 10);
if($_GET['view']){
$dx = date("Ym", $datee);
if($dx == $mnth) {
$dxx = (int)date("d", $datee);
if($dd[$dxx] > 1) $dd[$dxx]++;
else if($dd[$dxx]) $dd[$dxx] = 2;
else $dd[$dxx] = "id={$fid}&amp;no={$no}&amp;";
}
$bd[$fid] = $bd[$fid] + 1;
$bm[$dx] = $bm[$dx] + 1;
}
if((!$_GET['ct'] || $_GET['ct'] == $fid) && (!$_GET['date'] || ($mnth == $dx && (!$day || $day == $dxx)))){
if($start <= $c && $c < $end) {
if($_GET['id'] == $fid && $_GET['no'] == $no) {
?><tr class='bF7'><?php
} else {
?><tr><?php
}
$fdo = ($fdo[26] == "\x1b")? "<span style='color:#B5B5B5'>비밀글</span>":preg_replace("`<[^>]+>`","",substr($fdo,26));
?>
			<td class='f8'><a href='?<?php echo $rt?>&amp;ct=<?php echo $fid?>'><?php echo $fid?></a></td>
			<td class='f8'><a target="_blank" href="<?php echo $index?>?id=<?php echo $fid?>&amp;no=<?php echo $no?>" title="
 게시판에서 열기
 "><?php echo $no?></a></td>
			<td class='nobr'>ㆍ <a href="?id=<?php echo $fid?>&amp;no=<?php echo $no?>&amp;<?php echo $rtt?><?php if($vx[$v]=='rp') echo "#comment_{$no}";?>"><?php echo $fdo?></a></td>
			<td class='f8 ddate'><?php if($mbr_no==$mno){?><a href="#none" onclick="dell('<?php echo $vx[$v]?>','<?php echo $fid?>','<?php echo $no?>','<?php echo $datee?>','<?php echo $_GET['view']?>')" title="
 회원로그에서 삭제합니다
 "><?php }?><?php echo date("Y.m.d", $datee)?><?php if($mbr_no==$mno){?></a><?php }?></td>
			</tr><tr><td colspan='4' class='bD7'></td></tr>
<?php
}
$c++;
}
}
} else {
$datee = substr($fdo, 0, 10);
if($_GET['view']){
$dx = date("Ym", $datee);
if($dx == $mnth) {
$dxx = (int)date("d", $datee);
if($dd[$dxx] > 0) $dd[$dxx]++;
else $dd[$dxx] = 1;
}}
$bm[$dx] = $bm[$dx] + 1;
if(!$_GET['date'] || ($mnth == $dx && (!$day || $day == $dxx))) {
if($c >= $start && $c < $end) {
if(!$_GET['view']) {
$fdo = substr($fdo,73,strpos($fdo,"\x1b") -73);
if($ddo = strpos($fdo,"<br")) {if($ddo = substr($fdo,0,$ddo)) $fdo = $ddo;}
?>
			<tr><td colspan='3' class='nobr'>ㆍ<a href="?<?php echo $rtt?>&amp;p=1"><?php echo strcut($fdo,100)?></a></td>
			<td class='f8 ddate'><?php echo date("Y.m.d", $datee)?></td>
			</tr><tr><td colspan='4' class='bD7'></td></tr>
<?php
} else {
$fuo = explode("\x1b",$fdo);
if(substr($fuo[0],11,5) == 'mmbr:') {
$bmo = (int)substr($fuo[0],16,5);
if(file_exists("icon/m20_".$bmo)) $ico = "<img src='icon/m20_".$bmo."' class='icos' alt='' />";
} else $bmo = 0;
if($fuo[1]) $homepage = "<img src='icon/user_blue.gif' alt='' /> <a target='_blank' href='{$fuo[1]}' class='mbnick' title='홈페이지'>";
else if(!$bmo) $homepage = "<img src='icon/user_red.gif' alt='' /> ";
else if($bmo) {$homepage = $ico;if($mbr_level >= $sett[57]) $homepage .= "<a href='#none' onclick=\"send('memo', '{$bmo}','".urlencode(trim(substr($fuo[0],43,30)))."')\" class='mbnick' title='쪽지보내기'>";}
else $homepage = '';
if($fuo[2]) $bip = "({$fuo[2]})";
else $bip = '';
$cup = substr($fuo[0],10,1);
if($bmo == 0) $ibmo = 3;
else if($mbr_level == 9 || $bmo == $mbr_no) $ibmo = 4;else $ibmo = 2;
if(!$fuo[3] || $mno == $mbr_no || $mbr_level == 9 || (substr($fuo,11,5) == 'mmbr:' && $mbr_no = (int)substr($fuo,16,5))) $bdm = substr($fuo[0],73);
else $bdm = "<span style='color:#C2C2C2'><s>비밀글입니다</s></span>";
if($fuo[3]) $flock = "&nbsp; <img src='icon/lock.gif' alt='' class='lockp' />";
else $flock = '';
?>
<tr><td colspan='4'><?php if($cup == '1') {?><div class='rpdiv'><?php }else{?><div class='rrpdiv' style='margin:4px 0 4px <?php echo (30 * ($cup -1))?>px'><?php }?><div class='rpname'>
<?php echo $homepage?><?php echo trim(substr($fuo[0],43,30))?></a> <span class='f8'>(<?php echo date("Y.m.d a h:i",$datee)?>)</span><?php echo $flock?></div><div style='float:right'><span class='f7' style='color:#CCCCCC;float:left;margin-right:5px'><?php echo $bip?></span>
<a href="#none" class="rpbt" onclick="rpmd('<?php echo $datee?>',<?php echo $ibmo?>,$('bdo<?php echo $datee?>'),'<?php echo $fuo[3]?>','<?php echo $fuo[1]?>','guest',this);"><span title="수정">m</span></a><a href="#none" class="rpbt" onclick="fpass('del_guest','<?php echo $ibmo?>','<?php echo $datee?>','guest','','0');document.passe.action='<?php echo $_SERVER['PHP_SELF']?>';"><span title="삭제">x</span></a><?php if($cup != '9') {?><a href="#none" class="rpbt" onclick="rrp(<?php echo $bmo?>,'<?php echo $datee?>','<?php echo ($cup+1)?>')"><span title="리플에 리플"><img src="icon/rpa.gif" alt="" style="height:8px;width:8px" /></span></a><?php }?></div>
<div class='rpmemo'><div id='bdo<?php echo $datee?>' class='bdo'><?php echo $bdm?></div></div><?php if($cup != '9') {?><div id='rpp_<?php echo $datee?>' class='rrpw'></div><?php }?></div></td></tr>
<?php
}}
$c++;
}
}}}
fclose($fd);
}
if($_GET['view']) {
if($_GET['view'] == 'guest') {?><tr><td colspan='4' class='bD7'></td></tr><?php }
?>
<tr><td colspan='4'>
<?php
// 목록번호 출력
$allp = (int)(($c - 1)/ $isnt) + 1;
pagen('p',$allp,7,0);
?>
</td></tr>
<?php
}
?>
</table>
<?php
if(!$_GET['view']){?></div><?php }
}
}
?>
</div>
<div class='menu_left'>
<table cellpadding='0px' cellspacing='0px' width='100%' class='sigh'>
<tr><td class='menu_title1'>
<table cellpadding='0px' cellspacing='0px' width='100%' class='menu_title2'>
<tr><td align='center'><div class='menu_title3' onclick="location.href='?mno=<?php echo $mno?>'">전체메뉴</div></td></tr></table></td></tr>
<tr><td class='menu1'><div class='menu2'>
<?php if($msett[1]){?>
 ㆍ <a href='?mno=<?php echo $mno?>&amp;view=list' <?php if($_GET['view']=='list') echo "style='border-bottom:2px solid #FF6600'";?>><b>쓴글</b> <font class='f7'>[<?php echo $jno[12]?>]</font></a><br />
<?php } if($msett[2]){?>
 ㆍ <a href='?mno=<?php echo $mno?>&amp;view=rp' <?php if($_GET['view']=='rp') echo "style='border-bottom:2px solid #FF6600'";?>><b>덧글</b> <font class='f7'>[<?php echo $jno[13]?>]</font></a><br />
<?php } if($msett[4]){?>
 ㆍ <a href='?mno=<?php echo $mno?>&amp;month=visit_<?php echo date("Ym")?>' <?php if($monsix == 'visit_') echo "style='border-bottom:2px solid #FF6600'";?>><b>출석</b> <font class='f7'>[<?php echo $jno[2]?>]</font></a><br />
<?php } if($msett[3]) {?>
 ㆍ <a href='?mno=<?php echo $mno?>&amp;view=scrap' <?php if($_GET['view']=='scrap') echo "style='border-bottom:2px solid #FF6600'";?>><b>스크랩</b></a><br />
<?php }?>
 ㆍ <a href='?mno=<?php echo $mno?>&amp;view=guest' <?php if($_GET['view']=='guest') echo "style='border-bottom:2px solid #FF6600'";?>><b>방명록</b></a>
<?php if($msett[0]){?>
<br /> ㆍ <a href='?mno=<?php echo $mno?>&amp;month=diary_<?php echo date("Ym")?>' <?php if($monsix != 'visit_' && $_GET['month']) echo "style='border-bottom:2px solid #FF6600'";?>><b>다이어리</b></a>
<?php }?>
</div></td></tr></table>
<?php
if($_GET['view']){
if($_GET['view'] != 'guest'){
?>
<table cellpadding='0px' cellspacing='0px' width='100%' class='sigh'>
<tr><td class='menu_title1'>
<table cellpadding='0px' cellspacing='0px' width='100%' class='menu_title2'>
<tr><td align='center'><div class='menu_title3' onclick="location.href='?mno=<?php echo $mno?>'">게시판목록</div></td></tr></table></td></tr>
<tr><td class='menu1'><div class='menu2'>
<?php
if($bd) foreach($bd as $key => $val) {
?>
 ㆍ <a href='?<?php echo $rt?>&amp;ct=<?php echo $key?>&amp;p=1' <?php if($_GET['id'] == $key||$_GET['ct'] == $key) echo "style='border-bottom:2px solid #FF6600'";?>> <?php echo $bst[$key]?></a> <font class='f7'>[<?php echo $val?>]</font><br />
<?php
}
?>
</div></td></tr></table>
<?php
}
$month = substr($mnth, 4, 2);
$year = substr($mnth, 0, 4);
$pxt = mktime(0, 0, 0, $month, 1, $year);
$med = date("t", $pxt);
$nxt = mktime(23, 59, 59, $month, $med, $year);
$fem = date("w", $pxt);
$nxm = $year.str_pad($month + 1, 2, 0, STR_PAD_LEFT);
$pxm = $year.str_pad($month - 1, 2, 0, STR_PAD_LEFT);
if($month == '12') $nxm = ($year + 1)."01";
else if($month == '01') $pxm = ($year - 1)."12";
?>
<table cellpadding='0px' cellspacing='0px' width='100%' class='sigh'>
<tr><td class='menu_title1'>
<table cellpadding='0px' cellspacing='0px' width='100%' class='menu_title2'>
<tr><td>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td align='right' style='width:50%'><div class='menu_title7' onclick="teggle('montha','monthb')" id="montha1">달력</div></td><td align='left' style='width:50%'><div class='menu_title4' onclick="teggle('montha','monthb')" id="monthb1">월별목록</div></td></tr></table></td></tr></table></td></tr>
<tr><td class='menu1'>
<div id='montha' class='menu2' style='padding:7px 0 5px 0px' align='center'>
<table width='190px' class='calendar' align='center'>
<tr><td style='height:20px'>&nbsp;</td><td><a href='?<?php echo $rt?>&amp;date=<?php echo $pxm?>'>&lt;</a></td><td colspan='3'><?php echo substr($mnth, 0, 4)?> : <?php echo (int)substr($mnth, 4, 2)?></td><td><a href='?<?php echo $rt?>&amp;date=<?php echo $nxm?>'>&gt;</a></td><td>&nbsp;</td></tr>
<tr><td><font color='#FF0000'>일</font></td><td>월</td><td>화</td><td>수</td><td>목</td><td>금</td><td>토</td></tr><tr>
<?php
if($year == date("Y") && $month == date("m")) $tday = date("d");
for($i = 0; $i < $fem; $i++) echo "<td>&nbsp;</td>";
for($stt = 1; $stt <= $med; $stt++) {
$sst = ($stt + $fem) % 7;
if($sst == 1) $stc = "<font color='#FF0000'>{$stt}</font>";
else $stc = $stt;
if($tday == $stt) $stc = "<b><u>{$stc}</u></b>";
if($day == $stt) echo "<td class='thisdoc' onclick=\"rplace('?".$rt."&amp;date=".$mnth.str_pad($stt, 2, 0, STR_PAD_LEFT)."&amp;p=1');\">".$stc."</td>";
else if($dd[$stt] >= 2) echo "<td class='isdoc' onmouseover='mouxe(this)' onmouseout='mouxe(this)' onclick=\"rplace('?".$rt."&amp;date=".$mnth.str_pad($stt, 2, 0, STR_PAD_LEFT)."&amp;p=1')\" title='{$dd[$stt]}개의 게시물'>".$stc."</td>";
else if($dd[$stt]) echo "<td class='isdoc' onmouseover='mouxe(this)' onmouseout='mouxe(this)' onclick=\"rplace('?".$dd[$stt].$rt."&amp;date=".$mnth."&amp;p=1')\" title='1개의 게시물'>".$stc."</td>";
else echo "<td>".$stc."</td>";
if($sst == 0 && $stt != $med) echo "</tr><tr>";
}
if($sst > 0) for($i = $sst; $i < 7; $i++) echo "<td>&nbsp;</td>";
?>
</tr>
</table>
</div>
<div id='monthb' class='menu2' style='display:none'>
<?php
if($bm) foreach($bm as $key => $val) {
if($_GET['date'] == $key) echo " ㆍ <a href='?".$rt."&amp;date=".$key."&amp;p=1'><u>".$key."</u></a> <font class='f7'>[".$val."]</font><br />";
else echo " ㆍ <a href='?".$rt."&amp;date=".$key."&amp;p=1'>".$key."</a> <font class='f7'>[".$val."]</font><br />";
}
?>
</div></td></tr></table>
<?php
} else if($_GET['month']) {
?>
<table cellpadding='0px' cellspacing='0px' width='100%' class='sigh'>
<tr><td class='menu_title1'>
<table cellpadding='0px' cellspacing='0px' width='100%' class='menu_title2'>
<tr><td align='center'><div class='menu_title3'>월별 목록</div></td></tr></table></td></tr>
<tr><td class='menu1'><div class='menu2'>
<?php
if($bm) foreach($bm as $key => $val) {
?>
 ㆍ <a href='?month=<?php echo $monsix?><?php echo $key?>&amp;mno=<?php echo $_GET['mno']?>' <?php if($_GET['month'] == $monsix.$key) echo "style='border-bottom:2px solid #FF6600'";?>><?php echo $key?></a> <font class='f7'>[<?php echo $val?>]</font><br />
<?php
}
?>
</div></td></tr></table>
<?php
}
?>
</div>
<script type='text/javascript'>
//<![CDATA[
window.onload = function() {
img_resize();
if('<?php echo $_COOKIE['cfsz']?>' && $('cfsz')) $('cfsz').value='<?php echo $_COOKIE['cfsz']?>';
pview = $('pview');
<?php echo $onload?>

$('curtain').style.background="url('icon/d30.png')";
<?php if($ismobile) {?>cfsz(12);<?php }
if($nospam) {?>nwspm();<?php }?>
}
function dell(AA,BB,CC,DD,EE) {
if(confirm("회원로그에서 이 목록을 삭제하시겠습니까 ")) azax("?&dell="+ AA +"&id="+ BB +"&no="+ CC +"&date="+ DD +"&mno=<?php echo $mno?>","alert('삭제했습니다.');location.reload()");
}

function nl2br(txt) {
return txt.replace(/"/g,"˝").replace(/\x18/g,"<br />");
}
<?php
if($monsix != 'visit_') echo "document.title = '{$mm[1]}님의 다이어리';";
else echo "document.title = '{$mm[1]}님의 출석부';";
?>

<?php if($_GET['month']) {?>
function resize_m(AA, BB) {
if($(AA).style.height == '') {
$(AA).style.height = BB;
$(AA).style.overflow = 'hidden';
} else {
$(AA).style.height = '';
$(AA).style.overflow = 'visible';
}
}
<?php
}
if(!$_GET['id'] ||!$_GET['no']){
if($_GET['view']){
?>document.title='<?php echo $mm[1]?>님의 <?php echo $vvx[$_GET['view']]?>';<?php
} else {
?>document.title='<?php echo $mm[1]?>님의 글';<?php
}
}
?>
function teggle(AA, BB){
if($(AA).style.display=='none') {
$(AA).style.display = 'block';
$(BB).style.display = 'none';
$(AA + '1').className = 'menu_title7';
$(BB + '1').className = 'menu_title4';
} else {
$(AA).style.display = 'none';
$(BB).style.display = 'block';
$(AA + '1').className = 'menu_title4';
$(BB + '1').className = 'menu_title7';
}
}
<?php
if($_GET['id'] || $_GET['view'] == 'guest') {
?>
function ckprohibit(ths) {
var prhbw = new Array(''<?php
if($fp=@fopen($dxr."prohibit","r")){
while($fpo = trim(fgets($fp))) echo ",'{$fpo}'";
fclose($fp);
}
?>);
for(var i=prhbw.length -1;i > 0;i--) {
if(ths.indexOf(prhbw[i]) != -1) return prhbw[i];
}}

function rrp(no,nc,mt) {
if($('rpp_' + nc).innerHTML) {
$('rpp_' + nc).innerHTML = "";
$('rpp_' + nc).style.display = "none";
} else {
var rf = document.cmmt.innerHTML;
rf = rf.replace('cmmt','rp_' + nc);
rf = '<form name="rp_' + nc + '" method="post"  class="fmmt" action="<?php echo $_SERVER['PHP_SELF']?>" style="padding-top:10px">' + rf + '</form>';
$('rpp_' + nc).innerHTML = rf;
$('rpp_' + nc).style.display = "block";
rpp(nc,mt);
}
}
function rpp(nc,mt) {
var ccf =document.getElementsByName('rp_' + nc)[0];
<?php if(!$mbr_level){?>
ccf.name.value = document.cmmt.name.value;
ccf.pass.value = document.cmmt.pass.value;
<?php }?>
ccf.up.value = mt;
ccf.cc.value = nc;
if($$('cmmt',0).antispam) {ccf.antispam.value = $$('cmmt',0).antispam.value;if(!ccf.antispam.id) nwspm(ccf.antispam.previousSibling);}
}
function chrvsbmt(ths) {
var cform = findfm(ths);
if(cform.antispam && !cform.antispam.id) {alert('스팸 방지 코드를 넣으세요.');chkatcode(0);return false;}
if(cform.content.value == '') {alert('내용이 비었습니다.');return false;}
else {var proh = ckprohibit(cform.content.value);if(proh) {alert('금지단어 "' + proh + '"가 있습니다.');return false;}}
if(<?php echo $mbr_level?> == 0 && eval(cform.username) && (cform.username.value == '' || cform.pass.value == '' )) {alert('빈 칸이 있습니다');return false;}
var over = strbyte(cform.content.value) - stvbyte;
if(stvbyte != 0 && over > 0) {alert('내용이 너무 깁니다. (' + over + 'byte 초과)');return false;}
cform.submit();
}

function resizeheight(w,h){
if(py[2] != 0) {
w = w - parseInt(px[0]) + parseInt(px[1]);
h = h - parseInt(py[0]) + parseInt(py[1]);
if(w > 300 && h > 100) {
ry.style.width = w + 'px';
ry.style.height = h + 'px';
}} else {
w = w - parseInt(px[0]) + parseInt(px[1]);
h = h - parseInt(py[0]) + parseInt(py[1]);
ry.style.left = w + 'px';
ry.style.top = h + 'px';
}}
var reque = ["<?php echo md5(session_id())?>","<?php echo $_SERVER['REQUEST_URI']?>","<?php echo $xx?>","<?php echo $mno?>",0];
//]]>
</script>
<script type="text/javascript" src="include/bottom.js"></script>
<iframe name="exe" style="display:none;width:0;height:0"></iframe>
<form method="post" action="exe.php" name="passe" id="passf" style="display:none;">
<input type="hidden" name="no" value="<?php echo $_GET['no']?>" />
<input type="hidden" name="pno" value="<?php echo $_GET['no']?>" />
<input type="hidden" name="p" value="<?php echo $_GET['p']?>" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<input type="hidden" name="xx" value="<?php echo $xx?>" />
<input type='hidden' name='request' value='<?php echo $_SERVER['REQUEST_URI']?>' />
<input type='hidden' name='edit' value='<?php echo $_GET['edit']?>' />
<input type='hidden' name='mno' value='<?php echo $mno?>' />
<table class="passtb" onmousedown="movem(this);" onmouseup="movem();">
<tr><td>password : <input type="password" onmousemove="ry='';px=0;py=0" name="pass" class="psinput" value="<?php echo $_SESSION['ypass']?>" maxlength='10' /></td></tr>
<tr><td><input type="button" value="취소" onclick="fpass()" class="srbt" /> &nbsp; &nbsp; <input type="button" name="editt" value="" onclick="passbmt(this)" class="srbt" /></td></tr></table>
</form>
<form method="post" action="exe.php" id="ckfma" target="exe"></form>
<?php
} else {?>
//]]>
</script>
<?php }?>
<div id='curtain' style='display:none'></div>
</body>
</html>