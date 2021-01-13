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
        <title>Accueil</title>
    </head>

    <body>

    <h1> Profil de  <?php  echo $etudiant->getPrenom() . " " . $etudiant->getNom() ; ?></h1>
    <ul>
        <?php  echo $etudiant->getPhotoProfil(); ?>
        <li>Photo : <img src="<?= $etudiant->getPhotoProfil(); ?>" alt="photo profil"></li>
    </ul>
    <a href="deconnexion.php">Déconnexion</a>

    
    </body>
</html>

    <?php
}
catch (Exception $e) { echo $e->getMessage(); }
$db->close();
?>

