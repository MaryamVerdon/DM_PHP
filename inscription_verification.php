<?php
session_start();
require_once 'configBD.php';

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password'])  && isset($_POST['sexe']) && isset($_POST['dateNaissance']) && isset($_FILES['monfichier']))
{
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $date = htmlspecialchars($_POST['dateNaissance']);

    $req = $bdd->prepare('SELECT Email, MotDePasse FROM etudiant WHERE Email = ?');
    $req->execute(array($email));
    $data = $req->fetch();
    $row = $req->rowCount(); 

    if($row == 0) //la personne n'est pas dans la BD
    {
        
        if(preg_match("/^[a-zéèàêâùïüëA-Z]+$/", $_POST['nom']))
        {
            if(preg_match("/^[a-zéèàêâùïüëA-Z]+$/", $_POST['prenom']))
            {
                if(filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    if(/*preg_match('/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/', $date)*/ !empty($date))
                    {
 
                        if($_FILES['monfichier']['error'] == 0){
                            if ($_FILES['monfichier']['size'] <= 1000000)
                            {
                                // Testons si l'extension est autorisée
                                $infosfichier = pathinfo($_FILES['monfichier']['name']);
                                $extension_upload = $infosfichier['extension'];
                                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                                if (in_array($extension_upload, $extensions_autorisees))
                                {
                                    // On renomme le fichier avec la fonction uniqid
                                    $nouveaunom = uniqid(basename($_FILES['name']));
                                    // On peut valider le fichier et le stocker définitivement
                                     move_uploaded_file($_FILES['monfichier']['tmp_name'], 'images/' . $nouveaunom. '.' .$extension_upload);
                                     $chemin = 'images/' . $nouveaunom. '.' .$extension_upload;
                                     if(!empty($password)){
                                        //hachage du MotDePasse
                                        $password = hash('sha256', $password);
                                        //INSERTION
                                        $req = $bdd->prepare('INSERT INTO etudiant(Email, Nom, Prenom, MotDePasse, Sexe, DateNaissance, Photo) VALUES(:email, :nom, :prenom, :motdepasse, :sexe, :dateNaiss, :photo)');
                                        $req->execute(array(
                                            'nom' => $nom,
                                            'prenom' => $prenom,
                                            'email' => $email,
                                            'motdepasse' => $password,
                                            'sexe' => $sexe,
                                            'dateNaiss' => $date,
                                            'photo' => $chemin
                                        ));
                                        header('Location: connexion.php?login_err=success');
            
                                    } else { header('Location: inscription.php?reg_err=password'); } 
                                } else { header('Location: inscription.php?reg_err=fichier_extension'); } 
                     
                            } else { header('Location: inscription.php?reg_err=fichier_size'); } 
                        } else { header('Location: inscription.php?reg_err=fichier_err'); } 

                    } else { header('Location: inscription.php?reg_err=date'); }
                    
                } else { header('Location: inscription.php?reg_err=email'); }

            } else { header('Location: inscription.php?reg_err=prenom'); }

        } else { header('Location: inscription.php?reg_err=nom'); }

    } else { header('Location: inscription.php?reg_err=already'); }
} 