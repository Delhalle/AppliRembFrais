<?php
namespace App\Model\Entity;

class Produit
{
	private ?int $id;
	private ?string $libelle;

    public function __construct($id, $libelle)
	{
		$this->id = $id;
		$this->libelle = $libelle;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
    public function getLibelle()
	{
		return $this->libelle;
	}
	public function setLibelle($libelle)
	{
		$this->libelle = $libelle;
	}
}