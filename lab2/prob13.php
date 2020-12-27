<?php

$text = 'LOGIN 11223344 here';
$removedSubString = '11223344';
$trimmed = str_replace($removedSubString, '', $text);

echo $trimmed;
?>