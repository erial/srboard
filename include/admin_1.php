<?php
// 관리자기능
function modify_set($sett) {
global $set;
$fp = fopen($set,"w");
fputs($fp, $sett[0]."\x1b".$sett[1]."\x1b".$sett[2]."\x1b".$sett[3]."\x1b".$sett[4]."\x1b".$sett[5]."\x1b".$sett[6]."\x1b".$sett[7]."\x1b".$sett[8]."\x1b".$sett[9]."\x1b".$sett[10]."\x1b".$sett[11]."\x1b".$sett[12]."\x1b".$sett[13]."\x1b".$sett[14]."\x1b".$sett[15]."\x1b".$sett[16]."\x1b".$sett[17]."\x1b".$sett[18]."\x1b".$sett[19]."\x1b".$sett[20]."\x1b".$sett[21]."\x1b".$sett[22]."\x1b".$sett[23]."\x1b".$sett[24]."\x1b".$sett[25]."\x1b".$sett[26]."\x1b".$sett[27]."\x1b".$sett[28]."\x1b".$sett[29]."\x1b".$sett[30]."\x1b".$sett[31]."\x1b".$sett[32]."\x1b".$sett[33]."\x1b".$sett[34]."\x1b".$sett[35]."\x1b".$sett[36]."\x1b".$sett[37]."\x1b".$sett[38]."\x1b".$sett[39]."\x1b".$sett[40]."\x1b".$sett[41]."\x1b".$sett[42]."\x1b".$sett[43]."\x1b".$sett[44]."\x1b".$sett[45]."\x1b".$sett[46]."\x1b".$sett[47]."\x1b".$sett[48]."\x1b".$sett[49]."\x1b".$sett[50]."\x1b".$sett[51]."\x1b".$sett[52]."\x1b".$sett[53]."\x1b".$sett[54]."\x1b".$sett[55]."\x1b".$sett[56]."\x1b".$sett[57]."\x1b".$sett[58]."\x1b".$sett[59]."\x1b".$sett[60]."\x1b".$sett[61]."\x1b".$sett[62]."\x1b".$sett[63]."\x1b".$sett[64]."\x1b".$sett[65]."\x1b".$sett[66]."\x1b".$sett[67]."\x1b".$sett[68]."\x1b".$sett[69]."\x1b".$sett[70]."\x1b".$sett[71]."\x1b".$sett[72]."\x1b".$sett[73]."\x1b".$sett[74]."\x1b".$sett[75]."\x1b".$sett[76]."\x1b".$sett[77]."\x1b".$sett[78]."\x1b".$sett[79]."\x1b".$sett[80]."\x1b".$sett[81]."\x1b".$sett[82]."\x1b".$sett[83]."\x1b".$sett[84]."\x1b".$sett[85]."\x1b".$sett[86]."\x1b".$sett[87]."\x1b".$sett[88]."\x1b".$sett[89]."\x1b".$sett[90]."\x1b".$sett[91]."\x1b".$sett[92]."\x1b".$sett[93]."\x1b");
fclose($fp);
}
function fchr($value) {
$value = str_replace("%2F","/",urlencode($value));
return $value;
}
function RmDirR($dzr) {
if(@is_dir($dzr)) {
if($d = opendir($dzr)) {
while($entry = readdir($d)) {
if($entry != "." && $entry != "..") {
if(is_dir($dzr."/".$entry)) RmDirR($dzr."/".$entry);
else @unlink($dzr."/".$entry);
}
}
closedir($d);
}
@rmdir($dzr);
}}
function dircopy($copyfs,$copyfw,$mkd) {
if($mkd && !file_exists($copyfw)) @mkdir($copyfw, 0777);
if(substr($copyfw,-1) == '/') $copyfw = substr($copyfw,0,-1);
$d = dir($copyfs);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
if(is_dir($copyfs."/".$entry)) dircopy($copyfs."/".$entry,$copyfw."/".$entry,1);
else @copy($copyfs."/".$entry, $copyfw."/".$entry);
}
}
$d->close();
}
if($_GET['renewcache']) { /*-5-*/
if($_GET['renewcache'] == 'all') {
RmDirR($dxr."_member_/_bak_");
mkdir($dxr."_member_/_bak_",0777);
scrhref('?',0,0);
} else {
@unlink($dxr."_member_/_bak_/gatebk1_".$_GET['renewcache'].".dat");
@unlink($dxr."_member_/_bak_/gatebk2_".$_GET['renewcache'].".dat");
echo "<script type='text/javascript'>/*<![CDATA[*/parent.setup();/*]]>*/</script>";
}
exit;
} /*-5-*/
if($_POST['xh']) { /*-5-*/
$sett[17] = $_POST['xh'];
modify_set($sett);
scrhref($_POST['from'],0,0);exit;
} /*-5-*/
if($_POST['arr'] || $_GET['sect_arr'] || $_GET['section']) { /*-5-*/
$sxvtm['10days_graph'] = "10일간_방문자수";
$sxvtm['all_menu'] = "전체메뉴";
$sxvtm['hot_post'] = "전체최근글";
$sxvtm['hot_reple'] = "전체최근덧글";
$sxvtm['all_search'] = "전체검색";
$sxvtm['all_section'] = "전체섹션";
$sxvtm['all_section2'] = "전체섹션2";
$sxvtm['blog_profile'] = "블로그프로필";
$sxvtm['calendar'] = "달력";
$sxvtm['category'] = "카테고리";
$sxvtm['counter'] = "카운터";
$sxvtm['gagalive'] = "gagalive채팅";
$sxvtm['member_login'] = "회원로그인";
$sxvtm['member_rank'] = "회원랭킹";
$sxvtm['order_by_hit'] = "조회순덧글순";
$sxvtm['realtime_visitor'] = "실시간_방문자";
$sxvtm['recent_rp'] = "최근덧글";
$sxvtm['sect_boards'] = "섹션게시판";
$sxvtm['sect_boards2'] = "섹션게시판2";
$sxvtm['sect_recent'] = "섹션최근글";
$sxvtm['tag'] = "태그";
$sxvtm['trackback'] = "트랙백";
$sxvtm['menu_plus'] = "추가메뉴";
$sxvtm['research'] = "설문조사";
$sxvtm['bd_thumb'] = "게시판썸네일";
$sxvtm['bd_list'] = "게시판 하나";
$sxvtm['bd_list2'] = "게시판 두개";
$sxvtm['bd_list_rp'] = "게시판 + 덧글";
$sxvtm['by_hot'] = "전체인기순";
$sxvtm['by_hot1'] = "섹션조회덧글순";
$sxvtm['by_hot2'] = "전체조회덧글순";
$sxvtm['clock'] = "시계";
$sxvtm['member_on'] = "접속중인 회원";
$sxvtm['nconnect'] = "접속자수";

$smod = opendir("module");
while($smodd = readdir($smod)) {
$smo = substr($smodd,0,-4);
$sxt = substr($smodd,-4);
if($sxt == '.ph_') {if(!$sxvtm[$smo]) $sxvtm[$smo] = $smo;}
else if($sxt == '.php' && $smodd[0] != '_') $secto[] = $smo;
else if($sxt == '.css' && $smodd[0] == '_') $stcss[] = substr($smo,1);
}
closedir($smod);
@sort($secto);
if($_POST['arr']) {
$mtvxs = array_flip($sxvtm);
$stccs = '';
usleepp($dxr."section_arr.dat@@");
$smt = fopen($dxr."section_arr.dat@@","w");
$sm = fopen($dxr."section_arr.dat","r");
for($ii=1;(!feof($sm) || $ii <= $_POST['arr']);$ii++) {
$smo = fgets($sm);
if($ii == $_POST['arr']) {
$sm2 = explode("@@",trim($smo));
$smo = '';
for($i = 0;$_POST['subs'][$i];$i++) {
$smn = substr($_POST['subs'][$i],2);
if($stcss && in_array($smn,$stcss)) $stccs .= "@import url('_".$smn.".css'); /* @@ */\n";
$smo .= "@".substr($_POST['subs'][$i],0,2).$mtvxs[$smn];
}
if($_POST['geb']) $smo = $smo."@@".$smo;
else $smo = ($_POST['gob'] == 1)? $sm2[0]."@@".$smo:$smo."@@".$sm2[1];
$stcssf = "module/sectcss_".$ii.".css";
if($stccs || file_exists($stcssf)) {
if($stss = @fopen($stcssf,"r")) {
while($stsso = fgets($stss)) {
if(substr($stsso,-11) != "; /* @@ */\n") $stccs .= $stsso;
}
fclose($stss);
}
if($stccs) {
$stss = fopen($stcssf,"w");
fputs($stss,$stccs);
fclose($stss);
} else unlink($stcssf);
}
$arrmdfd = 0;
if($_POST['geb']) {if($_POST['gob'] == 1) {$sm2[2] = $_POST['arr_left1'];$sm2[3] = $_POST['arr_right1'];$sm2[6] = $_POST['arr_lftrgt1'];} else {$sm2[4] = $_POST['arr_left0'];$sm2[5] = $_POST['arr_right0'];$sm2[7] = $_POST['arr_lftrgt0'];}}
if($_POST['gob'] == 1) $smo .= "@@".(int)$sm2[2]."@@".(int)$sm2[3]."@@".(int)$_POST['arr_left1']."@@".(int)$_POST['arr_right1']."@@".(int)$sm2[6]."@@".(int)$_POST['arr_lftrgt1']."\n";
else {$smo .= "@@".(int)$_POST['arr_left0']."@@".(int)$_POST['arr_right0']."@@".(int)$sm2[4]."@@".(int)$sm2[5]."@@".(int)$_POST['arr_lftrgt0']."@@".(int)$sm2[7]."\n";if($_POST['arr_left0'] != $sm2[2] || $_POST['arr_right0'] != $sm2[3]) $arrmdfd = 1;}
} else if($ii < $_POST['arr'] && trim($smo) == '') $smo = "\n";
fputs($smt,$smo);
}
fclose($sm);
fclose($smt);
copy($dxr."section_arr.dat@@",$dxr."section_arr.dat");
unlink($dxr."section_arr.dat@@");
scrhref('?sect_arr='.$_POST['arr'].'&amp;gob='.$_POST['gob'].'&amp;mdfd='.$arrmdfd,0,0);exit;
}} /*-5-*/
if($_POST['bdcopy'] && $_POST['ffilex'] == 'copy') { /*-5-*/
$copyto = substr($_POST['bdcopy'],0,7).'_bk';
while(file_exists($dxr.$copyto)) {$end = strpos($copyto,'_bk');if($end) {$copyto = substr($copyto,0,$end - 1).substr($copyto,$end).'k';} else exit;}
$fs = fopen($ds,"a+");
$fc = fopen($dc,"a+");
while(!feof($fs)){
$fso = fgets($fs);
$fco = fgets($fc);
if(trim(substr($fso, 0, 10)) == $_POST['bdcopy']) {
fputs($fs,str_pad($copyto,10).substr($fso,10));
fputs($fc,$fco);
$ok = 2;
break;
}}
fclose($fs);
fclose($fc);
if($ok == 2) {
dircopy($dxr.$_POST['bdcopy'],$dxr.$copyto,1);
if(file_exists("icon/".$_POST['bdcopy']) && is_dir("icon/".$_POST['bdcopy'])) dircopy("icon/".$_POST['bdcopy'],"icon/".$copyto,1);
}
scrhref('?board=1',1,0);
exit;
} /*-5-*/
if($_POST['dstrbt'] && $_POST['ffilex'] == 'dstrbt') { /*-5-*/
usleepp($ds."@@");
copy($ds, substr($ds,0,-3)."bak");
$jds = fopen($ds."@@","w");
$fs = fopen($ds,"r");
$wdth6 = -1;
while(!feof($fs)) {
$sss = fgets($fs);
if($wdth6 == -1) {
if($_POST['dstrbt'] == trim(substr($sss, 0, 10))) {
$ss = explode("\x1b", $sss);
$wdth6 = $ss[6];
$sss = $ss[0]."\x1b".$ss[1]."\x1b".$ss[2]."\x1b".$ss[3]."\x1b".$ss[4]."\x1b".$ss[5]."\x1b\x1b".$ss[7]."\x1b".$ss[8]."\x1b".$ss[9]."\x1b\n";
}}
fputs($jds,$sss);
}
fclose($fs);
fclose($jds);
copy($ds."@@",$ds);
unlink($ds."@@");
$nlb = array('no','list','body','rbody','rlist');
foreach($nlb as $nlbr) {
$fnlb = fopen($dxr.$_POST['dstrbt']."/".$nlbr.".dat","a");
for($i = $wdth6;$i > 0;$i--) {
$jfnl = $dxr.$_POST['dstrbt']."/^".$i."/".$nlbr.".dat";
$jfnlb = fopen($jfnl,"r");
while(!feof($jfnlb)) fputs($fnlb,fgets($jfnlb));
fclose($jfnlb);
unlink($jfnl);
}
fclose($fnlb);
}
for($i = $wdth6;$i > 0;$i--) {RmDirR($dxr.$_POST['dstrbt']."/^".$i);}
fclose(fopen($dxr.$_POST['dstrbt']."/bno.dat","w"));
scrhref('?board=1',1,0);
exit;
} /*-5-*/
if($_GET['bd_uninstall'] == $mbr_id) { /*-5-*/
if($mbr_id && $mbr_level == 9) {
RmDirR(".");
ssckdxl();
echo "<h1>srboard 언인스톨 되었습니다.</h1>";
exit;
}} else if($_POST['mode'] == "new" && $_POST['id'] && $_POST['nam']) { /*-5-*/
if($_POST['id'] != "_member_" && preg_replace("`[a-z0-9_]+`i","",$_POST['id']) == ''){
$sss = str_pad(substr($_POST['id'],0,10), 10)."0000000000000000".$_POST['pt']."01011110620111109211101090001001000000000001111\x1b".$_POST['nam']."\x1bsrb_8\x1b\x1b\x1b000000000000\x1b\x1b0000100001+0005+0002-0000+0000201001\x1b01100\x1b0+0000000001000\x1b\n";
$fs = fopen($ds,"a");
fputs($fs,$sss);
fclose($fs);
$fc = fopen($dc,"a");
fputs($fc,"\x1b\n");
fclose($fc);
mkdir($dxr.$_POST['id'], 0777);
mkdir($dxr.$_POST['id']."/files", 0777);
fclose(fopen($dxr.$_POST['id']."/body.dat","w"));
fclose(fopen($dxr.$_POST['id']."/list.dat","w"));
fclose(fopen($dxr.$_POST['id']."/no.dat","w"));
fclose(fopen($dxr.$_POST['id']."/rbody.dat","w"));
fclose(fopen($dxr.$_POST['id']."/rlist.dat","w"));
fclose(fopen($dxr.$_POST['id']."/new_rp.dat","w"));
fclose(fopen($dxr.$_POST['id']."/upload.dat","w"));
fclose(fopen($dxr.$_POST['id']."/stb.dat","w"));
fclose(fopen($dxr.$_POST['id']."/rtb.dat","w"));
fclose(fopen($dxr.$_POST['id']."/bno.dat","w"));
fclose(fopen($dxr.$_POST['id']."/rss.dat","w"));
fclose(fopen($dxr.$_POST['id']."/tag.dat","w"));
fclose(fopen($dxr.$_POST['id']."/vote.dat","w"));
fclose(fopen($dxr.$_POST['id']."/head.dat","w"));
fclose(fopen($dxr.$_POST['id']."/date.dat","w"));
fclose(fopen($dxr.$_POST['id']."/notice.dat","w"));
$rset = fopen($dxr.$_POST['id']."/set.dat","w");
fputs($rset,"\n11\n\n");
fclose($rset);
$frlst = fopen($dxr.$_POST['id']."/last_rp.dat","w");
fputs($frlst,"1");
fclose($frlst);
}
scrhref($_POST['from'],0,0);exit;
} else if($_POST['mode'] && $_POST['mode'] != "new") { /*-5-*/
function lrs_member($mdm,$mdn) {
global $dxr,$time;
$mbrdr = $dxr."_member_/";
$rnm = opendir($mbrdr);
while($rnmo = readdir($rnm)) {
if($rnmo[0] == "l" || $rnmo[0] == "r" || $rnmo[0] == "s") {
if(@filesize($mbrdr.$rnmo)) {
usleepp($mbrdr.$rnmo."@@");
$nmt = fopen($mbrdr.$rnmo."@@","w");
$nm = fopen($mbrdr.$rnmo,"r");
while($nmo = fgets($nm)) {
if(substr($nmo,0,10) == $mdm) {
if(!$mdn) $nmo = '';
else $nmo = $mdn.substr($nmo,10);
if(!$onk) $onk = 1;
}
fputs($nmt,$nmo);
}
fclose($nm);
fclose($nmt);
if($onk) copy($mbrdr.$rnmo."@@",$mbrdr.$rnmo);
unlink($mbrdr.$rnmo."@@");
}
}
}
closedir($rnm);
}
function aacnt($vv,$ud,$vu) {
global $dxr;
	$vi = 0;
	$vh = 0;
	$vw = 1;
	if($vu) $vn = @fopen($dxr.$ud."/^1/no.dat","r");
	else $vn = fopen($dxr.$ud."/no.dat","r");
	while($vn) {
	$vno = fgets($vn);
	if(trim($vno) == '') {
	fclose($vn);
	$vbb[$vw][1] = str_pad($vi,6,0,STR_PAD_LEFT);
	$vbb[$vw][2] = str_pad($vh,6,0,STR_PAD_LEFT);
	if($vw <= $vu) {
	$vw++;
	if($vw <= $vu && file_exists($dxr.$ud."/^".$vw."/no.dat")) $vn = fopen($dxr.$ud."/^".$vw."/no.dat","r");
	else {$vn = fopen($dxr.$ud."/no.dat","r");$vw = $vu + 1;}
	$vh = 0;
	} else break;
	} else {
	if(!$vv || substr($vno,6,2) != 'aa') {
	if($vh == 0) $vbb[$vw][0] = substr($vno,0,6);
	$vi++;
	$vh++;
	}}}
if($vu) {
$vbn = fopen($dxr.$ud."/bno.dat","w");
for($va=1;$va <= $vu;$va++) {
if($vbb[$va]) {
fputs($vbn,$vbb[$va][0].$vbb[$va][1].$vbb[$va][2]."\n");
}}
fclose($vbn);
}
$vbb[$vw][2] = count($vbb) -1;
if($vbb[$vw][2] < 0) $vbb[$vw][2] = 0;
if(!$vbb[$vw][0]) {if($vbb[$vu][0]) $vbb[$vw][0] = $vbb[$vu][0];else $vbb[$vw][0] = '000000';}
return $vbb[$vw];
}
function sectbodc($bdaa,$bdbb) {
global $time, $dxr;
$bdaa = "^{$bdaa}^";
$bdbb = ($bdbb)? "^{$bdbb}^":"^";
$secfile = $dxr."section.dat";
usleepp($secfile."@@");
if($rfi = @fopen($secfile,"r")) {
$jfi = fopen($secfile."@@","w");
while($rfio = fgets($rfi)) {
$rfoo = explode("\x1b",$rfio);
$rfoo[2] = substr(str_replace($bdaa,$bdbb,"^{$rfoo[2]}^"),1,-1);
fputs($jfi,$rfoo[0]."\x1b".$rfoo[1]."\x1b".$rfoo[2]."\x1b".$rfoo[3]."\x1b".$rfoo[4]."\x1b".$rfoo[5]."\x1b".$rfoo[6]."\x1b\n");
}
fclose($rfi);
fclose($jfi);
copy($secfile."@@",$secfile);
unlink($secfile."@@");
}}
function wdthwdth($qhidi,$qht) {
global $time, $dxr;
if($qht == 1) {$qhfrom = $dxr.$qhidi."/files/";$qhto = "icon/".$qhidi."/";}
else {$qhfrom = "icon/".$qhidi."/";$qhto = $dxr.$qhidi."/files/";}
if(is_dir($qhfrom)) {
if(!file_exists($qhto)) {if(!mkdir($qhto)) return;}
$qhvip = 0;$qisimg = 0;
$qhd = $dxr.$qhidi."/upload.dat";
while($qhtime - @filemtime($qhd."@@") < 3) {usleep(50000);$qhtime = time();}
$qhjd = fopen($qhd."@@","w");
$qhf = fopen($qhd,"r");
while($qhfo = fgets($qhf)){
$qhvip += strlen($qhfo);
if(trim($qhfo)) {
$qhfname = substr($qhfo, 6, -13);
if($qhextt = strrpos($qhfname,".")) $qhext = strtolower(substr($qhfname,$qhextt));else $qhext = '';
if($qhfname[20] == '/') {$qhdest = substr($qhfname,0,20);$qhfname = substr($qhfname,21);$qhfile = str_replace("%","",urlencode($qhfname));} else {$qhdest = str_replace("%","",urlencode($qhfname));$qhfile = $qhdest;}
$qhnfile = substr(md5($qhfname.$time),rand(0,10),(20 - strlen($qhext))).$qhext;
if($qhext == ".jpg" || $qhext == ".gif" || $qhext == ".png") $qismig = substr($qhfile,0,-4)."_s.jpg";else $qismig = 0;
$qhfo = substr($qhfo,0,6).$qhnfile."/".$qhfname.substr($qhfo,-13);
if(!file_exists($qhfrom.$qhdest)) $qhfo = '';
else {copy($qhfrom.$qhdest,$qhto.$qhnfile);unlink($qhfrom.$qhdest);
if($qismig && file_exists($qhthumb = $qhfrom.$qismig)) {copy($qhthumb,$qhto.$qismig);unlink($qhthumb);}
}}
fputs($qhjd,$qhfo);$qhvip -= strlen($qhfo);
}
fclose($qhf);
fclose($qhjd);
if(filesize($qhd) == filesize($qhd."@@") + $qhvip) copy($qhd."@@",$qhd);
unlink($qhd."@@");
@rmdir($qhfrom);
}
}
usleepp($ds."@@");
copy($ds, substr($ds,0,-3)."bak");
$jds = fopen($ds."@@","w");
$fs = fopen($ds,"r");
$ii = 0;
$i = 0;
$sectpm = array();
while(!feof($fs)) {
$sss = fgets($fs);
$mdm = substr($sss, 0, 10);
if($mdt = trim($mdm)) {
$i = $ii - $_POST['order'][0];
$ss = explode("\x1b", $sss);
if($_POST['mode'] == 'dell' && $mdt == $_POST['id']) {
if($ss[7][33] == '1' && $mdt != '') RmDirR('icon/'.$mdt);
sectbodc($mdt,0);
lrs_member($mdm,'');
RmDirR($dxr.$mdt);
if(!$_POST['from'] || substr($_POST['from'],7,1) == '/') $gb = 1;else $gb = substr($_POST['from'],7);
scrhref('?dtm='.($ii + 1).'&gb='.$gb,0,0);
$sss = "";
} else if($_POST['mode'] == 'modi' && $i > -1 && $_POST['id'][$i] && $mdt == $_POST['idd'][$i]) {
$rset = fopen($dxr.$_POST['idd'][$i]."/set.dat","w");
fputs($rset,substr($_POST['rdt'][$i],2)."\n".substr($_POST['rdt'][$i],0,2)."\n".$_POST['addcss'][$i]."\n".$_POST['tgsprt'][$i]);
fclose($rset);
if($mdt != $_POST['id'][$i]) {
rename($dxr.$mdt,$dxr.$_POST['id'][$i]);
if($ss[7][33] == '1') rename('icon/'.$mdt,'icon/'.$_POST['id'][$i]);
sectbodc($mdt,$_POST['id'][$i]);
lrs_member($mdm,str_pad($_POST['id'][$i],10));
}
$lastnoo = (substr($_POST['lastcnt'][$i],0,6) == substr($_POST['lastcnt'][$i],12,6))? substr($ss[0],10,6):substr($_POST['lastcnt'][$i],0,6);
$cntt = (substr($_POST['lastcnt'][$i],6,6) == substr($_POST['lastcnt'][$i],18,6))? substr($ss[0],16,6):substr($_POST['lastcnt'][$i],6,6);
if((int)$ss[7][33] != $_POST['tct7'][$i][33]) {
wdthwdth($_POST['id'][$i],$_POST['tct7'][$i][33]);
}
if($ss[0][66] != $_POST['tct0'][$i][44] || substr($_POST['lastcnt'][$i],24,1)) {
$aanct = aacnt($_POST['tct0'][$i][44],$_POST['id'][$i],$ss[6]);
$lastnoo = $aanct[0];
$cntt = $aanct[1];
$ss[6] = $aanct[2];
}
if($ss[6] > 0) {
for($ss6 = $ss[6];$ss6 > 0;$ss6--) {
if(file_exists($dxr.$_POST['id'][$i]."/^".$ss6)) {$ss[6] = $ss6;break;}
}
if($ss6 == 0 && $ss[6] > 0) $ss[6] = 0;
}
if(($sbm = (int)substr($ss[0],57,2)) != ($sbp = (int)substr($_POST['tct0'][$i],35,2))) {$sectpm[$sbp][0][] = $_POST['id'][$i];$sectpm[$sbm][1][] = $_POST['id'][$i];}
$sss = str_pad($_POST['id'][$i], 10).$lastnoo.$cntt.$_POST['tct0'][$i]."\x1b".$_POST['nam'][$i]."\x1b".$_POST['tct1'][$i]."\x1b".$_POST['tct2'][$i]."\x1b".$ss[4]."\x1b".$_POST['tct5'][$i]."\x1b".$ss[6]."\x1b".$_POST['tct7'][$i]."\x1b".$_POST['tct8'][$i]."\x1b".$_POST['tct9'][$i]."\x1b\n";
}
fputs($jds,$sss);
}
$ii++;
}
fclose($fs);
fclose($jds);
copy($ds."@@",$ds);
unlink($ds."@@");
if(count($sectpm)) {
$secfile = $dxr."section.dat";
usleepp($secfile."@@");
if($rfi = @fopen($secfile,"r")) {
$jfi = fopen($secfile."@@","w");
for($r = 1;$rfio = fgets($rfi);$r++) {
if($sectpm[$r]) {
$rfoo = explode("\x1b",$rfio);
if($sectpm[$r][0]) {
foreach($sectpm[$r][0] as $sectpmr) $rfoo[2] .= "^".$sectpmr;
}
if($sectpm[$r][1]) {
$rfoo[2] = "^{$rfoo[2]}^";
foreach($sectpm[$r][1] as $sectpmr) $rfoo[2] = str_replace("^{$sectpmr}^","^",$rfoo[2]);
$rfoo[2] = substr($rfoo[2],1,-1);
}
$rfio = $rfoo[0]."\x1b".$rfoo[1]."\x1b".$rfoo[2]."\x1b".$rfoo[3]."\x1b".$rfoo[4]."\x1b".$rfoo[5]."\x1b".$rfoo[6]."\x1b\n";
}
fputs($jfi,$rfio);
}
fclose($rfi);
fclose($jfi);
copy($secfile."@@",$secfile);
unlink($secfile."@@");
}}
scrhref($_POST['from'],0,0);
exit;
} else if($_POST['titlee']) { /*-5-*/
$thos = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')).'/';
if($_POST['l'] != $sett[12] || $_POST['vc'] != $sett[77] || $_POST['wb'] != $sett[28] || $_POST['xp'] != $sett[67] || $_POST['xq'] != $sett[68] || $_POST['xr'] != $sett[69] || $_POST['xs'] != $sett[70] || $_POST['vd'] != $sett[78]) $dxrmdfd = 'all';else $dxrmdfd = 0;
$fp = fopen($set,"w");
$_POST['xm'] = trim($_POST['xm']);
if($_POST['xm'][0] == '|') $_POST['xm'] = substr($_POST['xm'],1);
if(substr($_POST['xm'],-1) == '|') $_POST['xm'] = substr($_POST['xm'],0,-1);
if(!$_POST['xm']) $_POST['xm'] = 'jpg|png|gif|zip|rar|7z|tgz|tar.gz|wma|mp3';
$str = stripslashes($_POST['titlee'])."\x1b".$_POST['a']."\x1b".$_POST['b']."\x1b".$_POST['c']."\x1b".$_POST['d']."\x1b".$sett[5]."\x1b".$_POST['f']."\x1b".$_POST['g']."\x1b".$_POST['h']."\x1b".$_POST['i']."\x1b".$_POST['j']."\x1b".$_POST['k']."\x1b".$_POST['l']."\x1b".$_POST['m']."\x1b".$thos."\x1b".(int)$_POST['r']."\x1b".$_POST['xd'].$_POST['xe']."\x1b".$sett[17]."\x1b".$sett[18]."\x1b".$_POST['s']."\x1b".$sett[20]."\x1b".$_POST['u']."\x1b".$_POST['v']."\x1b".$_POST['w']."\x1b".$_POST['ww']."\x1b".$_POST['wv']."\x1b".$sett[26]."\x1b".$_POST['wa']."\x1b".$_POST['wb']."\x1b".$_POST['wc']."\x1b".$_POST['wd']."\x1b".$_POST['we']."\x1b".$_POST['wf']."\x1b".$_POST['wg']."\x1b".$sett[34]."\x1b".(int)$_POST['wj']."\x1b".(int)$_POST['wk']."\x1b".(int)$_POST['wl']."\x1b".$sett[38]."\x1b".(int)$_POST['wn']."\x1b".(int)$_POST['wo']."\x1b".(int)$_POST['wp']."\x1b".(int)$_POST['wq']."\x1b".str_pad($_POST['wr1'],4,0,STR_PAD_LEFT).str_pad($_POST['wr2'],4,0,STR_PAD_LEFT).str_pad($_POST['wr3'],3,0,STR_PAD_LEFT).(int)$_POST['wr4']."\x1b".$_POST['ws']."\x1b".$sett[45]."\x1b".(int)$_POST['wt']."\x1b".$sett[47]."\x1b".$_POST['wx']."\x1b".$_POST['wy']."\x1b".$_POST['wz']."\x1b".$_POST['xa']."\x1b".$sett[52]."\x1b".$sett[53]."\x1b".$_POST['xb']."\x1b".$_POST['xc']."\x1b".$sett[56]."\x1b".$sett[57]."\x1b".$sett[58]."\x1b".$sett[59]."\x1b".(int)$_POST['xia']."|".(int)$_POST['xib']."\x1b".(int)$sett[61]."\x1b".(int)$_POST['xk']."\x1b".(int)$sett[63]."\x1b".$_POST['xm']."\x1b".(int)$_POST['xn']."\x1b".(int)$_POST['xo']."\x1b".(int)$_POST['xp']."\x1b".(int)$_POST['xq']."\x1b".(int)$_POST['xr']."\x1b".(int)$_POST['xs']."\x1b".(int)$_POST['vn'].(int)$_POST['vo'].(int)$_POST['vp'].(int)$_POST['vq'].(int)$_POST['vr'].(int)$_POST['vs'].(int)$_POST['vt'].(int)$_POST['vu'].(int)$_POST['vv'].(int)$_POST['vw'].(int)$_POST['vx'].(int)$_POST['vy'].(int)$_POST['vz'].(int)$_POST['ua'].(int)$_POST['ub'].(int)$_POST['uc'].$_POST['ud'].(int)$_POST['ue'].(int)$_POST['uf'].(int)$_POST['ug'].(int)$_POST['uh'].(int)$_POST['ui']."\x1b".(int)$_POST['xu']."\x1b".(int)$_POST['xv']."\x1b".$sett[74]."\x1b".(int)$_POST['va']."\x1b".(int)$_POST['vb']."\x1b".(int)$_POST['vc']."\x1b".(int)$_POST['vd']."\x1b".(int)$_POST['ve']."\x1b".(int)$_POST['vf']."\x1b".(int)$_POST['vg']."\x1b".(int)$_POST['wh']."\x1b".$sett[83]."\x1b".$_POST['vh']."\x1b".$_POST['vi']."\x1b".$_POST['vj']."\x1b".$_POST['vk']."\x1b".$_POST['vl']."\x1b".$_POST['vm']."\x1b".$sett[90]."\x1b".$sett[91]."\x1b".$_POST['uo'].(int)$_POST['ur']."\x1b".str_pad($_POST['up'],1).$_POST['uq']."\x1b";
fputs($fp, $str);
fclose($fp);
$fh = fopen($dxr."head","w");
fputs($fh, stripslashes($_POST['head']));
fclose($fh);
$ft = fopen($dxr."tail","w");
fputs($ft, stripslashes($_POST['tail']));
fclose($ft);
$ft = fopen($dxr."member_agreement","w");
fputs($ft, stripslashes($_POST['member_agreement']));
fclose($ft);
$ft = fopen($dxr."ban","w");
fputs($ft, str_replace("\r","",$_POST['ban']));
fclose($ft);
$ft = fopen($dxr."ban2","w");
fputs($ft, str_replace("\r","",$_POST['ban2']));
fclose($ft);
$ft = fopen($dxr."prohibit","w");
fputs($ft, str_replace("\r","",$_POST['prohibit']));
fclose($ft);
if($dxrmdfd) include("include/gatedit.php");
scrhref('?',0,0);exit;
} else if($_POST['ctm'] || $_GET['dtm']) { /*-5-*/
usleepp($dc."@@");
$jdc = fopen($dc."@@","w");
$fc = fopen($dc,"r");
$ii = 1;
while(!feof($fc)){
$str = fgets($fc);
if($ii == $_POST['ctm']) {
$stri = explode("\x1b",substr($str,1));
$strr = "\x1b";
$cnt = count($_POST['ct']);
for($i = 0; $i < $cnt; $i++) {
if($i < $cnt -2 || $_POST['ct'][$i]) $strr .= $_POST['ct'][$i].str_pad((int)$_POST['ctn'][$i],6,0,STR_PAD_LEFT)."\x1b";
}
$str = $strr."\n";
} else if($ii == $_GET['dtm']) $str = "";
else {
$strx = strpos(substr($str,-9,7),"\x1b");
if($strx !== false) {$str = substr($str,0,-9 +$strx)."\x1b\n";
while(substr($str,-9) == "\x1b000000\x1b\n") {$str = substr($str,0,-8)."\n";}
while(substr($str,-3) == "\x1b\x1b\n") {$str = substr($str,0,-2)."\n";}
}}
fputs($jdc, $str);
$ii++;
}
fclose($fc);
fclose($jdc);
copy($dc."@@", $dc);
unlink($dc."@@");
if($_GET['dtm']) scrhref('?board='.$_GET['gb'],0,0);
else scrhref('?mst='.$_POST['ctm'],0,0);exit;
} else if($_POST['stm']) { /*-5-*/
$stgt = array();
$stadd = array();
$file = $dxr."section.dat";
$filee = $dxr."section_add.dat";
$filer = $dxr."section_arr.dat";
$tste = fopen($file,"r");
for($i = 1;$tsto = trim(fgets($tste));$i++) {$tstx = explode("\x1b",$tsto);if($tstx[4]) {$tstae[$i] = "\x1b".$tstx[3]."\x1b".$tstx[4]."\x1b".$tstx[5];} else $tstae[$i] = "\x1b\x1b\x1b";}
fclose($tste);
$tsta = fopen($filee,"r");
for($i = 1;$tsto = fgets($tsta);$i++) $tstao[$i] = trim($tsto);
fclose($tsta);
$tstr = fopen($filer,"r");
for($i = 1;$tstro = fgets($tstr);$i++) $tstar[$i] = trim($tstro);
fclose($tstr);
$secc = count($_POST['sect']);
$st = fopen($file,"w");
$sta = fopen($filee,"w");
$str = fopen($filer,"w");
$fdo = ",";
for($i =0;$i < $secc;$i++) { /*-4-*/
if($_POST['sect'][$i]) {
$stgt[$_POST['sectgrp'][$i]] .= "^".($i+1);
if($_POST['sectlnk'][$i] == '8') {
$_POST['sectadd'][$i] = '';
$fs = fopen($ds,"r");
for($tstn = 0;$tstbd = trim(substr(@fgets($fs),0,10));$tstn++) $_POST['sectadd'][$i] .= $tstbd."^";
$_POST['sectadd'][$i] = substr($_POST['sectadd'][$i],0,-1);
fclose($fs);
$_POST['sectlnk'][$i] = '1';
$sec8 = 8;
} else if($_POST['sectlnk'][$i] == 'n') {$sec8 = 7;$_POST['sectlnk'][$i] = '1';}
else $sec8 = 0;
foreach(explode("^",$_POST['sectadd'][$i]) as $stad) {
if(!!$stad && strpos($stad,'>') ==  false) $stadd[$i][] = $stad;
}
$tstna = $tstao[$_POST['sn'][$i]];
$ips = $i + 1;
if($ips != $_POST['sn'][$i] && file_exists("widget/sectbtm_".$_POST['sn'][$i])) {copy("widget/sectbtm_".$_POST['sn'][$i],"widget/sectbtm__".$ips);$changes[] = $ips;}
if(!$_POST['sectlnk'][$i]) $_POST['sectlnk'][$i] = '1';
fputs($st,$_POST['sect'][$i]."\x1b".$_POST['sectlnk'][$i]."\x1b".stripslashes($_POST['sectadd'][$i]).$tstae[$_POST['sn'][$i]]."\x1b".$_POST['sectgrp'][$i]."\x1b\n");
if($sec8 == 8 || $sec8 == 7 || ($tstna == '' && $_POST['sectlnk'][$i] != '3' && $_POST['sectlnk'][$i] != '6' && $_POST['sectlnk'][$i] != '7' && $_POST['sectlnk'][$i] != 's')) {
$fdo .= $ips.",";
if($_POST['sectadd'][$i] == '') $tstna = "<colgroup><col width='100%' /></colgroup><tr><td width='100%' valign='top'>&nbsp;</td></tr>";
else {
if(count($stadd[$i]) == 1) $tstna = "<colgroup><col width='100%' /></colgroup><tr><td width='100%' valign='top'><#board#></td></tr>";
else {
if($sec8 == 7) {$tstna = substr($tstna,0,strpos($tstna,'</colgroup>') + 11);$tstw = substr_count($tstna,'<col width');$tstwt = (int)(100/$tstw);}
else {$tstna = "<colgroup><col width='50%' /><col width='50%' /></colgroup>";$tstw = 2;$tstwt = 50;}
$ii = 0;
foreach($stadd[$i] as $stad) {
if($ii%$tstw == 0) $tstna .= "<tr><td width='{$tstwt}%' valign='top'><#board#></td>";
else if($ii%$tstw) $tstna .= "<td width='{$tstwt}%' valign='top'><#board#></td></tr>";
$ii++;
}
if($ii%$tstw) {
while($ii%$tstw) {$tstna .= "<td width='{$tstwt}%' valign='top'>&nbsp;</td>";$ii++;}
$tstna .= "</tr>";
}}}}
fputs($sta,$tstna."\n");
fputs($str,$tstar[$_POST['sn'][$i]]."\n");
}
} /*-4-*/
fclose($st);
fclose($sta);
fclose($str);
if($_POST['ss57']) { /*-4-*/
$s57 = array();
for($i =0;$i < $secc;$i++) {
$n57 = str_pad($_POST['sn'][$i],2,0,STR_PAD_LEFT);
if(count($stadd[$i])) foreach($stadd[$i] as $stad) $s57[$stad] = $n57;
}
usleepp($ds."@@");
$jds = fopen($ds."@@","w");
$fsfz = filesize($ds);
$fs = fopen($ds,"r");
while(!feof($fs)) {
$fso = fgets($fs);
$i57 = $s57[trim(substr($fso,0,10))];
if(!!$i57) $fso = substr($fso,0,57).$i57.substr($fso,59);
fputs($jds,$fso);
}
fclose($fs);
fclose($jds);
if($fsfz == filesize($ds."@@")) copy($ds."@@",$ds);
unlink($ds."@@");
} /*-4-*/
if($sett[26] != $_POST['sectmenu'] || $sett[45] != $_POST['wgcss']) { /*-4-*/
$sett[26] = $_POST['sectmenu'];
$sett[45] = $_POST['wgcss'];
modify_set($sett);
} /*-4-*/
for($i = 0;$changes[$i];$i++) rename("widget/sectbtm__".$changes[$i],"widget/sectbtm_".$changes[$i]);
if($sett[56]) {
$fg = fopen($dxr."section_group.dat","w");
$i = 0;
$lit = count($_POST['stgs']);
while($lit > $i) {
if($_POST['stgs'][$i]) fputs($fg,$_POST['stgs'][$i]."\x1b".$_POST['stgl'][$i]."\x1b".$stgt[($i + 1)]."^\x1b".$_POST['stga'][$i]."\x1b\n");
$i++;
}
fclose($fg);
}
if($fdo != ",") {$dxrmdfd = 'all';include("include/gatedit.php");}
scrhref('?section=1',0,0);exit;
} else if($_POST['ffiles'] && $_POST['ffilew'] && $_POST['ffilex'] != 'find') { /*-5-*/
if($_POST['ffilew'] == 'compress') { /*-4-*/
$gz = $dxr.date("Ymd_His").".tar.gz";
$owner = str_replace("<>", " ", $_POST['ffiles']);
system("tar cfzp $gz $owner --exclude=$gz");
} else if($_POST['ffilew'] == 'compressf') { /*-4-*/
$gz = $dxr.date("Ymd_His").".tar.gz";
$owner = str_replace("<>", " ", $_POST['ffiles']);
system("tar cfzp $gz $owner --exclude=$gz --exclude=files/*");
} else if($_POST['ffilex'] == 'decompress') { /*-4-*/
$gz = $_POST['ffiles'];
$owner = $_POST['ffilew'];
system("tar xfzp $gz -C $owner");
} else if($_POST['ffilew'] == 'delete') { /*-4-*/
$owner = explode("<>",$_POST['ffiles']);
for($i = 0; $i < count($owner); $i++) {
if(is_file($owner[$i])) unlink($owner[$i]);
else RmDirR($owner[$i]);
}
} else if($_POST['ffilew'] == 'list2txt') { /*-4-*/
$ltx = fopen($dxr."list.txt","w");
$owner = explode("<>",$_POST['ffiles']);
for($i = 0; $i < count($owner); $i++) {
fputs($ltx,$owner[$i]."\n");
}
fclose($ltx);
} else if($_POST['ffilew'] == 'clear') { /*-4-*/
$owner = explode("<>",$_POST['ffiles']);
for($i = 0; $i < count($owner); $i++) {
if(is_file($owner[$i])) {
fclose(fopen($owner[$i],"w"));
}
}
} else if($_POST['ffilew'] == '0777') { /*-4-*/
function xhmod($path) {
$d = dir($path);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
@chmod($path."/".$entry, 0777);
if(is_dir($path."/".$entry)) xhmod($path."/".$entry);
}}
$d->close();
}
$owner = explode("<>",$_POST['ffiles']);
for($i = 0; $i < count($owner); $i++) {
@chmod($owner[$i], 0777);
if(is_dir($owner[$i])) xhmod($owner[$i]);
}
} else if($_POST['ffilex'] == 'rename' || $_POST['ffilex'] == 'copy') { /*-4-*/
if(!file_exists($_POST['ffilew']) && strpos($_POST['ffiles'],"<>") !== false) mkdir($_POST['ffilew'],0777);
if(strpos($_POST['ffiles'],'<>') === false) {
if(file_exists($_POST['ffiles'])) {
if(strpos($_POST['ffiles'],$_POST['ffilew']) !== false) {$mtrand = $_POST['ffilew'];$_POST['ffilew'] = $_POST['ffilew'].'_'.mt_rand();}
if($_POST['ffilex'] == 'copy') {if(is_file($_POST['ffiles'])) copy($_POST['ffiles'], $_POST['ffilew']);else dircopy($_POST['ffiles'],$_POST['ffilew'],1);}
else if($_POST['ffilex'] == 'rename') @rename($_POST['ffiles'], $_POST['ffilew']);
}} else {
if(substr($_POST['ffilew'], -1) != '/') $_POST['ffilew'] = $_POST['ffilew'].'/';
$owner = explode("<>",$_POST['ffiles']);
$ownercnt = count($owner);
for($i = 0; $i < $ownercnt; $i++) {
$base = basename($owner[$i]);
if(is_dir($owner[$i]) && $_POST['ffilex'] == 'copy') dircopy($owner[$i],$_POST['ffilew'].$base,1);
else {
if($_POST['ffilex'] == 'copy') @copy($owner[$i], $_POST['ffilew'].$base);
else @rename($owner[$i], $_POST['ffilew'].$base);
}}}

} /*-4-*/
scrhref('?drct='.$_POST['ffilet'],0,0);
exit;
} else if($_POST['mkid']) { /*-5-*/
$ft = fopen($dxr.$_POST['mkid']."/".$_POST['mknm'],"w");
fputs($ft,stripslashes($_POST['mktxt']));
fclose($ft);
} else if($_GET['deled']) { /*-5-*/
RmDirR($_GET['deled']);
echo "<script type='text/javascript'>location.replace('?drct=".fchr(substr($_GET['deled'], 0, strrpos($_GET['deled'],'/')))."');</script>";
exit;
} else if($_GET['delef']) { /*-5-*/
$xx = UnLink ($_GET['delef']);
if(!$xx) {
 chown($_GET['delef'], 99);
 UnLink ($_GET['delef']);
}
echo "<script type='text/javascript'>location.replace('?drct=".substr($_GET['delef'], 0, strrpos($_GET['delef'],'/'))."');</script>";exit;
} else if($_GET['delem']) { /*-5-*/
fclose(fopen($_GET['delem'],"w"));
echo "<script type='text/javascript'>location.replace('?drct=".substr($_GET['delem'], 0, strrpos($_GET['delem'],'/'))."');</script>";exit;
} else if($_GET['mkdir']) { /*-5-*/
mkdir($_GET['mkdir'], 0777);
echo "<script type='text/javascript'>location.replace('?drct=".substr($_GET['mkdir'], 0, strrpos($_GET['mkdir'],'/'))."');</script>";exit;
} else if($_POST['statisticn']) { /*-5-*/
$countin = array("request","host","query");
for($i = 0;$i < 3;$i++) { /*-4-*/
if($_POST['dlimit'][$i]) {
$ffile = $dxr."count_".$countin[$i].".dat";
if($fsp = @fopen($ffile,"r")) {
usleepp($ffile."@@");
$stff = fopen($ffile."@@","w");
while($fspo = fgets($fsp)) {
if((int)substr($fspo,0,6) <= $_POST['dlimit'][$i]) $fspo = '';
else if($i != 1) {
if($i == 0) {
if(!strpos($fspo,'=')) $fspo = '';
else {$fspo = str_replace('&amp;','&',$fspo);
if(($tempa = strpos($fspo,'id=')) && ($tempb = strpos($fspo,'no='))) {
$fspp = substr($fspo,0,6).'id=';$temp = substr($fspo,$tempa + 3);
if($tempa = strpos($temp,'&')) {$fspp .= substr($temp,0,$tempa);} else $fspp .= $temp;
$fspp .= '&no=';$temp = substr($fspo,$tempb + 3);
if($tempb = strpos($temp,'&')) {$fspp .= substr($temp,0,$tempb);} else $fspp .= $temp;
$fspo = trim($fspp)."\n";
} else if(strpos($fspo,'&p=')) {$fspo = preg_replace("`&p=[^&\n]+`","",$fspo);$fspp = 1;}
}} else if($i == 2) {
if(strpos($fspo,'=') && strpos($fspo,'&')) $fspo = '';
else if(strlen($fspo) <= 8) $fspo = '';
else if(substr($fspo,6,1) == ' ') $fspo = substr($fspo,0,6).trim(substr($fspo,6))."\n";
}}
fputs($stff,$fspo);
}
fclose($stff);
copy($ffile."@@", $ffile);
unlink($ffile."@@");
}}} /*-4-*/
$sett[47] = $_POST['statisticn'];
modify_set($sett);
if($fspp) { /*-4-*/
$fspp = array();
$isdoubled = 0;
$fsp = fopen($dxr."count_request.dat","r");
while($fspo = fgets($fsp)) {
if($fspo = trim($fspo)) {
$tempa = substr($fspo,6);$tempb = (int)substr($fspo,0,6);
if($fspp[$tempa]) {$fspp[$tempa] += $tempb;if(!$isdoubled) $isdoubled = 1;}
else $fspp[$tempa] = $tempb;
}}
fclose($fsp);
if($isdoubled) {
arsort($fspp);
$fsp = fopen($dxr."count_request.dat","w");
foreach($fspp as $key => $value) {
fputs($fsp,str_pad($value,6,0,STR_PAD_LEFT).$key."\n");
}
fclose($fsp);
}} /*-4-*/
scrhref('?'.$_POST['from'],0,0);exit;
} else if(isset($_POST['xg']) || isset($_POST['gx'])) { /*-5-*/
$sett[58] = $_POST['xg'];
$sett[56] = $_POST['gx'];
modify_set($sett);
scrhref('?'.$_POST['from'],0,0);exit;
} else if($_POST['mblvby']) { /*-5-*/
usleepp($dim."@@");
$jdim = fopen($dim."@@","w");
$fim = fopen($dim,"r");
$fmfz = filesize($dim);
$xxx = '';
while(!feof($fim)) {
$xxx = fgets($fim);
if(strlen($xxx) > 10) {
$okk = explode("\x1b",trim($xxx));
if($okk[2] < $_POST['mblvby'][2]) {
$mbf = $dxr."_member_/member_".(int)substr($okk[0],0,5);
if($mbf = @fopen($mbf,"r")) {
$fmfz -= strlen($xxx);
$jno = explode("\x1b",fgets($mbf));
fclose($mbf);
if($_POST['mblvby'][0] == 1 && $_POST['mblvby'][1] <= (int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]) $okk2 = $_POST['mblvby'][2];
else if(($_POST['mblvby'][0] == 2 && $_POST['mblvby'][1] <= $jno[0]) || ($_POST['mblvby'][0] == 3 && $_POST['mblvby'][1] <= $jno[1]) || ($_POST['mblvby'][0] == 4 && $_POST['mblvby'][1] <= $jno[2])) $okk2 = $_POST['mblvby'][2];
else $okk2 = $okk[2];
$xxx = $okk[0]."\x1b".$okk[1]."\x1b".$okk2."\x1b".$okk[3]."\x1b".$okk[4]."\x1b".$okk[5]."\x1b".$okk[6]."\x1b".$okk[7]."\x1b".$okk[8]."\x1b".$okk[9]."\x1b".$okk[10]."\x1b".$okk[11]."\x1b".$okk[12]."\x1b".$okk[13]."\x1b".$okk[14]."\x1b".$okk[15]."\x1b".$okk[16]."\x1b\n";
$fmfz += strlen($xxx);
}}}
fputs($jdim, $xxx);
}
fclose($fim);
fclose($jdim);
if($fmfz == filesize($dim."@@")) {copy($dim,$dim."_bk");copy($dim."@@", $dim);}
unlink($dim."@@");
scrhref('?member=1',0,0);exit;
} else if($_POST['mpoint']) { /*-5-*/
$sett[5] = $_POST['ymm'][0].$_POST['ymm'][1].$_POST['ymm'][2].$_POST['ymm'][3].$_POST['ymm'][4].$_POST['ymm'][5].$_POST['ymm'][6];
$sett[18] = $_POST['mpoint'][0];
$sett[20] = (int)$_POST['mpoint'][3].(int)$_POST['mpoint'][4].(int)$_POST['mpoint'][5].(int)$_POST['mpoint'][6].$_POST['mpoint'][7];
$sett[34] =  $_POST['wi'];
$sett[52] = $_POST['mpoint'][1];
$sett[53] = ((int)$_POST['mpoint'][2])? $_POST['mpoint'][2]:10;
$sett[57] = $_POST['xf'];
$sett[61] = $_POST['xj'];
$sett[63] = $_POST['xl'];
$sett[74] = $_POST['xw'];
$sett[83] = $_POST['wu'];
$sett[90] = $_POST['uj'];
$sett[91] = (int)$_POST['uk'].(int)$_POST['ul'];
$sett[59] = '';
for($i = 0;$_POST['mbcname'][$i];$i++) {if($i < 9) {$sett[59] .= $_POST['mbclevel'][$i].$_POST['mbcname'][$i]."\x18";} else break;}
modify_set($sett);
scrhref('?'.$_POST['from'],0,0);exit;
} else if($_POST['uploadpath']) { /*-5-*/
if($_POST['linkfile'] && $_POST['linkfile'] != 'http://') { /*-4-*/
$rqurl = substr($_POST['linkfile'], 7);
$end = strpos($rqurl,'/');
$host = substr($rqurl,0,$end);
$end = substr($rqurl,$end);
$dest = substr($rqurl,strrpos($rqurl,'/') + 1);
$fp = fsockopen($host, 80, $errno, $errstr, 30);
$tmp = fopen($_POST['uploadpath'].$dest,"w");
fputs($fp, "GET ".$end." HTTP/1.1\r\n");
fputs($fp, "Accept-Language: ko\r\n");
fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Accept-Encoding: gzip, deflate\r\n");
fputs($fp, "User-Agent: Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)\r\n");
fputs($fp, "Host: ".$host."\r\n");
fputs($fp, "Connection: close\r\n");
fputs($fp, "Cache-Control: no-cache\r\n");
fputs($fp, "\r\n\r\n");
while(!$ste) {$fpo = fread($fp, 4096);$ste = strpos($fpo,"\r\n\r\n");}
fputs($tmp,substr($fpo,$ste + 4));
while (!feof($fp)) {
$strr = fread($fp,4096);
if(feof($fp)) $strr = substr($strr,0,-7);
fputs($tmp,$strr);
}
fclose($fp);
fclose($tmp);
} else if(is_uploaded_file($_FILES['upfile']['tmp_name'])) { /*-4-*/
$dest =stripslashes($_POST['uploadpath']) . basename($_FILES['upfile']['name']);
move_uploaded_file($_FILES['upfile']['tmp_name'], $dest);
} else { /*-4-*/
$sett[38] = $_POST['dnsize'].$_POST['dnsort'].$_POST['dnfilter'];
modify_set($sett);
} /*-4-*/
scrhref('?drct='.fchr($_POST['uploadpath']),0,0);exit;
} else if($_POST['pvw'] && $_POST['pvw1']) { /*-5-*/
$fpt = fopen($dxr."_member_/point_".$_POST['pvw'],"a");
fputs($fpt,$time."\x1b".(int)$_POST['pvw1']."\x1b".str_replace("\x1b","",$_POST['pvw2'])."\n");
fclose($fpt);
chmbr($_POST['pvw'], 3, $_POST['pvw1']);
?>
<script type='text/javascript'>location.replace('?pview=<?php echo $_POST['pvw']?>');</script>
<?php
} else if($_POST['deletee'] == 'mailcheck') { /*-5-*/
function mailtest($address) {
if(function_exists('mail')) $mailsent = mail($address, "mailtest", "mailtest", "MIME-Version: 1.0\r\nContent-type: text/plain; charset=UTF-8\r\nFrom: admin<{$address}>\r\nReply-To: {$address}\r\nX-Mailer: PHP/".phpversion());
return ($mailsent)? 1:0;
}
$sett[15] = mailtest($_POST['cemail']);
modify_set($sett);
scrhref('?',0,0);exit;
} else if($_GET['down']) { /*-5-*/
$ext = strtolower(substr($_GET['down'],-4));
$name = strrchr($_GET['down'],'/');
if(!$name) $name = $_GET['down'];
else $name = substr($name,1);
$name = iconv("UTF-8","CP949//IGNORE",$name);
if(is_file($_GET['down'])) {
if($ext=='.jpg' || $ext=='.gif' || $ext=='.png') {
header("Content-type:image/jpeg");
} else {
header("Content-Type: applicaiton/octet-stream; charset=UTF-8");
}
header("Content-Disposition: filename=\"$name\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($_GET['down']));
fpassthru(fopen($_GET['down'],"rb"));
}
exit;
} /*-5-*/
?>