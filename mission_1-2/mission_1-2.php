<?php
$filename = 'mission_1-2_ syadan.txt';
$fp = fopen($filename,'w');
fwrite($fp,'test');
fclose($fp);
?>