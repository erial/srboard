<?php
if(!$flo) {
scrhref($dxpt."&amp;p=".$gp,0,0);
exit;
}
$name = $flo[1];
if($plus == 1) {
if(!file_exists($dxr.$idd."/no.dat@@")) {
$nfn = fopen($dxr.$idd."/no.dat@@","w");
foreach($uuu as $ufu) {fputs($nfn,$ufu);}
fclose($nfn);
if($fnfs == filesize($dxr.$idd."/no.dat@@")) {
copy($dxr.$idd."/no.dat",$dxr.$idd."/no.dat_m");
copy($dxr.$idd."/no.dat@@",$dxr.$idd."/no.dat");
}
unlink($dxr.$idd."/no.dat@@");
$plus = 0;
} else {$onajax = "&nlus=".$_GET['no'];if($xx > 0) $onajax .= "&xx=".$xx;}
}
if(!$schphp && $sss[30]) {
if(($type == 'a' || $type == 'e') && $wdth[4]) {$nss = explode('^', $wdth[4]);$nsc = count($nss) -1;$nscc = $nsc;}
if($wdth[6] && $xx) $px = $fct - substr($do[$xx],6,6);$gp = (int)(($ths + $nscc + (int)$px)/$isnt) + 1;$_GET['p'] = $gp;}
if($type == 'd') {echo "<script type='text/javascript'>rplace('{$dxpt}&amp;p={$gp}&amp;rp={$_GET['no']}&amp;cc={$_GET['cc']}')</script>";exit;}
if($mn) {
$fim = fopen($dim,"r");
while($fm = fgets($fim)) {
if((int)substr($fm,0,5) == $mn) {
$fmm[$mn] = explode("\x1b",$fm);
break;
}}
fclose($fim);
if($sett[83] && $mn == $mbr_no) notiff($mn,0,$id10.$no6,0);
}
$ctt = substr($crp[0], 6, 2);
$date = substr($flo[0], 0, 10);
if(!$sss[31]) $flo[5] = '';
else if($flo[5]) $flo[5] = str_replace("&","&amp;",$flo[5]);
$sr_body = tagcut('body',$srkin);
$ipr = trim(substr($flo[0], 10, 15));
if($ipr && (!$mn || $sss[44] < 3) && ($mbr_level == 9 || ($sss[44] != 2 && $sss[44] != 9 && ($mbr_level || $sss[44] == 0 || $sss[44] == 7)))) $sr_body = str_replace("<#ipr#>",$ipr,$sr_body);
else $sr_body = str_replace("<#isipr#>","<;>",$sr_body);
if(!$wdth[7][32] && $flo[6]) {
$tagg = explode(",",$flo[6]);
$tag = "<div class='tagg'><img src='icon/tag.gif' alt='' /> ";
foreach($tagg as $taggi){if($taggi) {
if($_GET['search'] == 't') $taggi = skword($taggi);
$tag .= "<a href='?id={$id}&amp;search=t&amp;keyword=".urlencode($taggi)."&amp;p=1'>{$taggi}</a>, ";
}}
$tag = substr($tag, 0, -2)."</div>";
}
if($mn && $sss[46]) {
$m8 = file_exists("icon/m80_".$mn);
if($m8 && ($a = @fopen("icon/m02_".$mn,"r"))) {
if($m8) $sr_body = str_replace("<#sign12#>","<img src='icon/m80_{$mn}' alt='' />",$sr_body);
if($a) {$sr_body = str_replace("<#sign02#>",fread($a,filesize("icon/m02_".$mn)),$sr_body);fclose($a);}
} else $sr_body = str_replace("<#issign#>","<;>",$sr_body);
} else $sr_body = str_replace("<#issign#>","<;>",$sr_body);
function skeyw($memo) {
$mlt = explode('<',$memo);
$memo = '';
foreach($mlt as $mtt) {
$memo .= '<';
if(($msp = strpos($mtt,'>')) !== false) {
$memo .= substr($mtt,0,$msp);
$mtt = substr($mtt,$msp);
}
if($mtt) $memo .= skword($mtt);
}
return substr($memo,1);
}
$onload .= "xxn = '{$xx}';\nono = {$_GET['no']};\n";
if($_GET['search']) {
if($_GET['search'] == 's') $flo[3] = skword($flo[3]);
if($_GET['search'] == 'n') $name = str_replace($_GET['keyword'], "<span class='keyword'>{$_GET['keyword']}</span>",$name);
if($_GET['search'] == 'b') {$memo = skeyw($memo);}
}
if($ctg[$ctt]) $isnct = "";
else $isnct = "<;>";
if($crp[6][0] > 0) {
$insert = "";
for($r = $crp[6][0];$r > 0; $r--) $insert = $insert."re:";
$flo[3] = "<font class='t8'>".$insert."</font> ".$flo[3];
}
$url = "?".str_replace("&","&amp;",preg_replace("`(\?|&)(no|rp|p|slys)=[^&]+`i","",$_SERVER['QUERY_STRING']))."&amp;p=".$_GET['p'];
if(!$flo[5]) $isnlink = "<;>";
if($sss[54] && !$notice && $noright != 1) {
$addfield = explode("\x1b",$memo);
$memo = $addfield[0];
if($fv = @fopen($dxr.$id."/view.html","r")) {
$fvo ='';
while(!feof($fv)) {
$fvo .= fgets($fv);
}
eval("\$fvo=\"$fvo\";");
$memo = $fvo.$memo;
fclose($fv);
}} else if($aview >= 3 && !$noright) $onload .= "\nsetTimeout(\"aview('{$id}','{$_GET['no']}','{$xx}')\",150);";
$depth = $crp[6][0] + 1;
if($fh = @fopen($dxr.$id."/middle.dat","r")) {while(!feof($fh)) {$memo .= fgets($fh);}fclose($fh);}
$sr_body = str_replace("<#no#>",$_GET['no'],$sr_body);
$nvote = explode('|',$crp[5]);
if($wdth[7][5]) {
if(!$noright) {
$ratng = ($nvote[1])? sprintf("%.2f",$nvote[0]/$nvote[1]):0;
$memo .= "<div class='rating'><dt class='rating_bg'><div style='width:".(int)($ratng*25)."px'><img src='icon/t.gif' alt='' /></div></dt><dd class='p20'>".($ratng*2)."점 <span class='f8'>(참여:".(int)$nvote[1]."명)</span></dd>";
if($mbr_level >= $wdth[9][0] && (!$mn || $mn != $mbr_no)) $memo .= "<dd class='w20'><div onclick=\"this.nextSibling.style.display=(this.nextSibling.style.display=='block')?'none':'block'\" class='rating_set'>평점</div><ul onclick='if(this.style.height == \"126px\") this.style.height=\"0px\"'>
<li onclick=\"vote('s0','{$xx}','{$_GET['no']}')\"><dt style='width:0px'></dt></li>
<li onclick=\"vote('s1','{$xx}','{$_GET['no']}')\"><dt style='width:25px'></dt></li>
<li onclick=\"vote('s2','{$xx}','{$_GET['no']}')\"><dt style='width:50px'></dt></li>
<li onclick=\"vote('s3','{$xx}','{$_GET['no']}')\"><dt style='width:75px'></dt></li>
<li onclick=\"vote('s4','{$xx}','{$_GET['no']}')\"><dt style='width:100px'></dt></li>
<li onclick=\"vote('s5','{$xx}','{$_GET['no']}')\"><dt style='width:125px'></dt></li>
</ul></dd>";
$memo .= "<dd class='fcler'></dd></div>";
}} else {
if($sss[60]) $sr_body = str_replace("<#nAppr#>",(int)$nvote[0],$sr_body);
if($sss[61]) $sr_body = str_replace("<#nOppo#>",(int)$nvote[1],$sr_body);
}
if($sss[69]) {$fh = fopen("widget/twitter.htm","r");while(!feof($fh)) {$memo .= fgets($fh);}fclose($fh);}
$memo .= "<div class='fcler'></div>";
if($crp[6][0] === 'a' || $crp[6][0] == 9 || $sss[24] === 'a' || $sss[24] > $mbr_level || !$sss[55] || $sss[54] || $xx || $sss[63] || $sss[26] == 'd' || ($s7116 && $dctime > $cuttime[$sett[71][20]])) $sr_body = str_replace('<#frited#>','<;>',$sr_body);
$sr_body = imn($mn,ckmdfx(2,3,$crp,$flo[0]),$sr_body,$_GET['no'],$xx,1);
$sr_body = str_replace("<#xx#>",$xx,$sr_body);
$sr_body = str_replace("<#url#>",$url,$sr_body);
$sr_body = str_replace("<#subject#>",$flo[3],$sr_body);
$sr_body = str_replace("<#name#>",name($name, $mn, 0, 1, $fmm[$mn][10]),$sr_body);
$sr_body = str_replace("<#tname#>",name($name, $mn, 0, 0, $fmm[$mn][10]),$sr_body);
$sr_body = str_replace("<#isnct#>",$isnct,$sr_body);
if($isnct != "<;>") {
$sr_body = str_replace("<#ct_no#>",$ctt,$sr_body);
$sr_body = str_replace("<#ct_name#>",$ctg[$ctt],$sr_body);
}
$sr_body = str_replace("<#nHit#>",(int)$crp[1],$sr_body);
$sr_body = str_replace("<#nReply#>",(int)$crp[2],$sr_body);
if($wdth[9][11]) $sr_body = str_replace("<#nTrb_out#>",(int)$crp[3],$sr_body);
$sr_body = str_replace("<#nTrb_in#>",(int)$crp[4],$sr_body);
$sr_body = str_replace("<#date#>",@date("Y-m-d H:i", $date),$sr_body);
$sr_body = str_replace("<#memo#>",nocopy($memo),$sr_body);
$sr_body = str_replace("<#isnlink#>",$isnlink,$sr_body);
$sr_body = str_replace("<#rlink#>",$flo[5],$sr_body);
$sr_body = str_replace("<#tag#>",$tag,$sr_body);
if(!$noright) $sr_body = str_replace("<#uplist#>",uplist($_GET['no']),$sr_body);
$sr_body = str_replace("<#depth#>",$depth,$sr_body);
if($inclwt=inclvde($sr_body)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) {if($sett[92][0] == '2' || $sett[92][0] == '3') $gmtime = getmicrotime();include($inxv[1]);if($sett[92][0] == '2' || $sett[92][0] == '3') echo "<!--".$inxv[1]." 처리시간:: ".(getmicrotime() - $gmtime)." -->";}else {?><?php echo $inxv[1]?><?php }}
if($_GET['no'] && $type == 'b') $type = 'a';
if($fz) $onload .= "if($('cfsz')) $('cfsz').value = '{$fz}';";
$onload .= "\nsetTimeout('img_resize()',100);";
?>