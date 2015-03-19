<?php
$cnt = ($sett[17])? $sett[17]:5;
if($mbr_level == 9) {
$_SERVER['QUERY_STRING'] = str_replace("&","&amp;",$_SERVER['QUERY_STRING']);
?>
<center style="margin:70px 0 70px 0">
<table cellpadding='0px' cellspacing='0px' width='950px'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;background-color:#5289CC'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='height:30px;margin:0;border-style:solid;border-color:#5289CC;border-width:1px 1px 0 1px;background-color:#2A5EB2;width:100%;padding-left:15px'>
<div id='tit_1' class='section_title<?php if($_POST['ffilex'] != 'find' && $_SERVER['QUERY_STRING'] == '') echo "2";?>'><a href="?">전체설정</a></div>
<img src='icon/t.gif' class='section_title_between<?php if($_GET['board'] || ($_POST['ffilex'] != 'find' && $_SERVER['QUERY_STRING'] =='')) echo "2";?>' alt='' /><div class='section_title<?php if($_GET['board']) echo "2";?>'><a href="?board=1">게시판관리</a></div>
<img src='icon/t.gif' class='section_title_between<?php if($_GET['board'] || $_GET['drct'] || $_POST['ffilex'] == 'find') echo "2";?>' alt='' /><div class='section_title<?php if($_GET['drct'] || $_POST['ffilex'] == 'find') echo "2";?>'><a href="?drct=<?php echo $dxr?>">파일관리</a></div>
<img src='icon/t.gif' class='section_title_between<?php if($_GET['drct'] || $_POST['ffilex'] == 'find' || $_GET['member']) echo "2";?>' alt='' /><div class='section_title<?php if($_GET['member']) echo "2";?>'><a href="?member=1">회원관리</a></div>
<img src='icon/t.gif' class='section_title_between<?php if($_GET['member'] || $_GET['section']) echo "2";?>' alt='' /><div class='section_title<?php if($_GET['section']) echo "2";?>'><a href="?section=1">섹션관리</a></div>
<img src='icon/t.gif' class='section_title_between<?php if($_GET['section'] || $_GET['statistics']) echo "2";?>' alt='' /><div class='section_title<?php if($_GET['statistics']) echo "2";?>'><a href="?statistics=1">접속통계</a></div>
<img src='icon/t.gif' class='section_title_between<?php if($_GET['statistics']) echo "2";?>' alt='' /><div class='section_title'><a target="_blank" href="<?php echo $index?>?mbr_info=1">관리자정보</a></div>
</td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#F7F7F7;padding:0px 1px 1px 1px;text-align:center'>
<?php
function rtchecked($val) {
if($val && $val != '0') return "checked='checked'";
else return "";
}
if($_GET['board']) {
if(substr($_GET['board'],0,1) == '/') $boare = 1;else $boare = 0;
?>
<form name="bdstfm" method="post" action="admin.php" style="margin:0">
</form>
<form name="pstfm" method="post" action="admin.php" style="margin:0;height:0"><input type='hidden' name='from' value='?<?php echo preg_replace("`&open=[0-9]+`","",$_SERVER['QUERY_STRING'])?>' /></form>
<?php
if(!$boare) {
?>
<form name="nwbdfm" method="post" action="admin.php" style="margin:0"><input type='hidden' name='mode' value='new' /><input type='hidden' name='from' value='<?php echo $_SERVER['SCRIPT_NAME']?>?<?php echo $_SERVER['QUERY_STRING']?>' />
<table border='0px' cellpadding='3px' cellspacing='1px' class='ttb' style='table-layout:fixed'>
<colgroup><col width='38px' /><col width='55px' /><col width='90px' /><col width='97px' /><col width='210px' /><col width='260px' /><col width='150px' /></colgroup>
<tr style='background-color:#EAEAEA;text-align:center'><td>추가 :</td>
<td><input type='text' name='id' maxlength='10' /></td><td><input type='text' name='nam' style='width:80px' /></td>
<td align='left'><select name='pt'>
<option value='a'>제목형</option>
<option value='b'>본문형</option>
<option value='c'>요약형</option>
<option value='g'>갤러리</option>
<option value='d'>방명록</option>
<option value='e'>블로그</option>
<option value='k'>달력형</option>
</select></td>
<td><input type="button" onclick="idlong()" value="게시판추가" class="button" style="width:160px" /></td>
<td><input type="button" onclick="location.href='?mkbdlist=1'" value="설정복구" class='button' onmouseover='vwtip(this,30)' style='width:50px' /> &nbsp; <input type="button" onclick="location.href='?CkDataIntegrity=1'" value="데이타무결성체크" class='button' onmouseover='vwtip(this,78)' style='width:100px' /></td>
<td><input type="button" onclick="openall()" value="추가설정 모두 열기 / 닫기" onmouseover='vwtip(this,31)' class='button' style="width:140px;" /></td></tr>
</table></form>
<?php
}
?>
<form method="post" name="mkfrm" action="admin.php" style="margin:0" target="exe">
<input type="hidden" name="mkid" value="" />
<input type="hidden" name="mknm" value="" />
<textarea name="mktxt" rows="1" cols="1" style="display:none"></textarea>
</form>
<script type="text/javascript">
//<![CDATA[
var skinoption = "<?php echo $skinoption?>";
var tct = Array();
var flst = Array();
var csff = Array();
var headat = Array();
var midat = Array();
var wtdat = Array();
var tct = Array();
var scx1 = Array();
var s17cnt = <?php echo $cnt?>;
var s15 = '<?php echo $sett[15]?>';
<?php
$scx = "";
$secx = fopen($dxr."section.dat","r");
for($sx = 1;!feof($secx);$sx++) {$sc = explode("\x1b",fgets($secx));$scx[$sx] = array($sc[0],"^".$sc[2]."^");}
fclose($secx);
for($c = 1;$scx[$c][0];$c++) {?>scx1[<?php echo $c?>] = "<?php echo str_replace('"','\"',$scx[$c][1])?>";
<?php }?>
function sctnbd(isd) {
var ele = "<select name='qh[]'>";
<?php for($c = 1;$scx[$c][0];$c++) {$cv = str_pad($c,2,0,STR_PAD_LEFT);?>
ele += "<option value='<?php echo $cv?>' " + selcte('<?php echo $cv?>',57,isd);
ele += (scx1[<?php echo $c?>].indexOf("^" + flst[isd][1] + "^") != -1)?" style='background:#FFDD00'":"";
ele += "><?php echo $scx[$c][0]?></option>";
<?php }?>
ele += "<option value='00' " + selcte('00',57,isd) + ">선택 안 함</option><option value='xx' " + selcte('xx',57,isd) + " title='게시판만 출력'>섹션없음</option></select>";
return ele;
}
<?php
$i = 0;
$iy = 0;
$jaccum = '';
if($boare) {
$stt = substr($_GET['board'],1);
$ett = 0;
} else {
$stt = ($_GET['board'] - 1)*$cnt;
$ett = $stt + $cnt;
}
$fs = fopen($ds,"r");
$fc = fopen($dc,"r");
while(!feof($fs)) {
$bdset = fgets($fs);
$dcfile = fgets($fc);
if(trim($bdset)){
$bid = trim(substr($bdset, 0, 10));
if(($boare && $stt == $bid) || (!$boare && $i >= $stt && $i < $ett)){
$i1 = $i + 1;
$tct = explode("\x1b", $bdset);
$ctct = substr_count($dcfile,"\x1b") - 1;
?>
tct[<?php echo $iy?>] = Array(<?php
foreach($tct as $key => $value) {
$value = trim($value);
if($key == 1) $value = str_replace("&","&amp;",$value);
?>"<?php echo $value?>",<?php }?>
"");
flst[<?php echo $iy?>] = Array('<?php echo $i1?>','<?php echo $bid?>','<?php echo $iy?>','<?php echo $ctct?>','<?php echo $i?>');
csff[<?php echo $iy?>] = Array(<?php
if($csf = @fopen($dxr.$bid."/set.dat","r")) {?>
"<?php echo trim(fgets($csf))?>","<?php echo trim(fgets($csf))?>","<?php echo trim(fgets($csf))?>","<?php echo trim(fgets($csf))?>"<?php fclose($csf);} else {?>"","","",""<?php }?>);
headat[<?php echo $iy?>] = "<?php if($fh = @fopen($dxr.$bid."/head.dat","r")) {while(!feof($fh)) {?><?php echo str_replace("<","&lt;",str_replace("\r","",str_replace("\n","\x7f",str_replace("&","&amp;",str_replace('"','\"',fgets($fh))))));?><?php }fclose($fh);}?>";
midat[<?php echo $iy?>] = "<?php if($fh = @fopen($dxr.$bid."/middle.dat","r")) {while(!feof($fh)) {?><?php echo str_replace("<","&lt;",str_replace("\r","",str_replace("\n","\x7f",str_replace("&","&amp;",str_replace('"','\"',fgets($fh))))));?><?php }fclose($fh);}?>";
wtdat[<?php echo $iy?>] = "<?php if($fh = @fopen($dxr.$bid."/wtform.dat","r")) {while(!feof($fh)) {?><?php echo str_replace("<","&lt;",str_replace("\r","",str_replace("\n","\x7f",str_replace("&","&amp;",str_replace('"','\"',fgets($fh))))));?><?php }fclose($fh);}?>";
<?php
$jsaccum .= "$$('tct1[]',{$iy}).value = tct[{$iy}][2];\n";
$jsaccum .= "$$('csf[]',{$iy}).value = csff[{$iy}][0];\n";
$iy++;
}
$bids .= $bid.",";
$i++;
}}
fclose($fs);
fclose($fc);
?>
var iyy = <?php echo $iy?>;

function rtfadd() {
var fadd = rtfad();
<?php
$mcnt = $i -1;
$pnt = 10;
if(!$boare && $cnt <= $mcnt) {
?>
fadd += "<tr><td colspan='8' style='text-align:center;background-color:#EAEAEA'>";
fadd += "<?php
$mp = (int)($mcnt / $cnt) + 1;
str_replace("\n","",pagen('board',$mp,10,0));
?>";
fadd += "</td></tr>";
<?php
}
?>
fadd += "<tr><td colspan='5'><input type='text' value='<?php echo $sett[17]?>' style='width:40px' maxlength='6' /><input type='button' value='게시판 목록 갯수' onclick=\"mdset17(this)\" class='button' style='height:20px;width:100px' onmouseover='vwtip(this,76)' /> &nbsp; <input type='hidden' id='abcnt' value='0' /><label onmouseover='vwtip(this,77)'>총갯수정리 <input type='checkbox' onclick='chkck(this)' class='no' /></label> &nbsp; ";
<?php if($rid) {?>fadd += "<input type=\"button\" onclick=\"window.open('exe.php?id=<?php echo $rid?>&amp;read=1&amp;rn=1','')\" value=\"rss리더 모두갱신\" class='button' style=\"width:100px;\" />";<?php }?>
fadd += "</td><td colspan='3' align='right'><input type=\"button\" onmouseover=\"vwtip(this,23)\" onclick=\"bdpst(0,1)\" value=\"적 용\" class=\"button\" style=\"width:450px;height:25px;margin-right:20px\" /></td>";
fadd += "</tr></table>";
return fadd;
}
function vwedit(bid,vw) {
if(vw == 2) {
alert("글쓰기에 '추가입력' 항목 추가하는 방법 :\n---------\n추가항목 : <input type='text' name='addfield[]' \/>\n추가항목 : <select name=\'addfield[]\' />...<\/select>\n---------\n유의점 : name=\'addfield[]\'");
bid = bid + "/write.html";
} else {
alert("본문에 '추가입력' 값 표시하는 방법 :\n---------\n추가항목1 : $addfield[1]<br \/>\n추가항목2 : $addfield[2]<br \/>\n---------\n유의점 : $addfield[번호]");
bid = bid + "/view.html";
}
popup('?fm=<?php echo $dxr?>' + bid, 800, 400);
}
function idlong() {
var lcng = document.nwbdfm.id.value;
if(",<?php echo $bids?>".indexOf("," + lcng + ",") != -1) {alert('중복된 ID입니다');return false;}
else if(lcng.replace(/[a-z0-9_]+/ig,"") != "") {alert('게시판ID는 영문,숫자,_ 만 쓸 수 있습니다');return false;}
else {
var abcg = (lcng.length*9 - encodeURIComponent(lcng).length)/8;
var leng = (lcng.length - abcg)*3 + abcg;
if(leng > 10) alert('게시판id가 너무 깁니다. (현재:' + leng + 'byte)');
else document.nwbdfm.submit();
}}
function jsaccum() {
<?php echo $jsaccum?>
<?php
if($_GET['open']) echo "toggle('bdwdth".(--$_GET['open'])."')\n";
if($boare) echo "toggle('bdwdth0')\n";
?>
}
//]]>
</script>
<script type="text/javascript" src="include/manage.js"></script>
<?php
} else if($_GET['drct'] || $_POST['ffilex'] == 'find') {
if(substr($_GET['drct'],0,2) == '//') $_GET['drct'] = $dxr.substr($_GET['drct'],2);
$n = 0;$r = 0;$dr = array();$fn = array();
$drct = ($_GET['drct'])? $_GET['drct']:$dxr;
if($_POST['ffilex'] == 'find') {
$fn = '';
$owner = explode("<>",$_POST['ffiles']);
function filefind($dcr) {
global $fn,$n;
$ddr = fopen($dcr,"r");
while(!feof($ddr)) {
if(strpos(fgets($ddr),$_POST['ffilew']) !== false) {$fn[$n] = $dcr;$n++;break;}
}
fclose($ddr);
}
function dirfind($dcrr) {
global $fn,$n;
$d = dir($dcrr);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
if(is_dir($dcrr."/".$entry)) {
if(($_POST['ffileu'] == '2' || $_POST['ffileu'] == '3') && $entry == $_POST['ffilew']) {$dr[$n] = $dcrr."/".$entry;$n++;}
else dirfind($dcrr."/".$entry);
} else {
if($_POST['ffileu'] == '5') filefind($dcrr."/".$entry);
else if(($_POST['ffileu'] == '1' || $_POST['ffileu'] == '3') && $entry == $_POST['ffilew']) {$fn[$n] = $dcrr."/".$entry;$n++;}
else if($_POST['ffileu'] == '4' && strpos($entry,$_POST['ffilew']) !== false) {$fn[$n] = $dcrr."/".$entry;$n++;}
}}}
$d->close();
}
$ownerc = count($owner);
for($i = 0; $i < $ownerc; $i++) {
if(is_dir($owner[$i])) dirfind($owner[$i]);
else if($_POST['ffileu'] == '5') filefind($owner[$i]);
else if($entry = strpos($owner[$i],$_POST['ffilew']) !== false) {
if($_POST['ffileu'] == '4') {$fn[$n] = $owner[$i];$n++;}
else if(($_POST['ffileu'] == '1' || $_POST['ffileu'] == '3') && substr($owner[$i],$entry) == $_POST['ffilew']) {$fn[$n] = $owner[$i];$n++;}
}}

} else {
function dirsize($dcrr,$size) {
$d = dir($dcrr);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
if(is_dir($dcrr."/".$entry)) $size = dirsize($dcrr."/".$entry,$size);
else $size += @filesize($dcrr."/".$entry);
}
}
$d->close();
return $size;
}
if(substr($drct, -1) != "/") $drct = $drct."/";
if($d = @dir($drct)) {
while($entry = $d->read()) {
if($entry != "." && $entry != ".." && $entry != "") {
$fnfn = $drct.$entry;
if($sett[38][2]) {
if($sett[38][2] == '7' && $time - filemtime($fnfn) > 60) $fnfn = '';
else if($sett[38][2] == '8' && $time - filemtime($fnfn) <= 60) $fnfn = '';
else if($sett[38][2] == '9' && $time - filemtime($fnfn) > 3600) $fnfn = '';
else if($sett[38][2] == 'a' && $time - filemtime($fnfn) <= 3600) $fnfn = '';
else if($sett[38][2] == 'b' && $time - filemtime($fnfn) > 86400) $fnfn = '';
else if($sett[38][2] == 'c' && $time - filemtime($fnfn) <= 86400) $fnfn = '';
else if($sett[38][2] == 'd' && $time - fileatime($fnfn) > 60) $fnfn = '';
else if($sett[38][2] == 'e' && $time - fileatime($fnfn) <= 60) $fnfn = '';
else if($sett[38][2] == 'f' && $time - fileatime($fnfn) > 3600) $fnfn = '';
else if($sett[38][2] == 'g' && $time - fileatime($fnfn) <= 3600) $fnfn = '';
else if($sett[38][2] == 'h' && $time - fileatime($fnfn) > 86400) $fnfn = '';
else if($sett[38][2] == 'i' && $time - fileatime($fnfn) <= 86400) $fnfn = '';
}
if($fnfn) {
if(is_dir($fnfn)) {
 $dr[$r] = $fnfn;
 $r++;
} else {
if($sett[38][2] == '1') {if(filesize($fnfn) == 0) {$fn[$n] = $fnfn;$n++;}}
else if($sett[38][2] == '2') {if(filesize($fnfn) > 0) {$fn[$n] = $fnfn;$n++;}}
else if($sett[38][2] == '3') {if(filesize($fnfn) > 1024) {$fn[$n] = $fnfn;$n++;}}
else if($sett[38][2] == '4') {if(filesize($fnfn) < 1024) {$fn[$n] = $fnfn;$n++;}}
else if($sett[38][2] == '5') {if(filesize($fnfn) > 1048576) {$fn[$n] = $fnfn;$n++;}}
else if($sett[38][2] == '6') {if(filesize($fnfn) < 1048576) {$fn[$n] = $fnfn;$n++;}}
else {$fn[$n] = $fnfn;$n++;}
}}}}
$d->close();
$drctl = strlen($drct);
} else {$drct = substr($drct,0,-1);$end = strrpos($drct,'/');if($end === false) $drct ='';else $drct = substr($drct,0,$end);scrhref('?drct='.$drct,'','존재하지 않는 경로입니다.');exit;}
function basenm($name) {
global $drctl;
return substr($name,$drctl);
}
}
?>
<div id='filelst'></div>
<form name='ffile' action="admin.php" method="post" style="margin:0">
<input type='hidden' name='ffiles' />
<input type='hidden' name='ffilew' />
<input type='hidden' name='ffilex' />
<input type='hidden' name='ffilet' value='<?php echo fchr($drct)?>' />
<input type='hidden' name='ffileu' value='1' />
</form>
<form name="fileform" enctype="multipart/form-data" action="admin.php" method="post" style="margin:0;background-color:#F7F7F7">
<label title='폴더내부 용량 계산으로 출력이 지연될 수 있습니다.'>폴더 내부크기 출력 <input type='checkbox'  onclick="this.parentNode.nextSibling.value=(this.checked)? '1':'0';submit();" <?php if($sett[38][0]) echo "checked='cheked'";?> class='no' style='padding-bottom:5px' /></label><input type='hidden' name='dnsize' value='<?php echo $sett[38][0]?>' />
<label>역순으로 정렬 <input type='checkbox'  onclick="this.parentNode.nextSibling.value=(this.checked)? '1':'0';submit();" <?php if($sett[38][1]) echo "checked='cheked'";?> class='no' style='padding-bottom:5px' /></label><input type='hidden' name='dnsort' value='<?php echo $sett[38][1]?>' />
필터 <select name='dnfilter' onchange='submit();' style='width:95px;margin-right:10px'><option value='0' <?php if($sett[38][2] == '0') echo "selected='selected'";?>>필터 없음</option><option value='1' <?php if($sett[38][2] == '1') echo "selected='selected'";?>>0 == 파일크기</option><option value='2' <?php if($sett[38][2] == '2') echo "selected='selected'";?>>0 < 파일크기</option><option value='3' <?php if($sett[38][2] == '3') echo "selected='selected'";?>>1kb < 파일크기</option><option value='4' <?php if($sett[38][2] == '4') echo "selected='selected'";?>>1kb > 파일크기</option><option value='5' <?php if($sett[38][2] == '5') echo "selected='selected'";?>>1mb < 파일크기</option><option value='6' <?php if($sett[38][2] == '6') echo "selected='selected'";?>>1mb > 파일크기</option><option value='7' <?php if($sett[38][2] == '7') echo "selected='selected'";?>>1분 안에 수정된</option><option value='8' <?php if($sett[38][2] == '8') echo "selected='selected'";?>>1분 안에 수정 안 된</option><option value='9' <?php if($sett[38][2] == '9') echo "selected='selected'";?>>1시간 안에 수정된</option><option value='a' <?php if($sett[38][2] == 'a') echo "selected='selected'";?>>1시간 안에 수정 안 된</option><option value='b' <?php if($sett[38][2] == 'b') echo "selected='selected'";?>>1일 안에 수정된</option><option value='c' <?php if($sett[38][2] == 'c') echo "selected='selected'";?>>1일 안에 수정 안 된</option><option value='d' <?php if($sett[38][2] == 'd') echo "selected='selected'";?>>1분 안에 접속된</option><option value='e' <?php if($sett[38][2] == 'e') echo "selected='selected'";?>>1분 안에 접속 안 된</option><option value='f' <?php if($sett[38][2] == 'f') echo "selected='selected'";?>>1시간 안에 접속된</option><option value='g' <?php if($sett[38][2] == 'g') echo "selected='selected'";?>>1시간 안에 접속 안 된</option><option value='h' <?php if($sett[38][2] == 'h') echo "selected='selected'";?>>1일 안에 접속된</option><option value='i' <?php if($sett[38][2] == 'i') echo "selected='selected'";?>>1일 안에 접속 안 된</option></select>
파일업로드 : <input type='file' name='upfile' style='width:200px;height:20px;margin-right:10px' onchange='if(this.value) submit()' />
<input type='button' class='button' style='width:80px' value='URL 파일저장' onclick='submit()' /> <input type='text' name='linkfile' style='width:200px;height:20px' value='http://' />
<input type='hidden' name='uploadpath' value='<?php echo $drct?>' /></form>
<script type="text/javascript">
//<![CDATA[
<?php if($_GET['drct']) {?>
var fdrct = Array("<?php echo $drct?>","<?php echo fchr($drct)?>");
<?php } else echo "var fdrct = Array('','');";?>

var flist = Array(""<?php
function perms($perms) {
return substr(sprintf('%o', fileperms($perms)), -4);
}
if(substr($drct, -2) == './') {if($drct == './') $drup = '../';else $drup = '../'.$drct;}
else {
$drup = preg_replace("`(.+)/[^/]+/`","$1",$drct)."/";
if($drup == $drct.'/' || $drup == '/') $drup = './';
}
$n = 2;
$drcnt = count($dr);
if($drcnt > 0) {
if($sett[38][1] == 0) sort($dr);else rsort($dr);
for($i = 0;$i < $drcnt; $i++) {
if($sett[38][0] == 1) {
 $drsize = dirsize($dr[$i],0);
 $fnszall += $drsize;
 if($drsize > 1048576) $drsize = sprintf("%.2f", ($drsize / 1048576))." mb";
 else if($drsize > 1024) $drsize = sprintf("%.2f", ($drsize / 1024))." k";
 }
 if($_POST['ffilex'] == 'find') $bdf = $dr[$i];
 else $bdf = basenm($dr[$i]);
 if(($fcf = fchr($bdf)) == $bdf) $fcf = '';
 echo ",Array(1,".($n % 2).",'{$bdf}','{$fcf}','{$drsize}','".fileowner($dr[$i])."','".perms($dr[$i])."','".date("y/m/d_H:i:s",filemtime($dr[$i]))."')";
 $n++;
}
}
$fncnt= count($fn);
if($fncnt > 0) {
if($sett[38][1] == 0) sort($fn);else rsort($fn);
for($ii = 0;$ii < $fncnt; $ii++) {
 $fnsize = filesize($fn[$ii]);
 $fnszall += $fnsize;
 if($fnsize > 1048576) {$fnsize = sprintf("%.2f", ($fnsize / 1048576))." mb";echo ",Array(2,";}
 else {if($fnsize > 1024) $fnsize = sprintf("%.2f", ($fnsize / 1024))." k";echo ",Array(3,";}
 if($_POST['ffilex'] == 'find') $bdf = $fn[$ii];
 else $bdf = basenm($fn[$ii]);
 if(($fcf = fchr($bdf)) == $bdf) $fcf = '';
 echo ($n % 2).",'{$bdf}','{$fcf}','{$fnsize}','".fileowner($fn[$ii])."','','".date("y/m/d_H:i:s",filemtime($fn[$ii]))."')";
 $n++;
}
}
 if($fnszall > 1048576) $fnszall = sprintf("%.2f", ($fnszall / 1048576))." m";
 else if($fnszall > 1024) $fnszall = sprintf("%.2f", ($fnszall / 1024))." k";
?>);

function flout() {
var fadd = "<table border='0px' cellpadding='5px' cellspacing='1px' class='ttb'>";
fadd += "<colgroup><col width='*' /><col width='60px' /><col width='50px' /><col width='35px' /><col width='35px' /><col width='110px' /><col width='100px' /></colgroup>";
fadd += "<tr><td style='text-align:left'><input type='text' style='width:300px' value='<?php echo fchr($drct)?>' /><input type='submit' onclick=\"location.href='?drct='+this.previousSibling.value\" value='경로이동' class='button' style='width:80px' title='아래 출력되는 폴더/파일의 경로이동' /></td>";
fadd += "<td colspan='6'><input type='text' id='newpath' style='width:240px' value='<?php echo fchr($drct)?>' /><input type='button' onclick=\"location.href='?delem='+$('newpath').value\" value='파일생성' class='button' style='width:65px' title='앞의 경로에 새로운 빈파일생성' /> <input type='button' onclick=\"location.href='?mkdir='+$('newpath').value\" value='폴더생성' class='button' style='width:65px' title='앞의 경로에 새로운 폴더생성' /></td></tr>";
fadd += "<tr style='background-color:#EAEAEA'><td>폴더는 경로이동 /파일은 다운로드</td><td>파일크기</td><td title='파일소유자'>소유자</td><td title='폴더는 권한 / 파일은 내용편집'>편집</td><td title='파일내용 검색교체'>검색</td><td title='파일수정일, 클릭하면 링크'>수정일 / 링크</td><td>삭제</td></tr>";
fadd += "<tr style='background-color:#F1F1F1'><td colspan='7' style='text-align:left'> <a href='?drct=<?php echo fchr($drup)?>'><font color='#0000CD'><?php echo $drup?></font></a></td></tr>";
var flength = flist.length;
for(var i=1;i < flength;i++) {
if(flist[i][3] == '') flist[i][3] = flist[i][2];
if(flist[i][1] == 1) fadd += "<tr style='background-color:#F1F1F1' onmouseover='this.style.background=\"#FFF29B\"' onmouseout='this.style.background=\"#F1F1F1\"'>";
else fadd += "<tr style='background-color:#FFFFFF' onmouseover='this.style.background=\"#FFF29B\"' onmouseout='this.style.background=\"#FFFFFF\"'>";
fadd += "<td style='text-align:left'><input type='checkbox' name='fiile' value='" + fdrct[0] + flist[i][2] + "' class='no' /> ";
if(flist[i][0] == 1) fadd += "<a href='?drct=" + fdrct[1] + flist[i][3] + "'><font color='#0000CD'>";
else fadd += "<a target='_blank' href='?down=" + fdrct[1] + flist[i][3] + "'><font color='red'>";
fadd += fdrct[0] + flist[i][2] + "</font></a></td><td>" + flist[i][4] + "</td><td>(" + flist[i][5] + ")</td>";
if(flist[i][0] == 1) fadd += "<td class='f7'>" + flist[i][6] + "</td><td><a onclick=\"popup('admin.php?fr=" + fdrct[1] + flist[i][3] + "/', 550, 250)\" href='#none'>검색</a>";
else {
if(flist[i][0] == 3) fadd += "<td><a onclick=\"popup('admin.php?fm=" + fdrct[1] + flist[i][3] + "', 800, 400)\" href='#none'>편집</a>";
else fadd += "<td>";
fadd += "</td><td><a onclick=\"popup('admin.php?fr=" + fdrct[1] + flist[i][3] + "', 550, 250)\" href='#none'>검색</a>";
}
fadd += "</td><td class='f8'><a target='_blank' href='" + fdrct[0] + flist[i][2] + "'>" + flist[i][7] + "</a></td>";
if(flist[i][0] == 1) fadd += "<td><a href='#none' onclick=\"if(confirm('폴더를 삭제하시겠습니까'))location.href='?deled=" + fdrct[1] + flist[i][3] + "';\"><font color='red'>폴더삭제</font></a></td></tr>";
else fadd += "<td><a href='?delef=" + fdrct[1] + flist[i][3] + "'>삭제</a> / <a href='?delem=" + fdrct[1] + flist[i][3] + "'>비움</a></td></tr>";
}
fadd += "<tr style='background-color:#EAEAEA'><td><div style='text-align:left;float:left;'><input type='button' value='선택' class='button' onclick='slect()' /> &nbsp; <input type='button' value='선택목록저장' title='선택한 파일목록을 list.txt로 저장합니다' class='button' onclick=\"sllect('list2txt','')\" style='width:80px' /> &nbsp; <input type='button' value='list.txt 검색교체' title='list.txt의 목록에서 검색교체합니다' class='button' onclick=\"popup('admin.php?fr=list.txt', 550, 250)\" style='width:90px' /></div><div style='text-align:right;float:right' id='copi'>폴더 : <?php echo $drcnt?> 개, 파일 : <?php echo $fncnt?> 개, 총크기 : <?php echo $fnszall?></div>";
fadd += "<form method='get' action='' onsubmit='sllect();return false' style='text-align:right;float:right;display:none;' id='copp'><span>경로</span> : <input type='text' id='copd' style='width:260px;background-color:#EAEAEA' value='<?php echo $drct?>' /><input type='submit' onclick=\"sllect(this.previousSibling.value, this.value)\" id='copc' value='' class='button' style='width:80px' /></form></td>";
fadd += "<td colspan='6' style='clear:both;text-align:center'><input type='button' onclick=\"fcopy('copy')\" value='copy' class='button' /> <input type='button' onclick=\"fcopy('rename')\" value='rename' class='button' style='width:50px' /> <input type='button' onclick=\"sllect('0777','')\" value='0777' class='button' style='width:30px' /><?php if(strpos(ini_get('disable_functions'),"system") === false){?> <input type='button' onclick=\"sllect('compressf','')\" value='압축-f' class='button' style='width:38px' title='files폴더 빼고 압축' /> <input type='button' onclick=\"sllect('compress','')\" value='압축' class='button' style='width:30px' /> <input type='button' onclick=\"fcopy('decompress')\" value='압축해제' class='button' style='width:50px' /><?php }?> <input type='button' onclick=\"fcopy('find')\" value='검색' class='button' style='width:30px' /> ";
fadd += "<input type='button' onclick=\"if(confirm('선택 파일/폴더를 삭제하시겠습니까',''))sllect('delete','')\" value='삭제' class='button' /> <input type='button' onclick=\"sllect('clear','')\" value='비움' class='button' /></td></tr>";
fadd += "<tr style='clear:both'><td colspan='4'></td></tr></table>";
$('filelst').innerHTML = fadd;
}

function slect() {
var tog = document.getElementsByName('fiile');
for(i = 0; i < tog.length; i++){
if(tog[i].checked == true) tog[i].checked = false;
else tog[i].checked = true;
}
}

function sllect(xx,yy) {
if(!xx) {
xx = $('copd').value;
yy = $('copc').value;
}
if(xx) {
var tog = document.getElementsByName('fiile');
var got = '';
for(i = 0; i < tog.length; i++){
if(tog[i].checked == true) got += "<>" + tog[i].value;
}
document.ffile.ffiles.value = got.substr(2);
document.ffile.ffilew.value = xx;
document.ffile.ffilex.value = yy;
document.ffile.submit();
}
}
function fcopy(xx) {
if($('copp').style.display == 'none') {
$('copi').style.display = 'none';
$('copp').style.display = 'block';
$('copc').value = xx;
if(xx == 'copy') $('copd').title = "\n < 선택한 것이 여럿 >이거나, < 하나의 폴더 >이고, \n\n < 존재하지 않는 경로 >를 입력한 경우 \n\n 그 경로의 폴더가 생성되어서 \n\n 선택한 폴더가 하나인 경우 하위경로가, \n\n 여럿인 경우엔 선택한 것들이 그 안에 복사됩니다. \n ";
else if(xx == 'rename') $('copd').title = "\n < 선택한 것이 여럿 >이고, \n\n < 존재하지 않는 경로 >를 입력한 경우 \n\n 그 경로의 폴더가 생성되어서 \n\n 그 안으로 선택한 것들이 이동됩니다. \n";
$('copp').firstChild.innerHTML = (xx == 'find')? '<select onchange="document.ffile.ffileu.value=this.options[this.selectedIndex].value;"><option value="1">파일이름 검색</option><option value="2">폴더이름 검색</option><option value="3">파일/폴더 이름검색</option><option value="4">검색어 포함한 파일이름</option><option value="5">파일내용 검색</option></select>&nbsp; 검색어':'경로';
if(xx == 'find') {$('copd').value = "<?php echo ($_POST['ffilex'] == 'find')? $_POST['ffilew']:'';?>";$('copd').style.width = '150px';}
} else {
$('copi').style.display = 'block';
$('copp').style.display = 'none';
$('copc').value = '';
$('copd').title = '';
$('copd').value = '<?php echo $drct?>';
$('copd').style.width = '260px';
}
}
document.title = "파일관리";
setTimeout("flout()",100);
//]]>
</script>
<?php
} else if($_GET['member']) {
if(!$_GET['orderby']) $_GET['orderby'] = 1;
?>
<div id='admtip' style='width:920px;margin:4px 0 5px 0'>회원관리</div>
<div style='text-align:center'>
<input type='button' value="전체쪽지발송" onclick="send('memo', 'all','all')" class='button' style='width:100px' />
 &nbsp; <input type='button' value="전체메일발송" onclick="send('mail', 'all', '')" class='button' style='width:100px' />
 &nbsp; <input type='button' value="가입환영쪽지편집" onclick='popup("admin.php?fm=<?php echo $dxr?>welcome", 800, 400)' class='button' style='width:100px' />
</div><div align='right'><form name='smember' method='get' action='?'><input type='hidden' name='member' value='1' /><input type='hidden' name='orderby' value='1' /><select name='search'><option value='id'>아이디</option><option value='nick'>닉네임</option><option value='no'>회원번호</option><option value='level'>회원레벨</option><option value='email'>이메일</option><option value='address'>주소</option><option value='registdate'>가입일자</option><option value='birthdate'>생년월일</option><option value='birthmonth'>태어난 달</option></select><input type='text' name='keyword' style='width:80px' /><input type='submit' value='회원검색' class='button' style='width:50px' />
 <select id='orderby' onchange="location.replace(('?member=1&amp;orderby=' + this.options[this.selectedIndex].value).replace(/amp;/,''))"><option value='1' <?php echo seltd('11',$_GET['orderby'])?>>가입일 높은순</option><option value='21' <?php echo seltd('21',$_GET['orderby'])?>>최근 방문일 높은순</option><option value='31' <?php echo seltd('31',$_GET['orderby'])?>>회원아이디 높은순</option><option value='41' <?php echo seltd('41',$_GET['orderby'])?>>회원레벨 높은순</option><option value='51' <?php echo seltd('51',$_GET['orderby'])?>>쓴글수 높은순</option><option value='61' <?php echo seltd('61',$_GET['orderby'])?>>쓴덧글수 높은순</option><option value='71' <?php echo seltd('71',$_GET['orderby'])?>>출석수 높은순</option><option value='81' <?php echo seltd('81',$_GET['orderby'])?>>추가점 높은순</option><option value='91' <?php echo seltd('91',$_GET['orderby'])?>>포인트 높은순</option><option value='11' <?php echo seltd('11',$_GET['orderby'])?>>가입일 낮은순</option><option value='22' <?php echo seltd('22',$_GET['orderby'])?>>최근 방문일 낮은순</option><option value='32' <?php echo seltd('32',$_GET['orderby'])?>>회원아이디 낮은순</option><option value='42' <?php echo seltd('42',$_GET['orderby'])?>>회원레벨 낮은순</option><option value='52' <?php echo seltd('52',$_GET['orderby'])?>>쓴글수 낮은순</option><option value='62' <?php echo seltd('62',$_GET['orderby'])?>>쓴덧글수 낮은순</option><option value='72' <?php echo seltd('72',$_GET['orderby'])?>>출석수 낮은순</option><option value='82' <?php echo seltd('82',$_GET['orderby'])?>>추가점 낮은순</option><option value='92' <?php echo seltd('92',$_GET['orderby'])?>>포인트 낮은순</option></select></form></div>
<table border='0px' cellpadding='2px' cellspacing='1px' class='ttb'>
<colgroup><col width='43px' /><col width='38px' /><col width='100px' /><col width='70px' /><col width='148px' /><col width='39px' /><col width='39px' /><col width='39px' /><col width='56px' /><col width='60px' /><col width='70px' /><col width='50px' /><col width='42px' /><col width='55px' /><col width='42px' /></colgroup>
<tr style='background-color:#EAEAEA'><td onmouseover='vwtip(this,0)'>no</td><td onmouseover='vwtip(this,1)'>성별</td><td>id / 쪽지</td>
<td>닉네임</td><td>메일주소</td><td>쓴글</td><td>덧글</td><td>출석</td><td>추가</td><td>포인트</td><td>가입일/로그</td><td>레벨</td><td  onmouseover='vwtip(this,2)'>적용</td><td onmouseover='vwtip(this,3)'>암호변경</td><td onmouseover='vwtip(this,4)'>삭제</td></tr>
<?php
$cnt = ($_GET['cnt'])? $_GET['cnt']:30;
$stt = ($_GET['member'] - 1)*$cnt;
$ett = $stt + $cnt;
$i = 1;
$attd = array();
$ordr = array();
$mlst = array();
if($fa = @fopen($dxr."attend.dat","r")){
while(!feof($fa)) {
$fao = explode("\x1b",fgets($fa));
if($fao[1]) for($a = count($fao) -2;$a > 0;$a--) if(!$attd[$fao[$a]]) $attd[$fao[$a]] = substr($fao[0],0,4)."-".substr($fao[0],4,2)."-".substr($fao[0],6,2);
}
fclose($fa);
}
if($_GET['orderby'] != 1) {
$i = 1;
$fim = fopen($dim,"r");
while($xxx = fgets($fim)) {
if(strlen($xxx) > 10) {
$xxn = substr($xxx,0,5);
if($_GET['orderby'][0] == 1) $ordr[$xxn] = $i;
else if($_GET['orderby'][0] == 2) {if($attd[(int)$xxn]) $ordr[$xxn] = $attd[(int)$xxn];}
else if($_GET['orderby'][0] == 3) $ordr[$xxn] = substr($xxx,5,15);
else if($_GET['orderby'][0] == 4) {
$okok = explode("\x1b", $xxx);
$ordr[$xxn] = $okok[2].(99999-$xxn);
} else if($_GET['orderby'][0] >= 5) {
if($jn = @fopen($dxr.'_member_/member_'.(int)$xxn,'r')) {
$jno = explode("\x1b",fgets($jn));fclose($jn);
if($_GET['orderby'][0] == 5) $ordr[$xxn] = $jno[0];
else if($_GET['orderby'][0] == 6) $ordr[$xxn] = $jno[1];
else if($_GET['orderby'][0] == 7) $ordr[$xxn] = $jno[2];
else if($_GET['orderby'][0] == 8) $ordr[$xxn] = $jno[3];
else if($_GET['orderby'][0] == 9) $ordr[$xxn] = (int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9];
}}
$i++;
}}
fclose($fim);
if($_GET['orderby'][1] == 1) arsort($ordr);
else asort($ordr);
if(count($ordr) >= $cnt) $ordr = array_slice($ordr,$stt,$cnt);
$i = $stt +1;
foreach($ordr as $key => $value) {
$ordr[$key] = $i;
$i++;
}
}
function prevw($vk) {
global $sett;
$val = '';
if($sett[20][2] && substr($vk[6],10)) $val .= ' / 생년월일 '.substr($vk[6],10,4).'. '.substr($vk[6],14,2).'. '.substr($vk[6],16,2);
if($sett[20][1] && $vk[5]) $val .= ' /  '.$vk[5];
if($sett[20][0] && $vk[4]) $val .= ' / '.$vk[4];
if(substr($sett[20],4) && $vk[7]) $val .= ' / '.substr($sett[20],4).' '.$vk[7];
return $val;
}
$i = 1;
$fim = fopen($dim,"r");
while($xxx = fgets($fim)) {
if(strlen($xxx) > 10) {
if($i <= $ett) {
if($_GET['orderby'] == 1) {
if($_GET['search'] || $i > $stt) $yyy = explode("\x1b", $xxx);
$ml = 1;
if($_GET['search'] && $_GET['keyword']) {
if($_GET['search'] == 'id') {if(strpos($yyy[0],$_GET['keyword']) === false) $ml = 0;
} else if($_GET['search'] == 'nick') {if(strpos($yyy[1],$_GET['keyword']) === false) $ml = 0;
} else if($_GET['search'] == 'no') {if((int)substr($xxx,0,5) != $_GET['keyword']) $ml = 0;
} else if($_GET['search'] == 'level') {if($yyy[2] != $_GET['keyword']) $ml = 0;
} else if($_GET['search'] == 'email') {if(strpos($yyy[3],$_GET['keyword']) === false) $ml = 0;
} else if($_GET['search'] == 'address') {if(strpos($yyy[4],$_GET['keyword']) === false) $ml = 0;
} else if($_GET['search'] == 'registdate') {if(($xxx = (int)substr($yyy[6],0,10)) == 0 || date("Y",$xxx) != substr($_GET['keyword'],0,4) || (strlen($_GET['keyword']) >= 6 && date("m",$xxx) != substr($_GET['keyword'],4,2))) $ml = 0;
} else if($_GET['search'] == 'birthdate') {if(strlen($yyy[6]) <= 10 || substr($yyy[6],10,4) != substr($_GET['keyword'],0,4) || (strlen($_GET['keyword']) >= 6 && substr($yyy[6],14,2) != substr($_GET['keyword'],4,2))) $ml = 0;
} else if($_GET['search'] == 'birthmonth') {if(strlen($yyy[6]) <= 14 || substr($yyy[6],14,2) != substr($_GET['keyword'],0,2)) $ml = 0;
}}
if($ml) {if($i > $stt) $mlst[$i] = $yyy;$i++;}
} else {$i++;$ett++;$xxn = substr($xxx,0,5);if($ordr[$xxn]) $mlst[$ordr[$xxn]] = explode("\x1b", $xxx);}
} else if($_GET['search'] && $_GET['keyword']) break;else $i++;
}}
fclose($fim);
$mcnt = $i -2;
ksort($mlst);
$i = 1;
foreach($mlst as $okok) {
$odate = date("Y.m.d", substr($okok[6],0,10));
$okid = trim(substr($okok[0],5,15));
$okok[0] = (int)substr($okok[0], 0, 5);if($okok[1]) {
if($jn = @fopen($dxr."_member_/member_".$okok[0],"r")) {
$jno = explode("\x1b",fgets($jn));fclose($jn);
if($okok[9] == 'm') $okok[9] = '男';
else if($okok[9]=='f') $okok[9] = '女';
} else {
$jno = "0\x1b0\x1b1\x1b100\x1b\x1b1\x1b0\x1b0\x1b0\x1b0\x1b0\x1b0\x1b\x1b\x1b";
fopen($dxr."_member_/member_".$okok[0],"w");
fgets($jn,$jno);fclose($jn);
$okok[9] = 'x';
}
if($okok[10]) $okok[10] = "onclick='nwopn(\"".$okok[10]."\")' title='".$okok[10]."' style='width:20px'";
else $okok[10] = "title='empty' style='width:20px;background-color:#FFFFFF'";
?>
<tr onmouseover='this.style.background="#FFF29B";vwtip(this,"x")' onmouseout='this.style.background=""' title="  최근 방문 <?php echo $attd[$okok[0]]?><?php echo prevw($okok)?>  "><td class='cbox'><a target='_blank' href='<?php echo $index?>?mbr_info=1&amp;mbr=<?php echo $okok[0]?>'><?php echo $okok[0]?></a></td>
<td><input type='button' class='button' value='<?php echo $okok[9]?>' <?php echo $okok[10]?> /></td><td align='left'><?php echo (($sett[90])? "<img src='icon/pointlevel/{$okok[16]}.gif' alt='{$okok[16]}' /> ":"")?><input type='hidden' id='no_<?php echo $i?>' value='<?php echo $okok[0]?>' /><input type='hidden' id='usr_<?php echo $i?>' value='<?php echo $okid?>' /><a href='#none' onclick="send('memo', '<?php echo $okok[0]?>','<?php echo urlencode($okok[1])?>')" title='쪽지 보내기'><?php echo $okid?></a></td>
<td><input type='text' id='nick_<?php echo $i?>' value='<?php echo $okok[1]?>' style='width:65px' /></td><td><input type='text' id='email_<?php echo $i?>' value='<?php echo $okok[3]?>' style='width:100px' /><input type='button' onclick="send('mail', '<?php echo $okok[0]?>','<?php echo urlencode($okok[1])?>','<?php echo $mbr_no?>')" value='발송' class='button' /></td>
<td style='font-size:11px'><?php echo $jno[0]?></td><td style='font-size:11px'><?php echo $jno[1]?></td><td style='font-size:11px'><?php echo $jno[2]?></td><td style='font-size:11px'><input type='button' value='<?php echo $jno[3]?>' onclick="popup('admin.php?pview=<?php echo $okok[0]?>',400,300);" style='width:50px' class='button' /></td><td style='font-size:11px'><?php echo (int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9];?></td><td><input type='button' class='button' onclick="nwopn('member.php?mno=<?php echo $okok[0]?>')" value='<?php echo $odate?>' style='width:60px' /></td><td><select id='level_<?php echo $i?>'>
<?php
for($c = 0;$c < 9; $c++){
if($c == $okok[2]) $ic = " selected='selected'";
else $ic = "";
?>
<option value='<?php echo $c?>'<?php echo $ic?>><?php echo $c?></option>
<?php
}
if($okok[2] == 9) $iic = " selected='selected'";
else $iic = "";
?>
<option value='9'<?php echo $iic?>>adm</option></select></td>
<td><input type='button' onclick="change('<?php echo $i?>','')" value='적용' class='button' /></td><td style='text-align:center'><input type='button' onclick="if($('newpswd').innerHTML != '') newpd();else {if(confirm('<?php echo $okid?>님의 비밀번호를 재설정합니까'))newpd('<?php echo $okid?>','<?php echo $i?>')}" value='암호변경' class='button' style='width:50px' /></td><td style='text-align:center'><input type='button' onclick="if(confirm('<?php echo $okid?>님의 회원정보를 삭제하시겠습니까'))change('<?php echo $i?>','delete')" value='삭제' class='button' /></td></tr>
<?php
}
$i++;
}
if($cnt < $mcnt){
?>
<tr><td colspan='15' style='text-align:center;background-color:#EAEAEA'>
<?php
$mp = (int)($mcnt / $cnt) + 1;
pagen('member',$mp,30,0);
?>
</td></tr>
<?php
}
?>
<tr><td colspan='15' style='text-align:left;border-top:2px solid #D7D7D7;padding-left:20px '>
<?php
$mblevel = "<option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option>";
if(!$_GET['search']) echo '전체회원수 :: '.($mcnt +1).' &nbsp; &nbsp; &nbsp; ';?><input type='button' value='전체회원 포인트 재계산' onclick='location.replace("?allpntcal=1")' class='button' style='width:130px' />
<form action="admin.php" method="post" style="float:right;margin:0"><select name='mblvby[]'><option value='1'>포인트</option><option value='2'>쓴글수</option><option value='3'>덧글수</option><option value='4'>출석수</option></select> <input type='text' name='mblvby[]' value='' /> 이상이면, 최소한 <select name='mblvby[]'><?php echo degree(0,3)?></select> <input type='button' value='회원레벨 일괄조정' onclick='if($$("mblvby[]",1).value != "") submit();else alert("값이 없습니다");' class='button' style='width:100px' /></form><div style='clear:both'></div>
<form action="admin.php" method="post" style="margin:0"><input type='hidden' name='from' value='<?php echo $_SERVER['QUERY_STRING']?>' />
<fieldset style='padding:20px;line-height:22px'><legend>회원관리설정</legend>
신규회원가입: <select name='xj'><option value='0' <?php echo seltd('0',$sett[61])?>>허용</option><option value='1' <?php echo seltd('1',$sett[61])?>>중단</option></select>
&nbsp;중복 로그인: <select name='xw'><option value='0' <?php echo seltd('0',$sett[74])?>>불허</option><option value='1' <?php echo seltd('1',$sett[74])?>>허용</option></select>
<br />로그인 암호키 전달: <select name='wi'><option value='0' <?php echo seltd('0',$sett[34])?>>ajax로</option><option value='1' <?php echo seltd('1',$sett[34])?>>직접 출력</option></select>
<br />출석 포인트 배점 : <input type='text' name='mpoint[]' style='width:35px' value='<?php echo $sett[18]?>' />
<br />신규덧글알림: <label><input type='radio' name='wu' value='1' style='width:13px' <?php if($sett[83]) echo "checked='checked'";?> /> 사용함</label> &nbsp; <label><input type='radio' name='wu' value='0' style='width:13px' <?php if(!$sett[83]) echo "checked='checked'";?> /> 사용 안 함</label>
<br /><span onmouseover="vwtip(this,7)">쪽지사용권한</span>: <select name='xf'><?php echo degree($sett[57],4)?></select>부터
<br />쪽지도착 알림방법: <select name='mpoint[]'><option value='1' <?php echo seltd('1',$sett[52])?>>안 알림</option><option value='2' <?php echo seltd('2',$sett[52])?>>문구만</option><option value='3' <?php echo seltd('3',$sett[52])?>>문구+소리</option><option value='4' <?php echo seltd('4',$sett[52])?>>팝업+소리</option><option value='5' <?php echo seltd('5',$sett[52])?>>팝업+문구</option><option value='6' <?php echo seltd('6',$sett[52])?>>팝업+문구+소리</option><option value='7' <?php echo seltd('7',$sett[52])?>>팝업만</option></select>
<br /><span onmouseover="vwtip(this,5)">쪽지저장파일 처리</span>: 시간이 <select name='ymm[]'><option value='0' <?php echo seltd('0',$sett[5][0])?>>0초</option><option value='1' <?php echo seltd('1',$sett[5][0])?>>1개월</option><option value='2' <?php echo seltd('2',$sett[5][0])?>>3개월</option><option value='3' <?php echo seltd('3',$sett[5][0])?>>6개월</option><option value='4' <?php echo seltd('4',$sett[5][0])?>>1년</option><option value='5' <?php echo seltd('5',$sett[5][0])?>>2년</option></select> 지난 경우 &nbsp;그리고 &nbsp;파일크기가 <select name='ymm[]'><option value='0' <?php echo seltd('0',$sett[5][1])?>>0mb</option><option value='1' <?php echo seltd('1',$sett[5][1])?>>1mb</option><option value='2' <?php echo seltd('2',$sett[5][1])?>>3mb</option><option value='3' <?php echo seltd('3',$sett[5][1])?>>6mb</option><option value='4' <?php echo seltd('4',$sett[5][1])?>>12mb</option></select> 이상인 경우 &nbsp; 처리방법 : <select name='ymm[]'><option value='0' <?php echo seltd('0',$sett[5][2])?>>그냥 둠</option><option value='1' <?php echo seltd('1',$sett[5][2])?>>기록 삭제</option><option value='2' <?php echo seltd('2',$sett[5][2])?>>memo3.txt에 저장</option></select>
<br /><span onmouseover="vwtip(this,6)">미확인 쪽지 처리</span>: 시간이 <select name='ymm[]'><option value='1' <?php echo seltd('1',$sett[5][3])?>>1개월</option><option value='2' <?php echo seltd('2',$sett[5][3])?>>3개월</option><option value='3' <?php echo seltd('3',$sett[5][3])?>>6개월</option><option value='4' <?php echo seltd('4',$sett[5][3])?>>1년</option><option value='5' <?php echo seltd('5',$sett[5][3])?>>2년</option></select> 지난 경우 &nbsp;그리고 발신자가 <select name='ymm[]'><option value='0' <?php echo seltd('0',$sett[5][4])?>>관리자(전체쪽지,자동쪽지)</option><option value='1' <?php echo seltd('1',$sett[5][4])?>>비회원</option><option value='2' <?php echo seltd('2',$sett[5][4])?>>쪽지삭제</option><option value='3' <?php echo seltd('3',$sett[5][4])?>>아무나</option></select> 인 경우 &nbsp;<select name='ymm[]'><option value='0' <?php echo seltd('0',$sett[5][5])?>>그냥 둠</option><option value='1' <?php echo seltd('1',$sett[5][5])?>>확인된 쪽지로 처리함</option></select>
<br />반복된 로그인 실패 차단: 24시간 동안 <input type='text' name='mpoint[]' value='<?php echo $sett[53]?>' />번 실패하면, 24시간 동안 차단합니다.
<br />회원정보 입력 사항:
&nbsp;주소 <select name='mpoint[]'><option value='1' <?php echo seltd('1',$sett[20][0])?>>필수입력</option><option value='2' <?php echo seltd('2',$sett[20][0])?>>선택입력</option><option value='0' <?php echo seltd('0',$sett[20][0])?>>사용 안 함</option></select>
&nbsp;전화번호 <select name='mpoint[]'><option value='1' <?php echo seltd('1',$sett[20][1])?>>필수입력</option><option value='2' <?php echo seltd('2',$sett[20][1])?>>선택입력</option><option value='0' <?php echo seltd('0',$sett[20][1])?>>사용 안 함</option></select>
&nbsp;생년월일 <select name='mpoint[]'><option value='1' <?php echo seltd('1',$sett[20][2])?>>필수입력</option><option value='2' <?php echo seltd('2',$sett[20][2])?>>선택입력</option><option value='0' <?php echo seltd('0',$sett[20][2])?>>사용 안 함</option></select>
&nbsp;성별 <select name='mpoint[]'><option value='1' <?php echo seltd('1',$sett[20][3])?>>필수입력</option><option value='2' <?php echo seltd('2',$sett[20][3])?>>선택입력</option><option value='3' <?php echo seltd('3',$sett[20][3])?> title='회원의 성별선택 사용 안 함'>사용 안 함</option></select>
<br />회원정보 추가 입력: <input type='text' name='mpoint[]' style='width:100px' value='<?php echo substr($sett[20],4)?>' />
<br /><div style='float:left'>회원 레벨명칭 :</div><div id='mbclass'>
<?php
if($sett[59]) {
$sett59 = explode("\x18",$sett[59]);
for($i =0;$sett59[$i];$i++) {
?>
<span class='f8'><select name='mbclevel[]'><?php echo degree($sett59[$i][0],3)?></select>부터 <input type='text' name='mbcname[]' value='<?php echo substr($sett59[$i],1)?>' /><img src='icon/x.gif' alt='삭제' title='명칭삭제' onclick='addmbvs(this)' /> | </span>
<?php }} if(!$sett59[1]) {?>
<span class='f8'><select name='mbclevel[]'><?php echo degree(0,3)?></select>부터 <input type='text' name='mbcname[]' /><img src='icon/x.gif' alt='삭제' title='명칭삭제' onclick='addmbvs(this)' /> | </span>
<?php }?></div>
<input type='button' class='button' onclick='addmbvs()' value='레벨명칭추가' style='float:left;width:80px' /><div style='clear:both'></div>
포인트레벨: <label><input type='radio' name='uj' value='1' style='width:13px' <?php if($sett[90]) echo "checked='checked'";?> /> 사용함</label> &nbsp; <label><input type='radio' name='uj' value='0' style='width:13px' <?php if(!$sett[90]) echo "checked='checked'";?> /> 사용 안 함</label>
&nbsp;<input type='button' class='button' onclick='popup("?pointlevel=1",500,500)' value='포인트레벨 편집' style='width:90px' />
&nbsp;관리자 표시 : <select name='ul'><option value='0' <?php echo seltd('0',$sett[91][1])?> style='background:url("icon/pointlevel/<?php echo $mbr_ptlv?>.gif") no-repeat;padding-left:14px'>포인트.gif</option><option value='1' <?php echo seltd('1',$sett[91][1])?> style='background:url("icon/pointlevel/m.gif") no-repeat;padding-left:14px'>m.gif</option></select>
<br /><span onmouseover="vwtip(this,8)">이미지마크, 레벨아이콘 표시:</span><select name='uk'><option value='0' <?php echo seltd('0',$sett[91][0])?> onmouseover="vwtip(this,9)">각각 따로 표시</option><option value='1' <?php echo seltd('1',$sett[91][0])?> onmouseover="vwtip(this,10)">이미지마크에 레벨아이콘</option><option value='2' <?php echo seltd('2',$sett[91][0])?> onmouseover="vwtip(this,11)">레벨아이콘에 이미지마크</option><option value='3' <?php echo seltd('3',$sett[91][0])?> onmouseover="vwtip(this,12)">둘 다 표시</option><option value='4' <?php echo seltd('4',$sett[91][0])?> onmouseover="vwtip(this,13)">이미지마크에 레벨아이콘만</option><option value='5' <?php echo seltd('5',$sett[91][0])?> onmouseover="vwtip(this,14)">레벨아이콘에 이미지마크만</option></select>
<br />회원탈퇴 방법: <select name='xl'><option value='0' <?php echo seltd('0',$sett[63])?>>회원 단독으로 탈퇴가능</option><option value='1' <?php echo seltd('1',$sett[63])?>>관리자에게 탈퇴신청</option></select><br />
<input type='submit' class='button' value='적용' style='width:200px'/>
</fieldset></form></td></tr>
</table>
<div  id='newpswd' style='display:none;text-align:center'></div>
<form name="memb" method="post" action="admin.php" style='margin:0;'>
<input type='hidden' name='from' value='<?php echo $_SERVER['SCRIPT_NAME']?>?<?php echo $_SERVER['QUERY_STRING']?>' />
<input type='hidden' name='username_3' value='' />
<input type='hidden' name='password_3' value='newpass' />
<input type='hidden' name='password2' value='' />
<input type='hidden' name='level' value='' />
<input type='hidden' name='no' value='' />
<input type='hidden' name='cnick' value='' />
<input type='hidden' name='cemail' value='' />
<input type='hidden' name='wr' value='' />
<input type='hidden' name='wc' value='' />
<input type='hidden' name='deletee' value='' />
</form>
<script type="text/javascript">
//<![CDATA[
function vwtip(ths,i) {
var ttitle = Array("회원을 특정하는 고유번호 / 클릭하면 회원정보 링크",
"회원의 성별 / 클릭하면 홈페이지 링크",
"회원정보 수정내용 저장",
"회원의 비밀번호를 재설정",
"회원정보 삭제",
"새 쪽지가 발송될 때 처리됨, memo2.dat의 내용을 대상으로 함 ",
"받은 쪽지함을 열었을 때 처리됨",
"쪽지 발송 권한",
"스킨에서 레벨아이콘 <#tname#>, 이미지마크 <#name#> 로 구분. 포인트레벨 사용하면 레벨아이콘 => 포인트레벨 아이콘으로 바뀝니다.",
"변동없이 <#name#>은 이미지마크, <#tname#>은 레벨아이콘을 표시합니다.",
"스킨에 이미지마크 <#name#> 여도, 레벨아이콘이 앞에 표시되도록 합니다.",
"스킨에 레벨아이콘 <#tname#>이어도, 뒤에 이미지마크가 붙도록 합니다.",
"스킨에 <#tname> <#name> 가리지 않고 둘 다 표시합니다.",
"스킨에 이미지마크<#name> 일 때, 이미지마크 빼고, 레벨아이콘을 표시합니다.",
"스킨에 레벨아이콘 <#tname> 일 때, 레벨아이콘 빼고, 이미지마크를 표시합니다.");
if(i == 'x' || ttitle[i]) {
if(i == 'x') ttitle = ths.title;
else if(ttitle[i]) {
if(ths.innerHTML) ttitle = ths.innerHTML +" :: " +ttitle[i];
else if(ths.value) ttitle = ths.value +" :: " +ttitle[i];
}
$('admtip').innerHTML = ttitle;
}}
function change(x, ode){
var meb = document.memb;
var nick = $('nick_' + x).value;
if(ode == 'delete') meb.deletee.value=ode;
else if(ode == 'newpass') newpd();
meb.username_3.value=chbase($('usr_' + x).value);
meb.level.value=$('level_' + x).value;
meb.no.value=$('no_' + x).value;
meb.cnick.value=$('nick_' + x).value;
meb.cemail.value=$('email_' + x).value;
meb.submit();
}
function newpd(pid,x) {
if(pid) {
$('newpswd').innerHTML = pid + "님의 새 비밀번호 : <input type='text' style='width:150px;margin-right:5px' /><input type='button' value='비밀번호변경' style='width:80px' class='button' onclick=\"var npss=this.previousSibling.value;if(npss != '') {document.memb.password2.value=npss;change('" + x + "','newpass')}\" /> &nbsp; <input type='button' value='취소' style='width:40px' class='button' onclick='newpd()' />";
$('newpswd').style.display = 'block';
} else {
$('newpswd').innerHTML = '';
$('newpswd').style.display = 'none';
}
}
function addmbvs(ths) {
var mbcls = $('mbclass');
var mbcln = mbcls.getElementsByTagName('span').length;
if(ths) {if(mbcln > 1) mbcls.removeChild(ths.parentNode);}
else if(mbcln < 9) mbcls.innerHTML = mbcls.innerHTML + "<span class='f8'>" + mbcls.getElementsByTagName('span')[mbcln -1].innerHTML + "</span>";
}
<?php if($_GET['search'] && $_GET['keyword']) echo "document.smember.search.value = '{$_GET['search']}';document.smember.keyword.value = '{$_GET['keyword']}';";?>
document.title = "회원관리";
//]]>
</script>
<?php
} else if($_GET['section']) {
$fsidlist = "^";
$fs = fopen($ds,"r");
while($fso = fgets($fs)) {
$fsid = trim(substr($fso,0,10));
$fsidlist .= $fsid."^";
}
fclose($fs);
$sectt = "<option value=''>사용 안 함</option>";
for($i = 0;$secto[$i]; $i++) {
$sectt .= "<option value='{$secto[$i]}'>{$secto[$i]}</option>";
}
?>
<table border='0px' cellpadding='5px' cellspacing='1px' class='ttb'>
<tr><td style='padding:5px 5px 5px 10px;line-height:230%' align='center'>
<div id='admtip' style='width:920px'>섹션관리</div>
<form name='sectform' method='post' action='admin.php' style='margin:0'>
<input type='hidden' name='stm' value='1' />
<div style='padding:10px 0 10px 0'>
<label>섹션 그룹 사용 <input type='checkbox' class='no' <?php if($sett[56]) echo "checked='checked'";?> onclick='var sf=document.sectbtmf;sf.gx.value=(this.checked)?1:0;sf.submit()' /></label> &nbsp; &nbsp;
<span style='font-weight:bold;'>레이아웃 선택 :: </span><select name='sectmenu' onchange='sectmenuchange(this)'>
<?php echo $sectt?>
</select> &nbsp; <b>편집</b> : <span id='sectmenudit'><a href='#none' onclick='popup("admin.php?fm=module/<?php echo $sett[26]?>.php", 800, 400)'><?php echo $sett[26]?>.php</a> &nbsp; <a href='#none' onclick='popup("admin.php?fm=module/<?php echo $sett[26]?>.css", 800, 400)'><?php echo $sett[26]?>.css</a></span></div>
<?php
if($sett[56]) {
$st56 = '';
?>
<table cellpadding='3px' cellspacing='1px' width='900px'>
<caption style='background:#DADADA;border-bottom:2px solid #fff;padding:5px'><b>섹션그룹</b>(::섹션의 묶음) <b>설정</b><a href='#none' onclick="popup('?fm=module/_head.php', 800, 400)" style="margin-left:50px">_head.php</a></caption>
<tr style='background-color:#EAEAEA'><th style='height:25px'>번호</th><th>이름</th><th>레이아웃</th><th>하위섹션</th><th title="
 회원번호를 입력합니다.
두명 이상일 경우엔 쉼표(,)로 구분합니다.
">섹션그룹 관리자</th></tr>
<?php
$i = 1;
$file = $dxr."section_group.dat";
$sectgp = "<option value='0'>&nbsp;</option>";
if(file_exists($file)) {
$st =fopen($file,"r");
while($sto = fgets($st)) {
if($stn = explode("\x1b",$sto)) {
$sectgp .= "<option value='{$i}'>{$stn[0]}</option>";
?>
<tr style='text-align:center'>
<td><input type='text' value='<?php echo $i?>' style='border:0;width:20px' /></td>
<td><input type='text' name='stgs[]' value='<?php echo str_replace("&","&amp;",$stn[0])?>' style='width:200px' /></td>
<td><input type='hidden' value='<?php echo $stn[1]?>' /><select name='stgl[]'><?php echo $sectt?></select></td>
<td><input type='text' value='<?php echo $stn[2]?>' style='width:200px' readonly='readonly' /></td>
<td><input type='text' name='stga[]' value='<?php echo $stn[3]?>' style='width:200px' /></td></tr>
<?php
$i++;
}}
fclose($st);
}
?>
<tr style='text-align:center'>
<td>new</td>
<td><input type='text' name='stgs[]' value='' style='width:200px' /></td>
<td><select name='stgl[]'><?php echo $sectt?></select></td>
<td style='width:200px'></td>
<td><input type='text' name='stga[]' value='' style='width:200px' /></td></tr>
</table>
<?php } else $st56 = " style='display:none'";?>
<table cellpadding='3px' cellspacing='1px' width='900px'>
<caption style='background:#DADADA;border-bottom:2px solid #fff;padding:5px'><b>섹션</b>(::게시판, 링크등의 묶음) <b>설정</b></caption>
<colgroup><col width='50px' /><col width='50px' /><col width='70px' /><col width='373px' /><col width='90px' /><col width='167px' /><col width='100px'  <?php echo $st56?> /></colgroup>
<tr style='background-color:#EAEAEA'><th style='height:25px'>번호</th><th>순서</th>
<th>섹션이름</th><th>하위목록</th><th>하위목록처리</th><th>대문좌우하단css</th><th <?php echo $st56?>>섹션그룹</th></tr>
<?php
$file = $dxr."section.dat";
$i = 1;
$stgtn = '';
if(file_exists($file)) {
$st =fopen($file,"r");
while($sto = fgets($st)) {
if($stn = explode("\x1b",$sto)) {
$im = $i - 1;
if($stn[1] != '3' && $stn[1] != '6' && $stn[1] != '7' && $stn[1] != 's') {$sectedit = "<input type='button' value='대문' onmouseover='vwtit(this)' onclick=\"popup('?ectgt=' + $$('sn[]',".$im.").value,500,410)\" class='button' style='width:25px' /> <input type='button' value='wz' onmouseover='vwtit(this)' onclick=\"popup('?ectgtw=' + $$('sn[]',".$im.").value,750,600,1)\" class='button' style='width:18px' /> <input type='button' value='좌우' onmouseover='vwtit(this)' onclick=\"popup('?sect_arr=' + $$('sn[]',".$im.").value,610,500)\" class='button' style='width:25px' /> <input type='button' value='하단' onmouseover='vwtit(this)' onclick=\"popup('?fm=widget/sectbtm_' + $$('sn[]',".$im.").value, 800, 400)\" class='button' style='width:25px' /> <input type='button' value='css' onmouseover='vwtit(this)' onclick=\"popup('?fm=module/sectcss_' + $$('sn[]',".$im.").value + '.css', 800, 400)\" class='button' style='width:23px' />";$stgtn .= $i.",";}
else $sectedit = "";
$stid = explode("^",$stn[2]);
for($ii = 0;$stid[$ii];$ii++) $fsidlist = str_replace("^".$stid[$ii]."^","^",$fsidlist);
if($stn[4]) $stn[4] =";background:#F7F4E1' title='가입회원:".(substr_count($stn[5],',') -1)."명";
?>
<tr style='text-align:center'><td><input type='text' name='sn[]' value='<?php echo $i?>' style='border:0;width:20px' onclick="nwopn('<?php echo $index?>?section=<?php echo $i?>')" /></td><td><input type='button' value='↑' onclick='mvup(<?php echo $i?>)' class='uparrow' /></td><td><input type='text' name='sect[]' value='<?php echo str_replace("&","&amp;",$stn[0])?>' style='width:60px' /></td><td><input type='text' name='sectadd[]' value='<?php echo str_replace("&","&amp;",$stn[2])?>' style='width:323px' /><input type='button' value='소모임' onclick="popup('?sect_group=' + $$('sn[]',<?php echo $im?>).value,300,320)" class='button' style='width:40px<?php echo $stn[4]?>' /> </td>
<td><input type='hidden' value='<?php echo $stn[1]?>' /><select name='sectlnk[]'><option value='1'>+섹션대문</option><option value='4'>&nbsp; └ 출력x</option><option value='n'>&nbsp; └ 대문갱신</option><option value='3'>-링크</option><option value='6'>-새창링크</option><option value='7'>-스크립트</option><option value='8'>+전체대문</option><option value='s'>+하위메뉴</option><option value='x'>+섹션안씀</option></select></td>
<td><?php echo $sectedit?></td><td <?php echo $st56?>><input type='hidden' value='<?php echo $stn[6]?>' /><select name='sectgrp[]'><?php echo $sectgp?></select></td></tr>
<?php
$i++;
}
}
fclose($st);
}
if($i < 98) {
?>
<tr style='text-align:center'><td>new</td><td></td><td><input type='text' name='sect[]' id='new' value='' style='width:60px' /></td><td><input type='text' name='sectadd[]' value='' style='width:365px' /></td>
<td><select name='sectlnk[]'><option value='1'>+섹션대문</option><option value='4'>&nbsp; └ 출력x</option><option value='3'>-링크</option><option value='6'>-새창링크</option><option value='7'>-스크립트</option><option value='8'>+전체대문</option><option value='s'>+하위메뉴</option><option value='x'>+섹션안씀</option></select></td>
<td></td><td <?php echo $st56?>></td></tr>
<?php
}
$fsidlist = substr($fsidlist,1,-1);
if(!$fsidlist) $fsidlist = "없음";
?>
<tr><td colspan='3'><input type='button' id='dvframebt' class='button' value=' 대문 편집창 모두 갱신 ' onclick='popup("?stgate=all",400,400)' style='width:120px;background-color:#FF0000' /></td><td align='center'><label>섹션 하위목록 게시판의 섹션선택 수정 <input type='checkbox' name='ss57' class='no' /></label></td>
<td colspan='3' align='right'>하단 출력위치:<select id='sectbtm' onchange='var sf=document.sectbtmf;sf.xg.value=this.options[this.selectedIndex].value;sf.submit()'><option value='100'>대문</option><option value='010'>목록</option><option value='001'>본문</option><option value='011'>목록+본문</option><option value='110'>대문+목록</option><option value='101'>대문+본문</option><option value='111'>대문+목록+본문</option></select></td></tr>
<tr><td colspan='7' align='center'>
섹션에 할당 안된 게시판 : <textarea rows='1' cols='1' style='width:600px;height:18px;overflow:auto;border:0;background:#F7F7F7' >^<?php echo $fsidlist?></textarea>
<div id='secxplain'>
<span class='red'>## 하위목록처리 - 하나짜리</span><br />
-링크 :: 링크주소 하나 입력<br />
-새창링크 :: 링크주소 하나 입력<br />
-스크립트 :: 자바스크립트 하나 입력<br />
<span class='red'>## 하위목록처리 - 기타</span><br />
+섹션대문 :: 하위메뉴 O, 섹션대문 O, 섹션이름 O<br />
&nbsp; └ 출력x :: 하위메뉴 O, 섹션대문 O, 섹션이름 X<br />
&nbsp; └ 대문갱신 ::섹션대문 게시판 갱신 (기존의 내용은 삭제됩니다)<br />
+전체대문 :: 전체게시판 하위목록에 추가해서 '섹션대문'으로<br />
+하위메뉴 :: 하위메뉴 O, 섹션대문 X, 섹션이름 O<br />
+섹션안씀 :: 하위메뉴 게시판은 섹션대문 X, 섹션이름 X<br />
<span class='red'># 하위목록 입력방법</span><br />
└게시판 :: <span class='blue'>게시판아이디1<span class='red'>^</span>게시판아이디2<span class='red'>^</span>게시판아이디3</span><br />
└링크 :: <span class='blue'>제목1<span class='red'>></span>경로1<span class='red'>^</span>제목2<span class='red'>></span>경로2</span><br />
└새창링크 :: <span class='blue'>제목1<span class='red'>></span>경로1<span class='red'>></span>nw<span class='red'>^</span>제목2<span class='red'>></span>경로2<span class='red'>></span>nw</span><br />
└자바스크립트함수링크 :: <span class='blue'>제목1<span class='red'>></span>함수1<span class='red'>></span>js<span class='red'>^</span>제목2<span class='red'>></span>함수2<span class='red'>></span>js</span>
<br/>&nbsp; └ (작은 따옴표 사용불가, 큰 따옴표만)<br/>
└탭블록과 탭블록 분리 :: <span class='blue'>탭블록1게시판1<span class='red'>^</span>탭블록1게시판2<span class='red'>^>^</span>탭블록2게시판3<span class='red'>^</span>탭블록2게시판4
</div></td></tr>
</table>
<?php
if(is_dir("widget")) {
$wdopen = opendir("widget");
while($wfile[] = readdir($wdopen)) {}
closedir($wdopen);
@sort($wfile);
foreach($wfile as $w) if($w != '.' && $w != '..' && $w) {
if(substr($w,-4) == '.css') $wcss[] = $w;
else $wphp[] = $w;
}}
?>
<fieldset id='gatewidget' style="border:1px solid #0000ff;padding:30px;width:550px"><legend style='padding:0 20px 0 20px'><b>대문위젯 :: </b>대문(편집)에 &lt;##widget/파일이름##&gt; 삽입, <b>스타일 선택 :: </b><select name='wgcss'><option value=''></option>
<?php
if($wcss) foreach($wcss as $css) echo "<option value='".substr($css,0,-4)."'>{$css}</option>";
?>
</select></legend>
<?php
if($wcss) foreach($wcss as $w) echo "<div><a href='#none' onclick=\"popup('?fm=widget/{$w}', 800, 400)\">{$w}</a></div>";
echo "<hr style='clear:both' />";
if($wphp) foreach($wphp as $w) echo "<div><a href='#none' onclick=\"popup('?fm=widget/{$w}', 800, 400)\" onmouseover='vwtip(this)'>{$w}</a></div>";
?>
</fieldset>
<input type='submit' value=' 적용 ' class='button' style='width:400px;height:20px;margin:15px 0 10px 0' />
</form>
<form name='sectbtmf' method='post' action='admin.php' style="margin:0">
<input type='hidden' name='from' value='<?php echo $_SERVER['QUERY_STRING']?>' />
<input type='hidden' name='xg' value='<?php echo $sett[58]?>' />
<input type='hidden' name='gx' value='<?php echo $sett[56]?>' />
</form>
<script type="text/javascript">
//<![CDATA[
function mvup(ths) {
var pt=ths - 2;
var nt=ths - 1;
var psect = $$('sect[]',pt).value;
$$('sect[]',pt).value = $$('sect[]',nt).value;
$$('sect[]',nt).value = psect;
var psectadd = $$('sectadd[]',pt).value;
$$('sectadd[]',pt).value = $$('sectadd[]',nt).value;
$$('sectadd[]',nt).value = psectadd;
var psectlnk = $$('sectlnk[]',pt).value;
$$('sectlnk[]',pt).value = $$('sectlnk[]',nt).value;
$$('sectlnk[]',nt).value = psectlnk;
var psectsn = $$('sn[]',pt).value;
$$('sn[]',pt).value = $$('sn[]',nt).value;
$$('sn[]',nt).value = psectsn;
var psectgrp = $$('sectgrp[]',pt).value;
$$('sectgrp[]',pt).value = $$('sectgrp[]',nt).value;
$$('sectgrp[]',nt).value = psectgrp;
}
function vwtit(ths) {
var ttitle = Array();
var i = ths.value;
ttitle['대문'] = "대문편집창";
ttitle['wz'] = "대문 위지윅편집창";
ttitle['좌우'] = "좌우메뉴 배치창";
ttitle['하단'] = "대문 하단내용 추가/편집";
ttitle['css'] = "대문에 css 추가 편집창";
if(ttitle[i]) {
var iv = ths.parentNode;if(!!iv) iv = iv.parentNode;if(!!iv) iv = iv.childNodes[2];if(!!iv) iv = iv.firstChild;if(!!iv) iv = iv.value;
if(!!iv) $('admtip').innerHTML = "&lt;" + iv + "&gt; " + ttitle[i];
else if(ttitle[i]) $('admtip').innerHTML = ttitle[i];
} else $('admtip').innerHTML = "";
}
function vwtip(ths) {
var ttitle = Array();
var i = ths.innerHTML;
ttitle['bd_img.php'] = "설정한 게시판의 최근 이미지파일 하나를 출력";
ttitle['by_hot.php'] = "전체 게시판에서 조회순, 덧글순, 추천순 중 설정한 순서의 목록";
ttitle['by_hot3.php'] = "전체 게시판에서 조회순 / 덧글순 / 추천순 탭형 목록";
ttitle['calendar_memo.php'] = "대문에 달력형 메모";
ttitle['counter_mon.php'] = "대문에 달력형 월별 방문자 수";
ttitle['gagachat.php'] = "gagachat";
ttitle['gate3.php'] = "내용 편집후, 섹션하위목록과 별개로 대문에 게시판 출력";
ttitle['hot_post.php'] = "전체 최근 게시물";
ttitle['hot_reple.php'] = "전체 최근 덧글";
ttitle['hot2.php'] = "전체 최근 글 / 전체 최근 덧글 탭형목록";
ttitle['img_block.php'] = "설정한 게시판의 이미지를 고정 형식으로 출력";
ttitle['img_rotate.php'] = "설정한 게시판의 이미지를 회전 형식으로 출력";
ttitle['list10.php'] = "외부에서 게시판 출력하도록 하는 bdopn 함수 출력";
ttitle['marker.php'] = "전광판";
ttitle['marker.dat'] = "전광판 데이타파일";
ttitle['marker2.php'] = "관리자 전용 전광판";
ttitle['marker2.dat'] = "관리자 전용 전광판 데이타파일";
ttitle['mbr_list.php'] = "게시판관리-본문하단 내용추가에 <##wiget/mbr_list.php##> 이렇게 넣어서, 글쓴이가 쓴 글 목록 출력";
ttitle['member_login.php'] = "대문에 출력하는 회원로그인";
ttitle['research.php'] = "설문조사 :  질문번호($pollno)는 5자리값으로 \"<###$pollno='00001';###><##widget/research.php##>\" 이런 식으로 대문편집창에 삽입";
ttitle['sitemap.php'] = "전체 사이트맵 출력";
ttitle['sitemap_g.php'] = "섹션그룹 사이트맵 출력";
if(ttitle[i]) $('admtip').innerHTML = i +" ::\n " + ttitle[i];
else $('admtip').innerHTML = "";
}
$$('sectmenu',0).value = '<?php echo $sett[26]?>';
$$('wgcss',0).value = '<?php echo $sett[45]?>';
$('sectbtm').value = '<?php echo $sett[58]?>';
if($('new')) $('new').focus();
for(var i=document.getElementsByName('sectlnk[]').length -2;i >= 0;i--) {$$('sectlnk[]',i).value = $$('sectlnk[]',i).previousSibling.value;$$('sectgrp[]',i).value = $$('sectgrp[]',i).previousSibling.value;}
for(var i=document.getElementsByName('stgl[]').length -2;i >= 0;i--) {$$('stgl[]',i).value = $$('stgl[]',i).previousSibling.value;}
document.title='섹션관리';
//]]>
</script>
</td></tr>
</table>
<?php
} else if($_GET['statistics']) {
$countin = array("hour","request","host","query","browser");
$counting = array(array(),array(),array(),array(),array());
for($c = 0;$c < 5;$c++) {
if($_GET['statistics'] == 1 || ($c != 0 && $c != 4)) {
if($fv = @fopen($dxr."count_".$countin[$c].".dat","r")) {
while($fvo = trim(fgets($fv))) {
$fvn = (int)substr($fvo,0,6);
if($c == 0 || $c == 4 || $fvn >= $sett[47]) $counting[$c][substr($fvo,6)] = $fvn;
}
fclose($fv);
}}}
if($_GET['statistics'] == 1) {
?>
<table id='graph_browser' class='table' cellpadding='2px' cellspacing='2px'><tr><th colspan='8' class='title'>누적 브라우저별</th></tr>
<tr>
<?php
$sum = 0;
$cnt ='';
$browser = array('ie6','ie7','ie8','ie9','chrome','firefox','opera','other');
for($b = 0;$b < 8;$b++) {
$sum += $counting[4][$browser[$b]];
?><td><?php echo $browser[$b]?></td><?php
$cnt .= "<td>{$counting[4][$browser[$b]]}</td>";
}
?>
</tr><tr class='cnt'><?php echo $cnt?></tr>
<tr style='height:100px'>
<?php
if($sum) {
for($b = 0;$b < 8;$b++) {
$wd = sprintf("%.2f",$counting[4][$browser[$b]]/$sum);
?>
<td valign='bottom'><div style='height:<?php echo ($wd*100)+10?>px'><?php echo $wd*100?>%</div></td>
<?php
}}
$vmonth = ($_GET['month'])? $_GET['month']:date("Ym",$time -86400*3);
$vday = array();
$amonth = array();
$big = 0;
if($fp = @fopen($dxr."count.dat","r")) {
while($fpo = fgets($fp)) {
$vc = (int)substr($fpo,8);
if(substr($fpo,0,6) == $vmonth) {$vday[substr($fpo,6,2)] = $vc;if($big < $vc) $big = $vc;}
$amonth[substr($fpo,0,6)] += $vc;
}
fclose($fp);
}
?>
</tr></table>
<table id='graph_month' class='table' cellpadding='2px' cellspacing='2px'><tr><td class='title'><div style='float:left;width:480px;background:transparent;padding-top:3px'><b><?php echo substr($vmonth,0,4)?>년 <?php echo substr($vmonth,4)?>월 방문자수</b> (전체:<?php echo $amonth[$vmonth]?> 최고:<?php echo $big?>) </div><select onchange="location.href='?statistics=1&amp;month=' + this.options[this.selectedIndex].value;" style='float:right'>
<?php
foreach($amonth as $key => $value) {
if($key == $vmonth) echo "<option value='{$key}' selected='selected'>{$key} ({$value})</option>";
else echo "<option value='{$key}'>{$key} ({$value})</option>";
}
?></select></td></tr>
<tr><td valign='bottom' height='130px'>
<?php
foreach($vday as $key => $value) {
?><div style='height:<?php echo sprintf("%.2f",$value/$big*100)?>%'><?php echo $key?><br /><span class='f7'><?php echo $value?></span></div><?php
}
?>
</td></tr></table>
<table id='graph_hour' class='table' style='clear:both' cellpadding='2px' cellspacing='2px'><tr><th colspan='25' class='title'>누적 시간대별</th></tr>
<tr>
<?php
$sum = 0;
$cnt ='';
for($i = 0;$i < 24;$i++) {
$ii = str_pad($i,2,0,STR_PAD_LEFT);
$sum += $counting[0][$ii];
?>
<td><?php echo $i?>시</td>
<?php
$cnt .= "<td>{$counting[0][$ii]}</td>";
}
?>
</tr><tr class='cnt'><?php echo $cnt?></tr>
<tr style='height:100px'>
<?php
if($sum) {
for($i = 0;$i < 24;$i++) {
$ii = str_pad($i,2,0,STR_PAD_LEFT);
$wd = sprintf("%.2f",$counting[0][$ii]/$sum);
?>
<td valign='bottom'><div style='height:<?php echo ($wd*300)+10?>px'><?php echo $wd*100?>%</div></td>
<?php
}}
?>
</tr></table>
<?php
}
?>
<table cellpadding='2px'><tr>
<?php
$max = 0;
$name = array('','요청받은 페이지','접속한 사이트','검색어순위');
for($c=1;$c < 4;$c++) {
$cnt = count($counting[$c]);
$max = ($max > $cnt)? $max:$cnt;
?>
<td valign='top'><table cellpadding='2px' cellspacing='2px' class='table'>
<tr class='title'><th width='40px'>순위</th><th width='40px'>횟수</th><th width='216px'><b><?php echo $name[$c]?></b></th></tr>
<?php
arsort($counting[$c]);
$d = 0;
$limit = ($_GET['statistics'] == 1)? 10:20;
$start = ($_GET['statistics'] == 1)? 0:($_GET['statistics']-1)*$limit -10;
foreach($counting[$c] as $key => $value) {
$key = str_replace("&","&amp;",$key);
$key = str_replace("&amp;amp;","&amp;",$key);
if($d >= $start) {
if($c == 1) $key = "<a target='_blank' href='{$index}?{$key}'>{$key}</a>";
else if($c == 2) $key = "<a target='_blank' href='http://{$key}'>{$key}</a>";
?>
<tr><td><?php echo $d+1?></td><td class='cnt'><?php echo $value?></td><td><?php echo $key?></td></tr>
<?php
}
$d++;
if($d == $start + $limit) break;
}
?>
</table></td>
<?php
}
?>
</tr>
<tr><td colspan='3' align='center'>
<?php
$max = (int)(($max + 9)/20) +1;
pagen('statistics',$max,20,0);
?>
</td></tr>
<tr><td colspan='3' align='center'>
<script type="text/javascript">
//<![CDATA[
function vwtip(ths,i) {
var ttitle = Array("접속통계 횟수순 정렬에 출력할 배열의 최소횟수를 정합니다","접속통계 저장데이타 중에서 횟수 *회 이하의 기록을 삭제합니다");
ths.title = "\n  " + ttitle[i] + "  \n \n";
}
document.title='접속통계';
//]]>
</script>
<div style='float:right'><form method='post' action='admin.php' style="margin:0"><input type='hidden' name='from' value='<?php echo $_SERVER['QUERY_STRING']?>' />요청받은 페이지 <input type='text' name='dlimit[]' value='0' style='width:15px' /><span onmouseover='vwtip(this,1)'>접속한 사이트 </span><input type='text' name='dlimit[]' value='0' style='width:15px' /> 검색어순위 <input type='text' name='dlimit[]' value='0' style='width:15px' />이하 내역삭제  &nbsp; <span onmouseover='vwtip(this,0)'>접속통계 배열최소횟수</span>: <input type='text' name='statisticn' style='width:35px' value='<?php echo $sett[47]?>' /> &nbsp; <input type='submit' class='button' value='적용' /></form>
</div></td></tr></table>
<?php
} else {
$sett_xd=substr($sett[16],0,3);
$sett_xe=substr($sett[16],3,3);
for($i = substr_count(substr($sett[14],7 + strlen($_SERVER['HTTP_HOST'])),'/');$i > 1;$i--) $sett_we .= '../';
if(file_exists($sett_we.'favicon.ico')) $sett_we = "<input type='checkbox' onclick=\"this.previousSibling.value=(this.previousSibling.value == '1')? '0':'1'\" ".rtchecked($sett[31])." class='no' /> 사용여부 선택";
else {$sett_we = "파일없음";$sett[31] = 0;}
?>
<div id='admtip' style='width:920px;background-color:#E6FFA3'>전체설정</div>
<table border='0px' cellpadding='5px' cellspacing='1px' class='ttb'>
<tr><td style='padding:10px 5px 5px 130px;text-align:left'>
<form action="admin.php" method="post" style="margin:0;line-height:220%">
<span class='r7'>1.</span> 홈페이지 제목: <input type='text' name='titlee' style='width:150px' value='<?php echo $sett[0]?>' /> &nbsp; <span onmouseover='vwtip(this,0)'>즐겨찾기 파비콘 (http://<?php echo $_SERVER['HTTP_HOST']?>/favicon.ico)</span> <input type='hidden' name='we' value='<?php echo $sett[31]?>' /><?php echo $sett_we?><br />
<span class='r7'>2.</span> <span onmouseover='vwtip(this,1)'>외부파일 삽입</span>: &nbsp; → 위쪽 : <input type='text' name='b' style='width:100px' value='<?php echo $sett[2]?>' /> &nbsp; → 아래쪽 : <input type='text' name='c' style='width:100px' value='<?php echo $sett[3]?>' /> &nbsp; → CSS : <input type='text' name='ww' style='width:100px' value='<?php echo $sett[24]?>' /><br />
<span class='r7'>3.</span> 가로넓이 설정: &nbsp; → <span onmouseover='vwtip(this,2)'>본문그림</span> : <input type='text' name='k' style='width:30px' value='<?php echo $sett[11]?>' /> &nbsp; → <span onmouseover='vwtip(this,3)'>게시판(전체)</span> : <input type='text' name='l' style='width:40px' class='strk' value='<?php echo $sett[12]?>' /><select name='vc' onchange='ckalert(this)'><option value='0' <?php echo seltd('0',$sett[77])?>>px</option><option value='1' <?php echo seltd('1',$sett[77])?>>%</option></select><span> &nbsp;→ <span onmouseover='vwtip(this,62)'>게시판 최소 넓이</span> : <input type='text' name='vl' style='width:25px' value='<?php echo $sett[88]?>' /></span>
 &nbsp;→ <span onmouseover='vwtip(this,42)'>미리보기</span>: <input type='text' name='xc' style='width:30px' value='<?php echo $sett[55]?>' /> &nbsp; → <span onmouseover='vwtip(this,4)'><span class='clr2'>덧글</span>표시</span> : <input type='text' name='wb' style='width:30px' class='strk' value='<?php echo $sett[28]?>' /><br />
<span class='r7'>4.</span> 좌우메뉴 넓이: &nbsp; → <b>대문</b> :: 좌측 : <input type='text' name='xp' style='width:30px' class='strk' value='<?php echo $sett[67]?>' /> &nbsp; 우측 : <input type='text' name='xq' style='width:30px' class='strk' value='<?php echo $sett[68]?>' /> &nbsp; → 게시판 :: 좌측 : <input type='text' name='xr' style='width:30px' value='<?php echo $sett[69]?>' /> &nbsp; 우측 : <input type='text' name='xs' style='width:30px' value='<?php echo $sett[70]?>' /> &nbsp; → <span onmouseover='vwtip(this,58)'>좌우메뉴간격</span> : <input type='text' name='vd' style='width:30px' class='strk' value='<?php echo $sett[78]?>' /><br />
<span class='r7'>5.</span> 리사이즈 설정: &nbsp; → <span onmouseover='vwtip(this,73)'>리사이즈 넓이</span> : <input type='text' name='uq' style='width:30px' value='<?php echo substr($sett[93],1)?>' />px &nbsp; → <span onmouseover='vwtip(this,74)'>사용 여부</span> : <select name='up'><option value='1' <?php echo seltd('1',$sett[93][0])?>>모두 사용</option><option value='2' <?php echo seltd('2',$sett[93][0])?>>모바일만 사용</option><option value='3' <?php echo seltd('3',$sett[93][0])?>>PC만 사용</option><option value='4' <?php echo seltd('4',$sett[93][0])?>>사용 안 함</option></select><br />
<span class='r7'>6.</span> <span onmouseover='vwtip(this,57)'><b>대문</b>캐시 갱신</span>: <select name='vb'><option value='0' <?php echo seltd('0',$sett[76])?>>사용 안 함</option><option value='1' <?php echo seltd('1',$sett[76])?>>새글 있으면</option><option value='2' <?php echo seltd('2',$sett[76])?>>새글 or 새덧글 있으면</option><option value='3' <?php echo seltd('3',$sett[76])?>>시간주기로만</option><option value='4' <?php echo seltd('4',$sett[76])?>>새글 or 시간주기</option><option value='5' <?php echo seltd('5',$sett[76])?>>새글 or 새덧글 or 시간주기</option></select>
&nbsp; <span onmouseover='vwtip(this,23)'>시간주기</span>:  <input type='text' name='va' style='width:50px' value='<?php echo $sett[75]?>' />분&nbsp; <input type='button' class='button' value=' 캐시 삭제 - 갱신 ' onclick='location.replace("?renewcache=all")' style='width:100px' /> &nbsp; <input type='button' id='dvframebt' class='button' value=' 대문 편집창 모두 갱신 ' onclick='popup("?stgate=all",400,400)' style='width:120px;background-color:#FF0000' /><br />
<span class='r7'>7.</span> <span onmouseover='vwtip(this,14)'><b><b>대문</b></b> 스킨</span>: <select name='a'>
<?php echo $skinoption?>
</select> &nbsp; <span onmouseover='vwtip(this,15)'><b>대문</b> 셀간격</span>: <input type='text' name='wn' value='<?php echo $sett[39]?>' style='width:30px' /> &nbsp; <span onmouseover='vwtip(this,16)'>게시판 하나짜리 <b>대문</b>출력 여부</span>: <select name='wo'><option value='0' <?php echo seltd('0',$sett[40])?> onmouseover='vwtip(this,17)'>no</option><option value='1' <?php echo seltd('1',$sett[40])?>>yes</option></select><br />
<span class='r7'>8.</span> <span onmouseover='vwtip(this,48)'><b>대문</b> 회전주기</span>: <span>탭형목록</span> <input type='text' name='xia' style='width:50px' value='<?php $sett60 = strpos($sett[60],'|');echo substr($sett[60],0,$sett60)?>' /> 초
 &nbsp; <span>뉴스형내용</span> <input type='text' name='xib' style='width:50px' value='<?php echo substr($sett[60],$sett60 + 1)?>' />초<br />
<span class='r7'>9.</span> <span onmouseover='vwtip(this,6)'>상단 내용추가</span>: <textarea name='head' rows='1' cols='1' style='width:500px;height:80px;overflow:auto'><?php if($fp=@fopen($dxr."head","r")) {echo str_replace("&","&amp;",@fread($fp,filesize($dxr."head")));fclose($fp);}?></textarea><br />
<span class='r7'>10.</span> <span onmouseover='vwtip(this,46)'>출력위치 설정</span>: <select name='xd'><option value='100' <?php echo seltd('100',$sett_xd)?>>대문</option><option value='010' <?php echo seltd('010',$sett_xd)?>>목록</option><option value='001' <?php echo seltd('001',$sett_xd)?>>본문</option><option value='011' <?php echo seltd('011',$sett_xd)?>>목록+본문</option><option value='110' <?php echo seltd('110',$sett_xd)?>>대문+목록</option><option value='101' <?php echo seltd('101',$sett_xd)?>>대문+본문</option><option value='111' <?php echo seltd('111',$sett_xd)?>>대문+목록+본문</option></select><br />
<span class='r7'>11.</span> <span onmouseover='vwtip(this,7)'>하단 내용추가</span>: <textarea name='tail' rows='1' cols='1' style='width:500px;height:80px;overflow:auto'><?php if($fp=@fopen($dxr."tail","r")) {echo str_replace("&","&amp;",@fread($fp,filesize($dxr."tail")));fclose($fp);}?></textarea><br />
<span class='r7'>12.</span> <span onmouseover='vwtip(this,47)'>출력위치 설정</span>: <select name='xe'><option value='100' <?php echo seltd('100',$sett_xe)?>>대문</option><option value='010' <?php echo seltd('010',$sett_xe)?>>목록</option><option value='001' <?php echo seltd('001',$sett_xe)?>>본문</option><option value='011' <?php echo seltd('011',$sett_xe)?>>목록+본문</option><option value='110' <?php echo seltd('110',$sett_xe)?>>대문+목록</option><option value='101' <?php echo seltd('101',$sett_xe)?>>대문+본문</option><option value='111' <?php echo seltd('111',$sett_xe)?>>대문+목록+본문</option></select><br />
<span class='r7'>13.</span> <span onmouseover='vwtip(this,8)'>내용추가 방식</span>: <select name='wf'><option value='0' <?php echo seltd('0',$sett[32])?>>include</option><option value='1' <?php echo seltd('1',$sett[32])?>>readfile</option></select><br />
<span class='r7'>14.</span> <span onmouseover='vwtip(this,13)'>회원가입 약관</span>: <textarea name='member_agreement' rows='1' cols='1' style='width:500px;height:80px;overflow:auto'><?php if($fp=@fopen($dxr."member_agreement","r")) {echo str_replace("&","&amp;",@fread($fp,filesize($dxr."member_agreement")));fclose($fp);}else echo "홈페이지에 맞는 이용약관을 입력합니다.";?></textarea><br />
<span class='r7'>15.</span> <span><b>rss</b>&nbsp; 피드 갯수</span>: &nbsp; → 게시판 : <input type='text' name='wj' style='width:35px' value='<?php echo $sett[35]?>' /> &nbsp; → <span>전체피드</span> : <input type='text' name='wk' style='width:35px' value='<?php echo $sett[36]?>' /> &nbsp; → <span onmouseover='vwtip(this,30)'>rss&nbsp;본문길이</span>: <select name='d'><option value='0' <?php echo seltd('0',$sett[4])?>>본문전체</option><option value='1' <?php echo seltd('1',$sett[4])?>>128byte</option><option value='2' <?php echo seltd('2',$sett[4])?>>256byte</option><option value='3' <?php echo seltd('3',$sett[4])?>>512byte</option><option value='4' <?php echo seltd('4',$sett[4])?>>1024byte</option><option value='5' <?php echo seltd('5',$sett[4])?>>2048byte</option></select> &nbsp; → <span onmouseover='vwtip(this,31)'>rss&nbsp;html삭제</span>: <select name='wa'><option value='0' <?php echo seltd('0',$sett[27])?>>삭제 안 함</option><option value='1' <?php echo seltd('1',$sett[27])?>>삭제함</option></select><br />
<span class='r7'>16.</span> <span onmouseover='vwtip(this,22)'><b>태그</b> 나열갯수</span>: <input type='text' name='w' style='width:35px' value='<?php echo $sett[23]?>' />
&nbsp; <span onmouseover='vwtip(this,21)'>태그링크의 목록방식</span>: <select name='v'><option value='a' <?php echo seltd('a',$sett[22])?>>제목형</option><option value='b' <?php echo seltd('b',$sett[22])?>>본문형</option><option value='c' <?php echo seltd('c',$sett[22])?>>요약형</option></select>
&nbsp; <span onmouseover='vwtip(this,20)'>태그 스타일구분 횟수</span>: <input type='text' name='u' style='width:65px' value='<?php echo $sett[21]?>' /><br />
<span class='r7'>17.</span> <span onmouseover='vwtip(this,11)'><b>메일</b>발송 사용</span>: <select name='h'><?php echo degree($sett[8],4)?><option value='a' <?php echo seltd('a',$sett[8])?>>사용 안 함</option></select>
&nbsp; <span onmouseover='vwtip(this,12)'>메일발송 방법</span>: <select name='r'><option value='0' <?php echo seltd('0',$sett[15])?>>아웃룩 (자동발송X)</option><option value='1' <?php echo seltd('1',$sett[15])?>>팝업창 (자동발송O)</option></select>
<?php if($sett[15] == 1){?>&nbsp; <span onmouseover='vwtip(this,41)'>메일인증 사용여부</span>: <select name='wt'><option value='0' <?php echo seltd('0',$sett[46])?>>사용 안 함</option><option value='1' <?php echo seltd('1',$sett[46])?>>회원가입에만</option><option value='2' <?php echo seltd('2',$sett[46])?>>이메일변경에만</option><option value='3' <?php echo seltd('3',$sett[46])?>>모두사용함</option></select><?php }?><br />
<span class='r7'>18.</span> <span onmouseover='vwtip(this,19)'>방문내역 열람</span>: <select name='wv'><?php echo degree($sett[25],4)?></select><br />
<span class='r7'>19.</span> <span onmouseover='vwtip(this,49)'>NEW 표시기간</span>: <select name='xk'><option value='0' <?php echo seltd('0',$sett[62])?>>출력 안 함</option><option value='1' <?php echo seltd('1',$sett[62])?>>6시간</option><option value='2' <?php echo seltd('2',$sett[62])?>>12시간</option><option value='4' <?php echo seltd('4',$sett[62])?>>24시간</option><option value='8' <?php echo seltd('8',$sett[62])?>>2일</option><option value='12' <?php echo seltd('12',$sett[62])?>>3일</option><option value='28' <?php echo seltd('28',$sett[62])?>>7일</option></select>
&nbsp; <span onmouseover='vwtip(this,23)'>추천인 ip 보존기간</span>: <input type='text' name='wc' style='width:50px' value='<?php echo $sett[29]?>' /> 일<br />
<span class='r7'>20.</span> <span onmouseover='vwtip(this,32)'>상단 이름경로</span>: <select name='wp'><option value='0' <?php echo seltd('0',$sett[41])?>>표시 안 함</option><option value='1' <?php echo seltd('1',$sett[41])?>>경로빼고 게시판이름만</option><option value='2' <?php echo seltd('2',$sett[41])?>>그룹경로 뺌</option><option value='3' <?php echo seltd('3',$sett[41])?>>섹션경로 뺌</option><option value='4' <?php echo seltd('4',$sett[41])?>>게시판경로 뺌</option><option value='5' <?php echo seltd('5',$sett[41])?>>그룹경로만</option><option value='6' <?php echo seltd('6',$sett[41])?>>섹션경로만</option><option value='7' <?php echo seltd('7',$sett[41])?>>게시판경로만</option><option value='8' <?php echo seltd('8',$sett[41])?>>전부 표시함</option></select>
&nbsp; <span onmouseover='vwtip(this,43)'>회원로그 스킨</span>: <select name='wx'><?php echo $skinoption?></select><br />
<span class='r7'>21.</span> <span onmouseover='vwtip(this,18)'>검색목록 새창</span>: <select name='j'><option value='1' <?php echo seltd('1',$sett[10])?>>모두 새창으로</option><option value='2' <?php echo seltd('2',$sett[10])?>>게시판검색만 새창</option><option value='3' <?php echo seltd('3',$sett[10])?>>전체검색만 새창</option><option value='4' <?php echo seltd('4',$sett[10])?>>모두 그 창에서</option></select>
&nbsp; <span onmouseover='vwtip(this,26)'>블로그형목록배수</span>: <select name='s'><option value='1' <?php echo seltd('1',$sett[19])?>>1x</option><option value='2' <?php echo seltd('2',$sett[19])?>>2x</option><option value='3' <?php echo seltd('3',$sett[19])?>>3x</option><option value='4' <?php echo seltd('4',$sett[19])?>>4x</option><option value='5' <?php echo seltd('5',$sett[19])?>>5x</option><option value='6' <?php echo seltd('6',$sett[19])?>>6x</option><option value='7' <?php echo seltd('7',$sett[19])?>>7x</option><option value='8' <?php echo seltd('8',$sett[19])?>>8x</option><option value='9' <?php echo seltd('9',$sett[19])?>>9x</option><option value='10' <?php echo seltd('10',$sett[19])?>>10x</option><option value='11' <?php echo seltd('11',$sett[19])?>>11x</option><option value='12' <?php echo seltd('12',$sett[19])?>>12x</option><option value='13' <?php echo seltd('13',$sett[19])?>>13x</option><option value='14' <?php echo seltd('14',$sett[19])?>>14x</option><option value='15' <?php echo seltd('15',$sett[19])?>>15x</option><option value='16' <?php echo seltd('16',$sett[19])?>>16x</option><option value='17' <?php echo seltd('17',$sett[19])?>>17x</option><option value='18' <?php echo seltd('18',$sett[19])?>>18x</option><option value='19' <?php echo seltd('19',$sett[19])?>>19x</option><option value='20' <?php echo seltd('20',$sett[19])?>>20x</option></select><br />
<span class='r7'>22.</span> <span onmouseover='vwtip(this,25)'>글쓴이 팝업메뉴</span>:  <select name='ws'><option value='1' <?php echo seltd('1',$sett[44])?>>아이콘에 큰 이미지</option><option value='2' <?php echo seltd('2',$sett[44])?>>팝업에 큰 이미지</option><option value='3' <?php echo seltd('3',$sett[44])?>>둘 다 보임</option><option value='4' <?php echo seltd('4',$sett[44])?>>둘 다 안보임</option></select><br />
<span class='r7'>23.</span> <span onmouseover='vwtip(this,63)'>새로운 <span class='clr2'>덧글</span> 표시</span>:  <select name='vm'><?php echo degree($sett[89],6)?></select>
&nbsp; <span onmouseover='vwtip(this,39)'><span class='clr2'>덧글</span> 이미지URL 처리</span>: <select name='wq'><option value='0' <?php echo seltd('0',$sett[42])?>>이미지팝업 링크</option><option value='1' <?php echo seltd('1',$sett[42])?>>이미지 직접출력</option></select><br />
<span class='r7'>24.</span> <span onmouseover='vwtip(this,51)'><span class='clr2'>덧글</span> 목록갯수</span>:  <input type='text' name='xn' style='width:50px' value='<?php echo $sett[65]?>' /> 개
&nbsp; <span onmouseover='vwtip(this,52)'><span class='clr2'>덧글</span> 페이지 처리</span>:  <select name='xo'><option value='0' <?php echo seltd('0',$sett[66])?>>페이징 사용 안 함</option><option value='1' <?php echo seltd('1',$sett[66])?>>정확히 갯수로 자름</option><option value='2' <?php echo seltd('2',$sett[66])?>>하위 덧글 이어붙임</option></select><br />
<div class='bgc'><span class='r7'>25.</span> <span onmouseover='vwtip(this,40)'>썸네일 작성크기</span>:  &nbsp; → 가로 : <input type='text' name='wr1' style='width:35px' maxlength='4' value='<?php echo (int)substr($sett[43],0,4)?>' />px &nbsp; → 세로 : <input type='text' name='wr2' style='width:35px' maxlength='4' value='<?php echo (int)substr($sett[43],4,4)?>' />px<span onmouseover='vwtip(this,24)'> &nbsp; → 썸네일 화질 : </span><input type='text' name='wr3' style='width:25px' maxlength='3' value='<?php echo (int)substr($sett[43],8,3)?>' />% &nbsp; → 썸네일 원본비율 : <select name='wr4'><option value='0' <?php echo seltd('0',substr($sett[43],11,1))?>>여백줘서 원본비율로</option><option value='1' <?php echo seltd('1',substr($sett[43],11,1))?>>여백없이 꽉차게</option></select><br />
<span class='r7'>26.</span> <span onmouseover='vwtip(this,27)'>글쓰기 높이설정</span>: <input type='text' name='wg' style='width:100px' value='<?php echo $sett[33]?>' />px &nbsp; → <span onmouseover='vwtip(this,36)'>글쓰기 원격작성가능 회원레벨</span>:  <select name='xb'><option value='0' <?php echo seltd('0',$sett[54])?>>모두 불허</option><?php echo degree($sett[54],3)?></select><br />
<span class='r7'>27.</span> <span onmouseover='vwtip(this,45)'>글쓰기 시간간격</span>:  &nbsp; → 본문 : <input type='text' name='wy' style='width:35px' value='<?php echo $sett[49]?>' />분 &nbsp; → <span class='clr2'>덧글</span> : <input type='text' name='wz' style='width:35px' value='<?php echo $sett[50]?>' />분 &nbsp; → 제외 대상 : <select name='xa'><?php echo degree($sett[51],4)?></select><br />
<span class='r7'>28.</span> <span onmouseover='vwtip(this,61)'>게시물 길이제한</span>:  &nbsp; → 본문 : <input type='text' name='vi' style='width:35px' value='<?php echo $sett[85]?>' />KB &nbsp; → <span class='clr2'>덧글</span> : <input type='text' name='vj' style='width:35px' value='<?php echo $sett[86]?>' />KB &nbsp; → 제외 대상 : <select name='vk'><?php echo degree($sett[87],4)?></select><br />
<span class='r7'>29.</span> <span onmouseover='vwtip(this,59)'>스팸방지 코드</span>: <select name='wh'><option value='0' <?php echo seltd('0',$sett[82])?>>사용 안 함</option><option value='1' <?php echo seltd('1',$sett[82])?>>비회원 덧글</option><option value='2' <?php echo seltd('2',$sett[82])?>>비회원 덧글, 회원 덧글</option><option value='3' <?php echo seltd('3',$sett[82])?>>비회원 덧글+글쓰기</option><option value='4' <?php echo seltd('4',$sett[82])?>>비회원 덧글+글쓰기, 회원 덧글</option><option value='5' <?php echo seltd('5',$sett[82])?>>비회원 덧글+글쓰기, 회원 덧글+글쓰기</option></select><br />
<span class='r7'>30.</span> <span onmouseover='vwtip(this,28)'>임시파일 삭제</span>: <select name='wd'><option value='1'>1일뒤</option><option value='0.5'>12시간뒤</option><option value='0.25'>6시간뒤</option><option value='2'>2일뒤</option><option value='3'>3일뒤</option><option value='7'>7일뒤</option><option value='0'>삭제 안 함</option></select><br />
<span class='r7'>31.</span> <span onmouseover='vwtip(this,37)'>분산저장 단위</span>: <input type='text' name='g' style='width:100px' value='<?php echo $sett[7]?>' /><br />
<span class='r7'>32.</span> <span onmouseover='vwtip(this,9)'>파일 외부링크</span>: <select name='m'><option value='0' <?php echo seltd('0',$sett[13])?>>비허용</option><option value='1' <?php echo seltd('1',$sett[13])?>>허용</option></select>
&nbsp; <span onmouseover='vwtip(this,10)'>업로드 크기 제한</span>: <input type='checkbox' onclick="this.nextSibling.value=(this.checked)?'<?php echo $sett[9]?>':'0';this.nextSibling.style.display=(this.checked)?'':'none';" <?php echo rtchecked($sett[9])?> class='no' style='margin-right:5px' /><input type='text' name='i' value='<?php echo $sett[9]?>' />mb<br />
<span class='r7'>33.</span> <span>중복차단 설정</span>: <select name='f'><option value='0' <?php echo seltd('0',$sett[6])?>>덧글,새글 중복차단</option><option value='1' <?php echo seltd('1',$sett[6])?>>덧글 중복차단</option><option value='2' <?php echo seltd('2',$sett[6])?>>새글 중복차단</option><option value='3' <?php echo seltd('3',$sett[6])?>>중복차단 사용 안 함</option></select><br />
<span class='r7'>34.</span> <span onmouseover='vwtip(this,53)'>변경금지 설정: </span> &nbsp; → <span onmouseover='vwtip(this,54)'>수정삭제 버튼 출력여부</span>: <select name='xu'><option value='0' <?php echo seltd('0',$sett[72])?>>모두 출력 안 함</option><option value='1' <?php echo seltd('1',$sett[72])?>>덧글에만 출력</option><option value='2' <?php echo seltd('2',$sett[72])?>>본문에만 출력</option><option value='3' <?php echo seltd('3',$sett[72])?>>모두 출력함</option></select>
<br /><img src='icon/t.gif' style='width:10px;height:1px' alt='' />→ 본문수정 : <select name='vn'><option value='0' <?php echo seltd('0',$sett[71][0])?> onmouseover='vwtip(this,64)'>x</option><option value='1' <?php echo seltd('1',$sett[71][0])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][0])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][0])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][0])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][0])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][0])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][0])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][0])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][0])?>>2년</option></select> 지나면
<select name='vo' onchange='$("v711").value=this.options[this.selectedIndex].value'><option value='0' <?php echo seltd('0',$sett[71][1])?>>or</option><option value='1' <?php echo seltd('1',$sett[71][1])?>>and</option></select>
조회수 <select name='vp'><option value='0' <?php echo seltd('0',$sett[71][2])?> onmouseover='vwtip(this,65)'>x</option><option value='1' <?php echo seltd('1',$sett[71][2])?>>1</option><option value='2' <?php echo seltd('2',$sett[71][2])?>>5</option><option value='3' <?php echo seltd('3',$sett[71][2])?>>10</option><option value='4' <?php echo seltd('4',$sett[71][2])?>>50</option><option value='5' <?php echo seltd('5',$sett[71][2])?>>100</option><option value='6' <?php echo seltd('6',$sett[71][2])?>>500</option><option value='7' <?php echo seltd('7',$sett[71][2])?>>1000</option><option value='8' <?php echo seltd('8',$sett[71][2])?>>5000</option></select> 이상이면
<select id='v711' onchange='$$("vo",0).value=this.options[this.selectedIndex].value'><option value='0' <?php echo seltd('0',$sett[71][1])?>>or</option><option value='1' <?php echo seltd('1',$sett[71][1])?>>and</option></select>
덧글수 <select name='vq'><option value='0' <?php echo seltd('0',$sett[71][3])?> onmouseover='vwtip(this,65)'>x</option><option value='1' <?php echo seltd('1',$sett[71][3])?>>1</option><option value='2' <?php echo seltd('2',$sett[71][3])?>>5</option><option value='3' <?php echo seltd('3',$sett[71][3])?>>10</option><option value='4' <?php echo seltd('4',$sett[71][3])?>>50</option><option value='5' <?php echo seltd('5',$sett[71][3])?>>100</option><option value='6' <?php echo seltd('6',$sett[71][3])?>>500</option><option value='7' <?php echo seltd('7',$sett[71][3])?>>1000</option><option value='8' <?php echo seltd('8',$sett[71][3])?>>5000</option></select> 이상이면 금지
→ 제외 대상 : <select name='vr'><?php echo degree($sett[71][4],4)?></select>
<br /><img src='icon/t.gif' style='width:10px;height:1px' alt='' />→ 본문삭제 : <select name='vs'><option value='0' <?php echo seltd('0',$sett[71][5])?> onmouseover='vwtip(this,64)'>x</option><option value='1' <?php echo seltd('1',$sett[71][5])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][5])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][5])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][5])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][5])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][5])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][5])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][5])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][5])?>>2년</option></select> 지나면
<select name='vt' onchange='$("v716").value=this.options[this.selectedIndex].value'><option value='0' <?php echo seltd('0',$sett[71][6])?>>or</option><option value='1' <?php echo seltd('1',$sett[71][6])?>>and</option></select>
조회수 <select name='vu'><option value='0' <?php echo seltd('0',$sett[71][7])?> onmouseover='vwtip(this,65)'>x</option><option value='1' <?php echo seltd('1',$sett[71][7])?>>1</option><option value='2' <?php echo seltd('2',$sett[71][7])?>>5</option><option value='3' <?php echo seltd('3',$sett[71][7])?>>10</option><option value='4' <?php echo seltd('4',$sett[71][7])?>>50</option><option value='5' <?php echo seltd('5',$sett[71][7])?>>100</option><option value='6' <?php echo seltd('6',$sett[71][7])?>>500</option><option value='7' <?php echo seltd('7',$sett[71][7])?>>1000</option><option value='8' <?php echo seltd('8',$sett[71][7])?>>5000</option></select> 이상이면
<select id='v716' onchange='$$("vt",0).value=this.options[this.selectedIndex].value'><option value='0' <?php echo seltd('0',$sett[71][6])?>>or</option><option value='1' <?php echo seltd('1',$sett[71][6])?>>and</option></select>
덧글수 <select name='vv'><option value='0' <?php echo seltd('0',$sett[71][8])?> onmouseover='vwtip(this,65)'>x</option><option value='1' <?php echo seltd('1',$sett[71][8])?>>1</option><option value='2' <?php echo seltd('2',$sett[71][8])?>>5</option><option value='3' <?php echo seltd('3',$sett[71][8])?>>10</option><option value='4' <?php echo seltd('4',$sett[71][8])?>>50</option><option value='5' <?php echo seltd('5',$sett[71][8])?>>100</option><option value='6' <?php echo seltd('6',$sett[71][8])?>>500</option><option value='7' <?php echo seltd('7',$sett[71][8])?>>1000</option><option value='8' <?php echo seltd('8',$sett[71][8])?>>5000</option></select> 이상이면 금지
→ 제외 대상 : <select name='vw'><?php echo degree($sett[71][9],4)?></select>
<br /><img src='icon/t.gif' style='width:10px;height:1px' alt='' />→ 덧글수정 : <select name='vx'><option value='0' <?php echo seltd('0',$sett[71][10])?> onmouseover='vwtip(this,64)'>x</option><option value='1' <?php echo seltd('1',$sett[71][10])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][10])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][10])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][10])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][10])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][10])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][10])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][10])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][10])?>>2년</option></select> 지나면
<select name='vy'><option value='0' <?php echo seltd('0',$sett[71][11])?>></option><option value='1' <?php echo seltd('1',$sett[71][11])?>>or 덧글 있으면</option><option value='2' <?php echo seltd('2',$sett[71][11])?>>and 덧글 있으면</option></select> 금지
&nbsp; → 제외 대상 : <select name='vz'><?php echo degree($sett[71][12],4)?></select>
<br /><img src='icon/t.gif' style='width:10px;height:1px' alt='' />→ 덧글삭제 : <select name='ua'><option value='0' <?php echo seltd('0',$sett[71][13])?> onmouseover='vwtip(this,64)'>x</option><option value='1' <?php echo seltd('1',$sett[71][13])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][13])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][13])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][13])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][13])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][13])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][13])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][13])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][13])?>>2년</option></select> 지나면
<select name='ub'><option value='0' <?php echo seltd('0',$sett[71][14])?>></option><option value='1' <?php echo seltd('1',$sett[71][14])?>>or 덧글 있으면</option><option value='2' <?php echo seltd('2',$sett[71][14])?>>and 덧글 있으면</option></select> 금지
&nbsp; → 제외 대상 : <select name='uc'><?php echo degree($sett[71][15],4)?></select>
<br /><span class='r7'>35.</span> <span onmouseover='vwtip(this,66)'>시간 경과후 차단: </span>&nbsp; → <label>관리자는 제외<input type='radio' value='0' name='ud' <?php if(!$sett[71][16]) echo "checked='checked'";?> class='no' /></label>&nbsp;<label>관리자도 차단<input type='radio' value='1' name='ud' <?php if(!!$sett[71][16]) echo "checked='checked'";?>  class='no' /></label>
<br /><img src='icon/t.gif' style='width:125px;height:1px' alt='' /><span onmouseover='vwtip(this,67)'>→ 추천비추 차단 : </span><select name='ue'><option value='0' <?php echo seltd('0',$sett[71][17])?>>사용 안 함</option><option value='1' <?php echo seltd('1',$sett[71][17])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][17])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][17])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][17])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][17])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][17])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][17])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][17])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][17])?>>2년</option></select> 지나면 차단
<br /><img src='icon/t.gif' style='width:125px;height:1px' alt='' /><span onmouseover='vwtip(this,68)'>→ 조회수 + 차단 : </span><select name='uf'><option value='0' <?php echo seltd('0',$sett[71][18])?>>사용 안 함</option><option value='1' <?php echo seltd('1',$sett[71][18])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][18])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][18])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][18])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][18])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][18])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][18])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][18])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][18])?>>2년</option></select> 지나면 차단
<br /><img src='icon/t.gif' style='width:125px;height:1px' alt='' /><span onmouseover='vwtip(this,69)'>→ 덧글쓰기 차단 : </span><select name='ug'><option value='0' <?php echo seltd('0',$sett[71][19])?>>사용 안 함</option><option value='1' <?php echo seltd('1',$sett[71][19])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][19])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][19])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][19])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][19])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][19])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][19])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][19])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][19])?>>2년</option></select> 지나면 차단
<br /><img src='icon/t.gif' style='width:125px;height:1px' alt='' /><span onmouseover='vwtip(this,70)'>→ 답글쓰기 차단 : </span><select name='uh'><option value='0' <?php echo seltd('0',$sett[71][20])?>>사용 안 함</option><option value='1' <?php echo seltd('1',$sett[71][20])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][20])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][20])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][20])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][20])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][20])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][20])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][20])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][20])?>>2년</option></select> 지나면 차단
<br /><img src='icon/t.gif' style='width:125px;height:1px' alt='' /><span onmouseover='vwtip(this,71)'>→ 엮인글  &nbsp; 차단 : </span><select name='ui'><option value='0' <?php echo seltd('0',$sett[71][21])?>>사용 안 함</option><option value='1' <?php echo seltd('1',$sett[71][21])?>>1시간</option><option value='2' <?php echo seltd('2',$sett[71][21])?>>3시간</option><option value='3' <?php echo seltd('3',$sett[71][21])?>>9시간</option><option value='4' <?php echo seltd('4',$sett[71][21])?>>24시간</option><option value='5' <?php echo seltd('5',$sett[71][21])?>>5일</option><option value='6' <?php echo seltd('6',$sett[71][21])?>>20일</option><option value='7' <?php echo seltd('7',$sett[71][21])?>>3달</option><option value='8' <?php echo seltd('8',$sett[71][21])?>>1년</option><option value='9' <?php echo seltd('9',$sett[71][21])?>>2년</option></select> 지나면 차단
<br /><span class='r7'>36.</span> <span onmouseover='vwtip(this,74)'>수정시간을 작성시간으로 변경: </span><select name='ur'><option value='0' <?php echo seltd('0',$sett[92][1])?>>변경 안 함</option><option value='1' <?php echo seltd('1',$sett[92][1])?>>덧글만</option><option value='2' <?php echo seltd('2',$sett[92][1])?>>본문만</option><option value='3' <?php echo seltd('3',$sett[92][1])?>>모두 변경</option></select>
</div><span class='r7'>37.</span> <span onmouseover='vwtip(this,33)'>IP 접속차단목록</span>:  <textarea name='ban' rows='1' cols='1' style='width:120px;height:40px;overflow:auto'><?php if($fp=@fopen($dxr."ban","r")) {echo @fread($fp,filesize($dxr."ban"));fclose($fp);}?></textarea>차단할 IP를 한 줄에 하나씩. 숫자 대신 와일드카드 * 를 사용할수 있습니다.<br />
<span class='r7'>38.</span> <span onmouseover='vwtip(this,33)'>IP 쓰기차단목록</span>:  <textarea name='ban2' rows='1' cols='1' style='width:120px;height:40px;overflow:auto'><?php if($fp=@fopen($dxr."ban2","r")) {echo @fread($fp,filesize($dxr."ban2"));fclose($fp);}?></textarea>차단할 IP를 한 줄에 하나씩. 숫자 대신 와일드카드 * 를 사용할수 있습니다.<br />
<span class='r7'>39.</span> <span onmouseover='vwtip(this,44)'>금지단어 설정</span>:  <textarea name='prohibit' rows='1' cols='1' style='width:120px;height:40px;overflow:auto'><?php if($fp=@fopen($dxr."prohibit","r")) {echo @fread($fp,filesize($dxr."prohibit"));fclose($fp);}?></textarea>금지할 단어를 한 줄에 하나씩<br />
<span class='r7'>40.</span> <span onmouseover='vwtip(this,59)'>게시물 신고설정</span>: &nbsp; → 신고권한 : <select name='ve'><?php echo degree($sett[79],4)?></select>&nbsp; → 신고수 <input type='text' name='vf' style='width:30px' value='<?php echo $sett[80]?>' /> 이상이면 게시물 잠금&nbsp; → 신고수 계산 <select name='vg'><option value='1' <?php echo seltd('1',$sett[81])?>>모두 1</option><option value='4' <?php echo seltd('4',$sett[81])?>>(회원레벨/4)+1</option><option value='3' <?php echo seltd('3',$sett[81])?>>(회원레벨/3)+1</option><option value='2' <?php echo seltd('2',$sett[81])?>>(회원레벨/2)+1</option></select><br />
<span class='r7'>41.</span> <span onmouseover='vwtip(this,56)'>게시판 잠금설정</span>:  <input type='checkbox' onclick="this.nextSibling.value=(this.checked)?'1':'0';" <?php echo rtchecked($sett[73])?> class='no' /><input type='hidden' name='xv' value='<?php echo $sett[73]?>' /><br />
<span class='r7'>42.</span> <span onmouseover='vwtip(this,60)'>접속자수 파악</span>:  <input type='checkbox' onclick="this.nextSibling.value=(this.checked)?'1':'0';" <?php echo rtchecked($sett[84])?> class='no' /><input type='hidden' name='vh' value='<?php echo $sett[84]?>' /><br />
<span class='r7'>43.</span> <span onmouseover='vwtip(this,50)'>첨부파일 확장자</span>:  <input type='text' name='xm' style='width:500px' value='<?php echo $sett[64]?>' />확장자 간의 구분은 |로<br />
<span class='r7'>44.</span> <span onmouseover='vwtip(this,34)'>게시판 데이타 다른곳으로 가져가기 사용 </span><input type='hidden' name='wl' value='<?php echo $sett[37]?>' /><input type='checkbox' onclick="this.previousSibling.value=(this.previousSibling.value == '1')? '0':'1'" <?php echo rtchecked($sett[37])?> class='no' /> &nbsp; <input type='button' value=' 게시판 가져오기 ' onclick="popup('?bkipt=1',400,375)" class='button' style='width:100px' onmouseover='vwtip(this,35)' /><br />
<span class='r7'>45.</span> <span onmouseover='vwtip(this,72)'>서버처리 시간 출력 : </span><select name='uo'><option value='0' <?php echo seltd('0',$sett[92][0])?>>출력 안 함</option><option value='1' <?php echo seltd('1',$sett[92][0])?>>좌우메뉴만</option><option value='2' <?php echo seltd('2',$sett[92][0])?>>대문위젯만</option><option value='3' <?php echo seltd('3',$sett[92][0])?>>모두 출력</option></select><br />
<input type='button' value='설문조사작성' class='button' style='width:150px' onclick="popup('include/poll.php?make=1',640,480)" />
&nbsp; <input type='button' value='설문조사목록' class='button' style='width:150px' onclick="popup('include/poll.php?page=1',640,480)" />
&nbsp; <input type='button' value='스타일정의 추가' class='button' onmouseover='vwtip(this,38)' style='width:150px' onclick="popup('?fm=icon/style.css', 800, 400)" /><br />

<input type='submit' value=' 적용 ' class='button' style='width:490px;height:25px' /><input type='button' value=' uninstall ' class='button' style='width:100px;height:20px;margin-left:100px' onclick="if(confirm('srboard를 언인스톨하시겠습니까')) window.open('?bd_uninstall=<?php echo $mbr_id?>');" />
</form>
<script type="text/javascript">
//<![CDATA[
function vwtip(ths,i) {
var ttitle = Array("즐겨찾기 파비콘 (16*16) 존재여부/사용여부",
"게시판에 외부파일 인클루드 위쪽 / 아래쪽 / css파일",
"본문에 보여질 그림의 최대 넓이\n 자동 리사이즈될 크기 (단위는 px, 값은 숫자만)",
"게시판의 전체 넓이\n좌우메뉴 포함해서 (단위는 선택, 값은 숫자만)",
"목록/대문에 덧글 표시 넓이 default:24\n  (단위는 px, 값은 숫자만)",
"vwtip(this,5)",
"게시판 위쪽에 출력할 내용 추가",
"게시판 아래쪽에 출력할 내용 추가",
"상/하단 내용추가 파일의 게시판 삽입방식",
"게시판 업로드 파일 외부링크 허용/ 비허용",
"게시판 업로드 파일 크기 제한,\n 값은 mb단위로 (정수,분수,소수)로 적으세요.\n 값이 0이면, 업로드 크기 제한을 안합니다.",
"메일 발송 회원레벨제한\n 또는 메일 발송 사용 안 함",
"메일 발송 방법 :\n 아웃룩링크 (자동발송사용불가) \n 팝업창 (서버가 지원해줘야함 / 자동발송기능 사용가)",
"회원가입할 때 동의해야 하는 이용약관",
"대문에서 사용할 게시판스킨 선택",
"대문 table의 cellspacing,디폴트 10,단위는 px입니다. 숫자만 적으세요",
"섹션에 게시판이 하나일 때,대문 출력 또는 게시판 직행 선택",
"대문출력없이 게시판으로 직행합니다",
"게시판검색과 전체검색, 검색된 게시물이 열리는 창",
"방문내역을 열람할 수 있는 회원레벨",
"검색횟수순으로 태그모양 달리하는데, 그때 모양 달리할 검색횟수단위",
"태그 클릭했을 때, 태그 검색목록 출력방식",
"목록 하나에 나열할 태그 갯수",
"대문캐시 갱신주기 (갱신조건에 시간주기가 포함된 경우)",
"썸네일 작성할 때의 화질설정,\n 화질을 올리면 이미지 파일용량이 커집니다.\n (권장값 80 ~ 100)",
"회원의 자기사진을 이름앞에\n 작은 아이콘 마우스오버에서\n 큰 이미지로 띄울 것인지 또는,\n 팝업메뉴에 띄울 것인지 선택 ",
"블로그형의 본문형 목록이 제목형으로 바뀔때 목록수에 곱할 값",
"글쓰기 편집창 높이",
"글쓰기 임시저장파일 삭제시간",
"회원 출석부를 열람할수 있는 회원레벨",
"rss피드 본문 출력하는 길이",
"rss피드 본문에 html태그 삭제여부",
"게시판 상단에 게시판이름 / 경로 출력여부와 경로표시 제외사항 선택",
"아이피 차단 목록편집 (와일드카드 * 사용가)",
"보안위험이 있을수 있으니까, 가져가기 직전에 열어두세요",
"다른 곳의 srboard 게시판을 게시판 가져오기",
"글쓰기 원격작성 허용할 회원레벨",
"게시판 데이타파일 분산 저장하는 (게시물 갯수의) 단위",
"손쉽게 추가하는 스타일 정의,\n 레이아웃이나 게시판의 스타일정의와 상충하는 경우에도\n 최우선적으로 적용됩니다.",
"덧글 본문에 URL주소 끝에 확장자가 이미지파일인 경우에,\n 덧글 저장할 때 자동처리방법 선택",
"썸네일 작성할 때 썸네일이미지의 가로x세로 크기설정",
"회원가입시, 이메일주소변경시, 메일인증 사용여부",
"게시판목록에서 본문미리보기 가로넓이 설정",
"회원로그의 게시물 본문스킨",
"제목, 본문, 덧글에 사용할 수 없는 금지어를 한 줄에 하나씩 지정합니다.",
"도배방지를 위한 본문,덧글 글쓰기의 시간간격 제한,\n 단위는 분(60초)\n 그리고 시간간격 제한을 적용받지 않는 회원레벨 설정",
"상단 내용추가를 출력할 위치 선정",
"하단 내용추가를 출력할 위치 선정",
"대문에서 탭형목록 회전 주기와\n 뉴스형목록 회전 주기 (단위는 초)",
"NEW 표시 여부 또는 시간 선택",
"게시판관리/업로드경로가 경로노출일 때,\n 첨부 허용할 확장자",
"덧글 페이징할 덧글 갯수의 단위 ",
"덧글 페이징 사용여부\n 페이징 갯수로 정확히 나눔 \n덧글의 덧글은 갯수와 무관하게 이어붙임 ",
"변경금지 설정한 경우,\n 본문/덧글 작성후에 이 시간이 지나면\n 변경금지가 발효됩니다.\n (설정여부는 게시판관리에서) ",
"변경금지가 발효될 때,\n 수정/삭제 버튼의 출력여부를 설정합니다. ",
"vwtip(this,55)",
"게시판 업데이트 등의 경우에,\n 오류방지를 위해 게시판 접속을 차단합니다.",
"대문캐시 사용여부와 갱신조건",
"좌우메뉴와 게시판사이의 간격설정 (단위 px)",
"스팸방지코드 사용여부와 조건설정",
"좌우메뉴 접속자수 출력할 게시판 전체의 접속자수 파악여부",
"게시물 글쓰기 길이 제한 설정. 단위는 KB. 0 으로 설정하면 사용 안 함",
"게시판 최소 넓이, 단위는 px, 0으로 설정하면 사용 안 함",
"게시판 본문에서 새로운 덧글 표시 여부와 권한 제한 설정",
"경과 시간으로 금지하지 않음",
"숫자로 금지하지 않음",
"본문 쓰여진 시간을 기준으로 선택한 시간 경과 이후엔 차단합니다.",
"선택한 시간 경과 이후엔 추천, 비추, 평점을 차단합니다.",
"선택한 시간 경과 이후엔 조회수 증가를 차단합니다.",
"선택한 시간 경과 이후엔 덧글 쓰기를 차단합니다.",
"선택한 시간 경과 이후엔 답글 쓰기를 차단합니다.",
"선택한 시간 경과 이후엔 엮인글 - 수신된 트랙백을 차단합니다.",
"소스보기에 서버처리시간 출력 여부 - 관리자에게만 뜹니다 -",
"브라우저 넓이가 이 값보다 작거나, 작아지면 리사이즈됩니다.",
"본문,덧글 수정할 때 작성시간을 수정시간으로 변경할 지 여부와 대상을 설정",
"리사이즈 사용 여부와 조건 선택");
if(ttitle[i]) {
if(ths.innerHTML) ttitle[i] = ths.innerHTML +" ::\n " +ttitle[i];
else if(ths.value) ttitle[i] = ths.value +" ::\n " +ttitle[i];
$('admtip').innerHTML = ttitle[i];
}}
function ckalert(ths) {
if(ths.name == 'vc') $$('vl',0).parentNode.style.visibility = (ths.value == '1')?'visible':'hidden';
}
$$('a',0).value = '<?php echo $sett[1]?>';
$$('wx',0).value = '<?php echo $sett[48]?>';
document.title = "전체설정";
setTimeout("$$('vl',0).parentNode.style.visibility = ($$('vc',0).value == '0')? 'hidden':'visible'",1000);
//]]>
</script>
</td></tr>
</table>
<?php
}
?>
<form method='post' action='?' style='padding:10px;margin:0;float:left'><input type='hidden' name='from' value='index.php' /><input type='hidden' name='logout' value='1' /><input type='submit' value='LOGOUT' class='button' style='width:100px' /></form>
<div style='padding:10px;float:right'>현재버전 <b title='2015-02-13'><?php echo $srboard?></b>&nbsp;&nbsp;(최신버전 <iframe src="http://sariputra.oranc.co.kr/latest4050.html" width="100px" height="15px" frameborder="0"></iframe>)</div>
</td></tr></table>
<?php
}
?>