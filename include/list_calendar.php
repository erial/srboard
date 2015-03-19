<?php
if($id && $sss[22] !== 'a' && $sss[22] <= $mbr_level) {
$dd = array();
$dtype = ($sss[26] == 'd')?'d':'b';
$month = substr($_GET['date'], 4, 2);
$year = substr($_GET['date'], 0, 4);
$pxt = mktime(0, 0, 0, $month, 1, $year);
$med = date("t", $pxt);
$fem = date("w", $pxt);
for($i = $isnt; $i > 0; $i--) {
if(trim($fdn[$i])){
$zzz = explode("\x1b", $fdn[$i]);
$flo = explode("\x1b", $fdl[$i]);
$dd[(int)date("d",substr($flo[0],0,10))] .= "<li><a".(int)substr($zzz[0],0,6)."'>".str_replace("&","&amp;",$flo[3])."</a> <span class='f8'>by ".$flo[1]."</span> <span class='r7'>[".(int)$zzz[2]."]</span></li>";
}}
?>
<div id='calendar' style='width:<?php echo $srwdthx?>'>
<div class='caption'><div class='sum'>sum : <?php echo $sum?></div><select onchange='lochref("p",this.options[this.selectedIndex].value)'><?php echo $months?></select><div class='listtype'>
<?php if($sss[29]) {?><img src='icon/rss.gif' alt='rss' class='abcg' onclick="nwopn('exe.php?rss=<?php echo $id?>')" />
<?php } if(!$sss[53]) {?>
<img src='icon/al.gif' alt='목록형' title='목록형' class='abcg' onclick="locato('type','a')" />
<img src='icon/bl.gif' alt='본문형' title='본문형' class='abcg' onclick="locato('type','b')" />
<img src='icon/cl.gif' alt='요약형' title='요약형' class='abcg' onclick="locato('type','c')" />
<img src='icon/gl.gif' alt='갤러리형' title='갤러리형' class='abcg' onclick="locato('type','g')" />
<img src='icon/kl.gif' alt='달력형' title='달력형' class='abcg' onclick="locato('type','k')" />
<?php }?></div></div>
<table width='100%' cellspacing='1px' cellpadding='0'>
<tr><th><font color='#FF0000'>일</font></th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th>토</th></tr>
<tr class='thbtwn'><td colspan='7'></td></tr><tr>
<?php
if($year == date("Y") && $month == date("m")) $tday = date("d");
for($i = 0; $i < $fem; $i++) echo "<td> </td>";
for($stt = 1; $stt <= $med; $stt++) {
$sst = ($stt + $fem) % 7;
if($sst == 1) $stc = "<font color='#FF0000'>{$stt}</font>";
else $stc = $stt;
if($tday == $stt) $stc = "<b><u>{$stc}</u></b>";
if($dd[$stt]) {echo "<td onmouseover='opencal(this)'><div class='day'>".$stc."</div><div class='cnt'>".substr_count($dd[$stt],'<li>')." posts</div><ul>";
if($aview == 6) echo preg_replace("/<a([^']+)'/","<img src='icon/sy.gif' alt='' /><a href='#none' onclick='aview(\"".$id."\",\"$1\",\"\")'",$dd[$stt]);
else echo str_replace("<a","<img src='icon/sy.gif' alt='' /><a href='".$index."?id=".$id.$rt."&amp;p=".$calp."&amp;no=",$dd[$stt]);
echo "</ul></td>";
} else echo "<td onmouseover='opencal()'><div class='day'>".$stc."</div></td>";
if($sst == 0 && $stt != $med) echo "</tr><tr>";
}
if($sst > 0) for($i = $sst; $i < 7; $i++) echo "<td onmouseover='opencal()'></td>";
?>

</tr>
</table>
<div class='buttcell'><a class='butt4' href='<?php echo $index?>?id=<?php echo $id?>&amp;p=1'><span>목록</span></a><a class='butt4' href='#none' onclick='frite()'><span>새글</span></a></div>
</div>
<?php
}
?>