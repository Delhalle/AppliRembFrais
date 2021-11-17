<?php
//class dont on a besoin (classe Repository.php obligatoire)
require_once(ROOT . "/model/repository/Repository.php");
require_once(ROOT . "/model/entity/Utilisateur.php");
require_once(ROOT . "/model/entity/Profil.php");
require_once(ROOT . "/model/entity/Fonctionnalite.php");
class UtilisateurRepository extends Repository
{
    // fonction de connexion
    public function connexionUtilisateur($pseudo, $motDePasse): ?Utilisateur
    {
        $db = $this->dbConnect();
        $msg = "";
        if (trim($pseudo) == "") {
            $msg = $msg . "Le pseudo est obligatoire </br>";
        }
        if (trim($motDePasse) == "") {
            $msg = $msg . "Le mot de passe est obligatoire </br>";
        }
        if ($msg == "") {
            try {

                // on prépare la requête select
                $req = $db->prepare("SELECT id,nom, prenom,pseudo,mot_de_passe,id_profil 
                FROM utilisateur 
                WHERE pseudo = :par_pseudo");
                // on affecte une valeur au paramètre déclaré dans la requête 
                $req->bindValue(':par_pseudo', $pseudo, PDO::PARAM_STR);
                // on demande l'exécution de la requête 
                $req->execute();
                // on récupere la valeur retournée par la requête 
                $enreg = $req->fetch();
                $unUtilisateur = new Utilisateur(
                    $enreg->id,
                    $enreg->nom,
                    $enreg->prenom,
                    $enreg->pseudo,
                    $enreg->mot_de_passe,
                    new Profil($enreg->id_profil, null),
                    null
                );
            } catch (PDOException $e) {
                die("BDselConnex: erreur vérification connexion 
                                <br>Erreur :" . $e->getMessage());
            }
            return $unUtilisateur;
        } else {
            return null;
        }
    }
    public function fonctUtilisateur($profil)
    {
        $lesFoncts = array();
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("select libelle_menu_parent,libelle_menu_enfant, lien_menu
            from fonctionnalite f
            join profil_fonct pf on pf.id_fonct = f.id
            join profil p on pf.id_profil =  p.id 
            where p.id =:par_profil");
            // on affecte une valeur au paramètre déclaré dans la requête 
            $req->bindValue(':par_profil', $profil, PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $req->execute();
            // on récupere la valeur retournée par la requête 
            $lesEnregs = $req->fetchAll();
            foreach ($lesEnregs  as $enreg) {
                $uneFonct = new Fonctionnalite(
                    null,
                    null,
                    $enreg->libelle_menu_parent,
                    $enreg->libelle_menu_enfant,
                    $enreg->lien_menu
                );
                array_push($lesFoncts, $uneFonct);
            }
        } catch (PDOException $e) {
            die("BDselprofil: erreur accès profil 
                            <br>Erreur :" . $e->getMessage());
        }
        return $lesFoncts;
    }
    public function ajoutUtilisateur(Utilisateur $utilACreer)
    {
        $db = $this->dbConnect();
        try {

            $req = $db->prepare("insert into utilisateur
            values (0,:par_nom,:par_prenom,:par_pseudo,:par_motDePasse,:par_id_profil,:par_id_dern_util)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_nom', $utilACreer->getNom(), PDO::PARAM_STR);
            $req->bindValue(':par_prenom', $utilACreer->getPrenom(), PDO::PARAM_STR);
            $req->bindValue(':par_pseudo', $utilACreer->getPseudo(), PDO::PARAM_STR);
            $req->bindValue(':par_motDePasse', $utilACreer->getMotDePasse(), PDO::PARAM_STR);
            $req->bindValue(':par_id_profil', $utilACreer->getProfil()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_dern_util', $utilACreer->getDerUtilAction()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
}
