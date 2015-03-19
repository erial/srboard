<?php
if($_GET['count_add']) {
$server_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
$sbot=array('bot','yahoo! slurp','daumoa','twiceler','yeti','bingpreview','baiduspider','crawler','mutant','daumsearch','facebook');
for($i=0;$i < 11;$i++) {
if(strpos($server_user_agent,$sbot[$i]) !== false) {$sbot = 'x';break;}
}
if(preg_replace("`[0-9]+`","",$_SERVER['HTTP_USER_AGENT']) == "") $sbot = 'x';
if($sbot != 'x') {
$query = explode("\x1b",base64_decode(substr($_SERVER['QUERY_STRING'], 10)));
if(!$query[0] || strlen($query[0]) != 15 || !isset($query[2])) exit;
$querystr = '';
if($query[1]) {
if(false !== ($slash = strpos($query[1],'/'))) $query[1] = substr($query[1],0,$slash);
parse_str($query[1], $output);
if($output['id']) {
$querystr .= 'id='.$output['id'];
if($output['no']) $querystr .= '&no='.$output['no'];
else if($output['search']) $querystr .= '&search='.$output['search'].'&keyword='.$output['keyword'];
else if($output['ct']) $querystr .= '&ct='.$output['ct'];
} else if($output['section']) $querystr .= 'section='.$output['section'];
else if($output['group']) $querystr .= 'group='.$output['group'];
else $querystr = $query[1];
}
$cut_d = $today - (86400*2) -1;
usleepp($dxr."count_3d.dat@@");
$fv = fopen($dxr."count_3d.dat@@","w");
$ffv = $time.$query[0].$querystr."\x1b".$query[2]."\x1b".$_SERVER['HTTP_USER_AGENT']."\x1b\n";
fputs($fv, $ffv);
$counting = array(array(),array(),array(),array(),array());
$c3d = fopen($dxr."count_3d.dat","r");
$u = 0;
while($c3do = fgets($c3d)) {
$c3time = substr($c3do,0,10);
if($c3time > $cut_d) fputs($fv, $c3do);
else {
$c3dd = explode("\x1b",$c3do);
$c3dd[0] = str_replace("amp;","",$c3dd[0]);
$c3dd[1] = str_replace("=&","&",$c3dd[1]);
$counting[0][date("H",$c3time)]++;
$counting[1][substr($c3dd[0],25)]++;
if($c3referer = parse_url($c3dd[1])) {
$counting[2][$c3referer['host']]++;
if(false !== ($c3q6 = strpos($c3referer['query'],"query="))) $c3query = substr($c3referer['query'],$c3q6+6);
else if(false !== ($c3q6 = strpos($c3referer['query'],"q="))) $c3query = substr($c3referer['query'],$c3q6+2);
else $c3query = '';
if($c3query) {
if(false !== ($c3qend = strpos($c3query,"&"))) $c3query = substr($c3query,0,$c3qend);
$c3query = urldecode($c3query);
if(mb_detect_encoding($c3query,"UTF-8,EUC-KR,ASCII") != 'UTF-8') $c3query = iconv("CP949","UTF-8//IGNORE",$c3query);
$counting[3][$c3query]++;
}}
if(substr($c3dd[2],25,4) == 'MSIE') $counting[4]["ie".substr($c3dd[2],30,1)]++;
else if(false !== strpos($c3dd[2],'Trident/7')) $counting[4]["ie11"]++;
else if(false !== strpos($c3dd[2],'AppleWebKit')) $counting[4]['chrome']++;
else if(false !== strpos($c3dd[2],'Firefox')) $counting[4]['firefox']++;
else if(substr($c3dd[2],0,5) == 'Opera') $counting[4]['opera']++;
else $counting[4]['other']++;
$u++;
}}
fclose($c3d);
fclose($fv);
copy($dxr."count_3d.dat@@",$dxr."count_3d.dat");
unlink($dxr."count_3d.dat@@");

if($u > 0) {
$fc = fopen($dxr."count.dat", "a");
fputs($fc, date("Ymd",$cut_d).$u."\n");
fclose($fc);
if(filesize($dxr."count_all.dat")) {
$fd = fopen($dxr."count_all.dat","r");
$fdo = fgets($fd);
fclose($fd);
}
$fe = fopen($dxr."count_all.dat","w");
fputs($fe, $fdo + $u);
fclose($fe);
$countin = array("hour","request","host","query","browser");
for($c = 0;$c < 5;$c++) {
if($counting[$c]) {
usleepp($dxr."count_".$countin[$c].".dat@@");
$dfv = fopen($dxr."count_".$countin[$c].".dat@@","w");
if($fv = @fopen($dxr."count_".$countin[$c].".dat","r")) {
while($fvo = trim(fgets($fv))) {
$fvc = (int)substr($fvo,0,6);
$fvv = substr($fvo,6);
if($fvc != '999999') {$fvc += (int)$counting[$c][$fvv];$counting[$c][$fvv] = 0;}
fputs($dfv,str_pad($fvc,6,0,STR_PAD_LEFT).$fvv."\n");
}
fclose($fv);
}
foreach($counting[$c] as $key => $value) {
if($key && $value) fputs($dfv,str_pad($value,6,0,STR_PAD_LEFT).$key."\n");
}
fclose($dfv);
copy($dxr."count_".$countin[$c].".dat@@",$dxr."count_".$countin[$c].".dat");
unlink($dxr."count_".$countin[$c].".dat@@");
}}

}
}
} else if($_GET['view'] && $mbr_level >= $sett[25]){
?>
<style type='text/css'> * {font-family:Gulim; font-size:9pt} td {overflow:hidden} .date {color:red; font-size:11px; height:25px} .f7 {font-family:tahoma,Gulim; font-size:11px; height:25px}</style>
<script type='text/javascript'>function wopn(purl){purl=purl.innerHTML.replace(/amp;/g,"");if(!window.open(purl,'_blank')) {if(confirm('팝업이 차단되었습니다.페이지 이동하시겠습니까')) location.replace(purl);}}</script>
</head>
<body onload="document.title='<?php echo $sett[0]?> 방문내역'">
<table width='100%' cellspacing='0' cellpadding='0' style='table-layout:fixed'>
<colgroup><col width='30px' align='center' /><col width='80px' /><col width='80px'/><col width='35%' /><col width='120px' /><col width='40%' /></colgroup>
<tr><td colspan='6' style='height:1px;background-color:#B8B8B8'></td></tr>
<tr><td style='text-align:center;height:25px'>번호</td><td style='text-align:center'>시간</td><td style='text-align:center'>IP</td><td style='text-align:center'>USER_AGENT</td><td style='text-align:center'>REQUEST_URI</td><td style='text-align:center'>HTTP_REFERER</td></tr>
<tr><td colspan='6' style='height:3px;background-color:#B8B8B8'></td></tr>
<?php
$f = 0;
$yday = $today - 86400;
$fv = fopen($dxr."count_3d.dat", "r");
while(!feof($fv)) {
$fvo = str_replace("&","&amp;",str_replace("amp;","",fgets($fv)));
$fdd = substr($fvo, 0, 10);
if((int)$fdd){
$dd = date("m/d H:i:s", $fdd);
if($fdd >= $today) echo "<tr>";
else if($fdd >= $yday) {echo "<tr style='background-color:#FFFAD9'>";if($end != 1) {$f = 0;$end=1;}}
else {echo "<tr>";if($end != 2) {$f = 0;$end=2;}}
$qq = explode("\x1b", substr($fvo, 25));
$ff = $f + 1;
if($qq[0]) $qq[0] = "<a target='_blank' href='".$index."?".$qq[0]."'>".$qq[0]."</a>";
if($qq[1]) $qq[1] = "<a href='#none' onclick='wopn(this)'>".$qq[1]."</a>";
?>
<td><?php echo $ff?></td><td class='date'><?php echo $dd?></td><td><?php echo substr($fvo, 10, 15)?></td><td class='f7'><?php echo $qq[2]?></td><td><?php echo $qq[0]?>&nbsp;</td><td><?php echo $qq[1]?>&nbsp;</td></tr>
<tr><td colspan='6' style='height:1px;background-color:#D7D7D7'></td></tr>
<?php
}
$f++;
}
fclose($fv);
?>
<tr><td colspan='6' style='height:3px;background-color:#B8B8B8'></td></tr>
</table>
</body>
</html>
<?php
}
exit;
?>