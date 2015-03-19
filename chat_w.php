<?php
@session_start();
//error_reporting(E_ERROR);
/*
 * srchat 219.48 -srboard 대문위젯/좌우메뉴용
 * Developed By 사리 (sariputra3@naver.com)
 * License : GNU Public License (GPL)
 * Homepage : http://srboard.styx.kr/srboard/index.php?id=blog&ct=06
 */
$chat = "chat_w.php";
$self = $chat;
$chtdate = "chat/srchat_cht/"; //데이타파일 저장경로(권한777)
$chtlastgap = 10; // 단위는 초, 접속여부 판단하는 현재시간-마지막접속시간 간격
$chticodir = "icon/emoticon"; // 이모티콘 저장된 경로
$chtmid = "icon/srchat.swf"; // 알림음 파일경로
$chthideadm = 0; // 관리자 감춤 (0: 사용 안 함, 1: 사용, -1: 관리자 기능으로 설정)
$chtmkadmin = 0; // 관리자 기능에서 IP로 관리자 지정 (0: 사용 안 함, -1: 관리자 기능으로 설정)
$chtrfrr = 0; // 채팅방 삽입주소에 따른 별도 설정 (0: 사용 안 함, 1:사용)
$time = time();
$cht_isadmin = 0;
$cht_ismbr = 0;
$delmip = 0;
$chtfid = '';
$chtnck = '';
$array = array('HTTP_REFERER','HTTP_HOST','HTTP_USER_AGENT','PHP_SELF','REMOTE_ADDR');
foreach($array as $spg) {if(!isset($_SERVER[$spg])) $_SERVER[$spg] = '';}
$chtip = str_pad(str_replace('.','',$_SERVER['REMOTE_ADDR']),12,'x'); /* ip로 사용자구분 할때 */
//$chtip = substr(session_id(),0,12); /* ip로 사용자구분 안할때 */
$chthis = date("mdHis",$time).$chtip;
$array = array('chtid','tt','content','neme','nn','ff','rr','delf','frombk','install');
foreach($array as $spg) {if(!isset($_POST[$spg])) $_POST[$spg] = '';}
if(!$_POST['tt']) {$array = array('chtid','js','v','view','down','mkcht','xbk','admin','css');
foreach($array as $spg) {if(!isset($_GET[$spg])) $_GET[$spg] = '';}}
$array = array('chtmobile','chtnick','cht_out','cht_sty4','srchatsv','mk','m_nick');
foreach($array as $spg) {if(!isset($_SESSION[$spg])) $_SESSION[$spg] = '';}
if(!isset($_COOKIE['mck'])) $_COOKIE['mck'] = '';
if($_SESSION['chtmobile']) $chtmbilew = "1";else $chtmbilew = "0";
if($_SESSION['srchatsv']) {
if(!$_SESSION['mk'] || $_COOKIE['mck'] != md5($_SESSION['mk'])) {unset($_SESSION['srchatsv']);unset($_SESSION['chtnick']);$delmip = 1;}
else {
list($level,$imgm) = $_SESSION['srchatsv'];
if($level == 9) {$cht_isadmin = 2;$chtmbilew .= "2";} //관리자구분
else $chtmbilew .= "1";
$cht_ismbr = 1;
$chtnck = $_SESSION['m_nick'];
$_SESSION['chtnick'] = $chtnck;
$chtnckk = $chtmbilew.$imgm."\x1a".$level."\x1a".$chtnck;
}} else {
$chtmbilew .= "0";
$chtnck = $_SESSION['chtnick'];
$chtnckk = $chtmbilew.$chtnck;
}
$chtexit = (isset($_SERVER['HTTP_REFERER']) && false === strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))? '':'1';
function cht_vnmb($view) {
$fff = '';
if($ff = @opendir($view)) {
while($fg = readdir($ff)) {
if($fg != '.' && $fg != '..') {$fff = $fg;break;}
}
closedir($ff);
}
return $fff;
}
function cht_mkroom($chtyd) {
mkdir($chtyd, 0777);
mkdir($chtyd."/_data", 0777);
mkdir($chtyd."/_gst", 0777);
mkdir($chtyd."/_ban", 0777);
mkdir($chtyd."/_upload", 0777);
mkdir($chtyd."/_gst/wt", 0777);
fclose(fopen($chtyd."/_bak","w"));
fclose(fopen($chtyd."/_gst/_guest","w"));
fclose(fopen($chtyd."/_gst/m_","w"));
fclose(fopen($chtyd."/_gst/gv","w"));
fclose(fopen($chtyd."/_gst/wt/000","w"));
$fpa = fopen($chtyd."/.htaccess","w");
fputs($fpa,"order deny,allow\ndeny from all");
fclose($fpa);
$ftb = fopen($chtyd."/_chtntb","w");
fputs($ftb, "2\n0\n80\n2\n4\n0\n");
fclose($ftb);
$ftc = fopen($chtyd."/_chtntc","w");
fputs($ftc, "1\nGulim\n9\n1\nN\n1\n1\n30\n0\n0\n400px\n350px\nv\n84%\n16%\n1\n1\n4\n0\n0\n1\n0\n0\n1500\n1\n11\n2\n0\n0\n1\n1\n2\n3\n2500\n3\n1\n1\n30\n0\n0\n1\n10\n0\n0\n2\n0\n1\n0\n0,top,,left,,\n0,top,,left,,\n\n0\n60\n50\n00\n020\n");
fclose($ftc);
$fs = fopen($chtyd."/_fsum","w");fputs($fs,"0\n0\n0");fclose($fs);
}
function chtrmfd($dirName,$n) {
$dirName = urldecode($dirName);
if(is_dir($dirName)) {
if(substr($dirName, -1) != "/") $dirName .= "/";
$d = opendir($dirName);
while($entry = readdir($d)) {
if($entry != "." && $entry != "..") {
if(is_dir($dirName.$entry)) chtrmfd($dirName.$entry,$n);
else @unlink($dirName.$entry);
}
}
closedir($d);
if($n) @RmDir($dirName);
}
}
if(!isset($chtid) || !$chtid) {if($_POST['chtid']) $chtid = $_POST['chtid'];else if($_GET['chtid']) $chtid = $_GET['chtid'];else $chtid = '';}
if(($chtdata = cht_vnmb($chtdate)) && $chtid) {
$chtfid = $chtdate.$chtdata."/".$chtid."/";
if(!file_exists($chtfid)) $chtfid = '';
$chtxwd = $chtfid."_xword"; // 금지된 표현
//$chtxnk = $chtfid."_xnick"; // 금지닉네임
if($chtfid) {
$chtdt = $chtfid."_data/";
$chtbk = $chtfid."_bak";
$chtgt = $chtfid."_gst/_guest";
$chtwt = $chtfid."_gst/wt/";
$chtmip = $chtfid."_gst/m_";
if($delmip) @unlink($chtmip.$chtip);
$chtup = $chtfid."_upload/";
$dsm = $chtfid."_fsum";
if(!$cht_isadmin && $chtmkadmin == -1 && file_exists($chtfid."adm_".$chtip)) {$cht_isadmin = 1;$chtnckk = $chtnckk[0]."2".substr($chtnckk,2);}
$dwv = cht_vnmb($chtwt);
function writee($dwn,$mema) {
 global $chtbk, $chtwt, $chtdt;
$ndwv = $dwn%499 + 1;
$ndwv = str_pad($ndwv,3,'0',STR_PAD_LEFT);
if(!@rename($chtwt.$dwn, $chtwt.$ndwv)) {unlink($chtwt.$dwn);fclose(fopen($chtwt.$ndwv,"w"));}
$fp = fopen($chtdt.$ndwv,"w");
fputs($fp,$mema);
fclose($fp);
if($mema[0] != "\x1b") {
$bk=fopen($chtbk,"a");
fputs($bk,$mema."\x1b".$ndwv."\n");
fclose($bk);
}
return $ndwv;
}
function whisp($rno) {
 global $chtip, $chtdt;
$rnn = str_pad($rno,3,'0',STR_PAD_LEFT);
$dtt = '';
if($fsz = @filesize($chtdt.$rnn)) {
$fp = fopen($chtdt.$rnn,"r");
$fpo = fread($fp,$fsz);
fclose($fp);
if(substr($fpo, 0, 2) == "\x1b\x1b") {
if(substr($fpo,2,12) == $chtip || substr($fpo,14,12) == $chtip)  $dtt = substr($fpo,26)."\x1b".$rnn."\x18";
} else $dtt = $fpo."\x1b".$rnn."\x18";
}
return $dtt;
}
function reaad_2($i,$wstrt,$wtend,$wtrt) {
$rtm = whisp($i);
$rtk = "\x1b";
if($_POST['tt'] == 'a' && $wstrt != 0 && $rtm[0] == "\x1b") {
while($rtk[0] == "\x1b") {
$wstrt = ($wstrt > 1)? $wstrt - 1:499;
if($wstrt <= $wtend && $wstrt >= $wtrt) {$wstrt = 0;break;}
$rtk = whisp($wstrt);
}}
if($rtk == "\x1b" || $rtk[0] == "\x1b") $rtk = "";
return array($rtm,$rtk,$wstrt);
}
function reaad($wtend,$rde) {
$rtn = '';
$rrtn = '';
$wstrt = $rde + 1;
$wtrt = $wstrt;
if($wtend > $rde) {
for($i = $wtrt;$i <= $wtend;$i++) {list($rtm,$rtk,$wstrt) = reaad_2($i,$wstrt,$wtend,$wtrt);$rtn .= $rtm;$rrtn = $rtk.$rrtn;}
} else {
if($rde < 499) {for($i = $wtrt;$i <= 499;$i++) {list($rtm,$rtk,$wstrt) = reaad_2($i,$wstrt,$wtrt,$wtend);$rtn .= $rtm;$rrtn = $rtk.$rrtn;}}
for($i = 1;$i <= $wtend;$i++) {list($rtm,$rtk,$wstrt) = reaad_2($i,$wstrt,$wtrt,$wtend);$rtn .= $rtm;$rrtn = $rtk.$rrtn;}
}
return $rrtn.$rtn;
}
function newtext($text) {
if($text) {
$text = stripslashes($text);
$text = preg_replace("`[\x1b\x18\x7f\t]`", "", $text);
$text = str_replace("<", "&lt;", $text);
$text = str_replace(">", "&gt;", $text);
}
return trim($text);
}
function guestt($hp,$gp) {
global $chtgt, $dwv, $chthis;
while(file_exists($chtgt."_tmp")) {usleep(5000);}
$fg = fopen($chtgt,"r");
$fmp = fopen($chtgt."_tmp","w");
while($fgo = fgets($fg)) {
if(substr($fgo,0,12) == $hp) {
if($gp > 2) {
if($gp === 4) $fgo = substr($fgo,0,13)."1".substr($fgo,14);
else if($gp === 5) $fgo = substr($fgo,0,13)."0".substr($fgo,14);
else if($gp === 3) $fgo = substr($fgo,0,12).((substr($fgo,12,1) == "1")? "0":"1").substr($fgo,13);
fputs($fmp,$fgo);
writee($dwv,"\x1b<%>".$gp."\x1b".substr($chthis,0,10).$hp."\x1b".(int)substr($fgo,14,2)."\x1b");
}} else fputs($fmp,$fgo);
}
fclose($fg);
fclose($fmp);
copy($chtgt."_tmp",$chtgt);
@unlink($chtgt."_tmp");
}
function rtname($val) {
$val = substr($val,16,-1);
return $val;
}
if($_POST['tt']) {
// 1.내부데이타처리 시작
@header("Content-Type: text/html; charset=UTF-8");
@header("Expires: 0");
@header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
@header("Cache-Control: no-cache, must-revalidate");
@header("Pragma: no-cache");
$mdd = 0;
if($_POST['tt'] == 'number') {
if($chthideadm === -1 && file_exists($chtfid."_hideadm")) $chthideadm = 1;
$v = 0;
if($fg = fopen($chtgt,"r")) {
$meo = '';
while($fgo = fgets($fg)) {
if($chthideadm !== 1 || substr($fgo,17,1) != '2') {
$fgdo = substr($fgo,0,12);
if($fgdo == $chtip || $time - @filemtime($chtmip.$fgdo) > $chtlastgap) {@unlink($chtmip.$fgdo);$mdd = 1;writee($dwv,"\x1b".rtname($fgo).">>\x1b".substr($chthis,0,10).$fgdo."\x1b");
} else {$v++;$meo .= $fgo;}
}}
fclose($fg);
if($mdd) {
$fg = fopen($chtgt,"w");
fputs($fg,$meo);
fclose($fg);
}
echo $v;
}
exit;
}
if($_POST['content'] == '7579a584' || $_POST['tt'] == 'a') {
if($_SESSION['cht_out'] == $chtid) unset($_SESSION['cht_out']);
if($_POST['content'] == '7579a584') $_POST['content'] = '';
} else if($_POST['content'] && substr($_POST['content'],1) == "579a584") {
if($_POST['content'] == "6579a584") {
guestt($chtip,3);
} else if($_POST['content'] == "8579a584" || $_POST['content'] == "9579a584") { // 퇴장할때 실행되는
$chtrmf = 0;
if($_POST['content'] == "8579a584") $_SESSION['cht_out'] = $chtid;
if(substr($chtid,0,2) == '__') {
if($fg = @fopen($chtgt,'r')) {
if(trim(fgets($fg)) == '' || trim(fgets($fg)) == '') $chtrmf = 1;
fclose($fg);
} else $chtrmf = 1;}
if($chtrmf) {chtrmfd($chtfid,1);exit;} else {
guestt($chtip,1);
if($chthideadm === 0 || $cht_isadmin == 0 || ($chthideadm === -1 && !file_exists($chtfid."_hideadm"))) $dwv = writee($dwv,"\x1b".$chtnckk.">>\x1b".$chthis."\x1b");
@unlink($chtmip.$chtip);
}}
exit;
}
$mdd = 0;
$vv = 0;
if($_POST['neme']){
if(!$cht_ismbr && $chtnck != $_POST['neme']){ // 닉변경되었으면
if($_POST['neme'] = newtext($_POST['neme'])) {
if($chtnck != '') {
if($fg = fopen($chtgt,"r")) {
while(!feof($fg)) {if(substr(fgets($fg),18,-1) == $_POST['neme']) {$vv = 1; break;}} // 닉네임중복검사
fclose($fg);
}}
if($chtnck == '' || !$vv) {
if($_SESSION['chtnick'] && $_POST['nn']) $dwv = writee($dwv,"\x1b".$chtnck."<>".$_POST['neme']."\x1b".$chthis."\x1b");
$chtnck = $_POST['neme'];
$chtnckk = $chtmbilew.$_POST['neme'];
$_SESSION['chtnick'] = $_POST['neme'];
$mdd = 2;
$egv = $time;
}}}}
if($_POST['ff'] && $_POST['ff'] != $_SESSION['cht_sty4']) {$_SESSION['cht_sty4'] = $_POST['ff'];$mdd = 1;}
else if(!$_SESSION['cht_sty4']) $_SESSION['cht_sty4'] = '00';
if(file_exists($chtmip.$chtip)) {
$fnt = fopen($chtmip.$chtip,"r");
$dgx = fgets($fnt);
$red = (int)substr($dgx,0,3);
if(!$red && $_POST['rd']) $red = (int)$_POST['rd'];
$dgx = substr($dgx,3,10);
fclose($fnt);
$egg = filemtime($chtmip.$chtip);
} else {if($_POST['rd']) $red = (int)$_POST['rd'];else $red = 1;$egg = 0;$dgx = 0;}
$meo = "";
if(!isset($egv)) $egv = filemtime($chtgt);
if($_POST['tt'] == 'a' || $_POST['tt'] == 'x' || $mdd || $dgx < $egv) { // 방문자목록처리
if(file_exists($chtfid."_ban/".$chtip)) {echo "\x7f\x1b<%>b".$chtnck."\x1b".$chthis."\x1b\x1b\x1b\x18";exit;}
if($_POST['tt'] == 'a') {$chtread = (int)$_POST['rr'];if($chtread > 499 || $chtread < 0) $chtread = 10;$dgx = 0;}
if($chthideadm === -1 && file_exists($chtfid."_hideadm")) $chthideadm = 1;
$is = 0;
$vv = 1;
$fg = fopen($chtgt,"a+");
while($fgo = fgets($fg)) {
if($chthideadm !== 1 || substr($fgo,17,1) != '2') {
$fgdo = substr($fgo,0,12);
if($fgdo == $chtip) {
$is = 1;
if($fgo[12] == '1' && $_POST['content']) {$fgo[12] = '0';$mdd = 1;}
$meo .= $chtip.$fgo[12].$fgo[13].$_SESSION['cht_sty4'].$chtnckk."\n";if($mdd != 2 && substr($fgo,16,-1) != $chtnckk) {$mdd = 1;$dwv = writee($dwv,"\x1b".((substr($fgo,17,1) != "0")? substr($fgo,strrpos($fgo,"\x1a") + 1,-1):substr($fgo,18,-1))."<>".$chtnck."\x1b".$chthis."\x1b");}
} else if($time - @filemtime($chtmip.$fgdo) > $chtlastgap) {@unlink($chtmip.$fgdo);$mdd = 1;$dwv = writee($dwv,"\x1b".rtname($fgo).">>\x1b".substr($chthis,0,10).$fgdo."\x1b");}
else $meo .= $fgo;
}}
fclose($fg);
if($chthideadm === 1 && $cht_isadmin) $is = 1;
if($is != 1 && $chtnck) {
$meo .= $chtip."0".(file_exists($chtfid."_ban/dumb_".$chtip)? "1":"0").$_SESSION['cht_sty4'].$chtnckk."\n";
$dwv = writee($dwv,"\x1b".$chtnckk."<<\x1b".$chthis."\x1b".$_SESSION['cht_sty4']);
}
if($_POST['tt'] == 'a') echo str_replace("\n","\x18",$meo);
if(!$is || $mdd) {
$fg = fopen($chtgt,"w");
fputs($fg,$meo);
fclose($fg);
}
}
$memo = '';
if($chtnck && $_POST['content']) { // 새글처리
if(file_exists($chtfid."_ban/dumb_".$chtip)) exit;
$_POST['content'] = newtext($_POST['content']);
if($_POST['content']) {
if(strpos($_POST['content'],'//whisper//') !== false) {
$wpcnt = explode('//whisper//',$_POST['content']);
$wpnk = substr($wpcnt[0],12);
$wwip = substr($wpcnt[0],0,12);
if($wpcnt[1] == '11chat') {
if(isset($wpcnt[2])) {
if($wpcnt[2] == 'yy') {$dwv = writee($dwv,"\x1b\x1b".$chtip.$chtip."\x1b<c><x>".$wpnk."\x1b".$chthis."\x1b");$memo = "\x1b\x1b".$wwip.$wwip."\x1b<h><x>".$chtnck."\x1b".$chthis."\x1b";}
else if($wpcnt[2] == 'xx') $memo = "\x1b\x1b".$wwip.$wwip."\x1b<r><x>".$wpnk."<>".$chtnck."\x1b".$chthis."\x1b";
else $memo = "\x1b\x1b".$wwip.$wwip."\x1b<p><x>".$wpnk."<>".$chtnck."<>".$wpcnt[2]."\x1b".$chthis."\x1b";
} else {
$dwv = writee($dwv,"\x1b\x1b".$chtip.$chtip."\x1b<t><x>".$wpnk."\x1b".$chthis."\x1b");
$chtyd = substr(md5($wwip),8,16);
$memo = "\x1b\x1b".$wwip.$wwip."\x1b<q><x><h>".$wpnk."<>".$chtnck."<>".$chtyd."<>".$chtip."\x1b".$chthis."\x1b";
}} else $memo= "\x1b\x1b".$chtip.$wwip."\x1b<w>".$wpnk."<>".$chtnck."<>".$wpcnt[1]."\x1b".$chthis."\x1b";
} else {
if($_POST['content'][0] == '(' && $_POST['content'][2] == ')') {
$pcontent = $_POST['content'];
$head = '';
while($pcontent[0] == '(' && $pcontent[2] == ')') {
$biu = $pcontent[1];
if($biu == 'b' || $biu == 'i' || $biu == 'u') {$head .= "<{$biu}>";$pcontent = substr($pcontent,3);}
else break;
}
$_POST['content'] = $head.$pcontent.str_replace('<','</',$head);
}
$memo = $chtnckk."\x1b".$_POST['content']."\x1b".$chthis."\x1b".(int)$_POST['ff'];
}}}
if($memo) $dwv = writee($dwv,$memo);
$dww = (int)$dwv;
if($vv || $red != $dww || $time - $egg > 4){
$mnt = fopen($chtmip.$chtip,"w");
fputs($mnt,$dwv.$egv);
fclose($mnt);
}
$dwv = $dww;
echo "\x7f";
if($_POST['tt'] == 'a') {
$rc = 0;
$echor = array();
if(@filesize($chtbk) < 150*$chtread && file_exists($chtbk."2")) {
$fp = fopen($chtbk."2","r");
while($fpo = trim(fgets($fp))) {
if($fpo[0] != "\x1b") {
$echor[] = $fpo;$rc++;
if($rc > $chtread) $echor = array_slice($echor,1);
}}
fclose($fp);
$rc = count($echor);
}
$fp = fopen($chtbk,"r");
while($fpo = trim(fgets($fp))) {
if($fpo[0] != "\x1b") {
$echor[] = $fpo;$rc++;
if($rc > $chtread) $echor = array_slice($echor,1);
}}
fclose($fp);
$echor = array_slice($echor,-$chtread);
foreach($echor as $echos) echo $echos."\x18";
} else if($red <> $dwv) echo reaad($dwv,$red); // 새글읽기
exit;
// 1.내부데이타처리 끝
} // if($_POST['tt'])
if(file_exists($chtfid."_ban/".$chtip)) {$chtexit = 'exit';?><h1>접속차단되셨습니다</h1><?php }
$exxt = array('_GET','_POST','_SESSION','_COOKIE','_FILES','_SERVER','sessid','isadmin');
for($i=0;$i < 8;$i++) if(isset($_GET[$exxt[$i]]) || isset($_POST[$exxt[$i]])) exit;
$server_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
$sbot=array('bot','yahoo! slurp','daumoa','twiceler','yeti','bingpreview','baiduspider','crawler');
for($i=0;$i < 8;$i++) {
if(strpos($server_user_agent,$sbot[$i]) !== false) {$chtfid = '';$_GET['js'] = '';$_GET['v'] = '';$chtexit = 'exit';}
}
$chtisie6 = 0;
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'iPhone') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'iPod') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'iPad')) $chtismobile = 3;
else if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'Mobile') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'SAMSUNG') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'LG') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Windows CE') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'/CLDC-') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Nokia') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'POLAR') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Skyfire')) $chtismobile = 2;
else {
$chtismobile = 0;
if(substr($_SERVER['HTTP_USER_AGENT'],25,6) == 'MSIE 6') $chtisie6 = 3;
}
$chtiswin = (false !== strpos($_SERVER['HTTP_USER_AGENT'],'Windows'))? 1:0;
function referr($val) {
global $self;
if(!$val || strpos($val,$self) !== false) $val = '';
else {
if(($vale = substr($val,-1)) == '/' || $vale == '?' || $vale == '&') $val = substr($val,0,-1);
$end = strrpos($val,'/');if($end) $val = substr($val,$end+1);
$end = strpos($val,'?');if($end) $val = substr($val,$end+1);
$end = strpos($val,'&');if($end) $val = substr($val,0,$end);
$end = strpos($val,'#');if($end) $val = substr($val,0,$end);
$val = preg_replace("`[^A-z0-9_]`i","",$val);
}
return $val;
}
if(!$chtrfrr) $rfrr = '';else $rfrr = (isset($_REQUEST['rfrr'])? $_REQUEST['rfrr']:(isset($_SERVER['HTTP_REFERER'])? referr($_SERVER['HTTP_REFERER']):''));
function ufiledell($fife) {
global $chtup, $cht_isadmin;
$return = 0;
if($cht_isadmin) {
$fife = $chtup.str_replace("^","",str_replace("/","",$fife));
if(file_exists($fife)) {
if(unlink($fife)) $return = 1;
$fmee = substr($fife,0,-4)."_s.jpg";
if(file_exists($fmee)) unlink($fmee);
}}
return $return;
}
function utxtdell($dtxt) {
if(substr($dtxt,0,3) == '<f>' && ($ffe = strpos($dtxt,"<>"))) {
ufiledell(substr($dtxt,6,$ffe - 6));
}}
if($_POST['delf'] || ($_GET['chtid'] && ($_GET['view'] || $_GET['down']))) {
// 2.업로드파일출력 시작
if($_POST['delf']) $gfile = $_POST['delf'];
else $gfile = ($_GET['view'])? $_GET['view']:$_GET['down'];
if($_GET['down'] == '_backup_.txt' && !$cht_isadmin) exit;
$filee = $chtup.str_replace("^","",str_replace("/","",$gfile));
if($_POST['delf']) {if(ufiledell($gfile)) {unlink($filee);$fmee = substr($filee,0,-4)."_s.jpg";if(file_exists($fmee)) unlink($fmee);echo "<script>alert('success');";if(!$_POST['frombk']) echo "location.replace('{$chat}?chtid={$chtid}&v=ban');";echo "</script>";}}
else {
$gfile = urldecode(str_replace("^","%",str_replace("/","",$gfile)));
if(strchr($_SERVER['HTTP_USER_AGENT'],"MSIE")) $gfile = iconv("UTF-8","euc-kr",$gfile);
if(file_exists($filee) && $chtnck){
if($_GET['view']) $ext = strtolower(substr($gfile,-4));else $ext = '';
if($ext=='.jpg' || $ext=='.gif' || $ext=='.png' || $ext=='.bmp'){
@header("Content-type:image/jpeg; charset=UTF-8");
@header("Content-Disposition: inline; filename=\"$gfile\"");
} else {
@header("Content-Type: applicaiton/octet-stream; charset=UTF-8");
@header("Content-Disposition:attachment; filename=\"$gfile\"");
}
@header("Content-Transfer-Encoding: binary");
@header("Content-Length: ".@filesize($filee));
@readfile($filee);
} else {
if($_GET['view']) {
@header("Content-type:image/png");
if($im = @imagecreate(100, 60)) {
imagecolorallocate($im,255,255,255);
$text_color = imagecolorallocate($im,0,0,0);
imagestring($im,5,15,20,"no image", $text_color);
imagepng($im);
imagedestroy($im);
}} else {
@header("Content-Type: text/html; charset=UTF-8");
echo "<h1>파일이 없습니다..</h1>";
}}}
exit;
// 2.업로드파일출력 끝
}
$isdid = 0;
// 3.외부출력 시작
if($rfrr && $_GET['v'] == 'ban'){if(file_exists($chtfid."_chtntc") && !file_exists($chtfid.$rfrr."_chtntc")) {copy($chtfid."_chtntc",$chtfid.$rfrr."_chtntc");copy($chtfid."_chtntb",$chtfid.$rfrr."_chtntb");}}
if($ftb = @fopen($chtfid.$rfrr."_chtntb","r")) {
$chtuimg = (int)fgets($ftb);
$chtvban = (int)fgets($ftb);
$chtvimg = (int)fgets($ftb);
$chtufile = (int)fgets($ftb);
$chtpnck = (int)fgets($ftb);
$chtiimg = (int)fgets($ftb);
fclose($ftb);
if(@is_dir($chtup)) $isdid = 1;
if($_POST['install'] == '1' || $_GET['v'] == 'ban' || isset($_FILES['file'])) {
if(file_exists($dsm) && $fd = fopen($dsm,"r")) {
$isdsm = (int)fgets($fd);
$isusm = (int)fgets($fd);
$isfsm = (int)fgets($fd);
fclose($fd);
}}}
if($cht_isadmin) {
$array = array('dxno','backup','chat_txt','empty','upload_delete','delcht','prhd','xword','mkadm','ban','nick','xbak','torf','dnox');
foreach($array as $spg) {if(!isset($_POST[$spg])) $_POST[$spg] = '';}
if($_POST['dxno']) {
$_POST['dxno'] = str_pad($_POST['dxno'],3,0,STR_PAD_LEFT);
$fkk = $chtdt.$_POST['dxno'];
if($fk = @fopen($fkk,"r")) {
$fko = fgets($fk);
$fke = explode("\x1b",$fko);
utxtdell($fke[1]);
fclose($fk);
fclose(fopen($fkk,"w"));
$fko = "\x1b{$_POST['dxno']}\n";
$bk = fopen($chtbk,"r");
$bkk = fopen($chtbk."@@","w");
while($memo = fgets($bk)) {
if(substr($memo,-5) != $fko) fputs($bkk,$memo);
}
fclose($bk);
fclose($bkk);
copy($chtbk."@@",$chtbk);
unlink($chtbk."@@");
if($fke[1] == '' && $fke[0] == '') writee($dwv,"\x1b<%>cx".$fke[4].$_POST['dxno']."\x1b".$chthis."\x1b");
else writee($dwv,"\x1b<%>cx".$fke[2].$_POST['dxno']."\x1b".$chthis."\x1b");
}
echo "<script>location.replace('?chtid={$chtid}&v=ban');</script>";
exit;
}
if($_POST['install'] == '1') {
// 3.4.관리자 로그인/로그아웃처리 시작
if($_POST['backup'] == 'reset') {
if(copy($chtbk,$chtbk."2")) fclose(fopen($chtbk,"w"));
fclose(fopen($chtup."_backup_.txt","w"));
} else if($_POST['delrfrr'] == 'delrfrr') {
if($d = opendir($chtfid)) {
while($entry = readdir($d)) {
if(strpos($entry,'_chtntc') || strpos($entry,'_chtntb')) {if(!$rfrr || ($efrr = strpos($entry,$rfrr.'_chtnt')) === false || $efrr) unlink($chtfid.$entry);}
} closedir($d);
}} else if($_POST['chat_txt'] == 'empty') {
fclose(fopen($chtbk,"w"));@unlink($chtbk."2");
chtrmfd($chtfid."_data/",0);
chtrmfd($chtfid."_gst/",0);
fclose(fopen($chtfid."_gst/gv","w"));
fclose(fopen($chtfid."_gst/wt/00","w"));
} else if($_POST['empty'] == 'empty') {
fclose(fopen($chtbk,"w"));@unlink($chtbk."2");
fclose(fopen($chtup."_backup_.txt","w"));
chtrmfd($chtfid."_data/",0);
chtrmfd($chtfid."_gst/",0);
fclose(fopen($chtfid."_gst/gv","w"));
chtrmfd($chtfid."_ban/",0);
chtrmfd($chtfid."_upload/",0);
$fs = fopen($dsm,"w");
fputs($fs,$isdsm."\n0\n0");
fclose($fs);
fclose(fopen($chtfid."_gst/wt/00","w"));
} else if($_POST['upload_delete']) {
@copy($chtup."_backup_.txt",$chtfid."_backup_.txt");
$fs = fopen($dsm,"w");fputs($fs,$isdsm."\n0\n0");fclose($fs);
chtrmfd($chtup,0);
@rename($chtfid."_backup_.txt",$chtup."_backup_.txt");
} else if($_POST['delcht']) {
chtrmfd($chtdate.$chtdata."/".$_POST['delcht'],1);
} else {
if(file_exists($chtfid."_ban/")) {
$ff = opendir($chtfid."_ban/");
while($fff = readdir($ff)) {
if($fff != '.' && $fff != '..') {if(!in_array($fff,$_POST['prhd'])) unlink($chtfid."_ban/".$fff);
}}
closedir($ff);
}
$fph = fopen($chtxwd, "w");
$cnt = count($_POST['xword']);
for($i = 0; $i < $cnt; $i++) if($_POST['xword'][$i]) fputs($fph, $_POST['xword'][$i]."\n");
fclose($fph);
if($cht_isadmin == 2) {
$ff = opendir($chtfid);
while($fff = readdir($ff)) {
if($fff != '.' && $fff != '..' && substr($fff,0,4) == 'adm_') {if(!in_array($fff,$_POST['mkadm'])) unlink($chtfid.$fff);
}}
closedir($ff);
if(isset($_POST['chtrefresh_'])) {
$array = array('chtufile_','chthideadm_','chtfbold_','chtfmly_','chtftsz_','chtimgmk_','chtunload_','chtuadmico_','chtuseico_','chtusealert_','chtnoticet_','chtnoticex_','chtwidth_','chtheight_','chthorizon_','cht_cntwh_','cht_usrwh_','chtbakbak_','chtmyself_','chtreload_','chtinterval_','chtcolorpk_','chtview_','chtimgmw_','chtmemberonly_','chtrefresh_','chtleave_','chtbakonly_','chtupdown_','chtlvico_','chtenter_','chtfitalic_','chtfunderline_','chtwrtpst_','chtusealert2_','chtrefresh2_','chturefresh_','chtfmobile_','chtncw_','chtcallt_','chtmemberonly2_','chtlimit_','chtbtcnt_','chtread_','chtchange_','chtbtnicon_','chtscrollstop_','chtisblack_','chtusrinout_','chtvsthddn_','chtwfixed_','chtwstylea_','chtwstyleb_','chtwstylec_','chtwstyled_','chtbtfixed_','chtbtstylea_','chtbtstyleb_','chtbtstylec_','chtbtstyled_','chtbtstylee_','chtwhprcd_','chtnwidth_','chtcwidth_','chtvdate_','chthsthddn_','chtclear_','chtvhead_','chtnextnk_','chtnoticed_','chtisdsm_','chtisfsm_','chtuimg_','chtvban_','chtvimg_','chtufile_','chtpnck_','chtiimg_');
foreach($array as $spg) {if(!isset($_POST[$spg])) $_POST[$spg] = '';}
}
if($_POST['chtufile_']) {if(!file_exists($chtup)) mkdir($chtup,0777);}
if($_POST['chthideadm_'] == 'a') fclose(fopen($chtfid."_hideadm","w"));else if(file_exists($chtfid."_hideadm")) unlink($chtfid."_hideadm");
$ftc = fopen($chtfid.$rfrr."_chtntc","w");
fputs($ftc, $_POST['chtfbold_']."\n");
fputs($ftc, $_POST['chtfmly_']."\n");
fputs($ftc, $_POST['chtftsz_']."\n");
fputs($ftc, $_POST['chtimgmk_']."\n");
fputs($ftc, $_POST['chtunload_']."\n");
fputs($ftc, $_POST['chtuadmico_']."\n");
fputs($ftc, $_POST['chtuseico_']."\n");
fputs($ftc, $_POST['chtusealert_']."\n");
fputs($ftc, $_POST['chtnoticet_']."\n");
fputs($ftc, $_POST['chtnoticex_']."\n");
fputs($ftc, $_POST['chtwidth_']."\n");
fputs($ftc, $_POST['chtheight_']."\n");
fputs($ftc, $_POST['chthorizon_']."\n");
fputs($ftc, $_POST['cht_cntwh_']."\n");
fputs($ftc, $_POST['cht_usrwh_']."\n");
fputs($ftc, $_POST['chtbakbak_']."\n");
fputs($ftc, $_POST['chtmyself_']."\n");
fputs($ftc, $_POST['chtreload_']."\n");
fputs($ftc, $_POST['chtinterval_']."\n");
fputs($ftc, $_POST['chtcolorpk_']."\n");
fputs($ftc, $_POST['chtview_']."\n");
fputs($ftc, $_POST['chtimgmw_']."\n");
fputs($ftc, $_POST['chtmemberonly_']."\n");
fputs($ftc, $_POST['chtrefresh_']."\n");
fputs($ftc, $_POST['chtleave_']."\n");
fputs($ftc, $_POST['chtbakonly_']."\n");
fputs($ftc, $_POST['chtupdown_']."\n");
fputs($ftc, $_POST['chtlvico_']."\n");
fputs($ftc, $_POST['chtenter_']."\n");
fputs($ftc, $_POST['chtfitalic_']."\n");
fputs($ftc, $_POST['chtfunderline_']."\n");
fputs($ftc, $_POST['chtwrtpst_']."\n");
fputs($ftc, $_POST['chtusealert2_']."\n");
fputs($ftc, $_POST['chtrefresh2_']."\n");
fputs($ftc, $_POST['chturefresh_']."\n");
fputs($ftc, $_POST['chtfmobile_']."\n");
fputs($ftc, $_POST['chtncw_']."\n");
fputs($ftc, $_POST['chtcallt_']."\n");
fputs($ftc, $_POST['chtmemberonly2_']."\n");
fputs($ftc, $_POST['chtlimit_']."\n");
fputs($ftc, $_POST['chtbtcnt_']."\n");
fputs($ftc, $_POST['chtread_']."\n");
fputs($ftc, $_POST['chtchange_']."\n");
fputs($ftc, $_POST['chtbtnicon_']."\n");
fputs($ftc, $_POST['chtscrollstop_']."\n");
fputs($ftc, $_POST['chtisblack_']."\n");
fputs($ftc, $_POST['chtusrinout_']."\n");
fputs($ftc, $_POST['chtvsthddn_']."\n");
fputs($ftc, $_POST['chtwfixed_'].",".$_POST['chtwstylea_'].",".$_POST['chtwstyleb_'].",".$_POST['chtwstylec_'].",".$_POST['chtwstyled_'].",\n");
fputs($ftc, $_POST['chtbtfixed_'].",".$_POST['chtbtstylea_'].",".$_POST['chtbtstyleb_'].",".$_POST['chtbtstylec_'].",".$_POST['chtbtstyled_'].",\n");
fputs($ftc, $_POST['chtbtstylee_']."\n");
fputs($ftc, $_POST['chtwhprcd_']."\n");
fputs($ftc, $_POST['chtnwidth_']."\n");
fputs($ftc, $_POST['chtcwidth_']."\n");
fputs($ftc, (int)$_POST['chtvdate_'].(int)$_POST['chtvtime_']."\n");
fputs($ftc, (int)$_POST['chthsthddn_'].(int)$_POST['chtclear_'].(int)$_POST['chtvhead_'].preg_replace("`[\r\n]`","",$_POST['chtnextnk_'])."\n");
fputs($ftc, stripslashes($_POST['chtnoticed_']));
fclose($ftc);
$fs = fopen($dsm,"w");
fputs($fs,(int)$_POST['chtisdsm_']."\n".$isusm."\n".(int)$_POST['chtisfsm_']);
fclose($fs);
$ftb = fopen($chtfid.$rfrr."_chtntb","w");
fputs($ftb, $_POST['chtuimg_']."\n");
fputs($ftb, $_POST['chtvban_']."\n");
fputs($ftb, $_POST['chtvimg_']."\n");
fputs($ftb, $_POST['chtufile_']."\n");
fputs($ftb, $_POST['chtpnck_']."\n");
fputs($ftb, $_POST['chtiimg_']."\n");
fclose($ftb);
}}
echo "<script type=\"text/javascript\">location.replace('{$chat}?chtid={$chtid}&v=ban&admin=1&rfrr={$rfrr}');</script>";
exit;
// 3.4.관리자 로그인/로그아웃처리 끝
} else if($_POST['ban'] && $_POST['ban'] != $chtip) {
if(substr($_POST['ban'],0,5) == 'dumb_') {
if(file_exists($chtfid."_ban/".$_POST['ban'])) {guestt(substr($_POST['ban'],5),5);@unlink($chtfid."_ban/".$_POST['ban']);}
else {guestt(substr($_POST['ban'],5),4);$a = fopen($chtfid."_ban/".$_POST['ban'],"w");fputs($a,$time."\x1b".$_POST['nick']."\x1b".$chtnck);fclose($a);}
} else if($cht_isadmin == 2 && substr($_POST['ban'],0,4) == 'adm_') {
$a = fopen($chtfid.$_POST['ban'],"w");fputs($a,$time.$_POST['nick']);fclose($a);
writee($dwv,"\x1b\x1b".$chtip.substr($_POST['ban'],4)."\x1b<a>".$_POST['nick']."\x1b".$chthis."\x1b");
} else {
$a = fopen($chtfid."_ban/".$_POST['ban'],"w");fputs($a,$time."\x1b".$_POST['nick']."\x1b".$chtnck);fclose($a);
writee($dwv,"\x1b<%>b".$_POST['nick']."\x1b".substr($chthis,0,10).$_POST['ban']."\x1b");
guestt($_POST['ban'],0);
@unlink($chtmip.$_POST['ban']);
}
echo "<script type=\"text/javascript\">location.replace('{$chat}?chtid={$chtid}&v=ban');</script>";
exit;
}
}
if($isdid && isset($_FILES['file'])) {
if(($isfsm && $_FILES['file']['size'] > $isfsm*1048576) || ($isdsm && $_FILES['file']['size'] > $isdsm*1048576)) {unlink($_FILES['file']['tmp_name']);$alert = "parent.alert('upload_max_filesize : ".$isdsm."mb');";
} else if($_FILES['file']['size']) {
$alert = '';
$fme = preg_replace("`[%(){}\+\[\]]`","",str_replace(" ","_",$_FILES['file']['name']));
$ext = strtolower(substr($fme,-4));
if($isdsm) {
$fs = fopen($dsm,"w");
fputs($fs,$isdsm."\n");
$isusm += $_FILES['file']['size'];
if($isusm > $isdsm*1048576) {@copy($chtup."_backup_.txt",$chtfid."_backup_.txt");chtrmfd($chtup,0);@rename($chtfid."_backup_.txt",$chtup."_backup_.txt");fputs($fs,$_FILES['file']['size']."\n");}
else fputs($fs,$isusm."\n");
fputs($fs,$isfsm);
fclose($fs);
}
$fmef = urlencode($fme);
$fmee = str_replace("%","",$fmef);
$dest = $chtup.$fmee;
$u = 0;$fmeee = '';
while(file_exists($dest)) {$u++;$fmeee = $u."_".$fmee;$dest = $chtup.$fmeee;}
move_uploaded_file($_FILES['file']['tmp_name'], $dest);
$fmee = str_replace("%","^",$fmef);
if($fmeee) $fmee = $u."_".$fmee;
$fmeee = '';
if($ext=='.jpg' || $ext=='.gif' || $ext=='.png' || $ext=='.bmp'){
if($ext != '.bmp') {
list($width, $height) = @getimagesize($dest);
if($width > $chtvimg) {
$tname = substr($dest,0,-4)."_s.jpg";
$mxheight = $height*$chtvimg/$width;
$thumb  = @imagecreatetruecolor($chtvimg, $mxheight);
@imagefill($thumb, 0, 0, @imagecolorallocate($thumb, 255, 255, 255));
if($ext=='.jpg') $source = @imagecreatefromjpeg($dest);
else if($ext=='.gif') $source = @imagecreatefromgif($dest);
else if($ext=='.png') $source = @imagecreatefrompng($dest);
if(@imagecopyresampled($thumb, $source, 0, 0, 0, 0, $chtvimg, $mxheight, $width, $height)){
if(@imagejpeg($thumb,$tname,90)) {imagedestroy($thumb);$fmeee = substr($fmee,0,-4)."_s.jpg";}
}}}
$memo = "<f><v>{$fmee}<>{$fme}<>{$fmeee}";
} else $memo = "<f><d>{$fmee}<>{$fme}";
$memo= $chtnckk."\x1b".$memo."\x1b".$chthis."\x1b".$_SESSION['cht_sty4'];
writee($dwv,$memo);
}
?>
<script type="text/javascript"><?php echo $alert;?>location.replace('<?php echo $chat;?>?chtid=<?php echo $chtid;?>&v=file');</script>
<?php
exit;
}} else if($_POST['tt']) {echo "<h1>there is no chatroom</h1>";exit;} else if($_GET['mkcht'] && $chtid == "__".substr(md5($chtip),8,16)) {cht_mkroom($chtdate.$chtdata."/".$chtid);echo "<script type='text/javascript'>location.replace('?chtid={$chtid}');</script>";exit;
} else if($cht_isadmin != 2 || substr($chtid,0,2) == '__') {echo "<fieldset style='padding:15px;text-align:center'>there is no chatroom</fieldset>";$chtexit = 'exit';}
}
if($chtexit != 'exit') {
if($_POST['install'] && $cht_isadmin) {
if($_POST['install'] == 'install') {
if(file_exists($chtdate) || mkdir($chtdate)) {
$_POST['chtid'] = trim($_POST['chtid']);
if($_POST['chtid'] !=preg_replace("`[\`\!@#$%^&*\(\)\[\]\"'\.\?/,+=|~\{\}]`", "", $_POST['chtid'])) {
echo "<script type=\"text/javascript\">location.href='?';alert('대화방id에 특수문자 사용 못합니다');</script>";
exit;
}
if(!$chtdata) {
$chtdata = substr(md5($time),rand(5,20),10);
mkdir($chtdate.$chtdata, 0777);
}
$chtfid = $chtdate.$chtdata."/".urldecode($_POST['chtid']);
cht_mkroom($chtfid);
} else {echo "<script type=\"text/javascript\">opener.alert(\"FTP에서 srchat/chat 권한을 777로 주세요\");</script>";exit;}
} else if($_POST['install'] == 'uninstall') {chtrmfd($chtfid,1);@RmDir($chtdate.$chtdata);}
echo "<script type=\"text/javascript\">location.replace('{$chat}?chtid={$chtid}&v=ban&admin=1&rfrr={$rfrr}');</script>";
exit;
}
if($_GET['js']) {
@header("Content-Type: text/javascript; charset=UTF-8");
function vemoticc($emofolder,$emor) {
global $chticodir;
if($ep = @opendir($chticodir.$emofolder)) {
$epps = 0;
while($epp = readdir($ep)) {
if($epp != '.' && $epp != '..') {
if(is_dir($chticodir.$emofolder.$epp)) $emor = vemoticc($emofolder.$epp.'/',$emor);
else $epps++;
}}
closedir($ep);
}
$emor[$emofolder] = $epps;
return $emor;
}
function vemotic($emofolder,$emor) {
global $chticodir;
$emof = vemoticc($emofolder,$emor);
$emofc = count($emof);
if($emof > 0) {
if($emof > 1) arsort($emof);
foreach($emof as $ekey => $evalue) {
if($evalue > 0) {
$emor .= ",Array('{$ekey}'";
$ep = opendir($chticodir.$ekey);
while($epp = readdir($ep)) {
if($epp != '.' && $epp != '..') {
if(is_file($chticodir.$ekey.$epp)) {$emor .= ",'{$epp}'";}
}}
closedir($ep);
$emor .= ")";
}}}
return $emor;
}
?>
var cht_this = null;
var cht_imopn = false;
var cht_obj = null;
var cht_tid = 0;
var chttalert = 0;
var chtualert = 0;
var cht_eeo = 0;
var cht_nxthtml = null;
var cht_nxth_tml = null;
var dph = Array();
var chtunload = false;
var chtuadmico = false;
var chtaablkc = 0;
var chtip = '';
var chtisbk = false;
var chtbx = 0;
var xmlhttp = null;
var chtreload = 0;
var chtview = 0;
var chtvimg = 100;
var chtimgmw = 0;
var chtrefresh = 1500;
var chtnextread = null;
var chtparam = '';
var chtismobile = 0;
var chtinterval = 0;
var chtwnext = 0;
var chtuimg = false;
var chtiimg = false;
var chtupdown = 0;
var chtwrtpst = false;
var chtmyself = 0;
var chtimgmk = 0;
var chtblk = 1;
var chttitle = '';
var chtctitle = '';
var chtcallt = 0;
var chtmkadmin = false;
var cht_isadmin = 0;
var cht_ico = Array(''<?php echo vemotic('/','');?>);
var chtlvico = false;
var chtpnck = 0;
var chtbtcnt = 0;
var chtread = 0;
var chtchange = 0;
var chtchtee = '';
var chtaacc = 0;
var fbdyw = 0;
var chtisblack = 0;
var chtusrinout = 0;
var chteelock = 0;
var chtvban = 0;
var chtncw = 0;
var chtafst = '';
var chtvcolor = 0;
var chtxw = '';
var chtxh = '';
var chticopt = 0;
var chtlgnfw = null;
var chtwnck = '';
var chtnwidth = 60; /* 닉네임란 넓이 */
var chtcwidth = 50; /* 색상선택상자넓이 */
var chtvdate = false;
var chtvtime = true;
var chtvread = '000';
var chtnextnk = " &gt; ";
var chtedir = 'icon/';

function dallar(key) {var rtn = document.getElementById(key);if(!rtn) rtn = document.getElementById('cht_none');return rtn;}
function cht_imgview(src) {
var img = dallar('cht_img');
if(src == 0 ||img.style.display == "block") {
img.innerHTML = "";
img.style.display = "none";
dallar('cht_gout').value = '0';
cht_imopn = false;
if(cht_nxthtml) cht_nxt_html();
} else {
var srcu = (src.substr(0, 7) != 'http://' && src.indexOf("&view=") == -1)? chtsrchat + "&amp;view=" + src:src;
if(chtview == 1 || chtisbk) window.open(srcu.replace(/amp;/g,''),'_blank');
else {
setTimeout("cht_imopn = true;",300);
img.style.display = "block";
var imgin = "<img onclick='cht_imgview(0)' src='" + srcu + "' alt=''";
if(chtimgmw > 0) imgin += " style='max-width:" + chtimgmw + "px'";
img.innerHTML = imgin + " />";
}}}
function chtnxg(thsx) {
var thsig = thsx.toLowerCase().indexOf("<span style=");
if(thsig != -1) {
thsx = thsx.substr(thsig);
thsx = thsx.substr(0,thsx.indexOf("</span"));
}
thsig = thsx.lastIndexOf('>');
if(thsig != -1) thsx = thsx.substr(thsig + 1);
return thsx.replace(/·/,'');
}

function chtwxa(thsx) {
var thxs = '';
var thxx = '';
var thtt = thsx.substr(1,1);
if(thsx.substr(0,1) == '1') thxx += "<img class='ht15' src='icon/mobile.gif' />";
if(thtt == '2' && chtuadmico) thxx += "<img class='ht15' src='icon/srchat_adm.gif' />";
thsx = thsx.substr(2);
var thss = '';
var thsig = thsx.indexOf("\x1a");
if(thsig != -1) {
thss = thsx.substr(0,thsig);
thsx = thsx.substr(thsig + 1);
thsig = thsx.indexOf("\x1a");
if(thsig != -1) {
thxs = thsx.substr(0,thsig);
thsx = thsx.substr(thsig + 1);
if(thxs != '' && chtlvico) thxx += "<img class='ht15' src='./icon/v" + thxs + ".gif' />";
}
if(thss != '' && chtimgmk == 1) thxx += "<img class='ht15' src='./icon/m20_" + thss + "' />";
}
thxx += thsx;
if(thtt == '0') thxx = "·" + thxx;
return Array(thxx,thsx,thtt);
}
function chtdmb(dmb) {
var tumb = '';
if(dmb == '1') tumb = "<img class='ht15' name='dumb' src='" + chtedir + "dumb.gif' title='글쓰기 차단됨' />";
return tumb;
}
function chtdelff(f) {
var furl;
var fkl;
if(f.href != '') {
furl = f.href;
fkl = furl.indexOf("down=") + 5;
if(fkl == 4) fkl = furl.indexOf("view=") + 5;
if(fkl == 4) {alert('failure');return false;}
fkl = furl.substr(fkl);
if(fkl.indexOf("&") != -1) fkl = fkl.substr(0,fkl.indexOf("&"));
} else {
furl = String(f.onclick);
furl = furl.substr(furl.indexOf("view=") + 5);
fkl = furl.substr(0,furl.indexOf(')') - 1);
}
return fkl;
}
function chtdelf(ths) {
var fkl =  chtdelff(ths.nextSibling);
cht_kout('',fkl, 2);
}
function cht_vinout(f) {
if(f) {
var uarip = f[2].substr(10);
var uxrip = 'cht_' + uarip;
if(f[1].indexOf("<<") != -1) {
var f1 = chtwxa(f[1].substr(0,f[1].indexOf("<<")));
if(dallar(uxrip).id == uxrip) {
cht_delt(dallar(uxrip).parentNode);
dallar('cht_vstd').value = dallar('cht_vstd').value.replace("," + f1[1] + ",",",");
} else {
while(dallar('cht_vstd').value.indexOf("," + f1[1] + ",") != -1) {dallar('cht_vstd').value.replace("," + f1[1] + ",",",");f1[1] += ".";if(uarip == chtip) dallar('neme').value = f1[1];}
dallar('cht_vstd').value =  dallar('cht_vstd').value + f1[1] + ",";
}
var dtt = document.createElement('dt');
dtt.setAttribute('id',uxrip);
dtt.onclick = function(){cht_whspr(this,2)};
f[3] = parseInt(f[3]);
if(f[3] && fbcolor[f[3]]) dtt.style.color = fbcolor[f[3]];
dtt.innerHTML = f1[0];
var dll = document.createElement('dl');
dll.appendChild(dtt);
dtt = document.createElement('dd');
dll.appendChild(dtt);
dallar('cht_DD').firstChild.appendChild(dll);
} else if(f[1].indexOf(">>") != -1) {
if(dallar(uxrip).id == uxrip) cht_delt(dallar(uxrip).parentNode);
var f1 = chtwxa(f[1].substr(0,f[1].indexOf(">>")));
dallar('cht_vstd').value = dallar('cht_vstd').value.replace("," + f1[1] + ",",",");
} else if(f[1].indexOf("<>") != -1) {
if(dallar(uxrip).id == uxrip) {
var ynm = f[1].substr(0,f[1].indexOf("<>"));
var znm = f[1].substr(f[1].indexOf("<>") + 2);
dallar(uxrip).innerHTML = dallar(uxrip).innerHTML.replace(ynm,znm);
dallar('cht_vstd').value = dallar('cht_vstd').value.replace("," + ynm + ",","," + znm + ",");
}} else if(f[1].indexOf("<%>") != -1) {
if(f[1].substr(0,5) == "<%>cx") {
var usrxdv = dallar(f[1].substr(3));
if(usrxdv) cht_delt(usrxdv);
} else if(dallar(uxrip).id == uxrip) {
var gp = f[1].substr(3);
if(gp == '4') {dallar(uxrip).innerHTML = "<img class='ht15' name='dumb' src='" + chtedir + "dumb.gif' title='글쓰기 차단됨' />" + dallar(uxrip).innerHTML;if(uarip == chtip) mkdumb(1);}
else if(gp == '5') {if(dallar(uxrip).firstChild && dallar(uxrip).firstChild.name == 'dumb') cht_delt(dallar(uxrip).firstChild);if(uarip == chtip) mkdumb(0);}
else if(gp == '3') {
if(dallar(uxrip).title != '') {dallar(uxrip).style.color = fbcolor[f[3]];dallar(uxrip).title = '';}
else {dallar(uxrip).style.color = '#BABABA';dallar(uxrip).title = '자리비움';}
}}}
}}
function cht_mdhis(val) {
return val.substr(0,2) + "-" + val.substr(2,2) + " " + val.substr(4,2) + ":" + val.substr(6,2) + ":" + val.substr(8,2);
}
function cht_his(val) {
return val.substr(4,2) + ":" + val.substr(6,2) + ":" + val.substr(8,2);
}
function cht_tntc(fv,nn) {
var rtn = "<div id='cx" + fv[2] + fv[4] + "' class='cht_ntc' style='" + chtafst + "'";
if(nn == 1) {
rtn += " onmouseover='cht_en(\"" + cht_mdhis(fv[2]) + "\")' onmouseout='cht_en()'><span";
if(cht_isadmin != 0) rtn += " onclick='chtxdel(this,\"" + fv[4] + "\")'";
} else rtn += "><span";
rtn += ">▶ </span>";
var f = fv[1];
if(f) {
if(f.substr(0,3) == '<%>') {if(f.substr(0,4) == '<%>b' && dallar('cht_ntim').value != "0000000000a") {
var uyrip = fv[2].substr(10);
if(chtip == uyrip) {tout();location.reload();}
if(dallar('cht_' + uyrip).id != 'cnt_none') cht_delt(dallar('cht_' + uyrip).parentNode);
if(chtvban === 0) rtn = "";else rtn += "<span class='dv'>" + f.substr(4) + "<\/span>님이 강퇴되셨습니다.";
} else rtn = "";
} else if(f.substr(0,3) == '<a>') {rtn += "<span class='dv'>" + f.substr(3) + "<\/span>님이 관리자로 선정되셨습니다. <input type='button' class='cht_button' value='새로고침' onclick='tout();location.reload()' />이 필요합니다.";}
else if(f.substr(0,6) == '<c><x>') {rtn += "<span class='dv'>" + f.substr(6) + "<\/span>님을 호출하셨습니다.";}
else if(f.substr(0,6) == '<h><x>') {rtn += "<span class='dv'>" + f.substr(6) + "<\/span>님이 호출하셨습니다.";}
else if(f.substr(0,6) == '<t><x>') {rtn += "<span class='dv'>" + f.substr(6) + "<\/span>님에게 1:1 대화가 신청되었습니다.";}
else if(f.substr(0,6) == '<r><x>') {uyrip = f.substr(6).split('<>');rtn += "<span class='dv'>" + uyrip[0] + "<\/span>님의 1:1 대화신청을 <span class='dv'>" + uyrip[1] + "<\/span>님이 거절하셨습니다.";}
else if(f.substr(0,6) == '<p><x>') {uyrip = f.substr(6).split('<>');nn = chtsrchat.indexOf('=');rtn += "<span class='dv'>" + uyrip[0] + "<\/span>님의 1:1 대화신청을 <span class='dv'>" + uyrip[1] + "<\/span>님이 수락하셨습니다.<br \/> <a target='_blank' href='" + chtsrchat.substr(0,nn) + "=" + uyrip[2] + "' onmousedown=\"cht_deltt(cht_this=this);cht_go('ssetiq')\"> <b>여기를</b> 클릭하세요</a>";}
else if(f.substr(0,9) == '<q><x><h>') {uyrip = f.substr(9).split('<>');nn = chtsrchat.indexOf('=');rtn += "<span class='dv'>" + uyrip[0] + "<\/span>님에게 <span class='dv'>" + uyrip[1] + "<\/span>님이 1:1 대화를 신청하셨습니다.<br \/> <a target='_blank' href='" + chtsrchat.substr(0,nn) + "=__" + uyrip[2] + "&amp;mkcht=1' onmousedown=\"cht_deltt(cht_this=this);cht_obj.value='" + uyrip[3] + uyrip[1] + "//whisper//11chat//whisper//__" + uyrip[2] + "';cht_go('rpage');cht_go('ssetiq')\"> <b>수락</b> </a> 또는 <a onmousedown=\"cht_deltt(cht_this=this);cht_obj.value='" + uyrip[3] + uyrip[1] + "//whisper//11chat//whisper//xx';cht_go('rpage');\"> <b>거절</b> </a>";}
else if(f.substr(0,3) == '<w>') {uyrip = f.substr(3).split('<>');rtn += "<span class='dv'>" + uyrip[0] + "<\/span>님에게 <span class='dv'>" + uyrip[1] + "<\/span>님의 귓속말<br \/> " + uyrip[2];}
else if(f.substr(f.length-2,2) == '<<') {if(chtusrinout === 0) rtn = "";else {f = f.substr(0,f.length-2);rtn += "<span class='dv'>" + chtwxa(f)[0] + "<\/span>님이 입장하셨습니다.";}}
else if(f.substr(f.length-2,2) == '>>') {if(chtusrinout === 0) rtn = "";else {f = f.substr(0,f.length-2);rtn += "<span class='dv'>" + chtwxa(f)[0] + "<\/span>님이 퇴장하셨습니다.";}}
else if(f.indexOf("<>") != -1) {if(chtchange === 0) rtn = "";else rtn += "<span class='dv'>" + f.replace(/([^<]+)<>/,"$1<\/span>  → <span class='dv'>") + "<\/span> (으)로 바꿨습니다.";}
else if(nn == 2 && (f.indexOf("<span  class='dv'>") != -1 || f.indexOf("<span class='dv' >") != -1)) rtn = "";
else rtn += f;
if(rtn != "") {
rtn += "</div><div class='bx'><\/div>";
}} else rtn = "";
return rtn;
}
function cht_tico(f) {
if(f) {
if(f.indexOf('<f>') === 0) {
var ff = f.substr(6).split('<>');
var vd = (f.indexOf('<v>') === 3)? 'view':'down';
if(cht_isadmin != 0) f = "<input type='button' value='삭제' class='cht_button' onclick='chtdelf(this)' style='margin-right:10px;height:18px' /><a ";else f = "<a ";
var elnk = chtsrchat + "&amp;" + vd + "=" + ff[0];
if(chtview == 1 || vd == 'down' || (chtview == 2 && chtuimg)) f += "target='_blank' href='" + elnk + "'";
else f += "onclick='cht_imgview(\"" + elnk + "\")'";
if(vd == 'view' && !chtuimg) {
if(!!ff[2]) var elnkk = chtsrchat + "&amp;" + vd + "=" + ff[2];else var elnkk = elnk;
f += "><img style='max-width:" + chtvimg + "px' src='" + elnkk + "' \/";
if(chtview == 2) f += "><\/a><a target='_blank' href='" + elnk + "'";
} f += ">" + ff[1] + "<\/a>";
} else {
if(f.indexOf("http:") != -1 || f.indexOf("https:") != -1 || f.indexOf("ftp:") != -1) {
if(chtiimg) f = f.replace(/(http|https|ftp):\/\/([^"'<>\r\n\s]+)\/([^"'<>\r\n\s\/]+)\.(jpg|gif|png|bmp|jpeg)/gi,"<a " + ((chtview != 0 || chtisbk)?"target='_blank' href='$1:\\$2/$3.$4'":"onclick='cht_imgview(this.innerHTML.replace(/amp;/g,\"\"))'") + ">$1:\\$2/$3.$4</a>");
else f = f.replace(/(http|https|ftp):\/\/([^"'<>\r\n\s]+)\/([^"'<>\r\n\s\/]+)\.(jpg|gif|png|bmp|jpeg)/gi,"<a " + ((chtview == 1 || chtisbk)?"target='_blank' href='$1:\\$2/$3.$4'":"onclick='cht_imgview(this.firstChild.src.replace(/amp;/g,\"\"))'") + "><img" + ((chtvimg > 0)?" style='max-width:" + chtvimg + "px'":"") + " src='$1:\\$2/$3.$4' />" + ((chtview == 2)? "</a><a target='_blank' href='$1:\\$2/$3.$4'>":"") + "$3.$4</a>");
f = f.replace(/(http|https|ftp):\/\/([^"'<>\r\n\s]+)/gi,"<a target='_blank' href='$1://$2'>$1://$2</a>").replace(/:\\/gi,"://");
} else if(cht_ico.length > 0 && f.indexOf("▩") != -1 && f.indexOf(".") != -1) {
var g = f.split("▩");
var gl = g.length;
var fl = -1;
f = g[0];
for(var i=1;i < gl;i++) {
fl = g[i].indexOf(".");
if(fl != -1) {
var gfl = g[i].substr(0,fl).split(",");
if(gfl[1]) f += "<img src='<?php echo $chticodir;?>" + cht_ico[gfl[0]][0] + cht_ico[gfl[0]][gfl[1]] + "' alt='' />";
f += g[i].substr(fl + 1);
} else f += "#" + g[i];
}}}}
return f;
}
var fbcolor = Array("#000000","#000000","#7d7d7d","#ff0000","#8c4835","#ff6c00","#ff9900","#ffef00","#a6cf00","#009e25","#1c4827","#00b0a2","#00ccff","#0095ff","#0075c8","#3a32c3","#7820b9","#ef007c");

function cht_fdnm(fdnm) {
var retunr;
var chtdda = dallar('cht_DD').getElementsByTagName('dt');
if(chtdda && chtdda.length > 0) {
for(var i = chtdda.length -1;i >= 0; i--) {
if(fdnm == chtnxg(chtdda[i].innerHTML)) {
retunr = chtdda[i];
break;
}}}
return retunr;
}
function ckt_whspr(ths,uzrip) {
if(chtsrchat.indexOf("__") != -1) return false;
cht_ntm(ths.parentNode);
var thh = ths.parentNode.nextSibling;
if(cht_imopn) cht_imgview(0);
if(cht_nxthtml != thh) {
var thst = chtnxg(ths.innerHTML);
if(thst) {
var uzrip = ths.parentNode.id.substr(12,12);
if(dallar('cht_' + uzrip).id != 'cht_none') {
if(cht_whspr(dallar('cht_' + uzrip),1,thh)) {
if(chtupdown != 1) setTimeout("dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;",50);
}} else cht_in("<b>" + thst + "</b> 님이 자리에 없습니다.");
}}}
function cht_ntm(ths,ntm) {
if(ntm) {
var iscnnctdd = '';
var iscnnctd = chtnxg(ths.firstChild.innerHTML);
if(fbdyw > 209) {iscnnctdd += '<div style="float:left;white-space:nowrap;overflow:hidden;font-weight:bold;max-width:' + (fbdyw - 189) + 'px;">' + iscnnctd + '</div>';}
var ntmdiv = dallar('cht_' + ths.id.substr(12,12));
iscnnctdd += (ntmdiv.id != 'cht_none')? ' :: 접속중':' :: 부재중';
ths.style.background = (chtisblack == 1)? '#212121':'#E9FFE3';
cht_en(iscnnctdd + " (" + cht_mdhis(ths.id.substr(2)) + ")&nbsp;");
} else {
cht_en();
ths.style.background = '';
}}
function cht_tosty(cont,cn) {
if(!cont[2]) return '';
var usrip = cont[2].substr(10);
var usrhis = cont[2].substr(0,10);
var usrvv = dallar('cht_' + usrip);
if(cont[3] && fbcolor[cont[3]]) cont[3] = 'color:' + fbcolor[cont[3]];
else cont[3] = '';
var chtwxaa = chtwxa(cont[0]);
cont[0] = chtwxaa[0];
cont[1] = cht_tico(cont[1]);
var cont4 = '';
if(!chtisbk) {
var cont5 = '';contr = '';
if(usrvv.id != 'cht_none') {if(!!cont[0]) {if(!usrvv.firstChild || !usrvv.firstChild.name || usrvv.firstChild.name != 'dumb') {dallar('cht_vstd').value = dallar('cht_vstd').value.replace("," + chtnxg(usrvv.innerHTML) + ",","," + chtwxaa[1] + ",");usrvv.innerHTML = cont[0];}}if(!!cont[3]) usrvv.style.color = cont[3].substr(6);}
if(chtip == usrip) {if(chtmyself == 2) {cont[3] += ";padding-right:4px;text-align:right;";cont[1] = "<span style=\"clear:right\">" + cont[1] + "<\/span>";cont5 = " style=\"float:right\"";cont[0] = "<b onclick=\"cht_whspr(0,3,this)\" style=\"float:right;" + ((cont[0].indexOf("<") == -1)? "":"margin-top:-3px") + "\">" + cont[0];} else {cont[0] = "<b onclick=\"cht_whspr(0,3,this)\">" + cont[0];if(chtmyself == 1) cont4 = (chtisblack == 1)?" myselfb":" myselfw";}}
else if(cn  == '1') cont[0] = "<b>" + cont[0];else cont[0] = "<b onclick=\"ckt_whspr(this,'" + usrip + "')\">" + cont[0];
if(cht_isadmin != 0) cont5 += " onclick=\"chtxdel(this,'" + cont[4] + "')\"";
contr = "<div id=\"cx" + cont[2] + cont[4] + "\" class=\"cx" + cont4 + "\" style=\"" + chtafst + cont[3] + "\" onmouseover=\"cht_ntm(this,1)\" onmouseout=\"cht_ntm(this)\">" + cont[0] + "<\/b><b" + cont5 + ">" + chtnextnk + "<\/b>" + cont[1];
if(chtvdate && (chtmyself != 2 || cont5 == "" || cont5.substr(1,5) != "style")) contr += "<span class=\"chtvdat\">" + cht_his(cont[2]) + "<\/span>";
contr += "<\/div><div class=\"bx\"><\/div>";
return contr;
} else {
cont4 = "<div class='cx' style='" + cont[3] + "'>";
if(cht_isadmin != 0) cont4 += "<input type=\"checkbox\" name=\"xbak[]\" value=\"" + cont[4] + "\" title=\"" + cont[5] + "\" />";
cont4 += " <span class=\"cht8\">&nbsp;" + cht_mdhis(usrhis) + " <\/span>&nbsp; <b>" + cont[0] + chtnextnk + "<\/b>" + cont[1] + "<\/div>";
return cont4;
}}
function cht_fbc(str) {
if(str.substr(0,1) === '0') str = str.substr(1);
return fbcolor[parseInt(str)];
}
function cht_fbcolr(nine) {
var thst = dallar('cht_color');
if(thst.title == '' || thst.title != 'disabled') {
var xx = cht_fbc(thst.value);
if(xx) {
cht_obj.style.color = xx;
dallar('neme').style.color = xx;
thst.style.backgroundColor = xx;
if(nine !== 9) cht_obj.focus();
}}}
function cht_aaee(pxp,xpx) {
if(chthorizon == 'v') {
dallar('cht_DD').style.height = pxp;
dallar('cht_AA').style.height = xpx;
} else {
dallar('cht_DD').style.width = pxp;
dallar('cht_AA').style.width = xpx;
}}
function cht_aadd(vcc) {
if(dallar('cht_gout').value != '9') {
var h = parseInt(cht_cntwh) + parseInt(cht_usrwh);
var d = cht_cntwh.replace(/[0-9]+/g,'');
if(chthorizon == 'v') {
if(vcc == 0 && dallar('cht_DD').style.height == cht_cntwh) cht_aaee(0,h + d);
else if(vcc == 2 || dallar('cht_DD').style.height == cht_usrwh) {cht_aaee(cht_cntwh,cht_usrwh);chtaacc = vcc;}
else {cht_aaee(cht_usrwh,cht_cntwh);chtaacc = 1;}
} else {
if(dallar('cht_DD').style.width == cht_usrwh) {dallar('cht_DD').style.display = 'none';cht_aaee(0,h + d);}
else {dallar('cht_DD').style.display = 'block';cht_aaee(cht_usrwh,cht_cntwh);}
}
if(chtupdown == 0) dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;
}}
function cht_tag(fvalue) {
if(cht_obj.createTextRange && cht_obj.currentPos && !cht_obj.currentPos.text) cht_obj.currentPos.text = "▩" + fvalue + ".";
else if(cht_obj.selectionStart) cht_obj.value = cht_obj.value.substring(0, cht_obj.selectionStart) + "▩" + fvalue + "." + cht_obj.value.substring(cht_obj.selectionEnd);
else cht_obj.value = cht_obj.value + "▩" + fvalue + ".";
chtemtbk(dallar('cht_LL'));
cht_obj.focus();
}
function notixe(tht) {
if(tht) tht = 'none';
else tht = '';
var cht_ntctr = dallar('cht_AA').getElementsByTagName('div');
for(var i=cht_ntctr.length-1;i >= 0;i--) {if(cht_ntctr[i].className == 'cht_ntc') cht_ntctr[i].style.display = tht;}
}
function cht_toggle(ff) {
var f = dallar(ff);
if(f) {
if(ff == 'cht_chkdiv') {
if(dallar('chtupload').style.display != 'none') dallar('chcontent').style.width = (f.style.display == 'block')? parseInt(dallar('chcontent').style.width) - 18 + 'px':parseInt(dallar('chcontent').style.width) + 18 + 'px';
if(chtwrtpst) {
dallar('cht_UU').style.marginTop = (f.style.display == 'block')? parseInt(dallar('cht_UU').style.marginTop) + 23 + 'px':parseInt(dallar('cht_UU').style.marginTop) - 23 + 'px';
dallar('cht_HH').style.marginTop = (f.style.display == 'block')? parseInt(dallar('cht_HH').style.marginTop) - 23 + 'px':parseInt(dallar('cht_HH').style.marginTop) + 23 + 'px';
}}
if(ff == 'cht_fico' && f.style.display == 'none' && !chtwrtpst && chticopt == 0) {
setTimeout("chticopt = dallar('cht_fico').scrollHeight;var htc = parseInt(chtxh) - chticopt;if(htc > 0) dallar('cht_fico').style.paddingTop = htc + 'px';else if(htc < 0) dallar('cht_fico').innerHTML = dallar('cht_fico').innerHTML + '<img src=\"' + chtedir + 'srchat_e.png\" title=\"close\" onclick=\"chtemtbk(dallar(\\\'cht_LL\\\'))\" />';",100);
}
f.style.display = (f.style.display == 'block')? 'none':'block';
}}
function chtemtbk(emt) {
if(emt.title == 'disabled') return;
if(emt.id == 'cht_LL' || emt.id == 'cht_MM' || emt.id == 'cht_PP' || emt.id == 'cht_QQ' || emt.id == 'cht_SS') {
var tme = '1px';
if(emt.style.borderWidth == '1px') tme = '0px';
emt.style.borderWidth = tme;
emt.style.padding = (tme == '1px')? '0px':'1px';
}
if(emt.id == 'cht_LL') cht_toggle('cht_fico');
else if(emt.id == 'cht_ZZ') cht_toggle('cht_CC');
else {
if(emt.id == 'cht_MM') dallar('chcontent').style.fontWeight=(tme == '1px')? 'bold':'normal';
else if(emt.id == 'cht_PP') dallar('chcontent').style.fontStyle=(tme == '1px')? 'italic':'normal';
else if(emt.id == 'cht_SS') {if(chtupdown != 1) chtupdown = (tme == '1px')? 2:0;}
else if(emt.id == 'cht_WW') {dallar('cht_AA').innerHTML = '';chtbx = 0;}
if(dallar('chtwtfm').style.display != 'none' && chtismobile != 1) cht_obj.focus();
}}
function cht_go(view) {
	clearTimeout(chtnextread);
	if(chtparam != '') {
	if(view == 'read') chtnextread = setTimeout("cht_go('read')", chtrefresh);
	else setTimeout("cht_go('" + view + "')",100);
	} else {
	var cht_ntime = new Date();
	var gtime = cht_ntime.getTime();
	var cht_etiq = Array("",";color:#BABABA' title='자리비움");
	var cht_ntv = dallar('cht_ntim').value.substr(10);
	if(cht_ntv != 'a') cht_ntv = cht_ntv + '&rd=' + chtvread;
	var cht_ok = 9;
	var nam = dallar('neme').value.replace(/[&'"]/gi,"");
	if(view == 'rpage' || view == 'alert') {
	var contt = cht_obj.value;
	if(dallar('cht_fico').style.display == 'block') chtemtbk(dallar('cht_LL'));
	cht_obj.value = '';
	if(contt.substr(0,1) == ';') {
	cht_obj.focus();
	if(contt == ';ico'){if(dallar('cht_LL').title != 'disabled') chtemtbk(dallar('cht_LL'));return;}
	else if(contt == ';b'){if(dallar('cht_MM').title != 'disabled') chtemtbk(dallar('cht_MM'));return;}
	else if(contt == ';i'){if(dallar('cht_PP').title != 'disabled') chtemtbk(dallar('cht_PP'));return;}
	else if(contt == ';u'){if(dallar('cht_QQ').title != 'disabled') chtemtbk(dallar('cht_QQ'));return;}
	else if(contt == ';pause'){if(dallar('cht_SS').title != 'disabled') chtemtbk(dallar('cht_SS'));return;}
	else if(contt == ';re'){if(dallar('cht_RR').title != 'disabled') {tout();location.reload();}return;}
	else if(contt == ';exit'){if(dallar('cht_OO').title != 'disabled') cht_leave();return;}
	else if(contt == ';nick'){if(chtpnck != 2 && chtvcolor != 2) chtvwnck();return;}
	else if(contt == ';clear'){if(dallar('cht_WW').title != 'disabled') chtemtbk(dallar('cht_WW'));return;}
	else if(contt == ';head'){if(dallar('cht_ZZ').title != 'disabled') chtemtbk(dallar('cht_ZZ'));return;}
	else if(contt == ';bak'){if(dallar('chtbackup').innerHTML != 'false') {if(!window.open(chtsrchat + "&v=backup","_blank")) cht_in("<a target='_blank' href='" + chtsrchat + "&amp;v=backup'>전체대화<\/a>");}return;}
	else if(contt == ';admin'){if(dallar('chtadmin').innerHTML != 'false') {if(!window.open(chtsrchat + "&v=ban&admin=1","_blank")) cht_in("<a target='_blank' href='" + chtsrchat + "&amp;v=ban&amp;admin=1'>관리자기능<\/a>");}return;}
	else if(contt == ';color'){if(chtvcolor == 2) chtvwnck();return;}
	} else if((chtpnck == 1 && dallar('chtnecolor').style.width != '1px') || chtvcolor == 2 && dallar('chtnecolor').style.width == (chtnwidth + chtcwidth + 2) + 'px') chtvwnck();
		if(chtinterval > 0) {
	if(chtwnext > gtime) {cht_inn('글쓰기 시간간격 '+ ((chtwnext - gtime)/1000) + '초/' + chtinterval + '초 남았습니다',2000,'cht_alert','');cht_obj.value = contt;cht_obj.focus();return false;}
		chtwnext = gtime + chtinterval*1000;
		}
		if(dallar('cht_pnam').value != nam) {
		if(nam.substr(0,1).replace(/[　\s]/g,"") != "") {
		if(dallar('cht_pnam').value != "") {
		if(dallar('cht_vstd').value.indexOf("," + nam + ",") != -1 || dallar('cht_vstd').value.indexOf(",·" + nam + ",") != -1) {
		cht_ok = 2;
		cht_inn("중복된 '닉네임' 입니다",2000,"cht_alert","");
		dallar('neme').value = dallar('cht_pnam').value;
		}}} else {cht_ok = 2;cht_inn("닉네임 첫글자가 공백입니다",2000,"cht_alert","");}
		if(cht_ok == 9) {dallar('cht_pnam').value = nam;nam += '&nn=' + chtchange;}
		else dallar('neme').value = dallar('cht_pnam').value;
		}
		if(cht_ok == 9) {
		if(view == 'alert') {
		if(chtcallt == 0 || gtime - parseInt(dallar('cht_callt').value) >= chtcallt) cht_ok = 2;
		contt += '//whisper//11chat//whisper//yy';
		} else {
		contt = contt.replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/[\r\n]/g, "").replace(/`/g,"").replace(/%/g,"%25").replace(/&/g,"%26").replace(/\+/g,"%2B").replace(/\\/g,"＼");if(contt =='') return false;
		if(dph.length) {
		for(var i = 0; dph[i]; i++){
		if(dph[i] && contt.indexOf(dph[i]) != -1) {
		cht_ok = 2;
		cht_inn("금지된 표현 '"+ dph[i] +"' (이)가 포함되어 있습니다.",2000,"cht_alert","");
		break;
		}}}}
		if(cht_ok == 9) {
		if(dallar('cht_prev').value != contt) {
		var fstyle = dallar('cht_color').value;
		if(fstyle.title == '' || fstyle.title != 'disabled') {
		if(dallar('psty').value != fstyle) dallar('psty').value = fstyle;
		if(dallar('cht_JJ').style.width != '1px') {
		chtwnck = dallar('cht_wip').value.substr(12) + '//';
		if(contt == chtwnck) {chtipths();return;}
		setTimeout('cht_obj.value = chtwnck;',10);
		cht_ok = contt.indexOf('//');
		if(cht_ok != -1) contt = contt.substr(cht_ok + 2);
		contt = dallar('cht_wip').value + '//whisper//' + contt;
		} else {
		if(dallar('cht_MM').style.borderWidth == '1px') contt = "(b)" + contt;
		if(dallar('cht_PP').style.borderWidth == '1px') contt = "(i)" + contt;
		if(dallar('cht_QQ').style.borderWidth == '1px') contt = "(u)" + contt;
		}
		chtparam = chtsrchat + '&neme='+ nam +'&content='+ contt + '&tt=' + cht_ntv + '&ff=' + fstyle;
		cht_iscookie(fstyle);
		dallar('cht_prev').value = contt;
		dallar('cht_ptim').value = gtime;
		}} else cht_inn('중복된 내용입니다',2000,'cht_alert','');
		}
		}
	} else if(view == 'out') {
		chtparam = chtsrchat + '&content=9579a584&tt=' + cht_ntv;
	} else if(view == 'exit') {
		chtparam = chtsrchat + '&content=8579a584&tt=' + cht_ntv;
	} else if(view == 'ssetiq') {
		chtparam = chtsrchat + '&content=6579a584&tt=' + cht_ntv;
	} else {
		var xtval = (parseInt(dallar('cht_xtim').value) + 1)%10;
		dallar('cht_xtim').value = xtval;
		if(dallar('cht_gout').value == '9') {if(chtbtcnt == 1 && dallar('cht_VV').style.display != 'none') {
		cht_ok = 99;
		if(xtval % 5 == 1) chtparam = chtsrchat + '&tt=number';else chtnextread = setTimeout("cht_go('read')", chtrefresh);
		}} else {
		if(cht_ntv == 'a') chtparam = chtsrchat + '&rr=' + chtread + '&tt=' + cht_ntv + '&neme=' + nam;
		else if(xtval == 0) chtparam = chtsrchat + '&tt=x';
		else chtparam = chtsrchat + '&tt=' + cht_ntv;
	  if(view == 'in') {chtparam += '&content=7579a584';view = 'read';}
	}}
if(chtparam != '') {
if(window.ActiveXObject) {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}  else if(window.XMLHttpRequest) {
xmlhttp = new XMLHttpRequest();
}
xmlhttp.open("POST", chtparam, true);
xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
xmlhttp.onreadystatechange = function(){
if(xmlhttp.readyState=='4' && xmlhttp.status=='200') {
	var str = xmlhttp.responseText;
	if(str.indexOf("<h1>") != -1) {dallar('cht_gout').value = '9';dallar('cht_fbdy').innerHTML=str;dallar('cht_VV').innerHTML='';return false;}
  else if(cht_ok == 99) {
	if(str.substr(0,9) == '<fieldset') location.reload();
	else dallar('cht_VV').firstChild.value = ' 채팅방 접속자 : ' + str;
	} else {
	if(chtvtime) {
	var ts = '';
	var t = cht_ntime.getHours();
	var m = cht_ntime.getMinutes();
	var s = cht_ntime.getSeconds();
	ts += (t < 10)? "0"+t+":":t+":";
	ts += (m < 10)? "0"+m+":":m+":";
	ts += (s < 10)? "0"+s:s;
	dallar('cht_FF').innerHTML = ts;
	}
		var vew = str.split("\x7f");
		if(vew.length > 0 && vew[0] != ''){
			var vews = vew[0].split("\x18");
			var sdd = vews.length - 1;
			var stra = '';var strt = '';
			var strr = '';var vew12 = '';var vew13 = Array();var cht_vstd = ",";
			for(var i = 0;i < sdd;i++) {
			vew12 = vews[i].substr(0,12);
			vew13 = chtwxa(vews[i].substr(16));
			strt = "<dl><dt id='cht_" + vew12 + "' style='color:" + cht_fbc(vews[i].substr(14,2)) + ";" + chtafst + cht_etiq[vews[i].substr(12,1)] + "'";
			if(vew12 == chtip) {strt += " onclick='cht_whspr(this,4)' class='" + ((chtisblack == 1)? "chtselfb":"chtselfw") + "'>";if(vews[i].substr(13,1) == '1') mkdumb(1);else mkdumb(0);}
			else strt += " onclick='cht_whspr(this,2)'>";
			strt += chtdmb(vews[i].substr(13,1)) + vew13[0] + "<\/dt><dd><\/dd><\/dl>";
			if(vew13[2] == 2) stra = strt + stra;
			else if(vew13[2] == 1) stra += strt;
			else strr += strt;
			cht_vstd += vew13[1] + ",";
			}
			dallar('cht_DD').innerHTML = "<div class='dv'>" + stra + strr + "<\/div>";
			dallar('cht_vstd').value = cht_vstd.replace(/·/g,'');
		}
		var strr = "";
		if(vew.length > 1 && vew[1] != ''){
			var aline = vew[1].split("\x18");
			var alinength = aline.length -2;
			if(chtupdown == 1) {
			for(var i = alinength;i >= 0;i--){
			if(aline[i]) {
			var wnam = aline[i].split("\x1b");
			if(i == alinength) chtvread = wnam[4];
			if(wnam[0]) strr += cht_tosty(wnam,0);
			else {
			if(wnam[1].indexOf("<h>") !== -1) chtparam = 'n';
			if(cht_ntv !== 'a' || wnam[1].indexOf("<x>") !== 3) strr += cht_tntc(wnam,1);
			if(cht_ntv !== 'a') cht_vinout(wnam);
			}}}} else {
			for(var i = 0;i <= alinength;i++){
			if(aline[i]) {
			var wnam = aline[i].split("\x1b");
			if(i == alinength) chtvread = wnam[4];
			if(wnam[0]) strr += cht_tosty(wnam,0);
			else {
			if(wnam[1].indexOf("<h>") !== -1) chtparam = 'n';
			if(cht_ntv !== 'a' || wnam[1].indexOf("<x>") !== 3) strr += cht_tntc(wnam,1);
			if(cht_ntv !== 'a') cht_vinout(wnam);
			}}}}
			if(strr != "") {
			if(chtbx > 500 || chtbx == 0) {
			dallar('cht_AA').innerHTML = strr;chtbx = 1;
			} else {
			chtbx++;
			var cdiv = document.createElement("div");
			cdiv.innerHTML = strr;
			cdiv.style.padding = 0;
			cdiv.style.margin = 0;
			if(chtupdown == 1) dallar('cht_AA').insertBefore(cdiv,dallar('cht_AA').firstChild);
			else dallar('cht_AA').appendChild(cdiv);
			}
			if(chtupdown == 1) dallar('cht_AA').scrollTop = 0;
			else if(chtupdown == 0) setTimeout("dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;",50);
			if(strr != '' && cht_ntv != 'a' && chtualert != 5 && (chtparam == 'n' || (chttalert !== 0 && parseInt(gtime) - parseInt(dallar('cht_ptim').value) > chttalert))) {
			if(chtualert == 2 || chtualert == 3 || (chtualert == 4 && chtismobile == 1)) {chttitle=document.title;chtctitle=ts;chtaablkc=gtime;chtblk = 0;chtaablk();}
			if(chtualert == 0 || chtualert == 3 || (chtualert == 4 && chtismobile != 1))  dallar('cht_AA').innerHTML = dallar('cht_AA').innerHTML + "<embed src='<?php echo $chtmid;?>' type='application/x-shockwave-flash' width='1px' height='1px'><\/embed>";
			}}
			dallar('cht_ptim').value = gtime;
		}
			if(dallar('cht_DD').firstChild) chtchtee = "접속자 (" + dallar('cht_DD').firstChild.childNodes.length + ")";
			if(chteelock == 0) dallar('cht_EE').innerHTML = chtchtee;
	}
	dallar('cht_ntim').value = gtime;
	chtparam = '';
	chtnextread = setTimeout("cht_go('read')", chtrefresh);
	delete xmlhttp;
}}
xmlhttp.send(chtparam);
if(view == 'out') return view;
}
if(view == 'rpage') cht_obj.focus();
}}

function cht_away() {
var ths = '자리비움을 ' + ((dallar('cht_' + chtip).title != '')? '해제':'설정') + '했습니다';
cht_nxth_tml = null;
cht_in(ths);
cht_go('ssetiq');
}
function cht_en(texxt) {
if(texxt) {dallar('cht_EE').innerHTML = "<div class='smll'>" + texxt + "</div>";chteelock = 2;}
else {dallar('cht_EE').innerHTML = chtchtee;chteelock = 0;}
}
function cht_in(texxt) {
if(texxt) {
setTimeout("cht_eeo = 3",1000);
setTimeout("if(cht_eeo == 3) cht_eeo = 2",2000);
setTimeout("cht_in()",4000);
cht_eeo = 0;
cht_en(texxt);
} else if(cht_eeo == 2) {cht_en();cht_eeo = 0;}
}
function cht_inn(texxt,vtm,vclass,vid) {
if(!vid) {vid = 'cht_tid_' + cht_tid;cht_tid++;}
var vdiv = document.createElement("div");
vdiv.innerHTML = texxt.replace(/#34;/g,'"').replace(/#39;/g,"'");
vdiv.id = vid;
if(vclass) vdiv.className = vclass;
if(chtupdown == 1) dallar('cht_AA').insertBefore(vdiv,dallar('cht_AA').firstChild);
else dallar('cht_AA').appendChild(vdiv);
if(vtm) setTimeout("cht_delt(dallar('" + vid + "'))",vtm);
if(chtupdown == 0) dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;
}
function cht_leave() {
cht_go('exit');dallar('cht_gout').value='9';chtlgnfw.chtenter(2);dallar('cht_xtim').value = '5';
}
function chtvwnck() {
if(chtvcolor == 2) {
if(dallar('chtnecolor').offsetWidth < chtnwidth + chtcwidth) {
dallar('chtnecolor').style.width = (chtnwidth + chtcwidth + 2) + 'px';
if(chtncw == 1) dallar('chcontent').style.width = parseInt(parseInt(dallar('chcontent').style.width) - chtcwidth) + 'px';
dallar('cht_color').style.display = 'inline';
} else {
dallar('chtnecolor').style.width = (chtnwidth + 2) + 'px';
if(chtncw == 1) dallar('chcontent').style.width = parseInt(parseInt(dallar('chcontent').style.width) + chtcwidth) + 'px';
dallar('cht_color').style.display = 'none';
}} else {
var chtnecolorw = (chtvcolor == 3)? chtnwidth + 2:chtnwidth + chtcwidth + 2;
var chtnecolorww = chtnecolorw - 1;
if(dallar('chtnecolor').style.width == '1px') {
dallar('chtnecolor').style.width = chtnecolorw + 'px';
if(chtncw == 1) dallar('chcontent').style.width = parseInt(parseInt(dallar('chcontent').style.width) - chtnecolorww) + 'px';
dallar('neme').style.display = 'inline';
if(chtvcolor !== 3) dallar('cht_color').style.display = 'inline';
} else {
dallar('neme').style.display = 'none';
if(chtvcolor !== 3) dallar('cht_color').style.display = 'none';
dallar('chtnecolor').style.width = '1px';
if(chtncw == 1) dallar('chcontent').style.width = parseInt(parseInt(dallar('chcontent').style.width) + chtnecolorww) + 'px';
}}}
function cht_ex(n) {
if(!n) cht_en();
else {
n -= 1;
var txta = new Array(";ico",";b",";i",";u",";exit",";re",";bak",";admin",";nick","상대방// 이 상태에서 엔터하면 해제됨",";color","","",";pause",";clear",";head");
var txtb = new Array("이모티콘","글자 굵게","글자 기울게","글자에 밑줄","채팅방 퇴장","새로고침","저장된 기록 보기","관리자 기능","닉네임 열기","귓속말 해제","색상선택상자","닉네임란","본문란","스크롤 정지","본문 지움","채팅방 헤드 감춤/드러냄");
if(chtvcolor == 2 && n == 8) n = 10;
var txtc = '<b>' + txtb[n] + '<\/b>';
if(n == 11) dallar('neme').focus();
else if(n == 12) dallar('chcontent').focus();
else {
if(fbdyw > 251) txtc += '&nbsp; 입력창에서 " ' + txta[n] + '"';
else if(fbdyw > 201) txtc += '&nbsp; ' + txta[n];
}
cht_en(txtc);
}}
function cht_gg() {
if(chtreload != 5 && dallar('cht_gout').value != '9') {
var ckk = new Date().getTime() - parseInt(dallar('cht_ntim').value);
if(ckk > 20000) {
if(chtreload == 1) {tout();location.reload();}
else if(chtreload == 2) cht_inn("새로고침이 필요합니다. <input type='button' value='새로고침' class='cht_button' onclick='tout();location.reload();' />",3000,"cht_alert","");
else if(confirm('새로고침이 필요합니다. 새로고침하시겠습니까')) {tout();location.reload();}
}
if(ckk > 10000) {
clearTimeout(chtnextread);
chtnextread = setTimeout("cht_go('read')", chtrefresh);
}}
if(chtreload != 5) setTimeout('cht_gg()', 3500);
}
function cht_emodr(n) {
var emdiv = dallar('cht_fico').getElementsByTagName('div');
if(emdiv.length > 1) {
n = parseInt(n) -1;
for(var m = emdiv.length - 1;m >= 0;m--) {
if(m == n) emdiv[m].style.display = '';
else emdiv[m].style.display = 'none';
}}}
function cht_setup() {
chtbx = 0;
cht_obj = dallar('chcontent');
cht_obj.value = '';
if(chtlgnfw == null) chtlgnfw = dallar('cht_ban').contentWindow;
dallar('cht_AA').style.overflowX='hidden';
dallar('cht_ntim').value="0000000000a";
if(dallar('cht_OO').style.borderWidth != '1px') dallar('cht_gout').value='0';
dallar('cht_xtim').value='0';
if(cht_ico.length > 0) {
var femt = '';
var femtt = '';
var chtl = cht_ico.length;
for(var ii=1;ii < chtl;ii++) {
if(chtl > 2) {
femtt += "<input type='button' value=' " + cht_ico[ii][0].replace(/\//g,'') + "' class='cht_button' onclick='cht_emodr(" + ii + ")' /> ";
if(ii == 1) femt += "<div>";
else femt += "<div style='display:none'>";
}
for(var i=cht_ico[ii].length -1;i > 0;i--) {
femt += "<img src='<?php echo $chticodir;?>" + cht_ico[ii][0] + cht_ico[ii][i] + "' alt='' onclick=\"cht_tag('" + ii + "," + i + "')\" />";
}
if(chtl > 2) femt += "<\/div>";
}
if(femt != '') dallar('cht_fico').innerHTML = "<dl style='background:" + ((chtisblack == 1)? '#000000':'#ffffff') + ";margin:0'>"+ femtt + femt + "</dl>";
dallar('cht_fico').style.width = fbdyw + 'px';
if(!chtvtime) fbdyw += 51;
dallar('cht_EE').style.width = (fbdyw - 81) + 'px';
dallar('cht_fico').style.display = 'none';
}
if(document.cookie) {
var chtcllt = document.cookie.indexOf('cht_callt=');
if(chtcllt != -1) {chtcllt = document.cookie.substr(chtcllt + 10,13);dallar('cht_callt').value = chtcllt;
}}
cht_go('read');
setTimeout('cht_gg()',5000);
if(chtupdown == 0) setTimeout("dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;",1000);
setTimeout("if(dallar('cht_AA').firstChild) cht_ntm(dallar('cht_AA').firstChild)",50);
var chtstyle = cht_iscookie(0);
dallar('cht_variable').value = 'chttalert=' + chttalert + ';chtualert=' + chtualert + ';chtunload=' + chtunload + ';chtuadmico=' + chtuadmico + ';chtip="' + chtip + '";chtisbk=' + chtisbk + ';chtreload=' + chtreload + ';chtview=' + chtview + ';chtvimg=' + chtvimg + ';chtimgmw=' + chtimgmw + ';chtrefresh=' + chtrefresh + ';chtismobile=' + chtismobile + ';chtinterval=' + chtinterval + ';chtuimg=' + chtuimg + ';chtiimg=' + chtiimg + ';chtupdown=' + chtupdown + ';chtwrtpst=' + chtwrtpst + ';chtmyself=' + chtmyself + ';chtimgmk=' + chtimgmk + ';chtcallt=' + chtcallt + ';chtmkadmin=' + chtmkadmin + ';cht_isadmin=' + cht_isadmin + ';chtpnck=' + chtpnck + ';chtbtcnt=' + chtbtcnt + ';chtread=' + chtread + ';chtchange=' + chtchange + ';fbdyw=' + fbdyw + ';chtisblack=' + chtisblack + ';chtusrinout=' + chtusrinout + ';chtvban=' + chtvban + ';chtncw=' + chtncw + ';chtafst="' + chtafst + '";chtvcolor=' + chtvcolor + ';chtxw="' + chtxw + '";chtxh="' + chtxh + '";chtnwidth=' + chtnwidth + ';chtcwidth=' + chtcwidth + ';chtvdate=' + chtvdate + ';chtvtime=' + chtvtime + ';';
setTimeout("cht_stvariable()",120000);
if(chtstyle != -1 && (dallar('cht_color').title == '' || dallar('cht_color').title != 'disabled')) {
dallar('cht_color').value = chtstyle;
setTimeout("cht_fbcolr(9)",50);
}}
function cht_stvariable() {
eval(dallar('cht_variable').value);
setTimeout("cht_stvariable()",120000);
}
function cht_iscookie(isc) {
var chtstyle = document.cookie.indexOf('cht_sty4=');
if(chtstyle != -1) chtstyle = document.cookie.substr(chtstyle + 9,2);
if(isc != 0) {if(isc != chtstyle) document.cookie = "cht_sty4 = " + isc;
} else return chtstyle;
}
function cht_deltt(ths) {
setTimeout("cht_delt(cht_this.parentNode);cht_this = null;",500);
}
function cht_delt(ths) {
if(ths && ths.id != 'cht_none') ths.parentNode.removeChild(ths);
}
function cht_11chat(ip,thsi) {
if(ip && chtaacc == 2) cht_aadd(1);
if(dallar('cht_JJ').style.width != '1px') chtipths();
cht_obj.value= ip + thsi + "//whisper//11chat";
cht_go('rpage');
cht_inn('"' + thsi + '"님에게 1:1 대화를 신청했습니다',2000,'cht_alert','');
}
function chtipthss() {
if(dallar('cht_JJ').style.width != '1px') {
dallar('cht_JJ').firstChild.style.display = 'none';
dallar('cht_JJ').style.width = '1px';
dallar('chcontent').style.width = parseInt(parseInt(dallar('chcontent').style.width) + 41) + 'px';
} else {
dallar('chcontent').style.width = parseInt(parseInt(dallar('chcontent').style.width) - 41) + 'px';
dallar('cht_JJ').style.width = '42px';
dallar('cht_JJ').firstChild.style.display = 'block';
}}
function chtipths(ip,thsi) {
if(ip && chtaacc == 2) cht_aadd(1);
if(ip && thsi) {
if(dallar('cht_JJ').style.width != '1px') chtipths();
else {
dallar('cht_wip').value = ip + thsi;
setTimeout("cht_obj.value = '" + thsi + "//'",200);
chtipthss();
}} else if(ip) {
if(dallar('cht_JJ').style.width != '1px') chtipths();
var ctime = new Date().getTime();
var dtime = ctime - parseInt(dallar('cht_callt').value);
if(chtcallt != 0 && dtime < chtcallt) cht_inn('알림음 호출 시간간격 '+  ((chtcallt - dtime)/1000) + '초/' + (chtcallt/1000) + '초 남았습니다',2000,'cht_alert','');
else {
dallar('cht_callt').value = ctime;
document.cookie = "cht_callt = " + ctime;
cht_obj.value = ip;
cht_go('alert');
}} else {
if(cht_obj.value.indexOf('//') != -1) cht_obj.value = '';
cht_delt(dallar(dallar('cht_wip').value.substr(0,12)));
dallar('cht_wip').value = '';
if(dallar('cht_JJ').style.width != '1px') chtipthss();
}
cht_obj.focus();
}
function cht_nxt_html(val) {
if(cht_nxthtml !== null) {
cht_nxthtml.style.display = 'none';
cht_nxthtml.innerHTML = '';
cht_nxthtml = null;
}
if(chtaacc == 2) cht_aadd(1);
if(val) {
val.display = 'none';
val.innerHTML = '';
}}
function cht_whspr(ths,n,m) {
if(chtsrchat.indexOf("__") != -1) return '';
var ip = '';
if(n == 3) {ths = dallar('cht_' + chtip);m = m.parentNode.nextSibling;}
var chtnx_thtml = ((n === 2 || n == 4)? ths.nextSibling:m);
if(cht_nxthtml == chtnx_thtml || chtnx_thtml.innerHTML != '' || chtnx_thtml == cht_nxth_tml || cht_nxthtml !== null) {cht_nxth_tml = null;cht_nxt_html(chtnx_thtml);} else {
if(ths.tagName.toLowerCase() == 'b') ip = ths.previousSibling.name.substr(4);
else ip = ths.id.substr(4);
var thsi = chtnxg(ths.innerHTML);
var nxthtml = "<ul class='nxtht'";
if(chtismobile > 0) nxthtml += " style='position:absolute;z-index:9'";
if(n == 3 || n == 4) {
nxthtml += "><li><a onmousedown=\"cht_away()\"><span>&bull;<\/span> 자리비움 " + ((ths.title != '')? '해제':'설정') + "</a><\/li>";
} else {
nxthtml += "><li><a onmousedown=\"chtipths('" + ip + "','" + thsi + "')\"><span>&bull;<\/span> 귓속말</a><\/li><li><a onmousedown=\"cht_11chat('" + ip + "','" + thsi + "')\"><span>&bull;<\/span> 1:1 대화신청<\/a><\/li>";
if(chtualert != 5) nxthtml += "<li><a onmousedown=\"chtipths('" + ip + thsi + "','')\"><span>&bull;<\/span> 알림음 호출<\/a><\/li>";
if(cht_isadmin != 0) {nxthtml += "<li><a onmousedown=\"cht_kout('dumb_" + ip + "','" + thsi + "',4)\"><span>&bull;<\/span> 글쓰기 차단/해제<\/a><\/li><li><a onmousedown=\"cht_kout('" + ip + "','" + thsi + "',3)\"><span>&bull;<\/span> 강퇴<\/a><\/li><li><a onmousedown=\"cht_obj.value='" + ip + "'\"><span>&bull;<\/span> IP 보기<\/a><\/li>";
if(cht_isadmin == 2 && chtmkadmin) nxthtml += "<li><a onmousedown=\"cht_kout('adm_" + ip + "','" + thsi + "',5)\"><span>&bull;<\/span> 관리자로 지명<\/a><\/li>";
}}
nxthtml += "<\/ul>";
cht_imopn = true;
cht_nxthtml = chtnx_thtml;
cht_nxth_tml = chtnx_thtml;
chtnx_thtml.innerHTML = nxthtml;
chtnx_thtml.style.display = 'block';
chtnx_thtml.style.margin = '0';
if(n !== 2) return 1;
else if(chthorizon == 'v' && chtaacc != 2) cht_aadd(2);
}}
function cht_kout(xban, xnick, xnum) {
if(cht_isadmin != 0){
if(chtisbk) var chtlgnf = document.logox;
else var chtlgnf = chtlgnfw.document.logox;
if((xnum === 3 && confirm(xnick + "님을 강퇴합니다")) || (xnum === 4 && confirm(xnick + "님의 글쓰기를 차단/차단해제합니다.")) || (xnum === 5 && confirm(xnick + "님을 관리자로 추가 지명합니다."))) {
chtlgnf.ban.value = xban;
chtlgnf.nick.value = xnick;
} else chtlgnf.delf.value = xnick;
chtlgnf.submit();
}}
function tout() {
dallar('cht_gout').value = '1';
}
function chtaablk() {
if(chtblk == 1 || new Date().getTime() -  chtaablkc > 10000) {
dallar('cht_AA').style.visibility = 'visible';
document.title = chttitle;
chtblk = 1;
} else {
dallar('cht_AA').style.visibility = (dallar('cht_AA').style.visibility == 'hidden')? 'visible':'hidden';
document.title = (document.title != chttitle)? chttitle:chtctitle;
setTimeout("chtaablk()",200);
}}
function chtonclick(n) {
if(cht_imopn) {cht_imgview(0);chtblk = 1;}
}
function chtxdel(ths,xno) {
if(confirm("'" + ths.parentNode.innerHTML.replace(/<[^>]+>/g,"").replace(/&[ag]t;/,"::") + "' 이 글을 삭제하시겠습니까")) {
var chtlgnf = chtlgnfw.document.logox;
if(chtlgnf) {chtlgnf.dxno.value = xno;chtlgnf.submit();}
}}
function tinvert(r) {
var sel = document.getElementsByName('xbak[]');
if(r) r = parseInt(sel.length/2); else r = sel.length - 1;
for(var i = r; i >= 0;i--) {
if(sel[i].checked) sel[i].checked = false;
else sel[i].checked = true;
}}
function finvert(r) {
var sel = document.getElementsByName('xbak[]');
var del = document.getElementsByClassName('cx');
if(r) r = parseInt(sel.length/2); else r = sel.length - 1;
for(var i = r; i >= 0;i--) {
if(del[i] && del[i].getElementsByTagName('input').length >= 2) {
if(sel[i].checked) sel[i].checked = false;
else sel[i].checked = true;
} else sel[i].checked = false;
}}
function fsubmit() {
document.bakform.torf.value = 1;
var sel = document.getElementsByName('xbak[]');
var del = document.getElementsByClassName('cx');
var fel;
for(i = sel.length - 1; i >= 0;i--) {
sel[i].value = '';
if(sel[i].checked == true && del[i]) {
fel = del[i].getElementsByTagName('input')[1];
if(!!fel) sel[i].value = chtdelff(fel.nextSibling);
}}
ssubmit();
}
function ssubmit() {
var sel = document.getElementsByName('xbak[]');
var xel = '';
for(i = sel.length - 1; i >= 0;i--) {
if(sel[i].checked) {
xel += "_" + sel[i].title;
}}
document.bakform.dnox.value = xel.slice(1);
document.bakform.submit();
}
function chtonkeydown(e) {
if(typeof(event) == "undefined") {var keycode = e.which;var etarget = e.target;}
else {var keycode = event.keyCode;var etarget = event.srcElement;}
if(keycode =='13' && etarget && etarget.id == 'chcontent') cht_go('rpage');
}
function mkdumb(mkd) {
if(mkd === 1) {
dallar('cht_UU').style.display = 'none';
dallar('cht_dumb').value = '1';
} else if(dallar('cht_dumb').value == '1') {
dallar('cht_UU').style.display = '';
dallar('cht_dumb').value = '0';
}}
var chtx, chty, chtry = 0;
function chtxy(e) {
if(typeof(event) == "undefined") {chtx = e.pageX;chty = e.pageY;}
else {chtx = event.clientX;chty = event.clientY;}
if(chtry !== 0) {
dallar("cht_fbdy").style.left = (chtx - chtry[0] + parseInt(chtry[2])) + "px";
dallar("cht_fbdy").style.top = (chty - chtry[1] + parseInt(chtry[3])) + "px";
}}
window.onbeforeunload = function(){if(!chtisbk && chtunload) {if(dallar('cht_gout').value == '0'){if(cht_go('out')){dallar('cht_gout').value = '9';if(navigator.appName == 'Opera') alert('접속을 종료합니다');else return "---";}}}}
window.onunload = function(){window.onbeforeunload();}
document.onmouseup = chtonclick;
document.onkeydown = chtonkeydown;
<?php
exit;
}}
$chtnoticed = '';
if($ftc = @fopen($chtfid.$rfrr."_chtntc","r")) {
$chtfbold = (int)fgets($ftc);
$chtfmly = trim(fgets($ftc));
$chtftsz = trim(fgets($ftc));
$chtimgmk = (int)fgets($ftc);
$chtunload = trim(fgets($ftc));
$chtuadmico = (int)fgets($ftc);
$chtuseico = (int)fgets($ftc);
$chtusealert = (int)fgets($ftc);
$chtnoticet = (int)fgets($ftc);
$chtnoticex = (int)fgets($ftc);
$chtwidth_ = trim(fgets($ftc));if(!isset($chtwidth)) $chtwidth = $chtwidth_;
$chtheight_ = trim(fgets($ftc));if(!isset($chtheight)) $chtheight = $chtheight_;
$chthorizon_ = trim(fgets($ftc));if(!isset($chthorizon)) $chthorizon = $chthorizon_;
$cht_cntwh_ = trim(fgets($ftc));if(!isset($cht_cntwh)) $cht_cntwh = $cht_cntwh_;
$cht_usrwh_ = trim(fgets($ftc));if(!isset($cht_usrwh)) $cht_usrwh = $cht_usrwh_;
$chtbakbak = (int)fgets($ftc);
$chtmyself = (int)fgets($ftc);
$chtreload = (int)fgets($ftc);
$chtinterval = trim(fgets($ftc));
$chtcolorpk = (int)fgets($ftc);
$chtview = (int)fgets($ftc);
$chtimgmw = (int)fgets($ftc);
$chtmemberonly = (int)fgets($ftc);
$chtrefresh = (int)fgets($ftc);if(!isset($chtrefresh)) $chtrefresh = 1500;
$chtleave = (int)fgets($ftc);
$chtbakonly = trim(fgets($ftc));
$chtupdown = (int)fgets($ftc);
$chtlvico = (int)fgets($ftc);
$chtenter = (int)fgets($ftc);
$chtfitalic = (int)fgets($ftc);
$chtfunderline = (int)fgets($ftc);
$chtwrtpst = (int)fgets($ftc);
$chtusealert2 = (int)fgets($ftc);
$chtrefresh2 = (int)fgets($ftc);
$chturefresh = (int)fgets($ftc);
$chtfmobile = (int)fgets($ftc);
$chtncw = (int)fgets($ftc);
$chtcallt = (int)fgets($ftc);
$chtmemberonly2 = (int)fgets($ftc);
$chtlimit = (int)fgets($ftc);
$chtbtcnt = (int)fgets($ftc);
$chtread = (int)fgets($ftc);
$chtchange = (int)fgets($ftc);
$chtbtnicon = (int)fgets($ftc);
$chtscrollstop = (int)fgets($ftc);
$chtisblack = (int)fgets($ftc);
$chtusrinout = (int)fgets($ftc);
$chtvsthddn = (int)fgets($ftc);
$chtwstyle = explode(',',fgets($ftc));
$chtbtstyle = explode(',',fgets($ftc));
$chtbtstylee = trim(fgets($ftc));
$chtwhprcd = trim(fgets($ftc));
$chtnwidth = (int)fgets($ftc);
$chtcwidth = (int)fgets($ftc);
$chtftco = fgets($ftc);
$chtvdate = (int)$chtftco[0];
$chtvtime = (int)$chtftco[1];
$chtftco = fgets($ftc);
$chthsthddn = (int)$chtftco[0];
$chtclear = (int)$chtftco[1];
$chtvhead = (int)$chtftco[2];
$chtnextnk = substr($chtftco,3,-1);
while(!feof($ftc)) $chtnoticed .= fgets($ftc);
fclose($ftc);
if($chtismobile) $chtmemberonlyy = $chtmemberonly2;
else $chtmemberonlyy = $chtmemberonly;
if($chtismobile && $chtfmobile) $_SESSION['chtmobile'] = 1;
else unset($_SESSION['chtmobile']);
} else {$chtrefresh = 0;$chtbtnicon= 0;$chtnoticet = 0;}
if($_POST['xbak'] && $cht_isadmin) {
$xbakc = count($_POST['xbak']);
if($_POST['torf']) {
for($i = 0;$i < $xbakc;$i++) {
if($_POST['xbak'][$i]) ufiledell($_POST['xbak'][$i]);
}} else {
if($xbakc > 1) sort($_POST['xbak']);
if($chtbakbak) $fx = fopen($chtup."_backup_.txt","a");
$bk = fopen($chtbk,"r");
$bkk = fopen($chtbk."@@","w");
$m = 0;
while($memo = fgets($bk)) {
if(!in_array($m,$_POST['xbak'])) fputs($bkk,$memo);
else {if($chtbakbak) fputs($fx,$memo);utxtdell($memo);}
$m++;
}
fclose($bk);
fclose($bkk);
if($chtbakbak) fclose($fx);
copy($chtbk."@@",$chtbk);
unlink($chtbk."@@");
if($_POST['dnox']) {
$dnox = explode("_",$_POST['dnox']);
foreach($dnox as $dnnx) {
if($dnnx) @fclose(@fopen($chtdt.$dnnx,"w"));
}}}
echo "<script>location.replace('?chtid={$chtid}&v=backup');</script>";
exit;
}
if($_GET['xbk']) {
if(@filesize($chtbk) > 65536) {
if(copy($chtbk,$chtbk."2")) {
fclose(fopen($chtbk,"w"));
if($chtbakbak) {
$fx = fopen($chtup."_backup_.txt","a");
$fk = fopen($chtbk."2","r");
while($fko = fgets($fk)) fputs($fx,$fko);
fclose($fx);
fclose($fk);
}}}
exit;
}
if(!$cht_ismbr && $_COOKIE['mck'] == md5($_SESSION['mk']) && $_SESSION['m_nick']) {
$gboard = $_SESSION[$_SESSION[$_COOKIE[md5($_COOKIE['mck']."\x1b".$_SESSION['mk'])]]];
if(!$chtimgmk) $imgm = '';
else if($gboard[1] && file_exists("./icon/m20_".$gboard[1])) $imgm = $gboard[1];
$_SESSION['srchatsv'] = array($gboard[2],$imgm);
$chtnck = $_SESSION['m_nick'];
$_SESSION['chtnick'] = $chtnck;
}
$ischat = 0;
if($chtexit != 'exit') {
if(!isset($chtwidth)) $chtwidth = '450px';
if(!isset($chtheight)) $chtheight = '350px';
if(!isset($chthorizon)) $chthorizon = 'v';
if(!isset($cht_cntwh)) $cht_cntwh = '83.9%';
if(!isset($cht_usrwh)) $cht_usrwh = '16%';
if(!isset($chtfmly)) $chtfmly = 'gulim';
if(!isset($chtftsz)) $chtftsz = '9';
if(strpos($_SERVER['PHP_SELF'],$chat) !== false) {
$ischat = 1;
@header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="srchat 219.48" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' type='text/css' href='module/_chat.css' />
<style type='text/css'>
#cht_fbdy #cht_AA div, #cht_fbdy #cht_DD dt {font-family:<?php echo $chtfmly;?>;font-size:<?php echo $chtftsz;?>pt}
input,select {font-size:9pt}
.E73A {color:#E73A00}
</style>
<?php
}
if($_GET['v'] == "ban") {
$chtxword = '';
if($ff = @fopen($chtxwd,"r")) {
while($fff = trim(fgets($ff))) {
$chtxword[] = $fff;
}
fclose($ff);
}
if($_GET['admin'] == 1) {
?>
<title>관리자 기능</title>
</head>
<body id="cht_fbdy" style="border:0;text-align:center">
<?php
} else if(!isset($chtbtcnt)) {
?>
<script type="text/javascript">
parent.dallar('cht_fbdy').style.display = "block";
parent.dallar("cht_VV").style.display = "none";
</script>
<?php
} else {
?>
<script type="text/javascript">
var chtntc;
function aodmksty(aod,atyle) {
for(var t = atyle.length - 1;t >= 0;t--) {
eval("parent.dallar('" + aod + "').style." + atyle[t][0] + " = '" + atyle[t][1] + "';");
}}
function setup() {
parent.dallar('cht_fbdy').style.display = "block";
parent.dallar("cht_VV").style.display = "none";
<?php
function roon() {
global $chtfid;
$g = 0;
if($fff = @opendir($chtfid."_gst")) {
while($ffg = readdir($fff)) {
if(substr($ffg,0,2) == 'm_' && $ffg != 'm_') $g++;
}}
closedir($fff);
return $g;
}
if(!$cht_ismbr && $chtmemberonlyy == 3) {?>parent.cht_delt(parent.dallar('cht_fbdy'));<?php }
else if($chtlimit > 0 && !file_exists($chtmip.$chtip) && $chtlimit < roon()) echo "parent.dallar('cht_fbdy').innerHTML = '<p align=\'center\'>인원 제한 초과</p>';";
else {
$chtrefreshh = ($chtrefresh2 && $chtismobile)? $chtrefresh2:$chtrefresh;
?>
if(!parent.cht_obj) {
var chtwhprcd = <?php echo (int)$chtwhprcd;?>;
<?php
if(!$cht_ismbr && $chtmemberonlyy == 2) echo "parent.dallar('chtwtfm').style.display = 'none';\nparent.chtrefresh = ".($chtrefreshh*2).";\n"; else {$chtmemberonlyy = 0;echo "parent.chtrefresh = {$chtrefreshh};\n";}
if(file_exists($chtfid."_ban/dumb_".$chtip)) {?>parent.mkdumb(1);<?php }
$isbtnicon = 0;$chtthc = 0;
if($chtisblack == 1 || ($chtisblack == 2 && $chtismobile)) {?>parent.chtisblack = 1;<?php }
if($chtnwidth) {?>parent.chtnwidth = <?php echo $chtnwidth;?>;<?php }
if($chtcwidth) {?>parent.chtcwidth = <?php echo $chtcwidth;?>;
<?php }?>
var chtHHQ = parent.dallar("cht_fbdy").parentNode;
var chtHHP = 0,chtHHR = 0;
if(chtwhprcd || !parent.chtwidth) parent.chtwidth = '<?php echo $chtwidth;?>';
if(chtwhprcd || !parent.chtheight) parent.chtheight = '<?php echo $chtheight;?>';
chtHHP = parent.chtwidth.indexOf("%");
if(chtHHP == -1) chtHHP = parent.chtwidth.indexOf("mm");
if(chtHHP != -1) {parent.chtxw = (chtHHQ.offsetWidth * parent.chtwidth.substr(0,chtHHP) / 100) + 'px';parent.chtwidth = parent.chtxw;}
else parent.chtxw = parent.chtwidth;
parent.dallar('cht_HH').style.width = parent.chtxw;

chtHHP = parent.chtheight.indexOf("%");
if(chtHHP == -1) chtHHP = parent.chtheight.indexOf("mm");
if(chtHHP != -1) {
var chtHHS = <?php echo (($chtismobile)? 190:300)?>;
chtHHR = chtHHQ.offsetHeight;
if(chtHHR == 100 || chtHHR == 101 || chtHHR == 102) {
chtHHQ = chtHHQ.parentNode;
if(chtHHQ && chtHHQ != parent.document.body) {
if(chtHHQ.offsetHeight > chtHHR) chtHHR = chtHHQ.offsetHeight;
else {chtHHQ = chtHHQ.parentNode;
if(chtHHQ && chtHHQ != parent.document.body) {
if(chtHHQ.offsetHeight > chtHHR) chtHHR = chtHHQ.offsetHeight;
else {chtHHQ = chtHHQ.parentNode;
if(chtHHQ && chtHHQ != parent.document.body) {
if(chtHHQ.offsetHeight > chtHHR) chtHHR = chtHHQ.offsetHeight;
else chtHHR = screen.height - chtHHS;
} else chtHHR = screen.height - chtHHS;
}} else chtHHR = screen.height - chtHHS;
}} else chtHHR = screen.height - chtHHS;
}
parent.chtxh = (chtHHR * parent.chtheight.substr(0,chtHHP) / 100) + 'px';
parent.chtheight = parent.chtxh;
} else parent.chtxh = parent.chtheight;
parent.dallar('cht_HH').style.height = parent.chtxh;
parent.chtlgnfw = self;
if(chtwhprcd || !parent.cht_cntwh) parent.cht_cntwh = '<?php echo $cht_cntwh;?>';
if(chtwhprcd || !parent.cht_usrwh) parent.cht_usrwh = '<?php echo $cht_usrwh;?>';
if(chtwhprcd || !parent.chthorizon) parent.chthorizon = '<?php echo $chthorizon;?>';
parent.dallar('neme').style.width = parent.chtnwidth + 'px';
parent.dallar('cht_color').style.width = parent.chtcwidth + 'px';
var chtvsthddn = '<?php echo $chtvsthddn;?>';
if(parent.chthorizon == 'h') {
if(parent.chtisblack == 1) parent.dallar('cht_DD').style.backgroundColor = '#1C1F28';
else parent.dallar('cht_DD').style.backgroundColor = '#FAFAFA';
if(chtvsthddn == '1') {aodmksty('cht_AA',[['width','100%'],['height',parent.chtheight]]);aodmksty('cht_DD',[['width','0'],['height',parent.chtheight],['display','none']]);}
else {aodmksty('cht_AA',[['width',parent.cht_cntwh],['height',parent.chtheight]]);aodmksty('cht_DD',[['width',parent.cht_usrwh],['height',parent.chtheight]]);}
} else {
if(chtvsthddn == '1') {aodmksty('cht_AA',[['width',parent.chtwidth],['height',parent.chtheight]]);aodmksty('cht_DD',[['width',parent.chtwidth],['height',0],['borderBottom','1px solid #CEDEFF']]);
} else {aodmksty('cht_AA',[['width',parent.chtwidth],['height',parent.cht_cntwh]]);aodmksty('cht_DD',[['width',parent.chtwidth],['height',parent.cht_usrwh],['borderBottom','1px solid #CEDEFF']]);}
}
if(parent.chtisblack == 1) {
parent.dallar('cht_fbdy').style.backgroundColor = '#000000';
parent.dallar('cht_fbdy').style.color = '#FFFFFF';
parent.dallar('neme').style.backgroundColor = '#000000';
parent.dallar('neme').style.color = '#FFFFFF';
parent.dallar('chcontent').style.color = '#FFFFFF';
parent.dallar('chcontent').style.backgroundColor = '#000000';
parent.fbcolor[0] = '#FFFFFF';
}
parent.chtbtcnt = <?php echo (int)$chtbtcnt;?>;
parent.chtread = <?php echo (int)$chtread;?>;
parent.chtchange = <?php echo (int)$chtchange;?>;
parent.chtimgmk = <?php echo (int)$chtimgmk;?>;
parent.chtcallt = <?php echo (int)$chtcallt*1000;?>;
parent.chtlvico = <?php echo (($chtlvico)? 'true':'false')?>;
parent.chtusrinout = <?php echo (int)$chtusrinout;?>;
parent.chtvban = <?php echo (int)$chtvban;?>;
parent.chtncw = <?php echo (int)$chtncw;?>;
<?php
if($chtinterval) {?>parent.chtinterval = <?php echo $chtinterval;?>;
<?php } if($chtwstyle[0]) {?>aodmksty('cht_fbdy',[['position','<?php echo (($chtwstyle[0] == 1)? 'absolute':'fixed')?>'],['zIndex','99'],['<?php echo $chtwstyle[1];?>','<?php echo $chtwstyle[2];?>'],['<?php echo $chtwstyle[3];?>','<?php echo $chtwstyle[4];?>']]);
parent.dallar('cht_CC').setAttribute('onmousedown','var ry=dallar("cht_fbdy");chtry=Array(chtx,chty,ry.style.left,ry.style.top)');
parent.dallar('cht_CC').setAttribute('onmouseup','chtry=0');
parent.dallar('cht_CC').setAttribute('onmouseout','chtry=0');
<?php } if($chthsthddn) {?>parent.dallar('cht_CC').style.display = 'none';
<?php if(!!$chtvhead) {?>parent.dallar('cht_ZZ').style.display = '';
<?php }} if($chtbtstyle[0]) {?>aodmksty('cht_VV',[['position','<?php echo (($chtbtstyle[0] == 1)? 'absolute':'fixed')?>'],['zIndex','99'],['<?php echo $chtbtstyle[1];?>','<?php echo $chtbtstyle[2];?>'],['<?php echo $chtbtstyle[3];?>','<?php echo $chtbtstyle[4];?>']]);
<?php } if(!$chtuimg || ($chtuimg == 2 && $chtismobile)) {?>parent.chtuimg = true;
<?php } if(!$chtiimg || ($chtiimg == 2 && $chtismobile)) {?>parent.chtiimg = true;
<?php } if($cht_isadmin) {?>parent.cht_isadmin = <?php echo (int)$cht_isadmin;?>;
<?php } if($chtview || $chtismobile) {?>parent.chtview = <?php echo $chtview;?>;
<?php } if($chtvdate == 2 || ($chtvdate == 3 && !$chtismobile)) {?>parent.chtvdate = true;
<?php } if($chtvtime == 1 || ($chtvitme == 2 && $chtismobile)) {?>parent.chtvtime = false;parent.dallar('cht_FF').style.display = 'none';parent.dallar('cht_OO').style.margin = '0';
<?php } if($chtimgmw) {?>parent.chtimgmw = <?php echo (int)$chtimgmw;?>;
<?php } if($chtvimg) {?>parent.chtvimg = <?php echo (int)$chtvimg;?>;
<?php } if($chtmkadmin == -1) {?> parent.chtmkadmin = true;
<?php } if(!!$chtnextnk) {?> parent.chtnextnk = "<?php echo $chtnextnk;?>";
<?php } if($chtmemberonlyy != 2 && ($chtuseico === 1 || ($chtuseico === 3 &&!$chtismobile) || ($chtuseico === 4 && $chtismobile))) {?>parent.dallar('cht_LL').style.display = '';
<?php } if($chtbtnicon != 0 && ($chtbtnicon === 1 || ($chtbtnicon === 3 &&!$chtismobile) || ($chtbtnicon === 4 && $chtismobile))) {$isbtnicon = 1;?>parent.dallar('cht_chkdiv').style.display = 'none';parent.dallar('cht_XX').style.display = 'block';
<?php } else if(!$chtuseico) {?>parent.dallar('cht_LL').title = 'disabled';
<?php } if($chtmemberonlyy != 2 && ($chtfbold === 1 || ($chtfbold === 3 &&!$chtismobile) || ($chtfbold === 4 && $chtismobile))) {?>parent.dallar('cht_MM').style.display = '';
<?php } else if(!$chtfbold) {?>parent.dallar('cht_MM').title = 'disabled';
<?php } if($chtmemberonlyy != 2 && ($chtfitalic === 1 || ($chtfitalic === 3 &&!$chtismobile) || ($chtfitalic === 4 && $chtismobile))) {?>parent.dallar('cht_PP').style.display = '';
<?php } else if(!$chtfitalic) {?>parent.dallar('cht_PP').title = 'disabled';
<?php } if($chtmemberonlyy != 2 && ($chtfunderline === 1 || ($chtfunderline === 3 &&!$chtismobile) || ($chtfunderline === 4 && $chtismobile))) {?>parent.dallar('cht_QQ').style.display = '';
<?php } else if(!$chtfunderline) {?>parent.dallar('cht_QQ').title = 'disabled';
<?php } if($chturefresh === 1 || ($chturefresh === 3 &&!$chtismobile) || ($chturefresh === 4 && $chtismobile)) {?>parent.dallar('cht_RR').style.display = '';
<?php } else if(!$chturefresh) {?>parent.dallar('cht_RR').title = 'disabled';
<?php } if($chtclear === 1 || ($chtclear === 3 &&!$chtismobile) || ($chtclear === 4 && $chtismobile)) {?>parent.dallar('cht_WW').style.display = '';
<?php } else if(!$chtclear) {?>parent.dallar('cht_WW').title = 'disabled';
<?php } if($chtvhead === 1 || ($chtvhead === 3 &&!$chtismobile) || ($chtvhead === 4 && $chtismobile)) {?>parent.dallar('cht_ZZ').style.display = '';
<?php } else if(!$chtvhead) {?>parent.dallar('cht_ZZ').title = 'disabled';
<?php } if($chtupdown !== 1 && (!$chtismobile || $chtupdown !== 2) && ($chtscrollstop === 1 || ($chtscrollstop === 3 &&!$chtismobile) || ($chtscrollstop === 4 && $chtismobile))) {?>parent.dallar('cht_SS').style.display = '';
<?php } else if(!$chtscrollstop || $chtupdown === 1 || ($chtismobile && $chtupdown === 2)) {?>parent.dallar('cht_SS').title = 'disabled';
<?php } if($chtleave == 0) {?>parent.dallar('cht_OO').title = 'disabled';parent.dallar('cht_OO').style.display = 'none';
<?php } if($chtreload > 2) { if($chtismobile) {?>parent.chtreload = 1;<?php } else if($chtreload == 4) {?>parent.chtreload = 2;<?php }} else {?>parent.chtreload = <?php echo (int)$chtreload;?>;
<?php } if($chtpnck == 2 || $chtpnck == 3) {$chtthc += 1;?>parent.dallar('neme').style.display = 'none';parent.dallar('cht_color').style.display = 'none';parent.dallar('chtnecolor').style.width = '1px';
<?php } if($chtpnck == 4 || $chtpnck == 5) {$chtthc += 1;?>parent.dallar('cht_color').style.display = 'none';
<?php } if($chtpnck == 1 || $chtpnck == 2 || $chtpnck == 5 || $cht_ismbr) {if($chtpnck == 1 || $chtpnck == 2 || $chtpnck == 5) $chtthc += 2;?>parent.dallar('neme').readOnly = 'readOnly';
<?php }
$chtnck = ($_SESSION['chtnick'])? $_SESSION['chtnick']:'손님_'.substr($chtip,-4);
?>
parent.chtafst = 'font-family:<?php echo $chtfmly;?>;font-size:<?php echo $chtftsz;?>pt;';
parent.chtuadmico = <?php echo (($chtuadmico)? 'true':'false')?>;
parent.chtmyself = <?php echo (($chtmyself == 3)? (($chtismobile)? 1:2):(int)$chtmyself)?>;
parent.chtunload = <?php echo (($chtunload == 'Y' || ($chtunload != 'T' && strpos($_SERVER['HTTP_REFERER'],$chat) !== false))? 'true':'false')?>;
parent.chtip = '<?php echo $chtip;?>';
chtntc = document.getElementById('chtnoticed').value;
parent.chttalert = <?php echo (int)$chtusealert*1000;?>;
parent.chtualert = <?php echo (int)$chtusealert2;?>;
var neme = '<?php echo $chtnck;?>';
if(neme && parent.dallar('neme').value != neme) {parent.dallar('neme').value = '<?php echo $chtnck;?>';parent.dallar('cht_pnam').value = '<?php echo $chtnck;?>';}
}
<?php
if($chtxword) {
echo "parent.dph = Array(";
foreach($chtxword as $fpp) echo "'{$fpp}',";
echo "'');\n";
}
$iswrtpst = 0;
if($chtismobile) {
?>parent.chtismobile = 1;parent.dallar('cht_chkdiv').innerHTML = parent.dallar('cht_chkdiv').innerHTML + "<img onclick='cht_go(\"rpage\")' src='" + parent.chtedir + "srchat_w.gif' />";<?php
if($chtupdown != 0) {?>parent.chtupdown = 1;<?php }
if($chtwrtpst != 0) {$iswrtpst = 1;?>parent.chtwrtpst = true;<?php }
} else {
if($chtisie6) {?>parent.chtismobile = 2;<?php }
if($chtupdown == 1) {?>parent.chtupdown = 1;<?php }
if($chtwrtpst == 1) {$iswrtpst = 1;?>parent.chtwrtpst = true;<?php }
}
if($isdid && ($chtismobile != 3 || $chtiswin)) {
?>parent.dallar('chtupload').innerHTML="<iframe src='" + parent.chtsrchat + "&amp;v=file' frameborder='0'></iframe>";<?php
} else {?>parent.dallar('chtupload').style.display='none';<?php }
if($cht_isadmin) {
if($chtbakonly == '30')  echo "parent.dallar('chtadmin').style.display = 'none';\n";
} else echo "parent.dallar('chtadmin').innerHTML = 'false';\nparent.dallar('chtadmin').style.display = 'none';\n";
if($chtcolorpk != 4 && (!$chtcolorpk || ($chtcolorpk != '3' && $cht_ismbr) || $cht_isadmin)) {
if($chtthc != 1 && $chtthc != 3) {?>parent.dallar('cht_color').style.display = 'inline';<?php }
if($chtthc) {?>parent.dallar('cht_TT').style.display = '';
<?php if($chtpnck == 4 || $chtpnck == 5) {?>parent.chtvcolor = 2;<?php } else {?>parent.chtpnck = 1;<?php }?>
<?php }} else {?>parent.dallar('cht_color').title = 'disabled';parent.chtvcolor = 3;<?php if($chtthc == 2 || $chtthc == 3) {$chtthc = 5;?>parent.dallar('cht_TT').style.display = 'none';parent.chtpnck = 2;
<?php } else if($chtthc) {?>parent.dallar('cht_TT').style.display = '';parent.chtpnck = 1;
<?php }} if($chtbakonly[0] == '1' || ($chtbakonly[0] == '2' && $cht_ismbr) || $cht_isadmin) {
if($chtbakonly[1] != '1') {?>parent.dallar('chtbackup').style.display = 'none';<?php }
} else echo "parent.dallar('chtbackup').style.display = 'none';\nparent.dallar('chtbackup').innerHTML = 'false';\n";
}
if(($chtenter && substr($chtid,0,2) != '__') || ($chtleave && $_SESSION['cht_out'] == $chtid)) $chenter = 1;
else $chenter = 3;

if($iswrtpst == 1) {?>
parent.chtwrtpst = true;
parent.dallar('cht_UU').style.width = parent.dallar('cht_HH').offsetWidth + 'px';
var chtwtfmh = ('<?php echo $chtncw;?>' == '1' || '<?php echo $chtthc;?>' == '5')? 46:66;
<?php
if($isbtnicon == 0) {?>chtwtfmh += 23;<?php }
if($chtncw || $chtpnck == 2 || $chtpnck == 3) {?>chtwtfmh -= 21;<?php }?>
var cht_HHh = parent.dallar('cht_HH').offsetHeight;
parent.dallar('cht_HH').style.marginTop = chtwtfmh + 'px';
parent.dallar('cht_UU').style.marginTop = (-chtwtfmh + -cht_HHh) + 'px';
parent.dallar('cht_UU').style.position = 'absolute';
parent.dallar('cht_HH').style.borderTop = '1px solid #CEDEFF';
<?php }?>
var chcontentw = ('<?php echo $chtncw;?>' == '1')? 14 + parent.dallar('chtnecolor').offsetWidth:14;
var chcontentww = 0;var chcontenww = 0;
<?php if($isbtnicon != 0) {if($isdid) {?>chcontentww += 36;<?php }
else {?>chcontentww += 16;chcontenww -= 16;<?php }}
else if($isdid) {?>chcontenww += 20;<?php }?>
chcontentw += chcontentww;
fbdyww(chcontentw, chcontentww, chcontenww);
}
function fbdyww(fdya, fdyb, fdyc) {
var fw = parent.dallar('cht_HH').offsetWidth;
if(fw == 0) {
if(parent.chtwidth.slice(-2) == 'px') fw = parseInt(parent.chtwidth.slice(0,-2));
else if(parent.chtwidth.slice(-1) == '%') fw = parseInt(parent.chtwidth.slice(0,-1))*parent.dallar('cht_fbdy').parentNode.offsetWidth;
}
if(fw > 0) {
parent.fbdyw = fw;
parent.dallar('cht_fbdy').style.width = fw + 'px';
parent.dallar('cht_UU').style.width = fw + 'px';
parent.dallar('chcontent').style.width = fw - fdya + 'px';
parent.dallar('cht_chkdiv').style.width = parseInt(fw - fdyb - fdyc) + 'px';
if(!parent.cht_obj) {
setInterval("document.getElementById('chtdelbak').contentWindow.location.reload()",300000);
if(parent.document.readyState == "complete") {parent.cht_setup();chtnotic();}
else setTimeout("parent.cht_setup();chtnotic();",500);
}}}
function chtnotic() {
chtntc = document.getElementById('chtnoticed').value;
if("<?php echo $chtnoticet;?>" != "0" && "<?php echo $chtnoticet;?>" != "" && chtntc != "") {
var chtnts = chtntc.split("###");
var chtntsl = chtnts.length;
var chtnoticet = <?php echo $chtnoticet*1000;?>;
var chtnoticel = chtntsl*chtnoticet;
var ii = 0;
for(var i=0;i < chtntsl;i++) {
ii = chtnoticet * (i + 1);
setTimeout("parent.cht_inn(\"" + chtnts[i] + "\",<?php echo $chtnoticex*1000;?>)",ii);
setTimeout("setInterval(\"parent.cht_inn(\\\"" + chtnts[i] + "\\\",<?php echo $chtnoticex*1000;?>)\"," + chtnoticel + ")",ii);
}}}
function chtenter(ths) {
if(ths == 3) setup();
else {
parent.chtlgnfw = self;
<?php if($chtbtstyle[0]) {?>aodmksty('cht_VV',[['position','<?php echo (($chtbtstyle[0] == 1)? 'absolute':'fixed')?>'],['zIndex','99'],['<?php echo $chtbtstyle[1];?>','<?php echo $chtbtstyle[2];?>'],['<?php echo $chtbtstyle[3];?>','<?php echo $chtbtstyle[4];?>']]);
<?php }?>
parent.dallar('cht_fbdy').style.display="none";
parent.dallar("cht_VV").innerHTML = "<input type='button' value=' 채팅방 입장 ' onclick=\"chtlgnfw.chtopen(" + ths + ")\" style=\"<?php echo $chtbtstylee;?>\" \/>";
parent.dallar("cht_VV").style.display = "";
if(ths == 1 && '<?php echo $chtbtcnt;?>' == '1') {parent.chtbtcnt = 1;parent.dallar('cht_gout').value='9';parent.dallar('cht_xtim').value = '4';parent.cht_go('read');
}}}
function chtopen(ths) {
parent.dallar('cht_fbdy').style.display = "block";
parent.dallar("cht_VV").style.display = "none";
parent.cht_imgview(0);
if(ths == 2) {
parent.dallar('cht_OO').style.borderWidth='0px';
parent.dallar('cht_AA').innerHTML='';
parent.dallar('cht_ntim').value='0000000000a';
parent.cht_go('in');
} else setup();
}
</script>
</head>
<body id="cht_fbdy" style="border:0;overflow:hidden;text-align:center" onload="setTimeout('chtenter(<?php echo $chenter;?>)',10)">
<textarea id="chtnoticed" cols="1" rows="1" style="display:none"><?php echo str_replace('"','#34;',str_replace("'","#39;",$chtnoticed))?></textarea>
<iframe id="chtdelbak" src="?chtid=<?php echo $chtid;?>&xbk=1" frameborder="0" style="display:none"></iframe>
<?php
}
if($cht_isadmin) {
?>
<form name="logox" style="margin:0 0 50px 0" method="post" action="<?php echo $chat;?>">
<input type="hidden" name="chtid" value="<?php echo $chtid;?>" />
<input type="hidden" name="ban" value="" />
<input type="hidden" name="nick" value="" />
<input type="hidden" name="delf" value="" />
<input type="hidden" name="delcht" value="" />
<input type="hidden" name="dxno" value="" />
<input type="hidden" name="rfrr" value="<?php echo $rfrr;?>" />
<?php
if($_GET['admin'] == 1) {
if($chtfid) {
?>
<script type='text/javascript'>
function expln(val) {
var ep = document.getElementById('exp');
if(val) {ep.style.width=(document.getElementsByTagName('div')[1].scrollWidth - 20) + 'px';ep.innerHTML=val;ep.style.display='';}
else {ep.style.display='none';}}
</script>
<div id='exp' style='display:none;position:fixed;top:0;width:90%;padding:10px;text-align:center;margin:0 auto;background-color:#FFF45F;border:1px solid #000000'></div>
<h3>관리자 기능 (srchat 219.48) :: chtid=<?php echo $chtid;if($rfrr) echo " - ".$rfrr;?></h3>
<div class='cht_addv'>금지된 표현</div>
<?php if($chtxword) {foreach($chtxword as $fpp) {?>
<input type="text" name="xword[]" class="cht_ipt" value="<?php echo $fpp;?>" />&nbsp;
<?php }}?>
<br /><input type="text" name="xword[]" class="cht_ipt" />
<div class='cht_addv'>접속차단된 IP</div>
<?php
if(file_exists($chtfid."_ban/")) {
$ff = opendir($chtfid."_ban/");
while($fff = readdir($ff)) {
if($fff != '.' && $fff != '..') {
$a = fopen($chtfid."_ban/".$fff,"r");$aa = fgets($a);fclose($a);
if($aa) {$aa = explode("\x1b",$aa);$aa = "NAME : ".$aa[1]." , DATE : ".date("m-d H:i:s",$aa[0])." , BY : ".$aa[2];}
?>
<input type="text" name="prhd[]" class="cht_ipt" value="<?php echo $fff;?>" onfocus="document.getElementById('prhdex').value = '<?php echo $aa;?>'" />&nbsp;
<?php
}}
closedir($ff);
}
?>
<br /><input type="text" id="prhdex" class="cht_ipex" />
<?php
if($cht_isadmin == 2) {
if($chtmkadmin == -1) {
?>
<div class='cht_addv'>관리자로 지명된 IP</div>
<?php
$ff = opendir($chtfid);
while($fff = readdir($ff)) {
if($fff != '.' && $fff != '..' && substr($fff,0,4) == 'adm_') {
$a = fopen($chtfid.$fff,"r");$aa = fgets($a);fclose($a);
if($aa) {$aa = "NAME : ".substr($aa,10)." , DATE : ".date("m-d H:i:s",substr($aa,0,10));}
?>
<input type="text" name="mkadm[]" class="cht_ipt" value="<?php echo $fff;?>" onfocus="document.getElementById('mkadminx').value = '<?php echo $aa;?>'" />&nbsp;
<?php
}}
closedir($ff);
?>
<br /><input type="text" id="mkadminx" class="cht_ipex" />
<?php
}
?>
<div class='cht_addv'>높이,넓이,형태</div>
<br />전체 넓이 : <input type="text" name="chtwidth_" class="cht_ipt" style="width:40px" value="<?php echo $chtwidth;?>" />
<br />전체 높이 : <input type="text" name="chtheight_" class="cht_ipt" style="width:40px" value="<?php echo $chtheight;?>" />
<br /><label><input name="chthorizon_" type="radio" value="v" <?php if($chthorizon == 'v') echo "checked=\"checked\"";?> /> 세로 2단</label>&nbsp; <label><input name="chthorizon_" type="radio" value="h" <?php if($chthorizon != 'v') echo "checked=\"checked\"";?> /> 가로 2단</label>
<br /><span onmouseover="expln('가로2단에서는 넓이, 세로2단에서는 높이')" onmouseout="expln()">채팅본문 : </span><input type="text" name="cht_cntwh_" class="cht_ipt" style="width:40px" value="<?php echo $cht_cntwh;?>" />
<br /><span onmouseover="expln('가로2단에서는 넓이, 세로2단에서는 높이')" onmouseout="expln()">접속자란 : </span><input type="text" name="cht_usrwh_" class="cht_ipt" style="width:40px" value="<?php echo $cht_usrwh;?>" />
<br /><span onmouseover="expln('위의 크기 설정값을 다른 설정값보다 우선할지 여부')" onmouseout="expln()">크기 설정 우선적용 : </span><label><input name="chtwhprcd_" type="radio" value="0" <?php if(!$chtwhprcd) echo "checked=\"checked\"";?> /> 하지 않음</label>&nbsp; <label><input name="chtwhprcd_" type="radio" value="1" <?php if($chtwhprcd) echo "checked=\"checked\"";?> /> 우선함</label>
<br /><br /><span class='E73A'>세로 2단 높이 = 채팅본문(높이) + 접속자란(높이)
<br />가로 2단 넓이 = 채팅본문(넓이) + 접속자란(넓이)</span>
<br /><br /><span onmouseover="expln('채팅방 헤드(cht_CC)를 감춤/보임.')" onmouseout="expln()">채팅방 헤드 :: </span><label><input name="chthsthddn_" type="radio" value="1" <?php if($chthsthddn) echo "checked=\"checked\"";?> /> 감춤</label>&nbsp; <label><input name="chthsthddn_" type="radio" value="0" <?php if(!$chthsthddn) echo "checked=\"checked\"";?> /> 드러냄</label>
<br /><span onmouseover="expln('최초에 접속자란(cht_DD)을 감춤/보임. - 헤드를 클릭해서 변경 가능함.')" onmouseout="expln()">접속자란 :: </span><label><input name="chtvsthddn_" type="radio" value="1" <?php if($chtvsthddn) echo "checked=\"checked\"";?> /> 감춤</label>&nbsp; <label><input name="chtvsthddn_" type="radio" value="0" <?php if(!$chtvsthddn) echo "checked=\"checked\"";?> /> 드러냄</label>
<br /><br /><span onmouseover="expln('채팅방 스타일 position 설정 (absolute:페이지의 특정 위치에 고정, fixed:모니터의 특정 위치에 고정, static:변동없음)')" onmouseout="expln()">채팅방 position :: </span><label onclick="document.getElementById('chtwstyle').style.display='block';"><input name="chtwfixed_" type="radio" value="1" <?php if($chtwstyle[0] == 1) echo "checked=\"checked\"";?> /> absolute</label>&nbsp; <label onclick="document.getElementById('chtwstyle').style.display='block';"><input name="chtwfixed_" type="radio" value="2" <?php if($chtwstyle[0] == 2) echo "checked=\"checked\"";?> /> fixed</label>&nbsp; <label onclick="document.getElementById('chtwstyle').style.display='none';"><input name="chtwfixed_" type="radio" value="0" <?php if(!$chtwstyle[0]) echo "checked=\"checked\"";?> /> static</label>
<div id='chtwstyle' style='display:<?php echo ($chtwstyle[0])? 'block':'none';?>'>채팅방 위치 :: <select name="chtwstylea_"><option value='top' <?php if($chtwstyle[1] == 'top') {?>selected='selected'<?php }?>>top</option><option value='bottom' <?php if($chtwstyle[1] == 'bottom') {?>selected='selected'<?php }?>>bottom</option></select>:<input type="text" name="chtwstyleb_" class="cht_ipt" style="width:40px" value="<?php echo $chtwstyle[2];?>" onmouseover="expln('숫자에 단위(px, %, em, pt,...) 붙여서')" onmouseout="expln()" /> <select name="chtwstylec_"><option value='left' <?php if($chtwstyle[3] == 'left') {?>selected='selected'<?php }?>>left</option><option value='right' <?php if($chtwstyle[3] == 'right') {?>selected='selected'<?php }?>>right</option></select>:<input type="text" name="chtwstyled_" class="cht_ipt" style="width:40px" value="<?php echo $chtwstyle[4];?>" onmouseover="expln('숫자에 단위(px, %, em, pt,...) 붙여서')" onmouseout="expln()" /> (숫자에 단위(px, %, em, pt,...) 붙여서)</div>
<br /><span onmouseover="expln('입장버튼 스타일 position 설정 (absolute:페이지의 특정 위치에 고정, fixed:모니터의 특정 위치에 고정, static:변동없음)')" onmouseout="expln()">입장버튼 position :: </span><label onclick="document.getElementById('chtbtstyle').style.display='block';"><input name="chtbtfixed_" type="radio" value="1" <?php if($chtbtstyle[0] == 1) echo "checked=\"checked\"";?> /> absolute</label>&nbsp; <label onclick="document.getElementById('chtbtstyle').style.display='block';"><input name="chtbtfixed_" type="radio" value="2" <?php if($chtbtstyle[0] == 2) echo "checked=\"checked\"";?> /> fixed</label>&nbsp; <label onclick="document.getElementById('chtbtstyle').style.display='none';"><input name="chtbtfixed_" type="radio" value="0" <?php if(!$chtbtstyle[0]) echo "checked=\"checked\"";?> /> static</label>
<div id='chtbtstyle' style='display:<?php echo ($chtbtstyle[0])? 'block':'none';?>'>입장버튼 위치 :: <select name="chtbtstylea_"><option value='top' <?php if($chtbtstyle[1] == 'top') {?>selected='selected'<?php }?>>top</option><option value='bottom' <?php if($chtbtstyle[1] == 'bottom') {?>selected='selected'<?php }?>>bottom</option></select>:<input type="text" name="chtbtstyleb_" class="cht_ipt" style="width:40px" value="<?php echo $chtbtstyle[2];?>" onmouseover="expln('숫자에 단위(px, %, em, pt,...) 붙여서')" onmouseout="expln()" /> <select name="chtbtstylec_"><option value='left' <?php if($chtbtstyle[3] == 'left') {?>selected='selected'<?php }?>>left</option><option value='right' <?php if($chtbtstyle[3] == 'right') {?>selected='selected'<?php }?>>right</option></select>:<input type="text" name="chtbtstyled_" class="cht_ipt" style="width:40px" value="<?php echo $chtbtstyle[4];?>" onmouseover="expln('숫자에 단위(px, %, em, pt,...) 붙여서')" onmouseout="expln()" /> (숫자에 단위(px, %, em, pt,...) 붙여서)</div>
<br />입장버튼 스타일 정의 : <input type="text" name="chtbtstylee_" class="cht_ipt" style="width:200px" value="<?php echo $chtbtstylee;?>" />
<br />ex)<span class='E73A'>border:0; background-color:#F7F7F7; border:1px solid #39ABB6;</span>
<div class='cht_addv'>공지</div>각각의 공지 사이의 구분자는 ### 입니다.<br />
<textarea name="chtnoticed_" cols="1" rows="5" style="width:80%;height:50px;font-size:9pt"><?php echo $chtnoticed;?></textarea>
<br /><span onmouseover="expln('이 시간마다 공지를 노출합니다')" onmouseout="expln()">노출주기 : </span><input type="text" name="chtnoticet_" class="cht_ipt" style="width:40px" value="<?php echo $chtnoticet;?>" />초
<br /><span onmouseover="expln('노출된 공지를 이 시간 뒤에 지웁니다.')" onmouseout="expln()">삭제시간 : </span><input type="text" name="chtnoticex_" class="cht_ipt" style="width:40px" value="<?php echo $chtnoticex;?>" />초
<div class='cht_addv'>새 글 알림</div>
<br /><span onmouseover="expln('알림 표시하는 새글과 이전글의 시간간격 / 0으로 설정하면 시간간격 알림 사용 안 함')" onmouseout="expln()">알림 시간 간격 : </span><input type="text" name="chtusealert_" class="cht_ipt" style="width:40px" value="<?php echo $chtusealert;?>" />초
<br /><span>알림방법 : </span><select name="chtusealert2_" /><option value='0' <?php if(!$chtusealert2) {?>selected='selected'<?php }?>>소리</option><option value='2' <?php if($chtusealert2 == '2') {?>selected='selected'<?php }?>>깜박임</option><option value='3' <?php if($chtusealert2 == '3') {?>selected='selected'<?php }?>>소리+깜박임</option><option value='4' <?php if($chtusealert2 == '4') {?>selected='selected'<?php }?>>pc소리,mobile깜박임</option><option value='5' <?php if($chtusealert2 == '5') {?>selected='selected'<?php }?>>알림 사용 안 함</option></select>
<div class='cht_addv'>글꼴,크기</div>
<br />글꼴 :: <select name="chtfmly_">
<option value='Gulim' <?php if($chtfmly == 'Gulim') {?>selected='selected'<?php }?>>굴림</option>
<option value='Dotum' <?php if($chtfmly == 'Dotum') {?>selected='selected'<?php }?>>돋움</option>
<option value='Batang' <?php if($chtfmly == 'Batang') {?>selected='selected'<?php }?>>바탕</option>
<option value='Gungsuh' <?php if($chtfmly == 'Gungsuh') {?>selected='selected'<?php }?>>궁서</option>
<option value='Malgun Gothic' <?php if($chtfmly == 'Malgun Gothic') {?>selected='selected'<?php }?>>맑은고딕</option>
<option value='Arial' <?php if($chtfmly == 'Arial') {?>selected='selected'<?php }?>>Arial</option>
<option value='Tahoma' <?php if($chtfmly == 'Tahoma') {?>selected='selected'<?php }?>>Tahoma</option>
<option value='Verdana' <?php if($chtfmly == 'Verdana') {?>selected='selected'<?php }?>>Verdana</option>
<option value='Trebuchet MS' <?php if($chtfmly == 'Trebuchet MS') {?>selected='selected'<?php }?>>Trebuchet MS</option>
<option value='sans-serif' <?php if($chtfmly == 'sans-serif') {?>selected='selected'<?php }?>>sans-serif</option>
</select>
<br />크기 :: <select name="chtftsz_">
<option value='9' <?php if($chtftsz == '9') {?>selected='selected'<?php }?>>9pt</option>
<option value='8' <?php if($chtftsz == '8') {?>selected='selected'<?php }?>>8pt</option>
<option value='7' <?php if($chtftsz == '7') {?>selected='selected'<?php }?>>7pt</option>
<option value='10' <?php if($chtftsz == '10') {?>selected='selected'<?php }?>>10pt</option>
<option value='11' <?php if($chtftsz == '11') {?>selected='selected'<?php }?>>11pt</option>
<option value='12' <?php if($chtftsz == '12') {?>selected='selected'<?php }?>>12pt</option>
<option value='13' <?php if($chtftsz == '13') {?>selected='selected'<?php }?>>13pt</option>
<option value='15' <?php if($chtftsz == '15') {?>selected='selected'<?php }?>>15pt</option>
<option value='18' <?php if($chtftsz == '18') {?>selected='selected'<?php }?>>18pt</option>
</select>
<div class='cht_addv'>전체 대화방</div>
<?php
if($ff = @opendir($chtdate.$chtdata)) {
while($fg = readdir($ff)) {
if($fg != '.' && $fg != '..') {
$g = 0;$gh = 0;
if($fff = @opendir($chtdate.$chtdata."/".$fg."/_gst")) {
$gtl = array();
if($gte = @fopen($chtdate.$chtdata."/".$fg."/_gst/_guest","r")) {
while($gteg = fgets($gte)) {$gtl[] = substr($gteg,0,12);}
fclose($gte);
}
while($ffg = readdir($fff)) {
if(substr($ffg,0,2) == 'm_') {
if($ffg == 'm_' || !in_array(substr($ffg,2),$gtl)) unlink($chtdate.$chtdata."/".$fg."/_gst/".$ffg);
else {
$g++;
$gf = filemtime($chtdate.$chtdata."/".$fg."/_gst/".$ffg);
if($gf > $gh) $gh = $gf;
}}}
closedir($fff);
}
if(substr($fg,0,2) == '__' && ($g == 0 || $time - $gh > 60)) chtrmfd($chtdate.$chtdata."/".$fg,1);
else {$chwjs = $time - $gh;$chlwhd = '';if($chwjs > 86400) {$chlwhd .= sprintf("%d",($chwjs/86400))."일 ";$chwjs = $chwjs % 86400;}if($chwjs > 3600) {$chlwhd .= sprintf("%d",($chwjs/3600))."시간 ";$chwjs = $chwjs % 3600;}if($chwjs > 60) {$chlwhd .= sprintf("%d",($chwjs/60))."분 ";$chwjs = $chwjs % 60;}$chlwhd .= $chwjs."초";
echo "<input type='button' onclick=\"location.href='?chtid={$fg}'\" value='{$fg}' style='width:100px";
if(substr($fg,0,2) == '__') {?>;color:#FF0000<?php }
echo "' /><input type='button' value='삭제' onclick=\"var dx=this.previousSibling.value;if(confirm('\'' + dx + '\' 대화방을 삭제합니까')) {document.logox.delcht.value=dx;submit();}\" style='margin-left:10px' /> <input type='text' value=\"".$g."명 / 최종접속: ".$chlwhd."전 / 생성시간: ".date("Y-m-d H:i:s",@filemtime($chtdate.$chtdata."/".$fg."/.htaccess"))."\" style='border:0;width:400px' /><br />";
}}}
closedir($ff);
}
?>
<div class='cht_addv'>이미지 설정</div><div style='width:380px;text-align:left;margin:0 auto'>
<div>첨부파일 이미지 처리 :: <select name="chtuimg_"><option value="0" <?php if(!$chtuimg) echo "selected=\"selected\"";?>>텍스트 링크</option><option value="1" <?php if($chtuimg == 1) echo "selected=\"selected\"";?>>썸네일 링크</option><option value="2" onmouseover="expln('모바일에서는 텍스트 링크, PC에서는 썸네일 링크')" onmouseout="expln()" <?php if($chtuimg == 2) echo "selected=\"selected\"";?>>모바일에서 텍스트 링크</option></select></div>
<div>인터넷주소 이미지 처리 :: <select name="chtiimg_"><option value="0" <?php if(!$chtiimg) echo "selected=\"selected\"";?>>텍스트 링크</option><option value="1" <?php if($chtiimg == 1) echo "selected=\"selected\"";?>>썸네일 링크</option><option value="2" onmouseover="expln('모바일에서는 텍스트 링크, PC에서는 썸네일 링크')" onmouseout="expln()" <?php if($chtiimg == 2) echo "selected=\"selected\"";?>>모바일에서 텍스트 링크</option></select></div>
<div>이미지 링크 타겟 :: <select name="chtview_"><option value="0" <?php if(!$chtview) echo "selected=\"selected\"";?>>레이어로</option><option value="1" <?php if($chtview == 1) echo "selected=\"selected\"";?>>새창으로</option><option value="2" <?php if($chtview == 2) echo "selected=\"selected\"";?>>썸네일은 레이어로,텍스트는 새창으로</option></select></div>
<div>썸네일 최대 넓이 : <input type="text" name="chtvimg_" class="cht_ipt" style="width:50px" value="<?php echo $chtvimg;?>" />px</div>
<div onmouseover="expln('0이면 원본 넓이로')" onmouseout="expln()">레이어 넓이 : <input type="text" name="chtimgmw_" class="cht_ipt" style="width:50px" value="<?php echo $chtimgmw;?>" />px</div>
</div>
<div class='cht_addv'>하단 아이콘</div><div style='width:380px;text-align:left;margin:0 auto'>
<div style="clear:both"><div style="float:left;width:140px">하단아이콘 모두 감춤 :: </div><select style="float:left" name="chtbtnicon_"><option value="1" <?php if($chtbtnicon == 1) echo "selected=\"selected\"";?>>모두 감춤</option><option value="3" <?php if($chtbtnicon == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 감춤</option><option value="4" <?php if($chtbtnicon == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 감춤</option><option value="0" <?php if($chtbtnicon == 0) echo "selected=\"selected\"";?>>모두 감춤 안 함</option></select></div>
<div style="clear:both" onmouseover="expln('이모티콘을 사용하려면, icon/emoticon/ 경로에 이미지파일이 들어 있어야 합니다.')" onmouseout="expln()"><div style="float:left;width:140px"><img src='icon/srchat_e.png' /> 이모티콘 :: </div><select style="float:left" name="chtuseico_"><option value="1" <?php if($chtuseico == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <?php if($chtuseico == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <?php if($chtuseico == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <?php if($chtuseico == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <?php if($chtuseico == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div style="clear:both"><div style="float:left;width:140px"><img src='icon/srchat_b.png' /> 굵게 :: </div><select style="float:left" name="chtfbold_"><option value="1" <?php if($chtfbold == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <?php if($chtfbold == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <?php if($chtfbold == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <?php if($chtfbold == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <?php if($chtfbold == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div style="clear:both"><div style="float:left;width:140px"><img src='icon/srchat_i.png' /> 기울게 :: </div><select style="float:left" name="chtfitalic_"><option value="1" <?php if($chtfitalic == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <?php if($chtfitalic == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <?php if($chtfitalic == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <?php if($chtfitalic == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <?php if($chtfitalic == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div style="clear:both"><div style="float:left;width:140px"><img src='icon/srchat_u.png' /> 밑줄 :: </div><select style="float:left" name="chtfunderline_"><option value="1" <?php if($chtfunderline == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <?php if($chtfunderline == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <?php if($chtfunderline == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <?php if($chtfunderline == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <?php if($chtfunderline == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div style="clear:both"><div style="float:left;width:140px"><img src='icon/srchat_r.png' /> 새로고침 :: </div><select style="float:left" name="chturefresh_"><option value="1" <?php if($chturefresh == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <?php if($chturefresh == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <?php if($chturefresh == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <?php if($chturefresh == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <?php if($chturefresh == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div style="clear:both"><div style="float:left;width:140px"><img src='icon/srchat_s.png' /> 스크롤 정지 :: </div><select style="float:left" name="chtscrollstop_"><option value="1" <?php if($chtscrollstop == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <?php if($chtscrollstop == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <?php if($chtscrollstop == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <?php if($chtscrollstop == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <?php if($chtscrollstop == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div style="clear:both"><div style="float:left;width:140px"><img src='icon/srchat_w.png' /> 본문 지움 :: </div><select style="float:left" name="chtclear_"><option value="1" <?php if($chtclear == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <?php if($chtclear == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <?php if($chtclear == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <?php if($chtclear == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <?php if($chtclear == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div style="clear:both"><div style="float:left;width:140px"><img src='icon/srchat_h.png' /> 채팅방 헤드 :: </div><select style="float:left" name="chtvhead_"><option value="1" <?php if($chtvhead == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <?php if($chtvhead == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <?php if($chtvhead == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <?php if($chtvhead == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <?php if($chtvhead == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div style="clear:both" onmouseover="expln('저장된 기록 보기 권한제한')" onmouseout="expln()"><div style="float:left;width:140px"><img src='icon/srchat_k.png' /> 저장된 기록 :: </div><select style="float:left" name="chtbakonly_"><option value="31" <?php if($chtbakonly == '31') echo "selected=\"selected\"";?>>관리자만</option><option value="30" <?php if($chtbakonly == '30') echo "selected=\"selected\"";?>> &nbsp;- 아이콘 숨김</option><option value="21" <?php if($chtbakonly == '21') echo "selected=\"selected\"";?>>회원만</option><option value="20" <?php if($chtbakonly == '20') echo "selected=\"selected\"";?>> &nbsp;- 아이콘 숨김</option><option value="11" <?php if($chtbakonly == '11') echo "selected=\"selected\"";?>>비회원도</option><option value="10" <?php if($chtbakonly == '10') echo "selected=\"selected\"";?>> &nbsp;- 아이콘 숨김</option></select></div>
<div style="clear:both"><div style="float:left;width:140px"><img src='icon/srchat_x.gif' /> 퇴장 :: </div><select style="float:left" name="chtleave_"><option value="1" <?php if($chtleave != 0) echo "selected=\"selected\"";?>>사용함</option><option value="0" <?php if($chtleave == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
</div>
<div style='clear:both' class='cht_addv'>회원 &bull; 비회원 &bull; 첨부파일</div><div style='width:380px;text-align:left;margin:0 auto'>
<div>닉네임 :: <select name="chtpnck_"><option value="0" <?php if(!$chtpnck) echo "selected=\"selected\"";?>>비회원 닉변경 가능</option><option value="3" <?php if($chtpnck == 3) echo "selected=\"selected\"";?>> &nbsp;- 닉네임란,색상선택상자 숨김</option><option value="4" <?php if($chtpnck == 4) echo "selected=\"selected\"";?>> &nbsp;- 색상선택상자만 숨김</option><option value="1" <?php if($chtpnck == 1) echo "selected=\"selected\"";?>>닉변경 불가능</option><option value="2" <?php if($chtpnck == 2) echo "selected=\"selected\"";?>> &nbsp;- 닉네임란,색상선택상자 숨김</option><option value="5" <?php if($chtpnck == 5) echo "selected=\"selected\"";?>> &nbsp;- 색상선택상자만 숨김</option></select></div>
<div><label onmouseover="expln('비회원 닉네임 변경알림 본문 출력 여부')" onmouseout="expln()"><input name="chtchange_" type="radio" value="1" <?php if($chtchange) echo "checked=\"checked\"";?> /> 닉네임 변경 알림 본문 출력</label>&nbsp; <label><input name="chtchange_" type="radio" value="0" <?php if(!$chtchange) echo "checked=\"checked\"";?> /> 안 함</label></div>
<div><label onmouseover="expln('닉네임과 색상과 글쓰기란을 한 줄로')" onmouseout="expln()"><input name="chtncw_" type="radio" value="1" <?php if($chtncw) echo "checked=\"checked\"";?> /> 닉네임 글쓰기 한줄로</label>&nbsp; <label><input name="chtncw_" type="radio" value="0" <?php if(!$chtncw) echo "checked=\"checked\"";?> /> 두줄로</label></div>
<div onmouseover="expln('채팅 본문에서 닉네임과 본문 사이의 구분자. (img) 태그 사용 가능합니다. 기본값) &amp;amp;gt; . 줄바꿈은 안됨')" onmouseout="expln()"> 닉네임 본문 사이 구분자 : <textarea name="chtnextnk_" style="width:200px;height:13px;font-size:9pt"><?php echo str_replace("&","&amp;",stripslashes($chtnextnk))?></textarea></div>
<div onmouseover="expln('PC와 모바일 별도로 설정하게 되어 있습니다. ex) PC는 회원만, 모바일은 비회원도')" onmouseout="expln()">회원전용 :: PC :: <select name="chtmemberonly_"><option value="3" <?php if($chtmemberonly == 3) echo "selected=\"selected\"";?>>모두 회원만</option><option value="2" <?php if($chtmemberonly == 2) echo "selected=\"selected\"";?>>쓰기는 회원만</option><option value="0" <?php if($chtmemberonly == 0) echo "selected=\"selected\"";?>>비회원도</option></select>
- 모바일 :: <select name="chtmemberonly2_"><option value="3" <?php if($chtmemberonly2 == 3) echo "selected=\"selected\"";?>>모두 회원만</option><option value="2" <?php if($chtmemberonly2 == 2) echo "selected=\"selected\"";?>>쓰기는 회원만</option><option value="0" <?php if($chtmemberonly2 == 0) echo "selected=\"selected\"";?>>비회원도</option></select></div>
<div>본문 색상선택 :: <select name="chtcolorpk_"><option value="4" <?php if($chtcolorpk == 4) echo "selected=\"selected\"";?>>사용 안 함</option><option value="3" <?php if($chtcolorpk == 3) echo "selected=\"selected\"";?>>관리자만</option><option value="2" <?php if($chtcolorpk == 2) echo "selected=\"selected\"";?>>회원만</option><option value="0" <?php if($chtcolorpk == 0) echo "selected=\"selected\"";?>>비회원도</option></select></div>
<div onmouseover="expln('숫자만 입력, 0으로 저장하면 기본값 60으로 처리됩니다')" onmouseout="expln()">닉네임 입력란 넓이 : <input type="text" name="chtnwidth_" class="cht_ipt" style="width:40px" value="<?php echo $chtnwidth;?>" /> (단위px,기본값:60)</div>
<div onmouseover="expln('숫자만 입력, 0으로 저장하면 기본값 50으로 처리됩니다')" onmouseout="expln()">색상 선택상자 넓이 : <input type="text" name="chtcwidth_" class="cht_ipt" style="width:40px" value="<?php echo $chtcwidth;?>" /> (단위px,기본값:50)</div>
<div><label><input name="chtusrinout_" type="radio" value="1" <?php if($chtusrinout) echo "checked=\"checked\"";?> /> 사용자 입출력 상황 본문 출력</label>&nbsp; <label><input name="chtusrinout_" type="radio" value="0" <?php if(!$chtusrinout) echo "checked=\"checked\"";?> /> 사용 안 함</label></div>
<?php if($chthideadm === -1) {?><div><label onmouseover="expln('관리자를 접속자 목록에서 지우고, 접속자 수에서도 빼서, 접속되어 있는 줄 모르게 접속함')" onmouseout="expln()"><input name="chthideadm_" type="radio" value="a" <?php if(file_exists($chtfid."_hideadm")) echo "checked=\"checked\"";?> /> 관리자 감춤</label>&nbsp; <label><input name="chthideadm_" type="radio" value="b" <?php if(!file_exists($chtfid."_hideadm")) echo "checked=\"checked\"";?> /> 사용 안 함</label></div><?php }?>
<div>첨부파일 :: <select name="chtufile_"><option value="2" <?php if($chtufile == 2) echo "selected=\"selected\"";?>>비회원도 가능</option><option value="3" <?php if($chtufile == 3) echo "selected=\"selected\"";?>>회원만 가능</option><option value="0" <?php if(!$chtufile) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div onmouseover="expln('첨부파일 크기가 이 값보다 크면 업로드 차단/ 0으로 설정하면 용량제한 사용 안 함')" onmouseout="expln()">첨부파일 용량제한 : <input type="text" name="chtisfsm_" class="cht_ipt" style="width:40px" value="<?php echo $isfsm;?>" />mb</div>
<div onmouseover="expln('첨부파일 누적용량이 이 값이 되면 모두 삭제 / 0으로 설정하면 총량제한 사용 안 함')" onmouseout="expln()">첨부파일 총량제한 : <input type="text" name="chtisdsm_" class="cht_ipt" style="width:40px" value="<?php echo $isdsm;?>" />mb</div>
</div>

<div class='cht_addv'>기타 설정</div><div style='width:380px;text-align:left;margin:0 auto'>
<br /><label><input name="chtbakbak_" type="radio" value="1" <?php if($chtbakbak) echo "checked=\"checked\"";?> /> 저장된 기록 영구 저장</label>&nbsp; <label><input name="chtbakbak_" type="radio" value="0" <?php if(!$chtbakbak) echo "checked=\"checked\"";?> /> 영구 저장 안 함</label>
<br /><input type="button" onclick="location.href='?chtid=<?php echo $chtid;?>&down=_backup_.txt'" value = "영구 저장 기록 다운로드" style="width:160px">
<br /><label onmouseover="expln('회원 닉네임앞에 이미지 마크 사용여부')" onmouseout="expln()"><input name="chtimgmk_" type="radio" value="1" <?php if($chtimgmk) echo "checked=\"checked\"";?> /> 이미지 마크</label>&nbsp; <label><input name="chtimgmk_" type="radio" value="0" <?php if(!$chtimgmk) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label><input name="chtlvico_" type="radio" value="1" <?php if($chtlvico) echo "checked=\"checked\"";?> /> 레벨아이콘 사용</label>&nbsp; <label><input name="chtlvico_" type="radio" value="0" <?php if(!$chtlvico) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label title='srchat_adm.gif'><input name="chtuadmico_" type="radio" value="1" <?php if($chtuadmico) echo "checked=\"checked\"";?> /> 관리자 아이콘 구분</label>&nbsp; <label><input name="chtuadmico_" type="radio" value="0" <?php if(!$chtuadmico) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label><input name="chtenter_" type="radio" value="1" <?php if($chtenter) echo "checked=\"checked\"";?> /> 버튼 클릭 입장</label>&nbsp; <label><input name="chtenter_" type="radio" value="0" <?php if(!$chtenter) echo "checked=\"checked\"";?> /> 자동 입장</label>
<br /><label><input name="chtvban_" type="radio" value="1" <?php if($chtvban) echo "checked=\"checked\"";?> /> 강퇴 본문 출력</label>&nbsp; <label><input name="chtvban_" type="radio" value="0" <?php if(!$chtvban) echo "checked=\"checked\"";?> /> 출력 안 함</label>
<br /><label onmouseover="expln('모바일 사용자 아이콘으로 구분 (mobile.gif)')" onmouseout="expln()"><input name="chtfmobile_" type="radio" value="1" <?php if($chtfmobile) echo "checked=\"checked\"";?> /> 모바일 사용자 구분</label>&nbsp; <label><input name="chtfmobile_" type="radio" value="0" <?php if(!$chtfmobile) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label onmouseover="expln('퇴장 버튼 클릭후 입장 버튼에 접속자수 표시 여부')" onmouseout="expln()"><input name="chtbtcnt_" type="radio" value="1" <?php if($chtbtcnt) echo "checked=\"checked\"";?> /> 입장버튼 접속자수 표시</label>&nbsp; <label><input name="chtbtcnt_" type="radio" value="0" <?php if(!$chtbtcnt) echo "checked=\"checked\"";?> /> 안 함</label>

<div onmouseover="expln('채팅 본문에서 날짜 표시 방법')" onmouseout="expln()" style="clear:both"><div style="float:left;width:120px">본문에서 날짜표시 :: </div><select style="float:left" name="chtvdate_"><option value="0" <?php if(!$chtvdate) echo "selected=\"selected\"";?>>상단으로</option><option value="2" <?php if($chtvdate == '2') echo "selected=\"selected\"";?>>우측으로 출력</option><option value="3" <?php if($chtvdate == '3') echo "selected=\"selected\"";?>>PC 우측, 모바일 상단</option></select></div>
<div onmouseover="expln('채팅 본문에서 사용자 자신의 글을 강조할지 여부와 방법 선택')" onmouseout="expln()" style="clear:both"><div style="float:left;width:120px">본문에서 본인 강조 :: </div><select style="float:left" name="chtmyself_"><option value="1" <?php if($chtmyself == '1') echo "selected=\"selected\"";?>>배경색으로</option><option value="2" <?php if($chtmyself == '2') echo "selected=\"selected\"";?>>우측으로 출력</option><option value="3" <?php if($chtmyself == '3') echo "selected=\"selected\"";?>>mobile 배경색,PC 우측으로 출력</option><option value="0" <?php if(!$chtmyself) echo "selected=\"selected\"";?>>강조 안 함</option></select></div>
<div onmouseover="expln('경로가 변경될 때, \'다른 페이지를 탐색하시겠습니까\' 라고 뜨는 경고창 사용여부 설정, 사용하면 접속종료 파악이 빨라집니다.')" onmouseout="expln()" style="clear:both"><div style="float:left;width:120px">경로이동 경고창 :: </div><select style="float:left" name="chtunload_"><option value="Y" <?php if($chtunload == 'Y') echo "selected=\"selected\"";?>>사용</option><option value="N" <?php if($chtunload == 'N') echo "selected=\"selected\"";?>>새창에서만</option><option value="T" <?php if($chtunload == 'T') echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div onmouseover="expln('ajax 접속이 먹통이어서, 새로고침이 필요할 때')" onmouseout="expln()" style="clear:both"><div style="float:left;width:120px">ajax 먹통일 때 :: </div><select style="float:left" name="chtreload_"><option value="0" <?php if(!$chtreload) echo "selected=\"selected\"";?>>새로고침 확인창</option><option value="1" <?php if($chtreload == 1) echo "selected=\"selected\"";?>>즉시 새로고침</option><option value="2" <?php if($chtreload == 2) echo "selected=\"selected\"";?>>새로고침 안내문</option><option value="3" <?php if($chtreload == 3) echo "selected=\"selected\"";?>>PC확인창, mobile 즉시 새로고침</option><option value="4" <?php if($chtreload == 4) echo "selected=\"selected\"";?>>PC안내문, mobile 즉시 새로고침</option><option value="5" <?php if($chtreload == 5) echo "selected=\"selected\"";?>>아무 조치 안 함</option></select></div>
<div onmouseover="expln('채팅 본문 출력하는 방향 : 아래로 또는 위로')" onmouseout="expln()" style="clear:both"><div style="float:left;width:120px">본문 출력 방향 :: </div><select style="float:left" name="chtupdown_"><option value="0" <?php if(!$chtupdown) echo "selected=\"selected\"";?>>위에서 아래로</option><option value="1" <?php if($chtupdown == 1) echo "selected=\"selected\"";?>>아래에서 위로</option><option value="2" <?php if($chtupdown == 2) echo "selected=\"selected\"";?>>모바일에서 위로</option></select></div>
<div onmouseover="expln('채팅 글쓰는 란 위치')" onmouseout="expln()" style="clear:both"><div style="float:left;width:120px">글쓰는 란 위치 :: </div><select style="float:left" name="chtwrtpst_"><option value="0" <?php if(!$chtwrtpst) echo "selected=\"selected\"";?>>아래로</option><option value="1" <?php if($chtwrtpst == 1) echo "selected=\"selected\"";?>>위로</option><option value="2" <?php if($chtwrtpst == 2) echo "selected=\"selected\"";?>>모바일에서 위로</option></select></div>
<div onmouseover="expln('우측 상단 시간 표시')" onmouseout="expln()" style="clear:both"><div style="float:left;width:120px">우측 상단 시간 표시 :: </div><select style="float:left" name="chtvtime_"><option value="0" <?php if(!$chtvtime) echo "selected=\"selected\"";?>>표시함</option><option value="1" <?php if($chtvtime == 1) echo "selected=\"selected\"";?>>표시 안 함</option><option value="2" <?php if($chtvtime == 2) echo "selected=\"selected\"";?>>PC 표시함, 모바일 표시 안 함</option></select></div>
<div onmouseover="expln('입장 인원제한설정, 0으로 설정하면 제한 안 함')" onmouseout="expln()" style="clear:both">입장 인원제한 :: <input type="text" name="chtlimit_" class="cht_ipt" style="width:40px" value="<?php echo $chtlimit;?>" />명</div>
<div onmouseover="expln('글쓰기 시간 간격 제한설정, 0으로 설정하면 제한 안 함')" onmouseout="expln()">글쓰기 시간간격 :: <input type="text" name="chtinterval_" class="cht_ipt" style="width:40px" value="<?php echo $chtinterval;?>" />초</div>
<div onmouseover="expln('알림음 호출 시간 간격 제한설정, 0으로 설정하면 제한 안 함')" onmouseout="expln()">알림음 호출 시간간격 :: <input type="text" name="chtcallt_" class="cht_ipt" style="width:40px" value="<?php echo $chtcallt;?>" />초</div>
<div onmouseover="expln('0부터 499까지 설정할 수 있습니다.')" onmouseout="expln()">처음 접속에서 출력할 본문갯수 : <input type="text" name="chtread_" class="cht_ipt" style="width:40px" value="<?php echo $chtread;?>" maxlength="3" /></div>
<div onmouseover="expln('채팅방 배경색 설정')" onmouseout="expln()">채팅방 배경색 :: <select name="chtisblack_"><option value="0" <?php if(!$chtisblack) echo "selected=\"selected\"";?>>흰색</option><option value="1" <?php if($chtisblack == 1) echo "selected=\"selected\"";?>>검은색</option><option value="2" <?php if($chtisblack == 2) echo "selected=\"selected\"";?>>모바일에서만 검은색</option></select></div>
<div onmouseover="expln('새글 확인하는 ajax 접속주기,디폴트는 1500(1.5초)')" onmouseout="expln()">새글 확인주기 : <input type="text" name="chtrefresh_" class="cht_ipt" style="width:30px" value="<?php echo $chtrefresh;?>" />/1000 초 - 모바일 : <input type="text" name="chtrefresh2_" class="cht_ipt" style="width:30px" value="<?php echo $chtrefresh2;?>" />/1000 초</div>
</div><br /><br />
<?php } else {?><input type="hidden" name="install" value="1" /><?php }?>
<input type="submit" value="입력" class="cht_button" style="width:75%;height:40px" /><br /><br />
<?php if($cht_isadmin == 2) {
if($chtrfrr) {?><input type="button" onmouseover="expln('채팅 관리자 기능 기본 설정외의 채팅방 삽입주소에 따른 별도 설정을 모두 삭제합니다.')" onmouseout="expln()" onclick="if(confirm(this.value + '합니다.')) {this.nextSibling.value='delrfrr';submit();}" value="관리자 기능 별도 설정 삭제" class="cht_button" style="width:155px" /><input type="hidden" name="delrfrr" value="" />
<?php }?><input type="button" onmouseover="expln('채팅 저장된 기록과 영구 저장된 기록을 삭제')" onmouseout="expln()" onclick="if(confirm(this.value + '합니다.')) {this.nextSibling.value='reset';submit();}" value="저장된 기록 비움" class="cht_button" style="width:120px" /><input type="hidden" name="backup" value="" />
<input type="button" onmouseover="expln('첨부파일을 모두 삭제')" onmouseout="expln()" onclick="if(confirm(this.value + '합니다.')) {this.nextSibling.value='delete';submit();}" value="첨부파일(<?php echo sprintf("%.1f", ($isusm / 1048576))?>mb) 삭제" class="cht_button" style="width:160px" /><input type="hidden" name="upload_delete" value="" />
<input type="button" onmouseover="expln('채팅내용, 저장된 기록을 삭제')" onmouseout="expln()" onclick="if(confirm(this.value + '합니다.')) {this.nextSibling.value='empty';submit();}" value="채팅내용 비움" class="cht_button" style="width:120px" /><input type="hidden" name="chat_txt" value="" />
<input type="button" onmouseover="expln('채팅내용, 첨부파일, 저장된 기록, 영구 저장된 기록을 삭제')" onmouseout="expln()" onclick="if(confirm(this.value + '합니다.')) {this.nextSibling.value='empty';submit();}" value="모두 비움" class="cht_button" style="width:120px" /><input type="hidden" name="empty" value="" />
<input type="button" onmouseover="expln('<?php echo $chtid;?> 대화방을 설치 해제')" onmouseout="expln()" onclick="if(confirm(this.value + '합니다.')) {this.nextSibling.value='uninstall';submit();}" value="uninstall" class="cht_button" style="width:120px" /><input type="hidden" name="install" value="1" />
<?php }} else if($chtid) {?>
<input type="button" title="<?php echo $chtid;?> 대화방을 설치" onclick="if(confirm(this.value + '합니다.')) {this.nextSibling.value='install';submit();}" value="install" class="cht_button" style="width:120px" /><input type="hidden" name="install" value="1" />
<?php }}?>
</form>
<?php }?>
</body></html>
<?php
exit;
}
if(!$cht_ismbr && isset($chtmemberonlyy) && $chtmemberonlyy == 3) $chtfid = '';
if($chtfid) {
if($_GET['v'] == "file") {
if($isdid) {
?>
<title>upload</title>
<style type='text/css'>
html, body, form, input {overflow:hidden; margin:0; padding:0}
input {font-family:Tahoma; font-size:8pt}
.cht_button {background:url('icon/srchat_f.gif') no-repeat 0% 100%; border:0; float:left; padding-left:3px; height:14px; width:14px; cursor:pointer}
.cht_button2 {border:0; border:1px solid #828282; float:left; height:16px; width:30px; cursor:pointer}
.file {width:50px; height:20px; margin:0; opacity:0; position:absolute; top:0; left:0; z-index:2; cursor:pointer}
</style>
<!--[if IE]>
<style type='text/css'>
.file {filter:alpha(opacity=0); height:18px; width:30px}
</style>
<![endif]-->
</head>
<body>
<form name="chtupfm" enctype="multipart/form-data" action="<?php echo $chat;?>" method="post">
<input type="hidden" name="chtid" value="<?php echo $chtid;?>" />
<input type="button" value="" class="cht_button" /><input type="file" class="file" name="file" onchange="if(this.value) submit()" /><input type="submit" class="cht_button2" />
</form></body></html>
<?php
exit;
}} else if($_GET['v'] == 'backup') {
if((!$cht_isadmin && $chtbakonly[0] == '3') || ($chtbakonly[0] == '2' && !$cht_ismbr)) {echo "<script type='text/javascript'>alert('You don\'t have permission to access');</script>";exit;}
?>
<title>[저장된 기록]</title>
<style type='text/css'>
body,div,fieldset {font-size:9pt}
#cht_fbdy #cht_AA b {cursor:text}
</style>
</head>
<body id="cht_fbdy" style="overflow:auto" onload="settup()">
<script type="text/javascript">
//<![CDATA[
var chtsrchat = '<?php echo $chat;?>?chtid=<?php echo $chtid;?>';
function settup() {
cht_isadmin = '<?php echo (isset($cht_isadmin))?$cht_isadmin:0;?>';
chtisbk = true;
<?php
if(!$chtuimg || ($chtuimg == 1 && $chtismobile)) {?>chtuimg = 2;<?php }
if(!$chtiimg || ($chtiimg == 1 && $chtismobile)) {?>chtiimg = 2;<?php }
?>
chtimgmk = <?php echo $chtimgmk;?>;
var con = Array(""<?php
$fp = fopen($chtbk, "r");
$m = 0;
while($memo = fgets($fp)){
$memo = trim($memo);
$memo = str_replace("</","<\/",str_replace("`","/",str_replace("\"","\\\"",$memo)));
$con = explode("\x1b", trim($memo));
if($con[4] && substr($memo, 0, 2) == "\x1b\x1b") {
if(substr($con[2],0,12) == $chtip || substr($con[2],12,12) == $chtip) {
$con[1] = $con[3];
$con[2] = $con[4];
$con[4] = $con[6];
}
}
if($con[1] != '') echo ",Array(\"{$con[0]}\",\"{$con[1]}\",\"{$con[2]}\",\"{$con[3]}\",\"{$m}\",\"{$con[4]}\")";
$m++;
}
fclose($fp);
?>);
var cl = con.length -1;
if(cl > 0) {
var tcon = "<div class='cht_addv' style='margin:0'>&nbsp;</div>";
for(var i = 1;i <= cl;i++) {
if(con[i][0] == '') tcon += cht_tntc(con[i],2);
else tcon += cht_tosty(con[i],1);
}
if(cht_isadmin != 0) tcon = "<form name='bakform' method='post' action='?'><input type='hidden' name='chtid' value='<?php echo $chtid;?>' /><input type='hidden' name='torf' value='' /><input type='hidden' name='dnox' value='' />" + tcon + "<input type='button' class='cht_button' value='글 선택반전' onclick='tinvert()' /> &nbsp; <input type='button' class='cht_button' value='글 50%선택' onclick='tinvert(1)' /> &nbsp; <input type='button' class='cht_button' value='글 삭제' onclick='ssubmit()' title='글과 첨부된 파일까지 삭제' /> &nbsp; <input type='button' class='cht_button' value='파일 선택반전' onclick='finvert()' /> &nbsp; <input type='button' class='cht_button' value='파일 50%선택' onclick='finvert(1)' /> &nbsp; <input type='button' class='cht_button' value='파일삭제' onclick='fsubmit()' title='첨부파일만 삭제' /> &nbsp; </form>";
dallar('cht_AA').innerHTML = tcon;
}}
//]]>
</script>
<script type="text/javascript" src="<?php echo $chat;?>?js=1"></script>
<fieldset id="cht_AA" style="width:590px;background:#FFFFFF;border:1px solid #828282;padding:5px;margin:0 auto;line-height:20px;text-align:left"></fieldset>
<div id="cht_img"></div><input type="hidden" id="cht_none" value="" /><input type="hidden" id="cht_gout" value="0" />
<?php if($cht_isadmin) {?>
<form name="logox" style="margin:0px" method="post" action="<?php echo $chat;?>" target="exeframe">
<input type="hidden" name="chtid" value="<?php echo $chtid;?>" />
<input type="hidden" name="delf" value="" />
<input type="hidden" name="frombk" value="1" />
</form>
<iframe name="exeframe" style="display:none"></iframe>
<?php }?>
</body>
</html>
<?php
exit;
}}
if($chtfid || $cht_isadmin) {
if($ischat) echo "\n<title>채팅</title>\n</head>\n<body>\n";
?>
<script type="text/javascript">
var chtsrchat = '<?php echo $chat;?>?chtid=<?php echo $chtid;?>';
var chtwidth = '<?php echo $chtwidth;?>';
var chtheight = '<?php echo $chtheight;?>';
var cht_cntwh = '<?php echo $cht_cntwh;?>';
var cht_usrwh = '<?php echo $cht_usrwh;?>';
var chthorizon =  '<?php echo $chthorizon;?>';
</script>
<div id="cht_VV"></div>
<fieldset id="cht_fbdy" style="display:none;" onmouseover="chtblk = 1">
<?php
$exxt = 0;
if($time - @filemtime($chtmip.$chtip) < 30 && $fnt = fopen($chtmip.$chtip,"r")) {
if(@fgets($fnt)) {
if($dgx = trim(@fgets($fnt))) {
if(md5($_SERVER['HTTP_USER_AGENT']) != $dgx) $exxt = 9;
}}
fclose($fnt);
}
if($exxt == 9) {?><div style='text-align:center;font-size:10pt;font-weight:bold;padding:10px 0 10px 0'>double access denied</div><?php }
else {
?>
<div id="cht_img"></div>
<div id="cht_CC" style="display:block" onclick="cht_aadd(0)"><input type="button" id="cht_OO" value="" title=";exit" onclick="cht_leave()" onmouseover="cht_ex(5)" onmouseout="cht_ex()" /><div id="cht_EE"></div><div id="cht_FF"></div></div>
<div id="cht_HH" style="width:<?php echo $chtwidth;?>;height:<?php echo $chtheight;?>"><div id="cht_fico"></div>
<div id="cht_DD" style="float:right"></div>
<div id="cht_AA" style="float:left"></div>
</div>
<div id="cht_UU">
<form id="chtwtfm" onsubmit="cht_go('rpage');return false;" action=""><div id="chtnecolor">
<input type="text" id="neme" maxlength="10" onmouseover="cht_ex(12)" onmouseout="cht_ex()" value="<?php echo $chtnck;?>"
 /><select id="cht_color" onchange="cht_fbcolr()" onmouseover="cht_ex(11)" onmouseout="cht_ex()">
	<option value="00" style="background-color:#ffffff;color:#ffffff">색상</option>
	<option value="01" style="background-color:#000000;color:#000000">black</option>
	<option value="02" style="background-color:#7d7d7d;color:#7d7d7d">dimgray</option>
	<option value="03" style="background-color:#ff0000;color:#ff0000">red</option>
	<option value="04" style="background-color:#A52A2A;color:#A52A2A">brown</option>
	<option value="05" style="background-color:#ff6c00;color:#ff6c00">tomato</option>
	<option value="06" style="background-color:#ff9900;color:#ff9900">orange</option>
	<option value="07" style="background-color:#ffef00;color:#ffef00">yellow</option>
	<option value="08" style="background-color:#a6cf00;color:#a6cf00">yellowgreen</option>
	<option value="09" style="background-color:#2E8B57;color:#2E8B57">seagreen</option>
	<option value="10" style="background-color:#1c4827;color:#1c4827">darkgreen</option>
	<option value="11" style="background-color:#00b0a2;color:#00b0a2">lightseagreen</option>
	<option value="12" style="background-color:#00ccff;color:#00ccff">deepskyblue</option>
	<option value="13" style="background-color:#0095ff;color:#0095ff">dodgerblue</option>
	<option value="14" style="background-color:#4682B4;color:#4682B4">steelblue</option>
	<option value="15" style="background-color:#0000CD;color:#0000CD">mediumblue</option>
	<option value="16" style="background-color:#9400D3;color:#9400D3">darkviolet</option>
	<option value="17" style="background-color:#FF1493;color:#FF1493">deeppink</option>
</select></div><div id="cht_JJ" style="width:1px"><input type='button' onclick='chtipths()' onmouseover='cht_ex(10)' onmouseout='cht_ex()' value='귓속말' /></div>
<textarea id="chcontent" onfocus="this.style.imeMode='active'" onmouseover="cht_ex(13)" onmouseout="cht_ex()" ></textarea>
<input type="submit" class="cht_button" id="chtsbmt2" /><input type="button" id="cht_XX" value="V" onclick="cht_toggle('cht_chkdiv')" /></form>
<div id="cht_chkdiv">
<img src="icon/srchat_e.png" id="cht_LL" alt=";ico" onclick="chtemtbk(this)" onmouseover="cht_ex(1)" onmouseout="cht_ex()" style="display:none"
 /><img src="icon/srchat_b.png" id="cht_MM" alt=";b" onclick="chtemtbk(this)" onmouseover="cht_ex(2)" onmouseout="cht_ex()" style="display:none"
 /><img src="icon/srchat_i.png" id="cht_PP" alt=";i" onclick="chtemtbk(this)" onmouseover="cht_ex(3)" onmouseout="cht_ex()" style="display:none"
 /><img src="icon/srchat_u.png" id="cht_QQ" alt=";u" title=";u" onclick="chtemtbk(this)" onmouseover="cht_ex(4)" onmouseout="cht_ex()" style="display:none"
 /><img src="icon/srchat_r.png" id="cht_RR" alt=";re" onclick="dallar('cht_gout').value='9';location.reload()" onmouseover="cht_ex(6)" onmouseout="cht_ex()" style="display:none"
 /><img src="icon/srchat_s.png" id="cht_SS" alt=";pause" onclick="chtemtbk(this)" onmouseover="cht_ex(14)" onmouseout="cht_ex()" style="display:none"
 /><img src="icon/srchat_w.png" id="cht_WW" alt=";clear" onclick="chtemtbk(this)" onmouseover="cht_ex(15)" onmouseout="cht_ex()" style="display:none"
 /><img src="icon/srchat_h.png" id="cht_ZZ" alt=";head" onclick="chtemtbk(this)" onmouseover="cht_ex(16)" onmouseout="cht_ex()" style="display:none"
 /><a target="_blank" id="chtbackup" href="<?php echo $chat;?>?chtid=<?php echo $chtid;?>&amp;v=backup"><img src="icon/srchat_k.png" alt=";bak" onmouseover="cht_ex(7)" onmouseout="cht_ex()"
 /></a><img src="icon/srchat_n.png" id="cht_TT" alt=";nick" onclick="chtvwnck()" onmouseover="cht_ex(9)" onmouseout="cht_ex()" style="display:none"
 /><a target="_blank" id="chtadmin" href="<?php echo $chat;?>?chtid=<?php echo $chtid;?>&amp;v=ban&amp;admin=1"><img src="icon/srchat_a.png" alt=";admin" onmouseover="cht_ex(8)" onmouseout="cht_ex()" /></a>
</div>
<div id="chtupload"></div><div style="clear:both"></div>
</div>
<iframe id="cht_ban" src="<?php echo $chat;?>?chtid=<?php echo $chtid;?>&amp;v=ban" style="display:none" frameborder="0"></iframe>
<input type="hidden" id="cht_none" value="" /><input type="hidden" id="cht_gout" value="0" /><input type="hidden" id="cht_ntim" value="a" /><input type="hidden" id="cht_vstd" value="" /><input type="hidden" id="cht_wip" value="" /><input type="hidden" id="cht_prev" value="" /><input type="hidden" id="psty" value="" /><input type="hidden" id="cht_pnam" value="<?php echo $chtnck;?>" /><input type="hidden" id="cht_xtim" value="0" /><input type="hidden" id="cht_ptim" value="9999999999999" /><input type="hidden" id="cht_callt" value="0" /><input type="hidden" id="cht_dumb" value="0" /><input type="hidden" id="cht_variable" value="" />
</fieldset>
<?php } if($ischat) {?>
<script type="text/javascript" src="<?php echo $chat;?>?js=1"></script>
</body>
</html>
<?php }}}?>