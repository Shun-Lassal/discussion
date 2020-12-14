<header>
  <a class="lien" href="index.php"><img src="images/home.png" alt=""></a>
  <h1><a class="pchatp" href="discussion.php">P-cHat-P</a></h1>
  <section id="headerf">
  <a class="lien" href="profil.php" id="disc"><?php if(isset($_SESSION['user'])){echo $_SESSION['user'];}else{echo "Profil";} ?></a>
    <span>/</span>
    <a class="lien" href="deconnexion.php" id="disc">Déconnexion</a>
  </section>
</header>
