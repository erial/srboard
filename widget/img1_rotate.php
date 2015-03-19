<?php
if(!isset($bd_id_imgrotate) || !$bd_id_imgrotate) $bd_id_imgrotate = ""; //게시판 id - 위에서 정의된 게 없으면 여기서 정의합니다
if(!isset($use_thumb) || !$use_thumb) $use_thumb = 1; // 원본출력 = 1, 썸네일출력 = 2
if(!isset($rlmt) || !$rlmt) $rlmt = 10; // 목록갯수
if(!isset($img_wt) || !$img_wt) $img_wt = 600; // 큰 이미지 넓이 (단위는 px)
if(!isset($img_ht) || !$img_ht) $img_ht = 400; // 큰 이미지 높이 (단위는 px)
if(!isset($rotate_interval) || !$rotate_interval) $rotate_interval = 5000; // 회전 시간간격 (5초=5000)

$dsmg = '';
if($bd_id_imgrotate && $bdidnm[$bd_id_imgrotate]) {
$bd_uid_imgrotate = urlencode($bd_id_imgrotate);
$mss = $fsbs[$bd_id_imgrotate];
if($use_thumb != 2) {
$fu = fopen($dxr.$bd_id_imgrotate."/upload.dat","r");
while(!feof($fu)) {
$fuo = trim(fgets($fu));
$file = substr($fuo,6,-12);
$ext = strtolower(substr($file,-4));
if($ext == '.jpg' || $ext == '.gif' || $ext == '.png') $ff[urlencode(substr($file,0,-4))] = $file;
}
fclose($fu);
}
$ii = 0;
$ida = '';
$fl = fopen($dxr.$bd_id_imgrotate."/list.dat","r");
$fn = fopen($dxr.$bd_id_imgrotate."/no.dat","r");
while(!feof($fn)){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = explode("\x1b", fgets($fl));
if(substr($zzz,6,2) == 'aa') continue;
if($flo[4] == '') continue;
if($use_thumb != 2) {
if(substr($flo[4],-6,3) == '_s.') $flo[4] = substr($flo[4],0,-6);
else $flo[4] = substr($flo[4],0,-4);
$ff4 = $ff[$flo[4]];
} else $ff4 = $flo[4];
if($mss[13] === 'a' || (int)$zzz[8] > $mbr_level || $mss[13] > $mbr_level) continue;
if(substr($flo[4],0,7) != 'http://' && $ff4) {
if(($zz6 = (int)substr($zzz,0,6))) {
$zzz = explode("\x1b",$zzz);
$zzz = (int)$zzz[2];
$flo[3] = andamp($flo[3]);
$dsmg .= "Array('exe.php?sls={$bd_uid_imgrotate}/file/{$ff4}','{$zz6}','{$flo[3]}','{$flo[1]}','{$zzz}'),";
$ii++;
}}} else {
$mwth = explode("\x1b",$mss);
list($ida,$fn,$fl) = data6($ida,array($fn,$fl),array($bd_id_imgrotate,$mwth[6]));
if($ida == 'q') break;
}
if($ii >= $rlmt) break;
}
fclose($fl);
fclose($fn);
unset($ff);
if($rlmt > $ii) $rlmt = $ii;
?>
<div id='de818' style='width:<?php echo $img_wt + 4?>px;height:<?php echo $img_ht + 10?>px;padding:5px'></div>
<div id='de828' style='width:<?php echo $img_wt + 4?>px'></div><img style='width:1px;height:1px' /><img style='width:1px;height:1px' />
<script type='text/javascript'>
//<![CDATA[
var de88 = document.getElementById('de818');
var demg = document.getElementsByName('demgg');
var demp = $('de828').getElementsByTagName('input');
var img_this = 0;
var dsmg = Array(<?php echo substr($dsmg,0,-1)?>);
function emgtt(w) {
if(w) {
clearInterval(ett);
ett = setInterval('emgtt()',<?php echo $rotate_interval?>);
w -= 1;
} else w = ((img_this + 1) % <?php echo $rlmt?>);
tot_3(w);
}
function tot_1(v) {
rhref("<?php echo $index?>?id=<?php echo $bd_uid_imgrotate?>&amp;no=" + dsmg[img_this][1]);
}
function tot_2(v) {
$("pview").style.width = '200px';
preview("<div class='prsjt'>" + dsmg[img_this][2] + "</div><span class='n8'>by " + dsmg[img_this][3] + "</span> <span class='r7'>[" + dsmg[img_this][4] + "]</span>","xx");
}
function tot_3(v) {
img_this = v;
de88.firstChild.src = dsmg[v][0];
for(var n=0;n < <?php echo $rlmt?>;n++) {
if(v == n) demp[v].style.background = '#000000';
else demp[n].style.background = 'transparent';
}
$('de828').nextSibling.src = dsmg[((img_this + 1) % <?php echo $rlmt?>)];
$('de828').nextSibling.nextSibling.src = dsmg[((img_this + 2) % <?php echo $rlmt?>)];
}
function tot_4() {
clearInterval(ett);
}
function tot_5() {
ett = setInterval('emgtt()',<?php echo $rotate_interval?>);
}
function ve818() {
var dee = "<img name='demgg' onclick='tot_1(0)' onmouseover='tot_4();tot_2(0)' onmouseout='tot_5();preview()' src='" + dsmg[0][0] + "' style='width:<?php echo $img_wt?>px;height:<?php echo $img_ht?>px' />";
de88.innerHTML = dee;
dee = "<input type='button' onclick='emgtt(1)' value=' 1 ' style='background:#000000' />";
for(var i=2; i <= <?php echo $rlmt?>; i++) {
dee += "<input type='button' onclick='emgtt(" + i + ")' value=' " + i + " ' />";
}
$('de828').innerHTML = dee;
ett = setInterval('emgtt()',<?php echo $rotate_interval?>);
}
setTimeout('ve818()',200);
//]]>
</script>
<?php } else echo "<h3>widget/img_rotate.php에 게시판id를 입력하세요</h3>";
unset($bd_id_imgrotate);
unset($use_thumb);
unset($rlmt);
unset($img_wt);
unset($img_ht);
unset($rotate_interval);
?>