<?php
if(basename($_SERVER['PHP_SELF']) == 'write.php' && !$_GET['box'] && !$_GET['spc']) exit;
$write = "include/write.php";
if(!$sett) {
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'Trident/7.0')) {$isie = 1;$bwr = 'ie11';}
else if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')) {$isie = 1;if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 10')) $bwr = 'ie8';else if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7')) $bwr = 'ie7';else {$bwr = 'ie6';$sett[76] = 0;}}
else if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'Trident/')) {$isie = 1;$bwr = 'ie11';}
else {
$isie = 2;
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'AppleWebKit')) $bwr = 'chrome';
else if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'Opera')) $bwr = 'opera';
}
$sett[14] = "http://".$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/include/') +1);
}
if($slss[2]) $wdth[2] = $slss[2];
if(!$isie) $isie = 2;
$http = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/')+1);
$sectcss = "module/sectcss_".$section.".css";
if(!file_exists($sectcss) || !filesize($sectcss)) $sectcss = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>&nbsp;</title>
<meta name="generator" content="srboard" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php if($ismobile) {?>
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.5, minimum-scale=0.5, width=device-width" />
<?php } if($sett[31]) {?><link rel="shortcut icon" type="image/x-icon" href="http://<?php echo $_SERVER['HTTP_HOST']?>/favicon.ico" />
<?php } if(!$_GET['box']) {?>
<link rel="stylesheet" type="text/css" href="include/srboard.css" />
<?php if($sett[26]){?><link rel='stylesheet' type='text/css' href='module/<?php echo $sett[26]?>.css' />
<?php } if($sectcss){?><link rel='stylesheet' type='text/css' href='<?php echo $sectcss?>' />
<?php } if($wdth[2]) {?><link rel='stylesheet' type='text/css' href='skin/<?php echo $wdth[2]?>/style.css' />
<?php }}?>
<?php if($bwr == 'opera') {?>
<style type="text/css">
#replace_a, #replace_b {border:1px solid #BFBFBF}
</style>
<?php }?>
<!--[if IE]>
<style type='text/css'>
#content {word-break:break-all;text-overflow:ellipsis}
a.butt3 {padding:4px 6px 0 6px}
</style>
<![endif]-->
<!--[if lte IE 6]>
<link rel='stylesheet' type='text/css' href='include/ie6.css' />
<![endif]-->
<?php
if($sett[24]) echo "<link rel='stylesheet' type='text/css' href='{$sett[24]}' />\n";
if(file_exists('icon/style.css')) echo "<link rel='stylesheet' type='text/css' href='icon/style.css' />\n";
if($_GET['box'] || $_GET['spc']) {?>
<link rel='stylesheet' type='text/css' href='write.css' />
<?php } else {?>
<link rel='stylesheet' type='text/css' href='include/write.css' />
<?php }
if($_GET['box']) {
?>
<script type='text/javascript'>
//<![CDATA[
<?php
if($isie == 1) echo "var opener = dialogArguments;";
?>
var gbox = '<?php echo $_GET['box']?>';
var gaox = '<?php echo $_GET['aox']?>';
var pxlor = '';
function $(id) {return document.getElementById(id);}

function mktb() {
var mkcols = $('tb_col').value;
var mkrows = $('tb_row').value;
var divv = '';
if($('bak_color').value) divv += "background-color:" + $('bak_color').value + ";";
if($('fnt_color').value) divv += "color:" + $('fnt_color').value + ";";
if($('box_width').value) divv += "width:" + $('box_width').value + ";";
if($('box_height').value) divv += "height:" + $('box_height').value + ";";
if(divv) divv = ' style="' + divv + '"';
var mkcg = "<colgroup>";
var mkcwidth = parseInt(100/mkcols) + '%';
for(var i=0; i < mkcols; i++) {mkcg += "<col width=" + mkcwidth + " />";}
mkcg += "</colgroup>";
var mktr = "<tr>";
for(var i=0; i < mkcols; i++) {mktr += "<td>&nbsp;</td>";}
mktr += "</tr>";
var mktable = "<table cellspacing='0' cellpadding='2px' border='1'" + divv + "><tbody>" + mkcg;
for(var i=0; i < mkrows; i++) {mktable += mktr;}
mktable += "</tbody></table>";
opener.tag(mktable, '', 'plus', '', '');
window.close();
}

function xcolor() {
if(gbox == 'table') {
mktb();
} else {
if($('bod_color') && $('bod_color').value) var brcolr = $('bod_color').value;
else var brcolr = '#000000';
if(gbox == 'img') {
gaox = opener.$('imgbordr');
if($('bod_width').value) gaox.value = $('bod_width').value + " " + $('bod_style').value + " " + brcolr;
else {gaox.value = '';gaox.checked = false;}
} else {
if($('legend') && $('legend').value) var blgnd = $('legend').value.replace(/["']/g,'´');
else var blgnd = '';
if(gaox == 'moreless') var divv = '<a onclick=\'togle(this.nextSibling)\' class="more" style="border-color:'+ brcolr +';">' + blgnd + '<\/a><div ondblclick=\'this.style.display="none"\' class="less" style="display:none;';
else var divv = '<' + gbox + ' style="';
if($('bak_color') && $('bak_color').value) divv += "background-color:" + $('bak_color').value + ";";
if($('fnt_color') && $('fnt_color').value) divv += "color:" + $('fnt_color').value + ";";
if(gbox == 'a') {var boxw = ($('box_width').value)? $('box_width').value:500;
opener.tag(divv + '" onmouseover=\'imgview(this.href,4,' + boxw + ')\' href="' + blgnd + '" title="링크미리보기" target=\'_blank\'>', '</' + gbox + '>','plus','','');
} else {
if($('bod_width') && $('bod_width').value) {
if(gbox == 'span')  divv += "border-bottom:" + $('bod_width').value + " " + $('bod_style').value + " " + brcolr + ";";
else divv += "border:" + $('bod_width').value + " " + $('bod_style').value + " " + brcolr + ";";
}
if($('fnt_family') && $('fnt_family').value) divv += "font-family:" + $('fnt_family').value + ";";
if($('fnt_size') && $('fnt_size').value) divv += "font-size:" + $('fnt_size').value + ";";
if(gbox == 'fontstyle') opener.tag(divv.replace('<fontstyle','<span') + '">', '</span>','plus','','');
else if(gbox == 'span') opener.tag(divv + '" onmouseover=\'preview("' + blgnd + '","xx")\' onmouseout=\'preview()\'>', '</' + gbox + '>','plus','','');
else {
if($('box_width').value) divv += "width:" + $('box_width').value + ";";
if($('box_height').value) divv += "height:" + $('box_height').value + ";";
if(gaox == 'scroll') divv += ";overflow:auto;";
if($('bod_padding').value) divv += "padding:" + $('bod_padding').value + ";";
if($('bod_lht').value) divv += "line-height:" + $('bod_lht').value + ";";
if(gbox == 'fieldset') opener.tag(divv + '"><legend>' + blgnd + '</legend>', '</' + gbox + '>','plus','','');
else opener.tag(divv + '">', '</' + gbox + '>','plus','','');
}}}}
setTimeout("window.close()",10);
return false;
}

function xxcolor(xolor) {
if(pxlor != '') pxlor.value = xolor;
else alert('색상이 들어갈 곳을 클릭하세요');
}

function setup() {
	var hcolor = new Array('ff0000','dc143c','b22222','800000','8b0000','a52a2a','a0522d','8b4513','cd5c5c','bc8f8f','f08080','fa8072','e9967a','ff7f50','ff6347','f4a460','ffa07a','cd853f','d2691e','ff4500','ffa500','ff8c00','d2b48c','ffdab9','ffe4c4','ffe4b5','ffdead','f5deb3','deb887','b8860b','daa520','ffd700','ffff00','fafad2','eee8aa','f0e68c','bdb76b','7cfc00','adff2f','7fff00','00ff00','32cd32','9acd32','808000','6b8e23','556b2f','228b22','006400','008000','2e8b57','3cb371','8fbc8f','90ee90','98fb98','00ff7f','00fa9a','008080','008b8b','20b2aa','66cdaa','5f9ea0','4682b4','7fffd4','b0e0e6','afeeee','add8e6','b0c4de','87ceeb','87cefa','48d1cc','40e0d0','00ced1','00ffff','00ffff','00bfff','1e90ff','6495ed','4169e1','0000ff','0000cd','000080','00008b','191970','483d8b','6a5acd','7b68ee','9370db','9932cc','9400d3','8a2be2','ba55d3','dda0dd','e6e6fa','d8bfd8','da70d6','ee82ee','4b0082','8b008b','800080','c71585','ff1493','ff00ff','ff00ff','ff69b4','db7093','ffb6c1','ffc0cb','ffe4e1','ffebcd','ffffe0','fff8dc','faebd7','ffefd5','fffacd','f5f5dc','faf0e6','fdf5e6','e0ffff','f0f8ff','f5f5f5','fff0f5','fffaf0','f5fffa','f8f8ff','f0fff0','fff5ee','fffff0','f0ffff','fffafa','ffffff','dcdcdc','d3d3d3','c0c0c0','a9a9a9','778899','708090','808080','696969','2f4f4f','000000');
	var tb = '';
	for(i = 0; i < 140; i++){
	tb += '<input type="button" style="background:#'+hcolor[i]+'" onclick="xxcolor(\'#'+hcolor[i]+'\')" onmouseover="bgxolor(\'#'+hcolor[i]+'\')" />';
	}
	$('color_set').innerHTML = tb;
	if($('bod_color')) $('bod_color').focus();
	else if($('bak_color')) $('bak_color').focus();
}

var dtitle = '<?php echo $_GET['box']?> / <?php echo $_GET['aox']?>';
document.title = dtitle;
if(parent) parent.document.title = dtitle;

function bgxolor(xolor) {
if('<?php echo $bwr?>' != 'opera') {
if(!pxlor || eval(pxlor).value == '') {
var bxo = (opener.$('wzor').value == 'w')?opener.obw.document.body:opener.obj;
if(eval(pxlor) && eval(pxlor) == $('bak_color')) bxo.style.backgroundColor = xolor;
else bxo.style.color = xolor;
}}}

function ppxlor(ths,n) {
pxlor=ths;
if($('bod_color')) $('bod_color').style.backgroundColor='#FFF';
if($('bak_color')) $('bak_color').style.backgroundColor='#FFF';
if($('fnt_color')) $('fnt_color').style.backgroundColor='#FFF';
ths.style.backgroundColor='#F0FFF0';
if(ths.value) ths.value = '';
}

function unload() {
opener.obw.document.body.style.backgroundColor = '#FFF';
opener.obw.document.body.style.color = '#000';
opener.obj.style.backgroundColor = '#FFFDFA';
opener.obj.style.color = '#000';
}
//]]>
</script>
</head>
<body class="pbody" onload="setup()" onunload="unload()" onbeforeunload="unload()">
<center style='padding-bottom:10px'>
<div style='width:270px;text-align:left;padding:15px 0 10px 0'>
<?php if($_GET['box'] != 'fontstyle') {
if($_GET['box'] == 'a') {?>
링크주소 : <input type='text' id='legend' style='width:192px' value='' /> <br />
<?php } else if($_GET['box'] == 'span') {?>
풍선말 : <input type='text' id='legend' style='width:204px' value='' /><br />
<?php } if($_GET['box'] != 'table' && $_GET['box'] !='a') {?>
<fieldset style='text-align:center;padding:5px'><legend>Border : </legend><select id='bod_width'><option value=''>0</option><option value='1px' selected='selected'>1px</option><option value='2px'>2px</option><option value='3px'>3px</option><option value='4px'>4px</option><option value='5px'>5px</option><option value='6px'>6px</option><option value='7px'>7px</option><option value='8px'>8px</option><option value='9px'>9px</option><option value='10px'>10px</option><option value='11px'>11px</option><option value='12px'>12px</option><option value='13px'>13px</option><option value='14px'>14px</option><option value='15px'>15px</option><option value='16px'>16px</option><option value='17px'>17px</option><option value='18px'>18px</option><option value='19px'>19px</option><option value='20px'>20px</option></select>
 &nbsp;<select id='bod_style'><option value='solid'>형태</option><option value='solid'>solid</option><option value='dashed'>dashed</option><option value='dotted'>dotted</option><option value='double'>double</option><option value='inset'>inset</option><option value='outset'>outset</option></select>
 &nbsp;<input type='text' id='bod_color' style='width:72px' onfocus='ppxlor(this)' /></fieldset>
<?php if($_GET['box'] != 'img' && $_GET['box'] != 'span' && $_GET['box'] !='a') {?>
padding : <input type='text' id='bod_padding' style='width:70px' value='10px' />&nbsp;
줄간격 : <input type='text' id='bod_lht' style='width:67px' onclick='if(!this.value) this.value="150%"' value='' /><br />
<?php }
} else if($_GET['box'] == 'table') {
?>
가로 : <select id='tb_col'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option></select>&nbsp;
세로 : <select id='tb_row'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option></select><br />
<?php }} if($_GET['box'] != 'img') {if($_GET['box'] == 'fieldset') {?>
제목 : <input type='text' id='legend' style='width:217px' /><br />
<?php } else {
if($_GET['aox'] == 'moreless') {?>
제목 : <input type='text' id='legend' style='width:217px' value='보기/닫기' /><br />
<?php }?>
배경색 : <input type='text' id='bak_color' style='width:73px' onfocus='ppxlor(this)' value='' />&nbsp;
<?php }?>
글자색 : <input type='text' id='fnt_color' style='width:73px' onfocus='ppxlor(this)' value='' /><br />
<?php if($_GET['box'] != 'table' && $_GET['box'] !='a') {?>
글꼴 : <select id='fnt_family'><option value=''>---</option><option value='Gulim'>굴림</option><option value='Dotum'>돋움</option><option value='Batang'>바탕</option><option value='Gungsuh'>궁서</option><option value='Malgun Gothic'>맑은고딕</option><option value='Arial'>Arial</option><option value='Tahoma'>Tahoma</option><option value='Verdana'>Verdana</option><option value='Trebuchet MS'>Trebuchet MS</option><option value='sans-serif'>sans-serif</option></select>
&nbsp;글자크기 : <select id='fnt_size'><option value=''>---</option><option value='7pt'>7pt</option><option value='8pt'>8pt</option><option value='9pt'>9pt</option><option value='10pt'>10pt</option><option value='11pt'>11pt</option><option value='12pt'>12pt</option><option value='14pt'>14pt</option><option value='18pt'>18pt</option><option value='24pt'>24pt</option><option value='36pt'>36pt</option></select>
<?php } if($_GET['box'] != 'span' && $_GET['box'] != 'fontstyle') {?>
넓이 : <input type='text' id='box_width' style='width:85px' onclick='if(!this.value) this.value="<?php if($_GET['box'] != 'a') {?>100%<?php } else {?>500<?php }?>"' value='<?php if($_GET['box']=='span') echo "500px";?>' />&nbsp;
<?php if($_GET['box'] != 'a') {?>높이 : <input type='text' id='box_height' style='width:85px' onclick='if(!this.value) this.value="100px"' value='<?php if($_GET['aox']=='scroll') echo "180px";?>' /><br />
<?php }}}?></div>
<input type='button' onclick='xcolor()' class='butt1' style='width:200px' value='적용' />
<div id="color_set" style="width:345px;margin-top:10px"></div>
</center>
</body>
</html>
<?php
exit;
} else if($_GET['spc']) {
?>
<style type='text/css'>
body {background:#EAEAEA}
table {display:none; width:419px}
td {font-family:Gulim; font-size:11pt; border:1px solid #EAEAEA; text-align:center; cursor:pointer; height:18px; width:18px; background:#FFF}
td:hover {border-color:#FF6633; background:#FFFF00}
div {font-size:9pt; padding:5px 0 5px 20px}
span {cursor:pointer}
</style>
<script type='text/javascript'>
//<![CDATA[
<?php
if($isie == 1) echo "var opener = dialogArguments;";
?>
function charT(no) {
for(var i=0;i < 6;i++) {
if(i !=no) {
document.getElementsByTagName('table')[i].style.display = 'none';
document.getElementsByTagName('span')[i].style.fontWeight = 'normal';
} else {
document.getElementsByTagName('table')[i].style.display = 'block';
document.getElementsByTagName('span')[i].style.fontWeight = 'bold';
}}}
function xxclick(e) {
<?php if($isie == 1) {?>
mousxent = event.srcElement;
<?php } else {?>
mousxent = e.target;
<?php }?>
if(mousxent && mousxent.tagName.toLowerCase() == 'td') opener.tag('',mousxent.innerHTML,'plus','','');
}
document.onclick = xxclick;
parent.document.title = '특수문자';

function mkchar() {
var mcharhead = ['일반기호','숫자,단위','원,괄호','한글','그리스,라틴어','일본어'];
var bodywt = "<div><span onclick='charT(0)' style='font-weight:bold'>" + mcharhead[0] + "</span>";
for(var i = 1;i < 6;i++) {bodywt += " | <span onclick='charT(" + i + ")'>" + mcharhead[i] + "</span>";}
bodywt += "</div>";
var mcharbody = [[['｛','｝','〔','〕','〈','〉','《','》','「','」','『','』','【','】','‘','’','“','”','、','。'],['·','‥','…','§','※','☆','★','○','●','◎','◇','◆','□','■','△','▲','▽','▼','◁','◀'],['▷','▶','♤','♠','♡','♥','♧','♣','⊙','◈','▣','◐','◑','▒','▤','▥','▨','▧','▦','▩'],['±','×','÷','≠','≤','≥','∞','∴','°','′','″','∠','⊥','⌒','∂','≡','≒','≪','≫','√'],['∽','∝','∵','∫','∬','∈','∋','⊆','⊇','⊂','⊃','∪','∩','∧','∨','￢','⇒','⇔','∀','∃'],['´','～','ˇ','˘','˝','˚','˙','¸','˛','¡','¿','ː','∮','∑','∏','♭','♩','♪','♬','㉿'],['→','←','↑','↓','↔','↕','↗','↙','↖','↘','㈜','№','㏇','™','㏂','㏘','℡','♨','☏','☎'],['☜','☞','¶','†','‡','®','ª','º','♂','♀']],[['½','⅓','⅔','¼','¾','⅛','⅜','⅝','⅞','¹','²','³','⁴','ⁿ','₁','₂','₃','₄','Ⅰ','Ⅱ'],['Ⅲ','Ⅳ','Ⅴ','Ⅵ','Ⅶ','Ⅷ','Ⅸ','Ⅹ','ⅰ','ⅱ','ⅲ','ⅳ','ⅴ','ⅵ','ⅶ','ⅷ','ⅸ','ⅹ','￦','$'],['￥','￡','€','℃','Å','℉','￠','¤','‰','㎕','㎖','㎗','ℓ','㎘','㏄','㎣','㎤','㎥','㎦','㎙'],['㎚','㎛','㎜','㎝','㎞','㎟','㎠','㎡','㎢','㏊','㎍','㎎','㎏','㏏','㎈','㎉','㏈','㎧','㎨','㎰'],['㎱','㎲','㎳','㎴','㎵','㎶','㎷','㎸','㎹','㎀','㎁','㎂','㎃','㎄','㎺','㎻','㎼','㎽','㎾','㎿'],['㎐','㎑','㎒','㎓','㎔','Ω','㏀','㏁','㎊','㎋','㎌','㏖','㏅','㎭','㎮','㎯','㏛','㎩','㎪','㎫'],['㎬','㏝','㏐','㏓','㏃','㏉','㏜','㏆']],[['㉠','㉡','㉢','㉣','㉤','㉥','㉦','㉧','㉨','㉩','㉪','㉫','㉬','㉭','㉮','㉯','㉰','㉱','㉲','㉳'],['㉴','㉵','㉶','㉷','㉸','㉹','㉺','㉻','ⓐ','ⓑ','ⓒ','ⓓ','ⓔ','ⓕ','ⓖ','ⓗ','ⓘ','ⓙ','ⓚ','ⓛ'],['ⓜ','ⓝ','ⓞ','ⓟ','ⓠ','ⓡ','ⓢ','ⓣ','ⓤ','ⓥ','ⓦ','ⓧ','ⓨ','ⓩ','①','②','③','④','⑤','⑥'],['⑦','⑧','⑨','⑩','⑪','⑫','⑬','⑭','⑮','㈀','㈁','㈂','㈃','㈄','㈅','㈆','㈇','㈈','㈉','㈊'],['㈋','㈌','㈍','㈎','㈏','㈐','㈑','㈒','㈓','㈔','㈕','㈖','㈗','㈘','㈙','㈚','㈛','⒜','⒝','⒞'],['⒟','⒠','⒡','⒢','⒣','⒤','⒥','⒦','⒧','⒨','⒩','⒪','⒫','⒬','⒭','⒮','⒯','⒰','⒱','⒲'],['⒳','⒴','⒵','⑴','⑵','⑶','⑷','⑸','⑹','⑺','⑻','⑼','⑽','⑾','⑿','⒀','⒁','⒂']],[['ㄱ','ㄲ','ㄳ','ㄴ','ㄵ','ㄶ','ㄷ','ㄸ','ㄹ','ㄺ','ㄻ','ㄼ','ㄽ','ㄾ','ㄿ','ㅀ','ㅁ','ㅂ','ㅃ','ㅄ'],['ㅅ','ㅆ','ㅇ','ㅈ','ㅉ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ','ㅏ','ㅐ','ㅑ','ㅒ','ㅓ','ㅔ','ㅕ','ㅖ','ㅗ','ㅘ'],['ㅙ','ㅚ','ㅛ','ㅜ','ㅝ','ㅞ','ㅟ','ㅠ','ㅡ','ㅢ','ㅣ','ㅥ','ㅦ','ㅧ','ㅨ','ㅩ','ㅪ','ㅫ','ㅬ','ㅭ'],['ㅮ','ㅯ','ㅰ','ㅱ','ㅲ','ㅳ','ㅴ','ㅵ','ㅶ','ㅷ','ㅸ','ㅹ','ㅺ','ㅻ','ㅼ','ㅽ','ㅾ','ㅿ','ㆀ','ㆁ'],['ㆂ','ㆃ','ㆄ','ㆅ','ㆆ','ㆇ','ㆈ','ㆉ','ㆊ','ㆋ','ㆌ','ㆍ','ㆎ']],[['Α','Β','Γ','Δ','Ε','Ζ','Η','Θ','Ι','Κ','Λ','Μ','Ν','Ξ','Ο','Π','Ρ','Σ','Τ','Υ'],['Φ','Χ','Ψ','Ω','α','β','γ','δ','ε','ζ','η','θ','ι','κ','λ','μ','ν','ξ','ο','π'],['ρ','σ','τ','υ','φ','χ','ψ','ω','Æ','Ð','Ħ','Ĳ','Ŀ','Ł','Ø','Œ','Þ','Ŧ','Ŋ','æ'],['đ','ð','ħ','I','ĳ','ĸ','ŀ','ł','ł','œ','ß','þ','ŧ','ŋ','ŉ','Б','Г','Д','Ё','Ж'],['З','И','Й','Л','П','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','б','в','г','д','ё'],['ж','з','и','й','л','п','ф','ц','ч','ш','щ','ъ','ы','ь','э','ю','я']],[['ぁ','あ','ぃ','い','ぅ','う','ぇ','え','ぉ','お','か','が','き','ぎ','く','ぐ','け','げ','こ','ご'],['さ','ざ','し','じ','す','ず','せ','ぜ','そ','ぞ','た','だ','ち','ぢ','っ','つ','づ','て','で','と'],['ど','な','に','ぬ','ね','の','は','ば','ぱ','ひ','び','ぴ','ふ','ぶ','ぷ','へ','べ','ぺ','ほ','ぼ'],['ぽ','ま','み','む','め','も','ゃ','や','ゅ','ゆ','ょ','よ','ら','り','る','れ','ろ','ゎ','わ','ゐ'],['ゑ','を','ん','ァ','ア','ィ','イ','ゥ','ウ','ェ','エ','ォ','オ','カ','ガ','キ','ギ','ク','グ','ケ'],['ゲ','コ','ゴ','サ','ザ','シ','ジ','ス','ズ','セ','ゼ','ソ','ゾ','タ','ダ','チ','ヂ','ッ','ツ','ヅ'],['テ','デ','ト','ド','ナ','ニ','ヌ','ネ','ノ','ハ','バ','パ','ヒ','ビ','ピ','フ','ブ','プ','ヘ','ベ'],['ペ','ホ','ボ','ポ','マ','ミ','ム','メ','モ','ャ','ヤ','ュ','ユ','ョ','ヨ','ラ','リ','ル','レ','ロ'],['ヮ','ワ','ヰ','ヱ','ヲ','ン','ヴ','ヵ','ヶ']]];
var mbacnt = 0;
var mbbcnt = 0;
for(var i = 0;i < 6;i++) {
bodywt += "<table cellSpacing='1px' cellPadding='0px'";
if(i == 0) bodywt += " style='display:block'><tbody>";else bodywt += "><tbody>";
mbacnt = mcharbody[i].length;
for(var j = 0;j < mbacnt;j++) {
bodywt += "<tr>";
mbbcnt = mcharbody[i][j].length;
for(var k = 0;k < mbbcnt;k++) {
bodywt += "<td>" + mcharbody[i][j][k] + "</td>";
}
bodywt += "</tr>";
}
bodywt += "</tbody></table>";
}
document.body.innerHTML = bodywt;
}
//]]>
</script>
</head>
<body onload="mkchar()">
</body>
</html>
<?php
exit;
}
?>
<script type='text/javascript'>
var wopen = 1;
var setop = Array('<?php echo $isie?>','<?php echo $bwr?>',<?php echo (int)$srwtpx?>,'<?php echo $sett[55]?>','<?php echo (($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?php echo (($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','<?php echo $id?>',<?php echo (int)$sett[11]?>,<?php echo $ismobile?>,'<?php echo $bdidnm[$id]?>');
var ffldr = "http://<?php echo $_SERVER['HTTP_HOST']?><?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $id?>&amp;";
var btype = "<?php echo ($sss[26] == 'd')? 'd':'';?>";
</script>
</head>
<body class="bbody" onclick="endyrsz();if(wopen==2) imgview(0)" onload="if(!sessno) setup()">
<span id='img' style='display:none;width:0'></span>
<div id='pview' style='display:none;padding:5px; line-height:130%'></div>
<script type="text/javascript" src="include/top.js"></script>
<?php
if($self != 3) {
$_SERVER['REQUEST_URI'] = str_replace("&","&amp;",$_SERVER['REQUEST_URI']);
if($sett[2]) include($sett[2]);
if(!$sett[41] || $sett[41] == 1) $bhlct = '';
else {
$bhlct = "<a href='{$index}'>HOME</a>";
if($sett[41] != 2 && $sett[41] != 6 && $sett[41] != 7 && $grp[$sgp]) $bhlct .= " &gt; <a href='{$index}?group={$sgp}'>{$grp[$sgp][0]}</a>";
if($sett[41] != 3 && $sett[41] != 5 && $sett[41] != 7 && $section && (count($bfsb[$section]) > 1 || $sett[40])) $bhlct .= " &gt; <a href='{$index}?section={$section}'>{$sect[$section][0]}</a>";
if($sett[41] != 4 && $sett[41] != 5 && $sett[41] != 6) $bhlct .= " &gt; <a href='{$dxpt}&amp;p=1'>{$wdth[1]}</a>";
}
if($sett[26]) include('module/'.$sett[26].'.php');
if($sett[41]){?><div class='bd_name'><h2><?php if($sss[29]){?><a target='_blank' href='exe.php?rss=<?php echo $id?>'><img src='icon/rss.gif' alt='' border='0' /></a><?php } else {?><img src='icon/norss.gif' alt='' border='0' /><?php }?><a href='<?php echo $dxpt?>'><?php echo $bdidnm[$id]?></a></h2><div><?php echo $bhlct?></div></div><?php }
if($sett[16][2] && @filesize($dxr."head")) {if($sett[32]) @readfile($dxr."head");else include($dxr."head");}
if($_POST['edit'] == "edit" && false !== strpos($wdth[4],$_POST['no']."^")) {$notrt = "checked='checked'";$notrtv = 1;}
else $notrtv = 0;
if($sett[32] && @filesize($dxr.$id."/head.dat")) @readfile($dxr.$id."/head.dat");else include($dxr.$id."/head.dat");
}
?>
<form method="post" name="wform" action="exe.php" style="margin:0">
<table id='wtable' border='0' cellspacing='0' cellpadding='0' style='width:100%'>
<tr><td>
<?php
$exit = '';
if($self != 3) {
if(($sett[6] == 0 || $sett[6] == 2) && $_GET['write'] == "new" && ($mbr_level > 0 || $sss[43])) $xdouble = '1';else $xdouble = '';
if($_GET['depth'] && ($sss[54] || !$sss[55])) $exit = 'exit';
else if($_GET['write'] != "new" || $xdouble) {
$fl = fopen($dl,"r");
$fn = fopen($dn,"r");
$fb = fopen($db,"r");
$num = 0;
while(!feof($fn)){
$xxx = fgets($fn);
$num = (int)substr($xxx, 0, 6);
if(!$num) break;
else if($xdouble) {
if(($mbr_no && strpos($xxx,$mbr_no."\x1b") == 9) || (!$mbr_no && trim(substr(fgets($fl),10,15)) == $_SERVER['REMOTE_ADDR'])) {
$xdouble = fgets($fb);
break;
} else fgets($fb);
} else if(($_POST['edit'] && $_POST['no'] == $num) || ($_GET['depth'] && $_GET['write'] == $num)) {
$xxx = explode("\x1b", $xxx);
$flo = explode("\x1b", fgets($fl));
$content = fgets($fb);
$mo = substr($xxx[0], 9);
if(($xxx[6][0] == 'a' || $xxx[0][8] > $mbr_level || ($s7116 === 1 && $time - substr($flo[0],0,10) > $cuttime[$sett[71][20]])) && $_GET['depth']) $exit = 'exit';
$ctt = substr($xxx[0], 6, 2);
break;
} else {
fgets($fl);
fgets($fb);
}
}
fclose($fl);
fclose($fn);
fclose($fb);
}
if($_POST['edit'] == "edit" || $_GET['depth']) {
if($exit == 'exit') {
echo "<script type='text/javascript'>history.go(-1);</script>";
exit;
}
$flo[1] = str_replace('"', '″',$flo[1]);
if($_POST['edit'] != "edit") $content = str_replace("<br />", "\n", $content);
$content =  str_replace("&", "&amp;", $content);
if($_POST['edit'] == "edit"){
$timecut = $time - $cuttime[$sett[71][0]];
if(($mo && $mo == $mbr_no) || (!$mo && $_POST['pass'] && $flo[2] == $_POST['pass'])|| $mbr_level == "9") $psscked = 2;
if($psscked === 2 && ckmdfx(2,1,$xxx,$flo[0]) === 7) {
$flo[3] = str_replace("\"", "″",$flo[3]);
if($sss[54]) {$conval = explode("\x1b", $content);$content=$conval[0];}
} else {
if($psscked !== 2) $psscked = "비밀번호가 틀립니다. (".wpass(2)."/10)";
else $psscked = "변경 금지되었습니다.";
scrhref($dxpt."&amp;no=".$_POST['no']."&amp;p=".$_POST['p'],0,$psscked);
exit;
}
?>
<input type="hidden" name="xx" value="<?php echo $_POST['xx']?>" />
<input type="hidden" name="no" value="<?php echo $_POST['no']?>" />
<input type="hidden" name="mode" value="<?php echo $_POST['edit']?>" />
<?php
} else {
?>
<input type="hidden" name="dctym" value="<?php echo ($time - substr($flo[0],0,10))?>" />
<?php
$content = "<br /><br /><br /><br /><div class='quot'>아래는 <b>{$flo[1]}</b>님의 글입니다.<div class='quot2'>".str_replace("<", "&lt;", $content)."</div></div>";
$flo = '';
}} else {$xxx = "000000";
if(file_exists($dxr.$id."/wtform.dat") && ($fbs = filesize($dxr.$id."/wtform.dat"))) {$fb = fopen($dxr.$id."/wtform.dat","r");$content = fread($fb,$fbs);fclose($fb);}
} if(!$flo[3]) $flo[3] = '제목을 입력하세요';
$_SESSION[$wtses] = array($id,$_POST['no']);
$istn = 0;
if($_POST['no']) $uno = $_POST['no'];
else {
$istn =1;
$nwdoc = $dxr.$id."/nwdoc";
if(!file_exists($nwdoc) || $time - filemtime($nwdoc) > 7200) {
$uno = $lst + 1;
$fw = fopen($nwdoc,"w");
} else {
$fw = fopen($nwdoc,"r+");
$uno = (int)fread($fw,6) + 1;
if($uno == 1000000) $uno = 1;
rewind($fw);
}
$uno6 = str_pad($uno,6,0,STR_PAD_LEFT);
fputs($fw,$uno6);
fclose($fw);
?>
<input type="hidden" name="uno" value="<?php echo $uno6?>" />
<?php
}
?>
<input type="hidden" name="pno" value="<?php echo $uno?>" />
<input type="hidden" name="spm" value="<?php echo $uno?>" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<input type="hidden" name="reply" value="<?php echo $_GET['write']?>" />
<input type="hidden" name="p" value="<?php echo $_REQUEST['p']?>" />
<input type="hidden" name="depth" value="<?php echo $_GET['depth']?>" />
<input type="hidden" name="ntime" value="<?php echo $dockie2?>" />
<div style="padding-right:6px">
<?php
if($ctg) {
?>
<select name='ct' style='vertical-align:middle;float:right;margin-left:5px'>
	<option value="00" style="color:#999">선택하세요</option>
<?php
foreach($ctg as $ii => $ctname) {
if($ctname) {
$ctname = preg_replace('`<[^>]+>`','',$ctname);
if($_POST['edit'] == "edit" && $ctt == $ii) echo "<option value='{$ii}' selected='selected'>{$ctname}</option>";
else echo "<option value='{$ii}'>{$ctname}</option>";
}}
if($mbr_level == 9) echo "<option onclick='popup(\"admin.php?mst={$idn}\",300,200)' value='".(str_pad(((int)$ii + 1),2,0,STR_PAD_LEFT))."'>_새 분류_</option>";
?></select><?php
} else echo "<input type='hidden' name='ct' />\n";
if($mbr_no <= 0) {
$uzname = ($sss[64])? "익명":(($_POST['edit'] == "edit")? $flo[1]:$_SESSION['yname']);
$uzpass = ($_POST['edit'] == "edit")? $flo[2]:$_SESSION['ypass'];
?>
<div style='float:left;width:395px'>이름<input type="text" name="name" style="width:100px" value="<?php echo $uzname?>" maxlength='20' class="inputt" />
 &nbsp; 비밀번호<input type="password" name="pass" style="width:100px" value="<?php echo $uzpass?>" maxlength='10' class="inputt" /></div>
<?php } if($_POST['edit'] != 'edit' && $sett[82] > 2 && (!$mbr_no || $sett[82] == 5)) {?>
<div class="antispamdv"><img src="include/antispam.php?no=<?php echo $uno?>" onclick="nwspm(this)" alt="antispam" /><input type="text" name="antispam" value="" onblur="chkatcode(0,this)" onclick="chkatcode(0,this)" /><span class="f8">왼쪽 값을 입력하세요</span></div>
<?php
} if($sss[26] != 'd') {
?>
<input type="text" name="subject" style="width:100%;clear:both;margin-left:0" value="<?php echo $flo[3]?>" onclick="if(this.value=='제목을 입력하세요') this.value=''" maxlength="70" class="inputt" />
<?php
}
?>
</div>
<?php
}
if(!$flo[5]) $flo[5] = "http://";
if($bwr == 'ie6') $preev = " onmouseover='this.style.backgroundColor=\"#C1F471\"' onmouseout='this.style.backgroundColor=\"transparent\"'";
else $preev = "";
if($sss[54]) {
if($fa=@fopen($dxr.$id."/write.html","r")) {
while($fao=fgets($fa)) echo $fao;
fclose($fa);
}
if($conval) {
echo "<script type='text/javascript'>
//<![CDATA[\n";
for($a = 1;isset($conval[$a]);$a++) {
$aa = $a -1;
echo "document.getElementsByName('addfield[]')[{$aa}].value = \"".trim($conval[$a])."\";\n";
}
echo "
//]]>
</script>";
}}
if($wdth[5][2] == 1) {$ismobilee = $ismobile;$ismobile = 2;}
if($ismobile != 2) {
?>
<div class='fcler' onmousedown='mtxt(9)'><ul class="butn">
<li><a class='butt3'>글꼴</a><ul style='width:100px' class='preev'>
<li style='font-family:Gulim'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Gulim\'}','{/span}','plus','t',this)">굴림</a></li>
<li style='font-family:Dotum'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Dotum\'}','{/span}','plus','t',this)">돋움</a></li>
<li style='font-family:Batang'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Batang\'}','{/span}','plus','t',this)">바탕</a></li>
<li style='font-family:Gungsuh'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Gungsuh\'}','{/span}','plus','t',this)">궁서</a></li>
<li style='font-family:Malgun Gothic'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Malgun Gothic\'}','{/span}','plus','t',this)">맑은고딕</a></li>
<li style='font-family:Arial'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Arial\'}','{/span}','plus','t',this)">Arial</a></li>
<li style='font-family:Tahoma'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Tahoma\'}','{/span}','plus','t',this)">Tahoma</a></li>
<li style='font-family:Verdana'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Verdana\'}','{/span}','plus','t',this)">Verdana</a></li>
<li style='font-family:Trebuchet MS'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:Trebuchet MS\'}','{/span}','plus','t',this)">Trebuchet MS</a></li>
<li style='font-family:sans-serif'><a<?php echo $preev?> onmousedown="tag('{span style=\'font-family:sans-serif\'}','{/span}','plus','t',this)">sans-serif</a></li>
</ul></li>
<li><a class='butt3'>크기</a><ul style='width:280px' class='preev'>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:7pt\'}','{/span}','plus','t',this)"><span style='font-size:7pt'>글자크기(7pt)</span></a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:8pt\'}','{/span}','plus','t',this)"><span style='font-size:8pt'>글자크기(8pt)</span></a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:9pt\'}','{/span}','plus','t',this)"><span style='font-size:9pt'>글자크기(9pt)</span></a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:10pt\'}','{/span}','plus','t',this)"><span style='font-size:10pt'>글자크기(10pt)</span></a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:11pt\'}','{/span}','plus','t',this)"><span style='font-size:11pt'>글자크기(11pt)</span></a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:13pt\'}','{/span}','plus','t',this)"><span style='font-size:13pt'>글자크기(13pt)</span></a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:16pt\'}','{/span}','plus','t',this)"><span style='font-size:16pt'>글자크기(16pt)</span></a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:20pt\'}','{/span}','plus','t',this)"><span style='font-size:20pt'>글자크기(20pt)</span></a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'font-size:25pt\'}','{/span}','plus','t',this)"><span style='font-size:25pt'>글자크기(25pt)</span></a></li>
</ul></li>
<li><a class='butt3'>박스</a><ul style='width:100px' class='preev'>
<li><a<?php echo $preev?>  onclick="popup('<?php echo $write?>?box=div',400,335);dsplnn(this)">div</a></li>
<li><a<?php echo $preev?> onclick="popup('<?php echo $write?>?box=div&amp;aox=scroll',400,335);dsplnn(this)"> - 내부스크롤</a></li>
<li><a<?php echo $preev?> onclick="popup('<?php echo $write?>?box=div&amp;aox=moreless',400,360);dsplnn(this)"> - 보기/닫기</a></li>
<li><a<?php echo $preev?> onclick="popup('<?php echo $write?>?box=fieldset',400,360);dsplnn(this)">fieldset</a></li>
<li><a<?php echo $preev?> onclick="popup('<?php echo $write?>?box=table',400,245);dsplnn(this)">table</a></li>
<li style='border-top:1px solid black'></li>
<li><a<?php echo $preev?> onclick="popup('<?php echo $write?>?box=fontstyle',400,310);dsplnn(this)">폰트스타일</a></li>
<li><a<?php echo $preev?> onclick="popup('<?php echo $write?>?box=span',400,310);dsplnn(this)">밑줄/풍선말</a></li>
<li><a<?php echo $preev?> onclick="popup('<?php echo $write?>?box=a',400,245);dsplnn(this)">미리보기 링크</a></li>
</ul></li>
<li><a class='butt3'>정렬</a><ul style='width:70px' class='preev'>
<li><div style="text-align:left;margin:0"><a<?php echo $preev?> onmousedown="tag('{div align=\'left\'}','{/div}','justifyLeft','','');dsplnn(this.parentNode)">left</a></div></li>
<li><div style="text-align:center;margin:0;background-color:#EAEAD6"><a<?php echo $preev?> onmousedown="tag('{div align=\'center\'}','{/div}','JustifyCenter','','');dsplnn(this.parentNode)">center</a></div></li>
<li><div style="text-align:right;margin:0"><a<?php echo $preev?> onmousedown="tag('{div align=\'right\'}','{/div}','JustifyRight','','');dsplnn(this.parentNode)">right</a></div></li>
</ul></li>
<li><a class='butt3' onmousedown='popurl()'>기타</a><ul style='width:100px' class='preev'>
<li><a<?php echo $preev?> onmousedown="tag('{sup}','{/sup}','superscript','t',this)">위첨자&lt;sup&gt;</a></li>
<li><a<?php echo $preev?> onmousedown="tag('{sub}','{/sub}','subscript','t',this)">아래첨자&lt;sub&gt;</a></li>
<li><a<?php echo $preev?> onmousedown="tag('{div style=\'margin-left:40px\'}','{/div}','indent','t',this)">들여쓰기</a></li>
<li><a<?php echo $preev?> onclick="tag('','','outdent','t',this)">내어쓰기</a></li>
<li><a<?php echo $preev?> onmousedown="tag('{hr size=\'3\' /}','','inserthorizontalrule','t',this)" title="〈hr〉">수평선</a></li>
<li><a<?php echo $preev?> onmousedown="tag('{span style=\'text-decoration: underline\' title=\'클릭:네이버사전\' onclick=\'imgview(\\\'http:\/\/dic.naver.com/search.nhn?query=\\\' +encodeURIComponent(this.innerHTML),4,500)\'}','{/span}','plus','','');dsplnn(this)" title="선택단어 네이버사전 링크">네이버사전</a></li>
<li><a<?php echo $preev?> onmousedown="tag('{a style=\'text-decoration: underline\' title=\'링크:네이버검색\' onclick=\'nwopn(\\\'http:\/\/search.naver.com/search.naver?where=nexearch&amp;sm=tab_jum&amp;query=\\\' +encodeURIComponent(this.innerHTML))\'}','{/a}','plus','','');dsplnn(this)" title="선택단어 네이버검색 링크">네이버검색</a></li>
<li><a<?php echo $preev?> onmousedown="tag('{a style=\'text-decoration: underline\' title=\'링크:구글검색\' onclick=\'nwopn(\\\'http:\/\/www.google.co.kr/search?q=\\\' +encodeURIComponent(this.innerHTML))\'}','{/a}','plus','','');dsplnn(this)" title="선택단어 구글검색 링크">구글검색</a></li>
<li><a<?php echo $preev?> onmousedown="popurl(this.parentNode.parentNode,3);dsplnn(this)" title="미디어플레이어 삽입">mp3 삽입</a></li>
<li><a<?php echo $preev?> onmousedown="popurl(this.parentNode.parentNode,4);dsplnn(this)" title="Flash 삽입">swf 삽입</a></li>
<li><a<?php echo $preev?> onmousedown="xhtmltag(this)" title="선택 영역 html 태그 삭제">&lt;a-z&gt;삭제</a></li>
<li><a<?php echo $preev?> id="selsosprw" onmousedown="prevw(2);dsplnn(this)" title="선택 영역 부분 소스보기">부분소스보기</a></li>
</ul><span style='display:none'></span></li>
<li><a class='butt3'>목록</a><ul style='width:100px' class='preev'>
<li><a<?php echo $preev?> onclick="tag('','{ul}{li}##{/li}{/ul}','plus','',3);dsplnn(this)">기호목록&lt;ul&gt;</a></li>
<li><a<?php echo $preev?> onclick="tag('','{ol}{li}##{/li}{/ol}','plus','',3);dsplnn(this)">번호목록&lt;ol&gt;</a></li>
<li><a<?php echo $preev?> onclick="if(emotc===1) emoticw(3);else emoticw(2);dsplnn(this)">이모티콘목록</a></li></ul></li>
<li><a<?php echo $preev?> class='butt3 bold8' onclick="popurl(this,1)" title="링크삽입">Lnk</a><span style='display:none'></span></li>
<li><a class='butt3 bold8' onclick="popurl(this,2)" title="이미지삽입">Img</a><span style='display:none'></span></li>
</ul>
<?php
if(!$sett[77] && $srwdth < 565) {
?>
<div class='fcler'></div>
<?php
}
if($sett[30]) {
$dtime = $time - ($sett[30]*86400);
$tm = opendir($dxr."_member_");
while($tmp = readdir($tm)) {
if(substr($tmp,0,3) == 'wtp') {
if(filemtime($dxr."_member_/".$tmp) < $dtime) @unlink($dxr."_member_/".$tmp);
}
}
closedir($tm);
}
if($tpsz = @filesize($saved)) {
$fp = fopen($saved,"r");
$svd = fread($fp,$tpsz);
fclose($fp);
$tpsz = ($tpsz > 1024)? sprintf("%.1f",$tpsz/1024)."kb":$tpsz."b";
}
if(is_dir("icon/emoticon")) {
$emotc = array();
$edopn = opendir("icon/emoticon");
while($emoc = readdir($edopn)) {
if($emoc != '.' && $emoc != '..') $emotc[] = $emoc;
}
closedir($edopn);
if($emotc[1]) sort($emotc);
}
?>
<ul class="butn">
<li><a class='butt3' onclick="popuu(this,1)" style="color:red" title="글자색">가</a><span style='display:none'></span></li>
<li><a class='butt3' onclick="popuu(this,2)" title="배경색"><span style="background-color:yellow">가</span></a><span style='display:none'></span></li>
<li><a class='butt3' onmousedown="tag('{b}','{/b}','bold','','')" style="font-weight:bold" title="굵게">가</a></li>
<li><a class='butt3' onmousedown="tag('{i}','{/i}','italic','','')" style="font-style:italic" title="기울게">가</a></li>
<li><a class='butt3' onmousedown="tag('{u}','{/u}','underline','','')" style="text-decoration:underline" title="밑줄">가</a></li>
<li><a class='butt3' onmousedown="tag('{s}','{/s}','strikethrough','','')" style="text-decoration:line-through" title="취소선">가</a></li>
<li style="width:27px"><a class="butt3" title="이모티콘" onclick="if(emotc===1) emoticw(3)"><img src="icon/emoticon.gif" alt="" border="0" /></a><ul id="emoticon" style="width:234px" class="preev emotic"></ul></li>
<li><a class='butt3' onclick="popup('<?php echo $write?>?spc=1',420,200)" title="특수문자">※</a></li>
</ul>
<ul class="butn" style="float:right">
<li><a class="butt3" id="dehtml" onclick="wsghtm(2)" title="위지윅/HTML 전환">html</a></li></ul></div>
<?php } else {$sett[33] = 100;?><div id='dehtml' style="display:none"></div><?php }?>
<div class="fcler"></div><div id="contentdiv" style="height:<?php echo $sett[33]?>px;">
<?php if($ismobile != 2) {?><iframe id="previw" marginheight='0px' marginwidth='0px' frameborder='0'></iframe>
<iframe id="wsgwin" marginheight="0px" marginwidth="0px" frameborder="0"></iframe><?php } else {?><input type="text" id="wsgwin" style="display:none" /><?php }?>
<div id="texx" style="height:<?php echo $sett[33]?>px"><textarea name="wcontent" id="content" rows="1" cols="1" <?php if($ismobile != 2) {?>onmouseup="save_pos(this)" onkeyup="if(ctrk) save_pos(this)" onkeydown="if(ekc == 13) texresiz(this,0)"<?php } else {?>style="background:#FFFFFF;height:<?php echo $sett[33]?>px;padding:0;"<?php }?>><?php echo str_replace("</textarea","<//textarea",$content)?></textarea></div>
</div>
<?php if($ismobile != 2) {?>
<input type='button' id='rszdv' class='rszdv' onmousedown='startyrsz()' onmouseup='endyrsz()' onclick='endyrsz()' />
<div id='wzwg' style='display:block;float:left;'>
<a onclick="tag('','','undo','','')"  class="butt3 butt9" title="실행취소">undo</a>
<a onclick="tag('','','redo','','')" class="butt3 butt9" title="다시실행">redo</a>
</div>
<select id="html" onchange="var xx=this.options[this.selectedIndex].value;if(xx){seltrans(xx);this.value='';}">
	<option value="">줄바꿈등등</option>
	<option value="nl2br">\n → &lt;br&gt;</option>
	<option value="nl+br">\n → \n&lt;br&gt;</option>
	<option value="nl-" style="color:#FF0000">\n → ''</option>
	<option value="br2nl">&lt;br&gt; → \n</option>
	<option value="br+nl">&lt;br&gt; → \n&lt;br&gt;</option>
	<option value="br-" style="color:#FF0000">&lt;br&gt; → ''</option>
	<option value="lt">&lt; → &amp;lt;</option>
	<option value="lt-">&amp;lt; → &lt;</option>
	<option value="x_gtlt">&gt;공백&lt; → &gt;&lt;</option>
	<option value="x_gt">&gt;공백 → &gt;</option>
	<option value="x_lt">공백&lt; → &lt;</option>
	<option value="edtb">테이블편집</option>
	<option value="lowcase">소문자로</option>
	<option value="upcase">대문자로</option>
	<option value="w3c">웹표준 변환</option>
	<option value="x_img" style="color:#FF0000">&lt;img&gt; → ''</option>
	<option value="x_span" style="color:#FF0000">&lt;span&gt; → ''</option>
	<option value="x_font" style="color:#FF0000">&lt;font&gt; → ''</option>
	<option value="x_p" style="color:#FF0000">&lt;p&gt; → \n</option>
	<option value="x_px" style="color:#FF0000">&lt;p&gt; → ''</option>
	<option value="x_div" style="color:#FF0000">&lt;div&gt; → \n</option>
	<option value="x_empty" style="color:#FF0000">&lt;a-z&gt;&lt;/a-z&gt; → ''</option>
	<option value="x_script" style="color:#FF0000">&lt;script~~&lt;/script&gt; → ''</option>
</select>
<div style='float:left;padding:7px 0 0 3px'>
<label title='검색치환을 정규식으로'>정규식 <input type='checkbox' class='checkk' id='regular' /></label></div>
<div style='float:right'>
<a id='tpsv' onclick="bysaved()" class="butt3 bold8" style="float:left" title="<?php echo $tpsz?>">임시저장</a>
<a id="aprevw" onclick="prevw(1)" class="butt3 bold8" style="float:left">미리보기</a></div><div class='fcler'></div><?php }?>
<table cellspacing='0' cellpadding='0' style='width:100%;padding:3px 0 3px 0'><tr><td style='width:50%'><table cellspacing='0' cellpadding='0' style='width:100%'><tr><td style='width:50px'><a onclick="findtxt()" class="butt3 bold8" style="height:16px;text-align:center" title="검색">find</a></td><td><textarea id='replace_a' rows="1" cols="1" onclick="if(this.value=='Find') this.value='';" ondblclick="this.value='';">Find</textarea></td></tr></table></td>
<td style='width:50%'><table cellspacing='0' cellpadding='0' style='width:100%'><tr><td style='width:65px;text-align:center'><a onclick="seltrans('replace')" class="butt3 bold8" style="height:16px" title="검색교체">replace</a></td>
<td><textarea id='replace_b' rows="1" cols="1" onclick="if(this.value=='Replace') this.value='';" ondblclick="this.value='';">Replace</textarea></td></tr></table></td></tr></table>
</td></tr>
<tr><td><input type="button" class="butt8" value="+" onclick="fndresize(1)" style="margin-left:5px" /><input type="button" class="butt8" value="-" onclick="fndresize(2)" />
<?php if($wdth[7][31] != 'a' && $wdth[7][31] <= $mbr_level) {?>
<div id="previe"></div>
<ul id="fuplist"><li></li></ul>
<div style="float:left">
<div style="float:left;padding:3px 0 0 3px;height:45px;color:#BABABA"><input type="hidden" name="afsze" value="" /><span id="afszt">0</span> KB<?php if($sett[9] && $wdth[7][9]) echo " / ".($sett[9]*1024)." KB";?> &nbsp; <label>외곽선 <input type='checkbox' id='imgbordr' onclick="if(this.checked) popup('<?php echo $write?>?box=img',303,250);else this.value='';" value="" style="height:13px;padding:0;margin:0;vertical-align:middle" /></label><br />이미지는 드래그해서 삽입하세요</div>
<div class="fcler"></div><div style="float:left"></div><iframe id="uploadlist" src="exe.php?id=<?php echo $id?>&amp;ufn=<?php echo $uno?>&amp;no=<?php echo $_POST['no']?>&amp;ntime=<?php echo $dockie2?>" style="height:25px;width:75px;float:left;" frameborder="0"></iframe>
<a onmousedown="mtxt(9)" onclick="tfdx()" class="butt3 bold8" style="float:left">삭제</a>
<a onmousedown="mtxt(9)" onclick="pimg()" class="butt3 bold8" style="float:left"><?php if(!$ismobile && $iswindows) {?><img src="icon/f.png" style="height:12px;vertical-align:middle;margin-right:3px;border:0" alt="" /><?php }?>본문삽입</a>
</div><div class="fcler"></div>
<?php if($wdth[7][33]){?><div style='padding:5px 0 5px 0;color:#BABABA'>첨부 허용: <?php echo str_replace("|",",",$sett[64])?></div>
<?php }} if($sss[26] != 'd') {?>
<div style='float:left;padding:5px 0 5px 0'><?php if($wdth[9][11]) {?><label>트랙백<input
 type="checkbox" class="checkk" onclick="toggle($('hidden1'))" /></label><?php }?><label>링크<input id="inhidden2"
 type="checkbox" class="checkk" onclick="toggle($('hidden2'))" /></label><?php if(!$wdth[7][32]) {?><label>태그<input
 type="checkbox" class="checkk" onclick="toggle($('hidden3'))" /></label><?php } if($sett[15]) {
function rtchecked($val) {
if($val && $val != '0') return "value=\"{$val}\" checked=\"checked\"";
else return "";
}
?><label title='덧글이 달리면 메일로 통보합니다'>덧글메일통보 <input type="checkbox" class="checkk"
<?php if(($_POST['edit'] != 'edit' && $mbr_level) || ($_POST['edit'] == 'edit' && $mo)) {echo " name='perm_rpmail' ";if($_POST['edit'] == "edit") echo rtchecked(substr($xxx[6],1));else echo rtchecked($wdth[7][7]);} else {
echo " onclick=\"if(this.nextSibling.style.display=='') {this.nextSibling.style.display='none';this.nextSibling.value='Email Address';} else this.nextSibling.style.display=''\"";
if($_POST['edit'] == 'edit' && substr($xxx[6],1)) echo " checked='checked'";echo " /><input type='text' name='perm_rpmail' onclick='if(this.value==\"Email Address\") this.value=\"\"' title='메일주소를 적으면 덧글을 메일로 통보합니다' value='";
if($_POST['edit'] == 'edit' && substr($xxx[6],1)) echo substr($xxx[6],1)."'";else echo "Email Address' style='display:none'";
}?> /></label><?php } if($mbr_level == "9"){?></div><div style='float:left;padding:5px 0 5px 0'><label>공지글<input
 type="checkbox" class="checkk" name="notice" value="<?php echo $notrtv?>" onclick="this.value=(this.value=='1')? '0':'1'" <?php echo $notrt?> /></label><label>분류편집<input
 type="checkbox" class="checkk" onclick="if(this.checked){repeatt(1);popup('admin.php?mst=<?php echo $idn?>', 300, 200)}" /></label><?php }}?></div><div class='fcler'></div>
비밀글/읽기권한&nbsp;<select name="perm_vw"><option value="0">모두 허용</option><option value="r">rss출력제한</option><option value="9">비밀글</option><?php if($sss[23] < 1){?><option value="1">level1 이상</option><?php } if($sss[23] < 2){?><option value="2">level2 이상</option><?php } if($sss[23] < 3){?><option value="3">level3 이상</option><?php } if($sss[23] < 4){?><option value="4">level4 이상</option><?php } if($sss[23] < 5){?><option value="5">level5 이상</option><?php } if($sss[23] < 6){?><option value="6">level6 이상</option><?php } if($sss[23] < 7){?><option value="7">level7 이상</option><?php } if($sss[23] < 8){?><option value="8">level8 이상</option><?php }?></select>
<?php if($sss[26] != 'd') {if((int)$xxx[2] == 0 && $sss[25] != 'a') {?>  &nbsp; 덧글&nbsp;<select name="perm_rp"><option value="0">허용</option><option value="a">차단</option></select><?php } if($sss[55] && (!$xxx[6] || (!$_GET['depth'] && (int)$xxx[6][0] == 0))){?> &nbsp; 답글&nbsp;<select name="perm_re"><option value="0">허용</option><option value="a">차단</option></select><?php } if((int)$xxx[4] == 0 && $sss[49] == 1) {?> &nbsp; 엮인글&nbsp;<select name="perm_tb"><option value="0">허용</option><option value="a">차단</option></select><?php }}?>
<div style='padding:5px 0 5px 0'><?php if($wdth[9][12] && $sss[25] < 9 && $sss[25] != 'a'){?>덧글쓰기권한&nbsp;<select name="perm_rpw"><option value="0">모두 허용</option><?php if($sss[25] < 1){?><option value="1">level1 이상</option><?php } if($sss[25] < 2){?><option value="2">level2 이상</option><?php } if($sss[25] < 3){?><option value="3">level3 이상</option><?php } if($sss[25] < 4){?><option value="4">level4 이상</option><?php } if($sss[25] < 5){?><option value="5">level5 이상</option><?php } if($sss[25] < 6){?><option value="6">level6 이상</option><?php } if($sss[25] < 7){?><option value="7">level7 이상</option><?php } if($sss[25] < 8){?><option value="8">level8 이상</option><?php }?><option value="9">관리자만</option><option value="a">사용 안 함</option></select>  &nbsp; <?php }?>
<?php if($wdth[9][13] && $wdth[5][0] < 9 && $wdth[5][0] != 'a'){?>덧글읽기권한&nbsp;<select name="perm_rpv"><option value="0">모두 허용</option><?php if($wdth[5][0] < 1){?><option value="1">level1 이상</option><?php } if($wdth[5][0] < 2){?><option value="2">level2 이상</option><?php } if($wdth[5][0] < 3){?><option value="3">level3 이상</option><?php } if($wdth[5][0] < 4){?><option value="4">level4 이상</option><?php } if($wdth[5][0] < 5){?><option value="5">level5 이상</option><?php } if($wdth[5][0] < 6){?><option value="6">level6 이상</option><?php } if($wdth[5][0] < 7){?><option value="7">level7 이상</option><?php } if($wdth[5][0] < 8){?><option value="8">level8 이상</option><?php }?><option value="9">관리자만</option></select>  &nbsp; <?php }?>
<?php if($wdth[9][14] && $wdth[7][3] < 9 && $wdth[7][3] != 'a'){?>다운로드권한&nbsp;<select name="perm_dwn"><option value="0">모두 허용</option><?php if($wdth[7][3] < 1){?><option value="1">level1 이상</option><?php } if($wdth[7][3] < 2){?><option value="2">level2 이상</option><?php } if($wdth[7][3] < 3){?><option value="3">level3 이상</option><?php } if($wdth[7][3] < 4){?><option value="4">level4 이상</option><?php } if($wdth[7][3] < 5){?><option value="5">level5 이상</option><?php } if($wdth[7][3] < 6){?><option value="6">level6 이상</option><?php } if($wdth[7][3] < 7){?><option value="7">level7 이상</option><?php } if($wdth[7][3] < 8){?><option value="8">level8 이상</option><?php }?><option value="9">관리자만</option></select><?php }?></div>
<div id="hidden1" style="display:none">트랙백주소<input type="text" name="tb_url" style="width:33%" value="http://" ondblclick="if(this.value=='http://') this.value=''" class="inputt" /> &nbsp; 글주소<input type="text" name="tb_link" style="width:33%" value="http://" ondblclick="if(this.value=='http://') this.value=''" class="inputt" /></div>
<div id="hidden2" style="display:none">링크주소<input type="text" name="wf_link5" style="width:74%" value="<?php echo $flo[5]?>" class="inputt" ondblclick="if(this.value=='http://') this.value='';" />&nbsp;</div>
<div id="hidden3" style="display:none">태그<input type="text" name="wf_link6" style="width:50%" value="<?php echo $flo[6]?>" class="inputt" />&nbsp;<input type="button" onclick="tagw()" class="butt7" value="태그보기" />&nbsp;태그의 구분은 쉼표(,)로<div id='tagdiv'></div></div>
<input type="hidden" id="wzor" value="w" /><input type="hidden" id="gout" value="1" /><input type="hidden" id="wrwn" value="0" /><input type="hidden" id="edht" value="300" /><input type="hidden" id="prvw" value="0" /><iframe name="exe" style="display:none;width:0;height:0"></iframe>
</td></tr>
<tr><td align='center'><input type="button" onclick="wcancel()" class="butt6" value="cancel" style="margin-right:10px" /><input type="button" onclick="sbmt()" id="_submit" class="butt6" value="submit" />
</td></tr>
</table></form>
<form name="svfm" action="exe.php" method="post" target="exe" style="visibility:hidden"><input type="hidden" name="id" value="<?php echo $id?>" /><input type="hidden" name="no" value="<?php echo $_POST['no']?>" /><input type="hidden" name="ckdoubled" value="" /><textarea name="saved" rows="1" cols="1" style="width:0;height:0;border:0;display:none"><?php echo str_replace("<","&lt;",str_replace("&","&amp;",$svd))?></textarea></form>
<textarea id="ckdouble" rows="1" cols="1"><?php echo trim($xdouble)?></textarea>
<?php
if($wdth[5][2] == 1) $ismobile = $ismobilee;
if($sett[16][5] && @filesize($dxr."tail")) {if($sett[32]) @readfile($dxr."tail");else include($dxr."tail");}
if($sett[26]) include('module/'.$sett[26].'.php');
if($sett[3]) include($sett[3]);
if($wdth[5][2] == 1) $ismobile = 2;
?>
<script type='text/javascript'>
//<![CDATA[
var obj;
stbLR67 = <?php echo $stbLR67?>;
var obw;
var updoc = '';
var ofen;
var win;
var oselt = '';
var mmo = null;
var isdoubled = 1;
var wlevel = '<?php echo $mbr_level?>';
var ismobile = '<?php echo $ismobile?>';
var emotic = new Array(<?php if($emotc) {foreach($emotc as $key => $value) echo "'{$value}',";}?>'');

function setup() {
recize();
obj = $$('wcontent',0);
obw = $('wsgwin').contentWindow;
nwspm();
if(ismobile != '2') {
	try
	{
 		var doc = obw.document;
 		doc.designMode = 'On';
 		doc.open();
 		doc.write("<html>");
 		doc.write("<head>");
 		doc.write("<link rel='stylesheet' type='text/css' href='skin/<?php echo $wdth[2]?>/style.css' />");
 		doc.write("<style type='text/css'>p,div,td {margin:2px} body {font-size:9pt;font-family:Gulim;line-height:120%; white-space:pre-wrap; margin:5px} a, a:link, a:hover, a:visited {text-decoration:underline}</style>");
 		doc.write("<!--[if IE]><style type='text/css'>body {word-break:break-all}</style><![endif]-->");
 		doc.write("</head>");
 		doc.write("<body class='wbody'>");
 		doc.write("</body>");
 		doc.write("</html>");
 		if(obj.value) doc.write(obj.value.replace(/<\/\/textarea>/gi,"</textarea>"));
 		doc.close();
 	}
 	catch(e) {if(!obw) {obw = $('wsgwin').contentWindow;setup();}}
pview = $('pview');
obw.focus();
if(ismobile == '3') {
wsghtm(1);
} else {
if('<?php echo $iswindows?>' != '1') {wsghtm(1);wsghtm(1);}
}} else {
$('wzor').value = 'h';
$('wsgwin').style.display = 'none';
$('wsgwin').style.height = '0px';
$('texx').style.display = 'block';
}
sessno = <?php echo $sessno?>;
$('texx').style.overflowX = 'hidden';
azax("exe.php?&onload=<?php echo $time?>&id=<?php echo ($id)?$id:1?>&isvcnct=<?php echo $isvcnnct?>",9);
setTimeout("bksecond()", 15000);
obj.style.overflowX='hidden';
if('<?php echo $_GET['ct']?>' && document.wform.ct) document.wform.ct.value='<?php echo $_GET['ct']?>';
rdio = ($('fuplist'))?$('fuplist').getElementsByTagName('li'):'';
emoticw();
<?php
if($_POST['edit'] == "edit") {
echo "document.wform.perm_vw.value='{$xxx[0][8]}';";
if($xxx[2] === 'a') echo "document.wform.perm_rp.value='a';";
if($xxx[4] === 'a') echo "document.wform.perm_tb.value='a';";
if($xxx[6][0] === 'a') echo "document.wform.perm_re.value='a';";
if($wdth[9][12] && $sss[25] < 9 && $sss[25] != 'a') echo "document.wform.perm_rpw.value='".$xxx[3][0]."';";
if($wdth[9][13] && $wdth[5][0] < 9 && $wdth[5][0] != 'a') echo "document.wform.perm_rpv.value='".$xxx[3][1]."';";
if($wdth[9][14] && $wdth[7][3] < 9 && $wdth[7][3] != 'a') echo "document.wform.perm_dwn.value='".$xxx[3][2]."';";
}
if($wdth[5][2] == 1) echo "$('contentdiv').style.display = 'none';parentt(parentt($('replace_a'),'table'),'table').style.display = 'none';";
if($sss[26] == 'd' || $sss[23] === 'a' || $wdth[5][3] == 1) echo "$('hidden2').style.display = 'block';if($('inhidden2')) $('inhidden2').checked = true;";
?>
}
function ckprohibit(ths) {
var prhbw = new Array(''<?php
if($fp=@fopen($dxr."prohibit","r")){
while($fpo = trim(fgets($fp))) echo ",'{$fpo}'";
fclose($fp);
}
?>);
for(var i=prhbw.length -1;i > 0;i--) {
if(ths.indexOf(prhbw[i]) != -1) return prhbw[i];
}}

function sbmt() {
var proh;
if(document.wform.antispam && document.wform.antispam.readOnly == false) {document.wform.antispam.style.backgroundColor='#B2FF6F';alert("스팸 방지 코드를 넣으세요");document.wform.antispam.focus();}
else {
if(document.wform.ct.value == '00') alert("'분류'를 선택하세요");
else {
repeatt(2);
if($('wzor').value == 'w') wsghtm(1);
else if($('wrwn').value == 1) obj.value=obj.value.replace(/[\r\n]/g, "");
<?php if($wdth[5][1] == 1 || $wdth[5][2] == 1) {?>if(obj.value == '' && (document.wform.wf_link5.value != '' || document.wform.addfield[0].value != '')) obj.value = '_';<?php }?>
if(obj.value == '') alert("'본문'이 비었습니다.");
else if(btype != 'd' && document.wform.subject.value == '') alert("'제목'이 비었습니다.");
else {
<?php if((int)$sett[85] > 0 && $mbr_level < $sett[87]) {?>
var over = strbyte(obj.value) - <?php echo $sett[85]*1024?>;
if(over > 0) {alert('내용이 너무 깁니다. (' + over + 'byte 초과)');return false;}
<?php }?>
if(btype != 'd') proh = ckprohibit(document.wform.subject.value);
if(proh) alert("제목에 금지단어 '"+proh+"'가 들어 있습니다");
else {
proh = ckprohibit(document.wform.content.value);
if(proh) alert("내용에 금지단어 '"+proh+"'가 들어 있습니다");
}
if(!proh) {
$('gout').value='3';
if(document.wform.tb_url.value=='http://') document.wform.tb_url.value = '';
if(document.wform.tb_link.value=='http://') document.wform.tb_link.value = '';
if(document.wform.wf_link5.value=='http://') document.wform.wf_link5.value = '';
<?php if($isie == 1 || $bwr == 'opera') {?>
seltrans('w3c');
<?php } if($isie == 1) {?>
obj.value = obj.value.replace(/<a ([^>]+) target='_blank'>/gi,"<a target='_blank' $1>");
obj.value = obj.value.replace(/<a href=/gi,"<a target='_blank' href=");
<?php }?>
obj.value = obj.value.replace(/[\r]?\n/g,"<br />");
<?php if($mbr_no <= 0) {?>
if(document.wform.name.value == '') alert("'이름'이 비었습니다");
else if(document.wform.pass.value == '') alert("'비밀번호'가 비었습니다");
else if(document.wform.pass.value.match(/[^0-9a-z]/i)) alert("'비밀번호'는 영문숫자만");
else
<?php }?>if($('ckdouble').value == obj.value) alert("중복된 내용입니다");
else ckform2(0);
}}
wsghtm(1);
}}}

function checkmemo(val) {
var mdiv = $('notifv');
if(val == 'new_memo') {
<?php
if($mbr_level && $sett[52] > 1 && $sett[57] != 'a' && $sett[57] <= $mbr_level) {
?>
var alertt = "";
if(('<?php echo $sett[52]?>' == '2' || '<?php echo $sett[52]?>' == '3' || '<?php echo $sett[52]?>' == '5' || '<?php echo $sett[52]?>' == '6')) alertt += "<input type='button' id='confirm_memo' class='srbt' value='쪽지가 도착했습니다' onclick='read(\"get\");hidedv(\"notifv\");' /><div class='fcler'></div>";
if('<?php echo $sett[52]?>' == '3' || '<?php echo $sett[52]?>' == '4' || '<?php echo $sett[52]?>' == '6') alertt += "<embed src='icon/memo.swf' type='application/x-shockwave-flash' autostart='true' loop='0' style='width:1px;height:1px' />";
if(parseInt('<?php echo $sett[52]?>') >= 4) read('get');
mdiv.innerHTML = alertt + moux;
mdiv.style.display = 'block';
<?php }?>
}
setTimeout('azax("exe.php?&check_memo=<?php echo $time?>&id=1&isvcnct=<?php echo $isvcnnct?>",9)',30000);
}

var reque = ["<?php echo md5($sessid)?>","<?php echo $_SERVER['REQUEST_URI']?>","<?php echo $xx?>",<?php if($sett[93][0] != 4 && ($sett[93][0] == 1 || ($sett[93][0] == 2 && $ismobile) || ($sett[93][0] == 3 && !$ismobile))) echo substr($sett[93],1);?>];

if("<?php echo $_POST['edit']?>") document.title = "글수정 - <?php echo $bdidnm[$id]?>";
else document.title = "글쓰기 - <?php echo $bdidnm[$id]?>";

//]]>
</script>
<script type="text/javascript" src="include/write.js"></script>
<form method="post" action="exe.php" id="ckfma" target="exe"></form>
<div id='notifv' style='display:none'></div>
<?php if($self != 3) {?>
</body>
</html>
<?php }?>