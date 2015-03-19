<?php
if(count($_POST) > 0 && false === strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])) exit;
header ("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="<?php echo $srboard?>" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php if($sett[31]) {?><link rel="shortcut icon" type="image/x-icon" href="http://<?php echo $_SERVER['HTTP_HOST']?>/favicon.ico" />
<?php }?>
<style type='text/css'>
* {font-size:9pt; font-family:Gulim}
div.mother {border:1px solid #DDDDDD; padding:20px; width:334px; height:37px; background:#FFF}
div.mother div {float:left; border:1px solid #DDDDDD; border-right-width:0; padding:10px; height:15px}
div.first {background:#F9F9F9; width:50px}
div.second {width:180px; background:#FFF}
div.third {width:40px; border-right-width:1px; background:#D7D7D7}
input.txt {border:0; padding:0; width:150px}
input.sbmt {border:0; padding:0; width:40px; background:#D7D7D7; cursor:pointer}
input.strk {background-color:#BB0000; color:#FFFFFF}
</style>
<script type='text/javascript'>
//<![CDATA[
function $$(nae,n) {return document.getElementsByName(nae)[n];}
function $(nae) {return document.getElementById(nae);}
function nwopn(purl){
if(!window.open(purl,'_blank')) {
if(confirm('팝업이 차단되었습니다.페이지 이동하시겠습니까')) location.replace(purl);
}}
//]]>
</script>
<?php
$sessnono = substr(preg_replace("`[^0-9]`","",$session_id),0,2);
if(strlen($sessnono) < 2) $sessnono = '99';
if($_GET['fram']) { /*-6-*/
?>
<title>
<?php
if(false !== strpos($_SERVER['QUERY_STRING'], 'send=memo')) echo "쪽지 보내기";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'send=mail')) echo "메일 보내기";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'mst=')) echo "분류 편집";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'rss=')) echo "RSS 주소 편집";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'fm=')) echo "내용편집";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'msect=')) echo "섹션 편집";
?></title><script type='text/javascript'>
//<![CDATA[
function resiz() {
$('frm').style.height = document.documentElement.clientHeight + 'px';
$('frm').style.width = document.documentElement.clientWidth + 'px';
var cwin = $('frm').contentWindow;
if(cwin){if(!!cwin.onloaded){cwin.onloaded();}}
}
setTimeout("resiz()",150);
//]]>
</script>
</head>
<body onload="resiz()" onresize="resiz()">
<iframe id="frm" src="<?php echo substr($_SERVER['QUERY_STRING'],5)?>" width="100%" height="100%" scrolling='auto'></iframe>
</body></html>
<?php
exit;
} /*-6-*/
if(($_POST['fmm'] || $_GET['fm'] || $_GET['fr']) && $mbr_level == 9) { /*-6-*/
?>
<title>내용</title>
<style type='text/css'>
* {font-size:9pt; color:black; font-family:Gulimche}
body {background-color:#F0F0F0; margin:0; overflow:hidden}
.button {cursor:pointer; width:40px; border:1px solid black; background-color:#D7D7D7; padding:0}
</style>
<?php
if($_POST['fmm']) { /*-4-*/
if(isset($_POST['tex']) && !$_POST['replace_a']) { /*---*/
@unlink($_POST['fmm']);
if($_POST['xfile'] != '1') {
$_POST['tex'] = str_replace("\r", "", str_replace("<//textarea>", "</textarea>", stripslashes($_POST['tex'])));
if($_POST['x1b']) $_POST['tex'] = str_replace("\x1c", "‹",str_replace("\x1d", "›",str_replace("›", "\x18", str_replace("‹", "\x1b", $_POST['tex']))));
$fp = fopen($_POST['fmm'],"w");
fputs($fp, $_POST['tex']);
fclose($fp);
@chmod($_POST['fmm'],0777);
}
echo "<body onload=\"setTimeout('self.close()', 500)\" bgcolor='#F0F0F0'><div style='font-size:200px;text-align:center'>성공</div>";
} else if($_POST['replace_a']) { /*---*/
function chslashes($val) {
$regula = array("\\d","\\D","\\f","\\n","\\r","\\s","\\S","\\t","\\v","\\w","\\W","\\p","\\x1b","\\x18");
$regulb = array("\d","\D","\f","\n","\r","\s","\S","\t","\v","\w","\W","\p","\x1b","\x18");
$val = str_replace("\\\\","\x1c",$val);
for($i = 0;$i < 14;$i++) $val = str_replace($regula[$i],$regulb[$i],$val);
$val = str_replace("\x1c","\\",$val);
return $val;
}
$_POST['replace_a'] = chslashes(stripslashes($_POST['replace_a']));
$_POST['replace_b'] = chslashes(str_replace("\r","",stripslashes($_POST['replace_b'])));
$replace_a = $_POST['replace_a'];
$osl = 0;
$osm = 0;
$osn = 0;
function changecontent($chfile) {
global $replace_a, $time, $osm;
usleepp($chfile."@@");
$jms = fopen($chfile."@@","w");
$ms = fopen($chfile,"r");
while(!feof($ms)){
$mso = fgets($ms);
if($_POST['regular']) $msso = preg_replace("`{$replace_a}`i",$_POST['replace_b'],$mso);
else $msso = str_replace($replace_a,$_POST['replace_b'],$mso);
fputs($jms,$msso);
if($msso != $mso) $osm++;
}
fclose($ms);
fclose($jms);
copy($chfile."@@", $chfile);
unlink($chfile."@@");
return $osm;
}
if(file_exists($_POST['fmm']) && is_file($_POST['fmm'])) {$oso = $osm;$osm = changecontent($_POST['fmm']);$osn++;if($oso < $osm) $osl++;}
else {
function dirscan($dir) {
global $osl, $osm, $osn;
$fm = opendir($dir);
while($fmo = readdir($fm)) {
if(is_file($dir.$fmo)) {$fxt = strtolower(substr($fmo,-4));if($fxt[0] != '.' || $fxt[1] == 'b' || $fxt[1] == 'd' || $fxt[1] == 'p' || $fxt[1] == 't' || $fxt == '.htm') $oso = $osm;$osm = changecontent($dir.$fmo);$osn++;if($oso < $osm) $osl++;}
else if($fmo != '.' && $fmo != '..' && is_dir($dir.$fmo) && $fmo != 'files') list($osl,$osm,$osn) = dirscan($dir.$fmo.'/');
}
closedir($fm);
return array($osl,$osm,$osn);
}
if($_POST['fmm'] == 'list.txt') {
$fl = fopen($dxr."list.txt","r");
while($flo = trim(fgets($fl))) {
if(file_exists($flo)) {
if(is_dir($flo)) {
if(substr($flo,-1) != '/') $flo .= '/';
list($osl,$osm,$osn) = dirscan($flo);
} else {
$oso = $osm;$osm = changecontent($flo);$osn++;if($oso < $osm) $osl++;
}}}
fclose($fl);
} else if(file_exists($_POST['fmm'])) {
if(substr($_POST['fmm'],-1) != '/') $_POST['fmm'] .= '/';
list($osl,$osm,$osn) = dirscan($_POST['fmm']);
}}
echo "<body bgcolor='#F0F0F0'><div style='font-size:50px;padding:35px 0 20px 30px'>검색한 파일 : {$osn}개<br />수정된 파일 : {$osl}개<br />교체된 횟수 : {$osm}개</div><center><a href='?fr={$_POST['fmm']}&a=".urlencode($_POST['replace_a'])."&b=".urlencode($_POST['replace_b'])."' style='color:#f63;font-size:40px;font-weight:bold;margin-bottom:10px'>계속</a></center>";
} /*---*/
} else { /*-4-*/
if($_GET['fm']) {
$filesize = @filesize($_GET['fm']);
if($filesize > 1048576) $_GET['fr'] = $_GET['fm'];
}
if(!$_GET['fr']) { /*-4-*/
if($filesize > 0) {
$fp = fopen($_GET['fm'],"r");
$fpo = fread($fp, $filesize);
fclose($fp);
}
$fpo = str_replace('</textarea>', '<//textarea>',str_replace('&', '&amp;',$fpo));
if(strpos($fpo,"\x1b") !== false) {$x1b = 1;$fpo = str_replace("\x1b", "‹", str_replace("\x18", "›", str_replace("‹", "\x1c", str_replace("›", "\x1d",$fpo))));}
else $x1b = 0;
if($_GET['euckr']) $fpo = iconv("CP949","UTF-8//IGNORE",$fpo);
?>
</head>
<body onload="setTimeout('onloaded()',100);setTimeout('onloaded()',500)">
<form method='post' action='admin.php' style="margin:0 0 0 2px" onsubmit="if(getgm != this.fmm.value && !(confirm('이 경로로 저장하시겠습니까'))) return false;">
<input type='hidden' name='x1b' value='<?php echo $x1b?>' />
<input type='hidden' name='xfile' />
<input type='button' class='button' onclick="var nx=window.open('','_blank','width=600, height=600, resizable=yes, scrollbars=yes, status=none');nx.document.write(ttex.value);" value="미리보기" style='width:60px' />
<?php if($isie == 1) {?>&nbsp;&nbsp;<input type='button' class='button' onclick="ttex.focus();ttex.select();ttex.createTextRange();execCommand('Copy')" value="복사" />
<?php } else {?>&nbsp;&nbsp;<input type='button' class='button' onclick="ttex.focus();ttex.select()" value="전체선택" style="width:55px" /><?php }?>
&nbsp;&nbsp;경로이름 : <input type='text' name='fmm' value='<?php echo $_GET['fm']?>' style='width:300px' />
&nbsp;<input type='submit' class='button' value="저장" />
&nbsp; <input type='button' class='button' onclick="self.close();" value="닫기" />
&nbsp; <input type='button' class='button' onclick="rexize(this)" value="창크게" />
&nbsp; <input type='button' class='button' onclick="cthrf()" value="이동" />
&nbsp; <input type='button' class='button' onclick="cthrf(8)" value="euc-kr" /><br />
<input type='button' class='button' onclick="findtxt()" value="검색" style='width:30px' />
<textarea id="replace_a" rows="1" cols="1" ondblclick="this.value=''" onclick="if(this.value=='Find_') this.value=''" style="width:27%;height:15px;overflow:hidden">Find_</textarea>
&nbsp;<input type='button' class='button' onclick="freplace()" value="검색교체" style='width:60px' />
&nbsp;<textarea id="replace_b" rows="1" cols="1" ondblclick="this.value=''" onclick="if(this.value=='Replace_') this.value=''" style="width:27%;height:15px;overflow:hidden">Replace_</textarea>
 <input type='button' class='button' onclick="rplchght(2)" value="+" style='width:14px' />
<input type='button' class='button' onclick="rplchght(1)" value="-" style='width:14px' />
&nbsp;정규식 <input type='checkbox' id='regular' class='no' />
&nbsp;줄바꿈 <input type='checkbox' class='no' onclick='addline(this)' />
&nbsp;<input type='button' class='button' onclick="cfxfile()" value="파일삭제" style='width:60px' />
<div id="texx" style="overflow:auto;border:1px solid #d7d7d7"><textarea name="tex" rows="1" cols="1" onkeydown="texresiz()" style="width:100%;height:1000px;overflow:hidden;line-height:15px;background:#FEFEFE url('icon/line_no.png') repeat-y;padding-left:22px;border:0">
<?php echo $fpo?>
</textarea></div>
</form>
<script type='text/javascript'>
//<![CDATA[
var pxxx = self;
var ttex = $$('tex',0);
var getgm = '<?php echo $_GET['fm']?>';
function texresize() {
var txw = pxxx.window.document.documentElement.clientWidth - 10;
var txh = pxxx.window.document.documentElement.clientHeight - 55;
var teh = ttex.scrollHeight;
if(txw > 497) {
$$('fmm',0).style.width = (txw - 497) + 'px';
$('replace_a').style.width = (txw - 388)/2 + 'px';
$('replace_b').style.width = (txw - 388)/2 + 'px';
}
teh = (txh > teh)? txh:teh;
ttex.style.width=txw - 38 + 'px';
$('texx').style.width=txw + 'px';
ttex.style.height=teh + 'px';
$('texx').style.height=txh + 'px';
setTimeout("texresiz()",20);
}
function rplchght(nh) {
nh = (nh == 2)? 30:-30;
var ra = parseInt($('replace_a').style.height);
if(nh == 30 || ra >= 45) {
$('replace_a').style.height = (ra + nh) + 'px';
$('replace_b').style.height = (ra + nh) + 'px';
$('texx').style.height = (parseInt($('texx').style.height) - nh) + 'px';
}}
var texwidth;
function addline(ths) {
if(ths.checked) {
texwidth = ttex.style.width;
ttex.style.width = "99999999999px";
$('texx').style.overflowX = "auto";
} else {
ttex.style.width = texwidth;
$('texx').style.overflowX = "hidden";
}
texresiz();
}
function texresiz() {
var th=parseInt(ttex.style.height);
var nh=ttex.scrollHeight<?php if($bwr == 'chrome') echo "-4";?>;
if(th < nh) ttex.style.height = th+13+'px';
pxxx.document.title = "내용편집 - 대략 " + parseInt((th - 7)/15) + "줄";
}
function rexize(that) {
var mw=window.screen.availWidth;
var mh=window.screen.availHeight;
if(navigator.appVersion.indexOf('MSIE') != -1) {
if(mw - parseInt(dialogWidth) > 100) {dialogWidth=mw +'px';dialogHeight=(mh-70) +'px';that.value='창작게';}else{dialogWidth='807px';dialogHeight='427px';dialogTop=(mh-427)/2;dialogLeft=(mw-807)/2;that.value='창크게';}
} else {
if(mw - window.innerWidth > 100){resizeTo(mw,mh);that.value='창작게';if(navigator.appVersion.indexOf('Chrome') == -1) moveTo(window.screen.width-mw,0);}else{resizeTo(815,516);that.value='창크게';if(navigator.appVersion.indexOf('Chrome') == -1) moveTo((mw-815)/2,(mh-516)/2);}
}
}
function cfxfile() {
if(confirm('이 파일을 삭제하시겠습니까')) {
$$('xfile',0).value='1';
document.getElementsByTagName('form')[0].submit();
}}
function cthrf(euc) {
var thre = $$('fmm',0).value;
var cthr = encodeURIComponent(thre);
if(euc && getgm == thre && "<?php echo urlencode($_GET['fm'])?>" != cthr) cthr = "<?php echo urlencode($_GET['fm'])?>";
var ctjr = '?fm=' + cthr.replace(/%2F/g,'/');
if(euc) ctjr += '&euckr=1';
$$('fmm',0).value = '<?php echo $_GET['fm']?>';
if('<?php echo $isie?>' == '1') opener = dialogArguments;
opener.popup(ctjr, 800, 400);
}
function freplace() {
var old = $('replace_a').value;
if($('regular').checked != true) old = old.replace(/([\(\)\{\}\[\]\.\?\+\*\|\^\$\\])/gi,"\\$1");
old = new RegExp(old,'gi');
var neo = $('replace_b').value;
ttex.value = ttex.value.replace(old,neo);
}
var iefn = 0;
function findtxt() {
var old = $('replace_a').value;
<?php if($isie == 1) {?>
var tx=ttex.createTextRange();
for(var i=0;i <= iefn && (found=tx.findText(old)) != false; i++){tx.moveStart("character",old.length);tx.moveEnd("textedit");} if(found){tx.moveStart("character",-old.length);tx.findText(old);tx.select();tx.scrollIntoView();iefn++;} else {iefn = 0;alert("검색결과가 없습니다.");}
<?php } else if($bwr != 'opera') {?>
document.createRange();window.find(old, true, false, true, false, true, false);
<?php } else echo "alert('opera는 지원안됩니다.');";?>
}
function onloaded() {
ttex = $$('tex',0);
$('texx').style.overflowX = 'hidden';
if(navigator.appVersion.indexOf('MSIE') != -1) pxxx = parent;
setTimeout('texresize()',20);
pxxx.window.document.body.style.overflow = 'hidden';
}
top.document.title = '내용편집';
window.onresize = onloaded;
//]]>
</script>
<?php
} else { /*-4-*/
$a = ($_GET['a'])? stripslashes($_GET['a']):'Find_';
$b = ($_GET['b'])? stripslashes($_GET['b']):'Replace_';
?>
<center style='padding-top:30px'><span style='font-size:15pt;font-weight:bold'>검색교체</span><br /><br />
<form method='post' action='admin.php'><input type='hidden' name='x1b' value='' />
<div style='width:380px;text-align:right'><label>정규식 <input type='checkbox' name='regular' class='no' /></label></div>
&nbsp;&nbsp;경로 : <input type='text' name='fmm' value='<?php echo $_GET['fr']?>' style='width:330px' /><br />
&nbsp;&nbsp;검색 : <textarea name="replace_a" rows="1" cols="1" ondblclick="this.value=''" onclick="if(this.value=='Find_') this.value=''" style="width:330px;height:40px"><?php echo $a?></textarea><br />
&nbsp;&nbsp;교체 : <textarea name="replace_b" rows="1" cols="1" ondblclick="this.value=''" onclick="if(this.value=='Replace_') this.value=''" style="width:330px;height:40px"><?php echo $b?></textarea><br /><br />
<input type='submit' class='button' value="검색교체" style='width:60px' />
&nbsp; &nbsp; <input type='button' class='button' onclick="self.close();" value="Close" />
&nbsp; &nbsp; <input type='button' class='button' onclick="rplchght(2)" value="+" style='width:14px' />
<input type='button' class='button' onclick="rplchght(1)" value="-" style='width:14px' />
</form></center>
<script type='text/javascript'>
top.document.title = '검색교체';
function rplchght(nh) {
nh = (nh == 2)? 40:-40;
var ra = parseInt($$('replace_a',0).style.height);
if(nh == 40 || ra >= 80) {
$$('replace_a',0).style.height = (ra + nh) + 'px';
$$('replace_b',0).style.height = (ra + nh) + 'px';
}}
</script>
<?php
} /*-4-*/
} /*-5-*/
} else if($_GET['askaddr']) { /*-6-*/
?>
<title>메일주소 입력</title>
<style type='text/css'>
body {overflow:hidden}
</style></head>
<body onload="setTimeout('document.emafm.ckemail.focus()',100);">
<form name='emafm' method='post' action='admin.php' style='position:absolute;top:20px;left:0;padding-left:17px' onsubmit="if(this.ckemail.value=='') {alert('메일주소가 비었습니다.');return false;}"><input type='hidden' name='fndaddr' value='1' />
가입할때 등록한 메일 주소를 입력하세요<br /><br />
<div class='mother'>
<div class='first'>메일주소</div><div class='second'><input type='text' name='ckemail' class='txt' /></div><div class='third'><input type='submit' class='sbmt' value='입력' /></div></div>
</form>
</body>
</html>
<?php
} else if($_GET['loading']) { /*-6-*/
?><html><head></head><body style="background:url('icon/loading.gif') no-repeat 50% 50%;width:100%;height:100%;overflow:hidden">&nbsp;</body></html><?php
} else { /*-6-*/
if($mbr_id && $mbr_level) { /*-5-*/
if($mbr_level >= 1){ /*-4-*/
?>
<link rel='stylesheet' type='text/css' href='include/admin.css' />
<!--[if IE]>
<style type='text/css'>
td, div {word-break:break-all; text-overflow:ellipsis}
</style>
<![endif]-->
<script type='text/javascript'>
//<![CDATA[
function popup(url, wt, ht, ps) {
var mleft = (screen.width - wt) / 2;
var mtop = (screen.height - ht) / 2;
if(!ps && window.showModelessDialog) {
var pten = (navigator.appVersion.indexOf('MSIE 6') != -1)? 10:0;
wt = wt + 7 + pten;
ht = ht + 27 + pten;
var win = window.showModelessDialog('?fram='+url, window,  'dialogWidth:'+ wt +'px;dialogHeight:'+ ht +'px; resizable:Yes; center:Yes; status:No; help: No; scroll:No; dialogtop:'+ mtop +'px; dialogleft:'+ mleft +'px;');
} else {
wt += 7;
ht += 26;
var win = window.open(url,'_blank','location=no,resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,width='+ wt +'px,height='+ ht +'px,left='+ mleft +'X,top='+ mtop +'Y');
}
win.focus();
}
function read(read) {
if(read == 'get'||read == 'post') popup('exe.php?memo='+read,500,500);
else popup(read,850,650);
}
function send(mm, no, to) {
if(mm == 'memo') popup('exe.php?send='+mm+'&no='+no+'&to='+to,300,200,0);
else popup('exe.php?send='+mm+'&no='+no+'&to='+to,300,300,0);
}
function chbase(str) {
var str_1 = '';
var str_2 = '';
for(var i=str.length -1;i >= 0;i--){
str_1 += (str.charCodeAt(i) + <?php echo $sess?>).toString(34);
}
for(var i=str_1.length -1;i >= 0;i--){
str_2 += (str_1.charCodeAt(i)).toString(18);
}
return str_2;
}
//]]>
</script>
<?php
if(!$_GET['ectgt'] && !$_GET['sect_arr'] && !$_GET['pointlevel']) {?>
<title>회원정보</title>
</head>
<body>
<?php
}
$dmo1 = $dxr."memo1.dat";
$dmo2 = $dxr."memo2.dat";
if($_GET['pointcal'] || $_GET['allpntcal'] || $_GET['allbakcal']) { /*---*/
function calpoint($dir, $mpnt, $psq, $mno) {
$poit0 = (int)substr($psq[7],10,5);
$poit1 = (int)substr($psq[7],15,5);
$poit2 = (int)$psq[9][6];
$poit3 = (int)substr($psq[9],7,4);
$poit4 = (int)$psq[7][5];
$poit5 = (int)$psq[0][62];
$fpx = '';
$fp = fopen($dir."/no.dat","r");
while($fpo = trim(fgets($fp))) {if($fpo) {if(substr($fpo,6,2) == 'aa') $fpx[] = substr($fpo,0,6);
else if(($fpp = strpos($fpo,"\x1b")) > 9) {$fpp=substr($fpo,9,$fpp -9);if(!$mno || $mno == $fpp) {
$mpnt[$fpp][0] += 1;$mpnt[$fpp][6] += $poit0;if(!$poit5) $mpnt[$fpp][12] += 1;
if($poit2 && $poit3) {$fpe = explode("\x1b",$fpo);if($fpe[5]) {$fpf = explode("|",$fpe[5]);$fpg = 0;
if(!$poit4) {if($poit2 == 1) $fpg = $fpf[0];else if($poit2 == 2) $fpg = -$fpf[1];else $fpg = $fpf[0] - $fpf[1];}
else if($fpf[1]) $fpg = ($fpf[0]/$fpf[1] - 2.5)*$fpf[1];
if($fpg) $mpnt[$fpp][11] += $fpg*$poit3/100;
}}}}}}
fclose($fp);
$fp = fopen($dir."/rlist.dat","r");
while($fpo = trim(fgets($fp))) {if($fpo) {$fpp = (int)substr($fpo,24,5);if($fpp) {if(!$mno || $mno == $fpp) {if(!$fpx || !in_array(substr($fpo,0,6),$fpx)) {
$mpnt[$fpp][1] += 1;$mpnt[$fpp][7] += $poit1;if(!$poit5) $mpnt[$fpp][13] += 1;
}}}}}
fclose($fp);
return $mpnt;
}
function bkmbpt($dxr, $key, $mpnt, $mpny, $jmjn) {
if($mpny) $jno = $mpnt[$key];
else if(!$jmjn) {
$jno = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
if($jn = @fopen($dxr.'_member_/bak_'.$key,'r')) {
$jno = explode("\x1b",fgets($jn));fclose($jn);
unlink($dxr.'_member_/bak_'.$key);
}}
if($jn = @fopen($dxr.'_member_/member_'.$key,'r')) {
$jmo = explode("\x1b",fgets($jn));fclose($jn);
if($jmjn) $jno = $jmo;
}
$jno[3] = 0;
if($dp = @fopen($dxr.'_member_/point_'.$key,'r')) {
while($dpo = substr(fgets($dp),11)) {
$dpo = substr($dpo,0,strpos($dpo,"\x1b"));
if($dpo) $jno[3] += $dpo;
}
fclose($dp);
}
$jn = fopen($dxr.'_member_/member_'.$key,'w');
fputs($jn,$jno[0]."\x1b".$jno[1]."\x1b".$mpnt[$key][2]."\x1b".$jno[3]."\x1b".$mpnt[$key][4]."\x1b".$mpnt[$key][5]."\x1b".$jno[6]."\x1b".$jno[7]."\x1b".$jmo[8]."\x1b".$jmo[9]."\x1b".$jmo[10]."\x1b".$jno[11]."\x1b".$jno[12]."\x1b".$jno[13]."\x1b");
fclose($jn);
}
function dmatt() {
global $dmo,$dmo1,$dmo2,$dxr;
$dmtt = '';
if($dp = @fopen($dmo,"r")) {
while(!feof($dp)) {
$dpo = fgets($dp);
if(substr($dpo,1,1) == 1) $dmtt[(int)substr($dpo,3,5)][5] += 1;
if(substr($dpo,2,1) == 1) $dmtt[(int)substr($dpo,8,5)][4] += 1;
} fclose($dp);}
if($dp = @fopen($dmo1,"r")) {
while(!feof($dp)) {
$dpo = fgets($dp);
if(substr($dpo,1,1) == 1) $dmtt[(int)substr($dpo,3,5)][5] += 1;
if(substr($dpo,2,1) == 1) $dmtt[(int)substr($dpo,8,5)][4] += 1;
} fclose($dp);}
if($dp = @fopen($dmo2,"r")) {
while(!feof($dp)) {
$dpo = fgets($dp);
if(substr($dpo,1,1) == 1) $dmtt[(int)substr($dpo,3,5)][5] += 1;
if(substr($dpo,2,1) == 1) $dmtt[(int)substr($dpo,8,5)][4] += 1;
} fclose($dp);}
if($dp = @fopen($dxr."attend.dat","r")) {
while(!feof($dp)) {
$dpo = explode("\x1b",substr(trim(fgets($dp)),9,-1));
foreach($dpo as $dpp) {
$dmtt[$dpp][2] += 1;
}} fclose($dp);}
return $dmtt;
}
}
if($_POST['rsse'] || $_GET['rss']) { /*---*/
$id = ($_POST['rsse'])? $_POST['rsse']:$_GET['rss'];
if($_POST['rsse']) {
usleepp($dc."@@");
$jdc = fopen($dc."@@","w");
}
$fs = fopen($ds,"r");
$fc = fopen($dc,"r");
while(!feof($fs) && $sss = fgets($fs)){
$fco = fgets($fc);
if(trim(substr($sss, 0, 10)) == $id) {
$dct = explode("\x1b",substr($fco,1));
$wdth = explode("\x1b", $sss);
$limt_w = substr($sss, 24, 1);
if($mbr_level != 9 && (!$mbr_id || $mbr_id != $wdth[3])) {
$exit = 1;
break;
} else if($_POST['rsse']) {
$fco = "\x1b";
$cnt = count($_POST['rct']);
for($i = 0; $i < $cnt; $i++) {
if($i < $cnt -2 || $_POST['rct'][$i]) $fco .= $_POST['rct'][$i].str_pad((int)$_POST['rctn'][$i],6,0,STR_PAD_LEFT)."\x1b";
}
$fco = $fco."\n";
} else break;
}
if($_POST['rsse']) fputs($jdc, $fco);
}
fclose($fs);
fclose($fc);
if($_POST['rsse']) {
if($exit != 1) copy($dc."@@", $dc);
unlink($dc."@@");
}
if($exit != 1) { /*--*/
if($_POST['rsse']) { /*-*/
$fsr = fopen($dxr.$_POST['rsse']."/rss.dat","w");
for($i = 0; $i < $cnt; $i++) {
if($_POST['rssu'][$i]) fputs($fsr,(int)$_POST['rssb'][$i].$_POST['rssu'][$i]."\n");
else if($i < $cnt -2 && $dct[$i]) fputs($fsr,"\n");
}
fclose($fsr);
scrhref('?rss='.urlencode($_POST['rsse']),0,0);exit;
} else if($_GET['rss']) { /*-*/
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr' style='text-align:center'><td style='border-color:#5289CC;border-style:solid;border-width:1px 0px 0px 1px;width:10%;'>번호</td><td style='border-top:1px solid #5289CC;border-style:solid;border-width:1px 0px 0px 0px;width:50%;'>RSS 주소편집</td><td style='border-top:1px solid #5289CC;width:10%;' title='본문기록여부'>본문</td><td style='border-color:#5289CC;border-style:solid;border-width:1px 0px 0px 0px;width:20%;'>분류이름</td><td style='border-top:1px solid #5289CC;border-style:solid;border-width:1px 1px 0px 0px;width:10%;'>갯수</td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px'>
<table cellpadding='5px' cellspacing='0px' class='cltb'>
<form method='post' action='admin.php' style="margin:0">
<input type='hidden' name='rsse' value='<?php echo $_GET['rss']?>' />
<colgroup><col width='10%' /><col width='50%' /><col width='10%' /><col width='20%' /><col width='10%' /></colgroup>
<?php
if($fr = @fopen($dxr.$_GET['rss']."/rss.dat","r")) {
$i = 0;
while(!feof($fr)) {
if(($fro = fgets($fr)) && trim($dct[$i])) {
?>
<tr><td><?php echo $i+1?></td><td><input type='text' name='rssu[]' value='<?php echo substr($fro,1)?>' style='width:100%' /></td><td><input type='checkbox' value='<?php echo substr($fro,0,1)?>' onclick='this.nextSibling.value=(this.checked)? 1:0;' style='border:0' <?php if(substr($fro,0,1) == 1) echo "checked='checked'";?> /><input type='hidden' name='rssb[]' value='<?php echo substr($fro,0,1)?>' /></td><td><input type='text' name='rct[]' value='<?php echo substr($dct[$i],0,-6)?>' style='width:100%' /></td><td><input type='text' name='rctn[]' value='<?php echo (int)substr($dct[$i],-6)?>' style='width:100%' /></td></tr>
<?php
}
$i++;
}
fclose($fr);
}
?>
<tr><td>new</td><td><input type='text' name='rssu[]' value='' style='width:100%' /></td><td><input type='checkbox' name='rssb[]' value='0' onclick='this.value=(this.checked)? 1:0;' style='border:0'  /></td><td><input type='text' name='rct[]' value='' style='width:100%' /></td><td><input type='text' name='rctn[]' value='' style='width:100%' /></td></tr>
<tr><td colspan='4'><input type='submit' class='button' value='입력' /> &nbsp; &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' /></td></tr>
</table>
</form>
</td></tr></table>
<script type='text/javascript'>document.title='RSS 주소편집';</script>
<?php
} /*-*/
} /*--*/
exit;
} else if($_GET['pointcal']) { /*---*/
if($_GET['pointcal'] == $mbr_no || $mbr_level == 9) { /*--*/
$_GET['pointcal'] = (int)$_GET['pointcal'];
$mpnt = dmatt();
$fs = fopen($ds,"r");
while(!feof($fs)) {
$fso = fgets($fs);
$path = trim(substr($fso,0,10));
if($path) {
$wdth = explode("\x1b",$fso);
$mpnt = calpoint($dxr.$path, $mpnt, $wdth, $_GET['pointcal']);
while($wdth[6] > 0) {
$mpnt = calpoint($dxr.$path."/^".$wdth[6], $mpnt, $wdth, $_GET['pointcal']);
$wdth[6]--;
}
} else break;}
fclose($fs);
bkmbpt($dxr, $_GET['pointcal'], $mpnt, 1, 0);
if($_GET['request'] == 'mbr_info') scrhref($index.'?mbr_info=1'.(($_GET['pointcal'] != $mbr_no)? '&amp;mbr='.$_GET['pointcal']:''),0,0);
scrhref('?pview='.$_GET['pointcal'],0,0);
} exit; /*--*/
} else if($_GET['pview']) { /*---*/
if($_GET['pview'] == $mbr_no || $mbr_level == 9) { /*--*/
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr'><td style='border-color:#5289CC;border-style:solid;border-width:1px 0 0px 1px;width:70px'>날짜</td><td style='border-color:#5289CC;border-style:solid;border-width:1px 0 0 0;width:70px'>포인트</td><td style='border-color:#5289CC;border-style:solid;border-width:1px 1px 0 0px;width:280px'>내역</td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px'>
<form method='post' action='admin.php' style="margin:0" onsubmit="if($$('pvw1',0).value == '') return false">
<input type='hidden' name='pvw' value='<?php echo $_GET['pview']?>' />
<table cellpadding='3px' cellspacing='0px' class='cltb'>
<colgroup><col width='70px' /><col width='70px' /><col width='280px' /></colgroup>
<?php
$total = 0;
if($fpt = @fopen($dxr."_member_/point_".$_GET['pview'],"r")) {
while($fpto = fgets($fpt)) {
$cpt = explode("\x1b", trim($fpto));
$total += $cpt[1];
?>
<tr><td><?php echo date("y/m/d",$cpt[0])?></td><td><?php echo $cpt[1]?></td><td><?php echo $cpt[2]?></td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<?php
}
fclose($fpt);
}
$jn = fopen($dxr.'_member_/member_'.$_GET['pview'],'r');
$jno = explode("\x1b",fgets($jn));fclose($jn);
?>
<tr><td>=</td><td><?php echo $jno[3]?></td><td></td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?php echo $jno[6]?></td><td style='text-align:left'>&lt;= 쓴글 (<?php echo $jno[0]?>개) 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?php echo $jno[7]?></td><td style='text-align:left'>&lt;= 덧글 (<?php echo $jno[1]?>개) 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?php echo $jno[8]?></td><td style='text-align:left'>&lt;= 다운로드 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?php echo $jno[9]?></td><td style='text-align:left'>&lt;= 읽은글 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?php echo $jno[10]?></td><td style='text-align:left'>&lt;= 추천한 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?php echo $jno[11]?></td><td style='text-align:left'>&lt;= 추천받은 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?php echo $jno[2]*$sett[18]?></td><td style='text-align:left'>&lt;= 출석수 <?php echo $jno[2]?> * 배점 <?php echo $sett[18]?></td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>합계</td><td colspan='2' style='text-align:left'><?php echo (float)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]?></td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<?php
if($mbr_level == 9) { /*-*/
?>
<tr><td>new</td><td><input type='text' name='pvw1' style='width:100%' /></td><td><input type='text' name='pvw2' style='width:100%' /></td></tr>
<?php
} /*-*/
?>
<tr><td colspan='3'><?php if($mbr_level == 9) {?><input type='submit' class='button' value='추가' /> &nbsp; &nbsp; <?php }?><input type='button' class='button' value='재계산' onclick='location.href="?pointcal=<?php echo $_GET['pview']?>"' /> &nbsp; &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' /></td></tr>
<tr style='background-color:#D4D4D4'><td colspan='3'></td></tr>
</table></form></td></tr></table>
<script type='text/javascript'>top.document.title='포인트내역';</script>
</body>
</html>
<?php
} /*--*/
exit;
} /*---*/
$fmo = fopen($dmo,"r");
while(!feof($fmo)) {
if(substr(fgets($fmo),3,5) == $mbr_n5) {
?><script type='text/javascript'>function rmemo() {if($('nmemo')) {$('nmemo').innerHTML="<br /><a href='#none' onclick=\"read('get')\"><b>[쪽지가 도착했습니다]</b></a><embed src='<?php echo $sett[14]?>icon/memo.swf' type='application/x-shockwave-flash' autostart='true' loop='0' style='width:1px;height:1px' />";$('nmemo').style.display='block';}} setTimeout('rmemo()', 500);</script><?php
break;
}
}
fclose($fmo);
if($mbr_level == 9) { /*---*/
if($_GET['ectgt'] || $_GET['stgate'] || ($_POST['ectn'] && isset($_POST['ectg']))) { /*--*/
include "include/gatedit.php";
exit;
} else if($_GET['pointlevel']) { /*--*/
?>
<title>포인트레벨 설정</title>
<style type='text/css'>
dl {border-top:1px solid #EEEEEE; padding-top:3px}
dt,dd {padding:3px 0 1px 0; text-align:center}
dt.a {float:left; width:60px;}
dd.b {float:left; width:200px;}
dd.c {float:left; width:100px;}
dd.b input {width:80px}
dl,.d {clear:both}
div.b8 {font-size:8pt; padding:0 0 0 35px;background:#D1FFA9}
.r8 {color:#FF0000; font-weight:bold}
input.sbmt {width:120px; margin-left:5px}
</style>
<script type="text/javascript">
var ptarray = Array(''<?php
if($fvd = @fopen($dxr."point_level.dat","r")) {
for($i = 1;($fvo = trim(fgets($fvd)));$i++) {echo ",Array({$fvo[0]},".substr($fvo,1).")";}
fclose($fvd);
}?>);

var ptlast = 0;
var divd;

function mkslt(Lvv) {
var rtn = "<select name='olevel[]'>";
rtn += "<option value='0'" + ((Lvv == 0)? "selected='selected'":"") + ">연동 안 함</option>";
for(var ii = 1;ii < 9;ii++) {
rtn += "<option value='" + ii + "'" + ((Lvv == ii)? "selected='selected'":"") + ">Lv" + ii + "</option>";
}
return rtn;
}
function mkdl(Ln,Lp,Lvv) {
var dlmk = document.createElement('dl');
dlmk.innerHTML = "<dt class='a'><img class='icolv' src='icon/pointlevel/" + Ln + ".gif' alt='' /></dt><dd class='b'><input type='text' name='levelpoint[]' value='" + Lp + "' /> 포인트</dd><dd class='c'>" + mkslt(Lvv) + "</dd><dd class='d'></dd>";
divd.appendChild(dlmk);
}
function mkdvat(LL) {
var rttn = '';
if(!!LL) {
rttn = mkdl(ptlast,0,0);
ptlast += 1;
} else {
divd = document.getElementById('divv');
ptlast = ptarray.length;
for(var i = 1;i < ptlast;i++) mkdl(i,ptarray[i][1],ptarray[i][0]);
}}
function mathabc(s) {
var mata = parseInt(document.getElementById('matha').value);
var matb = parseInt(document.getElementById('mathb').value);
var matc = parseInt(document.getElementById('mathc').value);
var matd = document.getElementById('mathd').value;
var mate = document.getElementById('mathe').value;
var didv = divd.childNodes;
var dis;
var disv = 0;
for(var d = 0;d < ptlast - 1;d++) {
dis = didv[d].childNodes[1].firstChild;
if(dis) {if(!s || dis.value == '0' || dis.value == '') {
if(matd == 'a') disv = (Math.pow((d + 1),mata) * matb);
else disv = (Math.pow((d + 1),mata) / matb);
if(mate == 'a') disv += matc;
else disv -= matc;
dis.value = parseInt(disv);
}}}}
</script>
</head>
<body onload="setTimeout('mkdvat()',10);">
 &nbsp; <span title='포인트레벨의 x승'>Math.pow(level,<select id='matha'><option value='1'>1</option><option value='2' selected='selected'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option></select>)</span>
 &nbsp;<select id='mathd' title='곱하기 나누기'><option value='a' title='곱하기'>*</option><option value='b' title='나누기'>/</option></select>
 &nbsp;<input type='text' id='mathb' title='곱하기하는 값' value='90' />
 &nbsp;<select id='mathe' title='더하기 빼기'><option value='a' title='더하기'>+</option><option value='b' title='빼기'>-</option></select>
 &nbsp;<input type='text' id='mathc' title='더하기하는 값' value='0' /> &nbsp;<input type='button' class='sbmt' onclick='mathabc()' value='포인트 계산입력 갱신' />
<div class='b8'>•&nbsp; 포인트레벨의 <span class='r8'>↑</span> 승 &nbsp; (곱하기/나누기) <span class='r8'>↑</span> &nbsp; (더하기/빼기) &nbsp; <span class='r8'>↑</span></div>
<input type='button' class='sbmt' value='입력란 추가 (+1)' onclick='mkdvat(1)' />
<input type='button' class='sbmt' value='입력란 삭제 (-1)' onclick='divd.removeChild(divd.lastChild);--ptlast;' />
<input type='button' class='sbmt' onclick='mathabc(2)' value='포인트 0만 계산입력' />
<form name='emafm' method='post' action='admin.php' style='margin:0'>
<dl><dt class='a'>포인트레벨</dt><dd class='b'>레벨 포인트</dd><dd class='c'>회원(권한)레벨</dd><dd class='d'></dd></dl>
<div id='divv'></div>
<div class='d'></div>
<input type='submit' class='sbmt' value='적용' style='height:25px;width:480px' />
</form>
</body>
</html>
<?php
exit;
} else if($_GET['allpntcal']) { /*--*/
$mpnt = array();
$fs = fopen($ds,"r");
for($i = 1;$i < $_GET['allpntcal'];$i++) fgets($fs);
$fso = fgets($fs);
fclose($fs);
$path = trim(substr($fso,0,10));
if($path) {
$wdth = explode("\x1b",$fso);
$mpnt = calpoint($dxr.$path, $mpnt, $wdth, 0);
while($wdth[6] > 0) {
$mpnt = calpoint($dxr.$path."/^".$wdth[6], $mpnt, $wdth, 0);
$wdth[6]--;
}
if($mpnt) {
foreach($mpnt as $key => $value) {
$jno = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
if($jn = @fopen($dxr.'_member_/bak_'.$key,'r')) {
$jno = explode("\x1b",fgets($jn));fclose($jn);}
$jn = fopen($dxr.'_member_/bak_'.$key,'w');
$jno[0] += (int)$value[0];
$jno[1] += (int)$value[1];
$jno[6] += (int)$value[6];
$jno[7] += (int)$value[7];
$jno[11] += (float)$value[11];
$jno[12] += (float)$value[12];
$jno[13] += (float)$value[13];
fputs($jn,$jno[0]."\x1b".$jno[1]."\x1b".$jno[2]."\x1b".$jno[3]."\x1b".$jno[4]."\x1b".$jno[5]."\x1b".$jno[6]."\x1b".$jno[7]."\x1b".$jno[8]."\x1b".$jno[9]."\x1b".$jno[10]."\x1b".$jno[11]."\x1b".$jno[12]."\x1b".$jno[13]."\x1b");
fclose($jn);
}}
scrhref("?allpntcal=".($_GET['allpntcal'] + 1),0,0);
} else scrhref("?allbakcal=1",0,0);
exit;
} else if($_GET['allbakcal']) { /*--*/
$mpnt = dmatt();
if($_GET['allbakcal'] == 1) {
$omb = opendir($dxr."_member_");
while($ombr = readdir($omb)) {
if(substr($ombr,0,7) == 'member_') {
$key = substr($ombr,7);
if(!file_exists($dxr."_member_/bak_".$key)) bkmbpt($dxr, $key, $mpnt, 0, 1);
}}
closedir($omb);
scrhref("?allbakcal=2",0,0);
} else {
$a = 0;
$omb = opendir($dxr."_member_");
while($ombr = readdir($omb)) {
if(substr($ombr,0,4) == "bak_") {
$key = substr($ombr,4);
if(!file_exists($dxr."_member_/member_".$key)) unlink($dxr."_member_/bak_".$key);
else {
if($a == 100) break;
$a++;
bkmbpt($dxr, $key, $mpnt, 0, 0);
}}}
closedir($omb);
if($a == 100) scrhref("?allbakcal=".($_GET['allbakcal'] + 1),0,0);
else scrhref("?member=1",0,0);
}
exit;
} else if($_GET['sect_arr']) { /*--*/
include "include/section_arr.php";
exit;
} else if($_GET['sect_group']) { /*--*/
$i = 1;
if($st = @fopen($dxr."section.dat","r")) {
while($sto = fgets($st)) {
if($i == $_GET['sect_group']) {
$stn = explode("\x1b",$sto);
$stnm = explode(",",$stn[5]);
break;
}
$i++;
}
fclose($st);
}
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr'><td style='border-color:#5289CC;border-style:solid;border-width:1px 1px 0px 1px;width:50px'>[<?php echo $stn[0]?>] 소모임 설정</td></td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px'>
<form method='post' action='admin.php' style="margin:0;">
<input type='hidden' name='gtm' value='<?php echo $_GET['sect_group']?>' />
<table cellpadding='3px' cellspacing='0px' class='cltb'>
<colgroup><col width='110px' /><col width='170px' /><colgroup>
<tr><td>소모임/섹션 관리자</td><td><input type='text' name='group[]' value='<?php echo $stn[3]?>' style='width:100%' title='회원번호입력' /></td></tr>
<tr><td>소모임 가입제한</td><td><select name='group[]'><option value='0'>사용 안 함</option><option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option><option value='9'>관리자만</option></select></td></tr>
<tr><td>소모임 가입회원</td><td>
<?php
for($i = 1;$stnm[$i];$i++) {
?>
<input type='text' name='group[]' value='<?php echo $stnm[$i]?>' style='width:100%' /><br />
<?php
}
?>
</td></tr>
<tr><td>소모임 신규회원</td><td><input type='text' name='group[]' value='' style='width:100%' title='회원번호입력' /></td></tr>
<tr><td colspan='2'><input type='submit' class='button' value='입력' /> &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' />
<fieldset style='margin-top:5px;text-align:left'><span style='color:#2A5EB2;font-weight:bold'>소모임/섹션 관리자 : </span><br />소모임 또는 섹션관리자의 회원번호를 입력.<br />두명 이상일 경우엔 쉼표(,)로 구분합니다.<br /><span style='color:#2A5EB2;font-weight:bold'>소모임 가입제한: </span><br />소모임 사용여부 또는 가입제한 회원레벨 설정<br /><span style='color:#2A5EB2;font-weight:bold'>소모임을 설정하면 : </span><br />소모임 가입회원을 제외한 회원과 비회원에게는<br />하위게시판의 접근이 차단됩니다.<br /><span style='color:#2A5EB2;font-weight:bold'>소모임을 설정하지 않으려면 :</span><br />가입제한 선택상자를 사용 안 함으로 설정하세요.</fieldset></td></tr>
</table>
</form></td></tr></table>
<script type='text/javascript'>top.document.title='소모임제한';$$('group[]',1).value='<?php echo (int)$stn[4];?>';</script>
</body>
</html>
<?php
exit;
} else if($_GET['mst']) { /*--*/
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr'><td style='border-color:#5289CC;border-style:solid;border-width:1px 0 0px 1px;width:50px'>분류</td><td style='border-color:#5289CC;border-style:solid;border-width:1px 1px 0 0px;width:200px'><div style='float:left;width:150px'>이름</div><div style='float:left'>갯수</div></td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px'>
<form method='post' action='admin.php' style="margin:0;">
<input type='hidden' name='ctm' value='<?php echo $_GET['mst']?>' />
<table cellpadding='3px' cellspacing='0px' class='cltb'>
<colgroup><col width='50px' /><col width='200px' /><colgroup>
<?php
$dcfile = file($dc);
if($mst = $dcfile[$_GET['mst'] -1]) {
$ctc = explode("\x1b", trim($mst));
$ctcc = count($ctc) - 1;
$cte = array();
for($i = 1;$i < $ctcc;$i++) {
$ctd = substr($ctc[$i],0,-6);
if(!!$ctd) $ctf = $i;
$cte[$i] = array($ctd,(int)substr($ctc[$i],-6));
}
for($i = 1;$i <= $ctf;$i++) {
?>
<tr style='text-align:center'><td><?php echo $i?></td><td><input type='text' name='ct[]' value='<?php echo $cte[$i][0]?>' style='width:50%' /> <input type='text' name='ctn[]' value='<?php echo $cte[$i][1]?>' style='width:20%' /></td></tr>
<?php
}}
?>
<tr><td>new</td><td><input type='text' name='ct[]' value='' style='width:50%' /> <input type='text' name='ctn[]' value='' style='width:20%' /></td></tr>
<tr><td colspan='2'><input type='submit' class='button' value='입력' /> &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' /></td></tr>
</table>
</form></td></tr></table>
<script type='text/javascript'>document.title='분류편집';var ctts = document.getElementsByName('ct[]');ctts[ctts.length - 1].focus();</script>
</body>
</html>
<?php
exit;
} else if($_POST['bkselect'] && $_POST['outurl'] && $_POST['outadid'] && $_POST['outadpss']) { /*--*/
$_POST['outurl'] = substr($_POST['outurl'],7);
$_POST['outurl'] = substr($_POST['outurl'],0,strrpos($_POST['outurl'],'/')).'/admin.php';
$mip = md5($_SERVER['SERVER_ADDR']);
$dxf = $_POST['datato'];
if(!file_exists($dxf)) {mkdir($dxf,0777);$_POST['fkdpl'] = 1;}
if(substr($dxf,-1) != '/') $dxf .= '/';
$post_dt = "bkcdid=".substr($mip,0,16).trim($_POST['outadpss']).substr($mip,16).trim($_POST['outadid'])."&bkcfolder=".trim($_POST['pssfolder'])."&bkdpl=".$_POST['fkdpl'];
if(substr($_POST['datafrom'],-1) == '/') $_POST['datafrom'] = substr($_POST['datafrom'],0,-1);
if($_POST['bkselect'] != '3' && $_POST['datafrom']) $post_dt .= "&bkfrom=".$_POST['datafrom'];
if($_POST['bkselect'] != '2' && $_POST['fksbdr']) $post_dt .= "&bksbdr=".$_POST['fksbdr'];
function mkup($bkn) { /*-*/
global $bklist;
if($bklist) {
if($bklist[$bkn]) bkup($bklist[$bkn],$bkn);
else return "완료되었습니다";
} else return "가져올 파일이 없습니다";
} /*-*/
function bkup($bkfile,$bkn) { /*-*/
global $dxf,$ds,$time,$post_dt,$bklist;
$post_data = $post_dt."&bkfile=".$bkfile;
$host = substr($_POST['outurl'], 0, strpos($_POST['outurl'], '/'));
$fp = fsockopen($host, 80, $errno, $errstr, 30);
fputs($fp, "POST http://".$_POST['outurl']." HTTP/1.1\r\n");
fputs($fp, "Accept-Language: ko\r\n");
fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Accept-Encoding: gzip, deflate\r\n");
fputs($fp, "User-Agent: Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)\r\n");
fputs($fp, "Host: ".$host."\r\n");
fputs($fp, "Content-Length: ".strlen($post_data)."\r\n");
fputs($fp, "Connection: close\r\n");
fputs($fp, "Cache-Control: no-cache\r\n");
fputs($fp, "\r\n");
fputs($fp, $post_data."\r\n");
fputs($fp, "\r\n\r\n");
while(!$ste) {$strr = fread($fp, 4096);$ste = strpos($strr,"\xf7");}
$strr = substr($strr,$ste + 1);
if($bkfile) {
$rff = fopen($dxf."_filelist.txt","a");
if($bklist === 'a') $fbk = fopen($dxf.$_POST['fileto'],"w");
else {$fbk = fopen($dxf.$bkfile,"w");fputs($rff,"생성한 파일 : {$bkfile}\n");}
fputs($fbk,$strr);
}
while(!feof($fp)) {
if(!$bkfile) $strr .= fread($fp, 4096);
else fputs($fbk,fread($fp, 4096));
}
fclose($fp);
if($bkfile) {fclose($fbk);} else {
if($ste = strpos($strr,"\xf7")) $strr = substr($strr,0,$ste);
$rff = fopen($dxf."_filelist.txt","w");fputs($rff,preg_replace("`\x1b[13]`","\n",str_replace("\x1b2","\ndir)",$strr)));fputs($rff,"\n\n-- 위는 저쪽에서 가져온 파일목록, 아래는 작업내역입니다.\n\n");
foreach(explode("\x1b",$strr) as $bkk) {if($bkk) {$bbg = substr($bkk,0,1);$bbh = substr($bkk,1);
if($bbg == '2') {if(!file_exists($dxf.$bbh)) {mkdir($dxf.$bbh, 0777);fputs($rff,"생성한 폴더 : {$bbh}\n");
}} else if($bbg == '3') {if(!file_exists($dxf.$bbh)) {fclose(fopen($dxf.$bbh,"w"));fputs($rff,"생성한 파일 : {$bbh}\n");
}} else if($_POST['fkdpl'] == '1') {$bklist[] = $bbh;
} else if($_POST['fkdpl'] == '3') {$bbk = substr($bkk,12);if(!file_exists($dxf.$bbk) || substr($bkk,2,10) > filemtime($dxf.$bbk)) {$bklist[] = $bbk;
}} else if($_POST['fkdpl'] == '2') {$bbk = explode("|",$bbh);if(!file_exists($dxf.$bbk[1]) || $bbk[0] != filesize($dxf.$bbk[1])) {$bklist[] = $bbk[1];
}} else if($_POST['fkdpl'] == '4') {if(!file_exists($dxf.$bbh)) {$bklist[] = $bbh;
}}}}}
fclose($rff);
$bkn++;
if($bklist === 'a') return "완료되었습니다";
else return mkup($bkn);
} /*-*/
if($_POST['bkselect'] == '2' && $_POST['filefrom']) {$bklist = 'a';$result = bkup($_POST['filefrom'],-2);}
else $result = bkup(0,-1);
echo "<h2 style='text-align:center'><input type='button' value='내역보기' onclick='popup(\"?fm=".$dxf."_filelist.txt\", 800, 400)' /> &nbsp; ".$result."</h2>";
exit;
} else if($_GET['bkipt']) { /*--*/
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr'><td style='border-color:#5289CC;border-style:solid;border-width:1px' title='다른 주소의 srboard 게시판을 여기로 가져오기'>게시판 가져오기</td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px 1px 10px 1px'>
<form name='bkfm' method='post' target='exe' action='?' style='margin:0;padding-top:7px'><center>
가져오는 방식 선택 : <select name="bkselect" onchange='bkslct(this)'><option value="1">가져올 폴더 지정하기</option><option value="2">가져올 파일 지정하기</option><option value="3">data/암호폴더 가져오기</option></select><br />
중복파일처리 : <select name="fkdpl"><option value="1">모두 덮어쓰기</option><option value="2">크기 다르면  덮어쓰기</option><option value="3">날짜 다르면 덮어쓰기</option><option value="4">건너뛰기</option></select>
&nbsp; <label>하위폴더 포함 <input type="checkbox" onclick="$$('fksbdr',0).value=(this.checked)? '1':'0'"  class="no" checked="checked" /></lable><input type="hidden" name="fksbdr" value="1" />
<div id='bfrom'>데이타 가져올 경로 : <input type='text' name='datafrom' value='data/암호폴더/게시판아이디' style='width:220px' /></div>
<div id='ffrom' style='display:none'>가져올 파일의 이름 : <input type='text' name='filefrom' value='' style='width:220px' /></div>
<div>데이타 저장할 경로 : <input type='text' name='datato' value='<?php echo $dxr?>' style='width:220px' /></div>
<div id='efrom' style='display:none'>저장할 파일의 이름 : <input type='text' name='fileto' value='' style='width:220px' /></div>
<fieldset style="border:1px solid;padding:10px;width:80%;margin-top:5px"><legend align='center'>가져올 곳의 정보</legend>
주소 : <input type='text' name='outurl' value='http://~~/admin.php' style='width:250px' /><br />
관리자 아이디 : <input type='text' name='outadid' value='' style='width:200px' /><br />
관리자 암 &nbsp; 호 : <input type='password' name='outadpss' value='' style='width:200px' /><br />
암호폴더 이름 : <input type='text' name='pssfolder' value='' style='width:200px' title='가져올 곳 data폴더내부의 암호폴더 이름' /></fieldset><br />
<input type='button' class='button' onclick='bkipt()' value='입력' /> &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' />
</center></form></td></tr></table>
<script type='text/javascript'>
function bkipt() {
var bks = document.bkfm.bkselect.value;
if((bks != '2' || document.bkfm.filefrom.value != '') && (bks == '3' || document.bkfm.datafrom.value != '') && document.bkfm.outurl.value != 'http://~~/admin.php' && document.bkfm.outurl.value != '' && document.bkfm.outadid.value != '' && document.bkfm.outadpss.value != '') {
$$("exe",0).style.display = "block";document.bkfm.submit();
} else alert('빈칸이 있습니다');
}
function bkslct(ths) {
if(ths.value == '2') {
$('ffrom').style.display = 'block';$('efrom').style.display = 'block';
} else {
$('ffrom').style.display = 'none';$('efrom').style.display = 'none';
$$('filefrom',0).value = '';$$('fileto',0).value = '';
}
if(ths.value == '1' || ths.value == '2') {
$('bfrom').style.display = 'block';
var dtfm = $$('datafrom',0).value;
if((!dtfm || dtfm == 'data/암호폴더/게시판아이디') && $$('pssfolder',0).value) $$('datafrom',0).value = 'data/' + $$('pssfolder',0).value + '/';
} else {
$('bfrom').style.display = 'none';$$('datafrom',0).value = '';}
}
top.document.title='게시판 가져오기';
</script>
<iframe name="exe" src="?loading=1" frameborder="0" style="width:100%;height:40px;display:none"></iframe>
</body>
</html>
<?php
exit;
} else if($_GET['CkDataIntegrity']) { /*--*/
$strt = ($_GET['CkDataIntegrity'] - 1)*20;
$send = $strt + 20;
$i = 1;
if($_GET['CkDataIntegrity'] == 1) $ckd = fopen($dxr."_data_integrity_report_.txt","w");
else $ckd = fopen($dxr."_data_integrity_report_.txt","a");
$fs = fopen($ds,"r");
while(!feof($fs)) { /*-*/
$fso = fgets($fs);
if($i > $strt && $i <= $send) {
if(!trim($fso)) {$_GET['CkDataIntegrity'] = -1;break;}
$i++;
$fss = explode("\x1b",$fso);
$sid = trim(substr($fss[0],0,10));
$ffna = (int)substr($fss[0],10,6);
$ffnb = (int)substr($fss[0],16,6);
$ffxd = substr($fss[0],66,1);
$ffnc = 0;
$ckdo = "게시판id:".$sid;
$cnt = 0;
$iserror = '';
$isnerror = 0;
for($ii = 0;$ii <= (int)$fss[6];$ii++) {
if($ii > 0) $fir = $sid."/^".$ii;
else $fir = $sid;
$fn = fopen($dxr.$fir."/no.dat","r");
$fl = fopen($dxr.$fir."/list.dat","r");
while($flo = fgets($fl)) {
$fno = @fgets($fn);
if($cnt == 0 && !$ffnc) $ffnc = (int)substr($fno,0,6);
if(!$fno) {$iserror .= $fir."/no.dat , ";break;}
else if(trim($fno) && (!$ffxd || substr($fno,6,2) != 'aa')) $cnt++;
}
if(!!@fgets($fn)) $iserror .= $fir."/list.dat , ";
fclose($fn);
fclose($fl);
}
if($ffna != $ffnc) {$ckdo .= " | 최근글 번호가 서로 다릅니다. 설정(".$ffna.")과 게시판(".$ffnc.")";$isnerror = 1;}
if($ffnb != $cnt) {$ckdo .= " | 총글갯수가 서로 다릅니다. 설정(".$ffnb.")과 게시판(".$cnt.")";$isnerror = 1;}
if(!!$iserror) $ckdo .= " | ".$iserror." 파일에 에러가 있습니다.";
if(!$isnerror) $ckdo .= " | 에러가 없습니다.";
fputs($ckd,$ckdo."\n");
} else {
$i++;
if($i > $send) break;
}} /*-*/
fclose($fs);
fclose($ckd);
if($_GET['CkDataIntegrity'] == -1) scrhref('?board=1',0,'_data_integrity_report_.txt 를 확인하세요.');
else scrhref('?CkDataIntegrity='.((int)$_GET['CkDataIntegrity'] + 1),0,0);
exit;
} else if($_GET['mkbdlist']) { /*--*/
$mdd = "";
$odr = opendir($dxr);
while($entry = readdir($odr)) { /*-*/
if($entry != "." && $entry != ".." && $entry != "_member_") {
if(is_dir($dxr.$entry) && @filesize($dxr.$entry."/no.dat")) {
 $dr = $dxr.$entry."/";
 $fn = fopen($dr."no.dat","r");
 $fbd = str_pad($entry,10).substr(fgets($fn),0,6);
 for($fnt =1;!feof($fn);$fnt++) {fgets($fn);}
if(@filesize($dr."bno.dat")) {
$fno = fopen($dr."bno.dat","r");
for($dvc = 0;$fnoo = fgets($fno);$dvc++) {$fnto = substr($fnoo,6,6);}
fclose($fno);} else {$dvc = 0;$fnto = 0;}
if(@filesize($dr."notice.dat")) {
$fto = fopen($dr."notice.dat","r");
while($ftoo = fgets($fto)) {$fnco .= "^".(int)substr($ftoo,0,6);}
fclose($fto);} else $fnco = '';
$fbd .= str_pad($fnt + $fnto,6,0,STR_PAD_LEFT)."0000a01011110620111109211101090001001000000000001111\x1b".$entry."\x1bsrb_8\x1b\x1b".$fnco."\x1b00000\x1b".$dvc."\x1b0000100001+0005+0002-0000+0000201001\x1b01100\x1b0+000000000\x1b\n";
$mdd .= $fbd;
$fnt = 0;
$fbd= '';
}}} /*-*/
closedir($odr);
$mblst = fopen(substr($ds,0,-3)."bak","w");
fputs($mblst,$mdd);
fclose($mblst);
scrhref('?board=1',0,0);exit;
} else { /*--*/
if($_GET['board'] || (!$_GET['drct'] && !$_GET['member'] && !$_GET['section'] && !$_GET['statistics'])) { /*-*/
$skinn = array();
$d = opendir("skin");
while($entry = readdir($d)) {
if(is_dir("skin/".$entry) && $entry !='.' && $entry !='..') $skinn[] = $entry;
}
closedir($d);
@sort($skinn);
$skinoption = '';
foreach($skinn as $entry) $skinoption .= "<option value='{$entry}'>{$entry}</option>";
} /*-*/
function seltd($key,$value) {
return ($key == $value)? " selected='selected'":"";
}
function degree($value,$n) { /*-*/
$key = array();
$key[$value] = "selected='selected'";
$lv = ($n > 2)? "level ":"";
$vz = ($n > 2)? "비회원도":"0";
$vt = ($n > 2)? "관리자만":"9";
if($n == 6) $n = 1;
if($n == 5) $degrea = " <option value='0' title='사용 안 함' {$key['0']}>사용 안 함</option>";
else $degrea = ($n == 3)? "":" <option value='0' title='비회원도 허용' {$key['0']}>{$vz}</option>";
for($g = 1;$g <= 8;$g++) {$degrea .= " <option value='{$g}' {$key[$g]}>{$lv}{$g}</option>";}
$degrea .= " <option value='9' title='관리자만' {$key['9']}>{$vt}</option>";
if($n == 1) $degrea = $degrea." <option value='a' title='모두 금지' {$key['a']}>x</option>";
return $degrea;
} /*-*/
include("include/manage.php");
} /*--*/
} /*---*/
?>
<div id='nmemo' style='display:none;'></div>
<?php
} else { /*-4-*/
ssckdxl();
scrhref($index,0,0);exit;
} /*-4-*/
} else { /*-5-*/
?>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<script type='text/javascript'>
var wopen = 1;
var setop = Array('<?php echo $isie?>','<?php echo $bwr?>',<?php echo (int)$srwtpx;?>,'<?php echo $sett[55]?>','<?php echo (($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?php echo (($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','<?php echo $id?>',<?php echo (int)$sett[11];?>,<?php echo $ismobile?>,'');
sessno = <?php echo $sessno?>;
setTimeout('document.getElementsByTagName("form")[0].from.value="<?php echo $index?>";azax("exe.php?&onload=<?php echo $time?>&id=1",9)',100);
</script>
</head>
<body>
<script type="text/javascript" src="include/top.js"></script>
<center style="margin:70px 0 70px 0">
<?php
include("include/login.php");
} /*-5-*/
?>
</center>
<?php
} /*-6-*/
?>