<?php
class FormationSuivi
{
    private ?int $id;
    private ?string $commentaire;
    
    public function __construct($id, $commentaire)
    {
        $this->id = $id;
        $this->commentaire = $commentaire;
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
    public function getNote()
	{
		return $this->note;
	}
	public function setNote($note)
	{
		$this->note = $note;
	}
    public function getIdFormation()
	{
		return $this->idFormation;
	}
	public function setIdFormation($idFormation)
	{
		$this->idFormation = $idFormation;
	}
    public function getIdDelegue()
	{
		return $this->idDelegue;
	}
	public function setIdDelegue($idDelegue)
	{
		$this->idDelegue = $idDelegue;
	}
}