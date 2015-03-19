<?php
if(basename($_SERVER['PHP_SELF']) != 'exe.php' || $mbr_level != 9) exit;
?>
<html><head></head>
<body onload="setTimeout('xliqq()',100)"><h1 onclick='self.opener=self;window.close()'>success</h1>
<?php
$wt7 = $wdth[6] + 2;
$xlinq = array();
for($w6=1;$w6 < $wt7;$w6++) {
if($w6 <= $wdth[6]) {
$aa6 = (int)substr($do[$w6],0,6);
$dn = $dxr.$id."/^".$w6."/no.dat";
$w5 = $w6;
} else {
$aa6 = (int)$lst;
$dn = $dxr.$id."/no.dat";
$w5 = 0;
}
$w8 = ($w6 == 1)? 0:(int)substr($do[$w6 - 1],0,6);
if($_POST['ifno'] <= $aa6) {
if($_POST['ifend'] >= $w8) {
$selected = '';
$fxxntfn = fopen($dn,"r");
while($ntfxxzzz = fgets($fxxntfn)) {
$ntfxxzn = substr($ntfxxzzz,0,6);$ntfzn = (int)$ntfxxzn;
if($ntfzn) {
if($_POST['ifno'] <= $ntfzn && $_POST['ifend'] >= $ntfzn) {
if(!$_POST['ifct'] || $_POST['ifct'] == substr($ntfxxzzz,6,2)) $selected .= $ntfxxzn.':';
}}}
fclose($fxxntfn);
if($selected) {
?>
<iframe name='xlink<?php echo $w5;?>' style='visibility:hidden;width:100%;height:100px' src=''></iframe>
<form name='adselect<?php echo $w5;?>' method='post' target='xlink<?php echo $w5;?>' action='exe.php' style='visibility:hidden'>
<input type='text' name='xx' value='<?php echo $w5;?>' />
<input type='text' name='selected' value='<?php echo $selected;?>' />
<input type='hidden' name='request' value='' />
<?php
foreach($_POST as $key => $value) {
if($key != 'ifno' && $key != 'ifend' && $key != 'selected' && $key != 'request' && $key != 'xx') {
echo "<input type='hidden' name='{$key}' value='{$value}' />";
}}
echo "<input type='submit' /></form>\n";
$xlinq[] = $w5;
}}}}
?>
<script type='text/javascript'>
function xliqq() {
<?php
foreach($xlinq as $w5) {echo "setTimeout('document.adselect{$w5}.submit()',".(($w5 * 100) + 100).");\n";}
?>
}
</script>
</body></html>