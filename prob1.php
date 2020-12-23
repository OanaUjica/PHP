<?php
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
$sirpreluat=$_POST["sir"];
print "Lungimea sirului:" . strlen($sirpreluat);
echo "<br><br>";

echo "<a href='prob1.php' target='_self'>Intoarce la formular</a>";
exit();
}

?>




<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">

<input type="text" id="sir" name="sir"><br><br>


<input type="submit" name="submit" value="Trimite">
</form>
