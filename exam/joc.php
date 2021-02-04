<html>
  <?php session_start();?>
  <?php include("head.php");?>

  <body>
    <div>
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

    <?php
      //daca utilizatorul este autentificat se va afisa un cuvant in ordine aleatorie
      if (isset($_SESSION["Username"]))
      {
        require_once ("config.php");
        $nivel = $_SESSION['Nivel'];
        $db = mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die ("could not connect");
        $query1 = "SELECT cuvant, explicatie FROM $tbl_name1 WHERE nivel = '$nivel' ORDER BY rand() LIMIT 1";

        $result1 = mysqli_query($db, $query1);
        $explicatii = array();
        $explicatiaCorecta = "";

        while ($r=mysqli_fetch_array($result1))
        {
          $cuvant = $r['cuvant'];
          $explicatiaCorecta = $r['explicatie'];
          $_SESSION["Cuvant"] = $r['cuvant'];
          $_SESSION["ExplicatieCorecta"] = $explicatiaCorecta;

          echo "<br>". "<br>". "Cuvant = " . $_SESSION["Cuvant"] . "<br>";
          echo "Nivel = " . $nivel . "<br>";
        }

        $query2 = "SELECT explicatie FROM $tbl_name1 WHERE explicatie != '$explicatiaCorecta' ORDER BY rand() LIMIT 2";
        $result2 = mysqli_query($db, $query2);
        while ($r=mysqli_fetch_array($result2))
        {
          $explicatiaGresita = $r['explicatie'];
          array_push($explicatii, $explicatiaGresita);
        }
      }
    ?>

    <form method="post" action="response.php" target="_self" enctype="multipart/form-data">
      <br><br>
      Alege definitia corecta: <br>
      <input type="radio" name="explicatie" value="<?php echo $explicatiaCorecta ?> " checked> <?php echo $explicatiaCorecta ?> <br>
      <input type="radio" name="explicatie" value="<?php echo $explicatii[0] ?>"> <?php echo $explicatii[0] ?> <br>
      <input type="radio" name="explicatie" value="<?php echo $explicatii[1] ?>"> <?php echo $explicatii[1] ?> <br>
      <br><br>

      <input type="submit" name="submit" value="Submit" style="background-color:powderblue;">
    </form>
  </body>
</html>
