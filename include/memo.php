<?php
if($_GET['memo'] == 'get') {
$bdc = "#FFE0A3";
$bgc = "#FFFAF0";
$tle = "받은";
} else if($_GET['memo'] == 'post') {
$bdc = "#A3FFD1";
$bgc = "#F5FFFA";
$tle = "보낸";
}
$dmo1 = $dxr."memo1.dat";
$dmo2 = $dxr."memo2.dat";
$ie7h = ($isie == 1 && ($bwr == 'ie7' || $bwr == 'ie6'))? 10:0;
?>
<style type='text/css'>
img {border:0}
* {margin:0; padding:0;font-size:9pt; font-family:Gulim; line-height:130%}
<?php if($_GET['send']) {?>
body {background-color:#EEEDED;}
div {width:99%}
div.fl {text-align:right; height:23px; width:100%}
div input {font-size:1em; width:50%; height:21px;}
div.acenter {height:33px}
div.acenter input  {width:99%; height:99%}
textarea {width:99%; height:100%; overflow:auto}
div.fleft {text-align:left;}
</style>
<?php } else {?>
body {font-size:9pt; font-family:Gulim; line-height:130%}
a {color:black}
a:link {text-decoration:none}
a:visited {text-decoration:none}
a:hover {text-decoration:underline}
input {height:20px}
.button {cursor:pointer; width:40px; border:1px solid black; background-color:#D7D7D7; padding:0}
#mailform input {width:210px}
.tname, .tmsg {background-color:<?php echo $bgc?>; padding:5px;}
.tname {border-bottom:1px solid <?php echo $bdc?>}
.tmsg, body.mt60 div {text-align:center;}
.mname {float:left; padding-left:12px; background:url('icon/sg.gif') no-repeat 0px 5px; font-family:verdana; font-size:8pt; color:#444}
.mname img {height:13px}
.mdate {float:right; padding-right:10px}
.mdate img {height:11px; vertical-align:middle}
.mmemo {border-bottom:3px solid <?php echo $bdc?>; padding:5px 0 5px 10px}
.mmemo textarea {width:98%; height:20em; border:0; overflow:auto}
.p_no {background-color:<?php echo $bdc?>; color:#000000; padding:6px 4px 6px 4px}
.mnew {background-color:#FF6633; color:#FFFFFF; padding:0px 2px 0 2px}
#tdgpno {text-align:right; border-bottom:3px solid <?php echo $bdc?>; height:25px; padding:2px}
.w10h2 {width:100px;height:20px;}
body.mt60 {cursor:pointer;margin-top:60px;}
div.f40 {font-size:40px;}
div.p10 {padding:10px;}
</style>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<?php }?>
<script type='text/javascript'>
//<![CDATA[
function popup(url, wt, ht) {
var mleft = (screen.width - wt) / 2;
var mtop = (screen.height - ht) / 2;
if(window.showModelessDialog) {
var pten = (navigator.appVersion.indexOf('MSIE 6') != -1)? 10:0;
wt = wt + 7 + pten;
ht = ht + 27 + pten;
var win = window.showModelessDialog('admin.php?fram='+url, window,  'dialogWidth:'+ wt +'px;dialogHeight:'+ ht +'px; resizable:Yes; center:Yes; status:No; help: No; scroll:No; dialogtop:'+ mtop +'px; dialogleft:'+ mleft +'px;');
} else {
wt += 7;
ht += 26;
var win = window.open(url,'_blank','location=no,resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,width='+ wt +'px,height='+ ht +'px,left='+ mleft +'X,top='+ mtop +'Y');
}
win.focus();
}
function read(read) {
if(read == 'get'||read == 'post') popup('exe.php?memo='+read,500,500);
else popup(read,850,650);
}
function send(mm, no, to) {
if(mm == 'memo') popup('exe.php?send='+mm+'&no='+no+'&to='+to,300,200,0);
else popup('exe.php?send='+mm+'&no='+no+'&to='+to,300,300,0);
}
function onloaded() {
if(document.getElementsByTagName('textarea').length > 0) {
<?php if($_GET['send']) {?>
var xxx = document.getElementsByTagName('div').length;
var hhh = (top.length == 0)? window.document.documentElement.clientHeight:parent.window.document.documentElement.clientHeight;
hhh -= (xxx * 23) + 15;
if('<?php echo $isie?>' == '1') hhh -= 10;else if('<?php echo $bwr?>' != '') hhh += 5;
document.getElementsByTagName('textarea')[0].style.height = hhh +'px';
<?php }?>
}}
function stonload() {
onloaded();setTimeout("onloaded()",100);setTimeout("onloaded()",200);
}
function checking(ths) {
if(ths.title.value == '') alert('제목이 비었습니다');
else if('<?php echo (int)$mbr_no?>' == '0' && (ths.replyto.value == '' || ths.replyto.value.split(/[\x00-\x2D]/g).length > 1 || ths.replyto.value.replace(/^[0-9a-z_\.]+@([0-9a-z_]+\.[0-9a-z_\.]+)$/,'') != '')) alert('회신 주소가 잘못되었습니다');
else ths.submit();
}
//]]>
</script>
<?php
$ie7h = ($isie == 1 && ($bwr == 'ie7' || $bwr == 'ie6'))? 10:0;
$ie6w = ($bwr == 'ie6')? 10:0;
if($_POST['email'] && $_POST['title']) {
if($sett[8] != 'a' && $sett[8] <= $mbr_level) {
/** 새메일 처리 시작 **/
if($mbr_level == 9 && $_POST['all'] == "all") {
$maddr = "";
$fim = fopen($dim,"r");
while(!feof($fim)) {
$fmo = fgets($fim);
if(trim($fmo)) {
$list = explode("\x1b", $fmo);
$maddr[] = $list[3];
if(!$from && (int)substr($fmo, 0, 5) == $mbr_no) $from = $list[3];
}
}
fclose($fim);
foreach($maddr as $address) {
$mailsent = sendmail($address,$_SESSION['m_nick'],$from,$_POST['title'],$_POST['maam']);
}
} else if($_POST['no']) {
$fim = fopen($dim,"r");
while(!feof($fim)) {
$fmo = fgets($fim);
$n = (int)substr($fmo, 0, 5);
if($n == $_POST['no']) $di2 = explode("\x1b", $fmo);
if($mbr_no >= 1) {
if($n == $mbr_no) $di3 = explode("\x1b", $fmo);
}
if($di2 && (!$mbr_no || $di3)) break;
}
fclose($fim);
if(!$mbr_no) {
$di3[1] = ($_POST['from'])? $_POST['from']:$_SERVER['REMOTE_ADDR'];
$di3[3] = $_POST['replyto'];
}
$mailsent = sendmail($di2[3],$di3[1],$di3[3],$_POST['title'],$_POST['maam']);
}
if($mailsent) {
?>
<body class='popupbk mt60' onload="setTimeout('self.opener = self;window.close();', 500)"><div class='f40'>발송완료</div>
<?php
} else if($_POST['all'] != "all"){
?>
<body class='popupbk'>
<div class='p10'>
메일발송실패::<input type='button' onclick="location.href='mailto:<?php echo $di2[3]?>'" class="srbt" value='아웃룩 메일링크' class='w10h2' />
<textarea style='width:100%;height:200px;overflow:auto'>제목:<?php echo $_POST['title']?>

내용:

<?php echo $_POST['maam']?></textarea>
<input type='button' onclick="self.opener = self;window.close();" class="srbt" value='창닫기' class='w10h2' />
</div>
<?php
}} else scrhref(0,0,'권한이 없습니다');
/** 새메일 처리 끝 **/
} if($_GET['send'] == 'mail') {
/** 메일보내기 출력 시작 **/
if($sett[8] != 'a' && $sett[8] <= $mbr_level) {
if($sett[15]) {
if($_GET['no'] == 'all') {
	$_GET['to'] = "회원전체";
	$all = "all";
}
if(!$mbr_id) $theight = 180;
else $theight = 215;
?>
<title>메일보내기</title>
</head>
<body class='popupbk sdmm' onload='stonload()' onresize='stonload()'>
<form enctype='multipart/form-data' id='mailform' method='post' action='exe.php' onsubmit='checking(this);return false'>
<input type='hidden' name='no' value='<?php echo $_GET['no']?>' />
<input type='hidden' name='email' value='<?php echo $_GET['send']?>' />
<input type='hidden' name='all' value='<?php echo $all?>' />
<div class='fl'>받는 사람: <input type='text' name='to' value='<?php echo $_GET['to']?>' /></div>
<?php if(!$mbr_id) {?>
<div class='fl'>보내는 이: <input type='text' name='from' value='' /></div>
<div class='fl'>회신 주소: <input type='text' name='replyto' value='' /></div>
<?php }?>
<div class='fl'>메일 제목: <input type='text' name='title' value='' /></div>
<textarea class='texte' name='maam'></textarea>
<div class='fleft'>첨부파일: <input type='file' name='attachment'/></div>
<div class='acenter'><input type='submit' value='메일 보내기' /></div>
</form>
<?php
} else {
$fim = fopen($dim,"r");
while(!feof($fim)) {
$fmo = fgets($fim);
if($mbr_level==9 && $_GET['no'] == 'all' || (int)substr($fmo, 0, 5) == $_GET['no']) {
$mailto = explode("\x1b", $fmo);
if($_GET['no'] == 'all' && $mailto[3]) $mailt .= $mailto[3].";";
else break;
}
}
fclose($fim);
if($_GET['no'] == 'all') echo "<script type='text/javascript'>/*<![CDATA[*/location.href='mailto:{$mailt}';setTimeout('self.close()', 500);/*]]>*/</script>";
else echo "<script type='text/javascript'>/*<![CDATA[*/location.href='mailto:{$mailto[3]}';setTimeout('self.close()', 500);/*]]>*/</script>";
}} else scrhref(0,0,'권한이 없습니다');
/** 메일보내기 출력 끝 **/
} else if($_GET['send'] == 'memo') {
if($sett[57] != 'a' && $sett[57] <= $mbr_level) {
/** 쪽지보내기 출력 시작 **/
?>
<title>쪽지보내기</title>
</head>
<body class='popupbk sdmm' onload='stonload()' onresize='stonload()'>
<form method='post' action='exe.php'>
<input type='hidden' name='no' value='<?php echo $_GET['no']?>' />
<?php if(!$mbr_id) {?><div class='fl'>보내는 이: <input type='text' name='from' value='' /></div><?php }
if($mbr_level == 9 && $_GET['to'] == 'all') $_GET['to'] ='[전체쪽지]';?>
<div class='fl'><?php if($mbr_level == 9 && $_GET['to'] == '[전체쪽지]') {?><select name='vltl' style='float:left;height:21px'><option value='0'>일회성</option><option value='1'>보존성</option></select><?php }?>받는 사람: <input type='text' value='<?php echo $_GET['to']?>' readonly='readonly' /></div>
<textarea class='texta' name='meem'><?php echo $_GET['text']?></textarea>
<div class='acenter'><input type='submit' value='쪽지 보내기' /></div>
</form>
<?php
/** 쪽지보내기 출력 끝 **/
} else scrhref(0,0,'권한이 없습니다');
} else if($_POST['meem']) {
if($sett[57] != 'a' && $sett[57] <= $mbr_level) {
/** 새쪽지 처리 시작 **/
$content = stripslashes($_POST['meem']);
$content = str_replace("<", "&lt;", $content);
$content = preg_replace("`[\r]*[\n]`", "<br />", $content)."\n";
$vltla = ($_POST['vltl'])? '00000':'0000a';
$jmo = fopen($dmo,"a");
if($_POST['no'] == "all") {if($mbr_level == 9) {
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(trim($xxx)) {
$ptno = substr($xxx, 0, 5);
$xxx = substr($xxx, 53);
$receiver = substr($xxx,0,strpos($xxx,"\x1b"));
$str = "010".$ptno.$vltla.$time."\x1b".$_SESSION['m_nick']."(전체쪽지)\x1b".$receiver."\x1b".$content;
fputs($jmo, $str);
if($_POST['vltl']) chmbr((int)$ptno,5,1);
}}
fclose($fim);
}} else if($_POST['no']) {
chmbr($_POST['no'],5,1);
$ptno = str_pad($_POST['no'],5,0,STR_PAD_LEFT);
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if($ptno == substr($xxx, 0, 5)) {
$xxx = substr($xxx,53);
$receiver = substr($xxx,0,strpos($xxx,"\x1b"));
break;
}}
fclose($fim);
if($mbr_id == '') $str = "010".$ptno."00000".$time."\x1b".$_POST['from']."(비회원)\x1b".$receiver."\x1b".$content;
else {
chmbr($mbr_no,4,1);
$str = "011".$ptno.$mbr_n5.$time."\x1b".$_SESSION['m_nick']."(회원)\x1b".$receiver."\x1b".$content;
}
fputs($jmo, $str);
}
fclose($jmo);
if((int)@filesize($dmo1) > 1048576) {
usleepp($dmo2."@@");
$jdmo2 = fopen($dmo2."@@","w");
$fmo1 = fopen($dmo1,"r");
for($ii = 0;!feof($fmo1);$ii++) {
$memos[$ii] = fgets($fmo1);
}
fclose($fmo1);
$iii = $ii - 2;
for($i = $ii - 1;$i >= 0;$i--) {
if($memos[$i] && ($i >= $iii || trim($memos[$i]))) fputs($jdmo2,$memos[$i]);
}
if($fmo2 = fopen($dmo2,"r")) {
while($fmoo = fgets($fmo2)) fputs($jdmo2,$fmoo);
fclose($fmo2);
}
fclose($jdmo2);
copy($dmo2."@@",$dmo2);
unlink($dmo2."@@");
fclose(fopen($dmo1,"w"));
}
if($sett[5][2]) {
if($st52 = (int)@filesize($dmo2)) {
$st502 = array(0,1,3,6,12,24);$st50 = $time - ($st502[$sett[5][0]]*2592000);$st52 = $st52 - ($st502[$sett[5][1]]*1048576);
if($st52 >= 0) {
function ememe($eno,$enp,$enq) {
global $dxr;
if($emb = @fopen($dxr."_member_/member_".$eno,"r")) {
$emv = explode("\x1b",fgets($emb));
fclose($emb);
$emv[4] -= (int)$enp;$emv[5] -= (int)$enq;
$emb = fopen($dxr."_member_/member_".$eno,"w");
fputs($emb,"{$emv[0]}\x1b{$emv[1]}\x1b{$emv[2]}\x1b{$emv[3]}\x1b{$emv[4]}\x1b{$emv[5]}\x1b{$emv[6]}\x1b{$emv[7]}\x1b{$emv[8]}\x1b{$emv[9]}\x1b{$emv[10]}\x1b{$emv[11]}\x1b{$emv[12]}\x1b{$emv[13]}\x1b");
fclose($emb);
}}
$eme = array();
usleepp($dmo2."@@");
$jdmo2 = fopen($dmo2."@@","w");
if($sett[5][2] == 2) {
$dmo3 = $dxr."memo3.txt";
$jdmo3 = fopen($dmo3."@@","w");
}
$fmo2 = fopen($dmo2,"r");
while($fmoo = fgets($fmo2)) {
if($st52 >= 0 && substr($fmoo,13,10) <= $st50) {
$st52 -= strlen($fmoo);
if($sett[5][2] == 2) fputs($jdmo3,$fmoo);
$eme[(int)substr($fmoo,8,5)][0]++;
$eme[(int)substr($fmoo,3,5)][1]++;
}
else fputs($jdmo2,$fmoo);
}
fclose($fmo2);
fclose($jdmo2);
copy($dmo2."@@",$dmo2);
unlink($dmo2."@@");
if($sett[5][2] == 2) {
fclose($jdmo3);
copy($dmo3."@@",$dmo3);
unlink($dmo3."@@");
}
foreach($eme as $key => $value) {
list($emp,$emq) = $value;
if($emb = @fopen($dxr."_member_/member_".$key,"r+")) {
$embo = fgets($emb);
rewind($emb);
$emv = explode("\x1b",$embo);
$embl = strlen($embo);
$emv[4] -= (int)$emp;$emv[5] -= (int)$emq;
$embo = "{$emv[0]}\x1b{$emv[1]}\x1b{$emv[2]}\x1b{$emv[3]}\x1b{$emv[4]}\x1b{$emv[5]}\x1b{$emv[6]}\x1b{$emv[7]}\x1b{$emv[8]}\x1b{$emv[9]}\x1b{$emv[10]}\x1b{$emv[11]}\x1b{$emv[12]}\x1b{$emv[13]}\x1b";
while(strlen($embo) < $embl) $embo .= " ";
fputs($emb,$embo);
fclose($emb);
}}}}}
?>
<body class='popupbk mt60' onload="setTimeout('self.opener = self;window.close();', 500)"><div style='font-size:40px;text-align:center'>발송완료</div>
<?php
/** 새쪽지 처리 끝 **/
} else scrhref(0,0,'권한이 없습니다');
} else if($_GET['memo']) {
if($sett[57] != 'a' && $sett[57] <= $mbr_level) {
function ememo($eno) {
global $dxr;
	if($emb = @fopen($dxr."_member_/member_".$eno,"r")) {
	$emv = explode("\x1b",fgets($emb));
	fclose($emb);
	$ema = array($emv[4],$emv[5]);
	} else $ema = array(0,0);
return $ema;
}
$mnt = ememo($mbr_no);
$ii = 0;
$cnt = 10;
$mem = array();
$memm = array();
$memmm = array();
$mii = array();
$gp = ($_GET['p'])? $_GET['p']:1;
if($_GET['memo'] == 'get' || $_GET['memo'] == 'post') {
if($_GET['memo'] == 'post') $eme = array();
if($gp == 1) {
	if($_GET['memo'] == 'get') {
	usleepp($dmo."@@");
	$jdmo = fopen($dmo."@@","w");
	if($sett[5][5]) {$st502 = array(0,1,3,6,12,24);$st54 = $time - ($st502[$sett[5][3]]*2592000);}
	}
$fim = fopen($dmo,"r");
while(!feof($fim)) {
	$xxx = fgets($fim);
	$x85 = substr($xxx,8,5);
	if(($_GET['memo'] == 'get' && substr($xxx,1,1) == '1' && substr($xxx,3,5) == $mbr_n5) || ($_GET['memo'] == 'post' && substr($xxx,2,1) == '1' && $x85 == $mbr_n5)) {
		$memm[$ii] = $xxx;
		if($x85 == '0000a') $mii[] = $ii;
		$ii++;
	} else if($_GET['memo'] == 'get') {
		if(!$sett[5][5] || substr($xxx,13,10) > $st54) fputs($jdmo, $xxx);
		else {
			if($sett[5][4] == 3 || ($sett[5][4] == 2 && substr($xxx,2,1) == 0)) $memmm[] = $xxx;
			else if($x85 == '00000') {
				$st56 = substr($xxx,24);$st56 = substr($st56,0,strpos($st56,"\x1b"));
				$st56 = (substr($st56,-11) == "(비회원)")? 3:2;
				if(($st56 == 3 && $sett[5][4] == 1) || ($st56 == 2 && $sett[5][4] == 0)) $memmm[] = $xxx;
				else fputs($jdmo, $xxx);
			} else if($x85 != '0000a' || $sett[5][4] != 0) fputs($jdmo, $xxx);
		}
	}
}
fclose($fim);
if($_GET['memo'] == 'get') {
	fclose($jdmo);
	copy($dmo."@@", $dmo);
	unlink($dmo."@@");
	if($ii > 0 || count($memmm)) {
	$jdmo1 = fopen($dmo1,"a");
	for($i = 0;$i < $ii;$i++) {if(!$mii || !in_array($i,$mii)) fputs($jdmo1,"1".substr($memm[$i],1));}
	for($i = 0;$memmm[$i];$i++) {fputs($jdmo1,"1".substr($memmm[$i],1));}
	fclose($jdmo1);
	}
}
for($i = $ii -1;$i >= 0;$i--) {
if($memm[$i]) $mem[] = $memm[$i];
}
unset($memm);
} else {
$fim = fopen($dmo1,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(($_GET['memo'] == 'get' && substr($xxx,1,1) == '1' && substr($xxx,3,5) == $mbr_n5) || ($_GET['memo'] == 'post' && substr($xxx,2,1) == '1' && substr($xxx,8,5) == $mbr_n5)) {
$memm[$ii] = $xxx;
$ii++;
}}
fclose($fim);
$stt = $ii - (($gp - 2)*$cnt);
$ett = $stt - $cnt;
for($i = $ii -1;$i >= 0;$i--) {
if($i < $stt && $i >= $ett) $mem[] = $memm[$i];
}
unset($memm);
$me1 = count($mem);
$eet = ($ett < 0)? $ett:1;
if($stt <= $cnt && ($fim2 = @fopen($dmo2,"r"))) {
while(!feof($fim2)) {
$xxx = fgets($fim2);
if(($_GET['memo'] == 'get' && substr($xxx,1,1) == '1' && substr($xxx,3,5) == $mbr_n5) || ($_GET['memo'] == 'post' && substr($xxx,2,1) == '1' && substr($xxx,8,5) == $mbr_n5)) {
if($eet < 0) $eet++;
else if($eet == 0) break;
if($stt < 0) $stt++;
else $mem[] = $xxx;
$ii++;
}}
fclose($fim2);
}
}
?>
<table border='0px' cellspacing='0px' cellpadding='5px' width='100%'>
<tr><td id='tdgpno'><input type='button' value='받은 쪽지 (<?php echo $mnt[1]?>)' onclick="location.href='?memo=get'" class='button' style='width:100px' /> <input type='button' value='보낸 쪽지 (<?php echo $mnt[0]?>)' onclick="location.href='?memo=post'" class='button' style='width:100px' /></td></tr>
<?php
if($ii > 0) {
if($gp == 1) $mee = ($_GET['memo'] == 'get')? '1':'';
$i = 0;
foreach($mem as $meme) {
$er = explode("\x1b", $meme);
if($_GET['memo'] == 'get') $who = "From : ";
else $who = "To : ";
if(substr($er[0], 0, 1) == '0') $who = "<span class='mnew'>new</span> ".$who;
if($_GET['memo'] == 'get') {
$sender = (int)substr($er[0],8,5);
if($sender) {
$wfo = urlencode(substr($er[1],0,strpos($er[1],"(")));
$who .= "<img src='icon/user_blue.gif' alt='' /> <a href='#none' onclick=\"send('memo','{$sender}','".$wfo."')\" title='답장보내기'>".$er[1]."</a>";
} else $who .= "<img src='icon/user_red.gif' alt='' /> ".$er[1];
} else $who .= "<img src='icon/user_blue.gif' alt='' /> <a href='#none' onclick=\"send('memo',".(int)substr($er[0],3,5).",'".urlencode($er[2])."')\" title='쪽지보내기'>".$er[2]."(회원)</a>";
if($gp > 1) $mee = ($i < $me1)? '1':'2';
$mmm = str_replace("<br />","\r\n",$er[3]);
if(strpos($mmm,"</a>") !== false) $mmm = preg_replace("`<a[^>]+>`","",str_replace("</a>","",$mmm));
?>
<tr><td class='tname'><div class='mname'><?php echo $who?></div><div class='mdate'><font class='f7'>(<?php echo date("Y-m-d H:i:s",substr($er[0],13))?>)</font> &nbsp;<a href='#none' onclick="dell('<?php echo substr($er[0],3)?>','<?php echo $mee?>');"><img src='icon/x.gif' alt='' /></a></div></td></tr>
<tr><td class='mmemo'><textarea cols='1' rows='1' readonly='readonly'><?php echo $mmm?></textarea></td></tr>
<?php
$i++;
}
} else if($gp == 1) {$_GET['p'] = 1;
$message = ($_GET['memo'] == 'get')? "새로 받은 쪽지가 없습니다.":"확인 안된 보낸 쪽지가 없습니다.";
?>
<tr><td class='tmsg'><?php echo $message?></td></tr>
<?php
}
$ii = $cnt;
$ii += ($_GET['memo'] == 'get')? $mnt[1]:$mnt[0];
$mp = (int)(($ii - 1) / $cnt) + 1;
?>
<tr><td>
<?php
if($message && $mp > 1) echo "<script type='text/javascript'>/*<![CDATA[*/setTimeout(\"location.href='?memo={$_GET['memo']}&p=2'\",1000);/*]]>*/</script>";
pagen('p',$mp,5,0);
?>
</td></tr></table>
<script type='text/javascript'>
//<![CDATA[
function dell(a,b) {location.href="?memo=" + a + "&from=<?php echo $_GET['memo']?>&p=<?php echo $gp?>&mee=" + b;}
function texta() {
var textar = document.getElementsByTagName('textarea');
for(var i = textar.length -1;i >= 0;i--) {if("<?php echo $isie?>" !== "1") textar[i].style.height = '1em';textar[i].style.height = textar[i].scrollHeight + 'px';}
}
window.onload = function() {
parent.document.title='<?php echo $tle?> 쪽지함';
if(document.getElementsByTagName('textarea').length > 0) texta();
}
//]]>
</script>
</body></html>
<?php
} else if($_GET['memo']) {
$dom = $dxr."memo".$_GET['mee'].".dat";
if($fim = @fopen($dom,"r")) {
usleepp($dom."@@");
$jdmo1 = fopen($dom."@@","w");
while(!feof($fim)) {
$xxx = fgets($fim);
if(!$okk && substr($xxx,3,20) == $_GET['memo']) {
if($_GET['from'] == 'get' && substr($xxx,3,5) == $mbr_n5) {
chmbr($mbr_no,5,-1);
$xxx = "10".substr($xxx,2);
} else if($_GET['from'] == 'post' && substr($xxx,8,5) == $mbr_n5) {
chmbr($mbr_no,4,-1);
$xxx = substr($xxx,0,2)."0".substr($xxx,3);
} else {
$okk = 2;
break;
}
if($okk != 2) {
$okk = 1;
if(substr($xxx, 1, 2) == '00') $xxx = '';
}}
fputs($jdmo1,$xxx);
}
fclose($fim);
fclose($jdmo1);
if($okk != 2) copy($dom."@@", $dom);
unlink($dom."@@");
}
scrhref('?memo='.$_GET['from'].'&p='.$_GET['p'],0,0);
}}}
?>