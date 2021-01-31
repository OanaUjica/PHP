<html>
  <?php include("head.php");?>

  <body>
    <h2>Login</h2>
    <form method="post" action="user.php" target="_self">
      <fieldset>
        <legend>Login</legend>
        Utilizator : <br><input type="text" name="username" length="40">
        <br><br>
        Parola: <br><input type="password" name="parola" length="40">
        <br><br>
        <label for="nivel">Alege un nivel:</label>
        <select name="nivel" id="nivel">
          <option value="usor">Usor</option>
          <option value="mediu">Mediu</option>
          <option value="dificil">Dificil</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Login">
        <br>
      </fieldset>
    </form>
    <!-- <br><br>
    <a href='index.php' target='_self'>Prima pagina</a>
    &nbsp; | &nbsp;
    <a href='register.php' target='_self'>Inregistrare utilizator nou</a> -->
  </body>
</html>
