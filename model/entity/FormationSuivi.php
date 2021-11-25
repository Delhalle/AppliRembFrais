<?php
class FormationSuivi
{
    private ?int $id;
	private ?string $dateSaisie;
    private ?string $commentaire;
	private ?int $note;
	private ?Formation $laFormation;
	private ?Utilisateur $leDelegue;
    
    public function __construct($id, $dateSaisie, $commentaire, $note, $laFormation, $leDelegue)
    {
        $this->id = $id;
		$this->dateSaisie = $dateSaisie;
        $this->commentaire = $commentaire;
		$this->note = $note;
		$this->laFormation = $laFormation;
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
    public function getCommentaire()
	{
		return $this->commentaire;
	}
	public function setCommentaire($commentaire)
	{
		$this->commentaire = $commentaire;
	}
    public function getNote()
	{
		return $this->note;
	}
	public function setNote($note)
	{
		$this->note = $note;
	}
    public function getFormation()
	{
		return $this->laFormation;
	}
	public function setFormation($laFormation)
	{
		$this->laFormation = $laFormation;
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