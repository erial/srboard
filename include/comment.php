<iframe name="rexe" style="display:none;width:0;height:0" src=""></iframe>
<?php
if($_POST['time']) {echo $_POST['time'] - time();exit;}
$comment = ($_GET['comment'])? $_GET['comment']:$_GET['rp_view'];
if($wdth[6]) {
for($aa = 1; $aa <= $wdth[6]; $aa++) {
if($comment <= (int)substr($do[$aa], 0 ,6)) {$xx = $aa;break;}
}}
if($xx > 0) $idd = $id."/^".$xx;
else $idd = $id;
$no6 = str_pad($comment,6,0,STR_PAD_LEFT);
$fn = fopen($dxr.$idd."/no.dat","r");
$fl = fopen($dxr.$idd."/list.dat","r");
while(!feof($fn)){
$xxx= fgets($fn);
if($no6 == substr($xxx, 0, 6)) {
if(substr($xxx,6,2) == 'aa' && $mbr_level != 9) $deleted = 1;
else if(!$wdth[9][11]) {
$xxe = explode("\x1b",$xxx);if($xxxx = $xxe[3]) {
if($wdth[9][12] && $xxxx[0] && $sss[25] != 'a' && $sss[25] < $xxxx[0]) $sss[25] = $xxxx[0];
if($wdth[9][13] && $xxxx[1] && $wdth[5][0] != 'a' && $wdth[5][0] < $xxxx[1]) $wdth[5][0] = $xxxx[1];
}}
$dctime = $time - substr(fgets($fl),0,10);
break;
}
fgets($fl);
}
fclose($fn);
fclose($fl);
if($s7116 === 1) {
if($dctime > $cuttime[$sett[71][17]]) {$vtrpc[0] = 1;$memb .= "vtrpc[0] = 3;\n";}
if($dctime > $cuttime[$sett[71][19]]) {$vtrpc[1] = 1;$memb .= "vtrpc[1] = 3;\n";}
if($dctime > $cuttime[$sett[71][21]]) $vtrpc[2] = 1;
}
if($deleted == 1) exit;
$crp = explode("\x1b", $xxx);
$mn = substr($crp[0], 9);
if(false !== strpos("^".$wdth[4],"^".$comment."^")) {if($wdth[7][8] <= $mbr_level) $notice = 1;else $notice = 2;}
if($sss[23] != 'a' && !$mn && $_COOKIE["scrt_".$comment.$id] == md5($comment."_".$sessid.$id)) $scrt = 1;else $scrt = 0;
if($notice == 2 || ($notice != 1 && $authority_read && !$scrt && ($sss[23] == 'a' || !$mn || $mn != $mbr_no))) exit;
$addrpvalue = "var rpvalue = Array();\n";
if($xxx[8] <= $mbr_level || ($mn && $mn == $mbr_no) || $scrt) {
if($wdth[5][0] == 'a' || $wdth[5][0] > $mbr_level){$crp[2] = 0;$crp[3] = 0;$crp[4] = 0;}
$srkin = str_replace("<#pno#>",$comment,$srkin);
if($crp[4] !== 'a' && $sss[49] == '1' && !$vtrpc[2]) $srkiin = str_replace("<#nReply#>",(int)$crp[2],tagcut('rp',$srkin));
else $srkiin = '<img src="icon/t.gif" alt="" style="height:10px" />';
$ism3 = (!$mn)? 3:(($mn == $mbr_no || $mbr_level == 9)? 4:2);
$sr_rpv = tagcut('rpv',$srkin);
if($crp[3] >= 1){
// 엮은글 출력
$fr = fopen($dxr.$id."/stb.dat","r");
$cc = 1;
while(!feof($fr)){
$comt = fgets($fr);
if(substr($comt, 0, 6) == $no6) {
	$rdata = explode("\x1b", $comt);
$sr_rp = str_replace("<#cid#>","crp3_".$crp[3],$sr_rpv);
$sr_rp = str_replace("<#name#>","<b class='nick'>엮은글</b>",$sr_rp);
$sr_rp = str_replace("<#tname#>","<b class='nick'>엮은글</b>",$sr_rp);
$sr_rp = str_replace("<#isipr#>","<;>",$sr_rp);
$sr_rp = str_replace("<#isrrpx#>","<;>",$sr_rp);
$sr_rp = str_replace("<#istrrpx#>","<!--/-->",$sr_rp);
$sr_rp = str_replace("<#bdo#>","<a target='_blank' href='{$rdata[1]}'>{$rdata[1]}</a>",$sr_rp);
$sr_rp = str_replace("<#rdymd#>",date("Y-m-d", $rdata[3]),$sr_rp);
$sr_rp = str_replace("<#rdhis#>",date("H:i:s", $rdata[3]),$sr_rp);
$sr_rp = str_replace("<#rdlnk#>","rfpass('del_stb','{$ism3}','{$cc}')",$sr_rp);
$sr_rp = str_replace("<#isrmlnk#>","<;>",$sr_rp);
$sr_rp = str_replace("<#isrrlnk#>","<;>",$sr_rp);
$sr_rp = str_replace("<#x_appr#>","<;>",$sr_rp);
$sr_rp = str_replace("<#x_oppo#>","<;>",$sr_rp);
$srkiin .= $sr_rp;
$crp[3]--;
}
if($crp[3] == 0) break;
$cc++;
}
fclose($fr);
$rtitle = "";
}
if($crp[4] >= 1){
// 엮인글 출력
$fr = fopen($dxr.$id."/rtb.dat","r");
$cc = 1;
while(!feof($fr)){
$comt = fgets($fr);
if(substr($comt, 0, 6) == $no6) {
	$rdata = explode("\x1b", $comt);
$sr_rp = str_replace("<#cid#>","crp4_".$crp[4],$sr_rpv);
$sr_rp = str_replace("<#name#>","<b class='nick'>엮인글</b>",$sr_rp);
$sr_rp = str_replace("<#tname#>","<b class='nick'>엮인글</b>",$sr_rp);
$sr_rp = str_replace("<#isipr#>","<;>",$sr_rp);
$sr_rp = str_replace("<#isrrpx#>","<;>",$sr_rp);
$sr_rp = str_replace("<#istrrpx#>","<!--/-->",$sr_rp);
$sr_rp = str_replace("<#ipr#>",$rdata[6],$sr_rp);
$sr_rp = str_replace("<#bdo#>","<a target='_blank' href='{$rdata[2]}'>[{$rdata[1]}] {$rdata[3]}</a><br>{$rdata[4]}",$sr_rp);
$sr_rp = str_replace("<#rdymd#>",date("Y-m-d", $rdata[5]),$sr_rp);
$sr_rp = str_replace("<#rdhis#>",date("H:i:s", $rdata[5]),$sr_rp);
$sr_rp = str_replace("<#rdlnk#>","rfpass('del_rtb','{$ism3}','{$cc}')",$sr_rp);
$sr_rp = str_replace("<#isrmlnk#>","<;>",$sr_rp);
$sr_rp = str_replace("<#isrrlnk#>","<;>",$sr_rp);
$sr_rp = str_replace("<#x_appr#>","<;>",$sr_rp);
$sr_rp = str_replace("<#x_oppo#>","<;>",$sr_rp);
$srkiin .= $sr_rp;
$crp[4]--;
}
if($crp[4] == 0) break;
$cc++;
}
fclose($fr);
}
$cc = $crp[2];
$rps = $crp[2];
if($crp[2] >= 1){
// 코멘트 출력
$cmt = '';
$cmm = ',';
if($crp[2] > $sett[65] && $sett[66] > 0) {
$pend = (int)(($crp[2] -1)/$sett[65]) + 1;
if($_GET['page'] == 1) {
$fstt = 0;
$fend = $crp[2] % $sett[65];
if($fend === 0) $fend = $sett[65];
} else {
if(!$_GET['page']) $_GET['page'] = $pend;
$fstt = $crp[2] - $sett[65]*($pend -$_GET['page'] +1);
$fend = $sett[65] + $fstt;
}} else {
$fstt = 0;
$fend = $crp[2];
}
$c = 1;
$appo = ($vtrpc[0] && ($sett[72] == '0' || $sett[72] == '2'))? 1:0;
if(!$csff[1][0] || $appo === 1) $sr_rpv = str_replace("<#x_appr#>","<;>",$sr_rpv);
if(!$csff[1][1] || $appo === 1) $sr_rpv = str_replace("<#x_oppo#>","<;>",$sr_rpv);
if($mbr_level < $wdth[9][0]) $isrvt = 0;else $isrvt = 1;
$fr = fopen($dxr.$idd."/rlist.dat","r");
for($i = 1;$comt = fgets($fr);$i++) {
if(substr($comt, 0, 6) == $no6) {
if($c > $fstt) {
if($sett[66] == 2 && $c > $fend && substr($comt,13,1) != '1') $fend++;
if($c <= $fend) {
$cmt[$i] = $comt;
$com5 = substr($comt, 24, 5).",";
if(strpos($cmm, $com5) === false) $cmm .= $com5;
} else break;
}
$c++;
}
}
fclose($fr);
if($cmm != ',') {
$fmm = array();
$fim = fopen($dim,"r");
while($fm = fgets($fim)) {
$fmo = substr($fm,0,5);
if(strpos($cmm,$fmo.",")) {
$fmm[(int)$fmo] = explode("\x1b",$fm);
}
}
fclose($fim);
if($sett[83] && $mbr_no && $mn != $mbr_no && strpos($cmm,$mbr_no.",")) notiff($mbr_no,0,$id10.$no6,0);
}
$fb = fopen($dxr.$idd."/rbody.dat","r");
$d = 1;
$ucp = 1;$upc = 1;$cpu = array(0,0,0,0,0,0,0,0,0,0);
for($j = 1;$j <= $i;$j++) {
if($d <= $fend) {
if($comt = $cmt[$j]) {
$d++;
$cbody = fgets($fb);
$comtm = explode("\x1b",trim(substr($comt, 29)));
$cdate = substr($comt, 14, 10);
$sr_rp = str_replace("<#cid#>","crp2_".$crp[2],$sr_rpv);
$mm = (int)substr($comt, 24, 5);
if($mm) $homepage = $fmm[$mm][10];
$ipr = trim(substr($cbody, 0, 15));
if($ipr && (!$mm || $sss[44] < 3) && ($mbr_level == 9 || ($sss[44] != 2 && $sss[44] != 9 && ($mbr_level || $sss[44] == 0 || $sss[44] == 7)))) $sr_rp = str_replace("<#ipr#>",$ipr,$sr_rp);
else $sr_rp = str_replace("<#isipr#>","<;>",$sr_rp);
$cup = substr($comt, 13, 1);
if($cup > $upc) $upc = $cup;
if($cup < $ucp) {for($u = $upc;$u >= $cup;$u--) {$cpu[$u] = 0;}$upc = $cup;}
$cpu[$cup] = ($mm)? 0:1;
$cc = substr($comt, 6, 7);
if($cup == 1) {
$sr_rp = str_replace("<#isrrpx#>","<;>",$sr_rp);
$sr_rp = str_replace("<#istrrpx#>","<!--/-->",$sr_rp);
} else {
$sr_rp = str_replace("<#istrrpx#>","<;>",$sr_rp);
$sr_rp = str_replace("<#rrpmg#>"," style='margin:4px 0 4px ".(30 * ($cup -1))."px'",$sr_rp);
}
$cb25 = 0;
$bdo = substr($cbody, 25, -1);
if(!$mm && $bdo[0] == "\x18") {$http = strpos($bdo,"\x1b");$homepage = substr($bdo,1,$http -1);$bdo = substr($bdo,$http + 1);}
if($bdo[0] == "\x1b") {
if($mbr_level != 9 && (!$mm || $mm != $mbr_no) && (!$mn || $mn != $mbr_no) && $_COOKIE["scrt_".$cc.$id] != md5($cc."_".$sessid.$id) && $_COOKIE["scrt_".$comment.$id] != md5($comment."_".$sessid.$id)) {
if($cpu[$cup-1] == 1 || !$mm || !$mn) $bdo = "<div class='dv_pass'><div>비밀글입니다</div><input type='text' class='txet' /><input type='button' class='srbt' name='{$cc}_{$cup}' onclick='frpass(this)' value='잠금 해제' /></div>";
else $bdo = "<u>비밀글입니다</u>";
} else $bdo = substr($bdo, 1);
$cb25 = 1;
}
if(($sett[6] == 0 || $sett[6] == 1) && ($mbr_no && $mm == $mbr_no) || (!$mbr_no && $ipr == $_SERVER['REMOTE_ADDR'])) $xdouble = $bdo;
if($_GET['search'] == 'r') $bdo = skword($bdo);
$bdo = "<div id='bdo{$cc}' class='bdo'>{$bdo}</div>";
if(!$sss[64] && $mm && file_exists("icon/m80_".$mm)) $sr_rp = str_replace("<#m12#>","<img src='icon/m80_{$mm}' class='m12' alt='' />",$sr_rp);
$sr_rp = str_replace("<#rdymd#>",date("Y-m-d", $cdate),$sr_rp);
$sr_rp = str_replace("<#rdhis#>",date("H:i:s",$cdate),$sr_rp);
$nseven = ($cup < (int)@substr($cmt[($j + 1)], 13, 1))? 3:2;
$iseven = ckmdfx(1,3,$nseven,$comt);
$sr_rp = imn($mm,$iseven,$sr_rp,$crp[2],0,0);
if($cup < 9 && $sss[25] !== 'a' && $sss[25] <= $mbr_level) {
$sr_rp = str_replace("<#rrlnk#>","rrp({$crp[2]})",$sr_rp);
$sr_rp = str_replace("<#rrdiv#>","<div id='rpp_{$cc}' class='rrpw'></div>",$sr_rp);
} else {
$sr_rp = str_replace("<#isrrlnk#>","<;>",$sr_rp);
}
$ccd = "<a name='c{$cc}'>&nbsp;</a>";
$sr_rp = str_replace("<#name#>",name($comtm[0], $mm, 1, 1, $homepage).$ccd,$sr_rp);
$sr_rp = str_replace("<#tname#>",name($comtm[0], $mm, 1, 0, $homepage).$ccd,$sr_rp);
if($isrvt && $uzname != trim($comtm[0]) && (!$mm || $mm != $mbr_no)) $isrvtt = 1;else $isrvtt = 0;
$addrpvalue .= "rpvalue[{$crp[2]}] = Array('{$cc}','{$cb25}','{$homepage}',{$cup},{$isrvtt});\n";
if($csff[1][0]) {$sr_rp = str_replace("<#nAppr#>",(int)$comtm[1],$sr_rp);$sr_rp = str_replace("<#vtApp#>","rvote({$crp[2]},1)",$sr_rp);}
if($csff[1][1]) {$sr_rp = str_replace("<#nOppo#>",(int)$comtm[2],$sr_rp);$sr_rp = str_replace("<#vtOpp#>","rvote({$crp[2]},2)",$sr_rp);}
$sr_rp = str_replace("<#bdo#>",$bdo,$sr_rp);
$srkiin .= $sr_rp;
$homepage = '';
$crp[2]--;
$ucp = $cup;
} else fgets($fb);
} else break;
}
fclose($fb);
}
if($sss[25] !== 'a' && $crp[2] !== 'a' && $sss[25] <= $mbr_level && $wdth[5][0] !== 'a' && !$vtrpc[1]){
$sr_rpw = tagcut('rpw',$srkin);
if($mbr_no) $sr_rpw = str_replace("<!--/--><;>","",$sr_rpw);
if(!$sett[82] || ($mbr_no && ($sett[82] == 1 || $sett[82] == 3))) {$sr_rpw = str_replace("<#isatspm#>","<;>",$sr_rpw); $nospam = 0;} else $nospam = 1;
$cwrt = "<input type='hidden' name='id' value='{$id}' />";
$cwrt .= "<input type='hidden' name='pno' value='{$comment}' />";
$cwrt .= "<input type='hidden' name='spm' value='{$comment}' />";
$cwrt .= "<input type='hidden' name='cc' value='{$cc}' />";
$cwrt .= "<input type='hidden' name='request' value='{$_SERVER['REQUEST_URI']}' />";
$cwrt .= "<input type='hidden' name='xx' value='{$xx}' />";
$cwrt .= "<input type='hidden' name='up' value='1' />";
$cwrt .= "<input type='hidden' name='ip' value='".md5($sessid)."' />";
$sr_rpw = str_replace("<#cwrt#>",$cwrt,$sr_rpw);
$sr_rpw = str_replace("<#yname#>",$uzname,$sr_rpw);
$srkiin .= str_replace("<#ypass#>",$uzpass,$sr_rpw);
}
$srkiin .= tagcut("rp_bottom",$srkin);
?><?php echo str_replace("<!--/-->","",preg_replace("`<#[^#]+#>`","",preg_replace("`<;>(.+)<!--/-->`sU","",$srkiin)));?><?php
if($pend) {
pagen('page',$pend,10,0);
if($_GET['page'] != 1) {
if(!$_GET['page']) $fend = --$pend;else if($_GET['page'] > 1) $fend = --$_GET['page'];else $fend = 0;
if($fend) $fend = "rplace('?".preg_replace("`&(amp;)?page=[0-9]+`","",$_SERVER['QUERY_STRING'])."&amp;page={$fend}')";
}}}
?>
<form method="post" action="exe.php" id="rmdForm" target="rexe"></form>
<script type='text/javascript'>
//<![CDATA[
<?php if($_GET['comment']) {?>
if(top.length == 0) pxxx = opener;
else pxxx = parent;
var gout = 1;
<?php } else {?>
pxxx = self;
var gout = 0;
<?php }?>
var rbr_level = <?php echo $mbr_level?>;
var svtime = <?php echo $time?>;
var lmtime = <?php echo ((($mbr_level < $sett[51])?(int)$_COOKIE["cmt_".$id]:0) + ($sett[50]*60));?>;
var strbytee = <?php echo (($sett[86] > 0 && $mbr_level < $sett[87])? $sett[86]*1024:0);?>;

<?php echo $addrpvalue?>
function mdrequest() {
for(var i= document.getElementsByName('request').length-1;i >= 0;i--) {document.getElementsByName('request')[i].value= "<?php echo $_SERVER['REQUEST_URI']?>";}
}
function rsetup() {
ono = <?php echo $comment?>;
xxn = '<?php echo $xx?>';
gout = <?php echo (($_GET['comment'])? '1':'0')?>;
<?php if($nospam) {?>nwspm();<?php }?>
svtime = svtime - (new Date().getTime()/1000);
<?php echo $memb?>

pview = $('pview');
toprsz();
img_resize();
if(pxxx && pxxx.location.href) {
var pcc = pxxx.location.href.indexOf('&cc=') + 4;
if(pcc != 3) {
pcc = pxxx.location.href.substr(pcc,7);
if($('bdo' + pcc)) {
var bdopp = $('bdo' + pcc);
if(bdopp.parentNode.parentNode) bdopp = bdopp.parentNode.parentNode;
else if(bdopp.parentNode) bdopp = bdopp.parentNode;
bdopp.className = ((bdopp.className)?bdopp.className + ' ':'') + 'seltdrp';
pxxx.siht = '#c' + pcc;
} else if(pxxx.siht != '#c' + pcc && <?php echo (int)$pend?> > 0) <?php echo $fend?>;
}}
<?php
if(!$_COOKIE[$docoo] || $_COOKIE[$docoo] != $dookie) {?>document.cookie = "<?php echo $docoo?>=<?php echo $dockie?>";<?php }
if($sss[25] > $mbr_level) {?>document.chksbmt=function(){alert("덧글 쓰기 권한이 없습니다.");};<?php }
if(!$_COOKIE[$docoo]) {?>if(document.cookie.indexOf('=<?php echo $dockie?>') == -1) document.chkssbmt=function(){alert("쿠키가 막혀있습니다.");};<?php }
?>
setTimeout('pxxdsht(2)',100);
if($$('antispam',0)) {
var spmnu = document.cookie.indexOf('spmnumber=');
if(spmnu != -1) {
spmnu = document.cookie.substr(spmnu + 10,14);
spmnu = spmnu.substr(0,spmnu.indexOf(';'));
if($$('pno',0).value == spmnu.substr(6)) {
$$('antispam',0).value = spmnu.substr(0,6);
chkatcode($$('pno',0).value,$$('antispam',0));
}}}}
//]]>
</script>
<script type="text/javascript" src="include/comment.js"></script>
<textarea id="ckdouble" rows="1" cols="1" style="width:0;height:0;border:0;visibility:hidden"><?php echo trim(preg_replace("`<[^>]+>`", "", preg_replace("`<br />`", "\r\n", $xdouble)))?></textarea>
<input type="hidden" id="rp_count" value="<?php echo $rps?>" /><input type="hidden" id="rp_time" value="<?php echo $time?>" />
<input type="button" id="nwrps" value="" style="display:none" onclick="location.reload()" />
<?php
$time_end = getmicrotime();
$timee = $time_end - $time_start;
echo "<!--서버처리시간:: $timee -->";
?>
</body>
</html>