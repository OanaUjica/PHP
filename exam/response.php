<?php
  session_start();
  include("head.php");


  if(isset($_POST['submit']))
  {
    echo "<a href='logout.php' target='_self'>Logout</a>" . "<br>" . "<br>";
    require_once("config.php");

    $db=mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die("could not connect");

    $explicatie=$_POST['explicatie'];
    $cuvant=$_SESSION["Cuvant"];
    $explicatiaCorecta=$_SESSION["ExplicatieCorecta"];
    $userName=$_SESSION["Username"];

    $nrCuvinteGhicite = 0;
    $nrCuvinteGresite = 0;

    echo "<br>" . $explicatie;
    echo "<br>" . $explicatiaCorecta . "<br>";
    if ($explicatie == $explicatiaCorecta) {

      $query = "SELECT nrCuvinteGhicite FROM $tbl_name2 WHERE user = '$userName'";
      $result=mysqli_query($db, $query);

      while($row=mysqli_fetch_array($result))
      {
        $nrCuvinteGhicite = ++$row['nrCuvinteGhicite'];
      }

      $query1 = "UPDATE $tbl_name2 SET nrCuvinteGhicite = '$nrCuvinteGhicite'";
      $result1=mysqli_query($db, $query1);

      if ($result1) {
        if($nrCuvinteGhicite == 5) {
          echo "Jocul s-a incheiat" . "<br>";
          echo "<br>" . "nivel = " . $_SESSION['Nivel'];
          echo "<br>" . "nr cuvinte ghicite = " . $nrCuvinteGhicite;
          echo "<br>" . "nr cuvinte gresite = " . $nrCuvinteGresite;
        } else {
          header("Location: http://localhost:8080/php/exam/joc.php");
        }
      } else {
        echo "Error: " . $query . "<br>" .mysqli_error($db);
      }
    }

    else {

      $query = "SELECT nrCuvinteGresite FROM $tbl_name2 WHERE user = '$userName'";
      $result=mysqli_query($db, $query);

      while($row=mysqli_fetch_array($result))
      {
        $nrCuvinteGresite = ++$row['nrCuvinteGresite'];
      }

      $query1 = "UPDATE $tbl_name2 SET nrCuvinteGresite = '$nrCuvinteGresite'";
      $result1=mysqli_query($db, $query1);

      if ($result1) {
        if($nrCuvinteGresite == 3) {
          echo "Jocul s-a incheiat" . "<br>";
          echo "<br>" . "nivel = " . $_SESSION['Nivel'];
          echo "<br>" . "nr cuvinte ghicite = " . $nrCuvinteGhicite;
          echo "<br>" . "nr cuvinte gresite = " . $nrCuvinteGresite;
        } else {
          header("Location: http://localhost:8080/php/exam/joc.php");
        }
      } else {

        echo "Error: " . $query . "<br>" .mysqli_error($db);
      }
    }
  }
?>
