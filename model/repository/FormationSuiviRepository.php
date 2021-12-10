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
            $req = $db->prepare("insert into formation_suivi values 
            (0, :par_date_saisie, :par_commentaire, :par_id_formation, :par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $ajoutACreer->getDateSaisie(), PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $ajoutACreer->getCommentaire(),PDO::PARAM_STR);
            $req->bindValue(':par_id_formation',$ajoutACreer->getFormation()->getId(),PDO::PARAM_INT);
            $req->bindValue(':par_id_delegue', $ajoutACreer->getDelegue()->getId(),PDO::PARAM_INT);
             // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }

    public function getLesFormationsSuivi($idDelegue = null)
    {
        
        $lesFormationSuivi = array();
        $db = $this->dbConnect();
        $req = $db->prepare("select formation_suivi.id as id, 
                        DATE_FORMAT(date_saisie, '%d/%m/%Y') as date_saisie, 
                        formation.formation, commentaire
                        from formation_suivi 
                        join formation on formation.id = id_formation 
                        where id_delegue = :par_id_delegue");
        $req->bindValue(':par_id_delegue', $idDelegue, PDO::PARAM_INT);
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $uneFormSuivi = new FormationSuivi(
                $enreg->id,
                $enreg->date_saisie,
                $enreg->commentaire,
                new Formation(null, $enreg->formation),
                null
            );

            array_push($lesFormationSuivi, $uneFormSuivi);
        }
        return $lesFormationSuivi;
    }
}


