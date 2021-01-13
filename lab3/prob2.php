<?php

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
$user=$_POST["user"];
$password=$_POST["password"];

if ($user == "" || $password == "" ) {
  print "User and password fields are required!";
} else {
  print "Hello " . $user . "!";
}

echo "<br><br>";
echo "<a href='prob2.php' target='_self'>Back to login page</a>";
exit();
}
?>




<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">

<h1>LOGIN - problem 2</h1>

<label for="user">User: </label>
<input type="text" id="user" name="user"><br><br>
<label for="password">Password: </label>
<input type="password" id="password" name="password"><br><br>

<input type="submit" name="submit" value="Submit" style="background-color:powderblue;">
</form>
