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
// Perform query
$query= "INSERT INTO $table_name (username, parola) VALUES ('$user', '$password')";
$result= mysqli_query($db, $query);
if ($result) {
  echo "New user created successfully";
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

<h1>REGISTER - problem 5 & 7 & 8</h1>

<label for="user">User: </label>
<input type="text" id="user" name="user"><br><br>
<label for="password">Password: </label>
<input type="password" id="password" name="password"><br><br>

<input type="submit" name="submit" value="Submit" style="background-color:powderblue;">
</form>
