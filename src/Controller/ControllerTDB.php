<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\DataObject\Personnel;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\Repository\PersonnelRepository;
use App\SAE\Service\ServiceEnseignant;
use App\SAE\Service\ServiceEntreprise;
use App\SAE\Service\ServiceEtudiant;
use App\SAE\Service\ServicePersonnel;

/**
 * Contrôleur pour l'affichage du tableau de bord des utilisateurs.
 */
class ControllerTDB extends ControllerGenerique {

    /**
     * Affiche le tableau de bord en fonction du type d'utilisateur.
     *
     * @return void
     */
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
        } elseif (ConnexionUtilisateur::estPersonnel()) {
            $methode = 'displayTDBpers';
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

    /**
     * Affiche le tableau de bord pour un enseignant.
     *
     * @return void
     */
    private static function displayTDBens(): void
    {
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

    /**
     * Affiche les informations du tableau de bord pour un enseignant.
     *
     * @return void
     */
    private static function displayTDBensInfo(): void
    {
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


    /**
     * Met à jour les informations de l'enseignant depuis le tableau de bord.
     *
     * Cette méthode récupère l'enseignant connecté, utilise le service Enseignant
     * pour mettre à jour ses informations avec des attributs vides (aucune modification spécifiée).
     * Enfin, elle redirige l'utilisateur vers le tableau de bord avec un message de succès.
     *
     * @return void
     */
    public static function displayTDBensMettreAJour(): void
    {
        // Récupérer l'adresse e-mail de l'utilisateur connecté
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();

        // Récupérer l'objet enseignant correspondant à l'adresse e-mail
        $enseignant = (new EnseignantRepository())->getByEmail($mail);

        // Utiliser le service Enseignant pour mettre à jour les informations (avec attributs vides)
        (new ServiceEnseignant())->mettreAJour($enseignant, []);

        // Rediriger vers le tableau de bord avec un message de succès
        self::redirectionVersURL("success", "L'enseignant a été mis à jour", "displayTDB&controller=TDB");
    }

    /**
     * Affiche le tableau de bord pour un personnel.
     *
     * @return void
     */
    private static function displayTDBpers(): void
    {
        $listeExpPro = (new ExperienceProfessionnelRepository())->search(null, null, null, null,null,
            null,null,"lastWeek",null,null);
        $mail=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new PersonnelRepository())->getByEmail($mail);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'user'=>$user,
                'cheminVueBody' => 'user/tableauDeBord/personnel.php',
                'TDBView' => 'user/tableauDeBord/personnel/accueilPersonnel.php',
                'listeExpPro' => $listeExpPro
            ]
        );
    }

    /**
     * Affiche les informations du tableau de bord pour un personnel.
     *
     * @return void
     */
    private static function displayTDBpersInfo(): void
    {
        $siret=ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user=(new PersonnelRepository())->getById($siret);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'cheminVueBody' => 'user/tableauDeBord/personnel.php',
                'TDBView' => 'user/tableauDeBord/personnel/infoPersonnel.php',
                'user'=>$user
            ]
        );
    }


    /**
     * Met à jour les informations du ppersonnel depuis le tableau de bord.
     *
     * Cette méthode récupère l'personnel connecté, utilise le service Personnel
     * pour mettre à jour ses informations avec des attributs vides (aucune modification spécifiée).
     * Enfin, elle redirige l'utilisateur vers le tableau de bord avec un message de succès.
     *
     * @return void
     */
    public static function displayTDBpersMettreAJour(): void
    {
        // Récupérer l'adresse e-mail du putilisateur connecté
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();

        // Récupérer l'objet personnel correspondant à l'adresse e-mail
        $personnel = (new PersonnelRepository())->getByEmail($mail);

        // Utiliser le service Personnel pour mettre à jour les informations (avec attributs vides)
        (new ServicePersonnel())->mettreAJour($personnel, []);

        // Rediriger vers le tableau de bord avec un message de succès
        self::redirectionVersURL("success", "L'personnel a été mis à jour", "displayTDB&controller=TDB");
    }
    

    /**
     * Affiche le tableau de bord pour une entreprise.
     *
     * @return void
     */
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

    /**
     * Affiche les informations du tableau de bord pour une entreprise.
     *
     * @return void
     */
    private static function displayTDBentrepriseInfo(): void
    {
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

    /**
     * Met à jour les informations d'une entreprise depuis le tableau de bord.
     *
     * @return void
     */
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

    /**
     * Affiche le tableau de bord pour un étudiant.
     *
     * @return void
     */
    private static function displ1ayTDBetu(): void
    {
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

    /**
     * Affiche les informations du tableau de bord pour un étudiant.
     *
     * @return void
     */
    private static function displayTDBetuInfo() : void{
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

    /**
     * Affiche le tableau de bord de gestion pour un étudiant.
     *
     * @return void
     */
    private static function displayTDBetuGestion(): void
    {
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

    /**
     * Met à jour les informations d'un étudiant depuis le tableau de bord.
     *
     * @return void
     */
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

    /**
     * Envoie une convention depuis le tableau de bord d'un étudiant.
     *
     * @return void
     */
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