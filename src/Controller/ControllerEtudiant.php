<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Etudiant;
use App\SAE\Model\Repository\AbstractExperienceProfessionnelRepository;
use App\SAE\Model\Repository\AbstractRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\Model;

class ControllerEtudiant extends ControllerGenerique
{

    public static function afficherListeEtudiant()
    {
        self::afficheVue("view.php", [
            "pagetitle" => "Liste des étudiants",
            "cheminVueBody" => "student/studentList.php"
        ]);
    }

    public static function getEtudiantBySearch(): void
    {
        $keywords = "";
        if (isset($_GET['keywords'])) {
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

    public static function displayTDBetu()
    {
        $listeExpPro = AbstractExperienceProfessionnelRepository::rechercheAllOffreFiltree(null, null, null, null, null
            , null, null, "lastWeek", null, null);
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new EtudiantRepository())->getByEmail($mail);
        self::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Tableau de bord',
                'listeExpPro' => $listeExpPro,
                'user' => $user,
                'cheminVueBody' => 'user/tableauDeBord/etudiant.php',
            ]
        );
    }

    public static function afficherDetailEtudiant(): void
    {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new EtudiantRepository())->getByEmail($mail);
        if (is_null($user)) {
            self::afficheVue('view.php', ["pagetitle" => "Page d'erreur", "cheminVueBody" => "student/error.php", "messageErreur" => "Cet étudiant n'existe pas"]);
        } else {
            self::afficheVue('view.php', ["user" => $user, "pagetitle" => "Detail d'un étudiant", "cheminVueBody" => "user/tableauDeBord/formulaireEtudiant.php"]);
        }
    }

    public static function mettreAJour(): void
    {
        $mail = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $user = (new etudiantRepository())->getByEmail($mail);
        if (!is_null($user)) {
            $user = Etudiant::construireDepuisFormulaire($_GET);
            (new etudiantRepository())->mettreAJour($user);
            self::redirectionVersURL("success", "L'etudiant a été mis à jour", "displayTDBetu&controller=Etudiant");
        } else {
            self::redirectionVersURL("warning", "cet etudiant n'existe pas", "afficherFormulaireMiseAJour");
        }

    }


}