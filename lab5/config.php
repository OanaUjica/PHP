<?php
  $host="localhost";
  $usernamesql="root";
  $passwordsql="";
  $db_name="userapp";
  $tbl_name="utilizatori";
  $max_file_size = "504500";
  $file_dir = "poze/";
?>


<html>
  <?php session_start();?>
  <?php include("head.php");?>

  <body>
    <div align="left">
      <?php
        //se verifica daca utilizatorul este autentficat
        if (isset($_SESSION["Username"]))
        {
          echo "<a href='logout.php' target='_self'>Logout</a>"; "<br>";
        }
        //daca utilizatorul nu este autentificat
        else
        {
          echo "<a href='login.php' target='_self'>Login</a>";
          echo "<p align='left'>Please login</p>";
        }
      ?>
    </div>

    <h2>Joc</h2>
    <?php
      //daca utilizatorul este autentificat se va afisa un cuvant in ordine aleatorie
      if (isset($_SESSION["Username"]))
      {
        require_once ("config.php");

        $nivel = $_SESSION['Nivel'];

        $db = mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die ("could not connect");
        $query = "SELECT cuvant, explicatie FROM $tbl_name1 WHERE nivel = '$nivel' ORDER BY rand() LIMIT 1";

        $result = mysqli_query($db, $query);

        $explicatii = array();
        $explicatiaCorecta = "";

        while ($r=mysqli_fetch_array($result))
        {

          $cuvant = $r['cuvant'];
          $explicatieCorecta = $r['explicatie'];
          $_SESSION["Cuvant"] = $r['cuvant'];
          $_SESSION["ExplicatieCorecta"] = $explicatieCorecta;

          echo "Cuvant = " . $cuvant . "<br>" . "<br>";

        }

        $query2 = "SELECT explicatie FROM $tbl_name1 WHERE explicatie != '$explicatieCorecta' ORDER BY rand() LIMIT 2";

        $result2 = mysqli_query($db, $query2);

        while ($r=mysqli_fetch_array($result2))
        {

          $explicatiaGresita = $r['explicatie'];
          array_push($explicatii, $explicatiaGresita);

        }

      }

    ?>

    <form method = "POST" action = "rezultat.php">
      Alege descrierea corecta: <br><br>
      <input type="radio" name="explicatie" value="<?php echo $explicatieCorecta ?>"> <?php echo $explicatieCorecta ?> <br>
      <input type="radio" name="explicatie" value="<?php echo $explicatii[0] ?>"> <?php echo $explicatii[0] ?> <br>
      <input type="radio" name="explicatie" value="<?php echo $explicatii[1] ?>"> <?php echo $explicatii[1] ?> <br>

      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
