<?php

namespace App\SAE\Controller;

use App\SAE\Model\DataObject\Convention;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\StageRepository;

class ControllerConvention extends ControllerGenerique
{
    public static function displayConvention(): void{
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
            ]
        );
    }


    public static function afficherFormulaire(): void{
        $idEtudiant = $_GET["idEtudiant"];
        $etudiant = (new EtudiantRepository())->getById($idEtudiant);
        $convention = (new ConventionRepository())->getConventionAvecEtudiant($idEtudiant);
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
                'convention' => $convention,
                'etudiant' => $etudiant
            ]
        );
    }

    public static function modifierConvention(): void {
        $rep = new ConventionRepository();
        $convention = $rep->construireDepuisTableau($_POST);
        $rep->mettreAJour($convention);
        ControllerTDB::displayTDB();
    }

    public static function creerFormulaire(): void{
        $idEtudiant = $_GET["idEtudiant"];
        $etudiant = (new EtudiantRepository())->getById($idEtudiant);
        (new ConventionRepository())->creerConvention($idEtudiant, 3);
        $convention = (new ConventionRepository())->getConventionAvecEtudiant($idEtudiant);
        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
                'convention' => $convention,
                'etudiant' => $etudiant
            ]
        );
    }

    public static function enregistrerConvention() {
        $rep = new ConventionRepository();
        $idEtudiant = $_GET["idEtudiant"];
        $convention = $rep->getConventionAvecEtudiant($idEtudiant);
        $convention->setEstFini(true);
        $rep->mettreAJour($convention);
        ControllerTDB::displayTDB();
    }
}