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
        //$idConvention = $_GET["idConvention"];
        $etudiant = (new EtudiantRepository())->getById($idEtudiant);
        $convention = (new ConventionRepository())->getConventionAvecEtudiant($idEtudiant);
        var_dump($etudiant);
        var_dump($convention);
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
        /*$tab = [
            "idConvention" => $_POST["idConvention"],
            "idStage" => $_POST["idStage"],
            "competencesADevelopper" => $_POST["competences"],
            "dureeDeTravail" => $_POST["dureeTravail"],
            "languesImpression" => $_POST["langueConvention"],
            "origineDeLaConvention" => $_POST["origineStage"],
            "sujetEstConfidentiel" => $_POST["confidentialite"],
            "nbHeuresHebdo" => $_POST["nombreHeuresHebdo"],
            "modePaiement" => $_POST["modaliteVersement"],
            "dureeExperienceProfessionnel" => $_POST["dureeStage"],
            "caisseAssuranceMaladie" => $_POST["assuranceMaladie"],
            "estSignee" => $_POST["estSignee"],
            "estValidee" => $_POST["estValidee"]
        ];*/
        $rep = new ConventionRepository();
        $convention = $rep->construireDepuisTableau($_POST);
        //$convention = new Convention($tab["idConvention"], $tab["idStage"], $tab["competencesADevelopper"], $tab["dureeDeTravail"], $tab["languesImpression"], $tab["origineDeLaConvention"], true, $tab["nbHeuresHebdo"], $tab["modePaiement"], $tab["dureeExperienceProfessionnel"], $tab["caisseAssuranceMaladie"], true, true);
        $rep->mettreAJour($convention);
        ControllerGenerique::home();
    }
}