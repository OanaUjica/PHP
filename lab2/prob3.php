<?php

function temperatura($tfahrenheit) 
{
	$tcelsius = (5/9)*($tfahrenheit-32);
	return $tcelsius;
}

$temperaturaF = 55;
echo "Temperatura Fahrenheit: " . $temperaturaF . "<br/>";

$temperaturaC = temperatura($temperaturaF);
$temperaturaC = round($temperaturaC, 1);
echo "Temperatura Celsius: " . $temperaturaC . "<br/>";
?>