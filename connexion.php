<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Accueil</title>
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
                            <div>
                                <strong>Erreur</strong> mot de passe incorrect
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
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                        break;

                        default : 
                    }
                }
                ?> 

       <h1>Connexion</h1>
        <form action="connexion_verification.php" method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Mot de passe">
            <button type="submit">Connexion</button>
            <a href="inscription.php">Inscription</a>
        </form> 
    </body>
</html>

