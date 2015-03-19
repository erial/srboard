<div class="mbebg">
<?php
if(!$topsection) {
echo "<a href='{$index}?section=1'>{$sett[0]}</a>";
if(count($grp) > 1) echo "&nbsp; &gt; &nbsp;<a href='{$index}?group={$sgp}'>{$grp[$sgp][0]}</a>";
if(!$_GET['group']) echo "&nbsp; &gt; &nbsp;<a href='{$index}?section={$section}'>{$sect[$section][0]}</a>";
$topsection = 1;
?></div><div id="check_memo"><?php
} else {
if($id) {
?>
<input type="button" class="mbebutt" onclick="location.href='<?php echo $index?>?id=<?php echo $id?>&amp;p=<?php echo ($_GET['p'])? $_GET['p']:1;?>'" value="목록" />
<?php }?>
<input type="button" class="mbebutt" onclick="document.cookie='ckmobile=3';location.reload()" value="PC버전" />
<input type="button" class="mbebutt" onclick="location.href='<?php echo $index?>?member_login=<?php echo urlencode($_SERVER['REQUEST_URI'])?>'" value="<?php echo ($mbr_level)? "회원정보":"로그인";?>" />
<input type="button" class="mbebutt" onclick="history.go(-1)" value="이전" />
<?php
}
?>
</div>