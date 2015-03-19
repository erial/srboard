<?php
$lognfrom = ($_GET['member_login'] && $_GET['member_login'] != '1')? str_replace("&","&amp;",$_GET['member_login']):$_SERVER['REQUEST_URI'];
?>
<form method="post" action="admin.php" class="loginfm if140" onsubmit="convertbase(this);return false">
<input type='hidden' name='username_3' value='' />
<input type='hidden' name='password_3' value='' />
<input type='hidden' name='from' value='<?php echo $lognfrom?>' />
<div class="div1">
<div class="div2">
<?php
// 로그인 출력
if($mbr_no && $mbr_level){
?>
<div class="div7" align="center">
<div style='padding:1px 0 4px 0'><?php if(file_exists("icon/m20_".$mbr_no)) {echo "<img src='icon/m20_".$mbr_no."' class='icos'";if(!strpos($_SERVER['PHP_SELF'],'exe.php')) echo " onmouseover='imgview(this.src,9)' onmouseout='imgview(0,1)'";echo " alt='' />";}?><b><?php echo $_SESSION['m_nick']?></b></div>
<div class='minfdv'><div>
 &bull; 레 &nbsp; 벨 : <?php echo levelname($mbr_level)?> <?php if($sett[90]) {?><img class='icolv' src='icon/pointlevel/<?php echo (($sett[91][1] && $mbr_level == '9')? 'm':$mbr_ptlv)?>.gif' alt='' <?php echo (($sett[90])? "title='레벨업까지 필요한 포인트 : {$jno[13]}'":"")?> /><?php } else {?><img class='mblv' src='icon/v<?php echo $mbr_level?>.gif' alt='' /><?php }?><br />
 &bull; <a href='#none' onclick="popup('admin.php?pview=<?php echo $mbr_no?>',400,300)">포인트</a> : <span><?php echo (int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]?></span><br />
 &bull; 쓴 &nbsp; 글 : <span><?php echo $jno[0]?></span><br />
 &bull; 덧 &nbsp; 글 : <span><?php echo $jno[1]?></span><br />
 &bull; 출 &nbsp; 석 : <span><?php echo $jno[2]?></span></div></div>
<div class='minlik'>
<a class='arwg' href='<?php echo $index?>?mbr_info=1'> &nbsp; 회원정보</a><br /><?php if($sett[57] != 'a' && $sett[57] <= $mbr_level) {?>
<a class='arwg' href='#none' onclick="read('get')"> &nbsp; 쪽지함</a><br /><?php }?>
<a class='arwg' href='member.php' target='_blank'> &nbsp; 회원로그</a><br /><?php if($mbr_level == 9){?>
<a class='arwg' target='_blank' href='admin.php'> &nbsp; 관리자기능</a><br /><?php }?></div>
<input type='hidden' name='logout' value='1' />
<input type="submit" value="LOGOUT" class="srbt" style="font-family:verdana,Gulim;font-size:11px;width:100px" />
</div>
<?php
} else {
?>
<div class="div3">MEMBER LOGIN</div>
<div class="div4">
<input type='text' name='username' class='i140 username' onfocus='lgnpt(this,2,1)' onblur='lgnpt(this,2,2)' />
<input type='password' name='password' class='i140 password' style='margin:5px 0 0 0' onfocus='lgnpt(this,2,1)' onblur='lgnpt(this,2,2)' />
</div>
<div class="div5"><label><input type="checkbox" name="autologin" class="autolog" value="0" onclick='if(this.checked){this.value=1;alert("체크하면, 자동으로 로그인됩니다.\r\n공공장소에서는 체크하지 마세요.");}else this.value=0;' /> 자동로그인</label>
<input type="submit" value="LOGIN" class='sbmt2' />
</div><div class="div6"></div>
<?php if(!$sett[61]){?>
<input type="button" value="회원가입" class="srbt" style="width:100px;margin-right:5px" onclick="rhref('<?php echo $index?>?signup=1')" />
<?php
}
if($sett[15]) $idfnd = "popup('admin.php?askaddr=1',400,200)";
else $idfnd = "popup('exe.php?send=memo&amp;no=1&amp;to=".urlencode("관리자")."&amp;text=".urlencode("[비밀번호 분실신고]\n회원아이디: \n이메일주소:")."',300,200)";
?>
<input type="button" value="아이디 &bull; 비밀번호찾기" class="srbt" style="width:170px" onclick="<?php echo $idfnd?>" />
<?php
}
?>
</div></div></form>