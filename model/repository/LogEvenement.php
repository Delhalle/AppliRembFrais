<?php
namespace App\model\repository;
//class dont on a besoin (classe Repository.php obligatoire)
use App\model\entity\LogEvenement;
use PDO;
use PDOException;


class LogEvenementRepository extends Repository
{
    public function ajoutLogEvenement(logEvenement $logACreer)
    {
        $logDate = $logACreer->getDateHeure();
        $logDate = $logDate->format('Y-m-d H:i:s');
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("INSERT INTO log_evenement values (0, :par_ip_utilisateur, :par_date_heure, 
            :par_numero_enregistrement, :par_id_utilisateur, :par_id_action, :par_id_table_concerner)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_ip_utilisateur', $logACreer->getIpUtilisateur(),PDO::PARAM_STR);
            $req->bindValue(':par_date_heure', $logACreer->getDateHeure(), PDO::PARAM_STR);
            $req->bindValue(':par_numero_enregistrement', $logACreer->getNumeroEnreg(), PDO::PARAM_INT);
            $req->bindValue(':par_id_utilisateur', $logACreer->getIdUtilisateur(),PDO::PARAM_INT);
            $req->bindValue(':par_id_action', $logACreer->getIdAction(), pdo::PARAM_INT);
            $req->bindValue(':par_id_table_concerner', $logACreer->getidTableConcerner(), pdo::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        }catch (PDOException $e){
            $ret = false;
        }
        return $ret;
    }
}