<?php
?>
<form method="post" action="admin.php" class="loginfm" onsubmit="convertbase(this);return false">
<input type='hidden' name='username_3' value='' />
<input type='hidden' name='password_3' value='' />
<input type='hidden' name='from' value='<?php echo $_SERVER['REQUEST_URI']?>' />
<div style='float:right'>
<?php
// 로그인 출력
if($mbr_no && $mbr_level){
?>
<span style='padding:1px 0 4px 0' onclick='toggle($("vtcl"))'><?php if(file_exists("icon/m20_".$mbr_no)) {echo "<img src='icon/m20_".$mbr_no."' class='icos'";if(!strpos($_SERVER['PHP_SELF'],'exe.php')) echo " onmouseover='imgview(this.src,9)' onmouseout='imgview(0,1)'";echo " alt='' />";}?><b><?php echo $_SESSION['m_nick']?></b></span>
<div id='vtcl' class='minfdv' style='display:none;position:absolute;z-index:99;width:230px;'><div style='float:left;width:130px'>
 &bull; 레 &nbsp; 벨 : <?php echo levelname($mbr_level)?> <?php if($sett[90]) {?><img class='icolv' src='icon/pointlevel/<?php echo (($sett[91][1] && $mbr_level == '9')? 'm':$mbr_ptlv)?>.gif' alt='' <?php echo (($sett[90])? "title='레벨업까지 필요한 포인트 : {$jno[13]}'":"")?> /><?php } else {?><img class='mblv' src='icon/v<?php echo $mbr_level?>.gif' alt='' /><?php }?><br />
 &bull; <a href='#none' onclick="popup('admin.php?pview=<?php echo $mbr_no?>',400,300)">포인트</a> : <span><?php echo (int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]?></span><br />
 &bull; 쓴 &nbsp; 글 : <span><?php echo $jno[0]?></span><br />
 &bull; 덧 &nbsp; 글 : <span><?php echo $jno[1]?></span><br />
 &bull; 출 &nbsp; 석 : <span><?php echo $jno[2]?></span></div><div style='float:right;width:80px'>
 &bull; <a href='<?php echo $index?>?mbr_info=1'> 회원정보</a><br /><?php if($sett[57] != 'a' && $sett[57] <= $mbr_level) {?>
 &bull; <a href='#none' onclick="read('get')"> 쪽지함</a><br /><?php }?>
 &bull; <a href='member.php' target='_blank'> 회원로그</a><br /><?php if($mbr_level == 9){?>
 &bull; <a target='_blank' href='admin.php'> 관리자기능</a><br /><?php }?></div></div>
<input type='hidden' name='logout' value='1' />
<input type="submit" value="LOGOUT" class="srbt" style="font-family:verdana,Gulim;font-size:11px" />
<?php
} else {
?>
<input type='text' name='username' class='i93 username' onfocus='lgnpt(this,1,1)' onblur='lgnpt(this,1,2)' />
<input type='password' name='password' class='i93 password' style='margin:3px 0 0 0' onfocus='lgnpt(this,1,1)' onblur='lgnpt(this,1,2)' />
<label title="자동로그인" style="display:inline;vertical-align:bottom"><input type="checkbox" name="autologin" class="autolog" value="0" onclick='if(this.checked){this.value=1;alert("체크하면, 자동으로 로그인됩니다.\r\n공공장소에서는 체크하지 마세요.");}else this.value=0;' /> 자동</label>
<span style='vertical-align:bottom' class='register_find'><?php if(!$sett[61]){?><a href='<?php echo $index?>?signup=1'><img src='icon/dumb.gif' alt='회원가입' title='회원가입' /></a>&nbsp; <?php } if($sett[15]){?><a href='#none' onclick='popup("admin.php?askaddr=1",400,200)'><?php } else {?><a href="#none" onclick='popup("exe.php?send=memo&amp;no=1&amp;to=<?php echo urlencode("관리자")?>&amp;text=<?php echo urlencode("[비밀번호 분실신고]\n회원아이디: \n회원닉네임: \n이메일주소: ")?>",300,200)' class='f8'><?php }?><img src='icon/unlock.gif' alt='아이디&bull;비밀번호찾기' title='아이디&bull;비밀번호찾기' /></a></span>
<input type="submit" value="로그인" class="srbt" style="width:55px" />
<?php
}
?>

</div><div class='fcler'></div></form>