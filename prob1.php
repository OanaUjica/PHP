<?php

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
$sirpreluat=$_POST["stringChar"];

print "String's lenght: " . strlen($sirpreluat) . "<br>";
print "Reverse string: " . strrev($sirpreluat) . "<br>";
print "Lowercase string: " . strtolower($sirpreluat) . "<br>";
print "Uppercase string: " . strtoupper ($sirpreluat);

echo "<br><br>";
echo "<a href='prob1.php' target='_self'>Back to form</a>";
exit();
}
?>




<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">

<h1>Problem 1</h1>

<input type="text" id="stringChar" name="stringChar"><br><br>

<input type="submit" name="submit" value="Submit">
</form>
