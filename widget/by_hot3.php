<?php
if(!isset($searc) || !$searc) $searc = 100; // 추적할 개별게시판의 최근게시물 수
if(!isset($limit) || !$limit) $limit = 8;  // 출력할 갯수
$rbdt = '';
$rbdt_0 = '';
$rbdt_1 = '';
$i = 0;
foreach($fsbs as $rbid => $rbset) {
if($rbset[16] != 'd' && !$rbset[53] && !$rbset[46]) {
$ida = '';
$frn = fopen($dxr.$rbid."/no.dat","r");
$frl = fopen($dxr.$rbid."/list.dat","r");
for($ii = 0;$ii < $searc;$ii++) {
$frno = fgets($frn);
$frlo = fgets($frl);
if($frno == "\n" || $frno == "") {
$rdth = explode("\x1b",$rbset);
list($ida,$frn,$frl) = data6($ida,array($frn,$frl),array($rbid,$rdth[6]));
if($ida == 'q') break;
$ii--;
} else {
if(substr($frno,6,2) == 'aa') {$searc++;continue;}
$frnx = explode("\x1b",$frno);
$rbdt[$i] = array($rbid,substr($frnx[0],0,6),substr($frlo, 0, 10),substr($frlo, 26));
$rbdt_0[$i] = (int)$frnx[1];
$rbdt_1[$i] = (int)$frnx[2];
$i++;
}}
fclose($frn);
fclose($frl);
}
}
if(is_array($rbdt)) {
arsort($rbdt_0);
arsort($rbdt_1);
$tpn++;
?>
<div id='tpn_<?php echo $tpn?>' class='tab_top' onmouseover='stopt=<?php echo $tpn?>' onmouseout='stopt=-1'>
<div class='tab_head theado' id='tabhead_<?php echo $iii?>' onmouseover='tabview(this)'><div class='first'><a href='#none'>조회순</a></div></div>
<div class='tab_head theadx' id='tabhead_<?php echo $iii +1?>' onmouseover='tabview(this)'><div><a href='#none'>덧글순</a></div></div><div class='fcler'></div></div>
<div class='tab_div' onmouseover='stopt=<?php echo $tpn?>' onmouseout='stopt=-1'>
<div class='tab_list tlisto' id='tablist_<?php echo $iii?>'>
<?php
$i = 1;
while($i <= $limit && list($key,$value) = each($rbdt_0)) {
$frrn = explode("\x1b",$rbdt[$key][3]);
$frrn[2] = andamp($frrn[2]);
?>
<div class='nobf gifs'><span class='ta5'><?php echo $value?></span><a href='<?php echo $index?>?id=<?php echo urlencode($rbdt[$key][0])?>&amp;no=<?php echo (int)$rbdt[$key][1]?>' class='pvxz'><?php echo $frrn[2]?></a>
</div><div class='fcler'><span class='ta7'><?php echo date("m/d", $rbdt[$key][2])?></span><span class='small'> - <?php echo $frrn[0]?> [<?php echo $bdidnm[$rbdt[$key][0]]?>]</span></div>
<?php
$i++;
}
?>
</div>
<div class='tab_list tlistx' id='tablist_<?php echo $iii+1?>'>
<?php
$i = 1;
while($i <= $limit && list($key,$value) = each($rbdt_1)) {
$frrn = explode("\x1b",$rbdt[$key][3]);
$frrn[2] = andamp($frrn[2]);
?>
<div class='nobf gifs'><span class='ta5'><?php echo $value?></span><a href='<?php echo $index?>?id=<?php echo urlencode($rbdt[$key][0])?>&amp;no=<?php echo (int)$rbdt[$key][1]?>' class='pvxz'><?php echo $frrn[2]?></a>
</div><div class='fcler'><span class='ta7'><?php echo date("m/d", $rbdt[$key][2])?></span><span class='small'> - <?php echo $frrn[0]?> [<?php echo $bdidnm[$rbdt[$key][0]]?>]</span></div>
<?php
$i++;
}
?>
</div></div>
<?php
$iii = $iii+3;
}
unset($searc);
unset($limit);
?>