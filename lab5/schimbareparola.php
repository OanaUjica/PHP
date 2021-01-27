<style>.error {color:#FF0000;}</style>

<?php
  session_start();

  $passworderr=$passworderr1=$passworderr2="";
  $eroare=0;

  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $password_old=$_POST["parola_veche"];
    $token_old=md5("$password_old");
    $password_new1=$_POST["parola_noua1"];
    $password_new2=$_POST["parola_noua2"];

    if ($password_old == $password_new1) {
      $passworderr1="The new password must be different from the old password";
      $eroare=1;
    }

    if ($token_old != $_SESSION["UserParola"])
    {
        $passworderr="The password doesn't match with the current password";
        $eroare=1;
    }

    if (empty($password_new1))
    {
      $passworderr1="The password cannot be empty";
      $eroare=1;
    }

    if (empty($password_new2))
    {
      $passworderr2="The password cannot be empty";
      $eroare=1;
    }

    if ($password_new1 != $password_new2)
    {
      $passworderr2="The passwords don't match";
      $eroare=1;
    }

    if ($eroare==0)
    {
      $password_new1=md5("$password_new1");
      $db_username = $_SESSION["Username"];

      require_once("config.php");
      $db=mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die("could not connect");
      // Check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }

      $query= "UPDATE $tbl_name SET parola = '$password_new1' WHERE username = '$db_username'";
      $result= mysqli_query($db, $query);
      if ($result) {
        header("Location: http://localhost:8080/php/lab3/lab5/index.php");
      } else {
        echo "Error: " . $query . "<br>" .mysqli_error($db);
      }
      exit();
    }
  }
?>

<html>
  <?php include("head.php");?>
  <body>
    <h2>Schimbare parola</h2>
    <form method="post" action="schimbareparola.php" target="_self">
      <fieldset>
        <legend>Schimbare parola</legend>
        Parola veche : <br><input type="password" name="parola_veche">
        <span class="error">* <?php echo $passworderr;?></span>
        <br><br>
        Parola noua: <br><input type="password" name="parola_noua1">
        <span class="error">* <?php echo $passworderr1;?></span>
        <br><br>
        Confirma parola: <br><input type="password" name="parola_noua2">
        <span class="error">* <?php echo $passworderr2;?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <br>
      </fieldset>
    </form>
    <br><br>
  </body>
</html>
