<?php
class Fonctionnalite
{
	private ?int $id;
	private ?string $libelle;
	private ?string $libelleMenuParent;
	private ?string $libelleMenuEnfant;
	private ?string $lienMenu;

	public function __construct($id = null, $libelle, $libelleMenuParent, $libelleMenuEnfant, $lienMenu)
	{
		$this->id = $id;
		$this->libelle = $libelle;
		$this->libelleMenuParent = $libelleMenuParent;
		$this->libelleMenuEnfant = $libelleMenuEnfant;
		$this->lienMenu = $lienMenu;
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
	public function getLibelleMenuParent()
	{
		return $this->libelleMenuParent;
	}
	public function setLibelleMenuParent($libelleMenuParent)
	{
		$this->libelleMenuParent = $libelleMenuParent;
	}
	public function getLibelleMenuEnfant()
	{
		return $this->libelleMenuEnfant;
	}
	public function setLibelleMenuEnfant($libelleMenuEnfant)
	{
		$this->libelle = $libelleMenuEnfant;
	}
	public function getLienMenu()
	{
		return $this->lienMenu;
	}
	public function setLienMenu($lienMenu)
	{
		$this->lienMenu = $lienMenu;
	}
}
