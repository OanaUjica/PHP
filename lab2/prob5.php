<?php

$text = "WDWWLWWWLDDWDLL";
$pos = stripos($text, "WWW");
$letter = substr($text, $pos+3, 1);

echo $letter;
?>