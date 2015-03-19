<?php
if($_GET['sect_arr']) {
if($_GET['mdfd']) {$dxrmdfd = $_GET['sect_arr'];include "include/gatedit.php";}
$secn = 1;
$st = fopen($dxr."section.dat","r");
while($sto = fgets($st)) {
if($secn == $_GET['sect_arr']) {
$stn = explode("\x1b",$sto);
if($stn[1] != '3' && $stn[1] != '6' && $stn[1] != '7' && $stn[1] != 's') $sectt = $stn[0];
break;
}
$secn++;
}
fclose($st);
$gob = (int)$_GET['gob'];
$btbg[$gob] = " style='background:#FFE252'";
?>
<title>&lt;<?php echo $sectt?>&gt; 좌우메뉴 배치</title>
<style type='text/css'>
input {height:18px; font-size:9pt}
td {text-align:left}
</style>
</head>
<body style='background-color:#F7F7F7;margin:0;padding:0'>
<form method='post' action='?' style='margin:0'><input type='hidden' name='arr' value='<?php echo $_GET['sect_arr']?>' /><input type='hidden' name='gob' value='<?php echo $gob?>' />
<?php
$stb = fopen($dxr."section_arr.dat","r");
for($i = 1;$i < $_GET['sect_arr'];$i++) fgets($stb);
$secrr = explode("@@",trim(fgets($stb)));
$secar = explode("@",$secrr[$gob]);
fclose($stb);
for($i = 1;$secar[$i]; $i++) {
$key = substr($secar[$i],0,2);
$yek = substr($secar[$i],2);
if($secar[$i][0] == 'L') $sectleft .= "<input type='text' value='↑' onclick='setmv(this)' class='up' /><input type='text' name='subs[]' value='".$key.$sxvtm[$yek]."' onclick='setedit(this,2)' title='내용편집' class='subs' /><input type='text' value='→' onclick='setmove(this,3)' title='탈락' class='out' />";
else if($secar[$i][0] == 'R') $sectright .= "<input type='text' value='↑' onclick='setmv(this)' class='up' /><input type='text' name='subs[]' value='".$key.$sxvtm[$yek]."' onclick='setedit(this,2)' title='내용편집' class='subs' /><input type='text' value='→' onclick='setmove(this,4)' title='탈락' class='out' />";
}
foreach($sxvtm as $key => $value) {
if(strpos($secrr[$gob],":".$key) === false) $sectcenter .= "<div><input type='button' value='←' onclick='setmove(this,1)' /><input type='button' value='".$value."' onclick='setedit(this,0)' title='내용편집' style='width:100px' /><input type='button' value='→' onclick='setmove(this,2)' /></div>";
}
$gobb = ($gob == 0)? "대문":"게시판";
$arr67 = ($gob == 0)? (int)$secrr[6]:(int)$secrr[7];
?>
<center><div style='padding-bottom:6px'><input type='button' class='button' value='대문' onclick='location.replace("?sect_arr=<?php echo $_GET['sect_arr']?>")'<?php echo $btbg[0]?>> &nbsp; <input type='button' class='button' value='게시판' onclick='location.replace("?sect_arr=<?php echo $_GET['sect_arr']?>&gob=1")'<?php echo $btbg[1]?>>&nbsp; &nbsp;
 ::&nbsp; no.<?php echo $_GET['sect_arr']?>&nbsp; &lt;<b><?php echo $sectt?> / <?php echo $gobb?></b>&gt; 좌우메뉴 순서와 배치 &nbsp;:: </div>
<label><input type='checkbox' name='geb' class='no' /> &lt;<?php echo $sectt?>/<?php echo $gobb?>&gt;의 설정을 &lt;<?php echo $sectt?>/<?php echo ($gob == 1)? "대문":"게시판"?>&gt;에서도 동일하게</label><br />
<span style='font-size:8pt;color:#FF00AE'>좌우로 배치되지 않은 가운데 것은 출력하지 않습니다.<br />좌우메뉴 넓이값이 0 이면, 전체설정의 설정값을 적용합니다.</span>
<br /><div style="float:left;width:230px"><?php echo $gobb?> 좌측메뉴 넓이 : <input type="text" name="arr_left<?php echo $gob?>" style="width:60px" value="<?php echo (($gob == 0)?(int)$secrr[2]:(int)$secrr[4])?>" />px</div><div style="float:left;"><select name="arr_lftrgt<?php echo $gob?>" style="width:200px;margin-left:35px"><option value="0" <?php if(0 == $arr67) echo 'selected="selected"';?>></option><option value="1" <?php if(1 == $arr67) echo 'selected="selected"';?>><?php echo $gobb?> 좌측메뉴 우측으로</option><option value="2" <?php if(2 == $arr67) echo 'selected="selected"';?>><?php echo $gobb?> 우측메뉴 좌측으로</option></select></div><div style="float:right;width:230px"><?php echo $gobb?> 우측메뉴 넓이 : <input type="text" name="arr_right<?php echo $gob?>" style="width:60px" value="<?php echo (($gob == 0)?(int)$secrr[3]:(int)$secrr[5])?>" />px</div>
<input type='submit' value=' 적용 ' class='button' style='width:400px;height:20px;margin:15px 0 10px 0' />
<fieldset id='sectcenter' style="border:1px solid #0000ff;padding:20px;width:550px;margin:0">
<div id='sectleft' style='float:left'><?php echo $sectleft?></div>
<div id='sectcntr' style='float:left;padding-left:25px'><?php echo $sectcenter?></div>
<div id='sectright' style='float:right'><?php echo $sectright?></div>
</fieldset>
<input type='submit' value=' 적용 ' class='button' style='width:400px;height:20px;margin:15px 0 10px 0' /></center>
</form>

<script type='text/javascript'>
//<![CDATA[
function setedit(ths,num) {
var thsv = (num == 2)? ths.value.substr(2):ths.value;
var sditf = '';
var sedit = Array(<?php foreach($sxvtm as $key => $value) echo "Array('{$value}','{$key}'),";?>Array('',''));
for(var i= sedit.length -2;i >= 0;i--) {
if(thsv == sedit[i][0]) sditf = sedit[i][1];
}
if(sditf) popup('admin.php?fm=module/' + sditf + '.ph_', 800, 400);

}
function setmove(ths,no) {
if(no == 3 || no == 4) {
var neww = "<div><input type='button' value='←' onclick='setmove(this,1)' /><input type='button' value='" + ths.previousSibling.value.substr(2) + "' onclick='setedit(this,0)' title='내용편집' style='width:100px' /><input type='button' value='→' onclick='setmove(this,2)' /></div>";
if(no == 3) {document.getElementById('sectleft').removeChild(ths.previousSibling.previousSibling);document.getElementById('sectleft').removeChild(ths.previousSibling);document.getElementById('sectleft').removeChild(ths);}
else {document.getElementById('sectright').removeChild(ths.previousSibling.previousSibling);document.getElementById('sectright').removeChild(ths.previousSibling);document.getElementById('sectright').removeChild(ths);}
document.getElementById('sectcntr').innerHTML = document.getElementById('sectcntr').innerHTML + neww;
} else if(no == 1) {
var neww = "<input type='text' value='↑' onclick='setmv(this)' class='up' /><input type='text' name='subs[]' value='L:" + ths.nextSibling.value + "' onclick='setedit(this,2)' title='내용편집' class='subs' /><input type='text' value='→' onclick='setmove(this,3)' title='탈락' class='out' />";
document.getElementById('sectleft').innerHTML = document.getElementById('sectleft').innerHTML + neww;
document.getElementById('sectcntr').removeChild(ths.parentNode);
} else if(no == 2) {
var neww = "<input type='text' value='↑' onclick='setmv(this)' class='up' /><input type='text' name='subs[]' value='R:" + ths.previousSibling.value + "' onclick='setedit(this,2)' title='내용편집' class='subs' /><input type='text' value='→' onclick='setmove(this,4)' title='탈락' class='out' />";
document.getElementById('sectright').innerHTML = document.getElementById('sectright').innerHTML + neww;
document.getElementById('sectcntr').removeChild(ths.parentNode);
}
}
function setmv(ths) {
if(ths.previousSibling && ths.previousSibling.previousSibling && ths.previousSibling.previousSibling.value) {
var xx=ths.nextSibling.value;
ths.nextSibling.value = ths.previousSibling.previousSibling.value;
ths.previousSibling.previousSibling.value=xx
}
}
function sectmenuchange(ths) {
var xx=ths.options[ths.selectedIndex].value;
if(xx) {
document.getElementById('sectmenudit').innerHTML = "<a href='#none' onclick='popup(\"admin.php?fm=module/" + xx + ".php\", 800, 400)'>" + xx + ".php</a> &nbsp; <a href='#none' onclick='popup(\"admin.php?fm=module/" + xx + ".css\", 800, 400)'>" + xx + ".css</a>";
}
}
function onloadh() {
var wh = parent.window.document.documentElement.clientHeight;
var sh = document.getElementById('sectcenter').scrollHeight;
var scr =  window.screen.availHeight;
if(sh + 400 > scr) sh = scr - 600;
if(wh + 100 < scr) {
if(wh < sh + 100) {
if(navigator.appVersion.indexOf('MSIE') != -1) dialogHeight=(sh + 110) +'px';
else resizeTo(window.document.documentElement.scrollWidth + 100,(sh+200));
}}}
top.document.title = "<<?php echo $sectt?> / <?php echo $gobb?>> 좌우메뉴 배치";
window.onload = function(){onloadh();}
//]]>
</script>
</body>
</html>
<?php
}
?>