<?php

namespace App\controller;

use App\controller\controller;
use App\model\repository\{DemandeRemboursementRepository, TypeFraisRepository};
use App\model\entity\{TypeFrais, Utilisateur, DemandeRemboursement};

class DemandeRemboursementController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function ajoutDemandeRemboursementForm()
    {
        $typeFraisRepository = new TypeFraisRepository();
        $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();

        $this->render("demandeRemboursement/ajoutDemande", array("title" => "Ajout d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais));
    }
    public function ajoutDemandeRemboursementTrait()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laDemande = new DemandeRemboursement(
            null,
            date('Y-m-d H:i:s'),
            $_POST['montant'],
            $_POST['commentaire'],
            new TypeFrais($_POST['typeFrais'], null),
            new Utilisateur($idUtilConnecte)
        );
        $uneDemandeRepository = new DemandeRemboursementRepository();
        $ret = $uneDemandeRepository->ajoutDemandeRemboursement($laDemande);

        //
        if ($ret[0] == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
            $this->insertInLogs(["insert", "demande_remboursement", $ret[1], $idUtilConnecte]);
        }
        //
        $typeFraisRepository = new TypeFraisRepository();
        $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();
        $this->render("demandeRemboursement/ajoutDemande", array("title" => "Ajout d'une demande de remboursement","laDemande"=> $laDemande, "lesTypesFrais" => $lesTypesFrais, "msg" => $msg));
    }
    public function modifDemandeRemboursementListeForm()
    {
        //
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);

        $this->render("demandeRemboursement/modifDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes));
    }

    public function modifDemandeRemboursementForm()
    {
        //
        $typeFraisRepository = new TypeFraisRepository();
        $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();

        //
        $idDemande =  $_POST["listDemRemb"];

        //
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        $laDemandeAModifier = $unDemRemboursRepository->getUneDemandeRemboursement($idDemande);
        //
        $this->render("demandeRemboursement/modifDemande", array("title" => "Modification d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais, "laDemande" => $laDemandeAModifier));
    }


    public function modifDemandeRemboursementTrait()
    {
        //
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laDemande = new DemandeRemboursement(
            $_POST['idDemande'],
            date('Y-m-d H:i:s'),
            $_POST['montant'],
            $_POST['commentaire'],
            new TypeFrais($_POST['typeFrais'], null),
            new Utilisateur($idUtilConnecte)
        );
        $uneDemandeRepository = new DemandeRemboursementRepository();
        $ret = $uneDemandeRepository->modifDemandeRemboursement($laDemande);
        if ($ret == false) {
            $msg = "modification impossible";
            $typeFraisRepository = new TypeFraisRepository();
            $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();
            $this->render("demandeRemboursement/modifDemande", array("title" => "Modification d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais,  "laDemande" => $laDemande, "msg" => $msg));
        } else {
            $this->insertInLogs(["update", "demande_remboursement", $_POST['idDemande'], $idUtilConnecte]);
            $msg = "modification effectuée";
            $unDemRemboursRepository = new DemandeRemboursementRepository();
            $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);
            $this->render("demandeRemboursement/modifDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes, "msg" => $msg));
        }
    }

    
    public function consultMesDemandeRemboursement()
    {
        session_start();
        $idUtilConnecte = $_SESSION['profil'];
        
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);

        $this->render("demandeRemboursement/consultDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes));
    }
};
