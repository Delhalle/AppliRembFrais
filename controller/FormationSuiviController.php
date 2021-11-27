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
            $_POST['note'],
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
        $this->render("FormationSuivi/ajoutFormationSuivi", array ("title" => "Ajout d'une formation suivi", "lesUtilisateurs"=>$lesFormations, "msg" => $msg));
    }
    
    public function consultMesFormationSuivi()
    {
    session_start();
    $id = $_SESSION['id'];
    $uneFormationSuiviRepository = new FormationSuiviRepository();
    $lesFormSuivi = $uneFormationSuiviRepository->getLesFormationSuivi($id);

    $this->render("formationSuivi/ajoutFormationSuivi", array("title" => "Liste des formation suivi", "lesFormationSuivi"=>$lesFormSuivi));
    }
}
    