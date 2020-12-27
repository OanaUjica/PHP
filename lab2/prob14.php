<?php

$text = "www.domain.com/public_html/index.php";
$position = strripos($text, "/");
$file = substr($text, $position+1);

echo $file;
?>