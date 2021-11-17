<?php
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class DemandeRemboursementRepository extends Repository
{
    public function ajoutDemandeRemboursement(DemandeRemboursement $demACreer)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into demande_remboursement 
            values (0,:par_date_saisie,:par_montant,:par_commentaire,:par_id_type_frais,:par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $demACreer->getDateSaisie(), PDO::PARAM_STR);
            $req->bindValue(':par_montant', $demACreer->getMontant(), PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $demACreer->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_type_frais', $demACreer->getTypeFrais()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_delegue', $demACreer->getDelegue()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
    public function modifDemandeRemboursement(DemandeRemboursement $demAModifier)
    {
        $db = $this->dbConnect();
        try {
            session_start();
            $id = $_SESSION['id'];
            // on prépare la requête select
            $req = $db->prepare("update demande_remboursement 
            set  montant = :par_montant,
            id_type_frais=:par_id_type_frais, id_delegue=:par_id_delegue
            where id = :par_id_demande");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_montant', $demAModifier->getMontant(), PDO::PARAM_STR);
            $req->bindValue(':par_id_type_frais', $demAModifier->getTypeFrais()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_delegue', $demAModifier->getDelegue()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_demande', $demAModifier->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();

            $ret = true;
        } catch (PDOException $e) {
            $ret = false;
        }

        return $ret;
    }
    public function getMesDemandesRemboursement($idDelegue = null)
    {
        $lesDemandes = array();
        $db = $this->dbConnect();
        $req = $db->prepare("select demande_remboursement.id as id, 
                        DATE_FORMAT(date_saisie, '%d/%m/%Y à %H:%i:%s') as date_saisie, 
                        type_frais.libelle,montant, commentaire
                        from demande_remboursement 
                join type_frais on type_frais.id = id_type_frais");
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $uneDemande = new DemandeRemboursement(
                $enreg->id,
                $enreg->date_saisie,
                $enreg->montant,
                $enreg->commentaire,
                new TypeFrais(null, $enreg->libelle),
                null
            );
            array_push($lesDemandes, $uneDemande);
        }
        return $lesDemandes;
    }
    public function getUneDemandeRemboursement($idDem)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("select demande_remboursement.id,id_type_frais,montant, commentaire from demande_remboursement 
        join type_frais on type_frais.id = id_type_frais where demande_remboursement.id = :par_id");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_id', $idDem, PDO::PARAM_INT);
        // on demande l'exécution de la requête 
        $req->execute();
        $enreg = $req->fetch();
        $uneDemande = new DemandeRemboursement(
            $enreg->id,
            null,
            $enreg->montant,
            $enreg->commentaire,
            new TypeFrais($enreg->id_type_frais, null),
            null
        );
        return $uneDemande;
    }
}
