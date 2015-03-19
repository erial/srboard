<?php
if(!isset($limit) || !$limit) $limit = 8; // 출력할 갯수
$rbdt_0 = '';
$rbdt_1 = '';
$frot0 = 0;
$frot1 = 0;
$i0 = 0;
$i1 = 0;
foreach($fsbs as $rbid => $rbset) {
if($rbset[16] != 'd' && !$rbset[53] && !$rbset[46] && ($i0 < $limit || filemtime($dxr.$rbid."/body.dat") > $frot0)) {
$ida = '';
$frn = fopen($dxr.$rbid."/no.dat","r");
$frl = fopen($dxr.$rbid."/list.dat","r");
for($ii = 0;$ii < $limit;$ii++) {
$frno = fgets($frn);
$frlo = fgets($frl);
if($frno == "\n" || $frno == "") {
$rdth = explode("\x1b",$rbset);
list($ida,$frn,$frl) = data6($ida,array($frn,$frl),array($rbid,$rdth[6]));
if($ida == 'q') break;
$ii--;
} else {
if(substr($frno,6,2) == 'aa') {$limit++;continue;}
$rbdt_0[substr($frlo,0,10)] = array($rbid,substr($frno,0,6),$frno[8].substr($frlo, 25));
$i0++;
}}
fclose($frn);
fclose($frl);
if($i0 >= $limit) {
krsort($rbdt_0);
$rbdt_0 = array_slice($rbdt_0,0,$limit,TRUE);
$frot0 = key(array_slice($rbdt_0,-1,1,TRUE));
}}
if($rbset[42] != '1' && ($i1 < $limit || filemtime($dxr.$rbid."/new_rp.dat") > $frot1)) {
$fr = fopen($dxr.$rbid."/new_rp.dat","r");
for($ii = 0;$ii < $limit;$ii++) {
if($fro = trim(fgets($fr))) {
$rbdt_1[substr($fro, 34, 10)] = array($rbid,$fro,$fsbs[$rbid][16]);
$i1++;
}}
fclose($fr);
if($i1 >= $limit) {
krsort($rbdt_1);
$rbdt_1 = array_slice($rbdt_1,0,$limit,TRUE);
$frot1 = key(array_slice($rbdt_1,-1,1,TRUE));
}}}
if(is_array($rbdt_0)) {
krsort($rbdt_0);
if(is_array($rbdt_1)) krsort($rbdt_1);
$tpn++;
?>
<div id='tpn_<?php echo $tpn?>' class='tab_top' onmouseover='stopt=<?php echo $tpn?>' onmouseout='stopt=-1'>
<div class='tab_head theado' id='tabhead_<?php echo $iii?>' onmouseover='tabview(this)'><div class='first'><a href='#none'>최근 글</a></div></div>
<div class='tab_head theadx' id='tabhead_<?php echo $iii +1?>' onmouseover='tabview(this)'><div><a href='#none'>최근 덧글</a></div></div><div class='fcler'></div></div>
<div class='tab_div' onmouseover='stopt=<?php echo $tpn?>' onmouseout='stopt=-1'>
<div class='tab_list tlisto' id='tablist_<?php echo $iii?>'>
<?php
$i = 1;
while($i <= $limit && list($key,$value) = each($rbdt_0)) {
$frrn = explode("\x1b",$value[2]);
$frrn[3] = andamp($frrn[3]);
if($frrn[0] != 'r' && $frrn[0] > $mbr_level) $gif = "<img src='icon/lock.gif' alt='' />&nbsp;";
else $gif = "";
?>
<div class='nobf gifa'><?php echo $gif?><a href='<?php echo $index?>?id=<?php echo urlencode($value[0])?>&amp;no=<?php echo (int)$value[1]?>' class='pvxz'><?php echo $frrn[3]?></a></div><div class='fcler'><span class='ta7'><?php echo date("m/d", $key)?></span><span class='small'> - <?php echo $frrn[1]?> [<?php echo $bdidnm[$value[0]]?>]</span></div>
<?php
$i++;
}
?>
</div>
<div class='tab_list tlistx' id='tablist_<?php echo $iii+1?>'>
<?php
$i = 1;
while($i <= $limit && list($key,$value) = each($rbdt_1)) {
$frr = preg_replace("`<[^>]+>?`i", "",andamp(substr($value[1],44)));
if($frr[0] == "\x1b") $frr = "[비밀글]";
?>
<div class='nobf gifa'><a href='<?php echo $index?>?id=<?php echo urlencode($value[0])?>&amp;<?php echo ($value[2] == 'd')?'rp':'no';?>=<?php echo (int)substr($value[1],0,6)?>&amp;cc=<?php echo substr($value[1],6,7)?>' class='pvxz'><?php echo $frr?></a>
</div><div class='fcler'><span class='ta7'><?php echo date("m/d", $key)?></span><span class='small'> - <?php echo substr($value[1], 14, 20)?> [<?php echo $bdidnm[$value[0]]?>]</span></div>
<?php
$i++;
}
?>
</div></div>
<?php
$iii = $iii+2;
}
unset($limit);
?>