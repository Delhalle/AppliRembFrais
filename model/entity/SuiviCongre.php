<?php

namespace AppliRembFraisControle\model\entity;

use AppliRembFraisControle\model\entity\Congre;
use AppliRembFraisControle\model\entity\Utilisateur;


class SuiviCongre
{
    private int $id;
    private ?string $resume;
    private ?string $avis;
    private ?Congre $leCongre;
    private ?Utilisateur $unUtilisateur;

    public function __construct($id, $resume = null, $avis = null, $leCongre = null, $unUtilisateur = null)
    {
        $this->id = $id;
        $this->resume = $resume;
        $this->avis = $avis;
        $this->leCongre = $leCongre;
        $this->unUtilisateur = $unUtilisateur;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getResume()
    {
        return $this->resume;
    }
    public function setResume($resume)
    {
        $this->resume = $resume;
    }
    public function getAvis()
    {
        return $this->avis;
    }
    public function setAvis($avis)
    {
        $this->avis = $avis;
    }
    public function getLeCongre()
    {
        return $this->leCongre;
    }
    public function setLeCongre($leCongre)
    {
        $this->leCongre = $leCongre;
    }
    public function getUtilisateur()
    {
        return $this->unUtilisateur;
    }
    public function setUtilisateur($unUtilisateur)
    {
        $this->leCongre = $unUtilisateur;
    }
}
