<?php
require 'DB.inc.php';
	session_start();

	if(!isset($_SESSION['user'])) header('Location: connexion.php');

	$email = $_SESSION['user'];

	$db = DB::getInstance();
	if ($db == null) echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
	else try
	{
		$tabFichesAcademiques = $db->getFichesAcademiques($email);
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
		<table>
			<thead>
				<tr><th> Liste des fiches académiques </th></tr>
			</thead>
			<tbody>
				<tr>
					<th> Nom </th>
					<th> Prénom </th>
					<th> Id fiche </th>
					<th> Nom de l'établissement </th>
					<th> Pays </th>
					<th> Nom de la formation </th>
					<th> Niveau </th>
					<th> Date de début </th>
					<th> Date de fin </th>
				</tr>

				<?php
					foreach($tabFichesAcademiques as $fiche )
					{
						echo('<tr>');
						echo('<td>'.$etudiant->getNom().'</td>');
						echo('<td>'.$etudiant->getPrenom().'</td>');
						echo('<td>'.$fiche->getID().'</td>');
						echo('<td>'.$fiche->getNomEtab().'</td>');
						echo('<td>'.$fiche->getPays().'</td>');
						echo('<td>'.$fiche->getNomFormation().'</td>');
						echo('<td>'.$fiche->getNiveau().'</td>');
						echo('<td>'.$fiche->getDateDebut().'</td>');
						echo('<td>'.$fiche->getDateFin().'</td>');
						echo('</tr>');
					}
				?>
			</tbody>
		</table>
	</body>

</html>

<?php
	}
	catch (Exception $e) { echo $e->getMessage(); }
	$db->close();
?>