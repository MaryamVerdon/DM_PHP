<?php
  session_start();
  if(isset($_SESSION['user'])) echo($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Accueil</title>
    </head>

    <body>
       <h1>Accueil</h1>
       <a href="inscription.php">Inscription</a>
       <a href="connexion.php">Connexion</a>
       <a href="regFiches.php">Enregistrement de fiches</a>
       <a href="visuFiches.php">Fiches académiques</a>
    </body>
</html>