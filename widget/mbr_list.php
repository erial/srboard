<?php if($mn) {?>
<div id='mbr_list'>
<div style='float:left'>“<?php echo $bdidnm[$id]?>”에 “<?php echo $name?>”님의 최근글</div><div style='float:right'><a href='<?php echo $dxpt?>&amp;m=<?php echo $mn?>'>더보기</a></div>
<ul>
<?php
if(!isset($listnumber) || !$listnumber) $listnumber = 6; // 게시물 출력갯수
$ida = '';
$hn = fopen($dxr.$id."/no.dat","r");
$hl = fopen($dxr.$id."/list.dat","r");
while(!feof($hn)) {
$hno = fgets($hn);
if($hno == "" || $hno == "\n") {
	list($ida,$hn,$hl) = data6($ida,array($hn,$hl),0);
	if($ida == 'q') break;
	} else {
if(strpos($hno,$mn."\x1b") == 9) {
$hnn = (int)substr($hno,0,6);
$hlo = explode("\x1b",fgets($hl));$hlo[3] = andamp($hlo[3]);
if($no == $hnn) echo "<li><a href='{$index}?id={$id}&amp;no={$hnn}' class='opened'>{$hlo[3]}</a></li>";
else echo "<li><a href='{$index}?id={$id}&amp;no={$hnn}'>{$hlo[3]}</a></li>";
$listnumber--;
} else fgets($hl);
}
if($listnumber == 0) break;
}
fclose($hn);
fclose($hl);
unset($listnumber);
$ida = '';
?>
</ul></div>
<?php }?>