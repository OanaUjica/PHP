<?php

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
$password=$_POST["password"];

$sex=$_POST["sex"];
$sexSql= $sex == "female" ? 0 : 1;

$stareaCivila=$_POST["stareCivila"];
$stareaCivilaSql= $stareaCivila == "casatorit" ? 0 : 1;

$nume=$_POST["nume"];
$prenume=$_POST["prenume"];
$email=$_POST["email"];
// Perform query
$query= "INSERT INTO $table_name (username, parola, sex, stareacivila, nume, prenume, email)
          VALUES ('$user', '$password', '$sexSql', '$stareaCivilaSql', '$nume', '$prenume', '$email')";
$result= mysqli_query($db, $query);
if ($result) {
  echo "New user created successfully!";
} else {
  echo "Error: " . $query. "<br>" .mysqli_error($db);
}
header("Location.inregistrare.php");

echo "<br><br>";
echo "<a href='inregistrare.php' target='_self'>Back to register page</a>";
exit();
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">

<h1>REGISTER - problem 5 & 7 & 8 & 15</h1>

<label for="user">User: </label>
<input type="text" id="user" name="user"><br><br>
<label for="password">Password: </label>
<input type="password" id="password" name="password"><br><br>

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

<label for="nume">Nume: </label>
<input type="text" id="nume" name="nume"><br><br>
<label for="prenume">Prenume: </label>
<input type="text" id="prenume" name="prenume"><br><br>
<label for="email">Email: </label>
<input type="email" id="email" name="email"><br><br>

<input type="submit" name="submit" value="Submit" style="background-color:powderblue;">
</form>
