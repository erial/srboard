<?php
if($sss[28] == 'a' || $sss[28] > $mbr_level) $authority[28] = 1;
if($sss[26] == 'e') {
if($_GET[type] == 'a' || $_GET[c] || $_GET[m] || $_GET[ct] || $_GET[keyword] || $_GET[arrange] || $_GET[date]) {$type = 'a'; $isnt = $isnt*$sett[19];}
else if($_GET[no]) $type = 'a';
else $type = 'b';
}
if($type == 'r') $type= 'a';
if($type == 'c') $len = 320;
else if($type == 'b'||$type == 'd') $len = 0;
else $len = 256;
if($_GET[xx] > 0) $idd = $id."/^".$_GET[xx];
else $idd = $id;
if($authority[28] && $type != 'b' && $type != 'c' &&  $type != 'd' &&  $type != 'e') $prevwx = 1;
else $prevwx = 0;
if($prevwx && $_GET[search] != 'b') $bodd = "";
else $bodd = "/body.dat";
$uuu = "";
function idab($da) {
 global $wdth, $id, $dxr;
if(!$_GET[xx]) {
if(!$da) $da = $wdth[6];
else if($da > 1) $da--;
else $da = "";
if($da >= 1 && file_exists($dxr.$id."/^".$da."/no.dat")) $da = array($da,"/^".$da);
else if($da == "x") $da = array($da,"");
} else $da = "";
return $da;
}
if($_GET[c] || $_GET[m] || $_GET[ct] || trim($_GET[keyword]) || $_GET[arrange] || $_GET[date]) {
if($type != 'g' && ($sett[10] == '1' || $sett[10] == '2')) $newwin = "' target='_blank' rel='";
include("include/search.php");
} else if($_GET[type] == 's' || $sss[26] == 's') {
$types = 1;
include("include/search.php");
} else {
if(!$_GET[xx]) {
$start = $isnt*($gp - 1);
if($wdth[6]) $fnt = $fct - substr($do[$wdth[6]], 6, 6);
else $fnt = $fct;
if($fnt < $start) {
$ftt = $start - $fnt;
$ih = $start - $fnt;
if($wdth[6]) {
for($i = $wdth[6];$i > 0;$i--) {
$fnt = substr($do[$i], 12, 6);
$ftt -= $fnt;
if($ftt < 0) {
$ida = $i;
$start = $ih;
break;
} else $ih -= $fnt;
}}
} else $ida = "";
if($ida > 0) $idd = $id."/^".$ida;
else $idd = $id;
} else {
$idd = $id."/^".$_GET[xx];
$start = $isnt*($_GET[p] - 1);
$fct = (int)substr($do[$_GET[xx]],12,6);
}
$end = $start + $isnt;
$n = $isnt;
if($type == 'a' && $wdth[4]) {
$nss = explode('^', $wdth[4]);
$nsc = count($nss) -1;
$nscc = $nsc;
$a = fopen($dxr.$id."/notice.dat","r");
for($aa=0;!feof($a);$aa++) $fns[$aa] = fgets($a);
fclose($a);
$ncc = 0;
if($_GET[p] > 1) $start = $start - $nsc;
$end = $end - $nsc;
if($_GET[p] == 1) {
while($ncc < $nsc && $fns[$ncc]) {
	$fdl[$n] = substr($fns[$ncc], 6);
	$fdn[$n] = substr($fns[$ncc], 0, 6);
	$fda[$n] = $ida;
	$n--;
	$ncc++;
}
}
}
$i = 0;
$fn = fopen($dxr.$idd."/no.dat","r");
$fl = fopen($dxr.$idd."/list.dat","r");
if($bodd) $fb = fopen($dxr.$idd.$bodd,"r");
while($i < $end) {
	$fno = fgets($fn);
if($n > 0 && $wdth[6] && ($fno == "" || $fno == "\n")) {
list($ida,$idb) = idab($ida);
if($ida) {
fclose($fn);
fclose($fl);
if($bodd) fclose($fb);
$fn = fopen($dxr.$id.$idb."/no.dat","r");
$fl = fopen($dxr.$id.$idb."/list.dat","r");
if($bodd) $fb = fopen($dxr.$id.$idb.$bodd,"r");
} else break;
} else {
if($i >= $start) {
	$fda[$n] = $ida;
	$fdn[$n] = $fno;
	$fdl[$n] = fgets($fl);
	if($bodd) $fdb[$n] = strcut(fgets($fb), $len);
	$fdu[substr($fno,0,6)] =1;
	$n--;
	} else {
fgets($fl);
if($bodd) fgets($fb);
}
$i++;
}
}
fclose($fn);
fclose($fl);
if($bodd) fclose($fb);
}
$fu = fopen($dxr.$id."/upload.dat","r");
while($fuo = substr(fgets($fu),0,6)) {if($fdu[$fuo] == 1) $fdu[$fuo] = 2;}
fclose($fu);
// 게시판 목록 윗부분
if($fcct) $fct=$fcct;
if(!$sum) $sum=$fct;
else $fct--;
if($fno !== 'a') {
if($_GET[desc] == 'asc') $fno = $isnt*($gp-1) + 1;
else $fno = $fct - $isnt*($gp-1);
if($nsc) $fno = $fno + $nsc;
}
if($sss[27] && $ctg && $type != 'd') {
$ctgs = "<select id='ctt' class='t8' onchange=\"locato('ct',this.options[this.selectedIndex].value)\">";
$ctgs .= "	<option value='' class='t8'>분류</option>";
for($i = 1; $i <= $ctl; $i++){
$i = str_pad($i, 2, 0, STR_PAD_LEFT);
$ctgs .= "	<option value='{$i}' class='t8'>{$ctg[$i]} ({$ctgn[$i]})</option>";
}
$ctgs .= "</select>";
}
/* 목록공통 상단 시작 */
$wtdh = $sett[12] - 6;
$srkin = tagcut('list',$srkin);
$list_top = tagcut('list_top',$srkin);
$list_top = str_replace("<#sum#>",$sum,$list_top);
if($type != 'd') {
if(!$sss[29]) {
$list_top = str_replace('<#rss1#>','<;>',$list_top);
if(!$sss[53]) $list_top = str_replace('<#rss2#>','<!--/-->',$list_top);
} else if($sss[53])  $list_top = str_replace('<#rss2#>','<;>',$list_top);
if(!$sss[45] || !$sss[47] || $_GET[keyword] || $_GET[c]) {
$list_top = str_replace('<#arrange1#>','<;>',$list_top);
$list_top = str_replace('<#arrange2#>','<!--/-->',$list_top);
}
$list_top = str_replace("<#select_ct#>","<!--/-->".$ctgs,$list_top);
} else {
$list_top = str_replace('<#typed#>','<;>',$list_top);
}
$srkiin = preg_replace("`<#[^#]+#>`","",$list_top);
$sr_cols = tagcut('list_head_cols',$srkin);
$srcl = explode("<col ",$sr_cols);
for($i=0;$srcl[$i];$i++) {
if($srcp = strpos($srcl[$i],'px')) {
$srcw = substr($srcl[$i],7,$srcp - 7);
if($srcw < 200) {
if(substr($srcl[$i-1],-2) == '#>') $srclw[substr($srcl[$i-1],-6,4)] = $srcw;
else $wtdh -= $srcw;
}
}
}
if($ctg && $sss[48]) {$isct = 1;$wtdh -= $srclw[isct];} // 게시판에 설정된 분류이름이 있으면
else $srkin = str_replace("<#isct#>","<;>",$srkin);
$cols = $i - 7 + $sss[38] +$sss[39] +$sss[40] +$sss[41] +$sss[42] + $isct;
$sr_list = str_replace("<#cols#>",$cols,$srkin);
if($type == 'b') $list_head = tagcut('list_head_b',$sr_list);
else if($type == 'c') $list_head = tagcut('list_head_c',$sr_list);
else if($type == 'g') $list_head = tagcut('list_head_g',$sr_list);
else if($type == 'd') {
$list_head = tagcut('list_head_d',$sr_list);
$list_head = str_replace("<#yname#>",$_COOKIE[yname],$list_head);
$list_head = str_replace("<#ypass#>",$_COOKIE[ypass],$list_head);
$ntime = str_replace(" ", "", microtime());
$gwrt = "<input type='hidden' name='id' value='{$id}' />";
$gwrt .= "<input type='hidden' name='p' value='{$_POST[p]}{$_GET[p]}' />";
$gwrt .= "<input type='hidden' name='ntime' value='{$ntime}' />";
$gwrt .= "<input type='hidden' name='secure' value='".md5(preg_replace('`[^0-9]`i','',$dockie).$ntime)."' />";
$gwrt .= "<input type='hidden' name='slys' value='{$slys}' />";
$list_head = str_replace("<#gwrt#>",$gwrt,$list_head);
?>
<script type='text/javascript'>
//<![CDATA[
function replax() {
var xx=document.guest_;
if((xx.innerHTML.indexOf("Ο") != -1 ||'<?php echo $mbr_id?>' != '' || (xx.name.value && xx.pass.value)) && xx.content.value){
var doc = xx.content.value.replace(/([\n\s])http:\/\/([^"'<>\r\n\s]+)\.(jpg|gif|png|bmp|jpeg)/gi, "$1<img src='http://$2.$3'>");
doc = doc.replace(/([\n\s])http:\/\/([^"'<>\r\n\s]+)/gi, "$1<a href='http://$2'>http://$2</a>");
xx.content.value = doc;
prohsbmt(xx);
} else {
alert('빈 칸이 있습니다');
}
}
function guedit(mn,no,ii,sct,linko) {
var vguest = document.guest_.innerHTML;
if(vguest.indexOf("Ο") != -1) {
document.guest_.innerHTML = vguest.substr(vguest.indexOf("Ο") + 8);
document.guest_.content.value = "";
document.getElementsByName('perm_vw')[0].value="0";
document.getElementsByName('perm_vw')[0].checked=false;
if(document.getElementsByName('link5').length) {
document.getElementsByName('name')[0].disabled = false;
}
document.guest_.content.focus();
ekc = 8;
xcroll(document.guest_.content,70);
} else {
if((!mn || mn == '<?php echo $mbr_no?>' || '<?php echo $mbr_level?>' == '9') && (!sct || document.getElementById('bdo' + ii).innerHTML.indexOf('fpass(\'unlock') == -1)) {
var nxx = "<input type='hidden' name='mode' value='edit' />";
nxx += "<input type='hidden' name='no' value='" + no + "' />";
if(<?php echo $mbr_no?> >= 1 && !mn) nxx += "<div style='padding:10px 0 0px 15px;text-align:left'>비밀번호 : <input type='password' name='pass' value='' /></div>";
document.guest_.innerHTML =nxx + "<span style='display:none'>Ο</span>" + vguest ;
document.guest_.content.value = document.getElementById('bdo' + ii).innerHTML.replace(/<br[ \/]*>/gi,"\r\n");
document.getElementById('nae').value = "수정";
if(sct == '9') {
document.getElementsByName('perm_vw')[0].value="9";
document.getElementsByName('perm_vw')[0].checked=true;
}
if(document.getElementsByName('link5').length) {
document.getElementsByName('name')[0].disabled = true;
document.getElementsByName('link5')[0].value= linko;
}
location.href="#guestw";
document.guest_.content.focus();
ekc = 13;
xcroll(document.guest_.content,70);
} else alert('글쓴이가 아닙니다');
}
}
//]]>
</script>
<?php
}
if(!$list_head || $type === 'a'){
if($type !== 'a') {$type = 'a';if($_GET[type] && !$types) $_GET[type] = 'a';}
if(!$sss[38]) $sr_list = str_replace('<#x_no#>','<;>',$sr_list);else $wtdh -= $srclw[x_no];
if(!$sss[39]) $sr_list = str_replace('<#x_name#>','<;>',$sr_list);else $wtdh -= $srclw[name];
if(!$sss[40]) $sr_list = str_replace('<#x_date#>','<;>',$sr_list);else $wtdh -= $srclw[date];
if(!$sss[41]) $sr_list = str_replace('<#x_visit#>','<;>',$sr_list);else $wtdh -= $srclw[isit];
if(!$sss[42]) $sr_list = str_replace('<#x_vote#>','<;>',$sr_list);else $wtdh -= $srclw[vote];
$list_head = tagcut('list_head_cols',$sr_list).tagcut('list_head_a',$sr_list);
}
$srkiin .= $list_head;
if($newwin) {$rrt = $rt;$rt = $newwin;}
if($fct > 0){
$ii = 0;
$iii = 0;
if($type == 'c') $list_bodyy = tagcut('list_body_c',$sr_list);
else if($type == 'b') $list_bodyy = tagcut('list_body_b',$sr_list);
else if($type == 'g') $list_bodyy = tagcut('list_body_g',$sr_list);
else if($type == 'd') $list_bodyy = tagcut('list_body_d',$sr_list);
if(!$list_bodyy || $type === 'a') $list_bodyy = tagcut('list_body_a',$sr_list);
$mn = '';
for($i = $isnt; $i > 0; $i--) {
if($fdn[$i][9] != "\x1b") {
$mn[] = substr($fdn[$i],9,strpos($fdn[$i],"\x1b") - 9);
}
}
if(is_array($mn)) {
$fmm = array();
$fim = fopen($dim,"r");
while($fm = fgets($fim)) {
$fmo = (int)substr($fm,0,5);
if(in_array($fmo, $mn)) {
$fmm[$fmo] = explode("\x1b",$fm);
}
}
fclose($fim);
}
for($i = $isnt; $i > 0; $i--) {
if(trim($fdn[$i])){
$zzz = explode("\x1b",$fdn[$i]);
$flo = explode("\x1b", $fdl[$i]);
$no = substr($zzz[0], 0, 6);
$ctn = substr($zzz[0], 6, 2);
$mn = substr($zzz[0], 9);
$name = $flo[1];
$flo[5] = str_replace("&","&amp;",$flo[5]);
$flo[3] = str_replace("&","&amp;",$flo[3]);
$flo[4] = str_replace("&","&amp;",$flo[4]);
$list_body = str_replace("<#xx#>",$fda[$i],$list_bodyy);
$wdtt = 0;
if($mbr_level == '9') $list_body = str_replace("<#no_check#>","<input type='checkbox' name='cart' value='".$no."' onclick='uchoice(this)' class='cart' /><input type='hidden' name='ixx' value='".$fda[$i]."' /> ",$list_body);
if($type === 'a' && $flo[4]) {$list_body = str_replace("<#isimg#>","</div><div class='lnkrp'><img src='icon/img.gif' style='width:13px;height:13px' alt='' />",$list_body);$wdtt += 20;}
if($type === 'a' && $fdu[$no] == 2) {$list_body = str_replace("<#isfile#>","</div><div class='lnkrp'><img src='icon/f.png' style='width:13px;height:13px' alt='' />",$list_body);$wdtt += 20;}
$no = (int)$no;
if((int)$zzz[0][8] > $mbr_level && $_COOKIE["scrt_".$no.$id] != md5($no."_".$sessid.$id)) $secret = 1;
else $secret = 0;
$date = substr($flo[0], 0, 10);
$notx = 1;
if(strchr($wdth[4], $no."^") && $nsc > 0 && $_GET[p] == 1) {
$notx = 0;
$list_body = str_replace("<#fnno#>","<b> 공지</b>",$list_body);
$list_body = str_replace("<#nHit#>","-",$list_body);
$list_body = str_replace("<#nVote#>","-",$list_body);
$ii--;
$nsc--;
} else if($_GET[no] == $no) {
if($type == 'g') $name = "<u>".$name."</u>";
else $fnno = "<script type='text/javascript'>/*<![CDATA[*/</script><marquee scrollamount='1' behavior='alternate' width='20px' style='font-size:7pt'>▶</marquee><script type='text/javascript'>/*]]>*/</script>";
} else if($fno === 'a') $fnno = $no;
else $fnno = $fno;
$list_body = str_replace("<#fnno#>",$fnno,$list_body);
if($_GET[search] == 's') {$flo[3] = str_replace($keyw[0], "<span class='keyword'>$keyw[0]</span>",$flo[3]);if($keyw[1]) $flo[3] = str_replace($keyw[1], "<span class='keyword'>$keyw[1]</span>",$flo[3]);}
if($flo[3] == '') $flo[3] = ' …… ';
$crp = "";
if($zzz[2] > 0 || $zzz[3] > 0 ||$zzz[4] > 0) {$nrp = (int)$zzz[2];if($type === 'a') $wdtt += $sett[28] + strlen($nrp)*5;}
else $list_body = str_replace("<#isnrp#>","<;>",$list_body);
if($notx == 0 || $prevwx || $secret) {
if($notx == 0 || $prevwx) $list_body = str_replace("<#memb#>","",$list_body);
else if($secret) {
if($type != 'b' && $type != 'c' && $type != 'd') $memb .= "\npretxt[{$ii}] = \"[비밀글]\";";
else {$list_body = str_replace("<#memb#>","<div class='dv_pass' id='lock_{$id}_{$no}'>비밀글입니다.</div>",$list_body);$memb .= "\nsetTimeout(\"ffpass('{$no}','{$fda[$i]}')\",50);";}
}
} else if($type != 'b' && $type != 'c' && $type != 'd') $list_body = str_replace("<#oprvw#>","onmouseover=\"preview('{$ii}','')\" onmouseout=\"preview()\"",$list_body);
if(!$secret && $wdth[7][0] == '1' && !$authority[23]) $list_body = str_replace("<#ispvrp#>","\"?id={$eid}&amp;comment={$no}\",5,0",$list_body);
else $list_body = str_replace("<#ispvrp#>","0",$list_body);
if($authority[23] || $secret) {
	if($secret) {if($type != 'g') $flo[3] = "<b>[잠김]</b> ".$flo[3];else $flo[3] = "[잠김] ".$flo[3];}
	else if($flo[5]) {
	$list_body = str_replace("<#no_jslink#>","onclick=\"var nw=window.open();nw.location.href='{$flo[5]}'\"",$list_body);
	$list_body = str_replace("<#target#>","target='_blank'",$list_body);
	$list_body = str_replace("<#no_link#>",$flo[5],$list_body);
	}
	if($type == 'g') $list_body = str_replace("<#simg#>","icon/noimg.gif",$list_body);
	else if($type == 'c') $list_body = str_replace("<#issimg#>","<;>",$list_body);
	$flo[4] = "";
	$list_body = str_replace("<#isnlink#>","<;>",$list_body);
} else {
if($flo[5] == "" || !$sss[32]) $list_body = str_replace("<#isnlink#>","<;>",$list_body);
else {$list_body = str_replace("<#rlink#>",$flo[5],$list_body);$wdtt += 22;}
if($flo[4]) {
if($flo[4]) {
if(substr($flo[4], 0, 5) != "http:") {
if(substr($flo[4],0,1) == "/") $flo[4] = "exe.php?sls=".$id.$flo[4];
else if(strpos($flo[4],"exe.php") === false) $flo[4] = "exe.php?sls=".$id."/file/".str_replace(" ","+",$flo[4]);
}
$list_body = str_replace("<#simg#>",$flo[4],$list_body);
if($type == 'a') $flo[4] = "<img src='{$flo[4]}' class='gthumb_100' alt='' />";
else $flo[4] = '';
} else if($type == 'g') $list_body = str_replace("<#simg#>","icon/noimg.gif",$list_body);
else if($type == 'c') $list_body = str_replace("<#issimg#>","<;>",$list_body);
}
$list_body = str_replace("<#no_jslink#>","onclick=\"location.href='{$index}?id={$eid}&amp;no={$no}{$rt}&amp;p={$_GET[p]}'\"",$list_body);
$list_body = str_replace("<#no_link#>","{$index}?id={$eid}&amp;no={$no}{$rt}&amp;p={$_GET[p]}",$list_body);
if($type == 'b' && $flo[6]) {
$tagg = explode(",",$flo[6]);
$tag = "<div class='tagg'><img src='icon/tag.gif' alt='' /> ";
for($j = 0; trim($tagg[$j]); $j++){
if($_GET[search] == 't' && $_GET[keyword] == $tagg[$j]) $tagg[$j] = "<span class='keyword'>{$tagg[$j]}</span>";
$tag .= "<a href='{$index}?id={$eid}&amp;search=t&amp;keyword=".urlencode($tagg[$j])."&amp;p=1'>{$tagg[$j]}</a>, ";
}
$tag = substr($tag, 0, -2)."</div>";
$list_body = str_replace("<#tag#>",$tag,$list_body);
}
if($type == 'd') {
if((!$mn || $sss[44] < 3) && ($mbr_level == 9 || ($sss[44] != 2 && $sss[44] != 9 && ($mbr_level || $sss[44] == 0 || $sss[44] == 7)))) $list_body = str_replace("<#ipr#>",trim(substr($flo[0], 10, 15)),$list_body);
else $list_body = str_replace('<#isipr#>','<;>',$list_body);
$list_body = str_replace('<#scrt#>',$zzz[0][8],$list_body);
}
$insert = "";
if($zzz[6] > 0) {
for($r = $zzz[6];$r > 0; $r--) $insert = "&nbsp;&nbsp; ".$insert."re:";
$insert = "<span class='t8'>".$insert."</span> ";
}
if($authority[23]) $fdb[$i] = $authority[23];
if($isct && $ctg[$ctn]) {
$list_body = str_replace("<#ct_no#>","{$ctn}",$list_body);
$list_body = str_replace("<#ct_name#>","{$ctg[$ctn]}",$list_body);
} else $list_body = str_replace("<#isnct#>","<;>",$list_body);
$list_body = str_replace("<#subject#>",$flo[3],$list_body);
$list_body = str_replace("<#re_depth#>",$insert,$list_body);
$list_body = str_replace("<#nHit#>",(int)$zzz[1],$list_body);
$list_body = str_replace("<#nVote#>",(int)$zzz[5],$list_body);
$list_body = str_replace("<#no#>",$no,$list_body);
$list_body = str_replace("<#ii#>",$ii,$list_body);
$list_body = str_replace("<#name#>",name($name, $mn, 0, 1, $fmm[$mn][2], $fmm[$mn][10]),$list_body);
$list_body = str_replace("<#tname#>",name($name, $mn, 0, 0, $fmm[$mn][2], $fmm[$mn][10]),$list_body);
if($type != 'b' && $type != 'c' && $type != 'd') $memb .= "\npretxt[{$ii}] = \"".str_replace('"','\\"',$flo[4])."<b>".str_replace('"','\\"',$flo[3])."</b><span class='n8'> by ".str_replace('"','\\"',$flo[1])."</span> <span class='r7'>[".(int)$nrp."]</span><br />".str_replace('"','\\"',$fdb[$i])."\";";
if($type === 'a'){
$list_body = str_replace("<#date#>",@date("Y.m.d", $date),$list_body);
$list_body = str_replace("<#nrp#>",$nrp,$list_body);
$list_body = str_replace("<#cno#>",$iii %2,$list_body);
$wdtt = $wtdh - $wdtt;
if($bwr == 'ie6') $list_body = str_replace("<#wtdh#>","width:expression((this.scrollWidth < {$wdtt})?\"\":\"{$wdtt}px\")",$list_body);
else $list_body = str_replace("<#wtdh#>","max-width:{$wdtt}px",$list_body);
} else {
$list_body = str_replace("<#date#>",@date("Y.m.d H:i", $date),$list_body);
if(($type == 'b' || $type == 'd') || ($type == 'c' && !$secret)) $list_body = str_replace("<#memb#>",$fdb[$i],$list_body);
$list_body = str_replace("<#nrp#>",(int)$nrp,$list_body);
$list_body = str_replace("<#mn#>",$mn,$list_body);
if($type == 'b'){
$list_body = str_replace("<#nReply#>",(int)$zzz[2],$list_body);
$list_body = str_replace("<#nTrb_out#>",(int)$zzz[3],$list_body);
$list_body = str_replace("<#nTrb_in#>",(int)$zzz[4],$list_body);
$list_body = str_replace("<#uplist#>",uplist($no),$list_body);
}}
$srkiin .= $list_body;
$nrp = '';
$ii++;
$iii++;
}
if($fno !== 'a') {
if($_GET[desc] == 'asc') $fno++;
else $fno--;
}
}
}
// 게시판 목록 아랫부분
$srkin = tagcut('list_tail',$sr_list);
if($type != 'g' && $type != 'b' && $type != 'd') $srkin = str_replace('<#gdb#>','<;>',$srkin);
else if($type == 'g') $srkin = str_replace('<#gdb#>','</td></tr>',$srkin);
if($wdth[7][1] == '0' || substr($sss,57,2) == '00' || (!$sett[40] && count($bfsb[$section]) == 1)) $srkin = str_replace('<#sss43#>','<;>',$srkin);
else $srkin = str_replace('<#surl#>','?section='.$section.$ptslys,$srkin);
if($sss[26] == 'd') $srkin = str_replace('<#sss26#>','<;>',$srkin);
if($sss[26] == 'd' || $sss[24] === 'a' || ($sss[26] == 'r' && $mbr_level != 9) || $sss[24] > $mbr_level) {
$srkin = str_replace('<#isrss#>','<;>',$srkin);
$srkin = str_replace('<#isnrss#>','<;>',$srkin);
} else if($sss[26] == 'r') $srkin = str_replace('<#isnrss#>','<;>',$srkin);
else $srkin = str_replace('<#isrss#>','<;>',$srkin);
$srkin = str_replace('<#type#>',$type,$srkin);
$srkin = str_replace("<#ct_no#>",$_GET[ct],$srkin);
$srkiin .= $srkin;
$srkiin = str_replace("<!--/-->","",preg_replace("`<#[^#]+#>`","",preg_replace("`<;>(.+)<!--/-->`sU","",$srkiin)));
$gtis = strpos($srkiin,'<##');
if($gtis) {
echo substr($srkiin,0,$gtis);
$gtin = explode('<##',substr($srkiin,$gtis));
$gtinc = count($gtin);
for($igt = 1;$igt < $gtinc;$igt++) {
$gtine = strpos($gtin[$igt],'##>');
$gtinf = substr($gtin[$igt],0,$gtine);
if($gtinf[0] == '#') parse_str(substr($gtinf,1,-1));
else @include($gtinf);
echo substr($gtin[$igt],$gtine + 3);
}} else echo $srkiin;
?>
<table cellpadding='0px' cellspacing='0px' width='<?php echo $sett[12]?>px'>
<tr><td class='pageno'><br />
<?php
if($_GET[keyword]){
?>
<script type='text/javascript'>
document.sform.keyword.value = '<?php echo $_GET[keyword]?>';
document.sform.search.value = '<?php echo $_GET[search]?>';
</script>
<?php
}
// 목록번호 출력
if($newwin) $rt = $rrt;
$fct += (int)$nscc;
$allp = (int)(($fct - 1)/ $isnt) + 1;
$isnt = 10;
$sg = (int)(($_GET[p] - 1)/ $isnt)*$isnt + 1;
$ge = ($allp > $sg+ 10)? $sg+ $isnt -1:$allp;
if($sg >= $isnt) {
?>
<a href='<?php echo $index?>?id=<?php echo $eid?><?php echo $rt?>&amp;p=1'>1</a> | <a href='<?php echo $index?>?id=<?php echo $eid?><?php echo $rt?>&amp;p=<?php echo $sg - 1;?>'>. .</a> | <?php
}
for($g = $sg;$g < $ge; $g++){
	if($_GET[p] == $g) $p = "<span class='p_no'>{$_GET[p]}</span>";
	else $p = $g;
?>
<a href='<?php echo $index?>?id=<?php echo $eid?><?php echo $rt?>&amp;p=<?php echo $g?>'><?php echo $p?></a> | <?php
}
	if($_GET[p] == $ge) $p = "<span class='p_no'>{$_GET[p]}</span>";
	else $p = $ge;
?>
<a href='<?php echo $index?>?id=<?php echo $eid?><?php echo $rt?>&amp;p=<?php echo $ge?>'><?php echo $p?></a><?php
if($allp > $ge) {
?>
 | <a href='<?php echo $index?>?id=<?php echo $eid?><?php echo $rt?>&amp;p=<?php echo $ge+1;?>'>. .</a> | <a href='<?php echo $index?>?id=<?php echo $eid?><?php echo $rt?>&amp;p=<?php echo $allp?>'><?php echo $allp?></a>
<?php
}
if($sum === "+") {
?>
&nbsp; <a href="#none" onclick="location.href='?' + location.search.slice(1).replace(/&amp;p=[^&]*/gi,'') + '&amp;p=<?php echo $_GET[p] + 1?>';">[계속검색]</a><?php
}
?>
</td></tr>
<?php
if($mbr_level == '9') {
?>
<tr><td align='right'>
<script type='text/javascript'>
//<![CDATA[
var sxx = document.getElementsByName('ixx');
var sel = document.getElementsByName('cart');
var i;
function choice(){
var sxv = sxx[rtsxv()].value;
var ctf = true;
for(i = 0; i < sel.length; i++){
if(sxx[i].value == sxv) {
if(sel[i].checked == true) ctf = false;
else if(sel[i].checked == false) {ctf = true;break;}
}
}
for(i = 0; i < sel.length; i++){
if(sxx[i].value == sxv) sel[i].checked = ctf;
else sel[i].checked = false;
}
document.adselect.xx.value = sxv;
}
function uchoice(that) {
var sxv = that.nextSibling.value;
document.adselect.xx.value = sxv;
for(i = 0; i < sel.length; i++){
if(sxx[i].value != sxv) sel[i].checked = false;
}
}
function choiced(chn){
var excv = document.adselect.exc.value;
if(excv.substr(0,7) == 'modify_') {
document.adselect.submit();
} else if(chn == '0' && (excv == 'change' || excv == 'move' || excv == 'copy' || excv == 'limit' || excv == '')) {
document.adselect.changeto.style.display = (excv == 'change')? 'block':'none';
document.adselect.moveto.style.display = (excv == 'move' || excv == 'copy')? 'block':'none';
document.adselect.perm_vw.style.display = (excv == 'limit')? 'block':'none';
} else {
var xx = 1;
if(excv == 'delete') xx = confirm('선택한 게시물을 삭제하시겠습니까');
else if(excv == 'delete_rp') xx = confirm('선택한 게시물의 덧글을 삭제하시겠습니까');
else if(excv == 'delete_body') xx = confirm('선택한 게시물의 본문을 삭제하시겠습니까');
if(xx) {
var selted = "";
var sxv = sxx[rtsxv()].value;
for(i = 0; i < sel.length; i++){
if(sel[i].checked == true && sel[i].value !='' && sxx[i].value == sxv) selted += sel[i].value + ":";
}
document.adselect.selected.value = selted;
document.adselect.xx.value = sxv;
if(selted) document.adselect.submit();
} else document.adselect.exc.value = "";
}
}
function rtsxv() {
var ii = 0;
for(i = 0; i < sel.length;i++){
if(sel[i].checked == true) {ii = i;break;}
}
return ii;
}
//]]>
</script>
<form name='adselect' method='post' action='exe.php'>
<input type='hidden' name='selected' />
<input type='hidden' name='id' value='<?php echo $id?>' />
<input type='hidden' name='p' value='<?php echo $gp?>' />
<input type='hidden' name='xx' value='<?php echo $xx?>' />
<select name="perm_vw" onchange='choiced(1)' style='display:none;'><option value="">::권한변경</option><option value="0">모두허용</option><option value="r">rss출력제한</option><option value="1">레벨1</option><option value="2">레벨2</option><option value="3">레벨3</option><option value="4">레벨4</option><option value="5">레벨5</option><option value="6">레벨6</option><option value="7">레벨7</option><option value="8">레벨8</option><option value="9">관리자</option></select>
<select name='changeto' onchange='choiced(1)' style='display:none;'>
	<option value="">분류선택</option>
	<option value="00">::분류없음</option>
<?php
for($i = 1; $i <= $ctl; $i++){
$i = str_pad($i, 2, 0, STR_PAD_LEFT);
?>
	<option value="<?php echo $i?>"><?php echo $ctg[$i]?></option>
<?php
}
?>
</select>
<select name='moveto' onchange='choiced(1)' style='display:none;'>
	<option value="">게시판선택</option>
<?php
foreach($fsbs as $mid => $val) {
if($mid != $id) {
?>
	<option value="<?php echo $mid?>"><?php echo $mid?></option>
<?php
}
}
?>
</select>
 <input type='button' onclick='choice()' value='전체선택' class='srbt' />
 <select name='exc' onchange="choiced(0)">
	<option value=""></option>
	<option value="change">분류 이동</option>
	<option value="move">게시판 이동</option>
	<option value="copy">게시판 복사</option>
	<option value="delete" style="background-color:#FCDBDB">게시물 삭제</option>
	<option value="delete_rp" style="background-color:#FCDBDB">덧글 삭제</option>
	<option value="delete_rtb" style="background-color:#FCDBDB">엮인글 삭제</option>
	<option value="delete_stb" style="background-color:#FCDBDB">엮은글 삭제</option>
	<option value="delete_body" style="background-color:#FCDBDB">본문 삭제</option>
	<option value="limit">읽기제한 변경</option>
<?php
if($xx == 0){
?>
	<option value="notc_add">공지 등록</option>
	<option value="notc_dell">공지 제거</option>
<?php
}
?>
	<option value="modify_tag" style="background-color:#EAFCE2">태그 정리</option>
	<option value="modify_date" style="background-color:#EAFCE2">날짜 정리</option>
	<option value="modify_ct" style="background-color:#EAFCE2">분류 정리</option>
	<option value="modify_upload" style="background-color:#EAFCE2">업로드 정리</option>
	<option value="delete_thumb">썸네일 삭제</option>
	<option value="delete_lnk">링크 삭제</option>
	<option value="delete_tag">태그 삭제</option>
	<option value="delete_ip">본문IP 삭제</option>
</select></form></td></tr>
<?php
}
?>
<tr><td colspan='2' style='text-align:center;vertical-align:top'>
<?php
// 로그인 출력
if(!$chkmemo && $mbr_level) {
$chkmemo = 1;
?><div id='check_memo'></div><?php }?>
<div id='login' style='display:none;' ondblclick="opeclo('login')">
<form method="post" action="<?php echo $admin?>" onsubmit="convertbase(this)">
<input type='hidden' name='username_3' value='' />
<input type='hidden' name='password_3' value='' />
<input type='hidden' name='from' value='<?php echo $_SERVER[REQUEST_URI]?>' />
<?php
if($mbr_no >= 1){
?>
<b>"<?php echo $_COOKIE[m_nick]?>"</b>님의 <a target='_blank' href='<?php echo $admin?>'>회원정보</a>, <a href='#none' onclick="read('get')">쪽지함</a>, <a href='#none' onclick="read('<?php echo $mblog?>')">회원로그</a> &nbsp; <input type="submit" name="logout" value="로그아웃" style='background-color:#D7D7D7;border:0;width:60px' />
<?php
} else {
?>
아이디 <input type='text' name='username' maxlength='10' class='login' />
&nbsp; 비밀번호 <input type='password' name='password' class='login' style='ime-mode:disabled' />
&nbsp; <input type="checkbox" name="autologin" value="0" onclick='if(this.checked){this.value=1;alert("체크하면, 자동으로 로그인됩니다.\r\n공공장소에서는 체크하지 마세요.");}else this.value=0;' style="border:0;width:16px;height:16px;vertical-align:bottom" /> <span style='vertical-align:bottom'>자동로그인</span>
 &nbsp; <input type="submit" value="로그인" style='background-color:#D7D7D7;border:0;width:60px' /> &nbsp; <a target='_blank' href='<?php echo $admin?>?signup=agreement'>회원가입</a><?php if($sett[15]){?> &nbsp; <a href='#none' onclick='popup("<?php echo $admin?>?askaddr=1",400,200)'>아이디/비밀번호_찾기</a><?php }?>
<?php
}
?>
 &nbsp; <input type='button' value='닫기' onclick="opeclo('login')"  style='background-color:#D7D7D7;border:0;width:40px' />&nbsp; </form></div>
<?php
if(@filesize("skin/".$wdth[2]."/maker.txt")) {
?><div style='text-align:right' class='f8'>skin by <?php echo join('',file("skin/".$wdth[2]."/maker.txt"))?></div><?php
}
?>
</td></tr>
<tr><td><iframe id='tag' src='' style='display:none;width:<?php echo $sett[12]?>px;height:30px' frameborder='0'></iframe>
</td></tr>
</table>
