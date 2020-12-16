<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("location: inscription.php");
}

if (isset($_POST['envoyer'])) {
  if (strlen($_POST['message']) > 4 && strlen($_POST['message']) < 150) {
    $db = mysqli_connect('localhost','root','','discussion');
    $message = mysqli_real_escape_string($db,htmlspecialchars($_POST['message']));
    $today = date("d/m H:i:s");
    $login = $_SESSION['user'];
    $sqlid = "SELECT id FROM utilisateurs WHERE login='$login'";
    $reqID = mysqli_query($db,$sqlid);
    $resultID = mysqli_fetch_assoc($reqID);
    $id = $resultID['id'];
    $sql = "INSERT INTO messages ( message, id_utilisateur, date) VALUES ( '$message', '$id', '$today')";
    $reqM = mysqli_query($db,$sql);

  }
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Discussion</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include('header.php'); ?>
      <section class="chatframe">
        <section class="chat">
          <?php
          $db = mysqli_connect('localhost','root','','discussion');
          $req = "SELECT * FROM messages ORDER BY date ASC";
          $result = mysqli_query($db,$req);
          $messages = mysqli_fetch_all($result);
          foreach ($messages as $key => $value) {
            echo ($value[2]." - ".$value[3]." - ".$value[1]."<br/>");
          }
          ?>
        </section>
        <form class="chat" action="discussion.php" method="post">
          <input class="chat" type="text" name="message" placeholder="Ecrire un message">
          <input class="schat" type="submit" name="envoyer" value="Envoyer">
        </form>
      </section>
  </body>
</html>
