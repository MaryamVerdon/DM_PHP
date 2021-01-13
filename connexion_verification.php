<?php
session_start();
require_once 'DB.inc.php';

if(isset($_POST['email']) && isset($_POST['password']))
{
    
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $db = DB::getInstance();
    if ($db == null) echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
    else try
    {
        $etudiant = $db->getEtudiant($email)[0];

        if($etudiant != null)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) && $etudiant->getEmail() == $email)
            {
                $password = hash('sha256', $password);
                //vérification du MotDePasse
                if($password == $etudiant->getMdp())
                {
                    //creation d'un session
                    $_SESSION['user'] = $email;
                    header('Location: index.php');
                }else { header('Location: connexion.php?login_err=password'); }
            }else { header('Location: connexion.php?login_err=email'); }
        }else { header('Location: connexion.php?login_err=already'); }
    }
    catch (Exception $e) { echo $e->getMessage(); }
    $db->close();
} else { header('Location: index.php'); }


?>