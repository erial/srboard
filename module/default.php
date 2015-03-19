<?php
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
$secdiv = secdiv(1,0,0);
?>
<center style='padding-top:<?php echo (int)$gheight?>px'>
<div style='width:<?php echo $srwtpx?>;text-align:left'>
<div style='float:left'>
<img src='ttl.gif' style='cursor:pointer;padding-top:20px' onclick="rplace('<?php echo $index?>?section=1')" alt='' />
</div><div style="float:right; margin-top:23px">
<form method='get' action='<?php echo $index?>'><input type='text' name='findw' class='find_input' value='<?php echo $_GET['findw']?>' /> <input type='submit' value='FIND' class='find_submit' /></form>
</div><div style="clear:both"></div></div>
<center>
<table id='section_title' cellpadding='0px' cellspacing='0px' width='<?php echo $srwtpx?>'>
<tr><td>
<script type='text/javascript'>/*<![CDATA[*/</script><?php echo $secdiv[0]?><script type='text/javascript'>/*]]>*/</script>
</td></tr>
</table>
<table id='section_bd' cellpadding='0px' cellspacing='0px' width='<?php echo $srwtpx?>'>
<tr><td><div class='w100'><div id="sub_bd">&nbsp;</div></div></td></tr>
</table></center>
<script type='text/javascript'>
//<![CDATA[
<?php echo $secdiv[1]?>
setTimeout("sublist(<?php echo $section?>,document.getElementById('stt2'))",30);
//]]>
</script>
<script type="text/javascript" src="include/default.js"></script>
<?php
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class="srmgat" style="width:<?php echo $srwtpx?>">
<div id="footer"><div class="infooter" align="center">
Copyright 2009 <?php $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div></div></div>
</center>
<?php
}
?>