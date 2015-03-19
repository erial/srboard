<?php
if(!isset($bd_id_imgblock) || !$bd_id_imgblock) $bd_id_imgblock = ""; //게시판 id - 위에서 정의된 게 없으면 여기서 정의합니다
if(!isset($rlmt) || !$rlmt) $rlmt = 7; // 이미지갯수 -홀수로-
if(!isset($bwidth) || !$bwidth) $bwidth = 462; // 영역넓이
if(!isset($bheight) || !$bheight) $bheight = 182; // 영역높이

if($bd_id_imgblock && $bdidnm[$bd_id_imgblock]) {
$bd_uid_imgblock = urlencode($bd_id_imgblock);
$bcnt = ($rlmt -1) / 2;
$cwt = (($bwidth -2) / ($bcnt + 2)) - 8;
$cht = (($bheight -2) / 2) - 8;
$mss = $fsbs[$bd_id_imgblock];
$ii = 0;
$totb = '';
$ffg = '';
$ida = '';
$fn = fopen($dxr.$bd_id_imgblock."/no.dat","r");
$fl = fopen($dxr.$bd_id_imgblock."/list.dat","r");
while(!feof($fn)){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = explode("\x1b", fgets($fl));
if(substr($zzz,6,2) == 'aa') continue;
if($flo[4] == '') continue;
if($mss[13] === 'a' || (int)$zzz[8] > $mbr_level || $mss[13] > $mbr_level) continue;
$ff[$ii] = array((int)substr($zzz,0,6),$flo[4]);
$zzz = explode("\x1b",$zzz);
$zzz = (int)$zzz[2];
$flo[3] = andamp($flo[3]);
$totb .= "Array('{$flo[3]}','{$flo[1]}','{$zzz}'),";
$ii++;
} else {
$mwth = explode("\x1b",$mss);
list($ida,$fn,$fl) = data6($ida,array($fn,$fl),array($bd_id_imgblock,$mwth[6]));
if($ida == 'q') break;
}
if($ii >= $rlmt) break;
}
fclose($fl);
fclose($fn);
if($rlmt > $ii) $rlmt = $ii;
if(substr($ff[0][1],0,7) != 'http://') {
$ffi = urldecode(substr($ff[0][1],0,-6));
$fu = fopen($dxr.$bd_id_imgblock."/upload.dat","r");
while(!feof($fu)) {
$fuo = trim(fgets($fu));
$file = substr($fuo,6,-12);
if(strpos($file,$ffi) !== false && substr($file,0,-4) == $ffi) {
$ext = strtolower(substr($file,-4));
if($ext == '.jpg' || $ext == '.gif' || $ext == '.png') {
$ffg = "exe.php?sls={$bd_uid_imgblock}/file/".urlencode($file);
break;
}}}
fclose($fu);
if(!$ffg) $ffg = "exe.php?sls={$bd_uid_imgblock}/file/".$ff[0][1];
} else $ffg = $ff[0][1];
?>
<div class='img_block' style='width:<?php echo $bwidth -2?>px;height:<?php echo $bheight -2?>px'>
<a href='<?php echo $index?>?id=<?php echo $bd_uid_imgblock?>&amp;no=<?php echo $ff[0][0]?>' onmouseover="tot_b(0)" onmouseout="preview()"><img src='<?php echo $ffg?>' style='width:<?php echo $cwt*2 + 8?>px;height:<?php echo ($cht*2 + 8)?>px' /></a>
<?php
for($i = 1; $i < $rlmt; $i++) {
if(substr($ff[$i][1],0,7) != 'http://') $ff[$i][1] = "exe.php?sls={$bd_id_imgblock}/file/{$ff[$i][1]}";
?>
<a href='<?php echo $index?>?id=<?php echo $bd_uid_imgblock?>&amp;no=<?php echo $ff[$i][0]?>' onmouseover="tot_b(<?php echo $i?>)" onmouseout="preview()"><img src='<?php echo $ff[$i][1]?>' style='width:<?php echo $cwt?>px;height:<?php echo $cht?>px' /></a>
<?php
}
?>
</div>
<script type='text/javascript'>
//<![CDATA[
function tot_b(v) {
var totb = Array(<?php echo substr($totb,0,-1)?>);
$("pview").style.width = '200px';
preview("<div class='prsjt'>" + totb[v][0] + "</div><span class='n8'>by " + totb[v][1] + "</span> <span class='r7'>[" + totb[v][2] + "]</span>","xx");
}
//]]>
</script>
<?php } else echo "<h3>widget/img_block.php에 게시판id를 입력하세요</h3>";
unset($bd_id_imgblock);
unset($rlmt);
unset($bwidth);
unset($bheight);
?>