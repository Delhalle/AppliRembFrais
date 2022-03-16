<?php

namespace App\model\entity;

Use DateTime;

class LogEvenement
{
    private ?int $id;
    private ?string $ipUtilisateur;
    private ?DateTime $dateHeure;
    private ?int $numeroEnreg;
    private ?int $idUtilisateur;
    private ?int $idAction;
    private ?int $idTableConcerner;

    public function __construct($id, $ipUtilisateur, $dateHeure, $numeroEnreg, $idUtilisateur, $idAction, $idTableConcerner)
    {
        $this->id = $id;
        $this->ipUtilisateur = $ipUtilisateur; 
        $this->dateHeure = $dateHeure;
        $this->numeroEnreg = $numeroEnreg;
        $this->idUtilisateur = $idUtilisateur;
        $this->idAction = $idAction;
        $this->idTableConcerner = $idTableConcerner;
    }

    public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}

    public function getIpUtilisateur()
	{
		return $this->ipUtilisateur;
	}
	public function setIpUtilisateur($ipUtilisateur)
	{
		$this->ipUtilisateur = $ipUtilisateur;
	}

    public function getDateHeure()
	{
		return $this->dateHeure;
	}
	public function setDateHeure($dateHeure)
	{
		$this->dateHeure = $dateHeure;
	}

    public function getNumeroEnreg()
	{
		return $this->numeroEnreg;
	}
	public function setNumeroEnreg($numeroEnreg)
	{
		$this->numeroEnreg = $numeroEnreg;
	}

    public function getIdUtilisateur()
	{
		return $this->idUtilisateur;
	}
	public function setIdUtilisateur($idUtilisateur)
	{
		$this->idUtilisateur = $idUtilisateur;
	}

    public function getIdAction()
	{
		return $this->idAction;
	}
	public function setIdAction($idAction)
	{
		$this->idAction = $idAction;
	}

    public function getidTableConcerner()
	{
		return $this->idTableConcerner;
	}
	public function setidTableConcerner($idTableConcerner)
	{
		$this->idTableConcerner = $idTableConcerner;
	}

}
