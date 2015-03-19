
function sublist(sno,ths) {
var tst = $('section_title').getElementsByTagName('div');
var thst = -1;
for(var t = tst.length -1;t >= 0;t--) {
if(tst[t] == ths) {
thst = t -1;
ths.className = 'stt2';
if(ths.nextSibling) ths.nextSibling.className = 'sect_btw2';
if(ths.previousSibling) ths.previousSibling.className = 'sect_btw2';
} else {
tst[t].className = 'stt1';
if(t != thst && tst[t].nextSibling) tst[t].nextSibling.className = 'sect_btw';
}}
if($('sub_bd')) {
$('sub_bd').style.paddingLeft = '0px';

var submt = "";
if(slist[sno] && slist[sno][0] && slist[sno][0][1] != '') {
var scnt = slist[sno].length -1;
for(var i=0;i <= scnt;i++) {
if(setop[6] == slist[sno][i][0]) submt += "<a href='index.php?id=" + slist[sno][i][0] + "&p=1'><span style='border-bottom:2px solid #00D6D9'>" + slist[sno][i][1] + "</span></a>";
else if(slist[sno][i][0].substr(0,1) == '_') {if(slist[sno][i][0]=='_nw') slist[sno][i][2] = "onclick='nwopn(\"" +  slist[sno][i][2] + "\")'";else if(slist[sno][i][0] =='_js') slist[sno][i][2] = "onclick='" +  slist[sno][i][2] + "'";else slist[sno][i][2] = "href='" + slist[sno][i][2] + "'";submt += "<a " + slist[sno][i][2] + "><span style='cursor:pointer'>" + slist[sno][i][1] + "</span></a>";}
else submt += "<a href='index.php?id=" + slist[sno][i][0] + "&p=1'><span style='cursor:pointer'>" + slist[sno][i][1] + "</span></a>";
if(i < scnt) submt += "<img src='icon/t.gif' class='secbd_btw' alt='' />";
}
}
if(submt == '') submt = "&nbsp;"
$('sub_bd').innerHTML = submt;
if(submt != '&nbsp;') valignn(sno,ths);
}}
function valignn(sno,ths) {
if(ths) {
var xx = 0;
if(sno == 1) xx = 10;
else {
var slength = 0;
var smg = 3;
for(var d=0;$('section_title').getElementsByTagName('div')[d] != ths;d++) slength += $('section_title').getElementsByTagName('div')[d].offsetWidth + smg;
slength += parseInt((ths.offsetWidth + smg)/2);
var tlength = 0;
var tmg = 15;
var ofw = 0;
var tleng = $('sub_bd').childNodes.length - 1;
for(var d=0;d < tleng;d++) tlength += $('sub_bd').childNodes[d].offsetWidth + tmg;
tlength += $('sub_bd').childNodes[d].offsetWidth;
if(setop[2] > 100 && slength + (tlength/2) > setop[2]) xx = setop[2] - tlength -15;
else xx = slength - (tlength/2);
}
if(xx < 10) xx = 10;
$('sub_bd').style.paddingLeft = xx + 'px';
}}