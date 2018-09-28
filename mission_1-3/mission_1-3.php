<?php
$filename = 'mission_1-2_ syadan.txt';
$fp = fopen($filename,'r');
$str=fgets($fp);
echo $str;
fclose($fp);
?>