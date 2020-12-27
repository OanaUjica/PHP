<?php

$radius = 12;
$PI = 3.14;
$PIFunction = pi();

$A = $PI * $radius * $radius;
$AWithPi = $PIFunction * $radius * $radius;


echo "Area circle = " . $A . "<br/>";

echo "Area circle with pi() = " . $AWithPi;

?>