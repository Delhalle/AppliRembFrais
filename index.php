<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "ajoutUtilisateurForm":
            // demande du formulaire d'ajout d'un utilisateur
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/UtilisateurController.php");
            $leControleur = new UtilisateurController();
            $leControleur->ajoutUtilisateurForm();
            break;
        case "ajoutUtilisateurTrait":
            // le formulaire d'ajout d'un utilisateur a été soumis.
            // Vérification et enregistrement des informations saisies
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/UtilisateurController.php");
            $leControleur = new UtilisateurController();
            $leControleur->ajoutUtilisateurTrait();
            break;
        case "ajoutDemRembForm":
            
            // demande du formulaire d'ajout d'une demande de remboursement
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/DemandeRemboursementController.php");
            $leControleur = new DemandeRemboursementController();
            $leControleur->ajoutDemandeRemboursementForm();
            break;
        case "ajoutDemRembTrait":
            // le formulaire d'ajout d'une demande de remboursement a été soumis.
            // Vérification et enregistrement des informations saisies
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/DemandeRemboursementController.php");
            $leControleur = new DemandeRemboursementController();
            $leControleur->ajoutDemandeRemboursementTrait();
            break;
        case "ajoutVisiteForm":
            session_start();
            //if (session_status() == 3) {
            $idDelegue = $_SESSION['id'];
            //}
            if (isset($idDelegue) == false || $idDelegue == 0) {
                require(ROOT . "/controller/Controller.php");
                require(ROOT . "/controller/UtilisateurController.php");
                $leControleur = new UtilisateurController();
                $leControleur->connexionForm();
                break;
            }
            // demande du formulaire d'ajout d'une visite
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/VisiteController.php");
            $leControleur = new VisiteController();
            $leControleur->ajoutVisiteForm();
            break;
        case "ajoutVisiteTrait":
            // le formulaire d'ajout d'une visite a été soumis.
            // Vérification et enregistrement des informations saisies
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/VisiteController.php");
            $leControleur = new VisiteController();
            $leControleur->ajoutVisiteTrait();
            break;

            
        case "modifDemRembListeForm":
            // demande du formulaire permettant d'obtenir la liste des
            // demande de remboursement en vue d'une modification
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/DemandeRemboursementController.php");
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementListeForm();
            break;
        case "modifDemRembForm":
            // demande du formulaire de modification d'une demande de remboursement
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/DemandeRemboursementController.php");
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementForm();
            break;
        case "modifDemRembTrait":
            // le formulaire de modification d'une demande de remboursement a été soumis.
            // Vérification et enregistrement des informations saisies
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/demandeRemboursementController.php");
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementTrait();
            break;




        case "consultMesDemRemb":
            // affichage des demandes de remboursements saisies par le délegué
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/DemandeRemboursementController.php");
            $leControleur = new DemandeRemboursementController();
            $leControleur->consultMesDemandeRemboursement();
            break;
        case "consultVisite":
            // affichage des visites pour le délegué choisis
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/VisiteController.php");
            $leControleur = new VisiteController();
            $leControleur->consultLesVisites();
            break;
        case "consultVisiteListe":
            // affichage des visites pour le délegué choisis
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/UtilisateurController.php");
            $leControleur = new UtilisateurController();
            $leControleur->consultLesDeleguesListe();
            break;
        case "connexionTrait":
            // le formulaire de connexion a été soumis. 
            // Vérification des informations saisies
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/UtilisateurController.php");
            $leControleur = new UtilisateurController();
            $leControleur->connexionTrait($_POST);
            break;
        case "ajoutFormSuivi":
            // demande du formulaire d'ajout d'un utilisateur
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/FormationSuiviController.php");
            $leControleur = new FormationSuiviController();
            $leControleur->ajoutFormationSuiviForm();
            break;
        case "ajoutFormSuiviTrait":
            // demande du formulaire permettant d'obtenir la liste des
            // Formation suivi en vue d'une modification
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/FormationSuiviController.php");
            $leControleur = new FormationSuiviController();
            $leControleur->ajoutFormationSuiviTrait();
            break;
        case "consulFormSuivi":
            // affichage des formations suivi pour le délegué choisis
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/FormationSuiviController.php");
            $leControleur = new FormationSuiviController();
            $leControleur->consultLesFormationsSuivi();
            break;
        case "consulFormSuiviList":
            // affichage des délegués à choisir
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/UtilisateurController.php");
            $leControleur = new UtilisateurController();
            $leControleur->consultLesDeleguesFormListe();
            break;


        case "modifFormSuiviList":
            // demande du formulaire permettant d'obtenir la liste des
            // demande de remboursement en vue d'une modification
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/formationSuiviController.php");
            $leControleur = new formationSuiviController();
            $leControleur->modifFormationSuiviListeForm();
            break;
        case "modifFormSuiviForm":
            // demande du formulaire de modification d'une demande de remboursement
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/formationSuiviController.php");
            $leControleur = new formationSuiviController();
            $leControleur->modifFormationSuiviForm();
            break;
        case "modifFormSuiviTrait":
            // le formulaire de modification d'une demande de remboursement a été soumis.
            // Vérification et enregistrement des informations saisies
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/formationSuiviController.php");
            $leControleur = new formationSuiviController();
            $leControleur->modifFormationSuiviTrait();
            break;


            case "suppFormSuiviList":
                // demande du formulaire permettant d'obtenir la liste des
                // demande de remboursement en vue d'une suppression
                require(ROOT . "/controller/Controller.php");
                require(ROOT . "/controller/formationSuiviController.php");
                $leControleur = new formationSuiviController();
                $leControleur->suppFormationSuiviListeForm();
                break;
            case "suppFormSuiviForm":
                // demande du formulaire de suppression d'une demande de remboursement
                require(ROOT . "/controller/Controller.php");
                require(ROOT . "/controller/formationSuiviController.php");
                $leControleur = new formationSuiviController();
                $leControleur->suppFormationSuiviForm();
                break;
            case "suppFormSuiviTrait":
                // le formulaire de suppression d'une demande de remboursement a été soumis.
                // Vérification et enregistrement des informations saisies
                require(ROOT . "/controller/Controller.php");
                require(ROOT . "/controller/formationSuiviController.php");
                $leControleur = new formationSuiviController();
                $leControleur->suppFormationSuiviTrait();
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
    require(ROOT . "/controller/Controller.php");
    require(ROOT . "/controller/UtilisateurController.php");
    $leControleur = new UtilisateurController();
    $leControleur->connexionForm();
}
