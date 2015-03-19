<?php
if(!$topsection) {
function stwlr($wlr,$stbwdth) {
global $st_arr;
$starry = array();
echo "<td id='stb{$wlr}' class='stbLR' style='width:{$stbwdth}px' align='center'><div>\n";
for($sb=1;$st_arr[$sb];$sb++) {
if(substr($st_arr[$sb],0,2) == $wlr.":") {
$starry[] = substr($st_arr[$sb],2);
}}
return $starry;
}
$sb = "width:{$srwtpx}";
$sb .= ($sett[77] && $sett[88])? ";min-width:{$sett[88]}px":"";
echo "<div id='srboard' style='{$sb}'>\n<table id='main_table' cellpadding='0px' cellspacing='0px'>\n<colgroup>";
if($stbLR67 == 2) {
if($stbL && $stbL >= 1) echo "<col width='{$stbL}px' /><col width='{$sett78}px' />";
if($stbR && $stbR >= 1) echo "<col width='{$stbR}px' /><col width='{$sett78}px' />";
} else if(!$stbLR67 && $stbL && $stbL >= 1) echo "<col width='{$stbL}px' /><col width='{$sett78}px' />";
if(!$sett[77]) {$srwdth -= (int)$srpdg;$paddng = "style='width:{$srwdth}px'";echo "<col width='{$srwdth}px' />";} else echo "<col width='100%' />";
if($stbLR67 == 1) {
if($stbL && $stbL >= 1) echo "<col width='{$sett78}px' /><col width='{$stbL}px' />";
if($stbR && $stbR >= 1) echo "<col width='{$sett78}px' /><col width='{$stbR}px' />";
} else if(!$stbLR67 && $stbR && $stbR >= 1) echo "<col width='{$sett78}px' /><col width='{$stbR}px' />";
echo "</colgroup>\n<tbody>\n<tr>\n";
if($stbLR67 == 2) {
if($stbL && $stbL >= 1) {foreach(stwlr("L",$stbL) as $st_arr2) {if($st_arr2) {if($sett[92][0] == '1' || $sett[92][0] == '3') $gmtime = getmicrotime();include("module/".$st_arr2.".ph_");if($sett[92][0] == '1' || $sett[92][0] == '3') echo "\n<!--".$st_arr2." 처리시간:: ".(getmicrotime() - $gmtime)." -->\n";}}echo "\n</div></td>\n<td class='stbCC'></td>\n";}
if($stbR && $stbR >= 1) {foreach(stwlr("R",$stbR) as $st_arr2) {if($st_arr2) {if($sett[92][0] == '1' || $sett[92][0] == '3') $gmtime = getmicrotime();include("module/".$st_arr2.".ph_");if($sett[92][0] == '1' || $sett[92][0] == '3') echo "\n<!--".$st_arr2." 처리시간:: ".(getmicrotime() - $gmtime)." -->\n";}}echo "\n</div></td>\n<td class='stbCC'></td>\n";}
} else if(!$stbLR67 && $stbL && $stbL >= 1) {foreach(stwlr("L",$stbL) as $st_arr2) {if($st_arr2) {if($sett[92][0] == '1' || $sett[92][0] == '3') $gmtime = getmicrotime();include("module/".$st_arr2.".ph_");if($sett[92][0] == '1' || $sett[92][0] == '3') echo "\n<!--".$st_arr2." 처리시간:: ".(getmicrotime() - $gmtime)." -->\n";}}echo "\n</div></td>\n";echo "<td class='stbCC'></td>\n";}
echo "<td id='stbC' {$paddng} align='center'>\n";
$topsection = 1;

} else {

echo "\n</td>\n";
if($stbLR67 == 1) {
if($stbL && $stbL >= 1) {echo "<td class='stbCC'></td>\n"; foreach(stwlr("L",$stbL) as $st_arr2) {if($st_arr2) {if($sett[92][0] == '1' || $sett[92][0] == '3') $gmtime = getmicrotime();include("module/".$st_arr2.".ph_");if($sett[92][0] == '1' || $sett[92][0] == '3') echo "\n<!--".$st_arr2." 처리시간:: ".(getmicrotime() - $gmtime)." -->\n";}}echo "\n</div></td>\n";}
if($stbR && $stbR >= 1) {echo "<td class='stbCC'></td>\n";foreach(stwlr("R",$stbR) as $st_arr2) {if($st_arr2) {if($sett[92][0] == '1' || $sett[92][0] == '3') $gmtime = getmicrotime();include("module/".$st_arr2.".ph_");if($sett[92][0] == '1' || $sett[92][0] == '3') echo "\n<!--".$st_arr2." 처리시간:: ".(getmicrotime() - $gmtime)." -->\n";}}echo "\n</div></td>\n";}
} else if(!$stbLR67 && $stbR && $stbR >= 1) {echo "<td class='stbCC'></td>\n"; foreach(stwlr("R",$stbR) as $st_arr2) {if($st_arr2) {if($sett[92][0] == '1' || $sett[92][0] == '3') $gmtime = getmicrotime();include("module/".$st_arr2.".ph_");if($sett[92][0] == '1' || $sett[92][0] == '3') echo "\n<!--".$st_arr2." 처리시간:: ".(getmicrotime() - $gmtime)." -->\n";}}echo "\n</div></td>\n";}
if(($sett[58][0] && !$id) || ($id && (($sett[58][2] && $_GET['no']) || ($sett[58][1] && !$_GET['no'])))) {
if(file_exists("widget/sectbtm_".$section)) {
echo "</tr>\n<tr>\n";
echo "<td colspan='{$srcol}' id='stbBT'>\n";
include("widget/sectbtm_".$section);
echo "</td>";
}}
echo "</tr>\n</tbody>\n</table>\n</div>\n";
}
?>