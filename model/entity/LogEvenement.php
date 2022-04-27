<?php

namespace App\model\entity;

use App\model\entity\{Utilisateur, Action, Table};

class LogEvenement
{
	private ?int $id;
	private string $ipUtilisateur;
    private string $dateheure;
	private int $idEnregistrement;
    private Utilisateur $utilisateur;
	private Action $action;
	private Table $table;

	public function __construct($id, $ipUtilisateur, $dateheure, $idEnregistrement, $utilisateur, $action, $table)
	{
		$this->id = $id;
		$this->ipUtilisateur = $ipUtilisateur;
		$this->dateheure = $dateheure;
		$this->idEnregistrement = $idEnregistrement;
		$this->utilisateur = $utilisateur;
		$this->action = $action;
		$this->table = $table;
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
    public function getDateheure()
	{
		return $this->dateheure;
	}
	public function setDateheure($dateheure)
	{
		$this->dateheure = $dateheure;
	}
    public function getIdEnregistrement()
	{
		return $this->idEnregistrement;
	}
	public function setIdEnregistrement($idEnregistrement)
	{
		$this->idEnregistrement = $idEnregistrement;
	}
    public function getUtilisateur()
	{
		return $this->utilisateur;
	}
	public function setUtilisateur($utilisateur)
	{
		$this->utilisateur = $utilisateur;
	}
    public function getAction()
	{
		return $this->action;
	}
	public function setAction($action)
	{
		$this->action = $action;
	}
    public function getTable()
	{
		return $this->table;
	}
	public function setTable($table)
	{
		$this->table = $table;
	}
}
