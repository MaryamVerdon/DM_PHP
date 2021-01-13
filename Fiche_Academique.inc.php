<?php
/*classe permettant de representer un utilisateur */
class Fiche_Academique
{
	private $id_fiche;
	private $email_etud;
	private $nom_etab;
	private $pays;
	private $nom_form;
	private $niveau;
	private $date_deb;
	private $date_fin;

	public function __construct($id="",$email="",$etab="",$pays="",$form="",$niv="",$dateD="",$dateF="")
	{
		$this->id_fiche = $id;
		$this->email_etud = $email;
		$this->nom_etab = $etab;
		$this->pays = $pays;
		$this->nom_form = $form;
		$this->niveau = $niv;
		$this->date_deb = $dateD;
		$this->date_fin = $dateF;
	}

	public function getID () { return $this->id_fiche; }
	public function getEmailEtud   () { return $this->email_etud;   }
	public function getNomEtab () { return $this->nom_etab; }
	public function getPays () { return $this->pays; }
	public function getNomFormation () { return $this->nom_form; }
	public function getNiveau () { return $this->niveau; }
	public function getDateDebut () { return $this->date_deb; }
	public function getDateFin () { return $this->date_fin; }
}
?>
