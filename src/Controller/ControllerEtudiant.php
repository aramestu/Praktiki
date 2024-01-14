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

/**
 * Contrôleur gérant les actions liées aux étudiants.
 */
class ControllerEtudiant extends ControllerGenerique
{
    /**
     * Affiche la liste des étudiants.
     *
     * @return void
     */
    public static function afficherListeEtudiant() : void{
        self::afficheVue("view.php", [
            "pagetitle" => "Liste des étudiants",
            "cheminVueBody" => "student/studentList.php"
        ]);
    }

    /**
     * Obtient la liste des étudiants en fonction de la recherche par mots-clés.
     *
     * @return void
     */
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
}