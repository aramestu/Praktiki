<?php
namespace App\SAE\Controller;
use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\AbstractRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\ExperienceProfessionnelRepository;
use App\SAE\Model\Repository\Model;

class ControllerEtudiant extends ControllerGenerique{

    public static function afficherListeEtudiant(){
        self::afficheVue("view.php", [
            "pagetitle" => "Liste des étudiants",
            "cheminVueBody" => "student/studentList.php"
        ]);
    }

    public static function getEtudiantBySearch(): void
    {
        $keywords = "";
        if(isset($_GET['keywords'])){
            $keywords = urldecode($_GET["keywords"]);
        }
        $listEtudiants = (new EtudiantRepository())->getAll();
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Recherche',
                'listEtudiants' => $listEtudiants,
                'cheminVueBody' => 'student/studentList.php',
            ]
        );
    }

    public static function afficherMettreAJourEtudiant(): void
    {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new EtudiantRepository())->getByEmail($mail);
        if (is_null($user)) {
            self::redirectionVersURL("warning", "Etudiant inconnu", "home");
        } else {
            self::afficheVue('view.php', ["user" => $user, "pagetitle" => "Detail d'une Etudiant", "cheminVueBody" => "user/tableauDeBord/formulaireEtudiant.php"]);
        }
    }

    public static function mettreAJour(): void
    {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new EtudiantRepository())->getByEmail($mail);
        if (!is_null($user)) {
            $user = Etudiant::construireDepuisFormulaire($_GET);
            (new EtudiantRepository())->mettreAJour($user);
            self::redirectionVersURL("success", "L'etudiant a été mis à jour", "displayTDBetu&controller=Etudiant");
        } else {
            self::redirectionVersURL("warning", "Cet etudiant n'existe pas", "afficherFormulaireMiseAJour");
        }
    }



}