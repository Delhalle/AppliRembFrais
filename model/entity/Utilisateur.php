<?php
class Utilisateur
{
	private ?int $id;
	private ?string $nom;
	private ?string $prenom;
	private ?string $pseudo;
	private ?string $motDePasse;
	private ?Profil $leProfil;
	private ?Utilisateur $derUtilAction;

	public function __construct($id, $nom = null, $prenom = null, $pseudo = null, $motDePasse = null, $leProfil = null, $derUtilAction = null)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->pseudo = $pseudo;
		$this->motDePasse = $motDePasse;
		$this->leProfil = $leProfil;
		$this->derUtilAction = $derUtilAction;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function setNom($nom)
	{
		$this->nom = $nom;
	}
	public function getPrenom()
	{
		return $this->prenom;
	}
	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;
	}
	public function getPseudo()
	{
		return $this->pseudo;
	}
	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}
	public function getMotDePasse()
	{
		return $this->motDePasse;
	}
	public function setMotDePasse($motDePasse)
	{
		$this->motDePasse = $motDePasse;
	}
	public function getProfil(): ?Profil
	{
		return $this->leProfil;
	}
	public function setProfil($leProfil)
	{
		$this->leProfil = $leProfil;
	}
	public function getDerUtilAction(): ?Utilisateur
	{
		return $this->derUtilAction;
	}
	public function setDerUtilAction($derUtilAction)
	{
		$this->derUtilAction = $derUtilAction;
	}
}
