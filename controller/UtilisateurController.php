<?php

class UtilisateurController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/UtilisateurRepository.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
    }
    public function connexionTrait()
    {
        $utilRepository = new UtilisateurRepository();
        $unUtilisateur = $utilRepository->connexionUtilisateur($_POST['pseudo'], $_POST['motdepasse']);
        if ($unUtilisateur == null) {
            $msgErr = "compte et/ou identifiant incorrect(s)";
            $this->render("utilisateur/connexion", array("title" => "Connexion", "msgErr" => $msgErr));
        } else {
            if (password_verify($_POST['motdepasse'], $unUtilisateur->getMotDePasse())) {
                // enregistrement existe (l'identifiant et le mot de passe sont valides)
                // on enregistre dans une variable de session le nom et le prénom de l'employé
                session_start();
                $_SESSION['profil'] = $unUtilisateur->getProfil()->getId();
                $_SESSION['id'] = $unUtilisateur->getId();
                $lesFonctionnalites = $utilRepository->fonctUtilisateur($unUtilisateur->getProfil()->getId());
                $this->creerOptionsMenus($unUtilisateur->getProfil()->getId(), $lesFonctionnalites);
                $this->render("accueil/accueil", array("title" => "Accueil"));
            } else {
                $msgErr = "identifiant et/ou mot de passe incorrect";
                $this->render("utilisateur/connexion", array("title" => "Connexion", "msgErr" => $msgErr));
            }
        }
    }
    public function creerOptionsMenus($profil, $lesFonc)
    {
        $contenuHTML = "";
        $contenuHTML = $contenuHTML . "<div class='collapse navbar-collapse' id='navbarNavDarkDropdown'>
            <ul class='navbar-nav'>
                <li class='nav-item'><a class='nav-link active' aria-current='page' href='index.php'>Accueil</a></li>";
        foreach ($lesFonc as $uneFonc) {
            $contenuHTML = $contenuHTML .
                "<li class='nav-item'>" .   // li à sortir si on veut que les options soient centrées à gauche dans le menu
                "<a class='nav-link active' href='index.php?action=" . $uneFonc->getLienMenu() . "'>"
                . $uneFonc->getLibelleMenuEnfant() . "</a>"
                . "</li>";
        }
        $contenuHTML = $contenuHTML . "</ul></div>";
        $nomFichier = "nav" . $profil;
        $fic = fopen('view/' . $nomFichier . '.html', 'w');
        fwrite($fic, $contenuHTML);
        fclose($fic);
    }
    public function connexionForm()
    {
        session_start();
        $_SESSION['nom_prenom'] = "";
        $_SESSION['profil'] = 0;
        $_SESSION['id'] = 0;
        $this->render("utilisateur/connexion", array("title" => "Connexion"));
    }
    public function ajoutUtilisateurForm()
    {
        $this->render("utilisateur/ajoutUtilisateur", array("title" => "Ajout d'un utilisateur"));
    }
    public function ajoutUtilisateurTrait()
    {
        $idProfil = 4;
        // on récupère l'id de l'utilisateur connecté
        session_start();
        $idUtilConnecte = $_SESSION['id'];

        // on génère le pseudo et le mot de passe
        $nom = trim($_POST['nom']);
        $nom = strtolower($nom);
        $prenom = trim($_POST['prenom']);
        $prenom = strtolower($prenom);
        $pseudo = substr($nom, 0, 2) . date("y") . substr($prenom, 0, 2);
        $motDePasse = "AK" . substr($nom, 0, 2) . "B1@8T" . substr($prenom, 0, 2) . "#";
        // on crypte le mot de passe
        $motDePasseHasche = password_hash($motDePasse, PASSWORD_BCRYPT);
        $unUtilisateur = new Utilisateur(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $pseudo,
            $motDePasseHasche,
            new Profil($idProfil, null),
            new Utilisateur($idUtilConnecte)
        );
        $unUtilisateurRepository = new UtilisateurRepository();
        $ret = $unUtilisateurRepository->ajoutUtilisateur($unUtilisateur);
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : l'utilisateur n'a pas été enregistré</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>L'utilisateur a été enregistré</p>";
        }
        $this->render("utilisateur/ajoutUtilisateur", array("title" => "Ajout d'un utilisateur", "msg" => $msg));
    }
}
