<?php
class Pharmacie
{
	private ?int $id;
    private ?string $nom;
	private ?string $rue;
	private ?Ville $laVille;

    public function __construct($id, $nom, $rue, $laVille)
	{
		$this->id = $id;
        $this->nom = $nom;
		$this->rue = $rue;
		$this->laVille = $laVille;
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
    public function getRue()
	{
		return $this->rue;
	}
	public function setRue($rue)
	{
		$this->rue = $rue;
	}
    public function getVille()
	{
		return $this->laVille;
	}
	public function setVille($laVille)
	{
		$this->laVille = $laVille;
	}

}


