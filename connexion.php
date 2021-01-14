<?php
//require_once ('index.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Connexion</title>
        <!--css-->
        <link rel="stylesheet" href="css/connexion.css">
        <!--font & bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    </head>

    <body>

        <?php 
            if(isset($_GET['login_err']))
            {
                $err = htmlspecialchars($_GET['login_err']);
                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Erreur</strong> mot de passe incorrect
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
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                        break;

                        default : 
                    }
                }
                ?> 

       <!--  <form action="connexion_verification.php" method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Mot de passe">
            <button type="submit">Connexion</button>
            <a href="inscription.php">Inscription</a>
        </form> -->

        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Connexion</h5>
                            <form class="form-signin" action="connexion_verification.php" method="post">
                                <div class="form-label-group">
                                    <input type="email" id="inputEmail"  name="email" class="form-control" placeholder="Email" required>
                                    <label for="inputEmail">Email</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
                                    <label for="inputPassword">Mot de passe</label>
                                </div>

                                <button class="btn btn-lg btn-block text-uppercase" type="submit">Connexion</button>
                                <hr class="my-4">
                                <a class="row url justify-content-md-center" href="inscription.php">Inscription</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>

