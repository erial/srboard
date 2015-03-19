var sxx = document.getElementsByName('ixx');
var sel = document.getElementsByName('cart');
var i;
function choice(){
var sxw = rtsxv();
var sxv = sxx[sxw].value;
var ctf = true;
for(i = 0; i < sel.length; i++){
if(sxx[i].value == sxv) {
if(sel[i].checked == true) ctf = false;
else if(sel[i].checked == false) {ctf = true;break;}
}
}
for(i = 0; i < sel.length; i++){
if(sxx[i].value == sxv) sel[i].checked = ctf;
else sel[i].checked = false;
}
if(typeof(sxw) == 'number' && typeof(sxv) != 'undefined') document.adselect.xx.value = sxv;
}
function uchoice(that) {
var sxv = that.nextSibling.value;
document.adselect.xx.value = sxv;
for(i = 0; i < sel.length; i++){
if(sxx[i].value != sxv) sel[i].checked = false;
}
}
function choiced(chn){
var excv = document.adselect.exc.value;
if(excv.substr(0,7) == 'modify_') {
if(excv == 'modify_time' && confirm('게시판의 모든 게시물을 날짜순으로 재정렬합니다.')) document.adselect.submit();
else if(excv != 'modify_link') document.adselect.submit();
else if(confirm('링크주소가 중복되는 게시물을 모두 삭제합니다.')) {document.adselect.target = 'blank';document.adselect.submit();}
} else if(excv == 'range') {
if(document.adselect.ifno.parentNode.style.display == 'none') document.adselect.ifno.parentNode.style.display = '';
else {document.adselect.ifno.value = '';document.adselect.ifno.parentNode.style.display = 'none';}
document.adselect.exc.value = '';
} else if(chn == '0' && (excv == 'manage' || excv == 'hundred' || excv == 'datafile' || excv == 'cteditwin')) {
document.adselect.exc.value = '';
if(excv == 'manage') nwopn('admin.php?board=/' + setop[6]);
else if(excv == 'datafile') nwopn('admin.php?drct=//' + setop[6]);
else if(excv == 'cteditwin') popup('admin.php?mst=' + document.adselect.idn.value,300,200);
else rhref(document.location.href.replace(/&slys=[^&=]+/,'') + '&slys=|||||100');
} else if(chn == '0' && (excv == 'change' || excv == 'move' || excv == 'copy' || excv == 'limit' || excv == 'add_tag' || excv == '')) {
document.adselect.changeto.style.display = (excv == 'change')? 'block':'none';
document.adselect.moveto.style.display = (excv == 'move' || excv == 'copy')? 'block':'none';
document.adselect.perm_vw.style.display = (excv == 'limit')? 'block':'none';
$('addtagdv').style.display = (excv == 'add_tag')? 'block':'none';
} else if(excv == 'deletect') {
if(document.sform && document.sform.ct.value && confirm('이 범주의 모든 게시물을 삭제하시겠습니까')) rplace(document.location.href + '&deletect=' + document.sform.ct.value);
} else {
var xx = 1;
if(chn != 'delete_ct') {
if(excv == 'delete') xx = confirm('선택한 게시물을 삭제하시겠습니까');
else if(excv == 'delete_rp') xx = confirm('선택한 게시물의 덧글을 삭제하시겠습니까');
else if(excv == 'delete_body') xx = confirm('선택한 게시물의 본문을 삭제하시겠습니까');
}
if(xx) {
var selted = "";
if(document.adselect.ifno.value) {selted = 'ifno';document.adselect.target = 'blank';}
else {
var sxw = rtsxv();
var sxv = sxx[sxw].value;
for(i = 0; i < sel.length; i++){
if(sel[i].checked == true && sel[i].value !='' && sxx[i].value == sxv) selted += sel[i].value + ":";
}}
if(!!selted) document.adselect.selected.value = selted;
if(typeof(sxw) == 'number' && typeof(sxv) != 'undefined') document.adselect.xx.value = sxv;
if(excv == 'view_info') document.adselect.target = 'blank';
else if(excv == 'change') chn = document.adselect.changeto;
if(excv == 'change' && chn.options[chn.selectedIndex].innerHTML == '_새 분류_') document.adselect.newct.parentNode.style.display = '';
else if(selted) document.adselect.submit();
} else document.adselect.exc.value = "";
if(excv == 'view_info') setTimeout("document.adselect.exc.value = '';",100);
}
}
function rtsxv() {
var ii = 0;
for(i = 0; i < sel.length;i++){
if(sel[i].checked == true) {ii = i;break;}
}
return ii;
}