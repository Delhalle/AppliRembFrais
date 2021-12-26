<?php

class FormationSuiviController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/FormationSuiviRepository.php');
        require_once(ROOT . '/model/repository/UtilisateurRepository.php');
        require_once(ROOT . '/model/repository/FormationRepository.php');
        require_once(ROOT . '/model/entity/FormationSuivi.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
        require_once(ROOT . '/model/entity/Formation.php');
    }
    public function ajoutFormationSuiviForm()
    {
        $formationRepository = new FormationRepository();
        $lesFormations = $formationRepository->getLesFormations();
        
        $this->render("FormationSuivi/ajoutFormationSuivi", array ("title" => "Ajout d'une formation suivi", "lesFormations"=>$lesFormations));
    }
    public function ajoutFormationSuiviTrait()  
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laFormationSuivi = new FormationSuivi(
            null,
            date('Y-m-d H:i:s'),
            $_POST['commentaire'],
            new Formation($_POST['formation'],null),
            new Utilisateur($idUtilConnecte)
        );
        $uneFormationSuiviRepository = new FormationSuiviRepository();
        $ret = $uneFormationSuiviRepository->ajoutFormationSuivi($laFormationSuivi);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
        }
        //
        $formationRepository = new FormationRepository();
        $lesFormations = $formationRepository->getLesFormations();
        $this->render("formationSuivi/ajoutFormationSuivi", array ("title" => "Ajout d'une formation suivi", "lesFormations"=>$lesFormations, "msg" => $msg));
    }




    public function modifFormationSuiviListeForm()
    {
        //
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $uneFormSuiviRepository = new formationSuiviRepository();
        $lesFormationsSuivi = $uneFormSuiviRepository->getMesFormationsSuivi($idUtilConnecte);

        $this->render("formationSuivi/modifFormationSuiviList", array("title" => "Liste des formations suivi", "lesFormationsSuivi" => $lesFormationsSuivi));
    }

    public function modifFormationSuiviForm()
    {
        //
        $formationRepository = new FormationRepository();
        $lesFormations = $formationRepository->getLesFormations();

        //
        $idFormSuivi =  $_POST["listFormSuivi"];

        //
        $uneFormSuiviRepository = new FormationSuiviRepository();
        $laFormSuiviAModifier = $uneFormSuiviRepository->getUneFormationSuivi($idFormSuivi);
        //
        $this->render("formationSuivi/modifFormationSuivi", array("title" => "Modification d'une formation suivi", "lesFormations" => $lesFormations, "laFormSuivi" => $laFormSuiviAModifier));
    }


    public function modifFormationSuiviTrait()
    {
        //
        $uneFormationSuiviRepository = new FormationSuiviRepository();
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laFormSuivi = new FormationSuivi(
            $_POST['idFormSuivi'],
            date('Y-m-d H:i:s'),
            $_POST['commentaire'],
            new TypeFrais($_POST['formation'], null),
            new Utilisateur($idUtilConnecte)
        );
        $uneFormationSuiviRepository = new FormationSuiviRepository();
        $ret = $uneFormationSuiviRepository->modifFormationSuivi($laFormSuivi);
        if ($ret == false) {
            $msg = "modification impossible";
            $formationRepository = new formationRepository();
            $lesFormations = $formationRepository->getlesFormations();
            $this->render("formationSuivi/modifFormSuivi", array("title" => "Modification d'une formation suivi", "lesFormations" => $lesFormations,  "laFormSuivi" => $laFormSuivi, "msg" => $msg));
        } else {
            $msg = "modification effectuée";
            $uneFormationSuiviRepository = new FormationSuiviRepository();
            $lesFormationSuivi = $uneFormationSuiviRepository->getMesFormationsSuivi($idUtilConnecte);
            $this->render("formationSuivi/modifFormSuiviListe", array("title" => "Liste des demandes de remboursement", "lesFormationSuivi" => $lesFormationSuivi, "msg" => $msg));
        }
    }







    
    public function consultLesFormationsSuivi()
    {
        
        $uneFormationSuiviRepository = new FormationSuiviRepository();
        $lesFormationsSuivi = $uneFormationSuiviRepository->getLesFormationsSuivi($_POST["listDel"]);

        $this->render("formationSuivi/consultFormationSuivi", array("title" => "Liste des formation", "lesFormationsSuivi" => $lesFormationsSuivi));
    }
}
    