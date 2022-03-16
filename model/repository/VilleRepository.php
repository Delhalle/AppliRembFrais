<?php
//class dont on a besoin (classe Repository.php obligatoire)

namespace AppliRembFraisControle\model\repository;

use AppliRembFraisControle\model\entity\Ville;
use Repository;




class VilleRepository extends Repository
{
    //(requête permettant d'obtenir tous les types de frais
    public function getLesVilles()
    {
        $lesVilles = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM ville order by nom");
        $req->execute();
        $lesEnregs = $req->fetchAll();


        foreach ($lesEnregs  as $enreg) {

            $uneVille = new Ville(
                $enreg->numero_insee,
                $enreg->nom,
                $enreg->code_postal

            );
            array_push($lesVilles, $uneVille);
        }

        return $lesVilles;
    }
}
