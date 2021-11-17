<?php

class DemandeRemboursementController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/DemandeRemboursementRepository.php');
        require_once(ROOT . '/model/repository/TypeFraisRepository.php');
        require_once(ROOT . '/model/entity/DemandeRemboursement.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
        require_once(ROOT . '/model/entity/TypeFrais.php');
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
            0,
            $_POST['commentaire'],
            new TypeFrais($idUtilConnecte, null),
            new Utilisateur($_POST['typeFrais'])
        );
        $uneDemandeRepository = new DemandeRemboursementRepository();
        $ret = $uneDemandeRepository->ajoutDemandeRemboursement($laDemande);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
        }
        //
        $typeFraisRepository = new TypeFraisRepository();
        $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();
        $this->render("demandeRemboursement/ajoutDemande", array("title" => "Ajout d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais, "msg" => $msg));
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
            $msg = "modification effectuée";
            $unDemRemboursRepository = new DemandeRemboursementRepository();
            $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);
            $this->render("demandeRemboursement/modifDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes, "msg" => $msg));
        }
    }
    public function consultMesDemandeRemboursement()
    {
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement();

        $this->render("demandeRemboursement/consultDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes));
    }
};
