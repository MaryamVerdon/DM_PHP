<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('Location: connexion.php');
}

require_once "DB.inc.php";
$db = DB::getInstance();
// On récupère les informations de l'utilisateur connecté
/*$afficher_profil = $db->prepare("SELECT * FROM etudiant WHERE email = ?");
$afficher_profil->execute(array($_SESSION['user']));
$data = $afficher_profil->fetch(); */

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
    </head>

    <body>

    <h1> Profil de  <?php  echo $data['Prenom'] . " " . $data['Nom']; ?></h1>
    <ul>
        <li>Adresse mail: <?= $data['Email'] ?></li>
        <li>Date de Naissande: <?= $data['DateNaissance'] ?></li>
        <li>Sexe: <?= $data['Sexe'] ?></li>
        <li>Photo : <?= $data['Photo'] ?></li> 
    </ul>
    <a href="deconnexion.php">Déconnexion</a>

    
    </body>
</html>



