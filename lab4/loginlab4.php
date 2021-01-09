<?php
session_start();

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
  $host= "localhost";
  $usernamesql= "root";
  $passwordsql= "";
  $db_name= "userapp";
  $table_name="utilizatori";

  $db= mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die ("could not connect");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  $orderByName= $_POST['orderByName'];
  $date = date('Y-m-d');
  $user= $_POST['user'];
  $password = $_POST['password'];
  // Perform query
  $query= "SELECT username FROM $table_name WHERE username='$user' AND parola='$password'";
  $result= mysqli_query($db, $query);
  $row = mysqli_num_rows($result);

  if ($row == 1) {
    echo "Hello, $user!" . "<br>";
    echo "Order by name " . $orderByName . "." . "<br>";
    echo "Current date: " . $date;
  } else {
    echo "Wrong user or password. Please try again!";
  }
  header("Location.login.php");

  echo "<br><br>";
  echo "<a href='login.php' target='_self'>Back to login page</a>";

  exit();
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">

<h1>LOGIN</h1>

<label for="user">User: </label>
<input type="text" id="user" name="user"><br><br>
<label for="password">Password: </label>
<input type="password" id="password" name="password"><br><br>

<p>ORDER BY NAME</p>
<input type="radio" id="ascending" name="orderByName" value="ascending">
<label for="ascending">Ascending</label><br>
<input type="radio" id="descending" name="orderByName" value="descending">
<label for="descending">Descending</label><br><br>

<input type="submit" name="submit" value="Submit" style="background-color:powderblue;">
</form>
