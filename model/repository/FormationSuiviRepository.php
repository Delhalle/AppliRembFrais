<?php
date_default_timezone_set('Europe/Paris');
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class FormationSuiviRepository extends Repository
{
    public function ajoutFormationSuivi(FormationSuivi $ajoutACreer)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête insert
            $req = $db->prepare("INSERT into formation_suivi values 
            (0, :par_date_saisie, :par_commentaire, :par_note, :par_id_formation, :par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $ajoutACreer->getDateSaisie(), PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $ajoutACreer->getCommentaire(),PDO::PARAM_STR);
            $req->bindValue(':par_note', $ajoutACreer->getNote(),PDO::PARAM_STR);
            $req->bindValue(':par_id_formation',$ajoutACreer->getFormation()->getId(),PDO::PARAM_INT);
            $req->bindValue(':par_id_delegue', $ajoutACreer->getDelegue()->getId(),PDO::PARAM_INT);
             // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
}
