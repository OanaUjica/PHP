<?php
  session_start();
  session_destroy();
  header("Location: http://localhost:8080/php/lab3/lab4/loginLab4.php");
?>
