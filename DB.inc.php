<?php

require 'Etudiant.inc.php';
require 'Fiche_Academique.inc.php';

class DB 
{
	private static $instance = null; //mémorisation de l'instance de DB pour appliquer le pattern Singleton
	private $connect=null;           //connexion PDO à la base

	/************************************************************************/
	/*        Constructeur gerant  la connexion à la base via PDO           */
	/************************************************************************/
	private function __construct()
	{
		// Connexion à la base de données
		$connStr = 'mysql:host=localhost;dbname=projetphp';
		try
		{
			// Connexion à la base
			$this->connect = new PDO($connStr, 'root', ''); // Base wamp en local
			// Configuration facultative de la connexion
			$this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			$this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e)
		{
			echo "probleme de connexion :".$e->getMessage();
			return null;
		}
	}

	/************************************************************************/
	/*          Methode permettant d'obtenir un objet instance de DB        */
	/************************************************************************/
	public static function getInstance()
	{
		if (is_null(self::$instance))
		{
			try { self::$instance = new DB(); }
			catch (PDOException $e) { echo $e; }
		}

		$obj = self::$instance;

		if (($obj->connect) == null) self::$instance=null;
		return self::$instance;
	}

	/************************************************************************/
	/*    Methode permettant de fermer la connexion a la base de données    */
	/************************************************************************/
	public function close() { $this->connect = null; }

	/************************************************************************/
	/*    Methode uniquement utilisable dans les méthodes de la class DB.   */
	/*     Permet d'exécuter n'importe quelle requête SQL et renvoit les    */
	/*    tuples renvoyés par la requête sous forme d'un tableau d'objets   */ 
	/************************************************************************/
	/* param1 : texte de la requête à exécuter (éventuellement paramétrée)  */
	/* param2 : tableau des valeurs permettant d'instancier les paramètres  */
	/* param3 : nom de la classe devant être utilisée pour créer les objets */
	/* qui vont représenter les différents tuples.                          */
	/************************************************************************/
	private function execQuery($requete,$tparam,$nomClasse)
	{
		//on prépare la requête
		$stmt = $this->connect->prepare($requete);
		//on indique que l'on va récupére les tuples sous forme d'objets instance de Client
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $nomClasse); 
		//on exécute la requête

		if ($tparam != null) $stmt->execute($tparam);
		else $stmt->execute();

		//récupération du résultat de la requête sous forme d'un tableau d'objets
		$tab = array();
		$tuple = $stmt->fetch(); //on récupère le premier tuple sous forme d'objet
		if ($tuple)
		{
			//au moins un tuple a été renvoyé
			while ($tuple != false)
			{
				$tab[]=$tuple;           //on ajoute l'objet en fin de tableau
				$tuple = $stmt->fetch(); //on récupère un tuple sous la forme
				                         //d'un objet instance de la classe $nomClasse
			}
		}
		return $tab;
	}

	/************************************************************************/
	/*   Methode utilisable uniquement dans les méthodes de la classe DB.   */
	/*   permet d'exécuter n'importe quel ordre SQL autre qu'une requête.   */
	/*  Résultat : nombre de tuples affectés par l'exécution de l'ordre SQL */
	/************************************************************************/
	/*  param1 : texte de l'ordre SQL à exécuter (éventuellement paramétré) */
	/*  param2 : tableau des valeurs permettant d'instancier les paramètres */
	/************************************************************************/
	private function execMaj($ordreSQL,$tparam)
	{		
		$stmt = $this->connect->prepare($ordreSQL);
		$res = $stmt->execute($tparam); //execution de l'ordre SQL 
		echo($stmt->rowCount());
		return $stmt->rowCount();
	}

	/************************************************************************/
	/*      Fonctions qui peuvent être utilisées dans les scripts PHP       */
	/************************************************************************/

	/*----------------- méthodes de gestion des étudiants ------------------*/

	public function getEtudiants()
	{
		$requete = 'SELECT * FROM projetphp.etudiant';
		return $this->execQuery($requete,null,'Etudiant');
	}

	public function getEtudiant($email)
	{
		$requete = 'SELECT * FROM projetphp.etudiant WHERE email = ?';
		return $this->execQuery($requete,array($email),'Etudiant');
	}

	public function getPassword($email)
	{
		$requete ='SELECT mot_passe FROM projetphp.etudiant WHERE email = $email';
		//return 
	}
	
	public function insertEtudiant($email,$nom,$prenom,$mdp,$sexe,$date,$photo)
	{
		$requete = 'INSERT INTO projetphp.etudiant VALUES(?,?,?,?,?,?,?)'; 
		$tparam = array($email,$nom,$prenom,$mdp,$sexe,$date,$photo);
		return $this->execMaj($requete,$tparam);
	}

	/*------------ méthodes de gestion des fiches académiques --------------*/

	public function getFichesAcademiques($email)
	{
		$requete = 'SELECT * FROM projetphp.fiche_academique WHERE email_etud = ?';
		return $this->execQuery($requete,array($email),'Fiche_Academique');
	}

	public function getFichesAcademique($id)
	{
		$requete = 'SELECT * FROM projetphp.fiche_academique WHERE id_fiche = ?';
		return $this->execQuery($requete,array($id),'Fiche_Academique');
	}

	public function insertFichesAcademique($email,$etab,$pays,$formation,$niveau,$dateDeb,$dateFin)
	{
		$requete = 'INSERT INTO projetphp.fiche_academique VALUES(?,?,?,?,?,?,?,?)'; 
		$tparam = array(0,$email,$etab,$pays,$formation,$niveau,$dateDeb,$dateFin);
		return $this->execMaj($requete,$tparam);
	}
	
}
?>