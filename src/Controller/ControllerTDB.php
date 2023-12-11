<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;

class ControllerTDB extends ControllerGenerique {

    public static function displayTDB():void{
        if (!ConnexionUtilisateur::estConnecte()){
            self::redirectionVersURL("warning", "Veuillez vous connecter pour acceder à cette page", "home");
            return;
        }
        $tdbAction = isset($_GET["tdbAction"]) ? ucfirst($_GET["tdbAction"]) : "";
        $reflexion = new \ReflectionClass(new ControllerTDB());
        $methode =  match (true) {
                        ConnexionUtilisateur::estEtudiant() =>  'displayTDBetu',
                        ConnexionUtilisateur::estEnseignant() => 'displayTDBens',
                        ConnexionUtilisateur::estEntreprise() => 'displayTDBentreprise',
                        default => ""
                    };
        if($methode = ""){
            self::redirectionVersURL("danger", "Utilisateur non enregistré dans la base de données", "home");
            return;
        }
        if(ConnexionUtilisateur::estEtudiant()){
            $methode = 'displayTDBetu'.$tdbAction;
        }
        else if(ConnexionUtilisateur::estEntreprise()){
            $methode = 'displayTDBentreprise'.$tdbAction;
        }
        else if(ConnexionUtilisateur::estEnseignant()){
            $methode = 'displayTDBens'.$tdbAction;
        }
        if($reflexion->hasMethod($methode)){
            self::$methode();
        }else{
            self::error("");
        }
    }
    private static function displayTDBens() {
        $mail=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new EnseignantRepository())->getByEmail($mail);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'user'=>$user,
                'cheminVueBody' => 'user/tableauDeBord/enseignant.php',
                'TDBView' => 'user/tableauDeBord/enseignant/accueilEnseignant.php'
            ]
        );
    }

    private static function displayTDBensInfo() {
        $siret=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new EnseignantRepository())->getById($siret);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'cheminVueBody' => 'user/tableauDeBord/enseignant.php',
                'TDBView' => 'user/tableauDeBord/enseignant/infoEnseignant.php',
                'user'=>$user
            ]
        );
    }

    private static function displayTDBentreprise(): void {
        $listeExpPro =  (new ExperienceProfessionnelRepository())->search(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        $siret=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new EntrepriseRepository())->getById($siret);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'cheminVueBody' => 'user/tableauDeBord/entreprise.php',
                'TDBView' => 'user/tableauDeBord/entreprise/accueilEntreprise.php',
                'user'=>$user,
                'listeExpPro' => $listeExpPro
            ]
        );
    }

    private static function displayTDBentrepriseInfo() {
        $siret=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new EntrepriseRepository())->getById($siret);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'cheminVueBody' => 'user/tableauDeBord/entreprise.php',
                'TDBView' => 'user/tableauDeBord/entreprise/infoEntreprise.php',
                'user'=>$user
            ]
        );
    }

    private static function displayTDBetu() {
        $listeExpPro = (new ExperienceProfessionnelRepository())->search(null, null, null, null,null,
            null,null,"lastWeek",null,null);
        $mail=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new EtudiantRepository())->getByEmail($mail);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'cheminVueBody' => 'user/tableauDeBord/etudiant.php',
                'TDBView' => 'user/tableauDeBord/etudiant/accueilEtudiant.php',
                'user'=>$user,
                'listeExpPro' => $listeExpPro
            ]
        );
    }

    private static function displayTDBetuInfo() {
        $mail=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new EtudiantRepository())->getByEmail($mail);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'cheminVueBody' => 'user/tableauDeBord/etudiant.php',
                'TDBView' => 'user/tableauDeBord/etudiant/infoEtudiant.php',
                'user'=>$user
            ]
        );
    }

    private static function displayTDBetuGestion() {
        $mail=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new EtudiantRepository())->getByEmail($mail);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'cheminVueBody' => 'user/tableauDeBord/etudiant.php',
                'TDBView' => 'user/tableauDeBord/etudiant/gestionEtudiant.php',
                'user'=>$user
            ]
        );
    }

    public static function displayTDBetuMettreAJour(): void {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new EtudiantRepository())->getByEmail($mail);
        if (!is_null($user)) {
            $user = Etudiant::construireDepuisFormulaire($_GET);
            (new EtudiantRepository())->mettreAJour($user);
            self::redirectionVersURL("success", "L'etudiant a été mis à jour", "displayTDB&controller=TDB");
        } else {
            self::redirectionVersURL("warning", "Cet etudiant n'existe pas", "afficherFormulaireMiseAJour");
        }
    }

}