<style>.error {color:#FF0000;}</style>

<?php
session_start();

$numeerr=$prenumeerr=$emailerr=$passworderr=$sexerr=$usernameerr=$fileerr="";
$nume1=$prenume1=$email1=$sex1=$password1=$username1=$starecivila1=$fileupload1="";
$eroare=0;

function test_input($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
  $host= "localhost";
  $usernamesql = "root";
  $passwordsql = "";
  $db_name= "userapp";
  $table_name="utilizatori";

  $db= mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die ("could not connect");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  $user=$_POST["user"];

  $salt1 = "Qm&h*";
  $salt2 = "pg!@";
  $password=$_POST["password"];
  $token=md5("$salt1$password$salt2");

  $sex=$_POST["sex"];
  $sexSql= $sex == "female" ? 0 : 1;

  $stareaCivila=$_POST["stareCivila"];
  $stareaCivilaSql= $stareaCivila == "casatorit" ? 0 : 1;

  $nume=$_POST["nume"];
  $prenume=$_POST["prenume"];
  $email=$_POST["email"];

  if (empty($nume))
  {
      $numeerr="Numele este obligatoriu";
      $eroare=1;
  }
  else
  {
      $nume1=test_input($nume);
      if (!preg_match("/^[a-zA-Z ]*$/",$nume1))
      {
          $numeerr="Numai litere si spatii sunt acceptate";
          $eroare=1;
      }
  }

  if (empty($prenume))
  {
      $prenumeerr="Prenumele este obligatoriu";
      $eroare=1;
  }
  else
  {
      $prenume1=test_input($prenume);
      if (!preg_match("/^[a-zA-Z ]*$/",$prenume1))
      {
          $prenumeerr="Numai litere si spatii sunt acceptate";
          $eroare=1;
      }
  }

  if (empty($user))
  {
      $usernameerr="Username este obligatoriu";
      $eroare=1;
  }
  else
  {
      $username1=test_input($user);
  }

  if (empty($email))
  {
      $emailerr="Email este obligatoriu";
      $eroare=1;
  }
  else
  {
      $email1=test_input($email);
      if (!filter_var($email1, FILTER_VALIDATE_EMAIL))
      {
          $emailerr="Email invalid";
          $eroare=1;
      }
  }


  if (empty($password))
  {
      $passworderr="Password este obligatoriu";
      $eroare=1;
  }
  else
  {
      $password1 = $password;
      if (strlen($password1) <= '8') {
          $passworderr = "Your Password Must Contain At Least 8 Characters!";
      }
      elseif(!preg_match("#[0-9]+#",$password1)) {
          $passworderr = "Your Password Must Contain At Least 1 Number!";
      }
      elseif(!preg_match("#[A-Z]+#",$password1)) {
          $passworderr = "Your Password Must Contain At Least 1 Capital Letter!";
      }
      elseif(!preg_match("#[a-z]+#",$password1)) {
          $passworderr = "Your Password Must Contain At Least 1 Lowercase Letter!";
      }
  }

  if ($eroare==0)
  {

    $_SESSION['user'] = $username1;
    if(isset($_SESSION['user'])) {

      echo "Hello " . $username1 . "<br>";
    } else {

      echo "hello user.";
    }
    // se introduce in baza de date si oprim rularea scriptului exit()
    // Perform query
    $query= "INSERT INTO $table_name (username, parola, sex, stareacivila, nume, prenume, email)
              VALUES ('$username1', '$token', '$sexSql', '$stareaCivilaSql', '$nume1', '$prenume1', '$email1')";
    $result= mysqli_query($db, $query);
    if ($result) {
      echo "New user created successfully!";
    } else {
      echo "Error: " . $query . "<br>" .mysqli_error($db);
    }
    header("Location.inregistrareLab4.php");

    echo "<br><br>";
    echo "<a href='inregistrareLab4.php' target='_self'>Back to register page</a>" . "<br>";
    echo "<a href='mainPage.php' target='_self'>Main page</a>";
    exit();
  }
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">

<h1>REGISTER - problem 1 & 2</h1>

<label for="user">User: </label>
<input type="text" id="user" name="user" value="<?php echo $username1; ?>">
<span class="error">* <?php echo $usernameerr;?></span><br><br>

<label for="nume">Nume: </label>
<input type="text" id="nume" name="nume" value="<?php echo $nume1; ?>" maxlength="40">
<span class="error">* <?php echo $numeerr;?></span><br><br>

<label for="prenume">Prenume: </label>
<input type="text" id="prenume" name="prenume" value="<?php echo $prenume1; ?>" maxlength="40">
<span class="error">* <?php echo $prenumeerr;?></span><br><br>

<label for="email">Email: </label>
<input type="email" id="email" name="email" value="<?php echo $email1; ?>">
<span class="error">* <?php echo $emailerr;?></span><br><br>

<label for="password">Password: </label>
<input type="password" id="password" name="password" value="<?php echo $password1; ?>">
<span class="error">* <?php echo $passworderr;?></span><br><br>

<label for="sex">Sex: </label><br>
<input type="radio" name="sex" value="male"> Male
<br>
<input type="radio" name="sex" value="female"> Female
<br><br>

<label for="stareCivila">Stare civila: </label><br>
<input type="radio" name="stareCivila" value="casatorit"> Casatorit
<br>
<input type="radio" name="stareCivila" value="necasatorit"> Necasatorit
<br><br>

<input type="submit" name="submit" value="Submit" style="background-color:powderblue;">
</form>
