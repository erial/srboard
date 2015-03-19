<?php
if(!isset($bd_id_bdimg) || !$bd_id_bdimg) $bd_id_bdimg = ''; //게시판 id - 위에서 정의된 게 없으면 여기서 정의합니다

if($bd_id_bdimg && $bdidnm[$bd_id_bdimg]) {
$bd_uid_bdimg = urlencode($bd_id_bdimg);
$ida = '';
$ofn = fopen($dxr.$bd_id_bdimg."/no.dat","r");
$ofl = fopen($dxr.$bd_id_bdimg."/list.dat","r");
while(!feof($ofn)){
$ofnn = fgets($ofn);
if($ofnn == "" || $ofnn == "\n") {
$mwth = explode("\x1b",$fsbs[$bd_id_bdimg]);
list($ida,$ofn,$ofl) = data6($ida,array($ofn,$ofl),array($mid,$mwth[6]));
if($ida == 'q') break;
} else {
$oflo = explode("\x1b",fgets($ofl));
if($oflo[4]) {
if(substr($ofnn,6,2) == 'aa') continue;
$ofno = (int)substr($ofnn,0,6);
$nrp = explode("\x1b", $ofnn);
if($nrp[2] > 0 || $nrp[3] > 0 ||$nrp[4] > 0) $nrp = " <span class='r7'>[".(int)($nrp[2] + $nrp[4] + $nrp[3])."]</span>";
else $nrp = "";
$oflo[3] = andamp($oflo[3]);
if(substr($oflo[4], 0, 5) != "http:") {
$ofu = fopen($dxr.$bd_id_bdimg."/upload.dat","r");
while(!feof($ofu)) {
$ofuv = fgets($ofu);
if((int)substr($ofuv,0,6) == $ofno) {
if($ext = substr($ofuv,-17,4)) {
$ext = strtolower($ext);
if($ext == '.jpg' || $ext == '.gif' || $ext == '.png' || $ext == '.bmp') {
$oflo[4] = "exe.php?sls={$bd_uid_bdimg}/file/".substr($ofuv,6,-13);
break;
}}}}
fclose($ofu);
}
?>
<table cellspacing='0' cellpadding='0' class='head_all'>
<tr class='title_tr'><td class='title_td'> &nbsp; <?php echo $bdidnm[$bd_id_bdimg]?>&nbsp; |&nbsp; <span class='small'>[<?php echo date("m/d", substr($oflo[0],0,10))?>]</span> <a href='?id=<?php echo $bd_id_bdimg?>&amp;no=<?php echo $ofno?>'><?php echo $oflo[3]?><?php echo $nrp?></a> <span class='small'>by <?php echo $oflo[1]?></span></td></tr>
<tr><td class='gtlst'>
<a href='<?php echo $index?>?id=<?php echo $bd_uid_bdimg?>&amp;no=<?php echo $ofno?>'><img src='<?php echo $oflo[4]?>' style='width:400px;border:4px solid #F1F1F1' alt='' /></a>
</td></tr></table>
<?php
break;
}}}
fclose($ofn);
fclose($ofl);
} else echo "<h3>widget/bd_img.php에 게시판id를 입력하세요</h3>";
unset($bd_id_bdimg);
?>
