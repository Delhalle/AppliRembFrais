<?php
namespace App\Model\Entity;

use DateTime;

class DeplacementPharmacie
{
	private ?int $id;
	private ?DateTime $dateSaisie;
	private ?string $commentaire;
	private ?Pharmacie $laPharmacie;
	private ?Produit $leProduit;
	private ?Utilisateur $leDelegue;

	public function __construct($id, $dateSaisie, $commentaire, $laPharmacie, $leProduit, $leDelegue)
	{
		$this->id = $id;
		$this->dateSaisie = $dateSaisie;
		$this->commentaire = $commentaire;
		$this->laPharmacie = $laPharmacie;
		$this->leProduit = $leProduit;
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
	public function getCommentaire()
	{
		return $this->commentaire;
	}
	public function setCommentaire($commentaire)
	{
		$this->commentaire = $commentaire;
	}
    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }
	public function setDateSaisie($dateSaisie)
	{
		$this->dateSaisie = $dateSaisie;
	}
	public function getPharmacie()
	{
		return $this->laPharmacie;
	}
	public function setPharmacie($laPharmacie)
	{
		$this->laPharmacie = $laPharmacie;
	}
	public function getProduit()
	{
		return $this->leProduit;
	}
	public function setProduit($leProduit)
	{
		$this->leProduit = $leProduit;
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