<?php

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
$user=$_POST["user"];
$password=$_POST["password"];
print "User before: " . $user . "<br>";
print "Password before: " . $password . "<br><br>";

print "User after: " . htmlentities($user) . "<br>";
//print "Password after: " . htmlentities($password, ENT_QUOTES, "UTF-8") . "<br><br>";
print "Password after: " . htmlentities($password) . "<br><br>";

echo "<a href='prob6.php' target='_self'>Back to register page</a>";
exit();
}
?>




<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">

<h1>REGISTER - prob 6</h1>

<label for="user">User: </label>
<input type="text" id="user" name="user"><br><br>
<label for="password">Password: </label>
<input type="password" id="password" name="password"><br><br>

<input type="submit" name="submit" value="Submit" style="background-color:powderblue;">
</form>
