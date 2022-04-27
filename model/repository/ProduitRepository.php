<?php
namespace App\Model\Repository;

use App\Model\Entity\Produit;

class ProduitRepository extends Repository
{
    //(requête permettant d'obtenir tous les produits
    public function getLesProduits()
    {
        $lesProduits = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id,libelle FROM produit order by libelle");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
                $unProduit = new Produit(
                $enreg->id,
                $enreg->libelle,
            );
            array_push($lesProduits, $unProduit);
        }
        return $lesProduits;
    }
}
