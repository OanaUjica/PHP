<html>
  <?php session_start();?>
  <?php include("head.php");?>

  <body>
    <div align="left">
      <?php
        //se verifica daca utilizatorul este autentficat
        if (isset($_SESSION["Username"]))
        {
          $date = $_SESSION["RegistrationDate"];
          $photo = $_SESSION["UserPhoto"];
          $userName = $_SESSION["Username"];

          echo "<a href='logout.php' target='_self'>Logout</a>";
          echo "&nbsp; | &nbsp;";
          echo "<a href='schimbareparola.php' target='_self'>Change password</a>" . "<br>" . "<br>";

          echo $userName . " registration date: " . $date . "<br>";
          echo "<img src='". $photo ."' width='200'>" . "<br>";
        }
        //daca utilizatorul nu este autentificat
        else
        {
          echo "<a href='login.php' target='_self'>Login</a>";
          echo "&nbsp; | &nbsp;";
          echo "<a href='register.php' target='_self'>Register new user</a>";
          echo "<p align='left'>Please login so you could see users details</p>";
        }
      ?>
    </div>

    <h2>Registered users</h2>
    <?php
      //daca utilizatorul este autentificat se va afisa o lista cu utilizatorii in ordinea aleasa
      if (isset($_SESSION["Username"]))
      {
        require_once ("config.php");
        $orderby = $_SESSION['Orderby'];
        $db = mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die ("could not connect");
        $query = "SELECT * FROM $tbl_name ORDER BY username $orderby";
        $result = mysqli_query($db, $query);

        while ($r=mysqli_fetch_array($result))
        {
          $poza4 = $r['poza'];
          $user4 = $r['username'];
          $nume4 = $r['nume'];
          $prenume4 = $r['prenume'];
          $registrationDate = $r['dataregistrare'];

          echo "Registration date: " . $registrationDate . "<br>";
          echo "Username: " . $user4 . " => " . "Name: " . $nume4 . " " . $prenume4 . "<br>";
          echo "<img src='". $poza4 ."' width='200'>" . "<br>";
        }
      }
      //daca utilizatorul nu este autentificat se va afisa numai o lista cu username-uri neordonate
      else
      {
        require_once ("config.php");
        $db = mysqli_connect($host, $usernamesql, $passwordsql, $db_name) or die ("could not connect");
        $query = "SELECT * FROM $tbl_name";
        $result = mysqli_query($db, $query);

        while ($r=mysqli_fetch_array($result))
        {
          $user4 = $r['username'];
          echo "<p align='left'>" . $user4 . "</p>";
        }
      }
    ?>
  </body>
</html>
