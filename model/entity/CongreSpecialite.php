<?php

namespace AppliRembFraisControle\model\entity;

use AppliRembFraisControle\model\entity\Congre;
use AppliRembFraisControle\model\entity\Specialite;

class CongreSpecialite
{

    private Congre $leCongre;
    private Specialite $laSpecialite;

    public function __construct($leCongre, $laSpecialite)
    {
        $this->leCongre = $leCongre;
        $this->laSpecialite = $laSpecialite;
    }
    public function getLeCongre()
    {
        return $this->leCongre;
    }
    public function setLeCongre($leCongre)
    {
        $this->leCongre = $leCongre;
    }
    public function getLaSpecialite()
    {
        return $this->laSpecialite;
    }
    public function setLaSpecialite($laSpecialite)
    {
        $this->laSpecialite = $laSpecialite;
    }
}
