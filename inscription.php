<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>

        <!-- css -->
        <link rel="stylesheet" href="css/connexion.css">

        <!--font-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                            <div class="alert alert-danger" role="alert">
                                <strong>Erreur</strong> le mot de passe ne peut pas être vide
                            </div>
                            <?php
                        break;

                        case 'nom':
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Erreur</strong> nom incorrect
                                </div>
                            <?php
                            break;

                        case 'prenom':
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Erreur</strong> prenom incorrect
                                </div>
                            <?php
                            break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                        break;

                        case 'date':
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Erreur</strong> la date saisie doit être du format : jj/mm/aaaa.
                                </div>
                            <?php
                            break;

                        case 'fichier_extension':
                            ?>
                                <div class="alert alert-danger" role="alert">
                                <strong>Erreur</strong> Le fichier doit être en : .jpg, .jpeg, .png ou .gif
                                </div>
                            <?php
                            break;  
                            
                        case 'fichier_size':
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Erreur</strong> Le fichier est trop volumineux.
                                </div>
                            <?php
                            break;  
                            
                        case 'fichier_err':
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Erreur</strong> Le fichier est endommagé
                                </div>
                            <?php
                            break;    


                        case 'success':
                            ?>
                                <div class="alert alert-success" role="alert">
                                    Inscription terminé !
                                </div>
                            <?php
                            break;

                        case 'already':
                        ?>
                             <div class="alert alert-danger" role="alert">
                                <strong>Erreur</strong> Vous ne vous êtes pas inscrit 
                        <?php
                        break;

                        default : 
                    }
                }
                ?>

                                 <div class="container">
                                     <div class="row">
                                         <div class="col-8 mx-auto">
                                             <div class="card card-signin my-5">
                                                 <div class="card-body">
                                                     <h5 class="card-title text-center">Inscription</h5>
                                                     <form class="form-signin" action="inscription_verification.php" method="post" enctype="multipart/form-data">
                                                         <div class="form-label-group">
                                                             <input type="text" id="inputNom"  name="nom" class="form-control" placeholder="Nom" required>
                                                             <label for="inputNom">Nom</label>
                                                         </div>
                                                         <div class="form-label-group">
                                                             <input type="text" id="inputPrenom"  name="prenom" class="form-control" placeholder="Prénom" required>
                                                             <label for="inputPrenom">Prénom</label>
                                                         </div>
                                                         <div class="form-label-group">
                                                             <input type="email" id="inputEmail"  name="email" class="form-control" placeholder="Email" required>
                                                             <label for="inputEmail">Email</label>
                                                         </div>
                                                         <div class="form-label-group">
                                                             <input type="date" id="inputDate"  name="dateNaissance" class="form-control" placeholder="Date de Naissance" required>
                                                             <label for="inputDate">Date de Naissance</label>
                                                         </div>

                                                         <label>Sexe</label>
                                                         <div class="form-check">
                                                             <input class="form-check-input" type="radio" name="sexe" id="femme" value="1" checked>
                                                             <label class="form-check-label" for="femme">
                                                                 Femme
                                                             </label>
                                                         </div>
                                                         <div class="form-check pb-4">
                                                             <input class="form-check-input" type="radio" name="sexe" id="homme" value="2">
                                                             <label class="form-check-label" for="homme">
                                                                 Homme
                                                             </label>
                                                         </div>

                                                         <div class="form-label-group">
                                                             <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
                                                             <label for="inputPassword">Mot de passe</label>
                                                         </div>

                                                         <div class="form-label-group">
                                                             <input type="file" id="inputFile" name="monfichier" class="form-control">
                                                             <label for="inputFile">Photo de profil</label>
                                                         </div>

                                                         <button class="btn btn-lg btn-block text-uppercase" type="submit">Valider</button>
                                                         <hr class="my-4">
                                                         <a class="row url justify-content-md-center" href="index.php">Retour à l'accueil</a>
                                                     </form>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
    </body>
</html>