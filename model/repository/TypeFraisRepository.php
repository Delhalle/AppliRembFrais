<?php
//class dont on a besoin (classe Repository.php obligatoire)

namespace AppliRembFraisControle\model\repository;


use AppliRembFraisControle\model\entity\TypeFrais;
use Repository;



class TypeFraisRepository extends Repository
{
    //(requête permettant d'obtenir tous les types de frais
    public function getLesTypesFrais()
    {
        $lesTypesFrais = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM type_frais order by libelle");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unTypeFrais = new TypeFrais(
                $enreg->id,
                $enreg->libelle,
            );
            array_push($lesTypesFrais, $unTypeFrais);
        }
        return $lesTypesFrais;
    }
}
