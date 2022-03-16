<?php


// require_once(ROOT . "/model/autoload.php");

namespace AppliRembFraisControle\model\repository;

use AppliRembFraisControle\model\entity\Pays;
use AppliRembFraisControle\model\repository\Repository;
use PDO;


class PaysRepository extends Repository
{
    //(requête permettant d'obtenir tous les types de frais

    public function getLePays($lePays)
    {

        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM pays where id = :par_id");
        $req->bindValue(':par_id', $lePays->getId(), PDO::PARAM_INT);

        $req->execute();
        $lesEnregs = $req->fetchAll();


        foreach ($lesEnregs  as $enreg) {

            $unPays = new Pays(
                $enreg->id,
                $enreg->libelle,


            );
        }

        return $unPays;
    }



    public function getLesPays()
    {
        $lesPays = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM pays");
        $req->execute();
        $lesEnregs = $req->fetchAll();


        foreach ($lesEnregs  as $enreg) {

            $unPays = new Pays(
                $enreg->id,
                $enreg->libelle,


            );
            array_push($lesPays, $unPays);
        }

        return $lesPays;
    }
}
