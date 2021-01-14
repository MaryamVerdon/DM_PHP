<?php
	require 'classe/DB.inc.php';
	session_start();

	if(!isset($_SESSION['user'])) header('Location: index.php');

	$email = $_SESSION['user'];

	$db = DB::getInstance();
	if ($db == null) echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
	else try
	{
		$tabFichesAcademiques = "";
		if(isset($_GET["sort"])) 
		{
			$tabFichesAcademiques = $db->getFichesAcademiquesTri($email,$_GET["sort"]);
		}
		else $tabFichesAcademiques = $db->getFichesAcademiques($email);

		$etudiant = $db-> getEtudiant($email)[0];
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="UTF-8"/>
		<meta name="author" content="Arthur ALAIN"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content=" Fiches Académiques ">
		<!--link rel="stylesheet" href="CSS/styleGeneral.css"-->
		<link rel="icon" type="image/png" href="Images/Header/logo.png" />
        <!-- css -->
        <link rel="stylesheet" href="css/tableau.css">
        <!--bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<title> Fiches Académiques </title>
	</head>

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
		<form action="handleFiche.php" method="POST">
			<table class="table table-hover mt-5">
				<thead><tr><th> Liste des fiches académiques </th></tr></thead>
				<tbody>
					<tr>
						<th> Nom </th>
						<th> Prénom </th>
						<th><a href='visuFiches.php?sort=nom_etab'> Nom de l'établissement </a></th>
						<th><a href='visuFiches.php?sort=pays'> Pays </a></th>
						<th><a href='visuFiches.php?sort=nom_form'> Nom de la formation </a></th>
						<th><a href='visuFiches.php?sort=niveau'> Niveau </a></th>
						<th><a href='visuFiches.php?sort=date_deb'> Date de début </a></th>
						<th><a href='visuFiches.php?sort=date_fin'> Date de fin </a></th>
					</tr>
					
					<?php
							$i = 0;
							foreach($tabFichesAcademiques as $fiche )
							{
								echo('<tr id="tr_'.$i.'">');
								echo('<td>'.$etudiant->getNom().'</td>');
								echo('<td>'.$etudiant->getPrenom().'</td>');
								echo('<td>'.$fiche->getNomEtab().'</td>');
								echo('<td>'.$fiche->getPays().'</td>');
								echo('<td>'.$fiche->getNomFormation().'</td>');
								echo('<td>'.$fiche->getNiveau().'</td>');
								echo('<td>'.$fiche->getDateDebut().'</td>');
								echo('<td>'.$fiche->getDateFin().'</td>');
								echo('<td><a class="btnModif btn btn-outline-success" id="'.$i.'"> Modifier </a></td>');
								echo('<td><a class="btnSuppr btn" id="'.$fiche->getID().'" href="handleFiche?delId='.$fiche->getID().'"> Supprimer </a></td>');
								echo('</tr>');
								$i++;
							}
						}
						catch (Exception $e) { echo $e->getMessage(); }
						$db->close();
					?>
				</tbody>
			</table>
		</form>

	</body>

	<script type="text/javascript" src="js/modifier.js"></script>

</html>

