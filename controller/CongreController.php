<?php

namespace AppliRembFraisControle\controller;

use DateTime;
use AppliRembFraisControle\model\entity\{
    Pays,
    Utilisateur,
    Congre,
    Ville
};
use AppliRembFraisControle\model\repository\{

    CongreRepository,

    PaysRepository,
    VilleRepository
};
use AppliRembFraisControle\controller\Controller;

class CongreController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getLesCongres()
    {
        $lesCongres = new CongreRepository();
        $lesCongres = $lesCongres->getLesCongres();
        return $lesCongres;
    }

    public function getLesCongresListeDer()
    {
        session_start();

        $id = $_SESSION['id'];

        $utilisateur = new Utilisateur($id);

        $lesCongres = new CongreRepository();

        $lesCongres = $lesCongres->getLesCongresUtilisateur($utilisateur);

        $this->render("congre/listeDerCongres", array("title" => "Liste des congrès suivies", "lesCongres" => $lesCongres));

        return $lesCongres;
    }
    public function getLesCongresPays($id)
    {
        $pays = new Pays($id);
        $lePaysRepo = new PaysRepository();
        $paysChoisie = $lePaysRepo->getLePays($pays);
        $lesCongres = new CongreRepository();
        $lesCongres = $lesCongres->getLesCongresPays($pays);

        $this->render("congre/listeCongresSuivis", array("title" => "Liste des congrès suivies par le pays choisie", "paysChoisie" => $paysChoisie, "lesCongres" => $lesCongres));
        return $lesCongres;
    }

    public function getLesCongresUtilisateur($id)
    {
        $utilisateur = new Utilisateur($id);
        $lesCongres = new CongreRepository();
        $lesCongres = $lesCongres->getLesCongresUtilisateur($utilisateur);

        $this->render("congre/listeCongresSuivis", array("title" => "Liste des congrès suivies par le délégué choisi", "lesCongres" => $lesCongres));
        return $lesCongres;
    }
    public function ajoutCongreForm()
    {

        $villeRepo = new VilleRepository();

        $lesVilles = $villeRepo->getLesVilles();
        $this->render("congre/ajoutCongre", array("title" => "Ajout d'un congrès'", "lesVilles" => $lesVilles));
    }
    public function ajoutCongreTrait()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $leCongres = new Congre(
            0,
            $_POST['nom'],
            new DateTime($_POST['dateDeb']),
            new DateTime($_POST['dateFin']),
            new Ville($_POST['ville'], null, null)

        );

        $leCongreRep = new CongreRepository();
        $array = $leCongreRep->ajoutCongre($leCongres);

        $id = $array[0];

        $this->ajoutLog("INSERT", "congre", $id);


        //
        if ($array[1] == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {

            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
        }

        $villeRepo = new VilleRepository();
        $lesVilles = $villeRepo->getLesVilles();

        $this->render("congre/ajoutCongre", array("title" => "Ajout d'un congrés'", "lesVilles" => $lesVilles, "msg" => $msg));
    }
}
