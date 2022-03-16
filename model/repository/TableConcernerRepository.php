<?php
namespace App\model\repository;
//class dont on a besoin (classe Repository.php obligatoire)

use PDO;

class TableConcernerRepository extends Repository
{
    public function getTableConcernerId ($uneTableConcerner)
    {
        $db = $this->dbConnect();
        $req = $db ->prepare("SELECT id FROM 'table_concerner' WHERE nom = :par_nom");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_nom', $uneTableConcerner, PDO::PARAM_STR);
        //on demande l'éxecution de la requete
        $req->execute();
        $enreg = $req->fetch();
        return intval($enreg->id);
    }
}