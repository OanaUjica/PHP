<?php
  session_start();
  if (session_status() == PHP_SESSION_ACTIVE) {
    echo 'Session is active' . "<br>";

    echo "<a href='logout.php' target='_self'>Logout</a>" . "<br>";
    echo "<h1>MAIN PAGE</h1>";
  }
?>
