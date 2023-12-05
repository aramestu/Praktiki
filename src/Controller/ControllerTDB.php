<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
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
        $methode = 'displayTDBetu' . $tdbAction;
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
                'listeExpPro' => $listeExpPro,
                'user' => $user,
                'cheminVueBody' => 'user/tableauDeBord/entreprise.php'
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

}