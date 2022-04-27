<?php
namespace App\Model\Repository;

use App\Model\Entity\{Pharmacie,Ville};

class PharmacieRepository extends Repository
{
    //(requête permettant d'obtenir toutes les pharmacies 
    public function getLesPharmacies()
    {
        $lesPharmacies = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id,nom,rue,pharmacie.numInsee,ville.codePostal, ville.nomVille FROM pharmacie JOIN Ville on pharmacie.numInsee=Ville.numInsee order by nom");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
                $unePharmacie = new Pharmacie(
                $enreg->id,
                $enreg->nom,
                $enreg->rue,
                new Ville(null, $enreg->codePostal, $enreg->nomVille),
            );
            array_push($lesPharmacies, $unePharmacie);
        }
        return $lesPharmacies;
    }
}
