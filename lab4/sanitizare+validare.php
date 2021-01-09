<?php

$host="localhost";
$usernamesql="root";
$passwordsql="";
$db_name="userapp";
$tbl_name="utilizatori";

$username=$_POST["username"];
$parola=$_POST["pass"];
$parola=md5($parola);
$gender=$_POST["gender"];
$marital_status=$_POST["marital_status"];
$nume=$_POST["lastname"];
$prenume=$_POST["firstname"];
$email=$_POST["email"];

$db=mysqli_connect($host,$usernamesql,$passwordsql,$db_name) or die ("could not connect");

// definirea valorilor pentru erori ca fiind goale. Altfel la prima afisare a formularului ar da o eroare
$numeerr=$prenumeerr=$emailerr=$passworderr=$sexerr=$usernameerr="";
// definirea variabilelor pentru valorile din formular. Daca nu am stabili, la prima afisare a formularului ar da eroare
$nume1=$prenume1=$email1=$sex1=$username1=$starecivila1=$parola1="";
//definirea valorii la eroarea principala. Daca intervine orice eroare la verificare formular, ii vom atribui o alta valoare
$eroare=0;
// functie pentru sanitizarea datelor primite din formular
function test_input($data) {

    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

// verifica daca au fost trimise date din formular
if ($_SERVER["REQUEST_METHOD"]=="POST") {
  // verifica daca campul nume a fost completat cu functia empty
      if (empty($nume)) {
  // in cazul in care nu a fost completat defineste o eroare
          $numeerr="Numele este obligatoriu";
  // in cazul in care a fost definit o eroare la verificarea formularului, se modifica si eroarea principala
          $eroare=1;

      } else {
  // se modifica valoarea goala de la variabila $nume cu valoarea primita din formular
          $nume1=test_input($nume);
  // daca campul a fost completat, se verifica daca contine numai litere si spatii folosind functia de filtrare preg_match
          if (!preg_match("/^[a-zA-Z ]*$/",$nume1)) {

              $numeerr="Numai litere si spatii sunt acceptate";
              $eroare=1;
          }
      }

      if (empty($prenume)) {

          $prenumeerr="Prenumele este obligatoriu";

          $eroare=1;

      } else {

          $prenume1=test_input($prenume);

          if (!preg_match("/^[a-zA-Z ]*$/",$prenume1)) {

              $prenumeerr="Numai litere si spatii sunt acceptate";
              $eroare=1;
          }
      }


    if (empty($email)) {

        $emailerr="Email este obligatoriu";
        $eroare=1;

    } else {

        $email1=test_input($email);

        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email1)) {
            $emailerr = "Email-ul este invalid";
            $eroare=1;
        }
    }

      if (empty($username)) {

          $usernameerr="Username-ul este obligatoriu";

          $eroare=1;

      } else {

          $username1=test_input($username);

      }
}
      if (empty($parola)) {

          $passworderr="Parola este obligatorie";

          $eroare=1;

      } else {

        $parola1 = test_input($parola);

        if (strlen($parola1) <= '8') {
          $passworderr = "Your Password Must Contain At Least 8 Characters!";
        }
        elseif(!preg_match("#[0-9]+#",$parola1)) {
          $passworderr = "Your Password Must Contain At Least 1 Number!";
        }
        elseif(!preg_match("#[A-Z]+#",$parola1)) {
          $passworderr = "Your Password Must Contain At Least 1 Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#",$parola1)) {
          $passworderr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }
      }

if ($eroare==0) {

  $query="INSERT INTO $tbl_name (username, parola, sex, starecivila, nume, prenume, email)
          VALUES ('$username1', '$parola1', '$gender', '$marital_status', '$nume1', '$prenume1', '$email1')";

  $result=mysqli_query($db, $query);

}

//header("Location: index.php");
?>

<style>.error {

  color:#FF0000;

  }
</style>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">

Username:<input type="text" id="username" name="username" value="<?php echo $username1; ?>">
<span class="error">* <?php echo $usernameerr;?></span><br><br>

Password:<input type="password" id="pass" name="pass" value="<?php echo $parola1; ?>">
<span class="error">* <?php echo $passworderr;?></span><br><br>

Sex:<input type="number" id="gender" name="gender" min="0"; max="1"><br><br>

Stare civila:<input type="number" id="marital_status" name="marital_status" min="0"; max="1"><br><br>

Nume:<input type="text" id="lastname" name="lastname" value="<?php echo $nume1; ?>" length="40">
<span class="error">* <?php echo $numeerr;?></span><br><br>

Prenume:<input type="text" id="firstname" name="firstname" value="<?php echo $prenume1; ?>">
<span class="error">* <?php echo $prenumeerr;?></span><br><br>

Email:<input type="text" id="email" name="email" value="<?php echo $email1; ?>">
<span class="error">* <?php echo $emailerr;?></span><br><br>

<input type="submit" name="submit" value="Send">
</form>
