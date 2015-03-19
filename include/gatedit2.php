<?php
if($_POST[ectn] && isset($_POST[ectg])) {
$ectg = str_replace("\r","",str_replace("\n","",stripslashes($_POST[ectg])));
$tr = explode("<tr",$ectg);
$ectg = $tr[0];
$wtd = substr($tr[0],0,strpos($tr[0],'</colgroup>'));
if($wtd && preg_match_all("`width='([0-9]+)%`i",$wtd,$colwt)) $wtd = count($colwt[0]);
$jump = array();
for($r = 1;$tr[$r];$r++) {
$td = explode("<td",$tr[$r]);
$ectg .= "<tr".$td[0];
for($d = 1;$td[$d];$d++) {
$colw = 0;
$cols = (preg_match("` colspan=['\"]?([0-9]+)`i",$td[$d],$cols))? $cols[1]:1;
$rows = (preg_match("` rowspan=['\"]?([0-9]+)`i",$td[$d],$rows))? $rows[1]:1;
for($w = $rows;$w > 1;$w--) {
$jump[$r + $w -1][$d - $cols + 1] = $cols;
}
for($l = $cols;$l > 0;$l--) {
$ll = $d + $l -2 + (int)$jump[$r][$d];
$colw += $colwt[1][$ll];
}
?>
<textarea style='width:100%;height:20px;background-color:#D7D7D7;overflow:auto'><?php echo $colw?> :: d=<?php echo $d?> :: jump=<?php echo (int)$jump[$r][$d]?> :: jump=<?php echo print_r($jump[$r])?></textarea>
<?php
$wtdh = (int)((int)($sett[12] - $sett[39]*($wtd + 1))*$colw/100 + $sett[39]*($cols -1));
$ectg .= "<td width='{$wtdh}px'".$td[$d];
}
?>
<hr />
<?php
}
?>
<textarea style='width:100%;height:100px;background-color:#D7D7D7;overflow:auto'><?php echo print_r($jump)?></textarea>
<textarea style='width:100%;height:100px;background-color:#D7D7D7;overflow:auto'><?php echo $ectg?></textarea>
<?php
$filee = $dxr."section_add.dat";
$tpfile = $dxr."section_add.dat@@";
$sta = fopen($filee, "r");
$tsta = fopen($tpfile, "w");
for($i = 1;$stao = fgets($sta);$i++) {
if($i == $_POST[ectn]) $stao = $ectg."\n";
fputs($tsta,$stao);
}
fclose($sta);
fclose($tsta);
//copy($tpfile,$filee);
//unlink($tpfile);
//echo "<body onload=\"setTimeout('self.close()', 500)\" bgcolor='#F0F0F0'><div style='font-size:100px;text-align:center'>완료</div>";
} else {
?>
<title><?php echo $_GET[ectgt]?> 대문편집</title>
<style type='text/css'>
input {height:18px; font-size:9pt}
td {text-align:left}
#yrsz {width:100%; height:7px; background:url('icon/b3.png') repeat-x 0% 80%; cursor:s-resize}
</style>
</head>
<body onload='setup()' onresize='onloaded()' style='background-color:#F7F7F7;margin:0;padding:0;overflow:hidden'>
<form name='sectfm' method='post' action='?' style='margin:0'>
<center>
<input type='hidden' name='ectn' value='<?php echo $_GET[ectgt]?>' />
<input type='hidden' id='colw' value='' />
<?php
if($_GET[ectgt]) {
$fst = fopen($dxr."section.dat","r");
$fsta = fopen($dxr."section_add.dat","r");
for($ii=1;$ii < $_GET[ectgt];$ii++) {fgets($fsta);fgets($fst);}
$sectt = explode("\x1b",fgets($fst));
$sectgt = str_replace("<t","\n<t",fgets($fsta));
fclose($fst);
fclose($fsta);
}
?>
<textarea id='ectg' name='ectg' style='width:98%;height:180px;overflow:auto'><?php echo $sectgt?></textarea>
<div id='yrsz' onmousedown='starsz()' onmouseup='endyrsz()' title='크기조정'></div>
<input type='button' value=' 아래로 ' onclick='toifr()' class='button' style='width:70px' />
 &nbsp; <input type='button' value=' 위로 ' onclick='toectg()' class='button' style='width:70px' />
 &nbsp; <input type='submit' value=' 저장 ' class='button' style='width:70px' />
 &nbsp; <input type='button' value=' 닫기 ' onclick='self.close()' class='button' style='width:70px' />
 &nbsp; <input type='button' value=' 창크게 ' onclick='rexize(this)' class='button' style='width:70px' />
 &nbsp; <input type='button' value=' 셀추가 ' onclick='addsell()' class='button' style='width:70px' />
</center>
</form>
<iframe id='ifr' style='width:100%;height:220px' frameborder='0'></iframe>
<script type='text/javascript'>
//<![CDATA[
var ifrw = document.getElementById('ifr').contentWindow;
var ectgg = document.getElementById('ectg');
var y;
var ry = 0;
var ymov = 0;
var hch = 1;
function toifr() {
var ectd = ectgg.value.split(/<\/td>/i);
var ectt ='';
var colw = ectd[0].split("<col ");
colw = colw.length -1;
document.getElementById('colw').value = colw;
for(var i=0;i < ectd.length -1;i++) {
var reg = / colspan=['"]?([0-9]+)/i;
var neo = ectd[i].match(reg);
var cols = (neo)? neo[1]:1;
var reg = / rowspan=['"]?([0-9]+)/i;
var neo = ectd[i].match(reg);
var rows = (neo)? neo[1]:1;
var ecdt = ectd[i].indexOf('<td');
var edct = ectd[i].substr(ecdt);
var etcd = edct.indexOf('>') + 1;
ectt += ectd[i].substr(0,ecdt) + edct.substr(0,etcd) + "가로 <input type='text' name='coli' value='" + cols + "' /> &nbsp; 세로 <input type='text' name='rowi' value='" + rows + "' /><img src='icon/x.gif' alt='' title='삭제' onclick='this.parentNode.getElementsByTagName(\"input\")[0].value=\"0\";parent.toectg();' /><span onclick='resiz(1,"+i+")'>+</span> <span onclick='resiz(2,"+i+")'>-</span><br /><textarea name='cells' class='txta' style='height:20px'>" + edct.substr(etcd) + "</textarea></td>";
}
ifrw.document.body.innerHTML = "전체 가로 갯수 : <input type='text' id='colw' value='" + colw + "' /><input type='hidden' id='ocolw' value='" + colw + "' /><table cellspacing='2px' cellpadding='2px' border='1' width='100%'>" + ectt + "</table>";
}
function addsell() {
var colw = ectgg.value.split("<col ");
colw = colw.length -1;
if(colw > 2) ectgg.value = ectgg.value + "\n<tr>\n<td valign='top'></td><td colspan='" + (colw -1) + "' valign='top'></td>\n</tr>";
else if(colw == 2) ectgg.value = ectgg.value + "\n<tr>\n<td valign='top'></td><td valign='top'></td>\n</tr>";
else ectgg.value = ectgg.value + "\n<tr>\n<td valign='top'></td>\n</tr>";
toifr();
}
function toectg() {
var ectd = ectgg.value.substr(ectgg.value.indexOf('<tr'));
ectd = ectd.replace(/ (col|row)span='[0-9]'/gi,'').replace(/<\/?tr>/gi,'').replace(/[\r\n]/g,'');
ectd = ectd.split("<td ");
var ectt = ectd[0];
var ii;
var ci;
var ri;
var cw = parseInt(ifrw.document.getElementById('colw').value);
var cellcount = 1;
var jp = ','
var jj;
var rn = 0;
var colio = ifrw.document.getElementsByName('coli').length;
for(var i=1;i <= colio;i++) {
ii = i -1;
ci = parseInt(ifrw.document.getElementsByName('coli')[ii].value);
ri = parseInt(ifrw.document.getElementsByName('rowi')[ii].value);
if(ci > cw) ci = cw;
if(ci > 0) {
if(cellcount % cw == 1 || cw == 1) {ectt += "\n\n<tr>";rn++;}
ectt += "\n<td ";
if(ifrw.document.getElementsByName('coli')[i] && ifrw.document.getElementsByName('coli')[i].value == '0' && (cellcount+ci-1)%cw > 0) ci++;
if(ci > 1) ectt += "colspan='" + ci + "' ";
if(ri > 1) {
for(var r=2;r <= ri;r++) {
for(var c=1;c <= ci;c++) {
jj = cellcount + (cw*(r -1)) + (c-1);
jp += jj + ',';
}
}
ectt += "rowspan='" + ri + "' ";
}
ectt += ectd[i].substr(0,ectd[i].indexOf('>') + 1) + ifrw.document.getElementsByName('cells')[ii].value + ectd[i].substr(ectd[i].indexOf('</td'));
cellcount += ci;
if(jp != ',') {
while(jp.indexOf(',' + cellcount + ',') != -1) {
jp = jp.replace(',' + cellcount + ',',',');
if(cellcount % cw == 1) {ectt += "\n</tr>\n<tr>";rn++;}
cellcount++;
}
}
if(cellcount % cw == 1 || cw == 1) ectt += "\n</tr>";
else if(ifrw.document.getElementsByName('coli')[i] && cw != 1 && (cellcount + parseInt(ifrw.document.getElementsByName('coli')[i].value)) > cw*rn + 1) {
while(cellcount % cw != 1) {ectt += "\n<td valign='top'></td>";cellcount++;}
ectt += "\n</tr>";
rn++;
}
}
}
if(cellcount % cw != 1 && cw != 1) {
ii = (cw + 1 - (cellcount % cw)) % cw;
if(ii > 1) ectt += "\n<td colspan='" + ii + "' valign='top'></td>";
else ectt += "\n<td valign='top'></td>";
ectt += "\n</tr>";
}
var cgp = ectgg.value.indexOf('</colgroup>');
var cg = ectgg.value.substr(0,cgp + 11);
if(cgp == -1 || parseInt(ifrw.document.getElementById('ocolw').value) != cw) {
cg = "<colgroup>";
var cow = parseInt(100/cw);
for(var i=cw;i > 0;i--) cg += "<col width='" + cow + "%' />";
cg += "</colgroup>";
}
ectgg.value = cg + ectt;
toifr();
}
function rexize(that) {
var tval;
var mw=window.screen.availWidth;
var mh=window.screen.availHeight;
if(navigator.appVersion.indexOf('MSIE') != -1) {
if(mw - parseInt(dialogWidth) > 10) {dialogWidth=mw +'px';dialogHeight=(mh-70) +'px';tval = 1;}else{dialogWidth='507px';dialogHeight='437px';dialogTop=(mh-437)/2;dialogLeft=(mw-507)/2;tval = 2;}
} else {
if(mw - window.innerWidth > 10){resizeTo(mw,mh);tval = 1;if(navigator.appVersion.indexOf('Chrome') == -1) moveTo(window.screen.width-mw,0);}else{resizeTo(515,526);tval = 2;if(navigator.appVersion.indexOf('Chrome') == -1) moveTo((mw-515)/2,(mh-526)/2);}
}
if(tval == 1) {
that.value='창작게';
var nh = (mh-120)/2;
document.getElementById('ectg').style.height = nh + 'px';
document.getElementById('ifr').style.height = nh + 'px';
} else {
that.value='창크게';
document.getElementById('ectg').style.height = '180px';
document.getElementById('ifr').style.height = '220px';
}
}
function setup() {
var doc = ifrw.document;
doc.open();
doc.write("<html>");
doc.write("<head>");
doc.write("<style type='text/css'>* {font-family:gulim; font-size:9pt} input,.txta {width:12px; border:0; border-bottom:1px solid black; background-color:#F7F7F7} .butt {border:0; color:#FFF; background:#000; width:30px} .txta {overflow:auto;  width:100%} img {cursor:pointer; width:13px; vertical-align:middle; margin-left:5px} span {cursor:pointer; margin-left:4px}</style>");
doc.write("<script type='text/javascript'>function resiz(b,n){var txtht=parseInt(document.getElementsByName('cells')[n].style.height);document.getElementsByName('cells')[n].style.height = (b==1)?(txtht*2) + 'px':(txtht/2) + 'px';}<\/script>");
doc.write("</head>");
doc.write("<body bgcolor='#F7F7F7'>");
doc.write("</body>");
doc.write("</html>");
doc.close();
toifr();
top.document.title = "\"<?php echo $sectt[0]?>\" 대문편집";
}
function onloaded() {
var ht =parent.window.document.documentElement.clientHeight -37;
document.getElementById('ectg').style.height = parseInt(ht*0.45) + 'px';
document.getElementById('ifr').style.height = parseInt(ht*0.55) + 'px';
}
function starsz() {
ymov = 2;
ry = y - parseInt(document.getElementById('ectg').style.height);
}
function endyrsz() {
ymov = 0;
ry = 0;
}
function mousemov(e){
  if(navigator.appVersion.indexOf('MSIE') == -1){
   y = e.pageY;
	} else {
   y = event.clientY + ((setop[1] == 'chrome')? document.body:document.documentElement).scrollTop;
	}
if(ymov == 2) {
document.getElementById('ifr').style.height = parseInt(document.getElementById('ifr').style.height) - (y - ry - parseInt(document.getElementById('ectg').style.height)) + 'px';
document.getElementById('ectg').style.height = y - ry + 'px';
}}

document.onmousemove = mousemov;
document.onclick = function() {if(ymov == 1) endyrsz();}
//]]>
</script>
</body>
</html>
<?php
}
?>