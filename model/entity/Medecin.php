<?php
class Medecin
{
	private ?int $id;
	private ?string $nom;
    private ?string $prenom;

	public function __construct($id, $nom, $prenom)
	{
		$this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
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
}