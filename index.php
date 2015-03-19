<?php
session_start();
header ("Content-Type: text/html; charset=UTF-8");
/*
 *  srboard 40.60
 * -------------------------------
 * Developed By 사리 (sariputra3@naver.com)
 * License : GNU Public License (GPL)
 * Homepage : http://srboard.styx.kr
 */
//if($_SERVER['HTTP_REFERER'] == "http://{$_SERVER['HTTP_HOST']}/") exit;
include("include/common.php");
$title = $sett[0];
$flo = '';
$memb = '';
$onload = '';
$vtrpc = array(0,0,0);
if(_GET('keyword')) {$gkeyword = trim($_GET['keyword']);$_GET['keyword'] = stripslashes($gkeyword);} else $gkeyword = '';
if($id && ($sss[23] == 'a' || $sss[23] > $mbr_level)) $authority_read = 3; else $authority_read = 0;
if($id && (_GET('no') || _GET('link'))) {include("include/view.php");$title = "[{$wdth[1]}] ".$flo[3];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title?></title>
<meta name="generator" content="<?php echo $srboard?>" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php if($ismobile) {?>
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.5, minimum-scale=0.5, width=device-width" />
<?php
} if($sett[31]) {?>
<link rel="shortcut icon" type="image/x-icon" href="http://<?php echo $_SERVER['HTTP_HOST']?>/favicon.ico" />
<?php }
if(_GET('count_add') || _GET('view')) include("include/referer.php");
function getmicrotime()
{
    $msec = microtime();
    return substr($msec,19) + substr($msec,0,10);
}
function strcut($str, $len){
$str = trim($str);
if($len){
$str = str_replace("<br />"," ",$str);
$str = strip_tags($str);
if(strlen($str) > $len) {
$str = substr($str, 0, $len + 1);
$end = $len;
if(ord($str[$end -2]) < 224 && ord($str[$end]) > 126) {
while(ord($str[$end]) < 194 && ord($str[$end]) > 126) $end--;
$str = substr($str, 0, $end)."..";
} else $str .= "..";
}
$isa = strpos(substr($str,-8),"&");
if($isa) $str = substr($str,0,-8 + $isa);
$str = str_replace("\\", "＼", $str);
}
if($end = strpos($str,"\x1b")) $str = substr($str,0,$end);
return trim($str);
}
$time_start = getmicrotime();
function name($name, $mn, $target, $ico, $url) {
global $sett,$sss,$fmm;
if($sss[64]) $namee = $name;
else {
$name = trim($name);
if($target == 1) $adtarget="_parent";
else $adtarget="_self";
$namee = $is80 = $m = '';
if($mn) {
if(file_exists("icon/m20_".$mn)) {
if($sett[44] == 2 || $sett[44] == 3) $is80 = 1;
if($sett[44] == 1 || $sett[44] == 3) $is60 = 1;
$umg = 'icon/m20_'.$mn;
$isumg = 1;
} else {$umg = 'icon/noimg.gif';$isumg = 0;}
if($sett[91][0] == '4' && $ico) $ico = 0;else if($sett[91][0] == '5' && !$ico) $ico = 1;
if(!$ico || $sett[91][0] == '1' || $sett[91][0] == '3') {
if($sett[90]) $namee .= "<img class='icolv' src='icon/pointlevel/".(($sett[91][1] && $fmm[$mn][2] == '9')? 'm':$fmm[$mn][16]).".gif' alt='' />";
else $namee .= "<img src='icon/v".$fmm[$mn][2].".gif' class='mblv' alt='' />";
}
if($ico || ($isumg && ($sett[91][0] == '2' || $sett[91][0] == '3'))) {
if($is60) $namee .= "<img src='{$umg}' onmouseover='imgview(this.src,9)' onmouseout='imgview(0)' class='icos' alt='' />";
else $namee .= "<img src='{$umg}' class='icos' alt='' />";
}
$m = 'mb';
}
$namee .= "<a href='#none' class='{$m}nick' onclick=\"wwname('".urlencode($name)."','{$mn}','{$adtarget}','{$url}','{$is80}')\">";
$namee .= ($_GET['search'] == 'n')? str_replace($_GET['keyword'], "<span class='keyword'>{$_GET['keyword']}</span>",$name):$name;
$namee .="</a>";
}
return $namee;
}
function tagcut($tag, $rkin) {
$glen = strpos($rkin,"<sr_".$tag.">");
if($glen !== false) {
$head = $glen + strlen($tag) + 5;
return substr($rkin, $head, strpos($rkin,"</sr_".$tag.">") - $head);
} else return '';
}
function inclvde($data) {
if(strpos($data,'<;>') !== false) $data = preg_replace("`<;>(.+)<!--/-->`sU","",$data);
$data = str_replace("<!--/-->","",$data);
if(strpos($data,'<#') !== false) {
$data = preg_replace("`<#[^#]+#>`","",$data);
$gtis = strpos($data,'<##');
if($gtis !== false) {
echo substr($data,0,$gtis);
$gtin = explode('<##',substr($data,$gtis));
$gtinc = count($gtin);
for($igt = 1;$igt < $gtinc;$igt++) {
$gtine = strpos($gtin[$igt],'##>');
$gtinf = substr($gtin[$igt],0,$gtine);
if($gtinf[0] == '#') $return[] = array(1,substr($gtinf,1,-1));
else if(@filesize($gtinf)) $return[] = array(2,$gtinf);
$return[] = array(0,substr($gtin[$igt],$gtine + 3));
}} else $return[] = array(0,$data);
} else $return[] = array(0,$data);
return $return;
}
if($id && !$sss) {
scrhref('?',0,0);
exit;
}
if($slss[4]) $fz = $slss[4];
if(_COOKIE('cfsz')) $fz = $_COOKIE['cfsz'];
else if(!_VAR($fz)) $fz = '9';
$faz = array('Gulim','Dotum','Batang','Gungsuh','Malgun Gothic','Arial','Tahoma','Verdana','Trebuchet MS','sans-serif');
$faze = (isset($wdth[8][0]) && $wdth[8][0])? $faz[$wdth[8][0]]:$faz[0];
if(_GET('signup') || _POST('join') || _GET('mbr_info')) $mbrphp = 1;else $mbrphp = 0;
if($id) {
if($csf = @fopen($dxr.$id."/set.dat","r")) {$csff[0] = trim(fgets($csf));$csff[1] = trim(fgets($csf));$csff[2] = trim(fgets($csf));$csff[3] = (int)fgets($csf);fclose($csf);if($csff[3]) $sett[21] = $csff[3];}
if($_GET['comment'] && $csff[0]) $srk = $csff[0];
else $srk = ($slss[2])? $slss[2]:$wdth[2];
} else $srk = ($slss[2])? $slss[2]:$sett[1];
if($ismobile == 2) $srk = 'mobile';
if($id && $sss[29]) echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"[{$sett[0]}] - {$bdidnm[$id]}\" href=\"{$sett[14]}exe.php?rss={$id}\" />\n";
if($sect[$section][2]) echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"[{$sett[0]}] - {$sect[$section][0]} -\" href=\"{$sett[14]}exe.php?rssfeed={$section}\" />\n";
$sectcss = "module/sectcss_".$section.".css";
if(!file_exists($sectcss) || !filesize($sectcss)) $sectcss = '';
?>
<link rel="alternate" type="application/rss+xml" title="[<?php echo $sett[0]?>] - 전체" href="<?php echo $sett[14]?>exe.php?rssfeed=all" />
<style type='text/css'>
<?php if($_GET['comment']) {?>
body {overflow:hidden; font-family:Gulim; font-size:9pt; margin:0}
<?php } else {?>
body {font-family:Gulim; font-size:9pt; margin:0}
<?php }?>
.bdo, .bdo div {font-size:<?php echo $fz?>pt; font-family:<?php echo $faze?>;}
</style>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<?php if($sett[26]){?><link rel='stylesheet' type='text/css' href='module/<?php echo $sett[26]?>.css' />
<?php } if(!$id && $sett[45]){?><link rel='stylesheet' type='text/css' href='widget/<?php echo $sett[45]?>.css' />
<?php } if($sectcss){?><link rel='stylesheet' type='text/css' href='<?php echo $sectcss?>' />
<?php }?>
<link rel='stylesheet' type='text/css' href='skin/<?php echo $srk?>/style.css' />
<!--[if IE]>
<style type='text/css'>
td, div {word-break:break-all; text-overflow:ellipsis}
</style>
<![endif]-->
<!--[if lte IE 6]>
<link rel='stylesheet' type='text/css' href='include/ie6.css' />
<![endif]-->
<?php if($ismobile == 2) {?>
<style type='text/css'>
</style>
<?php }
if($sett[77]) {?>
<style type='text/css'>.nobr {white-space:normal}
<?php if(!$id) {?>#srgate dt span, #srgate .nL4 {float:none; display:inline} #srgate span.lnkrp a.rp {display:inline-block}
<?php } else {?>#bd_main dt span {float:none; display:inline}<?php }?>
</style><?php }
if($sett[24]) {?>
<link rel='stylesheet' type='text/css' href='<?php echo $sett[24]?>' /><?php }
if(file_exists('icon/style.css')) {?>
<link rel='stylesheet' type='text/css' href='icon/style.css' /><?php }
if(_VAR($csff[2])) {?>
<link rel='stylesheet' type='text/css' href='<?php echo $csff[2]?>' />
<?php }?>

<script type='text/javascript'>
var wopen = 1;
var setop = Array('<?php echo $isie?>','<?php echo $bwr?>',<?php echo (int)$srwtpx?>,'<?php echo $sett[55]?>','<?php echo (($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?php echo (($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','<?php echo $id?>',<?php echo (int)$sett[11]?>,<?php echo $ismobile?>,'<?php echo $bdidnm[$id]?>');

</script>
</head>
<?php
if($_GET['comment']) {
?>
<body class='cbody' onclick="if(pxxx.wopen==2) pxxx.imgview(0);">
<?php
} else if($aview) {
?>
<body class='bbody' onselectstart="return false" style="-moz-user-select:none">
<?php
} else {
?>
<body class='bbody'>
<?php
if($sett[2]) include($sett[2]);
}
?>
<span id='img' style='position:absolute'></span>
<div id='pview' style='display:none;padding:5px; line-height:130%;position:absolute'></div>
<script type="text/javascript" src="include/top.js"></script>
<script type='text/javascript'>
//<![CDATA[
function searchc(val) {
if(document.sform.keyword.value != '' && document.sform.keyword.value == '<?php echo $gkeyword?>') location.href='?<?php echo $_SERVER['QUERY_STRING']?>'.replace(/&search=[a-z]/i,'&search=' + val).replace(/&p=[0-9]+/i,'&p=1');
}
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
<?php if($dxr && $_GET['block5']) {
if($sss[22] == 'a' || $sss[22] > $mbr_level) exit;
if($isie == 1) {?>
setTimeout("$('bdo-1').innerHTML = dialogArguments.ajaxx;img_resize();document.body.style.overflowX = 'hidden';document.body.style.background = '#FFFFFF';",500);
<?php }}?>
//]]>
</script>
<?php
if($dxr && _GET('block5')) {echo "<div id='bdo-1' class='bdo block5' style='padding:20px 10px 10px 30px'></div></body></html>";exit;}
if($dxr && !$_GET['comment']) {
if(_GET('type') && $sss[53]) $_GET['type'] = '';
if($_GET['type']) $type= $_GET['type'];
else if($id) $type = $sss[26];else $type = '';
$length = strlen(_GET('date'));
if($length < 4 || $length%2) $_GET['date'] = '';
if($type == 'k') {
$otype = 'k';
$mcnt = 1;
if($length > 6) $_GET['date'] = substr($_GET['date'],0,6);
else if($length == 4)  $_GET['date'] .= "01";
$fr = fopen($dxr.$id."/date.dat","r");
while(!feof($fr)){
if($fro = trim(fgets($fr))){
$ymdn = substr($fro, 0, 4)."년 ".substr($fro, 4, 2)."월 (".substr($fro, 6).")";
if(!$_GET['date'] && ($_GET['p'] == $mcnt || !$_GET['p'] && $mcnt == 1)) {$calp = $mcnt;$_GET['date'] = substr($fro,0,6);$isnt = substr($fro,6);$months .= "<option value='{$mcnt}' selected='selected'>$ymdn</option>";}
else if($_GET['date'] && substr($_GET['date'],0,6) == substr($fro,0,6)) {$calp = $mcnt;$isnt = substr($fro,6);$months .= "<option value='{$mcnt}' selected='selected'>$ymdn</option>";}
else $months .= "<option value='{$mcnt}'>$ymdn</option>";
$mcnt++;
}}
fclose($fr);
$_GET['p'] = 1;
$mcnt--;
}
if(!$sett[41] || $sett[41] == 1) $bhlct = '';
else {
$bhlct = "<a href='{$index}'>HOME</a>";
if($sett[41] != 2 && $sett[41] != 6 && $sett[41] != 7 && $grp[$sgp]) $bhlct .= " &gt; <a href='{$index}?group={$sgp}'>{$grp[$sgp][0]}</a>";
if($sett[41] != 3 && $sett[41] != 5 && $sett[41] != 7 && $section && (count($bfsb[$section]) > 1 || $sett[40])) $bhlct .= " &gt; <a href='{$index}?section={$section}'>{$sect[$section][0]}</a>";
if($sett[41] != 4 && $sett[41] != 5 && $sett[41] != 6) $bhlct .= " &gt; <a href='{$dxpt}&amp;p=1'>{$wdth[1]}</a>";
}
if($sett[26]) include('module/'.$sett[26].'.php');
if($ismobile == 2 || $sett[77] == 1) $srwdthx = '100%';
else $srwdthx = $srwdth.'px';
if($id && $sett[41]){?><div class='bd_name'><h2><?php if($sss[29]){?><a target='_blank' href='exe.php?rss=<?php echo $id?>'><img src='icon/rss.gif' alt='' border='0' /></a><?php } else {?><img src='icon/norss.gif' alt='' border='0' /><?php }?><a href='<?php echo $dxpt?>'><?php echo $bdidnm[$id]?></a></h2><div><?php echo $bhlct?>&nbsp;</div></div><?php }
if($_GET['signup'] || $_POST['join'] || $_GET['mbr_info'] || _GET('findw')) {?><div class='bd_name'><h2><img src='icon/sy.gif' alt='' /><?php if($_GET['signup']) echo "이용약관과 개인정보 취급방침";else if($_POST['join']) echo "회원가입";else if($_GET['mbr_info']) echo "회원정보";else echo "검색어 : ". $_GET['findw'];?></h2><div></div></div><?php }
else if(!$ismobile && (($sett[16][0] && !$id) || ($id && (($sett[16][2] && $_GET['no']) || ($sett[16][1] && !$_GET['no'])))) && @filesize($dxr."head")) {if($sett[32]) @readfile($dxr."head");else include($dxr."head");}
}
if($mbrphp) {echo "<center>";include("include/mbr.php");echo "</center>";}
else {
$rt = "";
$rrt = "";
if($_GET['keyword']) $rt .= "&amp;search=".$_GET['search']."&amp;keyword=".urlencode($_GET['keyword']);
if(_GET('c')) $rrt .= "&amp;c=".$_GET['c'];
if(_GET('arrange')) $rrt .= "&amp;arrange=".$_GET['arrange']."&amp;desc="._GET('desc');
if(_GET('m')) $rrt .= "&amp;m=".$_GET['m'];
if($type != 'k' && $_GET['date']) $rrt .= "&amp;date=".$_GET['date'];
$rt .= $rrt;
if(_GET('ct')) $rt .= "&amp;ct=".$_GET['ct'];
if($_GET['type']) $rt .= "&amp;type=".$_GET['type'];
if(_GET('xx')) $rt .= "&amp;xx=".$_GET['xx'];
$crt = preg_replace('`&amp;ct=[0-9]+`', '', $rt)."&amp;p=1";
if(!$_GET['comment']) {
$day = date("d",$time);
if(_COOKIE('visit') != $day) {
$onload .= "mkcookie('visit','{$day}',1);\n";
if($_SESSION['visit'] != $day) {
$_SESSION['visit'] = $day;
$countadd = $index."?count_add=".base64_encode(str_pad($_SERVER['REMOTE_ADDR'], 15)."\x1b".$_SERVER['QUERY_STRING']."\x1b".$_SERVER['HTTP_REFERER']);
}}
?>
<iframe name="exe" style="display:none;width:0;height:0" src="<?php echo $countadd?>"></iframe>
<?php
}
$srkn = '';
$sr = fopen("skin/".$srk."/skin.html","r");
while($sro = fgets($sr)) $srkn .= $sro;
fclose($sr);
$srkn = str_replace("<#index#>",$index,$srkn);
$srkn = str_replace("<#exe#>","exe.php",$srkn); /* 38.20에서 삭제된 부분*/
$srkn = str_replace("<#bd_width#>",$srwdthx,$srkn);
$srkn = str_replace("<#bd_url#>",$sett[14],$srkn);
if($mbr_no >= 1) {
$srkn = str_replace('<#ismbr#>','',$srkn);
$srkn = str_replace('<#isxmbr#>','<;>',$srkn);
} else {
$srkn = str_replace('<#ismbr#>','<;>',$srkn);
$srkn = str_replace('<#isxmbr#>','',$srkn);
}
$skv = tagcut('top',$srkn);
if($sett[62]) $sett[62] = $time - $sett[62]*21600;
else $sett[62] = 9999999999;
if($id) {
function uplist($uno) {
global $dxr, $id, $du, $wdth;
$drctry = ($wdth[7][33])? "icon/".$id."/":$dxr.$id."/files/";
$fu = fopen($du ,"r");
while(!feof($fu)) {
	$fuo = fgets($fu);
	if((int)substr($fuo, 0, 6) == $uno) {
		$nfile = substr($fuo, 6, -13);
		if($nfile[20] == '/') {$mfile = $drctry.substr($nfile,0,20);$nfile = substr($nfile,21);}
		else $mfile = $drctry.str_replace("%","",urlencode($nfile));
		if($sfile = @filesize($mfile)) {
		$ufile = "exe.php?sls=".$id."/down/".(int)substr($fuo, -7, 6);
		$sfile = ($sfile >= 1048576)? sprintf("%.2f", ($sfile / 1048576))."mb":sprintf("%.2f", ($sfile / 1024))."kb";
		$sfile .= " : ".(int)substr($fuo, -13, 6)."회";
		$memx .= "<img src='icon/f.png' style='width:13px;height:13px;vertical-align:middle;margin-right:3px' alt='' /><a target='_blank' href='".$ufile."'>".$nfile." ( ".$sfile." )</a> &nbsp; ";
	}
}
}
fclose($fu);
if($memx) return "<div class='uplist'><b>첨부파일</b> : ".$memx."</div>";
}
$keyw = array();
if($_GET['search'] == 'n' || $_GET['search'] == 'ip' || $_GET['search'] == 't' || $_GET['search'] == 'r' || $_GET['search'] == 'rip') $keyw[0] = $_GET['keyword'];
else {
$keywrd2 = str_replace('\'','"',$_GET['keyword']);
$keyu = array();$keyy = array();
if(strpos($keywrd2,'"') !== false) {
while(($kew = strpos($keywrd2,'"')) !== false) {
$keywrd = substr($keywrd2,0,$kew);
$keywrd2 = substr($keywrd2,$kew + 1);
if(($kex = strpos($keywrd2,'"')) !== false) {
$keyv = explode(" ",$keywrd);
$keyv[] = substr($keywrd2,0,$kex);
$keywrd2 = substr($keywrd2,$kex + 1);
$keyu = array_merge($keyu, $keyv);
} else {if(!count($keyu)) $keywrd = $_GET['keyword'];if($keywrd) {$keyv = explode(" ",$keywrd);$keyu = array_merge($keyu, $keyv);}}
}
if($keywrd2) {$keyv = explode(" ",$keywrd2);$keyu = array_merge($keyu, $keyv);}
} else $keyy = explode(" ",$_GET['keyword']);
if(count($keyu)) $keyy = array_merge($keyu,$keyy);
foreach($keyy as $key => $value) {if($value) $keyw[] = $value;}}
$keywc = count($keyw) - 1;
$srkin = tagcut('id',$srkn);
$srkin = str_replace("<#id#>",$id,$srkin);
$srkin = str_replace("<#eid#>",$id,$srkin);
$srkin = str_replace("<#bd_name#>",$wdth[1],$srkin);
if(!$_GET['comment']) {
$skv .= tagcut('head',$srkin);
if($inclwt=inclvde($skv)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) {if($sett[92][0] == '2' || $sett[92][0] == '3') $gmtime = getmicrotime();include($inxv[1]);if($sett[92][0] == '2' || $sett[92][0] == '3') echo "<!--".$inxv[1]." 처리시간:: ".(getmicrotime() - $gmtime)." -->";}else {?><?php echo $inxv[1]?><?php }}
function nocopy($txt) {
global $aview, $noright;
if($aview && !$noright) {
if($aview < 3) $txt = "<div onselectstart='return false' style='-moz-user-select:none'>".$txt."</div>";
else if($aview == 3) $txt = "<div id='ifr_bdo' onselectstart='return false' style='-moz-user-select:none'></div>";
else if($aview == 4) $txt = "<iframe id='ifr_bdo' style='border:0' frameborder='0'></iframe>";
else if($aview >= 5) $txt = "<div style='padding:120px 0px 100px 0;margin-right:20px'><div style='background:#000;color:#FFF;font-size:25px;line-height:40px;padding:25px'>본문은 팝업으로 뜹니다<br />IE에서만 보입니다.</div></div>";
}
return $txt;
}
}
if(!$xx && $_GET['xx']) $xx = $_GET['xx'];
if($slss[5]) $isnt= $slss[5];
if(($sss[26] === 'a'||$sss[63]||$sss[26] == 'g') && ($_GET['type'] == 'b'||$_GET['type'] == 'c'||$_GET['type'] == 'd')) $isnt = (int)($isnt/2);
if(!$_GET['comment'] && (!$ismobile || $sss[70]) && @filesize($dxr.$id."/head.dat")) {if($sett[32]) @readfile($dxr.$id."/head.dat");else include($dxr.$id."/head.dat");}
if(_POST('edit') == "unlock") $_GET['no'] = $_POST['no'];
if(!_GET('p')) $gp = 1;
else $gp = $_GET['p'];
if($sss[22] != 'a' && $sss[22] <= $mbr_level){
function imn($mm,$mddlt,$body,$nn,$xx,$isdoc) {
global $mbr_no,$mbr_level,$sett;
if(!$mm) {$vmd = 3;$vlt = 3;}
else if($mm == $mbr_no || $mbr_level == 9) {$vmd = 4;$vlt = 4;}
else {$vmd = 2;$vlt = 2;}
if($mddlt[0] === 4) $vmd = 0;
if($mddlt[1] === 4) $vlt = 0;
if($isdoc) {
if($vlt == 0 && $sett[72] < 2) $body = str_replace('<#is_delete#>','<;>',$body);
else $body = str_replace("<#jsdelete#>","'delete',{$vlt},'{$nn}','{$xx}'",$body);
if($vmd == 0 && $sett[72] < 2) $body = str_replace('<#is_edit#>','<;>',$body);
else $body = str_replace("<#jsedit#>","'edit',{$vmd},'{$nn}','{$xx}'",$body);
} else {
if($vlt == 0 && (!$sett[72] || $sett[72] == 2)) $body = str_replace('<#isrdlnk#>','<;>',$body);
else $body = str_replace("<#rdlnk#>","rfpass('del_reple','{$vlt}','a',{$nn})",$body);
if($vmd == 0 && (!$sett[72] || $sett[72] == 2)) $body = str_replace('<#isrmlnk#>','<;>',$body);
else $body = str_replace("<#rmlnk#>","rpmod('{$vmd}',{$nn})",$body);
}
return $body;
}
function skword($kword) {
global $keyw;
for($k = 0;$keyw[$k];$k++) {$kword = str_replace($keyw[$k], "<span class='keyword'>{$keyw[$k]}</span>",$kword);}
return $kword;
}
$appo = ($mbr_level < $wdth[9][0] || $authority_read || ($vtrpc[0] && $sett[72] < 2))? 1:0;
if(!$sss[60] || $appo === 1) $srkin = str_replace('<#is_appr#>','<;>',$srkin);
if(!$sss[61] || $appo === 1) $srkin = str_replace('<#is_oppo#>','<;>',$srkin);
if($mbr_level < $wdth[9][0] || $authority_read || $sss[49] != '2') $srkin = str_replace('<#is_accs#>','<;>',$srkin);
if($_GET['c'] || $_GET['m'] || $_GET['keyword'] || $_GET['date']) $cmkd = 2; else $cmkd = 0;
if($cmkd == 2 || $_GET['ct'] || $_GET['arrange'] || $sss[65]) $schphp = 1; else $schphp = 0;
$ida = '';
if($_GET['no']) {
// 게시물 본문 출력
if($ismobile == 2) $sss[30] = 0;
include("include/view2.php");
} else if($_GET['comment'] || $_GET['rp_view']) {
include("include/comment.php");
if($_GET['comment']) exit;
else {
$_GET['comment'] = '';
$_GET['no'] = $_GET['rp_view'];
}} else {
$sss[30] = 1;
$crtime = $time - $cuttime[$sett[71][17]];
?>
<script type='text/javascript'>document.title="[<?php echo $sett[0]?>] <?php echo $wdth[1]?>";</script>
<?php
}
// 게시판 목록 시작
if(!$_GET['p']) $_GET['p'] = 1;$newwin = '';$nscc = 0;
if($sss[30]){
if($type == 'k') {
if($_GET['type'] == 'a' || $_GET['c'] || $_GET['m'] || $_GET['keyword'] || $_GET['arrange'] || $_GET['no']) $type = 'a';
$_SERVER['QUERY_STRING'] = preg_replace("`&(amp;)?date=[0-9]+`i","",$_SERVER['QUERY_STRING']);
} else if($sss[26] == 'e') {
if($_GET['type'] == 'a' || $cmkd == 2 || $_GET['ct'] || $_GET['arrange']) {$type = 'a'; $isnt = $isnt*$sett[19];}
else if($_GET['no']) $type = 'a';
else $type = 'b';
}
if($type == 'c') $len = 320;
else if($type == 'b'||$type == 'd') $len = 0;
else $len = 256;
if($_GET['xx'] > 0) $idd = $id."/^".$_GET['xx'];
else $idd = $id;
if(!$ismobile && ($sss[28] == 1 || $sss[28] == 3) && ($type == 'a' || $type == 'g')) $sss[28] = 4;else if($type == 'g') $onload .= "thtcg = 1;";
if($sss[32] == 1 || $sss[32] == 3) $sss[32] = 4;
if($sss[71] == 1 || $sss[71] == 3) $sss[71] = 4;
if($sss[72] == 1 || $sss[72] == 3) $sss[72] = 4;
if($sss[73] == 1 || $sss[73] == 3) $sss[73] = 4;
if($sss[73] != 4 && $_GET['search'] != 'b' && (!$sss[54] || !$wdth[7][0])) $bodd = "";
else $bodd = "/body.dat";
$uuu = "";
if($sss[64] && $_GET['m']) {scrhref($dxpt,0,'익명게시판에서는  회원검색이 안됩니다');exit;}
if($schphp) {
if($type != 'g' && ($sett[10] == '1' || $sett[10] == '2')) $newwin = '" target="_blank" rel="';
if(!$_GET['arrange'] && $sss[65] && $cmkd != 2) $_GET['arrange'] = 'hot';
if($sss[65] || (_COOKIE($docoo) && $_COOKIE[$docoo] == $dockie)) include("include/search.php");
} else {
if(!$_GET['xx']) {
$start = $isnt*($gp - 1);
if($fnt < $start) {
$ftt = $start - $fnt;
$ih = $start - $fnt;
if($wdth[6]) {
for($i = $wdth[6];$i > 0;$i--) {
$fnnt = substr($do[$i], 12, 6);
$ftt -= $fnnt;
if($ftt < 0) {
$ida = $i;
$start = $ih;
break;
} else $ih -= $fnnt;
}}
} else $ida = "";
if($ida > 0) {$idd = $id."/^".$ida;$xx = $ida;}
else $idd = $id;
} else {
$idd = $id."/^".$_GET['xx'];
$start = $isnt*($_GET['p'] - 1);
$fct = $fnt;
}
$end = $start + $isnt;
$n = $isnt;
if($type == 'a' && $wdth[4]) {
if(!$nscc) {
$nss = explode('^', $wdth[4]);
$nsc = count($nss) -1;
$nscc = $nsc;
}
if($_GET['p'] > 1) $start = $start - $nsc;
$end = $end - $nsc;
if($_GET['p'] == 1) {
$a = fopen($dxr.$id."/notice.dat","r");
for($aa=0;!feof($a);$aa++) $fns[$aa] = fgets($a);
fclose($a);
$ncc = 0;
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
if($bodd) $fb = fopen($dxr.$idd.$bodd,"r");else $fb = 0;
while($i < $end) {
	$fno = fgets($fn);
if($n == 0) break;
if($fno == "" || $fno == "\n") {
list($ida,$fn,$fl,$fb) = data6($ida,array($fn,$fl,$fb),0);
if($ida == 'q') break;else $xx = $ida;
} else {
if($i >= $start && $fno[6] != 'a') {
	$fda[$n] = $ida;
	$fdn[$n] = $fno;
	$fdl[$n] = fgets($fl);
	if($bodd) {$fbo = fgets($fb);$fdb[$n] = strcut($fbo, $len);if($sss[54] && $wdth[7][0]) $faf[$n] = substr($fbo,strpos($fbo,"\x1b"));}
	$fdu[substr($fno,0,6)] = 1;
	$n--;
	} else {
if($fno[6] == 'a') $end++;
fgets($fl);
if($bodd) fgets($fb);
}
$i++;
}
}
fclose($fn);
fclose($fl);
if($bodd) fclose($fb);
}} // 415
$ida = '';
$fu = fopen($dxr.$id."/upload.dat","r");
while($fuo = substr(fgets($fu),0,6)) {if(isset($fdu[$fuo]) && $fdu[$fuo] == 1) $fdu[$fuo] = 3;}
fclose($fu);
if($wdth[7][4]) {
	$fr = fopen($dxr.$id."/new_rp.dat","r");
	while(!feof($fr)){
	$fro = fgets($fr);
	$frn = substr($fro,0,6);
	if(trim($frn) && (_VAR($fdu[$frn]) == 1 || $fdu[$frn] == 3)) {
	if(substr($fro,34,10) > $sett[62]) $fdu[$frn] += 1;
	}}
	fclose($fr);
}
// 게시판 목록 윗부분
if(_VAR($fcct)) $fct=$fcct;
if(!_VAR($sum)) $sum=$fct;
else $fct--;
if(_VAR($fno) !== 'a') {
if(_GET('desc') == 'asc') $fno = $isnt*($gp-1) + 1;
else $fno = $fct - $isnt*($gp-1);
if(_VAR($nsc)) $fno = $fno + $nsc;
}
$ctgs = "";
if($type != 'd') {
if($wdth[7][30]) {
if(!$sss[53]) {
$ctgs .= "<a href=\"#\" title=\"제목형 목록\" class=\"aabcg\" onclick=\"this.blur();locato('type','a')\"><img src=\"icon/al.gif\" alt=\"목록형\" class=\"abcg\" /></a>
<a href=\"#\" title=\"본문형 목록\"  class=\"aabcg\" onclick=\"this.blur();locato('type','b')\"><img src=\"icon/bl.gif\" alt=\"본문형\" class=\"abcg\" /></a>
<a href=\"#\" title=\"요약형 목록\"  class=\"aabcg\" onclick=\"this.blur();locato('type','c')\"><img src=\"icon/cl.gif\" alt=\"요약형\" class=\"abcg\" /></a>
<a href=\"#\" title=\"갤러리형 목록\"  class=\"aabcg\" onclick=\"this.blur();locato('type','g')\"><img src=\"icon/gl.gif\" alt=\"갤러리형\" class=\"abcg\" /></a>
<a href=\"#\" title=\"달력형 목록\"  class=\"aabcg\" onclick=\"this.blur();locato('type','k')\"><img src=\"icon/kl.gif\" alt=\"달력형\" class=\"abcg\" /></a>";
}
if($wdth[7][35]) $ctgs .= "\n<a href=\"#\" title=\"로그인\" class=\"aabcg\" onclick=\"this.blur();rhref('?member_login=' + encodeURIComponent(document.passe.request.value))\"><img src=\"icon/ml.gif\" alt=\"로그인\" class=\"abcg\" /></a>";
if($wdth[7][34] == '1') {
$ctgs .= "\n<select class='t8' onchange='locato(\"date\",this.options[this.selectedIndex].value)'><option value=''>월별목록</option>";
$fr = fopen($dxr.$id."/date.dat","r");
while(!feof($fr)){
if($fro = trim(fgets($fr))){
$ymdn = substr($fro, 0, 4)."·".substr($fro, 4, 2)." (".substr($fro, 6).")";
$ym = substr($fro,0,6);
if($_GET['date'] && substr($_GET['date'],0,6) == $ym) $ctgs .= "<option value='{$ym}' selected='selected' style='background:#000;color:#fff'>$ymdn</option>";
else $ctgs .= "<option value='{$ym}'>$ymdn</option>";
}}
$ctgs .= "</select>";
}
if($ctg && $sss[27] == '1') {
$ctgs .= "\n<select id='ctt' class='t8' onchange=\"locato('ct',this.options[this.selectedIndex].value)\">";
$ctgs .= "	<option value='' class='t8'>분류</option>";
for($i = 1; $i <= $ctl; $i++){
$it = str_pad($i,2,0,STR_PAD_LEFT);
if($ctg[$it]) $ctgs .= "	<option value='{$it}' class='t8'>".preg_replace("`<[^>]+>`","",$ctg[$it])." ({$ctgn[$it]})</option>";
}
$ctgs .= "</select>";
}
if($sss[45] && $sss[47] && !$_GET['keyword'] && !$_GET['c']) {
function arraydsp($odr) {
if($_GET['arrange'] == $odr) {
if($_GET['desc'] == 'asc') return "style='background:#7df;'";
else return "style='background:#000;color:#fff'";
}}
$ctgs .= "\n<select class='t8' onchange='arrange(this.options[this.selectedIndex].value);'>
<option value='' class='t8'>정렬</option>
<option value='no' class='t8' ".arraydsp('no').">번호</option>
<option value='subject' class='t8' ".arraydsp('subject').">제목</option>
<option value='name' class='t8' ".arraydsp('name').">이름</option>
<option value='date' class='t8' ".arraydsp('date').">날짜</option>
<option value='view' class='t8' ".arraydsp('view').">조회</option>
<option value='rp' class='t8' ".arraydsp('rp').">덧글</option>";
if($sss[60]) $ctgs .= "\n<option value='appr' class='t8' ".arraydsp('appr').">추천</option>";
if($sss[61]) $ctgs .= "\n<option value='oppo' class='t8' ".arraydsp('oppo').">비추</option>";
if($wdth[7][5]) $ctgs .= "\n<option value='point' class='t8' ".arraydsp('point').">평점</option>";
$ctgs .= "\n<option value='hot' class='t8' ".arraydsp('hot').">활성</option>\n</select>";
}
}
if($sss[27] == '2' && $ctg) {
$ct_list = "<div class='ct_vtc'>";
foreach($ctg as $ii => $category) {
if($category) {
if($_GET['ct'] && $_GET['ct'] == $ii) $linK = 'slctd';
else $linK = '';
$ct_list .= "<input type='button' class='{$linK}' title='{$ctgn[$ii]}' onclick='locato(\"ct\",\"{$ii}\")' value='".preg_replace("`<[^>]*>`","",$category)."' />";
}}
$ct_list .= "</div>";
}} else $wdth[7][30] = 0;
/* 목록공통 상단 시작 */
$wtdh = $srwdth - 6;
if(_VAR($otype) && $otype == 'k') $_GET['p'] = $calp;
if($type == 'k') {
include('include/list_calendar.php');
} else {
$sr_list = tagcut('list',$srkin);
$list_top = tagcut('list_top',$sr_list);
if(_VAR($ct_list)) $list_top = str_replace("<#ct_list#>",$ct_list,$list_top);
if($wdth[7][30] == '1') $list_top = str_replace("<#icoselect#>",$ctgs,$list_top);
$srkiin = preg_replace("`<#[^#]+#>`","",$list_top);
$sr_cols = tagcut('list_head_cols',$sr_list);
if($sr_cols) {
function listr($xt) {
global $sss;
$s3859['no'] = $sss[38];
$s3859['name'] = $sss[39];
$s3859['date'] = $sss[40];
$s3859['visit'] = $sss[41];
$s3859['appr'] = $sss[42];
$s3859['oppo'] = $sss[59];
return $s3859[$xt];
}
$srcl = explode("<col ",$sr_cols);
for($i=0;isset($srcl[$i]);$i++) {
if($srcp = strpos($srcl[$i],'px')) {
$srcw = substr($srcl[$i],7,$srcp - 7);
if($srcw < 200) {
if(substr($srcl[$i-1],-2) == '#>') $srclw[substr($srcl[$i-1],-6,4)] = $srcw;
else $wtdh -= $srcw;
}}
if($i > 0) {$ix = $i -1;if(substr($srcl[$ix],-2) == '#>') {if(strpos($srcl[$i],'<!--/-->') !== false) {if($xtd = strpos($srcl[$ix],'<#x_')) {$xtd = substr($srcl[$ix],$xtd+4,-2);if(listr($xtd)) {if(!_VAR($xtx)) $xtx = $xtd;$xxt = $xtd;}}} else $xxt = '';}}
}
} else $srclw = array('isct'=>0,'x_no'=>0,'name'=>0,'date'=>0,'isit'=>0,'appr'=>0,'oppo'=>0);
if($ctg && $sss[48]) {$isct = 1;$wtdh -= $srclw['isct'];} // 게시판에 설정된 분류이름이 있으면
else {$sr_list = str_replace("<#isct#>","<;>",$sr_list);$isct = 0;}
$cols = $i - 7 + $sss[38] +$sss[39] +$sss[40] +$sss[41] +$sss[42] + $isct;
$sr_list = str_replace("<#cols#>",$cols,$sr_list);
if($type == 'b') $list_head = tagcut('list_head_b',$sr_list);
else if($type == 'c') $list_head = tagcut('list_head_c',$sr_list);
else if($type == 'g') $list_head = tagcut('list_head_g',$sr_list);
else if($type == 'd') {
$list_head = tagcut('list_head_d',$sr_list);
if($sss[24] != 'a' && $sss[24] <= $mbr_level) {
if($sett[82] < 3 || ($mbr_no && $sett[82] != 5)) $list_head = str_replace("<#isatspm#>","<;>",$list_head);
else {$list_head = str_replace("<#pno#>",$uzip,$list_head);}
$list_head = str_replace("<#yname#>",$uzname,$list_head);
$list_head = str_replace("<#ypass#>",$uzpass,$list_head);
$gwrt = "<input type='hidden' name='id' value='{$id}' />";
$gwrt .= "<input type='hidden' name='p' value='{$_POST['p']}{$_GET['p']}' />";
$gwrt .= "<input type='hidden' name='pno' value='{$uzip}' />";
$gwrt .= "<input type='hidden' name='spm' value='{$uzip}' />";
$list_head = str_replace("<#gwrt#>",$gwrt,$list_head);
} else $list_head = str_replace("<#gwrt#>","<script type='text/javascript'>document.guest_.style.display='none';</script>",$list_head);
?>
<script type="text/javascript" src="include/guest.js"></script>
<?php
}
if(!_VAR($list_head) || $type === 'a'){
if($type !== 'a') {$type = 'a';if($_GET['type']) $_GET['type'] = 'a';}
if(!$sss[38]) $sr_list = str_replace('<#x_no#>','<;>',$sr_list);else $wtdh -= $srclw['x_no'];
if(!$sss[39]) $sr_list = str_replace('<#x_name#>','<;>',$sr_list);else $wtdh -= $srclw['name'];
if(!$sss[40]) $sr_list = str_replace('<#x_date#>','<;>',$sr_list);else $wtdh -= $srclw['date'];
if(!$sss[41]) $sr_list = str_replace('<#x_visit#>','<;>',$sr_list);else $wtdh -= $srclw['isit'];
if(!$sss[42]) $sr_list = str_replace('<#x_appr#>','<;>',$sr_list);else $wtdh -= $srclw['appr'];
if(!$sss[59]) $sr_list = str_replace('<#x_oppo#>','<;>',$sr_list);else $wtdh -= $srclw['oppo'];
$list_a = tagcut('list_head_a',$sr_list);
if($xtx) $list_a = str_replace('<#x_'.$xtx.'#><td','<td class="list_tf"',$list_a);
else $list_a = str_replace('<td  ','<td class="list_tf" ',$list_a);
if($xxt) $list_a = str_replace('<#x_'.$xxt.'#><td','<td class="list_th"',$list_a);
else $list_a = str_replace('<td  ','<td class="list_th" ',$list_a);
$sr_cols = tagcut('list_head_cols',$sr_list);
$list_head = $sr_cols.$list_a;
}
$srkiin .= $list_head;
if($newwin) {$rrt = $rt;$rt = $newwin;}
if($fct > 0){
if(_VAR($fdn) && count($fdn) > 0){
$ii = 0;
$iii = 0;
if($type == 'c') $list_bodyy = tagcut('list_body_c',$sr_list);
else if($type == 'b') $list_bodyy = tagcut('list_body_b',$sr_list);
else if($type == 'g') $list_bodyy = tagcut('list_body_g',$sr_list);
else if($type == 'd') $list_bodyy = tagcut('list_body_d',$sr_list);
if(!_VAR($list_bodyy) || $type === 'a') $list_bodyy = tagcut('list_body_a',$sr_list);
$mn = '';
for($i = $isnt; $i > 0; $i--) {
if($fdn[$i][9] != "\x1b") {
$mn[] = substr($fdn[$i],9,strpos($fdn[$i],"\x1b") - 9);
}
}
$fmm = array();
if(is_array($mn)) {
$fim = fopen($dim,"r");
while($fm = fgets($fim)) {
$fmo = (int)substr($fm,0,5);
if(in_array($fmo, $mn)) {
$fmm[$fmo] = explode("\x1b",$fm);
}
}
fclose($fim);
}
if($sss[54] && $wdth[7][0]) {
function addlist($return,$val) {
$val = explode("\x1b",$val);
$addf = count($val);
for($d = 1;$d < $addf;$d++) {
$return = str_replace("<#addfield_".$d."#>",$val[$d],$return);
}
return $return;
}}
for($i = $isnt; $i > 0; $i--) {
if(trim($fdn[$i])){
$zzz = explode("\x1b",$fdn[$i]);
$flo = explode("\x1b", $fdl[$i]);
$no6 = substr($zzz[0], 0, 6);
$ctn = substr($zzz[0], 6, 2);
$mn = substr($zzz[0], 9);
if($sss[64]) $flo[1] = '익명';
$name = $flo[1];
$list_body = str_replace("<#xx#>",$fda[$i],$list_bodyy);
$wdtt = 0;
if($mbr_level == 9) $list_body = str_replace("<#no_check#>","<input type='checkbox' name='cart' value='".$no6."' onclick='uchoice(this)' class='cart' /><input type='hidden' name='ixx' value='".$fda[$i]."' /> ",$list_body);
if($type === 'a'){if($flo[4]) {$list_body = str_replace("<#isimg#>","<img src='icon/img.gif' class='mL4 wh13' alt='' />",$list_body);$wdtt += 20;}
if($fdu[$no6] > 2) {$list_body = str_replace("<#isfile#>","<img src='icon/f.png' class='mL4 wh13' alt='' />",$list_body);$wdtt += 20;}}
$no = (int)$no6;
$flo[3] = andamp($flo[3]);
if($flo[5]) $flo[5] = str_replace("&","&amp;",$flo[5]);
$re_depth = '';
$date = substr($flo[0], 0, 10);
$notx = 0;
if($sss[54] && $wdth[7][0]) $list_body = addlist($list_body,$faf[$i]);
if(false !== strpos($wdth[4], $no."^") && $nsc > 0 && $_GET['p'] == 1) {
$notx = ($ii > 0)? 1:2;
$list_body = str_replace("<#notice#>","notice",$list_body);
$list_body = str_replace("<#fnno#>","<b> 공지</b>",$list_body);
$list_body = str_replace("<#nHit#>","-",$list_body);
$list_body = str_replace("<#nAppr#>","-",$list_body);
$list_body = str_replace("<#nOppo#>","-",$list_body);
$ii--;
$nsc--;
$isntc = 1;
} else {
$isntc = 0;
if($_GET['no'] == $no) {
if($type == 'g') $name = "<u>".$name."</u>";
else $fnno = "<img src='icon/slct.gif' border='0' alt='' />";
} else if($fno === 'a') $fnno = $no;
else $fnno = $fno;
$list_body = str_replace("<#fnno#>",$fnno,$list_body);
$list_body = str_replace("<#nHit#>",(int)$zzz[1],$list_body);
if($type == 'd') $list_body = imn($mn,ckmdfx(2,3,$zzz,$flo[0]),$list_body,$no,$fda[$i],1);
$notxx = '';
if($sss[60] || $sss[61] || $wdth[7][5]) {
$nvote = explode('|',$zzz[5]);
if($sss[60] || $wdth[7][5]) {
if($sss[60]) $ratng = (int)$nvote[0];
else $ratng = ($nvote[0] && $nvote[1])? sprintf("%.1f",$nvote[0]/$nvote[1]*2):0;
$list_body = str_replace("<#nAppr#>",$ratng,$list_body);
}
if($sss[61]) $list_body = str_replace("<#nOppo#>",(int)$nvote[1],$list_body);
if($wdth[8][1] && (($wdth[8][1] == 3  && substr($wdth[8],2) <= $nvote[0]) || ($wdth[8][1] == 4  && substr($wdth[8],2) <= $ratng) || ($wdth[8][1] == 5  && ($wdth[7][5] && substr($wdth[8],2) <=$nvote[1] || !$wdth[7][5] && substr($wdth[8],2) <=$nvote[0] + $nvote[1])))) $notxx = 2;
}
if($notxx == 2 || ($wdth[8][1] == 1 && substr($wdth[8],2) <= $zzz[1]) || ($wdth[8][1] == 2 && substr($wdth[8],2) <= $zzz[2]))  {$notxx = "<img src='icon/hot.gif' class='mL4' alt='' />";$wdtt += 25;} else $notxx = '';
if($wdth[7][4] && ($date >= $sett[62] || $fdu[$no6] == 2 || $fdu[$no6] == 4)) {$list_body = str_replace("<#isnew#>","<img src='icon/new.gif' class='mL4' alt='' />".$notxx,$list_body);$wdtt += 25;}
else if($notxx) $list_body = str_replace("<#isnew#>",$notxx,$list_body);
}
if(_GET('search') == 's') $flo[3] = skword($flo[3]);
$zzz08 = (int)$zzz[0][8];
$secret = $authority_read;
if($zzz08 > 0) {
if(($zzz08 <= $mbr_level) || ($mn && $mn == $mbr_no) || (!$mn && $_COOKIE["scrt_".$no.$id] == md5($no."_".$sessid.$id))) {
if($type == 'g') $flo[3] = "[풀림] ".$flo[3];else $re_depth .= "<img src='icon/unlock.gif' alt='' class='lock' />";
} else {
$secret = 2;
if($type == 'g') $flo[3] = "[잠김] ".$flo[3];else $re_depth .= "<img src='icon/lock.gif' alt='' class='lock' />";
}
}
$njtnl = 0;
if($secret == 2 || $sss[73] != 4) $fdb[$i] = '';
if($wdth[5][4] == 1 && $secret != 2 && $authority_read && $flo[5]) {
	$njtnl = 1;
	$list_body = str_replace("<#no_jslink#>","onclick=\"nwopn('{$flo[5]}')\"",$list_body);
	$list_body = str_replace("<#target#>","target='_blank'",$list_body);
	$list_body = str_replace("<#no_link#>",$flo[5],$list_body);
	$fdb[$i] .= "<div class='dv_ea'>링크주소로 연결됩니다</div>";
	if($sss[32] == 4) $list_body = str_replace("<#isnlink#>","<;>",$list_body);
} else if($secret == 2 || ($secret && $sss[73] != 4)) {
if($sss[28] == 4) $fdb[$i] .= "[비밀글]";
else if($type != 'a') {$list_body = str_replace("<#memb#>","<div class='dv_pass' id='lock_{$id}_{$no}'>비밀글입니다.</div>",$list_body);
if(!$mn) $onload .= "\nsetTimeout(\"ffpass('{$no}','{$fda[$i]}')\",50);";
}}
if(!$isntc && ($zzz[2] > 0 || $zzz[3] > 0 ||($wdth[0][49] != '2' && $zzz[4] > 0))) {$nrp = (int)$zzz[2];if($wdth[9][11]) $nrp += (int)$zzz[3]; if($wdth[0][49] != '2') $nrp += (int)$zzz[4]; if($type === 'a') $wdtt += $sett[28] + strlen($nrp)*5;}
else {$list_body = str_replace("<#isnrp#>","<;>",$list_body);$nrp = 0;}
if(!$isntc) {
if($secret != 2 && $notx != 2 && $sss[28] == 4) $list_body = str_replace("<#oprvw#>","name=\"pv{$ii}\"",$list_body);else if($type == 'g') $list_body = str_replace("<#oprvw#>","name=\"thumb100\"",$list_body);
if(!$notx && !$secret && $nrp && $sss[71] == 4) $list_body = str_replace("<#ispvrp#>","<a href='?id={$id}&amp;rp_view={$no}' class='rp'>",$list_body);
else $list_body = str_replace("<#ispvrp#>","<a href='#none' class='rp'>",$list_body);
if($sss[71] == 4) $cmtlv = "'";
$rsimg = 1;
$rissimg = 1;
if($secret == 2 || $sss[72] != 4) {
if($type == 'g') {$list_body = str_replace("<#simg#>","icon/noimg.gif",$list_body);$rsimg = 0;}
else if($type == 'c') {$list_body = str_replace("<#issimg#>","<;>",$list_body);$rissimg = 0;}
$flo[4] = '';
}
if($secret != 2 && $flo[5]) {$list_body = str_replace("<#rlink#>",$flo[5],$list_body);$wdtt += 22;}
if($flo[4]) {
if(substr($flo[4], 0, 5) != "http:") {
if(substr($flo[4],0,1) == "/") $flo[4] = "exe.php?sls=".$id.$flo[4];
else if(strpos($flo[4],"exe.php") === false) $flo[4] = "exe.php?sls=".$id."/file/".str_replace(" ","+",$flo[4]);
}
if($rsimg) $list_body = str_replace("<#simg#>",$flo[4],$list_body);
if($sss[28] != 4) $flo[4] = '';
} else if($type == 'g' && $rsimg) $list_body = str_replace("<#simg#>","icon/noimg.gif",$list_body);
else if($type == 'c' && $rissimg) $list_body = str_replace("<#issimg#>","<;>",$list_body);
if($sss[28] == 4 && $notx != 2) $memb .= "\npretxt[{$ii}] = [\"".str_replace('"','\\"',$flo[4])."\",\"\",\"".str_replace('"','\\"',$flo[1])."\",\"".(int)$nrp."\",\"".str_replace('"','\\"',$fdb[$i])."\"];";
if(!$njtnl) $list_body = str_replace("<#no_jslink#>","onclick=\"rhref('{$index}?id={$id}&amp;no={$no}&amp;p={$_GET['p']}{$rt}')\"",$list_body);
if($type == 'b') {
if(!$_GET['no']) $onload .= "vtrpc[{$no}] = ".(($date < $crtime)? 3:2).";\n";
if(!$wdth[7][32] && $flo[6]) {
$tagg = explode(",",$flo[6]);
$tag = "<div class='tagg'><img src='icon/tag.gif' alt='' /> ";
for($j = 0; trim($tagg[$j]); $j++){
if($_GET['search'] == 't' && $_GET['keyword'] == $tagg[$j]) $tagg[$j] = "<span class='keyword'>{$tagg[$j]}</span>";
$tag .= "<a href='{$index}?id={$id}&amp;search=t&amp;keyword=".urlencode($tagg[$j])."&amp;p=1'>{$tagg[$j]}</a>, ";
}
$tag = substr($tag, 0, -2)."</div>";
$list_body = str_replace("<#tag#>",$tag,$list_body);
}
$list_body = str_replace("<#nReply#>",(int)$zzz[2],$list_body);
$list_body = str_replace("<#nTrb_out#>",(int)$zzz[3],$list_body);
$list_body = str_replace("<#nTrb_in#>",(int)$zzz[4],$list_body);
$list_body = str_replace("<#uplist#>",uplist($no),$list_body);
} else if($type == 'd') {
if((!$mn || $sss[44] < 3) && ($mbr_level == 9 || ($sss[44] != 2 && $sss[44] != 9 && ($mbr_level || $sss[44] == 0 || $sss[44] == 7)))) $list_body = str_replace("<#ipr#>",trim(substr($flo[0], 10, 15)),$list_body);
else $list_body = str_replace('<#isipr#>','<;>',$list_body);
$list_body = str_replace('<#scrt#>',$zzz[0][8],$list_body);
}
}
if($flo[5] == '' || $secret == 2 || $sss[32] != 4) $list_body = str_replace("<#isnlink#>","<;>",$list_body);
if(!$njtnl) {
if($aview == 6) {
if($isie == 1) $list_body = str_replace("<#no_link#>","#\" onclick=\"aview('{$id}','{$no}','{$xx}')",$list_body);
else $list_body = str_replace("<#no_link#>","#\" onclick=\"alert('IE에서만 보입니다')",$list_body);
} else $list_body = str_replace("<#no_link#>","{$index}?id={$id}&amp;no={$no}&amp;p={$_GET['p']}{$rt}",$list_body);
}
if(isset($zzz[6][0]) && $zzz[6][0] > 0) {
for($r = $zzz[6][0];$r > 0; $r--) $re_depth = "&nbsp;&nbsp; {$re_depth}re:";
$re_depth = "<span class='t8'>{$re_depth}</span> ";
}
if($isct && $ctg[$ctn]) {
$list_body = str_replace("<#ct_no#>","{$ctn}",$list_body);
$list_body = str_replace("<#ct_name#>","{$ctg[$ctn]}",$list_body);
} else $list_body = str_replace("<#isnct#>","<;>",$list_body);
$list_body = str_replace("<#subject#>",$flo[3],$list_body);
$list_body = str_replace("<#re_depth#>",$re_depth,$list_body);
$list_body = str_replace("<#no#>",$no,$list_body);
$list_body = str_replace("<#ii#>",$ii,$list_body);
if($mn) $hmpg = $fmm[$mn][10];else if($type == 'd' && $flo[5]) $hmpg = $flo[5];else $hmpg = '';
$list_body = str_replace("<#name#>",name($name, $mn, 0, 1, $hmpg),$list_body);
$list_body = str_replace("<#tname#>",name($name, $mn, 0, 0, $hmpg),$list_body);
if($type === 'a'){
if($date > 0) $list_body = str_replace("<#date#>",date("Y.m.d", $date),$list_body);
$list_body = str_replace("<#nrp#>",$nrp,$list_body);
$list_body = str_replace("<#cno#>",$iii %2,$list_body);
if($ismobile != 2 && !$sett[77]) {
$wdtt = $wtdh - $wdtt;
if($bwr == 'ie6') $list_body = str_replace("<#wtdh#>","width:expression((this.scrollWidth < {$wdtt})? '':'{$wdtt}px')",$list_body);
else $list_body = str_replace("<#wtdh#>","max-width:{$wdtt}px",$list_body);
}} else {
if($date > 0) $list_body = str_replace("<#date#>",date("Y.m.d H:i", $date),$list_body);
$list_body = str_replace("<#memb#>",nocopy($fdb[$i]),$list_body);
$list_body = str_replace("<#nrp#>",(int)$nrp,$list_body);
}
$srkiin .= $list_body;
$ii++;
$iii++;
}
if($fno !== 'a') {
if($_GET['desc'] == 'asc') $fno++;
else $fno--;
}
}
} else if($_GET['p'] > 1) $onload .= "locato('p','".($_GET['p'] - 1)."','');\n";
}
// 게시판 목록 아랫부분
$srkin = tagcut('list_tail',$sr_list);
if($type != 'g' && $type != 'b' && $type != 'd') $srkin = str_replace('<#gdb#>','<;>',$srkin);
else if($type == 'g') $srkin = str_replace('<#gdb#>','</td></tr>',$srkin);
else $srkin = str_replace('<#surl#>','?section='.$section,$srkin);
if($wdth[7][32] || $sss[26] == 'd') $srkin = str_replace('<#sss26#>','<;>',$srkin);
if($sss[26] == 'd' || $sss[24] === 'a' || ($sss[63] && $mbr_level != 9) || $sss[24] > $mbr_level) {
$srkin = str_replace('<#isrss#>','<;>',$srkin);
$srkin = str_replace('<#isnrss#>','<;>',$srkin);
} else if($sss[63]) $srkin = str_replace('<#isnrss#>','<;>',$srkin);
else $srkin = str_replace('<#isrss#>','<;>',$srkin);
if($wdth[7][30] == '2') $srkin = str_replace("<#icoselect#>",$ctgs,$srkin);
$srkiin .= $srkin;
if($inclwt=inclvde($srkiin)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) {if($sett[92][0] == '2' || $sett[92][0] == '3') $gmtime = getmicrotime();include($inxv[1]);if($sett[92][0] == '2' || $sett[92][0] == '3') echo "<!--".$inxv[1]." 처리시간:: ".(getmicrotime() - $gmtime)." -->";}else {?><?php echo $inxv[1]?><?php }}
} // 610
?>
<table cellpadding='0px' cellspacing='0px' width='<?php echo $srwdthx?>'>
<?php
if($sss[30]) {
if($_GET['keyword'] && $_GET['search'] != 'ip' && $_GET['search'] != 'rip') $onload .= "document.sform.keyword.value = '{$gkeyword}';\ndocument.sform.search.value = '{$_GET['search']}';\n";
?>
<tr><td>
<?php
// 목록번호 출력
if($newwin) $rt = $rrt;
$fct += (int)$nscc;
if($otype == 'k') $allp = $mcnt;
else $allp = (int)(($fct - 1)/ $isnt) + 1;
if($ismobile == 2) pagen('p',$allp,5,$sum);
else pagen('p',$allp,10,$sum);
?>
</td></tr>
<tr><td align="center">
<form method="get" name="sform" class="sform" action="?" style="display:inline"><input type="hidden" name="id" value="<?php echo $id?>" /><input type="hidden" name="ct" value="<?php echo $_GET['ct']?>" /><input type="hidden" name="p" value="1" />
<select name="search" onchange="searchc(this.options[this.selectedIndex].value)" class="sform"><option value="s">제목</option><option value="b">본문</option><option value="t">태그</option><option value="n">이름</option><option value="r">덧글</option></select>&nbsp;
<input type="text" name="keyword" class="sform" value="" />
<input type="submit" id="submit" value=" 검색 " class="srbt" /></form>
<?php
}
$rrt = str_replace('amp;','',$rt);
if($mbr_level == 9) {
if(!$sss[30]) {?><tr><td><?php }
if($ismobile == 2) {?><div class='fcler' style='height:10px'></div><?php }
?>
<script type="text/javascript" src="include/admin.js"></script>
<form name="adselect" method="post" class="sform" action="exe.php" style="float:right;margin-left:-154px">
<input type="hidden" name="selected" />
<input type="hidden" name="idn" value="<?php echo $idn?>" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<input type="hidden" name="p" value="<?php echo $gp?>" />
<input type="hidden" name="xx" value="<?php echo $xx?>" />
<input type="hidden" name="request" value="<?php echo $_SERVER["REQUEST_URI"]?>" />
<select name="perm_vw" onchange="choiced(1)" style="display:none;"><option value="">::권한변경</option><option value="0">모두허용</option><option value="r">rss출력제한</option><option value="1">레벨1</option><option value="2">레벨2</option><option value="3">레벨3</option><option value="4">레벨4</option><option value="5">레벨5</option><option value="6">레벨6</option><option value="7">레벨7</option><option value="8">레벨8</option><option value="9">관리자</option></select>
<div style="display:none">번호로 선택 <input type="text" name="ifno" style="width:40px" maxlength="6" /> 부터 <input type="text" name="ifend" style="width:40px" maxlength="6" /> 까지<?php if($_GET['ct']) {?><div class='tr'><span title='분류제한 해제하려면 다음 값을 0으로 바꾸세요.'>분류제한 </span><input type='text' name='ifct' value='<?php echo str_pad($_GET['ct'],2,0,STR_PAD_LEFT);?>' style='width:20px' maxlength='2' /></div><?php }?></div>
<div style="display:none"><input type="text" name="newct" onkeyup="if(ekc == 13) submit()" /><input type="button" value=" 생성 " onclick="submit()" class="srbt" /></div>
<select name="changeto" onchange="choiced(1)" style="display:none;">
	<option value="">분류선택</option>
	<option value="00">::분류없음</option>
<?php
for($i = 1; $i <= $ctl; $i++){
$i = str_pad($i, 2, 0, STR_PAD_LEFT);
if(!$ctg[$i]) $ctg[$i] = '_새 분류_';
?>
	<option value="<?php echo $i?>"><?php echo preg_replace('`<[^>]+>`','',$ctg[$i])?></option>
<?php
}
?>
</select>
<select name="moveto" onchange="choiced(1)" style="display:none;">
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
<div id="addtagdv" style="display:none;"><input type="text" name="addtag" value="" style="width:100px" /> <input type="button" onclick="choiced(1)" value="태그추가" class="srbt" /></div>
 <input type="button" onclick="choice()" value="전체선택" class="srbt" />
 <select name="exc" onchange="choiced(0)">
	<option value=""></option>
	<option value="manage">게시판 관리</option>
	<option value="datafile">파일 관리</option>
	<option value="cteditwin" class="FC">분류 편집창</option>
	<option value="hundred">목록 갯수 100</option>
	<option value="range">번호로 범위선택</option>
	<option value="change" class="FC">분류 이동</option>
	<option value="move" class="EA">게시판 이동</option>
	<option value="copy" class="EA">게시판 복사</option>
	<option value="delete" class="FC">게시물 삭제</option>
	<option value="delete_rp" class="FC">덧글 삭제</option>
	<option value="delete_rtb" class="FC">엮인글 삭제</option>
	<option value="delete_stb" class="FC">엮은글 삭제</option>
	<option value="delete_body" class="FC">본문 삭제</option>
<?php if($_GET['ct']) {?>	<option value="deletect" class="FC">분류글 모두 삭제</option><?php }?>
	<option value="view_info" class="EA">선택 게시물 정보</option>
	<option value="limit">읽기권한 변경</option>
<?php
if($xx == 0){
?>
	<option value="notc_add">공지 등록</option>
	<option value="notc_dell">공지 제거</option>
<?php
}
?>
	<option value="modify_rp" class="EA">덧글 정리</option>
	<option value="modify_newrp" class="EA">최근덧글정리</option>
	<option value="modify_tag" class="EA">태그 정리</option>
	<option value="modify_date" class="EA">날짜 정리</option>
	<option value="modify_ct" class="EA">분류 정리</option>
	<option value="modify_upload" class="EA">업로드 정리</option>
	<option value="modify_cnt" class="EA">게시물수 정리</option>
	<option value="modify_link" class="FC">링크 중복글 삭제</option>
	<option value="delete_thumb">썸네일 삭제</option>
	<option value="delete_lnk">링크 삭제</option>
	<option value="delete_tag">태그 삭제</option>
	<option value="delete_ip">본문IP 삭제</option>
	<option value="modify_time" class="FC">게시물 재배치</option>
	<option value="add_tag" class="FC">태그 추가</option>
</select></form><div class="fcler"></div></td></tr>
<?php
}
?>
<tr><td>
<?php
if(@filesize("skin/".$wdth[2]."/maker.txt")) {
?><div style='text-align:right' class='f8'>skin by <?php echo join('',file("skin/".$wdth[2]."/maker.txt"))?></div><?php
}
?>
</td></tr>
<tr><td><iframe id='tag' src='' style='display:none;width:<?php echo $srwdthx?>;height:30px' frameborder='0'></iframe>
</td></tr>
</table>
<?php
} else { // 363
?><div class='dv_login' id='authority_list'></div><?php
$onload .= "\nsetTimeout(\"$('authority_list').innerHTML=$('srlogin').innerHTML + '<br />목록 보기 권한이 없습니다.<br />'\",100);";
$srlogin = 1;
}
?>
<script type='text/javascript'>
//<![CDATA[
function frite(reply) {
<?php
if($sss[24] === 'a' || $sss[24] > $mbr_level) {?>alert('게시물 작성권한이 없습니다.');
<?php } else {
if($_GET['ct']) $tmp = "&amp;ct=".$_GET['ct']; else $tmp = '';
?>
if(reply && '<?php echo $sss[54]?>' == '0' && '<?php echo $sss[55]?>' == '1') {
<?php
if($s7116 === 1 && $dctime > $cuttime[$sett[71][20]]) {?>alert('시간 경과로 차단되었습니다.');return;<?php }?>
rhref('exe.php?id=<?php echo $id?>&amp;depth=' + reply + '&amp;p=<?php echo $_GET['p']?><?php echo $tmp?>&amp;write=<?php echo $_GET['no']?>');
} else if(!reply) rhref('exe.php?id=<?php echo $id?>&amp;p=<?php echo $_GET['p']?><?php echo $tmp?>&amp;write=new');

<?php }?>
}
<?php
if($sss[63] && $sss[24] !== 'a' && $sss[24] <= $mbr_level){
?>
function rss(x) {
if(x == 1) location.href='exe.php?id=<?php echo $id?>&read=1';
else popup('admin.php?rss=<?php echo $id?>',480,200);
}
<?php
}
?>
function arrange(xx) {
<?php if($sss[47]){?>
var yy;
if(('<?php echo $gkeyword?>' == '' && '<?php echo $_GET['c']?>' == '') || confirm('검색을 중단하고 항목별 정렬로 전환하시겠습니까')) {
if('<?php echo $_GET['arrange']?>' == xx && '<?php echo $_GET['desc']?>' == 'desc') yy = 'asc';
else yy = 'desc';
var x = location.search.slice(1).replace(/&keyword=[^&]*/gi,'').replace(/&search=[^&]*/gi,'').replace(/&arrange=[^&]*/gi,'').replace(/&desc=[^&]*/gi,'').replace(/&p=[^&]*/gi,'&p=1');
location.href='?' + x + '&desc=' + yy+ '&arrange=' + xx;
}
<?php }?>
}

function vwrp(no) {
var comx = $('comment_' + no);
if(comx) {
if(comx.style.display == 'block') {
comx.style.display = 'none';
} else {
comx.contentWindow.location.replace('<?php echo $index?>?id=<?php echo $id?><?php echo $rrt?>&comment=' + no);
comx.style.display = 'block';
}}}
if('<?php echo $_GET['p']?>' && '<?php echo $sss[30]?>' && $('ctt')) $('ctt').value='<?php echo $_GET['ct']?>';
if('<?php echo $xx?>' != '' && $('xxx')) $('xxx').value='<?php echo $xx?>';
if('<?php echo $_GET['date']?>' && $('mmm')) $('mmm').value='<?php echo $_GET['date']?>';
<?php
if(!$wdth[7][32] && $_GET['search'] == 't' && $_GET['keyword'] && $_GET['p'] == '1') $onajax = "&tglus=".urlencode($_GET['keyword']);
if($type=='d' && $_GET['rp']) $onload .= "\nvwrp('{$_GET['rp']}');";
?>
//]]>
</script>
<?php
} else if(!file_exists($ds)) { // 315
?><script type='text/javascript'>location.href='admin.php';</script><?php
} else {
?>
<table id='srgate' cellspacing='<?php echo $sett[39]?>px' cellpadding='0px' width='<?php echo $srwdthx?>' style='table-layout:fixed'>
<?php
if(($_GET['findw'] = trim($_GET['findw']))) {
if($sett[10] == '1' || $sett[10] == '3') $linktarget = "target='_blank'";
if(!$_GET['p']) $_GET['p'] =1;
$np = $_GET['p'] + 1;
$acook = str_replace(" ","`",$_GET['findw']."_p".$_GET['p']);
if($_GET['p'] > 1) {
$cookp = $_GET['p'] - 1;
$cookp = str_replace(" ","`",$_GET['findw']."_p".$cookp);
$bcook = explode("_",$_SESSION[$cookp]);
}
$bc0 = (int)$bcook[0];
$bc1 = (int)$bcook[1];
$bc2 = (int)$bcook[2];
$fndw = explode(" ",$_GET['findw']);
function search($an, $bn, $cn, $bx, $erh) {
global $fsbs, $dxr, $mbr_level, $acook, $fndw;
$n = 0;
if(!trim($fndw[0])) return;
foreach($fsbs as $mid => $mss) {
$n++;
if($mid && $mss[12] !== 'a' && $mss[12] <= $mbr_level) {
if($n >= $an && $cn <= 20) {
$mwth = explode("\x1b",$mss);
if($bx) {$ida = $mwth[6] -$bx +1;$idb = "/^".$ida;}
if((!$idb || $ida > 0) && file_exists($dxr.$mid.$idb."/no.dat")) {
if(!$isb) $isb = 1;
$rft = (int)substr($mss, 6, 6);
$fl = fopen($dxr.$mid.$idb."/list.dat","r");
$fn = fopen($dxr.$mid.$idb."/no.dat","r");
$fb = fopen($dxr.$mid.$idb."/body.dat","r");
$i = 0;
while($i < $rft){
if($i >= $bn){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = fgets($fl);
$fbo = fgets($fb);
if((stristr($flo,$fndw[0]) && (!$fndw[1] || stristr($flo,$fndw[1])) && (!$fndw[2] || stristr($flo,$fndw[2]))) || (stristr($fbo,$fndw[0]) && (!$fndw[1] || stristr($fbo,$fndw[1])) && (!$fndw[2] || stristr($fbo,$fndw[2])))) {
if($cn < 20) $erh[$mid][$cn] = array((int)substr($zzz,0,6),$flo);
$cn++;
}
} else break;
} else {
fgets($fn);fgets($fl);fgets($fb);
}
$i++;
if($cn == 20) {$en=$n;$ei=$i;}
else if($cn > 20) break;
}
fclose($fl);
fclose($fn);
fclose($fb);
}
}
}
}
if($isb && $cn >= 20) {$_SESSION[$acook] = $en."_".$ei."_".$bx;}
return array($cn,$i,$isb,$erh,$mbn);
}
?>
<tr><td style='line-height:140%;padding:10px;text-align:left'>
<?php
$erh = array();
list($ii,$i,$isb,$erh,$mbn) = search($bc0, $bc1, 0, $bc2, $erh);
for($f=$bc2 + 1;$isb && $ii < 21;$f++) {
list($ii,$i,$isb,$erh,$mbn) = search(0, 0, $ii, $f, $erh);
}
while(list($key,$val) = @each($erh)) {
echo "<div style='margin:5px 0 5px 0px;border-bottom:2px solid #2A5EB2;'><a href='{$index}?id={$key}' style='color:#2A5EB2'><b>게시판 : {$bdidnm[$key]}</b></a></div>";
while(list($vo,$vns) = @each($val)) {
$flo = explode("\x1b",$vns[1]);
if(!stristr($flo[2],$_GET['findw'])) {
echo "<span class='f7' style='color:#D7D7D7'><span style='font-size:6pt'>■</span> ".@date("m-d",substr($flo[0],0,10))."</span>&nbsp;<a href='{$index}?id={$key}&amp;no={$vns[0]}' {$linktarget}>[{$flo[1]}] {$flo[3]}</a><br />";
}
}
}
?>
</td></tr><tr><td>
<?php
pagen('p',$_GET['p'],10,(($isb && $ii > 20)? '+':''));
?>
</td></tr></table>
<?php
} else if(_GET('member_login')) {
?>
<tr><td>
<div class='bd_name'><h2>회원로그인</h2><div><a href='<?php echo $index?>'>HOME</a> &gt; <a href='<?php echo $index?>?member_login=1'>회원로그인</a></div></div>
<div class='c1png'> &nbsp; 회원로그인</div>
<?php
include("include/login.php");
?>
</td></tr></table>
<?php
} else {
// 전체 게시판 최근게시물
if($ismobile == 2) include("include/gate_mobile.php");
else if($sect[$section][1] != 3 && $sect[$section][1] != 6 && $sect[$section][1] != 7 && $sect[$section][1] != 's') {
$ida = '';
$nxs = 0;
$nwx = 0;
$tpn = 0;
$iii = 0;
include("include/gate.php");
if(trim($srkiin) == "</table>") include("include/login.php");
} else echo "</table>";
}
}
if($mbr_level == 9 && isset($gtbk2)) {?>
<div class="ulselect"> &nbsp; &nbsp; &bull; 관리자기능 &bull; &nbsp; &nbsp; <ul>
<li onclick="popup('admin.php?ectgt=<?php echo $section?>',500,410)">대문편집창</li>
<li onclick="popup('admin.php?ectgtw=<?php echo $section?>',750,600,'',1)">대문 위지윅편집창</li>
<li onclick="popup('admin.php?sect_arr=<?php echo $section?>',610,500)">좌우메뉴 배치창</li>
<li onclick="popup('admin.php?fm=widget/sectbtm_<?php echo $section?>', 800, 400)">하단 내용편집 </li>
<li onclick="popup('admin.php?fm=module/sectcss_<?php echo $section?>.css', 800, 400)">css 편집</li>
<li onclick="nwopn('admin.php?section=1')">- 섹션관리 -</li></ul></div>
<?php
} else if($id) {
?>
<form method="post" action="exe.php" name="passe" id="passf" style="display:none;">
<input type="hidden" name="no" value="<?php echo $_GET['no']?>" />
<input type="hidden" name="pno" value="<?php echo $_GET['no']?>" />
<input type="hidden" name="p" value="<?php echo $_GET['p']?>" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<input type="hidden" name="xx" value="<?php echo $xx?>" />
<input type='hidden' name='request' value='<?php echo $_SERVER['REQUEST_URI']?>' />
<input type='hidden' name='edit' value='<?php echo $_GET['edit']?>' />
<table class="passtb" onmousedown="movem(this);" onmouseup="movem();">
<tr><td>password : <input type="password" onmousemove="ry='';px=0;py=0" name="pass" class="psinput" value="<?php echo $uzpass?>" maxlength='10' /></td></tr>
<tr><td><input type="button" value="취소" onclick="fpass()" class="srbt" /> &nbsp; &nbsp; <input type="button" name="editt" value="" onclick="passbmt(this)" class="srbt" /></td></tr></table>
</form>
<form method="post" action="exe.php" id="ckfma" target="exe"></form>
<?php
}
$skv = '';
if($id) $skv = tagcut('listbottom',$srkn);
$skv .= tagcut('bottom',$srkn);
if($inclwt=inclvde($skv)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) {if($sett[92][0] == '2' || $sett[92][0] == '3') $gmtime = getmicrotime();include($inxv[1]);if($sett[92][0] == '2' || $sett[92][0] == '3') echo "<!--".$inxv[1]." 처리시간:: ".(getmicrotime() - $gmtime)." -->";}else {?><?php echo $inxv[1]?><?php }}
}
if($dxr) {
if(!$ismobile && (($sett[16][3] && !$id) || ($id && (($sett[16][5] && $_GET['no']) || ($sett[16][4] && !$_GET['no'])))) && @filesize($dxr."tail")) {if($sett[32]) @readfile($dxr."tail");else include($dxr."tail");}
if($sett[26]) include('module/'.$sett[26].'.php');
if($sett[3]) include($sett[3]);
}
?>
<script type='text/javascript'>
//<![CDATA[
<?php echo $memb?>

stbLR67 = <?php echo $stbLR67?>;

function checkmemo(val) {
var mdiv = $('notifv');
var ckmbrp = 0;
<?php
if($mbr_level && $sett[52] > 1 && $sett[57] != 'a' && $sett[57] <= $mbr_level) {
?>
ckmbrp += 2;
if(val == 'new_memo') {
var alertt = "";
if(('<?php echo $sett[52]?>' == '2' || '<?php echo $sett[52]?>' == '3' || '<?php echo $sett[52]?>' == '5' || '<?php echo $sett[52]?>' == '6')) alertt += "<input type='button' id='confirm_memo' class='srbt' value='쪽지가 도착했습니다' onclick='read(\"get\");hidedv(\"notifv\");' /><div class='fcler'></div>";
if('<?php echo $sett[52]?>' == '3' || '<?php echo $sett[52]?>' == '4' || '<?php echo $sett[52]?>' == '6') alertt += "<embed src='icon/memo.swf' type='application/x-shockwave-flash' autostart='true' loop='0' style='width:1px;height:1px' />";
if(parseInt('<?php echo $sett[52]?>') >= 4) read('get');
mdiv.innerHTML = alertt + moux;
mdiv.style.display = 'block';
}
<?php
}
if($sett[89] != 'a' && $sett[89] <= $mbr_level && $id && $wdth[5][0] != 'a' && $wdth[5][0] <= $mbr_level) {
?>
if(setop[6] != '' && ono != 0) {
if($('comment_' + ono)) {
var ifcmeW =  $('comment_' + ono).contentWindow;
if(ifcmeW.$('rp_time').value) {
ckmbrp += 1;
rpck = '&no=' + ono + '&xx=' + document.passe.xx.value + '&rps=' + ifcmeW.$('rp_count').value + '&rptime=' + ifcmeW.$('rp_time').value;
}}}
<?php }
$azid = (($id)? $id."&alst=".(int)$lst:1);
?>
if(ckmbrp > 0) setTimeout('azax("exe.php?&check_memo=<?php echo $time?>&id=<?php echo $azid?>' + rpck + '&isvcnct=<?php echo $isvcnnct?>",9)',10000);
}
<?php
if($tpn || $nxs) {$sett60 = explode('|',$sett[60]);
if($tpn){?>
tpn = <?php echo $tpn?>;
tabchng = <?php echo $sett60[0]*1000?>;
<?php } if($nxs) {?>
nwx = <?php echo $nwx?>;
newxchng = setInterval("newxrotate()", <?php echo $sett60[1]*1000?>);
<?php }}?>

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

<?php if($id && $aview > 1) {?>
function emptyselect() {
var issel = '';
if(setop[0] == '2' || setop[1] == 'ie11') {if((issel = window.getSelection()) && issel.toString()) {issel.removeAllRanges();}}
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

<?php if($aview >= 3) {?>
function aview(idd,no,xx) {
if(idd) {
azax('include/aview.php?&id=' + idd + '&dd=' + no + '&xx=' + xx,'avax(ajax)');
}}
function avieww(val) {
var scrt = parseInt(val.substr(0,3));
var txt = val.substr(4).split(".");
var str_1 = '';
var str_2 = '';
var txtl = txt.length;
for(var i = 0;i < txtl;i++) {
if(!!txt[i]) {
str_2 = '0x' + txt[i];
str_1 += String.fromCharCode(str_2 - scrt);
}}
str_1 = decodeURIComponent(str_1);
str_1 = str_1.replace(/\+/g," ");
return str_1;
}
function avax(val) {
<?php if($aview > 4) {if($isie == 1) echo "ajaxx=avieww(val);popup('{$index}?block5=1',$('bd_main').offsetWidth,500,1);";}
else if($aview == 3) {echo "$('ifr_bdo').innerHTML=avieww(val);";} else {?>
var doc = $('ifr_bdo').contentWindow.document;
 		doc.open();
 		doc.write("<html>");
 		doc.write("<head>");
 		doc.write("<link rel='stylesheet' type='text/css' href='skin/<?php echo $srk?>/style.css' />");
 		doc.write("<style type='text/css'>body {overflow:hidden; font-size:<?php echo $fz?>pt; font-family:'<?php echo $faze?>'; margin:0;-moz-user-select:none}</style>");
 		doc.write("</head>");
 		doc.write("<body onload='img_resize()' class='bdo' oncontextmenu='return false' ondragstart='return false' onselectstart='return false'>");
 		doc.write(avieww(val));
 		doc.write("<script type='text/javascript'>function img_resize() {var rszimg = document.getElementsByName('img580');if(rszimg) {for(i=rszimg.length -1; i >= 0; i--) {if(rszimg[i].width > <?php echo $sett[11]?>) rszimg[i].style.width = '<?php echo $sett[11]?>px';rszimg[i].style.cursor = 'pointer';}}setTimeout('resize()',100);}");
 		doc.write("function resize() {if(parent.location.href.indexOf('<?php echo $_SERVER['HTTP_HOST']?>') == -1) document.write();var ht=document.body.scrollHeight + \"px\";parent.$('ifr_bdo').style.height=ht;}<\/script>");
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

function setup() {
if(!thtck) thtck = 0;
thtck += 1;
azax("exe.php?&onload=<?php echo $time?><?php echo $onajax?>&id=<?php echo ($id)?$id:1?>&isvcnct=<?php echo $isvcnnct?>",9);
if(thtck < 2) {
imgview(0);
pview = $('pview');
sessno = <?php echo $sessno?>;
<?php echo $onload?>

<?php
if($ismobile == 2) echo "if('{$_COOKIE['scrwdth']}' == '' || '{$_COOKIE['scrwdth']}' != window.screen.availWidth) document.cookie = 'scrwdth=' + window.screen.availWidth;";
if($_GET['ct'] && $_GET['deletect'] && $_GET['ct'] == $_GET['deletect'] && $mbr_level == 9) echo "setTimeout(\"choice();document.adselect.exc.value = 'delete';choiced('delete_ct');\",100);";
?>
}
recize();
if(thtck < 6 && !sessno) {
if(thtck < 3) setTimeout("if(!sessno) setup()",200);
else if(thtck < 5) setTimeout("if(!sessno) setup()",500);
else setTimeout("if(!sessno) setup()",1500);
}}

function lochref(key,val) {
var url = "<?php echo $index?>?id=<?php echo $id?><?php echo $rrt?>&" + key + "=" + val;
location.href = url;
}

var reque = ["<?php echo md5($sessid)?>","<?php echo $_SERVER['REQUEST_URI']?>","<?php echo $xx?>",<?php if($sett[93][0] != 4 && ($sett[93][0] == 1 || ($sett[93][0] == 2 && $ismobile) || ($sett[93][0] == 3 && !$ismobile))) echo substr($sett[93],1);?>];
document.onreadystatechange = function(){if(document.readyState == "complete" && !sessno) setup();else if(document.readyState) recize(document.documentElement.offsetWidth);}
setTimeout("if(!sessno) setup()",1000);
window.onresize = recize;
//]]>
</script>
<script type="text/javascript" src="include/bottom.js"></script>
<?php
$time_end = getmicrotime();
$timee = $time_end - $time_start;
echo "<!--서버처리시간:: $timee -->";
if($ismobile == 3) {
?>
<div align="center">
<input type="button" class="msrbt" onclick="history.go(-1)" value="이전" />
<input type="button" class="msrbt" onclick="document.cookie='ckmobile=2';location.reload()" value="모바일버전" />
<input type="button" class="msrbt" onclick="location.href='<?php echo $index?>?member_login=<?php echo urlencode($_SERVER['REQUEST_URI'])?>'" value="<?php echo ($mbr_level)? "로그아웃":"로그인";?>" />
</div>
<?php
} if(isset($chtid)) {
?>
<script type="text/javascript" src="chat_w.php?js=1"></script>
<?php
}
?>
<div id='srlogin'><?php if($srlogin) include("include/login.php");?></div>
<div id='curtain' style='display:none'></div>
<div id='notifv' style='display:none'></div>
</body>
</html>