<?php
session_start();




?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bienvenue sur P-cHat-P</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include("header.php"); ?>
    <main id="index">
      <section class="fade">
        <section class="fade2">
          <h1 class="title">Bienvenue sur P-cHat-P</h1>
          <section class="fade3">
            <a href="inscription.php" class="bouton">Inscription</a>
            <?php
            if (isset($_SESSION['user'])) {
              echo "<a href='discussion.php' class='bouton'>Discussion</a>";
            }
            ?>
            <a href="connexion.php" class="bouton">Connexion</a>
          </section>
        </section>
      </section>
    </main>
  </body>
</html>
