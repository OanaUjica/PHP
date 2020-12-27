<?php

$text = "aBcdEfgHiJ";
$textPascalCase = "hello world!";

$uppercase = strtoupper($text);
$lowercase = strtolower($text);
$firstUC = ucfirst($text);
$pascalCase = ucwords($textPascalCase);

echo "uppercase = " . $uppercase . "<br/>";
echo "lowercase = " . $lowercase . "<br/>";
echo "first character uppercase = " . $firstUC . "<br/>";
echo "pascalCase = " . $pascalCase;
?>