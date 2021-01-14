<?php
	require 'DB.inc.php';

	session_start();
	if(!isset($_SESSION['user'])) header('Location: connexion.php');

	$db = DB::getInstance();
	if ($db == null) echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
	else try
	{
		if(isset($_GET["delId"])) $db->deleteFicheAcademique($_GET["delId"]);
		if(isset($_POST["modId"])) 
		{
			$nom_etab = $_POST["nom_etab"];
			$pays = $_POST["pays"];
			$nom_form = $_POST["nom_form"];
			$niveau = $_POST["niveau"];
			$dateDeb = $_POST["dateDeb"];
			$dateFin = $_POST["dateFin"];
			$id = $_POST["id_fiche"];
			$db->updateFicheAcademique($id,$_SESSION['user'],$nom_etab,
				$pays,$nom_form,$niveau,$dateDeb,$dateFin);
		}
	}
	catch (Exception $e) { echo $e->getMessage(); }
	$db->close();
	header('Location: visuFiches.php');
?>