<?php
//class dont on a besoin (classe Repository.php obligatoire)
require_once(ROOT . "/model/repository/Repository.php");
require_once(ROOT . "/model/entity/Medecin.php");

class MedecinRepository extends Repository
{
    //(requête permettant d'obtenir tous les types de frais
    public function getLesMedecins()
    {
        $lesMedecins = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, nom, prenom FROM medecin order by nom");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unMedecin = new Medecin(
                $enreg->id,
                $enreg->nom,
                $enreg->prenom,
            );
            array_push($lesMedecins, $unMedecin);
        }
        return $lesMedecins;
    }
}