var gout = 1;
function rpp(nc,cmt,cp) {
var ccf =$$('rp_' + nc,0);
if(rbr_level == 0) {
ccf.name.value = $$(cmt,0).name.value;
ccf.pass.value = $$(cmt,0).pass.value;
}
ccf.up.value = parseInt(cp) + 1;
ccf.cc.value = nc;
if($$(cmt,0).antispam) {ccf.antispam.value = $$(cmt,0).antispam.value;if(!ccf.antispam.id) nwspm(ccf.antispam.previousSibling);}
}
function toprsz() {
if(pxxx == parent) {
var bht = document.body.offsetHeight;
if(setop[1] == 'opera') bht += 10;
else if(setop[0] == '2' || setop[1] == 'ie6') bht += 5;
if(pxxx.$('comment_' + ono)) pxxx.$('comment_' + ono).style.height = bht + 'px';
} else document.body.style.overflowY='auto';
}
function rrp(crp) {
if($('rpp_' + rpvalue[crp][0]).innerHTML) {
$('rpp_' + rpvalue[crp][0]).innerHTML = "";
$('rpp_' + rpvalue[crp][0]).style.display = "none";
} else {
var rf = $$('cmmt_' + ono,0).innerHTML
if(!!rf) {
var cmt = RegExp('cmmt_' + ono,'gi');
rf = rf.replace(cmt,'rp_' + rpvalue[crp][0]);
rf = '<form name="rp_' + rpvalue[crp][0] + '" method="post" action="exe.php" style="padding-top:10px">' + rf + '</form>';
$('rpp_' + rpvalue[crp][0]).innerHTML = rf;
$('rpp_' + rpvalue[crp][0]).style.display = "block";
rpp(rpvalue[crp][0],'cmmt_' + ono,rpvalue[crp][3]);
}}
toprsz();
}
function chksbmt(ths) {
if(pxxx != parent && pxxx.setop[6] != setop[6]) pxxx.setop[6] = setop[6];
var tstime = (lmtime - (new Date().getTime()/1000) - svtime).toFixed(2);
if(tstime > 0) alert('시간간격 제한 : ' + tstime + '초 남았습니다');
else if(!!vtrpc[1] && vtrpc[1] === 3) alert('정해진 시간이 지나서 덧글 쓰기가 차단되었습니다');
else if(ths.form.antispam && !ths.form.antispam.id) {chkatcode(0);tath = ths;setTimeout("chkssbmt(tath)",500);}
else chkssbmt(ths);
}
function chkssbmt(ths) {
var cform = ths.form;
cform.target = "rexe";
if(cform.antispam && !cform.antispam.id) {alert('스팸 방지 코드를 넣으세요.');chkatcode(0);return false;}
if(cform.content.value == '') {alert('내용이 비었습니다.');return false;}
else if(cform.content.value == $('ckdouble').value) {alert('중복된 내용입니다.');return false;}
else {var proh = pxxx.ckprohibit(cform.content.value);if(proh) {alert('금지단어 "' + proh + '"가 있습니다.');return false;}}
if(rbr_level == 0 && eval(cform.name) && (cform.name.value == '' || cform.pass.value == '' )) {alert('빈 칸이 있습니다');return false;}
var over = strbyte(cform.content.value) - strbytee;
if(strbytee != 0 && over > 0) {alert('내용이 너무 깁니다. (' + over + 'byte 초과)');return false;}
gout = 0;
pxxx.ckfmr = Array(cform,2);
pxxx.ckform();
}
function rvote(crp,ap) {
if(!!vtrpc[0] && vtrpc[0] === 3) alert('정해진 시간이 지나서 추천 기능이 차단되었습니다');
else if(rpvalue[crp][4] == 0) alert('권한이 없습니다');
else azax('exe.php?&id=' + setop[6] + '&rvote=' + rpvalue[crp][0] + '&apop=' + ap + '&xx=' + pxxx.xxn,9);
}
function rtForm(cc) {
if($('rmdForm').innerHTML != '') $('rmdForm').innerHTML = '';
var rt_Form = $('rmdForm');
rt_Form = mkfmput(rt_Form,["id","cc","xx","pno","request"],[decodeURIComponent(setop[6]),cc,xxn,ono,document.location.href]);
pxxx.ckfmr = Array(rt_Form,2);
if(pxxx != self) gout = 0;
return rt_Form;
}
function frpass(ths) {
if(ths.previousSibling && ths.previousSibling.value && ths.previousSibling.disabled == false) {
var thr = ths.name.split("_");
var rfF = rtForm('');
rfF = mkfmput(rfF,["no","cup","edit","pass"],[thr[0],thr[1],"disclose",ths.previousSibling.value]);
rfF.submit();
}}
function rpmod(mno,crp) {
rtForm(rpvalue[crp][0]).appendChild(mkinput("edit","modify_rp"));
pxxx.rpmd(rpvalue[crp][0],mno,$('bdo' + rpvalue[crp][0]),rpvalue[crp][1],rpvalue[crp][2],crp,$('crp2_' + crp).parentNode);
pxxx.tath = $('bdo' + rpvalue[crp][0]);
toprsz();
}
function rpmc() {
pxxx.rpmd();
toprsz();
}
function rfpass(edit, mno, cc, crp) {
if(cc === 'a' && crp) cc = rpvalue[crp][0];
rtForm(cc).appendChild(mkinput("edit",edit));
pxxx.fpass(edit,mno);
}
function mktext(ths,n) {
if(n == 2) {
ths.removeChild(ths.lastChild);
ths.lastChild.style.display = '';
} else {
var thswdth = ths.offsetWidth + 'px';
var mtext = "<input type='text' style='width:" + ths.offsetWidth + "px' value='" + ths.innerHTML + "' onclick='this.select()' onblur='mktext(this.parentNode,2)' />";
ths.style.display = 'none';
thtck = ths.parentNode;
ths.parentNode.innerHTML = ths.parentNode.innerHTML + mtext;
setTimeout("thtck.lastChild.focus()",30);
}}
function pxxdsht(px) {
if(pxxx.siht && pxxx.siht.substr(0,2) == '#c') location.replace(pxxx.siht);
if(px == 2) setTimeout('pxxdsht(0)',200);
}
document.onreadystatechange = function(){if(document.readyState == "complete" && !ono) rsetup();}
setTimeout("if(!ono) rsetup()",1000);
document.onload = function(){toprsz();}
window.onbeforeunload = function(){
if(gout == 1) {
var textc = document.getElementsByName('content');
for(var i=textc.length -1;i >= 0;i--) {
if(textc[i].value) {if(setop[0] != '1' && setop[1] != '') prompt('복사하세요',textc[i].value.replace(/\n/g,'<br />')); else return "-----------------";}
}}}
window.onunload = function(){window.onbeforeunload();}