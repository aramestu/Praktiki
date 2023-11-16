<?php

namespace App\SAE\Controller;

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
        $idStage = $_GET["idStage"];

        $stage = (new StageRepository())->get($idStage);
        $entreprise = (new EntrepriseRepository())->getById($stage->getSiret());
        $etudiant = (new EtudiantRepository())->getById($stage->getNumEtudiant());
        $tuteur = (new TuteurProfessionnelRepository())->getById($stage->getMailTuteurProfessionnel());
        $prof = (new EnseignantRepository())->getById($stage->getMailEnseignant());

        ControllerGenerique::afficheVue(
            'view.php',
            [
                'pagetitle' => 'Convention',
                'cheminVueBody' => 'SAE/convention.php',
                'stage' => $stage,
                'entreprise' => $entreprise,
                'etudiant' => $etudiant,
                'tuteur' => $tuteur,
                'prof' => $prof
            ]
        );
    }

}