<?php
	require 'DB.inc.php';
	session_start();

	if(!isset($_SESSION['user'])) header('Location: connexion.php');

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
		<title> Fiches Académiques </title>
	</head>

	<body>
		<nav> 
			<a href="inscription.php"> Inscription </a>
			<a href="connexion.php"> Connexion </a>
			<a href="visuFiches.php"> Liste des fiches </a>
			<a href="regFiches.php"> Création de fiche </a>
		 </nav>

		<form action="handleFiche.php" method="POST">
			<table>
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
								echo('<td><a class="btnModif" id="'.$i.'"> Modifier </a></td>');
								echo('<td><a class="btnSuppr" id="'.$fiche->getID().'" href="handleFiche?delId='.$fiche->getID().'"> Supprimer </a></td>');
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

	<script type="text/javascript" src="modifier.js"></script>

</html>

