var rpmdv = null;

function fpass(edit, mno, no, xx, fx, pno, id) {
	if(edit && document.passe.style.display == 'none') {
	if(mno >= 3) {
	if(edit != 'edit' || mno != 4) $('curtain').style.display='block';
	var varray = new Array();
	varray['edit'] ='수정';
	varray['delete'] ='삭제';
	varray['unlock'] ='잠금 해제';
	varray['disclose'] = '잠금 해제';
	varray['del_reple'] = '덧글 삭제';
	varray['del_stb'] = '트랙백 삭제';
	varray['del_rtb'] = '트랙백 삭제';
	varray['del_guest'] = '방명록 삭제';
	document.passe.editt.value = varray[edit];
	document.passe.edit.value = edit;
	document.passe.action = 'exe.php';
	document.passe.no.value = no;
	if(pno) document.passe.pno.value = pno;
	if(xx) document.passe.xx.value = xx;
	if(id) document.passe.id.value = id;
	if(edit == "edit")  document.passe.setAttribute("target","_self");
	else  document.passe.setAttribute("target","exe");
	if(edit == "edit" && mno == 4) document.passe.submit();
	else {
	if(mno == 4) $$('passe',0).getElementsByTagName('td')[0].style.display = 'none';
	else $$('passe',0).getElementsByTagName('td')[0].style.display = 'block';
	document.passe.style.left = (document.documentElement.clientWidth - 250)/2 + 'px';
	document.passe.style.top = scrbody(1) + (document.documentElement.clientHeight - 90)/2 + 'px';
	document.passe.style.display = 'block';
	}} else if(mno == '2') alert("글쓴이가 아닙니다");else if(mno == '0') alert("변경 금지되었습니다.");
	} else {
	document.passe.edit.value = '';
	document.passe.style.display = 'none';
	$('curtain').style.display='none';
	}
}

function passbmt(ths) {
var sn = ths.form.edit.value;
if(sn == 'del_reple' || sn == 'del_stb' || sn == 'del_rtb') {
ckfmr[0].appendChild(mkinput("pass",ths.form.pass.value));
fpass();ckform();
} else if(sn == 'delete') {
if($('comment_' + ono) && $('comment_' + ono).contentWindow.$('rp_count').value) sn = 2;
else sn = 3;
ckfmr = Array(ths.form,sn);
ckform();
} else {
ths.form.submit();
}}

function unlock(ths) {
if(ths.previousSibling && ths.previousSibling.value && ths.previousSibling.disabled == false) {
var nxp = ths.name.split("_");
var gt_Form = document.passe;
gt_Form.setAttribute("target","exe");
gt_Form.no.value = nxp[0];
gt_Form.xx.value = nxp[1];
gt_Form.pass.value = ths.previousSibling.value;
gt_Form.edit.value = "unlock";
gt_Form.submit();
}}

function ffpass(no, xn) {
$('lock_' + setop[6] + '_' + no).className = 'dv_pass';
$('lock_' + setop[6] + '_' + no).innerHTML = "<div>비밀글입니다</div><input type='text' class='txet' /><input type='button' class='srbt' name='" + no + "_" + xn + "' onclick='unlock(this)' value='잠금 해제' />";
}

function scrap(xn, nx) {
nwopn('admin.php?id=' + setop[6] + '&xx=' + xn + '&scrap=' + nx);
}

function vote(ox, xn, nx, iyd) {
if(!!vtrpc[nx] && vtrpc[nx] !== 3) {
if(!iyd) iyd = setop[6];
var ok = 1;
if(ox == 1) ok=confirm("이 게시물을 추천하시겠습니까?");
else if(ox == 2) ok=confirm("이 게시물을 비추하시겠습니까?");
else if(ox == 3) ok=confirm("이 게시물을 신고하시겠습니까?");
if(ok) {
azax('exe.php?&id=' + iyd + '&vote=' + nx + '&apop=' + ox + '&xx=' + xn,9);
}} else alert('정해진 시간이 지나서 추천 기능이 차단되었습니다');
}

function prohsbmt(formm,cc) {
var proh = ckprohibit(formm.content.value);
if(proh) alert('금지단어 "' + proh + '"가 들어 있습니다');
else if(setop[6] != '') {
var rsecrtv = (formm.rsecrt.checked)? 1:0;
var cntnt = formm.content.value.replace(/[\r]?\n/g, "\x7f");
ckfmr[0] = mkfmput(ckfmr[0],["ip","pass","link","rsecrt","content"],[reque[0],formm.pass.value,formm.link.value,rsecrtv,cntnt]);
if(cc && tath && tath.id && tath.className == 'bdo') tath.innerHTML = cntnt.replace(/[\x7f]/g,"<br>");
rpmd();
ckform();
} else formm.submit();
}

function rpmd(cc, mno, content, cb, ulink, guest, rpmdd) {
if(rpmdv !== null) {
rpmdv.removeChild(rpmdv.lastChild);
for(var i = rpmdv.childNodes.length - 1;i >= 0;i--) {if(rpmdv.childNodes[i].tagName) rpmdv.childNodes[i].style.display = '';}
rpmdv = null;
} else if(mno == 2) alert("글쓴이가 아닙니다");
else if(mno == 0) alert("변경 금지되었습니다.");
else {
if(guest != 'guest') rpmdv = rpmdd;
else rpmdv = rpmdd.parentNode.parentNode;
var th = rpmdv.offsetHeight - 51;
if(th < 100) th =100;
var td = crelemt("form",["id","class","style"],["rpmdiv_" + guest,"rpmdiv","width:" + (rpmdv.offsetWidth - 20) + "px;"]);
var te = "<textarea name='content' style='width:100%;height:" + th + "px'><\/textarea><div><label class='fft'><input type='checkbox' name='rsecrt' " + ((cb == '1')? "checked='checked'":"") + " /> 비밀글</label><div class='fgt'>";
if(guest == 'guest') {
td.setAttribute("method","post");
td.setAttribute("target","_self");
td.setAttribute("action","?");
te += "<input type='hidden' name='cc' value='" + cc + "' /><input type='hidden' name='edit' value='modify_rp' /><input type='hidden' name='request' value='" + reque[1] + "' /><input type='hidden' name='mno' value='" + reque[3] + "' />";
}
if(mno == 3) te += "<span><input type='text' name='link' value='" + ((ulink)? ulink:"http://") + "' /><input type='text' name='pass' class='password' /></span>";
else if(mno == 4) te += "<input type='hidden' name='link' /><input type='hidden' name='pass' />";
if(guest == 'guest') te += "<input type='button' value='취소' onclick='rpmd()' class='srbt' /><input type='button' value='수정' onclick='prohsbmt(this.form)' class='srbt' />";
else te += "<input type='button' value='취소' onclick='rpmc()' class='srbt' /><input type='button' value='수정' onclick='pxxx.prohsbmt(this.form,1)' class='srbt' />";
td.innerHTML = te + "</div><div class='fcler'></div></div>";
td.firstChild.value = content.innerHTML.replace(/<br[ \/]*>/gi, "\r\n").replace(/<br [^>]+>/gi, "\r\n");
for(var i = rpmdv.childNodes.length - 1;i >= 0;i--) {if(rpmdv.childNodes[i].tagName) rpmdv.childNodes[i].style.display = 'none';}
rpmdv.appendChild(td);
}
}

function tabview(ths) {
var tpc = ths.parentNode.childNodes;
var j = tpc.length;
var tablist;
for(var i=0;i < j;i++) {
if(tpc[i].className) {
tablist = $("tablist_" + tpc[i].id.substr(8));
if(tablist) {
if(tpc[i] == ths) {
tablist.className = "tab_list tlisto";tpc[i].className = "tab_head theado";
} else {
tablist.className = "tab_list tlistx";tpc[i].className = "tab_head theadx";
}}}}}

var thigh = Array();
function tabthigh() {
var tablist;
var tpc;
var ods;
var j = 0;
for(var k=1;k <= tpn;k++){
if(!thigh[k]) thigh[k] = 0;
tpc = $('tpn_' + k).childNodes;
j = tpc.length;
var next = 0;
for(var i=0;i < j;i++) {
if(tpc[i].className) {
tablist = $("tablist_" + tpc[i].id.substr(8));
if(tablist) {
ods = tablist.style.display;
tablist.style.display = "block";
if(thigh[k] < tablist.scrollHeight) thigh[k] = tablist.scrollHeight;
tablist.style.display = ods;
}}}
for(var i=0;i < j;i++) {
if(tpc[i].className) {
tablist = $("tablist_" + tpc[i].id.substr(8));
if(tablist) {
if(thigh[k] != 0 && thigh[k] >= tablist.scrollHeight) {tablist.style.height = thigh[k] + 'px';}
}}}}
setInterval("tabrotate()", tabchng);
}

if(tabchng !== 0) tabthigh();
function tabrotate() {
var tablist;
var tpc;
var j = 0;
for(var k=1;k <= tpn;k++){
if(k == stopt) continue;
if(!thigh[k]) thigh[k] = 0;
tpc = $('tpn_' + k).childNodes;
j = tpc.length;
var next = 0;
for(var i=0;i < j;i++) {
if(tpc[i].className) {
tablist = $("tablist_" + tpc[i].id.substr(8));
if(tablist) {
if(next == 0 && tpc[i].className == "tab_head theado") {
tablist.className = "tab_list tlistx";tpc[i].className = "tab_head theadx";next = i + 1;
}}}}
if(next + 1 == j || !tpc[next]) next = 0;
if(!tpc[next].id) next++;
tablist = $("tablist_" + tpc[next].id.substr(8));
tablist.className = "tab_list tlisto";tpc[next].className = "tab_head theado";
}}

function newxrotate() {
var newx5t = '';
var newxx = '';
var newx60 = 0;
var newx61 = 0;
for(var ii = 1;ii <= nwx; ii++) {
if(ii == stopn) continue;
var newx6g=$('newx6_' + ii).getElementsByTagName('input');
if(newx6g[0]) {
newx60 = parseInt(newx6g[0].value);
newx61=newx6g.length + newx60;
for(var i=newx60;i < newx61; i++) {if($('newxi_' + ii).value == i) {if(i >= newx61 -1) newx5t += "newx(" + newx60 + ");";else newx5t += "newx(" + (i + 1) + ");";}}
}}
eval(newx5t);
}

function newx(iii) {
if(newtxt[iii] && newtxt[iii][7]) {
var nt0 = (newtxt[iii][0])?"<a href='" + newtxt[iii][5] + "'><img src='" + newtxt[iii][0] + "' class='gthumb_100' alt='' /></a>":"<img src='icon/t.gif' class='gthumb_100' alt='' />";
$('newx2_' + newtxt[iii][7]).innerHTML = nt0;
$('newx3_' + newtxt[iii][7]).innerHTML = "<div class='newx_4'><input type='hidden' id='newxi_" + newtxt[iii][7] + "' value='" + iii + "' /><a href='" + newtxt[iii][5] + "'>" + newtxt[iii][1] + "</a></div>" + newtxt[iii][4] + "<div class='newx_5'>by " + newtxt[iii][2] + " | comments " + newtxt[iii][3] + " | " + newtxt[iii][6] + "</div>";
var newx6g=$('newx6_' + newtxt[iii][7]).getElementsByTagName('img');
var newx6a=$('newx6_' + newtxt[iii][7]).getElementsByTagName('a');
if(newx6g && newx6g.length) for(var ii=newx6g.length -1;ii >= 0; ii--) {if(newx6g[ii].name == 'newxe') {if(newx6g[ii] == document.getElementsByName('newxe')[iii]) {newx6g[ii].className='gthumb_100 gthumb_100h';if(newx6a[ii].href == '') newx6a[ii].href = newtxt[iii][5].replace(/amp;/g,'');} else newx6g[ii].className='gthumb_100';}}
else for(var ii=newx6a.length -1;ii >= 0; ii--) {if(newx6a[ii].className.substr(0,3) == 'lnk') {if(newx6a[ii].href.substr(newx6a[ii].href.indexOf("?")).replace(/&/g,"&amp;") == newtxt[iii][5]) newx6a[ii].className='lnk gthumb_100h'; else newx6a[ii].className='lnk';}}
}}

function ckrps(nfn, nfe, nfo) {
if($('comment_' + nfo)) {
var rpfrm = $('comment_' + nfo).contentWindow;
if(rpfrm) {
if(parseInt(rpfrm.$('rp_count').value) != parseInt(nfe)) {
rpfrm.$('nwrps').value = '새로운 덧글 (' + nfn + ')';
rpfrm.$('nwrps').style.display = '';
}}}}

function movem(ths) {
if(ths) {
while(ths.tagName.toLowerCase() != 'form') ths = ths.parentNode;
ry=ths;
px=Array(x,ry.style.left,0);
py=Array(y,ry.style.top,0);
} else {
ry='';
px=0;
py=0;
}}

function cfsz(size) {
for(var i = -1;i < 1 || $('bdo' + i);i++) {
if($('bdo' + i)) {
$('bdo' + i).style.fontSize = size + "pt";
}
}
var ifr = document.getElementsByTagName('iframe');
if(ifr) {
var ifrl = ifr.length;
for(var i = 0;i < ifrl;i++) {
if(ifr[i].src && ifr[i].src.indexOf('comment=') != -1) {
var ifdv = ifr[i].contentWindow.document.getElementsByTagName('div');
var ifdvl = ifdv.length;
for(var ii = 0;ii < ifdvl;ii++) {
if(ifdv[ii].className == 'bdo') ifdv[ii].style.fontSize = size + 'pt';
}}}}
mkcookie("cfsz",size,1);
}
function twit(t) {
var dl = document.location.href;
dl = dl.substr(0,dl.indexOf("?")) + "?id=" + setop[6] + "&no=" + ono;
dl = encodeURIComponent(dl);
var dx = encodeURIComponent(document.title.substr(document.title.indexOf("]") + 2));
if(t == 1) dl = "https://www.facebook.com/sharer/sharer.php?u=" + dl + "&t=" + dx + "%20" + dl;
else if(t == 2) dl = "https://twitter.com/share?text=" + dx + "&url=" + dl;
else if(t == 3) dl = "https://me2day.net/posts/new?new_post[body]=%22" + dx + "%22%3A" + dl + "&new_post[tags]=";
window.open(dl,"_blank");
}
function bgsund(url) {
var ur = url.value.split(",");
if(ur[0].substr(0,2) == "/f") ur[0] = "exe.php?sls=" + setop[6] + "/by/wmp" + ur[0];
if(!ur[2] || ur[2] == undefined || ur[2] == null) ur[2] = "300px";
if(!ur[3] || ur[3] == undefined || ur[3] == null) ur[3] = "45px";
if(setop[0] != '1') {
if(ur[4] && (ur[4] == 'wmb' || ur[4] == 'wmd')) {
if(ur[1] == '0' || ur[1] == undefined) ur[1] = "";else ur[1]  = "autoplay";
if(ur[4] == 'wmb') url.parentNode.appendChild(crelemt("audio",["src","controls",ur[1],"width","height"],[ur[0],"controls",ur[1],ur[2],ur[3]]));
else url.parentNode.appendChild(crelemt("video",["src","controls",ur[1],"preload","type","width","height"],[ur[0],"controls",ur[1],"metadata","video/mp4",ur[2],ur[3]]));
} else url.parentNode.appendChild(crelemt("embed",["type","src","autostart","width","height"],["application/x-mplayer2",ur[0],ur[1],ur[2],ur[3]]));
}
else url.parentNode.innerHTML = "<object classid='clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95' width='" + ur[2] + "' height='" + ur[3] + "'><param name='filename' value='" + ur[0] + "'><param name='autosize' value='true'><param name='autostart' value='" + ur[1] + "'><param name='volume' value='0'></object>";
}