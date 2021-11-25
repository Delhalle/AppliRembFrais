<?php
class Visite
{
	private ?int $id;
	private ?string $date;
	private ?string $commentaire;
	private ?Medecin $medecin;
	private ?Utilisateur $delegue;

	public function __construct($id, $date = null, $commentaire = null, $medecin = null, $delegue = null)
	{
		$this->id = $id;
		$this->date = $date;
		$this->commentaire = $commentaire;
		$this->medecin = $medecin;
		$this->delegue = $delegue;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function setDate($date)
	{
		$this->date = $date;
	}
	public function getCommentaire()
	{
		return $this->commentaire;
	}
	public function setCommentaire($commentaire)
	{
		$this->commentaire = $commentaire;
	}
	public function getMedecin()
	{
		return $this->medecin;
	}
	public function setMedecin($medecin)
	{
		$this->medecin = $medecin;
	}
	public function getDelegue()
	{
		return $this->delegue;
	}
	public function setDelegue($delegue)
	{
		$this->delegue = $delegue;
	}
}
