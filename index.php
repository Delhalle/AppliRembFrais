<?php
use App\Autoloader;
use App\Controller\{UtilisateurController, DemandeRemboursementController, VisiteController, FormationSuiviController};

use function PHPSTORM_META\registerArgumentsSet;

require_once "./Autoloader.php";
Autoloader::register();

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "ajoutUtilisateurForm":
            // demande du formulaire d'ajout d'un utilisateur
            $leControleur = new UtilisateurController();
            $leControleur->ajoutUtilisateurForm();
            break;
        case "ajoutUtilisateurTrait":
            // le formulaire d'ajout d'un utilisateur a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new UtilisateurController();
            $leControleur->ajoutUtilisateurTrait();
            break;
        case "ajoutDemRembForm":
            
            // demande du formulaire d'ajout d'une demande de remboursement
            $leControleur = new DemandeRemboursementController();
            $leControleur->ajoutDemandeRemboursementForm();
            break;
        case "ajoutDemRembTrait":
            // le formulaire d'ajout d'une demande de remboursement a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new DemandeRemboursementController();
            $leControleur->ajoutDemandeRemboursementTrait();
            break;
        case "ajoutVisiteForm":
            session_start();
            //if (session_status() == 3) {
            $idDelegue = $_SESSION['id'];
            //}
            if (isset($idDelegue) == false || $idDelegue == 0) {
                $leControleur = new UtilisateurController();
                $leControleur->connexionForm();
                break;
            }
            // demande du formulaire d'ajout d'une visite
            $leControleur = new VisiteController();
            $leControleur->ajoutVisiteForm();
            break;
        case "ajoutVisiteTrait":
            // le formulaire d'ajout d'une visite a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new VisiteController();
            $leControleur->ajoutVisiteTrait();
            break;
        case "modifDemRembListeForm":
            // demande du formulaire permettant d'obtenir la liste des
            // demande de remboursement en vue d'une modification
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementListeForm();
            break;
        case "modifDemRembForm":
            // demande du formulaire de modification d'une demande de remboursement
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementForm();
            break;
        case "modifDemRembTrait":
            // le formulaire de modification d'une demande de remboursement a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementTrait();
            break;
        case "consultMesDemRemb":
            // affichage des demandes de remboursements saisies par le délegué
            $leControleur = new DemandeRemboursementController();
            $leControleur->consultMesDemandeRemboursement();
            break;
        case "consultVisite":
            // affichage des visites pour le délegué choisis
            $leControleur = new VisiteController();
            $leControleur->consultLesVisites();
            break;
        case "consultVisiteListe":
            // affichage des visites pour le délegué choisis
            $leControleur = new UtilisateurController();
            $leControleur->consultLesDeleguesListe();
            break;
        case "connexionTrait":
            // le formulaire de connexion a été soumis. 
            // Vérification des informations saisies
            $leControleur = new UtilisateurController();
            $leControleur->connexionTrait($_POST);
            break;
        case "ajoutFormSuivi":
            // demande du formulaire d'ajout d'un utilisateur
            $leControleur = new FormationSuiviController();
            $leControleur->ajoutFormationSuiviForm();
            break;
        case "ajoutFormSuiviTrait":
            // demande du formulaire permettant d'obtenir la liste des
            // Formation suivi en vue d'une modification
            $leControleur = new FormationSuiviController();
            $leControleur->ajoutFormationSuiviTrait();
            break;
        case "consulFormSuivi":
            // affichage des formations suivi pour le délegué choisis
            $leControleur = new FormationSuiviController();
            $leControleur->consultLesFormationsSuivi();
            break;
        case "consulFormSuiviList":
            // affichage des délegués à choisir
            $leControleur = new UtilisateurController();
            $leControleur->consultLesDeleguesFormListe();
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
