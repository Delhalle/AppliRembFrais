<?php

namespace AppliRembFraisControle\model\entity;

use DateTime;
use AppliRembFraisControle\model\entity\Ville;

class Congre
{
    private ?int $id;
    private ?string $nom;
    private ?DateTime $date_debut;
    private ?DateTime $date_fin;
    private ?Ville $laVille;


    public function __construct($id, $nom = null, $date_debut = null, $date_fin = null, $laVille = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->laVille = $laVille;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getDateDebut()
    {
        return $this->date_debut;
    }
    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }
    public function getDateFin()
    {
        return $this->date_fin;
    }
    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
    }
    public function getVille()
    {
        return $this->laVille;
    }
    public function setVille($laVille)
    {
        $this->laVille = $laVille;
    }
}
