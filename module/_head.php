<?php if(count($grp) > 1) {?>
<div id='sectiongroup'>
<div class='sctgrp' style='width:<?php echo $srwtpx?>'><div>
<?php for($i = 1;$grp[$i];$i++) {?>
<a href='<?php echo $index?>?group=<?php echo $i?>'><?php echo $grp[$i][0]?></a><span> &nbsp; | &nbsp; </span>
<?php }?>
<a href='<?php echo $index?>?member_login=<?php echo urlencode($_SERVER['REQUEST_URI'])?>'><?php if($mbr_level) echo "로그아웃";else echo "로그인";?></a></div></div></div>
<?php
$gheight = 24;
}
?>