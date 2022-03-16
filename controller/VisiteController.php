<?php
namespace App\controller;

use App\model\entity\{Visite, Medecin, Utilisateur};
use App\model\repository\{MedecinRepository, VisiteRepository};

class VisiteController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    public function ajoutVisiteForm()
    {
        $medecinRepository = new MedecinRepository();
        $lesMedecins = $medecinRepository->getLesMedecins();

        $this->render("visite/ajoutVisite", array("title" => "Ajout d'une visite", "lesMedecins" => $lesMedecins));
    }
    public function ajoutVisiteTrait()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laVisite = new Visite(
            null,
            date('Y-m-d H:i:s'),
            $_POST['commentaire'],
            new Medecin($_POST['medecin'], null, null),
            new Utilisateur($idUtilConnecte)
        );
        $uneVisiteRepository = new VisiteRepository();
        $ret = $uneVisiteRepository->ajoutVisite($laVisite);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre visite n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre visite a été enregistrée</p>";
        }
        $medecinRepository = new MedecinRepository();
        $lesMedecins = $medecinRepository->getLesMedecins();
        $this->render("visite/ajoutVisite", array("title" => "Ajout d'une visite", "lesMedecins" => $lesMedecins, "msg" => $msg));
    }
    public function consultLesVisites()
    {
        
        $uneVisiteRepository = new VisiteRepository();
        $lesVisites = $uneVisiteRepository->getLesVisites($_POST["listDel"]);

        $this->render("visite/consultVisite", array("title" => "Liste des visites", "lesVisites" => $lesVisites));
    }
}