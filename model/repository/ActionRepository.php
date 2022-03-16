<?php
namespace App\model\repository;
date_default_timezone_set('Europe/Paris');
//class dont on a besoin (classe Repository.php obligatoire)
use App\model\entity\Action;
use PDO;
use PDOException;

class ActionRepository extends Repository
{
    public function getActionId ( $uneAction)
    {
        $db = $this->dbConnect();
        $req = $db ->prepare("SELECT id FROM 'action' WHERE libelle = :par_libelle");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_libelle', $uneAction, PDO::PARAM_STR);
        //on demande l'éxecution de la requete
        $req->execute();
        $enreg = $req->fetch();
        return intval($enreg->id);
    }
}