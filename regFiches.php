<?php
	require 'classe/DB.inc.php';

	session_start();
	if(!isset($_SESSION['user'])) header('Location: index.php');

	if(isset($_POST["email"]) && isset($_POST["nomEtab"]) && isset($_POST["pays"]) && isset($_POST["nomForm"]) && isset($_POST["niveau"]) && isset($_POST["dateDeb"]) && isset($_POST["dateFin"]))
	{

	    if (filter_var($_POST['dateDeb'], FILTER_VALIDATE_INT) && filter_var($_POST['dateFin'], FILTER_VALIDATE_INT))
        {
            $db = DB::getInstance();
            if ($db == null) echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
            else try
            {
                $email = $_POST["email"];
                $nomEtab = $_POST["nomEtab"];
                $pays = $_POST["pays"];
                $nomForm = $_POST["nomForm"];
                $niveau = $_POST["niveau"];
                $dateDeb = $_POST["dateDeb"];
                $dateFin = $_POST["dateFin"];
                $db->insertFichesAcademique($email,$nomEtab,$pays,$nomForm,$niveau,$dateDeb,$dateFin);

            }
            catch (Exception $e) { echo $e->getMessage(); }
            $db->close();
            header('Location: visuFiches.php');

        }
	    else {
            header('Location: regFiches.php?reg_err=date');
        }

	}
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="UTF-8"/>
		<meta name="author" content="Arthur ALAIN"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content=" Fiches Académiques ">
        <!-- css -->
        <link rel="stylesheet" href="css/tableau.css">
		<!--link rel="stylesheet" href="CSS/styleGeneral.css"-->
		<link rel="icon" type="image/png" href="Images/Header/logo.png" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<title> Fiches Académiques </title>
	</head>

    <?php
    if(isset($_GET['reg_err'])) {
        $err = htmlspecialchars($_GET['reg_err']);
        echo "<div class='alert alert-danger' role='alert'>
            <strong>Erreur</strong> la date doit être en chiffre (exemple : 2021)
        </div>";
    }
    ?>
	<body>

    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="profil.php">Profil</a>
                <a class="nav-item nav-link" href="visuFiches.php">Consulter fiches</a>
                <a class="nav-item nav-link" href="regFiches.php">Ajouter fiche</a>
            </div>
        </div>
    </nav>

		<form action="regFiches.php" method="POST">
		<table class="table2 table">
			<thead>
				<tr><th> Enregistrer des fiches académique </th></tr>
			</thead>
			<tbody>
				<tr>
					<?php echo('<input type="hidden" name="email" value="'.$_SESSION["user"].'" >'); ?>
					<td><label for="nomEtab"> Nom de l'établissement </label> <input type="text" id="nomEtab" name="nomEtab"></td>
					<td><label for="pays"> Pays </label> <input type="text" id="pays" name="pays"></td>
					<td><label for="nomForm"> Nom de la formation </label> <input type="text" id="nomForm" name="nomForm"></td>
					<td><label for="niveau"> Niveau </label> <input type="number" id="niveau" name="niveau"></td>
					<td><label for="dateDeb"> Date de début </label> <input type="text" id="dateDeb" name="dateDeb"></td>
					<td><label for="dateFin"> Date de fin </label> <input type="text" id="dateFin" name="dateFin"></td>
					<td> <input class="btnFiche btn mt-4" type="submit" id="valider" name="valider" value="valider"> </td>
				</tr>
			</tbody>
		</table>
		</form>
	</body>

</html>