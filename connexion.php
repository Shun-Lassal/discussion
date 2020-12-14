<?php
session_start();
if (isset($_SESSION['user'])) {
    header("location: index.php");
}

if (isset($_POST['connect'])){
  if (isset($_POST['login'])) {
    if (isset($_POST['password'])) {
      $db = mysqli_connect('localhost', 'root', '', 'discussion');
      $login = trim(mysqli_real_escape_string($db,htmlspecialchars($_POST['login'])));
      $password = $_POST['password'];
      $queryLogin = "SELECT id FROM utilisateurs WHERE login = '$login'";
      $queryPassword = "SELECT password FROM utilisateurs WHERE login = '$login'";
      $reqL = mysqli_query($db,$queryLogin);
      $reqP = mysqli_query($db,$queryPassword);
      $resultP = mysqli_fetch_assoc($reqP);
      $cryptedPass = $resultP['password'];
      if (mysqli_num_rows($reqL) == 1) {
        if (password_verify($password,$cryptedPass)) {
          $_SESSION['user'] = $login;
          $db = mysqli_connect('localhost', 'root', '', 'discussion');
          mysqli_close($db);
          header("location: profil.php");
        }
        else {
          $msg = "Password incorrect";
        }
      }
      else {
        $msg = "Login Incorrect";
      }
    }
    else {
      $msg = "Pas de Password";
    }
  }
}



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include('header.php'); ?>
    <section class="connexion">
      <section class="connexion2">
        <h1 class="title">Connexion</h1>
        <section class="connexion3">
          <section class="connexion4">
            <?php if(isset($msg)){echo $msg;} ?>
            <a href="index.php">Accueil</a>
            <a href="inscription.php">Inscription</a>
          </section>
          <form class="" action="connexion.php" method="post">
            <label for="login">Identifiant:</label><br/>
            <input type="text" name="login" minlenght='3' required><br/>
            <label for="password">Mot de Passe:</label><br/>
            <input type="password" name="password" minlenght='6' required><br/>
            <input type="submit" name="connect" value="S'inscrire">
          </form>
        </section>
      </section>
    </section>
  </body>
</html>
