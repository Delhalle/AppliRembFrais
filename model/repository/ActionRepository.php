<?php

namespace AppliRembFraisControle\model\repository;


use AppliRembFraisControle\model\entity\Action;
use Exception;
use AppliRembFraisControle\model\repository\Repository;
use PDO;

// require_once(ROOT . "/model/repository/Repository.php");
// require_once(ROOT . "/model/entity/Action.php");


class ActionRepository extends Repository
{

    public function getIdAction($libelle)
    {
        try {
            $libelle = strtoupper($libelle);
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT id From action where libelle = :par_libelle");
            $req->bindValue(':par_libelle', $libelle, PDO::PARAM_STR);

            $ret = $req->execute();

            $enreg = $req->fetch();

            $id = $enreg->id;

            $action = new Action($id, $libelle);

            return $action;
        } catch (Exception $e) {
            die("BDselConnex: erreur recup id de action 
            <br>Erreur :" . $e->getMessage());
        }
    }
}
