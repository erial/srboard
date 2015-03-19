<?php
if(!isset($bd_id_imgrotate) || !$bd_id_imgrotate) $bd_id_imgrotate = ""; //게시판 id - 위에서 정의된 게 없으면 여기서 정의합니다
if(!isset($use_thumb) || !$use_thumb) $use_thumb = 1; // 원본출력 = 1, 썸네일출력 = 2
if(!isset($rlmt) || !$rlmt) $rlmt = 10; // 목록갯수
if(!isset($div_wt) || !$div_wt) $div_wt = 700; // 전체 넓이 (단위는 px)
if(!isset($img_wt) || !$img_wt) $img_wt = 600; // 큰 이미지 넓이 (단위는 px)
if(!isset($img_ht) || !$img_ht) $img_ht = 400; // 큰 이미지 높이 (단위는 px)
if(!isset($rotate_interval) || !$rotate_interval) $rotate_interval = 5000; // 회전 시간간격 (5초=5000)

$dsmg = '';
if($bd_id_imgrotate && $bdidnm[$bd_id_imgrotate]) {
$bd_uid_imgrotate = urlencode($bd_id_imgrotate);
$ww2 = ($div_wt/2) - ($img_wt/2) - 2;
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
<div id='de818' style='width:<?php echo $div_wt -4?>px;height:<?php echo $img_ht + 40?>px'></div>
<div id='de828' style='width:<?php echo $div_wt -14?>px'></div>
<script type='text/javascript'>
//<![CDATA[
var dml = Array(Array(100,80,<?php echo (($img_ht/2) -20)?>,20,1),Array(<?php echo $img_wt?>,<?php echo $img_ht?>,20,<?php echo $ww2?>,3),Array(100,80,<?php echo (($img_ht/2) -20)?>,<?php echo ($div_wt - 128)?>,2));
var de88 = document.getElementById('de818');
var demg = document.getElementsByName('demgg');
var demp = $('de828').getElementsByTagName('input');
var n = 0;
var ett;
var opacit = 0;
var dsmg = Array(<?php echo substr($dsmg,0,-1)?>);
var ey = 2;
var dmlp = Array('',Array(0,0,0,<?php echo (($div_wt - 148) / 10)?>),Array(<?php echo (($img_wt - 100) / 10)?>,<?php echo (($img_ht - 80) / 10)?>,-<?php echo ((($img_ht/2) -40) / 10)?>,-<?php echo (($div_wt - $ww2 - 128) / 10)?>),Array(-<?php echo (($img_wt - 100) / 10)?>,-<?php echo (($img_ht - 80) / 10)?>,<?php echo ((($img_ht/2) -40) / 10)?>,-<?php echo (($ww2 - 20) / 10)?>));

function opasity(key,value) {
var isie = '<?php echo $isie?>';
if(isie == '1') key.style.filter = 'alpha(opacity=' + value + ')';
else key.style.opacity = value/100;
if(value == '100') key.style.zIndex = 2;
else key.style.zIndex = 1;
}
function pls(val,ps) {
val = val + ps;
if(val < 0) val += <?php echo $rlmt?>;
else if(val >= <?php echo $rlmt?>) val -= <?php echo $rlmt?>;
return val;
}
function pml(p,em) {
var pm = dml[p][4];
if(pm == 1 && em != 2) dml[p][3] += dmlp[1][3];
else if(pm == 2 && em == 2) dml[p][3] -= dmlp[1][3];
else {
if(em == 2) {
if(pm == 1) pm = 3;
else if(pm == 3) pm = 2;
dml[p][0] -= dmlp[pm][0];
dml[p][1] -= dmlp[pm][1];
dml[p][2] -= dmlp[pm][2];
dml[p][3] -= dmlp[pm][3];
} else {
dml[p][0] += dmlp[pm][0];
dml[p][1] += dmlp[pm][1];
dml[p][2] += dmlp[pm][2];
dml[p][3] += dmlp[pm][3];
}
}}
function emgrr(en,em) {
en--;
if(en > 0) {
setTimeout("emgrr(" + en + "," + em + ")",10);
for(var i=0; i < 3; i++) {
pml(i,em);
if(dml[i][4] == 1 && em != 2) {
	demg[i].style.marginLeft = dml[i][3] + 'px';
	if(ey == 2 && dml[i][3] >= <?php echo $ww2?>) {
	demp[n].style.background ='transparent';
	ey = 0;n = pls(n,1);demg[i].src=dsmg[pls(n,1)][0];
	} else if(dml[i][3] > <?php echo ($div_wt - 129)?>) {
	dml[i][4] = 2;ey = 2;
	}
} else if(dml[i][4] == 2 && em == 2) {
	demg[i].style.marginLeft = dml[i][3] + 'px';
	if(ey == 2 && dml[i][3] <= <?php echo $ww2?>) {
	demp[n].style.background ='transparent';
	ey = 0;n = pls(n,-1);demg[i].src=dsmg[pls(n,-1)][0];
	} else if(dml[i][3] < 21) {
	dml[i][4] = 1;ey = 2;
	}
} else {
demg[i].style.width = dml[i][0] + 'px';
demg[i].style.height = dml[i][1] + 'px';
demg[i].style.marginTop = dml[i][2] + 'px';
demg[i].style.marginLeft = dml[i][3] + 'px';
if(em != 2) {
if(dml[i][4] == 3 && dml[i][0] <= 100) dml[i][4] = 1;
else if(dml[i][0] >= <?php echo $img_wt?> && dml[i][4] == 2) dml[i][4] = 3;
} else {
if(dml[i][4] == 3 && dml[i][0] <= 100) dml[i][4] = 2;
else if(dml[i][0] >= <?php echo $img_wt?> && dml[i][4] == 1) dml[i][4] = 3;
}
}
}
} else {
for(var i=0; i < 3; i++) {
if(dml[i][4] == 1) opasity(demg[i],'30');
else if(dml[i][4] == 2) opasity(demg[i],'50');
else opasity(demg[i],'100');
}
demp[n].style.background ='#000000';
}
}
function emgtt(w) {
if(w) {
clearInterval(ett);
ett = setInterval('emgtt()',<?php echo $rotate_interval?>);
}
emgrr(11,1);
}
function tot_1(v) {
if(dml[v][4] == 1) tot_3(n);
else if(dml[v][4] == 2) emgtt(1);
else if(dml[v][4] == 3) rhref("<?php echo $index?>?id=<?php echo $bd_uid_imgrotate?>&amp;no=" + dsmg[n][1]);
}
function tot_2(v) {
if(dml[v][4] == 3) {
$("pview").style.width = '200px';
preview("<div class='prsjt'>" + dsmg[n][2] + "</div><span class='n8'>by " + dsmg[n][3] + "</span> <span class='r7'>[" + dsmg[n][4] + "]</span>","xx");
}}
function tot_3(v) {
if(v == n || v - n == <?php echo $rlmt?>) {
clearInterval(ett);
emgrr(11,2);
ett = setInterval('emgtt()',<?php echo $rotate_interval?>);
} else {
if(v - n != 2) {
demp[n].style.background = 'transparent';
n = pls(v,-2);
for(var i = 0;i < 3;i++) {
if(dml[i][4] == 1) demg[i].src=dsmg[pls(n,-1)][0];
else if(dml[i][4] == 3) demg[i].src=dsmg[n][0];
else if(dml[i][4] == 2) demg[i].src=dsmg[pls(n,1)][0];
}}
emgtt(1);
}}
function ve818() {
var dee = "<img name='demgg' onclick='tot_1(0)' onmouseover='tot_2(0)' onmouseout='preview()' src='" + dsmg[<?php echo ($rlmt -1)?>][0] + "' style='width:" + dml[0][0] + "px;height:" + dml[0][1] + "px;margin-top:" + dml[0][2] + "px;margin-left:" + dml[0][3] + "px' />";
for(var i=1; i < 3; i++) {
dee += "<img name='demgg' onclick='tot_1(" + i + ")' onmouseover='tot_2(" + i + ")' onmouseout='preview()' src='" + dsmg[(i -1)][0] + "' style='width:" + dml[i][0] + "px;height:" + dml[i][1] + "px;margin-top:" + dml[i][2] + "px;margin-left:" + dml[i][3] + "px' />";
}
de88.innerHTML = dee;
dee = "<input type='button' name='dempt' onclick='tot_3(1)' value=' 1 ' style='background:#000000' />";
for(var i=2; i <= <?php echo $rlmt?>; i++) {
dee += "<input type='button' name='dempt' onclick='tot_3(" + i + ")' value=' " + i + " ' />";
}
$('de828').innerHTML = dee;
opasity(demg[0],'30');
opasity(demg[2],'50');
ett = setInterval('emgtt()',<?php echo $rotate_interval?>);
}
setTimeout('ve818();demg[1].style.zIndex=2',200);
//]]>
</script>
<?php } else echo "<h3>widget/img_rotate.php에 게시판id를 입력하세요</h3>";
unset($bd_id_imgrotate);
unset($use_thumb);
unset($rlmt);
unset($div_wt);
unset($img_wt);
unset($img_ht);
unset($rotate_interval);
?>