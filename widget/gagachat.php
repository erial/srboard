<?php
  function userKey($user, $roomKey)  {
    return md5(md5($user . $roomKey) . $roomKey);
  }
  $chatroom = preg_replace("`[^a-z]`i","",$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
  $roomkey = substr($chatroom,2);
  if(!$heightz) $heightz = "320px"; //높이
  if(!$widthz) $widthz = "220px"; //가로길이
  $usernickz = $_SESSION['m_nick'];
  //$usernickz = iconv("EUC-KR", "UTF-8", $usernickz);
  $userkey = userKey($usernickz, $roomkey);
if($mbr_level == 9) $userkey = userKey(userKey($usernickz, $roomkey), $roomkey);
$usernickz = urlencode($usernickz);
?>
<center>
<script src="http://www.gagalive.kr/Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version =7,0,19,0','width','<?php echo $widthz?>','height','<?php echo $heightz?>','title', '가가 채팅','src','http://www.gagalive.kr/livechat1?&amp;chatroom=<?php echo $chatroom?>&amp;user=<?php echo $usernickz?>&amp;encrypt=<?php echo $userkey?>','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','http://www.gagalive.kr/livechat1?&amp;chatroom=<?php echo $chatroom?>&amp;user=<?php echo $usernickz?>&amp;encrypt=<?php echo $userkey?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="<?php echo $widthz?>" height="<?php echo $heightz?>" title="가가 채팅">
<param name="movie" value="http://www.gagalive.kr/livechat1.swf?&amp;chatroom=<?php echo $chatroom?>&amp;user=<?php echo $usernickz?>&amp;encrypt=<?php echo $userkey?>" />
<param name="quality" value="high" />
</object></noscript>
</center>