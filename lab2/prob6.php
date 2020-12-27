<?php

$text = "WDWWLWWWLDDWDLL";
$pos = stripos($text, "L");
$letter = substr($text, $pos+1, 1);

echo $letter;
?>