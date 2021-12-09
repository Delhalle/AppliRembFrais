<?php

class DeplacementPharmacieController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/DeplacementPharmacieRepository.php');
        require_once(ROOT . '/model/repository/PharmacieRepository.php');
        require_once(ROOT . '/model/repository/ProduitRepository.php');
        require_once(ROOT . '/model/entity/DeplacementPharmacie.php');
        require_once(ROOT . '/model/entity/Pharmacie.php');
        require_once(ROOT . '/model/entity/Produit.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
    }
    public function ajoutDeplacementPharmacieForm()
    {
        $PharmacieRepository = new PharmacieRepository();
        $lesPharmacies = $PharmacieRepository->getLesPharmacies();
        $ProduitRepository = new ProduitRepository();
        $lesProduits = $ProduitRepository->getLesProduits();
        $this->render("deplacementPharmacie/ajoutDeplacement", array("title" => "Ajout d'une demande de déplacement chez une pharmacie", "lesPharmacies" => $lesPharmacies, "lesProduits" => $lesProduits));
    }

    public function ajoutDeplacementPharmacieTrait()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $leDeplacement = new DeplacementPharmacie(
            null,
            new DateTime($_POST['date_saisie']),
            $_POST['commentaire'],
            new Pharmacie($_POST['pharmacie'], null, null, null),
            new Produit($_POST['produit'], null),
            new Utilisateur($idUtilConnecte)
        );
        $unDeplacementRepository = new DeplacementPharmacieRepository();
        $ret = $unDeplacementRepository->ajoutDeplacementPharmacie($leDeplacement);
        
        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
        }
        //
        $PharmacieRepository = new PharmacieRepository();
        $lesPharmacies = $PharmacieRepository->getLesPharmacies();
        $ProduitRepository = new ProduitRepository();
        $lesProduits = $ProduitRepository->getLesProduits();
        $this->render("deplacementPharmacie/ajoutDeplacement", array("title" => "Ajout d'une demande de déplacement chez une pharmacie", "leDepl"=> $leDeplacement, "lesPharmacies" => $lesPharmacies, "lesProduits" => $lesProduits, "msg" => $msg));
    }

    public function consultDelegueDeplacementPharm()
    {
        $unDeplacementRepository = new DeplacementPharmacieRepository();
        $lesDeplacements = $unDeplacementRepository->getLesDeplacementsDeleguePharm($_POST['listDelegueDeplacementPharm']); 

        $this->render("deplacementPharmacie/consultDeplacementDelegue", array("title" => "Tableau des déplacements chez des pharmacies", "lesDeplacements"=> $lesDeplacements));
    }

    public function modifDeplacementPharmListeForm()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $unDeplacementRepository = new DeplacementPharmacieRepository();
        $lesDeplacements = $unDeplacementRepository->getLesDeplacementsDeleguePharm($idUtilConnecte); 

        $this->render("deplacementPharmacie/modifDeplacementListe", array("title" => "Liste des déplacements chez des pharmacies", "lesDeplacements"=> $lesDeplacements));
    }

    public function modifDeplacementPharmForm()
    {
        //
        $PharmacieRepository = new PharmacieRepository();
        $lesPharmacies = $PharmacieRepository->getLesPharmacies();
        $ProduitRepository = new ProduitRepository();
        $lesProduits = $ProduitRepository->getLesProduits();
        //
        $idDeplacement =  $_POST["listDeplPharm"];
        //
        $unDeplacementRepository = new DeplacementPharmacieRepository();
        $leDeplacementAModifier = $unDeplacementRepository->getUnDeplacementPharm($idDeplacement); 
        //
        $this->render("deplacementPharmacie/modifDeplacement", array("title" => "Modification d'un deplacement chez un pharmacien", "lesPharmacies" => $lesPharmacies, "lesProduits" => $lesProduits, "leDeplacement" => $leDeplacementAModifier));
    }

    public function modifDeplacementPharmacieTrait()
    {
        //
        $unDeplacementPharmRepository = new DeplacementPharmacieRepository();
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $leDeplacement = new DeplacementPharmacie(
            $_POST['idDeplacement'],
            new DateTime($_POST['date_saisie']),
            $_POST['commentaire'],
            new Pharmacie($_POST['pharmacie'], null, null, null),
            new Produit($_POST['produit'], null),
            new Utilisateur($idUtilConnecte)
        );
        $unDeplacementRepository = new DeplacementPharmacieRepository();
        $ret = $unDeplacementRepository->modifDeplacementPharmRemboursement($leDeplacement);
        if ($ret == false) {
            $msg = "modification impossible";

            $PharmacieRepository = new PharmacieRepository();
            $lesPharmacies = $PharmacieRepository->getLesPharmacies();
            $ProduitRepository = new ProduitRepository();
            $lesProduits = $ProduitRepository->getLesProduits();
            $this->render("deplacementPharmacie/modifDeplacement", array("title" => "Modification d'un déplacement chez un pharmacien", "lesPharmacies" => $lesPharmacies, "lesProduits" => "lesProduits", "leDeplacement" => $leDeplacement, "msg" => $msg));
        } else {
            $msg = "modification effectuée";
            $unDeplacementPharmRepository = new DeplacementPharmacieRepository();
            $lesDeplacements = $unDeplacementPharmRepository->getLesDeplacementsDeleguePharm($idUtilConnecte);
            $this->render("deplacementPharmacie/modifDeplacementListe", array("title" => "Modification d'un deplacement chez un pharmacien", "lesDeplacements" => $lesDeplacements, "msg" => $msg));
        }
    }

}