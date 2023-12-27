<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Service\ServiceEnseignant;
use App\SAE\Service\ServiceEntreprise;
use App\SAE\Service\ServiceEtudiant;

class ControllerTDB extends ControllerGenerique {

    public static function displayTDB():void{
        if (!ConnexionUtilisateur::estConnecte()){
            self::redirectionVersURL("warning", "Veuillez vous connecter pour acceder à cette page", "home");
            return;
        }
        $tdbAction = isset($_GET["tdbAction"]) ? ucfirst($_GET["tdbAction"]) : "";
        $reflexion = new \ReflectionClass(new ControllerTDB());
        if (ConnexionUtilisateur::estEtudiant()) {
            $methode = 'displayTDBetu';
        } elseif (ConnexionUtilisateur::estEnseignant()) {
            $methode = 'displayTDBens';
        } elseif (ConnexionUtilisateur::estEntreprise()) {
            $methode = 'displayTDBentreprise';
        } else {
            self::redirectionVersURL("danger", "Utilisateur non enregistré dans la base de données", "home");
            return;
        }
        $methode = $methode . $tdbAction;
        if($reflexion->hasMethod($methode)){
            self::$methode();
        }else{
            self::error("");
        }
    }
    private static function displayTDBens() {
        $listeExpPro = (new ExperienceProfessionnelRepository())->search(null, null, null, null,null,
            null,null,"lastWeek",null,null);
        $mail=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new EnseignantRepository())->getByEmail($mail);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'user'=>$user,
                'cheminVueBody' => 'user/tableauDeBord/enseignant.php',
                'TDBView' => 'user/tableauDeBord/enseignant/accueilEnseignant.php',
                'listeExpPro' => $listeExpPro
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

    public static function displayTDBensMettreAJour(): void
    {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $enseignant = (new EnseignantRepository())->getByEmail($mail);

        (new ServiceEnseignant())->mettreAJour($enseignant, []);
        self::redirectionVersURL("success", "L'enseignant a été mis à jour", "displayTDB&controller=TDB");
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

    public static function displayTDBentrepriseMettreAJour(): void {
        $siret = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $entreprise = (new entrepriseRepository())->getById($siret);
        $attributs = [];
        if(isset($_POST["nom"])){
            $attributs["nomEntreprise"] = $_POST["nom"];
        }
        if(isset($_POST["mail"])){
            $attributs["mailEntreprise"] = $_POST["mail"];
        }
        if(isset($_POST["telephone"])){
            $attributs["telephoneEntreprise"] = $_POST["telephone"];
        }
        if(isset($_POST["postcode"])){
            $attributs["codePostalEntreprise"] = $_POST["postcode"];
        }
        if(isset($_POST["website"])){
            $attributs["siteWebEntreprise"] = $_POST["website"];
        }
        if(isset($_POST["effectif"])){
            $attributs["effectifEntreprise"] = $_POST["effectif"];
        }

        (new ServiceEntreprise())->mettreAJour($entreprise, $attributs);
        self::redirectionVersURL("success", "L'entreprise a été mis à jour", "displayTDB&controller=TDB");
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
        $convention=(new ConventionRepository())->getConventionAvecEtudiant($user->getNumEtudiant());
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'cheminVueBody' => 'user/tableauDeBord/etudiant.php',
                'TDBView' => 'user/tableauDeBord/etudiant/gestionEtudiant.php',
                'user'=>$user,
                'convention'=>$convention
            ]
        );
    }

    public static function displayTDBetuMettreAJour(): void {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $etudiant = (new EtudiantRepository())->getByEmail($mail);
        $attributs = [];
        if(isset($_POST["mailPerso"])){
            $attributs["mailPersoEtudiant"] = $_POST["mailPerso"];
        }
        if(isset($_POST["telephone"])){
            $attributs["telephoneEtudiant"] = $_POST["telephone"];
        }
        if(isset($_POST["postcode"])){
            $attributs["codePostalEtudiant"] = $_POST["postcode"];
        }

        (new ServiceEtudiant())->mettreAJour($etudiant, $attributs);
        self::redirectionVersURL("success", "L'etudiant a été mis à jour", "displayTDB&controller=TDB");
    }

    public static function displayTDBetuEnvoyerConvention(): void {
        $convention = (new ConventionRepository())->getConventionAvecEtudiant((new EtudiantRepository())->getByEmail(ConnexionUtilisateur::getLoginUtilisateurConnecte())->getNumEtudiant());
        if (!is_null($convention)) {
            $convention->setEstFini(true);
            (new ConventionRepository())->mettreAJour($convention);
            self::redirectionVersURL("success", "Convention envoyée", "displayTDB&controller=TDB&tdbAction=gestion");
        } else {
            self::redirectionVersURL("warning", "Cet etudiant ne possède pas de convention", "afficherFormulaireMiseAJour");
        }
    }

}