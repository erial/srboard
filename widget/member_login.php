<?php
?>
<form method="post" action="admin.php" class="loginfm" style="margin:0" onsubmit="convertbase(this);return false">
<input type='hidden' name='username_3' value='' />
<input type='hidden' name='password_3' value='' />
<input type='hidden' name='from' value='<?php echo $_SERVER['REQUEST_URI']?>' />
<div align='center' style='border:1px solid #D1D1D1;padding:15px 0 20px 0'>
<?php
// 로그인 출력
if($mbr_no && $mbr_level){
?>
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

<?php
} else {
?>
<div style='width:155px'>
<div style='float:left;width:100px;text-align:left'>
<input type='text' name='username' class='i93 username' onfocus='lgnpt(this,1,1)' onblur='lgnpt(this,1,2)' />
<input type='password' name='password' class='i93 password' style='margin:3px 0 0 0' onfocus='lgnpt(this,1,1)' onblur='lgnpt(this,1,2)' />
</div><div style='float:left;width:55px'>
<div style='padding-bottom:5px'><label title="자동로그인"><input type="checkbox" name="autologin" class="autolog" value="0" onclick='if(this.checked){this.value=1;alert("체크하면, 자동으로 로그인됩니다.\r\n공공장소에서는 체크하지 마세요.");}else this.value=0;' /> 자동</label></div>
<input type="submit" value="로그인" class="srbt" style="width:55px" /></div>
<div class='fcler'></div>
<div style='margin:3px 0 1px 0;padding-top:6px' class='register_find'><?php if(!$sett[61]){?><a href='<?php echo $index?>?signup=1'>회원가입</a>|<?php } if($sett[15]){?><a href='#none' onclick='popup("admin.php?askaddr=1",400,200)'><?php } else {?><a href="#none" onclick='popup("exe.php?send=memo&amp;no=1&amp;to=<?php echo urlencode("관리자")?>&amp;text=<?php echo urlencode("[비밀번호 분실신고]\n회원아이디: \n회원닉네임: \n이메일주소: ")?>",300,200)' class='f8'><?php }?>아이디&bull;비밀번호찾기</a>
</div></div>
<?php
}
?>

</div></form>