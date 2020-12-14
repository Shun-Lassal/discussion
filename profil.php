<?php
session_start();
if (empty($_SESSION['user'])) {
    header("location: inscription.php");
}
else {
  $login = $_SESSION['user'];
}


if (isset($_POST['profil'])) {
  if (isset($_POST['login'])) {
    $newLogin = trim(mysqli_real_escape_string($db,htmlspecialchars($_POST['login'])));
    $db = mysqli_connect('localhost', 'root', '', 'discussion');
    $queryLogin = "SELECT id FROM utilisateurs WHERE login = '$login'";
    $reqL = mysqli_query($db,$queryLogin);
    if (mysqli_num_rows($reqL) == 1) {
      $msg = "Login existant";
      mysqli_close($db);
    }
    elseif (strlen(trim($_POST['login'])) >= 3) {
      $queryMLogin = "UPDATE utilisateurs SET login='$newLogin' WHERE login='$login'";
      $reqML = mysqli_query($db, $queryMLogin);
      $msg = "Modification Login réussie";
    }
  }
  if (isset($_POST['password'])) {
      if (strlen($_POST['password']) >= 6 && strlen($_POST['cpassword']) >= 6) {
        if ($_POST['password'] === $_POST['cpassword']) {
          $password = password_hash(mysqli_real_escape_string($db,htmlspecialchars($_POST['password'])), PASSWORD_BCRYPT);
          $db = mysqli_connect('localhost', 'root', '', 'discussion');
          var_dump($queryPassword);
          $queryPassword = "UPDATE utilisateurs SET password='$password' WHERE login = '$login'";
          $reqP = mysqli_query($db, $queryPassword);
          $msg = "Modification MDP réussie";
          header("location: profil.php");
        }
        else {
          $msg = "Password / Confirmer Password Inexact";
        }
      }
      else {
        $msg = "Password 6 Charactères Minimum";
      }
    }
  }











?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include('header.php'); ?>
    <section class="profil">
      <section class="profil2">
        <h1 class="title">Profil</h1>
        <section class="profil3">
          <section class="profil4">
            <span id="nick">Identifiant actuel:<?php echo ' '.$login; ?></span>
            <a href="index.php">Accueil</a>
            <a href="deconnexion.php">Déconnexion</a>
          </section>
          <form class="" action="profil.php" method="post">
            <label for="login">Nouvel Identifiant:</label><br/>
            <?php echo "<input type='text' name='login' minlenght='3' value='$login'><br/>"; ?>
            <label for="password">Nouveau Mot de Passe:</label><br/>
            <input type="password" name="password"><br/>
            <label for="cpassword">Nouveau Mot de Passe:</label><br/>
            <input type="password" name="cpassword"><br/>
            <input type="submit" name="submit" value="S'inscrire">
          </form>
        </section>
      </section>
    </section>
  </body>
</html>
