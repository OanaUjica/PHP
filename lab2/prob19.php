<?php 
function Fibonacci($n){ 
  
    $num1 = 0; 
    $num2 = 1;

    while ($num2 < $n){
        echo ' '.$num1; 
        $num3 = $num2 + $num1; 
        $num1 = $num2; 
        $num2 = $num3;
    }
    echo " " . $num1;
}

$n = 8; 
Fibonacci($n); 
?> 