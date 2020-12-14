<?php
session_start();
if (isset($_SESSION['user'])) {
    header("location: index.php");
}

$db = mysqli_connect('localhost','root','','discussion');
if (isset($_POST['inscription'])) {
  $login = trim(mysqli_real_escape_string($db,htmlspecialchars($_POST['login'])));
  $sql = "SELECT id FROM utilisateurs WHERE login = '$login'";
  $result = mysqli_query($db,$sql);
  $count = mysqli_num_rows($result);
  if($count == 0){
    if (strlen(trim($_POST['login'])) >= 3) {
      if (strlen($_POST['password']) >= 6 && strlen($_POST['cpassword']) >= 6) {
        if ($_POST['password'] === $_POST['cpassword']) {
            $login = trim(mysqli_real_escape_string($db,htmlspecialchars($_POST['login'])));
            $password = password_hash(mysqli_real_escape_string($db,htmlspecialchars($_POST['password'])), PASSWORD_BCRYPT);
            $db = mysqli_connect('localhost','root','','discussion');
            $sql = "INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES (null, '$login', '$password')";
            $query = mysqli_query($db,$sql);
            if ($query == true) {
              $_SESSION['user'] = $login;
              $msg = "Compte créé";
              header("location: profil.php");
              mysqli_close($db);
            }
            else {
              $msg = "Création du compte échouée";
              mysqli_close($db);
            }
        }
        else {
          $msg = "Mot de passe & Confirm. Mdp incorrect";
        }
      }
      else {
        $msg = "Mot de passe 6 Charactères Min.";
      }
    }
    else {
      $msg = "Login 3 Charactères Min.";
    }
  }
    else {
      $msg = "Login Existant";
    }
  }

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include('header.php'); ?>
    <section class="inscription">
      <section class="inscription2">
        <h1 class="title">Inscription</h1>
        <section class="inscription3">
          <section class="inscription4">
            <?php if(isset($msg)){echo $msg;} ?>
            <a href="index.php">Accueil</a>
            <a href="connexion.php">Connexion</a>
          </section>
          <form class="" action="inscription.php" method="post">
            <label for="login">Identifiant:</label><br/>
            <input type="text" name="login" minlenght='3' required><br/>
            <label for="password">Mot de Passe:</label><br/>
            <input type="password" name="password" minlenght='6' required><br/>
            <label for="cpassword">Confirmer Mot de Passe:</label><br/>
            <input type="password" name="cpassword" minlenght='6' required><br/>
            <input type="submit" name="inscription" value="S'inscrire">
          </form>
        </section>
      </section>
    </section>
  </body>
</html>
