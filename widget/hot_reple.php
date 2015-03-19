<?php
if(!isset($limit) || !$limit) $limit = 10; // 출력할 갯수
if(!isset($groupORsection) || !$groupORsection) $groupORsection = 1; // 1:모든 게시판의 최근 덧글 출력, 2:섹션그룹(없으면 모든 게시판), 3:섹션

if($groupORsection == 3) $group = array($section,'');
else if($groupORsection == 2 && $grp) $group = explode("^",substr($grp[$sect[$section][6]][2],1,-1));else $group = 0;
$rbdt = '';
$frot = 0;
$i = 0;
foreach($fsbs as $rbid => $rbset) {
if($group && !in_array((int)substr($rbset,47,2),$group)) continue;
if($rbset[42] != '1' && ($i < $list_number || filemtime($dxr.$rbid."/new_rp.dat") > $frot)) {
$fr = fopen($dxr.$rbid."/new_rp.dat","r");
for($ii = 0;$ii < $list_number && $fro = trim(fgets($fr));$ii++) {
$rbdt[substr($fro, 34, 10)] = array($rbid,$fro,$rbset[16]);
$i++;
}
fclose($fr);
if($i >= $list_number) {
krsort($rbdt);
$rbdt = array_slice($rbdt,0,$list_number,TRUE);
$frot = key(array_slice($rbdt,-1,1,TRUE));
}}}
if(is_array($rbdt)) {
krsort($rbdt);
?>
<table cellspacing='0' cellpadding='0' class='head_all hslice' id='wg_arrp'>
<tr class='title_tr'><td class='title_td'><div style='padding-left:8px' class='entry-title'><b>전체 최근덧글</b></div></td></tr>
<tr><td class='gtlst entry-content'>

<?php
$i = 1;
while($i <= $list_number && list($key,$value) = each($rbdt)) {
$frr = preg_replace("`<[^>]+>?`i", "",andamp(substr($value[1], 44)));
if($frr[0] == "\x1b") $frr = "[비밀글]";
?>
<div class='link gifa'><a href='<?php echo $index?>?id=<?php echo urlencode($value[0])?>&amp;<?php echo ($value[2] == 'd')?'rp':'no';?>=<?php echo (int)substr($value[1],0,6)?>&amp;cc=<?php echo substr($value[1],6,7)?>' class='pvxy'><?php echo $frr?></a></div><div class='small'><?php echo date("m/d", $key)?> - <?php echo substr($value[1], 14, 20)?><?php if($section) echo "[".$bdidnm[$value[0]]."]";?></div>
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