<?php

namespace AppliRembFraisControle\controller;

// use AppliRembFraisControle\controller\{
//     Controller
// };

use AppliRembFraisControle\model\entity\{
    SuiviCongre,
    Utilisateur,
    Congre
};
use AppliRembFraisControle\model\repository\{
    SuiviCongreRepository,
    CongreRepository,
};


class SuiviCongreController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function ajoutSuiviCongreForm()
    {
        $unCongreRepo = new CongreRepository();
        $lesCongres = $unCongreRepo->getLesCongres();

        $this->render("suiviCongre/ajoutSuivi", array("title" => "Ajout des informations de suivi à une conférence", "lesCongres" => $lesCongres));
    }
    public function ajoutSuiviCongreTrait()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $leSuiviCongres = new SuiviCongre(
            0,
            $_POST['resume'],
            $_POST['avis'],
            new Congre($_POST['congre'], null, null, null, null),
            new Utilisateur($idUtilConnecte)
        );

        $leCongreRep = new SuiviCongreRepository();
        $array = $leCongreRep->ajoutSuiviCongre($leSuiviCongres);
        $id = $array[0];

        $this->ajoutLog("INSERT", "suivi_congre", $id);
        //
        if ($array[1] == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {

            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
        }

        //
        $unCongreRepo = new CongreRepository();
        $lesCongres = $unCongreRepo->getLesCongres();



        $this->render("SuiviCongre/ajoutSuivi", array("title" => "Ajout des informations de suivi à une conférence", "lesCongres" => $lesCongres, "msg" => $msg, "leSuiviCongres" => $leSuiviCongres));
    }

    public function modifSuiviCongreForm()
    {
        session_start();
        $congres = $_POST['congres'];
        $id = $_SESSION['id'];
        $unCongreRepo = new CongreRepository();
        $lesCongres = $unCongreRepo->getLesCongres();
        $unSuiviCongresRepo = new SuiviCongreRepository();
        $leSuiviCongres = $unSuiviCongresRepo->getSuiviCongre($id, $congres);

        $this->render("suiviCongre/modifSuivi", array("title" => "Modification des informations de suivi à une conférence", "lesCongres" => $lesCongres, "leSuiviCongres" => $leSuiviCongres));
    }

    public function modifSuiviCongreTrait()
    {
        $unSuiviCongresRepo = new SuiviCongreRepository();
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $avis = $_POST['avis'];
        $resume = $_POST['resume'];
        $congres = $_POST['congres'];
        $resume = htmlspecialchars($resume);
        $avis = htmlspecialchars($avis);


        if (empty($avis) == true || trim($avis)  == "") {
            $msg = "<p style ='color:red'>Modification impossible, veuillez saisir un avis correct</p>";
            $this->render("suiviCongre/modifSuivi", array("title" => "Modification des informations de suivi à une conférence", "lesCongres" => null, "msg" => $msg, "leSuiviCongres" => null));
        }
        if (empty($resume) == true || trim($resume)  == "") {
            $msg = "<p style ='color:red'>Modification impossible, veuillez saisir un résumé correct</p>";
            $this->render("suiviCongre/modifSuivi", array("title" => "Modification des informations de suivi à une conférence", "lesCongres" => null, "msg" => $msg, "leSuiviCongres" => null));
        }


        $congresRepo = new CongreRepository();
        $lesCongres = $congresRepo->getLesCongres();
        $leSuiviCongres = $unSuiviCongresRepo->getSuiviCongre($idUtilConnecte, $congres);



        // $this->render("suiviCongre/modifSuivi", array("title" => "Modification des informations de suivi à une conférence", "lesCongres" => $lesCongres, "msg" => $msg));
        $id = $leSuiviCongres->getId();

        $laDemande = new SuiviCongre(
            $id,
            $resume,
            $avis,
            new Congre($_POST['congres']),
            new Utilisateur($idUtilConnecte)

        );
        $ret = $unSuiviCongresRepo->modifSuiviCongres($laDemande);
        $this->ajoutLog("UPDATE", "suivi_congre", $id);

        if ($ret == false) {
            $msg = "<p style ='color:red'>Modification impossible</p>";
            $congresRepo = new CongreRepository();
            $lesCongres = $congresRepo->getLesCongres();
            $this->render("suiviCongre/modifSuivi", array("title" => "Modification des informations de suivi à une conférence", "lesCongres" => $lesCongres, "leSuiviCongres" => $laDemande, "msg" => $msg));
        } else {
            $msg = "<p style ='color:green'>Modification effectuée</p>";
            $congresRepo = new CongreRepository();
            $unUtil = new Utilisateur($idUtilConnecte);
            $lesCongres = $congresRepo->getLesCongresUtilisateur($unUtil);
            $this->render("congre/listeDerCongres", array("title" => "Liste des congès suivies", "lesCongres" => $lesCongres, "msg" => $msg));
        }
    }
}
