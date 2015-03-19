<?php
session_start();
include("include/common.php");
$tp = $dxr.$_SERVER['REMOTE_ADDR'];
$cook = "at".str_pad($uzip,12,"x");
$ok = 0;
if($_GET['ectgtw']) {
if($mbr_level == 9) {
$sett[26] = '';
$sectcss = '';
$wdth[2] = 'default';
$srwdth = 566;
$sss[26] = 'd';
$wdth[7][31] = 'a';
$sett[33] = '420';
$sett[41] = '';
$fst = fopen($dxr."section.dat","r");
$fsta = fopen($dxr."section_add.dat","r");
for($ii=1;$ii < $_GET['ectgtw'];$ii++) {fgets($fsta);fgets($fst);}
$sectt = explode("\x1b",fgets($fst));
$content = str_replace("<t","\n<t",str_replace("&","&amp;",fgets($fsta)));
$content = preg_replace("`<td width='[0-9\.]+(px|%)'`","<td",$content);
$content = "<table border='2' alt='수정삭제금지' width='100%'>".str_replace("<#","[#",str_replace("#>","#]",$content))."</table>";
fclose($fst);
fclose($fsta);
if(!$sectt[6]) $sectt6 = $sett[26];
else if((int)$sectt[6] >= 1) {
$sef = fopen($dxr."section_group.dat","r");
for($ii=1;$ii < $sectt[6];$ii++) fgets($sef);
$sefg = explode("\x1b",fgets($sef));
fclose($sef);
$sectt6 = $sefg[1];
}
include "include/write.php";
?>
<form name='sectfm' method='post' action='?' style='height:1px;visibility:hidden'>
<input type='hidden' name='ectn' value='<?php echo $_GET['ectgtw']?>' />
<input type='hidden' name='ectl' value='<?php echo $sectt6?>' />
<textarea name='ectg'></textarea>
<input type='submit' />
</form>
<script type='text/javascript'>
//<![CDATA[
$('gout').value = 3;
$('hidden2').parentNode.style.display = 'none';
$$('ct',0).parentNode.style.display = 'none';
$('tpsv').style.display = 'none';
document.title = '섹션대문편집 - <?php echo $_GET['ectgtw']?>';
$('regular').parentNode.parentNode.innerHTML = $('regular').parentNode.parentNode.innerHTML + "위지윅 특성으로 &lt;#는 [#, #&gt;는 #]로 표시함";
function repeatt() {}
function azax() {}
function wcancel() {self.opener = self;window.close();}
function sbmt() {
if(setop[0] == '1' || setop[1] == 'opera') {if($('wzor').value == 'w') wsghtm();seltrans('w3c');}
var datta = memo(1);datta = datta.replace(/\[#/g,"<#").replace(/#\]/g,"#>");
var tn = datta.indexOf('<colgroup>');if(tn == -1) tn = datta.indexOf('<COLGROUP>');if(tn != -1) {
datta = datta.substr(tn + 10);
tn = datta.indexOf('</colgroup>');if(tn == -1) tn = datta.indexOf('</COLGROUP>');if(tn != -1) {
var dattb = datta.substr(0,tn);
tn = datta.indexOf('<tr');if(tn == -1) tn = datta.indexOf('<TR');if(tn != -1) {
datta = datta.substr(tn);
if(datta.slice(-16).toLowerCase() == '</tbody></table>') datta = datta.slice(0,-16);
else if(datta.slice(-8).toLowerCase() == '</table>') datta = datta.slice(0,-8);
dattb = dattb.replace(/>/g," />").replace(/ \/ \/>/g," />").replace(/"/g,"'").toLowerCase();
if(setop[0] == '1' || setop[1] == 'opera') datta = datta.replace(/vAlign=/g,"valign=").replace(/colSpan=/g,"colspan=").replace(/rowSpan=/g,"rowspan=");
datta = '<colgroup>' + dattb + '</colgroup>' + datta.replace(/="([0-9a-z]+)"([ >])/g,"='\$1'\$2");
document.sectfm.ectg.value = datta;document.sectfm.submit();
} else alert('문제가 있습니다. &lt;tr&gt;');} else alert('문제가 있습니다. &lt;/colgroup&gt;');} else alert('문제가 있습니다. &lt;colgroup&gt;');
}
//]]>
</script>
</body>
</html>
<?php
}
exit;
}
if(!$mbr_level) {
if($_COOKIE[$cook]) {
$fat = fopen($dxr."_member_/autologin","r");
while(!feof($fat)) {
$xxx = fgets($fat);
if(substr($xxx,29,32) == $_COOKIE[$cook]) {
$xxx = explode("\x1b",substr($xxx,61,-1));
$_POST['username_3'] = $xxx[0];
$_POST['password_3'] = $xxx[1];
$_POST['autologin'] = 1;
$_SERVER['HTTP_REFERER'] = $_SERVER['HTTP_HOST'];
if(!$_POST['from']) $_POST['from'] = (false !== strpos($_SERVER['QUERY_STRING'],".") || false !== strpos($_SERVER['QUERY_STRING'],"/") || false !== strpos($_SERVER['QUERY_STRING'],"?"))? $_SERVER['QUERY_STRING']:$_SERVER['REQUEST_URI'];
$autologged = 1;
break;
}}
fclose($fat);
}}
function ssckdxl() {
$ustt = md5($_COOKIE['mck']."\x1b".$_SESSION['mk']);
unset($_SESSION['m_nick']);
unset($_SESSION[$_SESSION[$_COOKIE[$ustt]]]);
unset($_SESSION[$_COOKIE[$ustt]]);
unset($_SESSION['mk']);
foreach($_COOKIE as $key => $value) {if($key[0] != 'v' && $key != 'PHPSESSID') setcookie($key,'');}
}
if($mbr_level) { /*-7-*/
if($_POST['logout']) { /*-6-*/
if(file_exists($dxr."_member_/autologin")) {
usleepp($dxr."_member_/autologin@@");
$jdat = fopen($dxr."_member_/autologin@@","w");
$ltime = $time - 864000;
$fat = fopen($dxr."_member_/autologin","r");
while(!feof($fat)) {
$xxx = fgets($fat);
if((int)substr($xxx,14,5) == $mbr_no || substr($xxx,19,10) < $ltime) $xxx = '';
fputs($jdat, $xxx);
}
fclose($fat);
fclose($jdat);
copy($dxr."_member_/autologin@@", $dxr."_member_/autologin");
unlink($dxr."_member_/autologin@@");
}
unlink($dxr."_member_/logged_".$mbr_no);
ssckdxl();
scrhref($_POST['from'],0,0);exit;
} else if($_GET['id'] && $_GET['scrap']) { /*-6-*/
if($_GET['xx']) $idd = $_GET['id']."/^".$_GET['xx'];
else $idd = $_GET['id'];
$dl = $dxr.$idd."/list.dat";
$dn = $dxr.$idd."/no.dat";
$fn = fopen($dn,"r");
$fl = fopen($dl,"r");
while(!feof($fn)) {
$fno = fgets($fn);
if((int)substr($fno, 0, 6) == $_GET['scrap']) {
$str = explode("\x1b", fgets($fl));
break;
} else fgets($fl);
}
fclose($fn);
fclose($fl);
$end = str_pad($_GET['id'],10).str_pad($_GET['scrap'],6,0,STR_PAD_LEFT);
$str = $end.substr($str[0],0,10).$str[3]."\n";
$file = $dxr."_member_/scrap_".$mbr_no;
$fm = fopen($tp,"w");
$fp = fopen($file,"a+");
fputs($fm, $str);
while(!feof($fp) && $stop == "") {
$fpo = fgets($fp);
if(substr($fpo, 0, 16) == $end) $stop = "1";
fputs($fm, $fpo);
}
fclose($fp);
fclose($fm);
if($stop == "") {
copy($tp,$file);
}
unlink($tp);
header("location:member.php?mno=".$mbr_no."&view=scrap");
} else if($_GET['dell_scrap']) { /*-6-*/
$file = $dxr."_member_/scrap_".$mbr_no;
$fm = fopen($tp,"w");
$fp = fopen($file,"a+");
$i = 1;
while(!feof($fp)) {
$fpo = fgets($fp);
if($_GET['dell_scrap'] == $i) $fpo = "";
fputs($fm, $fpo);
$i++;
}
fclose($fp);
fclose($fm);
copy($tp,$file);
unlink($tp);
header("location:?scrap=".$mbr_no);
} else if($_POST['gtm']) { /*-6-*/
$file = $dxr."section.dat";
usleepp($file."@@");
$jfi = fopen($file."@@","w");
if($rfi = @fopen($file,"r")) {
$i = 1;
while($rfio = fgets($rfi)) {
if($i == $_POST['gtm']) {
$rfoo = explode("\x1b",$rfio);
if($_POST['group'] && $mbr_level == 9) {
$rfio = $rfoo[0]."\x1b".$rfoo[1]."\x1b".$rfoo[2]."\x1b".$_POST['group'][0]."\x1b".$_POST['group'][1]."\x1b,";
for($g = 2;$_POST['group'][$g];$g++) $rfio .= $_POST['group'][$g].",";
} else if($_POST['inout'] == '2') {
$rfio = $rfoo[0]."\x1b".$rfoo[1]."\x1b".$rfoo[2]."\x1b".$rfoo[3]."\x1b".$rfoo[4]."\x1b".str_replace(",".$mbr_no.",",",",$rfoo[5]);
} else if($_POST['inout'] == '1') {
$rfio = $rfoo[0]."\x1b".$rfoo[1]."\x1b".$rfoo[2]."\x1b".$rfoo[3]."\x1b".$rfoo[4]."\x1b".$rfoo[5].$mbr_no.",";
}
$rfio .= "\x1b".$rfoo[6]."\x1b\n";
}
fputs($jfi,$rfio);
$i++;
}
fclose($rfi);
}
fclose($jfi);
copy($file."@@",$file);
unlink($file."@@");
if($_POST['inout']) echo "location.reload()";
else scrhref('?sect_group='.$_POST['gtm'],0,0);
exit;
} /*-6-*/
if($mbr_level == 9) { /*-6-*/
include("include/admin_1.php");
} /*-6-*/
} /*-7-*/
function login_failcnt($w) { /*-7-*/
global $dxr,$sett,$time;
$ipt = str_pad($_SERVER['REMOTE_ADDR'],15);
$mtime = $time - 86400;
$fww = '';
$fwc = 0;
if($w == 1 && ($fw = @fopen($dxr."wrong_idpass2.dat","r"))) {
while(!feof($fw)) {
$fwo = fgets($fw);
if(substr($fwo,0,10) > $mtime) {
if(substr($fwo,10,15) == $ipt) $fwc = sprintf("%d",(substr($fwo,0,10) - $mtime)/60);
$fww .= $fwo;
} else $nfw = 1;
}
fclose($fw);
if($nfw) {
$fw = fopen($dxr."wrong_idpass2.dat","w");
fputs($fw,$fww);
fclose($fw);
}
if($fwc) {
$fwc = sprintf("%d",$fwc/60)."시간 ".($fwc%60)."분";
$goto = ($_POST['from'])? $_POST['from']:$index;
scrhref($goto,0,"반복된 실패로 차단되셨습니다. (남은 시간 : {$fwc})");
exit;
}
} else if($w == 2) {
if($fw = @fopen($dxr."wrong_idpass1.dat","r")) {
while(!feof($fw)) {
$fwo = fgets($fw);
if(substr($fwo,0,10) > $mtime) {
if(substr($fwo,10,15) == $ipt) {$fwc++;$fwi .= $fwo;}
else $fww .= $fwo;
} else $nfw = 1;
}
fclose($fw);
$fwc++;
if($fwc >= $sett[53]) {
$fw = fopen($dxr."wrong_idpass2.dat","a");
fputs($fw,$time.$ipt."\n");
fclose($fw);
$fwi = '';
}}
if($fwc < $sett[53]) $fww = $time.$ipt."\n".$fww;
$fw = fopen($dxr."wrong_idpass1.dat","w");
fputs($fw,$fwi.$fww);
fclose($fw);
}
return $fwc;
} /*-7-*/
function addrcheck($addr) {
$retn = 0;
if(preg_match("`^[0-9a-z_\.]+@([0-9a-z_]+\.[0-9a-z_\.]+)$`i",$addr,$host)) {
$nomail = array('sharklasers.com','guerrillamailblock.com','guerrillamail.com','guerrillamail.net','guerrillamail.biz','guerrillamail.org','guerrillamail.de','spam4.me','emailisvalid.com','yopmail.com','rmqkr.net','rtrtr.com','incognitomail.org','bj.mintemail.com','mailinator.com');
if(!in_array($host[1],$nomail)) {
if(($fp = @fsockopen($host[1], 80, $errno, $errstr, 30))) {
fclose($fp);
$retn = 1;
}}}
return $retn;
}
function logincheck($name, $pass) {
 global $dim, $sett;
login_failcnt(1);
if($name && $pass) {
$name = str_pad($name,15);
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(substr($xxx,5,15) == $name) {
$isid = 1;
$okok = explode("\x1b", $xxx);
if(md5(substr($okok[6],0,10).$pass) != substr($okok[0],20)) {$okok = "";$isps = 1;}
break;
}
}
fclose($fim);
}
if($isid != 1 || $isps == 1) scrhref(0,0,"incorrect username or password (".login_failcnt(2)."/{$sett[53]})");
else return $okok;
}
$sess = (int)substr(preg_replace("`[^0-9]`","",md5($_SERVER['REMOTE_ADDR'].$zro)),0,3);
if($_POST['username_3'] && $_POST['password_3']) { /*-7-*/
foreach($_POST as $key => $value) {
if(!is_array($value) && (false !== strpos($value,"\x1b") || false !== strpos($value,"\n"))) exit;
}
function convertbase($str) {
global $sess;
while($str) {
$str_1 .= chr(base_convert(substr($str,-2),18,10));
$str = substr($str,0,-2);
}
while($str_1) {
$str_2 .= chr(base_convert(substr($str_1,-2),34,10) - $sess);
$str_1 = substr($str_1,0,-2);
}
return $str_2;
}
$usrname = convertbase($_POST['username_3']);
$pssword = convertbase($_POST['password_3']);
if($_POST['nick'] && $_POST['email']) { /*-6-*/
if(!$sett[61]) { /*-4-*/
if($_SESSION['rgstr'] == md5($uzip) || $_SESSION[$_SESSION['eaddr']] = md5($_SERVER['REMOTE_ADDR'])) { /*---*/
if(strlen($usrname) <= 15) { /*--*/
$double = '';
$thos = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')).'/';
if($_POST['blog'] == 'http://') $_POST['blog'] = '';
if(!file_exists($dim)) { /*-*/
$first_level = "9";
$dxr = "data/".substr(md5($usrname.$time),rand(1,16),rand(10,16))."/";
if(!mkdir($dxr, 0777)) {scrhref(0,0,'data폴더에 쓰기권한이 없습니다. data,icon,chat,module폴더의 권한을 777로 주세요.');exit;}
$fpa = fopen($dxr.".htaccess","w");
fputs($fpa,"order deny,allow\ndeny from all");
fclose($fpa);
$fpa = fopen($dxr."section.dat","w");
fputs($fpa,"전체\x1b8\x1b\x1b\n");
fclose($fpa);
$fpa = fopen($dxr."section_add.dat","w");
fputs($fpa,"\n");
fclose($fpa);
fclose(fopen($dxr."section_arr.dat","w"));
fclose(fopen($dxr."section_group.dat","w"));
fclose(fopen($dxr."boards.dat","w"));
fclose(fopen($dxr."nothing","w"));
fclose(fopen($dxr."count_3d.dat","w"));
fclose(fopen($dxr."count.dat","w"));
fclose(fopen($dxr."count_all.dat","w"));
fclose(fopen($dxr."memo.dat","w"));
fclose(fopen($dxr."memo1.dat","w"));
$fp = fopen($dxr."setting.dat","w");
fputs($fp, "제목\x1bsrb_9\x1b\x1b\x1b2\x1b500\x1b0\x1b100\x1b0\x1b0\x1b3\x1b600\x1b940\x1b1\x1b".$thos."\x1b1\x1b100100\x1b10\x1b1\x1b9\x1b00000\x1b30\x1bc\x1b100\x1b\x1b1\x1bdefault\x1b0\x1b24\x1b1\x1b1\x1b\x1b0\x1b300\x1b0\x1b15\x1b10\x1b0\x1b0\x1b10\x1b0\x1b1\x1b0\x1b010001000800\x1b1\x1bdefault\x1b0\x1b1\x1bsrb_2\x1b0.2\x1b0.1\x1b9\x1b3\x1b10\x1b2\x1b350\x1b\x1b0\x1b100\x1b1준회원\x182정회원\x189관리자\x18\x1b5|5\x1b0\x1b0\x1b0\x1bjpg|png|gif|zip|rar|7z|tgz|tar.gz|wma|mp3\x1b30\x1b1\x1b240\x1b240\x1b240\x1b240\x1b9000090000920920100000\x1b0\x1b0\x1b0\x1b5\x1b0\x1b0\x1b20\x1b1\x1b10\x1b1\x1b1\x1b1\x1b0\x1b0\x1b0\x1b0\x1b0\x1b0\x1b0\x1b00\x1b0\x1b1800\x1b");
fclose($fp);
fclose(fopen($dxr."head","w"));
fclose(fopen($dxr."tail","w"));
fclose(fopen($dxr."ban","w"));
fclose(fopen($dxr."ban2","w"));
fclose(fopen($dxr."prohibit","w"));
mkdir($dxr."_member_", 0777);
mkdir($dxr."_member_/_bak_", 0777);
fclose(fopen($dxr."attend.dat","w"));
fclose(fopen($dxr."category.dat","w"));
$fim = fopen($dxr."member.dat","w");
$str = "00001".str_pad($usrname, 15).md5($time.$pssword)."\x1b".$_POST['nick']."\x1b".$first_level."\x1b".$_POST['email']."\x1b".$_POST['postaddr'].",".$_POST['addrplus']."\x1b".$_POST['cellnumber'][0]."-".$_POST['cellnumber'][1]."-".$_POST['cellnumber'][2]."\x1b".$time.$_POST['birthday'][0].$_POST['birthday'][1].$_POST['birthday'][2]."\x1b".$_POST['addinfo']."\x1b".(int)$_POST['public_postaddr'].(int)$_POST['public_cellnumber'].(int)$_POST['public_birthday'].(int)$_POST['public_gender']."\x1b".$_POST['gender']."\x1b".$_POST['blog']."\x1ba\x1b0\x1b0\x1b0\x1b0\x1b1\x1b\n";
fputs($fim, $str);
fclose($fim);
$no = 1;
} else if($sett[46] == 0 || $sett[46] == 2 || $_SESSION[preg_replace("`[^0-9a-z]`i","",$_POST['email'])] = md5($_SERVER['REMOTE_ADDR'])) { /*-*/
$first_level = "1";
usleepp($dim."@@");
$jdim = fopen($dim."@@","w");
$fim = fopen($dim,"r");
$fmfz = filesize($dim);
$strr = fgets($fim);
$no = (int)substr($strr, 0, 5) + 1;
$str = str_pad($no,5, 0, STR_PAD_LEFT).str_pad($usrname, 15).md5($time.$pssword)."\x1b".$_POST['nick']."\x1b".$first_level."\x1b".$_POST['email']."\x1b".$_POST['postaddr'].",".$_POST['addrplus']."\x1b".$_POST['cellnumber'][0]."-".$_POST['cellnumber'][1]."-".$_POST['cellnumber'][2]."\x1b".$time.$_POST['birthday'][0].$_POST['birthday'][1].$_POST['birthday'][2]."\x1b".$_POST['addinfo']."\x1b".(int)$_POST['public_postaddr'].(int)$_POST['public_cellnumber'].(int)$_POST['public_birthday'].(int)$_POST['public_gender']."\x1b".$_POST['gender']."\x1b".$_POST['blog']."\x1ba\x1b0\x1b0\x1b0\x1b0\x1b1\x1b\n";
$fmfz += strlen($str);
fputs($jdim, $str);
rewind($fim);
while(!feof($fim)) {
$xxx = fgets($fim);
if(strpos($xxx, "\x1b".$_POST['nick']."\x1b") == 52) {
$double = "nick";
break;
} else if($usrname == trim(substr($xxx,5,15))) {
$double = "name";
break;
} else fputs($jdim, $xxx);
}
fclose($fim);
fclose($jdim);
if(!$double && $fmfz == filesize($dim."@@")) {copy($dim,$dim."_bk");copy($dim."@@", $dim);$okok = explode("\x1b",$str);}
unlink($dim."@@");
if($wp = @fopen($dxr."welcome","r")) {
while(!feof($wp)) $wps .= fgets($wp);
fclose($wp);
if($wps) {
$wps = preg_replace("`[\r\n]`","",$wps);
$fim = fopen($dmo,"a");
fputs($fim, "010".str_pad($no,5,0,STR_PAD_LEFT)."0000a".$time."\x1b관리자\x1b\x1b".$wps."\n");
fclose($fim);
}
}
} else $doble= 1; /*-*/
if(!$doble) { /*-*/
fclose(fopen($dxr."_member_/scrap_".$no,"w"));
fclose(fopen($dxr."_member_/diary_".$no,"w"));
fclose(fopen($dxr."_member_/list_".$no,"w"));
fclose(fopen($dxr."_member_/rp_".$no,"w"));
fclose(fopen($dxr."_member_/guest_".$no,"w"));
$fm=fopen($dxr."_member_/member_".$no,"w");
fputs($fm,"0\x1b0\x1b0\x1b100\x1b0\x1b0\x1b0\x1b0\x1b0\x1b0\x1b0\x1b0\x1b");fclose($fm);
$fpt = fopen($dxr."_member_/point_".$no,"w");
fputs($fpt,$time."\x1b100\x1b회원가입환영\n");fclose($fpt);
} /*-*/
else if($double == "name") scrhref('?',0,'아이디 중복 !!!'); /*--*/
else if($double == "nick") scrhref('?',0,'닉네임 중복 !!!'); /*--*/
} else scrhref('?',0,'아이디는 영문숫자15자 까지..'); /*---*/
}}} else if($mbr_level && $_POST['cnick'] && $_POST['cemail']) { /*-6-*/
usleepp($dim."@@");
$jdim = fopen($dim."@@","w");
$fim = fopen($dim,"r");
$fmfz = filesize($dim);
$xxx = '';
while(!feof($fim)) { /*-5-*/
$xxx = fgets($fim);
if(strlen($xxx) > 10) { /*-4-*/
if(trim(substr($xxx,5,15)) == $usrname && ($mbr_id == $usrname || $mbr_level == 9)) {
$fmfz -= strlen($xxx);
$okk = explode("\x1b", trim($xxx));
$pss = ($_POST['password2'])? md5(substr($okk[6],0,10).$_POST['password2']):substr($okk[0],20);
if($_POST['deletee'] == 'delete') { /*---*/
$mrno = (int)substr($okk[0],0,5);
if($mbr_level == 9 || !$sett[63]) {
@unlink($dxr."_member_/scrap_".$mrno);
@unlink($dxr."_member_/diary_".$mrno);
@unlink($dxr."_member_/list_".$mrno);
@unlink($dxr."_member_/rp_".$mrno);
@unlink($dxr."_member_/point_".$mrno);
@unlink($dxr."_member_/member_".$mrno);
@unlink($dxr."_member_/guest_".$mrno);
@unlink($dxr."_member_/logged_".$mrno);
@unlink("icon/m02_".$mrno);
@unlink("icon/m80_".$mrno);
@unlink("icon/m20_".$mrno);
$xxx = substr($xxx,0,5)."\n";
} else if($mbr_no == $mrno) {
$fmo = fopen($dmo,"a");
fputs($fmo, "01100001".$mbr_n5.$time."\x1b".$_SESSION['m_nick']."\x1b\x1b회원탈퇴 신청합니다.<br />회원아이디 : ".$mbr_id."<br />회원번호 : ".$mbr_no."\n");
fclose($fmo);
chmbr($mbr_no,4,1);
chmbr(1,5,1);
}
} else if(isset($_POST['level']) && $mbr_level == 9) { /*---*/
$xxx = substr($okk[0],0,20).$pss."\x1b".$_POST['cnick']."\x1b".$_POST['level']."\x1b".$_POST['cemail']."\x1b".$okk[4]."\x1b".$okk[5]."\x1b".$okk[6]."\x1b".$okk[7]."\x1b".(int)$okk[8]."\x1b".$okk[9]."\x1b".$okk[10]."\x1b".$okk[11]."\x1b".$okk[12]."\x1b".$okk[13]."\x1b".$okk[14]."\x1b".$okk[15]."\x1b".$okk[16]."\x1b\n";
} else if($mbr_level == 9 || $okk[3] == $_POST['cemail'] || ($sett[46] != 2 && $sett[46] != 3 && $_SESSION['rgstr'] == md5($uzip)) || $_SESSION[preg_replace("`[^0-9a-z]`i","",$_POST['cemail'])] = md5($_SERVER['REMOTE_ADDR'])) { /*---*/
$xxx = substr($okk[0],0,20).$pss."\x1b".$_POST['cnick']."\x1b".$okk[2]."\x1b".$_POST['cemail']."\x1b".$_POST['postaddr'].",".$_POST['addrplus']."\x1b".$_POST['cellnumber'][0]."-".$_POST['cellnumber'][1]."-".$_POST['cellnumber'][2]."\x1b".substr($okk[6],0,10).$_POST['birthday'][0].$_POST['birthday'][1].$_POST['birthday'][2]."\x1b".$_POST['addinfo']."\x1b".(int)$_POST['public_postaddr'].(int)$_POST['public_cellnumber'].(int)$_POST['public_birthday'].(int)$_POST['public_gender']."\x1b".$_POST['gender']."\x1b".$_POST['blog']."\x1b".$_POST['mlog1']."\x1b".$_POST['mlog2']."\x1b".$_POST['mlog3']."\x1b".$_POST['mlog4']."\x1b".$_POST['mlog5']."\x1b".$okk[16]."\x1b\n";
} /*---*/
$fmfz += strlen($xxx);
}} /*-4-*/
fputs($jdim, $xxx);
} /*-5-*/
fclose($fim);
fclose($jdim);
if($fmfz == filesize($dim."@@")) {copy($dim,$dim."_bk");copy($dim."@@", $dim);}
unlink($dim."@@");
if($mbr_id == $usrname) { /*-5-*/
if($_POST['deletee'] == 'delete') {
if($mbr_level == 9 || !$sett[63]) {
ssckdxl();
} else scrhref(0,0,'관리자에게 탈퇴 신청했습니다.');
} else if($_POST['cnick'] != $_SESSION['m_nick']) $_SESSION['m_nick'] = $_POST['cnick'];
}  /*-5-*/
} else { /*-6-*/
if(!$_POST['nick']) $okok = logincheck($usrname, $pssword);
if($okok[0]) { /*-5-*/
if($_SESSION['mk']) {
ssckdxl();
}
$mbr_no = substr($okok[0], 0, 5);
$logged = $dxr."_member_/logged_".(int)$mbr_no;
if($sett[74] || !file_exists($logged) || $autologged || $time - filemtime($logged) > 60) { /*-4-*/
if($_POST['autologin']) { /*---*/
$cool5 = md5($cook.$_POST['password_3']);
setcookie($cook, $cool5, $time+864000);
usleepp($dxr."_member_/autologin@@");
$jdat = fopen($dxr."_member_/autologin@@","w");
fputs($jdat, $cook.$mbr_no.$time.$cool5.$_POST['username_3']."\x1b".$_POST['password_3']."\n");
if(file_exists($dxr."_member_/autologin")) {
$ltime = $time - 864000;
$fat = fopen($dxr."_member_/autologin","r");
while(!feof($fat)) {
$xxx = fgets($fat);
if(substr($xxx,14,5) == $mbr_no || substr($xxx,19,10) < $ltime) $xxx = '';
fputs($jdat, $xxx);
}
fclose($fat);
}
fclose($jdat);
copy($dxr."_member_/autologin@@", $dxr."_member_/autologin");
unlink($dxr."_member_/autologin@@");
} /*---*/
$mk = substr(md5($session_id.$sett[14]),rand(1,25));
$_SESSION['mk'] = $mk;
$yid = md5($mk);
setcookie("mck", $yid);
$xid = md5($yid."\x1b".$mk);
$wid = "w".rand(1000,100000);
setcookie($xid, $wid);
$vid = "v".rand(10000,1000000);
$_SESSION[$wid] = $vid;
$mbr_no = (int)$mbr_no;
$_SESSION[$vid] = array($usrname,$mbr_no,$okok[2],$okok[16]);
$_SESSION['m_nick'] = $okok[1];
usleepp($dxr."attend.dat@@");
$fafz = filesize($dxr."attend.dat");
$vt = fopen($dxr."attend.dat@@","w");
$vp = fopen($dxr."attend.dat","r");
$tymd = date("Ymd");
$vpo = fgets($vp);
$fafz -= strlen($vpo);
if(substr($vpo, 0, 8) == $tymd) { /*---*/
if(false === strpos($vpo, "\x1b".$mbr_no."\x1b")) {
$vpo = trim($vpo).$mbr_no."\x1b\n";
$vok = 1;
} else $vok = 2;
} else { /*---*/
$vpo = $tymd."\x1b".$mbr_no."\x1b\n".$vpo;
$vok = 1;
} /*---*/
fputs($vt, $vpo);
$fafz += strlen($vpo);
while(!feof($vp)) {
fputs($vt, fgets($vp));
}
fclose($vp);
fclose($vt);
if($vok == 1) {
if($fafz == filesize($dxr."attend.dat@@")) {copy($dxr."attend.dat",$dxr."attend.dat_bk");copy($dxr."attend.dat@@", $dxr."attend.dat");}
chmbr($mbr_no, 2, 1);
}
unlink($dxr."attend.dat@@");
} else scrhref(0,0,'This is an ID that is already logged in'); /*-4-*/
}} /*-6-*/
scrhref($_POST['from'],0,0);
exit;
} /*-7-*/
function sendckmail($mail) {
global $sett, $time;
$sesmail = preg_replace("`[^0-9a-z]`i","",$mail);
$sesvalue = md5(md5($sett[14]).$mail.$_SERVER['REMOTE_ADDR'].$time);
$_SESSION[$sesmail] = $sesvalue;
$_SESSION['eaddr'] = $sesmail;
$set14 = substr($sett[14],7);
$set14 = substr($set14,0,strpos($set14,"/"));
$mailcont = "<div style='font-family:\"Malgun Gothic\";font-size:11pt;border:1px solid #ddd;padding:10px;line-height:160%'><div style='background:#f6f6f6;border:1px solid #ddd;padding:4px;margin-bottom:20px'><div style='background:#fff;padding:5px'>안녕하세요 <span style='font-size:12pt;color:#FF6633'>\"{$sett[0]}\"</span> ({$set14}) 입니다.</div></div><div style='background:#000;width:400px;padding:10px 20px 10px 20px;color:#fff' >인증코드 : <input style='width: 280px' value='{$sesvalue}' onclick='this.select()'></div>인증코드 입력하는 부분에 넣어주세요<br />본 메일은 발송전용 메일입니다.</div>";
$mailsent = mail($mail, "=?UTF-8?B?".base64_encode("\"".$sett[0]."\" 회원인증 메일입니다.")."?=\n", $mailcont, "MIME-Version: 1.0\r\nContent-type: text/html; charset=UTF-8\r\nFrom:admin<admin@{$set14}>\r\nReply-To: admin@{$set14}\r\nX-Mailer: PHP/".phpversion());
if($mailsent) $output = "
메일을 발송했습니다.<br />
메일 내용에 있는 인증코드를 입력하세요.<br /><br />
<div class='mother'>
<div style='background:#F9F9F9; width:50px'>인증코드</div><div style='width:180px; background:#FFF'><input type='text' name='ckemailaddr' style='width:150px' onblur='thtck=this;ischeck(1,1)' /></div><div style='width:40px;border-right-width:1px;background:#D7D7D7'><input type='button' style='width:40px;background:#D7D7D7;cursor:pointer' value='입력' /></div></div>";
else $output = "<span style='color:red'>인증 메일이 발송되지 않았습니다.</span>";
return $output;
}
function authentication($emailaddr) { /*-7-*/
global $dim;
if(trim($emailaddr) == $_SESSION[$_SESSION['eaddr']] && $_SESSION['eaddr'] == preg_replace("`[^0-9a-z]`i","",$_POST['email'])) {
if($_POST['fnumber']) {
$double = 2;
usleepp($dim."@@");
$jdim = fopen($dim."@@","w");
$fim = fopen($dim,"r");
$fmfz = filesize($dim);
while(!feof($fim)) {
$xxx = fgets($fim);
if(strlen($xxx) > 10) {
if($_POST['fnumber'] == substr($xxx,0,5)) {
$xxy = explode("\x1b",$xxx);
if($xxy[3] == $_POST['email']) {
$fmfz -= strlen($xxx);
$double = 1;
$psswrd = rand(100000,999999);
$xxx = substr($xxy[0],0,20).md5(substr($xxy[6],0,10).$psswrd).substr($xxx,52);
$fmfz += strlen($xxx);
}}}
fputs($jdim, $xxx);
}
fclose($fim);
fclose($jdim);
if($double == 1 && $fmfz == filesize($dim."@@")) {copy($dim,$dim."_bk");copy($dim."@@", $dim);}
unlink($dim."@@");
if($double == 1) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>메일인증 확인</title>
<style type='text/css'>
body {overflow:hidden; font-size:9pt}
div.mother {border:1px solid #DDDDDD; padding:20px; width:334px; height:37px; background:#FFF}
div.mother div {float:left; border:1px solid #DDDDDD; border-right-width:0; padding:10px; height:15px}
div.first {width:95px}
</style></head>
<body>
<div style='position:absolute;top:20px;left:0;padding-left:17px'>
로그인해서, 비밀번호를 바꾸세요.<br /><br />
<div class='mother' style='width:323px;height:74px'>
<div class='first'>회원아이디</div><div class='second' style='border-right:1px solid #DDDDDD'><input type='text' class='txt' value='<?php echo trim(substr($xxy[0],5,15))?>' /></div>
<div class='first'>임시비밀번호</div><div class='second' style='border-right:1px solid #DDDDDD'><input type='text' class='txt' value='<?php echo $psswrd?>' /></div></div>
</div>
</body>
</html>
<?php
}} else {
$_SESSION[$_SESSION['eaddr']] = md5($_SERVER['REMOTE_ADDR']);
$output = "<center><span style='color:black'>인증되었습니다.</span></center>";
}} else {$output = "<center><span style='color:red'>인증되지 않았습니다.</span></center>";if($_POST['fnumber']) echo $output;}
return $output;
} /*-7-*/
if($_POST['bkcdid']) { /*-7-*/
$mip = md5($_SERVER['REMOTE_ADDR']);
if(substr($_POST['bkcdid'],0,16) == substr($mip,0,16)) $value = explode(substr($mip,16),substr($_POST['bkcdid'],16));
$bkk = logincheck($value[1],$value[0]);
if($bkk[2] == '9' && $sett[37] && $_POST['bkcfolder'] == substr($dxr,5,-1)) {
$sndfldr = ($_POST['bkfrom'])? $_POST['bkfrom'].'/':$dxr;

echo "\xf7";
function dpfile($dpfl) {
global $sndfldr;
if(filesize($sndfldr.$dpfl) == 0) $dpv = '3';
else if($_POST['bkdpl'] == '2') $dpv = '1'.filesize($sndfldr.$dpfl).'|';
else if($_POST['bkdpl'] == '3') $dpv = '1'.filemtime($sndfldr.$dpfl).'|';
else $dpv = '1';
return $dpv.$dpfl;
}
if(!$_POST['bkfile']) {
function redr($bff,$accml) {
global $sndfldr;
$bf = opendir($sndfldr.$bff);
while($bfo = readdir($bf)) {
if($bfo != '.' && $bfo != '..') {
$dfo = $bff.$bfo;
if(is_file($sndfldr.$dfo)) $accml .= "\x1b".dpfile($dfo);
else {
echo "\x1b2".$dfo;
if($_POST['bksbdr']) $accml = redr($dfo.'/',$accml);
}}}
closedir($bf);
return $accml;
}
echo redr('','');
echo "\xf7";
} else {
if($fr = @fopen($sndfldr.$_POST['bkfile'],"r")) {
while(!feof($fr)) {echo fgets($fr);}
fclose($fr);
}}
echo "";
}
exit;
} else if($_POST['ckusername'] || $_POST['cknick'] || $_POST['ckemail'] || $_POST['ckemailaddr']) { /*-7-*/
if(false !== strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])) { /*-6-*/
header ("Content-Type: text/html; charset=UTF-8");
$_POST['cknick'] = urldecode($_POST['cknick']);
if($_POST['fndaddr']) login_failcnt(1);
if($_POST['ckemailaddr']) $rajax = authentication($_POST['ckemailaddr']);
else {
$okk = '';
$_POST['ckemail'] = urldecode($_POST['ckemail']);
if(!$_POST['ckemail'] || addrcheck($_POST['ckemail'])) {
if(!$_POST['ckusername'] || (strlen($_POST['ckusername']) <= 15 && preg_replace("`[0-9a-z_]`","",$_POST['ckusername']) == '')) {
if($fim = @fopen($dim,"r")) {
while(!feof($fim)) {
$xxx = trim(fgets($fim));
if($xxx) {
if($_POST['ckusername'] && trim(substr($xxx,5,15)) == $_POST['ckusername']) $okk = "아이디";
else if($_POST['cknick'] && strpos($xxx, "\x1b".$_POST['cknick']."\x1b") == 52) $okk = "닉네임";
else if($_POST['ckemail'] && strpos($xxx, "\x1b".$_POST['ckemail']."\x1b") > 54) {$okk = "이메일";if($_POST['fndaddr']) $fnumber = substr($xxx,0,5);}
if($okk) {
$rajax = "<span style='color:red'>이미 있는 {$okk}입니다.</span>";
break;
}}}
fclose($fim);
if($_POST['fndaddr']) {
if((int)$fnumber && $okk) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>인증코드 입력</title>
<style type='text/css'>
body {overflow:hidden; font-size:9pt}
div.mother {border:1px solid #DDDDDD; padding:20px; width:334px; height:37px; background:#FFF}
div.mother div {float:left; border:1px solid #DDDDDD; border-right-width:0; padding:10px; height:15px}
div.mother input {border:0; padding:0}
</style>
</head>
<body onload="if(eval(document.emafm.emailaddr)) document.emafm.emailaddr.focus();">
<script type='text/javascript'>
var thtck;
function ischeck() {
document.emafm.submit();
}
</script>
<form name='emafm' method='post' action='admin.php' style='position:absolute;top:20px;left:0;padding-left:17px' onsubmit="if(this.ckemailaddr.value=='') {alert('인증코드가 비었습니다.');return false;}">
<input type='hidden' name='email' value='<?php echo $_POST['ckemail']?>' /><input type='hidden' name='fnumber' value='<?php echo $fnumber?>' />
<?php echo sendckmail($_POST['ckemail'])?>
</form>
</body>
</html>
<?php
exit;
} else {$rajax = "<script type='text/javascript'>alert('이메일주소가 정확하지 않습니다. (".login_failcnt(2)."/{$sett[53]})');location.replace('admin.php?askaddr=1');</script>";}
} else if(!$okk) {
if(!$okk && $_POST['ckemail'] && ($sett[46] == $_POST['sett46'] || $sett[46] == 3)) {
if(addrcheck($_POST['ckemail'])) $rajax .= sendckmail($_POST['ckemail']);
else $rajax .= "<span style='color:red'>사용할 수 없는 이메일입니다.</span>";
} else $rajax .= "<span style='color:black'>사용 가능합니다.</span>";
}} else $rajax .= "<span style='color:black'>사용 가능합니다.</span>";} else $rajax .= "<span style='color:red'>아이디는 영문,숫자 15자 이내로.</span>";
} else $rajax .= "<span style='color:red'>사용할 수 없는 이메일입니다.</span>";
if($_POST['ckemail']) {
if(substr($rajax,19,5) == 'black') $_SESSION['rgstr'] = md5($uzip);
else if($_SESSION['rgstr']) $_SESSION['rgstr'] = '';
}
}
echo $rajax;
} exit; /*-6-*/
} else if(isset($_POST['sign'])) { /*-7-*/
if(false !== strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) && $mbr_no) {
$_POST['sign'] = str_replace("<?php ","",str_replace("?>","",stripslashes(urldecode($_POST['sign']))));
fputs($ss = fopen("icon/m02_".$mbr_no,"w"),$_POST['sign']);fclose($ss);
echo "success";
} exit;
} else if($_POST['ckewrpnotify']) { /*-7-*/
if(false !== strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) && $mbr_no) {
$mf = $dxr."_member_/notify_".$mbr_no;
if(@filesize($mf) == 1) {
if($_POST['ckewrpnotify'] == "a") fclose(fopen($mf,"w"));
} else if($_POST['ckewrpnotify'] == "b")  fputs($mfo = fopen($mf,"w"),"1");fclose($mfo);
echo "success";
} exit;
} else if($_POST['levelpoint'] || $_GET['levelpoint']) { /*-7-*/
$vlpoint = array();
if($_POST['levelpoint']) {
$fvd = fopen($dxr."point_level.dat","w");
$i = 0;
foreach($_POST['levelpoint'] as $lvpt) {
$vlpoint[] = array($_POST['olevel'][$i],$lvpt);
fputs($fvd,$_POST['olevel'][$i].$lvpt."\n");
$i++;
}
fclose($fvd);
}
usleepp($dim."@@");
if($_POST['levelpoint']) {$jdim = fopen($dim."@@","w");$pnum = 1;}
else {$jdim = fopen($dim."@@","a");;$pnum = $_GET['levelpoint'];}
$start = ($pnum - 1)*100;
$stop = $start + 100;
$fim = fopen($dim,"r");
$xxx = '';
$y = 0;$nextp = 0;
while(!feof($fim)) {
$xxx = fgets($fim);
if($y < $stop) {
if($y >= $start) {
if(strlen($xxx) > 10) {
$okk = explode("\x1b",trim($xxx));
$mbf = $dxr."_member_/member_".(int)substr($okk[0],0,5);
if($mbff = @fopen($mbf,"r")) {
$jno = explode("\x1b",fgets($mbff));
fclose($mbff);
$znt = findptlevel($jno,$okk[2],$vlpoint);
if(!!$znt) {
$mbff = fopen($mbf,"w");
fputs($mbff,$jno[0]."\x1b".$jno[1]."\x1b".$jno[2]."\x1b".$jno[3]."\x1b".$jno[4]."\x1b".$jno[5]."\x1b".$jno[6]."\x1b".$jno[7]."\x1b".$jno[8]."\x1b".$jno[9]."\x1b".$jno[10]."\x1b".$jno[11]."\x1b".$jno[12]."\x1b".$jno[13]."\x1b".$znt[1]."\x1b");
fclose($mbff);
$xxx = $okk[0]."\x1b".$okk[1]."\x1b".$znt[2]."\x1b".$okk[3]."\x1b".$okk[4]."\x1b".$okk[5]."\x1b".$okk[6]."\x1b".$okk[7]."\x1b".$okk[8]."\x1b".$okk[9]."\x1b".$okk[10]."\x1b".$okk[11]."\x1b".$okk[12]."\x1b".$okk[13]."\x1b".$okk[14]."\x1b".$okk[15]."\x1b".$znt[0]."\x1b\n";
}}}
fputs($jdim, $xxx);
}
} else $nextp = $pnum + 1;
$y++;
}
fclose($fim);
fclose($jdim);
if($nextp) scrhref('?levelpoint='.$nextp,0,0);
else {
copy($dim,$dim."_bk_levelpoint");copy($dim."@@", $dim);
unlink($dim."@@");
scrhref('?pointlevel=1',0,0);
}
exit;
} else { /*-7-*/
include("include/admin_2.php");
} /*-7-*/
?>
<iframe name='exe' style='display:none;width:1px;height:1px'></iframe>
</body>
</html>