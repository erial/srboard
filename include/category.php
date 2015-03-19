
<div class='ct_vtc'><dl>
<?php
$di = 2;
foreach($ctg as $ii => $category) {
if($category) {
if($_GET['ct'] && $_GET['ct'] == $ii) $linK = 'slctd';
else $linK = '';
echo "\n<dd class='{$linK}'><input type='button' value='".preg_replace("`<[^>]*>`","",$category)."' onclick='locato(\"ct\",\"{$ii}\")' /><span class='f7'>[".$ctgn[$ii]."]</span></dd>";
//if(!$ismobile && $di*130 > $srwdth) {echo "</dl><dl>";$di = 2;}
//else $di++;
}}
?>
</dl></div><div class='fcler'></div>
