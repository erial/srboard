<?php
if($_POST['ajax']) {
$zr = opendir("../data");
while($zro = readdir($zr)) {
if($zro != '.' && $zro != '..' && $zro) {$dxr = "../data/".$zro."/";break;}
}
closedir($zr);
}
$big = 0;
$dd = array();
$mm = array();
$thsmnth = date("Ym");
$mnth = ($_REQUEST['date'])? substr($_REQUEST['date'],0,6):$thsmnth;
$day = (int)substr($_REQUEST['date'], 6);
$fr = fopen($dxr."count.dat","r");
while(!feof($fr)){
if($fro = trim(fgets($fr))){
$fdn = substr($fro,8);
if(substr($fro,0,6) == $mnth) $dd[(int)substr($fro,6,2)] = $fdn;
$big = ($big > $fdn)? $big:$fdn;
$mm[substr($fro,0,6)] += $fdn;
}}
fclose($fr);
if($thsmnth == $mnth) {
$y = date("Y");$m = date("m");$d = date("d");
$today = mktime(0,0,0,$m,$d,$y);
$yday = $today - 86400;
$temp = $y.$m;$d = (int)$d;$y = $d - 1;$m = $d - 2;
if($fr = fopen($dxr."count_3d.dat","r")) {
while($fro = substr(fgets($fr),0,10)){
if($fro > 10) {
if($fro >= $today) $dd[$d]++;else if($fro >= $yday) $dd[$y]++;else $dd[$m]++;
$mm[$temp]++;
}}
fclose($fr);
}}
if(!$_POST['ajax']) {
?>
<div class='tab_top'><div class='tab_head theado' style='float:left'><div class='first'><a href='#none'>월별 방문자수</a></div></div><div style='float:right;padding-top:7px'><select id='counter_monsel' onchange="counterm(this.options[this.selectedIndex].value);">
<?php
foreach($mm as $ym => $cnt) echo "<option value='{$ym}'>".substr($ym,0,4)."/".substr($ym,4)." ({$cnt})</option>";
?>
</select></div>
<script type='text/javascript'>
//<![CDATA[
function counterm(n) {
if(n) {
azax("widget/counter_mon.php?&date=" + n,"$('counter_mondv').innerHTML=ajax");
}}
$('counter_monsel').value = "<?php echo $mnth?>";
//]]>
</script>
</div>
<div id='counter_mondv' class='tab_div'>
<?php
}
$month = substr($mnth, 4, 2);
$year = substr($mnth, 0, 4);
$pxt = mktime(0, 0, 0, $month, 1, $year);
$med = date("t", $pxt);
$nxt = mktime(23, 59, 59, $month, $med, $year);

$fem = date("w", $pxt);
$nxm = $year.str_pad($month + 1, 2, 0, STR_PAD_LEFT);
$pxm = $year.str_pad($month - 1, 2, 0, STR_PAD_LEFT);
if($month == '12') $nxm = ($year + 1)."01";
else if($month == '01') $pxm = ($year - 1)."12";
?>

<table class='calm'>
<colgroup><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /></colgroup>
<tr class='navi'><td>&nbsp;</td><td><a href='#none' onclick="counterm('<?php echo $pxm?>')">&lt;</a></td><td colspan='3'><?php echo substr($mnth, 0, 4)?> : <?php echo (int)substr($mnth, 4, 2)?></td><td><a href='#none' onclick="counterm('<?php echo $nxm?>')">&gt;</a></td><td>&nbsp;</td></tr>
<tr class='day'><td><font color='#FF0000'>일</font></td><td>월</td><td>화</td><td>수</td><td>목</td><td>금</td><td>토</td></tr><tr>

<?php
if($thsmnth == $mnth) $thsmnthd = date("d");
for($i = 0; $i < $fem; $i++) echo "<td>&nbsp;</td>";
for($stt = 1; $stt <= $med; $stt++) {
$sst = ($stt + $fem) % 7;
if($sst == 1) echo "<td style='color:#ff6633;background-color:rgb(";
else echo "<td style='background-color:rgb(";
if($dd[$stt]) {
$color = (int)($dd[$stt]/$big*512);
if($color > 256) echo "255,".(512 -$color).",0";
else echo ($color -1).",255,0";
} else echo "255,255,255";
echo ")'>{$dd[$stt]}<br /><div";
if($thsmnthd == $stt) echo " class='thisdoc'";
echo ">{$stt}</div></td>";
if($sst == 0 && $stt != $med) echo "</tr><tr>";
}
if($sst > 0) for($i = $sst; $i < 7; $i++) echo "<td>&nbsp;</td>";
?>

</tr>
</table>
<?php if(!$_POST['ajax']) echo "</div>";?>