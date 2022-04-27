<?php

namespace App\model\repository;

use App\model\repository\Repository;
use App\model\entity\{LogEvenement};
use PDO, PDOException;

class LogEvenementRepository extends Repository
{
    public function insertLog(LogEvenement $leLog)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into logevenement 
            values (0,:par_ip_utilisateur,:par_date_heure,:par_num_enregistrement,:par_id_utilisateur,:par_id_action, :par_id_table)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_ip_utilisateur', $leLog->getIpUtilisateur(), PDO::PARAM_STR);
            $req->bindValue(':par_date_heure', $leLog->getDateheure(), PDO::PARAM_STR);
            $req->bindValue(':par_num_enregistrement', $leLog->getIdEnregistrement(), PDO::PARAM_STR);
            $req->bindValue(':par_id_utilisateur', $leLog->getUtilisateur()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_action', $leLog->getAction()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_table', $leLog->getTable()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
}
