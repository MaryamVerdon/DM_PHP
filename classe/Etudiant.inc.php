<?php
/*classe permettant de representer un utilisateur */
class Etudiant
{
	private $email;
	private $nom;
	private $prenom;
	private $mot_passe;
	private $sexe;
	private $date_naissance;
	private $photo_profil;

	public function __construct($email="",$nom="",$prenom="",$mdp="",$sexe="",$dateN="",$photo="")
	{
		$this->email = $email;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->mot_passe = $mdp;
		$this->sexe = $sexe;
		$this->date_naissance = $dateN;
		$this->photo_profil = $photo;
	}

	public function getEmail () { return $this->email; }
	public function getNom   () { return $this->nom;   }
	public function getPrenom () { return $this->prenom; }
	public function getMdp () { return $this->mot_passe; }
	public function getSexe () { return $this->sexe; }
	public function getDateNaissance () { return $this->date_naissance; }
	public function getPhotoProfil () { return $this->photo_profil; }

	public function __toString()
	{
		$res = 'Email : '.$this->email.'      mdp : '.$this->mot_passe;
		return $res;
	}
}
?>
