<?php
class DemandeRemboursement
{
	private ?int $id;
	private ?string $dateSaisie;
	private float $montant;
	private ?string $commentaire;
	private TypeFrais $leTypeFrais;
	private ?Utilisateur $leDelegue;

	public function __construct($id, $dateSaisie, $montant, $commentaire, $leTypeFrais, $leDelegue)
	{
		$this->id = $id;
		$this->dateSaisie = $dateSaisie;
		$this->montant = $montant;
		$this->commentaire = $commentaire;
		$this->leTypeFrais = $leTypeFrais;
		$this->leDelegue = $leDelegue;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getDateSaisie()
	{
		return $this->dateSaisie;
	}
	public function setDateSaisie($dateSaisie)
	{
		$this->dateSaisie = $dateSaisie;
	}
	public function getMontant()
	{
		return $this->montant;
	}
	public function setMontant($montant)
	{
		$this->montant = $montant;
	}
	public function getCommentaire()
	{
		return $this->commentaire;
	}
	public function setCommentaire($commentaire)
	{
		$this->commentaire = $commentaire;
	}
	public function getTypeFrais()
	{
		return $this->leTypeFrais;
	}
	public function setTypeFrais($leTypeFrais)
	{
		$this->leTypeFrais = $leTypeFrais;
	}
	public function getDelegue()
	{
		return $this->leDelegue;
	}
	public function setDelegue($leDelegue)
	{
		$this->leDelegue = $leDelegue;
	}
}
