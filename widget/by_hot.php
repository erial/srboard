<?php
if(!isset($searc) || !$searc) $searc = 100; // 추적할 개별게시판의 최근게시물 수
if(!isset($orderby) || !$orderby) $orderby = 1; // 조회순=1, 덧글순=2, 엮은글순=3, 엮인글순=4, 추천순=5,
if(!isset($limit) || !$limit) $limit = 10; // 출력할 갯수
$rbdt = '';
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
$rbdt[$frnx[$orderby]] = array($rbid,substr($frnx[0],0,6),substr($frlo, 0, 10),substr($frlo, 26));
}}
fclose($frn);
fclose($frl);
}
}
if(is_array($rbdt)) {
krsort($rbdt);
?>
<table cellspacing='0' cellpadding='0' class='head_all hslice' id='wg_order<?php echo $orderby?>'>
<tr class='title_tr'><td class='title_td'><div style='padding-left:8px' class='entry-title'><b>인기순</b></div></td></tr>
<tr><td class='gtlst entry-content'>

<?php
$i = 1;
while($i <= $limit && list($key,$value) = each($rbdt)) {
$frrn = explode("\x1b",$value[3]);
$frrn[2] = andamp($frrn[2]);
?>
<div class='link'><a href='<?php echo $index?>?id=<?php echo urlencode($value[0])?>&amp;no=<?php echo (int)$value[1]?>' class='pvxy'><?php echo $frrn[2]?></a></div><div class='small'><span style='color:#55BEFF'>▶<?php echo $key?>ㆍ</span> <?php echo date("m/d", $value[2])?> - <?php echo $frrn[0]?> [<?php echo $bdidnm[$value[0]]?>]</div>
<?php
$i++;
}
?>

</td></tr></table>
<?php
}
unset($searc);
unset($orderby);
unset($limit);
?>