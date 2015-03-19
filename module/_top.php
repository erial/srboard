<?php
if(!$set) {
session_start();
header ("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $sett[0]?></title>
<meta name="generator" content="srboard" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php
include("include/common.php");
$fsbs = array();
$bfsb = array();
$ctgo = array();
$fc = fopen($dc,"r");
$fs = fopen($ds,"r");
for($bs = 0;$bso = trim(fgets($fs));$bs++) {
$fco = trim(fgets($fc));
$bid = trim(substr($bso, 0, 10));
$bsof = substr($bso,75);
$bdidnm[$bid] = substr($bsof,0,strpos($bsof,"\x1b"));
$fsbs[$bid] = substr($bso,10);
$ctgo[$bid] = $fco;
}
fclose($fc);
fclose($fs);
if(@filesize($dxr."section.dat")) {
$fst = fopen($dxr."section.dat","r");
for($ii=1;$fsto = trim(fgets($fst));$ii++) {
$sect[$ii] = explode("\x1b",$fsto);
if($sect[$ii][2]) $bfsb[$ii] = explode("^",$sect[$ii][2]);
if(!$section) {
if($sect[$ii][1] == 3 && false !== strpos($_SERVER['REQUEST_URI'],$sect[$ii][2])) $section = $ii;
else {for($b = 0;$bfsb[$ii][$b];$b++) {if(($ex = strchr($bfsb[$ii][$b],'>')) && strpos($_SERVER['REQUEST_URI'],substr($ex,1)) !== false) {$section = $ii;break;}}}
}}
fclose($fst);
$fsta = fopen($dxr."section_add.dat","r");
for($ii=1;$ii < $section;$ii++) fgets($fsta);
$sectgt = fgets($fsta);
fclose($fsta);
if($sett[56] && @filesize($dxr."section_group.dat")) {
$i = 1;
$fsg = fopen($dxr."section_group.dat","r");
while($fsgo = trim(fgets($fsg))) {
$grp[$i] = explode("\x1b",$fsgo);
$i++;
}
fclose($fsg);
$sgp = $sect[$section][6];
if($grp[$sgp][1]) $sett[26] = $grp[$sgp][1];
}
}
if(!$sett26) $sett26 = $sett[26];
?>
<style type='text/css'>
body {font-family:Gulim; font-size:9pt; margin:0}
</style>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<?php if($sett26){?><link rel='stylesheet' type='text/css' href='module/<?php echo $sett26?>.css' />
<?php } if($sett[45]){?><link rel='stylesheet' type='text/css' href='widget/<?php echo $sett[45]?>.css' />
<?php } if($sett[48]){?><link rel='stylesheet' type='text/css' href='skin/<?php echo $sett[48]?>/style.css' />
<?php } if($sett[24]){?><link rel='stylesheet' type='text/css' href='<?php echo $sett[24]?>' />
<?php }?>
<script type='text/javascript'>
//<![CDATA[
var wopen = 1;
var setop = Array('<?php echo $isie?>','<?php echo $bwr?>',<?php echo (int)$srwtpx?>,'<?php echo $sett[55]?>','<?php echo (($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?php echo (($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','<?php echo $id?>',<?php echo (int)$sett[11]?>,<?php echo $ismobile?>,'<?php echo $bdidnm[$id]?>');

function setup() {
pview = $('pview');
sessno = <?php echo $sessno?>;
azax("exe.php?&onload=<?php echo $time?>&id=1",9);
}
function checkmemo(val) {
var mdiv = $('notifv');
if(val == 'new_memo') {
<?php
if($mbr_level && $sett[52] > 1 && $sett[57] != 'a' && $sett[57] <= $mbr_level) {
?>
var alertt = "";
if(('<?php echo $sett[52]?>' == '2' || '<?php echo $sett[52]?>' == '3' || '<?php echo $sett[52]?>' == '5' || '<?php echo $sett[52]?>' == '6')) alertt += "<input type='button' id='confirm_memo' class='srbt' value='쪽지가 도착했습니다' onclick='read(\"get\");hidedv(\"notifv\");' /><div class='fcler'></div>";
if('<?php echo $sett[52]?>' == '3' || '<?php echo $sett[52]?>' == '4' || '<?php echo $sett[52]?>' == '6') alertt += "<embed src='icon/memo.swf' type='application/x-shockwave-flash' autostart='true' loop='0' style='width:1px;height:1px' />";
if(parseInt('<?php echo $sett[52]?>') >= 4) read('get');
mdiv.innerHTML = alertt + moux;
mdiv.style.display = 'block';
<?php }?>
}
setTimeout('azax("exe.php?&check_memo=<?php echo $time?>&id=1&isvcnct=<?php echo $isvcnnct?>",9)',30000);
}
//]]>
</script>
</head>
<body class='bbody' onload='setup()'>
<span id='img' style='display:none;width:0;z-index:9'></span>
<div id='pview' style='display:none;padding:5px; line-height:130%;z-index:8'></div>
<script type="text/javascript" src="include/top.js"></script>
<script type="text/javascript" src="include/bottom.js"></script>
<?php
$set = '';
}
$srwpm = 0;
if($section && ($stb = @fopen($dxr."section_arr.dat","r"))) {
for($sb=1;$sb < $section;$sb++) fgets($stb);
$stbbo = explode("@@",trim(fgets($stb)));
fclose($stb);
if($id) $stbo = $stbbo[1];
else $stbo = $stbbo[0];
if($mbrphp || $self == 2) $stbo = str_replace(":chat","",$stbo);
$st_arr = explode("@",$stbo);
$stbL =  ($id)? (($wdth[5][5])? (int)substr($wdth[5],6,3):(((int)$stbbo[4])? (int)$stbbo[4]:$sett[69])):(((int)$stbbo[2])? (int)$stbbo[2]:(int)$sett[67]);
$stbR =  ($id)? (($wdth[5][5])? (int)substr($wdth[5],9,3):(((int)$stbbo[5])? (int)$stbbo[5]:$sett[70])):(((int)$stbbo[3])? (int)$stbbo[3]:(int)$sett[68]);
$stbLR67 =  ($id)?(int)$stbbo[7]:(int)$stbbo[6];
$srcol = 1;
$sett78 = ($id)? $sett[78]:(($sett[39] > $sett[78])? 0:$sett[78] - $sett[39]);
if($stbL && strpos($stbo,"@L:") !== false) {$srcol += 2;if(!$sett[77]) {$srwdth -= (int)$stbL;$srwdth -= $sett78;}} else $stbL = 0;
if($stbR && strpos($stbo,"@R:") !== false) {$srcol += 2;if(!$sett[77]) {$srwdth -= (int)$stbR;$srwdth -= $sett78;}} else $stbR = 0;
}
function secdiv($ishrz,$asc,$scmg) {
global $sect, $section, $bfsb, $bdidnm, $index, $sgp, $bwr, $id, $ismobile;
if($ishrz == 1) {
if($asc == 1) {
$t = 0;
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii][6] == $sgp) {if(!$t) $t = $ii;else {$t = 0;break;}}
}
if($t) {
$ccfsb = count($bfsb[$t]) -1;
if($ccfsb >= 0) {
for($i=0;$i <= $ccfsb;$i++) {
if(strpos($bfsb[$t][$i],'>')) {
$bfsd = explode('>',$bfsb[$t][$i]);
if($bfsd[2]=='nw') $bfsd[1] .= "' target='_blank";
else if($bfsd[2]=='js') $bfsd[1] = "#none' onclick='".$bfsd[1];
$secdiv .= "<a href='{$bfsd[1]}'><span>{$bfsd[0]}";
} else if($bfsb[$t][$i] !='>') {
if($id && $id == $bfsb[$t][$i]) $scn = " class='supsec'";
else if(!$id && !$secdiv) $scn = " class='supsec'";
else $scn = '';
$secdiv .= "<a{$scn} href='{$index}?id=".encodee($bfsb[$t][$i])."'><span>{$bdidnm[$bfsb[$t][$i]]}";
}
$secdiv .= "</span></a><img src='icon/t.gif' class='sec_between' alt='' />";
}
}
} else {
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii][6] != $sgp) continue;
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 's' && $sect[$ii][1] != 'x') {
if($section == $ii)  $scn = " class='supsec'";
else $scn = '';
if($sect[$ii][1] == 3) $secdiv .= "<a href='{$sect[$ii][2]}'>";
else if($sect[$ii][1] == 7) $secdiv .= "<a href='#none' onclick='{$sect[$ii][2]}'>";
else if($sect[$ii][1] == 6) $secdiv .= "<a target='_blank' href='{$sect[$ii][2]}'>";
else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) $secdiv .= "<a{$scn} href='{$index}?id={$sect[$ii][2]}'>";
else $secdiv .= "<a{$scn} href='{$index}?section={$ii}'>";
$secdiv .= "<span>{$sect[$ii][0]}</span></a><img src='icon/t.gif' class='sec_between' alt='' />";
}}}
return substr($secdiv,0,-51);
} else {
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii][6] != $sgp) continue;
else if(!$fstii) $fstii = $ii;
if($section == $ii) $scn = 2;
else if($scn) $scn--;
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 'x') {
$sccn = ($scn)? '2':'';
$scnn = ($scn == 2)? 'stt2':'stt1';
if($fstii != $ii) $secdiv .= "<img src='icon/t.gif' class='sect_btw{$sccn}' alt='' />";
if($sect[$ii][1] == 3) $secdiv .= "<div class='{$scnn}' onclick=\"rplace('{$sect[$ii][2]}')\"";
else if($sect[$ii][1] == 7) $secdiv .= "<div class='{$scnn}' onclick=\"".str_replace('"','\'',$sect[$ii][2])."\"";
else if($sect[$ii][1] == 6) $secdiv .= "<div class='{$scnn}' onclick=\"nwopn('{$sect[$ii][2]}')\"";
else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) $secdiv .= "<div class='{$scnn}' onclick=\"rplace('{$index}?id={$sect[$ii][2]}')\"";
else if($sect[$ii][1] == 's') $secdiv .= "<div class='{$scnn}'";
else $secdiv .= "<div class='{$scnn}' onclick=\"rplace('{$index}?section={$ii}')\"";
$ssid = ($scn == 2)? " id='stt2'":"";
$secdiv .= " onmouseover='sublist({$ii},this)'{$ssid}>{$sect[$ii][0]}</div>";
}
}
$secdiv2 = "var slist = Array(''";
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii]) $secdiv2 .= ",";
if($sect[$ii][6] != $sgp) {$secdiv2 .= "''";continue;}
if($bfsb[$ii]) {
$arry = '';
$ccfsb = count($bfsb[$ii]) -1;
for($i=0;$i <= $ccfsb;$i++) {
if(strpos($bfsb[$ii][$i],'>')) {
$bfsd = explode('>',$bfsb[$ii][$i]);
$arry .= "Array('_".$bfsd[2]."','".$bfsd[0]."','".$bfsd[1]."'),";
} else if($bfsb[$ii][$i] !='>') $arry .= "Array('".encodee($bfsb[$ii][$i])."','".$bdidnm[$bfsb[$ii][$i]]."'),";
}
$secdiv2 .= "Array(".substr($arry,0,-1).")";
} else $secdiv2 .= "''";
}
$secdiv2 .= ");";
return array($secdiv,$secdiv2);
}} else {
if($scmg) $secdiv .= "<li class='supsec'><img src='icon/t.gif' alt='' style='width:{$scmg}px' /></li>";
if($bwr == 'ie6') $iesix = "onmouseover='this.className=\"iesix\"' onmouseleave='this.className=\"\"'";
else  $iesix = "";
for($ii=(($asc==1)? count($sect):1);$sect[$ii];$ii=(($asc==1)? $ii-1:$ii+1)) {
if($sect[$ii][6] != $sgp) continue;
if($ii == 1) $active = " first";
else $active = "";
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 'x') {
if($sect[$ii][1] == 3) $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></li>";
else if($sect[$ii][1] == 7) $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='#none' onclick='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></li>";
else if($sect[$ii][1] == 6) $secdiv .= "<li class='supsec{$active}'><a class='trigger' target='_blank' href='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></li>";
else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='{$index}?id={$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></li>";
else {
if($section == $ii) $active .= " active";
$ccfsb = count($bfsb[$ii]) -1;$usmobile = 0;
if($sect[$ii][1] == 's' || ($ismobile && $ccfsb >= 0)) {$secdiv .= "<li class='supsec{$active}'><a class='trigger' href='#none'><span>{$sect[$ii][0]}</span></a>";if($ismobile) $usmobile = 1;}
else $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='{$index}?section={$ii}'><span>{$sect[$ii][0]}</span></a>";
if($ccfsb >= 0) {
$secdiv .= "<ul>";
if($usmobile) $secdiv .= "<li {$iesix}><a href='{$index}?section={$ii}'><b>{$sect[$ii][0]}</b></a></li>";
for($i=0;$i <= $ccfsb;$i++) {
if(strpos($bfsb[$ii][$i],'>')) {
$bfsd = explode('>',$bfsb[$ii][$i]);
if($bfsd[2]=='nw') $bfsd[1] .= "' target='_blank";
else if($bfsd[2]=='js') $bfsd[1] = "#none' onclick='".$bfsd[1];
$secdiv .= "<li {$iesix}><a href='{$bfsd[1]}'>{$bfsd[0]}</a></li>";
} else if($bfsb[$ii][$i] !='>') $secdiv .= "<li {$iesix}><a href='{$index}?id=".encodee($bfsb[$ii][$i])."'>{$bdidnm[$bfsb[$ii][$i]]}</a></li>";
}
$secdiv .= "</ul></li>";
} else $secdiv .= "</li>";
}
if($ishrz == 3) $secdiv .= "<li class='supsec'><img src='icon/t.gif' alt='' /></li>";
}
}
return $secdiv;
}}
?>

