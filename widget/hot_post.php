<?php
if(!isset($limit) || !$limit) $limit = 10; // 출력할 갯수
if(!isset($groupORsection) || !$groupORsection) $groupORsection = 1; // 1:모든 게시판의 최근글 출력, 2:섹션그룹(없으면 모든 게시판), 3:섹션

if($groupORsection == 3) $group = array($section,'');
else if($groupORsection == 2 && $grp) $group = explode("^",substr($grp[$sect[$section][6]][2],1,-1));else $group = 0;
$rbdt = '';
$frot = 0;
$i = 0;
foreach($fsbs as $rbid => $rbset) {
if($group && !in_array((int)substr($rbset,47,2),$group)) continue;
if($rbset[16] != 'd' && !$rbset[53] && !$rbset[46] && ($i < $limit || filemtime($dxr.$rbid."/body.dat") > $frot)) {
$ida = '';
$frn = fopen($dxr.$rbid."/no.dat","r");
$frl = fopen($dxr.$rbid."/list.dat","r");
for($ii = 0;$ii < $limit;$ii++) {
$frlo = fgets($frl);
$frno = fgets($frn);
if($frno == "" || $frno == "\n") {
$rdth = explode("\x1b",$rbset);
list($ida,$frn,$frl) = data6($ida,array($frn,$frl),array($rbid,$rdth[6]));
if($ida == 'q') break;
}
if(substr($frno,6,2) == 'aa') {$limit++;continue;}
$rbdt[substr($frlo, 0, 10)] = array($rbid,(int)substr($frno,0,6),$frno[8],substr($frlo, 26));
$i++;
}
fclose($frn);
fclose($frl);
if($i >= $limit) {
krsort($rbdt);
$rbdt = array_slice($rbdt,0,$limit,TRUE);
$frot = key(array_slice($rbdt,-1,1,TRUE));
}}}
if(is_array($rbdt)) {
krsort($rbdt);
?>
<table cellspacing='0' cellpadding='0' class='head_all hslice' id='wg_arct'>
<tr class='title_tr'><td class='title_td'><div style='padding-left:8px' class='entry-title'><b>전체 최근글</b></div></td></tr>
<tr><td class='gtlst entry-content'>

<?php
$i = 1;
while($i <= $limit && list($key,$value) = each($rbdt)) {
$frrn = explode("\x1b",$value[3]);
$frrn[2] = andamp($frrn[2]);

if($value[2] != 'r' && $value[2] > $mbr_level) $gif = "<img src='icon/lock.gif' alt='' />";
else $gif = '';
?>
<div class='link gifa'><?php echo $gif?><a href='<?php echo $index?>?id=<?php echo urlencode($value[0])?>&amp;no=<?php echo $value[1]?>' class='pvxy'><?php echo $frrn[2]?></a></div><div class='small'><?php echo date("m/d", $key)?> - <?php echo $frrn[0]?> [<?php echo $bdidnm[$value[0]]?>]</div>
<?php
$i++;
}
?>

</td></tr></table>
<?php
}
unset($groupORsection);
unset($limit);
?>