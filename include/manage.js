
function selctd(a,b,c) {
var d = tctt(b,c);
return (a == d)?"selected='selected'":"";
}
function selcte(p,q,r) {
var s = tct[r][0].substr(q,2);
return (p == s)?"selected='selected'":"";
}
function chckd(e,f) {
var g = tctt(e,f);
return (g != '' && g != '0')?"checked='checked'":"";
}
function chcke(e,f) {
var g = tctt(e,f);
return (g != '' && g != '0')?"none":"";
}
function tctt(h,j) {
if(h && h.length > 0) return h.substr(j,1);
else return "";
}
function degree(m,n,o) {
var degrea = '';
var lv = (o > 2)? "level ":"";
var vz = (o > 2)? "비회원도":"0";
var vt = (o > 2)? "관리자만":"9";
if(o == 6) o = 1;
if(o == 5) degrea = " <option value='0' title='사용 안 함' " + selctd('0',m,n) + ">사용 안 함</option>";
else degrea = (o == 3)? "":" <option value='0' title='비회원도 허용' " + selctd('0',m,n) + ">" + vz + "</option>";
for(var gg = 1;gg <= 8;gg++) {degrea += " <option value='" + gg + "' " + selctd(gg,m,n) + ">" + lv + gg + "</option>";}
degrea += " <option value='9' title='관리자만' " + selctd('9',m,n) + ">" + vt + "</option>";
if(o == 1) degrea = degrea + " <option value='a' title='모두금지' " + selctd('a',m,n) + ">x</option>";
return degrea;
}
function rtfad() {
var fadd = "";
fadd += "<input type='hidden' name='from' value='" + document.location.href + "' />";
fadd += "<table border='0px' cellpadding='3px' cellspacing='1px' class='ttb' style='table-layout:fixed'>";
fadd += "<colgroup><col width='38px' /><col width='70px' /><col width='95px' /><col width='65px' /><col width='32px' /><col width='210px' /><col width='330px' /><col width='60px' /></colgroup>";
fadd += "<tr><td colspan='8'>";
fadd += "<div id='admtip' style='width:920px'>게시판관리</div></td></tr>";
fadd += "<tr class='bdhdr'><td>링크</td><td>게시판ID</td><td>게시판이름</td><td onmouseover='vwtip(this,0)'>목록형태</td><td onmouseover='vwtip(this,2)'>분류</td><td onmouseover='vwtip(this,3)'>번호/이름/분류/날짜/조회/추천/비추</td><td><input type='text' class='w30' onmouseover='vwtip(this,4)' value='목록' /><input type='text' class='w30' onmouseover='vwtip(this,5)' value='읽기' /><input type='text' class='w30' onmouseover='vwtip(this,6)' value='쓰기' /><input type='text' class='w50' onmouseover='vwtip(this,7)' value='덧글쓰기' /><input type='text' class='w50' onmouseover='vwtip(this,26)' value='덧글읽기' /><input type='text' class='w50' onmouseover='vwtip(this,48)' value='업로드' /><input type='text' class='w30' onmouseover='vwtip(this,37)' value='다운' /><input type='text' class='w30' onmouseover='vwtip(this,38)' value='공지' /></td>";
fadd += "<td>추가설정</td></tr>";
for(var i = 0;i < s17cnt;i++) {
if(tct[i]) {
fadd += "<tr onmouseover='this.style.background=\"#FFF29B\"' onmouseout='this.style.background=\"\"' style='text-align:center'>";
fadd += "<td><input type='hidden' name='order[]' value='" + flst[i][4] + "' /><a target='_blank' href='index.php?id=" + flst[i][1] + "&amp;p=1' class='f7'>&nbsp;" + flst[i][0] + "&nbsp;</a></td>";
fadd += "<td><input type='text' name='id[]' maxlength='10' value='" + flst[i][1] + "' readonly='readonly' onclick='idchg(this)' style='width:65px' /><input type='hidden' name='idd[]' value='" + flst[i][1] + "' /></td>";
fadd += "<td><input type='text' name='nam[]' value='" + tct[i][1] + "' style='width:90px' /></td>";
fadd += "<td><select name='pt[]'>";
fadd += "<option value='a' " + selctd('a',tct[i][0],26) + ">제목형</option>";
fadd += "<option value='b' " + selctd('b',tct[i][0],26) + ">본문형</option>";
fadd += "<option value='c' " + selctd('c',tct[i][0],26) + ">요약형</option>";
fadd += "<option value='g' " + selctd('g',tct[i][0],26) + ">갤러리</option>";
fadd += "<option value='d' " + selctd('d',tct[i][0],26) + ">방명록</option>";
fadd += "<option value='e' " + selctd('e',tct[i][0],26) + ">블로그</option>";
fadd += "<option value='k' " + selctd('k',tct[i][0],26) + ">달력형</option>";
fadd += "</select>";
fadd += "</td>";
fadd += "<td><input type='button' onclick=\"popup('admin.php?mst=" + flst[i][0] + "', 300, 200)\" value='" + flst[i][3] + "' class='button' style='width:25px' /></td>";
fadd += "<td style='height:25px' align='center'><input type='hidden' name='pd[]' value='" + tctt(tct[i][0],38) + "' /><label><input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],38) + " class='no mgn5' title='번호' /></label><input type='hidden' name='pe[]' value='" + tctt(tct[i][0],39) + "' /><label><input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],39) + " class='no mgn5'  title='이름' /></label><input type='hidden' name='pj[]' value='" + tctt(tct[i][0],48) + "' /><label><input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],48) + " class='no mgn5'  title='분류' /></label><input type='hidden' name='pf[]' value='" + tctt(tct[i][0],40) + "' /><label><input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],40) + " class='no mgn5'  title='날짜' /></label><input type='hidden' name='pg[]' value='" + tctt(tct[i][0],41) + "' /><label><input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],41) + " class='no mgn5'  title='조회' /></label><input type='hidden' name='ph[]' value='" + tctt(tct[i][0],42) + "' /><label><input type='checkbox' onclick=\"chkchk3(this," + flst[i][2] + ",1)\" " + chckd(tct[i][0],42) + " class='no mgn5'  title='추천' /></label><input type='hidden' name='qk[]' value='" + tctt(tct[i][0],59) + "' /><label><input type='checkbox' onclick=\"chkchk3(this," + flst[i][2] + ",2)\" " + chckd(tct[i][0],59) + " class='no mgn5'  title='비추' /></label>";
fadd += "</td>";
fadd += "<td>";
fadd += "<select class='w30' name='pl[]' onmouseover='vwtip(\"\",4)'>" + degree(tct[i][0],22,0) + "</select>";
fadd += "<select class='w30' name='pr[]' onmouseover='vwtip(\"\",5)' onchange=\"chkchk9(this," + flst[i][2] + ",'se[]')\">" + degree(tct[i][0],23,1) + "</select>";
fadd += "<select class='w30' name='pw[]' onmouseover='vwtip(\"\",6)'>" + degree(tct[i][0],24,1) + "</select>";
fadd += "<select class='w50' name='pc[]' onmouseover='vwtip(\"\",7)' onchange=\"chkchk8(this," + flst[i][2] + ",'sa[]',3)\">" + degree(tct[i][0],25,1) + "</select>";
fadd += "<select class='w50' name='sa[]' onmouseover='vwtip(\"\",26)' onchange=\"chkchk8(this," + flst[i][2] + ",'pc[]',2)\">" + degree(tct[i][5],0,1) + "</select>";
fadd += "<select class='w50' name='re[]' onmouseover='vwtip(\"\",48)'>" + degree(tct[i][7],31,1) + "</select>";
fadd += "<select class='w30' name='qo[]' onmouseover='vwtip(\"\",37)'>" + degree(tct[i][7],3,1) + "</select>";
fadd += "<select class='w30' name='qt[]' onmouseover='vwtip(\"\",38)'>" + degree(tct[i][7],8,0) + "</select>";
fadd += "</td>";
fadd += "<td>";
fadd += "<a href='#none' onclick=\"toggle('bdwdth' + " + flst[i][2] + ")\" onmouseover='vwtip(this,9)'>추가설정</a></td></tr>";
fadd += "<tr><td colspan='8'><div id='bdwdth" + flst[i][2] + "' class='exsett'><h4>추가 설정</h4>";
fadd += "<div class='bgz'>";
fadd += "<span class='r7'>01.</span>&nbsp;최근글: <input type='text' name='lastno[]' value='" + tct[i][0].substr(10,6) + "' style='width:60px' maxlength='6' /><input type='hidden' name='wlastno[]' value='" + tct[i][0].substr(10,6) + "' />";
fadd += " &nbsp; 총갯수: <input type='text' name='cnt[]' value='" + tct[i][0].substr(16,6) + "' style='width:60px'  maxlength='6' /><input type='hidden' name='wcnt[]' value='" + tct[i][0].substr(16,6) + "' />";
fadd += " &nbsp; 분산저장횟수: <input type='text' value='" + tct[i][6] + "' style='width:40px' disabled='disabled' />";
fadd += " &nbsp; <span onmouseover='vwtip(this,10)'>게시판관리자</span> : <input type='text' name='tct2[]' value='" + tct[i][3] + "' style='width:70px' />";
fadd += " &nbsp; <input type='button' onclick='if(confirm(\"게시판을 삭제하시겠습니까\")) dell(" + flst[i][2] + ")' value='게시판삭제' class='button' style='width:70px;float:right;margin-right:20px' />";
fadd += "<br /><span class='r7'>02.</span>&nbsp;<span onmouseover='vwtip(this,26)'>스킨설정</span>::";
fadd += "&nbsp;<select name='tct1[]' style='width:80px'>" + skinoption + "</select>";
fadd += " &nbsp; 공지글목록 : <input type='text' value='" + tct[i][4] + "' style='width:150px' disabled='disabled' />&nbsp;<input type='hidden' name='se[]' value='" + tctt(tct[i][5],4) + "' /><label";
if(tctt(tct[i][0],23) == '0') fadd += " style='display:none'";
fadd += " onmouseover='vwtip(this,75)'>읽기권한 없으면 링크로 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][5],4) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='sg[]' value='" + tctt(tct[i][5],5) + "' /><label onmouseover='vwtip(this,80)'>좌우메뉴 넓이 설정 <input type='checkbox' onclick='chkchk2(this)' " + chckd(tct[i][5],5) + " class='no' /></label><span";
if(tctt(tct[i][5],5) != '1') fadd += " style='display:none'";
fadd += ">&nbsp;좌측넓이 : <input type='text' name='sh[]' value='" + tct[i][5].substr(6,3) + "' style='width:35px' maxlength='3' />px&nbsp;우측넓이 : <input type='text' name='si[]' value='" + tct[i][5].substr(9,3) + "' style='width:35px' maxlength='3' />px</span>";
fadd += "<div class='bga'><span class='r7'>03.</span>&nbsp;<span onmouseover='vwtip(this,11)'>목록상단</span>::";
fadd += "&nbsp;<span onmouseover='vwtip(this,12)'>분류출력 </span><select name='py[]'><option value='0' " + selctd('0',tct[i][0],27) + ">출력 안 함</option><option value='1' " + selctd('1',tct[i][0],27) + ">선택상자</option><option value='2' " + selctd('2',tct[i][0],27) + ">분류박스</option></select>";
fadd += " &nbsp; <input type='hidden' name='pa[]' value='" + tctt(tct[i][0],45) + "' /><label onmouseover='vwtip(this,13)'>정렬 선택상자 <input type='checkbox' onclick=\"chkchk(this," + flst[i][2] + ",'pi[]',3)\" " + chckd(tct[i][0],45) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='sj[]' value='" + tctt(tct[i][7],34) + "' /><label onmouseover='vwtip(this,79)'>월별목록 선택상자 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][7],34) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='qa[]' value='" + tctt(tct[i][0],53) + "' /><label onmouseover='vwtip(this,15)'>목록형태고정 <input type='checkbox' onclick=\"chkchk5(this," + flst[i][2] + ")\" " + chckd(tct[i][0],53) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='sk[]' value='" + tctt(tct[i][7],35) + "' /><label onmouseover='vwtip(this,81)'>로그인ico 출력 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][7],35) + " class='no' /></label>";
fadd += " &nbsp; <span onmouseover='vwtip(this,46)'>항목나열위치 </span><select name='rd[]'><option value='0' " + selctd('0',tct[i][7],30) + ">감춤</option><option value='1' " + selctd('1',tct[i][7],30) + ">목록상단</option><option value='2' " + selctd('2',tct[i][7],30) + ">목록하단</option></select>";
fadd += "</div><span class='r7'>04.</span>&nbsp;<span>목록관련</span>::";
fadd += "&nbsp;<span onmouseover='vwtip(this,1)'>목록갯수</span>: <input type='text' name='po[]' maxlength='2' value='" + tct[i][0].substr(36,2) + "' style='width:25px' />";
fadd += " &nbsp; <input type='hidden' name='pi[]' value='" + tctt(tct[i][0],47) + "' /><label onmouseover='vwtip(this,20)'>항목별 정렬 <input type='checkbox' onclick=\"chkchk(this," + flst[i][2] + ",'pa[]',2)\" " + chckd(tct[i][0],47) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='pz[]' value='" + tctt(tct[i][0],30) + "' /><label onmouseover='vwtip(this,16)'>본문하단목록 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],30) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='qp[]' value='" + tctt(tct[i][7],4) + "' /><label onmouseover='vwtip(this,49)'>NEW표시 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][7],4) + " class='no' /></label>";
fadd += " &nbsp; <span onmouseover='vwtip(this,50)'>HOT표시 </span><select name='rg[]'><option value='0' " + selctd('0',tct[i][8],1) + ">감춤</option><option value='1' " + selctd('1',tct[i][8],1) + ">조회수</option><option value='2' " + selctd('2',tct[i][8],1) + ">덧글수</option><option value='3' " + selctd('3',tct[i][8],1) + ">추천수</option><option value='4' " + selctd('4',tct[i][8],1) + ">평점</option><option value='5' " + selctd('5',tct[i][8],1) + ">평가자수</option></select><input type='text' name='rh[]' value='" + tct[i][8].substr(2) + "' style='width:40px' />이상 ";
fadd += "<br /><span class='r7'>05.</span>&nbsp;<span>본문관련</span>::";
fadd += "&nbsp;<select name='pk[]'><option value='0' " + selctd('0',tct[i][0],49) + ">사용 안 함</option><option value='1' " + selctd('1',tct[i][0],49) + ">엮인글허용</option><option value='2' " + selctd('2',tct[i][0],49) + ">게시물신고</option></select>";
fadd += " &nbsp; <input type='hidden' name='qc[]' value='" + tctt(tct[i][0],55) + "' /><label onmouseover='vwtip(this,82)'>답글허용 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],55) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='pb[]' value='" + tctt(tct[i][0],46) + "' /><label onmouseover='vwtip(this,17)'>글쓴이서명 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],46) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='pp[]' value='" + tctt(tct[i][0],31) + "' /><label onmouseover='vwtip(this,18)'>본문링크표시 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],31) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='rq[]' value='" + tctt(tct[i][0],69) + "' /><label onmouseover='vwtip(this,83)'>SNS 스크랩 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],69) + " class='no' /></label>";
fadd += "<div class='bga'><span class='r7'>06.</span>&nbsp;<span>본문관련</span>::";
fadd += " &nbsp; <input type='hidden' name='px[]' value='" + tctt(tct[i][0],29) + "' /><label onmouseover='vwtip(this,14)'>rss출력 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],29) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='qj[]' value='" + tctt(tct[i][7],1) + "' /><label onmouseover='vwtip(this,19)'>rss본문길이제한 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][7],1) + " class='no' /></label>";
fadd += " &nbsp; <span onmouseover='vwtip(this,32)'>글자크기 </span><select name='pn[]'><option value='08' " + selcte('08',50,i) + ">8pt</option><option value='09' " + selcte('09',50,i) + ">9pt</option><option value='10' " + selcte('10',50,i) + ">10pt</option><option value='11' " + selcte('11',50,i) + ">11pt</option><option value='12' " + selcte('12',50,i) + ">12pt</option><option value='13' " + selcte('13',50,i) + ">13pt</option><option value='14' " + selcte('14',50,i) + ">14pt</option><option value='15' " + selcte('15',50,i) + ">15pt</option><option value='18' " + selcte('18',50,i) + ">18pt</option></select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,33)'>글꼴 </span><select name='qi[]'><option value='0' " + selctd('0',tct[i][8],0) + ">굴림</option><option value='1' " + selctd('1',tct[i][8],0) + ">돋움</option><option value='2' " + selctd('2',tct[i][8],0) + ">바탕</option><option value='3' " + selctd('3',tct[i][8],0) + ">궁서</option><option value='4' " + selctd('4',tct[i][8],0) + ">맑은고딕</option><option value='5' " + selctd('5',tct[i][8],0) + ">Arial</option><option value='6' " + selctd('6',tct[i][8],0) + ">Tahoma</option><option value='7' " + selctd('7',tct[i][8],0) + ">Verdana</option><option value='8' " + selctd('8',tct[i][8],0) + ">Trebuchet MS</option><option value='9' " + selctd('9',tct[i][8],0) + ">sans-serif</option></select>";
fadd += "</div><span class='r7'>07.</span>&nbsp;<span>추가입력</span>::";
fadd += "&nbsp;<input type='hidden' name='qb[]' value='" + tctt(tct[i][0],54) + "' /><label onmouseover='vwtip(this,21)'>추가입력 <input type='checkbox' onclick='chkchk2(this)' " + chckd(tct[i][0],54) + " class='no' /></label><span";
if(tctt(tct[i][0],54) != '1') fadd += " style='display:none'";
fadd += ">&nbsp;<a href=\"#none\" onmouseover=\"vwtip(this,62)\" onclick=\"vwedit('" + flst[i][1] + "',1)\">view.html</a> , <a href=\"#none\" onmouseover=\"vwtip(this,63)\" onclick=\"vwedit('" + flst[i][1] + "',2)\">write.html</a> , <input type='hidden' name='qd[]' value='" + tctt(tct[i][7],0) + "' /><label onmouseover=\"vwtip(this,64)\">목록출력 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][7],0) + " class='no' /></label></span>";
fadd += "<br /><span class='r7'>08.</span>&nbsp;<span>기타설정</span>::";
fadd += "&nbsp;<input type='hidden' name='rc[]' value='" + tctt(tct[i][7],9) + "' /><label onmouseover='vwtip(this,22)'>업로드크기제한 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][7],9) + " class='no' /></label>";
fadd += " &nbsp; <span onmouseover='vwtip(this,34)'>IP 기록제외 </span><select name='qe[]'><option value='0' " + selctd('0',tct[i][0],43) + ">모두제외</option>" + degree(tct[i][0],43,3) + "<option value='a' " + selctd('a',tct[i][0],43) + ">모두 사용</option></select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,24)'>IP 노출설정 </span><select name='qf[]'><option value='0' " + selctd('0',tct[i][0],44) + ">모든ip 모두에게</option><option value='1' " + selctd('1',tct[i][0],44) + ">모든ip 회원에게</option><option value='2' " + selctd('2',tct[i][0],44) + ">모든ip 관리자에게</option><option value='7' " + selctd('7',tct[i][0],44) + ">비회원ip 모두에게</option><option value='8' " + selctd('8',tct[i][0],44) + ">비회원ip 회원에게</option><option value='9' " + selctd('9',tct[i][0],44) + ">비회원ip 관리자에게</option></select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,51)'>업로드경로변경 </span><select name='ri[]'><option value='0' " + selctd('0',tct[i][7],33) + ">기본</option><option value='1' " + selctd('1',tct[i][7],33) + ">노출경로</option></select>";
fadd += "<div class='bga'><span class='r7'>09.</span>&nbsp;<span>기타설정</span>::";
fadd += "&nbsp;<input type='hidden' name='rf[]' value='" + tctt(tct[i][7],32) + "' /><label onmouseover='vwtip(this,47)'>태그안씀 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][7],32) + " class='no' /></label>";
fadd += " &nbsp; <span onmouseover='vwtip(this,36)'>불펌방지 </span>  <select name='qn[]' onchange='chkchk4(this," + flst[i][2] + ")'><option value='0' " + selctd('0',tct[i][7],2) + ">사용 안 함</option><option value='1' " + selctd('1',tct[i][7],2) + ">1단계</option><option value='2' " + selctd('2',tct[i][7],2) + ">2단계</option><option value='3' " + selctd('3',tct[i][7],2) + ">3단계</option><option value='4' " + selctd('4',tct[i][7],2) + ">4단계</option><option value='5' " + selctd('5',tct[i][7],2) + ">5단계 대화상자</option><option value='6' " + selctd('6',tct[i][7],2) + ">6단계  대화상자</option></select>";
fadd += " &nbsp; <input type='hidden' name='qg[]' value='" + tctt(tct[i][0],56) + "' /><label onmouseover='vwtip(this,44)'>최근글제외 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],56) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='ps[]' value='" + tctt(tct[i][0],52) + "' /><label onmouseover='vwtip(this,45)'>최근덧글제외 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],52) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='rj[]' value='" + tctt(tct[i][0],62) + "' /><label onmouseover='vwtip(this,52)'>회원로그제외 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],62) + " class='no' /></label>";
fadd += "</div><span class='r7'>10.</span>&nbsp;<span>추천설정</span>::";
fadd += "&nbsp;<input type='hidden' name='ql[]' value='" + tctt(tct[i][0],60) + "' /><label onmouseover='vwtip(this,29)'>추천사용 <input type='checkbox' onclick=\"chkchk3(this," + flst[i][2] + ",3)\" " + chckd(tct[i][0],60) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='qm[]' value='" + tctt(tct[i][0],61) + "' /><label onmouseover='vwtip(this,29)'>비추사용 <input type='checkbox' onclick=\"chkchk3(this," + flst[i][2] + ",4)\" " + chckd(tct[i][0],61) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='qq[]' value='" + tctt(tct[i][7],5) + "' /><label onmouseover='vwtip(this,39)'>평점사용 <input type='checkbox' onclick=\"chkchk6(this," + flst[i][2] + ")\" " + chckd(tct[i][7],5) + " class='no' /></label>";
fadd += " &nbsp; <span onmouseover='vwtip(this,65)'>추천권한 </span> <select name='rv[]'>" + degree(tct[i][9],0,4) + "</select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,67)'>피추천회원 포인트 </span>  <select name='ry[]'><option value='0' " + selctd('0',tct[i][9],6) + ">사용 안 함</option>";
if(tctt(tct[i][0],60) == '1') fadd += "<option value='1' " + selctd('1',tct[i][9],6) + ">추천만 가산</option>";
if(tctt(tct[i][0],61) == '1') fadd += "<option value='2' " + selctd('2',tct[i][9],6) + ">비추만 감산</option>";
if(tctt(tct[i][0],60) == '1' && tctt(tct[i][0],61) == '1') fadd += "<option value='3' " + selctd('3',tct[i][9],6) + ">추천비추 가감</option>";
if(tctt(tct[i][7],5) == '1') fadd += "<option value='1' " + selctd('1',tct[i][9],6) + ">평점 중간점수이상 가산</option><option value='2' " + selctd('2',tct[i][9],6) + ">평점 중간점수이하 감산</option><option value='3' " + selctd('3',tct[i][9],6) + ">평점 중간점수기준 가감</option>";
fadd += "</select>";
fadd += " &nbsp; 피추천수의 <input type='text' name='rz[]' value='" + parseInt(tct[i][9].substr(7,4)) + "' maxlength='4' style='width:30px' onmouseover='vwtip(this,68)' />%를 적립";
fadd += "<br /><span class='r7'>11.</span>&nbsp;<span>덧글설정</span>::";
fadd += "&nbsp;<span onmouseover='vwtip(this,69)'>덧글스킨설정 </span><select name='csf[]' style='width:80px'><option value=''></option>" + skinoption + "</select>";
fadd += " &nbsp; <input type='hidden' name='cql[]' value='" + tctt(csff[i][1],0) + "' /><label onmouseover='vwtip(this,70)'>덧글추천사용 <input type='checkbox' onclick='chkck(this)' " + chckd(csff[i][1],0) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='cqm[]' value='" + tctt(csff[i][1],1) + "' /><label onmouseover='vwtip(this,71)'>덧글비추사용 <input type='checkbox' onclick='chkck(this)' " + chckd(csff[i][1],1) + " class='no' /></label>";
fadd += "<div class='bga'><span class='r7'>12.</span>&nbsp;<span>특수기능</span>::";
fadd += "&nbsp;<input type='hidden' name='rk[]' value='" + tctt(tct[i][0],63) + "' /><label onmouseover='vwtip(this,53)'>rss리더 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],63) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='rl[]' value='" + tctt(tct[i][0],64) + "' /><label onmouseover='vwtip(this,54)'>익명게시판 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],64) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='rm[]' value='" + tctt(tct[i][0],65) + "' /><label onmouseover='vwtip(this,55)'>활성순정렬 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],65) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='rn[]' value='" + tctt(tct[i][0],66) + "' /><label onmouseover='vwtip(this,56)'>본문삭제를 숨김으로 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][0],66) + " class='no' /></label>";
fadd += "</div><span class='r7'>13.</span>&nbsp;<span onmouseover='vwtip(this,57)'>변경금지</span>::";
fadd += "&nbsp;<span onmouseover='vwtip(this,57)'>본문 </span><select name='ro[]'><option value='0' " + selctd('0',tct[i][0],67) + ">모두 해제</option><option value='1' " + selctd('1',tct[i][0],67) + ">수정금지적용</option><option value='2' " + selctd('2',tct[i][0],67) + ">삭제금지적용</option><option value='3' " + selctd('3',tct[i][0],67) + ">모두 적용</option></select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,57)'>덧글 </span><select name='rp[]'><option value='0' " + selctd('0',tct[i][0],68) + ">모두 해제</option><option value='1' " + selctd('1',tct[i][0],68) + ">수정금지적용</option><option value='2' " + selctd('2',tct[i][0],68) + ">삭제금지적용</option><option value='3' " + selctd('3',tct[i][0],68) + ">모두 적용</option></select>";
fadd += "<br /><span class='r7'>14.</span>&nbsp;<span>미리보기</span>::";
fadd += "&nbsp;<span onmouseover='vwtip(this,8)'>마우스오버 미리보기 </span><select name='pv[]'><option value='1' " + selctd('1',tct[i][0],28) + ">모두 사용</option><option value='2' " + selctd('2',tct[i][0],28) + ">대문에만</option><option value='3' " + selctd('3',tct[i][0],28) + ">목록에만</option><option value='0' " + selctd('0',tct[i][0],28) + ">모두 차단</option></select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,61)'>미리보기에 본문노출 </span><select name='ru[]'><option value='1' " + selctd('1',tct[i][0],73) + ">모두 사용</option><option value='2' " + selctd('2',tct[i][0],73) + ">대문에만</option><option value='3' " + selctd('3',tct[i][0],73) + ">목록에만</option><option value='0' " + selctd('0',tct[i][0],73) + ">모두 차단</option></select>";
fadd += "<div class='bga'><span class='r7'>15.</span>&nbsp;<span>대문/목록</span>::";
fadd += "&nbsp;<span onmouseover='vwtip(this,58)'>덧글링크 </span><select name='rs[]'><option value='1' " + selctd('1',tct[i][0],71) + ">모두 사용</option><option value='2' " + selctd('2',tct[i][0],71) + ">대문에만</option><option value='3' " + selctd('3',tct[i][0],71) + ">목록에만</option><option value='0' " + selctd('0',tct[i][0],71) + ">모두 차단</option></select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,59)'>링크표시 </span><select name='pu[]'><option value='1' " + selctd('1',tct[i][0],32) + ">모두 사용</option><option value='2' " + selctd('2',tct[i][0],32) + ">대문에만</option><option value='3' " + selctd('3',tct[i][0],32) + ">목록에만</option><option value='0' " + selctd('0',tct[i][0],32) + ">모두 차단</option></select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,60)'>썸네일노출 </span><select name='rt[]'><option value='1' " + selctd('1',tct[i][0],72) + ">모두 사용</option><option value='2' " + selctd('2',tct[i][0],72) + ">대문에만</option><option value='3' " + selctd('3',tct[i][0],72) + ">목록에만</option><option value='0' " + selctd('0',tct[i][0],72) + ">모두 차단</option></select>";
fadd += "</div><span class='r7'>16.</span>&nbsp;<span>대문설정</span>::";
fadd += "&nbsp;<select name='pq[]'> <option value='1' " + selctd('1',tct[i][0],33) + " >제목형</option><option value='2' " + selctd('2',tct[i][0],33) + " >요약형</option><option value='3' " + selctd('3',tct[i][0],33) + " >썸네일</option><option value='4' " + selctd('4',tct[i][0],33) + " >탭형태</option><option value='5' " + selctd('5',tct[i][0],33) + " >뉴스형</option></select>";
fadd += " &nbsp; <span onmouseover='vwtip(this,25)'>글갯수</span>: <input type='text' name='pm[]' maxlength='2' value='" + tct[i][0].substr(34,2) + "' />";
fadd += " &nbsp; <span onmouseover='vwtip(this,27)'>섹션선택: </span>";
fadd += sctnbd(i);
fadd += "<br /><span class='r7'>17.</span>&nbsp;<span>글쓰기설정</span>::";
fadd += "&nbsp;<input type='hidden' name='sb[]' value='" + tctt(tct[i][5],1) + "' /><label onmouseover=\"vwtip(this,72)\">본문 비어도 입력 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][5],1) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='sc[]' value='" + tctt(tct[i][5],2) + "' /><label onmouseover=\"vwtip(this,73)\">본문 입력란 삭제 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][5],2) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='sd[]' value='" + tctt(tct[i][5],3) + "' /><label onmouseover=\"vwtip(this,74)\">링크 입력란 노출 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][5],3) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='sl[]' value='" + tctt(tct[i][9],11) + "' /><label onmouseover='vwtip(this,84)'>트랙백사용 <input type='checkbox' onclick=\"chkchk10(this," + flst[i][2] + ")\" " + chckd(tct[i][9],11) + " class='no' /></label><span style='display:" + chcke(tct[i][9],11) + "'> &nbsp; [";
fadd += "<input type='hidden' name='sm[]' value='" + tctt(tct[i][9],12) + "' /><label onmouseover='vwtip(this,85)'>덧글쓰기 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][9],12) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='sn[]' value='" + tctt(tct[i][9],13) + "' /><label onmouseover='vwtip(this,86)'>덧글읽기 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][9],13) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='so[]' value='" + tctt(tct[i][9],14) + "' /><label onmouseover='vwtip(this,87)'>다운로드 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][9],14) + " class='no' /></label>]</span>";
fadd += "<div class='bga'><span class='r7'>18.</span>&nbsp;<span>포인트설정</span>::";
fadd += "&nbsp;<span onmouseover='vwtip(this,40)'>본문쓰기 </span>  <select name='qu[]'><option value='+' " + selctd('+',tct[i][7],10) + ">+</option><option value='-' " + selctd('-',tct[i][7],10) + ">-</option></select> <input type='text' name='qv[]' value='" + parseInt(tct[i][7].substr(11,4)) + "' maxlength='4' style='width:40px' />";
fadd += " &nbsp; <span onmouseover='vwtip(this,41)'>덧글쓰기</span>  <select name='qw[]'><option value='+' " + selctd('+',tct[i][7],15) + ">+</option><option value='-' " + selctd('-',tct[i][7],15) + ">-</option></select> <input type='text' name='qx[]' value='" + parseInt(tct[i][7].substr(16,4)) + "' maxlength='4' style='width:40px' />";
fadd += " &nbsp; <span onmouseover='vwtip(this,42)'>다운로드 </span>  <select name='qy[]'><option value='+' " + selctd('+',tct[i][7],20) + ">+</option><option value='-' " + selctd('-',tct[i][7],20) + ">-</option></select> <input type='text' name='qz[]' value='" + parseInt(tct[i][7].substr(21,4)) + "' maxlength='4' style='width:40px' />";
fadd += " &nbsp; <span onmouseover='vwtip(this,43)'>본문읽기 </span>  <select name='ra[]'><option value='+' " + selctd('+',tct[i][7],25) + ">+</option><option value='-' " + selctd('-',tct[i][7],25) + ">-</option></select> <input type='text' name='rb[]' value='" + parseInt(tct[i][7].substr(26,4)) + "' maxlength='4' style='width:40px' />";
fadd += " &nbsp; <span onmouseover='vwtip(this,66)'>추천 </span>  <select name='rw[]'><option value='+' " + selctd('+',tct[i][9],1) + ">+</option><option value='-' " + selctd('-',tct[i][9],1) + ">-</option></select> <input type='text' name='rx[]' value='" + parseInt(tct[i][9].substr(2,4)) + "' maxlength='4' style='width:40px' />";
fadd += "<span";
if(s15 != "1") fadd += " style='display:none'";
fadd += "><br />&nbsp;<span>메일통보</span>::";
fadd += "&nbsp;<input type='hidden' name='qr[]' value='" + tctt(tct[i][7],6) + "' /><label onmouseover='vwtip(this,29)'>게시판관리자에게 새글 메일통보 <input type='checkbox' onclick=\"chkchk7(this," + flst[i][2] + ")\" " + chckd(tct[i][7],6) + " class='no' /></label>";
fadd += " &nbsp; <input type='hidden' name='qs[]' value='" + tctt(tct[i][7],7) + "' /><label onmouseover='vwtip(this,29)'>글쓴이에게 덧글 메일통보 <input type='checkbox' onclick='chkck(this)' " + chckd(tct[i][7],7) + " class='no' /></label>";
fadd += "</span><div style='float:right;padding-right:10px'><input type='button' value='적용' onclick=\"bdpst(" + flst[i][2] + ",2)\" class='button' style='height:20px;width:100px' /></div><div style='clear:right'></div>";
fadd += "</div><span class='r7'>19.</span>&nbsp;태그 스타일구분 횟수: <input type='text' name='cqo[]' value='" + csff[i][3] + "'  />";
fadd += "<br /><span class='r7'>20.</span>&nbsp;css 삽입: <input type='text' name='cqn[]' value='" + csff[i][2] + "' style='width:300px' /><div style='float:right;padding-right:10px'>";
if(tctt(tct[i][0],63) == '1') {
fadd += "<font color='red'><a href=\"#none\" onclick=\"popup('admin.php?rss=" + encodeURIComponent(flst[i][1]) + "', 470,200);\" style=\"color:red\">rss주소 편집</a> &nbsp;  &nbsp; <a target=\"_blank\" href=\"exe.php?id=" + encodeURIComponent(flst[i][1]) + "&amp;read=1\" style=\"color:red\">rss리더 갱신</a>  &nbsp;  &nbsp; </font>";
}
fadd += "<input type='button' onmouseover='vwtip(this,88)' onclick='bdcopy(\"" + flst[i][1] + "\",2)' value='분산저장취소' class='button' style='width:70px' /> &nbsp; <input type='button' onmouseover='vwtip(this,28)' onclick='bdcopy(\"" + flst[i][1] + "\",1)' value='게시판복제' class='button' style='width:70px' /></div><div style='clear:right'></div></div><div style='float:left;width:310px' align='center'><textarea rows='1' cols='1' style='width:300px;height:50px;overflow:auto'>";
fadd += headat[i].replace(/\x7f/g,"\n");
fadd += "</textarea><input type='button' value='게시판상단 내용추가' onclick=\"mkhead(this,'head.dat','" + flst[i][1] + "')\" class='button' style='height:20px;width:160px' /><select name='rr[]'><option value='1' " + selctd('1',tct[i][0],70) + ">모바일에서 보임</option><option value='0' " + selctd('0',tct[i][0],70) + ">모바일에서 안보임</option></select></div>";
fadd += "<div style='float:left;width:310px' align='center'><textarea rows='1' cols='1' style='width:300px;height:50px;overflow:auto'>";
fadd += midat[i].replace(/\x7f/g,"\n");
fadd += "</textarea><input type='button' value='본문하단 내용추가' onclick=\"mkhead(this,'middle.dat','" + flst[i][1] + "')\" class='button' style='height:20px;width:160px' /></div>";
fadd += "<div style='float:left;width:310px' align='center'><textarea rows='1' cols='1' style='width:300px;height:50px;overflow:auto'>";
fadd += wtdat[i].replace(/\x7f/g,"\n");
fadd += "</textarea><input type='button' value='글쓰기 기본 양식 생성' onclick=\"mkhead(this,'wtform.dat','" + flst[i][1] + "')\" class='button' style='height:20px;width:160px' /></div><div style='clear:left'></div><h4>&nbsp;</h4></div></td></tr>";
}}
return fadd;
}

function idchg(ths) {
if(ths.readOnly && confirm('게시판 아이디를 변경하시겠습니까')) {
ths.readOnly = false;
ths.focus();
}}
function toggle(what) {
var tog = $(what);
tog.style.display=(tog.style.display != "block")?"block":"none";
}
function bdcopy(what,bdcd) {
document.mkfrm.removeChild(document.mkfrm.getElementsByTagName("input")[0]);
document.mkfrm.removeChild(document.mkfrm.getElementsByTagName("textarea")[0]);
if(bdcd == 2) {
var node = "<input type='hidden' name='ffilex' value='dstrbt' />";
node += "<input type='hidden' name='dstrbt' value='" + what +"' />";
} else {
var node = "<input type='hidden' name='ffilex' value='copy' />";
node += "<input type='hidden' name='bdcopy' value='" + what +"' />";
}
document.mkfrm.innerHTML = node;
document.mkfrm.submit();
}
function mkhead(ths,mfn,mid) {
document.mkfrm.mkid.value = mid;
document.mkfrm.mknm.value = mfn;
document.mkfrm.mktxt.value = ths.previousSibling.value;
document.mkfrm.submit();
}
function chkck(ths) {
ths.parentNode.previousSibling.value=(ths.parentNode.previousSibling.value == '1')?'0':'1';
}
function chkchk(ths,eye,pye,nye) {
if(nye == 3 && ths.parentNode.previousSibling.value != '1' && $$(pye,eye).value != '1') {$$(pye,eye).value = '1';$$(pye,eye).nextSibling.lastChild.checked = true;}
else if(nye == 2 && ths.parentNode.previousSibling.value == '1' && $$(pye,eye).value == '1') {$$(pye,eye).value = '0';$$(pye,eye).nextSibling.lastChild.checked = false;}
chkck(ths);
}
function chkchk2(ths) {
if(ths.parentNode.previousSibling.value == '1') {
ths.parentNode.previousSibling.value= '0';
ths.parentNode.nextSibling.style.display= 'none';
} else {
ths.parentNode.previousSibling.value= '1';
ths.parentNode.nextSibling.style.display= '';
}}
function chkchk3(ths,i,n) {
var hklm = Array('','ph[]','qk[]','ql[]','qm[]');
var wht = (n < 3)? hklm[n + 2]:hklm[n -2];
wht = $$(wht,i);
if(n != 1 && ths.parentNode.previousSibling.value != '1') {
$$('qq[]',i).value = '0';
$$('qq[]',i).nextSibling.lastChild.checked=false;
}
if(n < 3) {
if(ths.parentNode.previousSibling.value == '1') ths.parentNode.previousSibling.value = '0';
else {
ths.parentNode.previousSibling.value = '1';
if(n != 1 || $$('qq[]',i).value != 1) {
wht.value = '1';
wht.nextSibling.lastChild.checked=true;
}}} else {
if(ths.parentNode.previousSibling.value == '0') ths.parentNode.previousSibling.value = '1';
else {
ths.parentNode.previousSibling.value = '0';
wht.value = '0';
wht.nextSibling.lastChild.checked=false;
}}}
function chkchk4(ths,n) {
if(parseInt(ths.value) >= 3) {
if($$('qa[]',n).value == '0') {
$$('qa[]',n).value = '1';
$$('qa[]',n).nextSibling.lastChild.checked=true;
alert('불펌방지 3단계 이상에서는 게시판 목록형태가 고정되어야 합니다');
}
if(ths.value == '6' && ($$('pc[]',n).value != 'a' || $$('sa[]',n).value != 'a')) {
$$('pc[]',n).value = 'a';
$$('sa[]',n).value = 'a';
alert('불펌방지 6단계 대화상자에서는 덧글을 사용할 수 없습니다');
}}}
function chkchk5(ths,n) {
if(!ths.checked) {
if(parseInt($$('qn[]',n).value) >= 3) {$$('qn[]',n).value = '2';alert('불펌방지 3단계 이상에서는 게시판 목록형태가 고정되어야 합니다');}
ths.parentNode.previousSibling.value = '0';
} else ths.parentNode.previousSibling.value = '1';
}
function chkchk6(ths,i) {
if(ths.checked) {
ths.parentNode.previousSibling.value = '1';
$$('qk[]',i).value = '0';
$$('qk[]',i).nextSibling.lastChild.checked=false;
$$('qm[]',i).value = '0';
$$('qm[]',i).nextSibling.lastChild.checked=false;
$$('ql[]',i).value = '0';
$$('ql[]',i).nextSibling.lastChild.checked=false;
} else ths.parentNode.previousSibling.value = '0';
}
function chkchk7(ths,i) {
if(ths.checked) {
if($$('tct2[]',i).value == '') {
ths.checked = false;
alert('게시판관리자가 없습니다');
$$('tct2[]',i).focus();
} else ths.parentNode.previousSibling.value = '1';
} else ths.parentNode.previousSibling.value = '0';
}
function chkchk8(ths,eye,pye,nye) {
if(nye == 3 && ths.value != 'a' && ($$(pye,eye).value == 'a' || parseInt(ths.value) < parseInt($$(pye,eye).value))) $$(pye,eye).value = ths.value;
else if(nye == 2 && $$(pye,eye).value != 'a' && (ths.value == 'a' || parseInt(ths.value) > parseInt($$(pye,eye).value))) $$(pye,eye).value = ths.value;
}
function chkchk9(ths,eye,pye) {
if(ths.value == '0') {$$(pye,eye).value = '0';$$(pye,eye).nextSibling.lastChild.checked = false;$$(pye,eye).nextSibling.style.display = "none";}
else $$(pye,eye).nextSibling.style.display = "";
}
function chkchk10(ths,i) {
if(ths.checked) {
ths.parentNode.previousSibling.value = '1';
ths.parentNode.nextSibling.style.display = 'none';
$$('sm[]',i).value = '0';
$$('sm[]',i).nextSibling.lastChild.checked=false;
$$('sn[]',i).value = '0';
$$('sn[]',i).nextSibling.lastChild.checked=false;
$$('so[]',i).value = '0';
$$('so[]',i).nextSibling.lastChild.checked=false;
} else {
ths.parentNode.previousSibling.value = '0';
ths.parentNode.nextSibling.style.display = '';
}}
function $$$(nae,i,lh) {
var val = '';
var nval = $$(nae,i);
if(!nval) val = '';
else {val = nval.value;if(!val) val = '';}
if(lh != 0) {while(val.length < lh) {val = "0" + val;}}
return val;
}
function infval(nname,nvalue) {
var nput = document.createElement("input");
nput.setAttribute("type","hidden");
nput.setAttribute("name",nname);
nput.setAttribute("value",nvalue);
return nput;
}

function bdpst(ix,iy) {
iy = (iy == 1)? iyy:ix + 1;
var pform = document.pstfm;
if(ix != 0) pform.from.value = pform.from.value + "&open=" + iy;
var abcntt = $('abcnt').value;
for(var i = ix;i < iy;i++) {
pform.appendChild(infval('order[]',$$$('order[]',i,0)));
pform.appendChild(infval('id[]',$$$('id[]',i,0)));
pform.appendChild(infval('nam[]',$$$('nam[]',i,0)));
pform.appendChild(infval('lastcnt[]',$$$('lastno[]',i,6) + $$$('cnt[]',i,6) + $$$('wlastno[]',i,6) + $$$('wcnt[]',i,6) + abcntt));
pform.appendChild(infval('tct1[]',$$$('tct1[]',i,0)));
pform.appendChild(infval('tct2[]',$$$('tct2[]',i,0)));
pform.appendChild(infval('tct5[]',$$$('sa[]',i,1) + $$$('sb[]',i,1) + $$$('sc[]',i,1) + $$$('sd[]',i,1) + $$$('se[]',i,1) + $$$('sg[]',i,1) + $$$('sh[]',i,3) + $$$('si[]',i,3)));
pform.appendChild(infval('tct0[]',$$$('pl[]',i,1) + $$$('pr[]',i,1) + $$$('pw[]',i,1) + $$$('pc[]',i,1) + $$$('pt[]',i,1) + $$$('py[]',i,1) + $$$('pv[]',i,1) + $$$('px[]',i,1) + $$$('pz[]',i,1) + $$$('pp[]',i,1) + $$$('pu[]',i,1) + $$$('pq[]',i,1) + $$$('pm[]',i,2) + $$$('po[]',i,2) + $$$('pd[]',i,1) + $$$('pe[]',i,1) + $$$('pf[]',i,1) + $$$('pg[]',i,1) + $$$('ph[]',i,1) + $$$('qe[]',i,1) + $$$('qf[]',i,1) + $$$('pa[]',i,1) + $$$('pb[]',i,1) + $$$('pi[]',i,1) + $$$('pj[]',i,1) + $$$('pk[]',i,1) + $$$('pn[]',i,1) + $$$('ps[]',i,1) + $$$('qa[]',i,1) + $$$('qb[]',i,1) + $$$('qc[]',i,1) + $$$('qg[]',i,1) + $$$('qh[]',i,2) + $$$('qk[]',i,1) + $$$('ql[]',i,1) + $$$('qm[]',i,1) + $$$('rj[]',i,1) + $$$('rk[]',i,1) + $$$('rl[]',i,1) + $$$('rm[]',i,1) + $$$('rn[]',i,1) + $$$('ro[]',i,1) + $$$('rp[]',i,1) + $$$('rq[]',i,1) + $$$('rr[]',i,1) + $$$('rs[]',i,1) + $$$('rt[]',i,1) + $$$('ru[]',i,1)));
pform.appendChild(infval('tct7[]',$$$('qd[]',i,1) + $$$('qj[]',i,1) + $$$('qn[]',i,1) + $$$('qo[]',i,1) + $$$('qp[]',i,1) + $$$('qq[]',i,1) + $$$('qr[]',i,1) + $$$('qs[]',i,1) + $$$('qt[]',i,1) + $$$('rc[]',i,1) + $$$('qu[]',i,1) + $$$('qv[]',i,4) + $$$('qw[]',i,1) + $$$('qx[]',i,4) + $$$('qy[]',i,1) + $$$('qz[]',i,4) + $$$('ra[]',i,1) + $$$('rb[]',i,4) + $$$('rd[]',i,1) + $$$('re[]',i,1) + $$$('rf[]',i,1) + $$$('ri[]',i,1) + $$$('sj[]',i,1) + $$$('sk[]',i,1)));
pform.appendChild(infval('tct8[]',$$$('qi[]',i,1) + $$$('rg[]',i,1) + $$$('rh[]',i,0)));
pform.appendChild(infval('tct9[]',$$$('rv[]',i,1) + $$$('rw[]',i,1) + $$$('rx[]',i,4) + $$$('ry[]',i,1) + $$$('rz[]',i,4) + $$$('sl[]',i,1) + $$$('sm[]',i,1) + $$$('sn[]',i,1) + $$$('so[]',i,1)));
pform.appendChild(infval('idd[]',$$$('idd[]',i,0)));
pform.appendChild(infval('rdt[]',$$$('cql[]',i,1) + $$$('cqm[]',i,1) + $$$('csf[]',i,0)));
pform.appendChild(infval('addcss[]',$$$('cqn[]',i,0)));
pform.appendChild(infval('tgsprt[]',$$$('cqo[]',i,0)));
}
pform.appendChild(infval('mode','modi'));
pform.submit();
}
function dell(i) {
var pform = document.pstfm;
pform.appendChild(infval('mode','dell'));
pform.appendChild(infval('id',$$$('id[]',i,0)));
pform.submit();
}
function mdset17(ths) {
var pform = document.pstfm;
pform.appendChild(infval('xh',ths.previousSibling.value));
pform.submit();
}
function openall() {
var oclo = ($('bdwdth0').style.display != "block")?"block":"none";
for(var i=0;i < s17cnt;i++) {
if($('bdwdth' + i)) $('bdwdth' + i).style.display = oclo;
}
}
function vwtip(ths,i) {
var ttitle = Array("목록에서 게시물 출력 형태, 또는 게시판 종류 설정",
"한 목록에 출력할 게시물 갯수",
"분류(카테고리) 추가, 수정, 삭제",
"목록(제목형)에 출력할 항목 선택",
"권한제한설정(0~9) : 목록 보기",
"권한제한설정(0~9) : 본문 보기",
"권한제한설정(0~9) : 새 글 작성",
"권한제한설정(0~9) : 덧글 작성",
"게시판목록과 대문에서, 마우스오버했을 때 미리보기 설정",
"게시판 추가설정사항 열기/닫기",
"게시판관리자로 설정할 회원id",
"목록상단에 출력 여부",
"목록상단/하단에 분류박스나 분류선택상자 출력 여부",
"목록상단/하단에 번호,제목,이름,날짜,조회,덧글,추천,활성 등의  항목별 정렬 선택상자 출력 여부",
"게시판 rss피드 출력 여부",
"제목형, 본문형, 갤러리형 등의 게시판 목록형태 고정 여부",
"게시물 본문 하단에 게시판 목록 출력  여부",
"본문에 글쓴이(회원)의 서명 출력 여부",
"본문에 링크주소 출력 여부",
"rss피드 본문길이제한 적용 여부",
"번호/제목/날짜 등의 항목별 정렬 사용 여부",
"데이타 추가입력 사용",
"전체설정의 업로드파일 크기제한 적용 여부",
"나열된 게시판 전체의 설정을 저장합니다",
"전자의 ip를 후자에게 노출합니다",
"대문에 출력할 최근글 갯수",
"권한제한설정(0~9) : 덧글 읽기",
"게시판이 포함될 섹션선택",
"게시판_bk라는 게시판으로 게시판 복제하기",
"추천, 비추기능 사용 여부 선택",
"게시판데이타에서 게시판설정을 찾아 board.bak에 저장합니다",
"게시판 추가설정사항 모두 열기/닫기",
"게시물본문,덧글의 글자크기",
"게시물본문,덧글의 글꼴",
"본문,덧글에서 IP사용 안하는 대상",
"게시판 목록하단에 [전체]버튼(=대문링크) 출력 여부",
"본문 불펌 방지 선택\n 1단계:블록선택 차단\n 2단계:Ctrl키 차단\n 3단계:투명막+선택해제\n 4단계:ajax,iframe 차단\n 5단계:본문 대화상자\n 6단계:목록 대화상자",
"권한제한설정(0~9) : 첨부파일 다운로드",
"권한제한설정(0~9) : 공지글 읽기, 본문읽기권한보다 낮게 설정할 수 있습니다",
"평점(별점)기능 사용",
"포인트설정 : 본문쓰기",
"포인트설정 : 덧글쓰기",
"포인트설정 : 다운로드",
"포인트설정 : 본문읽기",
"좌우메뉴/대문의 최근글에 이 게시판을 제외시킬 것인지를 선택합니다",
"좌우메뉴/대문의 최근덧글에 이 게시판을 제외시킬 것인지를 선택합니다",
"분류 등의 목록 상단 항목을 출력할 위치나 출력 여부",
"태그(=꼬리표) 사용 여부",
"권한제한설정(0~9) : 첨부파일 업로드",
"목록과 대문에 NEW이미지 표시  여부",
"목록에 HOT이미지 표시  여부",
"기본은 간접링크/보안위주,\n 노출경로는 성능위주/확장자제한",
"이 게시판의 본문,덧글을\n 각 글쓴이 회원의 회원로그에서\n 제외합니다",
"rss피드를 수집하는 게시판으로 설정합니다",
"익명게시판으로 설정합니다",
"최근 덧글 또는 최근 글순으로 정렬합니다",
"본문삭제시 데이타삭제 없이,\n 데이타숨김으로 처리합니다",
"전체설정 - 변경금지 설정의 적용  여부와 적용 범위 선택 ",
"게시판 목록과 대문에서,\n 덧글표시에 덧글 링크(새창)를 출력할 지  여부를 설정합니다.",
"게시판 목록과 대문에서,\n 게시물에 저장된 링크를 목록에 표시할 지  여부를 설정합니다.",
"게시판 목록과 대문에서,\n 본문에 이미지를 미리보기 등에 표시할 지  여부를 설정합니다.",
"게시판 목록과 대문에서,\n 본문일부를 미리보기 등에 표시할지  여부를 설정합니다.",
"본문에 추가입력 표시하는 파일 편집",
"글쓰기에 추가입력 항목 삽입하는 파일 편집",
"추가입력항목 게시판 목록에 표시 여부 :: 스킨에 치환자가 추가되어 있어야 함 :: 목록 치환자는 <#addfield_번호#> ",
"권한제한설정(0~9) : 추천,비추,평점",
"포인트설정 : 추천,비추,평점 - 추천한 회원에게",
"피추천 포인트 가감방식",
"피추천수의 몇퍼센트를 글쓴이 회원의 포인트에 적립할 것인지를 설정합니다.",
"덧글의 스킨을 게시판스킨과 별도로 설정합니다",
"덧글에 추천 사용 여부",
"덧글에 비추 사용 여부",
"글쓰기할 때 본문이 비어도 링크나 추가입력이 있으면 입력이 되도록 함",
"글쓰기할 때 본문입력란 출력 안 함",
"글쓰기할 때 링크입력란을 노출함",
"본문 읽기 권한이 없고, 링크주소가 있는 경우 바로 링크주소로 연결합니다",
"관리자기능 - 게시판관리 목록에 게시판 출력 갯수를 변경합니다",
"위 게시판(들)의 게시물 총갯수를 다시 계산합니다",
"게시판 데이타파일의 무결성을 체크합니다.",
"목록상단/하단에 월별목록 선택상자 출력 여부",
"섹션 좌우메뉴 넓이 설정 - 전체설정이나 섹션관리-[좌우]메뉴 배치창의 설정보다 우선적으로 적용됩니다",
"목록상단/하단에 로그인 링크 아이콘 출력 여부 ",
"답글 (덧글이 아닌 본문으로 작성하는 답글) 허용 여부 ",
"본문에 트위터, 페이스북 등의 sns 스크랩 지원하는 아이콘 출력 여부 ",
"트랙백(엮은글) 사용 여부 -  '사용 안 함'으로 설정하면 글쓰기에서 설정하는 보다 자세한 권한 설정 가능해집니다",
"글쓰기에서 덧글쓰기 권한설정 허용 여부 ",
"글쓰기에서 덧글읽기 권한설정 허용 여부 ",
"글쓰기에서 첨부파일 다운로드 권한설정 허용 여부",
"분산저장 취소하고 데이타 파일을 한군데로 모음");
if(ttitle[i]) {
if(ths && ths.innerHTML) ttitle[i] = ths.innerHTML +" ::\n " +ttitle[i];
else if(ths && ths.value) ttitle[i] = ths.value +" ::\n " +ttitle[i];
$('admtip').innerHTML = ttitle[i];
}}

document.title = "게시판관리";
document.onreadystatechange = function(){if(document.readyState == "complete" && $$('bdstfm',0).innerHTML.length < 2) {$$('bdstfm',0).innerHTML = rtfadd();setTimeout("jsaccum()",500);}}
window.onload = function() {if($$('bdstfm',0).innerHTML.length < 2) {$$('bdstfm',0).innerHTML = rtfadd();setTimeout("jsaccum()",500);}}
setTimeout("if($$('bdstfm',0).innerHTML.length < 2) {$$('bdstfm',0).innerHTML = rtfadd();setTimeout('jsaccum()',500);}",2000);