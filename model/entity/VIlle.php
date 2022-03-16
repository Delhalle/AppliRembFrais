<?php

namespace AppliRembFraisControle\model\entity;

class Ville
{
    private int $numero_insee;
    private ?string $nom;
    private ?string $code_postal;

    public function __construct($numero_insee, $nom = null, $code_postal = null)
    {
        $this->numero_insee = $numero_insee;
        $this->nom = $nom;
        $this->code_postal = $code_postal;
    }
    public function getNumInsee()
    {
        return $this->numero_insee;
    }
    public function setNumInsee($numero_insee)
    {
        $this->numero_insee = $numero_insee;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function setLibelle($nom)
    {
        $this->nom = $nom;
    }
    public function getCodePostal()
    {
        return $this->code_postal;
    }
    public function setCodePosteal($code_postal)
    {
        $this->code_postal = $code_postal;
    }
}
