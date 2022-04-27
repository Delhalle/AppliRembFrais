<?php
namespace App\Model\Repository;

use PDO;
use PDOException;
use DateTime;
use App\Model\Entity\{DeplacementPharmacie,Pharmacie,Produit,Ville};

date_default_timezone_set('Europe/Paris');

class DeplacementPharmacieRepository extends Repository
{
    public function ajoutDeplacementPharmacie(DeplacementPharmacie $deplACreer)
    {
        $deplDate = $deplACreer->getDateSaisie();
        $deplDate = $deplDate->format('Y-m-d');
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into deplacement_pharmacie 
            values (0,:par_date_saisie,:par_commentaire,:par_id_pharmacie,:par_id_produit,:par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            $req->bindValue(':par_date_saisie', $deplDate, PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $deplACreer->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_pharmacie', $deplACreer->getPharmacie()->getId(), PDO::PARAM_STR);
            $req->bindValue(':par_id_produit', $deplACreer->getProduit()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_delegue', $deplACreer->getDelegue()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        if ($ret != False){
            $insertedId = $db->lastInsertId();
            return [$ret, $insertedId];
        }
        return [$ret];
    }

    public function getLesDeplacementsDeleguePharm($idDelegue = null)
    {
        
        $lesDeplacements = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT deplacement_pharmacie.id, date_saisie, commentaire, produit.libelle, pharmacie.nom, pharmacie.rue, ville.codePostal, ville.nomVille
        FROM deplacement_pharmacie
        JOIN pharmacie ON id_pharmacie = pharmacie.id
        JOIN produit ON id_produit = produit.id
        JOIN ville ON pharmacie.numInsee = ville.numInsee 
        WHERE id_delegue = :par_id ");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_id', $idDelegue, PDO::PARAM_INT);
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unDemplacement = new DeplacementPharmacie(
                $enreg->id,
                new DateTime($enreg->date_saisie),
                $enreg->commentaire,
                new Pharmacie(null,$enreg->nom,$enreg->rue,new Ville(null, $enreg->codePostal, $enreg->nomVille)),
                new Produit(null, $enreg->libelle),
                null
            );

            array_push($lesDeplacements, $unDemplacement);
        }
        return $lesDeplacements;
    }

    public function getUnDeplacementPharm($idDeplacement)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT deplacement_pharmacie.id, date_saisie, commentaire, id_pharmacie, id_produit, pharmacie.numInsee
        FROM deplacement_pharmacie
        JOIN pharmacie ON id_pharmacie = pharmacie.id
        JOIN produit ON id_produit = produit.id
        JOIN ville ON pharmacie.numInsee = ville.numInsee 
        WHERE deplacement_pharmacie.id = :par_id");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_id', $idDeplacement, PDO::PARAM_INT);
        // on demande l'exécution de la requête 
        $req->execute();
        $enreg = $req->fetch();
        $unDeplacement = new DeplacementPharmacie(
            $enreg->id,
            new DateTime($enreg->date_saisie),
            $enreg->commentaire,
            new Pharmacie($enreg->id_pharmacie,null,null,new Ville($enreg->numInsee, null, null)),
            new Produit($enreg->id_produit, null),
            null
        );
        return $unDeplacement;
    }

    public function modifDeplacementPharmRemboursement(DeplacementPharmacie $deplAModifier)
    {
        $deplDate = $deplAModifier->getDateSaisie();
        $deplDate = $deplDate->format('Y-m-d');
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("update deplacement_pharmacie 
            set  date_saisie = :par_date_saisie, commentaire = :par_commentaire,
            id_pharmacie = :par_id_pharmacie, id_produit = :par_id_produit, id_delegue=:par_id_delegue
            where id = :par_id_deplacement");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $deplDate, PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $deplAModifier->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_pharmacie', $deplAModifier->getPharmacie()->getId(), PDO::PARAM_STR);
            $req->bindValue(':par_id_produit', $deplAModifier->getProduit()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_delegue', $deplAModifier->getDelegue()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_deplacement', $deplAModifier->getId(), PDO::PARAM_INT);
            $ret = $req->execute();

            $ret = true;
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
}