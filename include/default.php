<?php
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
$srspg = 10;
$srpdg = 30;
$rightwidth = ($sett[12] > 1035)? $sett[12] - 1020:20;
$secdiv = secdiv(1,0);
?>
<center style='padding-top:<?php echo (int)$gheight?>px'>
<div style='width:<?php echo $sett[12]?>px;text-align:left'>
<img src='ttl.gif' style='cursor:pointer;float:left;padding-top:20px' onclick="rplace('<?php echo $index?>?section=1')" alt='' /><div style="clear:both"></div></div>
<center>
<table cellpadding='0px' cellspacing='0px' width='<?php echo $sett[12]?>px'>
<tr><td id='section_title'>
<script type='text/javascript'>/*<![CDATA[*/</script><?php echo $secdiv[0]?><script type='text/javascript'>/*]]>*/</script>
</td><td id='section_form'><form method='get' action='<?php echo $index?>'><input type='text' name='findw' style='width:100px' value='<?php echo $_GET['findw']?>' /> <input type='submit' value='검색' class='search' style='width:34px' /></form></td></tr>
</table>
<table id='section_bd' cellpadding='0px' cellspacing='0px' width='<?php echo $sett[12]?>px'>
<tr><td><div id="sub_bd">&nbsp;</div></td><td class='right' width='<?php echo $rightwidth?>px'></td></tr>
</table></center>
<script type='text/javascript'>
//<![CDATA[
var sublong = new Array();
function sublist(sno,ths) {
if(document.getElementById('sub_bd')) {
document.getElementById('sub_bd').style.paddingLeft = '0px';
<?php echo $secdiv[1]?>

var submt = "";
if(slist[sno] && slist[sno][0] && slist[sno][0][1] != '') {
var scnt = slist[sno].length -1;
for(var i=0;i <= scnt;i++) {
if('<?php echo $_GET['id']?>' == slist[sno][i][0]) submt += "<span onclick=\"rplace('<?php echo $index?>?id=" + slist[sno][i][0] + "&p=1')\" style='border-bottom:2px solid #00D6D9'>" + slist[sno][i][1] + "</span>";
else if(slist[sno][i][0].substr(0,1) == '_') {if(slist[sno][i][0]=='_nw') slist[sno][i][2] = "nwopn(\"" +  slist[sno][i][2] + "\")";else if(slist[sno][i][0] !='_js') slist[sno][i][2] = "rplace(\"" + slist[sno][i][2] + "\")";submt += "<span onclick='" + slist[sno][i][2] + "' style='cursor:pointer'>" + slist[sno][i][1] + "</span>";}
else submt += "<span onclick=\"rplace('<?php echo $index?>?id=" + slist[sno][i][0] + "&p=1')\" style='cursor:pointer'>" + slist[sno][i][1] + "</span>";
if(i < scnt) submt += "<img src='icon/t.gif' class='secbd_btw' alt='' />";
}
}
if(submt == '') submt = "&nbsp;"
document.getElementById('sub_bd').innerHTML = submt;
if(submt != '&nbsp;') valignn(sno,ths);
}}
function valignn(sno,ths) {
if(ths) {
var xx = 0;
if(sno == 1) xx = 10;
else {
var slength = 0;
var smg = 3;
for(var d=0;document.getElementById('section_title').getElementsByTagName('div')[d] != ths;d++) slength += document.getElementById('section_title').getElementsByTagName('div')[d].offsetWidth + smg;
slength += parseInt((ths.offsetWidth + smg)/2);
var tlength = 0;
var tmg = 15;
var ofw = 0;
var tleng = document.getElementById('sub_bd').childNodes.length - 1;
for(var d=0;d < tleng;d++) tlength += document.getElementById('sub_bd').childNodes[d].offsetWidth + tmg;
tlength += document.getElementById('sub_bd').childNodes[d].offsetWidth;
if(slength + (tlength/2) > <?php echo $sett[12]?>) xx = <?php echo $sett[12]?> - tlength -15;
else xx = slength - (tlength/2);
}
if(xx < 10) xx = 10;
document.getElementById('sub_bd').style.paddingLeft = xx + 'px';
}}
setTimeout("sublist(<?php echo $section?>,document.getElementById('stt2'))",30);
//]]>
</script>
<div style='width:<?php echo $sett[12]?>px;margin-top:10px;text-align:left'>
<?php
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class='footer'><div class='left' style='width:20px'></div><div class='right' style='width:<?php echo $sett[12] -20?>px'></div></div>
<div id="footer"><div class='left' style='width:20px'></div><div class='right' style='width:<?php echo $sett[12] -40?>px'>
Copyright 2009 <?php $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div></div>
</div>
</center>
<?php
}
?>