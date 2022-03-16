<?php

namespace AppliRembFraisControle\model\entity;

use DateTime;
use AppliRembFraisControle\model\entity\Action;
use AppliRembFraisControle\model\entity\Table;
use AppliRembFraisControle\model\entity\Utilisateur;


class LogEvenement
{

    private int $id;
    private string $ipUtilisateur;
    private DateTime $dateAction;
    private int $numEnreg;
    private Action $action;
    private Table $table;
    private Utilisateur $utilisateur;

    public function __construct(int $id = null, string $ipUtilisateur = null, DateTime $dateAction = null, int $numEnreg = null, Action $action = null, Table $table = null, Utilisateur $utilisateur = null)
    {
        $this->id = $id;
        $this->ipUtilisateur = $ipUtilisateur;
        $this->dateAction = $dateAction;
        $this->numEnreg = $numEnreg;
        $this->action = $action;
        $this->table = $table;
        $this->utilisateur = $utilisateur;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of ipUtilisateur
     */
    public function getIpUtilisateur()
    {
        return $this->ipUtilisateur;
    }

    /**
     * Set the value of ipUtilisateur
     *
     * @return  self
     */
    public function setIpUtilisateur($ipUtilisateur)
    {
        $this->ipUtilisateur = $ipUtilisateur;

        return $this;
    }

    /**
     * Get the value of dateAction
     */
    public function getDateAction()
    {
        return $this->dateAction;
    }

    /**
     * Set the value of dateAction
     *
     * @return  self
     */
    public function setDateAction($dateAction)
    {
        $this->dateAction = $dateAction;

        return $this;
    }

    /**
     * Get the value of numEnreg
     */
    public function getNumEnreg()
    {
        return $this->numEnreg;
    }

    /**
     * Set the value of numEnreg
     *
     * @return  self
     */
    public function setNumEnreg($numEnreg)
    {
        $this->numEnreg = $numEnreg;

        return $this;
    }

    /**
     * Get the value of action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the value of table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the value of table
     *
     * @return  self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get the value of utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set the value of utilisateur
     *
     * @return  self
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
