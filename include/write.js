var wcolor;
var wturl = '';
var bksec = 1;
var emotc = 0;
var ofen;

function popuu(ths, pal) {
if(ths && ths !== 3 && ths.nextSibling.innerHTML == '') {
if(wcolor) popuu(3);
var hcolor = new Array('ff0000','dc143c','b22222','800000','8b0000','a52a2a','a0522d','8b4513','cd5c5c','bc8f8f','f08080','fa8072','e9967a','ff7f50','ff6347','f4a460','ffa07a','cd853f','d2691e','ff4500','ffa500','ff8c00','d2b48c','ffdab9','ffe4c4','ffe4b5','ffdead','f5deb3','deb887','b8860b','daa520','ffd700','ffff00','fafad2','eee8aa','f0e68c','bdb76b','7cfc00','adff2f','7fff00','00ff00','32cd32','9acd32','808000','6b8e23','556b2f','228b22','006400','008000','2e8b57','3cb371','8fbc8f','90ee90','98fb98','00ff7f','00fa9a','008080','008b8b','20b2aa','66cdaa','5f9ea0','4682b4','7fffd4','b0e0e6','afeeee','add8e6','b0c4de','87ceeb','87cefa','48d1cc','40e0d0','00ced1','00ffff','00ffff','00bfff','1e90ff','6495ed','4169e1','0000ff','0000cd','000080','00008b','191970','483d8b','6a5acd','7b68ee','9370db','9932cc','9400d3','8a2be2','ba55d3','dda0dd','e6e6fa','d8bfd8','da70d6','ee82ee','4b0082','8b008b','800080','c71585','ff1493','ff00ff','ff00ff','ff69b4','db7093','ffb6c1','ffc0cb','ffe4e1','ffebcd','ffffe0','fff8dc','faebd7','ffefd5','fffacd','f5f5dc','faf0e6','fdf5e6','e0ffff','f0f8ff','f5f5f5','fff0f5','fffaf0','f5fffa','f8f8ff','f0fff0','fff5ee','fffff0','f0ffff','fffafa','ffffff','dcdcdc','d3d3d3','c0c0c0','a9a9a9','778899','708090','808080','696969','2f4f4f','000000');
var tb = '';
if(pal == 2) {
var bcolor = new Array('000000','0000ff','006400','8b0000','ff0000','ffff00','00ff00','00ffff','ffdead','d3d3d3');
var clr = 'ffffff';
for(var i = 0; i < 10; i++){
if(i > 4) clr = '000000';
tb += '<input type="button" style="background:#'+bcolor[i]+';color:#'+clr+';width:68px" value="text" onclick="xxcolor(\'#'+bcolor[i]+'#'+clr+'\',3)" onmouseover="bgxolor(\'#'+bcolor[i]+'\',3)" />';
}
tb += '<br>';
}
for(var i = 0; i < 140; i++){
tb += '<input type="button" style="background:#'+hcolor[i]+'" onclick="xxcolor(\'#'+hcolor[i]+'\','+pal+')" onmouseover="bgxolor(\'#'+hcolor[i]+'\','+pal+')" />';
}
ths.nextSibling.innerHTML = "<div id='color_set' style='position:absolute;width:345px'>" + tb + "</div>";
ths.nextSibling.style.display = 'block';
wcolor = ths;
} else {
if(ths !== 3) mmo = null;
if(!ths || ths == 3) ths = wcolor;
ths.nextSibling.innerHTML = '';
ths.nextSibling.style.display = 'none';
wcolor;
bgxolor();
}}

function emoticw(n) {
var emocnt = emotic.length -1;
if(emocnt > 0) {
if(n == 2) {$('emoticon').style.display='block';emotc = 1;}
else {emotc = 0;if(n == 3) $('emoticon').style.display='';}
var emot = "";
for(var e = 0;e < emocnt;e++) {
if(n === 2) emot += "<li title=\"" + emotic[e] + "\" onclick=\"tag('','{ul style=\\'list-style-image:url(&#34;' + this.firstChild.src + '&#34;)\\'}{li}##{/li}{/ul}','plus',3,3);dsplnn(this.firstChild)\"><img alt=\"\" src=\"icon/emoticon/" + emotic[e] + "\" /></li>";
else emot += "<li title=\"" + emotic[e] + "\" onclick=\"tag('','{img alt=\\'\\' src=\\'' + this.firstChild.src + '\\' /}','plus','','');dsplnn(this.firstChild)\"><img alt=\"\" src=\"icon/emoticon/" + emotic[e] + "\" /></li>";
}
$('emoticon').innerHTML = emot;
} else $('emoticon').parentNode.style.display = 'none';
}

function xxcolor(xolor,pal) {
if(pal == 1) tag('{span style="color:' + xolor + '"}','{/span}','plus','',5);
else if(pal == 2) tag('{span style="background-color:' + xolor + '"}','{/span}','plus','',5);
else if(pal == 3) tag('{span style="background-color:' + xolor.substr(0,7) + ';color:' + xolor.substr(7) + '"}','{/span}','plus','',5);
popuu(3);
}

function bgxolor(xolor,pal) {
var bxo = ($('wzor').value == 'w')?obw.document.body:obj;
if(xolor) {
if(pal == 2) bxo.style.backgroundColor = xolor;
else bxo.style.color = xolor;
} else {
bxo.style.backgroundColor = '#FFF';
bxo.style.color = '#000';
}}

function popurl(ths, pal) {
if(ths && ths.nextSibling.innerHTML == '') {
if(wcolor) popuu(3);
wcolor = ths;
var nextf = mtxt();
var nextg = '';
if(!nextf || nextf.indexOf('http://') == -1) nextf = 'http://';
if(pal == 1) nextg = "tag(\"<a href=&#92;&#34;\" + wturl + \"&#92;&#34;>\",\"<\/a>\",\"plus\",\"\",5);";
else if(pal == 2) nextg = "tag(\"<img name=&#92;&#34;img580&#92;&#34; onclick=&#92;&#34;imgview(this.src)&#92;&#34; src=&#92;&#34;\" + wturl + \"&#92;&#34; />\",\"\",\"plus\",\"\",7);";
else if(pal == 3) nextg = "tag(\"<span><input type=&#92;&#34;hidden&#92;&#34; name=&#92;&#34;img580&#92;&#34; value=&#92;&#34;\" + wturl + \",0,300px,45px&#92;&#34;><\/span>\",\"\",\"plus\",\"\",7);";
else if(pal == 4) nextg = "tag(\"<embed=&#92;&#34;\" + wturl + \"&#92;&#34; type=&#92;&#34;application/x-shockwave-flash&#92;&#34; style=&#92;&#34;width:400px;height:300px&#92;&#34; />\",\"\",\"plus\",\"\",7);";
var nextl = "<div style='position:absolute;width:200px;height:40px'><input type='text' value='" + nextf + "' onkeyup='if(ekc == 13) {wturl=this.value;if(wturl && wturl != \"http://\") " + nextg + ";popurl()}' onmousedown='if(this.value==\"http://\") this.value=\"\"' style='float:left;width:150px;padding:4px'/>";
ths.nextSibling.innerHTML = nextl + "<a onmousedown='wturl=this.previousSibling.value;if(wturl && wturl != \"http://\") " + nextg + ";popurl()' class='butt3 bold8' style='float:left'>입력</a></div>";
ths.nextSibling.style.display = 'block';
setTimeout("if((nextf=wcolor.nextSibling) && (nextf=nextf.firstChild) && (nextf=nextf.firstChild)) nextf.select();",30);
} else popuu();
}

function tagw(ths) {
if($('tagdiv').innerHTML) $('tagdiv').innerHTML = '';
else azax('index.php?&id=' + setop[6] + '&order=2&tag=1','tagview(ajax)');
}

function tagview(val) {
val = val.substr(val.indexOf("</div>") +6);
val = val.substr(0,val.indexOf("<script"));
$('tagdiv').innerHTML = val.replace(/tago[^<]+<span/g,"tago(this)'").replace(/<\/span><\/a>/g,"</a>").replace(/<a href='\?id=([^']+)'>/g,"<a onclick=\"azax('index.php?id=$1','tagview(ajax)')\">");
}
function tago(ths) {
$$('wf_link6',0).value = $$('wf_link6',0).value + ths.innerHTML + ",";
}

function texresiz(ths, n) {
var th=parseInt(ths.style.height);
var nh=ths.scrollHeight;
if(setop[0] == '2' && setop[1] == '') nh -= 4;
if(n == 1) {
var texh = parseInt($('texx').style.height);
if(texh < nh) ths.style.height=nh + 13 + 'px';
else ths.style.height=texh + 'px';
} else if(th < nh) ths.style.height=nh + 13 + 'px';
}

function tdbck(ths) {
if(!window.open('exe.php?sls=' + setop[6] + ths.childNodes[1].value,'_blank')) {
if(confirm("팝업이 차단되어 있습니다.\n파일주소를 Find란에 입력합니까")) $('replace_a').value = ffldr + ths.childNodes[1].value;
}}

function tfdx() {
if(updoc != '') {
if(updoc.document.delup.delfile.value) {
pimg(1);
updoc.document.delup.submit();
setTimeout("updoc.fselct()",500);
} else alert("파일을 선택하세요");
}}

function tclick(ths) {
if(rdio[0].innerHTML) {
if(!ths) {ths = rdio[0];}
if(ctrk == true) {
var updel = updoc.document.delup.delfile.value;
if(updel.substr(0,2) != "^^") updel = "^^" + updel;
if(updel.substr(updel.length -2,2) != "^^") updel += "^^";
if(updel.indexOf("^^" + ths.firstChild.value + "^^") == -1) updoc.document.delup.delfile.value = updel + ths.firstChild.value + "^^";
} else {
for(var i=rdio.length -1;i >= 0;i--) {rdio[i].style.background = '';if(rdio[i].firstChild) rdio[i].firstChild.className = '';}
updoc.document.delup.delfile.value = ths.firstChild.value;
}
ths.style.background = '#DBDBDB';ths.firstChild.className = 'xsltd';
if(ths.className == 'emg') {
var imgbdr = ($('imgbordr').checked)? " style='border:" + $('imgbordr').value + "'":"";
$('previe').innerHTML = "<img name=\"img580\" onclick=\"imgview(this.src,0,0," + ths.firstChild.value + ")\" src=\"exe.php?sls=" + setop[6] + ths.childNodes[1].value + "\"" + imgbdr + " alt=\"\" \/>";
} else $('previe').innerHTML = "";
}
ctrk = false;
}

function startyrsz() {
$('rszdv').style.cursor="row-resize";
if($('prvw').value == '1') $('previw').style.display = 'none';
else if($('wzor').value == 'w') $('wsgwin').style.display = 'none';
ry = y;
}

function endyrsz() {
if($('rszdv')) {
$('rszdv').style.cursor="n-resize";
$("edht").value=parseInt($("contentdiv").style.height);
if($('prvw').value == '1') $('previw').style.display = 'block';
else if($('wzor').value == 'w') $('wsgwin').style.display = 'block';
ry = '';
}}

function resizeheight(w,h){
h= (h - parseInt(ry) + parseInt($('edht').value));
$('contentdiv').style.height = h + 'px';
$('texx').style.height = h + 'px';
if(parseInt($('content').style.height) < h) $('content').style.height = h + 'px';
}

function pimg(dx) {
var isfile;
if($('wzor').value == 'w') obw.focus();
else obj.focus();
var imgv = $('imgbordr').value;
imgv = (imgv != '')?"border:" + imgv:"";
var imgbder = (imgv != '')?"style=\"" + imgv + "\"":"";
var rlengt = rdio.length;
var ffldrr = "exe.php?sls=" + setop[6];
if(dx == 1) ffldrr = "exe\\.php\\?sls=" + setop[6];
var fflrr = "";
for(var i=0;i < rlengt;i++) {
if(rdio[i] && rdio[i].childNodes.length) {
if(rdio[i].firstChild.className == 'xsltd') {
fflrr = rdio[i].childNodes[1].value;
if(!rdio[i].className) {
if(dx == 1) seltrans("<a[^>]+" + ffldrr + fflrr + "[^>]+>.*</a>");
else tag("","<a target=\"_blank\" href=\"" + ffldrr + fflrr + "\">" + rdio[i].childNodes[2].innerHTML + "</a><br />","plus","","");
} else if(rdio[i].className == "emg") {
if(dx == 1) seltrans("<img[^>]+" + ffldrr + fflrr + "[^>]+>");
else tag("","<img name=\"img580\" " + imgbder + " onclick=\"imgview(this.src,0,0," + rdio[i].firstChild.value + ")\" src=\"" + ffldrr + fflrr + "\" alt=\"\" /><br />","plus","",7);
} else if(rdio[i].className.substr(0,2) == "wm") {
if(dx == 1) seltrans("<span><input[^>]+value=[\"']?" + fflrr + ",[^>]+></span>");
else {var as=(confirm("자동재생하시겠습니까?"))?1:0;
if((rdio[i].className == "wma" || rdio[i].className == "wmb") && confirm("높이 45px, 넓이 300px로 설정하시겠습니까")) {var au = "45px";var at = "300px";} else if(confirm((rdio[i].className == "wmc" || rdio[i].className == "wmd") && "높이 300px, 넓이 400px로 설정하시겠습니까")) {var au = "300px";var at = "400px";} else {var au = prompt("높이값을 입력하세요 (px 까지)","");var at = prompt("넓이값을 입력하세요 (px 까지)","");};tag("","<span><input type=\"hidden\" name=\"img580\" value=\"" + fflrr + "," + as + "," + at + "," + au + "," + rdio[i].className + "\" \/><\/span>","plus","","");}
} else if(rdio[i].className == "swf") {
if(dx == 1) seltrans("<embed[^>]+" + ffldrr + fflrr + "[^>]+>");
else tag("","<embed src=\"" + ffldrr + fflrr + "\" type=\"application/x-shockwave-flash\" style=\"width:400px;height:300px;" + imgv + "\" /><br />","plus","","");
}
isfile = 1;
}}}
if(!isfile) alert('파일을 선택하세요');
}

function memo(n) {
var rtv = '';
if($('wzor').value == 'w') rtv = obw.document.body.innerHTML;
else if(n) {
if($('wrwn').value == 1) rtv = obj.value.replace(/[\r\n]/g, "");
else rtv = obj.value.replace(/[\r]?\n/g, "<br>");
$('wrwn').value = 0;
} else rtv = obj.value;
return rtv;
}

function sharp() {
oselt = '##';
setTimeout("findtxt(2)",10);
}

function prevw(n) {
if($('previw').style.display == 'block') {
$('prvw').value = '0';
$('aprevw').innerHTML = '미리보기';
$('previw').style.display = 'none';
if($('wzor').value == 'w') {
$('wsgwin').style.display = 'block';
$('texx').style.display = 'none';
} else {
$('wsgwin').style.display = 'none';
$('texx').style.display = 'block';
}} else {
$('aprevw').innerHTML = ((n == 1 || $('wzor').value == 'h')?'미리보기해제':'부분소스해제');
var doxt = ((n == 1)? memo(1):(($('wzor').value == 'h')? mtxt().replace(/\n/g,"<br>"):mtxt().replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;")));
$('prvw').value = '1';
$('texx').style.display = 'none';
$('wsgwin').style.display = 'none';
$('previw').style.display = 'block';
var doc = $('previw').contentWindow.document;
doc.open();
doc.write("<html>");
doc.write("<head>");
doc.write("<link rel='stylesheet' type='text/css' href='skin/default/style.css' />");
doc.write("<script type='text/javascript'>function toggle(ths){ths.style.display=(ths.style.display == 'none')?'block':'none'}<\/script>");
doc.write("</head>");
doc.write("<body style='background:#FAFEFF;margin:5px'>");
doc.write("<div class='bdo'>");
doc.write(doxt);
doc.write("</div>");
doc.write("</body>");
doc.write("</html>");
doc.close();
}
}

function mtxt(mxt) {
var mtmt = "";
if($('wzor').value != 'w') {
if(obj.createTextRange && obj.currentPos && obj.currentPos.text && obj.currentPos.text != wturl) {if(obj.value.length - obj.currentPos.text.length > 4) mtmt = obj.currentPos.text;}
else if(obj.selectionEnd && obj.selectionStart != obj.selectionEnd) mtmt = obj.value.substring(obj.selectionStart, obj.selectionEnd);
} else {
if(setop[0] == '1' && setop[1] != 'ie11') {
obw.focus();
if(mmo == null && obw.document.selection) mmo = obw.document.selection.createRange();
if(mmo != null && mxt != 9) mtmt = mmo.htmlText;
} else {
try{
if(mmo == null) {if(obw.getSelection) mmo = obw.getSelection().getRangeAt(0);else if(obw.document.getSelection) mmo = obw.document.getSelection().getRangeAt(0);else obw.focus();}
if(mmo != null && mxt != 9) {var node = document.createElement('div');
node.appendChild(mmo.cloneContents());
mtmt = node.innerHTML;
}} catch(e) {}
}}
if(!mtmt) {
if(mxt == 5) mtmt = "##";
if(mxt != 7) mtmt = "";
}
if(mxt != 9) return mtmt;
}

function tag(prefix, postfix, tagx, tagg, ttag) {
var vurl = "";
prefix = prefix.replace(/{/g,"<").replace(/}/g,">").replace(/\\'/g,'"');
postfix = postfix.replace(/{/g,"<").replace(/}/g,">");
if($('wzor').value != 'w') {
if(prefix == '<ul>' || prefix == '<ol>') {
prefix = prefix + '<li>';
postfix = '</li>' + postfix;
}
if(obj.createTextRange && obj.currentPos && obj.currentPos.text && obj.currentPos.text != wturl) {
		obj.currentPos.text = prefix + obj.currentPos.text + postfix;
		obj.focus();
} else if(obj.selectionEnd && obj.selectionStart != obj.selectionEnd) {
	var s1 = obj.value.substring(0, obj.selectionStart);
	var s2 = obj.value.substring(obj.selectionStart, obj.selectionEnd);
	var s3 = obj.value.substring(obj.selectionEnd);
	obj.value = s1 + prefix + s2 + postfix + s3;
} else obj.value = prefix + postfix + obj.value;
} else {
if(tagx == 'plus'){
if(!mmo) {mmo = null;mtxt(9);}
var mmtxt = mtxt(ttag);
if(tagg == 'x') mmtxt = mmtxt.replace(/<(br|p|div)>/gi,'(crlf)').replace(/<[^>]*>/g,'').replace(/\(crlf\)/g,'<br>');
else mmtxt = prefix + mmtxt + postfix;
obw.focus();
if(setop[0] == '1' && setop[1] != 'ie11') mmo.pasteHTML(mmtxt);
else if(mmo != null) {mmo.deleteContents();mmo.insertNode(mmo.createContextualFragment(mmtxt));}
if(ttag == 3) sharp();
if(tagg === 3) emoticw(3);
mmo = null;
} else {
obw.focus();
obw.document.execCommand(tagx,ttag,ttag);
}
}
if(tagg == 't' && ttag) dsplnn(ttag);
}

function dsplnn(ttag) {
ofen = ttag.parentNode.parentNode;if(!!ofen) {ofen.style.display='none';setTimeout('ofen.style.display="";',300);}
}

function xhtmltag(ths) {
if($('wzor').value == 'w') tag('','','plus','x','');else seltrans('x_tag');
dsplnn(ths);
}

function seltrans(str) {
	var old = "";
	var neo = "";
	var old__ = "";
	var old_ = "";
	var neo__ = "";
	var neo_ = "";
if(str == 'w3c') {
$$('saved',0).value = '';
old__ = obj.value;
old = old__.indexOf('<');
while(old != -1) {
old = old__.indexOf('<');
neo = old__.indexOf('>');
neo_ += old__.substr(0,old);
neo__ = old__.substring(old,neo + 1).replace(/ ([a-z]+)=([^'"> ]+)/gi," $1='$2'");
neo__ = neo__.replace(/ (width|height|cellpadding|cellspacing)='([0-9]+)'/gi," $1='$2px'");
old__ = old__.substr(neo + 1);
old_ = neo__.match(/[<\/ '"]+[-A-Z]+[='": >]/g);
if(old_) {
for(var i=0;i < old_.length;i++) {
neo__ = neo__.replace(new RegExp(old_[i],'g'),old_[i].toLowerCase());
}
}
neo_ += neo__;
}
old__ = neo_ + old__;
neo_ = '';
old = old__.split(/<p>/g);
old_ = old.length;
for(var i=0;i < old_;i++) {
neo_ += old[i].replace(/<\/p>/,"<br />");
}
if(neo_.indexOf('<embed') != -1 && neo_.indexOf('</embed>') == -1) neo_ = neo_.replace(/<embed([^>]+[^\/])>/g,"<embed$1 />");
neo_ = neo_.replace(/<(br|input|img|hr)([^>\/]*)>/g,"<$1$2 />");
if(neo_.indexOf('<textarea') != -1 && neo_.indexOf('</textarea>') == -1) neo_ += "</textarea>";
if(neo_.indexOf('<xmp') != -1 && neo_.indexOf('</xmp>') == -1) neo_ += "</xmp>";
if(neo_.indexOf('<pre') != -1 && neo_.indexOf('</pre>') == -1) neo_ += "</pre>";
if(wlevel != '9') {neo_ = neo_.replace(/<([\/]?)(script)/g,"&lt;$1$2");}
obj.value = neo_.replace(/<(br|hr)>/g,"<$1 />").replace(/<img([^>]+[^\/])>/g,"<img$1 />");
} else {
	if(str == 'nl2br') {
	old = /[\r]/gi;
	neo = "";
	old_ = /[\n]/gi;
	neo_ = "<br />";
	} else if(str == 'br2nl') {
	old = /<br>/gi;
	neo = "\n";
	old_ = /<br[ \/]*>/gi;
	neo_ = "\n";
	} else if(str == 'nl+br') {
	old = /[\n]/gi;
	neo = "\n<br />";
	} else if(str == 'br+nl') {
	old = /<br/gi;
	neo = "\n<br";
	} else if(str == 'br-') {
	old = /<br[ /]*>/gi;
	neo = "";
	} else if(str == 'nl-') {
	old = /[\r\n]/g;
	neo = "";
	} else if(str == 'lt') {
	old = /&/gi;
	neo = "&amp;";
	old_ = /</gi;
	neo_ = "&lt;";
	old__ = />/gi;
	neo__ = "&gt;";
	} else if(str == 'lt-') {
	old = /&lt;/gi;
	neo = "<";
	old_ = /&gt;/gi;
	neo_ = ">";
	old__ = /&amp;/gi;
	neo__ = "&";
	} else if(str == 'x_gtlt') {
	old = />[\t ]+</g;
	neo = "><";
	old_ = />[\s]+</g;
	neo_ = ">\n<";
	} else if(str == 'x_script') {
	old = /<\/script>/gi;
	neo = "\x1b";
	old_ = /<script[^\x1b]+\x1b/gi;
	neo_ = "";
	old__ = /[\x1b]/g;
	neo__ = "";
	} else if(str == 'x_gt') {
	old = />[\t ]+/g;
	neo = ">";
	old_ = />[\s]+/g;
	neo_ = ">\n";
	} else if(str == 'x_lt') {
	old = /[\t ]+</g;
	neo = "<";
	old_ = /[\s]+</g;
	neo_ = "\n<";
	} else if(str == 'x_p') {
	old = /<p[^>]+>/gi;
	neo = "";
	old_ = /<\/p>/gi;
	neo_ = "\r\n";
	} else if(str == 'x_px') {
	old = /<p[^>]+>/gi;
	neo = "";
	old_ = /<\/p>/gi;
	neo_ = "";
	} else if(str == 'x_img') {
	old = /<img[^>]+>/gi;
	neo = "";
	} else if(str == 'x_span') {
	old = /<span[^>]+>/gi;
	neo = "";
	old_ = /<\/span>/gi;
	neo_ = "";
	} else if(str == 'x_font') {
	old = /<font[^>]+>/gi;
	neo = "";
	old_ = /<\/font>/gi;
	neo_ = "";
	} else if(str == 'x_div') {
	old = /<div[^>]+>/gi;
	neo = "\r\n";
	old_ = /<\/div>/gi;
	neo_ = "\r\n";
	} else if(str == 'x_tag') {
	old = /<[^>]*>/gi;
	neo = "";
	} else if(str == 'x_empty') {
	old = /<[a-z]+[^>]*>[\s]*<\/[a-z]+>/gi;
	neo = "";
	} else if(str == 'edtb') {
	$('wrwn').value = 1;
	old = /[\n]/gi;
	neo = "\n<br />";
	old_ = /><t/gi;
	neo_ = ">\r\n<T";
	old__ = /><\/t/gi;
	neo__ = ">\r\n</T";
	} else if(str == 'eddv') {
	old = /><div/gi;
	neo = ">\r\n<DIV";
	old_ = /><\/div/gi;
	neo_ = ">\r\n</DIV";
	} else if(str == 'replace') {
	old = $('replace_a').value;
	if($('regular').checked != true) old = old.replace(/([\(\)\{\}\[\]\.\?\+\*\|\^\$\\])/gi,"\\$1");
	old = new RegExp(old,'gi');
	neo = $('replace_b').value;
	} else if(str != '') {
	old = new RegExp(str,'gi');
	neo = "";
	}
if(old != '') {
if($('wzor').value != 'w') {
if(str.indexOf('br') != -1) $('wrwn').value = 0;
if(obj.createTextRange && obj.currentPos && obj.currentPos.text) {
	if(str == 'lowcase') obj.currentPos.text = obj.currentPos.text.toLowerCase();
	else if(str == 'upcase') obj.currentPos.text = obj.currentPos.text.toUpperCase();
	else obj.currentPos.text = obj.currentPos.text.replace(old, neo).replace(old_, neo_).replace(old__, neo__);
	obj.focus();
} else if(obj.selectionEnd && obj.selectionStart != obj.selectionEnd) {
	var s1 = obj.value.substring(0, obj.selectionStart);
	var s2 = obj.value.substring(obj.selectionStart, obj.selectionEnd);
	var s3 = obj.value.substring(obj.selectionEnd);
	if(str == 'lowcase') obj.value = s1 + s2.toLowerCase() + s3;
	else if(str == 'upcase') obj.value = s1 + s2.toUpperCase() + s3;
	else obj.value = s1 + s2.replace(old, neo).replace(old_, neo_).replace(old__, neo__) + s3;
} else {
	if(str == 'lowcase') obj.value = obj.value.toLowerCase();
	else if(str == 'upcase') obj.value = obj.value.toUpperCase();
	else obj.value = obj.value.replace(old, neo).replace(old_, neo_).replace(old__, neo__);
}
if(str == 'edtb') seltrans('eddv');
else if(str != 'replace') repeatt(1);
} else obw.document.body.innerHTML = memo(0).replace(old, neo);
}
}
}

function obwdx() {
var obwdoc = obw.document.body.innerHTML;
obwdoc = obwdoc.replace(/ sab="[0-9]+">/gi,">").replace(/<\/P><P>/gi, "\n").replace(/<\/div><div>/gi, "\n").replace(/<br>/gi, "\n");
obwdoc = obwdoc.replace(/<span[^>]+><\/span>/gi,"").replace(/<span[^>]+>[\r\n]<\/span>/gi,"\n").replace(/[\r\n]<\/span>/gi,"</span>\n");
obwdoc = obwdoc.replace(/<font[^>]+><\/font>/gi,"").replace(/<font[^>]+>[\r\n]<\/font>/gi,"\n").replace(/[\r\n]<\/font>/gi,"</font>\n");
return obwdoc;
}

function wsghtm(wz) {
if(ismobile != '2') {
if($('prvw').value == '1') prevw(1);
oselt = (wz === 2 && setop[1] != 'opera')? mtxt():'';
if(!!oselt) oselt = oselt.replace(/<br[^>]*>/gi, "\n").replace(/<[^>]+>/g, "");
if($('wzor').value == 'w') {
$('wzor').value = 'h';
$('dehtml').innerHTML = 'wswg';
obj.value = obwdx();
$('html').style.display = 'block';
$('wzwg').style.display = 'none';
$('wsgwin').style.display = 'none';
$('texx').style.display = 'block';
$('selsosprw').title = '선택 영역 부분 미리보기';
$('selsosprw').innerHTML = '부분미리보기';
if(setop[0] == '1') obj.focus();
texresiz($('content'),1);
mmo = null;
} else {
obw.document.body.innerHTML = memo(1);
$('wzor').value = 'w';
$('dehtml').innerHTML = 'html';
$('html').style.display = 'none';
$('wzwg').style.display = 'block';
$('wsgwin').style.display = 'block';
$('texx').style.display = 'none';
$('selsosprw').title = '선택 영역 부분 소스보기';
$('selsosprw').innerHTML = '부분소스보기';
obw.focus();
}
if(!!oselt) {$('replace_a').focus();findtxt(2);if(setop[0] == '2' && setop[1] != 'chrome') findtxt(2);oselt = '';}
}}

function bksecond(sn) {
if(sn) {
var snt = '';
if(bksec === 1 && sn > 1) {
sn -= 1;setTimeout('bksecond(' + sn + ')',1000);
snt = "-" + sn;
} $('tpsv').innerHTML = "임시저장" + snt;
} else {
bksec -= 1;
if(bksec === 0) repeatt(0);else if(bksec === 1) setTimeout('bksecond(6)',1000);
setTimeout('bksecond()',6000);
}}

function repeatt(n) {
var param;
if(n == 2) {$$('ckdoubled',0).value = '3';ckfmr = Array(document.wform,3);}
if(ismobile != 2) {
if($('wzor').value == 'w') {if(obw.document) param = obw.document.body.innerHTML.replace(/[\r\n]/g,"");}
else param = memo(1);
if(param) {
if(param.length > 10 && $$('saved',0).value != param) {
$$('saved',0).value = param;
document.svfm.submit();
$$('saved',0).value = param;
param = 3;
var today = new Date();
$('tpsv').title = "임시저장시간 :: " + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();;
if(setop[1] == 'ie6') $('tpsv').style.width = '80px';
}}
if(n == 2 && param != 3) {
$$('saved',0).value = '';
document.svfm.submit();
}
if(n != 2) bksec = 5;
$$('ckdoubled',0).value = '';
}}

var iefn = 0;
function findtxt(alrt) {
if(!alrt) oselt = $('replace_a').value;
if(setop[0] == '1') {
if(tath != oselt) {iefn = 0;tath = oselt;}
if($('wzor').value != 'w') var tx=obj.createTextRange();
else var tx=obw.document.body.createTextRange();
for(var i=0;i <= iefn && (found=tx.findText(oselt)) != false; i++){tx.moveStart("character",oselt.length);tx.moveEnd("textedit");} if(found){tx.moveStart("character",-oselt.length);tx.findText(oselt);tx.select();tx.scrollIntoView();iefn++;} else {iefn = 0;if(alrt != 2) alert("검색결과가 없습니다.");}
} else if(setop[1] != 'opera') {
if($('wzor').value != 'w') {document.createRange();window.find(oselt, true, true, true, false, true, false);}
else {obw.document.createRange();if(!obw.find(oselt, true, true, true, false, true, false) && alrt != 2) alert("검색결과가 없습니다.");}
} else alert('opera는 지원안됩니다.');
}

function save_pos(obj) {
try {
if(obj.createTextRange && document.selection) obj.currentPos = document.selection.createRange().duplicate();
} catch(e) {}
}

function bysaved() {
if(confirm('임시저장된 내용을 불러옵니까')) {
if($('wzor').value == 'w')  obw.document.body.innerHTML = $$('saved',0).value;
else obj.value = $$('saved',0).value;
} else repeatt(1);
}

function wcancel() {
if(confirm('이 페이지를 벗어나시겠습니까','')){
if(ufdell()) {
$('gout').value='2';
var wurl = "index.php?id=" + setop[6];
if(document.wform.no) wurl += "&amp;no=" + document.wform.no.value;
rplace(wurl);
}}}

function ufdell() {
if(updoc) {
var delf = '';
if(document.wform.reply.value == 'new') {
if(rdio[0].innerHTML) {
for(var i=rdio.length-2;i >= 0;i--) {
delf += rdio[i].firstChild.value + "^^";
}
if(delf != '') {
$('fuplist').innerHTML = '';
updoc.document.delup.delfile.value = "^^" + delf;
}}} else updoc.document.delup.delfile.value = '';
updoc.document.delup.dxess.value = '3';
updoc.document.delup.submit();
if(delf != '') alert("업로드한 파일은 전부 삭제되었습니다\n");
} else {
$$('saved',0).value = 'dxess';
document.svfm.submit();
}
return true;
}

function parentt(ths,val) {
var rtn = null;
while(rtn == null) {
if(ths.parentNode.tagName.toLowerCase() == val) rtn = ths.parentNode;
else if(ths.parentNode.tagName.toLowerCase() == 'body') return false;
else ths = ths.parentNode;
}
return rtn;
}

function fndresize(n) {
var asze = parseInt($('replace_a').scrollHeight);
asze = (n == 1)? asze + 40:asze - 40;
if(asze > 16) {
$('replace_a').style.height = asze + "px";
$('replace_b').style.height = asze + "px";
}}

window.onbeforeunload = function(){
var goux = $('gout').value;
if(goux != '3') {
repeatt(1);
$('gout').value = '3';
if(goux != '2') {
ufdell();
return "\n \n";
}}}
document.onreadystatechange = function(){if(document.readyState == "complete" && !sessno) setup();else if(document.readyState) recize(document.documentElement.offsetWidth);}
setTimeout("if(!sessno) setup()",1000);
window.onresize = recize;
window.onunload = function(){window.onbeforeunload();}
