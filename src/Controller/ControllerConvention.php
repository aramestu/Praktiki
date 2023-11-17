<?php

namespace App\SAE\Controller;

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

    }

}