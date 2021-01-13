<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
    </head>

    <body>

        <?php 
            if(isset($_GET['reg_err']))
            {
                $err = htmlspecialchars($_GET['reg_err']);
                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div>
                                <strong>Erreur</strong> le mot de passe ne peut pas être vide
                            </div>
                        break;

                        case 'nom':
                            ?>
                                <div>
                                    <strong>Erreur</strong> nom incorrect
                                </div>
                            <?php
                            break;

                        case 'prenom':
                            ?>
                                <div>
                                    <strong>Erreur</strong> prenom incorrect
                                </div>
                            <?php
                            break;

                        case 'email':
                        ?>
                            <div>
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                        break;

                        case 'date':
                            ?>
                                <div>
                                    <strong>Erreur</strong> la date saisie doit être du format : jj/mm/aaaa.
                                </div>
                            <?php
                            break;

                        case 'fichier_extension':
                            ?>
                                <div>
                                <strong>Erreur</strong> Le fichier doit être en : .jpg, .jpeg, .png ou .gif
                                </div>
                            <?php
                            break;  
                            
                        case 'fichier_size':
                            ?>
                                <div>
                                    <strong>Erreur</strong> Le fichier est trop volumineux.
                                </div>
                            <?php
                            break;  
                            
                        case 'fichier_err':
                            ?>
                                <div>
                                    <strong>Erreur</strong> Le fichier est endommagé
                                </div>
                            <?php
                            break;    


                        case 'success':
                            ?>
                                <div>
                                    Inscription terminé !
                                </div>
                            <?php
                            break;

                        case 'already':
                        ?>
                             <div>
                                <strong>Erreur</strong> Vous ne vous êtes pas inscrit 
                        <?php
                        break;

                        default : 
                    }
                }
                ?> 

       <h1>Inscription</h1>
        <form action="inscription_verification.php" method="post" enctype="multipart/form-data">
            <input type="text" name="nom" placeholder="Nom">
            <input type="text" name="prenom" placeholder="Prénom">
            <input type="email" name="email" placeholder="Email">
           <label>Date de naissance : <input type="date" name="dateNaissance"></label>
           <label>Sexe : </label>
            <input type="radio" name="sexe" value="femme" id="femme" checked="checked" /> <label for="femme">Femme</label>
            <input type="radio" name="sexe" value="homme" id="homme" /> <label for="homme">Homme</label>
            <input type="password" name="password" placeholder="Mot de passe">
            <input type="file" name="monfichier" />
            <button type="submit">Valider</button>
           <a href="index.php">Retour Accueil</a> 
        </form> 
    </body>
</html>