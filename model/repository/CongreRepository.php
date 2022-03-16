<?php
//class dont on a besoin (classe Repository.php obligatoire)
namespace AppliRembFraisControle\model\repository;


use AppliRembFraisControle\model\entity\Congre;
use AppliRembFraisControle\model\entity\Ville;
use AppliRembFraisControle\model\entity\Pays;
use AppliRembFraisControle\model\entity\Utilisateur;
use PDOException;
use DateTime;
use Repository;
use PDO;

require_once(ROOT . "/model/repository/Repository.php");

require_once(ROOT . "/model/entity/Congre.php");
require_once(ROOT . "/model/entity/Ville.php");
require_once(ROOT . "/model/entity/Pays.php");


class CongreRepository extends Repository
{
    //(requête permettant d'obtenir tous les types de frais
    public function getLesCongres()
    {
        try {
            $lesCongres = array();
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT id, nom, dateDebut, dateFin, id_ville FROM congre order by nom");
            $req->execute();
            $lesEnregs = $req->fetchAll();
            foreach ($lesEnregs  as $enreg) {

                $unCongre = new Congre(
                    $enreg->id,
                    $enreg->nom,
                    new DateTime($enreg->dateDebut),
                    new DateTime($enreg->dateFin),
                    new Ville($enreg->id_ville, null, null)
                );
                array_push($lesCongres, $unCongre);
            }
        } catch (PDOException $e) {
            $ret = false;
        }



        return $lesCongres;
    }
    public function getLesCongresUtilisateur(Utilisateur $utilisateur)
    {
        try {
            $lesCongres = array();
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT congre.id, congre.nom, congre.dateDebut, congre.dateFin, avis FROM suivi_congre
            Join congre on id_congre = congre.id 
            Where id_utilisateur = :par_id_utilisateur");
            $req->bindValue(':par_id_utilisateur', $utilisateur->getId(), PDO::PARAM_INT);

            $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }

        $lesEnregs = $req->fetchAll();

        foreach ($lesEnregs  as $enreg) {

            $unCongre = new Congre(
                $enreg->id,
                $enreg->nom,
                new DateTime($enreg->dateDebut),
                new DateTime($enreg->dateFin),
                null
            );
            array_push($lesCongres, $unCongre);
        }
        return $lesCongres;
    }

    public function getLesCongresPays(Pays $pays)
    {

        try {
            $lesCongres = array();
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT congre.id, congre.nom, congre.dateDebut, congre.dateFin,id_pays, pays.libelle FROM congre
            Join pays on id_pays = pays.id
            Where id_pays = :par_id_pays");
            $req->bindValue(':par_id_pays', $pays->getId(), PDO::PARAM_INT);

            $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }

        $lesEnregs = $req->fetchAll();

        foreach ($lesEnregs  as $enreg) {

            $unCongre = new Congre(
                $enreg->id,
                $enreg->nom,
                new DateTime($enreg->dateDebut),
                new DateTime($enreg->dateFin),
                new Pays($enreg->id_pays, $enreg->libelle)
            );
            array_push($lesCongres, $unCongre);
        }

        return $lesCongres;
    }

    public function ajoutCongre(Congre $leCongre)
    {
        $db = $this->dbConnect();
        try {
            $dateDeb = $leCongre->getDateDebut();
            $dateDeb = $dateDeb->format('Y-m-d');
            $dateFin = $leCongre->getDateFin();
            $dateFin = $dateFin->format('Y-m-d');
            // on prépare la requête select
            $req = $db->prepare("insert into congre
            values (0,:par_nom,:par_date_deb,:par_date_fin,:par_id_ville)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 

            $req->bindValue(':par_nom', $leCongre->getNom(), PDO::PARAM_STR);
            $req->bindValue(':par_date_deb', $dateDeb, PDO::PARAM_STR);
            $req->bindValue(':par_date_fin', $dateFin, PDO::PARAM_STR);
            $req->bindValue(':par_id_ville', $leCongre->getVille()->getNumInsee(), PDO::PARAM_INT);
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
}
