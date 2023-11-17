<?php

namespace App\SAE\Controller;

use App\SAE\Model\DataObject\Convention;
use App\SAE\Model\Repository\ConventionRepository;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use App\SAE\Model\Repository\EtudiantRepository;
use App\SAE\Model\Repository\StageRepository;
use App\SAE\Model\Repository\TuteurProfessionnelRepository;

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
        $idConvention = $_GET["idConvention"];

        $convention = (new ConventionRepository())->getById($idConvention);
        $stage = (new StageRepository())->get($convention->getIdStage());
        $entreprise = (new EntrepriseRepository())->getById($stage->getSiret());
        $etudiant = (new EtudiantRepository())->getById($stage->getNumEtudiant());
        $tuteur = (new TuteurProfessionnelRepository())->getById($stage->getMailTuteurProfessionnel());
        $prof = (new EnseignantRepository())->getById($stage->getMailEnseignant());

        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
                'convention' => $convention,
                'stage' => $stage,
                'entreprise' => $entreprise,
                'etudiant' => $etudiant,
                'tuteur' => $tuteur,
                'prof' => $prof
            ]
        );
    }

    public static function modifierConvention(): void {
        $tab = [
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
        ];
        $convention = new Convention($tab["idConvention"], $tab["idStage"], $tab["competencesADevelopper"], $tab["dureeDeTravail"], $tab["languesImpression"], $tab["origineDeLaConvention"], true, $tab["nbHeuresHebdo"], $tab["modePaiement"], $tab["dureeExperienceProfessionnel"], $tab["caisseAssuranceMaladie"], true, true);
        (new ConventionRepository())->mettreAJour($convention);
        ControllerGenerique::home();
    }

}