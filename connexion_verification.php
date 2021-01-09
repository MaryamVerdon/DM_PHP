<?php
session_start();
require_once 'configBD.php';

if(isset($_POST['email']) && isset($_POST['password']))
{
    
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $req = $bdd->prepare('SELECT Email, MotDePasse FROM etudiant WHERE Email = ?');
    $req->execute(array($email));
    $data = $req->fetch();
    $row = $req->rowCount(); //vérifier si le user existe ou pas dans la table

    if($row == 1)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $password = hash('sha256', $password);
            //vérification du MotDePasse
            if($data['MotDePasse'] == $password )
            {
                //creation d'un session
                $_SESSION['user'] = $data['Email'];
                header('Location: profil.php');
            } else { header('Location: connexion.php?login_err=password'); }
        }else { header('Location: connexion.php?login_err=email'); }
    } else { header('Location: connexion.php?login_err=already'); }
} else { header('Location: connexion.php'); }


?>