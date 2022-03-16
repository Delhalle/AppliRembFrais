<?php

namespace AppliRembFraisControle\model\repository;


use AppliRembFraisControle\model\entity\Table;
use Exception;
use AppliRembFraisControle\model\repository\Repository;
use PDO;


class TableRepository extends Repository
{

    public function getIdTable($nom)
    {
        try {
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT id From table_concerne where nom = :par_nom");
            $req->bindValue(':par_nom', $nom, PDO::PARAM_STR);

            $req->execute();

            $enreg = $req->fetch();

            $id = $enreg->id;

            $table = new Table($id, $nom);

            return $table;
        } catch (Exception $e) {
            die("BDselConnex: erreur vérification connexion 
            <br>Erreur :" . $e->getMessage());
        }
    }
}
