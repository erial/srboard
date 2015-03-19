<?php
if($set) {
if(!isset($pollno) || !$pollno) $pollno = "00001";// 설문조사 질문번호. 위에 정의된게 없으면 여기서 5자리 값으로 정의합니다
if($pollno) {
$plla = $dxr."poll_1.dat"; //질문
if($fa = @fopen($plla,"r")) {
while($fao = fgets($fa)) {
if($fao[0] == "\x1b") {$novote = 1;$fao = substr($fao,1);} else $novote = 0;
if(substr($fao,0,5) == $pollno) {$faa = explode("\x1b",$fao);break;}
}
fclose($fa);
?>
<table cellspacing='0' cellpadding='0' class='head_all poll_tbl'>
<tr class='title_tr'><td class='title_td'><div style='padding-left:8px;cursor:pointer'><b>설문조사</b></div></td></tr>
<tr><td class='gtlst'>
<center><ul>
<li class='frst'><?php echo substr($faa[0],5)?></li>
<?php
for($pl = 1;$faa[$pl + 1];$pl++){
?>
<li><label><input type='radio' name='sublist_<?php echo $pollno?>' value='<?php echo $pl?>' /> <?php echo $faa[$pl]?></label></li>
<?php
}
?>
</ul>
<?php if(!$novote) {?><input type='button' class='srbt' value='투표하기' style='margin-right:10px' onclick='survey("<?php echo $pollno?>")' /><?php }?>
<input type='button' class='srbt' value='결과보기' onclick='popup("include/poll.php?no=<?php echo $pollno?>",640,480)' />
</center></td></tr></table>
<?php
}}
unset($pollno);
}
?>
