<?php
//class dont on a besoin (classe Repository.php obligatoire)

namespace AppliRembFraisControle\model\repository;

use Exception;

use Repository;
use PDO;

class LogEvenementRepository extends Repository
{

    public function AjoutLog($logEvenement)
    {
        try {
            $date = $logEvenement->getDateAction();
            $dateAction = $date->format('Y-m-d H:i:s');
            $db = $this->dbConnect();
            $req = $db->prepare("INSERT INTO log_evenement VALUES (0, :par_ip_util, :par_date_action, :par_num_enreg ,:par_action, :par_table, :par_utilisateur)");
            $req->bindValue(':par_ip_util', $logEvenement->getIpUtilisateur(), PDO::PARAM_STR);
            $req->bindValue(':par_date_action', $dateAction, PDO::PARAM_STR);
            $req->bindValue(':par_num_enreg', $logEvenement->getNumEnreg(), PDO::PARAM_STR);
            $req->bindValue(':par_action', $logEvenement->getAction()->getId(), PDO::PARAM_STR);
            $req->bindValue(':par_table', $logEvenement->getTable()->getId(), PDO::PARAM_STR);
            $req->bindValue(':par_utilisateur', $logEvenement->getUtilisateur()->getId(), PDO::PARAM_STR);

            $ret = $req->execute();
        } catch (Exception $e) {
            die("BDselConnex: erreur ajout Log
            <br>Erreur :" . $e->getMessage());
            $ret = false;
        }
        return $ret;
    }
}
