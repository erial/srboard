
var wwin;
var siht;
var tath;
var pxxx = self;
var brwsrw = document.documentElement.clientWidth;
var thtck;
var thtcg;
var sessno;
var tpn = 0;
var nwx = 0;
var tabchng = 0;
var newxchng;
var inty = 10;
var intx = 20;
var x, y;
var ekc = 0;
var ajax = '';
var px, py;
var ry = '';
var pretxt = new Array();
var newtxt = new Array();
var ajaxx;
var isazax = '';
var stopt = 0;
var stopn = 0;
var exmus;
var pview;
var isopo = 0;
var ctrk = false;
var cnw = '';
var ajaxbusy = 0;
var mdiv;
var rpck = '';
var srchecked = 1;
var moux = '';
var xxn = 0;
var ono = 0;
var ckfmr = Array('','');
var vtrpc = Array();
var stbLR67 = 0;

function $(id) {return document.getElementById(id);}

function keydow(e) {
if(setop[0] == '2') {ekc = e.which;ctrk = e.ctrlKey;}
else if(setop[0] == '1') {ekc = event.keyCode;ctrk = event.ctrlKey;}
if(ctrk && window.keyctrl) keyctrl();
}

function mouseclicked(e) {
var etype;
if(setop[0] == '1') {exmus = event.srcElement;etype = event.type;}
else {exmus = e.target;etype = e.type;}
var ename = exmus.name;
var extag = exmus.tagName.toLowerCase();
if(ename == 'antispam' && etype == 'mouseout') chkatcode(0,exmus);
if(!ename) ename = exmus.className;
if(extag == 'a') {
if(ename && ename.substr(0,2) == 'pv') {
if(etype == 'mouseover') {
if(ename.substr(2,1) == 'x') {preview(exmus,ename.substr(2));if(exmus.href=='' && exmus.rel) exmus.href= "index.php?id=" + exmus.rel.replace(",","&no=");}
else if(ename.substr(2,1) == 't') {exmus.title = " \r\n  ( " + exmus.rel.replace(","," ) 개의 글, ( ") + " ) 번 검색되었습니다.  \r\n ";exmus.onclick=function(){tago(this);};}
else if(ename == 'pvmc') {var exmusr = exmus.rel.split(",");exmus.href = "index.php?id=" + setop[6] + "&date=" + exmusr[0];preview(' 게시물 ' + exmusr[1] + '개','xx',80);}
else if(ename == 'pv00') {var exmusr = exmus.parentNode.nextSibling;if(exmusr.tagName.toLowerCase() == 'span' && exmusr.firstChild.className == 'rp') exmusr = exmusr.firstChild.innerHTML;else exmusr = 0;pretxt['00'] = Array("","","",exmusr,"");preview('00','',exmus);}
else preview(ename.substr(2),'',exmus);
} else preview();
} else if(!!(ename = exmus.onclick) && (ename = ename.toString()) != '') {
if(ename.indexOf('arrange(') != -1) {
if(etype == 'mouseover') exmus.title = exmus.innerHTML + ' 순서로 정렬';
}}} else if(extag == 'img' && ename && ename.substr(0,2) == 'pv') {if(etype == 'mouseover') preview(ename.substr(2),'',exmus);else preview();}
if(!!thtcg) {
if(ename && ename == 'thmtxt') {if(etype == 'mouseout') thmtxt(exmus,etype);}
else if(ename && ename == 'thumb100') {if(etype == 'mouseover') thmtxt(exmus.nextSibling,etype);}
else if(exmus != thtcg && extag != 'span' && thtcg.className == 'thmtxt') thmtxt(thtcg,'mouseout');
}}

function mousemov(e){
if(pview) {
  if(setop[0] == '2'){
   y = e.pageY;
   x = e.pageX;
	} else if(setop[0] == '1'){
   y = event.clientY + scrbody(1);
   x = event.clientX + scrbody(2);
	}
if(wopen == 3 && eval(pview) && eval(brwsrw)) {
var pvsw = parseInt(pview.style.width) + 30;
pview.style.top  = y + inty + 'px';
if(x + intx + pvsw > brwsrw) pview.style.left = brwsrw - pvsw + scrbody(2) + 'px';
else pview.style.left = x + intx + 'px';
} else pview = $("pview");
if(ry != '' && window.resizeheight) resizeheight(x,y);
}}

document.onmousemove = mousemov;
document.onkeydown = keydow;
document.onmouseover = mouseclicked;
document.onmouseout = mouseclicked;
document.onmouseup = function() {ry='';px=0;py=0;}

function imgview(sur, im, swth, fno) {
var imgee = $('img');
if(sur == 0) {
inty = 10;
intx = 20;
wopen = 1;
imgee.style.display = 'none';
if($('curtain')) $('curtain').style.display='none';
} else {
if(wopen == 2) imgview(0);
if(im) {
if(im == 5) im = 4;
if(im == 4) imgee.style.top = y - 20 + 'px';
else {imgee.style.top = y - 10 + 'px';if(im == 9) sur = sur.replace(/m20/,"m80");}
imgee.style.left = x + 15 + 'px';
} else imgee.style.top = scrbody(1) + 100 + 'px';
if(im == 4) {
if(!swth) swth = 500;
var cwth = document.documentElement.clientWidth - swth - 20;
if(cwth <  x) imgee.style.left = cwth + 'px';
sur = "<div style='width:" + (swth + 12) + "px;'><a class='im4' target='_blank' href='" + sur + "'>LINK</a><iframe class='im4' src='" + sur + "' style='width:" + swth + "px;height:" + swth + "px' scrolling='no' frameborder='0'></iframe></div>";
}
if(im == 2 || im == 4) imgee.innerHTML = sur;
else {
var imgin = "";
if(!im) {
if(sur.indexOf('exe.php?sls=' + setop[6] + '/fno/') != -1) {imgin = "<a target='exe' href='" + sur.replace("/fno/","/down/") + "' onclick='imgview(0)'>다운로드</a>";}
else if(fno != '' && sur.indexOf('exe.php?id=' + setop[6]) != -1) {imgin = "<a target='exe' href='exe.php?sls=" + setop[6] + "/down/" + fno + "' onclick='imgview(0)'>다운로드</a>";}
imgee.innerHTML = "<table cellspacing='1px' cellpadding='0' id='imgopen'><tr><th>" + imgin + "</th><th><a target='_blank' href='" + sur + "' onclick='imgview(0)'>새창으로</a></th><th><input type='button' value='닫기' onclick='imgview(0)' /></th></tr><tr><td colspan='3'><img onclick='imgview(0)' class='img' src='" + sur + "' onload='imglocat(this)' alt='' style='max-width:" + setop[7] + "px' /></td></tr></table>";
if($('curtain')) $('curtain').style.display='block';
} else imgee.innerHTML = imgin + "<img onclick='imgview(0)' class='img' src='" + sur + "' alt='' style='max-width:" + setop[7] + "px' />";
}
imgee.style.display = 'block';
setTimeout('wopen = 2',300);
}}

function preview(no, xx, pww) {
if(pview) {
$("img").style.display = 'none';
pview = $('pview');
if(xx == 'xz') {no = no.innerHTML + '<br />' + no.parentNode.nextSibling.innerHTML;xx = 'xx';}
else if(xx == 'xy') {no = no.innerHTML;xx = 'xx';}
inty = 10;
intx = 20;
	if(no) {
	wopen = 3;
	if(xx == 'xx') {pview.innerHTML = no;
	if(pww) pview.style.width = pww + 'px';
	} else if(pretxt[no]) {
	if(pww && !pretxt[no][1]) pretxt[no][1] = pww.innerHTML;
	var preimg = '';
	if(pretxt[no][0] != "") preimg = "<img src='" + pretxt[no][0] + "' class='gthumb_100' alt='' />";
	if(pretxt[no][2] == '' && pretxt[no][4] == '') pview.innerHTML = preimg + "<div class='prsjt'>" + pretxt[no][1] + " <span class='r7'>[" + pretxt[no][3] + "]<\/span><\/div><span class='n8'> " + pww.href + "<\/span>";
	else pview.innerHTML = preimg + "<div class='prsjt'>" + pretxt[no][1] + "<\/div><span class='n8'> by " + pretxt[no][2] + "<\/span> <span class='r7'>[" + pretxt[no][3] + "]<\/span><br \/>" + pretxt[no][4];
	}
	if(xx == 'xx' || pretxt[no]) {if(x || y) {
	if(setop[0] == '1') pview.style.filter = 'alpha(opacity=94)';
	else pview.style.opacity = '.94';
	pview.style.top=y+10 +'px';pview.style.left=x+20 +'px';pview.style.display = 'block';
	}}} else {
	wopen = 1;
	pview.style.width = setop[3] +'px';
	pview.innerHTML = "";
	pview.style.display = 'none';
}}}

function opeclo(A) {
if($(A).style.display == 'none') {
$(A).style.display = 'block';
if(A == 'tag') $(A).contentWindow.location.replace('include/tag.php?id=' + setop[6] + '&tag=1');
}
else $(A).style.display = 'none';
}

function wwname(mane,no,targ,url,is80) {
$("img").style.display = 'none';
var namee = "<div class='prev' id='wname' style='display:block;'>";
if(no > 0) {
if(is80 == '1') namee += "<div><img src='icon/m80_" + no + "' class='pu80' /></div>";
if(setop[6] != '') {
namee += "<div><a href='#none' onclick='" + targ.substr(1) + ".locato(\"m\"," + no + ")'><span>■</span> 게시판검색</a></div>";
namee += "<div><a href='#none' onclick='" + targ.substr(1) + ".locato(\"c\"," + no + ")'><span>■</span> 덧글검색</a></div>";
}
if(setop[5] == '1') namee += "<div><a href='#none' onclick=\"send('memo', '" + no + "','" + mane + "')\"><span>■</span> 쪽지보내기</a></div>";
if(setop[4] == '1') namee += "<div><a href='#none' onclick=\"send('mail', '" + no + "','" + mane + "')\"><span>■</span> 메일보내기</a></div>";
namee += "<div><a href='member.php?mno=" + no + "' target='_blank'><span>■</span> 회원로그</a></div>";
} else if(setop[6] != '') {
namee += "<div><a href='#none' onclick='" + targ.substr(1) + ".locato(\"keyword\",\"" + mane + "\",\"&amp;search=n\")'><span>■</span> 게시판검색</a></div>";
namee += "<div><a href='#none' onclick='" + targ.substr(1) + ".locato(\"keyword\",\"" + mane + "\",\"&amp;search=r\")'><span>■</span> 덧글검색</a></div>";
}
if(url) namee += "<div><a target='_blank' href='" + url + "'><span>■</span> 홈페이지</a></div>";
namee += "</div>";
imgview(namee,2);
}

function imglocat(ths) {
$('img').style.left = (setop[0] == '1')?(parseInt(window.document.documentElement.clientWidth)-parseInt(ths.width))/2+'px':(parseInt(window.innerWidth)-parseInt(ths.width))/2+'px';
}

function popup(url, wt, ht, iee, ps) {
if(iee && setop[0] != '1') return false;
else url = url.replace(/&amp;/g,"&");
if(!ps && setop[0] == '1') {
var pten = (setop[1] == 'ie6')? 8:0;
wt = wt + 7 + pten;
ht = ht + 27 + pten;
if(!iee || iee == '0') url = 'admin.php?fram='+url;
if(!window.showModelessDialog(url, window,  'dialogWidth:'+ wt +'px;dialogHeight:'+ ht +'px; resizable:Yes; center:Yes; status:No; help: No; scroll:' + ((iee)?'Yes':'No') +'; center:Yes')) wwin = 3;
} else {
wt += 7;
ht += 26;
if(!window.open(url,'_blank','location=no,resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,width='+ wt +'px,height='+ ht +'px,left='+ ((screen.width - wt) / 2) +'X,top='+ ((screen.height - ht) / 2) +'Y')) wwin = 3;
}
if(wwin == 3) {if(confirm("팝업이 차단되어 있습니다. 새창으로 띄우시겠습니까")) nwopn(url);wwin = 1;}
}

function send(mm, no, to) {
if(mm == 'memo') popup('exe.php?send='+mm+'&no='+no+'&to='+to,300,200,0);
else popup('exe.php?send='+mm+'&no='+no+'&to='+to,300,300,0);
}

function read(read) {
if(read == 'get'||read == 'post') popup('exe.php?memo='+read,500,500,0);
else popup(read,850,650,0);
}

function locato(wher,val,rest) {
if(!rest) rest = '';
if(wher != 'p' && (!rest || rest.indexOf('p=') == -1)) rest = rest + '&amp;p=1';
var what = 1;
var dcloc = location.search.slice(1).replace(/[&]no=[^&]*/gi,'').replace(/[&]p=[^&]*/gi,'');
if(wher == 'type' && val == 'k') dcloc = dcloc.replace(/[&]arrange=[^&]*/gi,'').replace(/[&]desc=[^&]*/gi,'');
var pwher = dcloc.indexOf('&'+wher+'=');
if(pwher != -1) {
pwher = dcloc.substr(pwher + wher.length + 2);
if(pwher.indexOf('&') != -1) pwher = pwher.substr(0,pwher.indexOf('&'));
else if(pwher.indexOf('#') != -1) pwher = pwher.substr(0,pwher.indexOf('#'));
if(pwher == val) what = 2;
pwher = new RegExp('&'+wher+'=[^&]*','gi');
dcloc = dcloc.replace(pwher,'');
}
if(what == 1) dcloc += '&' + wher + '=' + val;
rhref('index.php?' + dcloc + rest);
}

function opencal(ths) {
var targt = $('calendar').getElementsByTagName('ul');
for(var i=targt.length -1;i >= 0;i--) {
if(targt[i].parentNode == ths) targt[i].className = 'onload';
else targt[i].className = '';
}}

function xcroll(tht, thv) {
thv += 4;
if(ekc == 13 ||ekc == 8 ||ekc == 46) {
if((setop[0] == '2' || setop[1] == 'ie11') && ekc != 13)  tht.style.height = thv + 'px';
var tch=tht.scrollHeight;
if(setop[1] == 'chrome') tch -= 20;
else if(setop[1] == 'ie11') tch -= 3;
if(tch > thv) {
if(ekc == 13) {tht.style.height=tch + 14 + 'px';return true;}
else if(ekc == 8 ||ekc == 46) {tht.style.height=tch + 'px';return true;}
}}}

function startax(param) {
if(ajaxbusy == 1) setTimeout("startax(\"" + param + "\")",100);
else {ajaxbusy = 1;
var srbhttp = false;
try {srbhttp = new XMLHttpRequest();}
catch(e) {try {srbhttp = new ActiveXObject("Msxml2.XMLHTTP");}
catch(e) {try {srbhttp = new ActiveXObject("Microsoft.XMLHTTP");}
catch(e) {return false;}}}
if(srbhttp) {
param = param.replace(/%/g,"%25").replace(/\+/g,"%2B") + "&ajax=1";
srbhttp.open("POST", param, true);
srbhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
srbhttp.onreadystatechange = function(){
if(srbhttp.readyState=='4' && srbhttp.status=='200') {
	ajaxbusy = 0;
	ajax = srbhttp.responseText;
	delete srbhttp;
}}
srbhttp.send(param);
}}}

var azx1 = false;
var azx2 = false;
function azax(param,gkatn) {
if(param) {
if(isazax || ajax) {
if(azx1 != false && azx1 != param) {azx2=param;setTimeout("azax(azx2,\""+gkatn+"\")",600);}
else {azx1=param;setTimeout("azax(azx1,\""+gkatn+"\")",300);}
} else {
if(azx1==param) azx1 = false;
isazax = gkatn;
ajax = 'azax';
startax(param);
azax();
}} else if(ajax == 'azax') setTimeout("azax()",30);
else if(ajax != '') {
if(isazax) {
if(isazax == 9 && typeof(isazax) == 'number') eval(ajax);
else eval(isazax);
isazax = '';
}
ajax = '';
}}

function scrbody(n) {
var docbody = (setop[1] == 'chrome')? document.body:document.documentElement;
if(n == 1) var val = docbody.scrollTop;
else var val = docbody.scrollLeft;
return val;
}

function chbase(str) {
var str_1 = '';
var str_2 = '';
for(var i=str.length -1;i >= 0;i--){
str_1 += (str.charCodeAt(i) + sessno).toString(34);
}
for(var i=str_1.length -1;i >= 0;i--){
str_2 += (str_1.charCodeAt(i)).toString(18);
}
return str_2;
}
function convertbase(ths) {
if(sessno === '') {if(confirm("새로고침이 필요합니다. 새로고침하시겠습니까")) location.reload();else return false;}
if(ths.username||ths.password) {
ths.username_3.value = chbase(ths.username.value);
ths.password_3.value = chbase(ths.password.value);
ths.username.value = '';
ths.password.value = '';
}
ths.submit();
}
function nwopn(purl){
purl = purl.replace(/amp;/g,'');
if(!window.open(purl,'_blank')) {
if(confirm('팝업이 차단되었습니다.페이지 이동하시겠습니까')) location.replace(purl);
}}
function rplace(purl){
location.replace(purl.replace(/amp;/g,''));
}
function rhref(purl){
location.href=purl.replace(/amp;/g,'');
}
/*
function scrmv(mvid,mgt,sto) {
var pst = parseInt($(mvid).style.top);
var gap = scrbody(1) + mgt;
if(gap != pst) $(mvid).style.top = gap + 'px';
setTimeout("scrmv('"+mvid+"',"+mgt+","+sto+")",sto);
}
*/

function fthsn(prnt,son) {
son = document.getElementsByName(son);
var retn;
var ppt;
for(var i = son.length -1;i >= 0;i--) {
ppt = son[i];
do {
if(ppt == prnt) {retn = son[i];break;break;}
} while((ppt = ppt.parentNode) && ppt.tagName.toLowerCase() != 'body');
}
return retn;
}
function $$(a,b) {
var rt = document.getElementsByName(a)[0];
if(b != 0 || b != '') rt = fthsn(rt,b);
return rt;
}
function IE6png(obj) {
    obj.width=obj.height=1;
    obj.className=obj.className.replace(/pngEX/i,'');
    obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image')";
    obj.src='icon/t.gif';
}
function lgnpt(ths,i,n) {
if(!ths.value) {
var tcs = (i == 2)? "i140 ":"i93 ";
tcs += (n == 2)? ths.name:"userbc";
ths.className = tcs;
}}
function img_resize() {
var rszimg = document.getElementsByName('img580');
if(rszimg) {
if(brwsrw < setop[7]) setop[7] = brwsrw - 40;
for(i=rszimg.length -1; i >= 0; i--) {
if(isopo == 0 && rszimg[i].tagName.toLowerCase() == 'input') {bgsund(rszimg[i]);continue;}
if(isopo < 100 && rszimg[i].width == '0') {setTimeout('img_resize()',100);break;}
else if(rszimg[i].width > setop[7]) {var rszw = parseInt(rszimg[i].height * (setop[7] / rszimg[i].width));rszimg[i].style.width = setop[7] +'px';if(rszimg[i].height) rszimg[i].style.height = rszw + 'px';}
rszimg[i].style.cursor = 'pointer';
}}
isopo += 1;
}
function toggle(tog) {
if(tog) tog.style.display = (tog.style.display == 'block')?'none':'block';
}
function findfm(tog) {
var tta = '';
while(tta != 'form') {tog = tog.parentNode;tta = tog.tagName.toLowerCase();if(tta == 'body') break;}
return tog;
}
function chkatcode(nmr,rmn) {
if(nmr == 1) {
if(rmn == 'a') {
siht.nextSibling.innerHTML = "입력한 값이 맞습니다.";
siht.style.background = "";
siht.readOnly = true;
siht.setAttribute("id",siht.value);
siht.parentNode.firstChild.onclick=function() {alert("바꿀 수 없습니다");};
if(document.body.className == 'cbody') document.cookie = "spmnumber=" + siht.value + siht.previousSibling.src.substr(siht.previousSibling.src.indexOf('=')+1);
} else if(rmn == 'b') {
siht.nextSibling.innerHTML = "입력한 값이 틀렸습니다.";
siht.style.background = "#FF6600";
}} else if(nmr == 2) chkatcode(0);
else {
if(!rmn) {rmn = $$('antispam',0);var spmm = $$('spm',0);}
else var spmm = findfm(rmn).spm;
if(!rmn.id && rmn.value != '') {
siht = rmn;
azax('exe.php?&antispam=' + rmn.value + '&spm=' + spmm.value,'chkatcode(1,ajax)');
}}}
document.onclick = function() {
ry='';px=0;py=0;
if(wopen == 2) imgview(0);
}
function isnotiff(vn,val) {
var mdiv = $('notifv');
mdiv.style.display = 'block';
var alertt = '';
if(vn !== 1) alertt = "<div class='ftlft'>[" + setop[9] + "] 새로운 글이 있습니다</div><input type='button' class='srbt' value='바로가기' onclick='rhref(\"index.php?id=" + setop[6] + "\")' /><div class='fcler'></div>";
if(vn !== 2 && val && val.indexOf("#") > 0)  {
val = val.split("#");
var valen = val.length - 1;
alertt += "<div class='ftlft' onclick='toggle(this.nextSibling.nextSibling)'><span>" + valen + "</span> 개의 새로운 덧글이 있습니다</div><input type='button' class='srbt' value='모두삭제' onclick='startax(\"exe.php?&notifx=1&id=1\");hidedv(\"notifv\");' /><div class='iscmtnt' style='display:none;'>";
var idnocc;
for(var i = valen - 1;i >= 0; i--) {
if(val[i] != '') {
idnocc = "id=" + val[i].substr(0,10).replace(/\s/g,"") + "&amp;no=" + parseFloat(val[i].substr(10,6));
alertt += "&bull; &nbsp;<a href='index.php?" + idnocc + "&amp;cc=" + val[i].substr(16,7) + "'>" + idnocc + "<\/a><br \/>";
}}}
alertt += "<\/div>";
if(moux != alertt) {mdiv.innerHTML = alertt;moux = alertt;}
}
function hidedv(mkdiv) {
$(mkdiv).innerHTML = '';
$(mkdiv).style.display = 'none';
setTimeout("moux = ''",500);
}
function strbyte(str) {
var abc = (str.length*9 - encodeURIComponent(str).length)/8;
return (str.length - abc)*3 + abc;
}
function crelemt(elmt,attr,val) {
var kk = document.createElement(elmt);
for(var kn = attr.length - 1;kn >= 0;kn--) {
if(attr[kn] != '') kk.setAttribute(attr[kn],val[kn]);
}
return kk;
}
function mkinput(nname,nvalue) {
return crelemt("input",["type","name","value"],["hidden",nname,nvalue]);
}
function mkfmput(frm,nname,nvalue) {
for(var kn = nname.length - 1;kn >= 0;kn--) {
frm.appendChild(crelemt("input",["type","name","value"],["hidden",nname[kn],nvalue[kn]]));
}
return frm;
}
function ckform() {
if(setop[6]) {
if($('ckfma').innerHTML != '') $('ckfma').innerHTML = '';
srchecked -= 1;
var mk_Form = $('ckfma');
mk_Form = mkfmput(mk_Form,["id","no","xx","ckdoubled"],[decodeURIComponent(setop[6]),ono,xxn,ckfmr[1]]);
mk_Form.submit();
setTimeout("ckform2(0)",100);
}}
function ckform2(sn) {
if(srchecked == 3) {
srchecked = 1;
if($('ckfma').innerHTML != '') $('ckfma').innerHTML = '';
ckfmr[0].submit();
ckfmr = Array('','');
} else {
if(srchecked != 2 && sn < 10) {sn += 1;setTimeout("ckform2(" + sn + ");",30);}
else if(srchecked < -10) alert("서버에 이상이 있습니다. 내용은 임시저장하고 나중에 다시 작성하세요.");
else ckform();
}}

function mouxe(that) {
if(that.style.backgroundColor) {
that.style.backgroundColor = '';
that.style.borderColor= '#C7C7C7';
} else {
that.style.backgroundColor = '#FFFAD9';
that.style.borderColor = '#FF6633';
}
}
function resize_n(AA) {
if(AA = $('resizhgt_' + AA)) {
if(parseInt(AA.style.height) > 150) {
AA.style.height = '150px';
} else {
AA.style.height = AA.scrollHeight +'px';
}}}
function togge(n1,n2) {
if($('resizhgt_' + n2) && $('resizhgt_' + n2).style.display != 'none') {
$('resizhgt_' + n1).style.display='block';
if(n1 != '6' && n1 != '8' && n1 != '9') $('resizhgt_' + n1).style.height='150px';
$('resizhgt_' + n2).style.display='none';
$('head_' + n1).className='menu_title menuon';
$('head_' + n2).className='menu_title menuoff';
}}

function tago(ths) {
var fom = document.sform;
if(fom) {
fom.search.value = 't';
fom.p.value = '1';
fom.keyword.value = ths.innerHTML;
parent.$('submit').click();
}}

function mouse_down() {
if(wopen == 2) imgview(0);
if(setop[6] != '' && ono != 0 && $('comment_' + ono)) {if($('comment_' + ono).contentWindow.wopen == 2) $('comment_' + ono).contentWindow.imgview(0);}
}

function nwspm(ths) {
if(!ths) {if($$('antispam',0)) ths = $$('antispam',0).previousSibling;else return;}
var sm = Math.random() + Math.random();
var rm = ths.src.indexOf("no=") + 3;
ths.src = ths.src.substr(0,rm) + sm;
ths = findfm(ths);
ths.spm.value = sm;
}

function survey(pono) {
var mvl = '';
for(var i=document.getElementsByName('sublist_' + pono).length -1;i >= 0;i--) {
if(document.getElementsByName('sublist_' + pono)[i].checked == true) {
mvl = document.getElementsByName('sublist_' + pono)[i].value;
}}
if(mvl != '') {
azax("include/poll.php?&poll=" + pono + "&vote=" + mvl,9);
} else alert('답변을 선택하세요');
}

var stbLw = 0;
var stbRw = 0;
var stbCp = '';
function recstd(dowc,stwLR) {
var sw = 0;
if(dowc < stwLR) sw = dowc - 10;
else if(dowc <= stwLR * 2) sw = (dowc - 20)/2;
else if(dowc <= stwLR * 3) sw = (dowc - 30)/3;
else if(dowc <= stwLR * 4) sw = (dowc - 40)/4;
else if(dowc <= stwLR * 5) sw = (dowc - 50)/5;
else sw = stwLR;
return parseInt(sw);
}
function recstc(stblrc,stbLRw,stdLR,LR,isstbLR,docw) {
if(stblrc && stbLRw > 0) {
var stdM;
if(isstbLR == 3) stdM = stblrc.firstChild.innerHTML;
else {
var sw = recstd(docw,stbLRw);
stdM = stblrc.firstChild.innerHTML.replace(/<div class="menu20/gi,'<div name="stbrlt" style="float:left;margin:5px;width:' + sw + 'px" class="menu20');
}
stblrc.firstChild.innerHTML = stblrc.firstChild.innerHTML.replace(/ id=/gi,' iidd=');
stblrc.firstChild.style.display = 'none';stblrc.style.width = '0px';
var lrt = (LR == 1)? 'stdLL':'stdRR';
var flt = (isstbLR == 3) ?((LR == 2)? 'float:right':'float:left'):'';
var stdrl = crelemt('div',['id','style'],[lrt,flt]);
if(isstbLR == 3) stdrl.style.width = parseInt((docw - 20)/2) + 'px';
stdrl.style.paddingTop = '20px';
stdrl.innerHTML = stdM;
stdLR.appendChild(stdrl);
}
return stdLR;
}
function recstb(docw) {
var stdLR = crelemt('div',['id','style'],['stdLR','width:' + docw + 'px']);
var isstbLR = 0;if(stbLw) isstbLR += 1;if(stbRw) isstbLR += 2;
stdLR = recstc($('stbL'),stbLw,stdLR,1,isstbLR,docw);
stdLR = recstc($('stbR'),stbRw,stdLR,2,isstbLR,docw);
var cpg = $('main_table').getElementsByTagName('colgroup')[0];
stbCp = cpg.innerHTML;
if(isstbLR == 3) {
if(stbLR67 == 1) cpg.innerHTML = "<col width='100%' /><col width='0' /><col width='0' /><col width='0' /><col width='0' />";
else if(stbLR67 == 2) cpg.innerHTML = "<col width='0' /><col width='0' /><col width='0' /><col width='0' /><col width='100%' />";
else cpg.innerHTML = "<col width='0' /><col width='0' /><col width='100%' /><col width='0' /><col width='0' />";
} else if((isstbLR == 1 && stbLR67 != 1) || (isstbLR == 2 && stbLR67 == 2)) cpg.innerHTML = "<col width='0' /><col width='0' /><col width='100%' />";
else if((isstbLR == 2 && stbLR67 != 2) || (isstbLR == 1 && stbLR67 == 1)) cpg.innerHTML = "<col width='100%' /><col width='0' /><col width='0' />";
var stdD = crelemt('div',['style'],['clear:both']);
stdLR.appendChild(stdD);
$('srboard').appendChild(stdLR);
}
var stzerowd = 0;
function recize() {
if(typeof($) == 'function' && reque[3] && reque[3] > 0) {
var docw;
if(window.innerHeight) docw = window.innerWidth;
else if(document.documentElement && document.documentElement.clientHeight) docw = document.documentElement.clientWidth;
else if(document.body && document.body.clientHeight) docw = document.body.clientWidth;
if(!!docw && reque[3] > 0 && $('stbC') && $('srboard')) {
if(setop[8] && docw > screen.width) docw = window.screen.availWidth;
if(stzerowd == 0 && $('section') && $('section').childNodes && ($('settzero') || $('settfindw_form'))) {
if($('settzero')) stzerowd = $('settzero').scrollWidth + 20;else stzerowd = $('settfindw_form').scrollWidth + 40;
if($('section').tagName.toLowerCase() == 'ul') {for(var sew = $('section').childNodes.length -1;sew >= 0;sew--) {stzerowd += $('section').childNodes[sew].scrollWidth;}} else stzerowd += $('section').scrollWidth;
}
if($('settzero')) {if(stzerowd > docw) $('settzero').style.display = 'none';else if($('settzero').style.display == 'none') $('settzero').style.display = 'block';}
else if($('settfindw_form')) {if(stzerowd > docw) $('settfindw_form').style.display = 'none';else if($('settfindw_form').style.display == 'none') $('settfindw_form').style.display = '';}
if(docw < reque[3]) {
if(!$('stdLL') && !$('stdRR')) {
if($('stbL')) stbLw = parseInt($('stbL').style.width);
if($('stbR')) stbRw = parseInt($('stbR').style.width);
$('stbC').style.width = '100%';
recstb(docw);
} else {
if($('stdLR')) $('stdLR').style.width = docw + 'px';
$('srboard').style.width = docw + 'px';$('srboard').style.minWidth = '0';
if(!$('stdLL') || !$('stdRR')) {
var stbLRw = ($('stdLL'))? stbLw:stbRw;
var sw = recstd(docw,stbLRw);
var s20 = document.getElementsByName('stbrlt');var s20l = s20.length;
for(var i = 0;i < s20l;i++) {s20[i].style.width = sw + 'px';}
} else {
var sw = parseInt((docw - 20)/2) + 'px';
$('stdLL').style.width = sw;$('stdRR').style.width = sw;
}}
$('srboard').style.width = docw + 'px';$('srboard').style.minWidth = '0';
} else if($('stdLL') || $('stdRR')) {
var cpg = $('main_table').getElementsByTagName('colgroup')[0];
cpg.innerHTML = stbCp;
$('srboard').style.width = (setop[2] > 100)? setop[2] + 'px':setop[2] + '%';
var srbda = $('stdLR');
if($('stdLL')) {$('stbL').firstChild.innerHTML = $('stbL').firstChild.innerHTML.replace(/ iidd=/gi,' id=');$('stbL').firstChild.style.display = '';$('stbL').style.width = stbLw + 'px';srbda.removeChild($('stdLL'));}
if($('stdRR')) {$('stbR').firstChild.innerHTML = $('stbR').firstChild.innerHTML.replace(/ iidd=/gi,' id=');$('stbR').firstChild.style.display = '';$('stbR').style.width = stbRw + 'px';srbda.removeChild($('stdRR'));}
$('srboard').removeChild(srbda);
}}}}
function thmtxt(thsd,etype) {
if(thsd.className == 'thmtxt') {
if(thtcg != thsd) {
if(!!thtcg && thtcg.className == 'thmtxt' && thtcg.style.display == 'block') thmtxt(thtcg,'mouseout');
thtcg = thsd;
}
if(etype == 'mouseout') {
if(thsd.style.display == 'block') {
thsd.style.display = 'none';
thsd.style.background = 'none';
}} else if(etype == 'mouseover') {
if(thsd.style.display != 'block') {
thsd.style.background = "url('icon/d30.png')";thsd.style.display = 'block';
}}}}
function mkcookie(ckn,ckv,ckt) {
if(!!ckt) ckt = ";expire=" + ((new Date().getTime()/1000) + 86400);else ckt = '';
document.cookie = ckn + "="+ escape(ckv) + ckt + ";path=/;";
}