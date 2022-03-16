<?php
date_default_timezone_set('Europe/Paris');

namespace AppliRembFraisControle\model\repository;

use AppliRembFraisControle\model\entity\Congre;
use AppliRembFraisControle\model\entity\Utilisateur;
use PDOException;
use AppliRembFraisControle\model\entity\suiviCongre;
use AppliRembFraisControle\model\repository\Repository;
use PDO;

class SuiviCongreRepository extends Repository
{
    public function ajoutSuiviCongre(SuiviCongre $suiviCongre)
    {
        $db = $this->dbConnect();
        try {

            // on prépare la requête insert
            $req = $db->prepare("insert into suivi_congre
            values (0,:par_resume,:par_avis,:par_id_congre,:par_id_utilisateur)");
            // on affecte une valeur au paramètre déclaré dans la requête 

            $req->bindValue(':par_resume', $suiviCongre->getResume(), PDO::PARAM_STR);
            $req->bindValue(':par_avis', $suiviCongre->getAvis(), PDO::PARAM_STR);
            $req->bindValue(':par_id_congre', $suiviCongre->getLeCongre()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_utilisateur', $suiviCongre->getUtilisateur()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();

            $idDernAjout = $db->lastInsertId();
            $Array = array();
            array_push($Array, $idDernAjout);
            array_push($Array, $ret);
        } catch (PDOException $e) {
            $ret = false;
        }


        return $Array;
    }

    public function modifSuiviCongres($laDemande)
    {
        $db = $this->dbConnect();

        try {

            // on prépare la requête update
            $req = $db->prepare("update suivi_congre set resume = :par_resume, avis = :par_avis, id_congre = :par_id_congre, id_utilisateur = :par_id_utilisateur where id = :par_id ");
            // on affecte une valeur au paramètre déclaré dans la requête 

            $req->bindValue(':par_id', $laDemande->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_resume', $laDemande->getResume(), PDO::PARAM_STR);
            $req->bindValue(':par_avis', $laDemande->getAvis(), PDO::PARAM_STR);
            $req->bindValue(':par_id_congre', $laDemande->getLeCongre()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_utilisateur', $laDemande->getUtilisateur()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 

            $ret = $req->execute();
        } catch (PDOException $e) {

            $ret = false;
        }


        return $ret;
    }

    public function getSuiviCongre($id, $congres)
    {
        try {

            $db = $this->dbConnect();
            $req = $db->prepare("SELECT * FROM suivi_congre where id_utilisateur = :par_id_util and id_congre = :par_id_congre");
            $req->bindValue(':par_id_util', $id, PDO::PARAM_INT);
            $req->bindValue(':par_id_congre', $congres, PDO::PARAM_INT);
            $req->execute();
            $lesEnregs = $req->fetchAll();
        } catch (PDOException $e) {
            $ret = false;
        }



        foreach ($lesEnregs  as $enreg) {

            $unSuiviCongre = new SuiviCongre(
                $enreg->id,
                $enreg->resume,
                $enreg->avis,
                new Congre($enreg->id_congre),
                new Utilisateur($enreg->id_utilisateur)
            );
        }

        return $unSuiviCongre;
    }
}
