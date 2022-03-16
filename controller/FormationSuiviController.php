<?php
namespace App\controller;

use App\model\repository\{FormationRepository,FormationSuiviRepository};
use App\model\entity\{FormationSuivi, Formation,Utilisateur}; 

class FormationSuiviController extends Controller
{
    public function __construct()
    {
        parent::__construct();

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
        $this->render("FormationSuivi/ajoutFormationSuivi", array ("title" => "Ajout d'une formation suivi", "lesFormations"=>$lesFormations, "msg" => $msg));
    }
    
    public function consultLesFormationsSuivi()
    {
        
        $uneFormationSuiviRepository = new FormationSuiviRepository();
        $lesFormationsSuivi = $uneFormationSuiviRepository->getLesFormationsSuivi($_POST["listDel"]);

        $this->render("formationSuivi/consultFormationSuivi", array("title" => "Liste des formation", "lesFormationsSuivi" => $lesFormationsSuivi));
    }
}
    