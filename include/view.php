<?php
$plus = 0;
if($_GET['link']) {
$_GET['link'] = substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'],'link=') + 5);
$ida = '';
$linkx = "\x1b".$_GET['link']."\x1b";
$fn = fopen($dxr.$id."/no.dat","r");
$fl = fopen($dxr.$id."/list.dat","r");
while(!feof($fl)) {
$flo = fgets($fl);
if($flo == "" || $flo == "\n") {
list($ida,$fn,$fl) = data6($ida,array($fn,$fl),0);
if($ida == 'q') break;else $xx = $ida;
} else {
if(strpos($flo,$linkx)) {
$fno = fgets($fn);
$flow = explode("\x1b",$flo);
if($flow[5] == $_GET['link']) {
$no6 = substr($fno,0,6);$_GET['no'] = (int)$no6;break;
}} else fgets($fn);
}}
fclose($fn);
fclose($fl);
$ida = '';
} else {
$no6 = str_pad($_GET['no'],6,0,STR_PAD_LEFT);
if($wdth[6] && $_GET['no'] <= (int)substr($do[$wdth[6]],0,6)) {
for($aa = 1; $aa <= $wdth[6]; $aa++){
if($_GET['no'] <= (int)substr($do[$aa],0,6)) {$xx = $aa;break;}
}}}
if($xx > 0) $idd = $id."/^".$xx;
else $idd = $id;
$rdoc = '';
$rdoct = 0;
$i = 0;
$ths = 0;
$brk = 1;
$thsn = 0;
$fnfs = filesize($dxr.$idd."/no.dat");
$fn = fopen($dxr.$idd."/no.dat","r");
while(!feof($fn)){
$fno = fgets($fn);
$uuu[$i] = $fno;
if(!$sss[30] && $brk) {
$uuo = substr(trim($fno),0,-1);
$rpn = (int)substr($uuo,strrpos($uuo,"\x1b") + 1,1);
if($no6 == substr($uuo, 0, 6)) {$ths = $i;if($sss[55]){if($rpn == 0) $rdoc = '';$rdoc[] = $i;} else $brk = 0;}
else {
if($sss[66] && substr($fno,6,2) != 'aa') $thsp = $i;
if($sss[55]) {
if(!$ths){
if($rdoc && $rpn == 0) $rdoc = '';$rdoc[] = $i;
} else {
if($rpn != 0) $rdoc[] = $i;else $brk = 0;
}}}} else if(!$thsn && substr($fno,6,2) != 'aa') $thsn = $i;
$i++;
}
fclose($fn);
if(!$sss[30]) {
if($sss[55]) {$rdoct = count($rdoc);}
if($rdoct < 2 && !$sss[30]) {$rdoct = 3;$rdoc = '';}
if($rdoct > 2) {$fcct = $rdoct;$fno = 'a';$isnt = $rdoct;$sum = $fct;$type = 'a';}
if(!$sss[66]) $thsp = $ths - 1;
}
if(false !== strpos("^".$wdth[4],"^".$_GET['no']."^")){if($wdth[7][8] <= $mbr_level) $notice = 1;else $notice = 2;}
$fl = fopen($dxr.$idd."/list.dat","r");
$fb = fopen($dxr.$idd."/body.dat","r");
$ii = 0;
$ufu = '';
while($uuu[$ii]){
if($no6 == substr($uuu[$ii], 0, 6)) {
if(substr($uuu[$ii],6,2) == 'aa') {if($mbr_level != 9) break;else $deleted = 1;}
$crp = explode("\x1b",$uuu[$ii]);
$mn = substr($crp[0],9);
$floo = fgets($fl);
$memo = trim(fgets($fb));
$ths = $ii;
if(($sss[23] == 'a' || !$mn || $mn != $mbr_no) && $_GET['no'] && $_COOKIE["scrt_".$_GET['no'].$id] != md5($_GET['no']."_".$sessid.$id)) {
if((int)$crp[0][8] > $mbr_level) {
$memo = "<div class='dv_pass' id='lock_{$id}_{$_GET['no']}'>비밀글입니다.</div>";
if(!$mn && $sss[23] !== 'a') $memb .= "\nsetTimeout(\"ffpass('{$_GET['no']}','{$xx}')\",50);";
else if($crp[0][8] != 9) {$memo = str_replace('dv_pass','dv_login',$memo);$onload .= "\nsetTimeout(\"$('lock_{$id}_{$_GET['no']}').innerHTML=$('srlogin').innerHTML + '<br />본문 보기 권한이 없습니다.<br />'\",100);";$srlogin = 1;}
$noright = 1;
} else if($notice == 2 || ($notice != 1 && $authority_read)) {
$memo = "<div class='dv_login' id='lock_{$id}_{$_GET['no']}'></div>";
if(!$mn && $sss[23] !== 'a') $memb .= "\nsetTimeout(\"ffpass('{$_GET['no']}','{$xx}')\",50);";
else {
$onload .= "\n$('lock_{$id}_{$_GET['no']}').innerHTML = $('srlogin').innerHTML + '<br />";$srlogin = 1;if($mbr_level && $aview == 4) $onload .= "소모임에 가입되어 있지 않습니다.<br />';";else $onload .= "본문 읽기 권한이 없습니다.<br />';";}
$noright = 1;
}}
if($deleted == 1) $memo = "<h2 class='bd_name'>삭제된 글입니다.</h2>".$memo;
if($rdoct) {$fdn[$rdoct] = $uuu[$ii];$fdl[$rdoct] = $floo;$fdb[$rdoct] = '';$rdoct--;}
$flo = explode("\x1b",$floo);
$flo[3] = andamp($flo[3]);
if($s7116 === 1) {
$dctime = $time - substr($flo[0],0,10);
if($dctime > $cuttime[$sett[71][17]]) $vtrpc[0] = 1;
$onload .= "vtrpc[{$_GET[no]}] = ".(($vtrpc[0] === 1)? 3:2).";\n";
if($dctime <= $cuttime[$sett[71][18]] && !$noright && (!$mn || $mn != $mbr_no)) {
$gtt = "_".$_GET['no']."_";
if(!$_COOKIE["vst_".$id] || ($_COOKIE["vst_".$id] && false === strpos($_COOKIE["vst_".$id], $gtt))) {
if($_COOKIE["vst_".$id]) $gtt = $_COOKIE["vst_".$id].substr($gtt,1);
$onload .= "mkcookie('vst_{$id}', '{$gtt}',1);\n";
$plus = 1;
$fnfs -= strlen($uuu[$ii]);
$crp1 = $crp[1] + 1;
$uuu[$ii] = $crp[0]."\x1b".$crp1."\x1b".$crp[2]."\x1b".$crp[3]."\x1b".$crp[4]."\x1b".$crp[5]."\x1b".$crp[6]."\x1b\n";
$fnfs += strlen($uuu[$ii]);
}}}} else {
if(!$sss[30] && $rdoct && (($rdoc && in_array($ii,$rdoc)) || ($rdoc == '' && ($ii == $thsp || $ii == $thsn)))) {$fdn[$rdoct] = $uuu[$ii];$fdl[$rdoct] = fgets($fl);$fdb[$rdoct] = strcut(fgets($fb),256);$rdoct--;}
else {fgets($fl);fgets($fb);}}
$ii++;
}
fclose($fl);
fclose($fb);
?>