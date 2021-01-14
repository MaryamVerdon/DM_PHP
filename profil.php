<?php
require 'DB.inc.php';
session_start();
if(!isset($_SESSION['user'])) header('Location: connexion.php');

$email = $_SESSION['user'];

$db = DB::getInstance();
if ($db == null) echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
else try
{
$etudiant = $db-> getEtudiant($email)[0];

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Profil</title>
        <!--css-->
        <link rel="stylesheet" href="css/profil.css">
        <!------ Bootstrap---------->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>

    <body>

  <div class="card mx-auto border-success">
      <img class="card-img-top" src="<?= $etudiant->getPhotoProfil(); ?>" alt="Card image cap">
      <div class="card-body text-center">
          <h5 class="card-title"><?= $etudiant->getNom() . " " . $etudiant->getPrenom(); ?></h5>
          <p class="card-text">Adresse mail : <span><?= $etudiant->getEmail(); ?></span></p>
          <p class="card-text">Date de naissance : <span><?= date('d/m/Y', strtotime($etudiant->getDateNaissance())); ?></span></p>
      </div>
      <ul class="list-group list-group-flush text-center">
          <li class="list-group-item" ><a href="regFiches.php" class="card-link">Créer une fiche</a></li>
          <li class="list-group-item" ><a href="visuFiches.php" class="card-link">Voir mes fiches</a></li>
      </ul>
      <div class="card-body text-center">
          <a href="deconnexion.php" class="btn">Déconnexion</a>
      </div>
  </div>

    </body>
</html>

    <?php
}
catch (Exception $e) { echo $e->getMessage(); }
$db->close();
?>

