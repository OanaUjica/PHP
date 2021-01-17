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
    $orderby=$_POST['order'];

    $myusername=stripslashes($myusername);
    $mypassword=stripslashes($mypassword);

    $myusername=mysqli_real_escape_string($db, $myusername);
    $mypassword=mysqli_real_escape_string($db, $mypassword);

    $mypassword=md5($mypassword);

    $query="SELECT * FROM $tbl_name WHERE username='$myusername' and parola='$mypassword'";
    echo "User = " . $myusername . "<br>" ."Password = " . $mypassword;
    $result=mysqli_query($db, $query);

    while($row=mysqli_fetch_array($result))
    {
      $UserID=$row["id"];
      $Username=$row["username"];
      $UserNume=$row["nume"];
      $UserPrenume=$row["prenume"];
      $UserEmail=$row["email"];
      $UserParola=$row["parola"];
      $UserStarecivila=$row["stareCivila"];
      $UserSex=$row["sex"];
    }

    $count=mysqli_num_rows($result);

    //daca e ok -> inregistrare user
    if($count==1) {

      $_SESSION['Username']=$Username;
      $_SESSION['UserID']=$UserID;
      $_SESSION['UserNume']=$UserNume;
      $_SESSION['UserPrenume']=$UserPrenume;
      $_SESSION['UserEmail']=$UserEmail;
      $_SESSION['UserParola']=$UserParola;
      $_SESSION['UserStarecivila']=$UserStarecivila;
      $_SESSION['UserSex']=$UserSex;
      $_SESSION['Orderby']=$orderby;

      echo "<meta http-equiv='refresh' content='0;URL=index.php'>";

    } else {

      echo "Utilizator sau parola incorecta. <br><br>
      <a href='index.php' target='_self'>Prima pagina</a>
      &nbsp | &nbsp;

      <a href='login.php' target='_self'>Inapoi la Login</a>
      &nbsp | &nbsp;

      <a href='register.php' target='_self'>Inregistrare utilizator nou</a>";

    }
  }
?>
