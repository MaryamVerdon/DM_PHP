<?php
require_once 'DB.inc.php';

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password'])  && isset($_POST['sexe']) && isset($_POST['dateNaissance']) && isset($_FILES['monfichier']))
{
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['password']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $date = htmlspecialchars($_POST['dateNaissance']);

    $db = DB::getInstance();
    if ($db == null) echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
    else try
    {
        $tmpEtud = $db->getEtudiant($email);
        if($tmpEtud == null) //la personne n'est pas dans la BD
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                if(!empty($date))
                {
                    if($_FILES['monfichier']['error'] == 0)
                    {
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
                                move_uploaded_file($_FILES['monfichier']['tmp_name'],'images/'.$nouveaunom. '.' .$extension_upload);
                                $chemin = 'images/' . $nouveaunom. '.' .$extension_upload;
                                if(!empty($mdp))
                                {
                                    //hachage du MotDePasse
                                    $mdp = hash('sha256', $mdp);
                                    //INSERTION
                                    $db->insertEtudiant($email,$nom,$prenom,$mdp,$sexe,$date,$chemin);
                                    header('Location: connexion.php?login_err=success');
                                } else { header('Location: inscription.php?reg_err=password'); } 
                             } else { header('Location: inscription.php?reg_err=fichier_extension'); } 
                    } else { header('Location: inscription.php?reg_err=fichier_size'); } 
                } else { header('Location: inscription.php?reg_err=fichier_err'); } 
            } else { header('Location: inscription.php?reg_err=date'); }     
        } else { header('Location: inscription.php?reg_err=email'); }
    } else { header('Location: inscription.php?reg_err=already'); }

    }
    catch (Exception $e) { echo $e->getMessage(); }
    $db->close();
}


?> 