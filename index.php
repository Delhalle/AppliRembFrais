<?php

use AppliRembFraisControle\Autoloader;
use AppliRembFraisControle\controller\{
    UtilisateurController,
    DemandeRemboursementController,
    SuiviCongreController,
    CongreController,
    PaysController
};

require_once "./autoloader.php";
Autoloader::register();

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "ajoutUtilisateurForm":

            $leControleur = new UtilisateurController();
            $leControleur->ajoutUtilisateurForm();
            break;
        case "ajoutUtilisateurTrait":

            $leControleur = new UtilisateurController();
            $leControleur->ajoutUtilisateurTrait();
            break;
        case "ajoutDemRembForm":
            session_start();

            $idDelegue = $_SESSION['id'];

            if (isset($idDelegue) == false || $idDelegue == 0) {

                $leControleur = new UtilisateurController();
                $leControleur->connexionForm();
                break;
            }

            $leControleur = new DemandeRemboursementController();
            $leControleur->ajoutDemandeRemboursementForm();
            break;
        case "ajoutDemRembTrait":

            $leControleur = new DemandeRemboursementController();
            $leControleur->ajoutDemandeRemboursementTrait();
            break;
        case "modifDemRembListeForm":

            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementListeForm();
            break;
        case "modifDemRembForm":

            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementForm();
            break;
        case "modifDemRembTrait":

            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementTrait();
            break;
        case "consultMesDemRemb":

            $leControleur = new DemandeRemboursementController();
            $leControleur->consultMesDemandeRemboursement();
            break;
        case "connexionTrait":

            $leControleur = new UtilisateurController();
            $leControleur->connexionTrait($_POST);
            break;
        case "ajoutSuiviCongreForm":
            $leControleur = new SuiviCongreController();
            $leControleur->ajoutSuiviCongreForm();
            break;
        case "ajoutSuiviCongreTrait":
            $leControleur = new SuiviCongreController();
            $leControleur->ajoutSuiviCongreTrait();
            break;

        case "consultFormationUtilisateur":

            $leControleur = new UtilisateurController();
            $leControleur->getLesUtilisateurs();
            break;
        case "listeFormationsSuivi":
            $leControleur = new CongreController();
            $leControleur->getLesCongresUtilisateur($_POST["utilisateur"]);
            break;
        case "ajoutCongresForm":

            $leControleur = new CongreController();
            $leControleur->ajoutCongreForm();
            break;
        case "ajoutCongresTrait":

            $leControleur = new CongreController();
            $leControleur->ajoutCongreTrait();
            break;
        case "modifSuiviCongreListeForm":

            $leControleur = new CongreController();
            $leControleur->getLesCongresListeDer();
            break;
        case "modifSuiviForm":

            $leControleur = new SuiviCongreController();
            $leControleur->modifSuiviCongreForm();
            break;
        case "modifSuiviTrait":

            $leControleur = new SuiviCongreController();
            $leControleur->modifSuiviCongreTrait();
            break;

        case "ajoutCaractCongresForm":

            $leControleur = new CongreController();
            $leControleur->ajoutCongreForm();

            break;
        case "consultCongresPays":

            $leControleur = new PaysController();
            $leControleur->getLesPaysListeDer();
            break;
        case "consultCongresPayss":


            $leControleur = new CongreController();
            $leControleur->getLesCongresPays($_POST["pays"]);
            break;

        case "accueil":
            // action contient accueil (choix de l'option accueil dans le menu)

            afficheFormConnexion();

            break;
        default:
            // action contient une valeur non connue : on affiche le formulaire de connexion

            afficheFormConnexion();
            break;
    }
} else {
    // action n'est pas fourni : on affiche le formulaire de connexion
    afficheFormConnexion();
}
function afficheFormConnexion()
{

    $leControleur = new UtilisateurController();

    $leControleur->connexionForm();
}
