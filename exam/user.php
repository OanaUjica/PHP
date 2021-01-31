<?php
  session_start();
  include("head.php");

  //verificare user si parola
  if(isset($_POST['submit']))
  {
    require_once("config.php");
    $db=mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die("could not connect");
    $myusername=$_POST['username'];
    $mypassword=$_POST['parola'];
    $nivel=$_POST['nivel'];

    $myusername=stripslashes($myusername);
    $mypassword=stripslashes($mypassword);

    $myusername=mysqli_real_escape_string($db, $myusername);
    $mypassword=mysqli_real_escape_string($db, $mypassword);

    $query="SELECT * FROM $tbl_name3 WHERE username='$myusername' and parola='$mypassword'";
    $result=mysqli_query($db, $query);

    while($row=mysqli_fetch_array($result))
    {
      $UserID=$row["id"];
      $Username=$row["username"];
      $UserParola=$row["parola"];
    }

    $count=mysqli_num_rows($result);

    if($count==1) {

      $_SESSION["Username"]=$Username;
      $_SESSION["UserID"]=$UserID;
      $_SESSION["UserParola"]=$UserParola;
      $_SESSION["Nivel"]=$nivel;

      $query= "INSERT INTO $tbl_name2 (user, nivel, nrCuvinteGhicite, nrCuvinteGresite)
               VALUES ('$myusername', '$nivel', 0, 0)";

      $result= mysqli_query($db, $query);
      if ($result) {
        echo "<meta http-equiv='refresh' content='0;URL=joc.php'>";
        //header("Location: http://localhost:8080/php/lab3/lab5/index.php");
      } else {
        echo "Error: " . $query . "<br>" .mysqli_error($db);
      }
      exit();

    } else {

      echo "Utilizator sau parola incorecta. <br><br>
      <a href='login.php' target='_self'>Inapoi la Login</a>";
    }
  }
?>
